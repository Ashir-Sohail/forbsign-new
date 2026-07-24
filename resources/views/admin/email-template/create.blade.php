@extends('layouts.admin')

@section('title')
    Email Create
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Email Client</b></h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.email.index') }}">
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
                                        <form action="{{ route('admin.email.store') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <!-- Title -->
                                            <div class="form-group">
                                                <label for="title">Title <span class="req-star">*</span></label>
                                                <input type="text" name="title" class="form-control" id="title"
                                                    value="{{ old('title') }}" placeholder="Enter title">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Body (CKEditor) -->
                                            <div class="form-group">
                                                <label for="body">Body <span class="req-star">*</span></label>
                                                <textarea name="body" class="form-control" id="body" rows="5" placeholder="Enter content">{{ old('body') }}</textarea>
                                                @error('body')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

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
@section('scripts')
    <script type="text/javascript">
        CKEDITOR.config.autoParagraph = false;
        CKEDITOR.config.allowedContent = true;
        CKEDITOR.config.extraAllowedContent = '*[style](*)'; // Fixed this line
        CKEDITOR.config.ignoreEmptyParagraph = false;
        CKEDITOR.config.fullPage = false;
        CKEDITOR.replace('body');
    </script>
@endsection
