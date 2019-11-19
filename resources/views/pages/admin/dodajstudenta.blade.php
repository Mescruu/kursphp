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
                    Utwórz studenta!
                </h2>

                <div class="signin">

                    <form class="form-signin justify-content-center " method="POST" action="/registerstudent">
                        {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('nrAlbumu') ? ' has-error' : '' }}">
                                <label for="nrAlbumu" class="col-md-4 control-label">Numer albumu</label>

                                <div class="col-12">
                                    <input id="nrAlbumu" type="number" class="form-control" name="nrAlbumu" value="{{ old('nrAlbumu') }}" required autofocus>

                                    @if ($errors->has('nrAlbumu'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('nrAlbumu') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('grupa') ? ' has-error' : '' }}">
                                <label for="grupa" class="col-md-4 control-label">Grupa</label>

                                <div class="col-12">

                                    <select name="grupa" class="form-control" value="{{ old('grupa') }}" required>
                                    @foreach($grupy as $grupa)
                                                <option>{{$grupa->nazwa}}</option>
                                            @endforeach
                                    </select>

                                    @if ($errors->has('idGrupa'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('grupa') }}</strong>
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