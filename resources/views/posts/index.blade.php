@extends('layouts.app')
@section('content')
    <h1>Posts</h1>
    @if(count($posts)>=1)
            @foreach($posts as $post)
                <div class="row well">
                        <div class="col-md-4 col-sm-4">
                            <img style="width: 100%;max-width: 500px" src="/storage/cover_images/{{$post->cover_image}}" alt="">
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <h3><a href="/posts/{{$post->id}}">{{$post->title}}</a></h3>
                            <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
                        </div>
                </div>
                @endforeach
        {{$posts->links()}}
    @else
    <p>no posts found</p>
    @endif
@endsection
