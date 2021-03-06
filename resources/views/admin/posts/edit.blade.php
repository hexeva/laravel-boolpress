@extends('layouts.dashboard')

@section('content')
    <section>
        <h1 class="text-center">EDIT A POST</h1>
        <div>
            <form action="{{route('admin.posts.update',['post'=>$post->id])}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="title" class="form-label">Title</label>
                  <input type="" class="form-control" id="title" name="title" value="{{ old('title', $post->title) }}" >
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
                            <option selected value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                        @endforeach
                      </select>
                </div>

                <div class="mb-3">
                    <h3>Tag:</h3>
                    @foreach ($tags as $tag)
                    {{-- Checkbox --}}
                        <div class="form-check">
                            {{-- Se ci sono errori nella validazione dell'edit assumo che l'utente abbia precedentemente caricato la pagina e quindi assegnerò il valore contenuto in old --}}
                            @if ($errors->any())
                            <input class="form-check-input" {{ in_array($tag->id,old('tags',[])) ? 'checked' : '' }} name="tags[]" type="checkbox" value="{{$tag->id}}" id="tag-{{$tag->id}}">
                            @else
                                {{-- altrimenti se non ci sono errori di validazione assumo che sia la prima volta che l'utente carica la pagina quindi: --}}
                                <input class="form-check-input" {{ $post->tags->contains($tag) ? 'checked' : '' }} name="tags[]" type="checkbox" value="{{$tag->id}}" id="tag-{{$tag->id}}">
                            @endif
                            
                            <label class="form-check-label" for="tag-{{$tag->id}}">
                                {{ $tag->name }}
                            </label>
                        </div>
                        {{-- checkbox --}}
                    @endforeach
                        {{-- error --}}
                        @error('tags')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        {{-- end error --}}
                </div>  

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea class="form-control" name="content" id="content" cols="30" rows="10">{{ old('title', $post->content) }}</textarea>
                </div>
                {{-- error --}}
                @error('content')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
                {{-- end error --}}

                {{-- Upload images --}}
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" id="image" name="image">
                </div>
                  {{-- end upload images --}}

                {{-- anteprima immagine --}}
                @if($post->cover)
                <div class="edit_img">Current image:
                    <img src="{{asset('storage/' . $post->cover)}}" alt="{{$post->title}}">
                </div>
                @endif
                {{-- end anteprima immagine --}}
                  {{-- error --}}
                @error('image')
                    <div class="alert alert-danger">{{$message}}</div>
                @enderror
                {{-- end error --}}
                <button type="submit" class="btn btn-primary">Salva</button>
            </form>
        </div>
    </section>
@endsection