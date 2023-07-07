@extends('layouts.app')
@section('content')
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
      <div class="flight-detail-main light-shadow-box padd-30">
         <div class="booking-confirmation-top-hdr">
            <div class="booking-confirmation-top-hdr-left">
               <h2>Congratulations You're On Your Way!</h2>
               <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries,</p>
            </div>
            <div class="booking-confirmation-ref-box">
               <div class="booking-confirmation-ref-inner"> <span><img src="images/book-ref.png" alt="book-ref"></span>
                  <div class="booking-confirmation-ref-text">
                     <div class="booking-confirmation-ref-text-hdr">Booking <span>Ref</span>
                     </div>
                     <p>{{$bookingResponse->booking->reference}}</p>
                  </div>
               </div>
            </div>
         </div>
         <div class="flight-book-section booking-confirmation-section">
            <div class="booking-confirmation-hdr">Accommodation</div>
            <div class="flight-contain-section hotel-contain-section">
               <div class="hotel-inner-section">
                  <figure class="hotel-img mb-0">
                     <img src="images/hotel-img.jpg" alt="hotel-img">
                  </figure>
                  <div class="hotel-contain">
                     <div class="hotel-contain-hdr"><a href="#">{{$bookingResponse->booking->hotel->name}}</a>
                     </div>
                     <p>{{ !empty($bookingResponse->booking && $bookingResponse->booking->hotel)?$bookingResponse->booking->hotel->zoneName.', '.$bookingResponse->booking->hotel->destinationName.', '.$bookingResponse->booking->hotel->destinationCode:'' }}</p>
                     <ul class="star-rating">
                        <?php $rating = !empty($bookingResponse->booking && $bookingResponse->booking->hotel) ? mb_substr($bookingResponse->booking->hotel->categoryName, 0, 1) : 0;
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
                     $convert_checkIn_date = strtotime($bookingResponse->booking->hotel->checkIn);
                     $convert_checkOut_date = strtotime($bookingResponse->booking->hotel->checkOut);

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
                              <li>{{ !empty($bookingResponse->booking && $bookingResponse->booking->hotel)?$bookingResponse->booking->hotel->rooms[0]->name:'' }}</li>
                              <li>Room {{!empty($bookingResponse->booking && $bookingResponse->booking->hotel)?$bookingResponse->booking->hotel->rooms[0]->rates[0]->rooms:''}} : {{!empty($bookingResponse->booking && $bookingResponse->booking->hotel)?$bookingResponse->booking->hotel->rooms[0]->rates[0]->adults:''}} Adults</li>
                              <!-- <li><a href="{{URL::previous()}}" class="custom-btn">Change Room</a> -->
                              </li>
                           </ul>
                        </div>
                        <div class="hotel-contain-bottom-col">
                           <ul class="hotel-facility-dtl mb-0">
                              <li class="hotel-facility-hdr">Inclusion :</li>
                              <li>Breakfast</li>
                              <li>Wi-Fi Internet</li>
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <!-- <div class="booking-confirmation-hdr">Flight-Detail</div>
            <div class="flight-contain-section">
               <ul class="flight-book-row">
                  <li class=" flight-book-col">
                     <div class="d-flex flight-book-detail">
                        <figure> <span class="vertical-bdr"></span>
                           <img src="images/airline.jpg" alt="airline">
                           <div class="name-box">Airindia <span>AI - 9897</span>
                           </div>
                        </figure>
                        <div class="duration-box">
                           <ul class="d-flex duration-col-outer">
                              <li class="duration-col">
                                 <div class="palce-box">Goa, In <span>04:00</span>
                                 </div>
                                 <div class="time-box">Sat, 03 Aug 2020</div>
                              </li>
                              <li class="duration-col">
                                 <div class="palce-box">Delhi, In <span>04:00</span>
                                 </div>
                                 <div class="time-box">Sat, 03 Aug 2020</div>
                              </li>
                              <li class="duration-col">
                                 <ul class="d-flex time-list-text">
                                    <li>2h 15m</li>
                                    <li>No Meal Fare</li>
                                    <li>Economy</li>
                                 </ul>
                                 <div class="flight-icon-box">
                                    <img src="images/flight-gray.png" alt="flight-gray">
                                    <hr class="bdr-row">
                                 </div>
                                 <ul class="d-flex time-list-text">
                                    <li>15 kg</li>
                                    <li> <span class="blue-text">Partially Refundable</span>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </li>
                  <li class=" flight-book-col connect-airpot-col">
                     <div class="connect-airpot-text"><a href="#"> <span class="link-icon"><img src="images/link.png" alt="link" /></span>Connect in Airport <span class="hour-text">1 hr 30 min</span></a>
                     </div>
                  </li>
                  <li class=" flight-book-col">
                     <div class="d-flex flight-book-detail">
                        <figure> <span class="vertical-bdr"></span>
                           <img src="images/airline.jpg" alt="airline">
                           <div class="name-box">Airindia <span>AI - 9897</span>
                           </div>
                        </figure>
                        <div class="duration-box">
                           <ul class="d-flex duration-col-outer">
                              <li class="duration-col">
                                 <div class="palce-box">Delhi, In <span>04:00</span>
                                 </div>
                                 <div class="time-box">Sat, 03 Aug 2020</div>
                              </li>
                              <li class="duration-col">
                                 <div class="palce-box">Goa, In <span>04:00</span>
                                 </div>
                                 <div class="time-box">Sat, 03 Aug 2020</div>
                              </li>
                              <li class="duration-col">
                                 <ul class="d-flex time-list-text">
                                    <li>2h 15m</li>
                                    <li>No Meal Fare</li>
                                    <li>Economy</li>
                                 </ul>
                                 <div class="flight-icon-box">
                                    <img src="images/flight-gray.png" alt="flight-gray">
                                    <hr class="bdr-row">
                                 </div>
                                 <ul class="d-flex time-list-text">
                                    <li>15 kg</li>
                                    <li> <span class="blue-text">Partially Refundable</span>
                                    </li>
                                 </ul>
                              </li>
                           </ul>
                        </div>
                     </div>
                  </li>
               </ul>
            </div> -->
            <div class="booking-confirmation-hdr">Contact Detail</div>
            <div class="flight-contain-section">
               <div class="row">
                  <div class="col-sm-6">
                     <div class="book-confirm-box">
                        <label>Your name</label>
                        <p>{{$bookingResponse->booking->clientReference}}</p>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="book-confirm-box">
                        <label>Contact No.</label>
                        <p>{{Auth()->user()->mobile}}</p>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="book-confirm-box">
                        <label>Mobile No.</label>
                        <p>{{Auth()->user()->mobile}}</p>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="book-confirm-box">
                        <label>Email Address</label>
                        <p>{{Auth()->user()->email}}</p>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="book-confirm-box">
                        <label>Postcode</label>
                        <p>{{Auth()->user()->postcode}}</p>
                     </div>
                  </div>
                  <div class="col-sm-6">
                     <div class="book-confirm-box">
                        <label>City</label>
                        <p>{{$bookingResponse->booking->hotel->destinationName}}</p>
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="book-confirm-box booking-address-col">
                        <label>Address</label>
                        <div class="booking-address">
                           <p>J3 Jhalana Dungari Jaipur Raj.</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="booking-confirmation-hdr">Passenger Information</div>
            <div class="flight-contain-section passengers-info-section">
               <div class="row passengers-info-hdr-row">
                  <div class="col-6">
                     <div class="book-confirm-box">
                        <p>Guest Name</p>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="book-confirm-box">
                        <p>Type</p>
                     </div>
                  </div>
               </div>
               @if(!empty($guestNames))
               @foreach($guestNames as $key => $names)
               <div class="row">
                  <div class="col-6">
                     <div class="book-confirm-box">
                        <p>{{$names->fullname}}</p>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="book-confirm-box">
                        <p>Adult</p>
                     </div>
                  </div>
               </div>
               @endforeach
               @else
               <div class="row">
                  <div class="col-6">
                     <div class="book-confirm-box">
                        <p>{{$bookingResponse->booking->clientReference}}</p>
                     </div>
                  </div>
                  <div class="col-6">
                     <div class="book-confirm-box">
                        <p>Adult</p>
                     </div>
                  </div>
               </div>
               @endif
            </div>
            <div class="booking-confirmation-hdr">Payment Detail</div>

            <div class="flight-contain-section booking-payment-detail">
               @php
               $totalCharge = $bookingResponse->booking->totalNet; 
               $cardCharge = round($bookingResponse->booking->totalNet, 2) / "100" * "2.5";
               $hotelCharge = $totalCharge - $cardCharge
               @endphp
               <div class="row">
                  <div class="col-12">
                     <div class="book-confirm-box">
                        <p>Card Carge</p>
                        <p>{{$cardCharge}}</p>
                     </div>
                  </div>
                  <div class="col-12 ">
                     <div class="book-confirm-box book-hotel-col">
                        <p>Hotel Amount</p>
                        <p>{{$hotelCharge}}</p>
                     </div>
                  </div>
                  <div class="col-12">
                     <div class="book-confirm-box booking-total-amount">
                        <div class="total-amount-text">Total Amount<span class="inc-taxes-box">Include taxes and fees</span>
                        </div>
                        <p>{{$bookingResponse->booking->totalNet}}</p>
                     </div>
                  </div>
               </div>
            </div>
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