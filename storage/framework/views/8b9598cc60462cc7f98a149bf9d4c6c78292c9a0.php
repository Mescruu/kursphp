<!--css do poszczegolnej strony-->

<?php $__env->startSection('assets'); ?>
    <link href="<?php echo e(asset('css/underNav.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/tematy.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('undernav'); ?>

    <div class="col-md-4 col-sm-5 col-xs-3 float-left">
        <h2 >
            Lista Tematów
        </h2>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <section class="subjcets-section px-md-3 px-sm-0"> <!--klasa sekcji -->
        <div class="container"> <!--kontener/pojemnik calej siatki-->

            <div class="row"> <!-- <div class="row no-gutters"> opakowanie dla kolumn/ no-gutters wylacza odstepy/paddingi pionowe pomiedzy kolumnami-->
                <div class="col-12">

                    <?php if(count($listaTematow)>=1): ?>
                        <?php $__currentLoopData = $listaTematow; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="heading<?php echo e($temat->id); ?>">
                                            <a class="btn btn-info float-left" href="/tematy/<?php echo e($temat->id); ?>"><?php echo e($temat->nazwa); ?></a>
                                        <span class="text-center px-4  w-auto short-des">
                                            <?php echo e($temat->opis); ?>

                                        </span>
                                        <?php if(isset($temat->wykladID)): ?>
                                            <a class="btn btn-info float-right" href="/wyklady/<?php echo e($temat->wykladID); ?>"><?php echo e($temat->wyklad); ?></a>
                                        <?php endif; ?>

                                        


                                    </div>
                                </div>
                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p>Brak udostępnionych tematów.</p>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>