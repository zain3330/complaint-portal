<?php

namespace App\Http\Controllers\Frontend;

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
          return view('frontend.complaint-registration');
    }

    public function store(Request $request)
    {
        // dd(123);
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'department' => 'required|string',
                'complaint_type' => 'required|string',
                'details' => 'required|string'
            ]);

            Complaint::create($validatedData);

            return redirect()->route('complaint.index')->with('success', 'Complaint registered successfully.');
        } catch (ValidationException $e) {
            Log::error('Validation error during complaint registration: ', [
                'errors' => $e->validator->errors(),
                'input' => $request->all()
            ]);

            return redirect()->route('complaint.index')
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Error during complaint registration: ', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all()
            ]);

            return redirect()->route('complaint.index')->with('error', 'An error occurred while registering the complaint. Please try again.');
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

        // Send the email
        try {
            Mail::to($request->email)->send(new \App\Mail\SendVerificationCode($verificationCode));
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
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
