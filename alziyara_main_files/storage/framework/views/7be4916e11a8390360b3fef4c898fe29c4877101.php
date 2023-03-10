<?php if(sizeof($guides)>0): ?>
<div class="tab-pane active" id="tabs-1" role="tabpanel">
    <style>.mycardguidedescription{overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;}</style>
    <div class="row">
        <?php $__currentLoopData = $guides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 guide_view_detail">
                <div class="card" style="width: 18rem">
                    
                    <i class="far fa-heart heart" PropertyID="<?php echo e($guide->GuidesID); ?>" CategoryID="5" attr="<?php if($guide->getUserFavoriteProperties!=null): ?><?php echo e('heart_checked'); ?><?php else: ?><?php echo e('heart_unchecked'); ?><?php endif; ?>" style="<?php if($guide->getUserFavoriteProperties!=null): ?><?php echo e('background:red'); ?> <?php else: ?><?php echo e('background:grey'); ?><?php endif; ?>" value="abc" id="heart"></i>
                    <a href="<?php echo e(route('guide-details')); ?>/<?php echo e($guide->GuidesID??''); ?>/<?php echo e($guide->GuidesName??''); ?>?data=<?php echo e(json_encode(request()->all())); ?>">
                        <?php if(isset($guide->getGuideDefaultPic->PhotoLocation)): ?>
                            <img class="card-img-top" src="<?php echo e(asset('website')); ?>/<?php echo e($guide->getGuideDefaultPic->PhotoLocation); ?>" alt="<?php echo e($guide->getGuideDefaultPic->AltText); ?>" title="<?php echo e($guide->getGuideDefaultPic->PhotoTitle); ?>">
                        <?php else: ?>
                            <img class="card-img-top" src="<?php echo e(asset('website/img/not_available.png')); ?>" alt="Not Available" title="Not Available">
                        <?php endif; ?>
                    </a>
                    <div class="card-body">
                        <div class="card_body_content">
                            <p class="three_star">
                                <?php for( $a=1 ; $a <= round($guide->getGuideReviewAverageForView->avg('averageRating')) ; $a++ ): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                                <?php for( $a=1 ; $a <= 5-round($guide->getGuideReviewAverageForView->avg('averageRating')) ; $a++ ): ?>
                                    <i class="far fa-star"></i>
                                <?php endfor; ?>
                                <?php if(count($guide->getGuideReviewForView)>1): ?>
                                    <?php echo e(count($guide->getGuideReviewForView)); ?> reviews
                                <?php else: ?>
                                    <?php echo e(count($guide->getGuideReviewForView)); ?> review
                                <?php endif; ?>
                            </p>
                            <h3 class="card-title"><?php echo e($guide->GuidesName); ?></h3>														<div class="mycardguidedescription">															<?php echo $guide->GuidesDesc; ?>															</div>
                            
                            
                            
                            
                            
                            
                        </div>
                        <div class="final_price">
                            <p class="duration"><i class="fa fa-language"></i> Language : <?php echo e($guide->Languages); ?> 
                            </p>
                            <p>  <span> $<?php echo e(number_format($guide->PricePerDay, 0, '.', '')); ?>/day</span></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($guides->appends(request()->query())->links()); ?>

    </div>
</div>
<?php else: ?>
    <p class="text-center">We're sorry. We were not able to find a match.</p>
<?php endif; ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/guide_card_section.blade.php ENDPATH**/ ?>