<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\Website;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ManageController extends Controller
{
    public function index(): View
    {
        $client = auth()->guard('client')->user();
        $orders = Order::with('transactions')->where('website_id', $client->website->id)->get();
        return view('client.order.all-order', compact('orders'));
    }

    public function invoice($id)
    {
        $client = auth()->guard('client')->user();
        $order = Order::with(['orderItems', 'user', 'transactions', 'billingAddress'])->where('website_id', $client->website->id)->findOrFail($id);
        return view('client.order.invoice', compact('order'));
    }

    public function pending_order(): View
    {
        $client = auth()->guard('client')->user();
        $orders = Order::whereOrderStatus('pending')->where('website_id', $client->website->id)->get();
        return view('client.order.pending-order', compact('orders'));
    }
    public function prcossing_order(): View
    {
        $client = auth()->guard('client')->user();
        $orders = Order::whereOrderStatus('processing')->where('website_id', $client->website->id)->get();
        return view('client.order.pending-order', compact('orders'));
    }

    public function progress_order(): View
    {
        $client = auth()->guard('client')->user();
        $orders = Order::with('transactions')->whereOrderStatus('progress')->where('website_id', $client->website->id)->get();
        return view('client.order.progress-order', compact('orders'));
    }

    public function delivered_order(): View
    {
        $client = auth()->guard('client')->user();
        $orders = Order::with('transactions')->whereOrderStatus('delivered')->where('website_id', $client->website->id)->get();
        return view('client.order.delivered-order', compact('orders'));
    }

    public function canceled_order(): View
    {
        $client = auth()->guard('client')->user();
        $orders = Order::with('transactions')->whereOrderStatus('canceled')->where('website_id', $client->website->id)->get();
        return view('client.order.canceled-order', compact('orders'));
    }

    public function change_payment_status($id)
    {
        // Find the transaction using the numeric order ID
        $transaction = Transaction::where('order_id', $id)->firstOrFail();

        if ($transaction->payment_status === 'unpaid') {
            $transaction->payment_status = 'paid';
            $message = 'Payment status updated to Paid.';
        } else {
            $transaction->payment_status = 'unpaid';
            $message = 'Payment status updated to Unpaid.';
        }

        $transaction->save();

        return redirect()->back()->with('success', $message);
    }


    public function pending_status($id)
    {
        $client = auth()->guard('client')->user();
        $order = Order::where('website_id', $client->website->id)->findOrFail($id);
        $order->order_status = 'pending';
        $order->save();
        return redirect()->back()->with('success', 'Status is in pending');
    }

    public function process_status($id)
    {
        $client = auth()->guard('client')->user();
        $order = Order::where('website_id', $client->website->id)->findOrFail($id);
        $order->order_status = 'processing';
        $order->save();
        return redirect()->back()->with('success', 'Status is in processing');
    }

    public function progress_status($id)
    {
        $client = auth()->guard('client')->user();
        $order = Order::where('website_id', $client->website->id)->findOrFail($id);
        $order->order_status = 'progress';
        $order->save();
        return redirect()->back()->with('success', 'Status is in progress');
    }

    public function delivered_status($id)
    {
        $client = auth()->guard('client')->user();
        $order = Order::where('website_id', $client->website->id)->findOrFail($id);
        $order->order_status = 'delivered';
        $order->save();
        return redirect()->back()->with('success', 'Status is in delivered');
    }
    public function canceled_status($id)
    {
        $client = auth()->guard('client')->user();
        $order = Order::where('website_id', $client->website->id)->findOrFail($id);
        $order->order_status = 'canceled';
        $order->save();
        return redirect()->back()->with('success', 'Status is in canceled');
    }

    public function transactions()
    {
        $client = auth()->guard('client')->user();
        $transactions = Transaction::with(['order', 'user'])->where('website_id', $client->website->id)->get();
        return view('client.transactions', compact('transactions'));
    }

    public function transactions_delete($id)
    {
        $client = auth()->guard('client')->user();

        Transaction::where('website_id', $client->website->id)
            ->findOrFail($id)
            ->delete();

        return redirect()->route('client.transactions')->with('success', 'Transaction delete successfully');
    }
}
