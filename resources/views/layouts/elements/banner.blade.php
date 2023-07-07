<!-- banner-section -->
<div class="home-banner" style="background-image: url(images/home-banner.jpg);">
  <div class="container">
    <div class="home-banner-contain">
      <h1>Book a Ticket & Just Leave!</h1> 
      <!-- Nav tabs -->
      <div class="home-banner-tab">
        <ul class="nav nav-tabs" role="tablist">

          <!--<li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#flights-hotel"> <span class="icon">
                            <img src="images/fligh-hotel.png" alt="fligh-hotel">
                          </span>
              <span class="text">Flight + Hotel</span> 
            </a>
          </li>-->

          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#hotel"> <span class="icon">
                            <img src="images/hotel.png" alt="fligh">
                          </span>  <span class="text">Hotel</span> 
            </a>
          </li>
          <li class="nav-item"></li>
          <li class="nav-item"></li>
          <li class="nav-item"></li>
          <li class="nav-item"></li>
          <li class="nav-item"></li>
          <li class="nav-item"></li>
          <li class="nav-item"></li>
          <li class="nav-item"></li>
          <li class="nav-item"></li>
          <li class="nav-item"></li>
          <!--
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#flight"> <span class="icon">
                            <img src="images/flight.png" alt="fligh">
                          </span>  <span class="text">flight</span> 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#transfer"> <span class="icon">
                            <img src="images/transfer.png" alt="transfer">  
                          </span>  <span class="text">transfer</span> 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#cruises"> <span class="icon">
                            <img src="images/cruises.png" alt="cruises">  
                          </span>  <span class="text">Cruises</span> 
            </a>
          </li>
          -->
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <div id="flights-hotel" class="tab-pane fade">
            <div class="flight-book-form">
              <div class="row">
                <div class="col-lg-3 col-md-6  col-sm-6">
                  <div class="form-group">
                    <label>Flying from?</label>
                    <input type="text" name="" class="form-control" placeholder="EX. Australia">
                  </div>
                </div>
                <div class="col-lg-3 col-md-6  col-sm-6">
                  <div class="form-group">
                    <label>Going to? (destination or hotel)</label>
                    <input type="text" name="" class="form-control" placeholder="EX. Australia">
                  </div>
                </div>
                <div class="col-lg-3 col-md-6  col-sm-6">
                  <div class="two-item-box form-group">
                    <ul class=" d-flex">
                      <li>
                        <label>Departure</label>
                        <input type="text" name="" class="form-control" placeholder="08 Dec 19">
                      </li>
                      <li>
                        <label>Return</label>
                        <input type="text" name="" class="form-control" placeholder="08 Dec 19">
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6  col-sm-6">
                  <div class="two-item-box form-group">
                    <ul class=" d-flex">
                      <li>
                        <label>Room</label>
                        <input type="text" name="" class="form-control" placeholder="01 Room">
                      </li>
                      <li>
                        <label>Guests</label>
                        <input type="text" name="" class="form-control" placeholder="02 Guests">
                      </li>
                    </ul>
                  </div> 
                </div>
              </div>
              <button type="submit" class="custom-btn"><i class="fas fa-search"></i>
              </button>
            </div>
          </div>

          <div id="hotel" class="tab-pane active">
            <div class="flight-book-form">
            {{ Form::open(array('id'=>'search-hotels','method'=>'GET','url' => 'hotels')) }}
              <div class="row">
                <!--<div class="col-lg-3 col-md-6  col-sm-6">
                  <div class="form-group">
                    <label>Flying from?</label>
                    <input type="text" name="" class="form-control" placeholder="EX. Australia">
                  </div>
                </div>-->

                  <div class="col-lg-4 col-md-6  col-sm-6">
                    <div class="form-group">
                      <label>Going to? (destination) &nbsp;<i class="fa fa-map-marker" style='color:grey'></i></label>
                      <input type="text" maxlength="150" autofocus="false" name="hotel_search_destination" class="form-control hote_search_inputs stop_first_space destinationDrpDwn" placeholder="EX. Australia">

                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6  col-sm-6">
                    <div class="two-item-box form-group">
                      <ul class=" d-flex">
                        <li>
                          <label>Check-in &nbsp;<i class="fa fa-calendar" style='color:grey'></i></label>
                          <input type="text" readonly name="checkIn" id="checkIn" class="form-control hote_search_inputs hote_checkIn_out_dates" placeholder="DD MM YYYY">
                        </li>
                        <li>
                          <label>Check-out &nbsp;<i class="fa fa-calendar" style='color:grey'></i></label>
                          <input type="text" readonly name="checkOut" id="checkOut" class="form-control hote_search_inputs hote_checkIn_out_dates" placeholder="DD MM YYYY">
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="col-lg-4 col-md-6  col-sm-6">

                    <div class="two-item-box form-group">
                      <ul class=" d-flex">
                        <li>
                          <label>Room &nbsp;<i class="fa fa-bed" style='color:grey'></i></label>
                          <input type="text" readonly onclick="myFunction()" name="room" value="1" class="form-control hote_search_inputs dropbtn" placeholder="1">

                            <div id="myDropdown" class="dropdown-content-for-hotel-search">
                              @for($i=1;$i<=10;$i++)
                                <a href="javascript:void(0);" class="no_of_room">{{$i}}</a>
                              @endfor
                            </div>

                        </li>
                        <li>
                          <label>Guests &nbsp;<i class="fa fa-user" style='color:grey'></i></label>
                          <input type="text" readonly onclick="selectGuests()" name="guests" value="2" class="form-control hote_search_inputs dropbtn_guests" placeholder="2">

                            <div id="guestDropdown" class="dropdown-content-for-hotel-guests-search">
                              @for($i=1;$i<=10;$i++)
                                <a href="javascript:void(0);" class="no_of_guest">{{$i}}</a>
                              @endfor
                            </div>

                        </li>
                      </ul>
                    </div> 
                  </div>

               
              </div>
              <button type="submit" class="custom-btn"><i class="fas fa-search"></i>
              </button>
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Nav tabs end -->
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




/*
$(document).on("click",".destinationDrpDwn", function () {

  var popular_html = '';
  $.ajax({
      type: "POST",
      url: "{{ url('/getpopulardestinations') }}",
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      //dataType: "json",
      success: function(res) {
        
          // var obj = jQuery.parseJSON(res); 
        
          if(res.status)
          { 
            //console.log("res data obj---",res.data);
            if (res.data.length > 0) {
              $.each(res.data, function (key, val) {
                popular_html += '<li style="margin:5px;"> '+val.name+'</li>'
              });

              $(".add_dynamic_data").html('').append(popular_html);

            }
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
          

  $(".dropdown-content-for-hotel-destination-search").addClass('show');
  $(".dropdown-content-for-hotel-search").removeClass('show');
  $(".dropdown-content-for-hotel-guests-search").removeClass('show_guest');
});
*/




$("#search-hotels").validate({
  rules: {
    hotel_search_destination: {
      required: true
    },
    checkIn: {
      required: true
    },
    checkOut: {
      required: true
    },
    room: {
      required: true
    },
    guests: {
      required: true
    },

  },
  messages: {     
    hotel_search_destination: {
      required: "Please enter destination name."
    },
    checkIn: {
      required: "Please select check-in date."
    },
    checkOut: {
      required: "Please select check-out date."
    },
    room: {
      required: "Please select number of rooms."
    },
    guests: {
      required: "Please select number of guests."
    }
  }, 
  submitHandler: function() {
      console.log('submit form');

      if($("#search-hotels").valid()) {
        return true;
      }else{
        return false;
      }
  }
});
</script>