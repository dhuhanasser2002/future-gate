@extends('layouts.app')

@section('title', 'add user')

@section('content')
    <div class="card mx-auto mt-5" style="max-width: 400px;">
        @if($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
          </ul>
        </div>
      @endif
        <div class="card-body">
            <h2 class="card-title text-center mb-4">Add User</h2>
            <form method="POST" action="{{ route('users.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required autofocus>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password:</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Your Image</label>
                    <input class="form-control" type="file" id="formFile" name = "image" >
                  </div>
                <button type="submit" class="btn btn-primary btn-block">Add User</button>
            </form>
        </div>
    </div>
@endsection