@extends('layouts.app')

@section('title', 'Archived Posts')

@section('content')
<a href="{{ route('posts.index') }}" class="btn btn-primary btn-sm mb-5">Bach To Posts</a>
    <div class="container">
        <h1 class="my-4">Archived Posts</h1>
        <div class="row">
            @forelse ( $asrchivedPosts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($post->image)
                            <img src="{{ asset('images/' . $post->image) }}" alt="Post Image" class="card-img-top">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ $post->content }}</p>
                            <div class="mt-2">
                                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary btn-sm">View</a>
                                <form action="{{ route('posts.restore', $post->id) }}" method="POST"
                                    style="display:inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-primary btn-sm">Unarchive</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h2>no posts</h2>
            @endforelse
        </div>
    </div>
@endsection