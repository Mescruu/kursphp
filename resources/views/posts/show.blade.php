@extends('layouts.app')
@section('content')
    <a href="/posts" class="btn btn-default">Go Back!</a>
    <h1>{{$post->title}}</h1>
    <img style="width: 100%;max-width: 500px" src="/storage/cover_images/{{$post->cover_image}}" alt="">

    <div>
        {!! $post->body !!}
    </div>


    <hr>
    <small>Written on {{$post->created_at}}  by {{$post->user->name}}</small>
    <hr>
     @if (!Auth::guest()) <!--jeżeli użytkownik nie jest gościem-->
         @if (Auth::user()->id == $post->user->id) <!--jeżeli id użytkownika równe jest id użytkownika który napisał post..-->
         <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
        <!--USUWANIE-->
        {!! Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST', 'class'=>'pull-right']) !!}

        {!! Form::hidden('_method','DELETE') !!} <!-- zeby byl PULL-->
        {!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}

        {!! Form::close() !!}
         @endif
    @endif
@endsection

