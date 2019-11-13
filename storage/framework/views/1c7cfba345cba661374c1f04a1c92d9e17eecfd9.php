<!--css do poszczegolnej strony-->
<?php $__env->startSection('assets'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<h1>
    <?php echo e($grupa->nazwa); ?>

</h1>
<div class="container">
    <table class="table table-striped">
        <tr>
            <td>
                id
            </td>
            <td>
                <?php echo e(Auth::user()->id); ?>

            </td>
        </tr>
        <tr>
            <td>
                nazwa
            </td>
            <td>
                <?php echo e(Auth::user()->imie); ?>

            </td>
        </tr>
    </table>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>