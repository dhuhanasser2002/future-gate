@extends('layouts.app')

@section('title', 'Update Project')

@section('content')
<div class="card">
    <div class="card-body">
        <h2 class="card-title">Update Project</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('projects.update', $project->id )}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" value="{{ $project->title}}" required>
            </div>
            <div class="form-group">
                <label for="title">Technique:</label>
                <input type="text" class="form-control" name="technique" value="{{ $project->technique}}" required>
            </div>
            <div class="form-group">
                <label for="github">GitHub Link:</label>
                <input type="text" class="form-control" name="github"  value="{{$project->github}}">
            </div>
            <div class="form-group">
                <label for="content">Description:</label>
                <textarea class="form-control" name="description" required>{{ $project->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="image">main Image:</label>
                <input type="file" class="form-control-file" name="mainimage">
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control-file" name="images[]"  multiple>
            </div>
            <button type="submit" class="btn btn-primary">Update Project</button>
        </form>
    </div>
</div>
@endsection

