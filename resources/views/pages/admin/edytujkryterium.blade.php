@extends('layouts.app')
<!--css do poszczegolnej strony-->

@section('assets')
<link href="{{ asset('css/underNav.css') }}" rel="stylesheet">

<link href="{{ asset('css/login.css') }}" rel="stylesheet">


@endsection

@section('undernav')

<div class="col-md-4 col-sm-5 col-xs-3 float-left">
    <h2 >
        Kryterium
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
                    Edytuj kryterium oceniania
                </h2>

                <div class="signin">

                    <form class="form-signin justify-content-center " method="POST" action="/editcriterion">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('trzy') ? ' has-error' : '' }}">
                            <label for="trzy" class="col-md-4 control-label">Liczba punktów na ocenę 3.0</label>

                            <div class="col-12">
                                <input id="trzy" type="text" pattern="[0-9]{1,3}" title="liczba 0-999" class="form-control" name="trzy" value="{{ $kryterium['trzy'] }}" required autofocus>

                                @if ($errors->has('trzy'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('trzy') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('cztery') ? ' has-error' : '' }}">
                            <label for="cztery" class="col-md-4 control-label">Liczba punktów na ocenę 4.0</label>

                            <div class="col-12">
                                <input id="cztery" type="text" pattern="[0-9]{1,3}" title="liczba 0-999" class="form-control" name="cztery" value="{{ $kryterium['cztery'] }}" required autofocus>

                                @if ($errors->has('cztery'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cztery') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('piec') ? ' has-error' : '' }}">
                            <label for="piec" class="col-md-4 control-label">Liczba punktów na ocenę 5.0</label>

                            <div class="col-12">
                                <input id="piec" type="text" pattern="[0-9]{1,3}" title="liczba 0-999" class="form-control" name="piec" value="{{ $kryterium['piec'] }}" required autofocus>

                                @if ($errors->has('piec'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('piec') }}</strong>
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