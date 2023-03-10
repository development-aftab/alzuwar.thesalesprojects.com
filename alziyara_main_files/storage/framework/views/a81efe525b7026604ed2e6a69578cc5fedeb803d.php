
<?php $__env->startPush('css'); ?>
<style type="text/css">
    .error{color: red; font-size: 15px;}
</style>
<?php $__env->stopPush(); ?>
    <?php $__env->startSection('content'); ?>
    <section class="privacy_policy_sec">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="privacy_policy_content">
                  <h1><?php echo ($pages->where('slug','help_faq')->first()->title??'Not Available'); ?></h1>
                  <?php echo ($pages->where('slug','help_faq')->first()->description??'Not Available'); ?>

               </div>
            </div>
         </div>
      </div>
   </section>
   
   <section id="vendor-sec-3">
      <div class="container custom-comtainer">
         <div class="row">
            <div class="col-lg-12 text-center faq_text" data-aos="zoom-in" data-aos-duration="2000">
               <h1><?php echo ($pages->where('slug','faq')->first()->title??'Not Available'); ?></h1>
               <?php echo ($pages->where('slug','faq')->first()->description??'Not Available'); ?>

            </div>
            <div class="col-xl-8 col-lg-7 col-md-6" data-aos="fade-right" data-aos-duration="2000">
               <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="panel panel-default">
                     <div class="panel-heading" role="tab" id="headingOne">
                        <h4 class="panel-title">
                           <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne<?php echo e($key); ?>"
                              aria-expanded="true" aria-controls="collapseOne">
                              <i class="fas fa-plus"></i>
                               <?php echo e($item->title??''); ?>

                           </a>
                        </h4>
                     </div>
                     <div id="collapseOne<?php echo e($key); ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                        <div class="panel-body"> <?php echo $item->description??''; ?></div>
                     </div>
                  </div>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6 Form-text" data-aos="fade-left" data-aos-duration="2000">
               <h2> Ask a Question </h2>
               <form action="<?php echo e(route('ask_A_Question')); ?>" method="post" name="ask_question_form">
                  <?php echo csrf_field(); ?>
                  <div class="form-group">
                     <input type="email" class="form-control" id="email" placeholder="Email Address"
                            aria-describedby="emailHelp" name="email">
                  </div>

                  <div class="form-group">
                           <textarea class="form-control" id="description" placeholder="Message" rows="3" name="description"></textarea>
                  </div>

                  <div class="ball_button accordian_btn">
                     <!-- <a href="#"> SEND &nbsp;<i class="fas fa-arrow-right"></i></a> -->
                     <button class="ball_button accordian_btn" type="submit">Send &nbsp;<i class="fas fa-arrow-right"></i></button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>

    <?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script type="text/javascript">
    $(function() {
            $("form[name='ask_question_form']").validate({
                rules: {
                    email: {
                            required: true,
                            email: true
                    },
                    description: "required",
                },
                messages: {
                    email:           "Please enter your valid Email*",
                    description:     "Please enter your Message*",
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('website.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/help.blade.php ENDPATH**/ ?>