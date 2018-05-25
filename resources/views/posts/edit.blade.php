@extends('posts.header')

@section('content')
<h1 class="lead display-4">Edit Post</h1>
{!! Form::open(['action' => ['postController@update',$posts->id] ,'method' => 'POST','enctype' => 'multipart/form-data']) !!}
	<div class="form-group">
			{{Form::label('post','Title')}}
			{{Form::text('post',$posts->post, ['class' => 'form-control','placeholder' => 'Post Title'])}}
	</div>
	<div class="form-group">
			{{Form::label('body','Boody')}}
			{{Form::textarea('body',$posts->body, ['class' => 'form-control','placeholder' => 'Post Body'])}}
	</div>
	<div class="form-group">
		{{Form::file('cover_image')}}
	</div>
	{{Form::hidden('_method', 'PUT')}}
{{Form::submit('Edit', ['class' => 'btn btn-outline-success'])}}
{!! Form::close() !!}
@endsection