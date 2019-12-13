@extends('layouts.app')
<!--css do poszczegolnej strony-->

@section('assets')
<link href="{{ asset('css/underNav.css') }}" rel="stylesheet">

<link href="{{ asset('css/profile.css') }}" rel="stylesheet">


@endsection

@section('undernav')

<div class="col-md-4 col-sm-5 col-xs-3 float-left">
    <h2 >
        Panel administracyjny
    </h2>
</div>
@endsection

@section('content')

<section class="profile-section">

    <div class="container py-2">

        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link

                           @if ($errors->isEmpty())
                            active
                            @endif


                            " id="v-pills-notifications-tab" data-toggle="pill" href="#v-pills-notifications" role="tab" aria-controls="v-pills-notifications" aria-selected="true">Powiadomienia
                            @if(isset($notification))
                                @if(count($notification)>0)
                                    <span class="float-right badge badge-primary badge-pill">
                            {{count($notification)}}
                            </span>
                                @endif
                            @endif
                        </a>

                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Twoje dane</a>

                    <a class="nav-link

                 @if($errors->has('current-password'))
                            active
                    @endif
                    " id="v-pills-changepassword-tab" data-toggle="pill" href="#v-pills-changepassword" role="tab" aria-controls="v-pills-changepassword" aria-selected="false">Zmień hasło</a>

                    <a class="nav-link
                 @if ($errors->has('nazwa-grupy'))
                            active
                 @endif
                  " id="v-pills-group-tab" data-toggle="pill" href="#v-pills-group" role="tab" aria-controls="v-pills-group" aria-selected="false">Grupy</a>

                    <a class="nav-link" id="v-pills-student-tab" data-toggle="pill" href="#v-pills-student" role="tab" aria-controls="v-pills-student" aria-selected="false">Studenci</a>

                    <a class="nav-link" id="v-pills-teacher-tab" data-toggle="pill" href="#v-pills-teacher" role="tab" aria-controls="v-pills-teacher" aria-selected="false">Nauczyciele</a>

                    <a class="nav-link"
                       @if($errors->has('nazwa-zadania')||$errors->has('tresc-zadania')||$errors->has('tytul-wyklad')||$errors->has('file'))
                       active
                       @endif
                       id="v-pills-criterion-tab" data-toggle="pill" href="#v-pills-criterion" role="tab" aria-controls="v-pills-criterion" aria-selected="false">Kryterium oceniania</a>

                    <a class="nav-link" id="v-pills-cms-tab" data-toggle="pill" href="#v-pills-cms" role="tab" aria-controls="v-pills-cms" aria-selected="false">Zarządzanie treścią</a>

                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">

                    <div class="tab-pane fade show

                             @if ($errors->isEmpty())
                            active
                            @endif

                    " id="v-pills-notifications" role="tabpanel" aria-labelledby="v-pills-settings-tab">

                        <h2>
                            Powiadomienia
                        </h2>
                        <hr>
                        @if(isset($notification))
                        @if(count($notification)>0)
                        @foreach($notification as $not)

                            @if($not->waga === "kolokwium")
                                        <div class="alert alert-warning alert-dismissible fade show text-center w-100 mx-auto my-4" id="not{{ $not->id }}" role="alert">

                                            <small class="float-left">
                                                {{$not->created_at}}
                                            </small>
                                            <hr>

                                            {{$not->komunikat}}


                                           <button type="button" class="close closeWarning"  data-id="{{ $not->id }}" id="{{ $not->id }}" >
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @else
                                        <div class="alert alert-primary alert-dismissible fade show text-center w-100 mx-auto my-4" id="not{{ $not->id }}" role="alert">

                                            <small class="float-left">
                                                {{$not->created_at}}
                                            </small>
                                            <hr>

                                            {{$not->komunikat}}


                                            <button type="button" class="close closePrimary" data-id="{{ $not->id }}" id="{{ $not->id }}">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                    @endif

                        @endforeach
                        @else
                        <h4 class="w-100">brak powiadomień</h4>
                        @endif

                        @endif

                    </div>

                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                        <h2>
                            Twoje dane
                        </h2>
                        <hr>

                        <table class="table">
                            <tr>
                                <td>
                                    Imie
                                </td>
                                <td>
                                    {{ Auth::user()->imie}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nazwisko
                                </td>
                                <td>
                                    {{ Auth::user()->nazwisko}}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    email
                                </td>
                                <td>
                                    {{ Auth::user()->email}}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Data utworzenia
                                </td>
                                <td>
                                    {{ Auth::user()->created_at}}
                                </td>
                            </tr>
                        </table>



                    </div>

                    <div class="tab-pane fade

                    @if($errors->has('current-password'))
                            active in show
                    @endif

                    " id="v-pills-changepassword" role="tabpanel" aria-labelledby="v-pills-changepassword-tab">
                        <h2 class="w-100">
                            Zmień hasło
                        </h2>

                        <hr>
                        <!--Formularz do zmiany hasła - początek-->
                        <form class="form-signin justify-content-center" method="POST" action="changepassword">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('current-password') ? ' has-error' : '' }}">
                                <label for="new-password" class="col-md-4 control-label">Aktualne hasło</label>

                                <div class="col-12">
                                    <input id="current-password" type="password" class="form-control" name="current-password" required>

                                    @if ($errors->has('current-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('current-password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('new-password') ? ' has-error' : '' }}">
                                <label for="new-password" class="col-md-4 control-label">Nowe hasło</label>

                                <div class="col-12">
                                    <input id="new-password" type="password" class="form-control" name="new-password" required>

                                    @if ($errors->has('new-password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new-password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="new-password-confirm" class="col-md-4 control-label">Potwierdź nowe hasło</label>

                                <div class="col-12">
                                    <input id="new-password-confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-12 mb-3 mx-auto">
                                    <button type="submit" class="btn btn-info mx-auto">
                                        Zmień hasło
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!--Formularz do zmiany hasła - koniec-->

                    </div>

                    <div class="tab-pane fade
                            @if ($errors->has('nazwa-grupy'))
                            active in show
                            @endif

                    " id="v-pills-group" role="tabpanel" aria-labelledby="v-pills-group-tab">
                        <h2 class="w-100">
                            Grupy
                        </h2>



                        <hr>

                        <div class="accordion" id="accordionExample">

                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h5 class=" h-100 my-auto">
                                        Dodaj Grupę

                                        <a href="#createGroup" data-toggle="collapse"  aria-expanded="false" aria-controls="createGroup"  class="btn btn-info add">+ Grupa</a>

                                    </h5>
                                </div>
                            </div>
                                <div class="collapse border
                                 @if ($errors->has('nazwa-grupy'))
                                        in show
                                @endif
                                        "
                                     id="createGroup">
                                    <div class="card-body create-group-body">

                                        <form class="form-signin justify-content-center " method="POST" action="/panel/dodajgrupe">
                                            {{ csrf_field() }}

                                                    <div class="row">

                                                        <div class="col-xs-12 col-sm-6 mb-2">
                                                            <div class="form-group{{ $errors->has('nazwa-grupy') ? ' has-error' : '' }}">

                                                            <input id="nazwa-grupy" type="text" placeholder="Nazwa grupy" class="form-control" name="nazwa-grupy" value="{{ old('nazwa-grupy') }}" required autofocus>

                                                            @if ($errors->has('nazwa-grupy'))
                                                                <span class="help-block">
                                                                   <strong>{{ $errors->first('nazwa-grupy') }}</strong>
                                                                </span>
                                                            @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-6 mb-2">
                                                            <div class="form-group{{ $errors->has('nauczyciel') ? ' has-error' : '' }}">

                                                            <select name="nauczyciel" class="form-control" value="{{ old('nauczyciel') }}" required>
                                                                @foreach($nauczyciele as $teacher)
                                                                    <option>{{$teacher->imie}} {{$teacher->nazwisko}}</option>
                                                                @endforeach
                                                            </select>

                                                            @if ($errors->has('nauczyciel'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('nauczyciel') }}</strong>
                                                                </span>
                                                            @endif
                                                            </div>
                                                        </div>

                                                        <div class="col-xs-12 col-sm-6 col-md-4 ml-auto">
                                                            <button type="submit" class="btn btn-info w-100 mx-auto">
                                                                Zatwierdź
                                                            </button>
                                                        </div>

                                                 </div>
                                        </form>

                                    </div>
                                </div>


                            @foreach($group as $grupa)

                            <div class="card">

                                <div class="card-header" id="headingG{{$grupa->id}}">
                                    <h5 class="mb-0">


                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#G{{$grupa->id}}" aria-expanded="true" aria-controls="collapseG{{$grupa->id}}">

                                            {{$grupa->nazwa}}
                                        </button>





                                    </h5>
                                </div>

                                <div id="G{{$grupa->id}}" class="collapse" aria-labelledby="headingG{{$grupa->id}}" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <table class="table table-sm">
                                            <tr>
                                                <td>
                                                    Lp.
                                                </td>
                                                <td>
                                                    Imie
                                                </td>
                                                <td>
                                                    Nazwisko
                                                </td>
                                                <td>
                                                    Numer Albumu
                                                </td>
                                                <td>
                                                    Ocena
                                                </td>
                                                <td>
                                                   Liczba punktów
                                                </td>
                                                <td>
                                                    
                                                </td>
                                            </tr>
                                            @foreach ($grupa->studenci as $i)
                                            <tr>
                                                <td>
                                                    {{$loop->iteration}}
                                                </td>

                                                <td>
                                                    {{ $i->imie}}
                                                </td>

                                                <td>
                                                    {{ $i->nazwisko}}
                                                </td>

                                                <td>
                                                    {{ $i->nrAlbumu}}
                                                </td>
                                                <td>
                                                    {{$i->ocena}}
                                                </td>
                                                <td>
                                                    {{$i->iloscPunktow}}
                                                </td>
                                                <td>
                                                    <a href="/panel/uzytkownik/{{$i->id}}" class="btn btn-info add">
                                                        Edytuj
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>

                                    </div>
                                </div>
                            </div>
                            @endforeach

                        </div>

                    </div>

                    <div class="tab-pane fade" id="v-pills-student" role="tabpanel" aria-labelledby="v-pills-student-tab">
                        <h2>
                            Studenci
                        </h2>
                        <hr>

                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class=" h-100 my-auto">
                                    Dodaj Studenta

                                    <a href="/panel/dodajstudentazpliku" class="btn btn-info add"> + z pliku</a>
                                    <a href="/panel/dodajstudenta" class="btn btn-info add mr-2"> + Student</a>
                                </h5>
                            </div>
                        </div>

                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                @foreach ($studenci as $i)
                                <a class="nav-item nav-link" id="nav-{{$i->id}}-tab" data-toggle="tab" href="#nav-{{$i->id}}" role="tab" aria-controls="nav-{{$i->id}}" aria-selected="false">{{$i->nazwisko}} {{$i->imie}}</a>
                                @endforeach
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">

                            @foreach ($studenci as $i)
                            <div class="tab-pane fade" id="nav-{{$i->id}}" role="tabpanel" aria-labelledby="nav-{{$i->id}}-tab">

                                <table class="table">
                                    <tr>
                                        <td>
                                            Imie
                                        </td>
                                        <td>
                                            {{ $i->imie}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Nazwisko
                                        </td>
                                        <td>
                                            {{ $i->nazwisko}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            E-mail
                                        </td>
                                        <td>
                                            {{ $i->email}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            Numer Albumu
                                        </td>
                                        <td>
                                            {{ $i->nrAlbumu}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            Grupa
                                        </td>
                                        <td>
                                            {{ $grupa->where('id', $i->idGrupa)->value('nazwa') }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            Liczba punktów
                                        </td>
                                        <td>
                                            {{ $i->iloscPunktow }}
                                        </td>
                                    </tr>
                                </table>
                                <a href="/panel/uzytkownik/{{$i->id}}" class="btn btn-info add">Edytuj</a>
                            </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="tab-pane fade" id="v-pills-teacher" role="tabpanel" aria-labelledby="v-pills-teacher-tab">
                        <h2>
                            Nauczyciele
                        </h2>
                        <hr>

                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class=" h-100 my-auto">
                                    Dodaj Nauczyciela

                                    <a href="/panel/dodajnauczyciela" class="btn btn-info add"> + Nauczyciel</a>
                                </h5>
                            </div>
                        </div>


                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                @foreach ($nauczyciele as $i)
                                <a class="nav-item nav-link" id="nav-{{$i->id}}-tab" data-toggle="tab" href="#nav-{{$i->id}}" role="tab" aria-controls="nav-{{$i->id}}" aria-selected="false">{{$i->nazwisko}} {{$i->imie}}</a>
                                @endforeach
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">

                            @foreach ($nauczyciele as $i)
                            <div class="tab-pane fade" id="nav-{{$i->id}}" role="tabpanel" aria-labelledby="nav-{{$i->id}}-tab">

                                <table class="table">
                                    <tr>
                                        <td>
                                            Imie
                                        </td>
                                        <td>
                                            {{ $i->imie}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Nazwisko
                                        </td>
                                        <td>
                                            {{ $i->nazwisko}}
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            email
                                        </td>
                                        <td>
                                            {{ $i->email}}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            @endforeach
                        </div>

                    </div>

                    <div class="tab-pane fade" id="v-pills-criterion" role="tabpanel" aria-labelledby="v-pills-criterion-tab">
                        <h2>
                            Kryterium oceniania
                        </h2>
                        <hr>

                        <div class="table-responsive">
                            <table class="table table-sm">
                                <tr>
                                    <th>
                                        Ocena
                                    </th>
                                    <th>
                                        Próg punktowy
                                    </th>
                                </tr>
                                <tr>
                                    <td>
                                        3
                                    </td>
                                    <td>
                                        {{$kryterium['trzy']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        4
                                    </td>
                                    <td>
                                        {{$kryterium['cztery']}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        5
                                    </td>
                                    <td>
                                        {{$kryterium['piec']}}
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <a href="/panel/edytujkryterium" class="btn btn-info add">Edytuj</a>

                    </div>

                    <div class="tab-pane fade show" id="v-pills-cms" role="tabpanel" aria-labelledby="v-pills-settings-tab">

                        <h2>
                            Zarządzanie treścią
                        </h2>
                        <hr>

                        <ul class="nav nav-pills justify-content-center mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item w-25">
                                <a class="nav-link  w-100 text-center active" id="pills-contact-tab" data-toggle="pill" href="#pills-tematy" role="tab" aria-controls="pills-contact" aria-selected="false">Tematy</a>
                            </li>
                            
                            <li class="nav-item w-25">
                                <a class="nav-link  w-100 text-center" id="pills-home-tab" data-toggle="pill" href="#pills-quizy" role="tab" aria-controls="pills-home" aria-selected="true">Quizy</a>
                            </li>
                            
                            <li class="nav-item w-25">
                                <a class="nav-link w-100 text-center" id="pills-profile-tab" data-toggle="pill" href="#pills-zadania" role="tab" aria-controls="pills-profile" aria-selected="false">Zadania</a>
                            </li>
                            
                            <li class="nav-item w-25">
                                <a class="nav-link  w-100 text-center" id="pills-contact-tab" data-toggle="pill" href="#pills-wyklady" role="tab" aria-controls="pills-contact" aria-selected="false">Wykłady</a>
                            </li>
                        </ul>

                        <hr>

                        

                        <div class="tab-content" id="pills-tabContent">
                            
                            <!-- Treść zakładki TEMATY -->
                            <div class="tab-pane fade show active" id="pills-tematy" role="tabpanel" aria-labelledby="pills-tematy-tab">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class=" h-100 my-auto">
                                            Dodaj Temat
                                            <a href="/tematy/utworz" class="btn btn-info add mr-2"> + Temat</a>
                                        </h5>
                                    </div>
                                </div>
                                
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        @foreach ($tematy as $i)
                                            <a class="nav-item nav-link" id="nav-{{$i->id}}-tab" data-toggle="tab" href="#tematnav-{{$i->id}}" role="tab" aria-controls="nav-{{$i->id}}" aria-selected="false">{{$i->nazwa}}</a>
                                        @endforeach
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">

                                    @foreach ($tematy as $i)
                                        <div class="tab-pane fade" id="tematnav-{{$i->id}}" role="tabpanel" aria-labelledby="nav-{{$i->id}}-tab">

                                        <table class="table">
                                            <tr>
                                                <td>
                                                    Nazwa
                                                </td>
                                                <td>
                                                    {{ $i->nazwa}}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Udostępniony grupom:
                                                </td>
                                                <td>
                                                    @foreach($i->grupy as $grupa)
                                                        {{ $grupa }}
                                                        @if(!$loop->last)
                                                            <br>
                                                        @endif
                                                    @endforeach
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    Opis
                                                </td>
                                                <td>
                                                    {{ $i->opis}}
                                                </td>
                                            </tr>
                                        </table>
                                            <button class="btn btn-danger add" onclick="removeSubject({{$i->id}},'{{$i->nazwa}}');">Usuń</button>
                                            <button class="btn btn-warning add mr-2" onclick="restoreSubject({{$i->id}},'{{$i->nazwa}}');">Przywróć</button>
                                            <a href="/tematy/{{$i->id}}/edycja" class="btn btn-info add mr-2">Edytuj</a>
                                            <a href="/tematy/{{$i->id}}/grupy" class="btn btn-info add mr-2">Przypisz Grupy</a>
                                            <a href="/tematy/{{$i->id}}" class="btn btn-info add mr-2">Zobacz</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            
                            <!-- Treść zakładki QUIZY -->
                            <div class="tab-pane fade" id="pills-quizy" role="tabpanel" aria-labelledby="pills-quizy-tab">
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class=" h-100 my-auto">
                                            Dodaj Quiz
                                            <a href="/panel/dodajstudenta" class="btn btn-info add mr-2"> + Quiz</a>
                                        </h5>
                                    </div>
                                </div>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">typ</th>
                                        <th scope="col" class="text-center">ilosc pytań</th>
                                        <th scope="col" class="text-center">link</th>
                                        <th scope="col" class="text-center">edycja</th>
                                        <th scope="col" class="text-center">usun</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($quizy as $quiz)
                                        <tr>
                                            <th scope="row" class="text-center">{{$loop->iteration}}</th>
                                            <td class="text-center">
                                                {{$quiz->typ}}
                                            </td>
                                            <td class="text-center">
                                                {{$quiz->iloscPytan}}

                                            </td>
                                            <td>
                                                <a href="quizy/{{$quiz->id}}" class="btn btn-info w-100 mr-2"> przejdź</a>
                                            </td>
                                            <td>
                                                <a href="quizy/{{$quiz->id}}/edycja" class="btn btn-info w-100 mr-2"> edytuj</a>
                                            </td>
                                            <td>
                                                <a href="quizy/{{$quiz->id}}/usun"  onclick="return confirm('Tej operacji nie da się cofnąć!')" class="btn btn-info w-100 mr-2"> usun</a>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Treść zakładki ZADANIA -->
                            <div class="tab-pane fade" id="pills-zadania" role="tabpanel" aria-labelledby="pills-zadania-tab">


                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class=" h-100 my-auto">
                                            Dodaj Zadanie

                                            <a href="#createGroup" data-toggle="collapse"  aria-expanded="false" aria-controls="createGroup"  class="btn btn-info add">+ Zadanie</a>

                                        </h5>
                                    </div>
                                </div>
                                <div class="collapse border
                                 @if ($errors->has('nazwa-grupy'))
                                        in show
                                @endif
                                        "
                                     id="createGroup">
                                    <div class="card-body create-group-body">

                                        <form class="form-signin justify-content-center "  enctype="multipart/form-data"  method="POST" action="zadania/dodaj">
                                            {{ csrf_field() }}

                                            <div class="row">

                                                <div class="col-xs-12 col-sm-6 mb-2">
                                                    <div class="form-group{{ $errors->has('nazwa-zadania') ? ' has-error' : '' }}">

                                                        <input id="nazwa-zadania" type="text" placeholder="Nazwa zadania" class="form-control" name="nazwa-zadania" required autofocus>

                                                        @if ($errors->has('nazwa-zadania'))
                                                            <span class="help-block">
                                                                   <strong>{{ $errors->first('nazwa-zadania') }}</strong>
                                                                </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-xs-12 col-sm-6 mb-2">
                                                    <div class="form-group{{ $errors->has('nazwa-tematu') ? ' has-error' : '' }}">

                                                        <select name="nazwa-tematu" class="form-control" value="{{ old('nazwa-tematu') }}" required>
                                                            @foreach($tematy as $temat)
                                                                    <option>{{$temat->nazwa}}</option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('nazwa-tematu'))
                                                            <span class="help-block">
                                                                    <strong>{{ $errors->first('nazwa-tematu') }}</strong>
                                                                </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-12 mb-2">
                                                    <div class="form-group{{ $errors->has('tresc-zadania') ? ' has-error' : '' }}">

                                                                        <textarea  id="tresc-zadania" type="textarea" placeholder="Tytuł wykładu" class="form-control" name="tresc-zadania" equired autofocus>
                                                                        </textarea>

                                                        @if ($errors->has('tresc-zadania'))
                                                            <span class="help-block">
                                                                    <strong>{{ $errors->first('tresc-zadania') }}</strong>
                                                                </span>
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="col-xs-12 col-sm-6 col-md-4 ml-auto">
                                                    <button type="submit" class="btn btn-info w-100 mx-auto">
                                                        Zatwierdź
                                                    </button>
                                                </div>

                                            </div>
                                        </form>

                                    </div>
                                </div>



                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Zadanie</th>
                                        <th scope="col" class="text-center">Temat</th>
                                        <th scope="col" class="text-center">Treść</th>
                                        <th scope="col" class="text-center">Edycja</th>
                                        <th scope="col" class="text-center">Odpowiedzi</th>
                                        <th scope="col" class="text-center">Usun</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($zadania as $zadanie)
                                        <tr>
                                            <th scope="row" class="text-center">{{$loop->iteration}}</th>

                                            <td class="text-center">
                                                {{$zadanie->nazwa}}
                                            </td>
                                            <td class="text-center">
                                                {{$zadanie->lab}}
                                            </td>

                                            <td>
                                                <a href="#pokaz{{$zadanie->id}}" data-toggle="collapse"  aria-expanded="false" aria-controls="pokaz{{$zadanie->id}}"  class="btn btn-info w-100 mr-2">Pokaż</a>
                                            </td>
                                            <td>
                                                <a href="#edytuj{{$zadanie->id}}" data-toggle="collapse"  aria-expanded="false" aria-controls="edytuj{{$zadanie->id}}"  class="btn btn-info w-100 mr-2">Edytuj</a>
                                            </td>
                                            <td>
                                                <a href="#rozwiazanie{{$zadanie->id}}" data-toggle="collapse"  aria-expanded="false" aria-controls="rozwiazanie{{$zadanie->id}}"  class="btn btn-info w-100 mr-2">Rozwiązania</a>
                                            </td>
                                            <td>
                                                <a href="zadania/{{$zadanie->id}}/usun"  onclick="return confirm('Tej operacji nie da się cofnąć!')" class="btn btn-info w-100 mr-2"> usun</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="7">



                                                <div class="collapse border"
                                                     id="pokaz{{$zadanie->id}}">
                                                    <div class="card-body create-group-body">
                                                            <div class="row">
                                                                <div class="col-12 mb-2">
                                                                    <h5 class="text-center">
                                                                        {{$zadanie->nazwa}}
                                                                    </h5>
                                                                    <small>
                                                                        {{$zadanie->lab}}
                                                                    </small>
                                                                </div>
                                                                <hr>
                                                                <div class="col-12">
                                                                    {{$zadanie->tresc}}
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>

                                                <div class="collapse border"
                                                     id="edytuj{{$zadanie->id}}">
                                                    <div class="card-body create-group-body">

                                                        <form class="form-signin justify-content-center "  enctype="multipart/form-data"  method="POST" action="zadania/{{$zadanie->id}}/edytuj">
                                                            {{ csrf_field() }}

                                                            <div class="row">

                                                                <div class="col-xs-12 col-sm-6 mb-2">
                                                                    <div class="form-group{{ $errors->has('nazwa-zadania') ? ' has-error' : '' }}">

                                                                        <input id="nazwa-zadania" type="text" placeholder="Nazwa zadania" class="form-control" name="nazwa-zadania" value="{{$zadanie->nazwa}}" required autofocus>

                                                                        @if ($errors->has('nazwa-zadania'))
                                                                            <span class="help-block">
                                                                   <strong>{{ $errors->first('nazwa-zadania') }}</strong>
                                                                </span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-xs-12 col-sm-6 mb-2">
                                                                    <div class="form-group{{ $errors->has('nazwa-tematu') ? ' has-error' : '' }}">

                                                                        <select name="nazwa-tematu" class="form-control" value="{{ old('nazwa-tematu') }}" required>
                                                                            <option>{{$zadanie->lab}} </option>
                                                                        @foreach($tematy as $temat)
                                                                            @if($temat->nazwa!==$zadanie->lab)
                                                                                <option>{{$temat->nazwa}}</option>
                                                                                @endif
                                                                            @endforeach
                                                                        </select>

                                                                        @if ($errors->has('nazwa-tematu'))
                                                                            <span class="help-block">
                                                                    <strong>{{ $errors->first('nazwa-tematu') }}</strong>
                                                                </span>
                                                                        @endif
                                                                    </div>
                                                                </div>


                                                                <div class="col-12 mb-2">
                                                                    <div class="form-group{{ $errors->has('tresc-zadania') ? ' has-error' : '' }}">

                                                                        <textarea  id="tresc-zadania" type="textarea" placeholder="Tytuł wykładu" class="form-control" name="tresc-zadania" equired autofocus>
{{$zadanie->tresc}}
                                                                        </textarea>

                                                                        @if ($errors->has('tresc-zadania'))
                                                                            <span class="help-block">
                                                                    <strong>{{ $errors->first('tresc-zadania') }}</strong>
                                                                </span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-xs-12 col-sm-6 col-md-4 ml-auto">
                                                                    <button type="submit" class="btn btn-info w-100 mx-auto">
                                                                        Zatwierdź
                                                                    </button>
                                                                </div>

                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>

                                                <div class="collapse border"
                                                     id="rozwiazanie{{$zadanie->id}}">
                                                    <div class="card-body create-group-body">


                                                        <table class="table">
                                                            <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Imie studenta</th>
                                                                <th scope="col">Nazwisko student</th>
                                                                <th scope="col">Data wstawienia</th>
                                                                <th scope="col">Data aktualizacji</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">link</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($zadanie->rozwiazania as $rozwiazanie)
                                                                <tr
                                                                @if($rozwiazanie->oceniono=="nie")
                                                                    class="alert-warning"
                                                                @endif
                                                                >
                                                                    <th scope="row">{{$loop->iteration}}</th>
                                                                    <td>{{$rozwiazanie->uzytkownik->imie}}</td>
                                                                    <td>{{$rozwiazanie->uzytkownik->nazwisko}}</td>
                                                                    <td>{{$rozwiazanie->created_at}}</td>
                                                                    <td>{{$rozwiazanie->updated_at}}</td>
                                                                    <td>
                                                                        @if($rozwiazanie->oceniono=="nie")

                                                                                <a class="btn btn-info  w-100" href="/panel/uzytkownik/{{$rozwiazanie->uzytkownik->id}}/dodajpunkty/{{$rozwiazanie->id}}">Do oceny</a>
                                                                        @else
                                                                            Oceniono
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-info" style="height: 100%;" href="zadania/{{$zadanie->id}}/{{$rozwiazanie->uzytkownik->id}}/link">&#8681;</a>
                                                                    </td>

                                                                </tr>
                                                         @endforeach

                                                                </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </td>
                                        </tr>


                                    @endforeach

                                    </tbody>
                                </table>

                            </div>


                            <!-- Treść zakładki WYKŁADY-->
                            <div class="tab-pane fade" id="pills-wyklady" role="tabpanel" aria-labelledby="pills-wyklady-tab">

                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h5 class=" h-100 my-auto">
                                            Dodaj Grupę

                                            <a href="#createGroup" data-toggle="collapse"  aria-expanded="false" aria-controls="createGroup"  class="btn btn-info add">+ Wyklad</a>

                                        </h5>
                                    </div>
                                </div>
                                <div class="collapse border
                                 @if ($errors->has('nazwa-grupy'))
                                        in show
                                @endif
                                        "
                                     id="createGroup">
                                    <div class="card-body create-group-body">

                                        <form class="form-signin justify-content-center "  enctype="multipart/form-data"  method="POST" action="wyklady/dodaj">
                                            {{ csrf_field() }}

                                            <div class="row">

                                                <div class="col-xs-12 col-sm-6 mb-2">
                                                    <div class="form-group{{ $errors->has('tytul-wykladu') ? ' has-error' : '' }}">

                                                        <input id="tytul-wykladu" type="text" placeholder="Tytuł wykładu" class="form-control" name="tytul-wykladu" value="{{ old('tytul-wykladu') }}" required autofocus>

                                                        @if ($errors->has('tytul-wykladu'))
                                                            <span class="help-block">
                                                                   <strong>{{ $errors->first('tytul-wykladu') }}</strong>
                                                                </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 mb-2">
                                                    <div class="form-group{{ $errors->has('nazwa-tematu') ? ' has-error' : '' }}">

                                                        <select name="nazwa-tematu" class="form-control" value="{{ old('nazwa-tematu') }}" required>
                                                            @foreach($tematy as $temat)
                                                                <option>{{$temat->nazwa}}</option>
                                                            @endforeach
                                                        </select>

                                                        @if ($errors->has('nazwa-tematu'))
                                                            <span class="help-block">
                                                                    <strong>{{ $errors->first('nazwa-tematu') }}</strong>
                                                                </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-xs-12 col-sm-6 mb-2">
                                                    <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                                                    <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">

                                                    @if ($errors->has('file'))
                                                        <span class="help-block">
                                                              <strong>{{ $errors->first('file') }}</strong>
                                                        </span>
                                                    @endif
                                                   </div>

                                                </div>

                                                <div class="col-xs-12 col-sm-6 col-md-4 ml-auto">
                                                    <button type="submit" class="btn btn-info w-100 mx-auto">
                                                        Zatwierdź
                                                    </button>
                                                </div>

                                            </div>
                                        </form>

                                    </div>
                                </div>



                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="text-center">#</th>
                                        <th scope="col" class="text-center">Wykład</th>
                                        <th scope="col" class="text-center">Temat</th>
                                        <th scope="col" class="text-center">link</th>
                                        <th scope="col" class="text-center">edycja</th>
                                        <th scope="col" class="text-center">usun</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($wyklady as $wyklad)
                                        <tr>
                                            <th scope="row" class="text-center">{{$loop->iteration}}</th>

                                            <td class="text-center">
                                                {{$wyklad->tytul}}
                                            </td>
                                            <td class="text-center">
                                                {{$wyklad->lab}}
                                            </td>
                                            <td>
                                                <a href="wyklady/{{$wyklad->id}}" class="btn btn-info w-100 mr-2"> przejdź</a>
                                            </td>
                                            <td>
                                                <a href="#edytuj{{$wyklad->id}}" data-toggle="collapse"  aria-expanded="false" aria-controls="edytuj{{$wyklad->id}}"  class="btn btn-info w-100 mr-2">Edytuj</a>
                                            </td>
                                            <td>
                                                <a href="wyklady/{{$wyklad->id}}/usun"  onclick="return confirm('Tej operacji nie da się cofnąć!')" class="btn btn-info w-100 mr-2"> usun</a>
                                            </td>
                                        </tr>
                                        <tr>
                                           <td colspan="6">
                                               <div class="collapse border"
                                                    id="edytuj{{$wyklad->id}}">
                                                   <div class="card-body create-group-body">

                                                       <form class="form-signin justify-content-center "  enctype="multipart/form-data"  method="POST" action="wyklady/{{$wyklad->id}}/edytuj">
                                                           {{ csrf_field() }}

                                                           <div class="row">

                                                               <div class="col-xs-12 col-sm-6 mb-2">
                                                                   <div class="form-group{{ $errors->has('tytul-wykladu') ? ' has-error' : '' }}">

                                                                       <input id="tytul-wykladu" type="text" placeholder="Tytuł wykładu" class="form-control" name="tytul-wykladu" value="{{$wyklad->tytul}}" required autofocus>

                                                                       @if ($errors->has('tytul-wykladu'))
                                                                           <span class="help-block">
                                                                   <strong>{{ $errors->first('tytul-wykladu') }}</strong>
                                                                </span>
                                                                       @endif
                                                                   </div>
                                                               </div>
                                                               <div class="col-xs-12 col-sm-6 mb-2">
                                                                   <div class="form-group{{ $errors->has('nazwa-tematu') ? ' has-error' : '' }}">

                                                                       <select name="nazwa-tematu" class="form-control" value="{{$wyklad->lab}}" required>
                                                                           <option>{{$wyklad->lab}}</option>
                                                                       @foreach($tematy as $temat)
                                                                               @if($temat->nazwa!=$wyklad->lab)
                                                                                   <option>{{$temat->nazwa}}</option>
                                                                               @endif
                                                                           @endforeach
                                                                       </select>

                                                                       @if ($errors->has('nazwa-tematu'))
                                                                           <span class="help-block">
                                                                    <strong>{{ $errors->first('nazwa-tematu') }}</strong>
                                                                </span>
                                                                       @endif
                                                                   </div>
                                                               </div>
                                                               <div class="col-xs-12 col-sm-6 mb-2">
                                                                   <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                                                                       <input type="file" name="file" class="form-control-file" id="exampleFormControlFile1">

                                                                       @if ($errors->has('file'))
                                                                           <span class="help-block">
                                                              <strong>{{ $errors->first('file') }}</strong>
                                                        </span>
                                                                       @endif
                                                                   </div>

                                                               </div>

                                                               <div class="col-xs-12 col-sm-6 col-md-4 ml-auto">
                                                                   <button type="submit" class="btn btn-info w-100 mx-auto">
                                                                       Zatwierdź
                                                                   </button>
                                                               </div>

                                                           </div>
                                                       </form>

                                                   </div>
                                               </div>
                                           </td>
                                        </tr>


                                    @endforeach

                                    </tbody>
                                </table>

                            </div>
                        </div>


                    </div>


                </div>
            </div>
        </div>

    </div>

</section>
@endsection
@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- jQuery CDN -->
<script type='text/javascript' src="{{ asset('js/removeNotification.js')}}"></script>
<script type='text/javascript' src="{{ asset('js/modifySubject.js')}}"></script>

@endsection