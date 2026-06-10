@extends('layouts.admin')

@section('title')
    Email List
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Email Templates</b></h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.email.create') }}">
                                <i class="fas fa-plus"></i> Add Tenplate
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Email Table -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="gd-responsive-table">
                            <table class="table table-bordered table-striped" id="admin-table" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Body</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($emails as $email)
                                        <tr>
                                            <td>{{ $email->title }}</td>
                                            <td>{!! Str::limit(strip_tags($email->body), 90) !!}</td>
                                            
                                            <td>
                                                <div class="action-list">
                                                    <a href="{{ route('admin.email.edit', ['id' => $email->id]) }}"
                                                        class="btn btn-sm btn-secondary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <a href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#confirm-delete-{{ $email->id }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>

                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="confirm-delete-{{ $email->id }}"
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
                                                                    Are you sure you want to delete this template?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancel</button>
                                                                    <form method="POST"
                                                                        action="{{ route('admin.email.delete', ['id' => $email->id]) }}">
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
