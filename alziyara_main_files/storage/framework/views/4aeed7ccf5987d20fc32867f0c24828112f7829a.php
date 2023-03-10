

<body class="hotels transportation about_us">

    <?php $__env->startSection('content'); ?>

    <section class="sec-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 Alziyara" data-aos="fade-right" data-aos-duration="3000">
                    <h3> <?php echo ($abouts->where('slug','about')->first()->title??'Not Available'); ?></h3>
                    <?php echo ($abouts->where('slug','about')->first()->description??'Not Available'); ?>

                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-duration="3000">
                    <div class="hotel_bg_img">
                        <img src="<?php echo e(asset('website')); ?>/<?php echo e(($abouts->where('slug','about')->first()->image??'Not Available')); ?>" alt="Transport-service" class="img-fluid">
                    </div>

                </div>
            </div>
        </div>
    </section>



    <?php $__env->stopSection(); ?>
<?php echo $__env->make('website.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/aboutus.blade.php ENDPATH**/ ?>