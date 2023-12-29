@extends('layouts.app')

@section('title', $tag->name)

@section('content')
        <div class="card-body">
            <h2 class="card-title">{{ $tag->name }}</h2>
            @if ($tag->image)
                <img src="{{ asset('images/' . $tag->image) }}" alt="tag Image" class="img-fluid">
            @endif
            <div class="mt-2">
                <a href="{{ route('tags.index') }}" class="btn btn-secondary">Back to Tags</a>
            </div>
        </div>
    </div>
@endsection
