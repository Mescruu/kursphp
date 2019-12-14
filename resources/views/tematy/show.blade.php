@extends('layouts.app')

@section('assets')

    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/temat.css') }}" rel="stylesheet">

@endsection


@section('undernav')

    <div class="col-md-4 col-sm-4 col-xs-3 float-left">
        <h2 >
            <a href="/tematy/{{$temat->id}}" >Temat</a>
        </h2>
    </div>
    <div class="col-md-6 col-sm-8 col-xs-2">

        @if(Auth::user()->typ==\App\User::$admin)
            <div class="btn-diagonal btn-slanted float-left">
                <a href="/tematy/{{$temat->id}}/edycja" >Edycja</a>
            </div>
        @endif



        @if(isset($temat->wyklad))
            @if($temat->wyklad!="empty")
                <div class="btn-diagonal btn-slanted float-left">
                    <a href="/wyklady/{{$temat->wyklad}}" >Wyklad</a>
                </div>
            @endif
        @endif

        @if(isset($temat->quiz))
            @if($temat->quiz!="empty")
                <div class="btn-diagonal btn-slanted float-left">
                    <a href="/quizy/{{$temat->quiz}}" >Quiz</a>
                </div>
            @endif
        @endif

        @if(isset($temat->zadanie))
            @if($temat->zadanie!="empty")
                <div class="btn-diagonal btn-slanted float-left">
                    <a href="/zadania/{{$temat->zadanie}}" >Zadanie</a>
                </div>
            @endif
        @endif

    </div>

@endsection

@section('content')

    @if (!Auth::guest()) <!--jeżeli użytkownik nie jest gościem-->

    <div class="pokaz-temat-section">

        <div class="container">
            <div class="card">
                <div class="row">

                    <div class="col-12">
                        <h1>{{$temat->nazwa}}</h1>
                        <hr class="w-50">
                        @if(isset($temat->updated_at))
                            <small class="text-center mx-auto">Ostatnio edytowany {{$temat->updated_at}}</small>
                        @endif
                    </div>

                </div>
                <div class="row">
                    <div class="col-12 py-3">
                        <div>
                            {!! $trescAktualna !!}
                        </div>
                    </div>
                </div>

            </div>
          </div>
    </div>


    @endif
@endsection

