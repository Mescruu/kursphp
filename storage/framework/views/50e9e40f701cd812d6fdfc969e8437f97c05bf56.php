<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Kurs PHP')); ?></title>


    <!-- Bootstrap css -->
    <link href="<?php echo e(URL::asset('bootstrap/css/bootstrap.css')); ?>" rel="stylesheet" />

    <!-- Styles -->


    <link href="<?php echo e(asset('css/main.css')); ?>" rel="stylesheet">

    <?php echo $__env->yieldContent('assets'); ?>

</head>
<body>
    <div id="app">
        <header>
            <?php echo $__env->make('inc.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </header>
        <div class="title-section">

            <div class="container"> <!--kontener/pojemnik calej siatki-->
                <div class="row">
                    <?php echo $__env->yieldContent('undernav'); ?>
              </div>
          </div>
         </div>

        <div class="messages">
            <?php echo $__env->make('inc.messages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        </div>
        <main>
            <?php echo $__env->yieldContent('content'); ?>
        </main>

    </div>

    <!-- Scripts -->
    <script src="<?php echo e(asset('js/app.js')); ?>"></script>

    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('article-ckeditor');
    </script>

    <!-- jquery -->
    <script type="text/javascript" src="<?php echo e(URL::asset('js/jquery-3-4-1-min.js')); ?>"></script>

    <!-- bootstrap.js -->
    <script type="text/javascript" src="<?php echo e(URL::asset('bootstrap/js/bootstrap.js')); ?>"></script>


</body>
</html>
