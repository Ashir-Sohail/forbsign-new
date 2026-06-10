@extends('layouts.admin_two')
@section('title')
    Canceled Order
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class=" mb-0 bc-title"><b>Canceled Orders</b></h3>
                            {{-- <div class="right">
                                <a href="https://geniusdevs.com/codecanyon/omnimart40/admin/order/csv/export"
                                    class="btn btn-info btn-sm d-inline-block">CSV Export</a>
                                <form class="d-inline-block"
                                    action="https://geniusdevs.com/codecanyon/omnimart40/admin/bulk/deletes" method="get">
                                    <input type="hidden" value="" name="ids[]" id="bulk_delete">
                                    <input type="hidden" value="orders" name="table">
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </div> --}}
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
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr id="order-bulk-delete">
                                            <td>
                                                {{ $order->id }}
                                            </td>

                                            <td>
                                                {{ config('app.currency.symbol') }}{{ $order->total }}
                                            </td>

                                            <td>
                                                {{ $order->transactions->first()?->payment_status ?? 'N/A' }}
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
