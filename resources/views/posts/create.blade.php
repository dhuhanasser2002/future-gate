@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Create Post</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" required>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea class="form-control" name="content" required></textarea>
                </div>
                <div class="form-group">
                    <h5>Tags:</h5>
                <select class="form-select" aria-label="Default select example" name="tag_id[]" multiple>
                    @foreach($tags as $tag)
                    <option value={{$tag->id}}>{{$tag->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                    <h5>Categories:</h5>
                <select class="form-select" aria-label="Default select example" name="category_id">
                    @foreach($categories as $category)
                    <option value={{$category->id}}>{{$category->name}}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control-file" name="image">
                </div>
                <button type="submit" class="btn btn-primary">Create Post</button>
            </form>
        </div>
    </div>
@endsection