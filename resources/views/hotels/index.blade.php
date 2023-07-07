@extends('layouts.app')
@section('content')
@include('hotels.filters_nav')
@include('hotels.filters')
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
<?php

$hotelSortOrder = 'asc';
$locationSortOrder = 'asc';
$ratingSortOrder = 'asc';
$priceSortOrder = 'asc';


$hotelActive = '';
$locationActive = '';
$ratingActive = '';
$priceActive = '';


$hotelSortIcon = 'fas fa-sort-alpha-up';
$locationSortIcon = 'fas fa-sort-alpha-up';
$ratingSortIcon = 'fas fa-sort-amount-up';
$priceSortIcon = 'fas fa-sort-amount-up';

if (\Request::has('type') && \Request::has('order')) {
   //print_r(\Request::get('orderby'));die;

   if (\Request::get('type') == 'hotel') {
      $hotelActive = 'active';
      if (\Request::get('order') == 'asc') {
         $hotelSortOrder = 'desc';
         $hotelSortIcon = 'fas fa-sort-alpha-up';
      } else if (\Request::get('order') == 'desc') {
         $hotelSortOrder = 'asc';
         $hotelSortIcon = 'fas fa-sort-alpha-down-alt';
      }
   } else if (\Request::get('type') == 'location') {
      $locationActive = 'active';
      if (\Request::get('order') == 'asc') {
         $locationSortOrder = 'desc';
         $locationSortIcon = 'fas fa-sort-alpha-up';
      } else if (\Request::get('order') == 'desc') {
         $locationSortOrder = 'asc';
         $locationSortIcon = 'fas fa-sort-alpha-down-alt';
      }
   } else if (\Request::get('type') == 'rating') {
      $ratingActive = 'active';
      if (\Request::get('order') == 'asc') {
         $ratingSortOrder = 'desc';
         $ratingSortIcon = 'fas fa-sort-amount-up';
      } else if (\Request::get('order') == 'desc') {
         $ratingSortOrder = 'asc';
         $ratingSortIcon = 'fas fa-sort-amount-down';
      }
   } else if (\Request::get('type') == 'price') {
      $priceActive = 'active';
      if (\Request::get('order') == 'asc') {
         $priceSortOrder = 'desc';
         $priceSortIcon = 'fas fa-sort-amount-up';
      } else if (\Request::get('order') == 'desc') {
         $priceSortOrder = 'asc';
         $priceSortIcon = 'fas fa-sort-amount-down';
      }
   }
} else {
   $hotelActive = 'active';
   $hotelSortOrder = 'desc';
   $hotelSortIcon = 'fas fa-sort-alpha-up';
}
$full_url = url()->current() . '?' . http_build_query(array_merge(request()->all()));

$full_url = str_replace('&type=hotel', '', $full_url);
$full_url = str_replace('&type=location', '', $full_url);
$full_url = str_replace('&type=rating', '', $full_url);
$full_url = str_replace('&type=price', '', $full_url);
$full_url = str_replace('&order=asc', '', $full_url);
$full_url = str_replace('&order=desc', '', $full_url);

?>
<div class="inner-middle-section">
   <div class="flight-list-outer">
      <div class="container">
         <div class="flight-list-main">
            <div class="flight-list-box">
               <!-- short-box -->
               <div class="short-box">
                  <ul class="d-flex mb-0">
                     <li class="short-heading">
                        Sort By:
                     </li>
                     <li class="{{ $hotelActive }}"><a href="{{ $full_url.'&type=hotel&order='.$hotelSortOrder }}">Hotel <i class='{{$hotelSortIcon}}'></i></a></li>
                     <li>Location </li>
                     <!--<li class="{{ $locationActive }}"><a href="{{ $full_url.'&type=location&order='.$locationSortOrder }}">Location <i class='{{$locationSortIcon}}'></i> </a></li>-->
                     <li class="{{ $ratingActive }}"><a href="{{ $full_url.'&type=rating&order='.$ratingSortOrder }}">Rating <i class='{{$ratingSortIcon}}'></i></a></li>
                     <li class="{{ $priceActive }}"><a href="{{ $full_url.'&type=price&order='.$priceSortOrder }}">Price <i class='{{$priceSortIcon}}'></i></a></li>
                     <!--<li class="active"><a href="#"> Price Per Adult<img src="images/up-arrow.png" alt="up-arrow"> </a></li> -->
                  </ul>
               </div>
               <!-- short-box -->
               @if(count($paging_data) > 0)
               @foreach($paging_data as $key => $hotel)

               <div class="flight-listing-box">
                  <div class="flight-listing-box-inner">
                     <div class="listing-top-dtl">
                        <div class="listing-col">
                           <div class="airlines-box">
                              <figure>
                                 <a href="{{ url('/hotel-detail/'.$hotel->code) }}" target="_blank">
                                    <img src="<?php echo @$hotel->hotel_image; ?>" onerror="this.src='images/no-img.jpeg';" style="height: 73px !important;width: 142px !important;max-width: none !important;" alt="hotel image">
                                 </a>
                              </figure>
                              <!--<div class="airlines-text">
                                       <span class="name-text">Spice Jet</span>
                                       <p>SG-276</p>
                                    </div>-->
                           </div>
                        </div>
                        <div class="listing-col depart-time-col">
                           <a href="{{ url('/hotel-detail/'.$hotel->code) }}" target="_blank">
                              <p>{{$hotel->name}}</p>
                           </a>
                        </div>
                        <div class="listing-col">
                           <p>{{@$hotel->destinationName}}</p>
                        </div>
                        <div class="listing-col">
                           <p>
                              <span class="number_of_stars" data-rating="<?php echo getRatingCount($hotel->categoryName); ?>" data-num-stars="5"></span>
                           </p>
                        </div>
                        <div class="listing-col price-col">
                           <span>{{ @$hotel->minRate }} {{ @$hotel->currency }}</span>
                           <div class="save_hotel_session_data" style="display:none;"><?php echo json_encode($hotel); ?></div>
                           <a href="{{ url('/hotel-detail/'.$hotel->code) }}" target="_blank" class="custom-btn blue-bdr-btn save_hotel_session_data_anch">View Detail</a>
                        </div>
                     </div>
                  </div>
               </div>

               @endforeach
               @else
               <div class="flight-listing-box">
                  <div class="flight-listing-box-inner">
                     <div class="listing-top-dtl">
                        <div class="listing-col">
                           <div class="airlines-box">
                              No Record found.
                           </div>
                        </div>
                     </div>
                  </div>
               </div>

               @endif

               <!-- pagination -->
               {!! $paging_data->appends(request()->input())->links('vendor.pagination.custom') !!}

               <!-- pagination -->

            </div>
            <!-- flight-list-box -->
            <!-- advertise-box -->
            <div class="flight-advertise-box">
               <figure>
                  <a href="#"><img src=" images/flight-adv-bnr-1.jpg" alt=""></a>
               </figure>
               <figure>
                  <a href="#"><img src=" images/flight-adv-bnr-2.jpg" alt=""></a>
               </figure>
            </div>
         </div>
      </div>
   </div>
</div>
<?php
$price_filter = false;
$min_price = '1';
$max_price = '1';
if (\Request::has('min_price') && \Request::has('max_price') && \Request::get('min_price') != '' && \Request::get('max_price') != '' && is_numeric(\Request::get('min_price')) && is_numeric(\Request::get('max_price'))  && (\Request::get('max_price') <= 5000)) {
   $price_filter = true;
   $min_price = \Request::get('min_price');
   $max_price = \Request::get('max_price');
}
?>
<script>
   $(function() {
      $('.number_of_stars').stars();

      var is_price_range_applied = "<?php echo  $price_filter; ?>";

      if (is_price_range_applied != null && is_price_range_applied != '' && is_price_range_applied != undefined && is_price_range_applied == true) {
         $("#amount_min_range").val(parseInt(<?php echo $min_price; ?>));
         $("#amount_max_range").val(parseInt(<?php echo $max_price; ?>));

         $("#amount").text(<?php echo $min_price; ?> + " - " + <?php echo $max_price; ?>);


         $("#slider-range").slider({
            range: true,
            min: 1,
            max: 5000,
            values: [<?php echo $min_price; ?>, <?php echo $max_price; ?>],
            slide: function(event, ui) {
               $("#amount").text(ui.values[0] + " - " + ui.values[1]);

               $("#amount_min_range").val(ui.values[0]);
               $("#amount_max_range").val(ui.values[1]);

            }
         });
      } else {
         $("#slider-range").slider({
            range: true,
            min: 1,
            max: 5000,
            slide: function(event, ui) {
               $("#amount").text(ui.values[0] + " - " + ui.values[1]);

               $("#amount_min_range").val(ui.values[0]);
               $("#amount_max_range").val(ui.values[1]);

            }
         });
      }
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



   $('#select_star_cat').multiselect({
      placeholder: 'Select Star Category',
      selectAll: true
   });

   $('#user_rating').multiselect({
      placeholder: 'Select User Rating',
      selectAll: true
   });

   $('#amenities').multiselect({
      placeholder: 'Select Amenities',
      search: true
   });

   $('.save_hotel_session_data_anch').click(function(e) {
      $.ajax({
         type: "POST",
         dataType: 'json',
         url: "{{ url('/savehotelsessiondata') }}",
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
         data: {
            'hotel_session_data': $(this).siblings('.save_hotel_session_data').text()
         },
         complete: function(data) {
            return true;
         },
      });
   });
</script>
@endsection