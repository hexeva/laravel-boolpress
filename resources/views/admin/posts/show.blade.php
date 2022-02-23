@extends('layouts.dashboard')

@section('content')

<section>
    <h2>{{$post->title}}</h2>
    <div class="my-3">Slug:
        <h5>{{$post->slug}}</h3>
    </div>
    <p>{{$post->content}}</p>
    <a href="{{route('admin.posts.edit',['post'=>$post->id])}}" class="btn btn-primary">Edit Post</a>
    <div class="my-5">
        <form action="{{route('admin.posts.destroy',['post'=>$post->id])}}" method="post">
            @csrf
            @method('DELETE')
            <button onclick="return confirm('Do you really want to delete this post?')" class="btn btn-danger">DELETE</button>
        </form>
    </div>
</section>
    
@endsection