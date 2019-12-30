@extends('layouts.app')
<!--css do poszczegolnej strony-->

@section('assets')
<link href="{{ asset('css/underNav.css') }}" rel="stylesheet">
<link href="{{ asset('css/checkbox.css') }}" rel="stylesheet">
<link href="{{ asset('css/login.css') }}" rel="stylesheet">


@endsection

@section('undernav')

<div class="col-md-4 col-sm-5 col-xs-3 float-left">
    <h2 >
        Temat
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
                    Udostępnij grupom temat
                    {{$temat->nazwa}}
                </h2>

                <div class="signin">

                    <form class="form-signin justify-content-center " method="POST" action="/przypiszgrupy/{{$temat->id}}">
                        {{ csrf_field() }}
                        
                        @foreach($grupy as $grupa)
                        <div class="form-group">
                            <label class="container">
                                <input type="hidden" name="{{$grupa->id}}" value="0" />
                                <input type="checkbox" name="{{$grupa->id}}" value="1" {{$grupa->checked}}><span class="checkmark"></span><span class="text">{{$grupa->nazwa}}</span>
                            </label>
                        </div>
                        @endforeach

                        <div class="form-group">
                            <div class="col-12 mb-3 mx-auto">
                                <button type="submit" class="btn btn-info w-100 mx-auto">
                                    Zatwierdź
                                </button>
                            </div>

                            <div class="col-12 mx-auto">
                                    <a href="/panel" class="btn btn-info w-100 mx-auto">Powrót</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection