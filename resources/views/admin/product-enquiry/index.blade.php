@extends('layouts.admin')
@section('title')
    Product Enquiry List
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
                            <h3 class="mb-0 bc-title"><b>Product Enquiry</b></h3>
                            {{-- <a class="btn btn-primary  btn-sm" href="{{ route('admin.brand.create') }}"><i
                                    class="fas fa-plus"></i> Add</a> --}}
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Contact Number</th>
                                        <th>Product</th>
                                        <th>Message</th>
                                        <th>File</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($enquiries as $enquiry)
                                        <tr>
                                            <td>{{ $enquiry->name }}</td>
                                            <td>{{ $enquiry->email }}</td>
                                            <td>{{ $enquiry->contact_number }}</td>
                                            <td>{{ $enquiry->product->name ?? 'N/A' }}</td>
                                            <td>{{ Str::limit($enquiry->message, 50) }}</td>
                                            <td>
                                                @if ($enquiry->file)
                                                    <a href="{{ \App\Helpers\FileUploadHelper::url($enquiry->file) }}"
                                                        target="_blank">View
                                                        File</a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>

                                            <td>
                                                <div class="action-list">
                                                    <a class="btn btn-danger btn-sm text-white" data-toggle="modal"
                                                        data-target="#confirm-delete"
                                                        data-href="{{ route('admin.product-enquiries.delete', $enquiry->id) }}">
                                                        <i class="fas fa-trash-alt"></i>
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

                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
                    aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title">Confirm Delete?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span>&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                You are going to delete this product enquiry. Do you want to continue?
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <form id="delete-form" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>

                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $(document).ready(function() {
            $('#confirm-delete').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var href = button.data('href'); // Extract delete URL
                var form = $('#delete-form');
                form.attr('action', href); // Set form action dynamically
            });
        });
    </script>
@endsection
