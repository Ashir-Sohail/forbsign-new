@extends('layouts.admin')
@section('title')
    Custom Color List
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
                            <h3 class="mb-0 bc-title"><b>Colors</b></h3>
                            <a class="btn btn-primary  btn-sm" href="{{ route('admin.custom_color.create') }}"><i
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
                                        <th>Color</th> 
                                        <th>Name</th>
                                        <th>Price/Char</th>
                                        <th>Serial</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customColors as $color)
                                        <tr>
                                            {{-- Color Swatch (using hex_code) --}}
                                            <td>
                                                <div
                                                    style="width: 40px; height: 40px; border-radius: 5px; background-color: {{ $color->hex_code }}; border: 1px solid #ccc;">
                                                </div>
                                            </td>

                                            {{-- Color Name --}}
                                            <td>{{ $color->name }}</td>

                                            {{-- Price per character --}}
                                            <td>
                                                @if ($color->price)
                                                    {{ config('app.currency.symbol') }}{{ number_format($color->price, 2) }}
                                                @else
                                                    Free
                                                @endif
                                            </td>

                                            {{-- Serial --}}
                                            <td>{{ $color->serial }}</td>

                                            {{-- Status --}}
                                            <td>
                                                <span class="badge {{ $color->status ? 'badge-success' : 'badge-danger' }}">
                                                    {{ $color->status ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>

                                            {{-- Actions --}}
                                            <td>
                                                <a href="{{ route('admin.custom_color.edit', $color->id) }}"
                                                    class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="javascript:;" class="btn btn-sm btn-danger" data-toggle="modal"
                                                    data-target="#confirm-delete"
                                                    data-href="{{ route('admin.custom_color.delete', $color->id) }}">
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
