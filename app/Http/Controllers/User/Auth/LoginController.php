<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\ManageSite;

class LoginController extends Controller
{
    function index(): View
    {
        return view('user.auth.login');
    }


    function login(Request $request): RedirectResponse
    {
        // dd($request->all());
        $request->validate([
            'email_login' => 'required|email|exists:users,email',
            'password_login' => [
                'required',
                'min:8',
            ],
        ], [
            'email_login.email' => 'Please enter a valid email address.',
            'email_login.exists' => 'The email address is not registered.',
            'password_login.required' => 'The password field is required.',
            'password_login.min' => 'The password must be at least 8 characters long.',
        ]);
        $user = Auth::attempt(['email' => $request->email_login, 'password' => $request->password_login]);
        if ($user) {
            return redirect()->route('user.dashboard')->with('success', 'Login successfully');
        } else {
            return redirect()->route('user.register')->with('error', 'Invalid email and password');
        }
    }


    public function showForgotPasswordForm(): View
    {
        $media_setting = ManageSite::where('key', 'media')->first();
        return view('user.auth.forgot-password', compact('media_setting'));
    }

    public function submitForgotPasswordForm(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Logic to send the password reset link goes here
        $token = Str::random(60);
        // dd($token);
        DB::table('password_reset_tokens')->where(
            'email',
            $request->email
        )->delete();
        // dd('delete the old token');

        DB::table('password_reset_tokens')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send('user.auth.forgot-email', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Password Reset Link');
        });


        return redirect()->route('user.login')->with('success', 'Password reset link sent to your email address.');
    }

    public function showResetPasswordForm($token): View
    {
        $media_setting = ManageSite::where('key', 'media')->first();
        return view('user.auth.reset-password', ['token' => $token, 'media_setting' => $media_setting]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'token' => 'required',
        ], [
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'The email address is not registered.',
            'password.required' => 'The password field is required.',
            'password.min' => 'The password must be at least 8 characters long.',
            'token.required' => 'The token field is required.',
        ]);

        $updatePassword = DB::table('password_reset_tokens')->where([
            ['email', $request->email],
            ['token', $request->token],
        ])->first();
        // dd($updatePassword);

        if (!$updatePassword) {
            return redirect()->route('user.login')->with('error', 'Invalid token or email address.');
        }

        $user = User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();


        return redirect()->route('user.login')->with('success', 'Password reset successfully.');
    }
}
