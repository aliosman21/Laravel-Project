@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @if(isset($msg))
        <div class="alert alert-danger">
            {{ $msg }}
        </div>
    @endif
@if(auth()->guard('user')->user()->hasRole('admin')||auth()->guard('user')->user()->hasRole('manager'))
        <a href="{{ route('rooms.create') }}" class="edit btn btn-success btn-block">Create room</a>
        <br/>

@endif

    <table class="table table-bordered yajra-datatable">
        <thead>
        <tr>
            <th>Room number</th>
            <th>capacity</th>
            <th>Price</th>
            <th>floor number</th>
            <th>Created by</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css">
    </link>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.material.min.css">
    </link>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css">
    </link>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.material.min.css">
    </link>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
@stop

@section('js')
    <script type="text/javascript">
        $(function() {
            var php_var = "{{ auth()->guard('user')->user()->hasRole('manager') ||  auth()->guard('user')->user()->hasRole('receptionist')}}";
            
            var table = $('.yajra-datatable').DataTable({
                autoWidth: false,
                columnDefs: [{
                    targets: ['_all'],
                    className: 'mdc-data-table__cell'
                }],
                processing: true,
                serverSide: true,
                ajax: "{{ route('rooms.list') }}",
                columns: [
                    {
                        data: 'number',
                        name: 'number'
                    },
                    {
                        data: 'capacity',
                        name: 'capacity'
                    },
                    {
                        data: 'RealPrice',
                        name: 'RealPrice'
                    },
                    {
                        data: 'floorNumber',
                        name: 'floorNumber'
                    },
                    {
                        data: 'user_id',
                        name: 'user_id',
                        render: function (data, type, row) {
                            if (php_var) {
                                return 'you dont have permission';    
                            }else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });


        });

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
@stop
