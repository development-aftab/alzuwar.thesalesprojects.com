
<?php $__env->startPush('css'); ?>
<style>

    .sp_banner{
        background-image: url(<?php echo e(asset('website/img/banner_img.png')); ?>);
        background-size: 100% 100%;
        background-repeat: no-repeat;
        padding: 110px 130px;
    }
    .sp_banner .banner_txt h1{
        font-size: 46px;
        font-weight: 600;
        color: white;
        line-height: 72px;
    }
    .sp_banner .banner_txt h1 span{
        color: #DDC01A;
        margin-right: 10px;
    }
    .sp_banner .banner_txt p{
        color: white;
        font-size: 19px;
        width: 49%;
        margin-bottom: 44px;
    }
    .sp_banner .banner_txt a{
        padding: 12px 36px;
        background-color: #DDC01A;
        color: white;
        border-radius: 4px;
        font-size: 16px;
        font-weight: 500;
        text-decoration: none;
    }
    .sp_listing{
        padding: 60px 76px;
        background-color: #F8F8F8;
    }
    .sp_listing .list_boxes{
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 0px 10px;
    }
    .sp_listing .list_boxes h4 {
        font-size: 24px;
        font-weight: 600;
        margin-top: 25px;
        margin-bottom: 20px;
    }

    .sp_listing .list_boxes p{
        color: #8D8D8D;
        font-size: 15px;
        text-align: center;
    }
    .sp_listing .list_boxes img {
        width: 25%;
    }
    .desk_divs{
        padding: 60px 0px;
    }
    .desk_divs .cus_cont{
        max-width: 100%;
        padding:0px;
    }
    .desk_divs .desk_box h2{
        text-align: center;
        font-size: 35px;
        font-weight: 500;
        margin-bottom: 45px;
    }
    .desk_divs .desk_txt{
        display: flex;
        flex-direction: column;
        height: 100%;
        justify-content: center;
    }
    .desk_divs .desk_txt h4{
        font-size: 25px;
        font-weight: 500;
    }
    .desk_divs .desk_txt p{
        margin-left: 28px;
        margin-top: 19px;
        font-size: 19px;
        color: #8D8D8D;
        letter-spacing: -1px;
    }
    .desk_divs .desk_img_2{
        text-align: right;
    }
    .req_sec_table{
        padding: 70px 0px 100px 0px;
        background-color: #F8F8F8;
    }
    .req_sec_table .cus_cont{
        max-width: 87%;
    }
    .req_sec_table .col-md-12 h5{
        background-color: #365CA9;
        border-top-right-radius: 10px;
        border-top-left-radius: 10px;
        text-align: center;
        color: white;
        padding: 20px;
        margin: 0px;
        font-size: 18px;
        font-weight: 500;
    }
    .req_sec_table .req_table th:first-child{
        text-align: center;
    }
    .req_sec_table .req_table td,
    .req_sec_table .req_table th{
        border: 3px solid #F8F8F8;
    }
    .req_sec_table .req_table td:first-child{
        text-align: center;
        border-left: 1px solid #365CA9;
        width: 26%;
    }
    .req_sec_table .req_table th{
        background-color: white;
        padding: 15px;
    }
    .req_sec_table .req_table td{
        padding: 20px 0px;
        background-color: white;
    }
    .req_sec_table .req_table td:last-child {
        padding-left: 50px;
        border-right: 1px solid #365CA9;
        width: 74%;
    }
    .req_sec_table .req_table td p,
    .req_sec_table .req_table th{
        font-size: 16px;
        font-weight: 600;
    }
    .req_sec_table .req_table td img {
        margin-bottom: 5px;
    }
    .req_sec_table .req_table{
        width: 100%;
        box-shadow: rgb(0 0 0 / 10%) 0px 10px 30px 9px, rgb(0 0 0 / 0%) 0px 4px 20px 9px;
    }
    .req_sec_table .req_table tr:last-child td{
        border-bottom: 1px solid #365CA9;
    }
    .req_sec_table .req_table ul{
        list-style-image: url(<?php echo e(asset('website/img/check2-all.png')); ?>);
    }
    .req_sec_table .req_table ul li{
        font-size: 16px;
        color: #8D8D8D;
    }
    .req_sec_table .req_table th:last-child {
        padding-left: 50px;
    }
    .adds{
        padding: 75px 90px;
        background-color: #365CA9;
    }
    .adds .add{
        display: flex;
        align-items: center;
    }
    .adds .add1,
    .adds .add2{
        width: 24%;
    }
    .adds .add3{
        width: 52%;
    }
    .adds .add h2 {
        color: white;
        font-size: 35px;
        margin-left: 35px;
        margin-bottom: 0;
    }
    .desk_img img {
        width: 85%;
        margin-bottom: 40px;
    }
    #vendor-sec-3 {
        padding-top:7%;
        padding-bottom: 3%;
        padding-left: 16%;
        padding-right: 16%;
    }
    #accordion .panel-heading {
        background-color: #fff;
        box-shadow: 0 5px 12px 2px #0000001a;
        margin-bottom: 20px;
    }
    #accordion .panel-title>a {
        padding: 20px;
    }
    #accordion a>i {
        float: right;
        font-size: 16px;
        color: black;
    }
    #vendor-sec-3 textarea {
        padding: 15px 20px;
        border-radius: 8px;
    }
    #vendor-sec-3 input {
        padding: 20px;
        border-radius: 8px;
        box-shadow: none !important;
    }
    #vendor-sec-3 .ball_button.accordian_btn:before {
        width: 50px;
        height: 50px;
        top: -10px;
    }
    button.ball_button.accordian_btn{
        background-color: transparent;
        position: relative;
        border: none;
        font-weight: 600;
        margin-top: 13px;
        color: #000 !important;
        text-transform: uppercase;
        font-size: 16px;
        padding-left: 20px;
    }
    .ball_button.accordian_btn i {
        color: black;
        font-weight: 600;
        font-size: 18px;
    }
    .desk_divs .row {
        padding: 15px 50px;
        margin: 0;
    }
    .desk_divs .row:nth-child(3) {
        background-color: #F8F8F8;
    }
</style>

































































































































































































































<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>

    <section class="sp_banner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner_txt">
                        <h1><span>Experience</span>The World.<br> A World Of <span>Guests.</span></h1>
                        <p>Join us to get booking of your hotels, transport, tours, travel packages, religious events and promote your business to millions of Zuwar worldwide.</p>
                        <a href="<?php echo e(url('home')); ?>">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="sp_listing">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="list_boxes">
                        <img src="<?php echo e(asset('website/img/assign-user-line.png')); ?>" alt="">
                        <h4>Free Sign Up</h4>
                        <p>Register and create a business account for FREE. Get access to your own Alziyara Dashboard.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="list_boxes">
                        <img src="<?php echo e(asset('website/img/globe.png')); ?>" alt="">
                        <h4>Free Sign Up</h4>
                        <p>Register and create a business account for FREE. Get access to your own Alziyara Dashboard.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="list_boxes">
                        <img src="<?php echo e(asset('website/img/noot-book.png')); ?>" alt="">
                        <h4>Free Sign Up</h4>
                        <p>Register and create a business account for FREE. Get access to your own Alziyara Dashboard.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="list_boxes">
                        <img src="<?php echo e(asset('website/img/commission.png')); ?>" alt="">
                        <h4>Free Sign Up</h4>
                        <p>Register and create a business account for FREE. Get access to your own Alziyara Dashboard.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="desk_divs">
        <div class="container cus_cont container-fluid" >
            <div class="row">
                <div class="col-md-12">
                    <div class="desk_box">
                        <h2>Selling with us is simple. Here's how it works...</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-3">
                    <div class="desk_img">
                        <img src="<?php echo e(asset('website/img/desk-img-1.png')); ?>" alt="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="desk_txt">
                        <h4>1. Create your AlZuwar listing</h4>
                        <p>Enter your details to create a new listing-or find your existing one. Easily manage your reviews to build trust with travelers and grow your sales.</p>
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-5">
                    <div class="desk_txt">
                        <h4>2. Build products at your own pace</h4>
                        <p>Use the Management Center to create products, adding photos, pricing, availability and more. Save as you go along and publish when you're ready.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="desk_img desk_img_2">
                        <img src="<?php echo e(asset('website/img/desk-img-2.png')); ?>" alt="">
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                </div>
                <div class="col-md-3">
                    <div class="desk_img">
                        <img src="<?php echo e(asset('website/img/desk-img-1.png')); ?>" alt="">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="desk_txt">
                        <h4>3. Start earning and stay in control</h4>
                        <p>You decide exactly how much you want to earn from each booking and manage your business on your own terms. Simple, hassle-free and flexible.</p>
                    </div>
                </div>
                <div class="col-md-2">
                </div>
            </div>
        </div>
    </section>
    <section class="req_sec_table">
        <div class="container cus_cont">
            <div class="row">
                <div class="col-md-12">
                    <h5>What Are The Requirements?</h5>
                    <table class="req_table">
                        <thead>
                        <tr>
                            <th>Service</th>
                            <th>Requirements</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <img src="<?php echo e(asset('website/img/Travel-Package.png')); ?>" alt="">
                                <p>Travel Package</p>
                            </td>
                            <td>
                                <ul>
                                    <li>I am an agent/owner of travel agency</li>
                                    <li>I have a valid government issued ID card.</li>
                                    <li>I have phone and email address to communicate with customers.</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="<?php echo e(asset('website/img/hotel.png')); ?>" alt="">
                                <p>Travel Package</p>
                            </td>
                            <td>
                                <ul>
                                    <li>I am an agent/owner of travel agency</li>
                                    <li>I have a valid government issued ID card.</li>
                                    <li>I have phone and email address to communicate with customers.</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="<?php echo e(asset('website/img/transportation.png')); ?>" alt="">
                                <p>Travel Package</p>
                            </td>
                            <td>
                                <ul>
                                    <li>I am an agent/owner of travel agency</li>
                                    <li>I have a valid government issued ID card.</li>
                                    <li>I have phone and email address to communicate with customers.</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="<?php echo e(asset('website/img/guid.png')); ?>" alt="">
                                <p>Travel Package</p>
                            </td>
                            <td>
                                <ul>
                                    <li>I am an agent/owner of travel agency</li>
                                    <li>I have a valid government issued ID card.</li>
                                    <li>I have phone and email address to communicate with customers.</li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <img src="<?php echo e(asset('website/img/Shrines-Program.png')); ?>" alt="">
                                <p>Travel Package</p>
                            </td>
                            <td>
                                <ul>
                                    <li>I am an agent/owner of travel agency</li>
                                    <li>I have a valid government issued ID card.</li>
                                    <li>I have phone and email address to communicate with customers.</li>
                                </ul>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
    <section class="adds">
        <div class="container-fluid">
            <div class="row">

                <div class="add add1">
                    <img src="<?php echo e(asset('website/img/website.png')); ?>" alt="">
                    <h2>Website</h2>
                </div>


                <div class="add add2">
                    <img src="<?php echo e(asset('website/img/mobile-phone.png')); ?>" alt="">
                    <h2>Mobile</h2>
                </div>


                <div class="add add3">
                    <img src="<?php echo e(asset('website/img/house.png')); ?>" alt="">
                    <h2>With the Local Help center</h2>
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
                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12" data-aos="fade-right" data-aos-duration="2000">
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
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 Form-text" data-aos="fade-left" data-aos-duration="2000">
                    <h2> Ask a Question </h2>
                    <form action="<?php echo e(route('ask_A_Question')); ?>" method="post" name="ask_question_form">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="Email Address"
                                   aria-describedby="emailHelp" name="email">
                        </div>

                        <div class="form-group">
                            <textarea class="form-control" id="description" placeholder="Message" rows="2" name="description"></textarea>
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



































































































































































<?php echo $__env->make('website.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/list_your_services.blade.php ENDPATH**/ ?>