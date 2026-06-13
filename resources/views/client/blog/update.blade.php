@extends('layouts.admin_two')
@section('title')
    Update Blog
@endsection
@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    <div class="content">
        <div class="page-inner">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class=" mb-0 bc-title"><b>Update Blog</b> </h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('client.blog.index') }}"><i
                                    class="fas fa-chevron-left"></i> Back</a>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12">

                        <div class="card o-hidden border-0 shadow-lg">
                            <div class="card-body ">
                                <!-- Nested Row within Card Body -->
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <form class="admin-form"
                                            action="{{ route('client.blog.update', ['id' => $blog->id]) }}" method="POST"
                                            enctype="multipart/form-data">

                                            @csrf

                                            <div class="form-group">
                                                <label for="name">Set Image *</label>
                                                <br>
                                                <img class="admin-img"
                                                    src="{{ \App\Helpers\FileUploadHelper::url($blog->image) ?? asset('public/assets/images/placeholder.png') }}"
                                                    alt="{{ $blog->title ?? 'Blog Image' }}">
                                                <br>
                                                <span class="mt-1">Image Size Should Be 708 x 277.</span>
                                            </div>

                                            <div class="form-group position-relative ">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo"
                                                        name="image" multiple id="file"
                                                        aria-label="File browser example">
                                                    <span class="file-custom text-left">Upload Image...</span>
                                                </label>
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="title">Title *</label>
                                                <input type="text" name="title" class="form-control" id="title"
                                                    placeholder="Enter Title" value="{{ $blog->title }}">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>



                                            <div class="form-group">
                                                <label for="details">Details *</label>
                                                <textarea name="description" id="details" class="form-control text-editor" rows="5" placeholder="Enter Details">{{ $blog->description }}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_title">Meta Title *
                                                </label>
                                                <input type="text" name="meta_title" class="form-control" id="meta_title"
                                                    placeholder="Enter Meta Title" value="{{ $blog->meta_title }}">
                                                @error('meta_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="meta_keywords">Meta Keywords *
                                                </label>
                                                <input type="text" name="meta_keywords" class="tags" id="meta_keywords"
                                                    placeholder="Enter Meta Keywords" value="{{ $blog->meta_keyword }}">
                                                @error('meta_keywords')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="title">SEO URL *</label>
                                                <input type="text" name="meta_url" class="form-control" id="urls"
                                                    placeholder="Enter Meta Link" value="{{ $blog->meta_url }}">
                                                @error('meta_url')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_description">Meta Description *
                                                </label>
                                                <textarea name="meta_description" id="meta_description" class="form-control" rows="5"
                                                    placeholder="Enter Meta Description">{{ $blog->meta_description }}</textarea>
                                                @error('meta_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="website_id">Select Website*</label>
                                                <select name="website_id" id="website_id" class="form-control">
                                                    <option value="">-- Select Website --</option>
                                                    @foreach ($website as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ old('website_id', $blog->website_id) == $item->id ? 'selected' : '' }}>
                                                            {{ $item->domain_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('website_id')
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

<script>
    ClassicEditor
        .create(document.querySelector('#details'), {
            // Add image upload configuration
            ckfinder: {
                uploadUrl: '{{ route('admin.blog.uploadImage') . '?_token=' . csrf_token() }}',
            },
        })
        .then(editor => {
            console.log(editor);
        })
        .catch(error => {
            console.error(error);
        });
</script>
