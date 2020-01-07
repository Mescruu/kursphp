@extends('layouts.app')

@section('assets')
    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/quiz.css') }}" rel="stylesheet">

@endsection


@section('undernav')

    <div class="col-md-4 col-sm-2 col-xs-3 float-left">
        <h2 >
            <a href="/quizy/{{$quiz->id}}" >Quiz</a>
        </h2>
    </div>
    <div class="col-md-8 col-sm-10 col-xs-2">

        @if(Auth::user()->typ==\App\User::$admin)
            <div class="btn-diagonal btn-slanted float-left">
                <a href="/quizy/{{$quiz->id}}/edycja" >Edycja</a>
            </div>
        @endif


            @if(isset($quiz->temat))
                @if($quiz->temat!="empty")
                    <div class="btn-diagonal btn-slanted float-left">
                        <a href="/tematy/{{$quiz->temat}}" >Temat</a>
                    </div>
                @endif
            @endif

        @if(isset($quiz->wyklad))
            @if($quiz->wyklad!="empty")
                <div class="btn-diagonal btn-slanted float-left">
                    <a href="/wyklady/{{$quiz->wyklad}}"  target="_blank" rel="noopener noreferrer">Wykład</a>
                </div>
            @endif
        @endif


        @if(isset($quiz->zadanie))
            @if($quiz->zadanie!="empty")
                <div class="btn-diagonal btn-slanted float-left">
                    <a href="/zadania/{{$quiz->zadanie}}" >Zadanie</a>
                </div>
            @endif
        @endif

    </div>

@endsection

@section('content')

    <div class="quiz-section">

        <div class="container">

            <div id="hello">

                <div class="row ">
                    <div class="col-12">
                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                            <div class="card-header"><h2>Powodzenia!</h2></div>
                            <div class="card-body">
                                <p class="text-center">
                                    Ten quiz składa się z <strong>{{$ilosc}}</strong> pytań. 
                                    Do każdego pytania przypisane są 4 odpowiedzi, z których tylko jedna jest poprawna. 
                                    Po ukończeniu quizu otrzymasz wynik w postaci ilości poprawnie udzielonych odpowiedzi 
                                    oraz będziesz miał/a możliwość sprawdzenia, na które pytania odpowiedziałeś/aś poprawnie 
                                    (w przypadku błędnej odpowiedzi - która odpowiedź była prawidłowa).
                                </p>
                                @if($typ=="kolokwium")
                                    <p class="text-center">To jest kolokwium! Nie będzie można powtórzyć tego testu!</p>
                                @endif
                                @if($wynik!=null)
                                <p class="text-center">
                                    Rozwiązałeś/aś ostatnio ten quiz i otrzymałeś/aś wynik:<br>
                                    <strong>{{$wynik->wynik}}</strong>
                                </p>
                                @endif
                                <hr>
                                    <a href="/tematy/{{$quiz->temat}}" class="btn btn-info col-3 offset-3">Powrót</a>
                                
                                <button class="btn btn-info col-3" onClick="start()">Rozpocznij</button>
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
                                            <p class="card-text">{{$pytanie->tresc}}</p>
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
                            <div class="card-header"><h3 class="text-center">Koniec!</h3></div>
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

