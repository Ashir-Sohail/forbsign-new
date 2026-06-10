<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscribe;

class SubscribeController extends Controller
{
    public function index()
    {
        $subscribers = Subscribe::latest()->get();
        return view('admin.subscriber.index', compact('subscribers'));
    }

    public function destroy($id)
    {
        Subscribe::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Subscriber deleted');
    }
}
