<!--css do poszczegolnej strony-->
<?php $__env->startSection('assets'); ?>
        <link href="<?php echo e(asset('css/powitalna.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
        <section class="start px-md-3 px-sm-0"> <!--klasa sekcji -->

                <div class="container"> <!--kontener/pojemnik calej siatki-->

                        <div class="row"> <!-- <div class="row no-gutters"> opakowanie dla kolumn/ no-gutters wylacza odstepy/paddingi pionowe pomiedzy kolumnami-->
                                <div class="col-12 col-sm-6 col-md-5 col-xl-6 row-eq-height col-left">
                                        <!--  offset od rozmiaru "md" (medium) wzwyż o 1 kolumnę -->

                                        <div class="card" style="width: 100%">
                                                <div class="row align-items-center">

                                                        <h1 class="col-12 mx-auto">Witaj na stronie kursu</h1>

                                                        <div class="col-12 col-sm-12 col-md-12 col-lg-12" style="text-align: justify;">
                                                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam at dignissim diam. Nam consequat efficitur egestas.
                                                                Curabitur dapibus, mauris eu interdum rhoncus, diam ligula tempus orci, ac semper purus nisi in mi.
                                                                Nunc vehicula sagittis placerat. Vivamus pharetra pretium porttitor.
                                                                Nam ornare est id odio interdum ullamcorper eget et risus.
                                                        </div>

                                                </div>
                                        </div>

                                </div>
                                <div class="col-12 col-sm-6 col-md-3 col-xl-2 diagonal">
                                        <img src="storage/php.png" class="phpLogo"  alt="PHP">
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-xl-4 col-right">
                                        <!--  offset od rozmiaru "md" (medium) wzwyż o 1 kolumnę -->
                                        <div class="card " style="width: 100%">

                                                <div class="signin">

                                                        <form class="form-signin justify-content-center ">
                                                                <div class="text-center mx-auto mb-4">
                                                                        <h2 class="mx-auto font-weight-normal">Pierwszy raz na stronie?</br>Aktywuj konto!</h2>
                                                                </div>

                                                                <div class="p-0 form-label-group mx-auto mb-3">
                                                                        <input type="email" id="inputLogin" class="form-control" placeholder="Nr indeksu" required autofocus>
                                                                </div>

                                                                <div class="form-label-group mx-auto mb-3">
                                                                        <input type="password" id="inputPassword" class="form-control" placeholder="Hasło" required>
                                                                </div>

                                                                <div class="form-label-group mx-auto mb-3">
                                                                        <input type="email" id="inputEmail" class="form-control" placeholder="Email" required>
                                                                </div>

                                                                <button class="btn  btn-info  mx-auto" type="submit">Sign in</button>
                                                                <p class="mt-5 mb-3 text-muted text-center">&copy; 2019-2020</p>
                                                        </form>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>

        </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>