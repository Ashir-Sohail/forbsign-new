@extends('layouts.app')
@section('title')
    Login
@endsection
@section('content')
    <section id="login" class="my-5 pb-4">
        <div class="container">
            <div class="login_box white_box col-xl-5 col-md-8 col-sm-10">
                <form class="row" action="{{ route('user.make.login') }}" method="POST">
                    @csrf
                    <div class="row gy-4 floating_lables">
                        <div class="col-12 mb-4">
                            <img src="{{ asset('assets/imgs/Fobsignlogo.svg') }}" alt="Fobsign logo"
                                loading="lazy" style="width: 230px; max-width: 100%; height: auto;">
                        </div>
                        <div class="col-12">
                            <h5>
                                Sign in
                            </h5>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="email" name="email_login" class="form-control" id="Emailmobilenumber"
                                    placeholder="Email or mobile number" value="{{ old('email_login') }}">
                                <label for="Emailmobilenumber ">Email or mobile number</label>

                                @error('email_login')
                                    <p class="text-danger text-start">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating password-field">
                                <input class="form-control" type="password" name="password_login" placeholder="Password"
                                    id="login-pass" autocomplete="current-password">
                                <label for="login-pass">Password</label>
                                <button type="button" class="password-toggle" data-target="login-pass"
                                    aria-label="Show password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('password_login')
                                <p class="text-danger text-start">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn primary_btn w-100 rounded-0">Sign in</button>
                            <a href="{{ route('user.register') }}" class="orang_btn w-100 rounded-0 mt-3">Create Account</a>
                            <a href="{{ route('password.forgot') }}" class="login-forgot-link d-inline-block mt-3">Forgot password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <style>
        #login .login-forgot-link {
            color: #EE903B;
            font-size: 0.95rem;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s ease, text-decoration-color 0.2s ease;
        }

        #login .login-forgot-link:hover,
        #login .login-forgot-link:focus {
            color: #d67a2a;
            text-decoration: underline;
            text-underline-offset: 3px;
            outline: none;
        }

        /* Keep Create Account on one line on narrow phones */
        #login .orang_btn {
            white-space: nowrap;
            box-sizing: border-box;
        }

            @media (max-width: 400px) {
            #login .login_box {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            #login .orang_btn,
            #login .btn.primary_btn {
                font-size: 15px;
                line-height: 22px;
                padding-left: 1rem;
                padding-right: 1rem;
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
    <div id="qualityhelpinstall" class="store_footer_top">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/QualityMaterial.svg') }}" alt="" loading="lazy">
                    <h6>Quality Material</h6>
                    <p>
                        The best materials make for the best job. It’s that simple. Every sign is 100% weatherproof
                        &amp;
                        resistant so they’re as durable as they are brilliantly designed.
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/Help&Support.svg') }}" alt="Help and Support" loading="lazy">
                    <h6>Help and Support</h6>
                    <p>
                        We’re all about happy customers. If you need help purchasing your sign please contact us during
                        office hours on 01795 505850, or why not try our&nbsp;live chat.
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/Quick&Install.svg') }}" alt="Quick & easy to install" loading="lazy">
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
