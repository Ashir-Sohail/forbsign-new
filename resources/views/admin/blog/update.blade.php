@extends('layouts.admin')
@section('title')
    Update Blog
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class=" mb-0 bc-title"><b>Update Blog</b> </h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.blog.index') }}"><i
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
                                            action="{{ route('admin.blog.update', ['id' => $blog->id]) }}" method="POST"
                                            enctype="multipart/form-data">

                                            @csrf

                                            <div class="form-group">
                                                <label for="name">Set Image <span class="req-star">*</span></label>
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
                                                <label for="title">Title <span class="req-star">*</span></label>
                                                <input type="text" name="title" class="form-control" id="title"
                                                    placeholder="Enter Title" value="{{ $blog->title }}">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>



                                            <div class="form-group">
                                                <label for="details">Details <span class="req-star">*</span></label>
                                                <textarea name="description" id="details" class="form-control" rows="10" placeholder="Enter Details">{{ $blog->description }}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_title">Meta Title <span class="req-star">*</span>
                                                </label>
                                                <input type="text" name="meta_title" class="form-control" id="meta_title"
                                                    placeholder="Enter Meta Title" value="{{ $blog->meta_title }}">
                                                @error('meta_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            <div class="form-group">
                                                <label for="meta_keywords">Meta Keywords <span class="req-star">*</span>
                                                </label>
                                                <input type="text" name="meta_keywords" class="tags" id="meta_keywords"
                                                    placeholder="Enter Meta Keywords" value="{{ $blog->meta_keyword }}">
                                                @error('meta_keywords')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="title">SEO URL <span class="req-star">*</span></label>
                                                <input type="text" name="meta_url" class="form-control" id="urls"
                                                    placeholder="Enter Meta Link" value="{{ $blog->meta_url }}">
                                                @error('meta_url')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_description">Meta Description <span class="req-star">*</span>
                                                </label>
                                                <textarea name="meta_description" id="meta_description" class="form-control" rows="5"
                                                    placeholder="Enter Meta Description">{{ $blog->meta_description }}</textarea>
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

@section('scripts')
    <script type="text/javascript">
        CKEDITOR.config.versionCheck = false;
        CKEDITOR.config.autoParagraph = false;
        CKEDITOR.config.allowedContent = true;
        CKEDITOR.config.extraAllowedContent = '*[style](*)';
        CKEDITOR.config.ignoreEmptyParagraph = false;
        CKEDITOR.config.fullPage = false;
        CKEDITOR.replace('details');
    </script>
@endsection
