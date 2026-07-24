@extends('layouts.admin')
@section('title')
    Custom Size List
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <!-- Start of Main Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Size</b></h3>
                            <a class="btn btn-primary  btn-sm" href="{{ route('admin.custom_size.create') }}"><i
                                    class="fas fa-plus"></i> Add</a>
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
                                        <th>Name</th>
                                        <th>Extra Price</th>
                                        <th>Serial</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($customSizes as $size)
                                        <tr>
                                            {{-- Name --}}
                                            <td>{{ $size->name }}</td>

                                            {{-- Extra Price --}}
                                            <td>{{ config('app.currency.symbol') }}{{ number_format($size->extra_price, 2) }}</td>

                                            {{-- Serial --}}
                                            <td>{{ $size->serial }}</td>

                                            {{-- Status --}}
                                            <td>
                                                <span class="badge {{ $size->status ? 'badge-success' : 'badge-danger' }}">
                                                    {{ $size->status ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>

                                            {{-- Actions --}}
                                            <td>
                                                <a href="{{ route('admin.custom_size.edit', $size->id) }}"
                                                    class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#confirm-delete"
                                                    data-href="{{ route('admin.custom_size.delete', $size->id) }}">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
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
