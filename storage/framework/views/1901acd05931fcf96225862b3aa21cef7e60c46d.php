<?php $__env->startSection('content'); ?>
        <div class="jumbotron text-center">
                <h1><?php echo e($title); ?></h1>
                <p>lorem ipsum lorem ipsum</p>
                <a class="btn btn-primary btn-lg" href="/login" role="button">login</a>
                <a class="btn btn-info btn-lg" href="/register" role="button">register</a>
        </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>