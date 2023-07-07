
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
      </div>


      <div class="my-account-section">
         <div class="container">  

           <div class="my-account-row">  
            @include('user.sidemenu')
              <div class="my-account-contain-col">    
                <div class="my-account-contain my-account-shadow"> 
                  <div class="my-account-contain-hdr">Manage Profile</div>
                    
                   <div class="my-account-form-box">
                      <div class="my-account-form-top-text"> 
                         <p>To change any of your personal details, just enter the new information into the boxes below and click save change</p>
                      </div>
                     {{ Form::open(array('id'=>'update-profiel-form','method'=>'POST')) }}


                     <?php
                     $userInfo = auth()->user();
                     ?>
                        <div class="my-account-form-row no-gutters row">
                           <div class="col-md-12">
                              <label>Name <span class="requir-box text-danger">*</span></label>
                              <div class="form-group">
                                 <input type="text" class="form-control stop_first_space" minlength="3" maxlength="50" value="<?php echo $userInfo->name;?>" name="name" placeholder="Name"> 
                              </div>
                        </div>
                        <div class="col-md-6"> 
                              <label>Email Address <span class="requir-box text-danger">*</span></label> 
                              <div class="form-group">
                                 <input type="email" class="form-control stop_first_space" readonly value="<?php echo $userInfo->email;?>" name="email" placeholder="Email Address"> 
                              </div>
                        </div>
                        <div class="col-md-6">   
                              <label>Mobile <span class="requir-box text-danger">*</span></label>  
                              <div class="form-group"> 
                                 <input type="text" class="form-control stop_first_space" minlength="10" maxlength="10" value="<?php echo $userInfo->mobile; ?>" name="mobile" placeholder="Mobile"> 
                              </div>  
                        </div>
                        <div class="col-md-6">  
                              <label>Date of Birth</label> 
                              <div class="form-group">
                                 <input type="text" readonly class="form-control" id="dob" value="<?php echo ($userInfo->dob != '' && $userInfo->dob != '0000-00-00') ? date('d/m/Y',strtotime($userInfo->dob)) : '' ;?>" name="dob" placeholder="DD/MM/YY"> 
                              </div>
                        </div>
                        <div class="col-md-6">  
                              <label>Address<span class="requir-box text-danger">*</span></label> 
                              <div class="form-group">
                                 <input type="text" class="form-control stop_first_space" minlength="3" maxlength="150" value="<?php echo $userInfo->address; ?>" name="address" placeholder="Address"> 
                              </div>
                        </div>
                        <div class="col-md-6">  
                              <label>City<span class="requir-box text-danger">*</span></label>  
                              <div class="form-group">
                                 <input type="text" class="form-control stop_first_space" value="<?php echo $userInfo->city; ?>" name="city" minlength="3" maxlength="50" placeholder="City"> 
                              </div>
                        </div>
                        <div class="col-md-6">  
                              <label>Postcode<span class="requir-box text-danger">*</span></label>  
                              <div class="form-group">
                                 <input type="text"  class="form-control stop_first_space" minlength="5" value="<?php echo $userInfo->postcode; ?>" maxlength="15" name="postcode" placeholder="Postcode"> 
                              </div>
                        </div>
                        <div class="col-md-12">  
                              
                           <div class="checkbox-area form-group">
                                    <input type="checkbox" id="checkbox1" value="<?php echo ($userInfo->subscribe_news_letter ==1) ? 1: 0; ?>" <?php echo ($userInfo->subscribe_news_letter ==1) ? 'checked': ''; ?> name="subscribe_news_letter">
                                    <label for="checkbox1"> Subscribe to newsletter</label>
                                 </div>
                           </div>
                           <div class="col-md-12">
                           <div class="btn-outer"> 
                           <button type="submit" id="btnSubmit2" class="custom-btn blue-btn my-account-btn">Save Change</button>
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
      </div>
      <!-- inner-middle-section -->  
<script>

$( "#dob" ).datepicker({
   changeMonth: true,
   changeYear: true,
   minDate: new Date(1900,1-1,1), maxDate: '-18Y',
});


$("#checkbox1").change(function() {
   var ischecked= $(this).is(':checked');
   if(!ischecked)
   {
      $("#checkbox1").val(0);
   }else{
      $("#checkbox1").val(1);
   }
}); 

$("#update-profiel-form").validate({
  
   rules: {
      name: {
         required: true,
         minlength: 3,
         maxlength: 50
      },
      mobile: {
         required: true,
         minlength:10,
         maxlength:10,
         number: true,
         /*remote: {
            url: "{{ url('/checkemailormobile') }}",
            type: "POST",
            headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
               mobile: function () {
                  if($("input[name='mobile']").val() != '')
                  {
                     return $("input[name='mobile']").val();
                  }
               },
               field: 'mobile'
            },
            dataFilter: function (data) {
               if (data) {
                  return "\"" + "Mobile number already registered." + "\"";
               }
            }
         }
         */
      },
      email: {
         required: true,
         email: true
      },
      address: {
         required: true,
         minlength:3,
         maxlength:150
      },
      postcode: {
         required: true,
         minlength: 5,
         maxlength: 15
      },
      city: {
         required: true,
         minlength: 3,
         maxlength: 50
      }
   },
   messages: {
      name: {
         required : "Please enter name.",
         minlength : "Name should be minimum 3 characters.",
         maxlength : "Name should not be maximum 50 characters."
      },  
      mobile: {
         required: "Please enter mobile number.",
         minlength : "Mobile number should be 10 digits.",
         maxlength : "Mobile number should be 10 digits.",
         number : "Mobile number should be only numbers.",
         //remote : "Mobile number already registered."
      },      
      email: {
         required: "Please enter email address.",
         email: "Please enter valid email address."
      },
      address: {
         required: "Please enter address.",
         minlength : "Address should be minimum 3 characters.",
         maxlength : "Address should not be maximum 150 characters."
      },
      postcode: {
         required : "Please enter postcode.",
         minlength : "Postcode should be minimum 5 characters.",
         maxlength : "Postcode should not be maximum 15 characters."
      },
      city: {
         required : "Please enter city name.",
         minlength : "City name should be minimum 3 characters.",
         maxlength : "City name should not be maximum 50 characters."
      }
   }, 
   submitHandler: function() {
      
         $("#btnSubmit2").attr("disabled", true);
         if(!$(this).valid()) 
         {
            e.preventDefault();
            $("#btnSubmit2").attr("disabled", false);
            return false;
         }else{
            $('#update-profiel-form')[0].submit();
            return true;
         }
      }
   });

</script>
  @endsection