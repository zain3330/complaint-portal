<?php

namespace App\Http\Controllers\Admin\Department;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        // Or use logging
        Log::info('departments retrieved:', ['departments' => $departments]);

        return view('admin.department.index', compact('departments'));

    }

    public function create()
    {
        return view('admin.department.create');
    }


    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|unique:departments,name|max:255',
            ]);
            Department::create($validatedData);

            return redirect()->route('dashboard')->with('success', 'Login Successfully.');
        } catch (ValidationException $e) {
            return redirect()->route('department.create')
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->route('department.create')->with('error', 'An error occurred while creating the department. Please try again.');
        }
    }





    public function edit(Department $department)
    {
        return view('admin.department.edit', compact('department'));
    }


    public function update(Request $request, Department $department)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|unique:departments,name,' . $department->id . '|max:255',
            ]);
            $department->update($validatedData);
            return redirect()->route('department.index')->with('success', 'Department Updated Successfully.');
        } catch (ValidationException $e) {
            return redirect()->route('department.edit', $department->id)
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->route('department.edit', $department->id)->with('error', 'An error occurred while updating the department. Please try again.');
        }
    }


    public function destroy(Department $department)
    {
        $department->delete();

        return redirect()->route('department.index')->with('success', 'Department Deleted Successfully.');
    }

}
