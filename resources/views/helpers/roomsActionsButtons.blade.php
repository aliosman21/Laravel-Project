@if(auth()->guard('user')->user()->hasRole('admin')||auth()->guard('user')->user()->hasRole('manager'))
    @if(auth()->guard('user')->user()->hasRole('manager') && auth()->guard('user')->user()->id!=$user_id)
        <strong>you don't have permission</strong>
    @else
        <a href="{{ route('rooms.edit',['room'=>$id]) }}" class="edit btn btn-success btn-sm">Edit</a>
        <form action="{{ route('rooms.destroy',['room' =>$id ]) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" class="delete btn btn-danger btn-sm" value="Delete" />
        </form>
    @endif
@endif


