@extends('layouts.app')

@section('title', 'Tag')

@section('content')
  <form action="{{ route('tags.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="tag">Tag Name:</label>
        <input type="text" class="form-control" name="name" required>
    </div>
    <div class="form-group">
      <label for="image">Image:</label>
      <input type="file" class="form-control-file" name="image">
  </div>
    <button type="submit" class="btn btn-primary">Create Tag</button>
</form>
@endsection