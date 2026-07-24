@extends('layouts.admin')
@section('title')
    Update Product
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"> <b>{{ $viewMode ? 'Product Detail' : 'Update Product' }}</b>
                            </h3>
                            <a class="btn btn-primary   btn-sm" href="{{ route('admin.product.index') }}"><i
                                    class="fas fa-chevron-left"></i> Back</a>
                        </div>
                    </div>
                </div>

                <!-- Warning for deleted category -->
                @if (session('warning'))
                    <div class="alert alert-warning">
                        {{ session('warning') }}
                    </div>
                @endif

                <!-- Form -->


                <div class="row">
                    <div class="col-lg-12">
                    </div>
                </div>
                <!-- Nested Row within Card Body -->
                <form class="admin-form tab-form" action="{{ route('admin.product.update', ['id' => $product->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">

                                        <label for="name">Name <span class="req-star">*</span></label>
                                        <input type="text" name="name" class="form-control item-name" id="name"
                                            placeholder="Enter Name" value="{{ $product->name }}"
                                            @if ($viewMode) readonly @endif>
                                        <!-- Make input readonly if viewMode is true -->

                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group pb-0  mb-0">
                                        <label class="d-block">Featured Image <span class="req-star">*</span></label>
                                    </div>
                                    <div class="form-group pb-0 pt-0 mt-0 mb-0">
                                        @if ($product->featured_image)
                                            <img class="admin-img lg"
                                                src="{{ \App\Helpers\FileUploadHelper::url($product->featured_image) ?? asset('public/assets/images/placeholder.png') }}"
                                                @if ($viewMode) disabled @endif>
                                        @endif
                                    </div>
                                    <div class="form-group position-relative ">
                                        <label class="file">
                                            <input type="file" accept="image/*" class="upload-photo"
                                                name="featured_image" id="file" aria-label="File browser example">
                                            <span class="file-custom text-left">Upload Image...</span>
                                        </label>
                                        <br>
                                        <span class="mt-1 text-info">Image Size Should Be 800 x 800. or square size</span>
                                    </div>
                                    @error('featured_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            @php
                                $imageArray = json_decode($product->images, true);
                            @endphp

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group pb-0 mb-0">
                                        <label class="d-block">Additional Product Images <span class="req-star">*</span></label>
                                        <small class="text-muted">You can upload up to 10 images total</small>
                                    </div>

                                    <!-- Preview container -->
                                    <div class="form-group pb-0 pt-0 mt-0 mb-0">
                                        <div class="mb-2">
                                            <small class="text-info" id="imageCounter">
                                                @if ($imageArray)
                                                    {{ count($imageArray) }} existing images
                                                @else
                                                    No images selected
                                                @endif
                                            </small>
                                        </div>
                                        <div class="d-flex flex-wrap gap-2" id="imagePreviewContainer">
                                            @if ($imageArray)
                                                @foreach ($imageArray as $img)
                                                    <div class="existing-image-wrapper position-relative"
                                                        data-path="{{ $img }}">
                                                        <img src="{{ \App\Helpers\FileUploadHelper::url($img) }}" alt="Product Image"
                                                            style="width: 100px; height: 100px; object-fit: cover; border-radius: 5px; border: 2px solid #28a745;">
                                                        <input type="hidden" name="existing_images[]"
                                                            value="{{ $img }}">
                                                        <span class="remove-existing-image"
                                                            style="
                                                                position: absolute;
                                                                top: -5px;
                                                                right: -5px;
                                                                cursor: pointer;
                                                                color: white;
                                                                font-size: 16px;
                                                                background: #dc3545;
                                                                border-radius: 50%;
                                                                width: 20px;
                                                                height: 20px;
                                                                display: flex;
                                                                align-items: center;
                                                                justify-content: center;
                                                                border: 2px solid white;">&times;
                                                        </span>
                                                        <div
                                                            style="
                                                            position: absolute;
                                                            bottom: 0;
                                                            left: 0;
                                                            right: 0;
                                                            background: rgba(40, 167, 69, 0.8);
                                                            color: white;
                                                            font-size: 10px;
                                                            text-align: center;
                                                            padding: 2px;">
                                                            Existing
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Upload input -->
                                    <div class="form-group position-relative mt-3">
                                        <label class="file">
                                            <input type="file" accept="image/*" class="uploads-photo" name="images[]"
                                                id="imageInput" aria-label="File browser example" multiple
                                                @if ($viewMode) disabled @endif>
                                            <span class="file-custom text-left">Upload additional Images...</span>
                                        </label>
                                        <br>
                                        <span class="mt-1 text-info">Recommended: max 10 images.</span>
                                    </div>

                                    @error('images')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="sort_details">Short Description <span class="req-star">*</span></label>
                                        <textarea name="short_description" id="sort_details" class="form-control" placeholder="Short Description"
                                            @if ($viewMode) readonly @endif>{{ $product->short_description }}</textarea>
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="details">Description <span class="req-star">*</span></label>
                                        <textarea name="description" id="description" class="form-control text-editor" rows="6"
                                            placeholder="Enter Description" @if ($viewMode) readonly @endif>{{ $product->description }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="meta_title">Meta Title <span class="req-star">*</span>
                                        </label>
                                        <input type="text" name="meta_title" class="form-control" id="meta_title"
                                            placeholder="Enter Meta Title" value="{{ $product->meta_title }}"
                                            @if ($viewMode) readonly @endif>
                                        @error('meta_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="title">SEO URL <span class="req-star">*</span></label>
                                        <input type="text" name="meta_url" class="form-control" id="urls"
                                            placeholder="Enter Meta Link" value="{{ $product->meta_url }}"
                                            @if ($viewMode) readonly @endif>
                                        @error('meta_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>


                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords <span class="req-star">*</span>
                                        </label>
                                        <input type="text" name="meta_keyword" class="tags" id="meta_keywords"
                                            placeholder="Enter Meta Keywords" value="{{ $product->meta_keyword }}"
                                            @if ($viewMode) readonly @endif>
                                        @error('meta_keyword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">Meta Description <span class="req-star">*</span>
                                        </label>
                                        <textarea name="meta_description" id="meta_description" class="form-control" rows="5"
                                            placeholder="Enter Meta Description" @if ($viewMode) readonly @endif>{{ $product->meta_description }}</textarea>
                                        @error('meta_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-secondary mr-2">Update</button>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="discount_price">Current Price
                                            <span class="req-star">*</span></label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ config('app.currency.symbol') }}</span>
                                            </div>
                                            <input type="text" id="current_price" name="current_price"
                                                class="form-control" placeholder="Enter Current Price" min="1"
                                                step="0.1" value="{{ $product->current_price }}"
                                                @if ($viewMode) readonly @endif>
                                            @error('current_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="previous_price">Previous Price
                                        </label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ config('app.currency.symbol') }}</span>
                                            </div>
                                            <input type="text" id="previous_price" name="previous_price"
                                                class="form-control" placeholder="Enter Previous Price" min="1"
                                                step="0.1" value="{{ $product->previous_price }}"
                                                @if ($viewMode) readonly @endif>
                                            @error('previous_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="weight">Weight</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                            <input type="number" id="weight" name="weight" class="form-control"
                                                placeholder="Enter Weight" min="0" step="0.01"
                                                value="{{ old('weight', $product->weight ?? '') }}">
                                        </div>
                                        @error('weight')
                                            <span class="text-danger col-12 px-0">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-body">

                                    <label for="category_id" class="fw-bold">Select Category <span class="req-star">*</span></label>

                                    <div id="subcategory-wrapper">
                                        @php
                                            $parentId = null;
                                        @endphp

                                        @if (empty($categoryIds))
                                            {{-- Show top-level categories, nothing selected --}}
                                            <select name="cat_ids[]" class="form-control mt-2 category-dropdown" id="category_id">
                                                <option value="">Select Category</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        @else
                                            @foreach ($categoryIds as $key => $selectedCategoryId)
                                                @php
                                                    $subCategories = \App\Models\Category::where(
                                                        'parent_id',
                                                        $parentId,
                                                    )->get();
                                                    $parentId = $selectedCategoryId;
                                                @endphp

                                                <select name="cat_ids[]" class="form-control mt-2 category-dropdown"
                                                    {{ $loop->first ? 'id=category_id' : '' }}>
                                                    <option value="">Select Category</option>
                                                    @foreach ($subCategories as $sub)
                                                        <option value="{{ $sub->id }}"
                                                            {{ $sub->id == $selectedCategoryId ? 'selected' : '' }}>
                                                            {{ $sub->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @endforeach
                                        @endif
                                    </div>


                                </div>
                            </div>

                            


                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="brand_id">Select Brand <span class="req-star">*</span></label>
                                        <select name="brand_id" id="brand_id" class="form-control"
                                            {{ $viewMode ? 'disabled' : '' }}>
                                            <option value="" selected>Select Brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}" @selected($product->brand_id == $brand->id)>
                                                    {{ $brand->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="stock">Total in stock
                                            <span class="req-star">*</span></label>
                                        <div class="input-group mb-3">
                                            <input type="number" id="stock" name="total_stock" class="form-control"
                                                placeholder="Total in stock" value="{{ $product->total_stock }}"
                                                @if ($viewMode) readonly @endif>
                                            @error('total_stock')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="informative">Informative Product <span class="req-star">*</span></label>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="informative"
                                                id="informative_yes" value="1"
                                                {{ old('informative', $product->informative) == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="informative_yes">
                                                Yes
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="informative"
                                                id="informative_no" value="0"
                                                {{ old('informative', $product->informative) == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label" for="informative_no">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            {{-- <div class="card">
                                <div class="card-body">
                                    <h5>Update Sizes</h5>
                                    <div id="size-wrapper">
                                        @foreach ($product->sizes as $index => $size)
                                            <div class="size-item">
                                                <input type="hidden" name="sizes_id[]" value="{{ $size->id }}">
                                                <input type="text" name="sizes[]"
                                                    placeholder="Size (e.g., 20cm x 15cm)" class="form-control"
                                                    value="{{ $size->size }}" />

                                                @error('sizes.' . $index)
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        @endforeach
                                    </div>


                                    <button type="button" id="add-size" class="btn btn-sm btn-success">Add
                                        Size</button>
                                </div>
                            </div> --}}

                        </div>

                        <div id="product-options-container" class="col-12">
                            @foreach ($groupedProductOptions as $optionId => $groupedPov)
                                @php
                                    $option = $groupedPov->first()->option ?? null;
                                    $requiredValue = $groupedPov->first()->required ?? 0;
                                @endphp
                                @if ($option && count($option->option_values) > 0)
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card mb-4">
                                                {{-- Option & Required --}}
                                                <div class="d-flex justify-content-between align-items-center p-3">
                                                    <h5 class="mb-0">Product Option</h5>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="removeOptionBlock(this)">
                                                        <i class="fa fa-trash"></i> Remove Option
                                                    </button>
                                                    <input type="hidden" name="remove_option_ids[]"
                                                        class="remove-option-id"
                                                        value="{{ $groupedPov->first()->id ?? '' }}">
                                                </div>
                                                <div class="form-group mb-3 px-4">
                                                    <label class="my-2">Select Option</label>
                                                    <select name="product_option[{{ $optionId }}][option_id]"
                                                        class="form-control option-select">
                                                        @foreach ($options as $opt)
                                                            <option value="{{ $opt->id }}"
                                                                {{ $opt->id == $option->id ? 'selected' : '' }}>
                                                                {{ $opt->option_name_en }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3 px-4">
                                                    <label>Required</label>
                                                    <select name="product_option[{{ $optionId }}][required]"
                                                        class="form-control">
                                                        <option value="0"
                                                            {{ $requiredValue == 0 ? 'selected' : '' }}>No
                                                        </option>
                                                        <option value="1"
                                                            {{ $requiredValue == 1 ? 'selected' : '' }}>Yes
                                                        </option>
                                                    </select>
                                                </div>

                                                {{-- Option Values Table --}}
                                                <div class="card-body">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>Option Value</th>
                                                                <th>Quantity</th>
                                                                <th>Subtract</th>
                                                                <th>Price</th>
                                                                <th>Weight</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($product->productOptionValues as $index => $pov)
                                                                @if (optional($pov->option_values)['option']['id'] == $optionId)
                                                                    {{-- @foreach ($product->productOptionValues->where('option_id', $optionId) as $index => $pov) --}}
                                                                    {{-- @dd($product->productOptionValues->toArray()); --}}
                                                                    <tr>
                                                                        {{-- Option Value --}}
                                                                        <td>
                                                                            <select
                                                                                name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][option_value_id]"
                                                                                class="form-control">
                                                                                @if ($option && $option->option_values)
                                                                                    @foreach ($option->option_values as $optionValue)
                                                                                        <option
                                                                                            value="{{ $optionValue->id }}"
                                                                                            {{ $optionValue->id == $pov->option_value_id ? 'selected' : '' }}>
                                                                                            {{ $optionValue->option_name_en }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select>
                                                                        </td>

                                                                        {{-- Quantity --}}
                                                                        <td>
                                                                            <input type="number"
                                                                                name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][quantity]"
                                                                                value="{{ $pov->quantity }}"
                                                                                class="form-control">
                                                                        </td>

                                                                        {{-- Subtract --}}
                                                                        <td>
                                                                            <select
                                                                                name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][subtract]"
                                                                                class="form-control">
                                                                                <option value="1"
                                                                                    {{ $pov->subtract ? 'selected' : '' }}>
                                                                                    Yes
                                                                                </option>
                                                                                <option value="0"
                                                                                    {{ !$pov->subtract ? 'selected' : '' }}>
                                                                                    No
                                                                                </option>
                                                                            </select>
                                                                        </td>

                                                                        {{-- Price --}}
                                                                        <td>
                                                                            <select
                                                                                name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][price_prefix]"
                                                                                class="form-control">
                                                                                <option value="+"
                                                                                    {{ $pov->price_prefix == '+' ? 'selected' : '' }}>
                                                                                    +</option>
                                                                                <option value="-"
                                                                                    {{ $pov->price_prefix == '-' ? 'selected' : '' }}>
                                                                                    -</option>
                                                                            </select>
                                                                            <input type="number"
                                                                                name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][price]"
                                                                                value="{{ $pov->price }}"
                                                                                class="form-control mt-1"
                                                                                placeholder="Price">
                                                                        </td>

                                                                        {{-- Weight --}}
                                                                        <td>
                                                                            <select
                                                                                name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][weight_prefix]"
                                                                                class="form-control">
                                                                                <option value="+"
                                                                                    {{ $pov->weight_prefix == '+' ? 'selected' : '' }}>
                                                                                    +</option>
                                                                                <option value="-"
                                                                                    {{ $pov->weight_prefix == '-' ? 'selected' : '' }}>
                                                                                    -</option>
                                                                            </select>
                                                                            <input type="number"
                                                                                name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][weight]"
                                                                                value="{{ $pov->weight }}"
                                                                                class="form-control mt-1"
                                                                                placeholder="Weight">
                                                                        </td>

                                                                        {{-- Action --}}
                                                                        <td>
                                                                            <button type="button"
                                                                                onclick="removeOptionValueRow(this);"
                                                                                class="btn btn-danger">
                                                                                <i class="fa fa-minus-circle"></i>
                                                                            </button>
                                                                        </td>

                                                                        {{-- Hidden ID (for update) --}}
                                                                        <input type="hidden"
                                                                            name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][id]"
                                                                            value="{{ $pov->id }}">
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card mb-4">
                                                <div class="d-flex justify-content-between align-items-center p-3">
                                                    <h5 class="mb-0">Product Option</h5>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="removeOptionBlock(this)">
                                                        <i class="fa fa-trash"></i> Remove Option
                                                    </button>
                                                    <input type="hidden" name="remove_option_ids[]"
                                                        class="remove-option-id"
                                                        value="{{ $groupedPov->first()->id ?? '' }}">
                                                </div>

                                                {{-- Option & Required --}}
                                                <div class="form-group mb-3 px-4">
                                                    <label class="my-2">Select Option</label>
                                                    <select name="product_option[{{ $optionId }}][option_id]"
                                                        class="form-control option-select">
                                                        @foreach ($options as $opt)
                                                            <option value="{{ $opt->id }}"
                                                                {{ $opt->id == ($option->id ?? '') ? 'selected' : '' }}>
                                                                {{ $opt->option_name_en }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3 px-4">
                                                    <label>Required</label>
                                                    <select name="product_option[{{ $optionId }}][required]"
                                                        class="form-control">
                                                        <option value="0"
                                                            {{ ($requiredValue ?? 0) == 0 ? 'selected' : '' }}>No</option>
                                                        <option value="1"
                                                            {{ ($requiredValue ?? 0) == 1 ? 'selected' : '' }}>Yes</option>
                                                    </select>
                                                </div>

                                                {{-- Value input for options like text, textarea, file, date, etc. --}}
                                                <div class="card-body">

                                                    <input type="hidden"
                                                        name="product_option[{{ $optionId }}][type]"
                                                        value="{{ $option->type ?? '' }}">
                                                    <input type="hidden" name="product_option[{{ $optionId }}][id]"
                                                        value="{{ $groupedPov->first()->id ?? '' }}">
                                                    <input type="hidden" name="product_id"
                                                        value="{{ $product->id ?? '' }}">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>




                        <div class="col-12 mb-3">
                            <button type="button" class="btn btn-primary" onclick="addNewOption()">
                                <i class="fa fa-plus-circle"></i> Add New Option
                            </button>
                        </div>

                        <template id="new-option-template">
                            <div class="col-12 new-option-block">
                                <div class="card mb-4">
                                    <div class="d-flex justify-content-between align-items-center p-3">
                                        <h5 class="mb-0">Product Option</h5>
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="removeOptionBlock(this)">
                                            <i class="fa fa-trash"></i> Remove Option
                                        </button>
                                        <input type="hidden" name="remove_option_ids[]" class="remove-option-id"
                                            value="">
                                    </div>
                                    <div class="form-group mb-3 px-4">
                                        <label>Select Option</label>
                                        <select name="product_option[__INDEX__][option_id]"
                                            class="form-control option-select">
                                            @foreach ($options as $opt)
                                                <option value="{{ $opt->id }}">{{ $opt->option_name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="card-body">
                                        <div class="form-group mb-3">
                                            <label>Required</label>
                                            <select name="product_option[__INDEX__][required]" class="form-control">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Option Value</th>
                                                    <th>Quantity</th>
                                                    <th>Subtract</th>
                                                    <th>Price</th>
                                                    <th>Weight</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody class="option-value-rows">
                                                <!-- JS will add rows here -->
                                            </tbody>
                                        </table>

                                        <button type="button" class="btn btn-success btn-sm"
                                            onclick="addOptionValueRow(__INDEX__)">
                                            <i class="fa fa-plus-circle"></i> Add Option Value
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </template>



                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/back/css/bootstrap.min.css') }}">
@endpush

@section('footer')
    <script>
        $(document).on('change', '.category-dropdown', function() {
            const selectedCategoryId = $(this).val();
            const currentSelect = $(this);
            const wrapper = $('#subcategory-wrapper');

            // Remove all next dropdowns after current one
            currentSelect.nextAll('.category-dropdown').remove();

            if (selectedCategoryId) {
                $.ajax({
                    url: "{{ route('admin.product.get.sub.category') }}",
                    method: 'POST',
                    data: {
                        parent_id: selectedCategoryId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (Array.isArray(data) && data.length > 0) {
                            let newSelect = `<select name="cat_ids[]" class="form-control mt-2 category-dropdown">
                                            <option value="">Select Subcategory</option>`;
                            data.forEach(function(item) {
                                newSelect += `<option value="${item.id}">${item.name}</option>`;
                            });
                            newSelect += `</select>`;
                            wrapper.append(newSelect);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", xhr.status, xhr.responseText);

                        // Replace alert with Bootstrap alert or toast if you want more UI-friendly behavior
                        alert("❌ Failed to load subcategories. Please try again.");
                    }
                });
            }
        });
    </script>

    <script>
        let optionIndex = {{ $groupedProductOptions->keys()->max() ?? 0 }} + 1;

        function addNewOption() {
            const template = document.getElementById('new-option-template').innerHTML;
            const newOptionHtml = template
                .replace(/__INDEX__/g, optionIndex)
                .replace('col-12 new-option-block',
                    `col-12 new-option-block option-block" data-index="${optionIndex}`); // Add .option-block and data-index

            // Append the HTML directly
            document.querySelector('#product-options-container').insertAdjacentHTML('beforeend', newOptionHtml);

            // Get the selected option id (first option by default)
            const select = document.querySelector(`[name="product_option[${optionIndex}][option_id]"]`);
            const selectedOptionId = select ? select.value : null;

            // Call populateOptionValues for the new block
            if (selectedOptionId) {
                populateOptionValues(optionIndex, selectedOptionId);
            }

            optionIndex++;
        }

        function addOptionValueRow(optionId, index, value, existingValue = {}) {
            const tbody = document.querySelector(
                `[name="product_option[${optionId}][option_id]"]`
            ).closest('.card').querySelector('tbody');

            // Build the option list for this value
            let optionList =
                `<option value="${value.id}"${existingValue.option_value_id == value.id ? ' selected' : ''}>${value.option_name_en}</option>`;

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>
                    <select name="product_option[${optionId}][product_option_value][${index}][option_value_id]" class="form-control">
                        ${optionList}
                    </select>
                </td>
                <td><input type="number" name="product_option[${optionId}][product_option_value][${index}][quantity]" class="form-control" value="${existingValue.quantity || ''}"></td>
                <td>
                    <select name="product_option[${optionId}][product_option_value][${index}][subtract]" class="form-control">
                        <option value="1"${existingValue.subtract == 1 ? ' selected' : ''}>Yes</option>
                        <option value="0"${existingValue.subtract == 0 ? ' selected' : ''}>No</option>
                    </select>
                </td>
                <td>
                    <select name="product_option[${optionId}][product_option_value][${index}][price_prefix]" class="form-control">
                        <option value="+"${existingValue.price_prefix == '+' ? ' selected' : ''}>+</option>
                        <option value="-"${existingValue.price_prefix == '-' ? ' selected' : ''}>-</option>
                    </select>
                    <input type="number" name="product_option[${optionId}][product_option_value][${index}][price]" class="form-control" placeholder="Price" value="${existingValue.price || ''}">
                </td>
                <td>
                    <select name="product_option[${optionId}][product_option_value][${index}][weight_prefix]" class="form-control">
                        <option value="+"${existingValue.weight_prefix == '+' ? ' selected' : ''}>+</option>
                        <option value="-"${existingValue.weight_prefix == '-' ? ' selected' : ''}>-</option>
                    </select>
                    <input type="number" name="product_option[${optionId}][product_option_value][${index}][weight]" class="form-control" placeholder="Weight" value="${existingValue.weight || ''}">
                </td>
                <td>
                    <button type="button" class="btn btn-danger" onclick="removeOptionValueRow(this)">
                        <i class="fa fa-minus-circle"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(row);
        }

        function populateOptionValues(blockIndex, optionId, existingValues = {}) {
            let block = $(`.option-block[data-index="${blockIndex}"]`);
            let tbody = block.find('.option-value-rows');

            $.ajax({
                url: "{{ route('admin.product.get.option.values', ['id' => '__ID__']) }}".replace('__ID__', optionId),
                type: 'GET',
                success: function(data) {
                    tbody.empty();

                    if (data.length === 0) {
                        tbody.append(
                            `<tr><td colspan="6" class="text-center">No option values.</td></tr>`
                        );
                    } else {
                        // First, add rows for existing values
                        Object.keys(existingValues).forEach(function(valueIndex) {
                            let existingValue = existingValues[valueIndex];
                            let matchingOption = data.find(opt => opt.id == existingValue
                                .option_value_id);

                            if (matchingOption) {
                                addOptionValueRow(blockIndex, valueIndex, matchingOption,
                                    existingValue);
                            }
                        });

                        // If no existing values, add all available options
                        if (Object.keys(existingValues).length === 0) {
                            data.forEach(function(value, i) {
                                addOptionValueRow(blockIndex, i, value);
                            });
                        }
                    }
                },
                error: function() {
                    alert('Error loading option values.');
                }
            });
        }

        $(document).on('change', '.option-select', function() {
            let optionId = $(this).val();
            let block = $(this).closest('.option-block');
            let index = block.data('index');
            let tbody = block.find('.option-value-rows');
            tbody.empty();

            if (optionId) {
                populateOptionValues(index, optionId);
            }
        });

        function removeOptionValueRow(button) {
            button.closest('tr').remove();
        }
    </script>

    <script>
        function removeOptionBlock(button) {
            // Remove the block
            const card = button.closest('.col-12');
            if (card) card.remove();
        }
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('imageInput').addEventListener('change', function(e) {
                const files = e.target.files;

                const previewContainer = document.getElementById('imagePreviewContainer');
                // console.log(previewContainer);

                // Only append new previews, do not touch existing ones!
                for (let i = 0; i < files.length; i++) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Create a wrapper for the new image
                        const wrapper = document.createElement('div');
                        wrapper.className = 'new-image-wrapper position-relative';
                        wrapper.style.position = 'relative';
                        wrapper.style.display = 'inline-block';

                        // Create the image element
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.width = '100px';
                        img.style.height = '100px';
                        img.style.objectFit = 'cover';
                        img.style.borderRadius = '5px';
                        img.style.border = '2px solid #007bff';

                        // Remove button
                        const removeBtn = document.createElement('span');
                        removeBtn.innerHTML = '&times;';
                        removeBtn.className = 'remove-new-image';
                        removeBtn.style = `
                            position: absolute;
                            top: -5px;
                            right: -5px;
                            cursor: pointer;
                            color: white;
                            font-size: 16px;
                            background: #dc3545;
                            border-radius: 50%;
                            width: 20px;
                            height: 20px;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            border: 2px solid white;
                        `;
                        removeBtn.onclick = function() {
                            wrapper.remove();
                        };

                        // Label
                        const label = document.createElement('div');
                        label.innerText = 'New';
                        label.style = `
                            position: absolute;
                            bottom: 0;
                            left: 0;
                            right: 0;
                            background: rgba(0, 123, 255, 0.8);
                            color: white;
                            font-size: 10px;
                            text-align: center;
                            padding: 2px;
                        `;

                        wrapper.appendChild(img);
                        wrapper.appendChild(removeBtn);
                        wrapper.appendChild(label);

                        previewContainer.appendChild(wrapper);
                    };
                    reader.readAsDataURL(files[i]);
                }
            });

            document.querySelectorAll('.remove-existing-image').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    btn.closest('.existing-image-wrapper').remove();
                });
            });
        });
    </script>
    @push('scripts')
        <script src="{{ asset('assets/back/js/jquery.3.6.0.min.js') }}"></script>
        <script src="{{ asset('assets/back/js/bootstrap.min.js') }}"></script>
    @endpush
@endsection
