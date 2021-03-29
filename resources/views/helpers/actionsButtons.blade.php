
@if(auth()->guard('user')->user()->hasRole('admin')||auth()->guard('user')->user()->hasRole('manager'))
    @if(auth()->guard('user')->user()->hasRole('manager') && auth()->guard('user')->user()->id!=$created_by)
        <strong>you don't have permission</strong>
    @else
        @if($ban=='0')
            <a href="" class="delete btn btn-danger btn-sm">Ban</a>
        @else
            <a href="" class="delete btn btn-info btn-sm">Unban</a>
        @endif
        <a href="{{ route('users.edit',['user'=>$id]) }}" class="edit btn btn-success btn-sm">Edit</a>
        <form action="{{ route('users.destroy',['user' =>$id ]) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" class="delete btn btn-danger btn-sm" value="Delete" />
        </form>
    @endif
@endif


