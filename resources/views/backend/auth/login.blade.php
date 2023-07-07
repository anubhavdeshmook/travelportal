@extends('backend.layouts.auth')
@section('content')
<div class="auth-box">
    <div id="loginform">
        <div class="logo">
            <span class="db">
                <img src="{{ asset('backend/assets/images/logo-icon.png') }}" alt="logo" />
            </span>
            <h5 class="font-medium m-b-20">Sign In to Admin</h5>
        </div>
        @if(Session::has('error'))
            <div class="alert alert-danger" role="alert">
                <strong>Error - </strong> {{ Session::get('error') }}
            </div>
        @endif

        @if(Session::has('admin-logout'))
              <div class="flash-message">
                  <p class="alert alert-success">{{ Session::get('admin-logout') }}  

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>

                  </p>
              </div>
        @endif

        @if(Session::has('admin-login-error'))
              <div class="flash-message">
                  <p class="alert alert-danger">{{ Session::get('admin-login-error') }}  

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>

                  </p>
              </div>
        @endif


        <!-- Form -->
        <div class="row">
            <div class="col-12">
                {{ Form::open(array('route' => 'admin.login', 'method' => 'POST', 'class' => "form-horizontal m-t-20 admin-login-form", 'id' => "loginform")) }}
                    <input type="hidden" name="role" value="admin">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                        </div>
                        {{ Form::email('email', Request::old('email'), array('placeholder' => 'Email', 'class' => "form-control form-control-lg", 'aria-label' => "Email", 'id'=>'login_email','aria-describedby' => "basic-addon1")) }}
                        @error('email')
                            <div class="invalid-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                        </div>
                        <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" id="login_pwd" name="password">
                        @error('password')
                            <div class="invalid-error" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customCheck1">Remember me</label>
                                <a href="javascript:void(0)" id="to-recover1" class="text-dark float-right"><i class="fa fa-lock m-r-5"></i> Forgot pwd?</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="col-xs-12 p-b-20">
                            <button class="btn btn-block btn-lg btn-info" type="submit">Log In</button>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>

<script>
$(".admin-login-form2").validate({
  rules: {
    email: {
      required: true,
      email: true
    },
    password:{
      required: true
    }
  },
  messages: {     
    email: {
      required: "Please enter email address.",
      email: "Please enter valid email address."
    },
    password: {
      required : "Please enter password."
    }
  }, 
  submitHandler: function() {
      console.log('submit form');
      return false;
  }
});

</script>
@endsection