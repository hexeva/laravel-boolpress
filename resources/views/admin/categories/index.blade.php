@extends('layouts.dashboard')

@section('content')
    <section>
        <h1 class="text-center">Lista Categorie</h1>

        <ul>
        @foreach ($categories as $category)
            <li>
                <a href="">{{$category->name}}</a>
            </li>
        @endforeach
        </ul>
    </section>
@endsection