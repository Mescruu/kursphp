<!--css do poszczegolnej strony-->

<?php $__env->startSection('assets'); ?>
    <link href="<?php echo e(asset('css/underNav.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/login.css')); ?>" rel="stylesheet">

<?php $__env->stopSection(); ?>

<?php $__env->startSection('undernav'); ?>

    <div class="col-md-4 col-sm-5 col-xs-3 float-left">
        <h2 >
            Logowanie
        </h2>
    </div>
    <?php $__env->stopSection(); ?>

    <?php $__env->startSection('content'); ?>

<div class="container">
                    <div class="row">

                        <div class="col-12 col-sm-10 col-md-8 col-xl-6 mx-auto">
                            <!--  offset od rozmiaru "md" (medium) wzwyż o 1 kolumnę -->
                            <div class="card" style="width: 100%">

                                <h2 class="py-3">
                                Zaloguj się!
                                </h2>

                                <div class="signin">

                                    <form class="form-signin justify-content-center " method="POST" action="<?php echo e(route('login')); ?>">
                                        <?php echo e(csrf_field()); ?>


                                        <div class="mx-auto mb-3 form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                                            <label for="email" class="col-md-4 control-label">Adres E-Mail</label>

                                            <div class="col-md-12">
                                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                                <?php if($errors->has('email')): ?>
                                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="mx-auto mb-3 form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                                            <label for="password" class="col-md-12 control-label">Hasło</label>

                                            <div class="col-md-12">
                                                <input id="password" type="password" class="form-control" name="password" required>

                                                <?php if($errors->has('password')): ?>
                                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                                </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="form-group mx-auto mb-3 ">
                                            <div class="col-md-12">
                                                <div class="checkbox w-50 float-left">
                                                    <label>
                                                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Zapamiętaj
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-12 col-md-6 mx-auto">
                                                <button type="submit" class="btn btn-info w-100 mx-auto">
                                                    Zatwierdź
                                                </button>
                                            </div>
                                        </div>

                                        <hr>

                                        <a class="btn btn-link w-100 forgetLink" href="<?php echo e(route('password.request')); ?>">
                                            Zapomniałeś hasła?
                                        </a>
                                        <p class="mt-1 mb-3 text-muted text-center">&copy; 2019-2020</p>
                                    </form>


                                </div>
                            </div>

                    </div>

                </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>