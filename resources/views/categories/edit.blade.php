@extends('layouts.app')

@section('title', 'Edit Category')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Edit Category</h2>
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">name:</label>
                    <input type="text" class="form-control" name="name" value="{{ $category->name }}" required>
                </div>
                <div class="form-group">
                    <label for="content">description:</label>
                    <textarea class="form-control" name="description" required>{{ $category->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control-file" name="image">
                    @if ($category->image)
                        <img src="{{ asset('images/' . $category->image) }}" alt="Current Category Image" class="img-fluid mt-2">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update category</button>
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
