@extends('layouts.app')
<!--css do poszczegolnej strony-->

@section('assets')
    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">

    <link href="{{ asset('css/login.css') }}" rel="stylesheet">


@endsection

@section('undernav')

    <div class="col-md-4 col-sm-5 col-xs-3 float-left">
        <h2 >
            Nauczyciel
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
                    Utwórz nauczyciela!
                </h2>

                <div class="signin">

                    <form class="form-signin justify-content-center " method="POST" action="/registerteacher">
                        {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('imie') ? ' has-error' : '' }}">
                                <label for="imie" class="col-md-4 control-label">Imię</label>

                                <div class="col-12">
                                    <input id="imie" type="text" class="form-control" name="imie" value="{{ old('imie') }}" required autofocus>

                                    @if ($errors->has('imie'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('imie') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="form-group{{ $errors->has('nazwisko') ? ' has-error' : '' }}">
                                <label for="nazwisko" class="col-md-4 control-label">Nazwisko</label>

                                <div class="col-12">
                                    <input id="nazwisko" type="text" class="form-control" name="nazwisko" value="{{ old('nazwisko') }}" required autofocus>

                                    @if ($errors->has('nazwisko'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nazwisko') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-mail</label>

                                <div class="col-12">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('haslo') ? ' has-error' : '' }}">
                                <label for="haslo" class="col-md-4 control-label">Hasło</label>

                                <div class="col-12">
                                    <input id="haslo" type="password" class="form-control" name="haslo" required>

                                    @if ($errors->has('haslo'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('haslo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="haslo-confirm" class="col-md-4 control-label">Potwierdź hasło</label>

                                <div class="col-12">
                                    <input id="haslo-confirm" type="password" class="form-control" name="haslo_confirmation" required>
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
                                        <a href="/panel">Powrót</a>
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