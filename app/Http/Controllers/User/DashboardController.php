<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BillingAddress;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Helpers\FileUploadHelper;

class DashboardController extends Controller
{
    public function index()
    {
        $pending_orders = Order::whereUserIdAndOrderStatus(auth()->id(), 'pending')->count();
        $progress_orders = Order::whereUserIdAndOrderStatus(auth()->id(), 'progress')->count();
        $delivered_orders = Order::whereUserIdAndOrderStatus(auth()->id(), 'delivered')->count();
        $canceled_orders = Order::whereUserIdAndOrderStatus(auth()->id(), 'canceled')->count();
        $all_orders = Order::whereUserId(auth()->id())->count();
        return view('user.auth.dashboard', compact(
            'pending_orders',
            'progress_orders',
            'all_orders',
            'canceled_orders',
            'delivered_orders'
        ));
    }

    public function show_profile()
    {
        return view('user.auth.profile');
    }

    public function update_profile(Request $request)
    {
        $validate = $request->validate([
            'phone' => ['nullable', 'regex:/^\+?[0-9\s\-]{10,20}$/'],
        ]);


        $user = User::findOrFail(auth()->id());

        if ($request->hasFile('photo')) {
            FileUploadHelper::delete($user->photo);

            $user->photo = FileUploadHelper::upload(
                $request->file('photo'),
                "users/{$user->id}"
            );
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        // $user->photo = $filename;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('user.dashboard.profile')->with('success', 'User update successfully');
    }




    public function show_address()
    {
        $address = BillingAddress::whereUserId(auth()->id())->first();
        return view('user.auth.address', compact('address'));
    }

    public function update_address(Request $request)
    {
        $request->validate([
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'zip_code' => 'required|string|max:10',
            'city' => 'required|string|max:255',
        ]);


        $address = BillingAddress::firstOrNew(['user_id' => auth()->id()]);
        $address->user_id = auth()->id(); // set user_id if creating new
        $address->address1 = $request->address1;
        $address->address2 = $request->address2;
        $address->zip_code = $request->zip_code;
        $address->city = $request->city;
        $address->company = $request->company;
        $address->contact = $request->contact;
        // $address->check_input = $request->check_input;
        $address->save();
        return redirect()->route('user.dashboard.address')->with('success', 'Billing address successfully');
    }


    public function  logout()
    {
        session()->forget('cart');
        Auth::logout();
        return redirect()->route('user.login');
    }

    public function deleteAccount()
    {
        $user = User::findOrFail(auth()->id());

        if ($user->photo) {
            FileUploadHelper::delete($user->photo);
        }

        $user->delete();

        session()->forget('cart');
        Auth::logout();

        return redirect()->route('user.login')->with('success', 'Your account has been deleted successfully.');
    }
}
