
@extends('layouts.app')

@section('title', 'Project')
<style>
  .sample-header {
  background-image: url("{{asset('images/' . $project->mainimage)}}");
}
</style>
@section('content')
<div class="projectcontainer">
<div class="sample-header">
  <div class="sample-header-section">
    <h1>{{$project->title}}</h1>
    <h2>{{$project->technique}}</h2>
    <a href="{{$project->github}}">my github : {{$project->github}}</a>
  </div>
</div>
<div class="sample-section-wrap">
  <div class="sample-section">
    {{$project->description}}
  </div>
  <div class="galleryBody">
<div class="gallery" style="margin-top: 50px;">
  @foreach($project->images as $image)
    <span style="--i:{{$image->id}}">
      <img src="{{asset('images/' . $image->image)}}" alt="" />
    </span>
  @endforeach
  </div>
</div>
</div>
</div>