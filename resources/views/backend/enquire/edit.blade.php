@extends('backend.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Edit Testimonial</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.testimonials')}}">Testimonials</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Testimonial</li>
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
                    <div class="col-md-12">   
                        <div class="card card-primary">
                          
                            <!-- form start -->
                            {{ Form::model($testimonials, ['route' => ['admin.testimonials.update', $testimonials->id], 'method' => 'post', 'id' => 'form']) }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailname">User Name<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::text('name', old('name'), ['class' => 'form-control','pattern'=> "^[a-zA-Z_ ]*$", 'placeholder' => 'Enter Name', 'id' => 'emailname']) }}
                                            @error('name')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $testimonials->id }}">
                               
                                    <!-- /.card-body -->
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="email_content">Description</label><span
                                                    style="color: red;font-size:18px;"><b>*</b></span><br />
                                                {{ Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Enter Description', 'id' => 'email_content']) }}
                                                @error('description')
                                                    <p style="color:red;">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="custom-control custom-checkbox mr-sm-2 m-b-15">
                                        <input type="checkbox" class="custom-control-input" name="status" id="checkbox0"  value="1" @if($testimonials->status ==1) checked @else @endif>
                                        <label class="custom-control-label"  for="checkbox0">Is Active </label>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="card-body">
                                <button type="submit" id="submitButton" class="btn btn-primary">Submit </button>
                                <a href="{{ route('admin.email') }}" class="btn btn-secondary">Back</a>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <!-- /.validation  -->
    <script>
        $(document).ready(function() {
            $('#form').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 100,

                    },
                  
                    description: {
                        required: true,


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
