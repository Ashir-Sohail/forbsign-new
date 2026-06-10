@extends('layouts.admin')

@section('title')
    Cart Preferences
@endsection

@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Cart Preferences</b></h3>
                            {{-- <a class="btn btn-primary btn-sm" href="">
                                <i class="fas fa-chevron-left"></i> Back
                            </a> --}}
                        </div>
                    </div>
                </div>

                <!-- Preferences Form -->
                <div class="row">
                    <div class="col-12">
                        <div class="card o-hidden border-0 shadow-lg mb-4">
                            <div class="card-body">

                                <!-- Tabs Navigation -->
                                <ul class="nav nav-tabs" id="preferencesTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#card" role="tab">Card
                                            Section</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#information" role="tab">
                                            Information</a>
                                    </li>
                                </ul>

                                <!-- Form Start -->
                                <form action="{{route('admin.cart.store.preferences')}}" method="POST">
                                    @csrf
                                    <div class="tab-content pt-4">

                                        <!-- About Tab -->
                                        <div class="tab-pane fade show active" id="card" role="tabpanel">
                                            <div class="form-group">
                                                <label for="card_heading">Heading*</label>
                                                <input type="text" name="card_heading" class="form-control"
                                                    id="card_heading"
                                                    value="{{ old('card_heading', $cartpreferences['card_heading'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('card_heading')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="card_button1">Button1*</label>
                                                <input type="text" name="card_button1" class="form-control"
                                                    id="card_button1"
                                                    value="{{ old('card_button1', $cartpreferences['card_button1'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('card_button1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="card_button2">Button2*</label>
                                                <input type="text" name="card_button2" class="form-control"
                                                    id="card_button2"
                                                    value="{{ old('card_button2', $cartpreferences['card_button2'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('card_button2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="order_heading">Order Heading*</label>
                                                <input type="text" name="order_heading" class="form-control"
                                                    id="order_heading"
                                                    value="{{ old('order_heading', $cartpreferences['order_heading'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('order_heading')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="card_subtotal">Subtotal*</label>
                                                <input type="text" name="card_subtotal" class="form-control"
                                                    id="card_subtotal"
                                                    value="{{ old('card_subtotal', $cartpreferences['card_subtotal'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('card_subtotal')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="card_shipping">Shipping*</label>
                                                <input type="text" name="card_shipping" class="form-control"
                                                    id="card_shipping"
                                                    value="{{ old('card_shipping', $cartpreferences['card_shipping'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('card_shipping')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        {{-- Information --}}
                                        <div class="tab-pane fade" id="information" role="tabpanel">
                                            <div class="form-group">
                                                <label for="information_icon1">Icon1*</label>
                                                <textarea name="information_icon1" class="form-control" id="information_icon1" required>{{ old('information_icon1', $cartpreferences['information_icon1'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_icon1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="information_heading1">Heading1*</label>
                                                <input type="text" name="information_heading1" class="form-control"
                                                    id="information_heading1"
                                                    value="{{ old('information_heading1', $cartpreferences['information_heading1'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('information_heading1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="information_description1">Description1*</label>
                                                <textarea type="text" name="information_description1" class="form-control" id="information_description1" required>{{ old('information_description1', $cartpreferences['information_description1'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_description1')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="information_icon2">Icon2*</label>
                                                <textarea type="text" name="information_icon2" class="form-control" id="information_icon2" required>{{ old('information_icon2', $cartpreferences['information_icon2'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_icon2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="information_heading2">Heading2*</label>
                                                <input type="text" name="information_heading2" class="form-control"
                                                    id="information_heading2"
                                                    value="{{ old('information_heading2', $cartpreferences['information_heading2'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('information_heading2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="information_description2">Description2*</label>
                                                <textarea type="text" name="information_description2" class="form-control" id="information_description2" required>{{ old('information_description2', $cartpreferences['information_description2'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_description2')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                            <div class="form-group">
                                                <label for="information_icon3">Icon3*</label>
                                                <textarea type="text" name="information_icon3" class="form-control" id="information_icon3" required>{{ old('information_icon3', $cartpreferences['information_icon3'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_icon3')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="information_heading3">Heading3*</label>
                                                <input type="text" name="information_heading3" class="form-control"
                                                    id="information_heading3"
                                                    value="{{ old('information_heading3', $cartpreferences['information_heading3'] ?? '') }}"
                                                    required>
                                            </div>
                                            @error('information_heading3')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="form-group">
                                                <label for="information_Description3">Description3*</label>
                                                <textarea type="text" name="information_Description3" class="form-control" id="information_Description3"
                                                    required>{{ old('information_Description3', $cartpreferences['information_Description3'] ?? '') }}</textarea>
                                            </div>
                                            @error('information_Description3')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    <!-- Submit Button -->
                                    <div class="form-group mt-4 text-right">
                                        <button type="submit" class="btn btn-secondary">Save Preferences</button>
                                    </div>

                                </form>
                                <!-- Form End -->

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
