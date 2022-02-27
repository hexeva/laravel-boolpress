@extends('layouts.dashboard')

@section('content')

<section>
    <h2>{{$post->title}}</h2>
    <div class="my-3">
        <strong>Slug:</strong> {{$post->slug}}
    </div>
    {{-- verifico se la relazione con la categoria non è NUll faccio vedere la category altrimenti torno un messaggio 'nessuna categoria' --}}
    <div class="my-3">
        <h3>Category: {{$post->category ? $post->category->name : 'nessuna categoria'}}</h3>
    </div> 

    <div class="my-3"><strong>Tags:</strong>
        @forelse ($post->tags as $tag)
            {{ $tag->name }}{{ $loop->last ? '' : ', ' }}
        @empty
            Nessun Tag
        @endforelse
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