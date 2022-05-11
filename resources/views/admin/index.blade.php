<x-admin-layout>

    <x-slot name="title">
        Admin | Dashboard
    </x-slot>

    @if (session('delete'))
    <div class="alert alert-warning text-center">
        {{session('delete')}}
    </div>
    @endif

    @if (session('publish'))
    <div class="alert alert-warning text-center">
        {{session('publish')}}
    </div>
    @endif

    <table class="table table-light table-striped">
        <thead>
            @if ($blogs->count())
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Intro</th>
                <th scope="col" colspan="3" class="text-center">Action</th>
            </tr>
            @endif
        </thead>
        <tbody>
            @forelse ($blogs as $blog)
            <tr>
                <th scope="row">{{$blog->id}}</th>
                <td>{{$blog->title}}</td>
                <td>{{$blog->intro}}</td>
                <td>
                    <form action="/admin/{{$blog->slug}}/isPublish" method="POST">@csrf
                        @if ($blog->isShow)
                        <button class="btn btn-sm btn-success" type="submit">Published</button>
                        @else
                        <button class="btn btn-sm btn-primary" type="submit">Pending</button>
                        @endif
                    </form>
                </td>
                <td>
                    <form action="/admin/{{$blog->slug}}/update" method="GET">
                        <button type="submit" class="btn btn-sm btn-warning">Edit</button>
                    </form>
                </td>

                <!--delete Btn-->
                <form action="/admin/{{$blog->slug}}/delete" method="POST">@csrf @method('DELETE')
                    <td><button class="btn btn-sm btn-danger">Delete</button></td>
                </form>
                </td>
            </tr>
            @empty
            <p class="text-center p-5">Empty Blogs</p>
            @endforelse
        </tbody>
    </table>
</x-admin-layout>
