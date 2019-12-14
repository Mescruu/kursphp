@extends('layouts.app')
<!--css do poszczegolnej strony-->
@section('assets')
    <link href="{{ asset('css/temat.css') }}" rel="stylesheet">
    <link href="{{ asset('css/underNav.css') }}" rel="stylesheet">

@endsection

@section('undernav')

    <div class="col-md-4 col-sm-5 col-xs-3 float-left">
        <h2 >
            Strona Główna
        </h2>
    </div>
@endsection

@section('content')
@if (!Auth::guest()) <!--jeżeli użytkownik nie jest gościem-->

    <div class="pokaz-temat-section">

        <div class="container">
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        <h2>Witaj {{ Auth::user()->imie }}!</h2>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="row">
                    <div class="col-12">
                        @if(Auth::user()->typ === 'student')<h2>Twój profil</h2>
                        @else <h2>Panel Administracyjny</h2>
                        @endif
                        <hr class="w-80">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        @if(Auth::user()->typ === 'student')
                        Wejdź w swój profil klikając w zakładkę "Profil" na pasku nawigacji, aby zobaczyć Twoje powiadomienia, dane oraz ilość zdobytych punktów.
                        @else
                        Wejdź w panel administracyjny, aby zobaczyć swoje powiadomienia i dane. Tam również znajdują się narzędzia do zarządzania treści kursu.
                        @endif
                        <hr class="w-80">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2>Tematy</h2>
                        <hr class="w-80">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        Wybierz jeden z dostępnych tematów lub wejdź w ich listę klikając w rozwijalne menu "Tematy" na pasku nawigacji.
                        <hr class="w-80">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <h2>Zadania i Quizy</h2>
                        <hr class="w-80">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center">
                        Do każdego tematu mogą być przypisane zadanie oraz quiz. Rozwiązaniem zadania jest plik w postaci paczki kodu źródłowego aplikacji opisanej w treści zadania, a quizy możesz rozwiązywać wielokrotnie bezpośrednio w aplikacji kursu.
                    </div>
                </div>
            </div>
          </div>
    </div>


@endif
@endsection
