@extends('layouts.admin_two')
@section('title')
    Option List
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
                            <h3 class="mb-0 bc-title"><b>Option</b></h3>
                            <a class="btn btn-primary  btn-sm" href="{{ route('client.option.create') }}"><i
                                    class="fas fa-plus"></i> Add</a>
                        </div>
                    </div>
                </div>

                <!-- DataTables -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="gd-responsive-table">
                            <table class="table table-bordered table-striped" id="admin-table" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        {{-- <th>Image</th> --}}
                                        <th>Option Name 1 (English)</th>
                                        <th>Option Name 2 (Arabic)*</th>
                                        <th>Type </th>
                                        <th>Sort Order </th>
                                        <th>Status </th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($options as $option)
                                        <tr>
                                            {{-- <td>
                                                <img src="{{ asset('storage/' . $option->image) }}" alt="Image Not Found"
                                                    width="100">

                                            </td> --}}
                                            <td>
                                                {{ $option->option_name_en }}
                                            </td>
                                            <td>
                                                {{ $option->option_name_ar }}
                                            </td>
                                            <td>
                                                {{ $option->input_type }}
                                            </td>

                                             <td>
                                                {{ $option->serial }}
                                            </td>

                                            <td>

                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm  dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ $option->status == 1 ? 'Enable' : 'Disable' }}
                                                    </button>
                                                    <div class="dropdown-menu animated--fade-in"
                                                        aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="{{ route('client.option.change.status', ['id' => $option->id]) }}">Enable</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('client.option.change.status', ['id' => $option->id]) }}">Disable</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="action-list">
                                                    <a class="btn btn-secondary btn-sm "
                                                        href="{{ route('client.option.edit', ['id' => $option->id]) }}">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a class="btn btn-danger btn-sm " data-toggle="modal"
                                                        data-target="#confirm-delete" href="javascript:;"
                                                        data-href="{{ route('client.option.delete', ['id' => $option->id]) }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </div>
                                            </td>


                                            <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
                                                aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <!-- Modal Header -->
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Confirm Delete?
                                                            </h5>
                                                            <button class="close" type="button" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>

                                                        <!-- Modal Body -->
                                                        <div class="modal-body">
                                                            You are going to delete this option. All contents related with
                                                            this option will be lost. Do you want
                                                            to delete it?
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Cancel</button>
                                                            <form
                                                                action="{{ route('client.option.delete', ['id' => $option->id]) }}"
                                                                class="d-inline btn-ok" method="get">
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
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
