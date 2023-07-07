@extends('backend.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Edit Commission</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.offers')}}">Commission</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Commission</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
   
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @if (session('status'))

                        <div class="alert alert-success alert-dismissible fade show" role="alert"><i
                                class="far fa-check-circle"></i>
                            <strong>Congratulations !!</strong> {{ session('status') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif                
                    <div class="col-md-12">   
                        <div class="card card-primary">
                          
                            <!-- form start -->
                            {{ Form::model($commision,['route' => ['admin.commission.update'], 'method' => 'post', 'id' => 'form']) }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailname">Commission Name<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::text('name', old('name'), ['class' => 'form-control', 'pattern'=> "^[a-zA-Z_ ]*$", 'placeholder' => 'Enter Destination Name', 'id' => 'destination_name']) }}
                                            @error('name')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Destination<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                          <select name="destination" class="form-control">
                                               <option value=''>Select Destination</option>
                                               @foreach($destinations as $destination)
                                                <option @if($commision->destination==$destination->id) selected @else @endif value="{{$destination->id}}">{{$destination->name}}</option>
                                               @endforeach
                                           </select>
                                            @error('destination')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                 <input type="hidden" name="id" value="{{$commision->id}}"/>
                                    <!-- /.card-body -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailname">Mark Type<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                             <select name="mark_type" class="form-control">
                                               <option  value=''>Select Type</option>                                              
                                                <option @if($commision->mark_type=='Fixed') selected @else @endif value="Fixed">Fixed</option>    
                                                <option @if($commision->mark_type=='Not Fixed') selected @else @endif value="Not Fixed">Not Fixed</option>                                            
                                           </select>
                                            @error('mark_type')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Itinerary<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                             <select name="itinerary" class="form-control">
                                               <option value=''>Select itinerary</option>                                              
                                                <option @if($commision->itinerary=='Hotel') selected @else @endif value="Hotel">Hotel</option>
                                                <option @if($commision->itinerary=='Flight') selected @else @endif value="Flight">Flight</option>
                                                <option @if($commision->itinerary=='GuestHouse') selected @else @endif value="GuestHouse">GuestHouse</option>                                           
                                           </select>
                                            @error('destination')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Amount<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::text('amount', old('amount'), ['class' => 'form-control', 'placeholder' => 'Enter Amount', 'id' => 'amount']) }}
                                            @error('amount')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                             
                                  
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Booking Date From<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                                {{ Form::date('booking_date_from', old('booking_date_from'), ['class' => 'form-control', 'placeholder' => 'Enter Booking Date From', 'id' => 'my_date_picker']) }}
                                            @error('booking_date_from')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Booking Date To<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                                {{ Form::date('booking_date_to', old('booking_date_to'), ['class' => 'form-control', 'placeholder' => 'Enter Booking Date To', 'id' => 'my_date_picker']) }}
                                            @error('booking_date_to')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Travel Date From<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                                {{ Form::date('travel_date_from', old('booking_date_from'), ['class' => 'form-control', 'placeholder' => 'Enter Travel Date From', 'id' => 'my_date_picker']) }}
                                            @error('travel_date_from')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Travel Date To<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                                {{ Form::date('travel_date_to', old('travel_date_to'), ['class' => 'form-control', 'placeholder' => 'Enter Travel Date To', 'id' => 'my_date_picker']) }}
                                            @error('travel_date_to')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Duration Date From<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                                {{ Form::date('duration_days_from', old('booking_date_from'), ['class' => 'form-control', 'placeholder' => 'Enter Duration Days From', 'id' => 'my_date_picker']) }}
                                            @error('duration_date_from')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Duration Date To<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                                {{ Form::date('duration_days_to', old('travel_date_to'), ['class' => 'form-control', 'placeholder' => 'Enter Duration Days To', 'id' => 'my_date_picker']) }}
                                            @error('duration_date_to')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                    <div class="custom-control custom-checkbox mr-sm-2 m-b-15">
                                        <input type="checkbox" class="custom-control-input" name="status" id="checkbox0" @if($commision->status==1) checked @else @endif value="1">
                                        <label class="custom-control-label"  for="checkbox0">Is Active </label>
                                    </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="card-body">
                                <button type="submit" id="submitButton" class="btn btn-primary">Submit </button>
                                <a href="{{ route('admin.commission') }}" class="btn btn-secondary">Back</a>
                            </div>
                            {{ Form::close() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            $('#form').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 100,
    
                    },
                    destination: {
                        required: true,
                        maxlength: 100,
    
                    },
                    mark_type: {
                        required: true,
    
    
                    },
                    amount: {
                        required: true,
                        maxlength: 100,
    
                    },
                       
                    itinerary: {
                        required: true,
                        maxlength: 100,
    
                    },
                    booking_date_from: {
                        required: true,
    
    
                    },
                    booking_date_to: {
                        required: true,
                       
    
                    },
                    travel_date_from: {
                        required: true,
                      
    
                    },
                    travel_date_to: {
                        required: true,                
    
                    },
                    duration_days_from: {
                        required: true,
                      
    
                    },
                    duration_days_to: {
                        required: true,                
    
                    },
                
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
    <!-- /.close -->

    <!-- /.ckeditior -->
    <script>
        function checkfunction() {
            const textfield = CKEDITOR.instances['email_content'].getData();

            $('#email_content').validate()
        }

        CKEDITOR.replace("email_content");
        $("form").submit(function(e) {
            var messageLength = CKEDITOR.instances['email_content'].getData().replace(/<[^>]*>/gi, '').length;
            if (!messageLength) {

                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            }
        });
    </script>
    <!-- /.close -->
@stop
