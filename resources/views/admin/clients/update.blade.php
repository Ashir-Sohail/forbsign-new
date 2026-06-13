@extends('layouts.admin')

@section('title')
    Client Update
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Update Client</b></h3>
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
                                        <form action="{{ route('admin.client.update', $client->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            {{-- Optional: Profile Image --}}
                                            {{-- <div class="form-group">
                                                <label for="image">Profile Image</label><br>
                                                @if ($client->image)
                                                    <img class="admin-img"
                                                        src="{{ \App\Helpers\FileUploadHelper::url($client->image) ?? asset('public/assets/images/placeholder.png') }}"
                                                        alt="{{ $client->name ?? 'Client Image' }}" width="100">
                                                @else
                                                    <img class="admin-img" src="https://via.placeholder.com/100"
                                                        alt="No Image Found">
                                                @endif
                                            </div> --}}

                                            {{-- <div class="form-group position-relative">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo"
                                                        name="image" id="file" aria-label="File browser example">
                                                    <span class="file-custom text-left">Upload Image...</span>
                                                </label>
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> --}}

                                            {{-- Name --}}
                                            <div class="form-group">
                                                <label for="name">Name *</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    value="{{ old('name', $client->name) }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Email --}}
                                            <div class="form-group">
                                                <label for="email">Email *</label>
                                                <input type="email" name="email" class="form-control" id="email"
                                                    value="{{ old('email', $client->email) }}">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Phone --}}
                                            <div class="form-group">
                                                <label for="phone">Phone *</label>
                                                <input type="text" name="phone" class="form-control" id="phone"
                                                    value="{{ old('phone', $client->phone) }}">
                                                @error('phone')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- City --}}
                                            <div class="form-group">
                                                <label for="city">City *</label>
                                                <input type="text" name="city" class="form-control" id="city"
                                                    value="{{ old('city', $client->city) }}">
                                                @error('city')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Post Code --}}
                                            <div class="form-group">
                                                <label for="post_code">Post Code *</label>
                                                <input type="text" name="post_code" class="form-control" id="post_code"
                                                    value="{{ old('post_code', $client->post_code) }}">
                                                @error('post_code')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Optional: Change Password --}}
                                            {{-- <div class="form-group">
                                                <label for="password">New Password <small>(leave blank to keep
                                                        current)</small></label>
                                                <input type="password" name="password" class="form-control" id="password"
                                                    placeholder="Enter new password">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> --}}

                                            {{-- Status --}}
                                            {{-- <div class="form-group">
                                                <label for="status">Status *</label>
                                                <select name="status" class="form-control" id="status">
                                                    <option value="pending"
                                                        {{ $client->status == 'pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    <option value="approved"
                                                        {{ $client->status == 'approved' ? 'selected' : '' }}>Approved
                                                    </option>
                                                    <option value="rejected"
                                                        {{ $client->status == 'rejected' ? 'selected' : '' }}>Rejected
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> --}}

                                            {{-- Submit --}}
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-secondary">Update</button>
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
