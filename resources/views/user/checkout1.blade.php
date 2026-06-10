@extends('layouts.app')
@section('title')
    Checkout
@endsection
@section('content')
    <div class="page-title">
        <div class="container">
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="/">Home</a></li>
                    <li class="separator"></li>
                    <li>Billing address</li>
                </ul>
            </div>
        </div>
    </div>

    <section id="cart" class="my-5">
        <div class="container">
            <div class="row  cart_con">
                <div class="col-lg-8 ps-xl-4 pe-xl-5 pe-lg-3 py-3 cart_left">
                    <div class="d-flex flex-wrap justify-content-between align-items-center w-100">
                        <h5>Contact Information</h5>
                        {{-- <h6>Already have an account? <span>Sign in now</span></h6> --}}
                        @guest
                            {{-- <h6>Already have an account? <span>Sign in now</span></h6>
                            <a href="/login"><span>Sign in now</span></a> --}}
                            {{-- <h6>Already have an account? <a href="{{ route('user.register') }}" class="text-orang">Sign in now</a></h6> --}}
                            <h6>Already have an account?<a
                                    href="{{ route('user.register', ['redirect_to' => url()->current()]) }}"
                                    class="text-orang">Sign
                                    in now</a> </h6>



                        @endguest
                    </div>
                    <form id="shippingForm" method="POST" action="{{ route('user.billing.address.store') }}">
                        @csrf
                        <div class="row gy-3 floating_lables">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="email_phone"
                                        placeholder="Email or mobile number"
                                        value="{{ auth()->check() ? auth()->user()->email : '' }}">
                                    <label for="email_phone ">Email / Phone #</label>
                                </div>
                            </div>
                            <div class="col-12 mt-4 pt-2">
                                <div class="d-flex flex-wrap justify-content-between align-items-center w-100">
                                    <h5>Billing Information</h5>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="firstName" placeholder="Last Name"
                                        name="firtName" required value="{{ $user->first_name ?? '' }}">
                                    <label for="firstName ">First Name</label>
                                </div>
                                @error('firtName')
                                    <p class="text-danger text-start">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="lastName " placeholder="Last Name"
                                        name="lastName" required value="{{ $user->last_name ?? '' }}">
                                    <label for="lastName ">Last Name</label>
                                </div>
                                @error('lastName')
                                    <p class="text-danger text-start">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="Address1" placeholder="Address Line 1"
                                        name="address1" required value="{{ old('address1') }}">
                                    <label for="Address1">Address</label>
                                </div>
                                @error('address1')
                                    <p class="text-danger text-start">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="Address2" placeholder="Address Line 2"
                                        name="address2" required value="{{ old('address2') }}">
                                    <label for="Address2 ">Address Line 2</label>
                                </div>
                                @error('address2')
                                    <p class="text-danger text-start">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="contact" placeholder="Contact Number"
                                        name="contact" required value="{{ old('contact') }}">
                                    <label for="contact ">Contact #</label>
                                </div>
                                @error('contact')
                                    <p class="text-danger text-start">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="City" placeholder="City"
                                        name="city" required value="{{ old('city') }}">
                                    <label for="City ">City</label>
                                </div>
                                @error('city')
                                    <p class="text-danger text-start">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="zip_code" placeholder="Zip Code"
                                        name="zip_code" required value="{{ old('zip_code') }}">
                                    <label for="zip_code ">Zip Code</label>
                                </div>
                                @error('zip_code')
                                    <p class="text-danger text-start">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 my-lg-5 my-4">
                                <div class="d-flex align-items-center gap-2">
                                    <input type="checkbox" id="check_input" class="check_box" name="check_input">
                                    <p class="m-0"><label for="check_input">Keep me up to date on news and
                                            products.</label></p>
                                </div>
                            </div>
                            <div class="col-md-6 offset-md-6 text-end">
                                <button class="btn_black" type="submit">Continue to Shipping</button>
                            </div>
                        </div>
                    </form>


                    <div class="col-6 cuspm">
                        <a href="{{ route('user.cart') }}" class="btn_back float-start">
                            <img src="./assets/imgs/arrow-right.svg" alt="ForbSign" loading="lazy">
                            Back to Cart
                        </a>
                    </div>

                </div>

                <div class="col-lg-4 cart_right py-3 mb-3">
                    <!-- Cart Summary -->
                    <div class="d-flex flex-wrap justify-content-between align-items-baseline w-100 ">
                        <h5 class="heading_24">Order Summary</h5>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between align-items-baseline w-100 ">
                        <table class="cart_prodet">
                            <tr>
                                <h4>Deliver to:{{ Auth::check() ? Auth::user()->first_name : 'Guest User' }}</h4>
                            </tr>

                        </table>
                        <hr class="w-100">
                        <table class="cart_prodet w-100">
                            <tr>
                                <td>Subtotal</td>
                                <td class="heading_24 fw-bold text-end">
                                    {{ config('app.currency.symbol') }}{{ $total_cart }}</td>
                            </tr>
                            <tr>
                                <td>Shipping</td>
                                <td class="text-end">Free</td>
                            </tr>
                        </table>
                        <hr class="w-100">
                        <table class="cart_prodet w-100">
                            <tr>
                                <td>Total</td>
                                <td class="heading_24 fw-bold text-end">{{ $total_cart }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="container padding-bottom-3x mb-1 mt-5 checkut-page">
                        <div class="row">
                            <!-- Payment Methode-->

                            <div class="card">
                                <div class="card-body">

                                    <h6>Pay with :</h6>
                                    <div class="row mt-4">
                                        <div class="col-12">
                                            <div class="payment-methods">
                                                <div class="single-payment-method">
                                                    <a class="text-decoration-none p-2" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#stripe">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            style="width: 50px; height: 50px"
                                                            viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                                            <path
                                                                d="M165 144.7l-43.3 9.2-.2 142.4c0 26.3 19.8 43.3 46.1 43.3 14.6 0 25.3-2.7 31.2-5.9v-33.8c-5.7 2.3-33.7 10.5-33.7-15.7V221h33.7v-37.8h-33.7zm89.1 51.6l-2.7-13.1H213v153.2h44.3V233.3c10.5-13.8 28.2-11.1 33.9-9.3v-40.8c-6-2.1-26.7-6-37.1 13.1zm92.3-72.3l-44.6 9.5v36.2l44.6-9.5zM44.9 228.3c0-6.9 5.8-9.6 15.1-9.7 13.5 0 30.7 4.1 44.2 11.4v-41.8c-14.7-5.8-29.4-8.1-44.1-8.1-36 0-60 18.8-60 50.2 0 49.2 67.5 41.2 67.5 62.4 0 8.2-7.1 10.9-17 10.9-14.7 0-33.7-6.1-48.6-14.2v40c16.5 7.1 33.2 10.1 48.5 10.1 36.9 0 62.3-15.8 62.3-47.8 0-52.9-67.9-43.4-67.9-63.4zM640 261.6c0-45.5-22-81.4-64.2-81.4s-67.9 35.9-67.9 81.1c0 53.5 30.3 78.2 73.5 78.2 21.2 0 37.1-4.8 49.2-11.5v-33.4c-12.1 6.1-26 9.8-43.6 9.8-17.3 0-32.5-6.1-34.5-26.9h86.9c.2-2.3 .6-11.6 .6-15.9zm-87.9-16.8c0-20 12.3-28.4 23.4-28.4 10.9 0 22.5 8.4 22.5 28.4zm-112.9-64.6c-17.4 0-28.6 8.2-34.8 13.9l-2.3-11H363v204.8l44.4-9.4 .1-50.2c6.4 4.7 15.9 11.2 31.4 11.2 31.8 0 60.8-23.2 60.8-79.6 .1-51.6-29.3-79.7-60.5-79.7zm-10.6 122.5c-10.4 0-16.6-3.8-20.9-8.4l-.3-66c4.6-5.1 11-8.8 21.2-8.8 16.2 0 27.4 18.2 27.4 41.4 .1 23.9-10.9 41.8-27.4 41.8zm-126.7 33.7h44.6V183.2h-44.6z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="single-payment-method">
                                                    <a class="text-decoration-none p-2" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#bank">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            style="width: 50px; height: 50px"
                                                            viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                                            <path
                                                                d="M243.4 2.6l-224 96c-14 6-21.8 21-18.7 35.8S16.8 160 32 160l0 8c0 13.3 10.7 24 24 24l400 0c13.3 0 24-10.7 24-24l0-8c15.2 0 28.3-10.7 31.3-25.6s-4.8-29.9-18.7-35.8l-224-96c-8-3.4-17.2-3.4-25.2 0zM128 224l-64 0 0 196.3c-.6 .3-1.2 .7-1.8 1.1l-48 32c-11.7 7.8-17 22.4-12.9 35.9S17.9 512 32 512l448 0c14.1 0 26.5-9.2 30.6-22.7s-1.1-28.1-12.9-35.9l-48-32c-.6-.4-1.2-.7-1.8-1.1L448 224l-64 0 0 192-40 0 0-192-64 0 0 192-48 0 0-192-64 0 0 192-40 0 0-192zM256 64a32 32 0 1 1 0 64 32 32 0 1 1 0-64z" />
                                                        </svg>
                                                    </a>
                                                </div>


                                                <div class="single-payment-method">
                                                    <a class="text-decoration-none p-2" href="#"
                                                        data-bs-toggle="modal" data-bs-target="#cod">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                            style="width: 50px; height: 50px"
                                                            viewBox="0 0 640 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                                            <path
                                                                d="M48 0C21.5 0 0 21.5 0 48L0 368c0 26.5 21.5 48 48 48l16 0c0 53 43 96 96 96s96-43 96-96l128 0c0 53 43 96 96 96s96-43 96-96l32 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l0-64 0-32 0-18.7c0-17-6.7-33.3-18.7-45.3L512 114.7c-12-12-28.3-18.7-45.3-18.7L416 96l0-48c0-26.5-21.5-48-48-48L48 0zM416 160l50.7 0L544 237.3l0 18.7-128 0 0-96zM112 416a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm368-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Cash on Transfer-->
                            <div class="modal fade" id="cod" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title">Transaction Cash On Delivery</h6>
                                            <button class="close" type="button" data-bs-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <form action="{{ route('user.checkout.cash.on.delivery') }}" method="POST"
                                            class="payment-form">
                                            @csrf
                                            <input type="hidden" name="payment_method" value="Cash On Delivery"
                                                id="">
                                            <div class="card-body">
                                                <p class="p-3">Cash on Delivery basically means you will pay the amount
                                                    of product
                                                    while you get the
                                                    item delivered to you.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn_black" type="button"
                                                    data-bs-dismiss="modal"><span>Cancel</span></button>
                                                <button class="orang_btn px-3" type="submit"><span>Cash On
                                                        Delivery</span></button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal Stripe -->

                            <div class="modal fade" id="stripe" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('user.checkout.stripe') }}" method="POST"
                                            class="payment-form">
                                            @csrf
                                            <div class="modal-header">
                                                <h6 class="modal-title">Transactions via Stripe</h6>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input class="form-control mb-2 card-number" name="card"
                                                    placeholder="Card Number" required>
                                                <input class="form-control mb-2 card-expiry-month" name="month"
                                                    placeholder="Expiration Month" required>
                                                <input class="form-control mb-2 card-expiry-year" name="year"
                                                    placeholder="Expiration Year" required>
                                                <input class="form-control mb-2 card-cvc" name="cvc"
                                                    placeholder="CVV" required>
                                                <input type="hidden" name="payment_method" value="Stripe">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn_black"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="orang_btn px-3">Checkout With
                                                    Stripe</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>



                            <!-- Modal bank -->
                            <div class="modal fade" id="bank" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title">Transactions via Bank Transfer</h6>
                                            <button class="close" type="button" data-bs-dismiss="modal"
                                                aria-label="Close"><span aria-hidden="true">×</span></button>
                                        </div>
                                        <form action="{{ route('user.checkout.bank.transfer') }}" method="POST"
                                            class="payment-form">
                                            <div class="modal-body">
                                                <div class="col-lg-12 form-group">
                                                    <label for="transaction">Transaction Number</label>
                                                    <input class="form-control" name="transaction" id="transaction"
                                                        placeholder="Enter Your Transaction Number" required="">
                                                </div>
                                                <p></p>
                                                <p>Account Number : 434 3434 3334</p>
                                                <p>Pay With Bank Transfer.</p>
                                                <p>Account Name : Jhon Due</p>
                                                <p>Account Email : demo@gmail.com</p>
                                                <p></p>
                                            </div>
                                            <div class="modal-footer">
                                                @csrf
                                                <input type="hidden" name="payment_method" value="Bank">
                                                <button class="btn_black" type="button"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button class="orang_btn px-3" type="submit"><span>Checkout
                                                        With Bank
                                                        Transfer</span>
                                                </button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div>
                        <button class="btn_black px-4" type="submit">Place Order</button>
                    </div>
                </div>

                <!-- Accordion End -->

            </div>

        </div>
    </section>
@endsection
@section('footer')
    <script>
        document.querySelector('.btn-place-order').addEventListener('click', function() {
            var orderModal = new bootstrap.Modal(document.getElementById('stripe'));
            orderModal.show();
        });

        // Listen for modal close event and remove the backdrop
        document.getElementById('stripe').addEventListener('hidden.bs.modal', function() {
            var backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
        });

        document.querySelector('.btn-place-order').addEventListener('click', function() {
            var orderModal = new bootstrap.Modal(document.getElementById('stripe'));
            orderModal.show();
        });
    </script>
    <script>
        $(document).ready(function() {
            // alert('heoo');
            $('.payment-form').on('submit', function(e) {
                e.preventDefault(); // prevent default submit

                const $paymentForm = $(this);
                let shippingValid = true;
                let paymentValid = true;

                // Validate shipping form inputs (required fields)
                $('#shippingForm input[required], #shippingForm select[required], #shippingForm textarea[required]')
                    .each(function() {
                        if ($(this).val().trim() === '') {
                            shippingValid = false;
                            $(this).addClass('is-invalid'); // add invalid class or style
                        } else {
                            $(this).removeClass('is-invalid');
                        }
                    });

                // Validate payment form inputs (required fields)
                $paymentForm.find('input[required], select[required], textarea[required]').each(function() {
                    if ($(this).val().trim() === '') {
                        paymentValid = false;
                        $(this).addClass('is-invalid');
                    } else {
                        $(this).removeClass('is-invalid');
                    }
                });

                // Show error alert if shipping invalid
                if (!shippingValid) {
                    alert('Please fill out all required shipping fields.');
                    // Optionally, you can focus first invalid field
                    $('#shippingForm .is-invalid').first().focus();
                    return false;
                }

                // Show error alert if payment invalid
                if (!paymentValid) {
                    alert('Please fill out all required payment fields.');
                    $paymentForm.find('.is-invalid').first().focus();
                    return false;
                }

                // Both forms valid, submit payment form
                // Remove event handler to avoid infinite loop
                $paymentForm.off('submit');
                $paymentForm.submit();
            });
        });
    </script>
@endsection
