@extends('layouts.app')
@section('title')
    Cart
@endsection
@section('content')
    {{-- <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li><a href="/">Home</a> </li>
                        <li class="separator"></li>
                        <li>Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> --}}
    <section id="cart" class="my-5">
        <div class="container">
            @php $total = 0; @endphp
            
            @if (session('cart') && count(session('cart')) > 0)
                {{-- Cart has items - show existing cart functionality --}}
                @php
                    foreach(session('cart') as $item) {
                        $total += $item['current_price'] * $item['quantity'];
                    }
                @endphp
                <div class="row cart_con">
                    <div class="col-lg-8 ps-xl-4 pe-xl-5 pe-lg-3 py-3 cart_left">
                        <div class="d-flex flex-wrap justify-content-between align-items-center w-100">
                            <h5>{{ $cartpreferences['card_heading'] ?? '' }}</h5>
                        </div>
                        <div class="row gy-3 w-100 mx-auto">
                            <div class="col-12 border py-2">
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" id="check_input" class="check_box" />
                                        <p class="m-0"><label for="check_input">SELECT ALL
                                                ({{ count(session('cart')) }}
                                                item(s))</label></p>
                                    </div>
                                    <button type="button" class="del_btn" id="delete-all" style="background: transparent">
                                        <img src="./assets/imgs/trash.svg" alt="Trash" loading="lazy">
                                    </button>
                                </div>
                            </div>

                            <div class="col-12 cart2 py-2 py-lg-3 table-responsive px-0">
                                <table class="w-100">
                                    <tbody>
                                        @foreach (session('cart') as $id => $product)
                                            <tr data-id="{{ $id }}">
                                                <td>
                                                    <input type="checkbox" class="check_item" name="cart_ids[]"
                                                        value="{{ $id }}">
                                                </td>
                                                <td>
                                                    <img src="{{ \App\Helpers\FileUploadHelper::url($product['featured_image']) }}"
                                                        alt="Product Image" loading="lazy" class="product-img">
                                                </td>
                                                <td>
                                                    <div
                                                        class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                                        <div
                                                            class="d-flex justify-content-between align-items-center gap-3 w-100">
                                                            <h6 class="heading_18">{{ $product['name'] }}</h6>
                                                            <h5 class="m-0 heading_24 text-orang">
                                                                {{ config('app.currency.symbol') }}{{ number_format($product['current_price'] * $product['quantity'], 2) }}
                                                            </h5>
                                                        </div>
                                                        <div
                                                            class="d-flex justify-content-between align-items-center gap-3 w-100">
                                                            <p class="des">{{ $product['description'] }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-end align-items-center gap-2">
                                                        <a href="{{ route('user.wishlist.add', $id) }}"
                                                            class="del_btn wishlist">
                                                            <svg width="20" height="20" viewBox="0 0 20 20"
                                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M18.1099 3.0965C16.8629 1.5835 15.1299 0.750488 13.2279 0.750488C12.0839 0.750488 10.9779 1.02847 9.99992 1.55847C9.02292 1.02847 7.91693 0.750488 6.77193 0.750488C4.86993 0.750488 3.13594 1.5835 1.88994 3.0965C0.533937 4.7425 -0.0280681 6.9905 0.384932 9.1095C1.35993 14.1055 6.44793 17.5955 8.59093 18.8635C9.02593 19.1205 9.51292 19.2495 9.99992 19.2495C10.4869 19.2495 10.9749 19.1215 11.4099 18.8635C13.5519 17.5945 18.6409 14.1055 19.6159 9.1095C20.0279 6.9905 19.4659 4.7425 18.1099 3.0965ZM18.1429 8.82251C17.2849 13.2215 12.6139 16.4075 10.6449 17.5725C10.2479 17.8085 9.75193 17.8075 9.35493 17.5725C7.38593 16.4075 2.71492 13.2215 1.85692 8.82251C1.52792 7.13851 1.97392 5.35448 3.04692 4.05048C4.00392 2.88948 5.32593 2.25049 6.77193 2.25049C7.78993 2.25049 8.76593 2.53049 9.59593 3.06049C9.84193 3.21749 10.1579 3.21749 10.4039 3.06049C11.2339 2.53049 12.2099 2.25049 13.2279 2.25049C14.6729 2.25049 15.9959 2.88948 16.9529 4.05048C18.0259 5.35448 18.4709 7.13751 18.1429 8.82251Z"
                                                                    fill="{{ in_array($product['id'], $wishlistProductIds) ? '#FF0000' : '#41416E' }}"
                                                                    fill-opacity="{{ in_array($product['id'], $wishlistProductIds) ? '1' : '0.2' }}">
                                                                </path>
                                                            </svg>
                                                            <a type="button" class="del_btn delete-selected">
                                                                <img src="./assets/imgs/trash.svg" alt="Trash"
                                                                    loading="lazy" style="width: 18px;">
                                                            </a>
                                                        </div>
                                                        <div class="number mt-3">
                                                            <span class="minus"><img
                                                                    src="./assets/imgs/minus-square-Regular.svg"
                                                                    alt=""></span>
                                                            <input type="text" class="num_input"
                                                                value="{{ $product['quantity'] }}" disabled>
                                                            <span class="plus"><img
                                                                    src="./assets/imgs/plus-square-Regular.svg"
                                                                    alt=""></span>
                                                        </div>

                                                        <input type="hidden" name="quantity[{{ $id }}]"
                                                            value="{{ $product['quantity'] }}" class="quantity_input">
                                                        <input type="hidden" name="subtotal_price[{{ $id }}]"
                                                            value="{{ $product['current_price'] * $product['quantity'] }}">
                                                    </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12">
                                <div class="d-flex align-items-center justify-content-between gap-3 w-100 mt-3">
                                    <a href="{{ route('user.store') }}" class="btn_back float-start">
                                        <img src="./assets/imgs/arrow-right.svg" alt="ForbSign" loading="lazy">{{ $cartpreferences['card_button1'] ?? '' }}
                                    </a>
                                    <button class="btn_black ms-auto shippingToCart">{{ $cartpreferences['card_button2'] ?? '' }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 cart_right py-3 mb-3">
                        <div class="d-flex flex-wrap justify-content-between align-items-baseline w-100 ">
                            <h5 class="heading_24">{{ $cartpreferences['order_heading'] ?? '' }}</h5>
                        </div>
                        <div class="d-flex flex-wrap justify-content-between align-items-baseline w-100 ">
                            <table class="cart_prodet w-100">
                                <tr>
                                    <td>{{ $cartpreferences['card_subtotal'] ?? '' }}</td>
                                    <td class="text-orang text-end">
                                        <h6>{{ config('app.currency.symbol') }}{{ number_format($total, 0) }}
                                        </h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $cartpreferences['card_shipping'] ?? '' }}</td>
                                    <td class="text-orang text-end">Free</td>
                                </tr>
                            </table>
                            <hr class="w-100">
                            <table class="cart_prodet w-100">
                                <tr>
                                    <td>Total</td>
                                    <td class="heading_24 fw-bold text-end">
                                        {{ config('app.currency.symbol') }}{{ number_format($total, 0) }}</td>
                                </tr>
                            </table>
                            <hr class="w-100">
                        </div>
                    </div>
                </div>
            @else
                {{-- Cart is empty - show empty cart UI --}}
                <div class="row justify-content-center">
                    <div class="col-lg-6 col-md-8 col-12">
                        <div class="text-center py-5">
                            {{-- Shopping Cart Icon --}}
                            <div class="empty-cart-icon mb-4">
                                <svg width="120" height="120" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-muted">
                                    <path d="M2.99999 2H4.99999L6.29599 14.98L5.74999 16C5.74999 16 5.77999 16.5 6.29999 16.5H18.5L19.5 4.5H5.99999" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M2.5 2H3.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M7.5 7.5C7.5 8.32843 6.82843 9 6 9C5.17157 9 4.5 8.32843 4.5 7.5C4.5 6.67157 5.17157 6 6 6C6.82843 6 7.5 6.67157 7.5 7.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.5 7.5C16.5 8.32843 15.8284 9 15 9C14.1716 9 13.5 8.32843 13.5 7.5C13.5 6.67157 14.1716 6 15 6C15.8284 6 16.5 6.67157 16.5 7.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 21C9.55228 21 10 20.5523 10 20C10 19.4477 9.55228 19 9 19C8.44772 19 8 19.4477 8 20C8 20.5523 8.44772 21 9 21Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16 21C16.5523 21 17 20.5523 17 20C17 19.4477 16.5523 19 16 19C15.4477 19 15 19.4477 15 20C15 20.5523 15.4477 21 16 21Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </div>
                            
                            {{-- Empty Cart Heading --}}
                            <h2 class="mb-3" style="font-weight: 600; color: #2c3e50;">Your Cart is Empty</h2>
                            
                            {{-- Description --}}
                            <p class="text-muted mb-4" style="font-size: 1.05rem; max-width: 450px; margin: 0 auto 1.5rem auto;">
                                Looks like you haven't added any products to your cart yet.
                            </p>
                            
                            {{-- Continue Shopping Button --}}
                            <a href="{{ route('user.store') }}" class="btn btn-dark btn-lg px-5 py-2.5" style="background-color: #41416E; min-width: 200px;">
                                Continue Shopping
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <div id="qualityhelpinstall" class="store_footer_top">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="qhi col-md-4">
                    <img src="{{ asset('assets/imgs/QualityMaterial.svg') }}" alt="" loading="lazy">
                    <h6>{{ $cartpreferences['information_heading1'] ?? '' }}</h6>
                    <p>
                        {{ $cartpreferences['information_description1'] ?? '' }}
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('assets/imgs/Help&Support.svg') }}" alt="Help and Support" loading="lazy">
                    <h6>{{ $cartpreferences['information_heading2'] ?? '' }}</h6>
                    <p>
                       {{ $cartpreferences['information_description2'] ?? '' }}
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('assets/imgs/Quick&Install.svg') }}" alt="Quick &amp; easy to install"
                        loading="lazy">
                    <h6>{{ $cartpreferences['information_heading3'] ?? '' }}</h6>
                    <p>
                        {{ $cartpreferences['information_Description3'] ?? '' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script type="text/javascript">
        // Use jQuery to handle the click event on all buttons with the class 'shippingToCart'
        $(document).ready(function() {
            $('.shippingToCart').on('click', function() {
                window.location.href = "{{ route('user.checkout') }}";
            });
        });
    </script>
    <script>
        $('#delete-all').click(function() {
            // Check if SELECT ALL checkbox is checked
            if (!$('.check_box').is(':checked')) {
                toastr.error('Please select the checkbox to delete all items.');
                return;
            }

            if (!confirm("Are you sure you want to delete ALL selected items from the cart?")) return;

            $.ajax({
                url: "{{ route('user.cart.clear') }}", // Route for deleting all
                method: "GET",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function() {
                    toastr.success('All selected items have been removed from the cart');
                    location.reload();
                },
                error: function() {
                    alert("Something went wrong while deleting selected items.");
                }
            });
        });


        $('.delete-selected').click(function() {
            // alert('Delete selected item');
            let selectedIds = [];

            $('input[name="cart_ids[]"]:checked').each(function() {
                selectedIds.push($(this).val()); // Collects selected IDs
            });

            if (selectedIds.length === 0) {
                toastr.error('Please select at least one item.');
                return;
            }

            if (!confirm("Are you sure you want to delete selected items?")) return;

            $.ajax({
                url: "{{ route('user.cart.remove.selected') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    ids: selectedIds
                },
                success: function() {
                    toastr.success('Selected items removed from cart.');
                    location.reload();
                },
                error: function() {
                    alert("Error deleting selected items.");
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.plus, .minus').on('click', function() {
                var $container = $(this).closest('.number');
                var $row = $(this).closest('tr');
                var productId = $row.data('id'); // assuming tr has data-id
                var $displayInput = $container.find('.num_input');
                var $hiddenQuantityInput = $row.find('.quantity_input');

                var quantity = parseInt($hiddenQuantityInput.val());

                if ($(this).hasClass('plus')) {
                    quantity++;
                } else if (quantity > 1) {
                    quantity--;
                }

                // Update both inputs
                $displayInput.val(quantity);
                $hiddenQuantityInput.val(quantity);

                // AJAX request
                $.ajax({
                    url: "{{ route('cart.updateQuantity') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            location.reload(); // reload to reflect prices
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            alert(xhr.responseJSON
                                .message); // show the detailed stock limit error
                            location.reload();
                        } else {
                            alert('Error updating quantity');
                        }
                    }
                });
            });
        });
    </script>
    <!-- Show the wishlist success message -->
    @if (session('message'))
        <script>
            toastr.success("{{ session('message') }}");
        </script>
    @endif
    <script>
        $('.check_box').on('click', function() {
            $('.check_item').prop('checked', this.checked);
        });
    </script>
@endsection
