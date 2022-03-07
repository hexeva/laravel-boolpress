@extends('layouts.dashboard')

@section('content')
<h1 class="text-center">Post lists</h1>
   <div class="row row-cols-3">
       @foreach ($posts as $post)
           {{-- single post --}}
       <div class="col">
            <div class="card my-3">
                @if ($post->cover)
                <img src="{{asset('storage/' . $post->cover)}}" class="card-img-top" alt="{{$post->title}}">    
                @endif
                <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <p class="card-text">{{ Str::substr($post->content, 0, 60) }}...</p>
                <a href="{{route('admin.posts.show',['post'=>$post->id])}}" class="btn btn-primary">Go to post</a>
                </div>
            </div>
        </div>
            {{-- end single post --}}
       @endforeach
   </div>

   {{ $posts->links() }}
   
@endsection