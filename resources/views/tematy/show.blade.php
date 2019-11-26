@extends('layouts.app')

@section('assets')
    <link href="{{ asset('css/temat.css') }}" rel="stylesheet">

    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">

@endsection


@section('undernav')

    <div class="col-md-4 col-sm-5 col-xs-3 float-left">
        <h2 >
            Temat
        </h2>
    </div>
    <div class="col-md-5 col-sm-6 col-xs-2">

    @if(Auth::user()->typ==Auth::user()->admin)
            <div class="btn-diagonal btn-slanted float-left">
                <a href="/tematy/{{$temat->id}}/edycja" >Edycja</a>
            </div>
    @endif

    <div class="btn-diagonal btn-slanted float-left">
        <a href="#" >Quiz</a>
    </div>
    <div class="btn-diagonal btn-slanted float-left">
         <a href="#" >Zadanie</a>
    </div>

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
                        <small class="text-center mx-auto">Ostatnio edytowany {{$temat->updated_at}}</small>
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

