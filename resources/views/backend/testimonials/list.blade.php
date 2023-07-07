@extends('backend.layouts.app')
@section('content')


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Testimonials</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Testimonials</li>
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
                    
                <div class="card">
        
           
                    <div class="card-body">
                        <a href="{{ route('admin.testimonials.create') }}"><button style="float: right;"
                            class="btn btn-primary"><i class="fas fa-plus"></i> Add New</button></a>
                        
                        <div class="form-inline">
                            {{ Form::open(['route' => ['admin.email.filter'], 'method' => 'get', 'id' => 'form']) }}                
                                <div class="input-group">
                                    {{ Form::text('search', app('request')->query('search'), ['class' => 'form-control', 'placeholder' => 'search']) }}
                                    <div class="input-group-append">
                                        <button class="btn btn-sidebar" type="submit"><i
                                                class="fas fa-search fa-fw"></i></button>
                                        <a href="{{ route('admin.email') }}" class="btn btn-Secondary" title="reload"><i
                                                class="fas fa-sync"></i> </a>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                        </div>
                        <br>
                        <table id="table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>S.N.</th>
                                    <th>@sortablelink ('name','Name')</th>      
                                    <th>Description</th>                               
                                    <th>@sortablelink ('created_at','Created At')</th>
                                    <th>@sortablelink ('updated_at','Updated At')</th>
                                    <th>@sortablelink ('status','Status')</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tablecontents">
                                @if(count($testimonials)>0)
                                @foreach ($testimonials as $key => $testimonial)
                                 
                                        <tr class="row1" data-id="{{ $testimonial->id }}">
                                        <td class="pl-3">{{++$key}}</td>
                                        <td>{{ $testimonial->name }}</td>
                                        <td>{{ $testimonial->description }}</td>
                                        <td>{{ $testimonial->created_at->format(config('app.time')) }}</td>
                                        <td>{{ $testimonial->updated_at->format(config('app.time')) }}</td>
                                        <td onclick="myFunction({{ $testimonial->id }}); ">@if ($testimonial->status == 1)<button class="btn btn-success"> <span >Active </span> </button> </a>@else  <button class="btn btn-danger"> <span >Inactive </span> </button> @endif
                                        </td>
                                        <td> <a href="{{ route('admin.testimonials.view', $testimonial->id) }}"><button
                                                    class="btn btn-warning" title="view"><i class="fas fa-eye"></i> 
                                                </button></a>
                                            <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}"><button
                                                    class="btn btn-success" title="edit"><i class="fas fa-edit"></i>
                                                </button></a></i></a></button> <button class="btn btn-danger" title="delete"
                                                onclick="confirmDeleteModal(@php echo $testimonial->id; @endphp)"><i
                                                    class="fas fa-trash"></i> </button>
                                        </td>
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
                    @if ($testimonials)
                    <div class="card-footer clearfix">
                        {{ $testimonials->links() }}
                    </div>
                @endif
                </div>
            </div>          
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
   
   
    <script type="text/javascript">
          $("#table").DataTable({searching: false, paging: false, info: false});
          
  
          $( "#tablecontents" ).sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.6,
            update: function() {
                sendOrderToServer();
            }
          });
  
          function sendOrderToServer() {
            var order = [];
            var token = $('meta[name="csrf-token"]').attr('content');
            $('tr.row1').each(function(index,element) {
              order.push({
                id: $(this).attr('data-id'),
                position: index+1
              });
            });
  
            $.ajax({
              type: "POST", 
              dataType: "json", 
              url: "{{ route('admin.testimonials.sortable') }}",
                  data: {
                order: order,
                _token: token
              },
              success: function(response) {
                  if (response.status == "success") {
                    
                  } else {
                    
                  }
              }
            });
          }
       
      </script>
   
   <script type="text/javascript">
        function confirmDeleteModal(id) {
            $('#deleteModal').modal();
            $('#deleteButton').html('<a class="btn btn-danger" style="color:white;" onclick="deleteData(' + id + ')">Delete</a>');

        }

        function deleteData(id) {
            location.replace("{{ route('admin.testimonials.delete') }}?id=" + id);
        }
    </script>
    {{-- end --}}

    {{-- change status --}}

    <script>
        function myFunction(id) {
            $('#statusModal').modal();
            $('#changestatus').html('<a class="btn btn-danger" style="color:white;" onclick="changedataData(' + id + ')">Ok</a>')
        }

        function changedataData(id) {
            location.replace("{{ route('admin.testimonials.changestatus') }}?id=" + id);
        }
    </script>
    {{-- end --}}


 
    
@stop
