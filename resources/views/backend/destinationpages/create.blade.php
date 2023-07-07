@extends('backend.layouts.app')
@section('content')
<style>

    
    /* Style the tab */
    .tab {
      overflow: hidden;
      border: 1px solid #ccc;
      background-color: #f1f1f1;
    }
    
    /* Style the buttons inside the tab */
    .tab button {
      background-color: inherit;
      float: left;
      border: none;
      outline: none;
      cursor: pointer;
      padding: 14px 16px;
      transition: 0.3s;
      font-size: 17px;
    }
    
    /* Change background color of buttons on hover */
    .tab button:hover {
      background-color: #ddd;
    }
    
    /* Create an active/current tablink class */
    .tab button.active {
      background-color: #ccc;
    }
    
    /* Style the tab content */
    .tabcontent {
      display: none;
      padding: 6px 12px;
      border: 1px solid #ccc;
      border-top: none;
    }

    /* images */

    input[type="file"] {
  display: block;
}
.imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}

/* end images */
    </style>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Destination Page Create</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.destination.page')}}">Destination Pages</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Destination Page Create</li>
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
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <a class="nav-link active" id="general-tab-tab" data-toggle="tab" href="#general-tab" role="tab" aria-controls="general-tab" aria-selected="true">General Information</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <a class="nav-link" id="image-tab-tab" data-toggle="tab" href="#image-tab" role="tab" aria-controls="image-tab" aria-selected="false" style="cursor: not-allowed;
                                  pointer-events: none;">Images</a>
                                </li>
                              </ul>

                              <div class="tab-content">
                                <div class="tab-pane fade show active" id="general-tab" role="tabpanel" aria-labelledby="home-tab">
                                       
                            {{ Form::open(['route' => ['admin.destination.page.save'], 'method' => 'post', 'id' => 'form']) }}
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailname">Destination Name<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::text('name', old('name'), ['class' => 'form-control','pattern'=> "^[a-zA-Z_ ]*$", 'placeholder' => 'Enter Destination Name', 'id' => 'destination_name']) }}
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
                                                        <option value=''>Select Country</option>
                                                        @foreach($country as $country)
                                                         <option value="{{$country->id}}">{{$country->name}}</option>
                                                        @endforeach
                                                    </select>
                                            @error('destination')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailname">Destination Latitude <span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::text('latitude', old('latitude'), ['class' => 'form-control', 'placeholder' => 'Enter Latitude', 'id' => 'latitude']) }}
                                            @error('latitude')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Destination Longitude <span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::text('longitude', old('longitude'), ['class' => 'form-control', 'placeholder' => 'Enter Longitude', 'id' => 'logitude']) }}
                                            @error('longitude')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Short Description<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::textarea('short_descriptioin', old('short_descriptioin'), ['class' => 'form-control', 'placeholder' => 'Enter Short Description', 'id' => 'logitude']) }}
                                            @error('short_descriptioin')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Meta Description<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::textarea('meta_descriptioin', old('meta_descriptioin'), ['class' => 'form-control', 'placeholder' => 'Enter Meta Description', 'id' => 'logitude']) }}
                                            @error('meta_descriptioin')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Self Url<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                            {{ Form::text('self_url', old('self_url'), ['class' => 'form-control', 'placeholder' => 'Enter Self Url', 'id' => 'url']) }}
                                            @error('self_url')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                  
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="emailsubject">Popular<span
                                                    style="color: red;font-size:18px;"><b>*</b></span></label>
                                           <select name="popular" class="form-control">
                                               <option value='1'>Yes </option>
                                               <option value='0'>No</option>
                                      
                                           </select>
                                            @error('popular')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <div class="form-group">
                                                <label for="email_content">Description</label><span
                                                    style="color: red;font-size:18px;"><b>*</b></span><br />
                                                {{ Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Enter Description', 'id' => 'email_content']) }}
                                                @error('description')
                                                    <p style="color:red;">{{ $message }}</p>
                                                @enderror
                                            </div>
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
                                <a href="{{ route('admin.destination.page') }}" class="btn btn-secondary">Back</a>
                            </div>
                            {{ Form::close() }}
                              </div>
                              
                              <div class="tab-pane fade" id="image-tab" role="tabpanel" aria-labelledby="image-tab">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            {{ Form::open(['route' => ['admin.destination.images.update'], 'method' => 'post', 'id' => 'form', 'enctype'=> 'multipart/form-data']) }}
                                            <div class="field" align="left">
                                                <h3>Upload Destination images</h3>
                                                <input type="file" id="files" name="image[]" multiple />
                                            </div>
                                        </div>
                                       
                                    
                                    <div class="row">    
                                    <div class="card-body">
                                        <button type="submit" id="submitButton" class="btn btn-primary">Submit </button>
                                        <a href="{{ route('admin.destination.page') }}" class="btn btn-secondary">Back</a>
                                    </div>  
                                    </div>
                                            {{ Form::close() }}
                                      
                                </div>
                              </div>
                        </div>         
                        </div>
                        </div>
                    </div>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script>
        function checkfunction() {
            const textfield = CKEDITOR.instances['email_content'].getData();
            $('#email_content').validate()
        }
        CKEDITOR.replace("email_content");
        $("#form").submit(function(e) {
         
            
            var messageLength = CKEDITOR.instances['email_content'].getData().replace(/<[^>]*>/gi, '').length;
            if (!messageLength) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            }
        });
    </script>
      <script>
        $(document).ready(function() {
            $.validator.addMethod('latCoord', function(value, element) {
                console.log(this.optional(element))
                return this.optional(element) ||
                    value.length >= 4 && /^(?=.)-?((8[0-5]?)|([0-7]?[0-9]))?(?:\.[0-9]{1,20})?$/.test(
                    value);
            }, 'Your Latitude format has error.')

            $.validator.addMethod('longCoord', function(value, element) {
                console.log(this.optional(element))
                return this.optional(element) ||
                    value.length >= 4 &&
                    /^(?=.)-?((0?[8-9][0-9])|180|([0-1]?[0-7]?[0-9]))?(?:\.[0-9]{1,20})?$/.test(value);
            }, 'Your Longitude format has error.')
            $('#form').validate({
                rules: {
                    name: {
                        required: true,
                        maxlength: 100,
                    },
                    destination: {
                        required: true,
                        maxlength: 2000,
                    },
                    latitude: {
                        required: true,
                        maxlength: 100,
                   
                        latCoord: true
                    },
                    longitude: {
                        required: true,
                        maxlength: 100,
                        longCoord: true
                    },
                    short_descriptioin: {
                        required: true,
                        maxlength: 1000,
                    },
                    meta_descriptioin: {
                        required: true,
                        maxlength: 1000,
                    },

                    self_url: {
                        required: true,
                        maxlength: 100,
                       
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
    <script>
        function checkfunction() {
            const textfield = CKEDITOR.instances['email_content'].getData();
            $('#email_content').validate()
        }
        CKEDITOR.replace("email_content");
        $("#form").submit(function(e) {
            $("#submitButton").attr("disabled", true);
            
            var messageLength = CKEDITOR.instances['email_content'].getData().replace(/<[^>]*>/gi, '').length;
            if (!messageLength) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            }
        });
    </script>


<script>
    function openCity(evt, cityName) {
      var i, tabcontent, tablinks;
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
      }
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
      }
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
    
    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
<script>

$(document).ready(function() {
  if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
      for (var i = 0; i < filesLength; i++) {
        var f = files[i]
        var fileReader = new FileReader();
        fileReader.onload = (function(e) {
          var file = e.target;
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#files");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
          
          // Old code here
          /*$("<img></img>", {
            class: "imageThumb",
            src: e.target.result,
            title: file.name + " | Click to remove"
          }).insertAfter("#files").click(function(){$(this).remove();});*/
          
        });
        fileReader.readAsDataURL(f);
      }
      console.log(files);
    });
  } else {
    alert("Your browser doesn't support to File API")
  }
});
    </script>

@stop
