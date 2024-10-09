<?php

namespace App\Http\Controllers\Admin\Role;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all()->where('name','!=','Super Admin');
        // Or use logging
        Log::info('Roles retrieved:', ['roles' => $roles]);

        return view('admin.role.index', compact('roles'));

    }

    public function create()
    {
        return view('admin.role.create');
    }


    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|unique:roles,name|max:255',
            ]);
            Role::create($validatedData);

            return redirect()->route('role.index')->with('success', 'Role Created Successfully.');
        } catch (ValidationException $e) {
            return redirect()->route('role.create')
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->route('role.create')->with('error', 'An error occurred while creating the role. Please try again.');
        }
    }





    public function edit(Role $role)
    {
        return view('admin.role.edit', compact('role'));
    }


    public function update(Request $request, Role $role)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|unique:roles,name,' . $role->id . '|max:255',
            ]);
            $role->update($validatedData);
            return redirect()->route('role.index')->with('success', 'Role Updated Successfully.');
        } catch (ValidationException $e) {
            return redirect()->route('role.edit', $role->id)
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->route('role.edit', $role->id)->with('error', 'An error occurred while updating the role. Please try again.');
        }
    }


    public function destroy(Role $role)
    {
        if ($role->users()->count() > 0) {
            return redirect()->route('role.index')->with('error', 'Role cannot be deleted as it is assigned to one or more users.');
        }

        $role->delete();

        return redirect()->route('role.index')->with('success', 'Role Deleted Successfully.');
    }

}
