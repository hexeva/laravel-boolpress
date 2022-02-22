@extends('layouts.dashboard')

@section('content')

<section>
    <h2>{{$post->title}}</h2>
    <div class="my-3">Slug:
        <h5>{{$post->slug}}</h3>
    </div>
    <p>{{$post->content}}</p>
</section>
    
@endsection