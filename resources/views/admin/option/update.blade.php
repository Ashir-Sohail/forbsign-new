@extends('layouts.admin')
@section('title')
    Option Update
@endsection
@section('content')
    <!--modal code start there-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Option Value</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        {{-- <input type="hidden" id="option-id"> --}}
                        <label for="option-name-en" class="fw-bold">Option Name En</label>
                        <input type="text" class="form-control" id="option-name-en"><br>
                        <label for="option-name-ar" class="fw-bold">Option Name Ar</label>
                        <input type="text" class="form-control" id="option-name-ar"><br>
                        <label for="option-serial" class="fw-bold">Sort Order</label>
                        <input type="text" class="form-control" id="option-serial"><br>
                        {{-- <label for="option-image" class="fw-bold">Image</label>
                        <img id="image-preview" src="" style="max-width: 100px; height: auto;"> --}}
                        <input type="hidden" id="option-id">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save-option-value">update</button>

                </div>
            </div>
        </div>
    </div>
    <!--modal code end here-->



    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Update Option</b> </h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.option.index') }}"><i
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
                                        <form class="admin-form"
                                            action="{{ route('admin.option.update', ['id' => $option->id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf


                                            <div class="form-group">
                                                <label for="name">Option Name 1 (English)*</label>
                                                <input type="text" name="option_name_en" class="form-control item-name"
                                                    id="option_name_en" placeholder="Enter Name"
                                                    value="{{ $option->option_name_en }}">
                                                @error('option_name_en')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="name">Option Name 2 (Arabic)*</label>
                                                <input type="text" name="option_name_ar" class="form-control item-name"
                                                    id="option_name_ar" placeholder="Enter Name"
                                                    value="{{ $option->option_name_ar }}">
                                                @error('option_name_ar')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="title">Type *</label>
                                                <select name="input_type" id="input-type-select" class="form-control">
                                                    <option value="" disabled
                                                        {{ old('input_type', $option->input_type) == '' ? 'selected' : '' }}>
                                                        -- Choose Input Type --</option>

                                                    <optgroup label="Choose">
                                                        <option value="select"
                                                            {{ old('input_type', $option->input_type) == 'select' ? 'selected' : '' }}>
                                                            Select</option>
                                                        <option value="radio"
                                                            {{ old('input_type', $option->input_type) == 'radio' ? 'selected' : '' }}>
                                                            Radio</option>
                                                        <option value="checkbox"
                                                            {{ old('input_type', $option->input_type) == 'checkbox' ? 'selected' : '' }}>
                                                            Checkbox</option>
                                                    </optgroup>

                                                    <optgroup label="Input">
                                                        <option value="text"
                                                            {{ old('input_type', $option->input_type) == 'text' ? 'selected' : '' }}>
                                                            Text</option>
                                                        <option value="textarea"
                                                            {{ old('input_type', $option->input_type) == 'textarea' ? 'selected' : '' }}>
                                                            Textarea</option>
                                                    </optgroup>

                                                    <optgroup label="File">
                                                        <option value="file"
                                                            {{ old('input_type', $option->input_type) == 'file' ? 'selected' : '' }}>
                                                            File</option>
                                                    </optgroup>

                                                    <optgroup label="Date">
                                                        <option value="date"
                                                            {{ old('input_type', $option->input_type) == 'date' ? 'selected' : '' }}>
                                                            Date</option>
                                                        <option value="time"
                                                            {{ old('input_type', $option->input_type) == 'time' ? 'selected' : '' }}>
                                                            Time</option>
                                                        <option value="datetime"
                                                            {{ old('input_type', $option->input_type) == 'datetime' ? 'selected' : '' }}>
                                                            Date &amp; Time</option>
                                                    </optgroup>
                                                </select>

                                                @error('input_type')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                            </div>

                                            <div class="form-group">
                                                <label for="serial">Sort *</label>
                                                <input type="number" name="serial" class="form-control" id="serial"
                                                    placeholder="Enter Serial Number" value="{{ $option->serial }}">
                                                @error('serial')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <input type="hidden" id="option-values-json" name="option_values"
                                                value='@json($option->option_value)'>

                                            <!-- Option Values -->
                                            @php
                                                $option_values = $option->option_values;
                                            @endphp

                                            <div id="option-value-wrapper" style="display: none;">



                                                <table id="option-value-table"
                                                    class="table table-striped table-bordered table-hover mt-4">
                                                    <thead>
                                                        <th>Option Value Name</th>
                                                        <th>Image</th>
                                                        <th>Sort Order</th>
                                                        <th>Action</th>
                                                    </thead>
                                                    <tbody id="option-value-tbody">
                                                        @foreach ($option_values as $value)
                                                            <tr>
                                                                <td>
                                                                    <strong>Englsih:</strong>
                                                                    {{ $value->option_name_en ?? 'N/A' }} <br>
                                                                    <strong>Arabic:</strong>
                                                                    {{ $value->option_name_ar ?? 'N/A' }}
                                                                </td>

                                                                <td>
                                                                    {{-- @if (!empty($value['image']))
                                                                        <img src="{{ asset($value['image']) }}"
                                                                            alt="Option Image" width="50">
                                                                    @else
                                                                        No image
                                                                    @endif --}}
                                                                    <img src="{{ asset('assets/imgs/Fobsignlogo.svg') }}"
                                                                        class="img-thumbnail">

                                                                </td>

                                                                <td>{{ $value['serial'] }}</td>

                                                                <td>
                                                                    <!-- Delete and Edit buttons -->
                                                                    <a class="btn btn-danger btn-sm " data-toggle="modal"
                                                                        data-target="#confirm-delete" href="javascript:;"
                                                                        data-href="{{ route('admin.option.value.delete', $value->id) }}">
                                                                        <i class="fas fa-trash-alt"></i>
                                                                    </a>



                                                                    <button type="button"
                                                                        class="btn btn-secondary btn-sm edit-option-value"
                                                                        data-toggle="modal" data-target="#exampleModal"
                                                                        data-id="{{ $value->id }}"
                                                                        data-name-en="{{ $value->option_name_en }}"
                                                                        data-name-ar="{{ $value->option_name_ar }}"
                                                                        data-serial="{{ $value->serial }}"
                                                                        {{-- data-image="{{ asset('uploads/' . $value->image) }}" --}}>
                                                                        <i class="fas fa-edit"></i>
                                                                    </button>

                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                                <button type="button" id="add-option-value" class="btn btn-primary mb-3"
                                                    style="display:none;">
                                                    Add Option Value
                                                </button>
                                            </div>



                                            <div class="form-group">
                                                <button type="submit" class="btn btn-secondary ">Update</button>
                                            </div>

                                        </form>
                                    </div>

                                    <!-- Modal for delete confirmation -->
                                    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog"
                                        aria-labelledby="confirm-deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Confirm
                                                        Delete?
                                                    </h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    You are going to delete this option
                                                    value. All contents related with
                                                    this option value will be lost. Do
                                                    you
                                                    want
                                                    to delete it?
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
                                                    {{-- <form action="{{ route('admin.option.value.delete', $value->id) }}"
                                                        class="d-inline btn-ok" method="GET">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form> --}}
                                                    <form action="" class="d-inline btn-ok" method="GET">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Delete</button>
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
            </div>
        </div>
    </div>
@endsection


@section('footer')
    <script>
        $(document).ready(function() {

            // Toggle option values section based on select type
            $('#input-type-select').on('change', function() {
                var selectedType = $(this).val();

                if (selectedType === 'select' || selectedType === 'radio' || selectedType === 'checkbox') {
                    $('#option-value-wrapper').show();
                    $('#add-option-value').show();
                } else {
                    $('#option-value-wrapper').hide();
                    $('#add-option-value').hide();
                }
            });

            // Trigger change on page load (important for edit forms)
            $('#input-type-select').trigger('change');

            // Add new option value row
            $('#add-option-value').on('click', function() {
                let newRow = `
                    <tr>
                        <td>
                            <input type="text" name="option_value_name_en[]" class="form-control" placeholder="Option Name English"
                                required />
                            <input type="text" name="option_value_name_ar[]" class="form-control mt-1"
                                placeholder="Option Name Arabic" required />
                        </td>
                       
                         <td class="text-center">
                            <input type="hidden" class="option-value-image" value="" name="option_value_image[]">
                                    <img src="{{ asset('assets/imgs/Fobsignlogo.svg') }}" class="img-thumbnail">
                        </td>
                        <td>
                            <input type="number" name="option_value_serial[]" class="form-control" placeholder="Sort Order" required />
                        </td>
                      

                        <td class="text-right">
                            <button type="button" onclick="removeOptionValueRow(this);" class="btn btn-danger remove-option-value">
                                <i class="fa fa-minus-circle"></i>
                            </button>
                        </td>
                    </tr>`;
                $('#option-value-tbody').append(newRow);
            });

            // Remove option value row dynamically
            $(document).on('click', '.remove-option-value', function() {
                $(this).closest('tr').remove();
            });
        });
    </script>
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            let button = $(e.relatedTarget); // The button that triggered the modal
            let href = button.data('href'); // Extract info from data-* attributes
            $(this).find('form.btn-ok').attr('action', href);
        });
    </script>

    <script>
        $('.admin-form').on('submit', function(e) {
            const type = $('#input-type-select').val();

            if (type === 'select' || type === 'radio' || type === 'checkbox') {
                let hasNewOption = false;
                let hasExistingOption = $('#option-value-tbody tr').length > 0;

                // Check if any newly added option input (name fields) has a value
                $('input[name="option_value_name_en[]"]').each(function() {
                    if ($(this).val().trim() !== '') {
                        hasNewOption = true;
                        return false; // break loop
                    }
                });

                if (!hasNewOption && !hasExistingOption) {
                    e.preventDefault();
                    toastr.error('Please add at least one option value.');
                }
            }
        });
    </script>
@endsection
