@extends('layouts.admin')

@section('title')
    Website Create
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Create Website</b></h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.website.index') }}">
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
                                        <form action="{{ route('admin.website.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <!-- Domain Name -->
                                            <div class="form-group">
                                                <label for="domain_name">Domain Name *</label>
                                                <input type="text" name="domain_name" class="form-control"
                                                    id="domain_name" value="{{ old('domain_name') }}"
                                                    placeholder="Enter domain name">
                                                @error('domain_name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- SEO URL -->
                                            <div class="form-group">
                                                <label for="seo_url">SEO URL *</label>
                                                <input type="text" name="seo_url" class="form-control" id="seo_url"
                                                    value="{{ old('seo_url') }}" placeholder="Enter SEO-friendly URL">
                                                @error('seo_url')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Description -->
                                            <div class="form-group">
                                                <label for="description">Description *</label>
                                                <textarea name="description" class="form-control" id="description" rows="4"
                                                    placeholder="Enter website description">{{ old('description') }}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Client Selection -->
                                            <div class="form-group">
                                                <label for="client_id">Select Client *</label>
                                                <select name="client_id" class="form-control" id="client_id">
                                                    <option value="">-- Select Client --</option>
                                                    @foreach ($clients as $client)
                                                        <option value="{{ $client->id }}"
                                                            {{ old('client_id') == $client->id ? 'selected' : '' }}>
                                                            {{ $client->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('client_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Web Icon -->
                                            <div class="form-group">
                                                <label for="web_icon">Web Icon (optional)</label>
                                                <input type="file" name="web_icon" class="form-control-file"
                                                    id="web_icon">
                                                @error('web_icon')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Status -->
                                            {{-- <div class="form-group">
                                                <label for="status">Status *</label>
                                                <select name="status" class="form-control" id="status">
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
