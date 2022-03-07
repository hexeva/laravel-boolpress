@extends('layouts.dashboard')

@section('content')
    <section>
        <h1 class="text-center">CREATE A NEW POST</h1>
        <div>
            <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="" class="form-control" id="title" name="title" value="{{old('title')}}" >
                </div>
                {{-- error --}}
                @error('title')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
                {{-- end error --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select" id="category_id" name="category_id">
                        <option value="">Nessuna</option>
                        @foreach($categories as $category)
                            <option selected value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                        @endforeach
                      </select>
                  </div>

                    {{-- error --}}
                    @error('category_id')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    {{-- end error --}}

                  <div class="mb-3">
                        <h3>Tag:</h3>
                        @foreach ($tags as $tag)
                        {{-- Checkbox --}}
                            <div class="form-check">
                                <input {{ in_array($tag->id, old('tags', [])) ? 'checked' : '' }} class="form-check-input" name="tags[]" type="checkbox" value="{{ $tag->id }}" id="tag-{{ $tag->id }}">
                                <label class="form-check-label" for="tag-{{ $tag->id }}">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        {{-- checkbox --}}
                        @endforeach
                    </div>

                    {{-- Upload images --}}

                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" id="image" name="image">
                    </div>

                      {{-- end upload images --}}

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{old('content')}}</textarea>
                </div>

                    {{-- error --}}
                    @error('content')
                        <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                    {{-- end error --}}
                
                
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
        </div>
    </section>
@endsection