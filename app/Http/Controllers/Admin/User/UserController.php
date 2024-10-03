<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Mail\CreateUserMail;
use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        // Eager load 'role' and 'departments'
        $users = User::with('role', 'departments')
            ->where('role_id', '!=', 1) // Exclude role_id 1
            ->where('id', '=', auth()->user()->id) // Exclude current user
            ->get();

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::where('name','!=','Super Admin')->get();
        $departments = Department::all();
        return view('admin.user.create',compact('roles','departments'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'department_id' => 'required|array', // Allows multiple department IDs
            'role_id' => 'required',
        ]);

        try {
            // Hash the password
            $validatedData['password'] = Hash::make($validatedData['password']);

            // Create user without 'department_id', as it is handled in pivot table
            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
                'role_id' => $validatedData['role_id'],
            ]);

            // Sync multiple departments to the pivot table
            $user->departments()->sync($validatedData['department_id']);

            // Prepare details for the email
            $details = [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $request->password,
                'department_ids' => $validatedData['department_id'],
            ];

            // Send email
            Mail::to($user->email)->send(new CreateUserMail($details));

            // Redirect back with success message
            return redirect()->route('users.index')->with('success', 'User Created Successfully.');
        } catch (ValidationException $e) {
            // Handle validation errors
            Log::error('Validation error while creating user: ', ['errors' => $e->validator->errors()]);
            return redirect()->back()->withErrors($e->validator->errors())->withInput();
        } catch (\Exception $e) {
            // Handle other errors
            Log::error('Error while creating user: ', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'An error occurred while creating the user. Please try again.')->withInput();
        }
    }



    public function update(Request $request, User $user)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, // Ensures unique email except for the current user
            'password' => 'nullable|min:6', // Password is not required on update
            'role_id' => 'required',
            'department_id' => 'required|array', // Department ID should be an array
        ]);
        try {

            if ($request->filled('password')) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            } else {

                unset($validatedData['password']);
            }
            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'role_id' => $validatedData['role_id'],
                // Only update the password if it's provided
                'password' => isset($validatedData['password']) ? $validatedData['password'] : $user->password,
            ]);

            $user->departments()->sync($validatedData['department_id']);

            return redirect()->route('users.index')->with('success', 'User Updated Successfully.');
        } catch (ValidationException $e) {

            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {

            Log::error('Error updating user: ' . $e->getMessage());
            return redirect()->route('users.edit', $user->id)->with('error', 'An error occurred while updating the user. Please try again.');
        }
    }



    public function edit(User $user)
    {
        $roles = Role::where('name','!=','Super Admin')->get();
        $departments =Department::all();
        return view('admin.user.edit', compact('user','roles','departments'));
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User Deleted Successfully.');
    }
}
