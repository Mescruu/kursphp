<?php $__env->startSection('assets'); ?>
    <link href="<?php echo e(asset('css/underNav.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('undernav'); ?>

    <div class="col-md-4 col-sm-5 col-xs-3 float-left">
        <h2 >
            Temat
        </h2>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php if(!Auth::guest()): ?> <!--jeżeli użytkownik nie jest gościem-->

    <div class="container">
        <a href="/tematy" class="btn btn-default">Go Back!</a>
        <h1>Temat <?php echo e($temat->id); ?></h1>

        <div>
            <?php echo $temat->trescAktualna; ?>

        </div>


        <hr>
        <small>Written on <?php echo e($temat->created_at); ?></small>
        <hr>
    </div>

    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>