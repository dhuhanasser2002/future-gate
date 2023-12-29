@extends('layouts.app')

@section('title', 'Edit Tag')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Edit Tag</h2>
            <form action="{{ route('tags.update', $tag->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">name:</label>
                    <input type="text" class="form-control" name="name" value="{{ $tag->name }}" required>
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control-file" name="image">
                    @if ($tag->image)
                        <img src="{{ asset('images/' . $tag->image) }}" alt="Current tag Image" class="img-fluid mt-2">
                    @endif
                </div>
                <button type="submit" class="btn btn-primary">Update Tag</button>
                <a href="{{ route('tags.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
