<div class="my-account-menu-col">    
 <div class="my-account-menu my-account-shadow">  
  <div class="my-account-menu-hdr">Menu</div>       
  <ul class="my-account-list">  
     <?php
      $routeAction = explode('@',\Route::currentRouteAction());
      
      $profileUrl = url('profile');
      $bookingUrl = url('my-bookings');
      $changepwdUrl = url('change-password');

      $profileActiveClass= "";
      $mybookingActiveClass= "";
      $changepwdActiveClass= "";
      if(isset($routeAction[1]) && !empty($routeAction[1]))
      {
         if($routeAction[1] == 'profile')
         {
            $profileUrl = "javascript:void(0);";
            $profileActiveClass= "active";
         }

         if($routeAction[1] == 'myBookings')
         {
            $bookingUrl = "javascript:void(0);";
            $mybookingActiveClass= "active";
         }

         if($routeAction[1] == 'changePassword')
         {
            $changepwdUrl = "javascript:void(0);";
            $changepwdActiveClass= "active";
         }
      }

      $add_innner_header_class = '';
      if(isset($routeAction[1]))
      {
         $add_innner_header_class = 'inner-header';
      }
     ?>
     <li class="<?php echo $profileActiveClass;?>"><a href="<?php echo $profileUrl;?>">Profile</a></li>  
     <li class="<?php echo $mybookingActiveClass;?>"><a href="<?php echo $bookingUrl;?>">My Booking</a></li>
     <li class="<?php echo $changepwdActiveClass;?>"><a href="<?php echo $changepwdUrl;?>">Change Password</a></li>  
     <li><a href="{{ route('logout') }}">Logout</a></li>  
  </ul> 
 </div> 
</div>
