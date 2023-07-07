@extends('layouts.app')

@section('content')
  
      <!-- inner-middle-section -->
      <div class="inner-middle-section">
      <div class="my-account-section">
         <div class="container">  

           <div class="my-account-row">  
                @include('user.sidemenu')
                <div class="my-account-contain-col">    
                <div class="my-account-contain my-account-shadow"> 
                  <div class="my-account-contain-hdr">My Booking</div>
                      <div class="booking-tbl-outer">

                       {{ Form::open(['url' => ['my-bookings'], 'method' => 'GET', 'id' => 'form']) }}                


                       <div class="row">
                          <div class="col-sm-4">
                              <div class="form-group">
                                <label for="emailsubject">Booking Date From<span style="color: red;font-size:18px;"><b>*</b></span></label>
                                  {{ Form::date('booking_date_from', !empty($request->booking_date_from)?$request['booking_date_from']:'', ['class' => 'endDate form-control', 'placeholder' => 'Enter Booking Date From', 'id' => 'my_date_picker','required']) }}
                                            
                                </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label for="emailsubject">Booking Date To<span style="color: red;font-size:18px;"><b>*</b></span></label>
                                {{ Form::date('booking_date_to', !empty($request->booking_date_to)?$request['booking_date_to']:'', ['class' => 'endDate form-control', 'placeholder' => 'Enter Booking Date To', 'id' => 'my_date_picker','required']) }}
                                            
                            </div>
                          </div>
                          <div class="col-sm-2">
                            <div class="form-group">

                              <button type="submit" id="chanePassSubmit" class="custom-btn blue-btn my-account-btn">Filter</button> 
                                            
                            </div>
                          </div>
                          <div class="col-sm-1">
                            <div class="form-group">

                              <a href="{{ route('my-bookings') }}"><i class="fa fa-refresh" aria-hidden="true"></i><button type="button" id="reset" class="custom-btn blue-btn my-account-btn" >Reset</button></a>
                                            
                            </div>
                          </div>
                      </div> 
                      {{ Form::close() }}


                        <div class="booking-tbl-radis-box">
                        <table class="table booking-tbl"> 
                            <thead> 
                              <tr>
                                <th style="width:6%;">S.No</th>
                                <th>Booking Date</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Payment Type</th>
                                <th>Booking Status</th>
                                <th>Hotel</th>
                                <th>Price</th>
                                <th style="width: 7%;">View</th> 

                              </tr>
                            </thead>
                            <tbody>
                              @php $i =  1; @endphp 
                              @if(!empty($user_booking_details) && !empty($user_booking_details))
                              @foreach($user_booking_details as $result )
                              @php  $booking_response = json_decode($result['booking_response']); @endphp
                                @if(isset($booking_response->booking))
                              
                                <tr>
                                  <td>
                                    <ul class="user-dth-box">
                                      <li>{{ $i++ }}</li>
                                    </ul>
                                  </td> 
                                  <td>
                                    <ul>
                                      <li>
                                  <p>{{ date('m-d-Y',strtotime($result['created_at'])) }}</p> 
                                      </li>
                                    </ul>
                                  </td>
                                  <td>
                                     <ul class="chk-box-dtl">
                                      <li>
                                        <p>{{ $booking_response->booking->hotel->checkIn }}</p>
                                      </li>
                                    </ul>
                                  </td>
                                  <td>
                                     <ul class="chk-box-dtl">
                                      <li>
                                        <p>{{ $booking_response->booking->hotel->checkOut }}</p>
                                      </li>
                                    </ul>
                                  </td>
                                  <td>Stripe</td>
                                  <td>{{ "Confirmed" }}</td>
                                  <td>
                                    <div class="destination-col">
                                      <p>{{ $booking_response->booking->hotel->name }}</p>
                                      <!-- <span class="middle-bdr"></span>
                                      <p>Goa</p> -->
                                    </div>
                                   </td> 
                                  <td> <p>{{ $booking_response->booking->hotel->rooms[0]->rates[0]->net }}</p> </td>     
                                  <td><a class="view-icon" href="{{ route('booking.view',$result['id']) }}"><i class="fa fa-eye"></i></a></td>
                                </tr>

                                @else
  
                                <tr>
                                  <td>
                                    <ul class="user-dth-box">
                                      <li>{{ $i++ }}</li>
                                    </ul>
                                  </td> 
                                  <td>
                                    <ul>
                                      <li>
                                  <p>{{ date('m-d-Y',strtotime($result['created_at'])) }}</p> 
                                      </li>
                                    </ul>
                                  </td>
                                  <td>
                                     <ul class="chk-box-dtl">
                                      <li>
                                        <p>{{-- $booking_response->booking->hotel->checkIn --}}</p>
                                      </li>
                                    </ul>
                                  </td>
                                  <td>
                                     <ul class="chk-box-dtl">
                                      <li>
                                        <p>{{-- $booking_response->booking->hotel->checkOut --}}</p>
                                      </li>
                                    </ul>
                                  </td>
                                  <td></td>
                                  <td>{{ ($booking_response->error->code=="INVALID_DATA")? "FAILED":strtoupper($booking_response->error->message) }}</td>
                                  <td>
                                    <div class="destination-col">
                                      <p>{{-- $booking_response->booking->hotel->name --}}</p>
                                      
                                    </div>
                                   </td> 
                                  <td> <p>{{-- $booking_response->booking->hotel->rooms[0]->rates[0]->net --}}</p> </td>     
                                  <td><a class="view-icon" href="{{ route('booking.view',$result['id']) }}"><i class="fa fa-eye"></i></a></td>
                                </tr>


                                @endif
                                @endforeach
                              @endif

                        

                              <tr>
                            </tr>

                          </tbody>
                        </table>
                        </div>
                      </div>
                  
                </div>
          
              </div>

          </div>
       </div>
      </div>
      <script type="text/javascript">
        
      </script>
      <!-- inner-middle-section -->     
  @endsection