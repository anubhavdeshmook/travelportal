@extends('backend.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">User Create</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.user')}}">Users List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">User Create</li>
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
                        <!-- general form elements -->
                        <div class="card card-primary">
                            
                            {{ Form::open(['route' => ['admin.user.save'], 'method' => 'post', 'id' => 'form']) }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="username">Name<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::text('name', old('name'), ['class' => 'form-control','pattern'=> "^[a-zA-Z_ ]*$", 'placeholder' => 'Enter Name', 'id' => 'name']) }}
                                            @error('name')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="useremail">Email<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Enter Email', 'id' => 'useremail']) }}
                                            @error('email')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="userphone">Mobile Number<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Enter Phone Number', 'id' => 'userphone']) }}
                                            @error('phone')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                      <div class="form-group">
                                          <label for="userpass">Password<span
                                                  style="color: red;font-size:18px;"><b>*</b></span></label>
                                          {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter Password', 'id' => 'userpass']) !!}
                                          @error('password')
                                              <p style="color:red;">{{ $message }}</p>
                                          @enderror
                                      </div>
                                  </div>
                                  <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="userconformpass">Confirm Password<span
                                                style="color: red;font-size:18px;"><b>*</b></span></label>
                                        {{ Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'Enter Confirm Password', 'id' => 'userconformpass']) }}
                                        @error('password_confirmation')
                                            <p style="color:red;">{{ $message }}</p>
                                        @enderror
                                    </div>
                                  </div>
                                </div>
                     
                                    <div class="col-sm-12">
                                        <div class="custom-control custom-checkbox mr-sm-2 m-b-15">
                                            <input type="checkbox" class="custom-control-input" name="status" id="checkbox0" value="1">
                                            <label class="custom-control-label"  for="checkbox0">Is Active </label>
                                        </div>
                                    </div>
                             
                             
                             
                                </div>
                                
                                
                                    <div class="card-body">
                                   
                                        
                                        <button type="submit" id="submitButton" class="btn btn-primary">Submit </button>
                                        <a href="{{ route('admin.user') }}" class="btn btn-secondary">Back</a>
                                    </div>
                        
                    </div>
                </div>
            </div>
        </div>
                            {{ Form::close() }}
                    
                </div>
            </div>
        </section>
    </div>
</div>
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
                email: {
                    required: true,
                    maxlength: 100,

                },
                phone: {
                    required: true,
                    minlength:6,
                    maxlength:12,
                    number: true




                },
                password: {
                    required: true,
                    maxlength: 100,

                },
                password_confirmation: {
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
