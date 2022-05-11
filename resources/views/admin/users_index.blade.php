<x-admin-layout>

    <x-slot name="title">
        Admin | Blog Users
    </x-slot>


    @if (session('delete'))
    <div class="alert alert-warning text-center">
        {{session('delete')}}
    </div>
    @endif

    <table class="table table-light table-striped">
        <thead>
            @if ($users->count())
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Username</th>
                <th scope="col">Eamil</th>
                <th scope="col" colspan="3" class="text-center">Action</th>
            </tr>
            @endif
        </thead>
        <tbody>
            @forelse ($users as $user)
            <tr>
                <th scope="row">{{$user->id}}</th>
                <td>{{$user->name}}</td>
                <td>{{$user->username}}</td>
                <td>{{$user->email}}</td>

                @if ($user->is_admin)
                <td><button class="btn btn-sm btn-warning">Admin</button></td>
                @else
                <td><button class="btn btn-sm btn-primary">user</button></td>
                @endif

                <td>
                    <form action="/admin/user/{{$user->username}}/delete" method="POST">@csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <p class="text-center p-5">Empty Users</p>
            @endforelse
        </tbody>
    </table>
</x-admin-layout>
