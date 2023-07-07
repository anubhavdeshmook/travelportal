@extends('backend.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Destination Page View</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.destination')}}">Destinations List Page</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Destination Page View</li>
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
                            <a href="{{ route('admin.destination.page.edit', $destinationpage->id) }}"><button style="float: right;"
                                class="btn btn-primary"><i class="fas fa-edit"></i> Edit Destination Page</button></a>
                            </div>
                            <div class="card-body">
                                
                                <table id="example2" class="table table-hover">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $destinationpage->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Destination</th>
                                            <td>{{ $destinationpage->Country->name }}</td>
                                        </tr>

                                        <tr>
                                            <th>Short Descriptioin</th>
                                            <td>{{ $destinationpage->short_descriptioin }}</td>
                                        </tr>
                                        <tr>
                                            <th>Meta Description</th>
                                            <td>{{ $destinationpage->meta_descriptioin }}</td>
                                        </tr>
                                        <tr>
                                            <th>Popular</th>
                                            <td>{{ $destinationpage->popular ? 'yes':'no' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Self Url</th>
                                            <td>{{ $destinationpage->self_url }}</td>
                                        </tr>
                                        <tr>
                                            <th>Description</th>
                                            <td>{!! $destinationpage->description !!}</td>
                                        </tr>
                                      
                                    
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ $destinationpage->created_at->format(config('app.time')) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Updated At</th>
                                            <td>{{ $destinationpage->created_at->format(config('app.time')) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>@if ($destinationpage->status == 1) <span class="label label-success label-rounded">Active</span> @else <span class="label label-danger label-rounded">Inactive </span>@endif</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card-body">
                                    <a href="{{ route('admin.destination.page') }}"><button class="btn btn-secondary">Back</button></a>
                
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
