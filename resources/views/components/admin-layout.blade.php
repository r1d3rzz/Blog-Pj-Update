<x-layout>
    <x-slot name="title">
        {{$title}}
    </x-slot>

    <div class="container-fluid my-2">
        @if (session('admin'))
        <div class="alert alert-primary text-center">
            {{session('admin')}}
        </div>
        @endif
        <div class="row g-0">
            <nav class="col-2 bg-light pe-3">
                <h1 class="h4 text-center text-primary py-3">
                    <i class="fas fa-solid fa-folder"></i>
                    <span class="d-none d-lg-inline">Admin Panel</span>
                </h1>

                <div class="list-group text-lg-start text-center mt-3">
                    <span class="list-group-item disabled d-none d-lg-block">
                        <small>DashBoard</small>
                    </span>
                    <a href="/admin/blogs" class="list-group-item list-group-item-action">
                        <i class="fas fa-solid fa-box"></i>
                        <span class="d-none d-lg-inline">Blogs</span>
                    </a>
                    <a href="/admin/blogs/create" class="list-group-item list-group-item-action">
                        <i class="fas fa-solid fa-plus"></i>
                        <span class="d-none d-lg-inline">Create</span>
                    </a>
                    <a href="/admin/categories/create/category" class="list-group-item list-group-item-action">
                        <i class="fas fa-solid fa-puzzle-piece"></i>
                        <span class="d-none d-lg-inline">Category</span>
                    </a>
                    <a href="/admin/users" class="list-group-item list-group-item-action">
                        <i class="fas fa-solid fa-users"></i>
                        <span class="d-none d-lg-inline">Users</span>
                    </a>
                </div>
            </nav>
            <main class="col-10 bg-light">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="flex-fill"></div>
                    <div class="navbar nav">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                                {{-- <i class="fas fa-user-circle"></i> --}}
                                <img src="{{auth()->user()->avatar}}" width="30" class="rounded-circle"
                                    alt="{{auth()->user()->username}}">
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#" class="dropdown-item">{{auth()->user()->name}}</a>
                                </li>
                                <li>
                                    <a href="/logout" class="dropdown-item">Logout</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link"><i class="fas fa-cog"></i></a>
                        </li>
                    </div>
                </nav>
                <div>
                    {{$slot}}
                </div>
            </main>
        </div>
    </div>

    <script src="/ckEditor/ckeditor.js"></script>
    <script>
        ClassicEditor
				.create( document.querySelector( '#body' ), {

					licenseKey: '',



				} )
				.then( editor => {
					window.editor = editor;




				} )
				.catch( error => {
					console.error( 'Oops, something went wrong!' );
					console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
					console.warn( 'Build id: jd3gko2o0vj0-tyyidfogxwie' );
					console.error( error );
				} );
    </script>
</x-layout>
