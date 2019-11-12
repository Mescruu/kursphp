    <?php if(count($errors)>0): ?>
    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

        <div class="alert alert-danger alert-dismissible fade show text-center w-50 mx-auto my-4" role="alert">
            <strong >Holy guacamole! </strong><?php echo e($error); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>

    <?php if(session('success')): ?>

    <div class="alert alert-success alert-dismissible fade show text-center w-50 mx-auto my-4" role="alert">
        <strong >Udało się! </strong> <?php echo e(session('success')); ?>

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <?php endif; ?>

    <?php if(session('error')): ?>

        <div class="alert alert-danger alert-dismissible fade show text-center w-50 mx-auto my-4" role="alert">
            <strong >Holy guacamole! </strong> <?php echo e(session('error')); ?>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

    <?php endif; ?>