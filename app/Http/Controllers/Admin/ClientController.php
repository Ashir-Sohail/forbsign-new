<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Models\Client;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\FuncCall;
use Illuminate\Support\Facades\Hash;
use App\Helpers\EmailHelper;

class ClientController extends Controller
{
    //
    public function index()
    {
        $clients = Client::latest()->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        //  Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email',
            'phone' => 'required|string|max:20',
            'city'      => 'required|string|max:100',
            'post_code' => 'required|string|max:10',
            'password' => 'required|string|min:6|confirmed',
        ]);

        //  Create the client
        Client::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'city' => $validated['city'],
            'post_code' => $validated['post_code'],
            'password' => Hash::make($validated['password']),
        ]);

        try {
            EmailHelper::sendDynamicEmail(
                $request->email,
                'Welcome email', // Make sure this matches your EmailTemplate title
                [
                    'userName' => $validated['name'],
                    'userEmail' => $validated['email'],
                    'Password' => $validated['password'],
                    'loginUrl' => route('client.login'),
                    'year' => date('Y'),
                ]
            );
        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Failed to send reset email.']);
        }

        return redirect()->route('admin.client.index')->with('success', 'Client created successfully!');
    }

    public function edit($id)
    {
        $client = Client::findOrfail($id);
        return view('admin.clients.update', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $validated =   $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
            'phone' => 'required|string|max:20',
            'city'      => 'required|string|max:100',
            'post_code' => 'required|string|max:10',
        ]);

        $client = Client::findOrFail($id);

        $client->name  = $validated['name'];
        $client->email = $validated['email'];
        $client->phone = $validated['phone'];
        $client->city = $validated['city'];
        $client->post_code = $validated['post_code'];

        $client->save();

        return redirect()->route('admin.client.index')->with('success', 'Client updated successfully.');
    }


    public function update_status($id): RedirectResponse
    {
        $client = Client::findOrFail($id);
        if ($client->status == 1) {
            $client->status = 0;
            $client->save();

            return redirect()->route('admin.client.index')->with('success', 'Client Status un-active successfully');
        } else {
            $client->status = 1;
            $client->save();

            return redirect()->route('admin.client.index')->with('success', 'Client Status active successfully');
        }
    }

    public function delete($id): RedirectResponse
    {
        $client = Client::findOrFail($id);
        // Delete the client record from DB
        $client->delete();

        return redirect()->route('admin.client.index')->with('success', 'Client Delete successfully');
    }
}
