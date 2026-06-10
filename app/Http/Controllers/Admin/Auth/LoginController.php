<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class LoginController extends Controller
{
    function index(): View
    {
        return view('admin.auth.login');
    }

    function login(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => [
                'required',
                'min:8',
            ],
        ], [
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'The email address is not registered.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'password.regex' => 'The password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ]);
        $admin = Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password]);
        if ($admin) {
            return redirect()->route('admin.dashboard')->with('success', 'Login successfully');
        } else {
            return redirect()->back()->with('error', 'Invalid username and password');
        }
    }

    function profile_view()
    {
        return view('admin.auth.update-profile');
    }

    function update_profile(Request $request)
    {

        $request->validate([
            'username' => 'required|alpha',
            'email' => 'required|email',
            'phone' => [
                'required',
                'regex:/^\+?[1-9]\d{1,14}$/',  // E.164 international phone number format
                'unique:users,phone',
            ],

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'The phone number field is required.',
            'phone.unique' => 'The phone number is already in use.',
        ]);
        $admin = Admin::findOrFail(Auth::guard('admin')->user()->id);

        if ($request->existing_password) {
            $request->validate([
                'password' => 'required|confirmed'
            ]);

            // check if existing password is correct
            if (!Hash::check($request->existing_password, $admin->password)) {
                return redirect()->back()->with('error', 'Existing password is incorrect');
            }
        }

        $filename = '';
        if ($request->file('image')) {
            // Optionally delete the old image from S3
            if ($admin->image && Storage::disk('s3')->exists($admin->image)) {
                Storage::disk('s3')->delete($admin->image);
            }

            // Upload new image to S3
            $filename = $request->file('image')->store('admin', 's3');
            // Set visibility to public
            Storage::disk('s3')->setVisibility($filename, 'public');
        } else {
            // If no new image is uploaded, retain the existing image path
            $filename = $admin->image;
        }
        $admin->username = $request->username;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->image = $filename;

        if ($request->existing_password) {
            $admin->password = Hash::make($request->password) ?? $admin->password;
        }

        $admin->save();
        return redirect()->back()->with('success', 'Profile update successfully');
    }

    function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.auth.login')->with('success', 'Logout successfully');
    }
}
