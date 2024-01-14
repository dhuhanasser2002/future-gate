@extends('layouts.app')

@section('title', $user->username)

@section('content')
<div>
    <h1 style="display:inline">{{$user->username}}</h1>
  </div>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{ $user->username }}</h2>
            @if ($user->image)
                <img src="{{ asset('images/' . $user->image) }}" alt="Post Image" class="img-fluid">
            @endif
            <div class="mt-2">
                <a href="{{ route('users.index') }}" class="btn btn-secondary">Back to users</a>
            </div>
        </div>
    </div>
@endsection