@extends('layouts.app')
@section('title')
    Cart
@endsection
@section('content')
    <div class="page-title">
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
    </div>
    <section id="cart" class="my-5">
        <div class="container">
            <div class="row cart_con">
                <div class="col-lg-8 ps-xl-4 pe-xl-5 pe-lg-3 py-3 cart_left">
                    <div class="d-flex flex-wrap justify-content-between align-items-center w-100">
                        <h5>Cart Information</h5>
                    </div>
                    <div class="row gy-3 w-100 mx-auto">
                        <div class="col-12 border py-2">
                            @if (auth()->check() && $carts->isNotEmpty())
                                <div class="d-flex justify-content-between align-items-center w-100">
                                    <div class="d-flex align-items-center gap-2">
                                        <input type="checkbox" id="check_input" class="check_box">
                                        <p class="m-0"><label for="check_input">SELECT ALL ( item (s))</label></p>
                                    </div>
                                    <button type="button" class="del_btn" id="delete-all">
                                        <img src="./assets/imgs/trash.svg" alt="Trash" loading="lazy">
                                    </button>
                                </div>
                            @else
                                <p class="alert alert-danger text-center">your cart is empty</p>
                            @endif
                        </div>
                        <div class="col-12 cart2 py-2 py-lg-3 table-responsive px-0">
                            <table>
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td>
                                            {{-- <input type="checkbox" class="check_box" data-id="{{ $cart->id }}"> --}}
                                            <input type="checkbox" class="check_item" name="cart_ids[]"
                                                data-id="{{ $cart->id }}">
                                        </td>


                                        <td>
                                            <img src="{{ asset('storage/' . $cart->product->featured_image) }}"
                                                alt="" loading="lazy" style="min-width: 100px;">
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                                                <div class="d-flex justify-content-between align-items-center gap-3 w-100">
                                                    <h6 class="heading_18">{{ $cart->product->name }}</h6>
                                                    <h5 class="m-0 heading_24 text-orang">
                                                        £{{ number_format($cart->total, 2) }}</h5>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center gap-3 w-100">
                                                    <p class="des">{{ $cart->product->description }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-end align-items-center gap-2">
                                                <button type="button" class="del_btn wishlist">
                                                    <!-- Your SVG or icon here -->
                                                </button>
                                                <button type="button" class="del_btn" id="delete-selected">
                                                    <img src="./assets/imgs/trash.svg" alt="Trash" loading="lazy"
                                                        style="width: 18px;">
                                                </button>
                                                {{-- <button type="button" class="btn btn-danger" id="delete-selected">
                                                    Delete Selected
                                                </button> --}}

                                            </div>
                                            {{-- <div class="number mt-3">
                                                <span class="minus"><img src="./assets/imgs/minus-square-Regular.svg"
                                                        alt=""></span>
                                                <input type="text" class="num_input" value="{{ $cart->qty }}"
                                                    disabled />
                                                <span class="plus"><img src="./assets/imgs/plus-square-Regular.svg"
                                                        alt=""></span>
                                            </div> --}}
                                            <div class="number mt-3">
                                                <span class="minus" data-id="{{ $cart->id }}"><img
                                                        src="./assets/imgs/minus-square-Regular.svg" alt=""></span>
                                                <input type="text" class="num_input" value="{{ $cart->qty }}"
                                                    data-id="{{ $cart->id }}" disabled />
                                                <span class="plus" data-id="{{ $cart->id }}"><img
                                                        src="./assets/imgs/plus-square-Regular.svg" alt=""></span>
                                            </div>

                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between gap-3 w-100">
                                <a href="{{ route('user.store') }}" class="btn_back float-start">
                                    <img src="./assets/imgs/arrow-right.svg" alt="ForbSign" loading="lazy"> Back to Products
                                </a>
                                {{-- <button class="btn_black shippingToCart">Continue to Shipping</button> --}}
                                <button class="btn_black mt-4 ms-auto shippingToCart">Proceed to Checkout</button>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 cart_right py-3 mb-3">
                    <div class="d-flex flex-wrap justify-content-between align-items-baseline w-100 ">
                        <h5 class="heading_24">Order Summary</h5>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between align-items-baseline w-100 ">
                        <table class="cart_prodet w-100">
                            <tr>
                                <td>Subtotal</td>
                                <td class="text-orang text-end">
                                    <h6>£{{ number_format($total_cart, 2) }}</h6>
                                </td>
                            </tr>
                            <tr>
                                <td>Shipping</td>
                                <td class="text-orang text-end">£5.00</td> <!-- You can make this dynamic as well -->
                            </tr>
                        </table>
                        <hr class="w-100">
                        <table class="cart_prodet w-100">
                            <tr>
                                <td>Total</td>
                                <td class="heading_24 fw-bold text-end">£{{ number_format($total_cart + 5, 2) }}</td>
                                <!-- Total can be dynamic based on shipping -->
                            </tr>
                        </table>
                        <hr class="w-100">
                        {{-- <button class="btn_black mt-4 ms-auto shippingToCart">Proceed to Checkout</button> --}}
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
    <script type="text/javascript">
        // Use jQuery to handle the click event on all buttons with the class 'shippingToCart'
        $(document).ready(function() {
            $('.shippingToCart').on('click', function() {
                window.location.href = "/checkout";
            });
        });
    </script>
    <script>
        //  DELETE SELECTED ITEMS
        $('#delete-selected').click(function() {
            let selectedIds = [];

            // Get the checked checkboxes and push the data-id into selectedIds
            $('input[name="cart_ids[]"]:checked').each(function() {
                selectedIds.push($(this).data('id'));
            });

            if (selectedIds.length === 0) {
                toastr.error('Please select at least one item to delete.');
                return;
            }

            // Confirm before deleting
            if (!confirm("Are you sure you want to delete selected items?")) return;

            $.ajax({
                url: "{{ route('user.cart.remove') }}", // Route to handle bulk deletion
                method: "GET", // Use DELETE method
                data: {
                    _token: "{{ csrf_token() }}", // CSRF token
                    ids: selectedIds // Send the selected IDs in the request body
                },
                success: function(response) {
                    toastr.success('Product is removed from cart');
                    location.reload();
                },
                error: function() {
                    alert("Something went wrong while deleting selected items.");
                }
            });
        });


        //  DELETE ALL ITEMS
        $('#delete-all').click(function() {
            if (!confirm("Are you sure you want to delete ALL items from the cart?")) return;

            $.ajax({
                url: "{{ route('user.cart.clear') }}", //  Route 2: for deleting ALL
                method: "GET",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function() {
                    toastr.success('All items have been removed from the cart');
                    location.reload();
                },
                error: function() {
                    alert("Something went wrong while deleting all items.");
                }
            });
        });
        $('.plus').click(function() {
            const cartId = $(this).data('id');
            updateQuantity(cartId, 'increment');
        });

        $('.minus').click(function() {
            const cartId = $(this).data('id');
            updateQuantity(cartId, 'decrement');
        });

        function updateQuantity(cartId, action) {
            $.ajax({
                url: "{{ route('user.cart.update') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    cart_id: cartId,
                    action: action
                },
                success: function(response) {
                    toastr.success('Cart updated successfully');
                    location.reload(); // Or dynamically update DOM
                },
                error: function() {
                    toastr.error('Failed to update cart');
                }
            });
        }
    </script>
@endsection
