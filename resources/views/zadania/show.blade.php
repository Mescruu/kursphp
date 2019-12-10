@extends('layouts.app')

@section('assets')
    <link href="{{ asset('css/temat.css') }}" rel="stylesheet">

    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">

@endsection


@section('undernav')

    <div class="col-md-4 col-sm-5 col-xs-3 float-left">
        <h2 >
            Temat
        </h2>
    </div>
    <div class="col-md-5 col-sm-6 col-xs-2">

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

    <div class="pokaz-temat-section">

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
                <div class="row">


                    <form class="form-signin justify-content-center "  enctype="multipart/form-data" method="POST" action="/zadania/{{$zadanie->id}}/odpowiedz">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <div class="col-12 mb-3 upload-file">

                                <button class="btn btn-info w-100">Wstaw plik</button>



                                <div id="showfile">
                                    <span id="name">

                                    </span>
                                    <span id="size">

                                    </span>
                                </div>

                                <input type="file" id="fileInput" name="file" class="form-control-file" multiple onchange="showname()"/>
                                @if ($errors->has('file'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                @endif

                                <div class="form-group">


                                    <div class="col-12 mb-3">
                                        <button type="submit" class="btn btn-info w-100">
                                            Zatwierdź
                                        </button>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @endif
@endsection
@section('scripts')
    <script type="text/javascript" src="{{ asset('js/customInputFile.js')}}"></script>
@endsection
