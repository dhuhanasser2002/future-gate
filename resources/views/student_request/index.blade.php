@extends('layouts.app')

@section('title', 'Requests')

@section('content')
<div class="container pr-0 pl-0">
    <h1 class="my-4">Requests</h1>
    @forelse ($requests as $studentRequest)
    <div class="card mb-3">
        <div class="row g-0 align-items-center">
            <div class="col-md-3 d-flex align-items-center justify-content-center">
                @if ($studentRequest->image)
                <img src="{{ asset('images/' . $studentRequest->image) }}" class="img-fluid" alt="..." style="max-height: 150px; object-fit: cover;">
                @else
                <div class="no-image" style="width: 100%; height: 150px; background-color: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                    <span>No Image</span>
                </div>
                @endif
            </div>
            <div class="col-md-9 d-flex align-items-center">
                <div class="card-body w-100">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">{{ $studentRequest->requesttext }}</h5>
                        <div>
                            @if (auth()->check())
                            <form action="{{ route('requests.approve', $studentRequest->id) }}" method="POST" enctype="multipart/form-data" style="display: inline-block; margin-right: 10px;">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-primary">Approve</button>
                            </form>
                            @endif
                            @if (auth()->check())
                            <form action="{{ route('requests.destroy', $studentRequest->id) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to block this user?')">Reject</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @empty
    <h2>There are no requests to show</h2>
    @endforelse

</div>
@endsection