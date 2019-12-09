<?php $__env->startSection('assets'); ?>
    <link href="<?php echo e(asset('css/temat.css')); ?>" rel="stylesheet">

    <link href="<?php echo e(asset('css/underNav.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>


<?php $__env->startSection('undernav'); ?>

    <div class="col-md-4 col-sm-5 col-xs-3 float-left">
        <h2 >
            Temat
        </h2>
    </div>
    <div class="col-md-5 col-sm-6 col-xs-2">

    <?php if(Auth::user()->typ==Auth::user()->admin): ?>
            <div class="btn-diagonal btn-slanted float-left">
                <a href="/tematy/<?php echo e($temat->id); ?>/edycja" >Edycja</a>
            </div>
    <?php endif; ?>



        <?php if(isset($temat->wyklad)): ?>
            <?php if($temat->wyklad!="empty"): ?>
                <div class="btn-diagonal btn-slanted float-left">
                    <a href="/wyklady/<?php echo e($temat->wyklad); ?>" >Wyklad</a>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(isset($temat->quiz)): ?>
            <?php if($temat->quiz!="empty"): ?>
                <div class="btn-diagonal btn-slanted float-left">
                    <a href="/quizy/<?php echo e($temat->quiz); ?>" >Quiz</a>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php if(isset($temat->zadanie)): ?>
            <?php if($temat->zadanie!="empty"): ?>
                <div class="btn-diagonal btn-slanted float-left">
                    <a href="/zadania/<?php echo e($temat->zadanie); ?>" >Zadanie</a>
                </div>
            <?php endif; ?>
        <?php endif; ?>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php if(!Auth::guest()): ?> <!--jeżeli użytkownik nie jest gościem-->

    <div class="pokaz-temat-section">

        <div class="container">
            <div class="card">
                <div class="row">

                    <div class="col-12">
                        <h1><?php echo e($temat->nazwa); ?></h1>
                        <hr class="w-50">
                        <small class="text-center mx-auto">Ostatnio edytowany <?php echo e($temat->updated_at); ?></small>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12 py-3">
                        <div>
                            <?php echo $trescAktualna; ?>

                        </div>
                    </div>
                </div>

            </div>
          </div>
    </div>


    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>