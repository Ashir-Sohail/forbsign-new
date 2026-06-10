@extends('layouts.admin')

@section('title')
    Service Preferences
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Service Preferences</b></h3>
                            {{-- <a class="btn btn-primary btn-sm" href="">
                                <i class="fas fa-chevron-left"></i> Back
                            </a> --}}
                        </div>
                    </div>
                </div>

                <!-- Preferences Form -->
                <div class="row">
                    <div class="col-12">
                        <div class="card o-hidden border-0 shadow-lg mb-4">
                            <div class="card-body">

                                <!-- Tabs Navigation -->
                                <ul class="nav nav-tabs" id="preferencesTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#service" role="tab">Service
                                            Section</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#body" role="tab">Service Body</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#information" role="tab">
                                            Information</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#customer" role="tab">
                                            Customer</a>
                                    </li>
                                </ul>

                                <!-- Form Start -->
                                <form action="{{route('admin.service.store.preferences')}}" method="POST">
                                    @csrf
                                    <div class="tab-content pt-4">

                                        <!-- Service Section Tab -->
                                        <div class="tab-pane fade show active" id="service" role="tabpanel">
                                            <div class="form-group">
                                                <label for="service_title">Title*</label>
                                                <input type="text" name="service_title" class="form-control"
                                                    id="service_title"
                                                    value="{{ old('service_title', $servicepreferences['service_title'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('service_title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="service_heading">Heading*</label>
                                                <input type="text" name="service_heading" class="form-control"
                                                    id="service_heading"
                                                    value="{{ old('service_heading', $servicepreferences['service_heading'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('service_heading')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- Body Tab -->
                                        <div class="tab-pane fade" id="body" role="tabpanel">
                                            <div class="form-group">
                                                <label for="body_heading">Heading1*</label>
                                                <input type="text" name="body_heading" class="form-control"
                                                    id="body_heading"
                                                    value="{{ old('body_heading', $servicepreferences['body_heading'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('body_heading')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-check">
                                                <label for="body_description">Description*</label>
                                                <textarea class="form-control" name="body_description" id="body_description" required>{{ old('body_description', $servicepreferences['body_description'] ?? '') }}</textarea>
                                            </div>
                                            @error('body_description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Information --}}
                                        <div class="tab-pane fade" id="information" role="tabpanel">
                                            <div class="form-group">
                                                <label for="information_icon1">Icon1*</label>
                                                <textarea name="information_icon1" class="form-control" id="information_icon1" required>{{ old('information_icon1', $servicepreferences['information_icon1'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_icon1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="information_heading1">Heading1*</label>
                                                <input type="text" name="information_heading1" class="form-control"
                                                    id="information_heading1"
                                                    value="{{ old('information_heading1', $servicepreferences['information_heading1'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('information_heading1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="information_description1">Description1*</label>
                                                <textarea type="text" name="information_description1" class="form-control" id="information_description1" required>{{ old('information_description1', $servicepreferences['information_description1'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_description1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="information_icon2">Icon2*</label>
                                                <textarea type="text" name="information_icon2" class="form-control" id="information_icon2" required>{{ old('information_icon2', $servicepreferences['information_icon2'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_icon2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="information_heading2">Heading2*</label>
                                                <input type="text" name="information_heading2" class="form-control"
                                                    id="information_heading2"
                                                    value="{{ old('information_heading2', $servicepreferences['information_heading2'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('information_heading2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="information_description2">Description2*</label>
                                                <textarea type="text" name="information_description2" class="form-control" id="information_description2"
                                                    required>{{ old('information_description2', $servicepreferences['information_description2'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_description2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="information_icon3">Icon3*</label>
                                                <textarea type="text" name="information_icon3" class="form-control" id="information_icon3" required>{{ old('information_icon3', $servicepreferences['information_icon3'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_icon3')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="information_heading3">Heading3*</label>
                                                <input type="text" name="information_heading3" class="form-control"
                                                    id="information_heading3"
                                                    value="{{ old('information_heading3', $servicepreferences['information_heading3'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('information_heading3')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="information_Description3">Description3*</label>
                                                <textarea type="text" name="information_Description3" class="form-control" id="information_Description3"
                                                    required>{{ old('information_Description3', $servicepreferences['information_Description3'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_Description3')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- customer --}}
                                        <div class="tab-pane fade" id="customer" role="tabpanel">
                                            <div class="form-group">
                                                <label for="customer_heading">Customer Heading*</label>
                                                <input type="text" name="customer_heading" class="form-control"
                                                    id="customer_heading"
                                                    value="{{ old('customer_heading', $servicepreferences['customer_heading'] ?? '') }}"
                                                    required>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="form-group mt-4 text-right">
                                        <button type="submit" class="btn btn-secondary">Save Preferences</button>
                                    </div>

                                </form>
                                <!-- Form End -->

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
