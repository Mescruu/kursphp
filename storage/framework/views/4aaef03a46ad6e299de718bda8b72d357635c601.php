<?php $__env->startSection('assets'); ?>
    <link href="<?php echo e(asset('css/temat.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('css/underNav.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>


<?php $__env->startSection('undernav'); ?>

    <div class="col-md-4 col-sm-5 col-xs-3 float-left">
        <h2 >
            Temat <?php echo e($temat->id); ?>

        </h2>
    </div>
    <div class="col-md-5 col-sm-6 col-xs-2">

    <?php if(Auth::user()->typ==Auth::user()->admin): ?>
            <div class="btn-diagonal btn-slanted float-left">
                <a href="/tematy/edycja/<?php echo e($temat->id); ?>" >Edycja</a>
            </div>
    <?php endif; ?>

    <div class="btn-diagonal btn-slanted float-left">
        <a href="#" >Quiz</a>
    </div>
    <div class="btn-diagonal btn-slanted float-left">
         <a href="#" >Zadanie</a>
    </div>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php if(!Auth::guest()): ?> <!--jeżeli użytkownik nie jest gościem-->

    <div class="pokaz-temat-section">

        <div class="container">
            <div class="card">
                <div class="row">

                    <div class="col-12">
                        <h1>Temat <?php echo e($temat->id); ?></h1>
                        <hr class="w-50">
                        <small class="text-center mx-auto">Written on <?php echo e($temat->created_at); ?></small>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12 py-3">
                        <div>
                            <?php echo $temat->trescAktualna; ?>

                        </div>
                    </div>
                </div>

            </div>
          </div>
    </div>


    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>