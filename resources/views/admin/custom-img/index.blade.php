@extends('layouts.admin')
@section('title')
    Custom Images List
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
                            <h3 class="mb-0 bc-title"><b>Custom Images</b></h3>
                            <a class="btn btn-primary  btn-sm" href="{{ route('admin.custom_image.create') }}"><i
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Price/Char</th>
                                        <th>Serial</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($customImgs as $image)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($image->image_path) }}" alt="Image Not Found"
                                                    width="60">
                                            </td>
                                            <td>{{ $image->name }}</td>
                                            <td>{{ config('app.currency.symbol') }}{{ number_format($image->per_character_price, 2) }}</td>
                                            <td>{{ $image->serial }}</td>
                                            <td>
                                                <span class="badge {{ $image->status ? 'badge-success' : 'badge-danger' }}">
                                                    {{ $image->status ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.custom_image.edit', $image->id) }}"
                                                    class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#confirm-delete"
                                                    data-href="{{ route('admin.custom_image.delete', $image->id) }}">
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
