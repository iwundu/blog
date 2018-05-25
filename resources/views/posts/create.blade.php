@extends('posts.header')

@section('content')
<h1 class="lead display-4">Create Post</h1>
{!! Form::open(['action' => 'postController@store','method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
	<div class="form-group">
			{{Form::label('post','Title')}}
			{{Form::text('post','', ['class' => 'form-control','placeholder' => 'Post Title'])}}
	</div>
	<div class="form-group">
			{{Form::label('body','Body')}}
			{{Form::textarea('body','', ['class' => 'form-control','placeholder' => 'Post Body'])}}
	</div>
	<div class="form-group">
		{{Form::file('cover_image')}}
	</div> 
{{Form::submit('Submit', ['class' => 'btn btn-outline-success'])}}
{!! Form::close() !!}
@endsection