@extends('backend.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Email Templates</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.dashboard')}}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Email Templates</li>
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
                    
                <div class="card">
        
           
                    <div class="card-body">
                        <a href="{{ route('admin.email.create') }}"><button style="float: right;"
                            class="btn btn-primary"><i class="fas fa-plus"></i> Add New</button></a>
                        
                        <div class="form-inline">
                            {{ Form::open(['route' => ['admin.email.filter'], 'method' => 'get', 'id' => 'form']) }}                
                                <div class="input-group">
                                    {{ Form::text('search', app('request')->query('search'), ['class' => 'form-control', 'placeholder' => 'search']) }}
                                    <div class="input-group-append">
                                        <button class="btn btn-sidebar" type="submit"><i
                                                class="fas fa-search fa-fw"></i></button>
                                        <a href="{{ route('admin.email') }}" title="reload" class="btn btn-Secondary"><i
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
                                    <th>@sortablelink ('subject','Subject')</th>
                                    <th>@sortablelink ('created_at','Created At')</th>
                                    <th>@sortablelink ('updated_at','Updated At')</th>
                                    <th>@sortablelink ('status','Status')</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($emails)>0)
                                @foreach ($emails as $key => $email)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $email->name }}</td>
                                        <td>{{ $email->subject }}</td>
                                        <td>{{ $email->created_at->format(config('app.time')) }}</td>
                                        <td>{{ $email->updated_at->format(config('app.time')) }}</td>
                                        <td onclick="myFunction({{ $email->id }}); ">@if ($email->status == 1)<button class="btn btn-success"> <span >Active </span> </button> </a>@else  <button class="btn btn-danger"> <span >Inactive </span> </button> @endif
                                        </td>
                                        <td> <a href="{{ route('admin.email.view', $email->id) }}"><button
                                                    class="btn btn-warning" title="view"><i class="fas fa-eye"></i> 
                                                </button></a>
                                            <a href="{{ route('admin.email.edit', $email->id) }}"><button
                                                    class="btn btn-success" title="edit"><i class="fas fa-edit"></i>
                                                </button></a></i></a></button> <button class="btn btn-danger" title="delete"
                                                onclick="confirmDeleteModal(@php echo $email->id; @endphp)"><i
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
                    @if ($emails)
                        <div class="card-footer clearfix">
                            {{ $emails->links() }}
                        </div>
                    @endif
                </div>
            </div>          
        </section>
    </div>


    {{-- Delete model --}}
    <script type="text/javascript">
        function confirmDeleteModal(id) {
            $('#deleteModal').modal();
            $('#deleteButton').html('<a class="btn btn-danger" style="color:white;" onclick="deleteData(' + id + ')">Delete</a>');

        }

        function deleteData(id) {
            location.replace("{{ route('admin.email.delete') }}?id=" + id);
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
            location.replace("{{ route('admin.email.changestatus') }}?id=" + id);
        }
    </script>
    {{-- end --}}
@stop
