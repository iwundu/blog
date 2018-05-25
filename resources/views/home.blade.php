@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                      <p><a href="/posts/create" class="btn btn-outline-success float-right">Create Post</a> <a href="/posts" class="btn btn-outline-primary float-right">View Trends</a> 
                       </p>
                       @if(count($posts) > 0)
                    <table class="table table-hover">
                        <tr>
                            <th>Title</th>
                            <th></th>
                            <th></th>
                            
                        </tr>
                        <tr>
                            @foreach($posts as $post)
                            <td><a href="/posts/{{$post->id}}" class="text-secondary">{{$post->post}}</a></td>
                            <td><a href="/posts/{{$post->id}}/edit" class="btn btn-warning">Edit</a>
                                <td>
                                    {!! Form::open(['action' => ['postController@destroy',$post->id] ,'method' => 'POST','class' => 'float-right']) !!}
                                    {{Form::hidden('_method', 'DELETE')}}
                                {{Form::submit('Delete Post', ['class' => 'btn btn-danger'])}}
                                    {!! Form::close() !!}

                                </td>
                        </tr>
                        @endforeach
                         </table>
                         @else
                         <p class="lead text-danger">You Have No Post Yet !!!</p>
                         
                         @endif 
                   </div>
            </div>
        </div>
    </div>
</div>
@endsection
