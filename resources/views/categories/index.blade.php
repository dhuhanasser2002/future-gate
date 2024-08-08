@extends('layouts.app')

@section('title', 'Categories')

@section('content')
    <div class="container">
        @if (auth()->check() && auth()->user()->is_admin)
            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm mt-5">Add Category</a>
        @endif
        <h1 class="my-4">Categories</h1>
        <div class="row">
            @forelse ($categories as $category)
                <div class="col-md-3 col-sm-6 mb-4 d-flex align-items-stretch">
                    <div class="card">
                        @if ($category->image)
                            <img src="{{ asset('images/' . $category->image) }}" alt="Category Image" class="card-img-top" style="height: 150px; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title" style="font-weight: bold; color: black;">{{ $category->name }}</h5>
                            <p class="card-text" style="color: rgb(78, 78, 78); font-size: 0.9em;">{{ $category->description }}</p>
                            <div class="mt-auto">
                                <a href="{{ route('category.sort', $category->id) }}" class="btn btn-primary btn-sm">View</a>
                                @if (auth()->check() && auth()->user()->can('update', $category))
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                @endif
                                @if (auth()->check() && auth()->user()->can('delete', $category))
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h2>There are no categories to show</h2><br>
            @endforelse
        </div>
    </div>
@endsection