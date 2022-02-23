@extends('layouts.dashboard')

{{-- MESSAGE ERROR --}}
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
{{-- END MESSAGE ERROR --}}

@section('content')
    <section>
        <h1 class="text-center">EDIT A POST</h1>
        <div>
            <form action="{{route('admin.posts.update',['post'=>$post->id])}}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" >
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ old('title', $post->content) }}</textarea>
                  </div>
                
                
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </section>
@endsection