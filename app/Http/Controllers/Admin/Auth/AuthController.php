<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $user = \App\Models\User::where('email', $request->email)->first();
            if (!$user) {
                return redirect()->back()
                    ->withErrors(['email' => 'The email address is not registered.'])
                    ->withInput();
            }
            if (!Hash::check($request->password, $user->password)) {
                return redirect()->back()
                    ->withErrors(['password' => 'The password you entered is incorrect.'])
                    ->withInput();
            }

            if (Auth::attempt($request->only('email', 'password'))) {
                return redirect()->intended(route('dashboard'))
                    ->with('success', 'Login successful');
            }

            return redirect()->back()
                ->withErrors(['email' => 'Invalid credentials'])
                ->withInput();

        } catch (ValidationException $e) {
            return redirect()->route('login-screen')
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            // Handle any unexpected exceptions
            return redirect()->route('login-screen')
                ->with('error', 'An error occurred during login. Please try again.');
        }
    }


    public function logout(Request $request)
    {
        try {
            $request->session()->flush();
            Auth::logout();
            $request->session()->regenerate();
            return redirect('/login')->with('status', 'Successfully logged out.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['logout_error' => 'Failed to log out. Please try again.']);
        }
    }

}
