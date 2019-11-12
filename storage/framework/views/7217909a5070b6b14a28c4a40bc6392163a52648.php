<?php $__env->startSection('content'); ?>
    <h1><?php echo $title; //drugi sposób na wyświetlenie zmiennej z kontrolera?></h1>
<p>about</p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>