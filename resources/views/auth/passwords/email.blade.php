@extends('layouts.app')
<!--css do poszczegolnej strony-->

@section('assets')
    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

@endsection

@section('undernav')

    <div class="title-section">

        <div class="container-fluid"> <!--kontener/pojemnik calej siatki-->
            <div class="row">
                <div class="col-md-6 col-sm-4 col-xs-4 float-left">
                    <h2>
                        Resetowanie hasła
                    </h2>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')


    <div class="container">
        <div class="row">

            <div class="col-12 col-sm-10 col-md-8 col-xl-6 mx-auto">
                <!--  offset od rozmiaru "md" (medium) wzwyż o 1 kolumnę -->
                <div class="card" style="width: 100%">

                    <h2 class="py-3">
                        Wyślij link resetujący hasło!
                    </h2>


                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/reset_password_without_token') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <input id="email" type="email" placeholder="E-Mail Address" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                                <div class="col-sm-12 col-md-6 mx-auto">
                                    <button type="submit" class="btn btn-info w-100 mx-auto">
                                    Zatwierdź
                                    </button>
                            </div>
                        </div>
                    </form>
                </div>
    </div>
</div>
    </div>
@endsection
