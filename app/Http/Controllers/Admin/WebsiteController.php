<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Website;
use App\Models\Client;

class WebsiteController extends Controller
{
    //
    public function index()
    {
        $websites = Website::all();
        return view('admin.website.index', compact('websites'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('admin.website.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'domain_name' => 'required|string|max:255',
            'seo_url' => 'required|string|max:255',
            'description' => 'required|string',
            'client_id' => 'required|exists:clients,id',
            'web_icon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        // if ($request->hasFile('web_icon')) {
        //     $file = $request->file('web_icon');
        //     $filename = time() . '_' . $file->getClientOriginalName();
        //     $file->move(public_path('uploads/web_icons'), $filename);
        //     $data['web_icon'] = $filename;
        // }

        Website::create($data);

        return redirect()->route('admin.website.index')->with('success', 'Website created successfully.');
    }

    public function edit($id)
    {
        $website = Website::findOrFail($id);
        $clients = Client::all();
        return view('admin.website.update', compact('website', 'clients'));
    }

    public function update(Request $request, $id)
    {
        $website = Website::findOrFail($id);

        $data = $request->validate([
            'domain_name' => 'required|string|max:255',
            'seo_url' => 'required|string|max:255',
            'description' => 'required|string',
            'client_id' => 'required|exists:clients,id',
            'web_icon' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
        ]);

        // if ($request->hasFile('web_icon')) {
        //     $file = $request->file('web_icon');
        //     $filename = time() . '_' . $file->getClientOriginalName();
        //     $file->move(public_path('uploads/web_icons'), $filename);
        //     $data['web_icon'] = $filename;
        // }

        $website->update($data);

        return redirect()->route('admin.website.index')->with('success', 'Website updated successfully.');
    }
    
    public function update_status($id)
    {
        $wbsite = Website::findOrFail($id);
        if ($wbsite->status == 1) {
            $wbsite->status = 0;
            $wbsite->save();

            return redirect()->route('admin.website.index')->with('success', 'wbsite Status un-active successfully');
        } else {
            $wbsite->status = 1;
            $wbsite->save();

            return redirect()->route('admin.website.index')->with('success', 'wbsite Status active successfully');
        }
    }

    public function delete($id)
    {
        $website = Website::findOrFail($id);
        $website->delete();

        return redirect()->route('admin.website.index')->with('success', 'Website deleted successfully.');
    }
}
