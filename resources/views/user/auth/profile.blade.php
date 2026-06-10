@extends('layouts.app')
@section('title')
    Profie
@endsection
@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li><a href="/">Home</a> </li>
                        <li class="separator"></li>
                        <li>Profile</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container padding-bottom-3x mb-1">
        <div class="row">
            @include('includes.user-sidebar')
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="padding-top-2x mt-2 hidden-lg-up"></div>
                        <h4 class="mb-4">Profile</h4>
                        <form class="row" action="{{ route('user.profile.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="avater" class="form-label">Default file input example</label>
                                    <input class="form-control" type="file" name="photo" id="avater">
                                </div>
                            </div>
                       
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account-fn">First Name</label>
                                    <input class="form-control" name="first_name" type="text" id="account-fn"
                                        value="{{ Auth::user()->first_name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account-ln">Last Name</label>
                                    <input class="form-control" type="text" name="last_name" id="account-ln"
                                        value="{{ Auth::user()->last_name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account-email">E-mail Address</label>
                                    <input class="form-control" name="email" type="email" id="account-email"
                                        value="{{ Auth::user()->email }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account-phone">Phone Number</label>
                                    <input class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        type="text" id="account-phone" value="{{ old('phone', Auth::user()->phone) }}">

                                    @error('phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="account-pass">New Password</label>
                                    <input type="password" class="form-control" name="password" id="account-pass"
                                        placeholder="Change your password">
                                </div>
                            </div>
                            <div class="col-12">
                                <hr class="mt-2 mb-3">
                                <div class="d-flex flex-wrap justify-content-between align-items-center">
                                    <button class="btn_black margin-right-none" type="submit"><span>Update
                                            Profile</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
