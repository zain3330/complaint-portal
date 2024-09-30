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
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
        $complaints = Complaint::all();
        return view('admin.complaints.index', compact('complaints','users'));
    }
    public function show(Complaint $complaint)
    {
        return view('admin.complaints.view', compact('complaint'));
    }

    public function updateStatus(Request $request)
    {
        $complaint = Complaint::find($request->complaint_id);

        // Check if the complaint is already resolved
        if ($complaint->status == 'Resolved') {
            $resolver = $complaint->resolver ? $complaint->resolver->name : 'Unknown';

            return response()->json([
                'success' => false,
                'message' => 'This complaint has already been resolved by ' . $resolver,
            ]);
        }

        // Check if the complaint is already forwarded and trying to forward again
        if ($complaint->status == 'Forwarded' && $request->status == 'Forwarded') {
            return response()->json([
                'success' => false,
                'message' => 'This complaint is already in the queue of user ID: ' . $complaint->resolved_id,
            ]);
        }

        // Check if the complaint is already in progress
        if ($complaint->status == 'In Progress' && $request->status == 'In Progress') {
            return response()->json([
                'success' => false,
                'message' => 'This complaint is already in progress.',
            ]);
        }

        // Update the status and set resolved_by if resolved
        $complaint->status = $request->status;

        if ($request->status == 'Resolved') {
            $complaint->resolved_by = auth()->id();  // Set the resolver ID to the current authenticated user
        }

        $complaint->save();

        return response()->json([
            'success' => true,
            'complaint_id' => $complaint->id,
            'status' => $complaint->status,
            'message' => 'Complaint status updated successfully.'
        ]);
    }


    public function filterComplaints(Request $request)
    {
        $status = $request->get('status');

        // Fetch complaints based on status
        if ($status) {
            $complaints = Complaint::where('status', $status)->get();
        } else {
            $complaints = Complaint::all();
        }
        return view('admin.complaints.index', compact('complaints'));
    }


}
