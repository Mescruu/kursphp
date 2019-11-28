@extends('layouts.app')

@section('assets')
    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/quiz.css') }}" rel="stylesheet">

@endsection


@section('undernav')

    <div class="col-md-4 col-sm-5 col-xs-3 float-left">
        <h2 >
            Temat
        </h2>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-2">

        <div class="btn-diagonal btn-slanted float-left">
            <a href="#" >Temat</a>
        </div>
        <div class="btn-diagonal btn-slanted float-left">
            <a href="#" >Zadanie</a>
        </div>

    </div>

@endsection

@section('content')

    <div class="quiz-section">

        <div class="container">

            <div id="hello">

                <div class="row ">
                    <div class="col-12">
                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                            <div class="card-header"><h3>Powodzenia!</h3></div>
                            <div class="card-body">
                                <p class="text-center">

                                    @if($typ=="kolokwium")
                                    To jest kolokwium! Nie będzie można powtórzyć tego testu!
                                    @else
                                    informacje o quizie
                                    @endif

                                </p>
                                <h4 class="text-center">Jesteś Gotów?!</h4>
                                    <hr>
                                <a href="
                                 @if(Auth::user()->typ==\App\User::$admin)
                                      /panel
                                @endif
                                @if(Auth::user()->typ==\App\User::$user)
                                    /profil
                                @endif

                                " class="btn btn-info col-3 offset-3">Nie</a>
                                <button class="btn btn-info col-3" onClick="start()">Tak!</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    <form class="form-signin justify-content-center " method="POST" action="/quizy/sprawdz/{{$id}}">
        {{ csrf_field() }}

        <input type="hidden" value="{{$seed}}" name="seed">


        <div class="questions">
                    @foreach($pytania as $pytanie)
                        <div class="question" style="display: none" id="pytanie{{$pytanie->nr}}">

                            <div class="row ">
                                <div class="col-12">
                                    <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                        <div class="card-header"><h3>Pytanie {{$pytanie->nr}}.</h3></div>
                                        <div class="card-body">
                                            <p class="card-text">Treść pytania</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row"> <!-- <div class="row no-gutters"> opakowanie dla kolumn/ no-gutters wylacza odstepy/paddingi pionowe pomiedzy kolumnami-->
                                <div class="col-12 col-sm-6 col-md-3 ">
                                    <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                        <div class="card-header"><h3>A</h3></div>
                                        <div class="card-body answer">
                                            <p class="card-text">{{$pytanie->a}}</p>



                                            <label class="container">
                                                <input type="radio" name="odpowiedz{{$pytanie->nr}}" value="{{$pytanie->a}}" >
                                                <div class="checkmark" onClick="hide('pytanie{{$pytanie->nr}}')">
                                                    Wybierz
                                                </div>
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 ">
                                    <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                        <div class="card-header"><h3>B</h3></div>
                                        <div class="card-body answer">
                                            <p class="card-text">{{$pytanie->b}}</p>

                                            <label class="container">
                                                <input type="radio" name="odpowiedz{{$pytanie->nr}}" value="{{$pytanie->b}}" >
                                                <div class="checkmark" onClick="hide('pytanie{{$pytanie->nr}}')">
                                                    Wybierz
                                                </div>
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 ">
                                    <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                        <div class="card-header "><h3>C</h3></div>
                                        <div class="card-body answer">
                                            <p class="card-text">{{$pytanie->c}}</p>

                                            <label class="container">
                                                <input type="radio" name="odpowiedz{{$pytanie->nr}}" value="{{$pytanie->c}}" >
                                                <div class="checkmark" onClick="hide('pytanie{{$pytanie->nr}}')">
                                                    Wybierz
                                                </div>
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 ">
                                    <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                        <div class="card-header"><h3>D</h3></div>
                                        <div class="card-body answer">
                                            <p class="card-text">{{$pytanie->d}}</p>

                                            <label class="container">
                                                <input type="radio" name="odpowiedz{{$pytanie->nr}}" value="{{$pytanie->d}}" >
                                                <div class="checkmark" onClick="hide('pytanie{{$pytanie->nr}}')">
                                                    Wybierz
                                                </div>
                                            </label>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>


            <div id="results" style="display: none">

                <div class="row w-25 mx-auto">
                    <div class="col-12">
                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                            <div class="card-header"><h3 class="text-center">Wyniki!</h3></div>
                            <div class="card-body">

                                <button type="submit" class="btn btn-info col-12"  id="checkOdp">Sprawdź Odpowiedzi</button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </form>

        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>




</script>

@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/quiz.js')}}"></script>

@endsection

