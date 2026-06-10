@extends('layouts.admin')

@section('title')
    Home Preferences
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Home Preferences</b></h3>
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
                                        <a class="nav-link active" data-toggle="tab" href="#general"
                                            role="tab">General</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#images" role="tab">Images
                                            Description</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#trusted" role="tab">Trusted
                                            By</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#craft" role="tab">Craft</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#button_heading" role="tab">Button
                                            and
                                            Heeadings</a>
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
                                <form action="{{route('admin.home.store.preferences')}}" method="POST">
                                    @csrf
                                    <div class="tab-content pt-4">

                                        <!-- General Tab -->
                                        <div class="tab-pane fade show active" id="general" role="tabpanel">
                                            <div class="form-group">
                                                <label for="general_heading">Heading*</label>
                                                <input type="text" name="general_heading" class="form-control"
                                                    id="general_heading"
                                                    value="{{ old('general_heading', $homepreferences['general_heading'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('general_heading')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="general_description">Description*</label>
                                                <input type="text" name="general_description" class="form-control"
                                                    id="general_description"
                                                    value="{{ old('general_description', $homepreferences['general_description'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('general_description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- Images Tab -->
                                        <div class="tab-pane fade" id="images" role="tabpanel">
                                            <div class="form-group">
                                                <label for="image_one_button">Image One Button*</label>
                                                <input type="text" name="image_one_button" class="form-control"
                                                    id="image_one_button"
                                                    value="{{ old('image_one_button', $homepreferences['image_one_button'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('image_one_button')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="image_one_button_link">Image One Button Link*</label>
                                                <textarea type="text" name="image_one_button_link" class="form-control" id="image_one_button_link" required>{{ old('image_one_button_link', $homepreferences['image_one_button_link'] ?? '') }}</textarea>
                                            </div>
                                            @error('image_one_button_link')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="image_two_button">Image Two Button*</label>
                                                <input type="text" name="image_two_button" class="form-control"
                                                    id="image_two_button"
                                                    value="{{ old('image_two_button', $homepreferences['image_two_button'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('image_two_button')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="image_two_button_link">Image Two Button Link*</label>
                                                <textarea type="text" name="image_two_button_link" class="form-control" id="image_two_button_link" required>{{ old('image_two_button_link', $homepreferences['image_two_button_link'] ?? '') }}</textarea>
                                            </div>
                                            @error('image_two_button_link')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- Trusted Tab -->
                                        <div class="tab-pane fade" id="trusted" role="tabpanel">
                                            <div class="form-check">
                                                <label class="form-check-label" for="icon1">Icon1*</label>
                                                <textarea class="form-control" name="icon1" id="icon1" required>{{ old('icon1', $homepreferences['icon1'] ?? '') }}</textarea>

                                            </div>
                                            @error('icon1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-check">
                                                <label class="form-check-label" for="title1">title1*</label>
                                                <input type="text" class="form-control" name="title1" id="title1"
                                                    value="{{ old('title1', $homepreferences['title1'] ?? '') }}" required>

                                            </div>
                                            @error('title1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-check">
                                                <label class="form-check-label" for="title2">title2*</label>
                                                <input type="text" class="form-control" name="title2" id="title2"
                                                    value="{{ old('title2', $homepreferences['title2'] ?? '') }}" required>

                                            </div>
                                            @error('title2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-check">
                                                <label class="form-check-label" for="title3">title3*</label>
                                                <input type="text" class="form-control" name="title3" id="title3"
                                                    value="{{ old('title3', $homepreferences['title3'] ?? '') }}" required>

                                            </div>
                                            @error('title3')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            {{-- second --}}
                                            <div class="form-check">
                                                <label class="form-check-label" for="icon2">Icon2*</label>
                                                <textarea class="form-control" name="icon2" id="icon2" required>{{ old('icon2', $homepreferences['icon2'] ?? '') }}</textarea>

                                            </div>
                                            @error('icon2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-check">
                                                <label class="form-check-label" for="scond_title1">Title1*</label>
                                                <input type="text" class="form-control" name="scond_title1"
                                                    id="scond_title1"
                                                    value="{{ old('scond_title1', $homepreferences['scond_title1'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('scond_title1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-check">
                                                <label class="form-check-label" for="scond_title2">Title2*</label>
                                                <input type="text" class="form-control" name="scond_title2"
                                                    id="scond_title2"
                                                    value="{{ old('scond_title2', $homepreferences['scond_title2'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('scond_title2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-check">
                                                <label class="form-check-label" for="scond_title3">Title3*</label>
                                                <input type="text" class="form-control" name="scond_title3"
                                                    id="scond_title3"
                                                    value="{{ old('scond_title3', $homepreferences['scond_title3'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('scond_title3')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            {{-- third --}}

                                            <div class="form-check">
                                                <label class="form-check-label" for="icon3">Icon3*</label>
                                                <textarea class="form-control" name="icon3" id="icon3" required> {{ old('icon3', $homepreferences['icon3'] ?? '') }}</textarea>
                                            </div>
                                            @error('icon3')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-check">
                                                <label class="form-check-label" for="third_title1">Title1*</label>
                                                <input type="text" class="form-control" name="third_title1"
                                                    id="third_title1"
                                                    value="{{ old('third_title1', $homepreferences['third_title1'] ?? '') }}"
                                                    required>

                                            </div>
                                            @error('third_title1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-check">
                                                <label class="form-check-label" for="third_title2">Title2*</label>
                                                <input type="text" class="form-control" name="third_title2"
                                                    id="third_title2"
                                                    value="{{ old('third_title2', $homepreferences['third_title2'] ?? '') }}"
                                                    required>

                                            </div>
                                            @error('third_title2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-check">
                                                <label class="form-check-label" for="third_title3">Title3*</label>
                                                <input type="text" class="form-control" name="third_title3"
                                                    id="third_title3"
                                                    value="{{ old('third_title3', $homepreferences['third_title3'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('third_title3')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            {{-- fourth --}}

                                            <div class="form-check">
                                                <label class="form-check-label" for="icon4">Icon4*</label>
                                                <textarea class="form-control" name="icon4" id="icon4" required>{{ old('icon4', $homepreferences['icon4'] ?? '') }}</textarea>
                                            </div>
                                            @error('icon4')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-check">
                                                <label class="form-check-label" for="fourth_title1">Title1*</label>
                                                <input type="text" class="form-control" name="fourth_title1"
                                                    id="fourth_title1"
                                                    value="{{ old('fourth_title1', $homepreferences['fourth_title1'] ?? '') }}"
                                                    required>

                                            </div>
                                            @error('fourth_title1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-check">
                                                <label class="form-check-label" for="fourth_title2">Title2*</label>
                                                <input type="text" class="form-control" name="fourth_title2"
                                                    id="fourth_title2"
                                                    value="{{ old('fourth_title2', $homepreferences['fourth_title2'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('fourth_title2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-check">
                                                <label class="form-check-label" for="fourth_title3">Title3*</label>
                                                <input type="text" class="form-control" name="fourth_title3"
                                                    id="fourth_title3"
                                                    value="{{ old('fourth_title3', $homepreferences['fourth_title3'] ?? '') }}"
                                                    required>

                                            </div>
                                            @error('fourth_title3')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- Craft Tab -->
                                        <div class="tab-pane fade" id="craft" role="tabpanel">
                                            <div class="form-group">
                                                <label for="craft_heading1">Heading1*</label>
                                                <input type="text" name="craft_heading1" class="form-control"
                                                    id="craft_heading1"
                                                    value="{{ old('craft_heading1', $homepreferences['craft_heading1'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('craft_heading1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-check">
                                                <label for="craft_heading2">Heading2*</label>
                                                <input type="text" class="form-control" name="craft_heading2"
                                                    id="craft_heading2"
                                                  value="{{ old('craft_heading2', $homepreferences['craft_heading2'] ?? '') }}" required>
                                            </div>
                                            @error('craft_heading2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-check">
                                                <label for="craft_description">Description*</label>
                                                <textarea class="form-control" name="craft_description" id="craft_description" required>{{ old('craft_description', $homepreferences['craft_description'] ?? '') }}</textarea>
                                            </div>
                                            @error('craft_description')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <!-- Buttons and Headings Tab -->
                                        <div class="tab-pane fade" id="button_heading" role="tabpanel">
                                            <div class="form-group">
                                                <label for="customer_favorite_heading">Customer Favorite Heading*</label>
                                                <input type="text" name="customer_favorite_heading"
                                                    class="form-control" id="customer_favorite_heading"
                                                    value="{{ old('customer_favorite_heading', $homepreferences['customer_favorite_heading'] ?? '') }}" required>
                                            </div>
                                            @error('customer_favorite_heading')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="visit_store">Visit Store*</label>
                                                <input type="text" name="visit_store" class="form-control"
                                                    id="visit_store"
                                                    value="{{ old('visit_store', $homepreferences['visit_store'] ?? '') }}" required>
                                            </div>
                                            @error('visit_store')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="visit_store_link">Visit Store Link*</label>
                                                <input type="text" name="visit_store_link" class="form-control"
                                                    id="visit_store_link"
                                                    value="{{ old('visit_store_link', $homepreferences['visit_store_link'] ?? '') }}" required>
                                            </div>
                                            @error('visit_store_link')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="categories_heading">Categories Heading*</label>
                                                <input type="text" name="categories_heading" class="form-control"
                                                    id="categories_heading"
                                                    value="{{ old('categories_heading', $homepreferences['categories_heading'] ?? '') }}" required>
                                            </div>
                                            @error('categories_heading')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="categories_button">Categories Button*</label>
                                                <input type="text" name="categories_button" class="form-control"
                                                    id="categories_button"
                                                    value="{{ old('categories_button', $homepreferences['categories_button'] ?? '') }}" required>
                                            </div>
                                            @error('categories_button')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="categories_button_link">Categories Button Link*</label>
                                                <input type="text" name="categories_button_link" class="form-control"
                                                    id="categories_button_link"
                                                    value="{{ old('categories_button_link', $homepreferences['categories_button_link'] ?? '') }}" required>
                                            </div>
                                            @error('categories_button_link')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="brands_heading">Brands Heading*</label>
                                                <input type="text" name="brands_heading" class="form-control"
                                                    id="brands_heading"
                                                    value="{{ old('brands_heading', $homepreferences['brands_heading'] ?? '') }}" required>
                                            </div>
                                            @error('brands_heading')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="brands_button">Brands Button*</label>
                                                <input type="text" name="brands_button" class="form-control"
                                                    id="brands_button"
                                                    value="{{ old('brands_button', $homepreferences['brands_button'] ?? '') }}" required>
                                            </div>
                                            @error('brands_button')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="brands_button_link">Brands Button Link*</label>
                                                <input type="text" name="brands_button_link" class="form-control"
                                                    id="brands_button_link"
                                                    value="{{ old('brands_button_link', $homepreferences['brands_button_link'] ?? '') }}" required>
                                            </div>
                                            @error('brands_button_link')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        {{-- Information --}}
                                        <div class="tab-pane fade" id="information" role="tabpanel">
                                            <div class="form-group">
                                                <label for="information_icon1">Icon1*</label>
                                                <textarea name="information_icon1" class="form-control" id="information_icon1" required>{{ old('information_icon1', $homepreferences['information_icon1'] ?? '') }}</textarea>
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
                                                    value="{{ old('information_heading1', $homepreferences['information_heading1'] ?? '') }}"
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
                                                    required>{{ old('information_description1', $homepreferences['information_description1'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_description1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="information_icon2">Icon2*</label>
                                                <textarea type="text" name="information_icon2" class="form-control" id="information_icon2" required>{{ old('information_icon2', $homepreferences['information_icon2'] ?? '') }}</textarea>
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
                                                    value="{{ old('information_heading2', $homepreferences['information_heading2'] ?? '') }}"
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
                                                    required>{{ old('information_description2', $homepreferences['information_description2'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_description2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="information_icon3">Icon3*</label>
                                                <textarea type="text" name="information_icon3" class="form-control" id="information_icon3" required>{{ old('information_icon3', $homepreferences['information_icon3'] ?? '') }}</textarea>
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
                                                    value="{{ old('information_heading3', $homepreferences['information_heading3'] ?? '') }}"
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
                                                    required>{{ old('information_Description3', $homepreferences['information_Description3'] ?? '') }}</textarea>
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
                                                    value="{{ old('customer_heading', $homepreferences['customer_heading'] ?? '') }}"
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
