@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center">Create Category</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('categories.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="cattitle">Category Name:</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Description:</label>
                            <textarea class="form-control" name="description" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" class="form-control-file" name="image">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-3">Create Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
    .container {
        max-width: 800px;
    }

    .card {
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        font-size: 1.75rem;
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-control, .form-control-file {
        margin-bottom: 15px;
    }

    .form-select {
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        border-radius: 0.25rem;
    }

    .btn-primary {
        width: 100%;
        padding: 10px;
        font-size: 1.25rem;
        border-radius: 5px;
    }

    .alert {
        font-size: 0.9rem;
    }
</style>