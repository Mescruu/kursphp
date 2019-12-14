@extends('layouts.app')

@section('assets')
    <link href="{{ asset('css/zadanie.css') }}" rel="stylesheet">

    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">

@endsection


@section('undernav')

    <div class="col-md-4 col-sm-4 col-xs-3 float-left">
        <h2 >
            Zadanie
        </h2>
    </div>
    <div class="col-md-6 col-sm-8 col-xs-2">

        @if(Auth::user()->typ==\App\User::$admin)
            <div class="btn-diagonal btn-slanted float-left">
                <a href="/zadania/{{$zadanie->id}}/edycja" >Edycja</a>
            </div>
        @endif

        @if(isset($zadanie->temat))
            @if($zadanie->zadanie!="empty")
                <div class="btn-diagonal btn-slanted float-left">
                    <a href="/tematy/{{$zadanie->temat}}" >Temat</a>
                </div>
            @endif
        @endif

        @if(isset($zadanie->wyklad))
            @if($zadanie->wyklad!="empty")
                <div class="btn-diagonal btn-slanted float-left">
                    <a href="/wyklady/{{$zadanie->wyklad}}" >Wyklad</a>
                </div>
            @endif
        @endif

        @if(isset($zadanie->quiz))
            @if($zadanie->quiz!="empty")
                <div class="btn-diagonal btn-slanted float-left">
                    <a href="/quizy/{{$zadanie->quiz}}" >Quiz</a>
                </div>
            @endif
        @endif


    </div>

@endsection

@section('content')

    @if (!Auth::guest()) <!--jeżeli użytkownik nie jest gościem-->

    <div class="pokaz-zadanie-section">

        <div class="container">
            <div class="card">
                <div class="row">

                    <div class="col-12">
                        <h1>{{$zadanie->nazwa}}</h1>
                        <hr class="w-50">
                        @if(isset($zadanie->updated_at))
                            <small class="text-center mx-auto">Ostatnio edytowany {{$zadanie->updated_at}}</small>
                        @endif
                    </div>

                </div>
                <div class="row">
                    <div class="col-12 py-3">
                        <div>
                            {{ $zadanie->tresc }}
                        </div>
                    </div>
                </div>
                <hr class="mx-auto w-50">
                <div class="row">

                    @if($zadanie->oceniono=="tak")
                        @if($zadanie->url!="empty")

                            <h5 class="text-center w-100">
                                Twoj plik
                            </h5>
                            <div class="text-center  w-100 m-5">
                                <a class="mx-auto p-5 zip" href="{{$zadanie->id}}/{{Auth::user()->id}}/link"></a>
                            </div>
                        @endif
                            <hr class="w-50">

                            <h5 class="text-center w-100">
                                Twoje zadanie zostało ocenione.
                            </h5>

                    @endif
                    @if($zadanie->oceniono=="nie")

                        @if($zadanie->url!="empty")
                            <h5 class="text-center w-100">
                                Twoj plik
                            </h5>
                            <div class="text-center  w-100 m-5">
                                <a class="mx-auto p-5 zip" href="{{$zadanie->id}}/{{Auth::user()->id}}/link"></a>
                            </div>
                                <hr class="w-50">


                            @endif
                        <div class="col-12">

                            @if($zadanie->url!="empty")
                                <h5 class="text-center w-100 pb-2">
                                    Edytuj rozwiązanie
                                </h5>
                                @else
                                <h5 class="text-center w-100 pb-2">
                                    Prześlij rozwiązanie
                                </h5>
                            @endif

                            <form class="form-signin row"  enctype="multipart/form-data" method="POST" action="/zadania/{{$zadanie->id}}/odpowiedz">
                                {{ csrf_field() }}

                                @if ($errors->has('file'))
                                    <div class="help-block w-100 text-center mb-2">
                                                         <strong>{{ $errors->first('file') }}</strong>
                                                 </div>
                                @endif
                                <div class="col-12 d-flex justify-content-center form-group{{ $errors->has('file') ? ' has-error' : '' }}">

                                    <div class="upload-file mr-xs-0">

                                        <button class="btn btn-info mr-sm-2 mb-2">Wstaw plik</button>
                                        <input type="file" id="fileInput" name="file" class="form-control-file" multiple onchange="showname()"/>

                                        <button type="submit" class="btn btn-info mb-2">
                                            Zatwierdź
                                        </button>
                                    </div>

                                </div>
                                <div id="showfile" class="col-12 d-flex justify-content-center">
                                    <div id="name">brak pliku</div>
                                    <div id="size"></div>
                                </div>
                            </form>

                        </div>

                    @endif


                </div>
            </div>
        </div>
    </div>


    @endif
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/customInputFile.js')}}"></script>
@endsection
