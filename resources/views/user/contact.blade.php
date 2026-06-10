@extends('layouts.app')
@section('title')
    Contact
@endsection
@section('content')
    @php
        use Illuminate\Support\Facades\Storage;

        $media_setting = \App\Models\ManageSite::where('key', 'media')->first();
        $footer_setting = \App\Models\ManageSite::where('key', 'footer')->first();

        $media_value = $media_setting ? json_decode($media_setting->value) : null;
        $footer_value = $footer_setting ? json_decode($footer_setting->value) : null;
    @endphp

    <div class="page_banner">
        <!-- <div class=" d-flex justify-content-center h-100"> -->
        <div class="container d-flex justify-content-center flex-column gap-3 h-100">
            <p class="m-0">
                Get In touch
            </p>
            <h2 class="mb-0">
                Contact US
            </h2>
        </div>
        <!-- </div> -->
    </div>
    <section id="contactUs" class="my-lg-5 my-4">
        <div class="container">
            <h2 class="heading_72 text-center my-4">
                Contact US
            </h2>
            <div class="row gy-4">
                <div class="col-lg-7">
                    <div class="contact_form">
                        <h4>Get in touch</h4>

                        <form action="{{ route('user.save_contact') }}" method="POST">
                            @csrf
                            {{-- <div class="row gy-4">
                                <div class="col-md-6">
                                    <input type="text" name="first_name" placeholder="First Name" class="input" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="last_name" placeholder="Last Name" class="input" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" placeholder="Email Address" class="input" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" name="phone" placeholder="Phone Number" class="input" required>
                                </div>
                                <div class="col-12">
                                    <textarea name="message" placeholder="Message" rows="5" class="input" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn primery_btn col-sm-7 col-md-5">
                                        Send Message
                                    </button>
                                </div>
                            </div> --}}
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <input type="text" name="first_name" placeholder="First Name" class="input"
                                        required>
                                    @error('first_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input type="text" name="last_name" placeholder="Last Name" class="input" required>
                                    @error('last_name')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input type="email" name="email" placeholder="Email Address" class="input"
                                        required>
                                    @error('email')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <input type="text" name="phone" placeholder="Phone Number" class="input" required
                                        pattern="^\+?[0-9\s\-]{10,20}$" title="Enter a valid phone number (10–20 digits)">
                                    @error('phone')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <textarea name="message" placeholder="Message" rows="5" class="input" required></textarea>
                                    @error('message')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn primery_btn col-sm-7 col-md-5">
                                        Send Message
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="sidebar border-0 ps-xl-3">
                        <h6>Address</h6>
                        <p class="description lh-1 my-4">The Yard at, Mill Pit, Shiney Row DH4 4RA, United Kingdom</p>
                        <a class="btn white-btn orng_border mb-3" href="{{ $footer_value->google_maps_url ?? '' }}"
                            target="_blank">Get Directions</a>
                        <h6 class="mb-3">Contact</h6>
                        <p class="description lh-1 mb-2">+44 191 567 8060</p>
                        <p class="description lh-1 mb-2">info@forbsigns.co.uk</p>
                        <h6 class="mt-3">Social Media</h6>
                        <div class="d-flex align-items-center gap-3 flex-lg-nowrap flex-wrap social_link">

                            <a href="{{ $footer_value->facebook ?? '#' }}" target="_blank">
                                <img src="{{ asset('media/fb.svg') }}" alt="" srcset="" loading="lazy">
                            </a>

                            <a href="{{ $footer_value->twitter ?? '#' }}" target="_blank"><img
                                    src="{{ asset('media/twite.svg') }}" alt="" srcset="" loading="lazy"></a>

                            <a href="{{ $footer_value->instagram ?? '#' }}" target="_blank"><img
                                    src="{{ asset('media/instagram.svg') }}" alt="" srcset=""
                                    loading="lazy"></a>
                            <a href="{{ $footer_value->youtube ?? '#' }}" target="_blank"><img
                                    src="{{ asset('media/youtube.svg') }}" alt="" srcset=""
                                    loading="lazy"></a>
                            <a href="{{ $footer_value->pinterest ?? '#' }}" target="_blank"><img
                                    src="{{ asset('media/pinterest.svg') }}" alt="" srcset=""
                                    loading="lazy"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="qualityhelpinstall" class="my-5" style=" background-image: url({{ asset('media/image8.jpg') }});">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/QualityMaterial.svg') }}" alt="" loading="lazy">
                    <h6>Quality Material</h6>
                    <p>
                        The best materials make for the best job. It’s that simple. Every sign is 100% weatherproof &
                        resistant so they’re as durable as they are brilliantly designed.
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/Help&Support.svg') }}" alt="Help and Support" loading="lazy">
                    <h6>Help and Support</h6>
                    <p>
                        We’re all about happy customers. If you need help purchasing your sign please contact us during
                        office hours on 01795 505850, or why not try our live chat.
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('media/Quick&Install.svg') }}" alt="Quick & easy to install" loading="lazy">
                    <h6>Quick & easy to install</h6>
                    <p>
                        The best materials make for the best job. It’s that simple. Every sign is 100% weatherproof &
                        resistant so they’re as durable as they are brilliantly designed.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div id="customer_photo">
        <div class="container my-lg-5 my-3">
            <div class="line_heading mb-4">
                <h3>Customer Photos</h3>
                <div class="green_line"></div>
            </div>
            <img src="{{ optional($footer_value)->image1 ? Storage::disk('s3')->url($footer_value->image1) : asset('assets/images/CustomerPhotos.png') }}"
                alt="Customer Photos" />
        </div>
    </div>
@endsection
