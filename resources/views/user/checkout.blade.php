@extends('layouts.app')
@section('title')
    Checkout
@endsection
@section('content')
    {{-- <div class="page-title">
        <div class="container">
            <div class="column">
                <ul class="breadcrumbs">
                    <li><a href="/">Home</a></li>
                    <li class="separator"></li>
                    <li>Billing address</li>
                </ul>
            </div>
        </div>
    </div> --}}

    <section id="cart" class="my-5">
        <div class="container">
            <div class="row  cart_con">
                <div class="col-lg-8 ps-xl-4 pe-xl-5 pe-lg-3 py-3 cart_left">
                    <div class="d-flex flex-wrap justify-content-between align-items-center w-100">
                        <h5>Contact Information</h5>
                        {{-- <h6>Already have an account? <span>Sign in now</span></h6> --}}
                        @guest
                            <h6>Already have an account?<a
                                    href="{{ route('user.register', ['redirect_to' => url()->current()]) }}"
                                    class="text-orang">Sign
                                    in now</a> </h6>

                        @endguest
                    </div>

                    <form id="payment-form" method="POST" action="{{ route('user.stripe.payment.store') }}">

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
                                        name="address1" required value="{{ old('address1', $billing_address->address1 ?? '') }}"
>
                                    <label for="Address1">Address</label>
                                </div>
                                @error('address1')
                                    <p class="text-danger text-start">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="Address2" placeholder="Address Line 2"
                                        name="address2" required value="{{ old('address2', $billing_address->address2 ?? '') }}">
                                    <label for="Address2 ">Address Line 2</label>
                                </div>
                                @error('address2')
                                    <p class="text-danger text-start">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="contact" placeholder="Contact Number"
                                        name="contact" required value="{{ old('contact', $billing_address->contact ?? '') }}">
                                    <label for="contact ">Contact #</label>
                                </div>
                                @error('contact')
                                    <p class="text-danger text-start">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="City" placeholder="City"
                                        name="city" required value="{{ old('city', $billing_address->city ?? '') }}">
                                    <label for="City ">City</label>
                                </div>
                                @error('city')
                                    <p class="text-danger text-start">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="zip_code" placeholder="Zip Code"
                                        name="zip_code" required value="{{ old('zip_code', $billing_address->zip_code ?? '') }}">
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

                        </div>

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
                            {{-- <tr>
                                <td>Shipping</td>
                                <td class="text-end">Free</td>
                            </tr> --}}
                        </table>
                        <hr class="w-100">
                        <table class="cart_prodet w-100">
                            <tr>
                                <td>Total</td>
                                <td class="heading_24 fw-bold text-end">{{ config('app.currency.symbol') }}{{ $total_cart }}</td>
                            </tr>
                        </table>
                    </div>
                    <hr>
                    <h5 class="heading_24">Payment With Stripe</h5>
                    <input type="hidden" name="stripeToken" id="stripe-token">
                    <input type="hidden" name="price" value="{{ $total_cart }}">
                    <div id="card-element" class="form-control"></div>


                    <div class="my-2">
                        <button class="btn_black px-4 mt-4" type="submit">Place Order</button>
                    </div>

                    </form>


                </div>

                <!-- Accordion End -->

            </div>

        </div>
    </section>

       <div id="qualityhelpinstall" class="store_footer_top">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="qhi col-md-4">
                    <img src="./assets/imgs/QualityMaterial.svg" alt="" loading="lazy">
                    <h6>Quality Material</h6>
                    <p>
                        The best materials make for the best job. It’s that simple. Every sign is 100% weatherproof
                        &amp;
                        resistant so they’re as durable as they are brilliantly designed.
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="./assets/imgs/Help&amp;Support.svg" alt="Help and Support" loading="lazy">
                    <h6>Help and Support</h6>
                    <p>
                        We’re all about happy customers. If you need help purchasing your sign please contact us during
                        office hours on 01795 505850, or why not try our&nbsp;live chat.
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="./assets/imgs/Quick&amp;Install.svg" alt="Quick &amp; easy to install" loading="lazy">
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
        document.addEventListener('DOMContentLoaded', function() {
            // var stripe = Stripe('{{ env('STRIPE_KEY') }}');
            var stripe = Stripe('{{ config('services.stripe.key') }}');

            var elements = stripe.elements();
            var cardElement = elements.create('card');
            cardElement.mount('#card-element');

            var form = document.getElementById('payment-form');

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Stop default submission

                stripe.createToken(cardElement).then(function(result) {
                    if (result.error) {
                        // Show error to user
                        alert(result.error.message);
                    } else {
                        // Add token to hidden input and submit the form
                        document.getElementById('stripe-token').value = result.token.id;
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
