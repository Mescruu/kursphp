@extends('layouts.app')

@section('assets')
    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/temat.css') }}" rel="stylesheet">
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
            <a href="#" >Quiz</a>
        </div>
        <div class="btn-diagonal btn-slanted float-left">
            <a href="#" >Zadanie</a>
        </div>

    </div>

@endsection

@section('content')

        <section class="topic-section">
            <div class="container"> <!--kontener/pojemnik calej siatki-->

                <form action="/zapisztemat/{{$temat->id}}" method="POST" id="editform">
                    {{ csrf_field() }}

                    <div class="row">

                        <div class="col-xl-8 col-md-10 col-sm-12 mx-auto editorFrame p-2 pb-0">
                            <input type="text" name="nazwa" class="title" placeholder="Tytuł" value="{{$temat->nazwa}}">
                        </div>
                        
                        <div class="col-xl-8 col-md-10 col-sm-12 mx-auto editorFrame p-2 pb-0">
                            <input type="text" name="opis" class="title" placeholder="Krótki opis" value="{{$temat->opis}}">
                        </div>

                        <div class="d-flex flex-wrap" id="buttons-left">
                            <div class="btn-editor btn-img">
                                <input class="btn-info btn-img" type="button" value="Wstaw obrazek" onclick="pokazOpcje('obraz')">
                            </div>
                            <div class="btn-editor btn-table">
                                <input class="btn-info btn-table" type="button" value="Wstaw tabelę" onclick="pokazOpcje('tabela')"><br>
                            </div>
                            <div class="btn-editor btn-b">
                                <input class="btn-info btn-b" type="button" value="" onclick="dodajBBCode('b')">
                            </div>
                            <div class="btn-editor btn-i">
                                <input class="btn-info btn-i" type="button" value="i" onclick="dodajBBCode('i')">
                            </div>
                            <div class="btn-editor btn-u">
                                <input class="btn-info btn-u" type="button" value="u" onclick="dodajBBCode('u')">
                            </div>
                            <div class="btn-editor btn-code">
                                <input class="btn-info btn-code" type="button" value="Code" onclick="dodajBBCode('code')">
                            </div>
                            <div class="btn-editor btn-hr">
                                <input class="btn-info btn-hr" type="button" value="Przerwa" onclick="dodajBBCode('hr')"><br>
                            </div>
                            <div class="btn-editor btn-center">
                                <input class="btn-info btn-center" type="button" value="Wyśrodkuj" onclick="dodajBBCode('center')">
                            </div>
                            <div class="btn-editor btn-title">
                                <input class="btn-info btn-title" type="button" value="Tytuł" onclick="dodajBBCode('title')">
                            </div>

                            <!--                    <div class="btn-editor btn-stitle">-->
                            <!--                        <input class="btn-info btn-stitle" type="button" value="Podtytuł" onclick="dodajBBCode('stitle')">-->
                            <!--                    </div>-->

                            <div class="btn-editor btn-link">
                                <input class="btn-info btn-link" type="button" value="Link" onclick="dodajBBCode('link')">
                            </div>
                            <div class="btn-editor btn-color">
                                <input class="btn-info btn-color" type="button" value="Kolor" onclick="dodajBBCode('color')">
                            </div>
                            <div class="btn-editor btn-point">
                                <input class="btn-info btn-point" type="button" value="Punkt" onclick="dodajBBCode('point')">
                            </div>
                        </div>


                        <div id="buttons-right">
                            <input class="btn-info" type="submit" value="Zapisz">
                            <input class="btn-info" type="button" value="Podgląd" onclick="podglad()"><br>
                        </div>

                        <div class="col-xl-8 col-md-10 col-sm-12 mx-auto editorFrame p-2" >


                            <textarea name="text" id="text" rows="20"onkeydown="if(event.keyCode===9){var v=this.value,s=this.selectionStart,e=this.selectionEnd;this.value=v.substring(0, s)+'\t'+v.substring(e);this.selectionStart=this.selectionEnd=s+1;return false;}">{{$trescAktualna}}</textarea>
                            <input type="hidden" name="texthtml" id="texthtml"><br>



                        </div>
                    </div>



                    <div class="container-fluid view"> <!--kontener/pojemnik calej siatki-->


                        <div colspan="2" id="formatted">

                            <div class="label-preview">
                                <h2>Podgląd:</h2>
                            </div>


                        </div>
                    </div>

                </form>

            </div>
        </section>
        <section class="window-section">
            <div class="container-fluid"> <!--kontener/pojemnik calej siatki-->

                <div id="opcje">
                    <div id="frame">

                    </div>
                </div>

            </div>

        </section>

@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/expandingTextArea.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/bbcodeConverter.js')}}"></script>
    <script type="text/javascript" src="{{ asset('js/insertAtCursor.js')}}"></script>
    <script type='text/javascript' src="{{ asset('js/functions.js')}}"></script>
    <script type='text/javascript' src="{{ asset('js/addons.js')}}"></script>
@endsection

