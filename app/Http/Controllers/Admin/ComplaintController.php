<?php

namespace App\Http\Controllers\Admin;

use App\Jobs\SendComplaintResolvedEmail;
use App\Models\User;
use Flasher\SweetAlert\Prime\SweetAlertInterface;
use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class ComplaintController extends Controller
{
    public function index(Request $request)
    {

        $authUser = auth()->user();
        $status = $request->get('status');
        $users = User::where('id', '!=', $authUser->id)->get();
        $authUserRole = $authUser->role->name;

        $complaintsQuery = Complaint::query();

        if (!in_array($authUserRole, ['Super Admin', 'Admin'])) {

            $authUserDepartments = $authUser->departments->pluck('name')->toArray();
            $complaintsQuery->where(function($query) use ($authUserDepartments, $authUser) {
                $query->whereIn('department', $authUserDepartments)
                    ->orWhere('resolver_id', $authUser->id);
            });
        }
        if ($status) {
            $complaintsQuery->where('status', $status);
        }
        $complaints = $complaintsQuery->get();

        return view('admin.complaints.index', compact('complaints', 'users'));
    }


    public function show(Complaint $complaint)
    {
        // Fetch all users
        $users = User::whereHas('role', function($query) {
            // Only fetch users with 'Super Admin', 'Admin', or users who are linked to the same department
            $query->whereIn('name', ['Super Admin', 'Admin']);
        })->orWhereHas('departments', function($query) use ($complaint) {
            // Fetch users associated with the same department as the complaint
            $query->where('name', $complaint->department);
        })->orWhere('id', $complaint->resolver_id) // Include the resolver if they are set
        ->get();

        // Return the view with the complaint and users who can view it
        return view('admin.complaints.view', compact('complaint', 'users'));
    }


    public function updateStatus(Request $request)
    {
        $complaint = Complaint::find($request->complaint_id);

        // Check if the complaint exists
        if (!$complaint) {
            return response()->json([
                'success' => false,
                'message' => 'Complaint not found.',
            ]);
        }

        // Check if the complaint is already resolved
        if ($complaint->status == 'Resolved') {
            $resolver = $complaint->resolver ? $complaint->resolver->name : 'Unknown';

            return response()->json([
                'success' => false,
                'message' => 'This complaint has already been resolved by ' . $resolver,
            ]);
        }

        // Role-based permission: Only Admin or Super Admin can update "Forwarded" to "In Progress"
        if ($complaint->status == 'Forwarded') {
            $authUser = auth()->user();
            $authUserRole = $authUser->role->name;

            if (!in_array($authUserRole, ['Super Admin', 'Admin'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only Admin or Super Admin can update a forwarded complaint to "In Progress".',
                ]);
            }
            $complaint->resolver_id = null;
        }


        // Check if complaint is already in progress
        if ($complaint->status == 'In Progress' && $request->status == 'In Progress') {
            return response()->json([
                'success' => false,
                'message' => 'This complaint is already in progress.',
            ]);
        }

        // Update the complaint's status
        $complaint->status = $request->status;

        // If the complaint is being resolved
        if ($request->status == 'Resolved') {
            $complaint->resolved_by = auth()->id();

            // Store comments if provided
            if ($request->has('comments')) {
                $complaint->comments = $request->comments;
            }
            // Handle attachment upload if provided
            if ($request->hasFile('attachment')) {
                // Validate the file type and size if needed
                try {
                    // Validate the attachment
                    $request->validate([
                        'attachment' => 'file|mimes:jpg,jpeg,png,pdf|max:2048',
                    ]);
                } catch (\Illuminate\Validation\ValidationException $e) {
                    return response()->json([
                        'success' => false,
                        'errors' => $e->validator->errors(), // Return validation errors
                    ]);
                }

                $file = $request->file('attachment');
                $filename = time() . '_' . $file->getClientOriginalName();

                // Ensure the directory exists
                $destinationPath = public_path('attachments');
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0755, true); // Create directory if it doesn't exist
                }

                // Move the file
                $file->move($destinationPath, $filename);
                $complaint->attachment = $filename; // Store the filename in the database
            }

            // Save the updated complaint
            $complaint->save();

            // Prepare email details
            $details = [
                'name' => $complaint->name,
                'email' => $complaint->email,
                'complaint_id' => $complaint->id,
                'department' => $complaint->department,
                'comments' => $complaint->comments,
                'attachment' => $complaint->attachment ? url('attachments/' . $complaint->attachment) : null, // Provide URL for attachment
            ];

            // Dispatch the email job
            SendComplaintResolvedEmail::dispatch($details);
        }
        $complaint->save();
        return response()->json([
            'success' => true,
            'complaint_id' => $complaint->id,
            'status' => $complaint->status,
            'message' => 'Complaint status updated successfully.'
        ]);
    }


//    public function filterComplaints(Request $request)
//    {
//        $status = $request->get('status');
//
//        if ($status) {
//            $complaints = Complaint::where('status', $status)->get();
//        } else {
//            $complaints = Complaint::all();
//        }
//
//        return view('admin.complaints.index', compact('complaints'));
//    }


    public function getUsers()
    {
        $authUser = auth()->user();
        $authUserRole = $authUser->role->name;
        $query = User::where('id', '!=', $authUser->id); // Exclude the authenticated user
        if (!in_array($authUserRole, ['Super Admin','Admin'])) {
            $query->whereHas('role', function($q) {
                $q->whereNotIn('name', ['Super Admin', 'Admin']);

            });
        }
        $users = $query->get(['id', 'name']);

        return response()->json([
            'success' => true,
            'users' => $users
        ]);
    }

    public function forwardComplaint(Request $request)
    {
        Log::info('Forwarding complaint:', $request->all());

        $complaint = Complaint::find($request->complaint_id);

        if (!$complaint) {
            return response()->json([
                'success' => false,
                'message' => 'Complaint not found.',
            ]);
        }
        $request->validate([
            'resolver_id' => 'required|exists:users,id',
        ]);

        if ($complaint->status == 'Forwarded') {
            $currentResolver = $complaint->forwardTo ? $complaint->forwardTo->name : 'Unknown';

            return response()->json([
                'success' => false,
                'message' => 'This complaint has already been forwarded to ' . $currentResolver,
            ]);
        }

        if ($complaint->status == 'Resolved') {
            return response()->json([
                'success' => false,
                'message' => 'Cannot forward a resolved complaint.',
            ]);
        }

        $newResolver = User::findOrFail($request->resolver_id);

        $forwardHistory = json_decode($complaint->forward_history, true) ?? [];
        $forwardHistory[] = [
            'from' => auth()->user()->name,
            'to' => $newResolver->name,
            'forwarded_at' => now()->toDateTimeString(),
        ];

        // Update the complaint's resolver, status, and forward history
        $complaint->resolver_id = $newResolver->id;
        $complaint->status = 'Forwarded';
        $complaint->forward_history = json_encode($forwardHistory);

        // Save the updated complaint
        $complaint->save();

        return response()->json([
            'success' => true,
            'complaint_id' => $complaint->id,
            'status' => 'Forwarded',
            'message' => 'Complaint forwarded to ' . $newResolver->name,
        ]);
    }

}
