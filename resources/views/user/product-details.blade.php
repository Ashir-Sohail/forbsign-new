@extends('layouts.app')

@section('title', $product->meta_title ?? $product->name)
@php
    $keywords = collect(json_decode($product->meta_keyword))
        ->pluck('value')
        ->implode(', ');
@endphp
@section('meta_keywords', $keywords)
@section('meta_description', $product->meta_description ?? '')
@section('canonical_url', url()->current())

@section('content')
    <style>
        .image-preview-box {
            position: relative;
            width: 100%;
            height: 400px;
            overflow: hidden;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .image-preview-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .overlay-text {
            width: 100%;
            display: block;
            position: absolute;
            top: 0;
            font-size: clamp(18px, calc(0.75rem + 1vw), 30px);
            font-weight: bold;
            color: #000;
            text-align: left;
            white-space: nowrap;
            padding: 1.5rem 2rem;
            text-wrap: wrap;
            word-wrap: break-word;
            pointer-events: none;
        }
    </style>
    {{-- <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li><a href="{{route('user.home')}}">Home</a>
                        </li>
                        <li class="separator"></li>
                        <li><a href="{{route('user.store')}}">Shop</a>
                        </li>
                        <li class="separator"></li>
                        <li>{{ $product->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}

    <section id="pro_detail" class="my-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5">
                    <ul class="nav nav-tabs text-start mb-1" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Preview</button>
                        </li>
                    </ul>

                    <div class="tab-content p-0" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <div class="pro_img">
                                <img src="{{ \App\Helpers\FileUploadHelper::url($product->featured_image) }}" alt="Product Image"
                                    loading="lazy">

                            </div>
                            @if (!empty($product->images))
                                @php
                                    // Decode JSON string to array
                                    $imageArray = json_decode($product->images, true);
                                @endphp

                                <div class="owl-carousel my-3" id="proimg_slider">

                                    @foreach ($imageArray as $image)
                                        <div class="item">
                                            <img src="{{ \App\Helpers\FileUploadHelper::url($image) }}" alt="product image"
                                                loading="lazy">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="image-preview-box">
                                <img id="selectedImage" src="{{ \App\Helpers\FileUploadHelper::url($product->featured_image) }}"
                                    alt="Preview">
                                <div id="overlayText" class="overlay-text">
                                    <div id="overlaycontent" class="w-100">

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="accordion mt-5">
                        <div class="accordion-item border-0">
                            <h2 class="accordion-button border-0 rounded-0 bg-white p-0" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne">
                                Product Details
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show"
                                aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body px-0 py-2">
                                    <p>{{ $product->description }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0">
                            <h2 class="accordion-button border-0 rounded-0 bg-white p-0" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapse2">
                                Key Features
                            </h2>
                            <div id="panelsStayOpen-collapse2" class="accordion-collapse collapse show"
                                aria-labelledby="panelsStayOpen-heading2">
                                <div class="accordion-body px-0 py-2">
                                    <p>{{ $product->short_description }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0">
                            <h2 class="accordion-button collapsed border-0 rounded-0 bg-white p-0" data-bs-toggle="collapse"
                                aria-expanded="false" data-bs-target="#panelsStayOpen-collapse3">
                                Assembly Instructions
                            </h2>
                            <div id="panelsStayOpen-collapse3" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headi2">
                                <div class="accordion-body px-0 py-2">
                                    <p>
                                        Please note: Due to the natural edged slate, the design and drill
                                        holes may be misaligned by a few millimetres due to the edges not being
                                        completely square. For our deep-engraved slate house signs, the presence of
                                        pyrite may create subtle bumps, rendering a distinctively natural and textured
                                        rather than a completely smooth finish.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="pro_filters">
                        <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                        <h4>{{ $product->name }}</h4>
                        <p class="m-2 price">{{ config('app.currency.symbol') }} {{ $product->current_price }}</p>
                        <p class="text-dark">{{ $product->short_description }}</p>
                        {{-- <div class="d-flex justify-content-between align-items-center w-100 any_size">
                            <span>Size: Any Size Slate</span>
                            <span class="text-orang">Convert to inches</span>
                        </div> --}}
                        <hr class="hr">
                        <h5 class="mb-4">Customize Design</h5>
                        <div class="col-12 px-0">
                            <div class="row">
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="textInput" class="form-label">Enter Text</label>
                                        <textarea id="textInput" class="form-control" placeholder="Type here..."></textarea>
                                    </div>

                                    <div id="alignmentControls" class="btn-group w-100 mb-3">
                                        <button class="align-btn btn primary_btn" data-align="left">
                                            <i class="fas fa-align-left"></i> Left
                                        </button>
                                        <button class="align-btn btn primary_btn" data-align="center">
                                            <i class="fas fa-align-center primary_btn"></i> Center
                                        </button>
                                        <button class="align-btn btn primary_btn" data-align="right"><i
                                                class="fas fa-align-right"></i> Right </button>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="mb-3">
                                                <label for="fontSelect" class="form-label">Font Style</label>
                                                <select id="fontSelect" class="form-select">
                                                    <option value="Arial" selected>Arial</option>
                                                    <option value="Courier New">Courier New</option>
                                                    <option value="Georgia">Georgia</option>
                                                    <option value="Times New Roman">Times New Roman</option>
                                                    <option value="Verdana">Verdana</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="textColor" class="form-label">Text Color</label>
                                                <input type="color" id="textColor"
                                                    class="form-control form-control-color" value="#000000" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="usageType" class="form-label">Usage Type</label>
                                            <select id="usageType" name="usage_type" class="form-select">
                                                <option value="">-- Select --</option>
                                                <option value="indoor">Indoor</option>
                                                <option value="outdoor">Outdoor</option>
                                            </select>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                        <div class="row gy-4 floating_lables">


                            @php
                                $hasRequiredOptions = $product->productOptions->where('required', true)->isNotEmpty();
                            @endphp

                            @if ($hasRequiredOptions)
                                @foreach ($product->productOptions as $productOption)
                                    @if ($productOption['required'])
                                        <div class="mb-3" id="profile-section">
                                            <label for="option_{{ $productOption['id'] }}" class="form-label">
                                                {{ $productOption['option']['option_name_en'] ?? 'Option Name' }}
                                            </label>

                                            @php
                                                $inputType = $productOption['option']['input_type']; // e.g., 'select', 'file', 'text', etc.
                                            @endphp


                                            @if ($inputType === 'select')
                                                <select name="options[{{ $productOption['id'] }}]"
                                                    id="option_{{ $productOption['id'] }}" class="form-control"
                                                    onchange="updatePrice()">
                                                    <option value="">-- Select --</option>
                                                    @foreach ($product->productOptionValues as $value)
                                                        @if ($value['option_values']['option_id'] == $productOption['option_id'])
                                                            <option value="{{ $value['option_value_id'] }}"
                                                                data-option-id="{{ $value['option_values']['option_id'] }}"
                                                                data-quantity="{{ $value['quantity'] }}"
                                                                data-subtract="{{ $value['subtract'] }}"
                                                                data-price_prefix="{{ $value['price_prefix'] }}"
                                                                data-price="{{ $value['price'] }}">
                                                                {{ $value['option_values']['option_name_en'] ?? 'N/A' }}
                                                                @if ($value['price'])
                                                                    ({{ $value['price_prefix'] }}{{ config('app.currency.symbol') }}{{ number_format($value['price'], 2) }})
                                                                @endif
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @elseif ($inputType === 'radio')
                                                @foreach ($product->productOptionValues as $value)
                                                    @if ($value['option_values']['option_id'] == $productOption['option_id'])
                                                        <div class="form-check">

                                                            <input class="form-check-input" type="radio"
                                                                name="options[{{ $productOption['option_id'] }}]"
                                                                id="radio_{{ $value['option_value_id'] }}"
                                                                value="{{ $value['option_value_id'] }}"
                                                                data-option-id="{{ $value['option_values']['option_id'] }}"
                                                                data-quantity="{{ $value['quantity'] }}"
                                                                data-subtract="{{ $value['subtract'] }}"
                                                                data-price_prefix="{{ $value['price_prefix'] }}"
                                                                data-price="{{ $value['price'] }}"
                                                                onchange="updatePrice()" />

                                                            <label class="form-check-label"
                                                                for="radio_{{ $value['id'] }}">
                                                                {{ $value['option_values']['option_name_en'] ?? 'N/A' }}
                                                                @if ($value['price'])
                                                                    ({{ $value['price_prefix'] }}{{ config('app.currency.symbol') }}{{ number_format($value['price'], 2) }})
                                                                @endif
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @elseif ($inputType === 'checkbox')
                                                @foreach ($product->productOptionValues as $value)
                                                    @if ($value['option_values']['option_id'] == $productOption['option_id'])
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="options[{{ $productOption['option_id'] }}][]"
                                                                id="checkbox_{{ $value['option_value_id'] }}"
                                                                value="{{ $value['option_value_id'] }}"
                                                                data-option-id="{{ $value['option_values']['option_id'] }}"
                                                                data-quantity="{{ $value['quantity'] }}"
                                                                data-subtract="{{ $value['subtract'] }}"
                                                                data-price_prefix="{{ $value['price_prefix'] }}"
                                                                data-price="{{ $value['price'] }}"
                                                                onchange="updatePrice()" />
                                                            <label class="form-check-label"
                                                                for="checkbox_{{ $value['option_value_id'] }}">
                                                                {{ $value['option_values']['option_name_en'] ?? 'N/A' }}
                                                                @if ($value['price'])
                                                                    ({{ $value['price_prefix'] }}{{ config('app.currency.symbol') }}{{ number_format($value['price'], 2) }})
                                                                @endif
                                                            </label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @elseif ($inputType === 'file')
                                                <input type="file" name="options[{{ $productOption['id'] }}]"
                                                    id="option_{{ $productOption['id'] }}" class="form-control" />
                                            @elseif ($inputType === 'textarea')
                                                <textarea name="options[{{ $productOption['id'] }}]" id="option_{{ $productOption['id'] }}" class="form-control"
                                                    rows="3" placeholder="Enter your text here"></textarea>
                                            @elseif ($inputType === 'text')
                                                <input type="text" name="options[{{ $productOption['id'] }}]"
                                                    id="option_{{ $productOption['id'] }}" class="form-control"
                                                    placeholder="Enter text" />
                                            @elseif ($inputType === 'date')
                                                <input type="date" name="options[{{ $productOption['id'] }}]"
                                                    id="option_{{ $productOption['id'] }}" class="form-control" />
                                            @elseif ($inputType === 'time')
                                                <input type="time" name="options[{{ $productOption['id'] }}]"
                                                    id="option_{{ $productOption['id'] }}" class="form-control" />
                                            @elseif ($inputType === 'datetime')
                                                <input type="datetime-local" name="options[{{ $productOption['id'] }}]"
                                                    id="option_{{ $productOption['id'] }}" class="form-control" />
                                            @endif
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="alert alert-info text-center">No options available for this product.</div>
                            @endif



                            @if ($product->informative == 0)

                                <div class="col-sm-12 text-end">
                                    @if ($inCart)
                                        <button class="btn_black" disabled>Added to Cart</button>
                                    @else
                                        <a href="javascript:void(0);" class="btn_black px-4 py-3 add-to-cart-btn"
                                            data-product-id="{{ $product->id }}">
                                            Add to Cart
                                        </a>
                                    @endif
                                </div>
                            @endif


                        </div>
                    </div>
                    <div class="accordion mt-5">
                        <div class="accordion-item border-0">
                            <h2 class="accordion-button border-0 rounded-0 bg-white p-0" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapse2">
                                Key Features
                            </h2>
                            <div id="panelsStayOpen-collapse2" class="accordion-collapse collapse show"
                                aria-labelledby="panelsStayOpen-heading2">
                                <div class="accordion-body px-0 py-2">
                                    <p>
                                        This Brazilian natural slate house sign with straight cut edges will add the
                                        perfect touch to your home.
                                    </P>
                                    <P>
                                        Choose from either a UV-Cured Ink Print (a bright white weatherproof ink) finish
                                        or a deep engraved option which is then hand-painted for a more premium finish.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item border-0">
                            <h2 class="accordion-button collapsed border-0 rounded-0 bg-white p-0"
                                data-bs-toggle="collapse" aria-expanded="false"
                                data-bs-target="#panelsStayOpen-collapse3">
                                Brand Related to Product
                            </h2>
                            <div id="panelsStayOpen-collapse3" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headi2">
                                <div class="accordion-body px-0 py-2">
                                    <p>
                                        {{ $product->brand->name ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    @if ($product->informative == 1)
        <div class="container my-5">
            <hr class="border-2">
            <h3 class="text-center mb-5">Submit Your Order / Enquire About This Product</h3>
            <form method="POST" enctype="multipart/form-data" id="product-enquiry-form">
                @csrf
                <div class="row">
                    <!-- Left: Contact Fields -->
                    <div class="col-md-6 ">

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Your Name: <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="name" placeholder="e.g. John Smith"
                                name="name" required value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Contact Number -->
                        <div class="mb-3">
                            <label for="contact_number" class="form-label">Contact Number: <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control" id="contact_number" name="contact_number"
                                placeholder="e.g. 0161 464 3645" required value="{{ old('contact_number') }}">
                            @error('contact_number')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address: <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="e.g. info@carricksigns.co.uk" required value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div class="mb-3">
                            <label for="message" class="form-label">Message: <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="message" placeholder="e.g. I would like to order..." rows="4"
                                name="message" required>{{ old('message') }}</textarea>
                            @error('message')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div id="form-response" class="alert alert-danger d-none"></div>

                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                    </div>


                    <!-- Right: Upload Section -->
                    <div class="col-md-6 border border-1 rounded">
                        <div class="upload-section   p-3">
                            <h5>Upload Your File <span class="text-danger">*</span></h5>
                            <!-- File Upload Input is now inside the form -->
                            <div class="mb-3">
                                <input type="file" class="form-control" id="upload-files" name="file"
                                    accept="image/jpeg, image/png, application/pdf, application/zip" required>
                                @error('file')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <p class="text-center">Upload your file using the button above or drag and drop files here.
                            </p>
                            <p class="text-center">Accepted file types: jpeg / png / pdf / zip. Maximum File size: 2GB.</p>

                            <div class="alert alert-info text-center">
                                <p>No files to attach at this time?<br>Don't worry, you can always send files later on—just
                                    hit
                                    send to complete your enquiry.</p>
                            </div>
                        </div>
                        <!-- Submit Button: Full width below both columns -->
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit"
                                    class="btn primary_btn w-100 d-flex justify-content-center align-items-center"
                                    id="submit-btn">
                                    <span id="btn-text">Send</span>
                                    <span class="spinner-border spinner-border-sm ms-2 d-none" role="status"
                                        aria-hidden="true" id="btn-spinner"></span>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>


            </form>
        </div>
    @endif




    <!-- Related Products Carousel-->
    {{-- <div class="relatedproduct-section container padding-bottom-3x mb-1 s-pt-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2 class="h3">You May Also Like</h2>
                </div>
            </div>
        </div>
        <div class="row g-3">
            <div class="col-lg-12">
                <div class="popular-category-slider owl-carousel">
                    @foreach ($products as $product1)
                        <div class="slider-item">
                            <div class="product-card">
                                <div class="product-thumb">

                                    <img src="{{ \App\Helpers\FileUploadHelper::url($product1->featured_image) }}"
                                        alt="Product Image" loading="lazy">
                                    <div class="product-button-group">
                                        @if (Auth::user() && Auth::user()->id)
                                            <a class="product-button wishlist_store"
                                                href="{{ route('user.add_to_wishlist', ['id' => $product1->id]) }}"
                                                title="Wishlist"><i class="icon-heart"></i></a>
                                        @else
                                            <a class="product-button wishlist_store" href="{{ route('user.register') }}"
                                                title="Wishlist"><i class="icon-heart"></i></a>
                                        @endif

                                        @if (Auth::user() && Auth::user()->id)
                                            <a data-target="" class="product-button product_compare"
                                                href="{{ route('user.add_to_compare', ['id' => $product1->id]) }}"
                                         title="Compare"><i class="icon-repeat"></i></a>
                                        @else
                                        <a data-target="" class="product-button product_compare"
                                            href="{{ route('user.register') }}" title="Compare"><i
                                                class="icon-repeat"></i></a>
                                        @endif

                                        @if (Auth::user() && Auth::user()->id)
                                            <a class="product-button add_to_single_cart" data-target="563"
                                                href="{{ route('user.add_to_cart', ['id' => $product1->id]) }}"
                                            title="To Cart"><i class="icon-shopping-cart"></i>
                                            </a>
                                        @else
                                        <a class="product-button add_to_single_cart" data-target="563"
                                            href="{{ route('user.register') }}" title="To Cart"><i
                                                class="icon-shopping-cart"></i>
                                        </a>
                                        @endif



                                    </div>
                                </div>
                                <div class="product-card-body">
                                    <div class="product-category"><a href="">{{ $product->categories->name }}</a>
                                    </div>
                                    <h3 class="product-title"><a
                                            href="{{ route('user.product_details', ['slug' => $product1->slug]) }}">
                                            {{ \Illuminate\Support\Str::substr($product1->name, 0, 50) }}
                                        </a></h3>

                                    <h4 class="product-price">
                                        <del>{{ config('app.currency.symbol') }}{{ $product1->previous_price }}</del>

                                        {{ config('app.currency.symbol') }}{{ $product1->current_price }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div> --}}


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
@section('footer')

    <script>
        function updateCartCount() {
            $.ajax({
                url: "{{ route('cart.count') }}",
                method: 'GET',
                success: function(response) {
                    $('#cart-count').text(response.count);
                }
            });
        }

        let textAlign = 'left'; // Default alignment

        $(document).ready(function() {

            $('.align-btn').on('click', function(e) {
                e.preventDefault();
                textAlign = $(this).data('align'); // 'left', 'center', or 'right'

                // Optional: visual feedback
                $('.align-btn').removeClass('active');
                $(this).addClass('active');
            });


            $('.add-to-cart-btn').on('click', function() {
                // alert('Button clicked');
                const button = $(this);

                //  Prevent double-click
                if (button.data('clicked')) return; // If already clicked, exit
                button.data('clicked', true);

                const productId = $(this).data('product-id');
                const options = [];
                let valid = true;
                const handledNames = new Set(); // Track processed input names
                var errorShown = false; // Track if toastr error was already shown
                const textInput = $('#textInput').val().trim();
                const fontSelect = $('#fontSelect').val();
                const textColor = $('#textColor').val();
                const usageType = $('#usageType').val();



                if (!textInput) {
                    toastr.error('Please enter text in the "Text" field.');
                    button.removeData('clicked');
                    valid = false;
                    return false;
                }

                if (!fontSelect) {
                    toastr.error('Please select a font style.');
                    button.removeData('clicked');
                    valid = false;
                    return false;
                }

                if (!textColor) {
                    toastr.error('Please pick a text color.');
                    button.removeData('clicked');
                    valid = false;
                    return false;
                }

                if (!usageType) {
                    toastr.error('Please select a usage type.');
                    button.removeData('clicked');
                    valid = false;
                    return false;
                }


                $('[name^="options["]').each(function() {
                    const input = $(this);
                    const name = input.attr('name');
                    const tag = input.prop('tagName').toLowerCase();
                    const type = input.attr('type') || tag;

                    if (handledNames.has(name)) return; // skip duplicates
                    handledNames.add(name);

                    // -------- SELECT --------
                    if (tag === 'select') {
                        const selected = input.find(':selected');
                        const valueId = selected.val();
                        const optionId = selected.data('option-id');

                        if (!valueId || !optionId) {
                            toastr.error(
                                'Please select all required options before adding to cart.');
                            button.removeData('clicked');
                            valid = false;
                            return false;
                        }

                        //  Debug here
                        console.log('option_id:', optionId);
                        console.log('option_value_id:', valueId);

                        options.push({
                            option_id: optionId,
                            option_value_id: valueId,
                            quantity: selected.data('quantity'),
                            subtract: selected.data('subtract'),
                            price_prefix: selected.data('price_prefix'),
                            price: selected.data('price')
                        });
                    }

                    // -------- RADIO --------
                    else if (type === 'radio') {
                        const selected = $(`input[name="${name}"]:checked`);
                        if (selected.length === 0) {
                            toastr.error(
                                'Please select at least one option before adding to cart.');
                            button.removeData('clicked');
                            valid = false;
                            return false;
                        }

                        options.push({
                            option_id: selected.data('option-id'),
                            option_value_id: selected.val(),
                            quantity: selected.data('quantity'),
                            subtract: selected.data('subtract'),
                            price_prefix: selected.data('price_prefix'),
                            price: selected.data('price')
                        });
                    }

                    // -------- CHECKBOX --------
                    else if (type === 'checkbox') {
                        const checked = $(`input[name="${name}"]:checked`);
                        if (checked.length === 0) {
                            toastr.error('Please select at least one checkbox option.');
                            button.removeData('clicked');
                            valid = false;
                            return false;
                        }

                        checked.each(function() {
                            const checkbox = $(this);
                            options.push({
                                option_id: checkbox.data('option-id'),
                                option_value_id: checkbox.val(),
                                quantity: checkbox.data('quantity'),
                                subtract: checkbox.data('subtract'),
                                price_prefix: checkbox.data('price_prefix'),
                                price: checkbox.data('price')
                            });
                        });
                    }

                    // -------- TEXT / TEXTAREA / FILE / DATE / TIME --------
                    else if (['text', 'textarea', 'file', 'date', 'time', 'datetime-local']
                        .includes(type)) {
                        const val = input.val();
                        const optionId = name.match(/\d+/)?.[0];

                        if (!val) {
                            toastr.error(
                                'Please fill all required input fields before adding to cart.');
                            button.removeData('clicked');
                            valid = false;
                            return false;
                        }

                        if (type !== 'file') {
                            options.push({
                                option_id: optionId,
                                value: val
                            });
                        }
                    }
                });

                if (!valid) return;



                const formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('product_id', productId);
                formData.append('text_input', textInput);
                formData.append('font_style', fontSelect);
                formData.append('text_color', textColor);
                formData.append('usage_type', usageType);
                formData.append('text_align', textAlign);


                // Append all collected options
                options.forEach((opt, i) => {
                    for (const key in opt) {
                        formData.append(`options[${i}][${key}]`, opt[key]);
                    }
                });

                // Append any files (file inputs are handled separately)
                $('input[type="file"][name^="options["]').each(function() {
                    const fileInput = $(this);
                    const files = fileInput[0].files;
                    const optionId = fileInput.attr('name').match(/\d+/)?.[0];

                    if (files.length > 0 && optionId) {
                        formData.append(`files[${optionId}]`, files[0]);
                    }
                });

                // Perform AJAX request
                $.ajax({
                    url: "{{ route('user.add-cart') }}",
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success(response.message ||
                            'Product added to cart successfully!');
                        const button = $(`.add-to-cart-btn[data-product-id="${productId}"]`);
                        button.text('Added to Cart').addClass('disabled').css('pointer-events',
                            'none');
                        updateCartCount();
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON?.message ||
                            'Failed to add product to cart.');
                        button.removeData('clicked');
                        console.error('AJAX Error:', xhr);
                    }
                });
            });
        });

        const optionDivs = document.querySelectorAll('#profile-section');

        // Loop and bind click
        optionDivs.forEach(div => {
            div.addEventListener('click', function() {
                const tabTrigger = document.querySelector('#profile');
                if (tabTrigger) {
                    const tab = new bootstrap.Tab(tabTrigger);
                    tab.show(); // this will show #home tab-pane
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const textInput = document.getElementById("textInput");
            const overlayText = document.getElementById("overlaycontent");
            const imageSelect = document.getElementById("imageSelect");
            const selectedImage = document.getElementById("selectedImage");
            const fontSelect = document.getElementById("fontSelect");
            const textColor = document.getElementById("textColor");
            const alignmentButtons = document.querySelectorAll(".btn-alignment");

            // Update text content
            textInput?.addEventListener("input", () => {
                overlayText.textContent = textInput.value.trim() || "Your Text";
            });

            // Update image
            imageSelect?.addEventListener("change", () => {
                selectedImage.src = imageSelect.value;
            });

            // Update font style
            fontSelect?.addEventListener("change", () => {
                overlayText.style.fontFamily = fontSelect.value;
            });

            // Update text color
            textColor?.addEventListener("input", () => {
                overlayText.style.color = textColor.value;
            });

            // Update alignment
            alignmentButtons.forEach(button => {
                button.addEventListener("click", function() {
                    alignmentButtons.forEach(btn => btn.classList.remove("active"));
                    this.classList.add("active");
                    console.log(this);
                    const align = this.getAttribute("data-align");
                    overlayText.style.textAlign = align;
                });
            });
            // jQuery
            // Define the alignment function
            function setTextAlign(position) {
                $('#overlaycontent').css('text-align', position);
            }

            // Wire up any button with class .align-btn
            $('.align-btn').on('click', function() {
                var align = $(this).data('align');
                this.classList.add("active");
                setTextAlign(align);
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $('#product-enquiry-form').on('submit', function(e) {
                e.preventDefault();

                let form = $(this);
                let formData = new FormData(this);
                let submitBtn = $('#submit-btn');
                let btnText = $('#btn-text');
                let btnSpinner = $('#btn-spinner');

                // Reset previous messages
                $('#form-response').html('');
                toastr.clear();

                // Disable the button & show spinner
                submitBtn.prop('disabled', true);
                btnText.text('Sending...');
                btnSpinner.removeClass('d-none');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('product.enquiry.store') }}",
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(response) {
                        // Show success toaster
                        toastr.success(response.message || 'Enquiry submitted successfully!');

                        // Reset form
                        form[0].reset();
                    },

                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorList = '<ul>';
                            $.each(errors, function(key, value) {
                                errorList += '<li>' + value[0] + '</li>';
                            });
                            errorList += '</ul>';
                            $('#form-response').html('<div class="alert alert-danger">' +
                                errorList + '</div>');
                        } else {
                            $('#form-response').html(
                                '<div class="alert alert-danger">Something went wrong. Please try again.</div>'
                            );
                            toastr.error('Something went wrong. Please try again.');
                        }
                    },

                    complete: function() {
                        // Re-enable button & reset text/spinner
                        submitBtn.prop('disabled', false);
                        btnText.text('Send');
                        btnSpinner.addClass('d-none');
                    }
                });
            });
        });
    </script>

@endsection
