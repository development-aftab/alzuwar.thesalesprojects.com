<footer class="alziyara-footer">
    <div class="container">
        <div class="row">
            <?php
               $contactdetails =  \App\ContactDetail::get();
            ?>
            <div class="col-lg-6 col-ft1">
                <img src="<?php echo e(asset('website')); ?>/img/logo.png" alt="">
                <?php echo ($contactdetails->where('slug','contactdetails')->first()->description??'Not Available'); ?>

                <ul class="list-unstyled pb-3 pt-3">
                    <li><a href="tel:<?php echo e(($contactdetails->where('slug','contactdetails')->first()->number??'Not Available')); ?>"><i class="fas fa-phone-alt"></i><?php echo ($contactdetails->where('slug','contactdetails')->first()->number??'Not Available'); ?></a></li>
                    <li><a href="mailto:<?php echo ($contactdetails->where('slug','contactdetails')->first()->email??'Not Available'); ?>"><i class="fas fa-envelope"></i> <?php echo ($contactdetails->where('slug','contactdetails')->first()->email??'Not Available'); ?></a>
                    </li>
                    <li><a href="#"><i class="fas fa-map-marker-alt"></i><?php echo ($contactdetails->where('slug','contactdetails')->first()->location??'Not Available'); ?><br>
                    </a></li>
            </ul>
                <a href="#!"><img src="<?php echo e(asset('website')); ?>/img/paypal.png" alt="" class="img-fluid"></a>
                <a href="#!"><img src="<?php echo e(asset('website')); ?>/img/american-express.png" alt="" class="img-fluid"></a>
                <a href="#!"><img src="<?php echo e(asset('website')); ?>/img/discover.png" alt="" class="img-fluid"></a>
                <a href="#!"><img src="<?php echo e(asset('website')); ?>/img/zelle.png" alt="" class="img-fluid"></a>
            </div>
            <div class="col-lg-3">
                <h3>Partners</h3>
                <ul class="list-unstyled ">
                    <li><a href="<?php echo e(route('list-your-services')); ?>">List your services</a></li>
                    <li><a href="<?php echo e(route('advertise-with-us')); ?>">Advertise With Us</a></li>
                </ul>
                <h3>Explore</h3>
                <ul class="list-unstyled ">
                    <li><a href="<?php echo e(route('mecca')); ?>">Destinations</a></li>
                    <li><a href="<?php echo e(route('flight')); ?>">Flights</a></li>
                    <!-- <li><a href="<?php echo e(route('flight')); ?>">Flight from US</a></li> -->
                    <li><a href="<?php echo e(route('hotels')); ?>">Hotels Deals</a></li>
                    <li><a href="<?php echo e(route('Transport')); ?>">Transportation</a></li>
                    <li><a href="<?php echo e(route('donations')); ?>">Donations</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h3>Help</h3>
                <ul class="list-unstyled ">
                    <li><a href="<?php echo e(route('help')); ?>">Help</a></li>
                    <li><a href="<?php echo e(route('contact_us')); ?>">Contact Us</a></li>
                    <li><a href="<?php echo e(route('return-and-refund')); ?>">Return and Refund</a></li>
                </ul>
                <h3>AlZuwar</h3>
                <ul class="list-unstyled ">
                    <li><a href="<?php echo e(route('aboutus')); ?>">About Us</a></li>
                    <li><a href="<?php echo e(route('careers')); ?>">Careers</a></li>
                    <li><a href="<?php echo e(route('media')); ?>">Media</a></li>
                    <li><a href="<?php echo e(route('terms-and-conditions')); ?>">Terms and Conditions</a></li>
                    <li><a href="<?php echo e(route('cookies-policy')); ?>">Cookie Policy</a></li>
                    <li><a href="<?php echo e(route('privacypolicy')); ?>">Privacy Policy</a></li>
                    <li><a href="<?php echo e(route('terms-and-conditions')); ?>">Terms of Use</a></li>
                </ul>
            </div>
            <div class="col-lg-12 text-center pt-5">
                <p style="color: #2D2D2D; font-size:15px;">©2021 Alziyara. All Rights Reserved.</p>
            </div>
        </div>
    </div>
</footer><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/footer.blade.php ENDPATH**/ ?>