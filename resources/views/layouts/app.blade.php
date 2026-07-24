@php
    $media_setting = \App\Models\ManageSite::where('key', 'media')->first();
    $footer_setting = \App\Models\ManageSite::where('key', 'footer')->first();

    $media_value = $media_setting ? json_decode($media_setting->value) : null;
    $footer_value = $footer_setting ? json_decode($footer_setting->value) : null;
@endphp


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">


    <!-- SEO Meta Tags-->
    <meta name="author" content="Online Bazzar">
    <meta name="distribution" content="web">
    <meta name="csrf-token" content="{{ csrf_token() }}">




    <!-- SEO Meta Tags -->
    <title>@yield('title')</title>
    <meta name="keywords" content="@yield('meta_keywords')">
    <meta name="description" content="@yield('meta_description')">
    <link rel="canonical" href="@yield('canonical_url', url()->current())">



    <!-- Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    @php
        $favicon = optional($media_value)->favicon
            ? \App\Helpers\FileUploadHelper::url($media_value->favicon)
            : asset('assets/images/fav-icon.svg');
    @endphp
    <!-- Favicon Icons-->
    {{-- <link rel="icon" type="image/png" href="{{ \App\Helpers\FileUploadHelper::url($media_value->favicon }}"> --}}
    <link rel="icon" type="image/png" href="{{ $favicon }}">
    <link rel="apple-touch-icon" href="{{ $favicon }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ $favicon }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ $favicon }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ $favicon }}">
    <!-- Vendor Styles including: Bootstrap, Font Icons, Plugins, etc.-->
    <link rel="stylesheet" media="screen" href="{{ asset('assets/front/css/plugins.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400&family=Lora:wght@400&family=Playfair+Display:wght@400&family=Lobster&display=swap"
        rel="stylesheet">


    <link id="mainStyles" rel="stylesheet" media="screen" href="{{ asset('assets/front/css/styles.min.css') }}">


    <link id="mainStyles" rel="stylesheet" media="screen" href="{{ asset('assets/front/css/responsive.css') }}">
    <!-- Color css -->
    <link href="{{ asset('assets/front/css/color.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css"
        integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Modernizr-->
    <link rel="stylesheet" href="{{ asset('assets/front/css/min.css') }}">
    <link id="" rel="stylesheet" media="screen" href="{{ asset('assets/front/css/style.css') }}">

    <script src="{{ asset('assets/front/js/modernizr.min.js') }}"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">



    <style>
        .accordion-button::after {
            background-image: url("{{ asset('assets/imgs/plus-square-Regular.svg') }}");
        }

        .accordion-button:not(.collapsed)::after {
            background-image: url("{{ asset('assets/imgs/minus-square-Regular.svg') }}");
        }

        #home-banner .item .slider-wrapper {
            background-color: #f5f5f5;
        }

        #qualityhelpinstall {
            background: linear-gradient(89.9deg, #3FB5DC 4.98%, #DBDD55 96.89%);
        }

        #footer {
            min-height: 450px;
            background: #15212d;
        }
    </style>
    <style>
        /* Remove default arrow from accordion-button */
        .accordion-button.no-arrow::after {
            display: none;
        }

        /* Optional: Prevent button from shifting content */
        .accordion-button {
            padding-left: 0.75rem;
            padding-right: 0.75rem;
        }

        /* Optional: Keep card-icons neat */
        .card-icons img {
            margin-left: 8px;
        }
    </style>

</head>
<!-- Body-->

<body class="body_theme1">

    <!-- Header-->
    <header class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid bg-white">
                <a class="logo" href="{{ route('user.home') }}">
                    @if (!empty($media_value->logo))
                        <img src="{{ \App\Helpers\FileUploadHelper::url($media_value->logo) }}" alt="ForbSign Logo"
                            loading="lazy">
                    @else
                        <img src="{{ asset('assets/imgs/Fobsignlogo.svg') }}" alt="Default Logo">
                    @endif
                </a>
                <div class="d-flex align-items-center gap-3">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <button class="cart" id="cartButton">
                        <img src="{{ asset('assets/imgs/shopping-basket.svg') }}" alt="">
                        {{-- <span>{{ session('cart') ? count(session('cart')) : 0 }}</span> --}}
                        <span id="cart-count">
                            {{ session('cart') ? array_sum(array_column(session('cart'), 'quantity')) : 0 }}
                        </span>

                    </button>

                </div>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav gap-2 align-items-lg-center">
                        <li>
                            <a class="nav-link {{ Request::routeIs('user.home') ? 'active' : '' }}" href="{{ route('user.home') }}">Home</a>
                        </li>
                        <li>
                            <a class="nav-link {{ Request::routeIs('user.about') ? 'active' : '' }}"
                                href="{{ route('user.about') }}">About Us</a>

                        </li>
                        <li>
                            <a class="nav-link {{ Request::routeIs('user.services') ? 'active' : '' }}"
                                href="{{ route('user.services') }}">Services</a>

                        </li>
                        <li>
                            <a class="nav-link {{ Request::routeIs('user.store') ? 'active' : '' }}"
                                href="{{ route('user.store') }}">Store</a>
                        </li>
                        <li>
                            <a class="nav-link {{ Request::routeIs('user.contact') ? 'active' : '' }}"
                                href="{{ route('user.contact') }}">Contact Us</a>

                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto gap-3">
                        <li>
                            <a class="nav-link header-icon"
                                href="mailto:{{ $footer_value->email ?? 'info@forbsigns.co.uk' }}"><img
                                    src="{{ asset('assets/imgs/envelope-Bold.svg') }}" alt=""
                                    loading="lazy"> {{ $footer_value->email ?? 'info@forbsigns.co.uk' }}
                            </a>
                        </li>
                        <li>
                            <a class="nav-link header-icon"
                                href="tel:{{ $footer_value->phone ?? '441915678060' }}"><img
                                    src="{{ asset('assets/imgs/mobile-Bold.svg') }} " alt="" loading="lazy">
                                {{ $footer_value->phone ?? '441915678060' }}
                            </a>
                        </li>
                        <li class="dropdown-center ms-lg-3">
                            @php
                                $iconRoute = Auth::check() ? route('user.dashboard') : route('user.login');
                            @endphp

                            <a href="{{ $iconRoute }}" class="nav-link header-icon"
                                style="display: inline-block;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                    style="
                                    width: 21px;
                                    fill: #EE903B;
                                    "><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.-->
                                    <path
                                        d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z">
                                    </path>
                                </svg>
                            </a>

                        </li>

                        <!-- Navbar Search Icon -->
                        <li class="nav-item">
                            <a class="nav-link header-icon" href="#" id="toggleSearch">
                                <img src="{{ asset('assets/imgs/search.svg') }}" alt="Search" loading="lazy">
                            </a>
                        </li>

                        <!-- Hidden Search Bar -->
                        <!-- <li class="nav-item d-none" id="searchFormWrapper">
                            <form class="d-flex" action="{{ route('user.search.product') }}" method="GET">
                                <input class="form-control me-2" type="search" name="query"
                                    placeholder="Search Products" aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </li> -->

                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Page Content-->

    @yield('content')

    <!-- Site Footer-->
    <footer id="footer">
        <div class="container">
            <div class="ournews_letter mb-4">
                <h1>
                    Newsletter
                </h1>
                <form class="row subscriber-form" id="subscribeForm">
                    @csrf
                    <div class="input_con">
                        <input class="form-control" type="email" name="email" id="email"
                            placeholder="Your e-mail">
                        <button class="news_btn" type="submit">
                            <span>Subscribe</span>
                        </button>
                    </div>
                </form>

            </div>
            <div class="footer_links row gy-4">
                <div class="col-sm-6 col-md-3">
                    <h5 class="mb-4">Menu</h5>
                    <ul>
                        <li>
                            <a href="{{ route('user.faq') }}">Help & FAQs</a>
                        </li>
                        <li>
                            <a href="{{ route('user.about') }}">About Us</a>
                        </li>
                        <li>
                            <a href="{{ route('user.services') }}">Services</a>
                        </li>
                        <li>
                            <a href="{{ route('user.store') }}">Store</a>
                        </li>
                        <li>
                            <a href="{{ route('user.contact') }}"> Contact Us</a>
                        </li>
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3">
                    <h5 class="mb-4">Services</h5>
                    <ul>
                        <li><a href="{{ route('user.blog') }}">Blogs</a></li>
                        <li><a href="{{ route('user.delivery') }}">Delivery Information</a></li>
                        <li><a href="{{ route('user.terms') }}">Terms and Condition</a></li>
                        <li><a href="{{ route('user.trackorder') }}">Track Order</a></li>
                        {{-- <li><a href="#">Custom Designs</a></li> --}}
                    </ul>
                </div>
                <div class="col-sm-6 col-md-3">
                    <h5 class="mb-4">Contact</h5>
                    <ul>
                        <li><a href="#">{{ $footer_value->address ?? '' }}</a></li>
                        <li><a class="btn primary_btn" href="{{ $footer_value->google_maps_url ?? '#' }}"
                                target="_blank">Directions</a></li>
                        <li><a href="tel:{{ $footer_value->phone ?? 'N\A' }}"><strong>Phone:</strong>
                                {{ $footer_value->phone ?? '' }}</a></li>
                        @if (isset($footer_value) && isset($footer_value->email))
                            <li>
                                <a href="mailto:{{ $footer_value->email }}">
                                    <strong>Email:</strong> {{ $footer_value->email }}
                                </a>
                            </li>
                        @else
                            <li>
                                <strong>Email:</strong> N/A
                            </li>
                        @endif


                    </ul>
                </div>
                <div class="col-sm-6 col-md-3">
                    <h5 class="mb-4">Social Media</h5>
                    <ul class="d-flex align-items-center flex-lg-nowrap flex-wrap gap-3 flex-row social_link">
                        <li><a href="{{ $footer_value->facebook ?? '#' }}" target="_blank">
                                <img src="{{ asset('media/fb.svg') }}" alt="" srcset=""
                                    loading="lazy">
                            </a>
                        </li>
                        <li><a href="{{ $footer_value->twitter ?? '#' }}" target="_blank"><img
                                    src="{{ asset('media/twite.svg') }}" alt="" srcset=""
                                    loading="lazy"></a></li>
                        <li><a href="{{ $footer_value->instagram ?? '#' }}" target="_blank"><img
                                    src="{{ asset('media/instagram.svg') }}" alt="" srcset=""
                                    loading="lazy"></a></li>
                        <li><a href="{{ $footer_value->youtube ?? '#' }}" target="_blank"><img
                                    src="{{ asset('media/youtube.svg') }}" alt="" srcset=""
                                    loading="lazy"></a></li>
                        <li><a href="{{ $footer_value->pinterest ?? '#' }}" target="_blank"><img
                                    src="{{ asset('media/pinterest.svg') }}" alt="" srcset=""
                                    loading="lazy"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back To Top Button-->
    <a class="scroll-to-top-btn" href="#">
        <i class="icon-chevron-up"></i>
    </a>

    <!-- Backdrop-->


    <!-- search modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content p-md-5 py-4 px-3">
                <div class="d-flex align-items-center justify-content-between gap-4 mb-3">
                    <p class="description m-0">Start typing what you’re looking for...</p>
                    <button type="button" class="btn-close align-self-end" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="col-12">
                    <div class="d-flex align-items-center  gap-3">
                        <span class="search-icon"><i class="bi bi-search fs-4 text-secondary"></i></span>
                        <form class="col-10" action="{{ route('user.search.product') }}" method="GET">
                            <input class="form-control" type="search" name="query" placeholder="Search Products"
                                aria-label="Search">
                        </form>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="col-12">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- search modal -->



    <script>
        var mainbs = {
            "is_announcement": "1",
            "announcement_delay": "1.00",
            "overlay": null
        };
        var decimal_separator = '.';
        var thousand_separator = ',';
    </script>
    <!-- Stripe JS -->
    <script src="https://js.stripe.com/v3/"></script>


    <!-- JavaScript (jQuery) libraries, plugins and custom scripts-->
    <script type="text/javascript" src="{{ asset('assets/front/js/plugins.min.js') }}"></script>
    {{-- <script type="text/javascript"
        src="https://geniusdevs.com/codecanyon/omnimart40/assets/back/js/plugin/bootstrap-notify/bootstrap-notify.min.js'">
    </script> --}}
    <script type="text/javascript" src="{{ asset('assets/front/js/scripts.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/lazy.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/lazy.plugin.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/myscript.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
        integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"
        integrity="sha512-i9cEfJwUwViEPFKdC1enz4ZRGBj8YQo6QByFTF92YXHi7waCqyexvRD75S5NVTsSiTv7rKWqG9Y5eFxmRsOn0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

    {{-- <script src="{{ asset('assets/front/js/theme.js.pagespeed.ce.CmKusEWjD7.js') }}"
        type="4b452d4c437ae2859da130d7-text/javascript"></script>
         <script src="{{ asset('assets/front/js/products.js.pagespeed.jm.pYVSdnqDLf.js') }}"
        type="4b452d4c437ae2859da130d7-text/javascript"></script>
            <script src="{{ asset('assets/front/js/rocket-loader.min.js') }}" data-cf-settings="4b452d4c437ae2859da130d7-|49" defer></script> --}}



    <script src="{{ asset('assets/front/js/main.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script type="text/javascript">
        $(document).on('click', '.spiner', function() {
            $('.color-picker').toggleClass('active');
        })
        document.getElementById('cartButton').addEventListener('click', function() {
            window.location.href = "{{ route('user.cart') }}";
        });
    </script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    <!-- Ajax call for news let -->
    <script>
        document.getElementById('subscribeForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent the form from submitting the traditional way

            var email = document.getElementById('email').value; // Get the email value

            var formData = new FormData();
            formData.append('email', email); // Append the email to the form data
            formData.append('_token', document.querySelector('input[name="_token"]').value); // Add CSRF token

            fetch("{{ route('user.subscribe') }}", {
                    method: "POST",
                    headers: {
                        'Accept': 'application/json' // Ensure the server returns JSON
                    },
                    body: formData
                })
                .then(response => response.json()) // Assuming your server returns JSON response
                .then(data => {
                    console.log(data); // Log the response data for debugging
                    if (data.success) {
                        toastr.success("Successfully subscribed!"); // Toaster success message
                        document.getElementById('email').value = ''; // Clear the email field

                    } else {
                        toastr.error("Subscription failed. Please try again."); // Toaster error message
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    toastr.error("This email already exists."); // Toaster error message on AJAX error
                });
        });
    </script>
    <!--  Search Bar -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleBtn = document.getElementById('toggleSearch');
            const searchForm = document.getElementById('searchFormWrapper');
            var myModal = new bootstrap.Modal(document.getElementById('searchModal'), {
                keyboard: false
            })
            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                // searchForm.classList.toggle('d-none');
                myModal.toggle()
            });
        });
    </script>


    @if (session()->has('success'))
        <script>
            toastr['success']("{{ session('success') }}")
        </script>
    @elseif(session()->has('error'))
        <script>
            toastr['error']("{{ session('error') }}")
        </script>
    @endif
    @yield('footer')
</body>

</html>
