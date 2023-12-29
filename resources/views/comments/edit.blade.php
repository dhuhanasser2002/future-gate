@extends('layouts.app')

@section('title', 'Edit Comment')

@section('content')
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">Edit Comment</h2>
            <form action="{{ route('comments.update', $comment) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea class="form-control" name="content" required>{{ $comment->content }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update Comment</button>
                <a href="{{ route('posts.show',$comment->postId) }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
