
        <a href="{{ route('users.approveClient',['client'=> $id]) }}" class="edit btn btn-success btn-sm">approve</a>

        <form method="post" action="{{ route('users.unapproveClient',['client' => $id]) }}">
            @csrf
            @method('DELETE')
            <input type="submit" class="delete btn btn-danger btn-sm" value="Delete" />
        </form>



