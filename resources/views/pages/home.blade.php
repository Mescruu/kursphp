@extends('layouts.app')
<!--css do poszczegolnej strony-->
@section('assets')
    <link href="{{ asset('css/temat.css') }}" rel="stylesheet">
    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">

@endsection

@section('undernav')

    <div class="col-md-4 col-sm-5 col-xs-3 float-left">
        <h2 >
            Strona Główna
        </h2>
    </div>
@endsection

@section('content')
@if (!Auth::guest()) <!--jeżeli użytkownik nie jest gościem-->

    <div class="pokaz-temat-section">

        <div class="container">
            <div class="card">
                <div class="row">

                    <div class="col-12">
                        <h1>Witaj!</h1>
                        <hr class="w-50">
                    </div>

                </div>
                <div class="row">
                    <div class="col-12 py-3">
                        <div>
                            aaaa
                        </div>
                    </div>
                </div>

            </div>
          </div>
    </div>


@endif
@endsection
