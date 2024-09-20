<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ComplaintController extends Controller
{
    public function index(){
          return view('frontend.complaint-registration');
    }

    public function store(Request $request)
    {
        dd(123);
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'department' => 'required|string',
                'complaint_type' => 'required|string',
                'details' => 'required|string'
            ]);

            Complaint::create($validatedData);

            return redirect()->view('frontend.complaint-registration ')->with('success', 'Complaint Registration  Successfully.');
        } catch (ValidationException $e) {
            return redirect()->route('locations.create')
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->view('frontend.complaint-registration ')->with('error', 'An error occurred while creating the location. Please try again.');
        }
    }
}
