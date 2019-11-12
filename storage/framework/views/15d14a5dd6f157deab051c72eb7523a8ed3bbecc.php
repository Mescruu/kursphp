<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>


    <!-- Bootstrap css -->
    <link href="<?php echo e(URL::asset('bootstrap/css/bootstrap.css')); ?>" rel="stylesheet" />

    <link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet">

<style>
    body{
        background: -webkit-linear-gradient(-60deg, rgba(245, 245, 245, 1) 70%,   rgba(79,91,147,1)0%);
    }
    main{
        height: 100vh;
        width: 100%;
        background-image: url("storage/php.png");
        background-repeat: no-repeat;
        background-position: 105% 155%;
        background-size: 45%;
    }
    .text{

        width: 25%;


        position: absolute;
        top: 5%;
        left: 15%;
        color: rgba(79,91,147,1);
        font-size: 16rem;
        font-weight: bold;
        font-style: italic;
    }

    /*.alert-primary{*/
    /*    background-color: rgba(79,91,147,1);*/
    /*    color: whitesmoke;*/
    /*}*/
    /*.alert-primary hr{*/
    /*    border-top-color: whitesmoke;*/
    /*}*/

</style>

</head>
<body>
<div id="app">
    <main class="align-items-center">









        <h1 class="text">
            error 404
        </h1>

    </main>
</div>

<!-- Scripts -->
<script src="<?php echo e(asset('js/app.js')); ?>"></script>


<!-- jquery -->
<script type="text/javascript" src="<?php echo e(URL::asset('js/jquery-3-4-1-min.js')); ?>"></script>

<!-- bootstrap.js -->
<script type="text/javascript" src="<?php echo e(URL::asset('bootstrap/js/bootstrap.js')); ?>"></script>


</body>
</html>
