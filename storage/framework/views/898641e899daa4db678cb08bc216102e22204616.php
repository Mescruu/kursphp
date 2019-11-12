<?php $__env->startSection('content'); ?>
    <h1>Create Post</h1>

    <?php echo Form::open(['action'=>'PostsController@store','method'=>'POST','enctype'=>'multipart/form-data']); ?>  <!-- wysyla te rzeczy do funkcji store -->
    <div class="form-group">
        <?php echo e(Form::label('title','Title')); ?>  <!-- label inputa -->
        <?php echo e(Form::text('title','', ['class'=>'form-control','placeholder'=>'Title'])); ?>  <!-- input -->
    </div>

    <div class="form-group">
        <?php echo e(Form::label('body','Body')); ?>

        <?php echo e(Form::textarea('body','', ['id'=>'article-ckeditor', 'class'=>'form-control','placeholder'=>'Body Text'])); ?>

    </div>
    <div class="form-group">
        <?php echo e(Form::file('cover_image')); ?>

    </div>


    <?php echo e(Form::submit('Submit',['class'=>'btn btn-primary'])); ?>  <!-- przycisk do wyslania requesta -->

    <?php echo e(Form::close()); ?>  <!-- koniec formularza -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>