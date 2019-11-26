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
                <div data-spy="scroll" data-target="#navbar-example3" data-offset="0" class="questions">

                </div>

                <div class="questions">

                    <div class="row">
                        <div class="col-12">
                            <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                <div class="card-header"><h3>Pytanie 1.</h3></div>
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
                                <div class="card-body">
                                    <p class="card-text">Odpowiedź a.</p>

                                    <form>
                                        <button class="btn mx-auto  btn-lg btn-info w-100 mb-3" type="submit">
                                            Wybierz
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 ">
                            <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                <div class="card-header"><h3>B</h3></div>
                                <div class="card-body">
                                    <p class="card-text">Odpowiedź b.</p>

                                    <form>
                                        <button class="btn mx-auto  btn-lg btn-info w-100 mb-3" type="submit">
                                            Wybierz
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 ">
                            <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                <div class="card-header "><h3>C</h3></div>
                                <div class="card-body">
                                    <p class="card-text">Odpowiedź c.</p>

                                    <form>
                                        <button class="btn mx-auto  btn-lg btn-info w-100 mb-3" type="submit">
                                            Wybierz
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-3 ">
                            <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                <div class="card-header"><h3>D</h3></div>
                                <div class="card-body">
                                    <p class="card-text">Odpowiedź d.</p>

                                    <form>
                                        <button class="btn mx-auto  btn-lg btn-info w-100 mb-3" type="submit">
                                            Wybierz
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>


        </div>
    </div>


@endsection
@section('scripts')

@endsection

