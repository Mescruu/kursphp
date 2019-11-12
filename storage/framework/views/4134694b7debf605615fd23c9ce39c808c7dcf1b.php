<?php $__env->startSection('content'); ?>
    <h1>Edit Post</h1>

    <?php echo Form::open(['action'=> ['PostsController@update',$post->id],'method'=>'POST','enctype'=>'multipart/form-data']); ?>  <!-- wysyla te rzeczy do funkcji store -->
    <div class="form-group">
    <?php echo e(Form::label('title','Title')); ?>  <!-- label inputa -->
    <?php echo e(Form::text('title',$post->title, ['class'=>'form-control','placeholder'=>'Title'])); ?>  <!-- input -->
    </div>

    <div class="form-group">
        <?php echo e(Form::label('body','Body')); ?>

        <?php echo e(Form::textarea('body',$post->body, ['id'=>'article-ckeditor', 'class'=>'form-control','placeholder'=>'Body Text'])); ?>

    </div>

    <!--obrazek -->
    <div class="form-group">
        <?php echo e(Form::file('cover_image')); ?>

    </div>

    <?php echo e(Form::hidden('_method','PUT')); ?> <!--laravel pozwala na oszustwo, gdyż route update wymaga put, a w formie jest POST wiec dodajemy kolejny input? -->
    <?php echo e(Form::submit('Submit',['class'=>'btn btn-primary'])); ?>  <!-- przycisk do wyslania requesta -->

    <?php echo e(Form::close()); ?>  <!-- koniec formularza -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>