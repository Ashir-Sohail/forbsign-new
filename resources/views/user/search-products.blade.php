@extends('layouts.app')
@section('title')
    Search Results for "{{ $query }}"
@endsection
@section('content')
    <div class="page_banner">
        <div class="container d-flex justify-content-center flex-column gap-3 h-100">
            <p class="m-0">You searched for:</p>
            <span class="mb-0">"{{ $query }}"</span>

        </div>
    </div>

    <div class="container my-4">
        @if ($products->isNotEmpty())
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="pro_con my-4">
                                  <img src="{{\App\Helpers\FileUploadHelper::url($product->featured_image)}}" alt="Product Image"
                                loading="lazy">
                            <div class="d-flex flex-column gap-1">
                                <a href="{{ route('user.product_details', ['slug' => $product->slug]) }}">
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
            <div class="card-body my-4 text-center">
                <p class="alert alert-danger">No products found for "{{ $query }}".</p>
            </div>
        @endif
    </div>


    <!-- footer -->
    <div id="qualityhelpinstall" class="store_footer_top">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="qhi col-md-4">
                    <img src="{{ asset('assets/imgs/QualityMaterial.svg') }}" alt="" loading="lazy">
                    <h6>Quality Material</h6>
                    <p>
                        The best materials make for the best job. It’s that simple. Every sign is 100% weatherproof
                        &amp;
                        resistant so they’re as durable as they are brilliantly designed.
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('assets/imgs/Help&Support.svg') }}" alt="Help and Support" loading="lazy">
                    <h6>Help and Support</h6>
                    <p>
                        We’re all about happy customers. If you need help purchasing your sign please contact us during
                        office hours on 01795 505850, or why not try our&nbsp;live chat.
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('assets/imgs/Quick&Install.svg') }}" alt="Quick &amp; easy to install"
                        loading="lazy">
                    <h6>Quick &amp; easy to install</h6>
                    <p>
                        The best materials make for the best job. It’s that simple. Every sign is 100% weatherproof
                        &amp;
                        resistant so they’re as durable as they are brilliantly designed.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
