@extends('layouts.app')

@section('assets')
    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">

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


        <section class="topic-section">
            <div class="container"> <!--kontener/pojemnik calej siatki-->

                <label>ilosc pytań</label>
                <input type="range" class="form-control-range"  id="rangeInput" min="1" max="20" step="1"
                       value="{{$ilosc}}" onclick="warning()" oninput="setValOnInput(this.value)" onchange="setValOnInput(this.value)">

                <form class="form-signin justify-content-center " method="POST" action="/zatwierdzquiz">

                    {!! csrf_field() !!}
                <div class="row">
                    <input type="number" min="1" max="20" step="1" id="numberInput" class="form-control col-6"  placeholder="{{$ilosc}}"
                           oninput="setValOnRange(this.value)"  onclick="warning()" onchange="setValOnRange(this.value)">

                    <select name="grupa" class="form-control col-6" value="{{$typ}}" required>
                        <option>quiz</option>
                        <option>kolokwium</option>
                    </select>



                    <div id="pytania">

                        <input class="form-control d-none" id="startValue" type="number"  value="{{$ilosc}}" >

                        @foreach($pytania as $pytanie)



                            <div class="form-group" id="pytanie{{$pytanie->nr}}">
                                <div class="row">
                                    <input type="text" class="form-control" name="tresc{{$pytanie->nr}}" value="{{$pytanie->tresc}}">
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="odpPoprawna{{$pytanie->nr}}" value="{{$pytanie->odpPoprawna}}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="odpA{{$pytanie->nr}}" value="{{$pytanie->odpA}}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="odpB{{$pytanie->nr}}" value="{{$pytanie->odpB}}">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" name="odpC{{$pytanie->nr}}" value="{{$pytanie->odpC}}">
                                    </div>
                                </div>
                            </div>


                        @endforeach

                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>


            </div>
        </section>

<script>

    let input = document.getElementById("startValue").value;
    let clickCount = 0;
    // alert(input);

    function warning() {
        clickCount++;
        if(clickCount%2!=0){
            window.confirm('Po zmniejszeniu zostaną usunięte pytania!');
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

        document.getElementById('pytania').innerHTML += '                    <div class="form-group" id="pytanie'+id+'">\n' +
            '                        <div class="row">\n' +
            '                            <input type="text" class="form-control" name="trescc'+id+'" placeholder="Pytanie">' +
            '                        </div>\n' +
            '                        <div class="row">\n' +
            '                            <div class="col">\n' +
            '                                <input type="text" class="form-control" name="odpPoprawna'+id+'" placeholder="Odpowiedź poprawna">\n' +
            '                            </div>\n' +
            '                            <div class="col">\n' +
            '                                <input type="text" class="form-control" name="odpA'+id+'" placeholder="Odpowiedź A">\n' +
            '                            </div>\n' +
            '                            <div class="col">\n' +
            '                                <input type="text" class="form-control" name="odpB'+id+'" placeholder="Odpowiedź B">\n' +
            '                            </div>\n' +
            '                            <div class="col">\n' +
            '                                <input type="text" class="form-control" name="odpC'+id+'" placeholder="Odpowiedź C">\n' +
            '                            </div>\n' +
            '                        </div>\n' +
            '                    </div>';
        return false;
    }



</script>

@endsection
@section('scripts')
{{--    <script type='text/javascript' src="{{ asset('js/addons.js')}}"></script>--}}
@endsection

