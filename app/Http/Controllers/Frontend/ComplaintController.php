<?php

namespace App\Http\Controllers\Frontend;

use App\Jobs\SendComplaintRegisteredEmail;
use App\Models\Department;
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
    public function index(){
        $departments = Department::all();
          return view('frontend.home');
    }
    public function register(){
        $departments = Department::all();
        return view('frontend.registration-form',compact('departments'));
    }

    public function statusForm(){
        return view('frontend.complaint-status');
    }
    public function checkStatus(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'complaintInfo' => 'required|string',
        ]);

        // Fetch complaints by complaint number or email
        $complaints = Complaint::where('id', $validatedData['complaintInfo'])
            ->orWhere('email', $validatedData['complaintInfo'])
            ->get();

        // Check if any complaints were found
        if ($complaints->isEmpty()) {
            return response()->json([
                'errors' => ['complaintInfo' => ['No complaints found for the provided information.']],
            ], 404);
        }

        // Return the complaints in JSON format
        return response()->json([
            'status' => 'success',
            'complaints' => $complaints
        ]);
    }


    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => [
                    'required',
                    'email',
                    'regex:/^[a-zA-Z0-9._%+-]+@niu\.edu\.pk$/',
                ],
                'department' => 'required|string',
                'details' => 'required|string'
            ], [
                'email.regex' => 'Only NIU institutional emails (@niu.edu.pk) are allowed.'
            ]);


            // Create complaint and retrieve the created complaint ID
            $complaint = Complaint::create($validatedData);

            // Prepare email details
            $emailDetails = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'department' => $validatedData['department'],
                'details' => $validatedData['details'],
                'complaint_id' => $complaint->id,
            ];

            // Dispatch the job to send an email
            SendComplaintRegisteredEmail::dispatch($emailDetails);

            // Return a JSON response with success message and complaint ID
            return response()->json([
                'success' => 'Complaint registered successfully.',
                'complaint_id' => $complaint->id,
            ]);
        } catch (ValidationException $e) {
            Log::error('Validation error during complaint registration: ', [
                'errors' => $e->validator->errors(),
                'input' => $request->all()
            ]);

            return response()->json([
                'errors' => $e->validator->errors()
            ], 422); // Return validation errors with a 422 status code
        } catch (\Exception $e) {
            Log::error('Error during complaint registration: ', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all()
            ]);

            return response()->json([
                'error' => 'An error occurred while registering the complaint. Please try again.'
            ], 500); // Return generic error message with a 500 status code
        }
    }



    public function sendVerificationCode(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
        ]);
        // Generate a 4-digit verification code
        $verificationCode = rand(1000, 9999);

        // Store the code in the session
        session(['verification_code' => $verificationCode]);

        try {
            Mail::to($request->email)->send(new \App\Mail\SendVerificationCode($verificationCode));
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Email sending failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => 'Failed to send email. Please try again later.']);
        }
    }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'verification_code' => 'required|numeric|digits:4',
        ]);

        // Check if the code matches the one in session
        if ($request->verification_code == session('verification_code')) {
            // Clear the verification code from the session after successful verification
            session()->forget('verification_code');

//            sweetalert()->success('Your password has been reset.');


            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }




}
