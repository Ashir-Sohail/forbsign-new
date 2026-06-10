@extends('layouts.admin_two')
@section('title')
    Category Create
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Create Category</b> </h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('client.category.index') }}"><i
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
                                        <form class="admin-form" action="{{ route('client.category.store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Set Image *</label>
                                                <br>
                                                <img class="admin-img" src="{{ asset('assets/images/placeholder.png') }}"
                                                    alt="No Image Found">
                                                <br>
                                                <span class="mt-1">Image Size Should Be 60 x 60.</span>
                                            </div>

                                            <div class="form-group position-relative">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo"
                                                        name="image" id="file" aria-label="File browser example">
                                                    <span class="file-custom text-left">Upload Image...</span>
                                                </label>
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="name">Name *</label>
                                                <input type="text" name="name" class="form-control item-name"
                                                    id="name" placeholder="Enter Name" value="{{ old('name') }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="website_id">Select Website*</label>
                                                <select name="website_id" id="website_id" class="form-control">
                                                    <option value="">-- Select Website --</option>
                                                    @foreach ($websites as $item)
                                                        <option value="{{ $item->id }}" {{ old('website_id') }}>
                                                            {{ $item->domain_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('website_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- <div class="form-group">
                                                <label for="parent_id">Parent Category</label>
                                                <select class="form-control" id="parent_id" name="parent_id">
                                                    <option value="">--None--</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div> --}}
                                            {{-- <div class="form-group">
                                                <label for="parent_id">Select Parent Category</label>
                                                <select class="form-control" name="parent_id" id="parent_id">
                                                    <option value="">-- No Parent (Top-Level Category) --</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                        @foreach ($category->children as $subcategory)
                                                            <option value="{{ $subcategory->id }}">-- {{ $subcategory->name }}</option>
                                                        @endforeach
                                                    @endforeach
                                                </select>
                                            </div> --}}
                                            <!-- resources/views/admin/categories/create.blade.php -->

                                            <div class="form-group">
                                                <label for="parent_id">Select Parent Category *</label>
                                                <select class="form-control" name="parent_id" id="parent_id">
                                                    <option value="">-- No Parent (Top-Level Category) --</option>

                                                    <!-- Recursively display categories and subcategories -->
                                                    @foreach ($categories as $category)
                                                        @include(
                                                            'client.category.partial.category-option',
                                                            [
                                                                'category' => $category,
                                                            ]
                                                        )
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_title">Meta Title *
                                                </label>
                                                <input type="text" name="meta_title" class="form-control" id="meta_title"
                                                    placeholder="Enter Meta Title" value="{{ old('meta_title') }}">
                                                @error('meta_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="meta_keywords">Meta Keywords *
                                                </label>
                                                <input type="text" name="meta_keyword" class="tags" id="meta_keywords"
                                                    placeholder="Enter Meta Keywords" value="{{ old('meta_keyword') }}">
                                                @error('meta_keyword')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="title">SEO URL *</label>
                                                <input type="text" name="meta_url" class="form-control" id="meta_url"
                                                    placeholder="Enter Meta Link" value="{{ old('meta_url') }}">
                                                @error('meta_url')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_description">Meta Description *
                                                </label>
                                                <textarea name="meta_description" id="meta_description" class="form-control" rows="5"
                                                    placeholder="Enter Meta Description">{{ old('meta_description') }}</textarea>
                                                @error('meta_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="serial">Sort *</label>
                                                <input type="number" name="serial" class="form-control" id="serial"
                                                    placeholder="Enter Serial Number" value="0">
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
<script>
    function renderParentCategoryDropdown(categories, parentId = null) {
        alert("Rendering categories with parentId: " + parentId);
        let dropdown = "";

        for (let category of categories) {
            if (category.parent_id === parentId) {
                dropdown += `<option value="${category.id}">`;
                if (category.parent_id !== null) {
                    dropdown += "  "; // Indent child categories
                }
                dropdown += category.name;
                dropdown += "</option>";

                // Recursively render child categories
                dropdown += renderParentCategoryDropdown(categories, category.id);
            }
        }

        return dropdown;
    }
</script>
