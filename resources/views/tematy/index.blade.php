@extends('layouts.app')
<!--css do poszczegolnej strony-->

@section('assets')
    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/tematy.css') }}" rel="stylesheet">

@endsection

@section('undernav')

    <div class="col-md-4 col-sm-5 col-xs-3 float-left">
        <h2 >
            Lista Tematów
        </h2>
    </div>

@endsection

@section('content')

    <section class="subjcets-section px-md-3 px-sm-0"> <!--klasa sekcji -->
        <div class="container"> <!--kontener/pojemnik calej siatki-->

            <div class="row"> <!-- <div class="row no-gutters"> opakowanie dla kolumn/ no-gutters wylacza odstepy/paddingi pionowe pomiedzy kolumnami-->
                <div class="col-12">

                    @if(count($tematy)>=1)
                        @foreach($tematy as $temat)

                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="heading{{$temat->id}}">
                                            <a class="btn btn-info float-left" href="/tematy/{{$temat->id}}">{{$temat->nazwa}}</a>

                                        <span class="text-center px-4  w-auto short-des">
                                            {{$temat->opis}}
                                        </span>
                                        @if(isset($temat->wykladID))
                                            <a class="btn btn-info float-right" href="/wyklady/{{$temat->wykladID}}">{{$temat->wyklad}}</a>
                                        @endif

                                        {{--                                            <button style="transform: rotate(90deg); width: 50px; height: 50px;" class="btn btn-info float-right collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">--}}
{{--                                                <span >&#10148;</span>--}}
{{--                                            </button>--}}
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="heading{{$temat->id}}" data-parent="#accordionExample">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                    @else
                        <p>Brak udostępnionych tematów.</p>
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection
