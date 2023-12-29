@extends('layouts.app')

@section('title', 'categories')

@section('content')
    <div class="container">
        <h1 style="color:palevioletred" class="my-4">categories</h1>
        <div class="row">
            @forelse ($categories as $category)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($category->image)
                            <img src="{{ asset('images/' . $category->image) }}" alt="category Image" class="card-img-top">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $category->name }}</h5>
                            <p class="card-text">{{ $category->description }}</p>
                            <div class="mt-2">
                                <a href="{{ route('categories.show', $category->id) }}" class="btn btn-primary btn-sm">View</a>
                                @if (auth()->check() &&
                                auth()->user()->can('update', $category))
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                @endif
                                @if (auth()->check() &&
                                        auth()->user()->can('delete', $category))
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h2  style="color:palevioletred"> there is no categories to show</h2><br>
            @endforelse
        </div>
@endsection
