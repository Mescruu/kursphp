@extends('layouts.app')
<!--css do poszczegolnej strony-->

@section('assets')
<link href="{{ asset('css/underNav.css') }}" rel="stylesheet">

<link href="{{ asset('css/login.css') }}" rel="stylesheet">

<link href="{{ asset('css/tooltip.css') }}" rel="stylesheet">

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
                    Utwórz studentów!
                </h2>

                <div class="signin pb-2">




                    <form class="form-signin justify-content-center "  enctype="multipart/form-data" method="POST" action="/panel/dodajstudentazpliku/dodaj">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <div class="col-12 upload-file">

                                <label for="exampleFormControlFile1">Plik</label>




                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">

                                                    <div class="nicetooltip">
                                                        nazwa
                                                            <span class="tooltiptext" style="font-size: 10px">
                                                             nazwapliku
                                                             </span>

                                                    </div>
                                                    <div class="nicetooltip">
                                                        .csv

                                                        <span class="tooltiptext" style="font-size: 10px">
                                                        . rozrzeszerzenie csv z formatowaniem UTF-8
                                                        </span>

                                                    </div>





                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">


                                                        <div  class="nicetooltip">
                                                            imie;
                                                            <span class="tooltiptext">
                                                             imie wprowadzanego uzytkownika
                                                         </span>
                                                        </div>

                                                         <div  class="nicetooltip">

                                                         nazwisko;
                                                         <span class="tooltiptext">
                                                             nazwisko wprowadzanego uzytkownika
                                                         </span>
                                                         </div>

                                                          <div  class="nicetooltip">

                                                          nrAlbumu;
                                                          <span class="tooltiptext">
                                                             numer albumu wprowadzanego uzytkownika
                                                         </span>
                                                          </div>
                                                 <br>

                                                            <div  class="nicetooltip">

                                                            Jan;
                                                            <span class="tooltiptext">
                                                             przykład
                                                         </span>

                                                            Kowalski;

                                                            990011
                                              <br>
                                                            Anna;
                                                            Nowak;
                                                            990022
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-info" data-dismiss="modal">Wyjdź</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                </div>

                                <button class="btn btn-info w-100 mx-auto">Wstaw plik</button>

                                <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">

                                    @if ($errors->has('file'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('file') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div>

                        <div class="form-group{{ $errors->has('Radio') ? ' has-error' : '' }}">
                            <div class="col-12">
                                <label for="exampleFormControlFile1">Wybierz separator</label>

                                <div class="form-check">


                                    <div class="d-flex bd-highlight">
                                        <div class="p-2 flex-fill">

                                            <label class="radio-container">,
                                                <input type="radio"  name="Radio" value=",">
                                                <span class="checkmark"></span>
                                            </label>

                                        </div>

                                        <div class="p-2 flex-fill">

                                            <label class="radio-container">-
                                                <input type="radio"  name="Radio" value="-">
                                                <span class="checkmark"></span>
                                            </label>

                                        </div>
                                        <div class="p-2 flex-fill">

                                            <label class="radio-container">;
                                                <input type="radio" checked="checked" name="Radio" value=";">
                                                <span class="checkmark"></span>
                                            </label>

                                        </div>
                                    </div>
                                </div>

                                @if ($errors->has('Radio'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('Radio') }}</strong>
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

                                @if ($errors->has('grupa'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('grupa') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        
                        <div class="form-group">
                            <div class="col-12 mx-auto">
                                <p class="text-muted">Hasło zostanie wygenerowane na zasadzie {Imię}{Numer Albumu}</p>
                                <a href="#" class="text-muted btn-point" data-toggle="modal" data-target="#exampleModal">
                                        jak wygląda przykładowy plik?
                                </a>
                            </div>
                        </div>

                        <div class="form-group">


                            <div class="col-12 mb-3 mx-auto">
                                <button type="submit" class="btn btn-info w-100 mx-auto">
                                    Zatwierdź
                                </button>
                            </div>


                        </div>
                    </form>
                    <div class="col-12 mx-auto">
                        <a href="/panel" class="btn btn-info w-100 mx-auto">
                            Powrót
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

