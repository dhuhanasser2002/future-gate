@extends('layouts.app')

@section('title', $tag->name)

@section('content')
        <div class="card-body">
            <h2 class="card-title">{{ $tag->name }}</h2>
            <div class="mt-2">
                <a href="{{ route('tags.index') }}" class="btn btn-secondary">Back to Tags</a>
            </div>
        </div>
    </div>
@endsection
