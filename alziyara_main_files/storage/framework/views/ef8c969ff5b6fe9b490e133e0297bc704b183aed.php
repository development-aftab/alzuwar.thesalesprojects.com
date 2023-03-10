
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
    }

    .loginform .icon_position .icon{
        position: absolute;
        top: 15px;
        left: 12px;
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
    .loginform input[type="email"], .loginform input[type="password"] {
        width: 90% !important;
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
        color: #212121;
    }

    .loginform .forgotpass a{
        color: #7199E9;
        text-decoration: none;
    }
    .loginform .privacypolicy{
        /* text-decoration: none; */
        color: #000;
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
    <?php if($errors->any()): ?>
        <div class="row justify-content-center mt-2">
            <div class="col-md-4 alert alert-danger align-center">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p class="text-center">You have entered an invalid username or password</p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
    <?php if(session('message')): ?>
        <!-- <div class="account-title"><?php echo e(session('message')); ?></div> -->
        <div class="account-title">
            
            <p class="alert alert-success text-center"><?php echo e(session('message')); ?>

                <?php if(session('message') == "Need the link of resending email confirmation as it could get lost in emails."): ?>
                    <span class="d-block  mt-4">Resend Email Confirmation<a href="<?php echo e(url('registration-Resend-Mail')); ?>" class="login"> Resend Email</a></span>
                <?php endif; ?>
            </p>
        </div>
    <?php elseif(session('error')): ?>
        <div class="account-title">
            
            <p class="alert alert-danger text-center"><?php echo e(session('error')); ?>

                <?php if(session('error') == "Your AlZuwar Account is not Verified Kindly check your email!!"): ?>
                    <span class="d-block  mt-4">Resend Email Confirmation<a href="<?php echo e(url('registration-Resend-Mail')); ?>" class="login"> Resend Email</a></span>
                <?php endif; ?>
            </p>
        </div>
    <?php endif; ?>
    <section class="loginform">
        <div class="container">
            <div class="inner_col">
                <form method="post" action="<?php echo e(route('login')); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="mb-4">
                        <h1 class="text-center loginheading pb-4">Login</h1>
                    </div>
                    <div class="mb-4 icon_position">
                        <div class="icon"><img src="<?php echo e(asset('website')); ?>/img/Icon awesome-envelope.png" alt=""></div>
                        <input type="email" placeholder="Email Address" aria-label="Username" aria-describedby="basic-addon1" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                    </div>
                    <div class="mb-4 icon_position">
                        <div class="icon"><img src="<?php echo e(asset('website')); ?>/img/Icon awesome-key.png" alt=""></div>
                        <input type="password" placeholder="Password" aria-label="Username" aria-describedby="basic-addon1" name="password" required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <div class="mb-4 form-check">
                            <input type="checkbox" class="" id="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                            <label class="form-check-label" for="exampleCheck1">Remember Password</label>
                        </div>
                        <div class="forgotpass">
                            <a href="<?php echo e(route('password-reset')); ?>">Forgot Password?</a>
                        </div>
                    </div>
                    <div class="buttons text-center mt-4">
                        <button type="submit" class="btn">Login&nbsp; <i class="fas fa-arrow-right"></i></button>
                        <a href="<?php echo e(url('user-signup')); ?>" class="d-block signup">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
<script>
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('website.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/user_login.blade.php ENDPATH**/ ?>