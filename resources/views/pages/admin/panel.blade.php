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
                    <a class="nav-link active" id="v-pills-notifications-tab" data-toggle="pill" href="#v-pills-notifications" role="tab" aria-controls="v-pills-notifications" aria-selected="true">
                        Powiadomienia

                        <span class="float-right badge badge-primary badge-pill"> .. </span>
                    </a>

                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">Twoje dane</a>

                    <a class="nav-link" id="v-pills-group-tab" data-toggle="pill" href="#v-pills-group" role="tab" aria-controls="v-pills-group" aria-selected="false">Grupy</a>

                    <a class="nav-link" id="v-pills-user-tab" data-toggle="pill" href="#v-pills-user" role="tab" aria-controls="v-pills-user" aria-selected="false">Studenci</a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">

                    <div class="tab-pane fade show active" id="v-pills-notifications" role="tabpanel" aria-labelledby="v-pills-settings-tab">

                        <h2>
                            Powiadomienia
                        </h2>
                        <hr>

                    </div>

                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                        <h2>
                            Dane
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

                            <tr>
                                <td>
                                    Twoje grupy
                                </td>
                                <td>
                                    @foreach($grupy as $grupa)
                                        {{$grupa}}
                                    @endforeach
                                </td>
                            </tr>
                        </table>



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
                                    Dodaj Grupę.

                                    <button class="btn btn-info add" type="button">
                                        <a href="/panel/edytowanie/grupy"> dodaj ></a>
                                    </button>
                                </h5>

                            </div>
                        </div>


                            @foreach($group as $grupa)

                            <div class="card">

                                <div class="card-header" id="heading{{$grupa->nazwa}}">
                                    <h5 class="mb-0">


                                            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#{{$grupa->nazwa}}" aria-expanded="true" aria-controls="collapse{{$grupa->nazwa}}">

                                                Grupa {{$grupa->nazwa}}
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

                    <div class="tab-pane fade" id="v-pills-user" role="tabpanel" aria-labelledby="v-pills-user-tab">
                        <h2>
                            Uzytkownicy
                        </h2>
                        <hr>

                        <div class="card">
                            <div class="card-header" id="headingOne">
                                <h5 class=" h-100 my-auto">
                                    Dodaj Uzytkownikow.

                                    <button class="btn btn-info add" type="button">
                                        <a href="/panel/edytowanie/uzytkownicy"> dodaj ></a>
                                    </button>
                                </h5>
                            </div>
                        </div>






                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                @foreach ($user as $i)
                                        <a class="nav-item nav-link" id="nav-{{$i->id}}-tab" data-toggle="tab" href="#nav-{{$i->id}}" role="tab" aria-controls="nav-{{$i->id}}" aria-selected="false">{{$i->nrAlbumu}}</a>
                                @endforeach
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">

                            @foreach ($user as $i)
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
                                                {{ $i->idGrupa}}
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