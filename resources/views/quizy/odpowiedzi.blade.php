@extends('layouts.app')

@section('assets')
    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/quiz.css') }}" rel="stylesheet">

@endsection


@section('undernav')

    <div class="col-md-4 col-sm-4 col-xs-3 float-left">
        <h2 >
            <a href="/quizy/{{$quiz->id}}" >Quiz</a>

        </h2>
    </div>
    <div class="col-md-6 col-sm-8 col-xs-2">

        @if(Auth::user()->typ==\App\User::$admin)
            <div class="btn-diagonal btn-slanted float-left">
                <a href="/quizy/{{$quiz->id}}/edycja" >Edycja</a>
            </div>
        @endif


    @if(isset($quiz->temat))
            @if($quiz->temat!="empty")
                <div class="btn-diagonal btn-slanted float-left">
                    <a href="/quizy/{{$quiz->temat}}" >Temat</a>
                </div>
            @endif
        @endif

        @if(isset($quiz->wyklad))
            @if($quiz->wyklad!="empty")
                <div class="btn-diagonal btn-slanted float-left">
                    <a href="/wyklady/{{$quiz->wyklad}}" >Wykład</a>
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



            <div class="questions" style="display: none" id="pytania">
                @foreach($pytania as $pytanie)
                    <div class="question"  id="pytanie{{$pytanie->nr}}">

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
                                    <div class="card-body answer
                                    @if($pytanie->twojaOdp==$pytanie->a)

                                            @if($pytanie->twojaOdp==$pytanie->odpPoprawna)
                                            bg-success
                                            @else
                                            bg-danger
                                            @endif
                                            ">
                                        <p class="card-text text-white">{{$pytanie->a}}</p>

                                        @else
                                            @if($pytanie->a==$pytanie->odpPoprawna)
                                                bg-warning
                                            @endif
                                            ">
                                            <p class="card-text">{{$pytanie->a}}</p>

                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 ">
                                <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                    <div class="card-header"><h3>B</h3></div>
                                    <div class="card-body answer
                                    @if($pytanie->twojaOdp==$pytanie->b)
                                        @if($pytanie->twojaOdp==$pytanie->odpPoprawna)
                                            bg-success
                                            @else
                                            bg-danger
                                            @endif
                                            ">
                                        <p class="card-text text-white">{{$pytanie->b}}</p>
                                        @else
                                            @if($pytanie->b==$pytanie->odpPoprawna)
                                                bg-warning
                                            @endif
                                                ">
                                            <p class="card-text">{{$pytanie->b}}</p>

                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 ">
                                <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                    <div class="card-header "><h3>C</h3></div>
                                    <div class="card-body answer
                                    @if($pytanie->twojaOdp==$pytanie->c)
                                            @if($pytanie->twojaOdp==$pytanie->odpPoprawna)
                                            bg-success
                                            @else
                                            bg-danger
                                            @endif
                                            ">
                                        <p class="card-text text-white">{{$pytanie->c}}</p>
                                        @else
                                            @if($pytanie->c==$pytanie->odpPoprawna)
                                                bg-warning
                                            @endif
                                            ">
                                            <p class="card-text">{{$pytanie->c}}</p>

                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 ">
                                <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                    <div class="card-header"><h3>D</h3></div>
                                    <div class="card-body answer
                                    @if($pytanie->twojaOdp==$pytanie->d)
                                            @if($pytanie->twojaOdp==$pytanie->odpPoprawna)
                                            bg-success
                                            @else
                                            bg-danger
                                            @endif
                                            ">
                                        <p class="card-text text-white">{{$pytanie->d}}</p>
                                    @else
                                            @if($pytanie->d==$pytanie->odpPoprawna)
                                                bg-warning
                                            @endif
                                           ">
                                            <p class="card-text">{{$pytanie->d}}</p>

                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach

            </div>

            <div id="hello">

                <div class="row ">
                    <div class="col-12">
                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                            <div class="card-header"><h2>Twój wynik</h2></div>
                            <div class="card-body">
                                <h3 class="text-center">{{$zdobytePunkty}}/{{$wszystkiePunkty}}</h3>
                                
                                <p class="text-center">
                                    @if($zdobytePunkty/$wszystkiePunkty < 0.5)
                                        Musisz się bardziej postarać...
                                    @elseif($zdobytePunkty/$wszystkiePunkty < 0.75)
                                        Całkiem nieźle!
                                    @elseif($zdobytePunkty/$wszystkiePunkty < 1)
                                        Tak blisko!
                                    @elseif($zdobytePunkty/$wszystkiePunkty == 1)
                                        Gratulacje!
                                    @endif
                                </p>

                                <div class="d-flex justify-content-center">

                                    <a href="/tematy/{{$quiz->temat}}" class="btn btn-info col-3 mx-1">Powrót</a>
                                    @if($quiz->typ=="quiz")
                                        <a href="/quizy/{{$id}}"   class="btn btn-info col-3 mx-1">Powtórz test!</a>
                                    @endif
                                    <button onclick="showall()" id="showQuestions" class="btn btn-info col-3 mx-1">Pokaz swoje odpowiedzi</button>


                                </div>



                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
@section('scripts')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/quiz.js')}}"></script>


@endsection

