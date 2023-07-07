@extends('backend.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">User Edit</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.user')}}">Users List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Users Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="content-wrapper">
        
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">                         
                    <div class="col-md-12">   
                        <div class="card card-primary">                       
                            <!-- form start -->
                            {{ Form::model($user, ['route' => ['admin.user.update', $user->id], 'method' => 'post', 'id' => 'form']) }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailname">Name<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::text('name', old('name'), ['class' => 'form-control','pattern'=> "^[a-zA-Z_ ]*$", 'placeholder' => 'Enter Name', 'id' => 'emailname']) }}
                                            @error('name')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="useremail">Email <span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Enter Email', 'id' => 'useremail']) }}
                                            @error('email')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="useremail">Mobile Number <span
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
                                    <div class="custom-control custom-checkbox mr-sm-2 m-b-15">
                                        <input type="checkbox" class="custom-control-input" name="status" id="checkbox0" value="1" @if($user->status ==1) checked @else @endif>
                                        <label class="custom-control-label"  for="checkbox0">Is Active </label>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="card-body">
                                <button type="submit" id="submitButton" class="btn btn-primary">Submit </button>
                                <a href="{{ route('admin.user') }}" class="btn btn-secondary">Back</a>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
   
    <!-- /.close -->
@stop
