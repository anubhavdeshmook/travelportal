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

<div class="inner-middle-section">
<div class="container">
<div class="flight-detail-main light-shadow-box padd-30">
<div class="container-fluid">
<section class="content">
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="card">    
@php
$booking = json_decode($bookings['booking_response']);                            
@endphp
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
<th>Payment Type</th>
<td>{{ $booking->booking->hotel->rooms[0]->rates[0]->paymentType }}</td>
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
<a href="{{ route('my-bookings') }}"><button class="btn btn-secondary">Back</button></a>

</div>
</div>
</div>
</div></div></div>
</section>
</div>
</div>
</div>
</div>

@endsection