@extends('layouts.admin')

@section('title')
    Client Create
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Create Client</b></h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.client.index') }}">
                                <i class="fas fa-chevron-left"></i> Back
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="card o-hidden border-0 shadow-lg">
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <form action="{{ route('admin.client.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <!-- Name -->
                                            <div class="form-group">
                                                <label for="name">Full Name *</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    value="{{ old('name') }}" placeholder="Enter client name">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Email -->
                                            <div class="form-group">
                                                <label for="email">Email *</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    value="{{ old('email') }}" placeholder="Enter email">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Phone -->
                                            <div class="form-group">
                                                <label for="phone">Phone *</label>
                                                <input type="text" name="phone" class="form-control" id="phone"
                                                    value="{{ old('phone') }}" placeholder="Enter phone number">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- City -->
                                            <div class="form-group">
                                                <label for="city">City *</label>
                                                <input type="text" name="city" class="form-control" id="city"
                                                    value="{{ old('city') }}" placeholder="Enter city name">
                                                @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Post_code -->
                                            <div class="form-group">
                                                <label for="post_code">Post Code *</label>
                                                <input type="text" name="post_code" class="form-control" id="post_code"
                                                    value="{{ old('post_code') }}" placeholder="Enter post code">
                                                @error('post_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Password -->
                                            <div class="form-group">
                                                <label for="password">Password *</label>
                                                <input type="password" name="password" class="form-control" id="password"
                                                    placeholder="Enter password">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Confirm Password -->
                                            <div class="form-group">
                                                <label for="password_confirmation">Confirm Password *</label>
                                                <input type="password" name="password_confirmation" class="form-control"
                                                    id="password_confirmation" placeholder="Confirm password">
                                            </div>

                                            <!-- Status -->
                                            {{-- <div class="form-group">
                                                <label for="status">Status *</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="pending"
                                                        {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="approved"
                                                        {{ old('status') == 'approved' ? 'selected' : '' }}>Approved
                                                    </option>
                                                    <option value="rejected"
                                                        {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejected
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> --}}

                                            <!-- Submit -->
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-secondary">Submit</button>
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
