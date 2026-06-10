@extends('layouts.admin')
@section('title')
    Custom Size Create
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Create Custom Size</b> </h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.custom_size.index') }}"><i
                                    class="fas fa-chevron-left"></i> Back</a>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12">

                        <div class="card o-hidden border-0 shadow-lg">
                            <div class="card-body ">
                                <!-- Nested Row within Card Body -->
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <form class="admin-form" action="{{ route('admin.custom_size.store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Size Name *</label>
                                                <input type="text" name="name" id="name" class="form-control"
                                                    placeholder="e.g. 24 inches, Large" required
                                                    value="{{ old('name') }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Extra Price --}}
                                            <div class="form-group">
                                                <label for="extra_price">Extra Price (Optional)</label>
                                                <input type="number" name="extra_price" id="extra_price"
                                                    class="form-control" step="0.01" placeholder="e.g. 100.00"
                                                    value="{{ old('extra_price', 0) }}">
                                                @error('extra_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Serial --}}
                                            <div class="form-group">
                                                <label for="serial">Serial (Sorting Order)</label>
                                                <input type="number" name="serial" id="serial" class="form-control"
                                                    value="{{ old('serial', 0) }}">
                                                @error('serial')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <button type="submit" class="btn btn-secondary ">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
