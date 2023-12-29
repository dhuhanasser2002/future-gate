@extends('layouts.app')

@section('title', $category->name)

@section('content')
        <div class="card-body">
            <h2 class="card-title">{{ $category->name }}</h2>
            <p>{{ $category->description }}</p>
            @if ($category->image)
                <img src="{{ asset('images/' . $category->image) }}" alt="category Image" class="img-fluid">
            @endif
            <div class="mt-2">
                <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to categories</a>
            </div>
        </div>
    </div>
@endsection
