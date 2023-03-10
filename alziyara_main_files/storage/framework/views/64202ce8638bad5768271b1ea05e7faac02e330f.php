
<?php $__env->startPush('css'); ?>
<style>
    .loginform{
        padding:40px;
    }
    .inner_col{
        /* border: 1px solid black; */
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0px 4px 10px rgba(94,92,169,0.4);
        margin: 50px 0;
        width: 100%;
        max-width: 60%;
        margin: 0 auto;
    }
    .loginform .loginheading{
        color: #365CA9;
        font-weight: bold;
        font-size: 50px;

    }
    .loginform input{
        border: none;
        outline: none !important;
        margin: 0 40px;
        font-size: 18px;
        background: none;
    }
    .loginform select{
        border: none;
        outline: none !important;
        /* margin: 0 40px; */
        font-size: 18px;
        background: none;
        width: 100%;
        padding: 0 40px;
        height: 28px;
    }
    .loginform input[type="email"],.loginform input[type="password"]{
        width: 100%;
    }
    .loginform input::placeholder{
        color: #212121;
    }
    .loginform .icon_position{
        position: relative;
        border: 1px solid #E8E8E8;
        padding: 15px 10px;
        border-radius: 5px;
        box-shadow: 0px 5px 10px rgba(0,0,0,0.15);
        width: 100%;
    }

    .loginform .icon_position .icon{
        position: absolute;
        top: 15px;
        left: 12px;
    }
    .loginform .buttons{
        width:100%;
    }
    .loginform .buttons button{
        background-color: #365CA9;
        padding: 10px 40px;
        color: white;
        font-size: 20px;
    }
    .loginform input[type="checkbox"]{
        margin: 0;
        padding: 0;
    }
    .loginform .camera{

        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #9B9B9B;
        display: flex;
        justify-content: center;
        align-items: center;

    }
    .loginform .camera-center{
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
    }
    .loginform .buttons .signup{
        padding: 20px 40px;
        color: #8D8D8D;
        font-size: 20px;
        font-weight: bold;
        text-decoration: none;
    }
    .loginform .buttons span{
        color: #8D8D8D;
        font-size: 20px;
        font-size: 400;
        text-decoration: none;
    }
    .loginform .buttons .login{
        color: #8D8D8D;
        font-size: 20px;
        font-weight: 400;
        text-decoration: none;
        font-weight: bold;
    }
    .loginform .form-check{
        padding: 0;
    }
    .loginform .form-check-label{
        font-size: 17px;
        color: #7e7e7e;
    }

    .loginform .forgotpass a{
        color: #7199E9;
        text-decoration: none;
    }
    .loginform .privacypolicy{
        /* text-decoration: none; */
        /*color: #000;*/
        color: #365ca9;
        text-decoration: underline;
    }

    /*New*/
    .loginform input[type="email"], .loginform input[type="password"] {
        width: 90% !important;
    }

    .loginform input[type="text"] {
        width: 90% !important;
    }
    .loginform textarea.form-control {
        height: auto;
        /*width: 95%;*/
        /*margin: 0 auto;*/
        box-shadow: 0px 5px 10px rgba(0,0,0,0.15);
        border: 1px solid #E8E8E8;;
    }

    .loginform .form-check {
        padding: 0 20px;
    }
    img.profile_pic { height: 100px; width: 100px; border-radius: 50%; object-fit: contain;}
    .image-upload>input {
        display: none;
    }
    .image-upload{
        text-align: center;
        width: 100%;
    }
    .chosen-container-multi .chosen-choices{
        background-image: none !important;
        border: none !important;
        background-color: transparent !important;
        padding: 0 0px 0px 45px !important;
    }
    .chosen-container-active .chosen-choices {
        box-shadow: none !important;
    }
    li.search-choice.search-choice-disabled{
        color: #495057 !important;
        font-size: 18px !important;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
    }
    @media(max-width:1024px){
        .loginform .inner_col{
            width: 100%;
            max-width: 70%;
            margin: 0 auto;
        }
    }
    @media(max-width:768px){
        .loginform .inner_col{
            width: 100%;
            max-width: 100%;
            margin: 0 auto;
        }
    }
    @media(max-width:480px){
        .loginform .form-check label{
            font-size: 15px;
        }
        .loginform .forgotpass a{
            font-size: 15px;
        }
    }
    @media(max-width:375px){
        .loginform .form-check label{
            font-size: 12px;
        }
        .loginform .forgotpass a{
            font-size: 12px;
        }
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    
        
            
                
                    
                
            
        
    
    
        
        
            
        
    
    <section class="loginform">
        <div class="container">
            <div class="inner_col">
                <form method="post" action="<?php echo e(route('password.request')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="token" value="<?php echo e($token); ?>">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            <h1 class="text-center loginheading pb-4">Password Reset</h1>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="mb-4 icon_position">
                                <div class="icon"><img src="<?php echo e(asset('website')); ?>/img/Icon awesome-envelope.png"></div>
                                <input placeholder="Email" id="email" type="email" class="form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" aria-label="Username" aria-describedby="basic-addon1" name="email" value="<?php echo e($email ?: old('email')); ?>" required autofocus readonly>
                                <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="mb-4 icon_position">
                                <div class="icon"><img src="<?php echo e(asset('website')); ?>/img/Icon awesome-key.png" alt=""></div>
                                <input id="password" placeholder="Password" type="password" class="form-control<?php echo e($errors->has('password') ? ' is-invalid' : ''); ?>" aria-label="Username" aria-describedby="basic-addon1" name="password" required>
                                <?php if($errors->has('password')): ?>
                                    <span class="invalid-feedback">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <div class="mb-4 icon_position">
                                <div class="icon"><img src="<?php echo e(asset('website')); ?>/img/Icon awesome-key.png" alt=""></div>
                                <input placeholder="Confirm Password" id="password-confirm" type="password" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="buttons text-center mt-4">
                            <button type="submit" class="btn">Reset&nbsp; <i class="fas fa-arrow-right"></i></button>
                            <span class="d-block  mt-4">Already have an account? <a href="<?php echo e(url('user-login')); ?>" class="login"> Login</a></span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('website.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/auth/passwords/password_change.blade.php ENDPATH**/ ?>