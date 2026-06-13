@extends('layouts.admin')
@section('title')
    Brand Update
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Update Brand</b> </h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.brand.index') }}"><i
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
                                            action="{{ route('admin.brand.update', ['id' => $brand->id]) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label for="name">Set Image *</label>
                                                <br>
                                                @if ($brand->image)

                                                        <img class="admin-img"
                                                        src="{{ \App\Helpers\FileUploadHelper::url($brand->image) ?? asset('public/assets/images/placeholder.png') }}"
                                                        alt="{{ $brand->image ?? 'Brand Image' }}">
                                                @else
                                                    <img class="admin-img"
                                                        src="{{asset('public/assets/images/placeholder.png')}}"
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
                                                    id="name" placeholder="Enter Name" value="{{ $brand->name }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            {{-- 
                                            <div class="form-group">
                                                <label for="title">Meta Title *</label>
                                                <input type="text" name="title" class="form-control" id="title"
                                                    placeholder="Enter Title" value="{{ $brand->title }}">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> --}}
                                            <div class="form-group">
                                                <label for="meta_title">Meta Title
                                                </label>
                                                <input type="text" name="meta_title" class="form-control" id="meta_title"
                                                    placeholder="Enter Meta Title" value="{{ $brand->meta_title }}">
                                                @error('meta_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_keywords">Meta Keywords
                                                </label>
                                                <input type="text" name="meta_keyword" class="tags" id="meta_keywords"
                                                    placeholder="Enter Meta Keywords" value="{{ $brand->meta_keyword }}">
                                                @error('meta_keyword')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- <div class="form-group">
                                                <label for="slider-link">SEO URL *</label>
                                                <input type="text" name="url" class="form-control" id="slider-link"
                                                    placeholder="Enter Link" value="{{ $brand->url }}">
                                                @error('url')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> --}}
                                            <div class="form-group">
                                                <label for="title">SEO URL *</label>
                                                <input type="text" name="meta_url" class="form-control" id="urls"
                                                    placeholder="Enter Meta Link" value="{{ $brand->meta_url }}">
                                                @error('meta_url')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_description">Meta Description
                                                </label>
                                                <textarea name="meta_description" id="meta_description" class="form-control" rows="5"
                                                    placeholder="Enter Meta Description">{{ $brand->meta_description }}</textarea>
                                                @error('meta_description')
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
