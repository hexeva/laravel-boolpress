@extends('layouts.dashboard')

@section('content')

<section>
    <h2 class="text-center">Dettagli</h2>
    <h3>{{$category->name}}</h3>
    <ul>
        @forelse ($posts as $post)
            <li>
                <a href="{{route('admin.posts.show',['post'=>$post->id])}}">{{$post->title}}</a>
            </li>
        @empty
            <div>Nessun post trovato</div>
        @endforelse
    </ul>
</section>
    
@endsection