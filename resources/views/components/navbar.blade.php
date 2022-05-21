<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Creative Coder</a>
        <div class="d-flex">
            <a href="#home" class="nav-link">Home</a>
            <a href="#blogs" class="nav-link">Blogs</a>
            @auth
            @can('admin')
            <a href="/admin/blogs" class="nav-link">Dashboard</a>
            @endcan
            <img src="{{auth()->user()->avatar}}" class="rounded-circle" width="40" alt="">
            <form action="">
                <button class="nav-link btn btn-link">{{auth()->user()->name}}</button>
            </form>
            <form action="/logout">
                <button class="nav-link btn btn-link">Logout</button>
            </form>
            @else
            <form action="/register">
                <button class="nav-link btn btn-link">Register</button>
            </form>
            <form action="/login">
                <button class="nav-link btn btn-link">Login</button>
            </form>
            @endauth
        </div>
    </div>
</nav>
