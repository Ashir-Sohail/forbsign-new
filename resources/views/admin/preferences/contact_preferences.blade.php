@extends('layouts.admin')

@section('title')
    Contact Preferences
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Contact Preferences</b></h3>
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
                                        <a class="nav-link active" data-toggle="tab" href="#contact" role="tab">Contact
                                            Section</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#body" role="tab">Body</a>
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
                                <form action="{{ route('admin.contact.store.preferences') }}" method="POST">
                                    @csrf
                                    <div class="tab-content pt-4">

                                        <!-- Contact Section Tab -->
                                        <div class="tab-pane fade show active" id="contact" role="tabpanel">
                                            <div class="form-group">
                                                <label for="contact_title">Title*</label>
                                                <input type="text" name="contact_title" class="form-control"
                                                    id="contact_title"
                                                    value="{{ old('contact_title', $contactpreferences['contact_title'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('contact_title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="contact_heading">Heading*</label>
                                                <input type="text" name="contact_heading" class="form-control"
                                                    id="contact_heading"
                                                    value="{{ old('contact_heading', $contactpreferences['contact_heading'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('contact_heading')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- Body Tab -->
                                        <div class="tab-pane fade" id="body" role="tabpanel">
                                            <div class="form-group">
                                                <label for="body_heading">Heading*</label>
                                                <input type="text" name="body_heading" class="form-control"
                                                    id="body_heading"
                                                    value="{{ old('body_heading', $contactpreferences['body_heading'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('body_heading')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-check">
                                                <label for="form_heading">Form Heading*</label>
                                                <input type="text" class="form-control" name="form_heading"
                                                    id="form_heading"
                                                    value="{{ old('form_heading', $contactpreferences['form_heading'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('form_heading')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-check">
                                                <label for="form_button">Form Button*</label>
                                                <input type="text" class="form-control" name="form_button"
                                                    id="form_button"
                                                    value="{{ old('form_button', $contactpreferences['form_button'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('form_button')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-check">
                                                <label for="address_heading">Address Heading*</label>
                                                <input type="text" class="form-control" name="address_heading"
                                                    id="address_heading"
                                                    value="{{ old('address_heading', $contactpreferences['address_heading'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('address_heading')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-check">
                                                <label for="address">Address*</label>
                                                <input type="text" class="form-control" name="address" id="address"
                                                    value="{{ old('address', $contactpreferences['address'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-check">
                                                <label for="direction_button">Direction Button*</label>
                                                <input type="text" class="form-control" name="direction_button"
                                                    id="direction_button"
                                                    value="{{ old('direction_button', $contactpreferences['direction_button'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('direction_button')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-check">
                                                <label for="address_contact_heading">Contact Heading*</label>
                                                <input type="text" class="form-control" name="address_contact_heading"
                                                    id="address_contact_heading"
                                                    value="{{ old('address_contact_heading', $contactpreferences['address_contact_heading'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('address_contact_heading')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-check">
                                                <label for="phone">Phone*</label>
                                                <input type="text" class="form-control" name="phone" id="phone"
                                                    value="{{ old('phone', $contactpreferences['phone'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-check">
                                                <label for="email">Email*</label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                    value="{{ old('email', $contactpreferences['email'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-check">
                                                <label for="social_heading">Social Heading*</label>
                                                <input type="text" class="form-control" name="social_heading"
                                                    id="social_heading"
                                                    value="{{ old('social_heading', $contactpreferences['social_heading'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('social_heading')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Information --}}
                                        <div class="tab-pane fade" id="information" role="tabpanel">
                                            <div class="form-group">
                                                <label for="information_icon1">Icon1*</label>
                                                <textarea name="information_icon1" class="form-control" id="information_icon1" required>{{ old('information_icon1', $contactpreferences['information_icon1'] ?? '') }}</textarea>
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
                                                    value="{{ old('information_heading1', $contactpreferences['information_heading1'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('information_heading1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="information_description1">Description1*</label>
                                                <textarea type="text" name="information_description1" class="form-control" id="information_description1"
                                                    required>{{ old('information_description1', $contactpreferences['information_description1'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_description1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="information_icon2">Icon2*</label>
                                                <textarea type="text" name="information_icon2" class="form-control" id="information_icon2" required>{{ old('information_icon2', $contactpreferences['information_icon2'] ?? '') }}</textarea>
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
                                                    value="{{ old('information_heading2', $contactpreferences['information_heading2'] ?? '') }}"
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
                                                    required>{{ old('information_description2', $contactpreferences['information_description2'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_description2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="information_icon3">Icon3*</label>
                                                <textarea type="text" name="information_icon3" class="form-control" id="information_icon3" required>{{ old('information_icon3', $contactpreferences['information_icon3'] ?? '') }}</textarea>
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
                                                    value="{{ old('information_heading3', $contactpreferences['information_heading3'] ?? '') }}"
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
                                                    required>{{ old('information_Description3', $contactpreferences['information_Description3'] ?? '') }}</textarea>
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
                                                    value="{{ old('customer_heading', $contactpreferences['customer_heading'] ?? '') }}"
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
