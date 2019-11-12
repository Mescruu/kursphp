<?php $__env->startSection('content'); ?>
    <a href="/posts" class="btn btn-default">Go Back!</a>
    <h1><?php echo e($post->title); ?></h1>
    <img style="width: 100%;max-width: 500px" src="/storage/cover_images/<?php echo e($post->cover_image); ?>" alt="">

    <div>
        <?php echo $post->body; ?>

    </div>


    <hr>
    <small>Written on <?php echo e($post->created_at); ?>  by <?php echo e($post->user->name); ?></small>
    <hr>
     <?php if(!Auth::guest()): ?> <!--jeżeli użytkownik nie jest gościem-->
         <?php if(Auth::user()->id == $post->user->id): ?> <!--jeżeli id użytkownika równe jest id użytkownika który napisał post..-->
         <a href="/posts/<?php echo e($post->id); ?>/edit" class="btn btn-default">Edit</a>
        <!--USUWANIE-->
        <?php echo Form::open(['action'=>['PostsController@destroy',$post->id],'method'=>'POST', 'class'=>'pull-right']); ?>


        <?php echo Form::hidden('_method','DELETE'); ?> <!-- zeby byl PULL-->
        <?php echo Form::submit('Delete',['class'=>'btn btn-danger']); ?>


        <?php echo Form::close(); ?>

         <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>