@props(['blog'])

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto text-center">
            <img src="https://creativecoder.s3.ap-southeast-1.amazonaws.com/blogs/GOLwpsybfhxH0DW8O6tRvpm4jCR6MZvDtGOFgjq0.jpg"
                class="card-img-top" alt="..." />
            <h3 class="my-3">{{$blog->title}}</h3>
            <p class="fs-6 text-secondary">
                <a href="/users/{{$blog->author->username}}">{{$blog->author->name}}</a>
                <span> - {{$blog->created_at->diffForHumans()}}</span>
            </p>
            <div class="tags my-3">
                <a href="/categories/{{$blog->category->slug}}"><span
                        class="badge bg-primary">{{$blog->category->name}}</span></a>
            </div>
            <p class="lh-md">
                {{$blog->body}}
            </p>
        </div>
    </div>
</div>