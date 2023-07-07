
@extends('layouts.app')

@section('content')
  
      <!-- inner-middle-section -->
      <div class="inner-middle-section">
      <div class="flash-message">
         @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))
               <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}


                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
               </button>
               </p>
            @endif
         @endforeach

         @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
      </div>
      <div class="my-account-section">
         <div class="container">  

           <div class="my-account-row">  
            @include('user.sidemenu')
            <div class="my-account-contain-col">    
                <div class="my-account-contain my-account-shadow"> 
                  <div class="my-account-contain-hdr">Change Password</div>
                    
                   <div class="my-account-form-box change-password">
                      <div class="my-account-form-top-text"> 
                         <p>To change any of your personal details, just enter the new information into the boxes below and click save change</p>
                      </div>
                      {{ Form::open(array('id'=>'change-pwd-form','method'=>'POST')) }}
                     <div class="my-account-form-row no-gutters row">
                     
                     <div class="col-md-12">
                           <label for="old_password">Old Password<span class="requir-box text-danger">*</span></label>
                           <div class="form-group"> 
                              <input type="password" class="form-control stop_first_space" minlength="6" maxlength="50" autocomplete="off"  name="current_password" id="old_password"  placeholder="Old Password">
                           </div>
                     </div>
                      <div class="col-md-6"> 
                           <label for="new_password">New Password<span class="requir-box text-danger">*</span></label> 
                           <div class="form-group">

                              <input type="password" class="form-control stop_first_space" minlength="6" maxlength="50" autocomplete="off"  name="password" id="password" placeholder="New Password">
                           </div>
                      </div>
                      <div class="col-md-6">   
                           <label for="confirm_password">Confirm Password<span class="requir-box text-danger">*</span></label> 
                           <div class="form-group"> 
                              <input type="password" class="form-control stop_first_space" minlength="6" maxlength="50" autocomplete="off"  name="password_confirmation" id="confirm_password" placeholder="Confirm Password">
                           </div>
                      </div>
                      <div class="col-md-12">
                        <div class="btn-outer"> 
                        <button type="submit" id="chanePassSubmit" class="custom-btn blue-btn my-account-btn">Save Change</button>
                        </div>
                          </div>
                      </div>

                      
                      </div> 
                      {{ Form::close() }}
                   </div>                 
                </div>
            </div>
          </div>
       </div>
      </div>
      <!-- inner-middle-section -->   
      
      

      <script>

$("#change-pwd-form").validate({
  
   rules: {
      current_password: {
         required: true,
         minlength: 6,
         maxlength: 50,
         remote: {}
      },
      password:{
         required: true,
         minlength: 6,
         maxlength: 50
      },
      password_confirmation:{
         required: true,
         minlength: 6,
         maxlength: 50,
         equalTo: "#password"
      }
   },
   messages: {
      current_password: {
         required : "Please enter old password.",
         minlength : "Old password should be minimum 6 characters.",
         maxlength : "Old password should not be maximum 50 characters.",
         remote : "Old password is incorrect."
      }, 
      password: {
         required : "Please enter new password.",
         minlength : "Password should be minimum 6 characters.",
         maxlength : "Password should not be maximum 50 characters."
      },
      password_confirmation: {
         required : "Please enter confirm password.",
         minlength : "Password should be minimum 6 characters.",
         maxlength : "Password should not be maximum 50 characters.",
         equalTo: "Please enter the same password as new password."
      }
   }
   });

$("#change-pwd-form").submit(function(e) 
{
  if($(this).valid()) {
    e.preventDefault();
    $("#chanePassSubmit").attr("disabled", true);
    $('#change-pwd-form')[0].submit();
    return true;
    


  }
});
</script>
  @endsection