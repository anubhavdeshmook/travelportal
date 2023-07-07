@extends('layouts.app')
@section('content')
@php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$parts = explode("/", $actual_link);
$hotelcode = end($parts);
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
<div class="hotel-dtl-top-row">
<div class="hotel-dtl-top-hdr">
<h4 class="hotel-dtl-hdr">
<span> {{ !empty($hotel_detail_arr) ? $hotel_detail_arr->name->content : ''}}</span>
<div class="hotel-dtl-top-rating">
@if($hotel_detail_arr)
<p style="font-size:14px;">
<span class="number_of_stars" data-rating="<?php echo getRatingCount($hotel_detail_arr->category->description->content); ?>" data-num-stars="5"> </span>
</p>
@endif
</div>
</h4>
<p>
<?php
$address = '';
if (isset($hotel_detail_arr->address->content) && !empty($hotel_detail_arr->address->content)) {
   $address = $hotel_detail_arr->address->content;
}

if (isset($hotel_detail_arr->city->content) && !empty($hotel_detail_arr->city->content)) {
   $address .= ', ' . $hotel_detail_arr->city->content;
}

if (isset($hotel_detail_arr->postalCode) && !empty($hotel_detail_arr->postalCode)) {
   $address .= ', ' . $hotel_detail_arr->postalCode;
}
echo $address;


?>


</p>
</div>
<div class="hotel-book-price"><?php //echo json_encode($hotel_previous_page_data);
?>
<div class="box-price-box">
<h4 class="hotel-dtl-hdr"> {{ @$hotel_previous_page_data->currency }} {{ @$hotel_previous_page_data->minRate }}</h4>
<p>Per Room</p>
</div>
<div class="btn-box">

@if(Auth::check())
<!-- <a href="{{ route('hotel-detail',$hotelcode); }}" class="custom-btn move_bottom_rooms">Book Now</a> -->
<a href="{{ route('hotelDetailwithUser',$hotelcode); }}" class="custom-btn move_bottom_rooms">Book Now</a>
<!-- <a href="javascript:void(0);" class="custom-btn move_bottom_rooms" onclick="bookNow()">Book Now</a> -->
@else
<a class="custom-btn move_bottom_rooms" onclick="bookNow()">Book Now</a>

@endif
</div>
</div>
</div>
<div class="hotel-dtl-slider-outer">
<div class="hotel-dtl-slider">
<div id="slider" class="flexslider flexslider-main">
<span class="off-price"><strong>56%</strong>Off</span>
<ul class="slides">
<?php
// echo '<pre>';
// print_r($hotel_previous_page_data);die;
?>
@if(isset($hotel_previous_page_data->hotel_detail->images) && !empty($hotel_previous_page_data->hotel_detail->images))

@foreach($hotel_previous_page_data->hotel_detail->images as $key => $hotel_images)
<li class="big-img">
<figure><img src="http://photos.hotelbeds.com/giata/xl/{{ $hotel_images->path }}" alt="{{ $hotel_images->type->description->content }}" /></figure>
</li>
@endforeach

@else
<li class="big-img">
<figure><img src="{{ !empty($hotel_previous_page_data->hotel_image)?$hotel_previous_page_data->hotel_image:'' }}" alt="{{ !empty($hotel_previous_page_data->name)?$hotel_previous_page_data->name:'' }}" /></figure>
</li>
@endif
</ul>
</div>
<div id="carousel" class="flexslider thumb-nav">
<ul class="slides">
@if(isset($hotel_previous_page_data->hotel_detail->images) && !empty($hotel_previous_page_data->hotel_detail->images))

@foreach($hotel_previous_page_data->hotel_detail->images as $key => $hotel_images)
<li class="thumb-img">
<img src="http://photos.hotelbeds.com/giata/xl/{{ $hotel_images->path }}" alt="{{ $hotel_images->type->description->content }}" />
</li>
@endforeach

@else
<li class="thumb-img">
<img src="{{ !empty($hotel_previous_page_data->hotel_image)?$hotel_previous_page_data->hotel_image:'' }}" alt="{{ !empty($hotel_previous_page_data->name)?$hotel_previous_page_data->name:'' }}" />
</li>
@endif
</ul>
</div>
</div>
<!-- hotel-dtl-slider -->
<div class="dtl-slider-contain">
<ul class="dtl-slider-list">
<li class="slider-list-items">
<div class="hotel-dtl-top-hdr">
<h4 class="hotel-dtl-hdr">{{ !empty($hotel_detail_arr)?\Illuminate\Support\Str::limit($hotel_detail_arr->name->content, 14, $end='...'):'' }}


</h4>
<p>{{ \Illuminate\Support\Str::limit($address, 40, $end='...') }}</p>
</div>
<ul class="hotel-facilities-list">

<?php
if (isset($hotel_detail_arr->facilities) && !empty($hotel_detail_arr->facilities)) {
   $facilities = getFacilities($hotel_detail_arr->facilities);
   foreach ($facilities as $key => $facility) {
      
      ?>
      <li>
      <span class="icon"><img src="{{URL::asset('/images/collection.jpg')}}" alt="collection"></span>
      {{$facility}}
      </li>
      <?php
   }
}
?>

</ul>
</li>
<li class="slider-list-items">
<div class="hotel-dtl-rating-box">
<div class="very-gd-text">

<?php
$rating = !empty($hotel_previous_page_data->star_counter) ? $hotel_previous_page_data->star_counter : 0;
if ($rating > 0 && $rating <= 1) {
   echo 'Poor';
} else if ($rating > 1 && $rating <= 2) {
   echo 'Average';
} else if ($rating > 2 && $rating <= 3) {
   echo 'Good';
} else if ($rating > 3 && $rating <= 4) {
   echo 'Very Good';
} else if ($rating > 4 && $rating <= 5) {
   echo 'Excellent';
}
?>
</div>
<div class="hotel-dtl-rating-contain">
<ul class="dtl-rating-outer">
<!--<li class="rating-text">5</li> -->
<li>
<ul class="dtl-rating">
<?php $rating = !empty($hotel_previous_page_data->star_counter) ? $hotel_previous_page_data->star_counter : 0;
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
      </li>
      </ul>
      <!--<div class="dtl-view-text">123 Reviews</div> -->
      </div>
      </div>
      </li>
      <li class="slider-list-items">
      <div class="desc-text">
      <p>The rating percentage is calculated from customers who booked within the last 12 months. All ratings and reviews are based on the feedback and opinions of the customers who submitted them and do not express the opinions of
      <span><a href="https://travel.dotsquares.solutions">https://travel.dotsquares.solutions</a></span>
      </p>
      <div>
      </li>
      </ul>
      </div>
      </div>
      <div class="hotel-detail-contain">
      <h4 class="hotel-detail-heading">Hotel Detail</h4>
      <p>
      {{!empty($hotel_detail_arr->description)?$hotel_detail_arr->description->content:''}}
      </p>
      </div>
      @if($hotel_detail_arr && $hotel_detail_arr->rooms)
      <div class="hotel-detail-contain">
      <h4 class="hotel-detail-heading">Available Room Types & Rooms Facilities</h4>
      <?php $rooms = showRooms($hotel_detail_arr->rooms);
      $hotel_listing_data = !empty($hotel_previous_page_data->rooms) ? $hotel_previous_page_data->rooms : [];
      
      $rooms_price = [];
      foreach ($hotel_listing_data as $key => $data) {
         $price_arr = [];
         if (isset($data->rates) && !empty($data->rates)) {
            foreach ($data->rates as $key2 => $rate) {
               // $price_arr[] = $rate->net;
               $price_arr[] = isset($rate->net)? $rate->net:$rate->shiftRates[0]->net;
               $rooms_price[$data->code] = $price_arr;
            }
         }
      }
      // echo "<pre>";
      // print_r($hotel_listing_data);die;
      
      //echo '<pre>';
      //print_r($rooms_price );die;
      
      foreach ($rooms as $key => $room) {
         if (!empty($room)) {
            
            ?>
            <div class="hotel-room-dtl-row">
            <div class="hotel-room-dtl-heading"><?php
            //echo '<pre>';
            //print_r($room );die;
            if ($key == 0) {
               echo 'Single bed 80-130 width';
            } else if ($key == 2) {
               echo 'Double bed 131-150 width';
            } else if ($key == 3) {
               echo 'Queen-size bed 150-154 width';
            }
            ?>
            </div>
            <!--<figure class="hotel-room-img hotel-room-img-mobile-view">
            <div class="img-box">
            <img  src="{{URL::asset('/images/hotel-room.jpg')}}" alt="hotel-room"/>
            </div>
            </figure>-->
            <div class="hotel-room-dtl">
            <?php foreach ($room as $key2 => $one_room) {
               if (isset($rooms_price[$one_room->roomCode])) {
                  ?>
                  <div class="hotel-room-dtl-contain <?php if ($key2 > 1) {
                     echo "view-more";
                  } ?>" <?php if ($key2 > 1) {
                     echo "style=display:none;";
                  }
                  ?>>
                  <div class="hotel-middle-heading">{!! $one_room->description !!}</div>
                  <div class="hotel-room-dtl-inner">
                  <ul class="hotel-middle-facilities">
                  <li class="facilities-items guests">
                  <div class="facilities-contain-box">
                  <div class="facilities-contain-box-hdr">Max Guests</div>
                  <ul class="facilities-contain-list">
                  <li class="facilities-contain-items">
                  Audlts: <?php echo $one_room->minAdults; ?>
                  </li>
                  <li class="facilities-contain-items">
                  Children: <?php echo $one_room->maxChildren; ?>
                  </li>
                  </ul>
                  </div>
                  </li>
                  <li class="facilities-items">
                  <div class="facilities-contain-box">
                  <div class="facilities-contain-box-hdr">Characteristic</div>
                  <ul class="facilities-contain-list inclusion">
                  <li class="facilities-contain-items"> <?php if (isset($one_room->characteristic->description->content) && !empty($one_room->characteristic->description->content)) {
                     if ($one_room->characteristic->description->content == 'DELUXE') {
                        echo $one_room->characteristic->description->content . ' ROOM';
                     } else {
                        echo $one_room->characteristic->description->content;
                     }
                  } ?></li>
                  </ul>
                  </div>
                  </li>
                  <li class="facilities-items">
                  <div class="facilities-contain-box">
                  <?php
                  if (isset($one_room->roomFacilities) && !empty($one_room->roomFacilities)) {
                     $room_facilities = getRoomFacilities($one_room->roomFacilities);
                     if (!empty($room_facilities)) {
                        ?>
                        <div class="facilities-contain-box-hdr">Highlights</div>
                        <ul class="facilities-contain-list highlated inclusion">
                        
                        <?php
                        
                        foreach ($room_facilities as $key => $faclity) {
                           
                           ?>
                           <li class="facilities-contain-items">
                           
                           {{$faclity}}
                           </li>
                           <?php
                        }
                        ?>
                        </ul>
                        </div>
                        <?php
                     }
                  }
                  ?>
                  </li>
                  </ul>
                  {{--@php
                     echo "<pre>";
                     print_r($hotel_previous_page_data);die;
                     @endphp--}}
                     <div class="hotel-room-dtl-price">
                     <span class="price">{{ @$hotel_previous_page_data->currency }} <?php
                     if (isset($rooms_price[$one_room->roomCode])) {
                        echo (min($rooms_price[$one_room->roomCode]));
                     }
                     
                     ?> </span>
                     @if(Auth::check())
                     
                     <a href="{{ route('hotelroom',[$hotelcode,$one_room->roomCode]); }}" class="custom-btn">Book Now</a>
                     @else
                     <a class="custom-btn move_bottom_rooms" onclick="bookNow()">Book Now</a>
                     
                     @endif
                     </div>
                     </div>
                     </div>
                     <?php
                  }
               } ?>
               </div>
               <?php if (count($room) > 2) { ?>
                  <div class="room-view-row text-center">
                  <a href="#!" onclick="show_more_hotels(this)" class="custom-btn blue-btn">View More <img src="{{URL::asset('/images/black-drop-down.png')}}" alt="black-drop-down" /></a>
                  </div>
                  <?php } ?>
                  </div>
                  
                  <?php }
               } ?>
               </div>
               @endif
               
               @if($hotel_detail_arr && $hotel_detail_arr->coordinates)
               <div class="hotel-detail-contain">
               <h4 class="hotel-detail-heading">Map & Directions</h4>
               <div class="hotel-detail-map">
               <iframe width="1240" height="500" src="https://maps.google.com/maps?q=<?php echo $hotel_detail_arr->coordinates->latitude; ?>,<?php echo $hotel_detail_arr->coordinates->longitude; ?>&hl=es;z=500&amp;output=embed"></iframe>
                  </div>
                  </div>
                  @endif
                  </div>
                  </div>
                  <!-- inner-middle-section -->
                  
                  <script>
                  $(function() {
                     $('.number_of_stars').stars();
                  });
                  
                  $.fn.stars = function() {
                     return $(this).each(function() {
                        const rating = $(this).data("rating");
                        const numStars = $(this).data("numStars");
                        const fullStar = '<i class="fas fa-star"></i>'.repeat(Math.floor(rating));
                        const halfStar = (rating % 1 !== 0) ? '<i class="fas fa-star-half-alt"></i>' : '';
                        const noStar = '<i class="far fa-star"></i>'.repeat(Math.floor(numStars - rating));
                        $(this).html(`${fullStar}${halfStar}${noStar}`);
                     });
                  }
                  
                  function openNav() {
                     document.getElementById("myNav").style.width = "100%";
                  }
                  
                  function closeNav() {
                     document.getElementById("myNav").style.width = "0%";
                  }
                  
                  {{--function bookNow() {
                     $.ajax({
                        url: "{{route('booking-confirm')}}",
                        type: "post",
                        dataType: 'json',
                        data: {
                           _token: "{{ csrf_token() }}",
                           rateKey: "{{$minRateKey}}"
                        },
                        success: function(result) {
                           if (result.success == 1) {
                              window.location = "{{route('view-booking-review')}}";
                           }
                        },
                        error: function(jqXHR, exception) {
                           if (jqXHR.status == "401") {
                              alert("Please Login First To Book Hotel");
                              return false;
                           }
                        }
                     });
                  }--}}
                  
                  
                  function bookNow(){
                     $('.login').click();
                  }
                  
                  
                  
                  $(".move_bottom_rooms").click(function() {
                     $("body, html").animate({
                        scrollTop: $($(this).attr('href')).offset().top
                     }, 600);
                  })
                  
                  function show_more_hotels($this){
                     $('.hotel-room-dtl-contain ').show();
                     $($this).hide();
                  }
                  
                  </script>
                  @endsection