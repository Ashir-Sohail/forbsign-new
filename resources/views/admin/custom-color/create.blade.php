@extends('layouts.admin')
@section('title')
    Custom Color Create
@endsection
@section('content')
    <div class="content">
        <div class="page-inner">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="mb-0 bc-title"><b>Create Custom Color</b> </h3>
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.custom_color.index') }}"><i
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
                                    <div class="col-12">
                                        <form class="admin-form" action="{{ route('admin.custom_color.store') }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf



                                            {{-- Name --}}
                                            <div class="form-group">
                                                <label for="name">Color Name *</label>
                                                <input type="text" name="name" class="form-control" id="name"
                                                    placeholder="Enter Color Name" value="{{ old('name') }}">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Color Picker --}}
                                            <div class="form-group">
                                                <label for="hex_code">Pick Color *</label><br>
                                                <input type="color" name="hex_code" id="hex_code" class="form-control"
                                                    value="{{ old('hex_code', '#ff0000') }}"
                                                    style="width: 80px; height: 50px; padding: 0;"
                                                    oninput="document.getElementById('hex_preview').textContent = this.value">

                                                <small class="text-muted">Hex Code: <span
                                                        id="hex_preview">{{ old('hex_code', '#ff0000') }}</span></small>

                                                @error('hex_code')
                                                    <br><span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>


                                            {{-- Optional Price --}}
                                            <div class="form-group">
                                                <label for="price">Additional Price (Optional)</label>
                                                <input type="number" step="0.01" name="price" class="form-control"
                                                    id="price" placeholder="e.g. 100.00" value="{{ old('price') }}">
                                                @error('price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            {{-- Serial --}}
                                            <div class="form-group">
                                                <label for="serial">Serial (Sort Order)</label>
                                                <input type="number" name="serial" class="form-control" id="serial"
                                                    placeholder="Enter serial number" value="{{ old('serial', 0) }}">
                                                @error('serial')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>



                                            {{-- Submit --}}
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-secondary">Submit</button>
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
    </div>
@endsection
