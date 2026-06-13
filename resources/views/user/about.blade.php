@extends('layouts.app')
@section('title', $page->meta_title ?? $page->title)
@php
    $keywords = collect(json_decode($page->meta_keywords))
        ->pluck('value')
        ->implode(', ');
@endphp
@section('meta_keywords', $keywords)
@section('meta_description', $page->meta_description ?? '')
@section('canonical_url', $page->meta_url ?? url()->current())
@section('content')
    <div class="page_banner">
        <!-- <div class=" d-flex justify-content-center h-100"> -->
        <div class="container d-flex justify-content-center flex-column gap-3 h-100">
            <p class="m-0">
                {{ $aboutpreferences['about_title'] ?? '' }}
            </p>
            <h2 class="mb-0">
                {{ $aboutpreferences['about_heading'] ?? '' }}
            </h2>
        </div>
        <!-- </div> -->
    </div>
    <section id="aboutUs">
        <div class="container">
            <h2 class="heading_72 text-center my-4">
                {{ $page->title }}
            </h2>

            <p class="description">
                {{ $page->description }}
            </p>
        </div>
    </section>

    <div id="qualityhelpinstall" class="my-5" style=" background-image: url({{ asset('media/image8.jpg') }});">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/QualityMaterial.svg') }}" alt="" loading="lazy">
                    <h6>{{ $aboutpreferences['information_heading1'] ?? '' }}</h6>
                    <p>
                    {{ $aboutpreferences['information_description1'] ?? '' }}
                </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/Help&Support.svg') }}" alt="Help and Support" loading="lazy">
                    <h6>{{ $aboutpreferences['information_heading2'] ?? '' }}</h6>
                    <p>
                       {{ $aboutpreferences['information_description2'] ?? '' }}
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/Quick&Install.svg') }}" alt="Quick & easy to install" loading="lazy">
                    <h6>{{ $aboutpreferences['information_heading3'] ?? '' }}</h6>
                    <p>
                        {{ $aboutpreferences['information_Description3'] ?? '' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id="customer_photo">
        <div class="container my-lg-5 my-3">
            <div class="line_heading mb-4">
                <h3>{{ $aboutpreferences['customer_heading'] ?? '' }}</h3>
                <div class="green_line"></div>
            </div>
            <img src="{{ optional($footer_value)->image1 ? \App\Helpers\FileUploadHelper::url($footer_value->image1) : asset('assets/images/CustomerPhotos.png') }}"
                alt="Customer Photos" />
        </div>
    </div>
@endsection
