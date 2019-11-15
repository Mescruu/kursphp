@extends('layouts.app')
<!--css do poszczegolnej strony-->
@section('assets')

@endsection

@section('content')
<h1>
Profil
</h1>
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
                {{$nazwaGrupy}}
            </td>
        </tr>
    </table>
    <div>
        <a href="/zmienhaslo">Zmień hasło</a>
    </div>
    <div>
        Ilość punktów: {{$iloscPunktow}}
        <a href="/punkty">Zobacz historię</a>
    </div>
</div>
@endsection