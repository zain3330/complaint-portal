<?php

namespace App\Http\Controllers\Admin;

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
        // Get the current authenticated user's departments
        $authUserDepartments = auth()->user()->departments->pluck('id')->toArray();

        // Fetch the status from the request
        $status = $request->get('status');

        // Get users except the authenticated one
        $users = User::where('id', '!=', auth()->id())->get();

        // Fetch complaints that belong to one of the authenticated user's departments
        $complaintsQuery = Complaint::whereIn('department', $authUserDepartments);

        // Apply status filter if provided
        if ($status) {
            $complaintsQuery->where('status', $status);
        }

        // Get the filtered complaints
        $complaints = $complaintsQuery->get();

        return view('admin.complaints.index', compact('complaints', 'users'));
    }


    public function show(Complaint $complaint)
    {
        return view('admin.complaints.view', compact('complaint'));
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
            if (!auth()->user()->hasRole(['Super Admin', 'Admin'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Only Admin or Super Admin can update a forwarded complaint to "In Progress".',
                ]);
            }

            // Reset resolver_id to null when changing status from "Forwarded" to "In Progress"
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
                $request->validate([
                    'attachment' => 'file|mimes:jpg,jpeg,png,pdf|max:2048', // Example validation rules
                ]);

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
        }

        // Save the updated complaint
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
        $users = User::where('id', '!=', auth()->id())->get(['id', 'name']);
        return response()->json([
            'success' => true,
            'users' => $users
        ]);
    }
    public function forwardComplaint(Request $request)
    {
        Log::info('Forwarding complaint:', $request->all());

        // Find the complaint
        $complaint = Complaint::find($request->complaint_id);

        if (!$complaint) {
            return response()->json([
                'success' => false,
                'message' => 'Complaint not found.',
            ]);
        }

        // Validate the request
        $request->validate([
            'resolver_id' => 'required|exists:users,id', // Ensure resolver_id is provided and exists
        ]);

        // Check if the complaint has already been forwarded or is resolved
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

        // Find the new resolver
        $newResolver = User::findOrFail($request->resolver_id);

        // Add to forward history
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
