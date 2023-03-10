<div class="container">
    <?php if($route_name == 'view-favorites'): ?>
        <?php $__currentLoopData = $hotelsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotelData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($hotelData->getUserFavoriteProperties != null): ?>
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <div class="hotel_img">
                            <?php $__currentLoopData = $hotelData->getHotelPics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotelPic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($hotelPic==null): ?>
                                    <img class="card-img-top" src="<?php echo e(asset('website/img/not_available.png')); ?>" alt="Not Available" title="Not Available">
                                <?php elseif($hotelPic->DefaultFlag==1): ?>
                                    <img class="card-img-top" src="<?php echo e(asset('website')); ?>/<?php echo e($hotelPic->PhotoLocation); ?>" alt="<?php echo e($hotelPic->AltText); ?>" title="<?php echo e($hotelPic->PhotoTitle); ?>">
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="hotel_detail">
                            <p class="three_star">
                                <?php for( $a=1 ; $a <= round($hotelData->getHotelReviewAverage->avg('averageRating')) ; $a++ ): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                                <?php for( $a=1 ; $a <= 5-round($hotelData->getHotelReviewAverage->avg('averageRating')) ; $a++ ): ?>
                                    <i class="far fa-star"></i>
                                <?php endfor; ?>
                                <?php if(count($hotelData->getHotelReview)>1): ?>
                                    <?php echo e(count($hotelData->getHotelReview)); ?> reviews
                                <?php else: ?>
                                    <?php echo e(count($hotelData->getHotelReview)); ?> review
                                <?php endif; ?>
                            </p>
                            <h3 class="card-title"> <?php echo e($hotelData->Name); ?></h3>
                            <p class=""> <?php echo e($hotelData->Address); ?>, <?php echo e($hotelData->City); ?></p>
                            <ul class="list-unstyled">



                                <li class="date"><i class="fas fa-door-open"></i> <?php echo e($hotelData->getMinPriceRooms->RoomType); ?></li>
                                <li class="house"><i class="fas fa-bread-slice"></i> Breakfast Included </li>
                                <li class="stay"><i class="fas fa-bed"></i> <?php echo e($hotelData->getMinPriceRooms->QtyOfBed); ?> <?php echo e($hotelData->getMinPriceRooms->getBedType->BedTypeDesc??''); ?>    </li>
                                <?php if($hotelData->PropertyShuttle == 1): ?>
                                    <li class="airfare"><i class="fas fa-shuttle-van"></i> <?php echo e($hotelData->PropertyDistance); ?>km Shuttle Service </li>
                                <?php else: ?>
                                    <li class="airfare"><i class="fas fa-walking"></i> <?php echo e($hotelData->PropertyDistance); ?>km Walking Distance</li>
                                <?php endif; ?>




                            </ul>
                            <?php if($route_name == 'search-hotels'): ?>

                                <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> <?php if($days==0): ?> 1 Night <?php else: ?> <?php echo e($days); ?> Nights <?php endif; ?> &amp; <?php echo e($days+1); ?> Days </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="hotel_view_detail">
                            <i class="far fa-heart heart" PropertyID="<?php echo e($hotelData->PropertyID); ?>" attr="<?php if($hotelData->getUserFavoriteProperties!=null): ?><?php echo e('heart_checked'); ?><?php else: ?><?php echo e('heart_unchecked'); ?><?php endif; ?>" style="<?php if($hotelData->getUserFavoriteProperties!=null): ?><?php echo e('background:red'); ?> <?php else: ?><?php echo e('background:grey'); ?><?php endif; ?>" value="abc" id="heart"></i>
                            <div class="hotel_view_detail_content">
                                
                                <p> From <span>$<?php echo e(number_format($hotelData->getRooms->min('Price'), 0, '.', '')); ?></span></p>
                                <a href="<?php echo e(route('hotelsdetails')); ?>/<?php echo e($hotelData->PropertyID); ?>/<?php echo e($hotelData->Name); ?>?data=<?php echo e(json_encode(request()->all())); ?>" class="view_detail">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>
        <?php if(sizeof($hotelsData)>0): ?>
            <?php $__currentLoopData = $hotelsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotelData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <div class="hotel_img">

                            <?php $__currentLoopData = $hotelData->getHotelPics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotelPic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($hotelPic==null): ?>
                                    <img class="card-img-top" src="<?php echo e(asset('website/img/not_available.png')); ?>" alt="Not Available" title="Not Available">
                                <?php elseif($hotelPic->DefaultFlag==1): ?>
                                    <img class="card-img-top" src="<?php echo e(asset('website')); ?>/<?php echo e($hotelPic->PhotoLocation); ?>" alt="<?php echo e($hotelPic->AltText); ?>" title="<?php echo e($hotelPic->PhotoTitle); ?>">
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="hotel_detail">
                            <p class="three_star">
                                <?php for( $a=1 ; $a <= round($hotelData->getHotelReviewAverage->avg('averageRating')) ; $a++ ): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                                <?php for( $a=1 ; $a <= 5-round($hotelData->getHotelReviewAverage->avg('averageRating')) ; $a++ ): ?>
                                    <i class="far fa-star"></i>
                                <?php endfor; ?>
                                <?php if(count($hotelData->getHotelReview)>1): ?>
                                    <?php echo e(count($hotelData->getHotelReview)); ?> reviews
                                <?php else: ?>
                                    <?php echo e(count($hotelData->getHotelReview)); ?> review
                                <?php endif; ?>
                            </p>
                            <h3 class="card-title"> <?php echo e($hotelData->Name); ?></h3>
                            <p class=""> <?php echo e($hotelData->Address); ?>, <?php echo e($hotelData->City); ?></p>
                            <ul class="list-unstyled">
                                <li class="date"><i class="fas fa-door-open"></i> <?php echo e($hotelData->getMinPriceRooms->RoomType); ?></li>
                                <li class="house"><i class="fas fa-bread-slice"></i> Breakfast Included </li>
                                <li class="stay"><i class="fas fa-bed"></i> <?php echo e($hotelData->getMinPriceRooms->QtyOfBed); ?> <?php echo e($hotelData->getMinPriceRooms->getBedType->BedTypeDesc??''); ?>    </li>
                                <?php if($hotelData->PropertyShuttle == 1): ?>
                                    <li class="airfare"><i class="fas fa-shuttle-van"></i> <?php echo e($hotelData->PropertyDistance); ?>km Shuttle Service </li>
                                <?php else: ?>
                                    <li class="airfare"><i class="fas fa-walking"></i> <?php echo e($hotelData->PropertyDistance); ?>km Walking Distance</li>
                                <?php endif; ?>
                            </ul>
                            <?php if($route_name == 'search-hotels'): ?>
                                <div class="final_price">
                                    <p class="duration"><i class="fas fa-clock"></i> <?php if($days==0): ?> 1 Night <?php else: ?> <?php echo e($days); ?> Nights <?php endif; ?> &amp; <?php echo e($days+1); ?> Days </p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="hotel_view_detail">
                            <i class="far fa-heart heart" PropertyID="<?php echo e($hotelData->PropertyID); ?>" CategoryID="2" attr="<?php if($hotelData->getUserFavoriteProperties!=null): ?><?php echo e('heart_checked'); ?><?php else: ?><?php echo e('heart_unchecked'); ?><?php endif; ?>" style="<?php if($hotelData->getUserFavoriteProperties!=null): ?><?php echo e('background:red'); ?> <?php else: ?><?php echo e('background:grey'); ?><?php endif; ?>" value="abc" id="heart"></i>
                            <div class="hotel_view_detail_content">
                                
                                <p> From <span>$<?php echo e(number_format($hotelData->getRooms->min('Price'), 0, '.', '')); ?></span></p>
                                <a href="<?php echo e(route('hotelsdetails')); ?>/<?php echo e($hotelData->PropertyID); ?>/<?php echo e($hotelData->Name); ?>?data=<?php echo e(json_encode(request()->all())); ?>" class="view_detail">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <p class="text-center">We're sorry. We were not able to find a match.</p>
        <?php endif; ?>
    <?php endif; ?>
    <?php echo e($hotelsData->appends(request()->query())->links()); ?>

</div><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/hotel_card_section.blade.php ENDPATH**/ ?>