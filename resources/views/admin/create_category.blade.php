<x-admin-layout>

    <x-slot name="title">
        Admin | Categories
    </x-slot>

    <div class="container-fluid">
        <div class="row">
            <!--Categories Lists-->
            <div class="col-md-5">
                @if (session('delete'))
                <div class="alert alert-warning text-center">{{session('delete')}}</div>
                @endif
                <table class="table table-light table-striped">
                    <thead>
                        @if ($categories->count())
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Slug</th>
                            <th scope="col">Action</th>
                        </tr>
                        @endif
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <th scope="row">{{$category->id}}</th>
                            <td>{{$category->name}}</td>
                            <td>{{$category->slug}}</td>
                            <td>
                                <form action="/admin/{{$category->slug}}/delete/category" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" value="Delete" class="btn btn-sm btn-danger">
                                </form>
                            </td>
                        </tr>
                        @empty
                        <p class="text-center p-5">Empty Category</p>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!--Add New Category-->
            <div class="col-md">
                @if (session('addCategory'))
                <div class="alert alert-primary text-center">{{session('addCategory')}}</div>
                @endif
                <form action="" method="POST">@csrf
                    <x-card-wrapper>
                        <x-form.input name="name" />

                        <x-form.input name="slug" />

                        <div class="d-flex justify-content-between my-3">
                            <div><input type="submit" class="btn btn-primary" value="Add New Category"></div>
                            <div><input type="reset" class="btn btn-danger" value="Cancel"></div>
                        </div>
                    </x-card-wrapper>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
