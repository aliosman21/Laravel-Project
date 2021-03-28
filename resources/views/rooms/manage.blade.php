@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    {{dd($rooms,$users)}}

    <table class="table table-bordered yajra-datatable">
        <thead>
        <tr>
            <th>Name</th>
            <th>Number</th>
            <th>Status</th>
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
            // $("table").addClass("mdl-data-table")
            // $(".mdl-data-table").css("padding","10px")
            // $(".container").css("margin-top","30px")
            var table = $('.yajra-datatable').DataTable({
                autoWidth: false,
                columnDefs: [{
                    targets: ['_all'],
                    className: 'mdc-data-table__cell'
                }],
                processing: true,
                serverSide: true,
                ajax: "{{ route('floors.index') }}",
                columns: [
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'number',
                        name: 'id'
                    },
                    {
                        data: 'status',
                        name: 'reserved'
                    },
                    {
                        data: '',
                        name: 'created'
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
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.material.min.js"></script>
@stop
