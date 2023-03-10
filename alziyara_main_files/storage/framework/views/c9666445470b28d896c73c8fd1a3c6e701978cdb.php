
<?php $__env->startPush('css'); ?>
<style>
    .view_article_sec{padding-top: 22px}
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<div class="container view_article_sec">
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <?php echo $blogs; ?></div>
        <div class="col-2"></div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('website.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/view_blog.blade.php ENDPATH**/ ?>