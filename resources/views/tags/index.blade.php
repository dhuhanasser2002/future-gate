@extends('layouts.app')

@section('title', 'Tags')

@section('content')
    <div class="container">
        <h1  style="color:palevioletred" class="my-4">Tags</h1>
        <div class="row">
            @forelse ($tags as $tag)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $tag->name }}</h5>
                            <p class="card-text">{{ $tag->description }}</p>
                            <div class="mt-2">
                                <a href="{{ route('tags.show', $tag->id) }}" class="btn btn-primary btn-sm">View</a>
                                @if (auth()->check() &&
                                auth()->user()->can('update', $tag))
                                    <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                @endif
                                @if (auth()->check() &&
                                        auth()->user()->can('delete', $tag))
                                    <form action="{{ route('tags.destroy', $tag->id) }}" method="POST"
                                        style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this tag?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h2 style="color:palevioletred"> there is no tags to show</h2><br>
            @endforelse
        </div>
@endsection
