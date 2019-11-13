@extends('layouts.app')

@section('assets')
    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">
@endsection


@section('undernav')

    <div class="col-md-4 col-sm-5 col-xs-3 float-left">
        <h2 >
            Temat
        </h2>

    </div>
@endsection

@section('content')

    @if (!Auth::guest()) <!--jeżeli użytkownik nie jest gościem-->

    <div class="container">
        <a href="/tematy" class="btn btn-default">Go Back!</a>
        <h1>Temat {{$temat->id}}</h1>

        <div>
            {!! $temat->trescAktualna !!}
        </div>


        <hr>
        <small>Written on {{$temat->created_at}}</small>
        <hr>
    </div>

    @endif
@endsection

