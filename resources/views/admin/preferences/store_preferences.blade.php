@extends('layouts.admin')

@section('title')
    Store Preferences
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Store Preferences</b></h3>
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
                                        <a class="nav-link active" data-toggle="tab" href="#store"
                                            role="tab">Store Section</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#card" role="tab">Card</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#information" role="tab">
                                            Information</a>
                                    </li>
                                </ul>

                                <!-- Form Start -->
                                <form action="{{route('admin.store.store.preferences')}}" method="POST">
                                    @csrf
                                    <div class="tab-content pt-4">

                                        <!-- Store Tab -->
                                        <div class="tab-pane fade show active" id="store" role="tabpanel">
                                            <div class="form-group">
                                                <label for="store_title">Title*</label>
                                                <input type="text" name="store_title" class="form-control"
                                                    id="store_title"
                                                    value="{{ old('store_title', $storepreferences['store_title'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('store_title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="store_heading">Heading*</label>
                                                <input type="text" name="store_heading" class="form-control"
                                                    id="store_heading"
                                                    value="{{ old('store_heading', $storepreferences['store_heading'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('store_heading')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- Card Tab -->
                                        <div class="tab-pane fade" id="card" role="tabpanel">
                                            <div class="form-group">
                                                <label for="card_heading1">Heading1*</label>
                                                <input type="text" name="card_heading1" class="form-control"
                                                    id="card_heading1"
                                                    value="{{ old('card_heading1', $storepreferences['card_heading1'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('card_heading1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-check">
                                                <label for="card_heading2">Heading2*</label>
                                                <input type="text" class="form-control" name="card_heading2"
                                                    id="card_heading2"
                                                  value="{{ old('card_heading2', $storepreferences['card_heading2'] ?? '') }}" required>
                                            </div>
                                            @error('card_heading2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-check">
                                                <label for="card_heading3">Heading3*</label>
                                                <input type="text" class="form-control" name="card_heading3"
                                                    id="card_heading3"
                                                  value="{{ old('card_heading3', $storepreferences['card_heading3'] ?? '') }}" required>
                                            </div>
                                            @error('card_heading3')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Information --}}
                                        <div class="tab-pane fade" id="information" role="tabpanel">
                                            <div class="form-group">
                                                <label for="information_icon1">Icon1*</label>
                                                <textarea name="information_icon1" class="form-control" id="information_icon1" required>{{ old('information_icon1', $storepreferences['information_icon1'] ?? '') }}</textarea>
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
                                                    value="{{ old('information_heading1', $storepreferences['information_heading1'] ?? '') }}"
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
                                                    required>{{ old('information_description1', $storepreferences['information_description1'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_description1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="information_icon2">Icon2*</label>
                                                <textarea type="text" name="information_icon2" class="form-control" id="information_icon2" required>{{ old('information_icon2', $storepreferences['information_icon2'] ?? '') }}</textarea>
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
                                                    value="{{ old('information_heading2', $storepreferences['information_heading2'] ?? '') }}"
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
                                                    required>{{ old('information_description2', $storepreferences['information_description2'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_description2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="information_icon3">Icon3*</label>
                                                <textarea type="text" name="information_icon3" class="form-control" id="information_icon3" required>{{ old('information_icon3', $storepreferences['information_icon3'] ?? '') }}</textarea>
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
                                                    value="{{ old('information_heading3', $storepreferences['information_heading3'] ?? '') }}"
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
                                                    required>{{ old('information_Description3', $storepreferences['information_Description3'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_Description3')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
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
