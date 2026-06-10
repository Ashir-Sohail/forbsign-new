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
                            <a class="btn btn-primary   btn-sm"
                                href="https://geniusdevs.com/codecanyon/omnimart40/admin/item"><i
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
                                        <label for="meta_title">Meta Title
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
                                        <label for="meta_keywords">Meta Keywords
                                        </label>
                                        <input type="text" name="meta_keyword" class="tags" id="meta_keywords"
                                            placeholder="Enter Meta Keywords" value="{{ old('meta_keyword') }}">
                                        @error('meta_keyword')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">Meta Description
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
                                                <span class="input-group-text">$</span>
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
                                                <span class="input-group-text">$</span>
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
                                        <label for="category_id">Select Category *</label>
                                        <select name="cat_id" id="category_id"
                                            data-href="{{ url('admin/product/nested/sub/category') }}"
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
                                        <label for="brand_id">Select Brand</label>
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
                                    <h5>Add Sizes</h5>
                                    <div id="size-wrapper">
                                        <div class="size-item">
                                            <input type="text" name="sizes[]" placeholder="Size (e.g., 20cm x 15cm)"
                                                class="form-control" />
                                            @error('sizes.0')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            {{-- <input type="text" name="prices[]" placeholder="Additional Price"
                                                class="form-control" />
                                            @error('prices.0')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    {{-- @error('sizes')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror --}}
                                    <button type="button" id="add-size" class="btn btn-sm btn-success">Add
                                        Size</button>
                                </div>

                            </div>

                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="option_id">Select Option</label>
                                        <select name="option_id" id="option_id" class="form-control">
                                            <option value="" selected>Select Option</option>
                                            @foreach ($options as $option)
                                                <option value="{{ $option->id }}">
                                                    {{ $option->option_name_en }}
                                                </option>
                                            @endforeach

                                        </select>
                                        @error('option_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="required-field">Required</label>
                                        <select id="required-field" name="required-option-value" class="form-control">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
                                    </div>


                                    <div class="card">
                                        <div class="card-body">
                                            <table class="table">
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
                                                <tbody id="option-value-rows">
                                                    <!-- New rows will be appended here -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>


                    </div>
                </form>





                <!-- Confirmation Modal -->
                <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
                    aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete?</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body">
                                You are going to delete this option. All contents related to this option will be lost. Do
                                you want to delete it?
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" id="confirm-delete-btn" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@section('footer')
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

    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('#option_id').change(function() {
                // alert('Option changed');
                var optionId = $(this).val();
                // alert('here');

                // Clear previous option values
                $('#option-value-rows').empty();

                if (optionId) {
                    // Fetch option values based on the selected option
                    $.ajax({
                        url: '/admin/product/get-option-values/' + optionId,
                        type: 'GET',
                        success: function(data) {
                            // alert('success');
                            // Check if data is empty
                            if (data.length === 0) {
                                // Append a message indicating no option values
                                var noValueRow = `
                                <tr>
                                    <td colspan="7" class="text-center">
                                        This option has no option values.
                                    </td>
                                </tr>`;
                                $('#option-value-rows').append(noValueRow);
                            } else {
                                // Assuming 'data' is an array of option values
                                $.each(data, function(index, value) {
                                    var rowHtml = `
                                    <tr>
                                        <td class="text-left">
                                            <div class="form-group">
                                                <select name="product_option[0][product_option_value][${index}][option_value_id]" class="form-control">
                                                    <option value="${value.id}">${value.option_name_en}</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td class="text-right">
                                            <input type="text" name="product_option[0][product_option_value][${index}][quantity]" value="" placeholder="Quantity" class="form-control">
                                        </td>
                                        <td class="text-left">
                                            <select name="product_option[0][product_option_value][${index}][subtract]" class="form-control">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </td>
                                        <td class="text-right">
                                            <select name="product_option[0][product_option_value][${index}][price_prefix]" class="form-control">
                                                <option value="+">+</option>
                                                <option value="-">-</option>
                                            </select>
                                            <input type="text" name="product_option[0][product_option_value][${index}][price]" value="" placeholder="Price" class="form-control">
                                        </td>
                                        <td class="text-right">
                                            <select name="product_option[0][product_option_value][${index}][points_prefix]" class="form-control">
                                                <option value="+">+</option>
                                                <option value="-">-</option>
                                            </select>
                                            <input type="text" name="product_option[0][product_option_value][${index}][points]" value="" placeholder="Points" class="form-control">
                                        </td>
                                        <td class="text-right">
                                            <select name="product_option[0][product_option_value][${index}][weight_prefix]" class="form-control">
                                                <option value="+">+</option>
                                                <option value="-">-</option>
                                            </select>
                                            <input type="text" name="product_option[0][product_option_value][${index}][weight]" value="" placeholder="Weight" class="form-control">
                                        </td>
                                        <td class="text-left">
                                            <button type="button" onclick="removeOptionValueRow(this);" class="btn btn-danger">
                                                <i class="fa fa-minus-circle"></i>
                                            </button>
                                        </td>
                                    </tr>`;
                                    $('#option-value-rows').append(rowHtml);
                                });
                            }
                        },
                        error: function() {
                            alert('Failed to fetch option values. Please try again.');
                        }
                    });
                }
            });
        });
    </script>
    <script>
        function removeOptionValueRow(button) {
            // alert('removeOptionValueRow');
            // Store the closest <tr> to delete later
            rowToDelete = $(button).closest('tr');
            console.log(rowToDelete);
            // Show the confirmation modal
            $('#confirm-delete').modal('show');
        }

        // Handle the confirmation button click
        $('#confirm-delete-btn').click(function() {
            if (rowToDelete) {
                // Remove the row from the frontend
                rowToDelete.remove();
                // Optionally, clear the variable after deletion
                rowToDelete = null;
            }
            // Hide the modal
            $('#confirm-delete').modal('hide');
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
        const imageInput = document.getElementById('imageInput');
        const container = document.getElementById('imagePreviewContainer');
        let dataTransfer = new DataTransfer();

        imageInput.addEventListener('change', function(event) {
            const files = Array.from(event.target.files);
            if (files.length + dataTransfer.files.length > 10) {
                alert('You can upload a maximum of 10 images.');
                event.target.value = "";
                return;
            }

            files.forEach((file, index) => {
                // Add file to DataTransfer
                dataTransfer.items.add(file);

                const reader = new FileReader();
                reader.onload = function(e) {
                    const wrapper = document.createElement('div');
                    wrapper.style.position = 'relative';

                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'admin-img lg';
                    img.style.height = '100px';
                    img.style.marginRight = '10px';

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

                    // Handle image remove
                    removeBtn.addEventListener('click', () => {
                        // Remove from DataTransfer
                        const newDataTransfer = new DataTransfer();
                        Array.from(dataTransfer.files).forEach((item, i) => {
                            if (i !== index) {
                                newDataTransfer.items.add(item);
                            }
                        });
                        dataTransfer = newDataTransfer;
                        imageInput.files = dataTransfer.files;

                        // Remove preview
                        wrapper.remove();
                    });

                    wrapper.appendChild(img);
                    wrapper.appendChild(removeBtn);
                    container.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });

            imageInput.files = dataTransfer.files;
        });
    </script>
@endsection
