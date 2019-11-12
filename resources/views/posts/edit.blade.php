@extends('layouts.app')
@section('content')
    <h1>Edit Post</h1>

    {!! Form::open(['action'=> ['PostsController@update',$post->id],'method'=>'POST','enctype'=>'multipart/form-data']) !!}  <!-- wysyla te rzeczy do funkcji store -->
    <div class="form-group">
    {{Form::label('title','Title')}}  <!-- label inputa -->
    {{Form::text('title',$post->title, ['class'=>'form-control','placeholder'=>'Title'])}}  <!-- input -->
    </div>

    <div class="form-group">
        {{Form::label('body','Body')}}
        {{Form::textarea('body',$post->body, ['id'=>'article-ckeditor', 'class'=>'form-control','placeholder'=>'Body Text'])}}
    </div>

    <!--obrazek -->
    <div class="form-group">
        {{Form::file('cover_image')}}
    </div>

    {{Form::hidden('_method','PUT')}} <!--laravel pozwala na oszustwo, gdyż route update wymaga put, a w formie jest POST wiec dodajemy kolejny input? -->
    {{ Form::submit('Submit',['class'=>'btn btn-primary'])}}  <!-- przycisk do wyslania requesta -->

    {{ Form::close() }}  <!-- koniec formularza -->

@endsection
