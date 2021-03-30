@if (auth()
        ->guard('user')
        ->user()
        ->hasRole('admin') ||
    auth()
        ->guard('user')
        ->user()
        ->hasRole('manager'))
    @if (auth()
        ->guard('user')
        ->user()
        ->hasRole('manager') &&
    auth()
        ->guard('user')
        ->user()->id != $created_by)
        <strong>you don't have permission</strong>
    @else
        @if ($banned_at == null)
            <form action="{{ route('users.ban', ['email' => $email]) }}" method="POST">
                @csrf
                <input type="submit" class="delete btn btn-danger btn-sm" value="Ban">
            </form>
        @else
            <form action="{{ route('users.unban', ['email' => $email]) }}" method="POST">
                @csrf
                <input type="submit" class="delete btn btn-warning btn-sm" value="Unban">
            </form>
        @endif
        <a href="{{ route('users.edit', ['user' => $id]) }}" class="edit btn btn-success btn-sm">Edit</a>
        <form action="{{ route('users.destroy', ['user' => $id]) }}" method="post">
            @csrf
            @method('DELETE')
            <input type="submit" class="delete btn btn-danger btn-sm" value="Delete" />
        </form>
    @endif
@endif
