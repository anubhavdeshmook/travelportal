
  <!-- footer -->
  <footer class="footer">
    <div class="footer-main"> 
      <div class="container">
        <div class="row">
          <div class="col-lg-3 col-sm-6 ">
            <h5 class="ftr-heading">Quick links</h5>
            <ul class="ftr-links">
              <li><a href="#">About Us</a>
              </li>
              <li><a href="#">Travel Blog</a>
              </li>
              <li><a href="#">Hotels</a>
              </li>
              <li><a href="#">Destinations</a>
              </li>
              <li><a href="#">Contact us</a>
              </li>
              <li><a href="#">Sitemap</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-3 col-sm-6 ">
            <h5 class="ftr-heading">Top Destinations</h5>
            <ul class="ftr-links">
              <li><a href="#">Mykonos</a>
              </li>
              <li><a href="#">Santorini</a>
              </li>
              <li><a href="#">Rhodes</a>
              </li>
              <li><a href="#">Singapure</a>
              </li>
              <li><a href="#">London</a>
              </li>
              <li><a href="#">Australia</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-3 col-sm-6 ">
            <h5 class="ftr-heading">Contact Us</h5> 
            <ul class="contact-links">
              <li class="address-dtl"> <span> <i class="fas fa-map-marker-alt"></i> <span class="text">Address :</span></span>
                <p>Lorem ipsum dolor adipiscing elit. Donec</p>
              </li> 
              <li>
                <a href="mailto:info@travelvacation.co.uk">
                  <img src="{{URL::asset('/images/mail.png')}}" alt="mail">Email: info@travelvacation.co.uk</a>
              </li>
              <li>
                <a href="tel:020 8554 8866"> 
                  <img src="{{URL::asset('/images/phone.png')}}" alt="phone">Phone: 020 8554 8866</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-3 col-sm-6 ">
            <h5 class="ftr-heading">Find Us</h5> 
            <ul class="d-flex social-links">
              <li><a href="#"><i class="fab fa-facebook-f"></i></a>
              </li>
              <li><a href="#"><i class="fab fa-pinterest-p"></i></a>
              </li>
              <li><a href="#"><i class="fab fa-instagram"></i></a>
              </li>
              <li><a href="#"><i class="fab fa-twitter"></i></a>
              </li>
              <li><a href="#"><i class="fab fa-google-plus-g"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container text-center">
        <p>© Travel Vacattion <?php echo date('Y');?></p>
      </div>
    </div> 
  </footer>


  
<!-- email verification popup -->
<div class="modal fade registration-modal" id="email-verification-model" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content registration-modal-content">
         <!-- Modal body -->
         <div class="modal-body">
            <div class="registration-form-section login-form">
               <button type="button" class="close" data-dismiss="modal">
               <span>×</span>  
               </button>
               
               <div class="registration-hdr-box">
                  <div class="registration-hdr">Email Verification Link</div>
                  <p>Enter your email address to receive email verification link</p>
               </div>

                {{ Form::open(array('id'=>'email-verification-form')) }}

                  <div class="registration-form">
                      <div class="form-group">
                        <input type="email" class="form-control"  name="verification_email" id="verification_email" placeholder="Enter Your Email">
                      </div>
                      <div class="form-group  btn-outer">
                        <button type="submit" class="custom-btn" id="btnVerificationSubmit">SEND LINK</button>   
                      </div>
                  </div>

                {{ Form::close() }}

            </div>
         </div>
      </div>
   </div>
</div>
<!-- email verification popup -->

  


<!-- email popup -->
<div class="modal fade registration-modal" id="reset-pwd-model" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content registration-modal-content">
         <!-- Modal body -->
         <div class="modal-body">
            <div class="registration-form-section login-form">
               <button type="button" class="close" data-dismiss="modal">
               <span>×</span>  
               </button>
               
               <div class="registration-hdr-box">
                  <div class="registration-hdr">Reset Password</div>
                  <p>Enter your email address to reset the password</p>
               </div>

                {{ Form::open(array('id'=>'reset-pwd-form')) }}

                  <div class="registration-form">
                      <div class="form-group">
                        <input type="email" class="form-control"  name="forgot_email" id="forgot_email" placeholder="Enter Your Email">
                      </div>
                      <div class="form-group  btn-outer">
                        <button type="submit" class="custom-btn" id="btnResetSubmit">Reset Password</button>   
                      </div>
                  </div>

                {{ Form::close() }}

            </div>
         </div>
      </div>
   </div>
</div>
<!-- reset popup -->

  

<!-- login popup -->
<div class="modal fade registration-modal" id="login-model">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content registration-modal-content">
         <!-- Modal body -->
         <div class="modal-body">
            <div class="registration-form-section login-form">
               <button type="button" class="close" data-dismiss="modal">
               <span>×</span>  
               </button>
               <span class="user-icon"><img src="{{URL::asset('/images/user-login.png')}}" alt="user-icon"/></span>
               <div class="registration-hdr-box">
                  <div class="registration-hdr">User Login</div>
                  <p>Login to access your account</p>
               </div>

                {{ Form::open(array('id'=>'log-form')) }}

                  <div class="registration-form">
                      <div class="form-group">
                        <input type="email" class="form-control"  name="email" placeholder="Enter Your Email">
                      </div>
                      <div class="form-group password-row">
                        <input type="password" class="form-control"  name="password" placeholder="Enter Your Password">

                        <div style="padding-bottom:5px !important;">
                        <span class="forget-pass-text text-left" style="display:none;float:left !important;"><a href="javascript:void(0);" class="show-verification">Send Verification Link?</a></span>
                        <span class="forget-pass-text text-right" style="float:right !important;"><a href="javascript:void(0);" class="show-forgot">Forgot Password?</a></span>
                        </div>
                      </div>
                      <div class="form-group  btn-outer">
                        <button type="submit" class="custom-btn" id="btnLoginSubmit">login</button>   
                        <div class="registration-text text-center">Don’t have an account? 
                            <a href="javascript:void(0);" class="show-reg">Register Now</a>
                          </div>
                      </div>
                  </div>

                {{ Form::close() }}

            </div>
         </div>
      </div>
   </div>
</div>
<!-- login popup -->



<!-- register popup -->
<div class="modal fade registration-modal" id="reg-model">
   <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content registration-modal-content">
         <!-- Modal body -->
         <div class="modal-body">
            <div class="registration-form-section">
               <button type="button" class="close" data-dismiss="modal">
               <span>×</span>  
               </button>
               <span class="user-icon"><img src="{{URL::asset('/images/user-login.png')}}" alt="user-icon"/></span>
                <div class="registration-hdr-box">
                    <div class="registration-hdr">Create Your Account</div>
                    <p>Lorem ipsum is a placeholder text commonly used to demonstrate document.</p>
                </div>

                {{ Form::open(array('id'=>'reg-form','type'=>'POST')) }}

                  <div class="registration-form">
                      <div class="form-group">
                        <input type="text" class="form-control stop_first_space" minlength="3" maxlength="50" name="name" placeholder="Name">
                      </div>
                      <div class="form-group">
                        <input type="text" class="form-control stop_first_space numericOnly reg_mob" minlength="10" maxlength="10" name="mobile" placeholder="Mobile">
                      </div>

                      <div class="form-group">
                        <input type="email" class="form-control stop_first_space reg_email" maxlength="150" name="email" placeholder="Enter Your Mail Address">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control stop_first_space" minlength="6" maxlength="50" autocomplete="off"  name="password" placeholder="Password">
                      </div>

                      <div class="form-group">
                        <input type="radio" name="gender" value="1" id="male" /> <label for="male">Male</label>
                        <input type="radio" name="gender" value="0" id="female" /> <label for="female">Female</label>

                        <br>
                        <label for="gender" class="error" style="display:none;">* Please pick an option above</label>

                      </div>


                      <div class="form-group  btn-outer">  
                        <button type="submit" class="custom-btn" id="btnSubmit">Create My Account</button>
                      </div>
                  </div>
                  {{ Form::close() }}

            </div>
         </div>
      </div>
   </div>
</div>
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<!-- register popup -->
<script>
  
let timeoutID = null;

function findPlace(searchTerm) {
  console.log('search: ' + searchTerm)

  $(".destinationDrpDwn").autocomplete({
    source: function (request, response) {
        $.ajax({
          type: "POST",
          url: "{{ url('/getpopulardestinations') }}",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data : {'search_term' : searchTerm},
          success: function (data) {

/*
            if (data.indexOf(item) === -1) {
                            return { label: "No Results." }
                        } else {
                            return {
                                label: item.Company + " (" + item.Symbol + ")",
                                value: item.Company
                            }
                        }
*/

              
            if(!data.data.length){
                var result = [
                    {
                        label: 'No matches found', 
                        value: ""
                    }
                ];
                response(result);
            }else{
                response(data.data);
              }
          },
          error: function () {
              response([]);
          }
        });
    }
  });      
}

$('.destinationDrpDwn').keyup(function(e) {
  clearTimeout(timeoutID);
  const value = e.target.value
  timeoutID = setTimeout(
    () => findPlace(value), 100
  )
});


// load default popular booking places
$(window).on('load', function () {

  var availableTags = <?php echo json_encode(@$booking_popular_places); ?>;
  $(".destinationDrpDwn").autocomplete({
      source: availableTags, minLength:0
  }).on('focus', function() { $(this).keydown(); });

} );


$(function () {
    $("#log-form").submit(function (e) {
        if($(this).valid()) {
          e.preventDefault();
          $("#btnLoginSubmit").attr("disabled", true);

          var datastring = $("#log-form").serialize();
          $.ajax({
              type: "POST",
              url: "{{ url('/login') }}",
              data: datastring,
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              //dataType: "json",
              success: function(obj) {
                  //var obj = jQuery.parseJSON(data); 
                  //console.log("obj---",obj);
                  //return false;
                  if(obj.status)
                  {
                      toastr.success(obj.message, obj.title,{timeOut: 5000});
                      
                          setTimeout(function()
                          {
                            location.href="{{ url('/profile') }}"
                          } , 2000);   


                  }else{
                      toastr.error(obj.message, obj.title,{timeOut: 5000});
                  }
              },
              error: function(xhr, status, error) {
                var res = jQuery.parseJSON(xhr.responseText); 
                toastr.error(res.message, "Failed",{timeOut: 5000});
              },
              complete: function(){
                setTimeout(function() {
                    $("#btnLoginSubmit").attr("disabled", false);     
                }, 3000);   

              }
          });
        }
    });
});


$("#reg-form").submit(function(e) 
{
  if($(this).valid()) {
    e.preventDefault();
    
    $("#btnSubmit").attr("disabled", true);

    var datastring = $("#reg-form").serialize();
    $.ajax({
        type: "POST",
        url: "{{ url('/register') }}",
        data: datastring,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        //dataType: "json",
        success: function(data) {
            var obj = jQuery.parseJSON(data); 
            console.log("Res--",obj);
            if(obj.status)
            {
                toastr.success(obj.message, obj.title,{timeOut: 5000});
                
              setTimeout(function() 
                  {
                    $('#reg-form')[0].reset();
                    $('#reg-model').modal('hide');
                  }, 2000
              );

            }else{
                toastr.error(obj.message, obj.title,{timeOut: 5000});
            }
        },
        error: function(xhr, status, error) {
          var res = jQuery.parseJSON(xhr.responseText); 
          toastr.error(res.message, "Failed",{timeOut: 5000});
        },
        complete: function(){

          setTimeout(function() {
              $("#btnSubmit").attr("disabled", false);     
          }, 2000);   

        }
    });
  }
});


$("#reset-pwd-form").submit(function (e) {
        if($(this).valid()) {

          $("#btnResetSubmit").css({ 'opacity' : '0.5' });


          e.preventDefault();
          $("#btnResetSubmit").attr("disabled", true);

          var datastring = $("#reset-pwd-form").serialize();
          $.ajax({
              type: "POST",
              url: "{{ url('/resetpassword') }}",
              data: datastring,
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              //dataType: "json",
              success: function(obj) {
                console.log("res----",obj);
                  if(obj.status == false)
                  {
                    toastr.error(obj.message, "Failed",{timeOut: 5000});

                  }else{
                    $('#reset-pwd-form')[0].reset();
                    

                    setTimeout(function() {
                      //$("#reset-pwd-model").removeClass("in");
                      //$(".modal-backdrop").remove();

                      //$('.modal-backdrop').remove()

                      //$("#reset-pwd-model").hide();    
                    }, 2000); 

                    toastr.success(obj.message, "Success",{timeOut: 5000});
                  }
              },
              error: function(xhr, status, error) {
                var res = jQuery.parseJSON(xhr.responseText); 
                toastr.error(res.message, "Failed",{timeOut: 5000});
              },
              complete: function(){
                setTimeout(function() {
                    $("#btnResetSubmit").attr("disabled", false);     
                    $("#btnResetSubmit").css({ 'opacity' : '' });
                }, 3000);   

                
              }
          });
        }
});



$("#email-verification-form").submit(function (e) {
        if($(this).valid()) {

          $("#btnVerificationSubmit").css({ 'opacity' : '0.5' });

          e.preventDefault();
          $("#btnVerificationSubmit").attr("disabled", true);

          var datastring = $("#email-verification-form").serialize();
          $.ajax({
              type: "POST",
              url: "{{ url('/send-verification-email') }}",
              data: datastring,
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              //dataType: "json",
              success: function(obj) {
                console.log("res----",obj);
                  if(obj.status == false)
                  {
                    toastr.error(obj.message, "Failed",{timeOut: 5000});

                  }else{
                    $('#email-verification-form')[0].reset();
                    

                    toastr.success(obj.message, "Success",{timeOut: 5000});
                  }
              },
              error: function(xhr, status, error) {
                var res = jQuery.parseJSON(xhr.responseText); 
                toastr.error(res.message, "Failed",{timeOut: 5000});
              },
              complete: function(){
                setTimeout(function() {
                    $("#btnVerificationSubmit").attr("disabled", false);     
                    $("#btnVerificationSubmit").css({ 'opacity' : '' });
                }, 3000);   

                
              }
          });
        }
});



$('body').on('keypress',".stop_first_space", function(e){
    if (e.which === 32 && !this.value.length)
        e.preventDefault();
});
$(".numericOnly").keypress(function (e) {
    if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
});

$("#reset-pwd-form").validate({
  rules: {
    forgot_email: {
      required: true,
      email: true
    }
  },
  messages: {     
    forgot_email: {
      required: "Please enter email address.",
      email: "Please enter valid email address."
    }
  }, 
  submitHandler: function() {
      console.log('submit form');
      return false;
  }
});


$("#email-verification-form").validate({
  rules: {
    verification_email: {
      required: true,
      email: true
    }
  },
  messages: {     
    verification_email: {
      required: "Please enter email address.",
      email: "Please enter valid email address."
    }
  }, 
  submitHandler: function() {
      console.log('submit form');
      return false;
  }
});

$("#log-form").validate({
  
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

$("#reg-form").validate({
  
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
        remote: {
            url: "{{ url('/checkemailormobile') }}",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              mobile: function () {
                  if($(".reg_mob").val() != '')
                  {
                    return $(".reg_mob").val();
                  }
                },
                field: 'mobile'
            },

          dataFilter: function (data) {
              if (data == true) {
                  return "\"" + "Mobile number already registered." + "\"";
              }else {
                  var jsonStr2 = JSON.stringify(true);
                  return jsonStr2; //will not make previous error to disappear !
               } 
          }
        }
      },
      gender: {
        required: true
      },
      email: {
        required: true,
        email: true,
        remote: {
            url: "{{ url('/checkemailormobile') }}",
            type: "POST",
            async: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
              email: function () {
                  if($(".reg_email").val() != '')
                  {
                    return $(".reg_email").val();
                  }
                },
                field: 'email'
            },
            dataFilter: function (data) {
              if (data == true) {
                  return "\"" + "Email already registered." + "\"";
              }else {
                  var jsonStr = JSON.stringify(true);
                  return jsonStr; //will not make previous error to disappear !
               } 
          }
        }




        
      },
      password:{
        required: true,
        minlength: 6,
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
        remote : "Mobile number already registered."
      }, 
      gender: {
        required: "Please select gender."
      },      
      email: {
        required: "Please enter email address.",
        email: "Please enter valid email address.",
        remote : "Email already taken."
      },
      password: {
        required : "Please enter password.",
        minlength : "Password should be minimum 6 characters.",
        maxlength : "Password should not be maximum 50 characters."
      }
    }, 
    submitHandler: function() {
        console.log('submit form');
    }
});


	   
</script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
