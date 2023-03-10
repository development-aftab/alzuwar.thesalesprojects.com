<?php $__env->startPush('css'); ?>
    <style>

        /*Rameez Css*/
        .sec-4 .tab-content .card a img {
            width: 100%;
            height: 195px;
        }

        /*.sec-4 .tab-content .card {*/
            /*height: 610px;*/
        /*}*/


    </style>
<?php $__env->stopPush(); ?>

<?php if(sizeof($packages)>0): ?>
<?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-4 package_view_detail">
        <div class="card" style="width: 18re">
            <i class="far fa-heart heart" PropertyID="<?php echo e($package->id); ?>" CategoryID="1" attr="<?php if($package->getUserFavoriteProperties!=null): ?><?php echo e('heart_checked'); ?><?php else: ?><?php echo e('heart_unchecked'); ?><?php endif; ?>" style="<?php if($package->getUserFavoriteProperties!=null): ?><?php echo e('background:red'); ?> <?php else: ?><?php echo e('background:grey'); ?><?php endif; ?>" value="abc" id="heart"></i>
            <a href="<?php echo e(route('packagedetail')); ?>/<?php echo e($package->id??''); ?>/<?php echo e($package->package_deals_name??''); ?>">
                <?php if($package->getPackageDealsDefaultPhoto != null): ?>
                    <img class="card-img-top" src="<?php echo e(asset('website/' . $package->getPackageDealsDefaultPhoto->PhotoLocation??'Not Available')); ?>" alt="Card image cap" width="350px">
                <?php else: ?>
                    <img src='<?php echo e(asset('website/img/karbala.png')); ?>' width="350px">
                <?php endif; ?>
                <div class="card-body">
                    <div class="card_body_content">
                        <p class="three_star"><i class="fas fa-map-marker-alt"></i><?php echo e($package->package_deals_location??''); ?> </p>
                        <h3 class="card-title" title="<?php echo e($package->package_deals_name??''); ?>"> <?php echo e($package->package_deals_name??''); ?></h3>
                        <ul class="list-unstyled">
                                                        <li class="date"><i class="far fa-calendar-plus"></i> <?php echo e($package->package_available_from??''); ?> to <?php echo e($package->package_available_to??''); ?></li>
                            <li class="stay"><i class="fas fa-bed"></i> <?php echo e($package->accomodation??''); ?></li>
                            <li class="house"><i class="fas fa-utensils"></i><?php echo e($package->meal??''); ?></li>
                            <li class="airfare"><i class="fas fa-bus"></i><?php echo e($package->transportation??''); ?></li>
                            <li class="airfare"><i class="fas fa-praying-hands"></i><?php echo e($package->location??''); ?></li>
                            <li class="airfare"><i class="fas fa-suitcase"></i>$<?php echo e($package->airfare??''); ?></li>
                        </ul>
                    </div>
                    <div class="final_price" >
                        <p>
                            <?php for( $a=1 ; $a <= round($package->getPackageReviewForView->avg('Rating')) ; $a++ ): ?>
                                <i class="fas fa-star"></i>
                            <?php endfor; ?>
                            <?php for( $a=1 ; $a <= 5-round($package->getPackageReviewForView->avg('Rating')) ; $a++ ): ?>
                                <i class="far fa-star"></i>
                            <?php endfor; ?>
                        </p>
                        <p> From <span> $<?php echo e($package->price); ?> </span></p>
                    </div>
                </div>
            </a>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
    <p class="text-center">We're sorry. We were not able to find a match.</p>
<?php endif; ?>
<?php echo e($packages->appends(request()->query())->links()); ?>



<?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/package_card_section.blade.php ENDPATH**/ ?>