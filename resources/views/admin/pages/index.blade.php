@extends('layouts.admin')
@section('title')
    Pages
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
                            <h3 class="mb-0 bc-title"><b>Page Content Management</b></h3>
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
                                        <th>Title</th>
                                        <th>Type</th>
                                        <th>Last Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pages as $page)
                                        <tr>
                                            <td>{{ $page->title }}</td>
                                            <td>{{ ucfirst(str_replace('_', ' ', $page->type)) }}</td>
                                            <td>{{ $page->updated_at->format('d M, Y h:i A') }}</td>
                                            <td>
                                                <a class="btn btn-secondary btn-sm "
                                                    href="{{ route('admin.pages.edit', $page->id) }}">
                                                    <i class="fas fa-edit"></i>
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
