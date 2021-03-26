
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"/>
    </head>
<body>
<div class="container mt-7">
    <table class="table table-bordered yajra-datatable">
        <thead>
            <tr>
                
                <th>Name</th>
                <th>Email</th>
                <th>NationalID</th>
                <th>Role</th>
                <th>Ban</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>
</body> 

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css"></link>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.material.min.css"></link>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-components-web/4.0.0/material-components-web.min.css"></link>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.material.min.css"></link>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<!-- <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.24/js/dataTables.material.min.js"></script>

<script type="text/javascript">
  $(function () {
    // $("table").addClass("mdl-data-table")
    // $(".mdl-data-table").css("padding","10px")
    // $(".container").css("margin-top","30px")
    var table = $('.yajra-datatable').DataTable({
        autoWidth: false,
        columnDefs: [
            {
                targets: ['_all'],
                className: 'mdc-data-table__cell'
            }
        ],
        processing: true,
        serverSide: true,
        ajax: "{{ route('users.list') }}",
        columns: [
            // {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'national_id', name: 'national_id'},
            {data: 'role', name: 'role'},
            {data: 'ban', name: 'ban'},
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