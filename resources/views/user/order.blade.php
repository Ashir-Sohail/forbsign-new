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
                                                class="btn btn-info btn-sm">Invoice</a>
                                        </td> --}}
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
