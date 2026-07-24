@extends('layouts.admin')
@section('title')
    Create Product
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Create Product</b> </h3>
                            <a class="btn btn-primary   btn-sm" href="{{ url()->previous() }}"><i
                                    class="fas fa-chevron-left"></i> Back</a>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <form class="admin-form tab-form" action="{{ route('admin.product.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name *</label>
                                        <input type="text" name="name" class="form-control item-name" id="name"
                                            placeholder="Enter Name" value="{{ old('name') }}">
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
                                        <img class="admin-img lg" src="">
                                    </div>
                                    <div class="form-group position-relative ">
                                        <label class="file">
                                            <input type="file" accept="image/*" class="upload-photo"
                                                name="featured_image" id="file1" aria-label="File browser example"
                                                value="{{ old('featured_image') }}">
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

                            <!-- Multiple Product Images Upload -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group pb-0  mb-0">
                                        <label class="d-block">Additional Product Images *</label>
                                    </div>

                                    <!-- Preview container -->
                                    <div class="form-group pb-0 pt-0 mt-0 mb-0 d-flex flex-wrap gap-2"
                                        id="imagePreviewContainer">
                                        <!-- Image previews will appear here -->
                                    </div>


                                    <div class="form-group position-relative ">
                                        <label class="file">
                                            <input type="file" accept="image/*" class="upload-photo" name="images[]"
                                                id="imageInput" aria-label="File browser example" multiple>
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
                                        <textarea name="short_description" id="sort_details" class="form-control" placeholder="Short Description">{{ old('short_description') }}</textarea>
                                        @error('short_description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="details">Description *</label>
                                        <textarea name="description" id="description" class="form-control text-editor" rows="6"
                                            placeholder="Enter Description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group mb-2">
                                        <label for="meta_title">Meta Title *
                                        </label>
                                        <input type="text" name="meta_title" class="form-control" id="meta_title"
                                            placeholder="Enter Meta Title" value="{{ old('meta_title') }}">
                                        @error('meta_title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="title">SEO URL *</label>
                                        <input type="text" name="meta_url" class="form-control" id="meta_url"
                                            placeholder="Enter Meta Link" value="{{ old('meta_url') }}">
                                        @error('meta_url')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords *
                                        </label>
                                        <input type="text" name="meta_keyword" class="tags" id="meta_keywords"
                                            placeholder="Enter Meta Keywords" value="{{ old('meta_keyword') }}">
                                        @error('meta_keyword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">Meta Description *
                                        </label>
                                        <textarea name="meta_description" id="meta_description" class="form-control" rows="5"
                                            placeholder="Enter Meta Description">{{ old('meta_description') }}</textarea>
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
                                    <button type="submit" class="btn btn-secondary mr-2">Save</button>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="discount_price">Current Price
                                            *</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">{{ config('app.currency.symbol') }}</span>
                                            </div>
                                            <input type="text" id="current_price" name="current_price"
                                                class="form-control" placeholder="Enter Current Price" min="1"
                                                step="0.1" value="{{ old('current_price') }}"><br>
                                            @error('current_price')
                                                <span class="text-danger col-12 px-0">{{ $message }}</span>
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
                                                step="0.1" value="{{ old('previous_price') }}">
                                            @error('previous_price')
                                                <span class="text-danger col-12 px-0">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="points">Points</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">#</span> {{-- Optional: use # or other icon instead of $ for points --}}
                                            </div>
                                            <input type="number" id="points" name="points" class="form-control"
                                                placeholder="Enter Points" min="1" step="1"
                                                value="{{ old('points', $product->points ?? '') }}">
                                        </div>
                                        @error('points')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="weight">Weight</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Kg</span> {{-- or "g", "lbs" depending on your unit --}}
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

                                    <div class="form-group">
                                        <label for="category_id">Select Category *</label>
                                        <select name="cat_id" id="category_id"
                                            data-href="{{ route('admin.product.get.sub.category') }}"
                                            class="form-control category-dropdown">
                                            <option value="" selected>Select One</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('cat_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div id="subcategory-wrapper"></div>


                                </div>
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="brand_id">Select Brand *</label>
                                        <select name="brand_id" id="brand_id" class="form-control">
                                            <option value="" disabled {{ old('brand_id') ? '' : 'selected' }}>Select
                                                Brand</option>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->name }}
                                                </option>
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
                                                placeholder="Total in stock" value="{{ old('total_stock') }}">
                                            @error('total_stock')
                                                <span class="text-danger col-12 px-0">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                       
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="informative">Informative Product *</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="informative"
                                                id="informative_yes" value="1">
                                            <label class="form-check-label" for="informative_yes">
                                                Yes
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="informative"
                                                id="informative_no" value="0" checked>
                                            <label class="form-check-label" for="informative_no">
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="card">
                                <div class="card-body">
                                    <h5>Add Sizes</h5>
                                    <div id="size-wrapper">
                                        <div class="size-item">
                                            <input type="text" name="sizes[]" placeholder="Size (e.g., 20cm x 15cm)"
                                                class="form-control" />
                                            @error('sizes.0')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>
                                    </div>
                                    <button type="button" id="add-size" class="btn btn-sm btn-success">Add
                                        Size</button>
                                </div>
                            </div> --}}

                        </div>

                        <!-- Container for dynamic options -->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="product-options-container"></div>

                                    <!-- Add Option Button -->
                                    <button type="button" id="add-option-btn" class="btn btn-primary mt-3">
                                        Add Option
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>


            </div>
        </div>
    </div>
@endsection

@section('footer')
    <!-- code show nested subcategory -->
    <script>
        $(document).on('change', '.category-dropdown', function() {
            alert('Category changed');
            const categoryId = $(this).val();
            const href = $('#category_id').data('href');
            const currentSelect = $(this);

            //  Always remove dropdowns that appear after the currently selected one
            currentSelect.nextAll('.category-dropdown').remove();

            if (categoryId) {
                $.ajax({
                    url: href,
                    type: 'POST',
                    data: {
                        parent_id: categoryId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // console.log(response);
                        //  Remove again in case response comes late
                        currentSelect.nextAll('.category-dropdown').remove();

                        // Only add new dropdown if there are subcategories
                        if (response.length > 0) {
                            let subCategorySelect =
                                '<select class="form-control mt-2 category-dropdown">';
                            subCategorySelect += '<option value="">Select Subcategory</option>';
                            response.forEach(function(category) {
                                subCategorySelect +=
                                    `<option value="${category.id}">${category.name}</option>`;
                            });
                            subCategorySelect += '</select>';

                            //  Insert the new subcategory dropdown after the current one
                            currentSelect.after(subCategorySelect);
                        }
                    }
                });
            }
        });
    </script>

    <!-- Add Product Options and option Values Script -->
    <script>
        let optionIndex = 0;

        // Initialize options on page load (repopulate after validation failure)
        $(document).ready(function() {
            @if (old('product_option'))
                let oldOptions = @json(old('product_option'));
                repopulateOptions(oldOptions);
            @endif
        });

        $('#add-option-btn').click(function() {
            addOptionBlock();
        });

        function addOptionBlock(optionData = null) {
            let optionBlock = `
        <div class="option-block card mt-4" data-index="${optionIndex}">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Option ${optionIndex + 1}</h5>
                <button type="button" class="btn btn-danger btn-sm remove-option-btn">
                    <i class="fa fa-times"></i> Remove Option
                </button>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Select Option</label>
                    <select name="product_option[${optionIndex}][option_id]" class="form-control option-select">
                        <option value="">Select Option</option>
                        @foreach ($options as $option)
                            <option value="{{ $option->id }}" ${optionData && optionData.option_id == '{{ $option->id }}' ? 'selected' : ''}>{{ $option->option_name_en }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Required</label>
                    <select name="product_option[${optionIndex}][required]" class="form-control">
                        <option value="0" ${optionData && optionData.required == '0' ? 'selected' : ''}>No</option>
                        <option value="1" ${optionData && optionData.required == '1' ? 'selected' : ''}>Yes</option>
                    </select>
                </div>

                <table class="table mt-3">
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
                    <tbody class="option-value-rows">
                        <!-- Option values will be loaded here -->
                    </tbody>
                </table>
            </div>
        </div>`;

            $('#product-options-container').append(optionBlock);

            // If we have option data, populate the option values
            if (optionData && optionData.option_id) {
                populateOptionValues(optionIndex, optionData.option_id, optionData.product_option_value || {});
            }

            optionIndex++;
        }

        // Function to repopulate all options after validation failure
        function repopulateOptions(oldOptions) {
            Object.keys(oldOptions).forEach(function(key) {
                addOptionBlock(oldOptions[key]);
            });
        }

        // Function to populate option values for a specific option
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
                            `<tr><td colspan="7" class="text-center">No option values.</td></tr>`
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

        // Function to add a single option value row
        function addOptionValueRow(blockIndex, valueIndex, optionValue, existingData = {}) {
            let block = $(`.option-block[data-index="${blockIndex}"]`);
            let tbody = block.find('.option-value-rows');

            let row = `
        <tr>
            <td>
                <select name="product_option[${blockIndex}][product_option_value][${valueIndex}][option_value_id]" class="form-control">
                    <option value="${optionValue.id}">${optionValue.option_name_en}</option>
                </select>
            </td>
            <td>
                <input type="text" 
                       name="product_option[${blockIndex}][product_option_value][${valueIndex}][quantity]" 
                       class="form-control" 
                       placeholder="Quantity"
                       value="${existingData.quantity || ''}">
            </td>
            <td>
                <select name="product_option[${blockIndex}][product_option_value][${valueIndex}][subtract]" class="form-control">
                    <option value="1" ${existingData.subtract == '1' ? 'selected' : ''}>Yes</option>
                    <option value="0" ${existingData.subtract == '0' ? 'selected' : ''}>No</option>
                </select>
            </td>
            <td>
                <select name="product_option[${blockIndex}][product_option_value][${valueIndex}][price_prefix]" class="form-control">
                    <option value="+" ${existingData.price_prefix == '+' ? 'selected' : ''}>+</option>
                    <option value="-" ${existingData.price_prefix == '-' ? 'selected' : ''}">-</option>
                </select>
                <input type="number" 
                       name="product_option[${blockIndex}][product_option_value][${valueIndex}][price]" 
                       class="form-control" 
                       placeholder="Price"
                       value="${existingData.price || ''}">
            </td>
            <td>
                <select name="product_option[${blockIndex}][product_option_value][${valueIndex}][points_prefix]" class="form-control">
                    <option value="+" ${existingData.points_prefix == '+' ? 'selected' : ''}>+</option>
                    <option value="-" ${existingData.points_prefix == '-' ? 'selected' : ''}">-</option>
                </select>
                <input type="number" 
                       name="product_option[${blockIndex}][product_option_value][${valueIndex}][points]" 
                       class="form-control" 
                       placeholder="Points"
                       value="${existingData.points || ''}">
            </td>
            <td>
                <select name="product_option[${blockIndex}][product_option_value][${valueIndex}][weight_prefix]" class="form-control">
                    <option value="+" ${existingData.weight_prefix == '+' ? 'selected' : ''}>+</option>
                    <option value="-" ${existingData.weight_prefix == '-' ? 'selected' : ''}">-</option>
                </select>
                <input type="number" 
                       name="product_option[${blockIndex}][product_option_value][${valueIndex}][weight]" 
                       class="form-control" 
                       placeholder="Weight"
                       value="${existingData.weight || ''}">
            </td>
            <td>
                <button type="button" onclick="$(this).closest('tr').remove()" class="btn btn-danger">
                    <i class="fa fa-minus-circle"></i>
                </button>
            </td>
        </tr>`;

            tbody.append(row);
        }

        // Remove option block
        $(document).on('click', '.remove-option-btn', function() {
            $(this).closest('.option-block').remove();
        });

        // Handle option select change
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
    </script>


    <script>
        const imageInput = document.getElementById('imageInput');
        const container = document.getElementById('imagePreviewContainer');
        let selectedFiles = [];

        function getFileId(file) {
            return `${file.name}_${file.size}_${file.lastModified}`;
        }

        function syncFilesToInput() {
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            imageInput.files = dt.files;
        }

        function renderPreviews() {
            container.innerHTML = '';

            selectedFiles.forEach(file => {
                const fileId = getFileId(file);
                const reader = new FileReader();

                reader.onload = function(e) {
                    const wrapper = document.createElement('div');
                    wrapper.style.position = 'relative';
                    wrapper.style.display = 'inline-block';
                    wrapper.style.margin = '5px';
                    wrapper.dataset.id = fileId;

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.height = '100px';
                    img.style.width = '100px';
                    img.style.objectFit = 'cover';
                    img.style.border = '1px solid #ccc';
                    img.style.borderRadius = '4px';

                    const removeBtn = document.createElement('span');
                    removeBtn.innerHTML = '&times;';
                    removeBtn.style.position = 'absolute';
                    removeBtn.style.top = '0px';
                    removeBtn.style.right = '5px';
                    removeBtn.style.cursor = 'pointer';
                    removeBtn.style.color = 'red';
                    removeBtn.style.fontSize = '20px';
                    removeBtn.style.background = 'white';
                    removeBtn.style.borderRadius = '50%';
                    removeBtn.style.padding = '0 5px';

                    removeBtn.addEventListener('click', () => {
                        selectedFiles = selectedFiles.filter(f => getFileId(f) !== fileId);
                        renderPreviews();
                        syncFilesToInput();
                    });

                    wrapper.appendChild(img);
                    wrapper.appendChild(removeBtn);
                    container.appendChild(wrapper);
                };

                reader.readAsDataURL(file);
            });

            syncFilesToInput();
        }

        imageInput.addEventListener('change', function(event) {
            const newFiles = Array.from(event.target.files);

            if (selectedFiles.length + newFiles.length > 10) {
                alert("You can upload a maximum of 10 images.");
                imageInput.value = '';
                return;
            }

            newFiles.forEach(file => {
                const fileId = getFileId(file);
                if (!selectedFiles.some(f => getFileId(f) === fileId)) {
                    selectedFiles.push(file);
                }
            });

            renderPreviews();
            imageInput.value = ''; // Allow re-selecting same file again
        });
    </script>
    <script>
        document.querySelector('form').addEventListener('submit', function() {
            syncFilesToInput(); // Ensure imageInput.files is updated before submit
        });
    </script>
@endsection
