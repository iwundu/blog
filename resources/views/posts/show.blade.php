@extends('posts.header')

@section('content')
<div class="card">
  <div class="card-header">
    <a href="/posts" class="btn btn-outline-danger">Go Back</a>
  </div>
  <div class="card-body">
    <h5 class="card-title">{{$posts->post}}</h5>
    <img src="storage/cover_images/{{$posts->cover_image}}" style="width:100%" class="img-responsive img-thumbnail shadow p-3 mb-5 bg-white rounded">
    <p class="card-text">{{$posts->body}}</p>
    @if(!Auth::guest())
    @if(auth()->user()->id == $posts->user_id)
    <a href="/posts/{{$posts->id}}/edit" class="btn btn-outline-secondary">Edit Post</a>
{!! Form::open(['action' => ['postController@destroy',$posts->id] ,'method' => 'POST','class' => 'float-right']) !!}
	{{Form::hidden('_method', 'DELETE')}}
	{{Form::submit('Delete Post', ['class' => 'btn btn-danger'])}}
{!! Form::close() !!}
@endif
@endif
<small class="text-success">Written by <b>{{$posts->user->name}}</b> on {{$posts->created_at}}</small>

    </div>
</div>
@endsection