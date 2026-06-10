@extends('layouts.app')
@section('title')
    Category-by-products
@endsection
@section('title', $category->meta_title ?? $category->name)
@php
    $keywords = collect(json_decode($category->meta_keyword))
        ->pluck('value')
        ->implode(', ');
@endphp
@section('meta_keywords', $keywords)
@section('meta_description', $category->meta_description ?? '')
@section('canonical_url', url()->current())
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
                Products by this Category
            </h2>
        </div>
    </div>

    <div class="container">
        <div class="row">
            @if ($products->isNotEmpty())
                @foreach ($products as $product)
                    <div class="col-sm-6 col-md-3 mt-4">
                        <div class="pro_con store p-1 border-0">
                            <img src="{{ Storage::disk('s3')->url($product->featured_image) }}" alt="Custom Favorite"
                                loading="lazy">
                            <div class="d-flex flex-column gap-1">
                                <h4 class="title m-0">
                                    {{ \Illuminate\Support\Str::substr($product->name, 0, 30) }}
                                </h4>
                                {{-- @dump($product->categories->name) --}}
                                <span class="met">{{ $product->categories->name }}</span>
                                <p class="price m-0">
                                    @if ($product->previous_price > 0)
                                        <del>{{ config('app.currency.symbol') }}
                                            {{ $product->previous_price }}</del>
                                    @endif
                                    {{ config('app.currency.symbol') }}{{ $product->current_price }}
                                </p>
                            </div>
                            <div class="store_details">
                                <button class="detail_btn">
                                    <a href="{{ route('user.product_details', ['slug' => $product->slug]) }}">
                                        Details
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach <!-- End of products loop -->
            @else
                <div class="col-12">
                    <div class="alert alert-info text-center my-5">
                        No products found related to this Category.
                    </div>
                </div>
            @endif
        </div>
    </div>

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
            <img src="{{ optional($footer_value)->image1 ? Storage::disk('s3')->url($footer_value->image1) : asset('assets/images/CustomerPhotos.png') }}"
                alt="Customer Photos" />
        </div>
    </div>
@endsection
