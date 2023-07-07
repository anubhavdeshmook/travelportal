@extends('backend.layouts.app')
@section('content')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Destination Create</h4>
            </div>
            <div class="col-7 align-self-center">
                <div class="d-flex align-items-center justify-content-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.destination') }}">Destinations List</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Destination Create</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">

                    {{ Form::open(['route' => ['admin.destination.save'], 'method' => 'post', 'id' => 'form']) }}
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="emailname">Destionation Name<span
                                            style="color: red;font-size:18px;"><b>*</b></span></label>
                                    {{ Form::text('name', old('name'), ['class' => 'form-control','pattern'=> "^[a-zA-Z_ ]*$", 'placeholder' => 'Enter Destination Name', 'id' => 'destination_name']) }}
                                    @error('name')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="emailsubject">Code<span
                                            style="color: red;font-size:18px;"><b>*</b></span></label>
                                    {{ Form::text('code', old('code'), ['class' => 'form-control', 'placeholder' => 'Enter Code', 'id' => 'code']) }}
                                    @error('code')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="emailname">Latitude<span
                                            style="color: red;font-size:18px;"><b>*</b></span></label>
                                    {{ Form::text('latitude', old('latitude'), ['class' => 'form-control', 'placeholder' => 'Enter Latitude', 'id' => 'latitude']) }}
                                    @error('latitude')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="emailsubject">Logitude<span
                                            style="color: red;font-size:18px;"><b>*</b></span></label>
                                    {{ Form::text('longitude', old('longitude'), ['class' => 'form-control', 'placeholder' => 'Enter Logitude', 'id' => 'logitude']) }}
                                    @error('longitude')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="emailsubject">Country<span
                                            style="color: red;font-size:18px;"><b>*</b></span></label>
                                    <select name="country_id" class="form-control">
                                        <option value=''>Select Country</option>
                                        @foreach ($country as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="emailsubject">Popular<span
                                            style="color: red;font-size:18px;"><b>*</b></span></label>
                                    <select name="is_popular" class="form-control">
                                        <option value='1'>Yes </option>
                                        <option value='0'>No</option>

                                    </select>
                                    @error('is_popular')
                                        <p style="color:red;">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox mr-sm-2 m-b-15">
                                        <input type="checkbox" class="custom-control-input" name="status" id="checkbox0"
                                            value="1">
                                        <label class="custom-control-label" for="checkbox0">Is Active </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <button type="submit" id="submitButton" class="btn btn-primary">Submit </button>
                        <a href="{{ route('admin.destination') }}" class="btn btn-secondary">Back</a>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            $.validator.addMethod('latCoord', function(value, element) {
                console.log(this.optional(element))
                return this.optional(element) ||
                    value.length >= 4 && /^(?=.)-?((8[0-5]?)|([0-7]?[0-9]))?(?:\.[0-9]{1,20})?$/.test(
                    value);
            }, 'Your Latitude format has error.')

            $.validator.addMethod('longCoord', function(value, element) {
                console.log(this.optional(element))
                return this.optional(element) ||
                    value.length >= 4 &&
                    /^(?=.)-?((0?[8-9][0-9])|180|([0-1]?[0-7]?[0-9]))?(?:\.[0-9]{1,20})?$/.test(value);
            }, 'Your Longitude format has error.')
            $('#form').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 100,
                    },
                    code: {
                        required: true,
                        maxlength: 100,
                    },
                    latitude: {
                        required: true,
                        maxlength: 100,
                   
                        latCoord: true
                    },
                    longitude: {
                        required: true,
                        maxlength: 100,
                        longCoord: true
                    },
                    country_id: {
                        required: true,
                        maxlength: 100,
                    },
                    popular: {
                        required: true,
                        maxlength: 100,
                    },





                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>


@stop
