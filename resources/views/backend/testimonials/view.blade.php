@extends('backend.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Testimonial View</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.testimonials')}}">Testimonials</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Testimonial View</li>
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
                            <a href="{{ route('admin.email.edit', $testimonials->id) }}"><button style="float: right;"
                                class="btn btn-primary"><i class="fas fa-edit"></i> Edit Email</button></a>
                            </div>
                            <div class="card-body">
                                
                                <table id="example2" class="table table-hover">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>User Name</th>
                                            <td>{{ $testimonials->name }}</td>
                                        </tr>
                                       
                                        <tr>
                                            <th>Description</th>
                                            <td>{{ $testimonials->description }}</td>
                                        </tr>
                                        <tr>
                                            <th>Order No</th>
                                            <td>{{ $testimonials->order }}</td>
                                        </tr>
                                        <tr>
                                            <th>Created At</th>
                                            <td>{{ $testimonials->created_at->format(config('app.time')) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Updated At</th>
                                            <td>{{ $testimonials->created_at->format(config('app.time')) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>@if ($testimonials->status == 1) <span class="label label-success label-rounded">Active</span> @else <span class="label label-danger label-rounded">Inactive </span>@endif</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-actions">
                                <div class="card-body">
                                    <a href="{{ route('admin.testimonials') }}"><button class="btn btn-secondary">Back</button></a>
                
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
    </div>
    </section>
    </div>


@stop
