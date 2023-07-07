<div class="flight-search-section">
         <div class="container">
            <nav class="navbar navbar-expand-lg p-0">
               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">Flight Search 
               <span class="navbar-toggler-icon"><i class="fas fa-chevron-down"></i></span> 
               </button> 
               <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                  {{ Form::open(array('id'=>'search-hotels','method'=>'GET','url' => 'hotels')) }}
                  <div class="flight-search">
                     <span class="flight-icon"><img src="images/white-flight-icon.png" alt="white-flight-icon"></span>
                     <ul class="d-flex flex-wrap flight-search-form">
                        <li>
                           <div class="from-group">
                              <label>Destination</label> 
                              <input type="text" value="<?php echo request()->get('hotel_search_destination'); ?>" class="form-control destinationDrpDwn stop_first_space" data-arc="list_page_search" id="inr_dest_search" name="hotel_search_destination" placeholder="Australia(AUS)">
                           </div>
                        </li>
                        <li>
                           <div class="from-group">
                              <label>Check-in</label>
                              <input type="text" class="form-control calender-icon" value="<?php echo request()->get('checkIn'); ?>" readonly name="checkIn" id="checkIn" placeholder="Check-in">
                           </div>
                        </li>
                        <li>
                           <div class="from-group">
                              <label>Check-out</label>
                              <input type="text" class="form-control calender-icon" value="<?php echo request()->get('checkOut'); ?>" readonly name="checkOut" id="checkOut" placeholder="Check-out">
                           </div>
                        </li>
                        <li>
                           <div class="from-group">
                              <label>Room</label> 
                              <select class="form-control custom-select" name="room" placeholder="Room">
                                 <option <?php echo (request()->get('room') !='' && request()->get('room') == 1) ? 'selected' : ''; ?> value="1">1</option>
                                 <option <?php echo (request()->get('room') !='' && request()->get('room') == 2) ? 'selected' : ''; ?>  value="2">2</option>
                                 <option  <?php echo (request()->get('room') !='' && request()->get('room') == 3) ? 'selected' : ''; ?>  value="3">3</option>
                                 <option <?php echo (request()->get('room') !='' && request()->get('room') == 4) ? 'selected' : ''; ?>  value="4">4</option>
                                 <option <?php echo (request()->get('room') !='' && request()->get('room') == 5) ? 'selected' : ''; ?>  value="5">5</option>
                                 <option <?php echo (request()->get('room') !='' && request()->get('room') == 6) ? 'selected' : ''; ?>  value="6">6</option>
                                 <option <?php echo (request()->get('room') !='' && request()->get('room') == 7) ? 'selected' : ''; ?>  value="7">7</option>
                                 <option <?php echo (request()->get('room') !='' && request()->get('room') == 8) ? 'selected' : ''; ?>  value="8">8</option>
                                 <option <?php echo (request()->get('room') !='' && request()->get('room') == 9) ? 'selected' : ''; ?>  value="9">9</option>
                                 <option <?php echo (request()->get('room') !='' && request()->get('room') == 10) ? 'selected' : ''; ?>  value="10">10</option>
                              </select>
                           </div>
                        </li>
                        <li>
                           <div class="from-group">
                              <label>Guests</label> 
                              <select class="form-control custom-select" name="guests" placeholder="Guests">
                                 <option <?php echo (request()->get('guests') !='' && request()->get('guests') == 1) ? 'selected' : ''; ?>  value="1">1</option>
                                 <option <?php echo (request()->get('guests') !='' && request()->get('guests') == 2) ? 'selected' : ''; ?>  value="2">2</option>
                                 <option <?php echo (request()->get('guests') !='' && request()->get('guests') == 3) ? 'selected' : ''; ?>  value="3">3</option>
                                 <option <?php echo (request()->get('guests') !='' && request()->get('guests') == 4) ? 'selected' : ''; ?>  value="4">4</option>
                                 <option <?php echo (request()->get('guests') !='' && request()->get('guests') == 5) ? 'selected' : ''; ?>  value="5">5</option>
                                 <option <?php echo (request()->get('guests') !='' && request()->get('guests') == 6) ? 'selected' : ''; ?>  value="6">6</option>
                                 <option <?php echo (request()->get('guests') !='' && request()->get('guests') == 7) ? 'selected' : ''; ?>  value="7">7</option>
                                 <option <?php echo (request()->get('guests') !='' && request()->get('guests') == 8) ? 'selected' : ''; ?>  value="8">8</option>
                                 <option <?php echo (request()->get('guests') !='' && request()->get('guests') == 9) ? 'selected' : ''; ?>  value="9">9</option>
                                 <option <?php echo (request()->get('guests') !='' && request()->get('guests') == 10) ? 'selected' : ''; ?>  value="10">10</option>
                              </select>
                           </div>
                        </li>
                        <li>   
                           <button type="submit" class="custom-btn">Search</button>
                        </li>
                     </ul>
                  </div>
                  {{ Form::close() }}
               </div>
            </nav>
         </div>
      </div>

<script>
   $(document).ready(function(){  
     $( "#checkIn" ).datepicker({
       maxDate: '+1Y',
       minDate: new Date(),
       dateFormat: 'd M yy',
       onClose: function(selectedDate) {
           //$("#checkOut").datepicker("option", "minDate", selectedDate);


           var date2 = $( "#checkIn" ).datepicker('getDate', '+1d'); 
           if(date2 != '' && date2 != undefined && date2 != null)
           {
           date2.setDate(date2.getDate()+1); 
         // $('.dropoffDate').datepicker('setDate', date2);


           $("#checkOut").datepicker("option", "minDate", date2);
           }

         }
     });

     $( "#checkOut" ).datepicker({
       maxDate: '+1Y',
       dateFormat: 'd M yy',
       minDate: new Date()
     });
});


let timeoutIDFilter = null;

function autopopulateplaces(searchTerm) {
  console.log('search: ' + searchTerm)

  $("#inr_dest_search").autocomplete({
    source: function (request, response) {
        $.ajax({
          type: "POST",
          url: "{{ url('/getpopulardestinations') }}",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data : {'search_term' : ''},
          success: function (data) {
              
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
$('#inr_dest_search').click(function(e) {
      clearTimeout(timeoutIDFilter);
      const value = e.target.value
      timeoutIDFilter = setTimeout(
         () => autopopulateplaces(value), 100
      )  
});

// load default popular booking places
$(window).on('load', function () {

   var get_all = 'all';
   autopopulateplaces(get_all);

} );
</script>