@extends('backend.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Destination View</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.destination')}}">Destinations List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Destination View</li>
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
                            <a href="{{ route('admin.destination.edit', $destination->id) }}"><button style="float: right;"
                                class="btn btn-primary"><i class="fas fa-edit"></i> Edit Destination</button></a>
                            </div>
                            <div class="card-body">
                                
                                <table id="example2" class="table table-hover">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $destination->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Country</th>
                                            <td>{{ $destination->Country->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Latitude</th>
                                            <td>{{ $destination->latitude }}</td>
                                        </tr>
                                        <tr>
                                            <th>Logitude</th>
                                            <td>{{ $destination->longitude }}</td>
                                        </tr>
                                        <tr>
                                            <th>Popular</th>
                                            <td>{{ $destination->is_popular==1?'Yes':'No' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ $destination->created_at->format(config('app.time')) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Updated At</th>
                                            <td>{{ $destination->created_at->format(config('app.time')) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>@if ($destination->status == 1) <span class="label label-success label-rounded">Active</span> @else <span class="label label-danger label-rounded">Inactive </span>@endif</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card-body">
                                    <a href="{{ route('admin.destination') }}"><button class="btn btn-secondary">Back</button></a>
                
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
