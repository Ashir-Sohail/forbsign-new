<div class="main-header ">
    <!-- Logo Header -->
    <div class="logo-header">
        @php
            $settings = \App\Models\ManageSite::where('key', 'media')->first();
            $setting_value = null;

            if ($settings) {
                $setting_value = json_decode($settings->value);
            }
        @endphp

        <a href="/" class="logo">
            @if (!empty($media_value->logo))
                <img src="{{ Storage::disk('s3')->url($media_value->logo) }}" alt="ForbSign Logo" loading="lazy"
                    class="navbar-brand">
            @else
                <img src="{{ asset('assets/imgs/Fobsignlogo.svg') }}" alt="Default Logo" class="navbar-brand">
            @endif
        </a>
        <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
            data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <i class="fa fa-bars"></i>
            </span>
        </button>
        <button class="topbar-toggler more"><i class="fa fa-ellipsis-v"></i></button>
        <div class="navbar-minimize">
            <button class="btn btn-minimize ">
                <i class="fa fa-bars"></i>
            </button>
        </div>
    </div>
    <!-- End Logo Header -->

    <!-- Navbar Header -->
    <nav class="navbar navbar-header navbar-expand-lg">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                <li class="nav-item mr-4">
                    <a class="btn btn-sm btn-primary py-1 text-white" title="website" href="/" target="_blank">
                        <b> View Website</b>
                    </a>
                </li>


                <li class="nav-item dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="" aria-expanded="false">
                        <div class="avatar-sm avatar avatar-sm">
                            <img src="{{ Auth::guard('admin')->user()->image
                                ? Storage::disk('s3')->url(Auth::guard('admin')->user()->image)
                                : asset('assets/images/placeholder.png') }}"
                                alt="..." class="avatar-img rounded-circle">
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <li>
                            <div class="user-box py-3">
                                <div class="avatar-lg">
                                    <img src="{{ Auth::guard('admin')->user()->image
                                        ? Storage::disk('s3')->url(Auth::guard('admin')->user()->image)
                                        : asset('assets/images/placeholder.png') }}"
                                        alt="..." class="avatar-img rounded-circle">
                                </div>

                                <div class="u-text">
                                    <h4>{{ Auth::guard('client')->user()->name }}</h4>
                                    <p class="text-muted">{{ Auth::guard('client')->user()->email }}</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{route('client.profile.view')}}">Update
                                Profile</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal"
                                data-target="#confirm-logout">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
</div>

<!-- Logout Admin Modal -->

<div class="modal fade" id="confirm-logout" tabindex="-1" role="dialog" aria-labelledby="confirmLogoutLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="confirmLogoutLabel">Confirm Logout</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body">
                Are you sure you want to log out of your account?
            </div>

            <!-- Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-primary p-2 rounded-3" data-dismiss="modal">Cancel</button>
                <form action="{{route('client.logout')}}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-danger p-2 rounded-3">Logout</button>
                </form>
            </div>

        </div>
    </div>
</div>
