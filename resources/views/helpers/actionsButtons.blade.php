
@if(auth()->guard('user')->user()->hasRole('admin'))
<a href="" class="edit btn btn-success btn-sm"><?php echo $role ; ?></a>
@else
<a href="" class="delete btn btn-danger btn-sm">Delete</a>
@endif


