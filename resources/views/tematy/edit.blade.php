@extends('layouts.app')

@section('assets')
    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/temat.css') }}" rel="stylesheet">
    <link href="{{ asset('css/checkbox.css') }}" rel="stylesheet">
    <link href="{{ asset('css/trescTematu.css') }}" rel="stylesheet">

@endsection


@section('undernav')

    <div class="col-md-4 col-sm-5 col-xs-3 float-left">
        <h2 >
            <a href="/tematy/{{$temat->id}}" >Temat</a>
        </h2>
    </div>
    <div class="col-md-4 col-sm-6 col-xs-2">

        @if(isset($temat->wyklad))
            @if($temat->wyklad!="empty")
                <div class="btn-diagonal btn-slanted float-left">
                    <a href="/wyklady/{{$temat->wyklad}}" >Wykład</a>
                </div>
            @endif
        @endif

        @if(isset($temat->quiz))
            @if($temat->quiz!="empty")
                <div class="btn-diagonal btn-slanted float-left">
                    <a href="/quizy/{{$temat->quiz}}" >Quiz</a>
                </div>
            @endif
        @endif

        @if(isset($temat->zadanie))
            @if($temat->zadanie!="empty")
                <div class="btn-diagonal btn-slanted float-left">
                    <a href="/zadania/{{$temat->zadanie}}" >Zadanie</a>
                </div>
            @endif
        @endif

    </div>

@endsection

@section('content')

        <section class="topic-section">
            <div class="container"> <!--kontener/pojemnik calej siatki-->

                <form action="/zapisztemat/{{$temat->id}}" method="POST" id="editform">
                    {{ csrf_field() }}

                    <div class="row">

                        <div class="col-xl-8 col-md-10 col-sm-12 mx-auto editorFrame p-2 pb-0" id="edytor">
                            <input type="text" name="nazwa" class="title" placeholder="Tytuł" value="{{$temat->nazwa}}">
                        </div>
                        
                        <div class="col-xl-8 col-md-10 col-sm-12 mx-auto editorFrame p-2 pb-0">
                            <input type="text" name="opis" class="title" placeholder="Krótki opis" value="{{$temat->opis}}">
                        </div>

                        <div class="d-flex flex-wrap" id="buttons-left">
                            <div class="btn-editor btn-img">
                                <input class="btn-info btn-img" type="button" value="Wstaw obrazek" title="Wstaw obrazek z opisem" onclick="pokazOpcje('obraz')">
                            </div>
                            <div class="btn-editor btn-table">
                                <input class="btn-info btn-table" type="button" value="Wstaw tabelę" title="Wstaw tabelę" onclick="pokazOpcje('tabela')"><br>
                            </div>
                            <div class="btn-editor btn-code">
                                <input class="btn-info btn-code" type="button" value="Code" title="Listing z opisem" onclick="dodajBBCode('code')">
                            </div>
                            <div class="btn-editor btn-link">
                                <input class="btn-info btn-link" type="button" value="Link" title="Link URL" onclick="dodajBBCode('link')">
                            </div>
                            <div class="btn-editor btn-b">
                                <input class="btn-info btn-b" type="button" value="b" title="Pogrubienie" onclick="dodajBBCode('b')">
                            </div>
                            <div class="btn-editor btn-i">
                                <input class="btn-info btn-i" type="button" value="i" title="Kursywa" onclick="dodajBBCode('i')">
                            </div>
                            <div class="btn-editor btn-u">
                                <input class="btn-info btn-u" type="button" value="u" title="Podkreślenie" onclick="dodajBBCode('u')">
                            </div>
                            <div class="btn-editor btn-center">
                                <input class="btn-info btn-center" type="button" value="Wyśrodkuj" title="Wyśrodkowanie" onclick="dodajBBCode('center')">
                            </div>
                            <div class="btn-editor btn-color">
                                <input class="btn-info btn-color" type="button" value="Kolor" title="Kolor" onclick="dodajBBCode('color')">
                            </div>
                            <div class="btn-editor btn-highlight">
                                <input class="btn-info btn-highlight" type="button" value="Zakreślenie" title="Zakreślenie" onclick="dodajBBCode('highlight')">
                            </div>
                            <div class="btn-editor btn-hr">
                                <input class="btn-info btn-hr" type="button" value="Przerwa" title="Przerwa" onclick="dodajBBCode('hr')"><br>
                            </div>
                            <div class="btn-editor btn-point">
                                <input class="btn-info btn-point" type="button" value="Punkt" title="Punkt" onclick="dodajBBCode('point')">
                            </div>
                            <div class="btn-editor btn-title">
                                <input class="btn-info btn-title" type="button" value="Tytuł" title="Tytuł" onclick="dodajBBCode('title')">
                            </div>
                            <div class="btn-editor btn-stitle">
                                <input class="btn-info btn-stitle" type="button" value="Podtytuł" title="Podtytuł" onclick="dodajBBCode('stitle')">
                            </div>
                            <div class="btn-editor btn-name">
                                <input class="btn-info btn-name" type="button" value="Nazwa" title="Nazwa własna (XAMPP, PHP...)" onclick="dodajBBCode('name')">
                            </div>
                            <div class="btn-editor btn-path">
                                <input class="btn-info btn-path" type="button" value="Ścieżka" title="Ścieżka (index.php, /localhost...)" onclick="dodajBBCode('path')">
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



                    <div class="view w-100">


                        <div id="formatted">

                                <div class="label-preview">
                                    <h2>Podgląd:</h2>
                                </div>
                        </div>
                    </div>

                </form>

            </div>
        </section>
        <section class="window-section">
            <div class="container-fluid">

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

