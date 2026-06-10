@extends('layouts.admin')
@section('title')
    Page Content Management
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Update Page Content Management</b> </h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.pages') }}"><i
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

                                        <form class="admin-form" action="{{ route('admin.pages.update', $page->id) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-group">
                                                <label for="name">Title *</label>
                                                <input type="text" name="title" class="form-control item-name"
                                                    id="title" placeholder="Enter Title" value="{{ $page->title }}">
                                                @error('title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_description">Description *
                                                </label>
                                                <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter Description">{{ $page->description }}</textarea>
                                                @error('description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_title">Meta Title *</label>
                                                <input type="text" name="meta_title" class="form-control" id="meta_title"
                                                    placeholder="Enter Meta Title" value="{{ $page->meta_title }}">
                                                @error('meta_title')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_keywords">Meta Keywords *</label>
                                                <input type="text" name="meta_keywords" class="tags" id="meta_keywords"
                                                    placeholder="Enter Meta Keywords" value="{{ $page->meta_keywords }}">
                                                @error('meta_keywords')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="title">SEO URL *</label>
                                                <input type="text" name="meta_url" class="form-control" id="urls"
                                                    placeholder="Enter Meta Link" value="{{ $page->meta_url }}">
                                                @error('meta_url')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="meta_description">Meta Description *</label>
                                                <textarea name="meta_description" id="meta_description" class="form-control" rows="5"
                                                    placeholder="Enter Meta Description">{{ $page->meta_description }}</textarea>
                                                @error('meta_description')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="type" class="form-label">Page Type</label>
                                                <input type="text" class="form-control" value="{{ $page->type }}"
                                                    disabled>
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
