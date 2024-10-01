<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Flasher\SweetAlert\Prime\SweetAlertInterface;
use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class DashboardController extends Controller
{
    public function index()
    {

        $departments = Department::count();
        $totalComplaints = Complaint::count();
        $inProcessComplaints = Complaint::where('status', 'In Process')->count();
        $resolvedComplaints = Complaint::where('status', 'Resolved')->count();
        $forwardedComplaints = Complaint::where('status', 'Forwarded')->count();

        return view('admin.dashboard', compact(
            'departments',
            'totalComplaints', 'inProcessComplaints', 'resolvedComplaints', 'forwardedComplaints'
        ));
    }



}
