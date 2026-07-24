@extends('layouts.app')

@section('title', 'Customize Product')
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
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            padding: 1.5rem 2rem;
            pointer-events: none;
        }

        #overlayTextInner {
            font-size: clamp(18px, calc(0.75rem + 1vw), 30px);
            font-weight: bold;
            color: #000;
            word-wrap: break-word;
            white-space: pre-wrap;
            display: block;
            width: 100%;
        }
    </style>
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
                        {{-- <li>{{ $product->name }}</li> --}}
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <section id="pro_detail" class="my-5">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-5">

                    <div class="image-preview-box">
                        @if ($defaultImage)
                            <img id="selectedImage" src="{{ asset($defaultImage->image_path) }}" alt="Preview">
                        @else
                            <img id="selectedImage" src="" alt="No Image Available">
                        @endif
                        <div id="overlayText" class="overlay-text">
                            <span id="overlayTextInner">Your Text</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="col-12 px-0">
                        <h3>Personalise sign</h3>
                        <div class="row">
                            <div class="col-12">
                                <span>Price {{ config('app.currency.symbol') }}</span>
                                <div class="mb-3">
                                    <label for="textInput" class="form-label">Enter Text</label>
                                    <textarea id="textInput" class="form-control" placeholder="Type here..."></textarea>
                                </div>

                                <div id="alignmentControls" class="btn-group w-100 mb-3">
                                    <button type="button" class="btn btn-outline-primary btn-alignment" data-align="left">
                                        <i class="fas fa-align-left"></i> Left
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-alignment "
                                        data-align="center">
                                        <i class="fas fa-align-center"></i> Center
                                    </button>
                                    <button type="button" class="btn btn-outline-primary btn-alignment" data-align="right">
                                        <i class="fas fa-align-right"></i> Right
                                    </button>
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
                                            <input type="color" id="textColor" class="form-control form-control-color"
                                                value="#000000" />
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="imageSelect" class="form-label">Choose Image</label>
                                        <select id="imageSelect" class="form-select">
                                            @if ($defaultImage)
                                                <option value="{{ $defaultImage->id }}"
                                                    data-image="{{ asset($defaultImage->image_path) }}" selected>
                                                    {{ $defaultImage->name }}
                                                </option>
                                            @endif

                                            @foreach ($customImages as $image)
                                                <option value="{{ asset($image->image_path) }}"
                                                    data-id="{{ $image->id }}">{{ $image->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>



                                    <div class="col-md-6 mb-3">
                                        <label for="sizeSelect" class="form-label">SIZE AT WIDEST POINT</label>
                                        <select id="sizeSelect" class="form-select">
                                            @foreach ($customSizes as $size)
                                                <option value="{{ $size->name }}" data-id="{{ $size->id }}"
                                                    data-extra-price="{{ $size->extra_price }}">
                                                    {{ $size->name }}
                                                    ({{ config('app.currency.symbol') }}{{ number_format($size->extra_price, 2) }})
                                                </option>
                                            @endforeach

                                        </select>
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

                                <div class="col-sm-12 text-end mt-5">
                                    <a href="javascript:void(0);" class="btn_black px-4 py-3 add-to-cart-btn"
                                        data-product-id="94">
                                        Add to Cart
                                    </a>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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


        // $(document).ready(function() {
        //     $('.add-to-cart-btn').on('click', function() {
        //         const button = $(this);

        //         //  Prevent double-click
        //         if (button.data('clicked')) return; // If already clicked, exit
        //         button.data('clicked', true);

        //         const productId = $(this).data('product-id');
        //         const options = [];
        //         let valid = true;
        //         const handledNames = new Set(); // Track processed input names
        //         var errorShown = false; // Track if toastr error was already shown


        //         $('[name^="options["]').each(function() {
        //             const input = $(this);
        //             const name = input.attr('name');
        //             const tag = input.prop('tagName').toLowerCase();
        //             const type = input.attr('type') || tag;

        //             if (handledNames.has(name)) return; // skip duplicates
        //             handledNames.add(name);

        //             // -------- SELECT --------
        //             if (tag === 'select') {
        //                 const selected = input.find(':selected');
        //                 const valueId = selected.val();
        //                 const optionId = selected.data('option-id');

        //                 if (!valueId || !optionId) {
        //                     toastr.error(
        //                         'Please select all required options before adding to cart.');
        //                     button.removeData('clicked');
        //                     valid = false;
        //                     return false;
        //                 }

        //                 //  Debug here
        //                 console.log('option_id:', optionId);
        //                 console.log('option_value_id:', valueId);

        //                 options.push({
        //                     option_id: optionId,
        //                     option_value_id: valueId,
        //                     quantity: selected.data('quantity'),
        //                     subtract: selected.data('subtract'),
        //                     price_prefix: selected.data('price_prefix'),
        //                     price: selected.data('price')
        //                 });
        //             }

        //             // -------- RADIO --------
        //             else if (type === 'radio') {
        //                 const selected = $(`input[name="${name}"]:checked`);
        //                 if (selected.length === 0) {
        //                     toastr.error(
        //                         'Please select at least one option before adding to cart.');
        //                     button.removeData('clicked');
        //                     valid = false;
        //                     return false;
        //                 }

        //                 options.push({
        //                     option_id: selected.data('option-id'),
        //                     option_value_id: selected.val(),
        //                     quantity: selected.data('quantity'),
        //                     subtract: selected.data('subtract'),
        //                     price_prefix: selected.data('price_prefix'),
        //                     price: selected.data('price')
        //                 });
        //             }

        //             // -------- CHECKBOX --------
        //             else if (type === 'checkbox') {
        //                 const checked = $(`input[name="${name}"]:checked`);
        //                 if (checked.length === 0) {
        //                     toastr.error('Please select at least one checkbox option.');
        //                     button.removeData('clicked');
        //                     valid = false;
        //                     return false;
        //                 }

        //                 checked.each(function() {
        //                     const checkbox = $(this);
        //                     options.push({
        //                         option_id: checkbox.data('option-id'),
        //                         option_value_id: checkbox.val(),
        //                         quantity: checkbox.data('quantity'),
        //                         subtract: checkbox.data('subtract'),
        //                         price_prefix: checkbox.data('price_prefix'),
        //                         price: checkbox.data('price')
        //                     });
        //                 });
        //             }

        //             // -------- TEXT / TEXTAREA / FILE / DATE / TIME --------
        //             else if (['text', 'textarea', 'file', 'date', 'time', 'datetime-local']
        //                 .includes(type)) {
        //                 const val = input.val();
        //                 const optionId = name.match(/\d+/)?.[0];

        //                 if (!val) {
        //                     toastr.error(
        //                         'Please fill all required input fields before adding to cart.');
        //                     button.removeData('clicked');
        //                     valid = false;
        //                     return false;
        //                 }

        //                 if (type !== 'file') {
        //                     options.push({
        //                         option_id: optionId,
        //                         value: val
        //                     });
        //                 }
        //             }
        //         });

        //         if (!valid) return;

        //         const formData = new FormData();
        //         formData.append('_token', "{{ csrf_token() }}");
        //         formData.append('product_id', productId);

        //         // Append all collected options
        //         options.forEach((opt, i) => {
        //             for (const key in opt) {
        //                 formData.append(`options[${i}][${key}]`, opt[key]);
        //             }
        //         });

        //         // Append any files (file inputs are handled separately)
        //         $('input[type="file"][name^="options["]').each(function() {
        //             const fileInput = $(this);
        //             const files = fileInput[0].files;
        //             const optionId = fileInput.attr('name').match(/\d+/)?.[0];

        //             if (files.length > 0 && optionId) {
        //                 formData.append(`files[${optionId}]`, files[0]);
        //             }
        //         });

        //         // Perform AJAX request
        //         $.ajax({
        //             url: "{{ route('user.add-cart') }}",
        //             method: "POST",
        //             data: formData,
        //             processData: false,
        //             contentType: false,
        //             success: function(response) {
        //                 toastr.success(response.message ||
        //                     'Product added to cart successfully!');
        //                 const button = $(`.add-to-cart-btn[data-product-id="${productId}"]`);
        //                 button.text('Added to Cart').addClass('disabled').css('pointer-events',
        //                     'none');
        //                 updateCartCount();
        //             },
        //             error: function(xhr) {
        //                 toastr.error(xhr.responseJSON?.message ||
        //                     'Failed to add product to cart.');
        //                 button.removeData('clicked');
        //                 console.error('AJAX Error:', xhr);
        //             }
        //         });
        //     });
        // });
        $(document).ready(function() {
            $('.add-to-cart-btn').on('click', function() {
                const button = $(this);
                const productId = button.data('product-id');
                const text = $('#textInput').val().trim();
                const font = $('#fontSelect').val();
                const color = $('#textColor').val();
                const alignment = $('.btn-alignment.active').data('align');
                const imageUrl = $('#imageSelect').val();
                const imageId = $('#imageSelect option:selected').data('id'); // You'll set this in HTML
                const size = $('#sizeSelect').val();
                const sizeId = $('#sizeSelect option:selected').data('id'); // You'll set this in HTML
                const usageType = $('#usageType').val();

                // --- Validate required fields ---
                if (!text) {
                    toastr.error('Please enter your custom text.');
                    return;
                }

                if (!font || !color || !alignment || !imageUrl || !size || !usageType) {
                    toastr.error('Please fill all customization fields before adding to cart.');
                    return;
                }

                const formData = new FormData();
                formData.append('_token', "{{ csrf_token() }}");
                formData.append('custom_text', text);
                formData.append('font', font);
                formData.append('color', color);
                formData.append('alignment', alignment);
                formData.append('image_id', imageId);
                formData.append('image_url', imageUrl); // optional if needed
                formData.append('size_id', sizeId);
                formData.append('size', size); // optional if needed
                formData.append('usage_type', usageType);

                // --- AJAX Submit ---
                $.ajax({
                    url: "{{ route('user.add-cart') }}", // Adjust route if needed
                    method: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        toastr.success(response.message || 'Custom product added to cart!');
                        button.text('Added to Cart').addClass('disabled').css('pointer-events',
                            'none');
                        updateCartCount();
                    },
                    error: function(xhr) {
                        toastr.error(xhr.responseJSON?.message ||
                            'Failed to add custom product.');
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
        $(document).ready(function() {
            const textInput = $('#textInput');
            const overlayTextInner = $('#overlayTextInner');
            const textColorPicker = $('#textColor');
            const fontSelect = $('#fontSelect');
            const imageSelect = $('#imageSelect');
            const selectedImage = $('#selectedImage');

            imageSelect.on('change', function() {
                const selectedOption = $(this).find(':selected');
                const imagePath = selectedOption.data('image');
                selectedImage.attr('src', imagePath);
            });


            textInput.on('input', function() {
                overlayTextInner.text($(this).val());
            });

            textColorPicker.on('input', function() {
                overlayTextInner.css('color', $(this).val());
            });

            fontSelect.on('change', function() {
                overlayTextInner.css('font-family', $(this).val());
            });

            $(document).on('click', '.btn-alignment', function(event) {
                console.log('Button clicked:', $(this).data('align'));
                changeAlignment(event.currentTarget); // <- this fixes the issue
            });

            setDefaultAlignment();
        });

        window.changeAlignment = function(button) {
            const overlayText = $('#overlayText');
            const overlayTextInner = $('#overlayTextInner');

            $('.btn-alignment').removeClass('active');
            $(button).addClass('active');

            let align = $(button).data('align'); // ✅ Correct way

            if (align === 'left') {
                overlayText.css('justify-content', 'flex-start');
                overlayTextInner.css('text-align', 'left');
            } else if (align === 'center') {
                overlayText.css('justify-content', 'center');
                overlayTextInner.css('text-align', 'center');
            } else if (align === 'right') {
                alert('Right alignment is not supported yet.');
                overlayText.css('justify-content', 'flex-end');
                overlayTextInner.css('text-align', 'right');
            }
        }


        function setDefaultAlignment() {
            $('.btn-alignment[data-align="center"]').trigger('click');
        }
    </script>

@endsection
