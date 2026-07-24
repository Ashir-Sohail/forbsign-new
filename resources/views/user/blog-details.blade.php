@extends('layouts.app')

{{-- SEO Sections --}}
@section('title', $blog->meta_title ?? $blog->title)
@section('meta_description', $blog->meta_description ?? '')
@php
    $keywords = collect(json_decode($blog->meta_keyword))
        ->pluck('value')
        ->implode(', ');
@endphp
@section('meta_keywords', $keywords)
@section('canonical_url', route('user.blog_details', $blog->meta_url ?? $blog->id))

@section('content')
    <div class="container my-4">
        <img src="{{ \App\Helpers\FileUploadHelper::url($blog->image) }}" alt="{{ $blog->name }}" class="rounded-4 img-fluid" style="max-height: 600px">
    </div>
    <section id="aboutUs">
        <div class="container">
            <h2 class="heading_72 text-center my-4">
                {{ $blog->title }}
            </h2>
            <p class="description">
                {!! $blog->description !!}
            </p>
        </div>
    </section>
    <div id="qualityhelpinstall" class="my-5">
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
            <img src="{{ \App\Helpers\FileUploadHelper::url($footer_value->image1) }}" alt="Customer Photos" />
        </div>
    </div>
@endsection
