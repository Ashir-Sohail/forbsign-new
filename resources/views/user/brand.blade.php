@extends('layouts.app')
@section('title')
    Brand
@endsection
@section('content')
    <div class="page_banner">
        <div class="container d-flex justify-content-center flex-column gap-3 h-100">
            <p class="m-0">
                {{ $brandspreferences['brand_title'] ?? '' }}
            </p>
            <h2 class="mb-0">
                {{ $brandspreferences['brand_heading'] ?? '' }}
            </h2>
        </div>
    </div>

    <div class="container py-5">
        <h2 class="heading_72 text-center my-4">
            Brands
        </h2>
        <div class="row g-3">
            @foreach ($brands as $brand)
                {{-- <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-4 col-6"> --}}
                <div class="col-12 col-sm-6 col-md-3">

                    <a class="brand-items" href="{{ route('user.brand.product', ['slug' => $brand->slug]) }}">
                        <img class="img-fluid" src="{{ Storage::disk('s3')->url($brand->image) }}" alt="{{ $brand->name }}"
                            title="Adidas">
                        <h5 class="header30_gray">{{ $brand->name }}</h5>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <div id="qualityhelpinstall" class="my-5" style=" background-image: url({{ asset('media/image8.jpg') }});">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/QualityMaterial.svg') }}" alt="" loading="lazy">
                    <h6>{{ $brandspreferences['information_heading1'] ?? '' }}</h6>
                    <p>
                        {{ $brandspreferences['information_description1'] ?? '' }}
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/Help&Support.svg') }}" alt="Help and Support" loading="lazy">
                    <h6>{{ $brandspreferences['information_heading2'] ?? '' }}</h6>
                    <p>
                        {{ $brandspreferences['information_description2'] ?? '' }}
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/Quick&Install.svg') }}" alt="Quick & easy to install" loading="lazy">
                    <h6>{{ $brandspreferences['information_heading3'] ?? '' }}</h6>
                    <p>
                        {{ $brandspreferences['information_Description3'] ?? '' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id="customer_photo">
        <div class="container my-lg-5 my-3">
            <div class="line_heading mb-4">
                <h3>{{ $brandspreferences['customer_heading'] ?? '' }}</h3>
                <div class="green_line"></div>
            </div>
            <img src="{{ optional($footer_value)->image1 ? Storage::disk('s3')->url($footer_value->image1) : asset('assets/images/CustomerPhotos.png') }}"
                alt="Customer Photos" />
        </div>
    </div>
@endsection
