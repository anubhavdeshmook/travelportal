@extends('backend.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Booking List</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Booking List</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div id="deleteModal" class="modal fade" role='dialog'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Do You Really Want to Delete This ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <span id='deleteButton'></span>
                </div>

            </div>
        </div>
    </div>
    {{-- Status model --}}

    <div id="statusModal" class="modal fade" role='dialog'>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Do You Really Want to Change Status ?</p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <span id='changestatus'></span>
                </div>
            </div>
        </div>
    </div>
    {{-- end --}}

    <div class="content-wrapper">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"><i class="far fa-check-circle"></i>
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

      

        <section class="content">
            
                <div class="row">                    
                    <div class="col-12">
                        <div class="card">       
                            <div class="card-body">
                              
                                <div class="form-inline">
                                    {{ Form::open(['route' => ['admin.booking.filter'], 'method' => 'get', 'id' => 'form']) }}                
                                       <div class="input-group">
                                            {{ Form::text('search', app('request')->query('search'), ['class' => 'form-control', 'placeholder' => 'search name']) }}
                                            <div class="input-group-append">
                                                <button class="btn btn-sidebar" type="submit"><i
                                                        class="fas fa-search fa-fw"></i></button>
                                                <a href="{{ route('admin.booking') }}" title="reload" class="btn btn-Secondary"><i
                                                        class="fas fa-sync"></i> </a>
                                            </div>
                                            {{ Form::close() }}
                                        </div>
                                </div>
                                <br>
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th> Name</th>
                                            <th> CheckIn</th>
                                            <th> CheckOut</th>
                                            <th> Hotel</th>
                                            <th> Destination</th>
                                            <th> Room Type</th>
                                            <th> Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @dd($bookings) --}}
                                    @if(isset($bookings) && count($bookings)>0)
                                       @php $i = 1; @endphp
                                        @foreach ($bookings as $key => $booking)
                                        @php
                                        $user_name = DB::table('users')->where('id', $booking['user_id'])->first()->name;    
                                        $bookingresponse = json_decode($booking['booking_response']);
                                        @endphp
                                            <tr>
                                               @if(isset($bookingresponse->booking)) 
                                                <td>{{ $i++ }}</td>
                                                <td>{{$user_name}}</td>
                                                <td>{{ $bookingresponse->booking->hotel->checkIn }}</td>
                                                <td>{{ $bookingresponse->booking->hotel->checkOut }}</td>
                                                <td>{{ $bookingresponse->booking->hotel->name }}</td>
                                                <td>{{ $bookingresponse->booking->hotel->destinationName }}</td>
                                                <td>{{ $bookingresponse->booking->hotel->rooms[0]->name }}</td>
                                                <td>{{ $bookingresponse->booking->status }}</td>
                                                <td>  <a href="{{ route('admin.booking.view', $booking['id']) }}"><button
                                                            class="btn btn-warning" title="view"><i class="fas fa-eye"></i>
                                                        </button></a>
                                                     
                                                </td>
                                            @else    
                                            <td>{{ $i++ }}</td>
                                                <td>{{$user_name}}</td>
                                                <td>{{-- $bookingresponse->booking->hotel->checkIn --}}</td>
                                                <td>{{-- $bookingresponse->booking->hotel->checkOut --}}</td>
                                                <td>{{-- $bookingresponse->booking->hotel->name --}}</td>
                                                <td>{{-- $bookingresponse->booking->hotel->destinationName --}}</td>
                                                <td>{{-- $bookingresponse->booking->hotel->rooms[0]->name --}}</td>
                                                <td>{{ ($bookingresponse->error->code=="INVALID_DATA")? "FAILED":strtoupper($bookingresponse->error->message) }}</td>
                                                <td>  <a href="{{-- route('admin.booking.view', $booking['id']) --}}"><button
                                                            class="btn btn-warning" title="view"><i class="fas fa-eye"></i>
                                                        </button></a>
                                                     
                                                </td>       
                                            @endif
                                            </tr>
                                        @endforeach
                                        @else
                                        <tr>
                                            <td colspan="12">
                                                <h6><center>No Record Found </center> </h6> 
                                            </td>
                                        </tr>                                    
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            @if($bookings)
                                <div class="card-footer clearfix">
                                    {{ $bookings->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
        </section>
    </div>
</div>
</div> 
@stop
