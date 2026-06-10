@extends('layouts.admin_two')
@section('title')
    Invoice
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Invoice</b> </h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('client.all.order') }}"><i
                                    class="fas fa-chevron-left"></i> Back</a>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12">

                        <div class="card o-hidden border-0 shadow-lg">
                            <div class="card-body">
                                <h5 class="card-title">Order Details</h5>
                                <ul class="list-group mb-4">
                                    <li class="list-group-item"><strong>Name:</strong> {{ $order->user->name ?? '' }}</li>
                                    <li class="list-group-item"><strong>Email:</strong> {{ $order->user->email ?? '' }}</li>
                                    <li class="list-group-item"><strong>Address1:</strong>
                                        {{ $order->billingAddress->address1 ?? '' }}</li>
                                    <li class="list-group-item"><strong>Address2:</strong>
                                        {{ $order->billingAddress->address1 ?? '' }}</li>
                                    <li class="list-group-item"><strong>Zip Code:</strong>
                                        {{ $order->billingAddress->zip_code ?? '' }}</li>
                                    <li class="list-group-item"><strong>City:</strong>
                                        {{ $order->billingAddress->city ?? '' }}</li>
                                    <li class="list-group-item"><strong>Contact:</strong>
                                        {{ $order->billingAddress->contact ?? '' }}</li>
                                </ul>

                                <h5 class="card-title">Order Items</h5>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderItems as $key => $item)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>
                                                    {{ $item->product->name ?? '' }}

                                                    @if ($item->optionValues->isNotEmpty())
                                                        <ul class="list-unstyled mt-2 mb-0 ps-3"
                                                            style="font-size: 13px; color: #555;">
                                                            @foreach ($item->optionValues as $optionValue)
                                                                <li>
                                                                    <strong>{{ $optionValue->option->option_name_en ?? 'Option' }}:</strong>
                                                                    {{ $optionValue->option_name_en ?? '' }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                    
                                                    {{-- Customization --}}
                                                    @php
                                                        $customization = json_decode($item->customization, true);
                                                    @endphp

                                                    @if (!empty($customization))
                                                        <ul class="list-unstyled mt-2 mb-0 ps-3"
                                                            style="font-size: 13px; color: #007bff;">
                                                            @foreach ($customization as $key => $value)
                                                                <li>
                                                                    <strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong>
                                                                    {{ $value }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>{{ number_format($item->price, 2) }}</td>
                                                <td>{{ number_format($item->price * $item->quantity, 2) }}</td>
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
    </div>
@endsection
