@extends('layouts.admin')

@section('title')
    Website List
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Websites</b></h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.website.create') }}">
                                <i class="fas fa-plus"></i> Add Website
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Website Table -->
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="gd-responsive-table">
                            <table class="table table-bordered table-striped" id="admin-table" width="100%"
                                cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Domain Name</th>
                                        <th>SEO URL</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Client</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($websites as $website)
                                        <tr>
                                            <td>{{ $website->domain_name }}</td>
                                            <td>{{ $website->seo_url }}</td>
                                            <td>{{ Str::limit($website->description, 50) }}</td>
                                            <td>
                                                <div class="dropdown">
                                                    <button class="btn btn-success btn-sm  dropdown-toggle" type="button"
                                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                        {{ $website->status == 1 ? 'Enable' : 'Disable' }}
                                                    </button>
                                                    <div class="dropdown-menu animated--fade-in"
                                                        aria-labelledby="dropdownMenuButton">
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.website.change.status', ['id' => $website->id]) }}">Enable</a>
                                                        <a class="dropdown-item"
                                                            href="{{ route('admin.website.change.status', ['id' => $website->id]) }}">Disable</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $website->client->name ?? 'N/A' }}</td>
                                            <td>
                                                <div class="action-list">
                                                    <a href="{{ route('admin.website.edit', $website->id) }}"
                                                        class="btn btn-sm btn-secondary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    <a href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal"
                                                        data-target="#confirm-delete-{{ $website->id }}">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>

                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="confirm-delete-{{ $website->id }}"
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
                                                                    Are you sure you want to delete this website?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Cancel</button>
                                                                    <form method="POST"
                                                                        action="{{ route('admin.website.delete', $website->id) }}">
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
