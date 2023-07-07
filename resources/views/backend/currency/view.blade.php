@extends('backend.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Currency View</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.currency')}}">Currencies List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Currency View</li>
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
                            <a href="{{ route('admin.currency.edit', $currency->id) }}"><button style="float: right;"
                                class="btn btn-primary"><i class="fas fa-edit"></i> Edit Currency</button></a>
                            </div>
                            <div class="card-body">
                                
                                <table id="example2" class="table table-hover">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>Name</th>
                                            <td>{{ $currency->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Code</th>
                                            <td>{{ $currency->code}}</td>
                                        </tr>
                                        <tr>
                                            <th>Exchange Rate</th>
                                            <td>{{ $currency->exchange_rate}}</td>
                                        </tr>
                                        <tr>
                                            <th>Current Rate</th>
                                            <td>{{ $currency->current_rate}}</td>
                                        </tr>
                                        <tr>
                                            <th>Sign</th>
                                            <td>{{ $currency->sign}}</td>
                                        </tr>
                                    
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ $currency->created_at->format(config('app.time')) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Updated At</th>
                                            <td>{{ $currency->created_at->format(config('app.time')) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>@if ($currency->status == 1) <span class="badge bg-success" style="color: white;">Active</span> @else <span class="badge bg-danger" style="color: white;">Inactive </span>@endif</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="card-body">
                                    <a href="{{ route('admin.currency') }}"><button class="btn btn-secondary">Back</button></a>
                
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
