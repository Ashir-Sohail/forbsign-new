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
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('user.home') }}">Home</a>
                        </li>
                        <li class="separator"></li>
                        <li><a href="{{ route('user.store') }}">Shop</a>
                        </li>
                        <li class="separator"></li>
                        <li>{{ $product->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section id="pro_detail" class="my-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5">
                    <ul class="nav nav-tabs mb-1" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
                        </li>
                    </ul>

                    <div class="tab-content p-0" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                            <div class="pro_img">
                                <img src="{{ \App\Helpers\FileUploadHelper::url($product->featured_image) }}" alt="{{ $product->name }}"
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
                                            <img src="{{ \App\Helpers\FileUploadHelper::url($image) }}" alt="product image" loading="lazy">
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>

                        {{-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="w-100" id="prod-m" data-commercial="false" data-preview-key="ivy_way_slate"
                                data-cart-url="/ajax/cart" data-image-url="https://artwork.uksignshop.co.uk/artwork.php"
                                data-upload-link="/_uploader/upload/upload">
                                <div class="w-100" id="prod-preview-c">

                                    <div id="prod-preview">
                                        <img data-preview="" src="./artwork.php" alt="Ivy Way Slate live preview">
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="w-100" id="prod-preview-c">
                                <div id="prod-preview">
                                    <img src="{{ \App\Helpers\FileUploadHelper::url($product->featured_image) }}" alt="{{ $product->name }}"
                                        loading="lazy" id="customizableImagePreview">
                                    <div id="dynamicTextOverlay"
                                        style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: white; font-size: 30px; white-space: nowrap;">
                                        <div id="textLine1" class="dynamic-text-line"
                                            style="position: absolute; text-align: center; width: 100%; color: white; font-size: 30px;">
                                        </div>
                                        <div id="textLine2" class="dynamic-text-line"
                                            style="position: absolute; text-align: center; width: 100%; color: white; font-size: 20px;">
                                        </div>
                                        <div id="textLine3" class="dynamic-text-line"
                                            style="position: absolute; text-align: center; width: 100%; color: white; font-size: 20px;">
                                        </div>
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
                                    <P>
                                        Choose from either a UV-Cured Ink Print (a bright white weatherproof ink) finish
                                        or a deep engraved option which is then hand-painted for a more premium finish.
                                    </p>
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
                        <div class="d-flex justify-content-between align-items-center w-100 any_size">
                            <span>Size: Any Size Slate</span>
                            <span class="text-orang">Convert to inches</span>
                        </div>
                        <hr class="hr">
                        {{-- <h5 class="mb-4">Customize Design</h5> --}}
                        <div class="row gy-4 floating_lables">

                            {{-- @include('includes.fonts-layout') --}}


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
                                                                    ({{ $value['price_prefix'] }}
                                                                    {{ number_format($value['price'], 2) }})
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
                                                                    ({{ $value['price_prefix'] }}
                                                                    {{ number_format($value['price'], 2) }})
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
                                                                    ({{ $value['price_prefix'] }}
                                                                    {{ number_format($value['price'], 2) }})
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

                            <div class="col-12 px-0">
                                <form name="" method="" id="sylius-product-adding-to-cart"
                                    class="ui loadable form">

                                    <div id="prod-options">
                                        <div id="prod-p">
                                            <h3>Personalise sign</h3>
                                            <div class="required field">
                                                <div id="sylius_add_to_cart_cartItem_textOptions">
                                                    <div class="field">
                                                        <div class="prod-option-c" data-mapping="sign-layout">
                                                            <label for="">Sign Layout
                                                                <span class="icon-help" data-toggle="tooltip"
                                                                    data-placement="right" title=""
                                                                    data-original-title="Choose the way your text is laid out on your sign"></span></label>
                                                            <div class="prod-select-c" id="sign-layout">
                                                                <div class="prod-select-box prod-select-box-layout">
                                                                    Choose your sign layout
                                                                </div>
                                                                <div class="prod-select-popup" style="display: none;">
                                                                    <div class="prod-select-header icon-close">Choose your
                                                                        sign
                                                                        layout</div>
                                                                    <div class="prod-select-main d-flex flex-wrap">
                                                                        <div class="layout-option col-4 selected"
                                                                            data-value="house_no_with_text_below">
                                                                            <div class="layout-img" id="num-name-below">
                                                                                <div class="num">#</div>
                                                                                <div class="line"></div>
                                                                            </div>
                                                                            <div class="item-name">House No. with street
                                                                                name
                                                                                below</div>
                                                                        </div>
                                                                        <div class="layout-option col-4"
                                                                            data-value="one_text_block">
                                                                            <div class="layout-img" id="text-one">
                                                                                <div class="line"></div>
                                                                            </div>
                                                                            <div class="item-name">One text block (e.g.
                                                                                House
                                                                                Name)</div>
                                                                        </div>
                                                                        <div class="layout-option col-4"
                                                                            data-value="house_no_only">
                                                                            <div class="layout-img" id="num-only">
                                                                                <div class="num">#</div>
                                                                            </div>
                                                                            <div class="item-name">House No. Only</div>
                                                                        </div>
                                                                        <div class="layout-option col-4"
                                                                            data-value="house_no_with_text_above">
                                                                            <div class="layout-img" id="num-name-above">
                                                                                <div class="line"></div>
                                                                                <div class="num">#</div>
                                                                            </div>
                                                                            <div class="item-name">House No. with text
                                                                                above
                                                                            </div>
                                                                        </div>
                                                                        <div class="layout-option col-4"
                                                                            data-value="house_no_with_text_above_below">
                                                                            <div class="layout-img"
                                                                                id="num-name-above-below">
                                                                                <div class="line"></div>
                                                                                <div class="num">#</div>
                                                                                <div class="line"></div>
                                                                            </div>
                                                                            <div class="item-name">House No. with text
                                                                                above
                                                                                &amp; below</div>
                                                                        </div>
                                                                        <div class="layout-option col-4"
                                                                            data-value="two_text_blocks">
                                                                            <div class="layout-img" id="text-two">
                                                                                <div class="line"></div>
                                                                                <div class="line"></div>
                                                                            </div>
                                                                            <div class="item-name">Two text blocks</div>
                                                                        </div>
                                                                    </div>
                                                                    <input class="input" id="sign-layout-selection"
                                                                        type="hidden"
                                                                        name="sylius_add_to_cart[cartItem][textOptions][sign-layout][layout]"
                                                                        value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="field">
                                                        <div class="prod-option-c" data-mapping="text-style">
                                                            <label for="">Text Style</label>
                                                            <div class="prod-select-c" id="sign-text">
                                                                <div class="prod-select-box prod-select-box-text">
                                                                    Choose your text style
                                                                </div>
                                                                <div class="prod-select-popup" style="display: none;">
                                                                    <div class="prod-select-header icon-close">Choose your
                                                                        text
                                                                        style</div>
                                                                    <div class="prod-select-main">
                                                                        <ul id="text-filter-options">
                                                                            <li class="active"><a
                                                                                    href="javascript:void(0);"
                                                                                    data-font="all" class="all">All</a>
                                                                            </li>
                                                                            <li><a href="javascript:void(0);"
                                                                                    data-font="modern"
                                                                                    class="modern">Modern</a></li>
                                                                            <li><a href="javascript:void(0);"
                                                                                    data-font="traditional"
                                                                                    class="traditional">Traditional</a>
                                                                            </li>
                                                                            <li><a href="javascript:void(0);"
                                                                                    data-font="bold"
                                                                                    class="bold">Bold</a></li>
                                                                            <li><a href="javascript:void(0);"
                                                                                    data-font="script"
                                                                                    class="script">Script</a></li>
                                                                            <li><a href="javascript:void(0);"
                                                                                    data-font="fun" class="fun">Fun</a>
                                                                            </li>
                                                                        </ul>
                                                                        <div id="text-options-c">
                                                                            <div class="text-option default-font"
                                                                                data-value="" data-font="">
                                                                                <span>As Pictured</span>
                                                                                As Pictured
                                                                            </div>
                                                                            <div class="text-option modern default selected"
                                                                                data-value="arial.ttf" data-font="modern">
                                                                                <span>Arial</span>
                                                                                <img src="{{ asset('assets/imgs/text-style/xarial.png.pagespeed.ic.BaBLePNSxo.webp') }}"
                                                                                    alt="Arial">
                                                                            </div>
                                                                            <div class="text-option modern"
                                                                                data-value="bariol_bold.otf"
                                                                                data-font="modern">
                                                                                <span>Bariol</span>
                                                                                <img src="./assets/imgs/text-style/xbariol.png.pagespeed.ic.i71kbFR5jj.webp"
                                                                                    alt="Bariol">
                                                                            </div>
                                                                            <div class="text-option modern"
                                                                                data-value="opensans-bold.ttf"
                                                                                data-font="modern">
                                                                                <span>Open Sans</span>
                                                                                <img src="./assets/imgs/text-style/xopen-sans.png.pagespeed.ic.APjFbasMcS.webp"
                                                                                    alt="Open Sans">
                                                                            </div>
                                                                            <div class="text-option modern"
                                                                                data-value="gill_sans.ttf"
                                                                                data-font="modern">
                                                                                <span>Gill Sans</span>
                                                                                {{-- <img src="{{asset('assets/imgs/text-style/gil-sans.webp')}}"
                                                                        alt="Gill Sans"> --}}
                                                                            </div>
                                                                            <div class="text-option modern"
                                                                                data-value="sourcesanspro-bold.ttf"
                                                                                data-font="modern">
                                                                                <span>Source Sans Pro</span>
                                                                                <img src="./assets/imgs/text-style/xsource-sans-pro.png.pagespeed.ic.EvAQrEwbWd.webp"
                                                                                    alt="Source Sans Pro">
                                                                            </div>
                                                                            <div class="text-option traditional"
                                                                                data-value="medio.otf"
                                                                                data-font="traditional">
                                                                                <span>Medio</span>
                                                                                <img src="./assets/imgs/text-style/xmedio.png.pagespeed.ic.p37PCXCtGQ.webp"
                                                                                    alt="Medio">
                                                                            </div>
                                                                            <div class="text-option traditional"
                                                                                data-value="trajan_pro.otf"
                                                                                data-font="traditional">
                                                                                <span>Trajan Pro</span>
                                                                                <img src="./assets/imgs/text-style/xtrajan_pro.png.pagespeed.ic.GFvZe-Zjg_.webp"
                                                                                    alt="Trajan Pro">
                                                                            </div>
                                                                            <div class="text-option traditional"
                                                                                data-value="times_new_roman.ttf"
                                                                                data-font="traditional">
                                                                                <span>Times New Roman</span>
                                                                                <img src="./assets/imgs/text-style/xtimes_new_roman.png.pagespeed.ic.vv-sRIhx-T.webp"
                                                                                    alt="Times New Roman">
                                                                            </div>
                                                                            <div class="text-option traditional"
                                                                                data-value="georgia.ttf"
                                                                                data-font="traditional">
                                                                                <span>Georgia</span>
                                                                                <img src="./assets/imgs/text-style/xgeorgia.png.pagespeed.ic.QygnXLrMW4.webp"
                                                                                    alt="Georgia">
                                                                            </div>
                                                                            <div class="text-option traditional"
                                                                                data-value="opulent.ttf"
                                                                                data-font="traditional">
                                                                                <span>Opulent</span>
                                                                                <img src="./assets/imgs/text-style/xopulent.png.pagespeed.ic.h3ixEX2Ob3.webp"
                                                                                    alt="Opulent">
                                                                            </div>
                                                                            <div class="text-option traditional"
                                                                                data-value="lora-regular.ttf"
                                                                                data-font="traditional">
                                                                                <span>Lora</span>
                                                                                <img src="./assets/imgs/text-style/xlora-regular.png.pagespeed.ic.GlF6Jc83Up.webp"
                                                                                    alt="Lora">
                                                                            </div>
                                                                            <div class="text-option traditional"
                                                                                data-value="playfairdisplay-regular.ttf"
                                                                                data-font="traditional">
                                                                                <span>Playfair Display</span>
                                                                                <img src="./assets/imgs/text-style/xplayfairdisplay-regular.png.pagespeed.ic.PyqFmpGOuw.webp"
                                                                                    alt="Playfair Display">
                                                                            </div>
                                                                            <div class="text-option traditional"
                                                                                data-value="vidaloka-regular.ttf"
                                                                                data-font="traditional">
                                                                                <span>Vidaloka</span>
                                                                                <img src="./assets/imgs/text-style/xvidaloka-regular.png.pagespeed.ic.Dt0sJQB9Tu.webp"
                                                                                    alt="Vidaloka">
                                                                            </div>
                                                                            <div class="text-option bold"
                                                                                data-value="impact.ttf" data-font="bold">
                                                                                <span>Impact</span>
                                                                                <img src="./assets/imgs/text-style/ximpact.png.pagespeed.ic.usIur3q3jr.webp"
                                                                                    alt="Impact">
                                                                            </div>
                                                                            <div class="text-option bold"
                                                                                data-value="oswald-bold.ttf"
                                                                                data-font="bold">
                                                                                <span>Oswald</span>
                                                                                <img src="./assets/imgs/text-style/xoswald-bold.png.pagespeed.ic.pEHHupQb-O.webp"
                                                                                    alt="Oswald">
                                                                            </div>
                                                                            <div class="text-option bold"
                                                                                data-value="vag_rounded_bold.ttf"
                                                                                data-font="bold">
                                                                                <span>VAG Rounded</span>
                                                                                <img src="./assets/imgs/text-style/xvag_rounded_bold.png.pagespeed.ic.eHVip5rLhB.webp"
                                                                                    alt="VAG Rounded">
                                                                            </div>
                                                                            <div class="text-option bold"
                                                                                data-value="century_gothic_bold.ttf"
                                                                                data-font="bold">
                                                                                <span>Century Gothic Bold</span>
                                                                                <img src="./assets/imgs/text-style/xcentury_gothic_bold.png.pagespeed.ic.HBGsFZOwB-.webp"
                                                                                    alt="Century Gothic Bold">
                                                                            </div>
                                                                            <div class="text-option bold"
                                                                                data-value="sourcesanspro-black.ttf"
                                                                                data-font="bold">
                                                                                <span>Source Sans Pro Black</span>
                                                                                <img src="./assets/imgs/text-style/xsourcesanspro-black.png.pagespeed.ic.3sORFgWqRH.webp"
                                                                                    alt="Source Sans Pro Black">
                                                                            </div>
                                                                            <div class="text-option bold"
                                                                                data-value="alfaslabone-regular.ttf"
                                                                                data-font="bold">
                                                                                <span>Alfa Slab One</span>
                                                                                <img src="./assets/imgs/text-style/xalfaslabone-regular.png.pagespeed.ic.CAUZqFz5SG.webp"
                                                                                    alt="Alfa Slab One">
                                                                            </div>
                                                                            <div class="text-option script"
                                                                                data-value="cookie-regular.ttf"
                                                                                data-font="script">
                                                                                <span>Cookie</span>
                                                                                <img src="./assets/imgs/text-style/xcookie-regular.png.pagespeed.ic.sMxBoJHTO7.webp"
                                                                                    alt="Cookie">
                                                                            </div>
                                                                            <div class="text-option script"
                                                                                data-value="lobster-regular.ttf"
                                                                                data-font="script">
                                                                                <span>Lobster</span>
                                                                                <img src="./assets/imgs/text-style/xlobster-regular.png.pagespeed.ic.JnU-eqYduJ.webp"
                                                                                    alt="Lobster">
                                                                            </div>
                                                                            <div class="text-option fun"
                                                                                data-value="comic_sans_ms.ttf"
                                                                                data-font="fun">
                                                                                <span>Comic Sans</span>
                                                                                <img src="./assets/imgs/text-style/xcomic_sans_ms.png.pagespeed.ic.t1yyHCBI2t.webp"
                                                                                    alt="Comic Sans">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input class="input" type="hidden"
                                                                        name="sylius_add_to_cart[cartItem][textOptions][text-style]"
                                                                        value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="required field">
                                                        <div class="prod-option-c" data-pup="0.00"
                                                            data-mapping="slate_oiling">
                                                            <label for="">Finishing Option</label>
                                                            <div class="prod-select-c" id="slate-oiling-options">
                                                                <div class="prod-select-box prod-select-box-slate-oiling">
                                                                    Choose your finishing options
                                                                </div>
                                                                <div class="prod-select-popup pb-2"
                                                                    style="display: none;">
                                                                    <div class="prod-select-header icon-close">Finishing
                                                                        Option
                                                                    </div>
                                                                    <div class="prod-select-main d-flex flex-wrap">
                                                                        <div class="d-flex flex-column w-100">
                                                                            <div data-itemtype="slate-oiling-options"
                                                                                class="text-option-popup-option"
                                                                                data-op="300" data-value="yes">
                                                                                <div class="border rounded shadow mb-2 bg-grey px-2 py-2"
                                                                                    style="cursor: pointer; border-color: #c5d3da !important;">
                                                                                    <div
                                                                                        class="d-flex justify-content-between flex-grow-1 justify-content-between align-items-center">
                                                                                        <div class="item-name"
                                                                                            style="font-size: 18px; color: #3b4958; font-weight: bold;">
                                                                                            Yes, please oil my slate sign
                                                                                        </div>
                                                                                        <strong class="text-right"
                                                                                            style="font-size: 18px; color: #3b4958; min-width: 100px;">+£3.00</strong>
                                                                                    </div>
                                                                                    <div
                                                                                        class="text-left ml-0 mb-0 mr-0 p-0 mt-1">
                                                                                        <ul>
                                                                                            <li>Enhanced contrast &amp;
                                                                                                colour
                                                                                            </li>
                                                                                            <li>Protects against staining
                                                                                                &amp;
                                                                                                watermarking</li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div data-itemtype="slate-oiling-options"
                                                                                class="text-option-popup-option"
                                                                                data-op="0" data-value="no">
                                                                                <div class="border rounded shadow mb-2 bg-grey px-2 py-2"
                                                                                    style="cursor: pointer; border-color: #c5d3da !important;">
                                                                                    <div
                                                                                        class="d-flex justify-content-between flex-grow-1 justify-content-between align-items-center">
                                                                                        <div class="item-name"
                                                                                            style="font-size: 18px; color: #3b4958; font-weight: bold;">
                                                                                            No, please leave natural</div>
                                                                                        <strong class="text-right"
                                                                                            style="font-size: 18px; color: #3b4958; min-width: 100px;">FREE</strong>
                                                                                    </div>
                                                                                    <div
                                                                                        class="text-left ml-0 mb-0 mr-0 p-0 mt-1">
                                                                                        I do not require any slate oiling
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="px-2">
                                                                                <h4 px="1">Why add an oiling
                                                                                    upgrade to your
                                                                                    slate sign?</h4>
                                                                                <p class="text-left">Applying slate oil to
                                                                                    your
                                                                                    sign is for the protection of rough to
                                                                                    finely honed slate surfaces. It enhances
                                                                                    the
                                                                                    natural colour and intensifies the
                                                                                    structure, improving the appearance of
                                                                                    the
                                                                                    stone. To see the difference please take
                                                                                    a
                                                                                    look at the photo below.</p>
                                                                                <img class="img-fluid"
                                                                                    src="/assets/theme/img/xslate-oil-option.jpg.pagespeed.ic.8n1R-OMZUb.webp">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input class="input" type="hidden"
                                                                        name="sylius_add_to_cart[cartItem][textOptions][slate_oiling]"
                                                                        value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="prod-option-c text-option-select required field">
                                                        <div class="prod-option-c"
                                                            style="padding: 15px 20px 20px 15px; border: 2px solid #b7b9bc; background: #f8f9fa; border-radius: 5px; margin: 15px 0;"
                                                            data-pup="0.00" data-mapping="solar-light">
                                                            <label for=""><strong class="color-p">Upgrade
                                                                    Available:</strong>
                                                                Solar Light <span class="icon-help" data-toggle="tooltip"
                                                                    data-placement="right" title=""
                                                                    data-original-title="This will allow you add an optional solar light to your order"></span></label>
                                                            <div
                                                                style="margin: 5px 0; text-transform: uppercase; letter-spacing: 1px; font-size: 12px; color: #dd3029; font-weight: bold;">
                                                                🕚 Limited time offer only while stocks last</div>
                                                            <div class="prod-select-c" id="solar-light">
                                                                <div class="prod-select-box prod-select-box-finish"
                                                                    style="background: white !important;">
                                                                    Pick Your Solar Upgrade
                                                                </div>
                                                                <div class="prod-select-popup pb-2"
                                                                    style="display: none;">
                                                                    <div class="prod-select-header icon-close">Nova Solar
                                                                        Light
                                                                    </div>
                                                                    <div class="prod-select-main d-flex flex-wrap">
                                                                        <div class="col-6 text-left">
                                                                            <p>Make your house sign shine even at night.
                                                                                Simply
                                                                                install above your house sign to add
                                                                                illumination.</p>
                                                                            <ul>
                                                                                <li>Matte black finish and discreet design
                                                                                    for a
                                                                                    sleek appearance</li>
                                                                                <li>15 energy-efficient LEDs for bright and
                                                                                    clear illumination</li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <img src="/assets/theme/img/xsolar-light.jpg.pagespeed.ic.kd5S5NMR8O.webp"
                                                                                alt="Nova Solar Light for House Signs">
                                                                            <img src="/assets/theme/img/xsolar-light-box.jpg.pagespeed.ic.WzUco4wBZP.webp"
                                                                                style="margin-top:20px;"
                                                                                alt="Nova Solar Light Box">
                                                                        </div>
                                                                        <p>Our premium, sleek eco-friendly solution for
                                                                            illuminating your house sign at night.</p>
                                                                        <div class="d-flex flex-column w-100">
                                                                            <div data-itemtype="solar-light"
                                                                                class="text-option-popup-option"
                                                                                data-op="1999" data-value="yes">
                                                                                <div style="background: #EE903B; cursor: pointer"
                                                                                    class="text-white mb-2 d-flex justify-content-between rounded shadow align-items-center align-content-center pl-2 py-2 pr-3 text-left">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                                        class="d-none d-sm-block mr-1 ml-2 text-white-50"
                                                                                        style="width: 40px;"
                                                                                        viewBox="0 0 24 24">
                                                                                        <path fill="white"
                                                                                            d="M22.088 13.126l1.912-1.126-1.912-1.126c-1.021-.602-1.372-1.91-.788-2.942l1.093-1.932-2.22-.02c-1.185-.01-2.143-.968-2.153-2.153l-.02-2.219-1.932 1.093c-1.031.583-2.34.233-2.941-.788l-1.127-1.913-1.127 1.913c-.602 1.021-1.91 1.372-2.941.788l-1.932-1.093-.02 2.219c-.01 1.185-.968 2.143-2.153 2.153l-2.22.02 1.093 1.932c.584 1.032.233 2.34-.788 2.942l-1.912 1.126 1.912 1.126c1.021.602 1.372 1.91.788 2.942l-1.093 1.932 2.22.02c1.185.01 2.143.968 2.153 2.153l.02 2.219 1.932-1.093c1.031-.583 2.34-.233 2.941.788l1.127 1.913 1.127-1.913c.602-1.021 1.91-1.372 2.941-.788l1.932 1.093.02-2.219c.011-1.185.969-2.143 2.153-2.153l2.22-.02-1.093-1.932c-.584-1.031-.234-2.34.788-2.942zm-10.117 6.874c-4.411 0-8-3.589-8-8s3.588-8 8-8 8 3.589 8 8-3.589 8-8 8zm6.029-8c0 3.313-2.687 6-6 6s-6-2.687-6-6 2.687-6 6-6 6 2.687 6 6z">
                                                                                        </path>
                                                                                    </svg>
                                                                                    <div class="item-name pl-1"
                                                                                        style="font-size: 18px; margin-top: -3px;">
                                                                                        Yes, please add a solar light</div>
                                                                                    <strong class="text-white"
                                                                                        style="font-size: 22px;">£19.99</strong>
                                                                                </div>
                                                                            </div>
                                                                            <div data-itemtype="solar-light"
                                                                                class="text-option-popup-option"
                                                                                data-op="0" data-value="no">
                                                                                <div class="flex-grow-1 border d-flex rounded shadow mb-2 align-items-center bg-grey align-items-center justify-content-center px-3 py-1"
                                                                                    style="cursor: pointer; border-color: #c5d3da !important;">
                                                                                    <div class="item-name"
                                                                                        style="font-size: 18px;">
                                                                                        No
                                                                                        thank you
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input class="input" type="hidden" name=""
                                                                        value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>



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
            </div>
        </div>
    </section>


    <!-- Related Products Carousel-->
    <div class="relatedproduct-section container padding-bottom-3x mb-1 s-pt-30">
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

                                    <img class="lazy"
                                        data-src="{{ \App\Helpers\FileUploadHelper::url($product1->featured_image) }}"
                                        alt="Product">
                                    <div class="product-button-group">
                                        {{-- @if (Auth::user() && Auth::user()->id)
                                            <a class="product-button wishlist_store"
                                                href="{{ route('user.add_to_wishlist', ['id' => $product1->id]) }}"
                                                title="Wishlist"><i class="icon-heart"></i></a>
                                        @else
                                            <a class="product-button wishlist_store" href="{{ route('user.register') }}"
                                                title="Wishlist"><i class="icon-heart"></i></a>
                                        @endif --}}

                                        {{-- @if (Auth::user() && Auth::user()->id)
                                            <a data-target="" class="product-button product_compare"
                                                href="{{ route('user.add_to_compare', ['id' => $product1->id]) }}"
                                                title="Compare"><i class="icon-repeat"></i></a>
                                        @else
                                            <a data-target="" class="product-button product_compare"
                                                href="{{ route('user.register') }}" title="Compare"><i
                                                    class="icon-repeat"></i></a>
                                        @endif --}}

                                        {{-- @if (Auth::user() && Auth::user()->id)
                                            <a class="product-button add_to_single_cart" data-target="563"
                                                href="{{ route('user.add-cart') }}"
                                                title="To Cart"><i class="icon-shopping-cart"></i>
                                            </a>
                                        @else
                                            <a class="product-button add_to_single_cart" data-target="563"
                                                href="{{ route('user.register') }}" title="To Cart"><i
                                                    class="icon-shopping-cart"></i>
                                            </a>
                                        @endif --}}



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
                                        <del>${{ $product1->previous_price }}</del>

                                        ${{ $product1->current_price }}
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


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


        $(document).ready(function() {
            $('.add-to-cart-btn').on('click', function() {
                const button = $(this);

                //  Prevent double-click
                if (button.data('clicked')) return; // If already clicked, exit
                button.data('clicked', true);

                const productId = $(this).data('product-id');
                const options = [];
                let valid = true;
                const handledNames = new Set(); // Track processed input names
                var errorShown = false; // Track if toastr error was already shown


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
 


@endsection
