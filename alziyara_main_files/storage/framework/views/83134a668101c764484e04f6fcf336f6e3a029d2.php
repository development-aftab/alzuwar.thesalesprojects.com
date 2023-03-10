<?php $__env->startPush('css'); ?>
<script src="http://js.stripe.com/v3/"></script>
<style type="text/css">
    form {
        /*width: 30vw;*/
        min-width: 500px;
        align-self: center;
        box-shadow: 0px 0px 0px 0.5px rgba(50, 50, 93, 0.1),
        0px 2px 5px 0px rgba(50, 50, 93, 0.1), 0px 1px 1.5px 0px rgba(0, 0, 0, 0.07);
        border-radius: 7px;
        padding: 40px;
    }

    .hidden {
        display: none;
    }

    #payment-message {
        color: rgb(105, 115, 134);
        font-size: 16px;
        line-height: 20px;
        padding-top: 12px;
        text-align: center;
    }

    #payment-element {
        margin-bottom: 24px;
    }

    /* Buttons and links */
    button {
        background: #5469d4;
        font-family: Arial, sans-serif;
        color: #ffffff;
        border-radius: 4px;
        border: 0;
        padding: 12px 16px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        display: block;
        transition: all 0.2s ease;
        box-shadow: 0px 4px 5.5px 0px rgba(0, 0, 0, 0.07);
        width: 100%;
    }

    button:hover {
        filter: contrast(115%);
    }

    button:disabled {
        opacity: 0.5;
        cursor: default;
    }

    /* spinner/processing state, errors */
    .spinner,
    .spinner:before,
    .spinner:after {
        border-radius: 50%;
    }

    .spinner {
        color: #ffffff;
        font-size: 22px;
        text-indent: -99999px;
        margin: 0px auto;
        position: relative;
        width: 20px;
        height: 20px;
        box-shadow: inset 0 0 0 2px;
        -webkit-transform: translateZ(0);
        -ms-transform: translateZ(0);
        transform: translateZ(0);
    }

    .spinner:before,
    .spinner:after {
        position: absolute;
        content: "";
    }

    .spinner:before {
        width: 10.4px;
        height: 20.4px;
        background: #5469d4;
        border-radius: 20.4px 0 0 20.4px;
        top: -0.2px;
        left: -0.2px;
        -webkit-transform-origin: 10.4px 10.2px;
        transform-origin: 10.4px 10.2px;
        -webkit-animation: loading 2s infinite ease 1.5s;
        animation: loading 2s infinite ease 1.5s;
    }

    .spinner:after {
        width: 10.4px;
        height: 10.2px;
        background: #5469d4;
        border-radius: 0 10.2px 10.2px 0;
        top: -0.1px;
        left: 10.2px;
        -webkit-transform-origin: 0px 10.2px;
        transform-origin: 0px 10.2px;
        -webkit-animation: loading 2s infinite ease;
        animation: loading 2s infinite ease;
    }

    .newsubmitbuttons {
        color: white !important;
    }

    .amount_donation>span {
        top: 22%;
        font-size: 15px;
    }

    .side_bar .form-section-modal h3 {
        font-weight: 600;
        font-size: 20px;
        display: inline;
        line-height: 2;
    }

    .form-section-modal .selected-text {
        font-size: 22px;
        font-weight: 600;
        padding-top: 8px;
        padding-bottom: 0px;
    }

    .side_bar .form-section-modal h4 {
        font-weight: bold;
        float: right;
        font-size: 18px;
        display: inline;
        margin-bottom: 0px;
        line-height: 2;
    }

    .summary-sec {
        padding: 0px 0px 0px;
    }

    .form-section-modal .change-selection {

        line-height: 3;

    }

    .summary-sec p {
        font-size: 16px;
        font-weight: 500;
        margin: 15px 0px;
    }

    #totalsummaryamount,
    #finaltotalheading {
        text-align: right;
    }

    #modal-one input {
        padding: 0px;
        padding-left: 33px;
    }

    .reviews .rating-num {
        background: none;
        color: black;
    }

    .col .txt_recipt {
        display: inline;
        /*justify-content: space-between;*/
    }

    .txt_recipt p.quantity,
    .txt_recipt p.price {
        margin-right: 22%;
    }

    .txt_recipt p.date {
        margin-right: 6%;
    }

    .text-right {
        text-align: right !important;
        float: right;
        font-size: 14px;
    }

    .more-section {
        margin: 0;
    }

    .checkout_container .col-md-7 .form-row,
    .checkout_container .col-md-7 .row {
        margin: 0;
    }

    #modal-one .No {
        padding: 20px 36px;
    }

    .checkout_container form {
        padding: 20px;
    }

    #modal-one .No label {
        margin-bottom: 0;
    }

    #modal-one .amount_donation input {
        padding: 0px;
        padding-left: 22px;
        margin-bottom: 12px;
    }

    .all-visa-nd-anchor li a {
        font-size: 13px;
    }

    .all-visa-nd-anchor .newsubmitbuttons {
        display: flex;
        width: fit-content;
    }

    .checkout_container .donation {
        align-items: center;
    }

    .selected_col .col-md-6 {
        word-break: break-word;
    }

    .side_bar p {
        font-size: 16px !important;
        font-weight: 500 !important;
        word-break: break-word;
    }

    .side_bar .time_list {
        padding: 0;
        list-style: none;
    }

    .date_row P {
        display: inline;
        margin-right: 5px;
    }

    .selected_col_right {
        text-align: right;
    }

    @media  screen and (max-width: 1024px) {
        #modal-one input {
            padding-left: 15px;
        }
    }

    @-webkit-keyframes loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes  loading {
        0% {
            -webkit-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @media  only screen and (max-width: 600px) {
        form {
            width: 80vw;
            min-width: initial;
        }
    }

</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <?php //dd($cart)
    $tax_and_charges = session()->get('tax_and_charges');
    $tax_and_charges = floatval($tax_and_charges);
    ?>

    <section id="modal-one">
        <div class="container checkout_container">
            <div class="section-1">
                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-12">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">

                                        <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>">Home</a></li>

                                        <?php if(isset($cart["category"])): ?>

                                            <?php if($cart["category"] == 4): ?>


                                                <li class="breadcrumb-item"><a href="<?php echo e(route('guestspasses')); ?>">Guest Passes</a></li>
                                                <li class="breadcrumb-item"><a href="<?php echo e(url()->previous()); ?>"><?php echo e($cart['title']); ?></a></li>

                                            <?php elseif($cart["category"] == 1): ?>


                                                <li class="breadcrumb-item"><a href="<?php echo e(route('packages')); ?>">Package Deals</a></li>
                                                <li class="breadcrumb-item"><a href="<?php echo e(url()->previous()); ?>"><?php echo e($cart['title']); ?></a></li>


                                            <?php elseif($cart["category"] == 2): ?>


                                                <li class="breadcrumb-item"><a href="<?php echo e(route('hotels')); ?>">Hotel</a></li>
                                                <li class="breadcrumb-item"><a
                                                            href="<?php echo e(url()->previous()); ?>"><?php echo e($cart['title']); ?></a></li>
                                            <?php elseif($cart["category"] == 3): ?>

                                                <li class="breadcrumb-item"><a href="<?php echo e(route('guestspasses')); ?>">Transport</a></li>
                                                <li class="breadcrumb-item"><a href="<?php echo e(url()->previous()); ?>"><?php echo e($cart['title']); ?></a></li>

                                            <?php elseif($cart["category"] == 5): ?>


                                                <li class="breadcrumb-item"><a href="<?php echo e(route('guestspasses')); ?>">Guide</a>
                                                </li>
                                                <li class="breadcrumb-item"><a
                                                            href="<?php echo e(url()->previous()); ?>"><?php echo e($cart['title']); ?></a></li>
                                                <?php else: ?>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                        <!--  <li class="breadcrumb-item"><a href="#">Buss</a></li>-->
                                                <!--<li class="breadcrumb-item active" aria-current="page">Name of Vehicle / Plate#</li>-->
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <div class="row">

                            <?php if(isset($cart)): ?>

                                <?php if($cart["category"] == "4"): ?>

                                    <div class="col-md-4">
                                        <img src="<?php echo e($cart['image']); ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="sect-one-txt">


                                            <h5 class="title-hotel">Guest Passes</h5>
                                            <h1 class="main-heading"><?php echo e($cart['title']); ?></h1>
                                            <p class="address-najaf"><?php echo e($categoryitem->GuestPassLocation); ?></p>
                                            <p class="guest-rating">Guests have rated it
                                                <?php echo e(round($categoryitem->getGuestPassreviewdetails->avg('Rating'), 2)); ?>!
                                            </p>

                                            <?php for($a = 1; $a <= round($categoryitem->getGuestPassreviewdetails->avg('Rating')); $a++): ?>
                                                <i class="fas fa-star"></i>
                                            <?php endfor; ?>

                                            <?php for($a = 1; $a <= 5 - round($categoryitem->getGuestPassreviewdetails->avg('Rating')); $a++): ?>
                                                <i class="far fa-star"></i>
                                            <?php endfor; ?>

                                            <div class="reviews">
                                                <h4 class="rating-num">
                                                    <?php echo e(round($categoryitem->getGuestPassreviewdetails->avg('Rating'), 2)); ?>

                                                    out of 5</h4>

                                                <?php $ratings = round($categoryitem->getGuestPassreviewdetails->avg('Rating'), 2); ?>


                                                <?php if($ratings >= 4): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php elseif($ratings >= 3): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php elseif($ratings >= 2): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php elseif($ratings >= 1): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php else: ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php endif; ?>


                                                <p class="reviews-para">
                                                    <?php echo e($categoryitem->getGuestPassreviewdetails->count()); ?> reviews</p>
                                            </div>
                                        </div>
                                    </div>

                                <?php elseif($cart["category"] == "1"): ?>

                                    <div class="col-md-4">
                                        <img src="<?php echo e($cart['image']); ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="sect-one-txt">

                                            <!--<h5 class="title-hotel">Package Deal<span><i class="fas fa-thumbs-up"></i></span></h5>
                                            <h5 class="title-hotel">Package Deal<span><i class="fas fa-thumbs-up"></i></span></h5>-->
                                            <h1 class="main-heading"><?php echo e($cart['title']); ?></h1>
                                            
                                            

                                            <?php for($a = 1; $a <= round($categoryitem->getPackageReviewForView->avg('Rating')); $a++): ?>
                                                <i class="fas fa-star"></i>
                                            <?php endfor; ?>

                                            <?php for($a = 1; $a <= 5 - round($categoryitem->getPackageReviewForView->avg('Rating')); $a++): ?>
                                                <i class="far fa-star"></i>
                                            <?php endfor; ?>

                                            <div class="reviews">
                                                <h4 class="rating-num">
                                                    <?php echo e(round($categoryitem->getPackageReviewAverage[0]->averageRating, 2)); ?>

                                                    out of 5</h4>
                                                <?php $ratings = round($categoryitem->getPackageReviewAverage[0]->averageRating, 2); ?>

                                                <?php if($ratings >= 4): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php elseif($ratings >= 3): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php elseif($ratings >= 2): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php elseif($ratings >= 1): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php else: ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php endif; ?>

                                                <p class="reviews-para">
                                                    <?php echo e($categoryitem->getPackageReviewCountForView->count()); ?> reviews</p>
                                            </div>

                                        </div>
                                    </div>

                                <?php elseif($cart["category"] == "2"): ?>

                                    <div class="col-md-4">
                                        <img src="<?php echo e($cart['image']); ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="sect-one-txt">

                                            <h5 class="title-hotel">Hotel</h5>
                                            <h1 class="main-heading"><?php echo e($cart['title']); ?></h1>
                                            <p class="address-najaf"><?php echo e($categoryitem->City); ?></p>
                                            <p class="guest-rating">Guests have rated it
                                                <?php echo e(round($categoryitem->getHotelReviewAverage[0]->averageRating, 2)); ?>!
                                            </p>

                                            <div class="reviews">
                                                <h4 class="rating-num">
                                                    <?php echo e(round($categoryitem->getHotelReviewAverage[0]->averageRating, 2)); ?>

                                                    out of 5</h4>
                                                <?php $ratings = round($categoryitem->getHotelReviewAverage[0]->averageRating, 2); ?>


                                                <?php if($ratings >= 4): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php elseif($ratings >= 3): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php elseif($ratings >= 2): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php elseif($ratings >= 1): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php else: ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php endif; ?>

                                                <p class="reviews-para"><?php echo e($categoryitem->getHotelReview->count()); ?>

                                                    reviews</p>
                                            </div>

                                        </div>

                                    </div>

                                <?php elseif($cart["category"] == "3"): ?>

                                    <div class="col-md-4">
                                        <img src="<?php echo e($cart['image']); ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="sect-one-txt">

                                            <h5 class="title-hotel">Transport</h5>
                                            <h1 class="main-heading"><?php echo e($cart['title']); ?></h1>

                                            <?php

                                            $getroute = explode('-', $cart['title']);

                                            $ratings = round($categoryitem->getTransportReviewAverageForView->avg('averageRating'));

                                            ?>
                                            <p class="address-najaf"><?php echo e($getroute[1]); ?></p>
                                            <p class="guest-rating">Guests have rated it <?php echo e($ratings); ?> out of 5</p>


                                            <div class="reviews">
                                                <h4 class="rating-num">

                                                    <?php for($a = 1; $a <= round($categoryitem->getTransportReviewAverageForView->avg('averageRating')); $a++): ?>
                                                        <i class="fas fa-star"></i>
                                                    <?php endfor; ?>

                                                    <?php for($a = 1; $a <= 5 - round($categoryitem->getTransportReviewAverageForView->avg('averageRating')); $a++): ?>
                                                        <i class="far fa-star"></i>
                                                    <?php endfor; ?>

                                                </h4>
                                                <?php if($ratings >= 4): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php elseif($ratings >= 3): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php elseif($ratings >= 2): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php elseif($ratings >= 1): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php else: ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php endif; ?>

                                                <?php if(count($categoryitem->getTransportReview) > 1): ?>
                                                    <p class="reviews-para">
                                                        <?php echo e(count($categoryitem->getTransportReviewForView)); ?> reviews</p>
                                                <?php else: ?>
                                                    <p class="reviews-para">
                                                        <?php echo e(count($categoryitem->getTransportReviewForView)); ?> review</p>
                                                <?php endif; ?>

                                            </div>




                                        </div>
                                    </div>

                                <?php elseif($cart["category"] == "5"): ?>

                                    <div class="col-md-4">
                                        <img src="<?php echo e($cart['image']); ?>" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="sect-one-txt">

                                            <h5 class="title-hotel">Guide</h5>
                                            <h1 class="main-heading"><?php echo e($cart['title']); ?></h1>
                                            <p class="address-najaf"><?php echo e($categoryitem->GuidesLocation); ?></p>
                                            <p class="guest-rating">Guests have rated it
                                                <?php echo e(round($categoryitem->getGuideReviewForView->avg('Rating'), 2)); ?> !</p>

                                            <?php for($a = 1; $a <= round($categoryitem->getGuideReviewForView->avg('Rating')); $a++): ?>
                                                <i class="fas fa-star"></i>
                                            <?php endfor; ?>

                                            <?php for($a = 1; $a <= 5 - round($categoryitem->getGuideReviewForView->avg('Rating')); $a++): ?>
                                                <i class="far fa-star"></i>
                                            <?php endfor; ?>

                                            <div class="reviews">
                                                <h4 class="rating-num">
                                                    <?php echo e(round($categoryitem->getGuideReviewForView->avg('Rating'), 2)); ?>

                                                    out of 5</h4>

                                                <?php $ratings = round($categoryitem->getGuideReviewForView->avg('Rating'), 2); ?>


                                                <?php if($ratings >= 4): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php elseif($ratings >= 3): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php elseif($ratings >= 2): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php elseif($ratings >= 1): ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php else: ?>
                                                    <h4 class='rating-text'></h4>
                                                <?php endif; ?>

                                                <p class="reviews-para">
                                                    <?php echo e($categoryitem->getGuideReviewForView->count()); ?> reviews</p>
                                            </div>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-md-4">
                                        <img src="" class="img-fluid" alt="">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="sect-one-txt">
                                            <div class="reviews">
                                                <h4 class="rating-num">0.0</h4>
                                                <h4 class="rating-text"></h4>
                                                <p class="reviews-para">0 reviews</p>
                                            </div>
                                            <h5 class="title-hotel"></h5>
                                            <h1 class="main-heading">No Title</h1>
                                            <p class="address-najaf">No Location</p>
                                            <p class="guest-rating">Guests have rated it 0.0!</p>

                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <h5 class="title-hotel">Kindly Select Product</h5>
                            <?php endif; ?>
                        </div>
                        <?php if($errors->any()): ?>
                            <div class="alert alert-danger">
                                <ul>
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($error); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <?php endif; ?>
                            <?php if(session('message')): ?>
                                    <!-- <div class="account-title"><?php echo e(session('message')); ?></div> -->
                            <div class="account-title">
                                <p class="alert alert-danger"><?php echo e(session('message')); ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="section-2">
                            <h2 class="person-booking">
                                <?php if(isset(Auth::user()->id)): ?>
                                    Who is booking?
                                    <br>
                                    <br>
                                    
                                    <label>
                                        <label>Full Name : <?php $userprofile = App\Profile::where('user_id', '=', Auth::user()->id)->first(); ?> <?php echo e(Auth::user()->name); ?> </label>
                                        <br />
                                        <label>Contact : <?php echo e($userprofile->phone); ?> </label>
                                        <br />
                                        <label>Email : <?php echo e(Auth::user()->email); ?> </label>
                                        <br />
                                        <label><?php echo e($userprofile->country); ?></label>
                                        <br>
                                    </label>
                                <?php else: ?>
                                    Who is booking?<span class="text-right"><a href="<?php echo e(route('user-login')); ?>">I
                                            already have an account</a></span>
                                <?php endif; ?>
                            </h2>
                            <?php if(isset(Auth::user()->id)): ?>
                                <form action="<?php echo e(route('mycheckoutauth')); ?>" method="POST" name="checkout" id="checkout">

                                    <?php echo csrf_field(); ?>
                                    <?php else: ?>
                                        <form action="<?php echo e(route('registeruser')); ?>" method="POST" name="checkout"
                                              id="checkout">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-row for-user-icon">
                                                <div class="form-group col-md-8">
                                                    <label for="inputEmail4">Name <span>*</span></label>
                                                    <i class="fas fa-user"></i>
                                                    <input type="text" name="name" class="form-control" id="inputEmail4"
                                                           value="<?php echo e(old('name')); ?>" required placeholder="First and Last Name"
                                                           onkeyup="validateFields()">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <label for="">Country/Territory Code <span>*</span> </label>
                                                </div>
                                                <!--<div class="btn-group">
                                                           <button type="button" class="btn  dropdown-toggle country-drop territory-code" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                                                           United States of America +1
                                                           </button>

                                                           <input class="form-control" id="jquery-intl-phone" name="country" type="tel">

                                                           <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                                                              <button class="dropdown-item" type="button">Qatar</button>
                                                              <button class="dropdown-item" type="button">Pakistan</button>
                                                              <button class="dropdown-item" type="button">Saudi</button>
                                                           </div>
                                                        </div>
                                                     </div>
                                                     <div class="form-row">-->
                                                <div class="form-group col-md-8">
                                                    <select class="form-control" name="countryCode" id="" required
                                                            onkeyup="validateFields()">
                                                        <option value="">Select Country</option>
                                                        <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                                                        <option data-countryCode="AD" value="376">Andorra (+376)</option>
                                                        <option data-countryCode="AO" value="244">Angola (+244)</option>
                                                        <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                                                        <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)
                                                        </option>
                                                        <option data-countryCode="AR" value="54">Argentina (+54)</option>
                                                        <option data-countryCode="AM" value="374">Armenia (+374)</option>
                                                        <option data-countryCode="AW" value="297">Aruba (+297)</option>
                                                        <option data-countryCode="AU" value="61">Australia (+61)</option>
                                                        <option data-countryCode="AT" value="43">Austria (+43)</option>
                                                        <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                                                        <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                                                        <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                                                        <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                                                        <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                                                        <option data-countryCode="BY" value="375">Belarus (+375)</option>
                                                        <option data-countryCode="BE" value="32">Belgium (+32)</option>
                                                        <option data-countryCode="BZ" value="501">Belize (+501)</option>
                                                        <option data-countryCode="BJ" value="229">Benin (+229)</option>
                                                        <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                                                        <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                                                        <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                                                        <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)
                                                        </option>
                                                        <option data-countryCode="BW" value="267">Botswana (+267)</option>
                                                        <option data-countryCode="BR" value="55">Brazil (+55)</option>
                                                        <option data-countryCode="BN" value="673">Brunei (+673)</option>
                                                        <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                                                        <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                                                        <option data-countryCode="BI" value="257">Burundi (+257)</option>
                                                        <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                                                        <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                                                        <option data-countryCode="CA" value="1">Canada (+1)</option>
                                                        <option data-countryCode="CV" value="238">Cape Verde Islands (+238)
                                                        </option>
                                                        <option data-countryCode="KY" value="1345">Cayman Islands (+1345)
                                                        </option>
                                                        <option data-countryCode="CF" value="236">Central African Republic
                                                            (+236)</option>
                                                        <option data-countryCode="CL" value="56">Chile (+56)</option>
                                                        <option data-countryCode="CN" value="86">China (+86)</option>
                                                        <option data-countryCode="CO" value="57">Colombia (+57)</option>
                                                        <option data-countryCode="KM" value="269">Comoros (+269)</option>
                                                        <option data-countryCode="CG" value="242">Congo (+242)</option>
                                                        <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                                                        <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                                                        <option data-countryCode="HR" value="385">Croatia (+385)</option>
                                                        <option data-countryCode="CU" value="53">Cuba (+53)</option>
                                                        <option data-countryCode="CY" value="90392">Cyprus North (+90392)
                                                        </option>
                                                        <option data-countryCode="CY" value="357">Cyprus South (+357)</option>
                                                        <option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
                                                        <option data-countryCode="DK" value="45">Denmark (+45)</option>
                                                        <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                                                        <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                                                        <option data-countryCode="DO" value="1809">Dominican Republic (+1809)
                                                        </option>
                                                        <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                                                        <option data-countryCode="EG" value="20">Egypt (+20)</option>
                                                        <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                                                        <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)
                                                        </option>
                                                        <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                                                        <option data-countryCode="EE" value="372">Estonia (+372)</option>
                                                        <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                                                        <option data-countryCode="FK" value="500">Falkland Islands (+500)
                                                        </option>
                                                        <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                                                        <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                                                        <option data-countryCode="FI" value="358">Finland (+358)</option>
                                                        <option data-countryCode="FR" value="33">France (+33)</option>
                                                        <option data-countryCode="GF" value="594">French Guiana (+594)</option>
                                                        <option data-countryCode="PF" value="689">French Polynesia (+689)
                                                        </option>
                                                        <option data-countryCode="GA" value="241">Gabon (+241)</option>
                                                        <option data-countryCode="GM" value="220">Gambia (+220)</option>
                                                        <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                                                        <option data-countryCode="DE" value="49">Germany (+49)</option>
                                                        <option data-countryCode="GH" value="233">Ghana (+233)</option>
                                                        <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                                                        <option data-countryCode="GR" value="30">Greece (+30)</option>
                                                        <option data-countryCode="GL" value="299">Greenland (+299)</option>
                                                        <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                                                        <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                                                        <option data-countryCode="GU" value="671">Guam (+671)</option>
                                                        <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                                                        <option data-countryCode="GN" value="224">Guinea (+224)</option>
                                                        <option data-countryCode="GW" value="245">Guinea - Bissau (+245)
                                                        </option>
                                                        <option data-countryCode="GY" value="592">Guyana (+592)</option>
                                                        <option data-countryCode="HT" value="509">Haiti (+509)</option>
                                                        <option data-countryCode="HN" value="504">Honduras (+504)</option>
                                                        <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                                                        <option data-countryCode="HU" value="36">Hungary (+36)</option>
                                                        <option data-countryCode="IS" value="354">Iceland (+354)</option>
                                                        <option data-countryCode="IN" value="91">India (+91)</option>
                                                        <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                                                        <option data-countryCode="IR" value="98">Iran (+98)</option>
                                                        <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                                                        <option data-countryCode="IE" value="353">Ireland (+353)</option>
                                                        <option data-countryCode="IL" value="972">Israel (+972)</option>
                                                        <option data-countryCode="IT" value="39">Italy (+39)</option>
                                                        <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                                                        <option data-countryCode="JP" value="81">Japan (+81)</option>
                                                        <option data-countryCode="JO" value="962">Jordan (+962)</option>
                                                        <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                                                        <option data-countryCode="KE" value="254">Kenya (+254)</option>
                                                        <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                                                        <option data-countryCode="KP" value="850">Korea North (+850)</option>
                                                        <option data-countryCode="KR" value="82">Korea South (+82)</option>
                                                        <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                                                        <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                                                        <option data-countryCode="LA" value="856">Laos (+856)</option>
                                                        <option data-countryCode="LV" value="371">Latvia (+371)</option>
                                                        <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                                                        <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                                                        <option data-countryCode="LR" value="231">Liberia (+231)</option>
                                                        <option data-countryCode="LY" value="218">Libya (+218)</option>
                                                        <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                                                        <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                                                        <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                                                        <option data-countryCode="MO" value="853">Macao (+853)</option>
                                                        <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                                                        <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                                                        <option data-countryCode="MW" value="265">Malawi (+265)</option>
                                                        <option data-countryCode="MY" value="60">Malaysia (+60)</option>
                                                        <option data-countryCode="MV" value="960">Maldives (+960)</option>
                                                        <option data-countryCode="ML" value="223">Mali (+223)</option>
                                                        <option data-countryCode="MT" value="356">Malta (+356)</option>
                                                        <option data-countryCode="MH" value="692">Marshall Islands (+692)
                                                        </option>
                                                        <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                                                        <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                                                        <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                                                        <option data-countryCode="MX" value="52">Mexico (+52)</option>
                                                        <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                                                        <option data-countryCode="MD" value="373">Moldova (+373)</option>
                                                        <option data-countryCode="MC" value="377">Monaco (+377)</option>
                                                        <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                                                        <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                                                        <option data-countryCode="MA" value="212">Morocco (+212)</option>
                                                        <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                                                        <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                                                        <option data-countryCode="NA" value="264">Namibia (+264)</option>
                                                        <option data-countryCode="NR" value="674">Nauru (+674)</option>
                                                        <option data-countryCode="NP" value="977">Nepal (+977)</option>
                                                        <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                                                        <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                                                        <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                                                        <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                                                        <option data-countryCode="NE" value="227">Niger (+227)</option>
                                                        <option data-countryCode="NG" value="234">Nigeria (+234)</option>
                                                        <option data-countryCode="NU" value="683">Niue (+683)</option>
                                                        <option data-countryCode="NF" value="672">Norfolk Islands (+672)
                                                        </option>
                                                        <option data-countryCode="NP" value="670">Northern Marianas (+670)
                                                        </option>
                                                        <option data-countryCode="NO" value="47">Norway (+47)</option>
                                                        <option data-countryCode="OM" value="968">Oman (+968)</option>
                                                        <option data-countryCode="PS" value="970">Palestine (+970)</option>
                                                        <option data-countryCode="PW" value="680">Palau (+680)</option>
                                                        <option data-countryCode="PK" value="92">Pakistan (+92)</option>
                                                        <option data-countryCode="PA" value="507">Panama (+507)</option>
                                                        <option data-countryCode="PG" value="675">Papua New Guinea (+675)
                                                        </option>
                                                        <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                                                        <option data-countryCode="PE" value="51">Peru (+51)</option>
                                                        <option data-countryCode="PH" value="63">Philippines (+63)</option>
                                                        <option data-countryCode="PL" value="48">Poland (+48)</option>
                                                        <option data-countryCode="PT" value="351">Portugal (+351)</option>
                                                        <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                                                        <option data-countryCode="QA" value="974">Qatar (+974)</option>
                                                        <option data-countryCode="RE" value="262">Reunion (+262)</option>
                                                        <option data-countryCode="RO" value="40">Romania (+40)</option>
                                                        <option data-countryCode="RU" value="7">Russia (+7)</option>
                                                        <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                                                        <option data-countryCode="SM" value="378">San Marino (+378)</option>
                                                        <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)
                                                        </option>
                                                        <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                                                        <option data-countryCode="SN" value="221">Senegal (+221)</option>
                                                        <option data-countryCode="CS" value="381">Serbia (+381)</option>
                                                        <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                                                        <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                                                        <option data-countryCode="SG" value="65">Singapore (+65)</option>
                                                        <option data-countryCode="SK" value="421">Slovak Republic (+421)
                                                        </option>
                                                        <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                                                        <option data-countryCode="SB" value="677">Solomon Islands (+677)
                                                        </option>
                                                        <option data-countryCode="SO" value="252">Somalia (+252)</option>
                                                        <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                                                        <option data-countryCode="ES" value="34">Spain (+34)</option>
                                                        <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                                                        <option data-countryCode="SH" value="290">St. Helena (+290)</option>
                                                        <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                                                        <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                                                        <option data-countryCode="SD" value="249">Sudan (+249)</option>
                                                        <option data-countryCode="SR" value="597">Suriname (+597)</option>
                                                        <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                                                        <option data-countryCode="SE" value="46">Sweden (+46)</option>
                                                        <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                                                        <option data-countryCode="SI" value="963">Syria (+963)</option>
                                                        <option data-countryCode="TW" value="886">Taiwan (+886)</option>
                                                        <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
                                                        <option data-countryCode="TH" value="66">Thailand (+66)</option>
                                                        <option data-countryCode="TG" value="228">Togo (+228)</option>
                                                        <option data-countryCode="TO" value="676">Tonga (+676)</option>
                                                        <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)
                                                        </option>
                                                        <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                                                        <option data-countryCode="TR" value="90">Turkey (+90)</option>
                                                        <option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
                                                        <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                                                        <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands
                                                            (+1649)</option>
                                                        <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                                                        <option data-countryCode="UG" value="256">Uganda (+256)</option>
                                                        <option data-countryCode="GB" value="44">UK (+44)</option>
                                                        <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                                                        <option data-countryCode="AE" value="971">United Arab Emirates (+971)
                                                        </option>
                                                        <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                                                        <option data-countryCode="US" value="1">USA (+1)</option>
                                                        <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
                                                        <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                                                        <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                                                        <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                                                        <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                                                        <option data-countryCode="VG" value="84">Virgin Islands - British
                                                            (+1284)</option>
                                                        <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)
                                                        </option>
                                                        <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)
                                                        </option>
                                                        <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                                                        <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                                                        <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                                                        <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row for-user-icon">
                                                <div class="form-group col-md-8">
                                                    <label for="inputEmail4">Phone number <span>*</span></label>
                                                    <i class="fas fa-phone-alt"></i>
                                                    <input type="text" class="form-control" id="inputEmail4" required
                                                           name="phone" value="<?php echo e(old('phone')); ?>"
                                                           placeholder="In case we need to reach you" onkeyup="validateFields()">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-8">
                                                    <h3 class="confirm-mail">Confirmation email</h3>
                                                    <p class="email-text-conf">Please enter the email address where you would
                                                        like to receive your confirmation</p>
                                                </div>
                                            </div>
                                            <div class="form-row for-user-icon">
                                                <div class="form-group col-md-8">
                                                    <label for="inputEmail4">Email address <span>*</span></label>
                                                    <i class="fas fa-envelope"></i>
                                                    <input type="email" class="form-control" id="inputEmail4" required
                                                           name="email" value="<?php echo e(old('email')); ?>"
                                                           placeholder="Enter you email address" onkeyup="validateFields()">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="booking-sect">
                                                    <h5 class="manage-booking">Manage your booking</h5>
                                                    
                                                    <p>Enter a password to create an account using the email address.</p>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label for="inputEmail4">Create password<span>*</span></label>
                                                    <input type="password" class="form-control" id="inputEmail4"
                                                           name="password" placeholder="6 - 30 characters,  no spaces" required
                                                           onkeyup="validateFields()">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label for="inputEmail4">Confirm password<span>*</span></label>
                                                    <input type="password" class="form-control" name="password_confirmation"
                                                           id="inputEmail4" required onkeyup="validateFields()">
                                                </div>
                                            </div>
                                            <?php endif; ?>
                                            <div class="form-row">
                                                <div class="col-md-12 more">
                                                    
                                                            <!--<p class="more-para">Select Yes or No continue booking <span>*</span></p>-->
                                                    <input type="hidden" name="formtotalamount" id="formtotalamount" value="">
                                                    <input type="hidden" name="formtotaldonation" id="formtotaldonation" value="">
                                                </div>
                                            </div>
                                            <div class="row more-section" style="display: none">
                                                <div class="col-md-10">
                                                    <div class="Yes-more-section">
                                                        <h4>Medical Insurance</h4>
                                                        <input type="radio" id="html" name="Insurance" onchange="insurance();"
                                                               value="1"><label for="html">Yes, I need medical insurance</label><br>
                                                        <li> <i class="fas fa-check"></i>The healthcare system is extensive and will
                                                            support you in the event of illness.</span></li>
                                                        <li><i class="fas fa-check"></i><span>Everyone who plan to visit ziyara will be
                                                assured that they are insured in the event of illness.</span></li>
                                                        <li><i class="fas fa-check"></i><span>Never compromise on your
                                                health.</span></span></li>
                                                        <li><i class="fas fa-check"></i>Covers your rental car from <span>theif,
                                                Vandalism</span> and <span>collion damage</span></li>
                                                        <!--<li><i class="fas fa-check"></i>Covers your rental car from <span>theif, Vandalism</span> and <span>collion damage</span></li>-->
                                                        <a href="#!">View insurance details and disclosure</a>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="calendar-day">
                                                        <h4>$10.00</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row" style="display: none">
                                                <div class="col-md-12 No">
                                                    <input type="radio" id="html" name="Insurance" onchange="insurance();" checked="checked"
                                                           value="0"><label for="html">No, I am willing to take the risk</label><br>
                                                </div>
                                            </div>
                                            <div class="row more-section donation">
                                                <div class="col-md-10">
                                                    <h4>Donate to Holy Shrines</h4>
                                    <span>
                                        <select class="form-control" name="donation_shrine_name">
                                            <option value="Imam Ali Shrine">Imam Ali Shrine</option>
                                            <option value="Imam Hussain Shrine">Imam Hussain Shrine</option>
                                            <option value="Al-Abbas Shrine" selected>Al-Abbas Shrine</option>
                                            <option value="Al-Khadhimiya Shrine">Al-Khadhimiya Shrine</option>
                                            <option value="Al-Askari Shrine">Al-Askari Shrine</option>
                                        </select>
                                    </span>
                                                    <br>
                                                    <div class="Yes-more-section">
                                                        <div class="form-inline">
                                                            <input type="radio" id="html" name="donation" onchange="mydonation();"
                                                                   value="1">
                                                            <label for="html">I like to donate to Holy Shrines with this order.</label>

                                                        </div>
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                        
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="calendar-day">
                                                        
                                                        <div class="amount_donation">
                                                            <span>$</span>
                                                            <input type="number" id="donationamountform" min="1" value="10" class="form-control"   placeholder="Amount"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="col-md-12 No">
                                                    <input type="radio" id="html" name="donation" checked="checked" onchange="mydonation();"
                                                           value="0"><label for="html">Skip Donation</label><br>
                                                </div>
                                            </div>
                                            <p class="surprise text">"I was surprised how quickly the claim was resolved and with minimal
                                                paperwork. And no deductible!!!"</p>

                                            <!--<div class="form-row">
                                                                   <div class="exp-date col-md-8">
                                                                      <h5>Expiration Date <span>*</span></h5>
                                                                      <div class="dropdown">
                                                                         <button class="btn exp-date-drp dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                         Month
                                                                         </button>
                                                                         <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                                            <button class="dropdown-item" type="button">January</button>
                                                                            <button class="dropdown-item" type="button">Feb</button>
                                                                            <button class="dropdown-item" type="button">Mar</button>
                                                                         </div>
                                                                      </div>
                                                                      <div class="dropdown">
                                                                         <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                         Year
                                                                         </button>
                                                                         <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                                            <button class="dropdown-item" type="button">2020</button>
                                                                            <button class="dropdown-item" type="button">2021</button>
                                                                            <button class="dropdown-item" type="button">2022</button>
                                                                         </div>
                                                                      </div>
                                                                   </div>
                                                                </div>-->
                                            <!--<div class="zip">
                                                                   <div class="form-row">
                                                                      <div class="form-group col-md-4">
                                                                         <label for="inputZip">Security code <span>*</span></label>
                                                                         <input type="text" class="form-control" id="inputZip">
                                                                      </div>
                                                                      <div class="form-group col-md-6">
                                                                         <label for="inputZip">Billing ZIP code</label>
                                                                         <input type="text" class="form-control" id="inputZip">
                                                                      </div>
                                                                   </div>
                                                                </div>-->
                                            <div class="row">
                                                <div class="col-md-12 text-area">
                                                    <h3>Special Request/Requirements on this booking (Optional)</h3>
                                                    <div class="text-area-bg">
                                                        
                                                        <h5>Please write your requests/requirements in English</h5>
                                                        <textarea name="customernotes" class="form-control" id="" cols="90" rows="3"><?php echo e(old('customernotes')); ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="car-info">

                                                <?php if(isset($cart)): ?>
                                                    <?php if($cart["category"] == "4"): ?>
                                                        <h3>Rules, Cancelations & No-Show policy for <?php echo e($cart['title']); ?></h3>
                                                        
                                                        
                                                        <p><?php echo $categoryitem->HouseRules; ?></p>
                                                    <?php elseif($cart["category"] == "2"): ?>
                                                        <h3>Rules, Cancelations & No-Show policy for <?php echo e($cart['title']); ?></h3>
                                                        
                                                        
                                                        <p><?php echo $categoryitem->HouseRules; ?></p>
                                                        <input type="hidden" name="propertyid" value="<?php echo e($categoryitem->PropertyID); ?>">
                                                    <?php elseif($cart["category"] == "1" ): ?>
                                                        <h3>Rules, Cancelations & No-Show policy for <?php echo e($cart['title']); ?></h3>
                                                        
                                                        
                                                        <p><?php echo $categoryitem->house_rules; ?></p>
                                                    <?php elseif($cart["category"] == "5"): ?>
                                                        <h3>Rules, Cancelations & No-Show policy for <?php echo e($cart['title']); ?></h3>
                                                        
                                                        
                                                        <p><?php echo $categoryitem->HouseRules; ?></p>
                                                    <?php elseif($cart["category"] == "3"): ?>
                                                        <h3>Rules, Cancelations & No-Show policy for <?php echo e($cart['title']); ?></h3>
                                                        
                                                        
                                                        <input type="hidden" name="pickuplocation" value="<?php echo e($cart['pickuplocation']); ?>" />
                                                        <input type="hidden" name="dropofflocation" value="<?php echo e($cart['dropofflocation']); ?>" />
                                                        <input type="hidden" name="triptype" value="<?php echo e($cart['triptype']); ?>" />
                                                        <input type="hidden" name="tofrom" value="<?php echo e($getroute[1]); ?>" />
                                                        <p><?php echo $categoryitem->HouseRules; ?></p>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                                
                                            </div>


                                            

                                            <div class="all-visa-nd-anchor">
                                                <h3 class="payment">Payment</h3>

                                                <div class="container">
                                                    <br>
                                                    <!-- Nav tabs -->
                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" data-toggle="tab" id="creditcardpaymenttab"
                                                               href="#creditcard">CREDIT CARD</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" id="bankpaymenttab"
                                                               href="#banktab">CHEQUE/MONEY ORDER</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" id="paypalpaymenttab"
                                                               href="#paypaltab">PAYPAL</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" data-toggle="tab" id="zellepaymenttab"
                                                               href="#zelletab">ZELLE</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link " data-toggle="tab" id="cashpaymenttab"
                                                               href="#cashtab">CASH</a>
                                                        </li>
                                                    </ul>
                                                    <input type="hidden" class="form-control" id="paymenttype" name="payment_type"
                                                           value="creditcard" required>
                                                    <!-- Tab panes -->
                                                    <div class="tab-content">
                                                        <div id="creditcard" class="container tab-pane active"><br>
                                                            <h3>Credit Card Payment</h3>
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            
                                                            


                                                            <div id="payment-form">
                                                                <div id="payment-element">
                                                                    <!--Stripe.js injects the Payment Element-->
                                                                </div>
                                                                <button id="submit">
                                                                    <div class="spinner hidden" id="spinner"></div>
                                                                    <span id="button-text" onclick="submit()">Pay now</span>
                                                                </button>
                                                                <div id="payment-message" class="hidden"></div>
                                                            </div>

                                                        </div>
                                                        <div id="banktab" class="container tab-pane fade"><br>
                                                            <h3>Cheque/Money Order</h3>
                                                            <div class="right-tick">
                                                                <p><span><i class="fas fa-check"></i> You are promising to pay by
                                                        (Cheque/Money Order).Please follow these instructions.</span></p>
                                                                <p><span><i class="fas fa-check"></i> It can take up to 10 business days
                                                        to receive and post the payment.</span></p>
                                                                <p><span><i class="fas fa-check"></i> Your booking will only be confirmed
                                                        after payment has been received.For </span></p>
                                                                <p><span><i class="fas fa-check"></i> You can visit our office and pay in
                                                        person. Please don’t send cash by mail <br />Office
                                                        Address<br />Ziyarah Inc.<br />137-11 90th Ave <br />Jamaica, NY
                                                        11435</span></p>
                                                            </div>
                                                            <br />
                                                            <div class="form-row" id="fillfieldbank">

                                                            </div>
                                                            <a class="btn btn-primary newsubmitbuttons"
                                                               onclick="bankpaymentsubmit()">Confirm & Pay $ <div class="totalonsubmit">
                                                                </div></a>
                                                        </div>
                                                        <div id="paypaltab" class="container tab-pane fade"><br>
                                                            <h3>Paypal Payment</h3>

                                                            <p id="error" class="hidden">Please check the checkbox</p>
                                                            <input id="check" type="checkbox" <?php if(!Auth::User()): ?> disabled <?php endif; ?>>
                                                            <label id="checkbox-label">Check here to continue payment...</label>
                                                            <script src="https://www.paypal.com/sdk/js?client-id=<?php echo e(env('PAYPAL_SANDBOX_CLIENT_ID')); ?>">
                                                                // Replace YOUR_CLIENT_ID with your sandbox client ID
                                                            </script>
                                                            <div id="paypal-button-container"></div>

                                                            <script>
                                                                paypal.Buttons({
                                                                    onInit: function(data, actions) {

                                                                        // Disable the buttons
                                                                        actions.disable();

                                                                        // Listen for changes to the checkbox
                                                                        document.querySelector('#check')
                                                                                .addEventListener('change', function(event) {
                                                                                    // Enable or disable the button when it is checked or unchecked
                                                                                    if (event.target.checked) {
                                                                                        actions.enable();
                                                                                    } else {
                                                                                        actions.disable();
                                                                                    }
                                                                                });
                                                                    },
                                                                    style: {
                                                                        layout: 'horizontal',
                                                                        size: 'small',
                                                                        color: 'blue',
                                                                        shape: 'pill',
                                                                        label: 'pay',
                                                                        height: 40,
                                                                        tagline: 'false'
                                                                    },
                                                                    createOrder: function(data, actions) {
                                                                        return actions.order.create({
                                                                            purchase_units: [{
                                                                                amount: {
                                                                                    value: parseFloat(document.getElementById('formtotalamount').value)
                                                                                            .toFixed(2)
                                                                                    
                                                                                }
                                                                            }]
                                                                        });

                                                                    },
                                                                    onApprove: function(data, actions) {
                                                                        return actions.order.capture().then(function(details) {
                                                                            // alert('Transaction completed by ' + details.payer.name.given_name);
                                                                            // document.checkout.submit();

                                                                            var x = document.createElement("INPUT");
                                                                            x.setAttribute("type", "readonly");
                                                                            x.setAttribute("name", "customer_id");
                                                                            x.setAttribute("value", details.payer.payer_id);
                                                                            document.checkout.appendChild(x);

                                                                            var y = document.createElement("INPUT");
                                                                            y.setAttribute("type", "hidden");
                                                                            y.setAttribute("name", "charge_id");
                                                                            y.setAttribute("value", details.id);
                                                                            document.checkout.appendChild(y);

                                                                            var z = document.createElement("INPUT");
                                                                            z.setAttribute("type", "hidden");
                                                                            z.setAttribute("name", "reciept_url");
                                                                            z.setAttribute("value", details.links[0].href);
                                                                            document.checkout.appendChild(z);

                                                                            var type = document.createElement("INPUT");
                                                                            type.setAttribute("type", "hidden");
                                                                            type.setAttribute("name", "payment_type");
                                                                            type.setAttribute("value", "paypal");
                                                                            document.checkout.appendChild(type);

                                                                            Swal.fire(
                                                                                    'Thanks ' + details.payer.name.given_name,
                                                                                    'Transaction completed !',
                                                                                    'success'
                                                                            );
                                                                            console.log(details);
                                                                            document.createElement('form').submit.call(document.checkout)
                                                                            // payment_direct_object = details;
                                                                            // payment_object = JSON.stringify(details);
                                                                            // payment_object = '';

                                                                            // form_post(payment_direct_object)
                                                                            // var formData= $("#ecard_form").serializeArray();
                                                                        });
                                                                    }
                                                                }).render('#paypal-button-container'); // Display payment options on your web page
                                                            </script>
                                                            <!-- Add the checkout buttons, set up the order and approve the order -->
                                                        </div>
                                                        <div id="zelletab" class="container tab-pane fade"><br>
                                                            <h3>Zelle Payment</h3>
                                                            

                                                            <div class="right-tick">
                                                                <p><span><i class="fas fa-check"></i> You are promising to pay by (Zelle
                                                        Payment).Please follow these instructions.</span></p>
                                                                <p><span><i class="fas fa-check"></i> It can take up to 5 business days
                                                        to receive and post the payment.</span></p>
                                                                <p><span><i class="fas fa-check"></i> Your booking will only be confirmed
                                                        after payment has been received.For </span></p>
                                                            </div>

                                                            

                                                            <div class="form-row" id="fillfieldzelle">

                                                            </div>
                                                            <a class="btn btn-primary newsubmitbuttons" onclick="submit()">Confirm & Pay $
                                                                <div class="totalonsubmit"></div></a>

                                                        </div>
                                                        <div id="cashtab" class="container tab-pane fade"><br>
                                                            <h3>Cash Payment</h3>
                                                            

                                                            <div class="right-tick">
                                                                <p><span><i class="fas fa-check"></i> You are promising to pay by (Cash
                                                        Payment).Please follow these instructions.</span></p>
                                                                <p><span><i class="fas fa-check"></i> It can take up to 5 business days
                                                        to receive and post the payment.</span></p>
                                                                <p><span><i class="fas fa-check"></i> Your booking will only be confirmed
                                                        after payment has been received</span></p>
                                                                <p><span><i class="fas fa-check"></i> You can visit our office and pay in
                                                        person. Please don’t send cash by mail <br />Office
                                                        Address<br />Ziyarah Inc.<br />137-11 90th Ave <br />Jamaica, NY
                                                        11435</span></p>
                                                            </div>
                                                            <br />
                                                            <div class="form-row" id="fillfieldcash">

                                                            </div>
                                                            <a class="btn btn-primary newsubmitbuttons"
                                                               onclick="cashpaymentsubmit()">Confirm & Pay $ <div class="totalonsubmit">
                                                                </div></a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <br>
                                                <!--<div class="form-check form-check-inline">
                                                                       <input class="form-check-input" type="radio" name="paymentTypeselect" id="" value="ChequePayment">
                                                                       <label class="form-check-label" for="">Bank Cheque</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                       <input class="form-check-input" type="radio" checked="checked" name="paymentTypeselect" id="" value="CashPayment">
                                                                       <label class="form-check-label"  for="">Cash</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                       <input class="form-check-input" type="radio" name="paymentTypeselect" id="" value="GatewayPayment">
                                                                       <label class="form-check-label" for="">Other Payment Methods </label>
                                                                    </div>
                                                                    <br><br>-->
                                                <!--<i class="fas fa-check"></i>
                                                                    <a href="#!">we use secure transmission</a>
                                                                    <i class="fas fa-check"></i>
                                                                    <a href="#!">we protect your personal information</a>-->
                                                <!--<div class="payment-imgs">
                                                                       <img src="./img/db1.png" alt="" class="img-fluid">
                                                                       <img src="./img/db2.png" alt="" class="img-fluid">
                                                                       <img src="./img/db3.png" alt="" class="img-fluid">
                                                                       <img src="./img/db4.png" alt="" class="img-fluid">
                                                                       <img src="./img/db5.png" alt="" class="img-fluid">
                                                                       <img src="./img/db6.png" alt="" class="img-fluid">
                                                                    </div>-->
                                            </div>


                                            <!--<div id="bankpayment" class="text-area" style="display:none">

                                                                    <ol>
                                                                        <li>Please make check or money order payable to: Ziyarah Inc.</li>
                                                                        <li>Make sure you write your phone number and email address on check.</li>
                                                                        <li>Mail the check to: <br/> Ziyarah Inc. <br/>137-11 90th Ave <br/>Jamaica, NY 11435 </li>
                                                                    </ol>

                                                                    Note: It can take up to 10 business days to receive and post the payment.




                                                                    <!--<div class="form-row">
                                                                        <div class="form-group col-md-8">
                                                                            <label for="inputEmail4">Cheque Depositor Name <span>*</span></label>
                                                                            <input type="text" class="form-control" name="chequedepositorname" id="chequedepositorname" required disabled >
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-8">
                                                                            <label for="inputEmail4">Cheque Depositor PhoneNo <span>*</span></label>
                                                                            <input type="text" class="form-control" name="chequedepositorphoneno" id="chequedepositorphoneno" required disabled >
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-8">
                                                                            <label for="inputEmail4">Cheque Depositor Email Address<span>*</span></label>
                                                                            <input type="text" class="form-control" name="chequedepositoremail" id="chequedepositoremail" required disabled >
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-8">
                                                                            <label for="inputEmail4">Deposit Cheque number<span>*</span></label>
                                                                            <input type="text" class="form-control" name="chequenumber" id="chequenumber" required >

                                                                        </div>
                                                                    </div>-->
                                            <!--<input type="hidden" class="form-control" id="paymenttypebank" name="payment_type"  value="bankpayment" required disabled >
                                                                <br/>
                                                                <div class="form-row" id="fillfieldbank">

                                                                </div>
                                                                <a class="btn btn-primary" onclick="bankpaymentsubmit()">Submit Order</a>
                                                            </div>-->

                                            <!--<div id="cashpayment" class="more-section" >


                                                                    <ol>
                                                                        <li>You can visit our office and pay in person. Please don’t send cash by mail <br/>Office Address<br/>Ziyarah Inc.<br/>137-11 90th Ave <br/>Jamaica, NY 11435</li>
                                                                    </ol>



                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-8">
                                                                            <label for="inputEmail4"> Cash Depositor Name <span>*</span></label>
                                                                            <input type="text" class="form-control" name="cashdepositorname" id="cashdepositorname" required >
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-8">
                                                                            <label for="inputEmail4"> Cash Depositor PhoneNo<span>*</span></label>
                                                                            <input type="text" class="form-control" name="cashdepositorphoneno" id="cashdepositorphoneno" required >
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-8">
                                                                            <label for="inputEmail4"> Cash Depositor Email Address<span>*</span></label>
                                                                            <input type="text" class="form-control" name="cashdepositoremail" id="cashdepositoremail" required >

                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" class="form-control" name="payment_type" id="paymenttypecash" value="cashpayment" required >
                                                                    <br/>
                                                                    <div class="form-row" id="fillfieldcash">

                                                                    </div>
                                                                    <a class="btn btn-primary" onclick="cashpaymentsubmit()">Submit Order</a>
                                                                </div>-->

                                            <div id="gatewaypayment" style="display:none">



                                                <div class="col-md-6">

                                                    <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Pay with Zelle</button>-->
                                                    <!--<a href="#!" class="btn reserve-now" data-toggle="modal" data-target="#largeModal">Book Now > </a>-->
                                                    
                                                </div>
                                            </div>
                                            <div class="lock-text">
                                                <!--<p class="lock-para"> <i class="fas fa-lock"></i> we use secure transmision and encrypted your personal information.</p>
                                               <p class="lock-para">This payment will be processed in the U.S. This does not apply the travel provider (airline/hotel/rail, etc )process Your payment.</p>-->
                                            </div>
                                        </form>
                        </div>
                    </div>
                    <div class="col-md-4 side_bar">
                        <section class="form-section-modal">
                            <div class="container">
                                <div class="row heading">
                                    <div class="col-md-12">
                                        <h2 class="your-main-heading">Your booking details</h2>
                                    </div>
                                </div>

                                <?php if(isset($cart)): ?>

                                    <?php if($cart["category"] == "4"): ?>


                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 class="check-in">Booking Date:</h3>


                                            </div>
                                            <div class="col-md-12">
                                                
                                                
                                                

                                                <?php $__currentLoopData = $categoryitem->getGuestPassprogramDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $getGuestPassDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <p class="time-check">
                                                        <?php $mygustspassdate = date_create($cart['date']); ?><?php echo e(date_format($mygustspassdate, 'D, M d, Y ')); ?> <?php echo e(date('g:iA', strtotime($getGuestPassDetail->GuestProDetailTime))); ?>

                                                    </p>

                                                    
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>

                                        </div>
                                        <!--<div class="row">
                                               <div class="col">
                                                  <h4 class="length-stay">Total length of stay:</h4>
                                                  <h3 class="week-stay">Less Than 1 day</h3>
                                               </div>
                                            </div>-->

                                    <?php elseif($cart["category"] == "1"): ?>

                                        <div class="row">
                                            <?php

                                            $myhotelcheckindate = date_create($categoryitem->package_available_from);

                                            $myhotelcheckoutdate = date_create($categoryitem->package_available_to);

                                            $startTimeStamp = strtotime($categoryitem->package_available_from);
                                            $endTimeStamp = strtotime($categoryitem->package_available_to);

                                            $timeDiff = abs($endTimeStamp - $startTimeStamp);

                                            $numberDays = $timeDiff / 86400; // 86400 seconds in one day

                                            // and you might want to convert to integer
                                            $numberDays = intval($numberDays);

                                            ?>
                                            <div class="col-md-6">
                                                <h3 class="check-in">From</h3>
                                                <p class="check-dates"><?php echo e(date_format($myhotelcheckindate,"D, M d, Y ")); ?></p>
                                                <!--<h6 class="time-check">00:00</h6>-->
                                            </div>
                                            <div class="col-md-6">
                                                <h3 class="check-in">To</h3>
                                                <p class="check-dates"><?php echo e(date_format($myhotelcheckoutdate,"D, M d, Y ")); ?></p>
                                                <!--<h6 class="time-check">24:00</h6>-->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h3 class="length-stay">Duration :
                                                <?php if($numberDays == 0): ?>
                                                    1 Day
                                                <?php else: ?>
                                                   <?php echo e($numberDays); ?> Days
                                                <?php endif; ?>
                                                </h3>
                                                

                                            </div>
                                        </div>
                                    <?php elseif($cart["category"] == "2"): ?>


                                        <div class="row">
                                            <?php

                                            $Bookdates = explode('-', $cart['date']);

                                            $myhotelcheckindate = date_create($Bookdates[0]);

                                            $myhotelcheckoutdate = date_create($Bookdates[1]);

                                            $startTimeStamp = strtotime($Bookdates[0]);
                                            $endTimeStamp = strtotime($Bookdates[1]);

                                            $timeDiff = abs($endTimeStamp - $startTimeStamp);

                                            $numberDays = $timeDiff / 86400; // 86400 seconds in one day

                                            // and you might want to convert to integer
                                            $numberDays = intval($numberDays);

                                            ?>
                                                    <!--<div class="col-md-6">
                                               <h4 class="check-in">Check-in</h4>
                                               <h3 class="check-dates"><?php echo e(date_format($myhotelcheckindate, 'D, M d, Y ')); ?></h3>
                                               <h6 class="time-check">00:00</h6>
                                               </div>
                                               <div class="col-md-6">
                                               <h4 class="check-in">Check-out</h4>
                                               <h3 class="check-dates"><?php echo e(date_format($myhotelcheckoutdate, 'D, M d, Y ')); ?></h3>
                                               <h6 class="time-check">24:00</h6>
                                            </div>-->
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <h3>Date:</h3>
                                            </div>
                                            <div class="col-md-12 ">
                                                <p><?php echo e($cart['date']); ?></p>
                                            </div>
                                            <div class="col-md-12 ">
                                                <h3 class="length-stay">Total length of stay:</h3>

                                            </div>
                                            <div class="col-md-12 ">
                                                <?php if($numberDays == 0): ?>
                                                    <p>1 Day</p>
                                                <?php else: ?>
                                                    <p><?php echo e($numberDays + 1); ?> Days</p>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                        
                                        
                                    <?php elseif($cart['category'] == '3'): ?>
                                        <?php

                                        $date = date_create($cart['date']);
                                        $mydayquantity = $cart['quantity'] - 1;
                                        date_add($date, date_interval_create_from_date_string($mydayquantity . ' days'));
                                        $newformatdatedropout = date_format($date, 'Y-m-d H:i:s');

                                        $pickuptime = date_create($cart['date']);

                                        $dropouttime = date_create($newformatdatedropout);

                                        ?>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 class="check-in">Booking Date:</h3>
                                            </div>
                                            <div class="col-md-12">
                                                <p class="check-dates"><?php echo e(date_format($pickuptime, 'D, M d, Y ')); ?> <?php echo e(date_format($pickuptime, 'h:i a')); ?></p>
                                                
                                            </div>

                                            
                                        </div>
                                        
                                    <?php elseif($cart['category'] == '5'): ?>
                                        <div class="row">


                                            <?php

                                            $Bookdates = explode('-', $cart['date']);

                                            $myguidecheckindate = date_create($Bookdates[0]);

                                            $myguidecheckoutdate = date_create($Bookdates[1]);

                                            $startTimeStamp = strtotime($Bookdates[0]);
                                            $endTimeStamp = strtotime($Bookdates[1]);

                                            $timeDiff = abs($endTimeStamp - $startTimeStamp);

                                            $numberDays = $timeDiff / 86400; // 86400 seconds in one day

                                            // and you might want to convert to integer
                                            $numberDays = intval($numberDays);

                                            if ($numberDays == 0) {
                                                $numberDays = 1;
                                            } else {
                                                $numberDays = $numberDays + 1;
                                            }

                                            ?>


                                            <div class="col-md-6">
                                                <h3 class="check-in">From</h3>
                                                <P class="check-dates">
                                                    <?php echo e(date_format($myguidecheckindate, 'D, M d, Y ')); ?></P>
                                                <!--<h6 class="time-check">00:00</h6>-->
                                            </div>
                                            <div class="col-md-6">
                                                <h3 class="check-in">To</h3>
                                                <P class="check-dates">
                                                    <?php echo e(date_format($myguidecheckoutdate, 'D, M d, Y ')); ?></P>
                                                <!--<h6 class="time-check">24:00</h6>-->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h3 class="length-stay">Duration :
                                                    <?php if($numberDays == 0): ?>
                                                        1 Day
                                                    <?php else: ?>
                                                        <?php echo e($numberDays); ?> Days
                                                    <?php endif; ?>
                                                </h3>
                                                
                                            </div>
                                        </div>
                                        
                                            
                                                
                                                
                                            
                                        
                                    <?php else: ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class="check-in">Check-in</h4>
                                                <h3 class="check-dates">Fri, Jun 25, 2021</h3>
                                                <h6 class="time-check">2:00 PM - 12:00 AM</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <h4 class="check-in">Check-out</h4>
                                                <h3 class="check-dates">Fri, July 2, 2021</h3>
                                                <h6 class="time-check">7:00 PM - 12:00 AM</h6>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <h4 class="length-stay">Total length of stay:</h4>
                                                <h3 class="week-stay">1 Week</h3>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php $total = 0; ?>
                                <div class=" selected_col">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="selected-text">You selected:</h3>
                                        </div>
                                    </div>

                                    <?php if(isset($cart)): ?>

                                    <?php if($cart['category'] == '4'): ?>
                                            <!--<p class="room">Guest Passes</p>-->

                                    

                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <p>Visitors:</p>
                                            <p>Price:</p>

                                        </div>
                                        <div class="col-md-6 selected_col_right">
                                            <p><?php echo e($cart['quantity']); ?></p>
                                            <p><?php echo e(number_format($cart['price'], 2, '.', '')); ?> / visitor</p>
                                        </div>

                                        

                                        <?php $total += $cart['quantity'] * $cart['price']; ?>
                                        </td>
                                    </div>
                                    <?php elseif($cart['category'] == '1'): ?>
                                            <!--<p class="room">Package Deal</p>-->

                                    <div class="row">
                                        <div class="col-md-6"><p>Number of Tickets:</p></div>
                                        <div class="col-md-6 selected_col_right"><p><?php echo e($cart['quantity']); ?></p></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6"><p>Price:</p></div>
                                        <div class="col-md-6 selected_col_right"><p>$ <?php echo e($cart['price']); ?> / visitor</p></div>
                                    </div>

                                    
                                    <?php $total += $cart['quantity'] * $cart['price']; ?>
                                    
                                    <br />
                                    <?php elseif($cart['category'] == '2'): ?>
                                            <!--<p class="room">Hotel</p>-->

                                    <div class="row">
                                        <div class="txt_recipt col-md-12">
                                            <p><?php echo e($cart['quantity']); ?> room of price $<?php echo e($cart['price']); ?></p>
                                            <h3> <?php echo e($cart['title']); ?>: </h3>
                                        </div>

                                        
                                        
                                        
                                        


                                        <div class="txt_recipt col-md-12">
                                            
                                            <p class="price"> Cost you $<?php echo e($cart['price']); ?></p>
                                        </div>
                                    </div>
                                    <?php $total += $cart['price']; ?>
                                    <?php elseif($cart['category'] == '3'): ?>
                                        

                                        <div class="row">
                                            <div class="col-md-6"><p>Pickup Location:</p> </div>
                                            <div class="col-md-6 selected_col_right"><p>
                                                    <?php echo e($cart['pickuplocation'] ?? ''); ?>

                                                    
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6"><p>Destination:</p> </div>
                                            <div class="col-md-6 selected_col_right"><p>
                                                    <?php echo e($cart['dropofflocation'] ?? ''); ?>

                                                    
                                                </p>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6"><p>Trip Type:</P></div>
                                            <?php if($cart['triptype'] == 'oneway'): ?>
                                                <div class="col-md-6 selected_col_right"><p>One Way Trip</P></div>
                                            <?php else: ?>
                                                <div class="col-md-6 selected_col_right"><p>Round Trip</p></div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6"><p>Vehicle Type:</p></div>
                                            <div class="col-md-6 selected_col_right">
                                                <p>
                                                    <?php echo e($categoryitem->getTransporttype->TransportationTypeDesc); ?>

                                                </p>
                                            </div>

                                        </div>

                                        <tr>
                                            

                                            <?php $total += $cart['quantity'] * $cart['price']; ?>
                                            </p>
                                            </td>
                                        </tr>
                                    <?php elseif($cart['category'] == '5'): ?>
                                        

                                        <div class="row">
                                            <div class="col-md-6"><p>Guide Based in:<p></div>
                                            <div class="col-md-6 selected_col_right"><p><?php echo e($categoryitem->GuidesLocation); ?></p></div>
                                        </div>

                                        

                                        <div class="row">
                                            <div class="col-md-6"><p>Price:</p></div>
                                            <div class="col-md-6 selected_col_right"><p><?php echo e($cart['price']); ?>/Day</p></div>
                                        </div>


                                        <br />
                                        
                                        <?php $total += $cart['price'] * $numberDays; ?>

                                        
                                    <?php endif; ?>

                                    <?php endif; ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <a href="<?php echo e(url()->previous()); ?>" class="change-selection">Change your
                                                selection</a>
                                        </div>
                                    </div>

                                </div>
                                <div class="row summary-sec">
                                    <div class="col-md-12">
                                        <h3 class="your-main-heading">Your Price Summary:</h3>
                                    </div>
                                    <?php if(isset($cart)): ?>
                                        <div class="col-md-12" id="totalsummaryheading">

                                            <div class="row">
                                                <?php if($cart['category'] == '4'): ?>
                                                    <div class="col-md-6" >  <p class="room">Price x <?php echo e($cart['quantity']); ?> visitors </p> </diV>
                                                    <div class="col-md-6" id="totalsummaryamount">
                                                        <p class="room" id="_total">$ <?php echo e(number_format($total, 2, '.', '')); ?></p>
                                                    </div>
                                                    <div class="col-md-6" >  <p class="room">Tax </p></diV>
                                                    <div class="col-md-6" id="totalsummaryamount">
                                                        <p class="room" id="_tax">$<?php echo e(number_format($tax_and_charges??'', 2, '.', '')); ?></p>
                                                    </div>
                                                <?php elseif($cart['category'] == '1'): ?>
                                                    <div class="col-md-6" >  <p class="room">Package price x <?php echo e($cart['quantity']); ?>

                                                            visitors </p>
                                                    </diV>
                                                    <div class="col-md-6" id="totalsummaryamount">
                                                        <p class="room" id="_total">$ <?php echo e(number_format($total, 2, '.', '')); ?></p>
                                                    </div>
                                                    <div class="col-md-6" >    <p class="room">Tax </p> </diV>
                                                    <div class="col-md-6" id="totalsummaryamount">
                                                        <p class="room" id="_tax">$<?php echo e(number_format($tax_and_charges??'', 2, '.', '')); ?></p>
                                                    </div>
                                                <?php elseif($cart['category'] == '2'): ?>
                                                    <div class="col-md-6" >    <p class="room">Hotel</p> </diV>
                                                    <div class="col-md-6" id="totalsummaryamount">
                                                        <p class="room" id="_total">$ <?php echo e(number_format($total, 2, '.', '')); ?></p>
                                                    </div>
                                                    <div class="col-md-6" >    <p class="room">Tax </p> </diV>
                                                    <div class="col-md-6" id="totalsummaryamount">
                                                        <p class="room" id="_tax">$<?php echo e(number_format($tax_and_charges??'', 2, '.', '')); ?></p>
                                                    </div>
                                                <?php elseif($cart['category'] == '3'): ?>
                                                    <div class="col-md-6" >
                                                        <p class="room">Vehicle <?php if($cart['triptype'] == 'twoway'): ?>
                                                                Round Trip Fare
                                                            <?php elseif($cart['triptype'] == 'oneway'): ?>
                                                                One Way Trip Fare
                                                            <?php endif; ?>
                                                        </p>
                                                    </diV>
                                                    <div class="col-md-6" id="totalsummaryamount">
                                                        <p class="room" id="_total">$ <?php echo e(number_format($total, 2, '.', '')); ?></p>
                                                    </div>
                                                    <div class="col-md-6" >    <p class="room">Tax </p> </diV>
                                                    <div class="col-md-6" id="totalsummaryamount">
                                                        <p class="room" id="_tax">$<?php echo e(number_format($tax_and_charges??'', 2, '.', '')); ?></p>
                                                    </div>
                                                <?php elseif($cart['category'] == '5'): ?>
                                                    <div class="col-md-6" >    <p class="room">Guide x <?php echo e($numberDays); ?> Days</p> </diV>
                                                    <div class="col-md-6" id="totalsummaryamount">
                                                        <p class="room" id="_total">$ <?php echo e(number_format($total, 2, '.', '')); ?></p>
                                                    </div>
                                                    <div class="col-md-6" >    <p class="room">Tax </p> </diV>
                                                    <div class="col-md-6" id="totalsummaryamount">
                                                        <p class="room" id="_tax">$<?php echo e(number_format($tax_and_charges??'', 2, '.', '')); ?></p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            
                                            
                                            
                                            
                                        </div>
                                    <?php endif; ?>

                                </div>
                                <div class="row price-bg-color">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h2 class="your-main-heading">Total </h2>
                                                <!--<p class="currency-text">(Your currency)</p>-->
                                            </div>
                                            <div class="col-md-6">
                                                <h2 class="your-main-heading" id="finaltotalheading">$
                                                    <?php echo e(number_format($total + $tax_and_charges, 2, '.', '')); ?></h2>
                                            </div>
                                        </div>
                                        <!--   <div class="row">-->
                                        <!--   <div class="col-md-6">-->
                                        <!--   <h4 class="property-txt">Property's Currency</h4>-->
                                        <!--   <p class="currency-text">in US$</p>-->
                                        <!--   <p class="currency-text">(for 1 week & all guests)</p>-->
                                        <!--</div>-->
                                        <!--<div class="col-md-6">-->
                                        <!--  <h4 class="property-txt">$885.50</h4>-->
                                        <!--</div>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                                <!--<p class="view-para">* This price is converted to show you the approximate cost in Rs. You'll pay in <strong>$</strong>. The exchange rate might change before you pay.</p>-->
                                <!--<p class="view-para">Keep in mind that your card issuer may charge you a foreign transaction fee.</p>-->
                                <input type="hidden" id="finaltotalamount" value="<?php echo e($total + $tax_and_charges); ?>" />
                                <input type="hidden" id="subtractdonationamount" value="" />
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    

            <!--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Zelle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Transaction ID:</label>
                            <input type="text" class="form-control" id="transaction_id" name="transaction_id" placeholder="e.g:TX291586333244UIJ">
                            <input type="hidden" class="form-control" id="payment_type" name="payment_type" value="zelle">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="submit()">Submit</button>
                </div>
            </div>
        </div>
    </div>-->

    </section>



    <!-- modal-section -->
    <!-- large modal -->
    <!--<section class="modal-two">-->
    <!--   <div class="modal fade" id="largeModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">-->
    <!--   <div class="modal-dialog modal-lg">-->
    <!--      <div class="modal-content">-->
    <!--         <div class="modal-header">-->
    <!--            <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
    <!--            <span aria-hidden="true">&times;</span>-->
    <!--            </button>-->
    <!--         </div>-->
    <!--         <div class="modal-body">-->
    <!--            <section class="form-section-modal">-->
    <!--               <div class="container">-->
    <!--                  <div class="row heading">-->
    <!--                     <div class="col-md-12">-->
    <!--                        <h2 class="your-main-heading">Your booking details</h2>-->
    <!--                     </div>-->
    <!--                  </div>-->
    <!--                  <div class="row">-->
    <!--                     <div class="col-md-6">-->
    <!--                        <h4 class="check-in">Check-in</h4>-->
    <!--                        <h3 class="check-dates">Fri, Jun 25, 2021</h3>-->
    <!--                        <h6 class="time-check">2:00 PM - 12:00 AM</h6>-->
    <!--                     </div>-->
    <!--                     <div class="col-md-6">-->
    <!--                        <h4 class="check-in">Check-out</h4>-->
    <!--                        <h3 class="check-dates">Fri, July 2, 2021</h3>-->
    <!--                        <h6 class="time-check">7:00 PM - 12:00 AM</h6>-->
    <!--                     </div>-->
    <!--                  </div>-->
    <!--                  <div class="row">-->
    <!--                     <div class="col">-->
    <!--                        <h4 class="length-stay">Total lenght of stay:</h4>-->
    <!--                        <h3 class="week-stay">1 Week</h3>-->
    <!--                     </div>-->
    <!--                  </div>-->
    <!--                  <div class="row">-->
    <!--                     <div class="col">-->
    <!--                        <h2 class="selected-text">You selected:</h2>-->
    <!--                        <p class="room">Double Room</p>-->
    <!--                        <a href="#!" class="change-selection">Change your selection</a>-->
    <!--                     </div>-->
    <!--                  </div>-->
    <!--                  <div class="row summary-sec">-->
    <!--                     <div class="col-md-12">-->
    <!--                        <h2 class="your-main-heading">Your Price Summary</h2>-->
    <!--                     </div>-->
    <!--                     <div class="col-md-6">-->
    <!--                        <p class="room">Double Room</p>-->
    <!--                        <p class="room">10 % City tax</p>-->
    <!--                     </div>-->
    <!--                     <div class="col-md-6">-->
    <!--                        <p class="room">$ 59,795.39</p>-->
    <!--                        <p class="room">5,979.54</p>-->
    <!--                     </div>-->
    <!--                  </div>-->
    <!--                  <div class="row price-bg-color">-->
    <!--                     <div class="col-md-12">-->
    <!--                        <div class="row">-->
    <!--                           <div class="col-md-6">-->
    <!--                              <h2 class="your-main-heading">Total Price</h2>-->
    <!--<p class="currency-text">(Your currency)</p>-->
    <!--                           </div>-->
    <!--                           <div class="col-md-6">-->
    <!--                              <h2 class="your-main-heading">$ 65,774.93 *</h2>-->
    <!--                           </div>-->
    <!--                        </div>-->
    <!--   <div class="row">-->
    <!--   <div class="col-md-6">-->
    <!--   <h4 class="property-txt">Property's Currency</h4>-->
    <!--   <p class="currency-text">in US$</p>-->
    <!--   <p class="currency-text">(for 1 week & all guests)</p>-->
    <!--</div>-->
    <!--<div class="col-md-6">-->
    <!--  <h4 class="property-txt">$885.50</h4>-->
    <!--</div>-->
    <!--</div>-->
    <!--                     </div>-->
    <!--                  </div>-->
    <!--<p class="view-para">* This price is converted to show you the approximate cost in Rs. You'll pay in <strong>$</strong>. The exchange rate might change before you pay.</p>-->
    <!--<p class="view-para">Keep in mind that your card issuer may charge you a foreign transaction fee.</p>-->
    <!--            </section>-->
    <!--            </div>-->
    <!--         </div>-->
    <!--      </div>-->
    <!--   </div>-->
    <!--</section>-->

    <script>
        function insurance() {

            $radiovalue = $("input[name='Insurance']:checked").val();

            if ($radiovalue == 1) {

                var finaltotalamount = $('#finaltotalamount').val();

                insuranceintotal = parseInt(finaltotalamount) + 10;

                $('#finaltotalamount').val(insuranceintotal);

                $('#formtotalamount').val(insuranceintotal);

                finaltotalamountheading = '$' + insuranceintotal + ' *';

                $('#finaltotalheading').empty();

                insuranceheading = '<p class="room" id="insuranceheading">Insurance</p>';

                insuranceamount = '<p class="room" id="insuranceamount">$ 10</p>';

                var addfield = $('#finaltotalheading').append(finaltotalamountheading);

                var addsummaryinshed = $('#totalsummaryheading').append(insuranceheading);

                var addsummaryinsamt = $('#totalsummaryamount').append(insuranceamount);

                // $('.totalonsubmit').remove();

                $('.totalonsubmit').html(finaltotalamountheading);


            } else if ($radiovalue == 0) {

                var finaltotalamount = $('#finaltotalamount').val();

                insuranceintotal = parseInt(finaltotalamount) - 10;

                $('#finaltotalamount').val(insuranceintotal);

                $('#formtotalamount').val(insuranceintotal);

                finaltotalamountheading = '$' + insuranceintotal + ' *';

                $('#finaltotalheading').empty();

                var addsummaryinshed = $('#insuranceheading').remove();

                var addsummaryinsamt = $('#insuranceamount').remove();

                var addfield = $('#finaltotalheading').append(finaltotalamountheading);

                // $('.totalonsubmit').val(0);

                $('.totalonsubmit').html(finaltotalamountheading);

            } else {

            }

        }

        $(document).ready(function() {

            var finaltotalamount = $('#finaltotalamount').val();
//            finaltotalamount = parseFloat(finaltotalamount);
//            alert(typeof finaltotalamount);

            $('#formtotalamount').val(finaltotalamount);

            $('.totalonsubmit').append(finaltotalamount);


        });

        function mydonation() {

            $radiovalue = $("input[name='donation']:checked").val();

            if ($radiovalue == 1) {

                var finaltotalamount = $('#finaltotalamount').val();

                var mydonationamount = $('#donationamountform').val();
                console.log(finaltotalamount, mydonationamount);
                donationintotal = parseInt(finaltotalamount) + parseInt(mydonationamount);
                if(mydonationamount==""){
                    $('#donationamountform').val(0);
                }

                $('#finaltotalamount').val(donationintotal);

                $('#subtractdonationamount').val(parseInt(mydonationamount));

                $('#formtotaldonation').val(parseInt(mydonationamount));

                $('#formtotalamount').val(donationintotal);

                finaltotalamountheading = '$' + donationintotal;

                $('#finaltotalheading').empty();

                donationheading = '<div class="col-md-6" ><p class="room" id="donationheading">Donation</p></div>';

                donationamount = '<div class="col-md-6 selected_col_right" ><p class="room" id="donationamount">$ ' + mydonationamount + '</p></div>';

                var addfield = $('#finaltotalheading').append(finaltotalamountheading);

                // $('.totalonsubmit').val(0);

                $('.totalonsubmit').html(finaltotalamountheading);


                var addsummaryinshed = $('#totalsummaryheading .row').append(donationheading);

                var addsummaryinsamt = $('#totalsummaryheading .row').append(donationamount);


            } else if ($radiovalue == 0) {

                var finaltotalamount = $('#finaltotalamount').val();

                var mydonationamount = $('#subtractdonationamount').val();

                $('#formtotaldonation').val(0);

                donationintotal = parseInt(finaltotalamount) - parseInt(mydonationamount);

                $('#formtotalamount').val(donationintotal);

                $('#finaltotalamount').val(donationintotal);

                finaltotalamountheading = '$' + donationintotal;

                $('#finaltotalheading').empty();

                var addsummaryinshed = $('#donationheading').remove();

                var addsummaryinsamt = $('#donationamount').remove();

                var addfield = $('#finaltotalheading').append(finaltotalamountheading);

                // $('.totalonsubmit').val(0);

                $('.totalonsubmit').html(finaltotalamountheading);
            }else{
            }
        }

        $('#creditcardpaymenttab').on('click', function(e) {
            $('#paymenttype').val("creditcard");
        });
        $('#bankpaymenttab').on('click', function(e) {
            $('#paymenttype').val("");
            $('#paymenttype').val("bankpayment");
        });
        $('#paypalpaymenttab').on('click', function(e) {
            $('#paymenttype').val("");
            $('#paymenttype').val("paypal");
        });
        $('#zellepaymenttab').on('click', function(e) {
            $('#paymenttype').val("");
            $('#paymenttype').val("zelle");
        });
        $('#cashpaymenttab').on('click', function(e) {
            $('#paymenttype').val("");
            $('#paymenttype').val("cashpayment");
        });

        $(document).ready(function() {
            $("input[name='paymentTypeselect']").change(function() {
                var radioValue = $("input[name='paymentTypeselect']:checked").val();

                if (radioValue == "CashPayment") {

                    // var onewayamount = jQuery("#onewayprice").val();
                    // var priceinput = jQuery("#price").val(onewayamount);

                    // console.log('cashpayment');

                    // $('#bankpayment').hide();

                    // $('#gatewaypayment').hide();


                    // document.getElementById("cashdepositorname").disabled = false;
                    // document.getElementById("cashdepositorphoneno").disabled = false;
                    // document.getElementById("cashdepositoremail").disabled = false;
                    document.getElementById("paymenttypecash").disabled = false;


                    // document.getElementById("chequedepositorname").disabled = true;
                    // document.getElementById("chequedepositorphoneno").disabled = true;
                    // document.getElementById("chequedepositoremail").disabled = true;
                    // document.getElementById("chequenumber").disabled = true;
                    document.getElementById("paymenttypebank").disabled = true;


                    $("#gatewaypayment").css("display", "none");

                    $("#bankpayment").css("display", "none");

                    $('#cashpayment').show();

                } else if (radioValue == "ChequePayment") {

                    // var twowayamount = jQuery("#twowayprice").val();
                    // var priceinput = jQuery("#price").val(twowayamount);

                    // $('#cashpayment').hide();

                    // $('#gatewaypayment').hide();

                    // document.getElementById("chequedepositorname").disabled = false;
                    // document.getElementById("chequedepositorphoneno").disabled = false;
                    // document.getElementById("chequedepositoremail").disabled = false;
                    // document.getElementById("chequenumber").disabled = false;
                    document.getElementById("paymenttypebank").disabled = false;


                    // document.getElementById("cashdepositorname").disabled = true;
                    // document.getElementById("cashdepositorphoneno").disabled = true;
                    // document.getElementById("cashdepositoremail").disabled = true;
                    document.getElementById("paymenttypecash").disabled = true;


                    $("#gatewaypayment").css("display", "none");

                    $("#cashpayment").css("display", "none");

                    $('#bankpayment').show();

                    console.log('bankpayment');

                } else if (radioValue == "GatewayPayment") {

                    // console.log('gatewaypayment');



                    // document.getElementById("chequedepositorname").disabled = true;
                    // document.getElementById("chequedepositorphoneno").disabled = true;
                    // document.getElementById("chequedepositoremail").disabled = true;
                    // document.getElementById("chequenumber").disabled = true;
                    // document.getElementById("cashdepositorname").disabled = true;
                    // document.getElementById("cashdepositorphoneno").disabled = true;
                    // document.getElementById("cashdepositoremail").disabled = true;
                    document.getElementById("paymenttypecash").disabled = true;
                    document.getElementById("paymenttypebank").disabled = true;

                    // $('#cashpayment').hide();

                    // $('#bankpayment').hide();

                    $("#cashpayment").css("display", "none");

                    $("#bankpayment").css("display", "none");

                    $('#gatewaypayment').show();
                }
            });
        });
    </script>
    <script>
        function validateFields() {
            // alert(document.forms["checkout"]["phone"].value);
            if (document.forms["checkout"]["name"].value == "" ||
                    document.forms["checkout"]["countryCode"].value == "" ||
                    document.forms["checkout"]["phone"].value == "" ||
                    document.forms["checkout"]["email"].value == "" ||
                    document.forms["checkout"]["password"].value == "" ||
                    document.forms["checkout"]["password_confirmation"].value == "") {
                // if (document.forms["checkout"]["password"].value != document.forms["checkout"]["password_confirmation"].value) {
                //     alert("Password and confirm passwords must be same");
                // document.getElementById('checkbox-label').innerHTML = 'Password and confirm passwords must be same';
                // }else {
                // alert("Please fill all the required fields");
                document.getElementById('checkbox-label').innerHTML = 'Please fill all the required fields';
                // }
                // return 'false';
            } else if (document.forms["checkout"]["password"].value != document.forms["checkout"]["password_confirmation"]
                            .value) {
                // alert("Password and confirm passwords must be same");
                document.getElementById('checkbox-label').innerHTML = 'Password and confirm passwords must be same';
            } else {
                // return 'true';
                document.getElementById("check").disabled = false;
                document.getElementById('checkbox-label').innerHTML =
                        'Please make sure all provided information is correct...';
            }
        }
    </script>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script>
    function submit() {

        console.log('Hello Zelle');

        <?php if(isset(Auth::user()->id)): ?>
                <?php else: ?>
        if (document.forms["checkout"]["name"].value == "" ||
                document.forms["checkout"]["countryCode"].value == "" ||
                document.forms["checkout"]["phone"].value == "" ||
                document.forms["checkout"]["email"].value == "" ||
                document.forms["checkout"]["password"].value == "" ||
                document.forms["checkout"]["password_confirmation"].value == "") {
            document.getElementById('fillfieldzelle').innerHTML =
                    '<h3>Please fill all the ( * ) mentioned required fields</h3>';
            return;
        }
        <?php endif; ?>

        // transaction_id        = $("#transaction_id").val();
        // payment_type          = $("#payment_type").val();
        // $('#checkout').append('<input type="hidden" name="transaction_id" value="'+transaction_id+'" />');
        // $('#checkout').append('<input type="hidden" name="payment_type" value="'+payment_type+'" />');
        //document.checkout.submit()
        document.createElement('form').submit.call(document.checkout)
        //document.forms["checkout"].submit();
    }

    function cashpaymentsubmit() {

        // transaction_id                    = $("#transaction_id").val();
        // payment_type                      = $("#payment_type").val();
        // $('#checkout').append('<input type="hidden" name="transaction_id" value="'+transaction_id+'" />');
        // $('#checkout').append('<input type="hidden" name="payment_type" value="'+payment_type+'" />');

        <?php if(isset(Auth::user()->id)): ?>
        // if (document.forms["checkout"]["cashdepositorname"].value == "" ||
        // document.forms["checkout"]["cashdepositorphoneno"].value == "" ||
        // document.forms["checkout"]["cashdepositoremail"].value == ""){

        // document.getElementById('fillfieldcash').innerHTML = '<h3>Please fill all the (*) mentioned required fields</h3>';

        // return;

        // }
        <?php else: ?>
        // if (document.forms["checkout"]["name"].value == "" ||
        // document.forms["checkout"]["countryCode"].value == "" ||
        // document.forms["checkout"]["phone"].value == "" ||
        // document.forms["checkout"]["email"].value == "" ||
        // document.forms["checkout"]["password"].value == "" ||
        // document.forms["checkout"]["password_confirmation"].value == "" ||
        // document.forms["checkout"]["cashdepositorname"].value == "" ||
        // document.forms["checkout"]["cashdepositorphoneno"].value == "" ||
        // document.forms["checkout"]["cashdepositoremail"].value == "") {


        // document.getElementById('fillfieldcash').innerHTML = '<h3>Please fill all the (*) mentioned required fields</h3>';

        // return;

        // }

        if (document.forms["checkout"]["name"].value == "" ||
                document.forms["checkout"]["countryCode"].value == "" ||
                document.forms["checkout"]["phone"].value == "" ||
                document.forms["checkout"]["email"].value == "" ||
                document.forms["checkout"]["password"].value == "" ||
                document.forms["checkout"]["password_confirmation"].value == "") {


            document.getElementById('fillfieldcash').innerHTML =
                    '<h3>Please fill all the ( * ) mentioned required fields</h3>';

            return;

        }
        <?php endif; ?>

        // document.getElementById("chequedepositorname").disabled = true;
        // document.getElementById("chequedepositorphoneno").disabled = true;
        // document.getElementById("chequedepositoremail").disabled = true;
        // document.getElementById("chequenumber").disabled = true;

        document.createElement('form').submit.call(document.checkout)
    }

    function bankpaymentsubmit() {

        // transaction_id                    = $("#transaction_id").val();
        // payment_type                      = $("#payment_type").val();
        // $('#checkout').append('<input type="hidden" name="transaction_id" value="'+transaction_id+'" />');
        // $('#checkout').append('<input type="hidden" name="payment_type" value="'+payment_type+'" />');

        <?php if(isset(Auth::user()->id)): ?>
        // if (

        // document.forms["checkout"]["chequedepositorname"].value == "" ||
        // document.forms["checkout"]["chequedepositorphoneno"].value == "" ||
        // document.forms["checkout"]["chequedepositoremail"].value == "" ||
        // document.forms["checkout"]["chequenumber"].value == ""){

        // document.getElementById('fillfieldbank').innerHTML = '<h3>Please fill all the ( * ) mentioned required fields</h3>';

        // return;

        // }
        <?php else: ?>
        // if (document.forms["checkout"]["name"].value == "" ||
        // document.forms["checkout"]["countryCode"].value == "" ||
        // document.forms["checkout"]["phone"].value == "" ||
        // document.forms["checkout"]["email"].value == "" ||
        // document.forms["checkout"]["password"].value == "" ||
        // document.forms["checkout"]["password_confirmation"].value == "" ||
        // document.forms["checkout"]["chequedepositorname"].value == "" ||
        // document.forms["checkout"]["chequedepositorphoneno"].value == "" ||
        // document.forms["checkout"]["chequedepositoremail"].value == "" ||
        // document.forms["checkout"]["chequenumber"].value == "" ) {


        // document.getElementById('fillfieldbank').innerHTML = '<h3>Please fill all the ( * ) mentioned required fields</h3>';

        // return;

        // }



        if (document.forms["checkout"]["name"].value == "" ||
                document.forms["checkout"]["countryCode"].value == "" ||
                document.forms["checkout"]["phone"].value == "" ||
                document.forms["checkout"]["email"].value == "" ||
                document.forms["checkout"]["password"].value == "" ||
                document.forms["checkout"]["password_confirmation"].value == "") {
            document.getElementById('fillfieldbank').innerHTML =
                    '<h3>Please fill all the ( * ) mentioned required fields</h3>';
            return;
        }
        <?php endif; ?>


        // document.getElementById("cashdepositorname").disabled = true;
        // document.getElementById("cashdepositorphoneno").disabled = true;
        // document.getElementById("cashdepositoremail").disabled = true;

        document.createElement('form').submit.call(document.checkout)
    }
</script>


<!-- Stripe Payment  -->
<script src="https://js.stripe.com/v3/"></script>
<script async>
    // A reference to Stripe.js initialized with a fake API key
    var stripe = Stripe(
            "pk_test_51JaWzdJ9wLXqEzY5CUWp3ytywJKYS1xJrcAz9yNbhx6PPoUOFeOsOOSiWFlfjcc023koJEazq6gMdlqo93C6pFuU00FBEDnUAX"
    );
    // The items the customer wants to buy
    const items = [{
        id: "xl-tshirt"
    }];

    let elements;
    initialize();
    checkStatus();

    document.querySelector("#payment-form").addEventListener("submit", handleSubmit);

    // Fetches a payment intent and captures the client secret

    
    
    
    
    
    
    
    
    
    
    
    

    


    function initialize() {
        $.ajax({
            url: "<?php echo e(route('test1')); ?>",
            type: "post",
            data: {
                '_token': "<?php echo e(csrf_token()); ?>"
            },
            dataType: 'json',
            success: function(response) {
                //                alert(response);
                //                var elements = stripe.elements({
                //                    clientSecret: 'pi_3Jz5GXJ9wLXqEzY51lq7kpC3_secret_VuehJgdCuIgwTSznedyDF3jZN'
                //                });
                var elements = stripe.elements({
                    clientSecret: 'pi_3Jz5GXJ9wLXqEzY51lq7kpC3_secret_VuehJgdCuIgwTSznedyDF3jZN'
                });
                const paymentElement = elements.create("payment");
                paymentElement.mount("#payment-element");
                // You will get response from your PHP page (what you echo or print)
            },
            error: function(error) {
                //                console.log(error.status);
            }
        });
    }

    async function handleSubmit(e) {
        e.preventDefault();
        setLoading(true);

        const {
                error
                } = await stripe.confirmPayment({
            elements,
            confirmParams: {
                // Make sure to change this to your payment completion page
                return_url: "http://localhost/Alziyara",
            },
        });

        // This point will only be reached if there is an immediate error when
        // confirming the payment. Otherwise, your customer will be redirected to
        // your `return_url`. For some payment methods like iDEAL, your customer will
        // be redirected to an intermediate site first to authorize the payment, then
        // redirected to the `return_url`.
        if (error.type === "card_error" || error.type === "validation_error") {
            showMessage(error.message);
        } else {
            showMessage("An unexpected error occured.");
        }

        setLoading(false);
    }

    // Fetches the payment intent status after payment submission
    async function checkStatus() {
        const clientSecret = new URLSearchParams(window.location.search).get(
                "payment_intent_client_secret"
        );
        if (!clientSecret) {
            return;
        }
        const {
                paymentIntent
                } = await stripe.retrievePaymentIntent(clientSecret);

        switch (paymentIntent.status) {
            case "succeeded":
                showMessage("Payment succeeded!");
                break;
            case "processing":
                showMessage("Your payment is processing.");
                break;
            case "requires_payment_method":
                showMessage("Your payment was not successful, please try again.");
                break;
            default:
                showMessage("Something went wrong.");
                break;
        }
    }
    // ------- UI helpers -------

    function showMessage(messageText) {
        const messageContainer = document.querySelector("#payment-message");

        messageContainer.classList.remove("hidden");
        messageContainer.textContent = messageText;

        setTimeout(function() {
            messageContainer.classList.add("hidden");
            messageText.textContent = "";
        }, 4000);
    }

    // Show a spinner on payment submission
    function setLoading(isLoading) {
        if (isLoading) {
            // Disable the button and show a spinner
            document.querySelector("#submit").disabled = true;
            document.querySelector("#spinner").classList.remove("hidden");
            document.querySelector("#button-text").classList.add("hidden");
        } else {
            document.querySelector("#submit").disabled = false;
            document.querySelector("#spinner").classList.add("hidden");
            document.querySelector("#button-text").classList.remove("hidden");
        }
    }

    var finalTotalAmountOriginal = $('#finaltotalheading').html().replace("$", '');
    console.log(finalTotalAmountOriginal);


    $(document).on('click keyup change keydown','#donationamountform',function(){
        $radiovalue = $("input[name='donation']:checked").val();
        var currentDonationAmount  = $(this).val();
        if($(this).val()==""){
            $(this).val(1);
            currentDonationAmount = 1;
        }

        if ($radiovalue == 1) {
            $('#donationamount').html('$ '+currentDonationAmount);
            var finalTotalAmountHtml = $('#finaltotalheading').html();
            finalTotalAmount  = finalTotalAmountHtml.replace("$", '');
            if(finalTotalAmountOriginal==0){
                finalTotalAmountOriginal  = finalTotalAmountHtml.replace("$", '');
            }

            console.log(finalTotalAmountOriginal);
            console.log(currentDonationAmount);
            if(currentDonationAmount==''){
                finalTotalAmount  = parseInt(finalTotalAmountOriginal);
                $('#donationamount').html('$ '+0);
            }else{
                finalTotalAmount  = parseInt(finalTotalAmountOriginal)+parseInt(currentDonationAmount);
            }

            $('#finaltotalheading').html('$'+finalTotalAmount);
        }
//        else{}
    });

</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('website.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/checkout.blade.php ENDPATH**/ ?>