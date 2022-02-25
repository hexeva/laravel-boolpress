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
        <h1 class="text-center">CREATE A NEW POST</h1>
        <div>
            <form action="{{route('admin.posts.store')}}" method="post">
                @csrf
                @method('POST')
                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="" class="form-control" id="title" name="title" value="{{old('title')}}" >
                </div>
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select" id="category_id" name="category_id">
                        <option value="" >Nessuna</option>
                        @foreach($categories as $category)
                            <option selected value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                        @endforeach
                      </select>
                  </div>
                  <div class="mb-3">
                      <h2>Tags:</h2>
                      @foreach ($tags as $tag)
                          {{-- checkbox --}}
                  <div class="form-check">
                    <input class="form-check-input" name="tags[]" type="checkbox" value="{{ $tag->id }}" id="tag-{{ $tag->id }}">
                    <label class="form-check-label" for="tag-{{ $tag->id }}">
                      {{$tag->name}}
                    </label>
                  </div>
                  {{-- end checkbox --}}
                      @endforeach
                  </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Title</label>
                    <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{old('content')}}</textarea>
                  </div>
                
                
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </section>
@endsection