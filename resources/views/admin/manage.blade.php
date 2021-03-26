


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
@foreach($users as $user)
{{$user}}
@endforeach

<script type="text/javascript">
  $(function () {
    $("table").addClass("mdl-data-table")
    $(".mdl-data-table").css("padding","10px")
    $(".container").css("margin-top","30px")
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
        ajax: "{{ route('users.index') }}",
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