@extends('backend.layouts.app')
@section('content')
<style>
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
.img-wraps {
    position: relative;
    display: inline-block;
    
    font-size: 0;
}
.img-wraps .closes {
    position: absolute;
    top: 5px;
    right: 8px;
    z-index: 100;
    background-color: #FFF;
    padding: 4px 3px;
     
    color: #000;
    font-weight: bold;
    cursor: pointer;
    
    text-align: center;
    font-size: 22px;
    line-height: 10px;
    border-radius: 50%;
    border:1px solid red;
}
.img-wraps:hover .closes {
    opacity: 1;
}
    </style>
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Destination Page Edit</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.destination.page')}}">Destinations Page List</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Destination Page Edit</li>
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
                              <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                  <a class="nav-link active" id="general-tab-tab" data-toggle="tab" href="#general-tab" role="tab" aria-controls="general-tab" aria-selected="true">General Information</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                  <a class="nav-link" id="image-tab-tab" data-toggle="tab" href="#image-tab" role="tab" aria-controls="image-tab" aria-selected="false">Images</a>
                                </li>
                              </ul>
                              <div class="tab-content">
                                <div class="tab-pane fade show active" id="general-tab" role="tabpanel" aria-labelledby="home-tab">
                                    <!-- form start -->
                                    {{ Form::model($destinationpage,['route' => ['admin.destination.page.update'], 'method' => 'post', 'id' => 'form']) }}
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
                                            <input type="hidden" name="id" value="{{$destinationpage->id}}"/>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="emailsubject">Destination<span
                                                            style="color: red;font-size:18px;"><b>*</b></span></label>
                                                            <select name="destination" class="form-control">
                                                                <option value=''>Select Country</option>
                                                                @foreach($country as $country)
                                                                <option @if($country->id==$destinationpage->destination) selected @else @endif value="{{$country->id}}">{{$country->name}}</option>
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
                                                    <label for="emailname">Destination Latitude<span
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
                                                    {{ Form::text('self_url', old('self_url'), ['class' => 'form-control', 'placeholder' => 'Enter Self Url', 'id' => 'logitude']) }}
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
                                                    <option @if($destinationpage->popular=='1') selected @else @endif  value='1'>Yes </option>
                                                    <option  @if($destinationpage->popular=='0') selected @else @endif value='0'>No</option>
                                            
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
                                                <input type="checkbox" class="custom-control-input" name="status" id="checkbox0" @if($destinationpage->status==1) checked @else @endif value="1">
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
                                                <input type="file" id="files" name="image[]" multiple  />
                                                @error('image')
                                                <p style="color:red;">{{ $message }}</p>
                                            @enderror
                                            </div>
                                            <br />
                                            @if(count($detinationimages)>0)
                                            <div class="row">
                                                <div class="col-sm-12">
                                            @foreach($detinationimages as $images)
                                            <div class="img-wraps">
                                            <span class="closes" onclick="confirmDeleteModal(@php echo $images->id; @endphp)" title="Delete">×</span>
                                            <img src="{{asset('public/backend/destination/'.$images->image)}}" style="width:150px;height:100px; border:2px solid black;">
                                            </div>
                                            @endforeach
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <input type="hidden" name="destination_id" value="{{$destinationpage->id}}" />
                                    
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
        </section>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script type="text/javascript">
        function confirmDeleteModal(id) {
            $('#deleteModal').modal();

            $('#deleteButton').html('<a class="btn btn-danger" style="color:white;" onclick="deleteData(' + id + ')">Delete</a>');

        }

        function deleteData(id) {
            location.replace("{{ route('admin.destination.image.delete') }}?id=" + id);
        }
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

    <script>
    
    $(document).ready(function() {
        var url = window.location.href;
        var activeTab = url.substring(url.indexOf("#") + 1);
        $('a[href="#'+ activeTab +'"]').tab('show')
        
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
