@extends('layouts.app')

@section('title', 'category')

@section('content')
  <form action="{{ route('categories.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="cattitle">Category Name:</label>
        <input type="text" class="form-control" name="name" required>
    </div>
    <div class="form-group">
      <label for="content">description:</label>
      <textarea class="form-control" name="description" required></textarea>
  </div>
    <div class="form-group">
      <label for="image">Image:</label>
      <input type="file" class="form-control-file" name="image">
  </div>
    <button type="submit" class="btn btn-primary">Create Category</button>
</form>
@endsection