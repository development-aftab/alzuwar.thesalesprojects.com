
<?php if($guestpass->count()>=1): ?>
<div class="tab-pane active" id="all_tab" role="tabpanel">
    <div class="row">
        <?php $__currentLoopData = $guestpass; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <div class="col-md-4 guestpass_view_detail">
                <i class="far fa-heart heart" PropertyID="<?php echo e($gp->GuestPassID); ?>" CategoryID="4" attr="<?php if($gp->getUserFavoriteProperties!=null): ?><?php echo e('heart_checked'); ?><?php else: ?><?php echo e('heart_unchecked'); ?><?php endif; ?>" style="<?php if($gp->getUserFavoriteProperties!=null): ?><?php echo e('background:red'); ?> <?php else: ?><?php echo e('background:grey'); ?><?php endif; ?>" value="abc" id="heart"></i>
                <a href="<?php echo e(route('guestsdetails')); ?>/<?php echo e($gp->GuestPassID); ?>/<?php echo e($gp->GuestPassName); ?>">
                    <div class="card">
                        <?php $__currentLoopData = $gp->getGuestPassDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gp_pics): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($gp_pics->DefaultFlag == '1'): ?>
                                <img class="card-img-top" src="<?php echo e(asset('website').'/'.$gp_pics->PhotoLocation); ?>" alt="<?php echo e($gp->AltText); ?>">
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="card-body">
                            <div class="card_body_content">
                                <p class="three_star"><i class="fas fa-map-marker-alt"></i><?php echo e($gp->GuestPassLocation); ?></p>
                                <h3 class="card-title" title="<?php echo e($gp->GuestPassName); ?>"> <?php echo e($gp->GuestPassName); ?></h3>
                                <div class="mycardguestpassdescription"><?php echo $gp->GuestPassDesc; ?></div>
                            </div>
                            
                                
                            
                            <div class="final_price">
                                <p>
                                    <?php for( $a=1 ; $a <= round($gp->getGuestPassreviewdetails->avg('Rating')) ; $a++ ): ?>
                                        <i class="fas fa-star"></i>
                                    <?php endfor; ?>
                                    <?php for( $a=1 ; $a <= 5-round($gp->getGuestPassreviewdetails->avg('Rating')) ; $a++ ): ?>
                                        <i class="far fa-star"></i>
                                    <?php endfor; ?>
                                </p>
                                <p> From <span>$ <?php echo e(number_format($gp->Price, 2, '.', '')); ?> </span></p>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($guestpass->appends(request()->query())->links()); ?>

    </div>
</div>
<?php else: ?>
<p class="text-center">We're sorry. We were not able to find a match.</p>
<?php endif; ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/guestpass_card_section.blade.php ENDPATH**/ ?>