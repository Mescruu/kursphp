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
                       value="1" oninput="setValOnInput(this.value)" onchange="setValOnInput(this.value)">

                <input type="number" min="1" max="20" step="1" id="numberInput" class="form-control"  placeholder="1"
                       oninput="setValOnRange(this.value)" onchange="setValOnRange(this.value)">

                <form >
                    <div id="pytania">

                    <div class="form-group" id="pytanie1">
                        <div class="row">
                            <input type="text" class="form-control" placeholder="Pytanie">
                        </div>
                        <div class="row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Odpowiedź poprawna">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Odpowiedź A">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Odpowiedź B">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Odpowiedź C">
                            </div>
                        </div>
                    </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>


            </div>
        </section>

<script>

    let input = 1;

    function setValOnInput(newVal){
        if(newVal< document.getElementById("numberInput").value)
        {
            if (window.confirm('Po zmniejszeniu zostaną usunięte pytania!'))
            {
                document.getElementById("numberInput").value =newVal;
                setInputs(newVal);
            }
        }
        else {
            document.getElementById("numberInput").value =newVal;
            setInputs(newVal);
        }
    }
    function setValOnRange(newVal){

        if(newVal< document.getElementById("rangeInput").value)
        {
            if (window.confirm('Po zmniejszeniu zostaną usunięte pytania!'))
            {
                document.getElementById("rangeInput").value =newVal;
                setInputs(newVal);
            }
        }
        else {
            document.getElementById("rangeInput").value =newVal;
            setInputs(newVal);
        }
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
            '                            <input type="text" class="form-control" placeholder="Pytanie">' +
            '                        </div>\n' +
            '                        <div class="row">\n' +
            '                            <div class="col">\n' +
            '                                <input type="text" class="form-control" placeholder="Odpowiedź poprawna">\n' +
            '                            </div>\n' +
            '                            <div class="col">\n' +
            '                                <input type="text" class="form-control" placeholder="Odpowiedź A">\n' +
            '                            </div>\n' +
            '                            <div class="col">\n' +
            '                                <input type="text" class="form-control" placeholder="Odpowiedź B">\n' +
            '                            </div>\n' +
            '                            <div class="col">\n' +
            '                                <input type="text" class="form-control" placeholder="Odpowiedź C">\n' +
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

