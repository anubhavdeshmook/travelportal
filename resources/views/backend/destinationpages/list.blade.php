@extends('backend.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Destinations Page List</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Destinations Page List</li>
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
    {{-- Status model --}}

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
    {{-- end --}}

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
                <div class="row">                    
                    <div class="col-12">
                        <div class="card">       
                            <div class="card-body">
                                <a href="{{ route('admin.destination.page.create') }}"><button style="float: right;"
                                    class="btn btn-primary"><i class="fas fa-plus"></i> Add New</button></a>
                                <div class="form-inline">
                                    {{ Form::open(['route' => ['admin.destination.page.filter'], 'method' => 'get', 'id' => 'form']) }}                
                                       <div class="input-group">
                                            {{ Form::text('search', app('request')->query('search'), ['class' => 'form-control', 'placeholder' => 'search name']) }}
                                            <div class="input-group-append">
                                                <button class="btn btn-sidebar" type="submit"><i
                                                        class="fas fa-search fa-fw"></i></button>
                                                <a href="{{ route('admin.destination.page') }}" title="reload" class="btn btn-Secondary"><i
                                                        class="fas fa-sync"></i> </a>
                                            </div>
                                            {{ Form::close() }}
                                        </div>
                                </div>
                                <br>
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.N.</th>
                                            <th>@sortablelink ('name','Name')</th>
                                            <th>@sortablelink ('destination','Destination')</th>
                                            <th>@sortablelink ('created_at','Created At')</th>
                                            <th>@sortablelink ('updated_at','Updated At')</th>
                                            <th>@sortablelink ('status','Status')</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if(count($destinationpages)>0)
                                        @foreach ($destinationpages as $key => $destinationpage)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $destinationpage->name }}</td>
                                                <td>@if(isset($destinationpage->Country->name)){{ $destinationpage->Country->name   }} @else @endif</td>
                                                <td>{{ $destinationpage->created_at->format(config('app.time')) }}</td>
                                                <td>{{ $destinationpage->updated_at->format(config('app.time')) }}</td>
                                                <td onclick="myFunction({{ $destinationpage->id }}); ">@if ($destinationpage->status == 1)<button class="btn btn-success"> <span >Active </span> </button> </a>@else  <button class="btn btn-danger"> <span >Inactive </span> </button> @endif
                                                </td>
                                                <td> <a href="{{ route('admin.destination.page.view', $destinationpage->id) }}"><button
                                                            class="btn btn-warning" title="view"><i class="fas fa-eye"></i>
                                                        </button></a>
                                                    <a href="{{ route('admin.destination.page.edit', $destinationpage->id) }}"><button
                                                            class="btn btn-success" title="edit"><i class="fas fa-edit"></i>
                                                        </button></a></i></a></button> <button class="btn btn-danger" title="delete"
                                                        onclick="confirmDeleteModal(@php echo $destinationpage->id; @endphp)"><i
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
                            @if ($destinationpages)
                                <div class="card-footer clearfix">
                                    {{ $destinationpages->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
          
     
        </section>
    </div>
</div>
</div> 

    {{-- Delete model --}}
    <script type="text/javascript">
        function confirmDeleteModal(id) {
            $('#deleteModal').modal();
            $('#deleteButton').html('<a class="btn btn-danger" style="color:white;" onclick="deleteData(' + id + ')">Delete</a>');

        }

        function deleteData(id) {
            location.replace("{{ route('admin.destination.page.delete') }}?id=" + id);
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
            location.replace("{{ route('admin.destination.page.changestatus') }}?id=" + id);
        }
    </script>
    {{-- end --}}
@stop
