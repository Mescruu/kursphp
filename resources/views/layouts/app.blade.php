<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Kurs PHP') }}</title>


    <!-- Bootstrap css -->
    <link href="{{ URL::asset('bootstrap/css/bootstrap.css') }}" rel="stylesheet" />

    <!-- Styles -->
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}

    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    @yield('assets')

</head>
<body>
    <div id="app">
        <header>
            @include('inc.navbar')
        </header>
        <div class="title-section">

            <div class="container"> <!--kontener/pojemnik calej siatki-->
                <div class="row">
                    @yield('undernav')
              </div>
          </div>
         </div>

        <div class="messages">
            @include('inc.messages')
        </div>
        <main>
            @yield('content')
        </main>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('article-ckeditor');
    </script>

    <!-- jquery -->
    <script type="text/javascript" src="{{ URL::asset('js/jquery-3-4-1-min.js') }}"></script>

    <!-- bootstrap.js -->
    <script type="text/javascript" src="{{ URL::asset('bootstrap/js/bootstrap.js') }}"></script>


</body>
</html>
