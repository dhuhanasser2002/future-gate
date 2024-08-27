@extends('layouts.app')

@section('title', 'Requests')

@section('content')
<div class="container pr-0 pl-0">
    <h1  class="my-4">Requests</h1>
    @forelse ($requests as $studentRequest)
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-3">
                @if ($studentRequest->image)
                <img src="{{ asset('images/' . $studentRequest->image) }}" class="img-fluid" alt="...">
                @endif
            </div>
            <div class="col-md-9">
                <div class="card-body">
                    <div class="mycard">
                        <div>
                            <h5 class="card-title">{{ $studentRequest->requesttext }}</h5>
                        </div>
                                @if (auth()->check())
                                <form action="{{ route('requests.approve', $studentRequest->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary">Approve</button>
                                </form>
                                @endif
                                @if (auth()->check())
                                <form action="{{ route('requests.destroy', $studentRequest->id) }}" method="POST"
                                    style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to block this user?')">Reject</button>
                                </form>
                                @endif
                            </div>
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