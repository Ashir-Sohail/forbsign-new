@extends('layouts.app')
@section('title')
    Order
@endsection
@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li><a href="/">Home</a> </li>
                        <li class="separator"></li>
                        <li>Orders</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container padding-bottom-3x mb-1">
        <div class="row">
            @include('includes.user-sidebar')
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        @if ($orders->isEmpty())
                            <div class="empty-order text-center py-5">
                                <svg class="empty-order-svg mb-4" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg" style="max-width: 100%; height: auto; width: 100%; max-width: 300px;">
                                    <!-- Background circle -->
                                    <circle cx="200" cy="150" r="120" fill="#f8f9fa" stroke="#dee2e6" stroke-width="2"/>

                                    <!-- Box body -->
                                    <path d="M130 130 L200 155 L270 130 L270 210 C270 214, 267 217, 263 218 L204 238 C201 239, 199 239, 196 238 L137 218 C133 217, 130 214, 130 210 Z"
                                          fill="none" stroke="#41416E" stroke-width="3" stroke-linejoin="round"/>

                                    <!-- Box top flaps -->
                                    <path d="M130 130 L200 108 L270 130 L200 155 Z"
                                          fill="#41416E" opacity="0.15" stroke="#41416E" stroke-width="3" stroke-linejoin="round"/>

                                    <!-- Vertical seam -->
                                    <line x1="200" y1="155" x2="200" y2="238" stroke="#41416E" stroke-width="2" opacity="0.6"/>

                                    <!-- Decorative elements -->
                                    <circle cx="120" cy="90" r="5" fill="#41416E" opacity="0.4"/>
                                    <circle cx="285" cy="95" r="5" fill="#41416E" opacity="0.4"/>
                                    <circle cx="100" cy="170" r="4" fill="#41416E" opacity="0.3"/>
                                    <circle cx="300" cy="170" r="4" fill="#41416E" opacity="0.3"/>
                                </svg>
                                <h3 class="text-muted mb-3">No orders yet</h3>
                                <p class="text-muted mb-4">Looks like you haven't placed any orders yet.</p>
                                <a href="{{ route('user.store') }}" class="btn primary_btn">Continue Shopping</a>
                            </div>
                        @else
                            <div class="u-table-res">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Order ID#</th>
                                            <th>Total</th>
                                            <th>Order Status</th>
                                            <th>Payment Status</th>
                                            <th>Date Purchased</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>
                                                    {{ $order->id }}
                                                </td>
                                                <td>
                                                    {{config('app.currency.symbol')}}{{ $order->total }}
                                                </td>
                                                <td>
                                                    <span class="text-info">{{ $order->order_status }}</span>
                                                </td>

                                                <td>
                                                    @if ($order->transactions->first())
                                                        {{ ucfirst($order->transactions->first()->payment_status) }}
                                                    @else
                                                        Not Paid
                                                    @endif
                                                </td>

                                                <td>{{ \Carbon\Carbon::now()->format('D/M/Y', strtotime($order->created_at)) }}
                                                </td>
                                                {{-- <td>
                                                <a href="https://geniusdevs.com/codecanyon/omnimart40/user/order/invoice/155"
                                                    class="btn primary_btn btn-sm">Invoice</a>
                                            </td> --}}
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
