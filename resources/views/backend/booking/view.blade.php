@extends('backend.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Booking View</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.booking')}}">Booking List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Booking View</li>
                    </ol>   
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">    
                            @php
                            $stripeTransId = $bookings['stripe_trans_id'];
                            $booking = json_decode($bookings['booking_response']);                            
                            @endphp
                            <!-- <div class="card-body">                  
                            <a href=""><button style="float: right;"
                                class="btn btn-primary"><i class="fas fa-edit"></i> Edit Destination</button></a>
                            </div> -->
                            <div class="card-body">
                                
                                <table id="example2" class="table table-hover">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Reference</th>
                                            <td>{{ $booking->booking->clientReference }}</td>
                                        </tr>
                                        <tr>
                                            <th>Hotel Name</th>
                                            <td>{{ $booking->booking->hotel->name }},
                                                {{ $booking->booking->hotel->zoneName }}</td>
                                        </tr>
                                        <tr>    
                                            <th>Hotel Category</th>
                                            <td>{{$booking->booking->hotel->categoryName}}</td>
                                        </tr>
                                        <tr>
                                            <th>Code</th>
                                            <td>{{ $booking->booking->hotel->code }}</td>
                                        </tr>
                                        <tr>
                                            <th>Check In</th>
                                            <td>{{ $booking->booking->hotel->checkIn }}</td>
                                        </tr>
                                        <tr>
                                            <th>Check Out</th>
                                            <td>{{ $booking->booking->hotel->checkOut }}</td>
                                        </tr>
                                        <tr>
                                            <th>Room Type</th>
                                            <td>{{ $booking->booking->hotel->rooms[0]->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Rooms Booked</th>
                                            <td>{{ $booking->booking->hotel->rooms[0]->rates[0]->rooms }}</td>
                                        </tr>
                                        <tr>
                                            <th>Adults </th>
                                            <td>{{ $booking->booking->hotel->rooms[0]->rates[0]->adults }}</td>
                                        </tr>
                                        <tr>
                                            <th>Children </th>
                                            <td>{{ $booking->booking->hotel->rooms[0]->rates[0]->children }}</td>
                                        </tr>
                                        <tr>
                                            <th>Net Price</th>
                                            <td>{{ $booking->booking->hotel->rooms[0]->rates[0]->net }}</td>
                                        </tr>
                                        <tr>
                                            <th>Transaction ID</th>
                                            <td><a href="">{{ $stripeTransId }}</a></td>
                                        </tr>
                                        <tr>
                                            <th>Destination Name</th>
                                            <td>{{ $booking->booking->hotel->destinationName }}</td>
                                        </tr>
                                        <tr>
                                            <th>Room Type</th>
                                            <td>{{ $booking->booking->hotel->rooms[0]->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>{{ $booking->booking->status }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card-body">
                                    <a href="{{ route('admin.booking') }}"><button class="btn btn-secondary">Back</button></a>
                
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                   
                </div>
           
            </div>
    </div>
    </div>
    </div>
    </div>
    </section>
    </div>


@stop
