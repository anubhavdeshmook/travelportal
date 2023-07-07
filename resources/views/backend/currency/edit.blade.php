@extends('backend.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Edit Currency</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.destination')}}">Currencies List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Currency</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
   
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @if (session('status'))

                        <div class="alert alert-success alert-dismissible fade show" role="alert"><i
                                class="far fa-check-circle"></i>
                            <strong>Congratulations !!</strong> {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif                
                    <div class="col-md-12">   
                        <div class="card card-primary">
                          
                            <!-- form start -->
                            {{ Form::model($currency,['route' => ['admin.currency.update'], 'method' => 'post', 'id' => 'form']) }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailname">Name<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::text('name', old('name'), ['class' => 'form-control','pattern'=> "^[a-zA-Z_ ]*$", 'placeholder' => 'Enter Destination Name', 'id' => 'destination_name']) }}
                                            @error('name')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $currency->id }}">
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
                                        <input type="checkbox" class="custom-control-input" name="status" id="checkbox0" @if($currency->status==1) checked @else @endif value="1">
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
        </section>
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
    <!-- /.close -->

    <!-- /.ckeditior -->
    <script>
        function checkfunction() {
            const textfield = CKEDITOR.instances['email_content'].getData();

            $('#email_content').validate()
        }

        CKEDITOR.replace("email_content");
        $("form").submit(function(e) {
            var messageLength = CKEDITOR.instances['email_content'].getData().replace(/<[^>]*>/gi, '').length;
            if (!messageLength) {

                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            }
        });
    </script>
    <!-- /.close -->
@stop
