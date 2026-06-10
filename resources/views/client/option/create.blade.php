@extends('layouts.admin_two')
@section('title')
    Option Create
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Create Option</b> </h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('client.option.index') }}"><i
                                    class="fas fa-chevron-left"></i> Back</a>
                        </div>
                    </div>
                </div>

                <!-- Form -->
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12">

                        <div class="card o-hidden border-0 shadow-lg">
                            <div class="card-body ">
                                <!-- Nested Row within Card Body -->
                                <div class="row justify-content-center">
                                    <div class="col-lg-12">
                                        <form class="admin-form" method="POST" enctype="multipart/form-data"
                                            id="option-form" action="{{ route('client.option.store') }}">
                                            @csrf
                                            {{-- <div class="form-group">
                                                <label for="name">Set Image *</label>

                                                <br>
                                                <img class="admin-img" src="{{ asset('public/admin/dummy.jpg') }}"
                                                    alt="No Image Found">
                                                <br>
                                                <span class="mt-1">Image Size Should Be 60 x 60.</span>
                                            </div>

                                            <div class="form-group position-relative">
                                                <label class="file">
                                                    <input type="file" accept="image/*" class="upload-photo"
                                                        name="image" id="file" aria-label="File browser example"
                                                        required>
                                                    <span class="file-custom text-left">Upload Image...</span>
                                                </label>
                                                @error('image')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div> --}}

                                            <div class="form-group">
                                                <label for="name">Option Name 1 (English)*</label>
                                                <input type="text" name="option_name_en" class="form-control item-name"
                                                    id="option_name_en" placeholder="Enter Name"
                                                    value="{{ old('option_name_en') }}" required>
                                                @error('option_name_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Option Name 2 (Arabic)*</label>
                                                <input type="text" name="option_name_ar" class="form-control item-name"
                                                    id="option_name_ar" placeholder="Enter Name"
                                                    value="{{ old('option_name_ar') }}" required>
                                                @error('option_name_ar')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="form-group">
                                                <label for="title">Type *</label>
                                                <select name="input_type" id="input-type" class="form-control" required>

                                                    <option value="" disabled
                                                        {{ old('input_type') ? '' : 'selected' }}>--
                                                        Choose Input Type --</option>

                                                    <optgroup label="Choose">
                                                        <option value="select"
                                                            {{ old('input_type') == 'select' ? 'selected' : '' }}>Select
                                                        </option>
                                                        <option value="radio"
                                                            {{ old('input_type') == 'radio' ? 'selected' : '' }}>Radio
                                                        </option>
                                                        <option value="checkbox"
                                                            {{ old('input_type') == 'checkbox' ? 'selected' : '' }}>
                                                            Checkbox
                                                        </option>
                                                    </optgroup>

                                                    <optgroup label="Input">
                                                        <option value="text"
                                                            {{ old('input_type') == 'text' ? 'selected' : '' }}>Text
                                                        </option>
                                                        <option value="textarea"
                                                            {{ old('input_type') == 'textarea' ? 'selected' : '' }}>
                                                            Textarea
                                                        </option>
                                                    </optgroup>

                                                    <optgroup label="File">
                                                        <option value="file"
                                                            {{ old('input_type') == 'file' ? 'selected' : '' }}>File
                                                        </option>
                                                    </optgroup>

                                                    <optgroup label="Date">
                                                        <option value="date"
                                                            {{ old('input_type') == 'date' ? 'selected' : '' }}>Date
                                                        </option>
                                                        <option value="time"
                                                            {{ old('input_type') == 'time' ? 'selected' : '' }}>Time
                                                        </option>
                                                        <option value="datetime"
                                                            {{ old('input_type') == 'datetime' ? 'selected' : '' }}>Date
                                                            &amp;
                                                            Time</option>
                                                    </optgroup>
                                                </select>
                                                <span class="text-danger" id="inputTypeError" style="display: none;">Please
                                                    select a valid input type.</span>

                                                @error('input_type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>
                                            <div class="form-group">
                                                <label for="serial">Sort *</label>
                                                <input type="number" name="serial" class="form-control" id="serial"
                                                    placeholder="Enter Serial Number" value="0" required>
                                                @error('serial')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <input type="hidden" id="option-values-json" name="option_values"
                                                value="">

                                            <div class="form-group">
                                                <!-- Dynamic Table -->
                                                <div id="option-value-section" style="display: none;">

                                                    <div class="card">
                                                        <div class="card-body">
                                                            <table id="option-value-table"
                                                                class="table table-striped table-bordered table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Option Value Name</th>
                                                                        <th>Image</th>
                                                                        <th>Sort Order</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="option-value-tbody">
                                                                    <!-- Dynamic rows will be added here -->
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td colspan="3"></td>
                                                                        <td class="text-right">
                                                                            <button type="button" id="add-option-value"
                                                                                {{-- onclick="addOptionValueRow();" --}} data-toggle="tooltip"
                                                                                title="Add Option Value"
                                                                                class="btn btn-primary">
                                                                                <i class="fa fa-plus-circle"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Submit Button (Always Visible) -->
                                                <button type="submit"
                                                    class="btn btn-secondary ms-start pull-right">Submit</button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('input-type').addEventListener('change', function() {
                const selectedType = this.value;
                // console.log(selectedType); // for debugging
                const optionSection = document.getElementById('option-value-section');

                if (['select', 'radio', 'checkbox'].includes(selectedType)) {
                    optionSection.style.display = 'block';
                } else {
                    optionSection.style.display = 'none';
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Add event listener to the button after DOM is ready
            document.getElementById('add-option-value').addEventListener('click', function() {
                addOptionValueRow();
            });
        });

        //  Define this outside the DOMContentLoaded so it's globally accessible
        function addOptionValueRow() {
            console.log('addOptionValueRow called');
            const tbody = document.getElementById('option-value-tbody');
            const row = document.createElement('tr');
            row.innerHTML = `
        <td class="text-left" data-option-value-row>
            <div class="input-group"> 
                <input type="text" class="form-control option-value-name-en" placeholder="Option Value Name English">
            </div>
            <div class="input-group">
                <input type="text" class="form-control option-value-name-ar" placeholder="Option Value Name Arabic">
            </div>
        </td>
        <td class="text-center">
            <input type="hidden" class="option-value-image" value="">
            <img src="{{ asset('assets/imgs/Fobsignlogo.svg') }}" class="img-thumbnail">
        </td>
        <td class="text-right">
            <input type="text" class="form-control option-value-sort" placeholder="Sort Order">
        </td>
        <td class="text-right">
            <button type="button" onclick="removeOptionValueRow(this);" class="btn btn-danger">
                <i class="fa fa-minus-circle"></i>
            </button>
        </td>
    `;
            tbody.appendChild(row);
        }

        // This also should be global if used inline
        function removeOptionValueRow(button) {
            const row = button.closest('tr');
            row.remove();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('option-form');

            form.addEventListener('submit', function(e) {
                const inputType = document.getElementById('input-type').value;
                const rows = document.querySelectorAll('#option-value-tbody tr');
                let values = [];

                rows.forEach(row => {
                    const nameEn = row.querySelector('.option-value-name-en')?.value.trim();
                    const nameAr = row.querySelector('.option-value-name-ar')?.value.trim();
                    const sort = row.querySelector('.option-value-sort')?.value.trim();
                    const image = row.querySelector('.option-value-image')?.value
                        .trim(); // You can handle file upload later

                    if (nameEn && nameAr) {
                        values.push({
                            name_en: nameEn,
                            name_ar: nameAr,
                            sort_order: sort || 0,
                            image: image || ''
                        });
                    }
                });
                // Validation logic
                if (['select', 'radio', 'checkbox'].includes(inputType) && values.length === 0) {
                    e.preventDefault(); // stop form submission
                    toastr.error('Please add at least one option value.', 'Validation Error');
                    return false;
                }

                document.getElementById('option-values-json').value = JSON.stringify(values);
            });
        });
    </script>
@endsection
