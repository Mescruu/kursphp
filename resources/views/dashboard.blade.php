@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                        <a href="/posts/create" class="btn btn-primary">Create Post</a>
                        <h3>Your blog posts</h3>
                        @if(count($posts)>0)
                            <table class="table table-striped">
                                <th> Title </th>
                                <th> </th>
                                <th></th>

                                @foreach($posts as $post)
                                    <tr>
                                        <td> {{$post->title}} </td>
                                        <td> <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                                        <td>
                                            <!--USUWANIE-->
                                        {!! Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST', 'class'=>'pull-center']) !!}

                                        {!! Form::hidden('_method','DELETE') !!} <!-- zeby byl PULL-->
                                            {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}

                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @else
                            <p>You have no posts</p>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
