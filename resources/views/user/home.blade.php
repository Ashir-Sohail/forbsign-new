@extends('layouts.app')
@php
    use Illuminate\Support\Str;
    $imagePlaceholder = asset('assets/imgs/placeholder.png');
@endphp
@section('title')
    Home
@endsection
@section('content')


    <div id="fs-container" class="mb-5">
        <div id="fs-top" class="h-100">
            <div class="owl-carousel h-100" id="home-banner">
                @foreach ($sliders as $slider)
                    @php
                        $hash = preg_replace('/[^A-Za-z0-9]/', '', strtolower($slider->title));
                    @endphp
                    <div class="item" data-hash="{{ $hash }}">
                        @php
                            $sliderImage = \App\Helpers\FileUploadHelper::url($slider->image);
                            $sliderBg = $sliderImage ?: asset('assets/front/imgs/HomeSigns.svg');
                        @endphp
                        <div class="slider-wrapper"
                            style="background-image: url('{{ $sliderBg }}')">
                            <div class="slider-text">
                                <p>{{ $slider->title }}</p>
                                <h2>{{ $slider->details }}</h2>
                                <a href="{{ $slider->url }}" class="btn white-btn" target="_blank">View Collection</a>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <div id="fs-nav">
            <div class="nav-service">
                <h6>{{ $homepreferences['general_heading'] ?? '' }}</h6>
                <p>
                    {{ $homepreferences['general_description'] ?? '' }}
                </p>
            </div>
            @foreach ($services as $index => $service)
                @php
                    $hash = preg_replace('/[^A-Za-z0-9]/', '', strtolower($service->title));
                @endphp
                <a class="nav-option {{ $index === 0 ? 'active' : '' }}" href="#{{ $hash }}"
                    data-service-index="{{ $index }}">
                    <img src="{{ \App\Helpers\FileUploadHelper::url($service->image) ?? $imagePlaceholder }}"
                        alt="{{ $service->title }}" loading="lazy">
                    <h6>{{ $service->title }}</h6>
                </a>
            @endforeach

        </div>
    </div>



    <div class="container" id="about">
        <div class="row justify-content-center gy-5">
            <div class="col-lg-10 ">
                <div class="about_con left_img">
                    <div class="img_con">
                        <img src="{{ optional($home_page_value)->image1 ? \App\Helpers\FileUploadHelper::url($home_page_value->image1) : $imagePlaceholder }}"
                            alt="{{ $home_page_value->title1 ?? 'YOUR DESIGN' }}" loading="lazy">
                    </div>
                    <div class="img_text ">
                        <p>{{ $home_page_value->title1 ?? 'N/A' }}</p>
                        <h4>
                            {{ $home_page_value->sub_title1 ?? 'N/A' }}

                        </h4>
                        <div class="d-inline-block">
                            <a class="btn primary_btn" href="{{ $home_page_value->url1 ?? '#' }}" target="_blank">
                                {{ $homepreferences['image_one_button'] ?? 'Learn More' }}
                            </a>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="about_con right_img">
                    <div class="img_text ">
                        <p>{{ $home_page_value->title2 ?? 'N/A' }}</p>
                        <h4>
                            {{ $home_page_value->sub_title2 ?? 'N/A' }}

                        </h4>
                        <div class="d-inline-block">
                            <a class="btn primary_btn" href="{{ $home_page_value->url2 ?? '#' }}" target="_blank">
                                {{ $homepreferences['image_two_button'] ?? 'Learn More' }}
                            </a>
                        </div>
                    </div>
                    <div class="img_con">

                        <img src="{{ optional($home_page_value)->image2 ? \App\Helpers\FileUploadHelper::url($home_page_value->image2) : $imagePlaceholder }}"
                            alt="{{ $home_page_value->title2 ?? 'YOUR DESIGN' }}" loading="lazy">
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="bg-green d-flex justify-content-center align-items-center py-4">
        <div class="container">
            <div class="row justify-content-center align-items-center gy-4">
                <div class="icon_text col-sm-6 col-lg-3 col">
                    <img src="{{ asset('media/icon1.svg') }}" alt="" loading="lazy">
                    <div class="d-flex flex-column">
                        <p> {{ $homepreferences['title1'] ?? '' }}</p>
                        <p>{{ $homepreferences['title2'] ?? '' }}</p>
                        <p>{{ $homepreferences['title3'] ?? '' }}</p>
                    </div>
                </div>
                <div class="icon_text col-sm-6 col-lg-3 col">
                    <img src="{{ asset('media/icon1.svg') }}" alt="" loading="lazy">
                    <div class="d-flex flex-column">
                        <p>{{ $homepreferences['scond_title1'] ?? '' }}</p>
                        <p>{{ $homepreferences['scond_title2'] ?? '' }}</p>
                        <p>{{ $homepreferences['scond_title3'] ?? '' }}</p>
                    </div>
                </div>
                <div class="icon_text col-sm-6 col-lg-3 col">
                    <img src="{{ asset('media/icon2.svg') }}" alt="" loading="lazy">
                    <div class="d-flex flex-column">
                        <p>{{ $homepreferences['third_title1'] ?? '' }}</p>
                        <p>{{ $homepreferences['third_title2'] ?? '' }}</p>
                        <p>{{ $homepreferences['third_title3'] ?? '' }}</p>
                    </div>
                </div>
                <div class="icon_text col-sm-6 col-lg-3 col">
                    <img src="{{ asset('media/scurea&save.svg') }}" alt="" loading="lazy">
                    <div class="d-flex flex-column">
                        <p>{{ $homepreferences['fourth_title1'] ?? '' }}</p>
                        <p>{{ $homepreferences['fourth_title2'] ?? '' }}</p>
                        <p>{{ $homepreferences['fourth_title3'] ?? '' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row my-5 py-md-3">
            <div class="col-md-6">
                <h2 class="heading_48 m-md-0">
                    {{ $homepreferences['craft_heading1'] ?? '' }}
                </h2>
                <div class="text-right col-12 ms-auto text-md-end">
                    <img src="{{ asset('assets/imgs/section.jpg') }}" alt="Handcrafted" loading="lazy"
                        style="max-width: 250px;">
                </div>
            </div>
            <div class="col-md-6">
                <h5 class="header30_gray mb-5 mt-2">
                    {{ $homepreferences['craft_heading2'] ?? '' }}
                </h5>
                <p class="description m-0 mt-lg-5">
                    {{ $homepreferences['craft_description'] ?? '' }}
                </p>
            </div>
        </div>
    </div>
    <div id="customer_fav">
        <div class="container my-lg-5 my-3">
            <div class="line_heading mb-4">
                <h3>{{ $homepreferences['customer_favorite_heading'] ?? '' }}</h3>
                <div class="green_line"></div>
            </div>

            <!-- Tab Navigation -->
            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                @foreach ($categories as $index => $category)
                    <button class="nav-link {{ $index === 0 ? 'active' : '' }}" id="tab-{{ $category->id }}"
                        data-bs-toggle="tab" data-bs-target="#tab-content-{{ $category->id }}" type="button"
                        role="tab">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>


            <div class="tab-content" id="nav-tabContent">
                @foreach ($categories as $index => $category)
                    @php
                        // Include current category and its children
                        $catIds = collect($category->children)->pluck('id')->push($category->id);
                        $catProducts = $products->whereIn('cat_id', $catIds);
                    @endphp

                    <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}"
                        id="tab-content-{{ $category->id }}" role="tabpanel">

                        @if ($catProducts->isNotEmpty())
                            <div class="row gy-4">
                                @foreach ($catProducts as $product)
                                    {{-- @dump($catProducts->toArray()) --}}
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="pro_con">
                                            <img src="{{ \App\Helpers\FileUploadHelper::url($product->featured_image) ?? $imagePlaceholder }}"
                                                alt="{{ $product->name ?? 'Product Image' }}" loading="lazy">
                                            <div class="d-flex flex-column gap-1">

                                                <a href="{{ route('user.product_details', ['slug' => $product->slug]) }}">
                                                    <span class="cat">{{ $category->name ?? 'N\A' }}</span>
                                                    <h4 class="title m-0">
                                                        {{ Str::substr($product->name, 0, 15) }}
                                                    </h4>
                                                </a>

                                                <p class="price m-0">
                                                    {{ config('app.currency.symbol') }}{{ $product->current_price }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>No products available in this category.</p>
                        @endif
                    </div>
                @endforeach
            </div>

            @if ($products->count() > 0)
                <div class="text-center">
                    <a class="btn primary_btn mx-auto px-5" href="{{ route('user.store') }}">
                        {{ $homepreferences['visit_store'] ?? 'Visit Store' }}
                    </a>
                </div>
            @endif




            <section id="brands_logos" class="my-5">
                <h2 class="heading_72 text-center mb-4">
                    {{ $homepreferences['categories_heading'] ?? '' }}
                </h2>
                @if ($allActiveCategories->isNotEmpty())
                    <div class="row my-4">
                        @foreach ($allActiveCategories as $allActiveCategorie)
                            <div class="col-6 col-md-3 text-center">
                                <a class="brand-items"
                                    href="{{ route('category.products', ['slug' => $allActiveCategorie->slug]) }}">
                                    <img src="{{ \App\Helpers\FileUploadHelper::url($allActiveCategorie->image) ?? $imagePlaceholder }}"
                                        alt="{{ $allActiveCategorie->name }}" loading="lazy">

                                    <h6 class="heading-30">{{ $allActiveCategorie->name }}</h6>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if ($allActiveCategories->isNotEmpty())
                    <div class="text-center">
                        <a class="btn primary_btn mx-auto py-2 d-inline-block" href="{{ route('user.categories') }}">
                             {{ $homepreferences['categories_button'] ?? 'View Categories' }}
                        </a>
                    </div>
                @endif
            </section>

            <section id="brands_logos" class="my-5">
                <h2 class="heading_72 text-center mb-4">
                     {{ $homepreferences['brands_heading'] ?? '' }}
                </h2>
                @if ($brands->isNotEmpty())
                    <div class="row my-4 gy-4">
                        @foreach ($brands as $brand)
                            <div class="col-6 col-md-3 text-center">
                                <a class="brand-items"
                                    href="{{ route('user.brand.product', ['slug' => $brand->slug]) }}">
                                    <img src="{{ \App\Helpers\FileUploadHelper::url($brand->image) ?? $imagePlaceholder }}"
                                        alt="{{ $brand->name }}"
                                        loading="lazy">

                                    <h6 class="heading-30">{{ $brand->name }}</h6>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @endif
                @if ($brands->isNotEmpty())
                    <div class="text-center">
                        <a class="btn primary_btn mx-auto py-2 d-inline-block" href="{{ route('user.brand') }}">
                             {{ $homepreferences['brands_button'] ?? 'View Brands' }}
                        </a>
                    </div>
                @endif
            </section>

        </div>
    </div>
    <div id="qualityhelpinstall" class="my-5">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/QualityMaterial.svg') }}" alt="" loading="lazy">
                    <h6> {{ $homepreferences['information_heading1'] ?? '' }}</h6>
                    <p>
                     {{ $homepreferences['information_description1'] ?? '' }} 
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/Help&Support.svg') }}" alt="Help and Support" loading="lazy">
                    <h6>{{ $homepreferences['information_heading2'] ?? '' }}</h6>
                    <p>
                        {{ $homepreferences['information_description2'] ?? '' }}
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/Quick&Install.svg') }}" alt="Quick & easy to install" loading="lazy">
                    <h6> {{ $homepreferences['information_heading3'] ?? '' }}</h6>
                    <p>
                        {{ $homepreferences['information_Description3'] ?? '' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id="customer_photo">
        <div class="container my-lg-5 my-3">
            <div class="line_heading mb-4">
                <h3>{{ $homepreferences['customer_heading'] ?? '' }}</h3>
                <div class="green_line"></div>
            </div>
             <img src="{{ optional($footer_value)->image1 ? \App\Helpers\FileUploadHelper::url($footer_value->image1) : asset('assets/images/CustomerPhotos.png') }}"
                alt="Customer Photos" />
        </div>
    </div>
@endsection
