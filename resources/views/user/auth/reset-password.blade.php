@extends('layouts.app')
@section('title')
    Change Password
@endsection
@section('content')
    @php
        $media_value = json_decode($media_setting->value);

    @endphp
    <section id="sign" class="my-5 pb-4">
        <div class="container">
            <div class="signin_box white_box col-lg-6 col-md-8 px-lg-5 col-sm-10">
                <div class="row gy-4 floating_lables">
                    <div class="col-12 mb-md-5 mb-3">
                        @if (!empty($media_value->logo))
                            <img src="{{ \App\Helpers\FileUploadHelper::url($media_value->logo) }}" alt="ForbSign Logo" loading="lazy" style="width:190px">
                        @else
                            <img src="{{ asset('assets/imgs/Fobsignlogo.svg') }}" alt="Default Logo"
                                style="width:60px;height:70px">
                        @endif
                    </div>
                    <div class="col-12">
                        <h5>
                            Reset Password
                        </h5>
                    </div>
                    <div>
                        <form action="{{ route('update.reset.password') }}" method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="col-12 my-4">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="Email"
                                        name="email">
                                    <label for="email">Email</label>
                                </div>
                                @error('oldPassword')
                                    <p class="text-danger text-start">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 my-4">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password" placeholder="password"
                                        name="password">
                                    <label for="password">Password</label>
                                </div>
                                @error('password')
                                    <p class="text-danger text-start">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 my-4">
                                <div class="form-floating">
                                    <input type="password" class="form-control" id="password_confirmation"
                                        placeholder="Confirm Passwaod" name="password_confirmation">
                                    <label for="password_confirmation">Confirm Password</label>
                                </div>

                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn primary_btn w-100 rounded-0">Reset Password</button>
                            </div>
                        </form>
                    </div>
                </div>
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
    <script>
        const passwordInput = document.getElementById('login-pass');
        const showPasswordCheckbox = document.getElementById('show-password-checkbox');

        showPasswordCheckbox.addEventListener('change', function() {
            passwordInput.type = this.checked ? 'text' : 'password';
        });
    </script>
@endsection
