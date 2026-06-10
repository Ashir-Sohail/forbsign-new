@extends('layouts.admin')

@section('title')
    Create Website Template
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Create Website Template</b></h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.website-template.index') }}">
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
                                        <form action="{{ route('admin.website-template.store') }}" method="POST">
                                            @csrf

                                            <!-- Domain -->
                                            <div class="form-group">
                                                <label for="domain">Domain *</label>
                                                <input type="text" name="domain" class="form-control" id="domain"
                                                    value="{{ old('domain') }}"
                                                    placeholder="Enter domain (e.g. example.com)">
                                                @error('domain')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Name -->
                                            <div class="form-group">
                                                <label for="name">Template Name *</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    value="{{ old('name') }}" placeholder="Enter template name">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="website_id">Select Domain *</label>
                                                <select name="website_id" class="form-control" id="website_id">
                                                    <option value="">-- Select Domain --</option>
                                                    @foreach ($websites as $website)
                                                        <option value="{{ $website->id }}"
                                                            {{ old('website_id') }}>
                                                            {{ $website->domain_name }}</option>
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('website_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <!-- Status -->
                                            {{-- <div class="form-group">
                                                <label for="status">Status *</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>
                                                        Active</option>
                                                    <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>
                                                        Inactive</option>
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
