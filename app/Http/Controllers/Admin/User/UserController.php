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
        $users = User::with('role','department')->where('role_id','!=',1)->where('id','!=',auth()->user()->id)->get();
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
            'department_id' => 'required',
            'department_id.*' => 'exists:departments,id',
            'role_id' => 'required',
        ]);

        try {
            $validatedData['password'] = Hash::make($validatedData['password']);
            $user = User::create($validatedData);

            $details = [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $request->password,
                'department_ids' => $validatedData['department_id'],
            ];

            Mail::to($user->email)->send(new CreateUserMail($details));
            return redirect()->route('users.index')->with('success', 'User Created Successfully.');
        } catch (ValidationException $e) { Log::error('Validation error while creating user: ', ['errors' => $e->validator->errors()]);
        } catch (\Exception $e) {
            Log::error('Error while creating user: ', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);
        }
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'required|min:6',
            'role_id' => 'required',
            'department_id'=>'required'
        ]);

        try {
            if ($request->filled('password')) {
                $validatedData['password'] = Hash::make($validatedData['password']);
            } else {
                unset($validatedData['password']);
            }
            $user->update($validatedData);
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
