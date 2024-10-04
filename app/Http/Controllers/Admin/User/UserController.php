<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Jobs\SendUserEditedEmail;
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
        $authUserRole = auth()->user()->role->name; // Adjust based on your role relationship
        $authUserId = auth()->user()->id;

        $usersQuery = User::with('role', 'departments');

        if (in_array($authUserRole, ['Super Admin', 'Admin'])) {
            $usersQuery->where('role_id', '!=', 1);
        } else {
            $usersQuery->where('id', $authUserId);
        }
        $users = $usersQuery->get();

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
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role_id' => 'required',
            'department_id' => 'required|array',
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
                'password' => isset($validatedData['password']) ? $validatedData['password'] : $user->password,
            ]);

            $user->departments()->sync($validatedData['department_id']);
            $details = [
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => $request->filled('password') ? $request->input('password') : null
            ];

            SendUserEditedEmail::dispatch($details);


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
