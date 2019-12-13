@extends('layouts.app')
<!--css do poszczegolnej strony-->
@section('assets')
    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">

@endsection

@section('undernav')

    <div class="col-md-4 col-sm-5 col-xs-3 float-left">
        <h2 >
            Użytkownik
        </h2>
    </div>
@endsection

@section('content')
<section class="profile-section">
    <div class="container py-2">

        <div class="row">
            <div class="col-3">
                <a href="/panel" class="btn btn-info">Powrót</a>
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    
                    <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Dane użytkownika</a>

                    <a class="nav-link" id="v-pills-points-tab" data-toggle="pill" href="#v-pills-points" role="tab" aria-controls="v-pills-points" aria-selected="false">Punkty</a>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">

                    <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">

                        <h2>
                            Dane użytkownika
                        </h2>
                        <hr>

                        <table class="table">
                            <tr>
                                <td>
                                    Imię
                                </td>
                                <td>
                                    {{ $user->imie}}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    Nazwisko
                                </td>
                                <td>
                                    {{ $user->nazwisko}}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    E-mail
                                </td>
                                <td>
                                    {{ $user->email}}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Data utworzenia
                                </td>
                                <td>
                                    {{ $user->created_at}}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    Grupa
                                </td>
                                <td class="d-flex">
                                    <div class="flex-fill">
                                        {{$nazwaGrupy}}
                                    </div>
                                    <div class="flex-fill text-right">
                                        <a href="#edytuj{{$user->id}}" data-toggle="collapse"  aria-expanded="false" aria-controls="edytuj{{$user->id}}"  class="btn btn-info mr-auto">Edytuj</a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                            <div class="collapse border
                                 @if ($errors->has('nazwa-grupy'))
                                    in show
@endif
                                    "
                                 id="edytuj{{$user->id}}">
                                <div class="card-body create-group-body">

                                    <form class="form-signin justify-content-center " method="POST" action="/panel/zmiengrupe/{{$user->id}}">
                                        {{ csrf_field() }}

                                        <div class="row">

                                            <div class="col-xs-12 col-sm-6">
                                                <div class="form-group{{ $errors->has('grupa') ? ' has-error' : '' }}">

                                                    <select name="grupa" class="form-control" value="{{ old('grupa') }}" required>
                                                        <option>{{$nazwaGrupy}}</option>

                                                        @foreach($grupy as $grupa)
                                                            @if($grupa->nazwa !== $nazwaGrupy)
                                                                <option>{{$grupa->nazwa}}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>

                                                    @if ($errors->has('grupa'))
                                                        <span class="help-block">
                                                                    <strong>{{ $errors->first('grupa') }}</strong>
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
                                    <a href="/panel/uzytkownik/{{$user->id}}/dodajpunkty" class="btn btn-info add">+ Dodaj</a>
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
                                                {{$i->nauczyciel}}
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
</section>

@endsection