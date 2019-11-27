@extends('layouts.app')

@section('assets')
    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/quiz.css') }}" rel="stylesheet">
    <link href="{{ asset('css/checkbox.css') }}" rel="stylesheet">

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
                                                <input type="checkbox" name="" value="1" ><span class="checkmark"
                                                                                                onClick="hide('pytanie{{$pytanie->nr}}')"
                                                ></span>
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 ">
                                    <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                        <div class="card-header"><h3>B</h3></div>
                                        <div class="card-body">
                                            <p class="card-text">{{$pytanie->odpA}}</p>

                                            <button class="btn mx-auto  btn-lg btn-info w-100 mb-3" type="submit"
                                                    onClick="hide('pytanie{{$pytanie->nr}}')"
                                            >
                                                Wybierz
                                            </button>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 ">
                                    <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                        <div class="card-header "><h3>C</h3></div>
                                        <div class="card-body">
                                            <p class="card-text">{{$pytanie->odpB}}</p>

                                            <button class="btn mx-auto  btn-lg btn-info w-100 mb-3" type="submit"
                                                    onClick="hide('pytanie{{$pytanie->nr}}')"
                                            >
                                                Wybierz
                                            </button>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-3 ">
                                    <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                        <div class="card-header"><h3>D</h3></div>
                                        <div class="card-body">
                                            <p class="card-text">{{$pytanie->odpC}}</p>

                                                <button class="btn mx-auto  btn-lg btn-info w-100 mb-3" type="submit"
                                                        onClick="hide('pytanie{{$pytanie->nr}}')"
                                                >
                                                    Wybierz
                                                </button>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>


        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>

        $( document ).ready(function() {
            show("pytanie1");
        });

    function hide(obj) {
        $("#"+obj).hide(500);

        var newValue = parseInt(obj.replace('pytanie', ''));
        newValue++;


        if ($('#pytanie'+newValue).length > 0) {
            show("pytanie"+newValue);
        }
        else{
            // showResults();
        }

    }

    function show(obj){
        $("#"+obj).show(500);
    }

    $(document).ready(function(){

        $(".btn1").click(function(){
            $("p").hide(1000);
        });
        $(".btn2").click(function(){
            $("p").show(1000);
        });
    });
</script>

@endsection
@section('scripts')

@endsection

