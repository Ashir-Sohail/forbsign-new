@extends('layouts.app')
@section('title')
    Register
@endsection
@section('content')
    <div class="container padding-bottom-3x mb-1 mt-5">
        <!-- form code start -->
        <div class="signin_box white_box col-lg-6 col-md-8 px-lg-5 col-sm-10">
            <form action="{{ route('user.make.register') }}" method="POST">
                @csrf
                <!--Add hidden input for redirect_to Checkout Page-->
                <input type="hidden" name="redirect_to" value="{{ request('redirect_to') }}">

                <div class="row gy-4 floating_lables">
                    <div class="col-12 mb-md-5 mb-3">
                        <img src="{{ asset('assets/imgs/Fobsignlogo.svg') }}" alt="Fobsign logo" class="" loading="lazy"
                            style="width: 230px; max-width: 100%; height: auto;">
                    </div>
                    <div class="col-12">
                        <h5>
                            Account Registration
                        </h5>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="FirstName" placeholder="FirstName"
                                name="first_name" value="{{ old('first_name') }}">
                            <label for="FirstName">First Name</label>
                        </div>
                        @error('first_name')
                            <p class="text-danger text-start">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="LastName" placeholder="Last Name"
                                name="last_name" value="{{ old('last_name') }}">
                            <label for="LastName">Last Name</label>
                        </div>
                        @error('last_name')
                            <p class="text-danger text-start">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="Email" placeholder="Email" name="email"
                                value="{{ old('email') }}">
                            <label for="Email">Email</label>
                        </div>
                        @error('email')
                            <p class="text-danger text-start">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" placeholder="Password"
                                name="password" value="{{ old('password') }}">
                            <label for="Password">Password</label>
                        </div>
                        @error('password')
                            <p class="text-danger text-start">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-12 mt-lg-5 mt-3">
                        <div class="d-flex align-items-baseline gap-3">
                            <input type="checkbox" id="check_input" class="check_box">
                            <p class="m-0 text-start"><label for="check_input">I agree to the following <a href="#"
                                        class="page_link">Terms of Use</a><span class="text-orang"> / </span><a
                                        href="#" class="page_link"> Privacy
                                        Policy.</a></label></p>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn primary_btn w-100 rounded-0">Register Account</button>
                        <a type="button" class="orang_btn w-100 rounded-0 mt-3" href="{{ route('user.login') }}">Sign
                            in</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- form code end -->

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
    <script>
        const passwordInput = document.getElementById('login-pass');
        const showPasswordCheckbox = document.getElementById('show-password-checkbox');

        showPasswordCheckbox.addEventListener('change', function() {
            passwordInput.type = this.checked ? 'text' : 'password';
        });
    </script>
@endsection
