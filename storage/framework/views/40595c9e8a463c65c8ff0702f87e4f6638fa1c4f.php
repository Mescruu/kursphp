<!--css do poszczegolnej strony-->

<?php $__env->startSection('assets'); ?>
    <link href="<?php echo e(asset('css/underNav.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/login.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('undernav'); ?>

    <div class="title-section">

        <div class="container-fluid"> <!--kontener/pojemnik calej siatki-->
            <div class="row">
                <div class="col-md-6 col-sm-4 col-xs-4 float-left">
                    <h2>
                        Resetowanie hasła
                    </h2>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <div class="container">
        <div class="row">

            <div class="col-12 col-sm-10 col-md-8 col-xl-6 mx-auto">
                <!--  offset od rozmiaru "md" (medium) wzwyż o 1 kolumnę -->
                <div class="card" style="width: 100%">

                    <h2 class="py-3">
                        Wyślij link resetujący hasło!
                    </h2>


                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <form class="form-horizontal" method="POST" action="<?php echo e(route('password.email')); ?>">
                        <?php echo e(csrf_field()); ?>


                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <div class="col-md-12">
                                <input id="email" type="email" placeholder="E-Mail Address" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                                <div class="col-sm-12 col-md-6 mx-auto">
                                    <button type="submit" class="btn btn-info w-100 mx-auto">
                                    Zatwierdź
                                    </button>
                            </div>
                        </div>
                    </form>
                </div>
    </div>
</div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>