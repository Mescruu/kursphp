@extends('layouts.app')
<!--css do poszczegolnej strony-->

@section('assets')
<link href="{{ asset('css/underNav.css') }}" rel="stylesheet">

<link href="{{ asset('css/login.css') }}" rel="stylesheet">


@endsection

@section('undernav')

<div class="col-md-4 col-sm-5 col-xs-3 float-left">
    <h2 >
        Student
    </h2>
</div>
@endsection

@section('content')


<div class="container">
    <div class="row">

        <div class="col-12 col-sm-10 col-md-8 col-xl-6 mx-auto">
            <!--  offset od rozmiaru "md" (medium) wzwyż o 1 kolumnę -->
            <div class="card" style="width: 100%">

                <h2 class="py-3">
                    Dodaj punkty użytkownikowi {{$user->imie}} {{$user->nazwisko}}
                </h2>

                <div class="signin">

                        @if($rozwiazanie=="empty")
                        <form class="form-signin justify-content-center " method="POST" action="/addpoints/{{$user->id}}">
                        @else
                        <form class="form-signin justify-content-center " method="POST" action="/rateAnAnswer/{{$user->id}}/{{$rozwiazanie}}">
                       @endif

                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('ilosc') ? ' has-error' : '' }}">
                            <label for="ilosc" class="col-md-4 control-label">Ilość</label>

                            <div class="col-12">
                                <input id="ilosc" type="text" pattern="-?[0-9]*" title="liczba dodatnia/ujemna" class="form-control" name="ilosc" value="{{ old('ilosc') }}" required autofocus>

                                @if ($errors->has('ilosc'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('ilosc') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('komentarz') ? ' has-error' : '' }}">
                                <label for="komentarz" class="col-md-4 control-label">Komentarz</label>

                                <div class="col-12">
                                    <input id="komentarz" type="text" class="form-control" name="komentarz" value="{{ old('komentarz') }}" required autofocus>

                                    @if ($errors->has('komentarz'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('komentarz') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        <div class="form-group">


                            <div class="col-12 mb-3 mx-auto">
                                <button type="submit" class="btn btn-info w-100 mx-auto">
                                    Zatwierdź
                                </button>
                            </div>

                            <div class="col-12 mx-auto">
                                <button type="link" class="btn btn-info w-100 mx-auto">
                                    <a href="/panel/uzytkownik/{{$user->id}}">Powrót</a>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection