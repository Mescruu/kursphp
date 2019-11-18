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

    <div class="container">
        <table>
            <tr>
                <td>
                    Imie:
                </td>
                <td>
                    {{ Auth::user()->imie}}
                </td>
            </tr>
            <tr>
                <td>
                    Nazwisko:
                </td>
                <td>
                    {{ Auth::user()->nazwisko}}
                </td>
            </tr>
            <tr>
                <td>
                    Numer Albumu:
                </td>
                <td>
                    {{ Auth::user()->nrAlbumu}}
                </td>
            </tr>
            <tr>
                <td>
                    Adres e-mail:
                </td>
                <td>
                    {{ Auth::user()->email}}
                </td>
            </tr>
            <tr>
                <td>
                    Grupa:
                </td>
                <td>
                    @if(isset($nazwaGrupy))
                        {{$nazwaGrupy}}
                    @endif
                </td>
            </tr>
        </table>
        <div>
            <a href="/password/reset">Zmień hasło</a>
        </div>
        <div>
            Ilość punktów:
            @if(isset($iloscPunktow))
                {{$iloscPunktow}}
            @endif
            <a href="/punkty">Zobacz historię</a>
        </div>
    </div>

</section>

@endsection