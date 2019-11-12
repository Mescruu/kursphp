@extends('layouts.app')
@section('content')

    @if (!Auth::guest()) <!--jeżeli użytkownik nie jest gościem-->

    <a href="/tematy" class="btn btn-default">Go Back!</a>
    <h1>Temat {{$temat->id}}</h1>

    <div>
        {!! $temat->trescAktualna !!}
    </div>


    <hr>
    <small>Written on {{$temat->created_at}}</small>
    <hr>

    @endif
@endsection

