<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WebsiteTemplate;
use App\Models\Website;

class WebsiteTemplateController extends Controller
{
    //
    public function index()
    {
        $templates = WebsiteTemplate::all();
        return view('admin.website_template.index', compact('templates'));
    }

    public function create()
    {
        $websites = Website::get();
        return view('admin.website_template.create', compact('websites'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'domain' => 'required|string',
            'name' => 'required|string',
            'website_id' => 'required|exists:websitetemplates,id',
        ]);

        WebsiteTemplate::create($data);

        return redirect()->route('admin.website-template.index')->with('success', 'Website Template created successfully.');
    }

    public function edit($id)
    {
        $template = WebsiteTemplate::findOrFail($id);
        $websites = Website::get();
        return view('admin.website_template.update', compact('template', 'websites'));
    }

    public function update(Request $request, $id)
    {
        $template = WebsiteTemplate::findOrFail($id);

        $data = $request->validate([
            'domain' => 'required|string',
            'name' => 'required|string',
            'website_id' => 'required|exists:websitetemplates,id',
        ]);

        $template->update($data);

        return redirect()->route('admin.website-template.index')->with('success', 'Website Template updated successfully.');
    }

    public function update_status($id)
    {
        $wbsitetemplate = WebsiteTemplate::findOrFail($id);
        if ($wbsitetemplate->status == 1) {
            $wbsitetemplate->status = 0;
            $wbsitetemplate->save();

            return redirect()->route('admin.website-template.index')->with('success', 'website-template Status un-active successfully');
        } else {
            $wbsitetemplate->status = 1;
            $wbsitetemplate->save();

            return redirect()->route('admin.website-template.index')->with('success', 'website-template Status active successfully');
        }
    }

    public function delete($id)
    {
        $template = WebsiteTemplate::findOrFail($id);
        $template->delete();

        return redirect()->route('admin.website-template.index')->with('success', 'Website Template deleted successfully.');
    }
}
