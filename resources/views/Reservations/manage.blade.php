@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')    
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                <th>client_id</th>
                <th>accompany_number</th>
                <th>price</th>
                <th>room_id</th>
                
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
         
            var table = $('.yajra-datatable').DataTable({
                autoWidth: false,
                columnDefs: [{
                    targets: ['_all'],
                    className: 'mdc-data-table__cell'
                }],
                processing: true,
                serverSide: true,
                ajax: "{{ route('reservations.list.ajax') }}",
                columns: [
                   
                    {
                        data: 'client_id',
                        name: 'client_id'
                    },
                    {
                        data: 'accompany_number',
                        name: 'accompany_number'
                    },
                    
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'room_id',
                        name: 'room_id'
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
