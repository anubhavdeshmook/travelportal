@extends('backend.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Currency Create</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.currency')}}">Currencies List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Currency Create</li>
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
                         
                            {{ Form::open(['route' => ['admin.currency.save'], 'method' => 'post', 'id' => 'form']) }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailname">Name<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::text('name', old('name'), ['class' => 'form-control','pattern'=> "^[a-zA-Z_ ]*$", 'placeholder' => 'Enter Name', 'id' => 'destination_name']) }}
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
                                            <label for="emailname">Sign<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::text('sign', old('sign'), ['class' => 'form-control', 'placeholder' => 'Enter Sign', 'id' => 'sign']) }}
                                            @error('sign')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Current Rate<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::text('current_rate', old('current_rate'), ['class' => 'form-control', 'placeholder' => 'Enter Current Rate', 'id' => 'current_rate']) }}
                                            @error('current_rate')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Exchange Rate<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                                    {{ Form::text('exchange_rate', old('exchange_rate'), ['class' => 'form-control', 'placeholder' => 'Enter Exchange Rate', 'id' => 'exchange_rate']) }}
                                            @error('exchange_rate')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                  
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                    <div class="custom-control custom-checkbox mr-sm-2 m-b-15">
                                        <input type="checkbox" class="custom-control-input" name="status" id="checkbox0" value="1">
                                        <label class="custom-control-label"  for="checkbox0">Is Active </label>
                                    </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="card-body">
                                <button type="submit" id="submitButton" class="btn btn-primary">Submit </button>
                                <a href="{{ route('admin.currency') }}" class="btn btn-secondary">Back</a>
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
                    sign: {
                        required: true,
                        maxlength: 100,
                    },
                    current_rate: {
                        required: true,
                        maxlength: 100,
                    },
                    exchange_rate: {
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
