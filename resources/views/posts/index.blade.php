@extends('posts.header')

@section('content')
@if(count($posts) > 0)
@foreach($posts as $post)
<div class="card">
  <div class="card-header">
    Post
  </div>
  <div class="card-body">
  	<div class="row">
  		<div class="col-md-4">
  			<img style="width:100%" class="img-responsive img-thumbnail shadow p-3 mb-5 bg-white rounded" src="storage/cover_images/{{$post->cover_image}}">
  		</div>
  		<div class="col-md-8">
    <h5 class="card-title"><a href="/posts/{{$post->id}}">{{$post->post}}</a></h5>
    <p class="card-text">{{$post->body}}</p>
    <small>Created at {{$post->created_at}} By <strong>{{$post->user->name}}</strong></small><br>
    <a href="/posts/{{$post->id}}" class="btn btn-outline-secondary">Read Post</a>
  </div>
  </div>
</div>
@endforeach
{{$posts->links()}}
@else
<div class="card">
  <div class="card-header">
    <a href="/login" class="btn btn-outline-success float-right">LOGIN</a><a href="/register" class="btn btn-outline-primary float-right">REGISTER</a>
  </div>
  <div class="card-body">
    <h5 class="card-title">No Post Found!</h5>
    <p class="card-text lead">This is a sample web blog written by <strong class="text-danger">Iwundu Chinonso</strong></p>
    <hr  class="my-4">
    <a href="/" class="btn btn-primary">HomePage</a>
  </div>
</div>
@endif
@endsection