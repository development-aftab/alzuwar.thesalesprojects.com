

<body class="hotels transportation faq_page">

<?php $__env->startSection('content'); ?>


    <section class="privacy_policy_sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="privacy_policy_content">
                        <h1><?php echo ($pages->where('slug','termsandconditions')->first()->title??'Not Available'); ?></h1>   
                        <?php echo ($pages->where('slug','termsandconditions')->first()->description??'Not Available'); ?>

                    </div>
                </div>
            </div>
        </div>
    </section>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('website.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/terms_and_conditions.blade.php ENDPATH**/ ?>