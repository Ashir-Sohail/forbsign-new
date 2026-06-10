<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\BillingAddress;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class RegisterController extends Controller
{
    function index(): View
    {
        return view('user.auth.register');
    }

    function create(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => 'required|alpha',
            'last_name' => 'required|alpha',
            'email' => 'required|email|unique:users',

            'password' => [
                'required',
                'min:8',
            ],
        ], [
            'first_name.required' => 'The first name field is required.',
            'first_name.alpha' => 'The first name should contain only letters.',
            'last_name.required' => 'The last name field is required.',
            'last_name.alpha' => 'The last name should contain only letters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'The email address is already in use.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters long.',
        ]);

        $user = new User();
        $user->name = $request->first_name . ' ' . $request->last_name;
        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->photo = "null";
        $user->password = Hash::make($request->password);
        $user->save();


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Redirect back to original page (e.g., checkout) or fallback to home
            $redirectUrl = $request->input('redirect_to', route('user.home'));

            return redirect()->to($redirectUrl)->with('success', 'Registration and login successful');
        }
        return redirect()->route('user.login')->withErrors([
            'login' => 'Registration succeeded, but login failed. Please login manually.',
        ]);
    }
}
