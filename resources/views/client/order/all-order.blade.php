@extends('layouts.admin_two')
@section('title')
    All Order
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class=" mb-0 bc-title"><b>All Orders</b></h3>
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
                                        <th> <input type="checkbox" data-target="order-bulk-delete"
                                                class="form-control bulk_all_delete"> </th>
                                        <th>Order ID</th>
                                        <th>Total Amount</th>
                                        <th>Payment Status</th>
                                        <th>Order Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr id="order-bulk-delete">
                                            <td><input type="checkbox" class="bulk-item" value="156"></td>

                                            <td>
                                                {{ $order->id }}
                                            </td>

                                            <td>
                                                ${{ $order->total }}
                                            </td>

                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm dropdown-toggle" type="button"
                                                        id="dropdownMenuButton{{ $order->id }}" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        {{-- @dump($order->transactions->toArray()) --}}
                                                        {{-- {{ optional($order->transactions)->payment_status  }} --}}
                                                        {{ $order->transactions->first()->payment_status ?? 'Unpaid' }}

                                                    </button>
                                                    <div class="dropdown-menu animated--fade-in"
                                                        aria-labelledby="dropdownMenuButton{{ $order->id }}">
                                                        <a class="dropdown-item"
                                                            href="{{ route('client.order.change.status', ['id' => $order->id, 'status' => 'paid']) }}">Paid</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('client.order.change.status', ['id' => $order->id, 'status' => 'unpaid']) }}">Unpaid</a>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn Pending  btn-sm dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ $order->order_status }}
                                                    </button>
                                                    <div class="dropdown-menu animated--fade-in"
                                                        aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#statusModal" href="javascript:;"
                                                            data-href="{{ route('client.order.change.pending.status', ['id' => $order->id]) }}">Pending</a>
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#statusModal" href="javascript:;"
                                                            data-href="{{ route('client.order.change.processing.status', ['id' => $order->id]) }}">Processing</a>
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#statusModal" href="javascript:;"
                                                            data-href="{{ route('client.order.change.progress.status', ['id' => $order->id]) }}">
                                                            Progress</a>
                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#statusModal" href="javascript:;"
                                                            data-href="{{ route('client.order.change.delivered.status', ['id' => $order->id]) }}">Delivered</a>

                                                        <a class="dropdown-item" data-toggle="modal"
                                                            data-target="#statusModal" href="javascript:;"
                                                            data-href="{{ route('client.order.change.canceled.status', ['id' => $order->id]) }}">Canceled</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="action-list">
                                                    <a class="btn btn-secondary btn-sm"
                                                        href="{{ route('client.order.invoice', ['id' => $order->id]) }}">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Status?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            You are going to update the status. Do you want proceed?
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <a href="" class="btn btn-ok btn-success">Update</a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
                aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirm Delete?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>

                        <!-- Modal Body -->
                        <div class="modal-body">
                            You are going to delete this order. All contents related with this order will be lost. Do you
                            want to delete it?
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <form action="" class="d-inline btn-ok" method="POST">

                                <input type="hidden" name="_token" value="5G7KJnWZJiKt6I6pMExOheNmLtALmb20am98At1S">
                                <input type="hidden" name="_method" value="DELETE"> <button type="submit"
                                    class="btn btn-danger">Delete</button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
