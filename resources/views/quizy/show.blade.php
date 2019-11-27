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
                                <p class="text-center">informacje o quizie</p>
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
                                            <p class="card-text">{{$pytanie->odpPoprawna}}</p>



                                            <label class="container">
                                                <input type="checkbox" name="" value="1" >
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
                                            <p class="card-text">{{$pytanie->odpA}}</p>

                                            <label class="container">
                                                <input type="checkbox" name="" value="1" >
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
                                            <p class="card-text">{{$pytanie->odpB}}</p>

                                            <label class="container">
                                                <input type="checkbox" name="" value="1" >
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
                                            <p class="card-text">{{$pytanie->odpC}}</p>

                                            <label class="container">
                                                <input type="checkbox" name="" value="1" >
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


    let last=0

    function hide(obj) {
        $("#"+obj).hide(500);

        var newValue = parseInt(obj.replace('pytanie', ''));
        newValue++;


        if ($('#pytanie'+newValue).length > 0) {
            show("pytanie"+newValue);
        }
        else{

                        show('results');
                        last=newValue;
        }

    }
    function start(){
        $("#hello").hide(500);
        show('pytanie1');
    }

    function show(obj){
        $("#"+obj).show(500);
    }
    function showall() {
        for(let i=1;i<=last;i++){
            show('pytanie'+i);
        }

        hide('checkOdp');
        hide('back');
        show('bigBack')
    }

</script>

@endsection
@section('scripts')

@endsection

