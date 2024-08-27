@extends('layouts.app')

@section('title', 'Tag')

@section('content')
  <form action="{{ route('tags.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div  class="form-group container"  style="  padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <label for="tag">Tag Name:</label>
        <input type="text" class="form-control" name="name" required  style="max-width: 500px">
        <button type="submit" class="btn btn-primary" style="margin-top: 10px">Create Tag</button>
    </div>
   
</form>
@endsection
<style>
   .container {
        max-width: 600px;
    }
</style>
