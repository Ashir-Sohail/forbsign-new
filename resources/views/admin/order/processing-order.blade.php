@extends('layouts.admin')
@section('title')
    Processing Order
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class=" mb-0 bc-title"><b>Pending Orders</b></h3>
                         
                        </div>
                    </div>
                </div>

                <!-- DataTales -->
                <div class="card shadow mb-4">
                    <div class="card-body">

                        <div class="gd-responsive-table">
                            <table class="table table-bordered table-striped" id="admin-table" width="100%"
                                cellspacing="0">

                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Total Amount</th>
                                        <th>Payment Status</th>
                                        <th>Order Status</th>
                                        {{-- <th>Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr id="order-bulk-delete">
                                            <td>
                                                {{ $order->id }}
                                            </td>

                                            <td>
                                                ${{ $order->total }}
                                            </td>

                                            <td>
                                                {{ $order->transactions->first()->payment_status ?? '' }}
                                            </td>
                                            <td>
                                                {{ $order->order_status }}
                                            </td>
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
