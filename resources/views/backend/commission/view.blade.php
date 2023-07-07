@extends('backend.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">View Commission</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.commission')}}">Commissions</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">View Commission</li>
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
                            <div class="card-body">                  
                            <a href="{{ route('admin.commission.edit', $commision->id) }}"><button style="float: right;"
                                class="btn btn-primary"><i class="fas fa-edit"></i> Edit Destination</button></a>
                            </div>
                            <div class="card-body">
                                
                                <table id="example2" class="table table-hover">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $commision->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Destination</th>
                                            <td>{{ $commision->Country->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Mark Type</th>
                                            <td>{{ $commision->mark_type }}</td>
                                        </tr>
                                    
                                        <tr>
                                            <th>Amount/Percentage</th>
                                            <td>{{ $commision->amount }}</td>
                                        </tr>
                                        <tr>
                                            <th>Itinerary</th>
                                            <td>{{ $commision->itinerary }}</td>
                                        </tr>
                                    
                                        <tr>
                                            <th>Booking Date From</th>
                                            <td>{{ $commision->booking_date_from }}</td>
                                        </tr>
                                        <tr>
                                            <th>Booking Date To</th>
                                            <td>{{ $commision->booking_date_to }}</td>
                                        </tr>

                                        <tr>
                                            <th>Travel Date From</th>
                                            <td>{{ $commision->travel_date_from }}</td>
                                        </tr>
                                        <tr>
                                            <th>Travel Date To</th>
                                            <td>{{ $commision->travel_date_to }}</td>
                                        </tr>
                                    
                                        
                                        <tr>
                                            <th>Duration Date From</th>
                                            <td>{{ $commision->duration_days_from }}</td>
                                        </tr>
                                        <tr>
                                            <th>Duration Date To</th>
                                            <td>{{ $commision->duration_days_to }}</td>
                                        </tr>
                                    
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ $commision->created_at->format(config('app.time')) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Updated At</th>
                                            <td>{{ $commision->created_at->format(config('app.time')) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>@if ($commision->status == 1) <span class="label label-success label-rounded">Active</span> @else <span class="label label-rounded label-danger">Inactive </span>@endif</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card-body">
                                    <a href="{{ route('admin.commission') }}"><button class="btn btn-secondary">Back</button></a>
                
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
