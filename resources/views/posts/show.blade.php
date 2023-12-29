@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div>
    @if ($post->user->image)
    <img style="display:inline" src="{{ asset('images/' . $user->image) }}" class="rounded-circle border border-3" alt="user image" width="100px" height="100px">
    @endif
    <h1 style="display:inline">{{$post->user->name}}</h1>
  </div>
    <div class="card">
        <h3>Category: {{$post->category->name}}</h3>
        <h3>tags:</h3>
        @foreach($post->tags as $tag)
          <h4>{{$tag->name}}</h4>
        @endforeach
        <div class="card-body">
            <h2 class="card-title">{{ $post->title }}</h2>
            <p>{{ $post->postContent }}</p>
            @if ($post->image)
                <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" class="img-fluid">
            @endif
            <div class="mt-2">
                <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>
            </div>
        </div>
    </div>
    @foreach ($comments as $comment)
    <div class="card">
        <div class="card-header">
          @if ($comment->user->image)
            <img style="display:inline" src="{{ asset('images/' . $user->image) }}" class="rounded-circle border border-3" alt="user image" width="75px" height="75px">
          @endif
          <h3 style="display:inline">{{$comment->user->name}}</h3>
        </div>
        <div class="card-body">
          <blockquote class="blockquote mb-0">
            <p>{{$comment->content}}</p>
          </blockquote>
        </div>
        <div class="mt-2">
            @if (auth()->check() &&
            auth()->user()->can('update', $comment))
                <a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-warning btn-sm">Edit</a>
            @endif
            @if (auth()->check() &&
                    auth()->user()->can('delete', $comment))
                <form action="{{ route('comments.destroy', $comment->id ) }}" method="POST"
                    style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('Are you sure you want to delete this post?')">Delete </button>
                </form>
            @endif
        </div>
      </div>
      @endforeach
      <form action="{{ route('comments.store', $post->id)}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="content">Your Comment:</label>
            <textarea class="form-control" name="content" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">post comment</button>
    </form>
@endsection
