<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    //
    public function index()
    {
        $emails = EmailTemplate::latest()->get();
        return view('admin.email-template.index', compact('emails'));
    }

    public function create()
    {
        return view('admin.email-template.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:email_templates,title',
            'body' => 'required',
        ]);

        EmailTemplate::create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        return redirect()->route('admin.email.index')->with('success', 'Template create successfully.');
    }

    public function edit($id)
    {
        $email = EmailTemplate::findOrfail($id);
        return view('admin.email-template.update', compact('email'));
    }

    public function update(Request $request, $id)
    {
        $validated =  $request->validate([
            'title' => 'required|unique:email_templates,title,' . $id,
            'body' => 'required',
        ]);

        $email = EmailTemplate::findOrFail($id);

        $email->title  = $validated['title'];
        $email->body = $validated['body'];
        $email->save();
        return redirect()->route('admin.email.index')->with('success', 'Email Updated Successfully');
    }

    public function delete($id)
    {
        $email = EmailTemplate::findOrfail($id);
        $email->delete();
        return redirect()->route('admin.email.index')->with('success', 'Email Delete Successfully');
    }
}
