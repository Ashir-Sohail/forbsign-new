    @if ($products->isNotEmpty())
        @foreach ($products as $product)
        {{-- @dump($products->toArray()) --}}
            <div class="col-sm-6 col-md-4">
                <div class="pro_con store p-1 border-0">
                    <img src="{{Storage::disk('s3')->url($product->featured_image)}}" alt="Custom Favorite" loading="lazy">
                    <div class="d-flex flex-column gap-1">
                        <h4 class="title m-0">
                            {{-- @dump($product->name) --}}
                            {{ \Illuminate\Support\Str::substr($product->name, 0, 20) }}
                        </h4>
                        {{-- @die($product->categories->name) --}}
                        <span class="met">{{ $product->categories->name ?? 'N/A' }}</span>
                        <p class="price m-0">
                            @if ($product->previous_price > 0)
                                <del>{{ config('app.currency.symbol') }}
                                    {{ $product->previous_price }}</del>
                            @endif
                            {{ config('app.currency.symbol') }}{{ $product->current_price }}
                        </p>
                    </div>
                    <div class="store_details">
                        <button class="detail_btn">
                            <a href="{{ route('user.product_details', ['slug' => $product->slug]) }}">
                                Details
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach <!-- End of products loop -->
    @else
        <div class="col-12">
            <div class="alert alert-info text-center mt-5">
                No products found.
            </div>
        </div>
    @endif
