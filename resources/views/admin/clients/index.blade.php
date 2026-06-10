@extends('layouts.admin')

@section('title')
    Client List
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Clients</b></h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.client.create') }}">
                                <i class="fas fa-plus"></i> Add Client
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Clients Table -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="gd-responsive-table">
                            <table class="table table-bordered table-striped" id="admin-table" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>Post Code</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($clients as $client)
                                        <tr>
                                            <td>{{ $client->name }}</td>
                                            <td>{{ $client->email }}</td>
                                            <td>{{ $client->phone }}</td>
                                            <td>{{ $client->city }}</td>
                                            <td>{{ $client->post_code }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm  dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ $client->status == 1 ? 'Enable' : 'Disable' }}
                                                    </button>
                                                    <div class="dropdown-menu animated--fade-in"
                                                        aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.client.change.status', ['id' => $client->id]) }}">Enable</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.client.change.status', ['id' => $client->id]) }}">Disable</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="action-list">
                                                    <a href="{{ route('admin.client.edit', ['id' => $client->id]) }}"
                                                        class="btn btn-sm btn-secondary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <a href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#confirm-delete-{{ $client->id }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>

                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="confirm-delete-{{ $client->id }}"
                                                        tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Confirm Delete</h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">×</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete this client?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancel</button>
                                                                    <form method="POST"
                                                                        action="{{ route('admin.client.delete', ['id' => $client->id]) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End Modal -->

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

        </div>
    </div>
@endsection
