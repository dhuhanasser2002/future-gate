@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Edit Post</h2>
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" value="{{ $post->title }}" required>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea class="form-control" name="content" required>{{ $post->postContent }}</textarea>
                </div>
                <div class="form-group">
                <select class="form-select" aria-label="Default select example" name="tag_id[]" multiple>
                    @foreach($tags as $tag)
                    <option value={{$tag->id}}>{{$tag->name}}</option>
                    @endforeach
                  </select>
                </div>
                  <div class="form-group">
                <select class="form-select" aria-label="Default select example" name="category_id">
                    <option selected>categories</option>
                    @foreach($categories as $category)
                    <option value={{$category->id}}>{{$category->name}}</option>
                    @endforeach
                  </select>
                  </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control-file" name="image">
                    @if ($post->image)
                        <img src="{{ asset('images/' . $post->image) }}" alt="Current Post Image" class="img-fluid mt-2">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update Post</button>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
