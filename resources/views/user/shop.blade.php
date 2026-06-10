@extends('layouts.app')
@section('title')
    Shop
@endsection
@section('content')
    <div class="page_banner">
        <div class="container d-flex justify-content-center flex-column gap-3 h-100">
            <p class="m-0">{{ $storepreferences['store_title'] ?? '' }}</p>
            <h2 class="mb-0">{{ $storepreferences['store_heading'] ?? '' }}</h2>
        </div>
    </div>

    <!-- Page Content-->
    <section id="store" class="my-lg-5 my-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-9">
                    <div class="row gy-4">
                        <div class="row" id="product-listing">
                            @include('user.partials.product-list', ['products' => $products])
                        </div>
                    </div>
                </div>

                <!-- Sidebar: Filter by Category, Size, and Price -->
                <div class="col-lg-4 col-xl-3">
                    <div class="sidebar">
                        <h6 class="mb-2">{{ $storepreferences['card_heading1'] ?? '' }}</h6>
                        <ul class="cat_list mb-3">

                            @foreach ($categories as $category)
                                <li>
                                    @if ($category->children->count())
                                        <span class="toggle-children" style="cursor: pointer;">&#9654;</span>
                                    @else
                                        <span style="display: inline-block; width: 1em;"></span>
                                    @endif

                                    <input type="checkbox" class="category-filter" value="{{ $category->id }}" id="filter-{{ $category->id }}">
                                    <label for="filter-{{ $category->id }}">{{ $category->name }}</label>

                                    @if ($category->children->count())
                                        <ul class="child-category-list list-unstyled ps-2" style="display: none; margin-left: 15px;">
                                            @include('user.category-tree-filter', [
                                                'categories' => $category->children,
                                            ])
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        <h6 class="mb-3">{{ $storepreferences['card_heading2'] ?? '' }}</h6>
                        <div class="range_container mb-4">
                            <div class="sliders_control">
                                <input id="fromSlider" class="size fromSize" type="range" value="0" min="0"
                                    max="100" />
                                <input id="toSlider" class="size toSize" type="range" value="100" min="0"
                                    max="100" />
                            </div>
                            <div class="form_control">
                                <div class="form_control_container">
                                    <div class="form_control_container__time">Min</div>
                                    <input class="form_control_container__time__input  minSize" type="number"
                                        id="fromInput" value="" min="0" max="100" disabled />
                                    <p>cm</p>
                                </div>
                                <div class="form_control_container">
                                    <div class="form_control_container__time">Max</div>
                                    <input class="form_control_container__time__input maxSize" type="number" id="toInput"
                                        value="" min="0" max="100" disabled />
                                    <p>cm</p>
                                </div>
                            </div>
                        </div>

                        <h6 class="mb-3">{{ $storepreferences['card_heading2'] ?? '' }}</h6>
                        <div class="range_container mb-4">
                            <div class="sliders_control">
                                <!-- PRICE -->
                                <input id="fromSlider" class="price fromPrice" type="range" value="0" min="0"
                                    max="{{ $maxPrice }}" />
                                <input id="toSlider" class="price toPrice" type="range" value="{{ $maxPrice }}" min="0"
                                    max="{{ $maxPrice }}" />
                            </div>
                            <div class="form_control">
                                <div class="form_control_container">
                                    <div class="form_control_container__time">Min</div>
                                    <input class="form_control_container__time__input minPrice" type="number"
                                        id="fromInput" value="0" min="0" max="{{ $maxPrice }}" disabled />
                                    <p>{{ config('app.currency.symbol') }}</p>
                                </div>
                                <div class="form_control_container">
                                    <div class="form_control_container__time">Max</div>
                                    <input class="form_control_container__time__input maxPrice" type="number"
                                        id="toInput" value="{{ $maxPrice }}" min="0" max="{{ $maxPrice }}" disabled />
                                    <p>{{ config('app.currency.symbol') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="w-100 text-center">
                            <button class="clear_filter mb-3" id="clear-filter">Clear Filter</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- footer -->
    <div id="qualityhelpinstall" class="store_footer_top">
        <div class="container">
            <div class="row justify-content-between align-items-center">
                <div class="qhi col-md-4">
                    <img src="{{ asset('assets/imgs/QualityMaterial.svg') }}" alt="" loading="lazy">
                    <h6>{{ $storepreferences['information_heading1'] ?? '' }}</h6>
                    <p>
                        {{ $storepreferences['information_description1'] ?? '' }}
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('assets/imgs/Help&Support.svg') }}" alt="Help and Support" loading="lazy">
                    <h6>{{ $storepreferences['information_heading2'] ?? '' }}</h6>
                    <p>
                        {{ $storepreferences['information_description2'] ?? '' }}
                    </p>
                </div>
                <div class="qhi col-md-4">
                    <img src="{{ asset('assets/imgs/Quick&Install.svg') }}" alt="Quick &amp; easy to install"
                        loading="lazy">
                    <h6>{{ $storepreferences['information_heading3'] ?? '' }}</h6>
                    <p>
                        {{ $storepreferences['information_Description3'] ?? '' }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function() {

            // 1. Toggle child categories
            $(document).on('click', '.toggle-children', function() {
                $(this).siblings('.child-category-list').slideToggle();
                $(this).text($(this).text() === '▸' ? '▾' : '▸');
            });

            // 2. Filter function
            function applyFilters() {
                let data = {};

                let selectedCategories = [];
                $('.category-filter:checked').each(function() {
                    selectedCategories.push($(this).val());
                });

                if (selectedCategories.length > 0) {
                    data.categories = selectedCategories;
                }

                let sizeMin = $('.fromSize').val();
                let sizeMax = $('.toSize').val();
                if (sizeMin && sizeMax && (parseFloat(sizeMin) !== 0 || parseFloat(sizeMax) !== 100)) {
                    data.size_min = sizeMin;
                    data.size_max = sizeMax;
                }

                let priceMin = $('.fromPrice').val();
                let priceMax = $('.toPrice').val();
                if (priceMin && priceMax && (parseFloat(priceMin) !== 0 || parseFloat(priceMax) !== 100)) {
                    data.price_min = priceMin;
                    data.price_max = priceMax;
                }

                console.log('Data being sent:', data);

                $.ajax({
                    url: "{{ route('store.filter') }}",
                    method: 'GET',
                    data: data,
                    beforeSend: function() {
                        $('#product-listing').html('<p>Loading products...</p>');
                    },
                    success: function(response) {
                        console.log('✅ AJAX Response:', JSON.stringify(response));

                        $('#product-listing').html(response);
                    },
                    error: function(xhr, status, error) {
                        alert('Error occurred while fetching data: ' + error);
                        console.error('AJAX Error:', status, error);
                    }
                });
            }

            // 3. Bind applyFilters to input changes
            $('.fromSize, .toSize, .fromPrice, .toPrice').on('input change', applyFilters);
            $('.category-filter').on('change', applyFilters);

            // 4. Clear filter button
            $('#clear-filter').on('click', function(e) {
                // alert('Clear filter button clicked');
                e.preventDefault();
                $('.category-filter').prop('checked', false);
                $('.fromSize').val(0);
                $('.toSize').val(100);
                $('.fromPrice').val(0);
                $('.toPrice').val(100);
                $('.fromSize, .toSize, .fromPrice, .toPrice').trigger('input');
                applyFilters();
                location.reload();
            });

        });
    </script>
@endsection
