<?php

namespace App\Http\Controllers\Admin;

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

        $complaints = Complaint::all();
        return view('admin.complaints.index', compact('complaints'));
    }
    public function show(Complaint $complaint)
    {
        return view('admin.complaints.view', compact('complaint'));
    }


}
