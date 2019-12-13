@extends('layouts.app')

@section('assets')
    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/quiz.css') }}" rel="stylesheet">

@endsection


@section('undernav')

    <div class="col-md-4 col-sm-5 col-xs-3 float-left">
        <h2 >
            <a href="/quizy/{{$quiz->id}}" >Quiz</a>
        </h2>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-2">
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
                    <a href="/wyklady/{{$quiz->wyklad}}" >Wyklad</a>
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


        <section class="quiz-section">
            <div class="container"> <!--kontener/pojemnik calej siatki-->

{{--                <label>ilosc pytań</label>--}}
{{--                <input type="range" class="form-control-range d-none"  id="rangeInput" min="1" max="20" step="1"--}}
{{--                       value="{{$ilosc}}" onclick="warning()" oninput="setValOnInput(this.value)" onchange="setValOnInput(this.value)">--}}

                <form class="form-signin justify-content-center " method="POST" action="/zatwierdzquiz">

                    {!! csrf_field() !!}
                    <div class="title">
                        <h1 class="m-0 p-2">
                            Edycja Quizu
                        </h1 >
                    </div>
                <div class="card-header form-navbar">
                    <div class="row">
                        <div class="col-4 mb-4">
                            <label for="numberInput" class="control-label">ilość pytań</label>

                            <input type="number" min="1" max="20" step="1" id="numberInput" class="form-control "  placeholder="{{$ilosc}}"
                                   oninput="setValOnRange(this.value)"  onclick="warning()" onchange="setValOnRange(this.value)">
                        </div>
                        <div class="col-4 mb-4">
                            <label for="grupa" class="control-label">typ testu</label>

                            <select name="grupa" class="form-control " value="{{$typ}}" required>
                                <option>quiz</option>
                                <option>kolokwium</option>
                            </select>
                        </div>
                        <div class="col-4 mb-4">
                            <label for="grupa" class="control-label">Zakończ tworzenie</label>
                            <button type="submit" class="btn btn-info w-100">Zatwierdź</button>
                        </div>
                    </div>





                    <input class="form-control d-none" id="startValue" name="oldCount" type="number"  value="{{$ilosc}}" >
                    <input class="form-control d-none" id="startValue" name="id" type="number"  value="{{$id}}" >

                    <div  id="pytania" class="questionsContainer" >
                        @foreach($pytania as $pytanie)

                            <div class="form-group " id="pytanie{{$pytanie->nr}}">

                                <div class="row">
                                    <div class="col-12">
                                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                            <div class="card-header"><h3>Pytanie {{$pytanie->nr}}.</h3></div>
                                            <div class="card-body">

                                                <textarea type="text" class="form-control" name="tresc{{$pytanie->nr}}" >{{$pytanie->tresc}}</textarea>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row"> <!-- <div class="row no-gutters"> opakowanie dla kolumn/ no-gutters wylacza odstepy/paddingi pionowe pomiedzy kolumnami-->
                                    <div class="col-12 col-sm-6 col-md-3 ">
                                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                            <div class="card-header"><h3>A</h3></div>
                                            <div class="card-body">
                                                <p class="card-text">Odpowiedź poprawna.</p>

                                                <textarea type="text" class="form-control" name="odpPoprawna{{$pytanie->nr}}">{{$pytanie->odpPoprawna}}</textarea>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3 ">
                                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                            <div class="card-header"><h3>B</h3></div>
                                            <div class="card-body">
                                                <p class="card-text">Odpowiedź a.</p>

                                                <textarea type="text" class="form-control" name="odpA{{$pytanie->nr}}" >{{$pytanie->odpA}}</textarea>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3 ">
                                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                            <div class="card-header "><h3>C</h3></div>
                                            <div class="card-body">
                                                <p class="card-text">Odpowiedź b.</p>

                                                <textarea type="text" class="form-control" name="odpB{{$pytanie->nr}}" >{{$pytanie->odpB}}</textarea>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3 ">
                                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">
                                            <div class="card-header"><h3>D</h3></div>
                                            <div class="card-body">
                                                <p class="card-text">Odpowiedź c.</p>

                                                <textarea type="text" class="form-control" name="odpC{{$pytanie->nr}}">{{$pytanie->odpC}}</textarea>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>


                    </div>
                </form>


            </div>
        </section>

<script>

    let input = document.getElementById("startValue").value;
    let clickCount = 0;
    // alert(input);

    function warning() {
        if(clickCount==0){
            window.confirm('Po zmniejszeniu zostaną usunięte pytania!');
            clickCount++;
        }
    }
    function setValOnInput(newVal){


                document.getElementById("numberInput").value =newVal;
                setInputs(newVal);

    }
    function setValOnRange(newVal){


                document.getElementById("rangeInput").value =newVal;
                setInputs(newVal);

    }

    function setInputs(value) {

        if(value<=input){
            for(let i=1;i<=input;i++)
            {
                if(i>value){
                    removeInputs(i);
                }
            }
        }
        else{

            for(let i=1;i<=value;i++)
            {
                if(i>input){
                    create(i);
                }
            }

        }


        input=value;
    }

    function removeInputs(id) {
        var elem = document.getElementById('pytanie'+id);
        elem.parentNode.removeChild(elem);
        return false;
    }
    function create(id) {

        document.getElementById('pytania').innerHTML += '' +
            '  <div class="form-group " id="pytanie'+id+'">\n' +
            '\n' +
            '                                <div class="row">\n' +
            '                                    <div class="col-12">\n' +
            '                                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">\n' +
            '                                            <div class="card-header"><h3>Pytanie '+id+'.</h3></div>\n' +
            '                                            <div class="card-body">\n' +
            '\n' +
            '                                                <textarea type="text" class="form-control" name="tresc'+id+'" ></textarea>\n' +
            '\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '                                <div class="row"> <!-- <div class="row no-gutters"> opakowanie dla kolumn/ no-gutters wylacza odstepy/paddingi pionowe pomiedzy kolumnami-->\n' +
            '                                    <div class="col-12 col-sm-6 col-md-3 ">\n' +
            '                                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">\n' +
            '                                            <div class="card-header"><h3>A</h3></div>\n' +
            '                                            <div class="card-body">\n' +
            '                                                <p class="card-text">Odpowiedź a.</p>\n' +
            '\n' +
            '                                                <textarea type="text" class="form-control" name="odpPoprawna'+id+'"></textarea>\n' +
            '\n' +
            '\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                    <div class="col-12 col-sm-6 col-md-3 ">\n' +
            '                                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">\n' +
            '                                            <div class="card-header"><h3>B</h3></div>\n' +
            '                                            <div class="card-body">\n' +
            '                                                <p class="card-text">Odpowiedź b.</p>\n' +
            '\n' +
            '                                                <textarea type="text" class="form-control" name="odpA'+id+'" > </textarea>\n' +
            '\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                    <div class="col-12 col-sm-6 col-md-3 ">\n' +
            '                                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">\n' +
            '                                            <div class="card-header "><h3>C</h3></div>\n' +
            '                                            <div class="card-body">\n' +
            '                                                <p class="card-text">Odpowiedź c.</p>\n' +
            '\n' +
            '                                                <textarea type="text" class="form-control" name="odpB'+id+'" > </textarea>\n' +
            '\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                    <div class="col-12 col-sm-6 col-md-3 ">\n' +
            '                                        <div class="card text-dark bg-light mb-3 row-eq-height w-100">\n' +
            '                                            <div class="card-header"><h3>D</h3></div>\n' +
            '                                            <div class="card-body">\n' +
            '                                                <p class="card-text">Odpowiedź d.</p>\n' +
            '\n' +
            '                                                <textarea type="text" class="form-control" name="odpC'+id+'"> </textarea>\n' +
            '\n' +
            '                                            </div>\n' +
            '                                        </div>\n' +
            '                                    </div>\n' +
            '                                </div>\n' +
            '                            </div>';
        return false;
    }



</script>

@endsection
@section('scripts')
{{--    <script type='text/javascript' src="{{ asset('js/addons.js')}}"></script>--}}
@endsection

