@extends('backend.layouts.app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" integrity="sha512-mSYUmp1HYZDFaVKK//63EcZq4iFWFjxSL+Z3T/aCt4IO9Cejm03q3NKKYN6pFQzY0SBOr8h+eCIAZHPXcpZaNw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Offer Create</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.offers')}}">Offers</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Offer Create</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

    <div class="container-fluid">
                <div class="row">
              
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                         
                            {{ Form::open(['route' => ['admin.offers.save'], 'method' => 'post', 'id' => 'form']) }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailname">Offer Name<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::text('name', old('name'), ['class' => 'form-control','pattern'=> "^[a-zA-Z_ ]*$", 'placeholder' => 'Enter Offer Name', 'id' => 'destination_name']) }}
                                            @error('name')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Offer Code<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::text('offer_code', old('offer_code'), ['class' => 'form-control', 'placeholder' => 'Enter Offer Code', 'id' => 'offer_code']) }}
                                            @error('offer_code')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailname">Offer Type<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                             <select name="offer_type" class="form-control">
                                               <option value=''>Select Offer Type</option>                                              
                                                <option value="Fixed">Fixed</option>    
                                                <option value="Not Fixed">Not Fixed</option>                                            
                                           </select>
                                            @error('offer_type')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Amount/ Percentage<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::text('amount', old('amount'), ['class' => 'form-control', 'placeholder' => 'Enter Amount', 'id' => 'amount']) }}
                                            @error('amount')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Destination<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                          <select name="destination_id" class="form-control">
                                               <option value=''>Select Destination</option>
                                               @foreach($destinations as $destination)
                                                <option value="{{$destination->id}}">{{$destination->name}}</option>
                                               @endforeach
                                           </select>
                                            @error('destination_id')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Itinerary<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                             <select name="itinerary" class="form-control">
                                               <option value=''>Select Itinerary</option>                                              
                                                <option value="Hotel">Hotel</option>
                                                <option value="Flight">Flight</option>
                                                <option value="GuestHouse">GuestHouse</option>                                           
                                           </select>
                                            @error('destination')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Booking Date From<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                                {{ Form::date('booking_date_from', old('booking_date_from'), ['class' => 'startDate form-control', 'placeholder' => 'Enter Booking Date From', 'id' => 'my_date_picker']) }}
                                            @error('booking_date_from')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Booking Date To<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                                {{ Form::date('booking_date_to', old('booking_date_to'), ['class' => 'endDate form-control', 'placeholder' => 'Enter Booking Date To', 'id' => 'my_date_picker']) }}
                                            @error('booking_date_to')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Travel Date From<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                                {{ Form::date('travel_date_from', old('booking_date_from'), ['class' => 'starttavelDate form-control', 'placeholder' => 'Enter Travel Date From', 'id' => 'my_date_picker']) }}
                                            @error('travel_date_from')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Travel Date To<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                                {{ Form::date('travel_date_to', old('travel_date_to'), ['class' => 'endtavelDate form-control', 'placeholder' => 'Enter Booking Date To', 'id' => 'my_date_picker']) }}
                                            @error('travel_date_to')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                    <div class="custom-control custom-checkbox mr-sm-2 m-b-15">
                                        <input type="checkbox" class="custom-control-input" name="status" id="checkbox0" value="1">
                                        <label class="custom-control-label"  for="checkbox0">Is Active </label>
                                    </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            <div class="card-body">
                                <button type="submit" id="submitButton" class="btn btn-primary">Submit </button>
                                <a href="{{ route('admin.email') }}" class="btn btn-secondary">Back</a>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js" integrity="sha512-T/tUfKSV1bihCnd+MxKD0Hm1uBBroVYBOYSk1knyvQ9VyZJpc/ALb4P0r6ubwVPSGB2GvjeoMAJJImBG12TiaQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


   
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>

<!-- /.validation  -->
<script>
    $(document).ready(function() {
        $.validator.addMethod("endDate", function(value, element) {
            let startDate = $('.startDate').val();
            return Date.parse(startDate) < Date.parse(value) || value == "";
        }, "* End date must be after start date");

        $.validator.addMethod("endtavelDate", function(value, element) {
            let starttravelDate = $('.starttavelDate').val();
           
            return Date.parse(starttravelDate) < Date.parse(value) || value == "";
        }, "* End date must be after start date");
        $('#form').validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 100,

                },
                offer_code: {
                    required: true,
                    maxlength: 100,

                },
                offer_type: {
                    required: true,


                },
                amount: {
                    required: true,
                    maxlength: 100,

                },
                destination_id: {
                    required: true,
                

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
                    endDate:true,
                   

                },
                travel_date_from: {
                    required: true,
                  

                },
                travel_date_to: {
                    required: true, 
                    endtavelDate:true,               

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




<script type="text/javascript">
    $('.date').datepicker({  
       format: 'dd-mm-yyyy'
     });  
</script>


@stop
