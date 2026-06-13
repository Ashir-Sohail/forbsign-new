@extends('layouts.app')
@section('title')
    Services
@endsection
@section('content')
    <div class="page_banner">
        <!-- <div class=" d-flex justify-content-center h-100"> -->
        <div class="container d-flex justify-content-center flex-column gap-3 h-100">
            <p class="m-0">
                {{ $servicepreferences['service_title'] ?? '' }}
            </p>
            <h2 class="mb-0">
                {{ $servicepreferences['service_heading'] ?? '' }}
            </h2>
        </div>
        <!-- </div> -->
    </div>


    <section id="aboutUs">
        <div class="container">
            <div class="col-lg-10 mx-auto">
                <h2 class="heading_72 text-center my-4">
                    {{ $servicepreferences['body_heading'] ?? '' }}
                </h2>
                <p class="heading_30 text-center mb-4">
                   {{ $servicepreferences['body_description'] ?? '' }}
                </p>

                <div class="row my-4 mx-0">
                    @if ($services->isNotEmpty())
                        @foreach ($services as $service)
                            <div class="col-sm-6 col-md-4 service p-sm-0">
                                <img src="{{ \App\Helpers\FileUploadHelper::url($service->image) }}" alt="{{ $service->title }}"
                                    loading="lazy">

                                <div class="bg-gr">
                                    <h6>{{ $service->title }}</h6>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center">
                            <p class="alert alert-info text-center mt-5">No services available.</p>
                        </div>
                    @endif
                </div>

            </div>

        </div>
    </section>

    <div id="qualityhelpinstall" class="my-5" style=" background-image: url({{ asset('media/image8.jpg') }});">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/QualityMaterial.svg') }}" alt="" loading="lazy">
                    <h6>{{ $servicepreferences['information_heading1'] ?? '' }}</h6>
                    <p>
                        {{ $servicepreferences['information_description1'] ?? '' }}
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/Help&Support.svg') }}" alt="Help and Support" loading="lazy">
                    <h6>{{ $servicepreferences['information_heading2'] ?? '' }}</h6>
                    <p>
                        {{ $servicepreferences['information_description2'] ?? '' }}
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/Quick&Install.svg') }}" alt="Quick & easy to install" loading="lazy">
                    <h6>{{ $servicepreferences['information_heading3'] ?? '' }}</h6>
                    <p>
                        {{ $servicepreferences['information_Description3'] ?? '' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id="customer_photo">
        <div class="container my-lg-5 my-3">
            <div class="line_heading mb-4">
                <h3>{{ $servicepreferences['customer_heading'] ?? '' }}</h3>
                <div class="green_line"></div>
            </div>
              <img src="{{ optional($footer_value)->image1 ? \App\Helpers\FileUploadHelper::url($footer_value->image1) : asset('assets/images/CustomerPhotos.png') }}"
                alt="Customer Photos" />
        </div>
    </div>
@endsection
