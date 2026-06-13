@extends('layouts.app')
@section('title')
    Forgot Password
@endsection
@section('content')
    @php
        $media_value = json_decode($media_setting->value);

    @endphp
    <section id="forgotPassword" class="my-5 pb-4">
        <div class="container">
            <div class="signin_box white_box col-xl-5 col-md-8 col-sm-10">
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="row gy-4 floating_lables">
                        <div class="col-12 mb-4">
                            @if (!empty($media_value->logo))
                                <img src="{{ \App\Helpers\FileUploadHelper::url($media_value->logo) }}" alt="ForbSign Logo"
                                    loading="lazy" style="width:190px">
                            @else
                                <img src="{{ asset('assets/imgs/Fobsignlogo.svg') }}" alt="Default Logo"
                                    style="width:60px;height:70px">
                            @endif
                        </div>
                        <div class="col-12">
                            <h5>
                                Forgot Password
                            </h5>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="Emailmobilenumber"
                                    placeholder="Email or mobile number" name="email">
                                <label for="Emailmobilenumber ">Email or mobile number</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn primery_btn w-100 rounded-0">Forget</button>
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
