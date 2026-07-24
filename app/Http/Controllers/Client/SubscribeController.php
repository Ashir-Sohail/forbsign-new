<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;

class SubscribeController extends Controller
{
    public function index()
    {
        $subscribers = Subscribe::latest()->get();
        return view('client.subscriber.index', compact('subscribers'));
    }

    public function destroy($id)
    {
        Subscribe::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Subscriber deleted');
    }
}
