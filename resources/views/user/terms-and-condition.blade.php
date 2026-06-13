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
                Terms and Conditions
            </p>
            <h2 class="mb-0">
                Terms and Conditions
            </h2>
        </div>
        <!-- </div> -->
    </div>

    <section id="aboutUs">
        <div class="container mt-4">

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
                    <h6>Quality Material</h6>
                    <p>
                        The best materials make for the best job. It’s that simple. Every sign is 100% weatherproof &
                        resistant so they’re as durable as they are brilliantly designed.
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/Help&Support.svg') }}" alt="Help and Support" loading="lazy">
                    <h6>Help and Support</h6>
                    <p>
                        We’re all about happy customers. If you need help purchasing your sign please contact us during
                        office hours on 01795 505850, or why not try our live chat.
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/Quick&Install.svg') }}" alt="Quick & easy to install" loading="lazy">
                    <h6>Quick & easy to install</h6>
                    <p>
                        The best materials make for the best job. It’s that simple. Every sign is 100% weatherproof &
                        resistant so they’re as durable as they are brilliantly designed.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id="customer_photo">
        <div class="container my-lg-5 my-3">
            <div class="line_heading mb-4">
                <h3>Customer Photos</h3>
                <div class="green_line"></div>
            </div>
            <img src="{{ optional($footer_value)->image1 ? \App\Helpers\FileUploadHelper::url($footer_value->image1) : asset('assets/images/CustomerPhotos.png') }}"
                alt="Customer Photos" />
        </div>
    </div>
@endsection
