@extends('layouts.app')
@section('content')

{{--@php
echo "<pre>";
print_r($bookingResponse);die;
@endphp--}}
@php
$bookingResponse = $hotel_previous_page_data;
@endphp
<style>
   i.fas.fa-star {
      color: orange;
   }

   i.fas.fa-star-half-alt {
      color: orange;
   }

   .flight-search-form li {
      max-width: 16% !important;
   }
</style>
<!-- inner-middle-section -->
<div class="inner-middle-section">
   <div class="container">
      <div class="flight-detail-main">
         <div class="flight-book-section">
            <div class="flight-contain-section hotel-contain-section">
               <div class="flight-book-heading">
                  <h4 class="heading-text"><img src="{{URL::to('/')}}/images/list-icon.png" alt="list-icon">Review Your Booking
                  </h4>
               </div>
               <div class="light-shadow-box hotel-inner-section padd-30">
                  <figure class="hotel-img mb-0">
                     <img src="{{URL::to('/')}}/images/hotel-img.jpg" alt="hotel-img">
                     <span class="save-text">Save Rs.1,461 </span>
                     <div class="hotel-img-text"> <a href="{{route('hotel-detail', $bookingResponse->code)}}">{{ !empty($bookingResponse && $bookingResponse->name)?$bookingResponse->name:'' }}
                        </a></div>
                  </figure>
                  <div class="hotel-contain">
                     <div class="hotel-contain-hdr">
                        <a href="{{route('hotel-detail', $bookingResponse->code)}}">{{ !empty($bookingResponse && $bookingResponse->name)?$bookingResponse->name:'' }}
                        </a>
                     </div>
                     <p>
                        {{ !empty($bookingResponse && $bookingResponse)?$bookingResponse->zoneName.', '.$bookingResponse->destinationName.', '.$bookingResponse->destinationCode:'' }}
                     </p>
                     <ul class="star-rating">
                        <?php $rating = !empty($bookingResponse) ? mb_substr($bookingResponse->categoryName, 0, 1) : 0;
                        $rating = ceil($rating);
                        $blankStar = 5 - $rating;
                        for ($i = 0; $i < $rating; $i++) { ?>
                           <li><i class="fas fa-star"></i></li>
                        <?php }
                        ?>
                        <?php if ($blankStar > 0) {
                           for ($j = 0; $j < $blankStar; $j++) {
                        ?>
                              <li><i class="far fa-star"></i></li>
                        <?php }
                        } ?>

                     </ul>
                     @php
                     @endphp
                     {{--$convert_checkIn_date = strtotime(session('checkin'));
                     $convert_checkOut_date = strtotime(session('checkout'));--}} 
                     @php
                     $convert_checkIn_date = strtotime($hotelsdata->check_in_date);
                     $convert_checkOut_date = strtotime($hotelsdata->check_out_date);

                     $month = date('F',$convert_checkIn_date);
                     $year = date('Y',$convert_checkIn_date);
                     $day = date('j',$convert_checkIn_date);

                     $checkOutMonth = date('F',$convert_checkOut_date);
                     $checkOutYear = date('Y',$convert_checkOut_date);
                     $checkOutDay = date('j',$convert_checkOut_date);
                     @endphp
                     <div class="hotel-contain-bottom">
                        <div class="hotel-contain-bottom-col">
                           <div class="hotel-chk-contain">
                              <ul class="d-flex hotel-chk-outer">
                                 <li>
                                    <div class="hotel-chk-box">
                                       <div class="title-text">Check-In</div>
                                       <div class="date-text"><span class="big-date-text">{{$day}}</span> {{$month}} <span class="sepration-bdr"></span> {{$year}}</div>
                                    </div>
                                 </li>
                                 <li>
                                    <div class="hotel-chk-box">
                                       <div class="title-text">Check-Out</div>
                                       <div class="date-text"><span class="big-date-text">{{$checkOutDay}}</span> {{$checkOutMonth}} <span class="sepration-bdr"></span> {{$checkOutYear}}</div>
                                    </div>
                                 </li>
                              </ul>
                           </div>
                        </div>
                        <div class="hotel-contain-bottom-col">
                           <ul class="hotel-book-dtl mb-0">
                              <li>{{ !empty($bookingResponse)?$bookingResponse->rooms[0]->name:'' }}</li>
                              <li>Room {{!empty($bookingResponse)?$bookingResponse->rooms[0]->rates[0]->rooms:''}} : {{!empty($bookingResponse)?$bookingResponse->rooms[0]->rates[0]->adults:''}} Adults</li>
                              <li><a href="{{URL::previous()}}" class="custom-btn">Change Room</a>
                              </li>
                           </ul>
                        </div>
                        <div class="hotel-contain-bottom-col">
                           <ul class="hotel-facility-dtl mb-0">
                              <li class="hotel-facility-hdr">Inclusion : </li>
                              <li> Breakfast</li>
                              <li>Wi-Fi Internet</li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="booking-confirmation-hdr">Contact Detail</div>
            <div class="flight-contain-section">
               <div class="row">
                  <div class="col-sm-6">
                     <div class="book-confirm-box">
                        <label>Your name</label>
                        <p> <b>{{ Auth::user()->name }}</b></p>
                     </div>
                  </div>

                  <div class="col-sm-6">
                     <div class="book-confirm-box">
                        <label>Contact No.</label>
                        <p> <b>{{ !empty(Auth::user()->mobile)?Auth::user()->mobile:'' }}</b></p>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="book-confirm-box">
                        <label>Email Address</label>
                        <p><b>{{!empty(Auth::user()->email)?Auth::user()->email:'' }}</b></p>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-6">
                     <div class="book-confirm-box">
                        <p>Adult</p>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="book-confirm-box">
                        <p><b>{{!empty($bookingResponse)?$bookingResponse->rooms[0]->rates[0]->adults:''}}</b></p>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-6">
                     <div class="book-confirm-box">
                        <p>Child</p>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="book-confirm-box">
                        <p><b>{{!empty($bookingResponse)?$bookingResponse->rooms[0]->rates[0]->children:''}}</b></p>
                     </div>
                  </div>
               </div>
            </div>
            <div class="flight-contain-section">
               <div class="flight-book-heading">
                  <h4 class="heading-text"><img src="{{URL::to('/')}}/images/user-icon.png" alt="list-icon">Enter Traveller
                     Details</h4>
               </div>
               <div class="form-section ">
                  <form action="{{url('stripe',$bookingResponse->code)}}" method="post">
                     @csrf
                  <div class="light-shadow-box padd-30">
                     <div class="form-contain-box contant-dtl-box flight-dtl-contact">
                        <h5>Contact Details</h5>
                        <div class="row">
                           <div class="col-sm-6">
                              <div class="form-group custom-icon envelop-icon">
                                 <input type="text" class="form-control " name="usermail" value="{{$loginUserData[0]['email']}}" placeholder="Enter-EMail">
                              </div>
                           </div>
                           <div class="col-sm-6">
                              <div class="form-group custom-icon phone-icon">
                                 <input type="text" class="form-control " name="" value="{{$loginUserData[0]['mobile']}}" placeholder="Enter-Phone no.">
                              </div>
                           </div>
                        </div>
                        <div class="text-contain">Your booking details will be sent to this email address
                           and mobile number.</div>
                        <div class="checkbox-area">
                           <input type="checkbox" id="checkbox1" name="">
                           {{--<label>Also send my booking details on WhatsApp
                              <img src="{{URL::to('/')}}/images/whatapp.png" alt="whatapp">
                           </label>--}}
                        </div>
                     </div>
                     <div class="form-contain-box traveller-information-box">
                        <h5>Traveller Information</h5>
                        <p> <strong>Important Note:</strong> Please ensure that the names of the passengers
                           on the travel documents is the same as on their government issued identity
                           proof.</p>
                     </div>
                     <div class="form-contain-box">
                        <div class="adult-add-field">
                        <h6 >Adults</h6>
                        @for($i=1;  $i <= $bookingResponse->rooms[0]->rates[0]->adults; $i++)
                        <ul class="d-flex adult-row no1">
                           <li>
                              <div class="form-group">
                                 <label for="" class="form-control">{{$i}}</label>
                              {{--<select id="choice" class="custom-select form-control">
                                    <option value="0" selected="selected">Title</option>
                                    <option value="01">02</option>
                                    <option value="01">03</option>
                                    <option value="01">04</option>
                                 </select>--}}
                              </div>
                           </li>
                           <li>
                              <div class="form-group">
                                 <input type="text" class="form-control " name="fn[]" placeholder="First Name">
                              </div>
                           </li>
                           <li>
                              <div class="form-group">
                                 <input type="text" class="form-control" name="ln[]" placeholder="Last Name">
                              </div>
                           </li>
                        </ul>
                        @endfor
                        </div>
                     </div>
                     <div class="form-contain-box">
                        <div class="optional optional-heading">
                           <div class="icon">
                              <img src="{{URL::to('/')}}/images/gst.jpg" alt="gst">
                           </div>
                           <div class="details-box">
                              <h6>Add your GST Details <span>(Optional)</span></h6>
                              <p>Claim credit of GST charges. Your taxes may get updated post submitting
                                 your GST details.</p>
                           </div>
                           <div class="btn-box"> <a href="#" class="custom-btn">Add</a>
                           </div>
                        </div>
                        <div class="optional-detail-box">
                           <div class="optional">
                              <div class="icon">
                                 <img src="{{URL::to('/')}}/images/workers.png" alt="workers">
                              </div>
                              <div class="details-box">
                                 <h6>Travelling for work?</h6>
                                 <div class="checkbox-area">
                                    <input type="checkbox" id="checkbox1" name="">
                                    <label>Join Yatra for Business</label>
                                 </div>
                                 <a href="#" class="view-link blue-link">View Benefits</a>
                              </div>
                           </div>
                           <div class="sign-in-box"> <a href="#" class="view-link blue-link"> Sign in</a>
                              to book faster and use eCash</div>
                        </div>
                     </div>
                  </div>
                  <div class="btn-box d-block w-100 text-center">
                     <button class="custom-btn blue-btn" href="#!">Proceed To payment</button>
                     <!-- <a class="custom-btn blue-btn" href="{{url('stripe',$bookingResponse->code)}}">Proceed To payment</a> -->
                     <!-- <a class="custom-btn blue-btn" href="{{route('view-booking-confirm')}}">Proceed To payment</a> -->
                  </div>
                  </form>
               </div>
            </div>
         </div>
         <!-- flight-list-box -->
         <!-- advertise-box -->
         <div class="flight-payment-section">
            <ul class="flight-payment-contain mb-0">
               <li class="flight-payment-contain-items">
                  <div class="d-flex flex-wrap flight-payment-heading">
                     <div class="header-text">Fare Details</div>
                     <a href="#" class="view-link">View Fare Rules</a>
                  </div>
                  <div class="light-shadow-box payment-box padd-30">
                     <ul class="price-row mb-0">
                        {{--@php
                        echo "<pre>";
                           print_r($bookingResponse);die;
                        @endphp--}}
                        <li> <span>Hotel Amount</span>
                           <span>&euro; {{ !empty($bookingResponse)?$bookingResponse->rooms[0]->rates[0]->net:'' }}</span>
                        </li>
                        <li class="total-price"> <span>Total Fare</span>
                           <span>&euro; {{ !empty($bookingResponse)?$bookingResponse->rooms[0]->rates[0]->net:'' }}</span>
                        </li>
                        {{--<li> <span>Add Ons</span>
                           <span>&euro; 20 </span>
                        </li>--}}
                        <li class="pay-price">
                           <span>You Pay :</span>
                           <span>&euro; {{ !empty($bookingResponse)?$bookingResponse->rooms[0]->rates[0]->net:'' }}</span>
                        </li>
                        {{--<li> <span>Earn eCash</span>
                           <span>&euro; 250 </span>
                        </li>--}}
                     </ul>
                  </div>
               </li>
               <li class="flight-payment-contain-items">
                  <div class="flight-payment-heading">Promo Code</div>
                  <div class="light-shadow-box padd-30">
                     <ul class="promo-code-dtl">
                        <li>
                           <div class="form-box form-contain-box">
                              <span>Select a Promo Code</span>
                              <div class="form-group">
                                 <input type="text" class="form-control" name="" placeholder="Promo Code Enter">
                                 <button class="custom-btn">Apply</button>
                              </div>
                           </div>
                        </li>
                        <li>
                           <div class="radio-custom">
                              <input id="radio1" type="radio" name="radio" value="1" checked="checked">
                              <label for="radio1">
                                 <span>TRAVELMONSOON</span>
                                 <p>Flat 30% OFF (up to Rs. 1500).Valid with all cards and wallets.</p>
                              </label>
                           </div>
                           <div class="btn-box text-right"> <a href="#" class="view-link blue-link tc-links">Terms & Conditions</a>
                           </div>
                        </li>
                        <li>
                           <div class="radio-custom">
                              <input id="radio2" type="radio" name="radio" value="2" checked="checked">
                              <label for="radio2">
                                 <span>HOTEL10</span>
                                 <p>Flat 10% OFF (up to Rs. 700).Valid with all cards and wallets.</p>
                              </label>
                           </div>
                           <div class="btn-box text-right"> <a href="#" class="view-link blue-link tc-links">Terms & Conditions</a>
                           </div>
                        </li>
                        <li>
                           <div class="btn-box text-right"> <a href="#" class="view-link blue-link">View
                                 All</a>
                           </div>
                        </li>
                     </ul>
                  </div>
               </li>
            </ul>
         </div>
      </div>
   </div>
</div>
<!-- inner-middle-section -->
<!-- footer -->

<!-- JavaScript -->
<script>
   function openNav() {
      document.getElementById("myNav").style.width = "100%";
   }

   function closeNav() {
      document.getElementById("myNav").style.width = "0%";
   }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
@endsection