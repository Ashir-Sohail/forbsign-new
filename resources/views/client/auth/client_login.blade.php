@extends('layouts.app')
@section('title')
   Client Login
@endsection
@section('content')
    <section id="login" class="my-5 pb-4">
        <div class="container">
            <div class="login_box white_box col-xl-5 col-md-8 col-sm-10">
                <form class="row" action="{{route('client.make.login')}}" method="POST">
                    @csrf
                    <div class="row gy-4 floating_lables">
                        <div class="col-12 mb-4">
                            <img src="{{ asset('assets/imgs/Fobsignlogo.svg') }}" alt="Fobsign logo" class=""
                                loading="lazy" style="width: 190px;">
                        </div>
                        <div class="col-12">
                            <h5>
                               Client Sign in
                            </h5>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="email" name="email_login" class="form-control" id="Emailmobilenumber"
                                    placeholder="Email or mobile number" value="{{ old('email_login') }}">
                                <label for="Emailmobilenumber ">Email</label>

                                @error('email_login')
                                    <p class="text-danger text-start">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input class="form-control" type="password" name="password_login" placeholder="Password"
                                    id="login-pass">
                                @error('password_login')
                                    <p class="text-danger text-start">{{ $message }}</p>
                                @enderror
                                <label for="password ">Password</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn primary_btn w-100 rounded-0">Sign in</button>
                            {{-- <a href="" class="orang_btn w-100 rounded-0 mt-3">Create Account</a> --}}
                        </div>
                         <a href="{{route('passwordforgot')}}" class="text-center mt-3">Forgot Password?</a>
                    </div>
                </form>
            </div>
        </div>
    </section>

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
