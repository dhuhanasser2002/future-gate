@extends('layouts.app')

@section('title', 'Create Project')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="card-title">Create Post</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" required>
            </div>
            <div class="form-group">
                <label for="title">Technique:</label>
                <input type="text" class="form-control" name="technique" required>
            </div>
            <div class="form-group">
                <label for="title">GitHub Link:</label>
                <input type="text" class="form-control" name="github" required>
            </div>
            <div class="form-group">
                <label for="content">Description:</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="image">main Image:</label>
                <input type="file" class="form-control-file" name="mainimage">
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" name="images[]"  multiple>
            </div>
            <button type="submit" class="btn btn-primary">Create Project</button>
        </form>
    </div>
</div>
@endsection