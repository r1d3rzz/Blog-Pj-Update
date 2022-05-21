@props(['blog'])

<div class="container">
    <div class="row mt-5">
        <div class="col-md-6 mx-auto text-center">
            @if ($blog->thumbnail)
            <img src="{{asset('storage/'.$blog->thumbnail)}}" class="card-img-top" alt="..." />
            @endif
            <h3 class="my-3">{{$blog->title}}</h3>
            <p class="fs-6 text-secondary">
                <a href="/?user={{$blog->author->username}}">{{$blog->author->name}}</a>
                <span> - {{$blog->created_at->diffForHumans()}}</span>
            </p>
            @auth
            <form action="/blogs/{{$blog->slug}}/subscribe" id="subscribe" method="POST">@csrf
                @if (auth()->user()->isSubscribe($blog))
                <button type="submit" class="btn btn-danger">Unsubscribe</button>
                @else
                <button type="submit" class="btn btn-warning">Subscribe</button>
                @endif
            </form>
            @endauth
            <div class="tags my-3">
                <a href="/?category={{$blog->category->slug}}"><span
                        class="badge bg-primary">{{$blog->category->name}}</span></a>
            </div>
            <p class="lh-md">
                {!!$blog->body!!}
            </p>
        </div>
    </div>
</div>
