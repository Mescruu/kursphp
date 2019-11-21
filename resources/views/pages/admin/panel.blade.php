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
                    <a class="nav-link active" id="v-pills-notifications-tab" data-toggle="pill" href="#v-pills-notifications" role="tab" aria-controls="v-pills-notifications" aria-selected="true">Powiadomienia<span class="float-right badge badge-primary badge-pill"> {{count($notification)}} </span></a>

                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Twoje dane</a>

                    <a class="nav-link" id="v-pills-changepassword-tab" data-toggle="pill" href="#v-pills-changepassword" role="tab" aria-controls="v-pills-changepassword" aria-selected="false">Zmień hasło</a>

                    <a class="nav-link" id="v-pills-group-tab" data-toggle="pill" href="#v-pills-group" role="tab" aria-controls="v-pills-group" aria-selected="false">Grupy</a>

                    <a class="nav-link" id="v-pills-student-tab" data-toggle="pill" href="#v-pills-student" role="tab" aria-controls="v-pills-student" aria-selected="false">Studenci</a>
                    
                    <a class="nav-link" id="v-pills-teacher-tab" data-toggle="pill" href="#v-pills-teacher" role="tab" aria-controls="v-pills-teacher" aria-selected="false">Nauczyciele</a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">

                    <div class="tab-pane fade show active" id="v-pills-notifications" role="tabpanel" aria-labelledby="v-pills-settings-tab">

                        <h2>
                            Powiadomienia
                        </h2>
                        <hr>
                        @if(isset($notification))
                            @if(count($notification)>0)
                                @foreach($notification as $not)

                                    <div class="alert alert-primary alert-dismissible fade show text-center w-100 mx-auto my-4" role="alert">

                                        <small class="float-left">
                                            {{$not->created_at}}
                                        </small>
                                        <hr>

                                        {{$not->komunikat}}


                                        <button type="button" class="close" data-id="{{ $not->id }}" id="{{ $not->id }}" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

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
                    
                    <div class="tab-pane fade" id="v-pills-changepassword" role="tabpanel" aria-labelledby="v-pills-changepassword-tab">
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

                    <div class="tab-pane fade" id="v-pills-group" role="tabpanel" aria-labelledby="v-pills-group-tab">
                        <h2 class="w-100">
                            Grupy
                        </h2>



                        <hr>

                        <div class="accordion" id="accordionExample">

                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class=" h-100 my-auto">
                                    Dodaj Grupę

                                        <a href="/panel/dodajgrupe" class="btn btn-info add">+ Grupa</a>
                                </h5>

                            </div>
                        </div>


                            @foreach($group as $grupa)

                            <div class="card">

                                <div class="card-header" id="heading{{$grupa->nazwa}}">
                                    <h5 class="mb-0">


                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#{{$grupa->nazwa}}" aria-expanded="true" aria-controls="collapse{{$grupa->nazwa}}">

                                                {{$grupa->nazwa}}
                                            </button>





                                    </h5>
                                </div>

                                <div id="{{$grupa->nazwa}}" class="collapse" aria-labelledby="heading{{$grupa->nazwa}}" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <table class="table">
                                                <tr>
                                                    <td>
                                                        Imie
                                                    </td>
                                                    <td>
                                                        Nazwisko
                                                    </td>
                                                    <td>
                                                        Numer Albumu
                                                    </td>
                                                </tr>
                                        @foreach ($user as $i)
                                            @if($i->idGrupa==$grupa->id)
                                                    <tr>

                                                        <td>
                                                            {{ $i->imie}}
                                                        </td>

                                                        <td>
                                                            {{ $i->nazwisko}}
                                                        </td>

                                                        <td>
                                                            {{ $i->nrAlbumu}}
                                                        </td>
                                                    </tr>
                                            @endif
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

                                    <a href="/panel/dodajzpliku" class="btn btn-info add"> + z pliku</a>
                                    <a href="/panel/dodajstudenta" class="btn btn-info add"> + Student</a>
                                </h5>
                            </div>
                        </div>

                        Numer Albumu:




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
                                                email
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
                                                Ilość punktów
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

                </div>
            </div>
        </div>

    </div>

</section>
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- jQuery CDN -->
    <script type='text/javascript' src="{{ asset('js/removeNotification.js')}}"></script>

@endsection