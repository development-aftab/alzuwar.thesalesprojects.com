<?php $__env->startPush('css'); ?>
    <style>
        .card>a>img {height: 227px;object-fit: cover;}
    </style>
<?php $__env->stopPush(); ?>
<div class="tab-pane active" id="view-all" role="tabpanel">
    <div class="row">
        <?php $__currentLoopData = $transports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transport): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-4 transportation_view_detail">
                <div class="card" style="width: 18re">
                    <i class="far fa-heart heart" PropertyID="<?php echo e($transport->VehicleRouteID); ?>" CategoryID="3" attr="<?php if($transport->getUserFavoriteProperties!=null): ?><?php echo e('heart_checked'); ?><?php else: ?><?php echo e('heart_unchecked'); ?><?php endif; ?>" style="<?php if($transport->getUserFavoriteProperties!=null): ?><?php echo e('background:red'); ?> <?php else: ?><?php echo e('background:grey'); ?><?php endif; ?>" value="abc" id="heart"></i>

                    <a href="<?php echo e(route('Transportdetails')); ?>/<?php echo e($transport->VehicleRouteID); ?>/<?php echo e($transport->NameofVehicle); ?>?data=<?php echo e(json_encode(request()->all())); ?>">
                        <img class="card-img-top" src="<?php echo e(asset('website')); ?>/<?php echo e($transport->getTransportDefaultPic->PhotoLocation??'img/not_available.png'); ?>" alt="<?php echo e($transport->getTransportDefaultPic->AltText??''); ?>" alt="<?php echo e($transport->getTransportDefaultPic->PhotoTitle??''); ?>">
                    </a>
                    <div class="card-body">
                        <div class="card_body_content">
                            <p class="three_star">
                                <?php for( $a=1 ; $a <= round($transport->getTransportReviewAverageForView->avg('averageRating')) ; $a++ ): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                                <?php for( $a=1 ; $a <= 5-round($transport->getTransportReviewAverageForView->avg('averageRating')) ; $a++ ): ?>
                                    <i class="far fa-star"></i>
                                <?php endfor; ?>
                                <?php if(count($transport->getTransportReviewForView)>1): ?>
                                    <?php echo e(count($transport->getTransportReviewForView)); ?> reviews
                                    <?php else: ?>
                                    <?php echo e(count($transport->getTransportReviewForView)); ?> review
                                <?php endif; ?>
                            </p>
                            <h3 class="card-title"><?php echo e($transport->NameofVehicle); ?></h3>
                            <?php
                            $featuresIds =  explode(',',$transport->FeatureID);
                            $features = App\VehicleFeaturesList::whereIn('FeatureID',$featuresIds)->take(4)->get();
                            ?>
                            <ul class="list-unstyled">
                                <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myfeature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="stay">
                                        <?php if($myfeature->ImageIcon): ?>
                                            <?php echo $myfeature->ImageIcon; ?>

                                        <?php else: ?>
                                            <i class="fas fa-dot-circle"></i>
                                        <?php endif; ?>
                                        <?php echo e($myfeature->Title); ?>

                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <div class="final_price">
                            <p class="duration" title="Number Of Seats"> <i class="fas fa-chair"></i> <?php echo e($transport->getTransporttype->NumOfSeats.' Seats'??''); ?> </p>
                            <p class="duration" title="Luggage Capacity"><i class="fas fa-briefcase"></i> <?php echo e($transport->getTransporttype->LuggageCapacity.' Bags'??''); ?> </p>
                            

                            
                                
                                    
                                
                            
                            
                                
                                    
                                
                            
                            
                            <p> From <span> $ <?php echo e(number_format($transport->getTransportRoutes[0]->Price??0,2)); ?>

                                    
                                </span></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php echo e($transports->appends(request()->query())->links()); ?>

    </div>
</div><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/transportation_card_section.blade.php ENDPATH**/ ?>