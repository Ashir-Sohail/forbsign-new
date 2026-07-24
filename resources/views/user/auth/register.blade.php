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
                        <img src="{{ asset('assets/imgs/Fobsignlogo.svg') }}" alt="Fobsign logo" loading="lazy"
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
                        <div class="form-floating password-field">
                            <input type="password" class="form-control" id="password" placeholder="Password"
                                name="password" autocomplete="new-password">
                            <label for="password">Password</label>
                            <button type="button" class="password-toggle" data-target="password"
                                aria-label="Show password">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-danger text-start">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-12 mt-lg-5 mt-3">
                        <label for="check_input" class="register-agree">
                            <input type="checkbox" id="check_input" class="check_box register-agree__box">
                            <span class="register-agree__text">
                                I agree to the following
                                <a href="{{ route('user.terms') }}" class="page_link">Terms of Use</a><span
                                    class="text-orang"> / </span><a href="{{ route('user.terms') }}"
                                    class="page_link">Privacy Policy.</a>
                            </span>
                        </label>
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
    <style>
        .register-agree {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin: 0;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .floating_lables .register-agree .register-agree__box.check_box {
            flex: 0 0 18px;
            width: 18px !important;
            height: 18px !important;
            max-height: 18px !important;
            min-height: 18px !important;
            margin: 0 !important;
            padding: 0 !important;
            border: 1px solid #808080;
            box-sizing: border-box;
            align-self: center;
        }

        .register-agree__text,
        .floating_lables .register-agree__text,
        .floating_lables .register-agree__text span {
            flex: 1 1 auto;
            min-width: 0;
            font-family: "Poppins", sans-serif;
            font-size: 15px !important;
            font-weight: 400 !important;
            line-height: 1.45 !important;
            color: #333333 !important;
            opacity: 1 !important;
            text-align: left;
        }

        .register-agree__text .page_link,
        .floating_lables .register-agree__text .page_link {
            white-space: nowrap;
            font-size: inherit !important;
            line-height: inherit !important;
            font-weight: 500 !important;
            color: #EE903B !important;
            opacity: 1 !important;
        }

        .register-agree__text .text-orang,
        .floating_lables .register-agree__text .text-orang {
            font-size: inherit !important;
            line-height: inherit !important;
            color: #EE903B !important;
            opacity: 1 !important;
        }

        @media (max-width: 400px) {
            .register-agree {
                gap: 0.5rem;
            }

            .register-agree__text,
            .floating_lables .register-agree__text,
            .floating_lables .register-agree__text span {
                font-size: 13px !important;
            }
        }

        @media (max-width: 320px) {
            .register-agree__text,
            .floating_lables .register-agree__text,
            .floating_lables .register-agree__text span {
                font-size: 12px !important;
            }
        }

        .password-field {
            position: relative;
        }

        .password-field .form-control {
            padding-right: 3rem;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 0.85rem;
            transform: translateY(-50%);
            border: 0;
            background: transparent;
            color: #6c757d;
            padding: 0;
            line-height: 1;
            z-index: 5;
            cursor: pointer;
        }

        .password-toggle:hover,
        .password-toggle:focus {
            color: #EE903B;
            outline: none;
        }

        .password-toggle i {
            font-size: 1.15rem;
        }
    </style>
    <script>
        document.querySelectorAll('.password-toggle').forEach(function(btn) {
            btn.addEventListener('click', function() {
                const input = document.getElementById(btn.getAttribute('data-target'));
                if (!input) return;
                const icon = btn.querySelector('i');
                const show = input.type === 'password';
                input.type = show ? 'text' : 'password';
                btn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
                if (icon) {
                    icon.classList.toggle('bi-eye', !show);
                    icon.classList.toggle('bi-eye-slash', show);
                }
            });
        });
    </script>
@endsection
