@props(['name','type'=>'text','value'=>'','readonly'=>false])

<div class="my-3">
    <x-form.label :name="$name" />
    <input value="{{old($name,$value)}}" type="{{$type}}" name="{{$name}}" id="{{$name}}" class="form-control my-1"
        {{$readonly ? "readonly" : "" }}>
    <x-error name="{{$name}}" />
</div>
