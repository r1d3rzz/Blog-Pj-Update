<x-admin-layout>
    <x-slot name="title">
        Admin | Blog Edit
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md mx-auto">
                <form action="/admin/{{$blog->slug}}/update" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf

                    <x-card-wrapper class="mt-0">
                        <x-form.input name="title" value="{{$blog->title}}" />

                        <x-form.input name="slug" value="{{$blog->slug}}" />

                        <x-form.input name="intro" value="{{$blog->intro}}" />

                        <div class="my-3">
                            <x-form.label name="body" />
                            <textarea name="body" id="body" cols="30" rows="10" class="form-control">
                                {!!$blog->body!!}
                            </textarea>
                            <x-error name="body" />
                        </div>

                        <x-form.input name="thumbnail" type="file" />

                        @if ($blog->thumbnail)
                        <div class="d-flex">
                            <div><input type="checkbox" name="useOldThumbnail" class="me-2" id="deleteThumbnail"></div>
                            <div><label for="deleteThumbnail"><b>delete Thumbnail</b></label></div>
                        </div>
                        <div><img src="{{asset('/storage/'.$blog->thumbnail)}}" width="200" alt=""></div>
                        @endif

                        <div class="my-3">
                            <x-form.label name="category" />
                            <select class="form-control" name="category_id" id="category">
                                @foreach ($categories as $category)
                                <option {{$category->id == old('category_id',$blog->category->id) ? 'selected' : ''}}
                                    value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            <x-error name="category_id" />
                        </div>

                        <div class="my-3 d-flex justify-content-between">
                            <div><button class="btn btn-primary">Update</button></div>
                            <div><button class="btn btn-danger">Cancel</button></div>
                        </div>
                    </x-card-wrapper>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
