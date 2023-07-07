<!-- header -->
    <header class="header">
      <!-- top-bar -->
      <div class="top-bar">
        <div class="d-flex flex-wrap container">
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
          <div class="d-flex top-right">
            <ul class="top-info">
              <li> <a href="#"><i class="fas fa-map-marker-alt"></i><span>1835 73rd Ave NE, Medina, Washington, USA.</span></a>
              </li>
            </ul> 
                  

@if(\Auth::check() && auth()->user()->name)
                  <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" style="background-color:#093d66;" aria-expanded="false">
    {{auth()->user()->name}}
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="{{url('/profile')}}">Profile</a>
    <a class="dropdown-item" href="{{url('/logout')}}">Logout</a>
  </div>
</div>
@else


<a href="#" class="link login" data-toggle="modal" data-backdrop="static" data-keyboard="false" data-target="#login-model">Login</a>
                  <a href="#" class="link registration" data-toggle="modal" data-backdrop="static" data-keyboard="false"  data-target="#reg-model">Register</a>  

@endif



          </div>
        </div>
      </div>
      <!-- top-bar -->
      <!-- logo section -->
      <div class="logo-row">
        <div class="d-flex flex-wrap container">
          <a href="{{url('/')}}" class="logo">
            <img src="{{ URL::to('/') }}/images/logo.png" alt="logo"> 
          </a>
          <div class="nav-section">

            @if(Session::has('logout-success'))
              <div class="flash-message hidesuccessmsg" style="margin-right:115px;">
                  <p class="alert alert-success">{{ Session::get('logout-success') }}  

                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>

                  </p>
              </div>
            @endif
            
            <div class="contact-info"> <span class="icon">
                  <img src="{{ URL::to('/') }}/images/mobile.png" alt="mobile"> 
               </span>
              <div class="contact-dtl"> <span><a href="mailto:020 8554 8866"> <span>Call Us:</span> 020 8554 8866 </a></span>
                <small>Open 7 days a week 9am – 8pm</small>
              </div>
            </div>
             <!-- nav -->
            <div class="top-nav">    
            <div id="myNav" class="overlay">
                   <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                     <ul class="nav">
                      <li><a href="{{ url('about_'); }}">About</a></li>
                      <li><a href="{{ url('services_'); }}">Services</a></li>
                      <li><a href="{{ url('client_'); }}">Clients</a></li>
                      <li><a href="{{ url('contact_'); }}">Contact</a></li>
                    </ul>
             </div>
             <a href="#" class="nav-icon"> 
             <span  onclick="openNav()"> <img src="{{ URL::to('/') }}/images/bar.png" alt="bar"></span>
            </a>
            </div>
            <!-- nav -->
          </div>
        </div>
      </div>
      <!-- logo section -->
    </header>
<!-- header -->
