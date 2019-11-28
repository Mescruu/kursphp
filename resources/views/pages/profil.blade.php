@extends('layouts.app')
<!--css do poszczegolnej strony-->
@section('assets')
<link href="{{ asset('css/underNav.css') }}" rel="stylesheet">
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">

@endsection

@section('undernav')

<div class="col-md-4 col-sm-5 col-xs-3 float-left">
    <h2 >
        Profil
    </h2>
</div>
@endsection

@section('content')
<section class="profile-section">
    <div class="container py-2">

        <div class="row">
            <div class="col-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-notifications-tab" data-toggle="pill" href="#v-pills-notifications" role="tab" aria-controls="v-pills-notifications" aria-selected="true">Powiadomienia
                        @if(isset($notification))
                          @if(count($notification)>0)
                            <span class="float-right badge badge-primary badge-pill">
                            {{count($notification)}}
                            </span>
                            @endif
                        @endif
                    </a>

                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Twoje dane</a>

                    <a class="nav-link" id="v-pills-changepassword-tab" data-toggle="pill" href="#v-pills-changepassword" role="tab" aria-controls="v-pills-changepassword" aria-selected="false">Zmień hasło</a>

                    <a class="nav-link" id="v-pills-points-tab" data-toggle="pill" href="#v-pills-points" role="tab" aria-controls="v-pills-points" aria-selected="false">Punkty</a>
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
                                    Imię
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
                                    E-mail
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

                            <tr>
                                <td>
                                    Grupa
                                </td>
                                <td>
                                    {{$nazwaGrupy}}
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

                    <div class="tab-pane fade" id="v-pills-points" role="tabpanel" aria-labelledby="v-pills-points-tab">
                        <h2>
                            Punkty
                        </h2>
                        <hr>

                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class=" h-100 my-auto">
                                    Ilość punktów: {{$iloscPunktow}}
                                </h5>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">
                                    Historia
                                </h5>
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <tr>
                                            <th>
                                                Ilość
                                            </th>
                                            <th>
                                                Komentarz
                                            </th>
                                            <th>
                                                Nauczyciel
                                            </th>
                                            <th>
                                                Data
                                            </th>
                                        </tr>
                                        @foreach($punkty as $i)
                                        <tr>
                                            <td class="align-middle">
                                                {{$i->ilosc}}
                                            </td>
                                            <td class="align-middle">
                                                {{$i->komentarz}}
                                            </td>
                                            <td class="align-middle">
                                                {{$nauczyciele[$i->id]}}
                                            </td>
                                            <td class="align-middle">
                                                {{$i->created_at}}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
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

@endsection