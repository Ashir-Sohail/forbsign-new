@extends('layouts.app')
@section('title')
    Track Order
@endsection
@section('content')
    @php
        use Illuminate\Support\Str;
    @endphp
    <section id="trackOrder" class="my-5 pb-4">
        <div class="container">
            <div class="text-center col-lg-6 col-md-8 mx-auto">
                <h3 class="header30_gray text-dark">
                    Order Tracker
                </h3>
                <p class="description">Checking the progress of your order is easy-peasy with our super-handy order
                    tracker.</p>
                <div class="info-panel gap-3 my-5">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                        <path fill-rule="evenodd"
                            d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <div class="text-start text-white">
                        <div class="mb-1"><strong>Please note.</strong></div>
                        If you have accepted a quote, please contact your account handler
                        for update information.
                    </div>
                </div>
            </div>
            <div class="signin_box white_box col-lg-6 col-md-8 px-lg-5 col-sm-10">
                <form method="post" action = "{{ route('user.trackorder.submit') }}">
                    @csrf
                    <div class="row gy-4 floating_lables">
                        <div class="col-12  mb-3">
                            <img src="{{ asset('assets/imgs/Fobsignlogo.svg') }}" alt="Fobsign logo" class=""
                                loading="lazy" style="width: 190px;">
                        </div>
                        <div class="col-12 mb-3">
                            <h5 class="mb-4">
                                Find your order
                            </h5>
                            <p>To check the status of an order, please enter your order number and email address in the
                                boxes below.</p>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="orderNumber" placeholder="Order Number"
                                    name="order_number" required>
                                <label for="orderNumber">Order Number</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email Address" required>
                                <label for="email">Email Address</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn primery_btn w-100 rounded-0">Check Order Status</button>
                        </div>
                    </div>
                </form>
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
