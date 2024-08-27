@extends('layouts.app')

@section('title', 'Projects')

@section('content')
<style>
    body {
        background-color:#0056b3; /* اختر اللون المناسب هنا */
    }

    .btn_primary_project {
        background-color: #007bff;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
    }

    .btn_primary_project:hover {
        background-color: #0056b3;
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .img_pod_project .project-image {
        width: 100%; /* العرض الكامل للنسبة */
        height: 300px; /* الارتفاع المحدد */
        object-fit: cover; /* للحفاظ على النسبة بدون تمدد */
    }

    .container_copy_project .project-image {
        width: 100%; /* العرض الكامل للنسبة */
        height: 300px; /* الارتفاع المحدد */
        object-fit: cover; /* للحفاظ على النسبة بدون تمدد */
    }
</style>

<a href="{{ route('projects.create') }}" class="btn btn-primary btn-sm mb-5">Add Project</a>
<div class="container-fluid">


    <h1 style="color:palevioletred" class="my-4 mb-5"></h1>

    <div class="row">
        @forelse ($projects as $project)
        <div class="col-md-5 col-lg-4 mb-4 mt-5">
            <div class="bodyproject">
                <div class="blog_post_project">
                    <div class="img_pod_project">
                        @if($project->mainimage)
                            <img src="{{ asset('images/' . $project->user->image) }}" alt="Project Image" class="img-fluid">
                        @else
                            <img src="https://pbs.twimg.com/profile_images/890901007387025408/oztASP4n.jpg" alt="Default Image" class="img-fluid">
                        @endif
                    </div>
                    <div class="container_copy_project">
                        <h3>{{ $project->created_at->format('d F Y') }}</h3>
                        <h1>{{ $project->title }}</h1>
                        <h2>{{ $project->technique }}</h2>
                        @if(auth()->check() && auth()->user()->can('view', $project))
                            <a class="btn_primary_project" href="{{ route('projects.show', $project->id) }}">View</a>
                        @endif
                        @if(auth()->check() && auth()->user()->can('delete', $project))
                            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                            </form>
                        @endif
                        <img src="{{asset('images/'.$project->mainimage)}}" class="img-fluid pt-5 project-image" alt="...">
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <h2 style="color:palevioletred">There are no projects to show</h2>
        </div>
        @endforelse
    </div>
</div>
@endsection
