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
                                        <label for="name">Name *</label>
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
                                        <label class="d-block">Featured Image *</label>
                                    </div>
                                    <div class="form-group pb-0 pt-0 mt-0 mb-0">
                                        <img class="admin-img lg"
                                            src="{{ asset('storage') }}/{{ $product->featured_image }}"
                                            @if ($viewMode) disabled @endif>
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
                                        <label class="d-block">Additional Product Images *</label>
                                    </div>

                                    <!-- Preview container -->
                                    <div class="form-group pb-0 pt-0 mt-0 mb-0 d-flex flex-wrap gap-2"
                                        id="imagePreviewContainer">
                                        @if ($imageArray)
                                            @foreach ($imageArray as $img)
                                                <div>
                                                    <img src="{{ asset('storage/' . $img) }}" alt="Product Image"
                                                        style="width: 100px; height: auto; border-radius: 5px; aspect-ratio:2/2;">
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                    <!-- Upload input -->
                                    <div class="form-group position-relative mt-3">
                                        <label class="file">
                                            <input type="file" accept="image/*" class="upload-photo" name="images[]"
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
                                        <label for="sort_details">Short Description *</label>
                                        <textarea name="short_description" id="sort_details" class="form-control" placeholder="Short Description"
                                            @if ($viewMode) readonly @endif>{{ $product->short_description }}</textarea>
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="details">Description *</label>
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
                                        <label for="meta_title">Meta Title
                                        </label>
                                        <input type="text" name="meta_title" class="form-control" id="meta_title"
                                            placeholder="Enter Meta Title" value="{{ $product->meta_title }}"
                                            @if ($viewMode) readonly @endif>
                                        @error('meta_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="title">SEO URL *</label>
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
                                        <label for="meta_keywords">Meta Keywords
                                        </label>
                                        <input type="text" name="meta_keyword" class="tags" id="meta_keywords"
                                            placeholder="Enter Meta Keywords" value="{{ $product->meta_keyword }}"
                                            @if ($viewMode) readonly @endif>
                                        @error('meta_keyword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">Meta Description
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
                                            *</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">$</span>
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
                                                <span class="input-group-text">$</span>
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

                                    <label for="category_id" class="fw-bold">Select Category *</label>

                                    <div id="subcategory-wrapper">
                                        @php
                                            $parentId = null;
                                        @endphp

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
                                    </div>


                                </div>
                            </div>


                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="brand_id">Select Brand </label>
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
                                            *</label>
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
                            </div>

                        </div>


                        @foreach ($groupedProductOptionValues as $optionId => $groupedPov)
                            @php
                                $option = $groupedPov->first()->option_values->option ?? null;
                                $requiredValue = $groupedPov->first()->required ?? 0;
                            @endphp

                            @if ($option)
                                <div class="col-12">
                                    <div class="card mb-4">

                                        <div class="form-group mb-3 px-4">
                                            <label for="option_id" class="my-2">Select Option</label>
                                            <select name="product_option[{{ $optionId }}][option_id]"
                                                class="form-control">
                                                @foreach ($options as $opt)
                                                    <option value="{{ $opt->id }}"
                                                        {{ $opt->id == $option->id ? 'selected' : '' }}>
                                                        {{ $opt->option_name_en }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="card-body">

                                            {{-- Required Field (Once Per Option) --}}
                                            <div class="form-group mb-3">
                                                <label for="required-field-{{ $optionId }}">Required</label>
                                                <select id="required-field-{{ $optionId }}"
                                                    name="product_option[{{ $optionId }}][required]"
                                                    class="form-control">
                                                    <option value="0" {{ $requiredValue == 0 ? 'selected' : '' }}>No
                                                    </option>
                                                    <option value="1" {{ $requiredValue == 1 ? 'selected' : '' }}>Yes
                                                    </option>
                                                </select>
                                            </div>

                                            {{-- Option Values Table --}}
                                            <button type="button" class="btn btn-success btn-sm mb-2"
                                                onclick="addOptionValueRow({{ $optionId }})">
                                                <i class="fa fa-plus-circle"></i> Add Option Value
                                            </button>

                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Option Value</th>
                                                        <th>Quantity</th>
                                                        <th>Subtract</th>
                                                        <th>Price</th>
                                                        <th>Points</th>
                                                        <th>Weight</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <div class="col-12">
                                                        <button type="button" class="btn btn-primary mb-3"
                                                            onclick="addNewOption()">
                                                            <i class="fa fa-plus-circle"></i> Add New Option
                                                        </button>
                                                    </div>

                                                    @foreach ($groupedPov as $index => $pov)
                                                        <tr>
                                                            <td>
                                                                <select
                                                                    name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][option_value_id]"
                                                                    class="form-control">
                                                                    @foreach ($option->option_values as $optionValue)
                                                                        <option value="{{ $optionValue->id }}"
                                                                            {{ $optionValue->id == $pov->option_value_id ? 'selected' : '' }}>
                                                                            {{ $optionValue->option_name_en }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                <input type="hidden"
                                                                    name="product_option[{{ $optionId }}][option_id]"
                                                                    value="{{ $optionId }}">
                                                            </td>

                                                            <td>
                                                                <input type="number"
                                                                    name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][quantity]"
                                                                    value="{{ $pov->quantity }}" class="form-control">
                                                            </td>

                                                            <td>
                                                                <select
                                                                    name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][subtract]"
                                                                    class="form-control">
                                                                    <option value="1"
                                                                        {{ $pov->subtract ? 'selected' : '' }}>Yes</option>
                                                                    <option value="0"
                                                                        {{ !$pov->subtract ? 'selected' : '' }}>No</option>
                                                                </select>
                                                            </td>

                                                            <td>
                                                                <select
                                                                    name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][price_prefix]"
                                                                    class="form-control">
                                                                    <option value="+"
                                                                        {{ isset($pov->price_prefix) && $pov->price_prefix == '+' ? 'selected' : '' }}>
                                                                        +</option>
                                                                    <option value="-"
                                                                        {{ isset($pov->price_prefix) && $pov->price_prefix == '-' ? 'selected' : '' }}>
                                                                        -</option>
                                                                </select>

                                                                <input type="text"
                                                                    name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][price]"
                                                                    value="{{ $pov->price ?? '' }}" class="form-control"
                                                                    placeholder="Price">
                                                            </td>

                                                            <td class="text-right">
                                                                <select
                                                                    name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][points_prefix]"
                                                                    class="form-control">
                                                                    <option value="+"
                                                                        {{ isset($pov->points_prefix) && $pov->points_prefix == '+' ? 'selected' : '' }}>
                                                                        +</option>
                                                                    <option value="-"
                                                                        {{ isset($pov->points_prefix) && $pov->points_prefix == '-' ? 'selected' : '' }}>
                                                                        -</option>
                                                                </select>
                                                                <input type="text"
                                                                    name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][points]"
                                                                    value="{{ $pov->points ?? '' }}" placeholder="Points"
                                                                    class="form-control">
                                                            </td>

                                                            {{-- @dump($pov->weight) --}}
                                                            <td>
                                                                <select
                                                                    name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][weight_prefix]"
                                                                    class="form-control">
                                                                    <option value="+"
                                                                        {{ isset($pov->weight_prefix) && $pov->weight_prefix == '+' ? 'selected' : '' }}>
                                                                        +</option>
                                                                    <option value="-"
                                                                        {{ isset($pov->weight_prefix) && $pov->weight_prefix == '-' ? 'selected' : '' }}>
                                                                        -</option>
                                                                </select>
                                                                <input type="text"
                                                                    name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][weight]"
                                                                    value="{{ $pov->weight ?? '' }}" class="form-control"
                                                                    placeholder="Weight">
                                                            </td>

                                                            {{-- <td>
                                                                <button type="button"
                                                                    class="btn btn-danger btn-sm remove-option-value">Delete</button>
                                                            </td> --}}

                                                            <td class="text-left">
                                                                <button type="button"
                                                                    onclick="removeOptionValueRow(this);"
                                                                    class="btn btn-danger">
                                                                    <i class="fa fa-minus-circle"></i>
                                                                </button>
                                                            </td>

                                                            <input type="hidden"
                                                                name="product_option[{{ $optionId }}][product_option_value][{{ $index }}][id]"
                                                                value="{{ $pov->id ?? '' }}">


                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="alert alert-warning">
                                    <strong>Warning!</strong> Option not found for Option ID {{ $optionId }}.
                                </div>
                            @endif
                        @endforeach


                        <template id="new-option-template">
                            <div class="col-12 new-option-block">
                                <div class="card mb-4">
                                    <div class="form-group mb-3 px-4">
                                        <label>Select Option</label>
                                        <select name="product_option[__INDEX__][option_id]" class="form-control">
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
                                                    <th>Points</th>
                                                    <th>Weight</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
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
        document.getElementById('add-size').addEventListener('click', function() {
            let wrapper = document.getElementById('size-wrapper');
            let sizeItem = document.createElement('div');
            sizeItem.classList.add('size-item');
            sizeItem.innerHTML = `
        <input type="text" name="sizes[]" placeholder="Size (e.g., 30cm x 20cm)" class="form-control" />
    `;
            wrapper.appendChild(sizeItem);
        });
    </script>
    
    <script>
            let optionIndex = {{ count($groupedProductOptionValues) + 1 }};

        function addNewOption() {
            const template = document.getElementById('new-option-template').innerHTML;
            const rendered = template.replace(/__INDEX__/g, optionIndex);
            const container = document.createElement('div');
            container.innerHTML = rendered;
            document.querySelector('form').appendChild(container);
            optionIndex++;
        }

        function addOptionValueRow(optionId) {
            const tbody = document.querySelector(`[name="product_option[${optionId}][option_id]"]`)
                .closest('.card')
                .querySelector('tbody');

            const index = tbody.rows.length;

            const row = document.createElement('tr');
            row.innerHTML = `
        <td>
            <select name="product_option[${optionId}][product_option_value][${index}][option_value_id]" class="form-control">
                @foreach ($options as $opt)
                    @foreach ($opt->option_values as $value)
                        <option value="{{ $value->id }}">{{ $value->option_name_en }}</option>
                    @endforeach
                @endforeach
            </select>
        </td>
        <td><input type="number" name="product_option[${optionId}][product_option_value][${index}][quantity]" class="form-control" /></td>
        <td>
            <select name="product_option[${optionId}][product_option_value][${index}][subtract]" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </td>
        <td>
            <select name="product_option[${optionId}][product_option_value][${index}][price_prefix]" class="form-control">
                <option value="+">+</option>
                <option value="-">-</option>
            </select>
            <input type="text" name="product_option[${optionId}][product_option_value][${index}][price]" class="form-control" placeholder="Price" />
        </td>
        <td>
            <select name="product_option[${optionId}][product_option_value][${index}][points_prefix]" class="form-control">
                <option value="+">+</option>
                <option value="-">-</option>
            </select>
            <input type="text" name="product_option[${optionId}][product_option_value][${index}][points]" class="form-control" placeholder="Points" />
        </td>
        <td>
            <select name="product_option[${optionId}][product_option_value][${index}][weight_prefix]" class="form-control">
                <option value="+">+</option>
                <option value="-">-</option>
            </select>
            <input type="text" name="product_option[${optionId}][product_option_value][${index}][weight]" class="form-control" placeholder="Weight" />
        </td>
        <td>
            <button type="button" class="btn btn-danger btn-sm" onclick="removeOptionValueRow(this)">
                <i class="fa fa-minus-circle"></i>
            </button>
        </td>
    `;

            tbody.appendChild(row);
        }

        function removeOptionValueRow(btn) {
            const row = btn.closest('tr');
            row.remove();
        }
    </script>

@endsection
