<style>
   .filter-search li:last-child{color: #000000 !important;} 
   .ms-options-wrap > .ms-options .ms-selectall {
      text-transform: capitalize;
   }
</style>
<div class="filter-section">
      {{ Form::open(array('id'=>'search-hotels','method'=>'GET','url' => 'hotels')) }}

         <input type="hidden" value="<?php echo request()->get('hotel_search_destination'); ?>" name="hotel_search_destination">
         <input type="hidden" value="<?php echo request()->get('checkIn'); ?>" name="checkIn">
         <input type="hidden" value="<?php echo request()->get('checkOut'); ?>" name="checkOut">
         <input type="hidden" value="<?php echo request()->get('room'); ?>" name="room">
         <input type="hidden" value="<?php echo request()->get('guests'); ?>" name="guests">


         <div class="container">
            <ul class="d-flex flex-wrap filter-search filter-hotel">               
               <li>
                  <div class="form-group">
                     
                     <!--<input type="range" name="price_range" min="1" max="2000" class="range-slider" id="myRange"> -->

                     <label for="amount">Price Range: <span id="amount"> </span></label>  
                     <input type="hidden" name="min_price" id="amount_min_range" value="0">
                     <input type="hidden" name="max_price" id="amount_max_range" value="0">
                     <div id="slider-range" class="range-slider"></div>


                  </div>
               </li>
               <li>
                  <div class="form-group str_cat">
                     <label>Star Category</label> 
                     <?php $star_cat = request()->get('star_category');?>
                     <select style="padding-left:0px;width:245px;" class="form-control custom-select" name="star_category[]" multiple="multiple" id="select_star_cat">
                        <option {{ (!empty($star_cat) && in_array(5,$star_cat)) ? 'selected':'' }} value="5">5 Star</option>
                        <option {{ (!empty($star_cat) && in_array(4,$star_cat)) ? 'selected':'' }} value="4">4 Star</option>
                        <option {{ (!empty($star_cat) && in_array(3,$star_cat)) ? 'selected':'' }} value="3">3 Star</option>
                        <option {{ (!empty($star_cat) && in_array(2,$star_cat)) ? 'selected':'' }} value="2">2 Star</option>
                        <option {{ (!empty($star_cat) && in_array(1,$star_cat)) ? 'selected':'' }} value="1">1 Star</option>
                     </select>
                  </div>
               </li>

               <li>
                  <div class="from-group user_rt">
                     <label>User Rating</label>  
                     <?php $user_rating = request()->get('user_rating');?>                    
                     <select style="padding-left:0px;width:225px;" class="form-control custom-select" name="user_rating[]" multiple="multiple" id="user_rating">
                        <option {{ (!empty($user_rating) && in_array(4.5,$user_rating)) ? 'selected':'' }} value="4.5">4.5 & above (Excellent)</option>
                        <option {{ (!empty($user_rating) && in_array(4,$user_rating)) ? 'selected':'' }} value="4">4 & above (Very Good)</option>
                        <option {{ (!empty($user_rating) && in_array(3,$user_rating)) ? 'selected':'' }} value="3">3 & above (Good)</option>
                     </select>
                  </div>
               </li>
               <li>
                  <div class="from-group" style="">
                     <label>Amenities</label> 
                     <select style="padding-left:0px;width:205px;" class="form-control custom-select" name="amenities[]" id="amenities" multiple="multiple">
                     @foreach ($amenities as $key => $amenity)
                        <option value="{{$key}}">{{ $amenity }}</option>
                     @endforeach
                     </select>
                  </div>
               </li>
                   
               <li class="apply-button">
               <div class="from-group">
                  <button type="submit" class="custom-btn">Apply Filters</button>
               </div>
               </li>
            </ul>
         </div>
      {{ Form::close() }}
</div>