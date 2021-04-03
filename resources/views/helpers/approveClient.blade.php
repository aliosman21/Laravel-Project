
        <a href="{{ route('users.approveClient',['client'=> $id]) }}" class="edit btn btn-success btn-sm">approve</a>

        <form method="post" action="{{ route('users.unapproveClient',['client' => $id]) }}" onsubmit="return confirm('Do you really want to delete ?');">
            @csrf
            @method('DELETE')
            <input type="submit" class="delete btn btn-danger btn-sm" value="Delete" />
        </form>



