<?php $__env->startSection('content'); ?>

    <?php if(!Auth::guest()): ?> <!--jeżeli użytkownik nie jest gościem-->

    <a href="/tematy" class="btn btn-default">Go Back!</a>
    <h1>Temat <?php echo e($temat->id); ?></h1>

    <div>
        <?php echo $temat->trescAktualna; ?>

    </div>


    <hr>
    <small>Written on <?php echo e($temat->created_at); ?></small>
    <hr>

    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>