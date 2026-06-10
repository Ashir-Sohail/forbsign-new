@extends('layouts.app')
@section('title')
    Track Order
@endsection
@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp

    <div class="container my-5">
        <div class="card shadow rounded-3">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">Order Status</h4>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                        <p><strong>Order Date:</strong> {{ $order->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Order Status:</strong> {{ ucfirst($order->order_status) }}</p>
                        <p><strong>Payment Status:</strong>
                            {{ ucfirst($order->transactions->first()->payment_status ?? 'N/A') }}
                        </p>
                        <p><strong>Total:</strong> {{ config('app.currency.symbol') . number_format($order->total, 2) }}</p>
                    </div>
                </div>

                <h5 class="mb-3">Products</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->product->name ?? 'N/A' }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ config('app.currency.symbol') . number_format($item->price, 2) }}</td>
                                    <td>{{ config('app.currency.symbol') . number_format($item->price * $item->quantity, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="text-end mt-3">
                    <h5>Total: <strong>{{ config('app.currency.symbol') . number_format($order->total, 2) }}</strong></h5>
                </div>
            </div>
        </div>
    </div>



    <div id="qualityhelpinstall" class="store_footer_top">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="qhi col-md-4">
                    <img src="./assets/imgs/QualityMaterial.svg" alt="" loading="lazy">
                    <h6>Quality Material</h6>
                    <p>
                        The best materials make for the best job. It’s that simple. Every sign is 100% weatherproof
                        &amp;
                        resistant so they’re as durable as they are brilliantly designed.
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="./assets/imgs/Help&amp;Support.svg" alt="Help and Support" loading="lazy">
                    <h6>Help and Support</h6>
                    <p>
                        We’re all about happy customers. If you need help purchasing your sign please contact us during
                        office hours on 01795 505850, or why not try our&nbsp;live chat.
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="./assets/imgs/Quick&amp;Install.svg" alt="Quick &amp; easy to install" loading="lazy">
                    <h6>Quick &amp; easy to install</h6>
                    <p>
                        The best materials make for the best job. It’s that simple. Every sign is 100% weatherproof
                        &amp;
                        resistant so they’re as durable as they are brilliantly designed.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
