<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kurs PHP</title>

    <style>
        .container{
        text-align: center;
            width: 100%;
        }

        h2{
            width: 100%;
            text-align: center;
        }

        a{
            color: dimgrey;
        }

        a.btn-info{
            background-color: rgba(119,123,179,1);
            border: 0px solid rgba(119,123,179,1);
            border-radius: 0px;
            width: 20%;
            font-size: 18px;
            text-align: center;
            color: whitesmoke;
            height: 100px;
            padding: 20px;
            margin: 40px 20px;
            text-decoration: none;
            transition: 0.5s;
        }
        a.btn-info:hover{
            background-color: rgba(129,133,189,1);
            border: 0px solid rgba(119,123,179,1)!important;
            border-radius: 0px;
            transition: 0.5s;
        }
        a.btn-info:focus{
            background-color: rgba(109,113,169,1)!important;
            border: 0px solid rgba(119,123,179,1)!important;

            border-radius: 0px;
        }

        p{
            width: 100%;
            text-align: center;
        }


    </style>
</head>
<body>
<div class="container">

    <h2>
        Witaj {{$imie}}!
    </h2>
    <p>
        Wydaje się, że ktoś próbuję zresetować hasło do Twojego konta.
    </p>
    <p>
        Jeżeli to nie Ty zignoruj wiadomość.
    </p>

    <p style="margin-bottom: 30px">
        Jeżeli Ty to zrobiłeś kilknij przycisk poniżej.
    </p>

    <a class="btn-info"  href="{{$link}}">Zresetuj hasło!</a>

    <p style="margin-top: 30px">
        Jeżeli nie możesz klikną w przycisk, skopiuj tekst poniżej i wklej go w przeglądarkę.
    </p>

    <p>
        {{$link}}
    </p>

</div>
</body>
</html>
