<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Contracts\View\View;

class ManageController extends Controller
{
    public function index(): View
    {
        $orders = Order::with('transactions')->latest()->get();
        return view('client.order.all-order', compact('orders'));
    }

    public function invoice($id)
    {
        $order = Order::with(['orderItems', 'user', 'transactions', 'billingAddress'])->findOrFail($id);
        return view('client.order.invoice', compact('order'));
    }

    public function pending_order(): View
    {
        $orders = Order::whereOrderStatus('pending')->latest()->get();
        return view('client.order.pending-order', compact('orders'));
    }

    public function prcossing_order(): View
    {
        $orders = Order::whereOrderStatus('processing')->latest()->get();
        return view('client.order.pending-order', compact('orders'));
    }

    public function progress_order(): View
    {
        $orders = Order::with('transactions')->whereOrderStatus('progress')->latest()->get();
        return view('client.order.progress-order', compact('orders'));
    }

    public function delivered_order(): View
    {
        $orders = Order::with('transactions')->whereOrderStatus('delivered')->latest()->get();
        return view('client.order.delivered-order', compact('orders'));
    }

    public function canceled_order(): View
    {
        $orders = Order::with('transactions')->whereOrderStatus('canceled')->latest()->get();
        return view('client.order.canceled-order', compact('orders'));
    }

    public function change_payment_status($id)
    {
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
        $order = Order::findOrFail($id);
        $order->order_status = 'pending';
        $order->save();
        return redirect()->back()->with('success', 'Status is in pending');
    }

    public function process_status($id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = 'processing';
        $order->save();
        return redirect()->back()->with('success', 'Status is in processing');
    }

    public function progress_status($id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = 'progress';
        $order->save();
        return redirect()->back()->with('success', 'Status is in progress');
    }

    public function delivered_status($id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = 'delivered';
        $order->save();
        return redirect()->back()->with('success', 'Status is in delivered');
    }

    public function canceled_status($id)
    {
        $order = Order::findOrFail($id);
        $order->order_status = 'canceled';
        $order->save();
        return redirect()->back()->with('success', 'Status is in canceled');
    }

    public function transactions()
    {
        $transactions = Transaction::with(['order', 'user'])->latest()->get();
        return view('client.transactions', compact('transactions'));
    }

    public function transactions_delete($id)
    {
        Transaction::findOrFail($id)->delete();

        return redirect()->route('client.transactions')->with('success', 'Transaction delete successfully');
    }
}
