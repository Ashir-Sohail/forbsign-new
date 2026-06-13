@extends('layouts.app')
@section('title')
    Blogs
@endsection
@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp
    <div class="page_banner">
        <div class="container d-flex justify-content-center flex-column gap-3 h-100">
            <p class="m-0">
                What we do?
            </p>
            <h2 class="mb-0">
                Blogs
            </h2>
        </div>
    </div>

    <section id="blogs">
        <div class="container">
            <h2 class="heading_72 text-center my-4">
                Blogs
            </h2>
            <p class="heading_30 text-center mb-4">
                Crafting personalized signs for homes and businesses, adding character to every space with bespoke
                designs and quality craftsmanship.
            </p>
            @if ($blogs->count() > 0)
                <div class="row my-4 mx-0">
                    @foreach ($blogs as $blog)
                        <div class="col-sm-6 col-md-4  service p-sm-0">
                            <a href="{{ route('user.blog_details', ['id' => $blog->id]) }}">
                                <img src="{{ \App\Helpers\FileUploadHelper::url($blog->image) }}" alt="{{ $blog->name }}"
                                    alt="Custom Favorite" loading="lazy">
                                <div class="bg-gr">
                                    <h6>{{ Str::limit($blog->title, 50, '..') }}</h6>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card-body">
                    <div class="alert alert-info text-center mt-5">
                        <strong>Sorry!</strong> No Blogs Found.
                    </div>
                </div>
            @endif

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
