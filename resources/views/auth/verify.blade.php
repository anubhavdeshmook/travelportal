@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8" style="min-height:300px;padding:10px;margin-top:30px;">

            @if(Session::has('verification-success'))
              <div class="flash-message hidesuccessmsg" style="margin-right:115px;">
                  <p class="alert alert-success">{{ Session::get('verification-success') }}  

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>

                  </p>
              </div>
            @elseif(Session::has('verification-danger'))
              <div class="flash-message hidesuccessmsg" style="margin-right:115px;">
                  <p class="alert alert-danger">{{ Session::get('verification-danger') }}  

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>

                  </p>
              </div>
            @endif
            
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <input type="hidden" name="verification_email" id="verification_email" value="<?php echo auth()->user()->email;?>" />
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
