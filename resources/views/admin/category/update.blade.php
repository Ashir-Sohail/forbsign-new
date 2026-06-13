@extends('layouts.admin')
@section('title')
    Category Update
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Update Category</b> </h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.category.index') }}"><i
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
                                        <form class="admin-form"
                                            action="{{ route('admin.category.update', ['id' => $category->id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Set Image *</label>
                                                <br>
                                                @if ($category->image)
                                                    {{-- <img class="admin-img"
                                                        src="{{ \App\Helpers\FileUploadHelper::url($category->image) }}"
                                                        alt="{{ $category->name }}"> --}}
                                                    <img class="admin-img"
                                                        src="{{ \App\Helpers\FileUploadHelper::url($category->image) ?? asset('public/assets/images/placeholder.png') }}"
                                                        alt="{{ $category->name ?? 'Category Image' }}">
                                                @else
                                                    <img class="admin-img"
                                                        src="{{ asset('assets/images/placeholder.png') }}"
                                                        alt="No Image Found">
                                                @endif

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
                                                    id="name" placeholder="Enter Name" value="{{ $category->name }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="parent_id">Select Parent Category *</label>
                                                <select name="parent_id" id="parent_id" class="form-control">
                                                    <option value="">-- No Parent (Top-Level Category) --</option>
                                                    @include(
                                                        'admin.category.partial.category-option-update',
                                                        [
                                                            'categories' => $categories,
                                                            'level' => 0,
                                                            'category' => $category,
                                                        ]
                                                    )
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_title">Meta Title *
                                                </label>
                                                <input type="text" name="meta_title" class="form-control" id="meta_title"
                                                    placeholder="Enter Meta Title" value="{{ $category->meta_title }}">
                                                @error('meta_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            {{-- <div class="form-group">
                                                <label for="slug">Slug *</label>
                                                <input type="text" name="slug" class="form-control" id="slug"
                                                    placeholder="Enter Slug" value="{{ $category->slug }}">
                                                @error('slug')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> --}}

                                            <div class="form-group">
                                                <label for="meta_keywords">Meta Keywords *
                                                </label>
                                                <input type="text" name="meta_keyword" class="tags" id="meta_keywords"
                                                    placeholder="Enter Meta Keywords"
                                                    value="{{ $category->meta_keyword }}">
                                                @error('meta_keyword')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="title">SEO URL *</label>
                                                <input type="text" name="meta_url" class="form-control" id="urls"
                                                    placeholder="Enter Meta Link" value="{{ $category->meta_url }}">
                                                @error('meta_url')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_description">Meta Description *
                                                </label>
                                                <textarea name="meta_description" id="meta_description" class="form-control" rows="5"
                                                    placeholder="Enter Meta Description">{{ $category->meta_description }}</textarea>
                                                @error('meta_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="serial">Sort *</label>
                                                <input type="number" name="serial" class="form-control" id="serial"
                                                    placeholder="Enter Serial Number" value="{{ $category->serial }}">
                                                @error('serial')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <button type="submit" class="btn btn-secondary ">Update</button>
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
