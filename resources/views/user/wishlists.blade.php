@extends('layouts.app')
@section('title')
    Wishlist
@endsection
@section('content')
    <div class="page-title">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumbs">
                        <li><a href="{{ route('user.home') }}">Home</a> </li>
                        <li class="separator"></li>
                        <li>Wishlist</li>
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
                        @if($wishlists->isEmpty())
                            <div class="empty-wishlist text-center py-5">
                                <svg class="empty-wishlist-svg mb-4" viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg" style="max-width: 100%; height: auto; width: 100%; max-width: 400px;">
                                    <!-- Background circle -->
                                    <circle cx="200" cy="150" r="120" fill="#f8f9fa" stroke="#dee2e6" stroke-width="2"/>
                                    
                                    <!-- Heart shape -->
                                    <path d="M200 220 C 150 180, 100 140, 100 110 C 100 80, 125 65, 150 65 C 170 65, 185 75, 200 95 C 215 75, 230 65, 250 65 C 275 65, 300 80, 300 110 C 300 140, 250 180, 200 220 Z" 
                                          fill="#dc3545" opacity="0.3" stroke="#dc3545" stroke-width="3"/>
                                    
                                    <!-- Plus sign -->
                                    <line x1="200" y1="100" x2="200" y2="140" stroke="#dc3545" stroke-width="4" stroke-linecap="round"/>
                                    <line x1="180" y1="120" x2="220" y2="120" stroke="#dc3545" stroke-width="4" stroke-linecap="round"/>
                                    
                                    <!-- Decorative elements -->
                                    <circle cx="120" cy="80" r="5" fill="#dc3545" opacity="0.5"/>
                                    <circle cx="280" cy="80" r="5" fill="#dc3545" opacity="0.5"/>
                                    <circle cx="100" cy="150" r="4" fill="#dc3545" opacity="0.4"/>
                                    <circle cx="300" cy="150" r="4" fill="#dc3545" opacity="0.4"/>
                                </svg>
                                <h3 class="text-muted mb-3">Your wishlist is empty</h3>
                                <p class="text-muted mb-4">Looks like you haven't added any items to your wishlist yet.</p>
                                <a href="{{ route('user.store') }}" class="btn primary_btn">Continue Shopping</a>
                            </div>
                        @else
                            <div class="u-table-res wishlist-table mb-0">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Wishlist Product</th>
                                            <th class="text-center"><a class="btn btn-sm primary_btn"
                                                    href="{{ route('user.wishlist.clear') }}"><span>Clear
                                                        Wishlist</span></a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($wishlists as $wishlist)
                                            <tr>
                                                <td>
                                                    <div class="product-item">
                                                        <a class="product-thumb"
                                                            href="{{ route('user.product_details', ['slug' => $wishlist->product->slug]) }}">
                                                            <img src="{{ \App\Helpers\FileUploadHelper::url($wishlist->product->featured_image) }}"
                                                                alt="Product">

                                                        </a>
                                                        <div class="product-info">
                                                            <h4 class="product-title"><a
                                                                    href="{{ route('user.product_details', ['slug' => $wishlist->product->slug]) }}">{{ $wishlist->product->name }}</a>
                                                            </h4>
                                                            <div class="text-lg mb-1">$ {{ $wishlist->product->current_price }}
                                                            </div>
                                                            <div class="text-sm">Availability:
                                                                <div class="d-inline text-success">In Stock</div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <a class="product-button btn primary_btn btn-sm add_to_single_cart"
                                                        href="{{ route('user.add_to_cart', ['id' => $wishlist->product->id]) }}"><i
                                                            class="icon-shopping-cart"></i><span>To Cart</span>
                                                    </a>
                                                </td>
                                                <td class="text-center"><a class="remove-from-cart"
                                                        href="{{ route('user.wishlist.remove', ['id' => $wishlist->id]) }}"
                                                        data-toggle="tooltip" title=""
                                                        data-bs-original-title="Remove item" aria-label="Remove item"><i
                                                            class="icon-x"></i></a></td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        @endif
                        <hr class="mb-4">
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
