<?php

namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Helpers\EmailHelper;

class ClientController extends Controller
{
    //

    // client login page
    function index()
    {
        return view('client.auth.client_login');
    }
    // client after login
    function login(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email_login' => 'required|email|exists:clients,email',
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
        $user = Auth::guard('client')->attempt(['email' => $request->email_login, 'password' => $request->password_login, 'status' => 1]);
        if ($user) {
            return redirect()->route('client.dashboard')->with('success', 'Login successfully');
        } else {
            dd('not login');
        }
    }

    public function profile_view()
    {
        return view('client.auth.update-profile');
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
            'city' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'email.email' => 'Please enter a valid email address.',
            'phone.required' => 'The phone number field is required.',
            'phone.unique' => 'The phone number is already in use.',
        ]);
        $client = Client::findOrFail(Auth::guard('client')->user()->id);

        if ($request->existing_password) {
            $request->validate([
                'password' => 'nullable|confirmed'
            ]);

            // check if existing password is correct
            if (!Hash::check($request->existing_password, $client->password)) {
                return redirect()->back()->with('error', 'Existing password is incorrect');
            }
        }

        // $filename = '';
        // if ($request->file('image')) {
        //     // Optionally delete the old image from S3
        //     if ($client->image && Storage::disk('s3')->exists($client->image)) {
        //         Storage::disk('s3')->delete($client->image);
        //     }

        //     // Upload new image to S3
        //     $filename = $request->file('image')->store('admin', 's3');
        //     // Set visibility to public
        //     Storage::disk('s3')->setVisibility($filename, 'public');
        // } else {
        //     // If no new image is uploaded, retain the existing image path
        //     $filename = $client->image;
        // }
        $client->name = $request->username;
        $client->email = $request->email;
        $client->phone = $request->phone;
        $client->city = $request->city;
        // $client->image = $filename;

        if ($request->existing_password) {
            $client->password = Hash::make($request->password) ?? $client->password;
        }

        $client->save();
        return redirect()->back()->with('success', 'Profile update successfully');
    }

    public function showForgotPasswordForm()
    {
        return view('client.auth.forgot-password');
    }


    public function submitForgotPasswordForm(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|exists:clients,email',
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

        // Mail::send('client.auth.forgot-email', ['token' => $token], function ($message) use ($request) {
        //     $message->to($request->email);
        //     $message->subject('Password Reset Link');
        // });

        try {
            EmailHelper::sendDynamicEmail(
                $request->email,
                'Forgot password', // Make sure this matches your EmailTemplate title
                [
                    'token' => $token,
                    'reset_link' => route('showresetpassword', ['token' => $token]), // Or route() if named
                    'year' => date('Y'),
                ]
            );
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send reset email.']);
        }


        return redirect()->route('client.login')->with('success', 'Password reset link sent to your email address.');
    }


    public function showResetPasswordForm($token)
    {
        return view('client.auth.reset-password', ['token' => $token]);
    }


    public function submitResetPasswordForm(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email|exists:clients,email',
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
            return redirect()->route('client.login')->with('error', 'Invalid token or email address.');
        }

        $user = Client::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();


        return redirect()->route('client.login')->with('success', 'Password reset successfully.');
    }

    public function logout()
    {
        Auth::guard('client')->logout();
        return redirect()->route('client.login')->with('success', 'Logged out successfully');
    }
}
