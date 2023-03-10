<?php $__env->startPush('css'); ?>
    <style>
        .addReviewButton{padding: 0px !important;width: auto;background: none;color: #365ca9 !important;border: none;text-decoration: underline !important;}
        .star-cb-group {
            /* remove inline-block whitespace */
            font-size: 0;
            /* flip the order so we can use the + and ~ combinators */
            unicode-bidi: bidi-override;
            direction: rtl;
            /* the hidden clearer */
        }
        .star-cb-group * {
            font-size: 1rem;
        }
        .star-cb-group > input {
            display: none;
        }
        .star-cb-group > input + label {
            /* only enough room for the star */
            display: inline-block;
            /*overflow: hidden;*/
            /*text-indent: 9999px;*/
            width: 1em;
            white-space: nowrap;
            cursor: pointer;
        }
        .star-cb-group > input + label:before {
            display: inline-block;
            text-indent: -9999px;
            content: "☆";
            color: #DDC01A;
            font-size: 45px;
        }
        .star-cb-group > input:checked ~ label:before, .star-cb-group > input + label:hover ~ label:before, .star-cb-group > input + label:hover:before {
            content: "★";
            color: #DDC01A;
            text-shadow: 0 0 1px #333;
        }
        .star-cb-group > .star-cb-clear + label {
            text-indent: -9999px;
            width: .5em;
            margin-left: -.5em;
        }
        .star-cb-group > .star-cb-clear + label:before {
            width: .5em;
        }
        .star-cb-group:hover > input + label:before {
            content: "☆";
            color: #888;
            text-shadow: none;
        }
        .star-cb-group:hover > input + label:hover ~ label:before, .star-cb-group:hover > input + label:hover:before {
            content: "★";
            color: #DDC01A;
            text-shadow: 0 0 1px #333;
        }
        .star-cb-group > input + label {
            padding: 0 20px;
        }
        fieldset {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .transportation-imgs .cards>img {
            height: 160px;
            object-fit: cover;
        }
        .transport-sec .transportation-imgs a.btn {
            margin-top: 5px !important ;
        }
        .modal-body .recipt div {
            display: flex;
            justify-content: space-between;
        }
        .modal-body{
            padding: 1rem 34px;
        }
        .price_detail .col-md-6 p {
    font-size: 16px;
    font-weight: bold;
}
.price_detail .col-md-6:nth-child(even) p {
    text-align: right;
}

    </style>
<?php $__env->stopPush(); ?>
<body class="visa transportation-details">

<?php $__env->startSection('content'); ?>

    <section class="transport-sec sec-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-bg-color">
                    <form role="form" method="get" action="<?php echo e(route('search-guide')); ?>" id="form_transport_details" class="margin-bottom-0">
                        
                        <div class="form-row d-flex" style="align-item:end;">
                            <div class="form-group col-md-3">
                                <div class="input-group" id="pickup-date">
                                    <label for=""><i class="fas fa-calendar-alt"></i></label>
                                    <?php
                                    $tour_start_date=date('m/d/Y');
                                    $tour_end_date=Date('m/d/Y', strtotime('+10 days'));
                                    //$default_checkin=Date('m/d/Y', strtotime('+7 days'));
                                    //$default_checkout=Date('m/d/Y', strtotime('+17 days'));
                                    ?>
                                    <input type="text" name="daterange" min="<?php echo e($tour_start_date); ?>" value="<?php echo e($checkin_date??$tour_start_date); ?> - <?php echo e($checkout_date??$tour_end_date); ?>" class="form-control" />
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class="input-group" id="loc-from">
                                    <label for=""><i class="fas fa-map-marker-alt"></i></label>
                                    <select class="form-control" name="city" required>
                                        <option value="" selected disabled>City</option>
                                        <?php $__currentLoopData = $guide_cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide_city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($existingData): ?>

                                                <option value="<?php echo e($guide_city->city_name??''); ?>" <?php if($existingData->city == $guide_city->city_name): ?> selected <?php endif; ?>><?php echo e(ucfirst($guide_city->city_name??'')); ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo e($guide_city->city_name??''); ?>"><?php echo e(ucfirst($guide_city->city_name??'')); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <div class="input-group" id="loc-from">
                                    <label for=""><i class="fa fa-language"></i></label>
                                    <select class="form-control" name="language" required>
                                        <option value="" selected disabled>Language</option>
                                        <?php $__currentLoopData = $guide_languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guide_language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($existingData): ?>
                                                
                                                <option value="<?php echo e($guide_language->language_name??''); ?>" <?php if($existingData->language == $guide_language->language_name): ?> selected <?php endif; ?>><?php echo e(ucfirst($guide_language->language_name??'')); ?></option>
                                            <?php else: ?>
                                                <option value="<?php echo e($guide_language->language_name??''); ?>"><?php echo e(ucfirst($guide_language->language_name??'')); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <input class="total_guests_guide" id="total_guests_guide" name="total_guests_guide" value="2" readonly hidden>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group" id="one-way">
                                        <div class="dropdown keep-open">
                                            <!-- Dropdown Button -->
                                            <button id="dLabel" role="button" href="#" data-toggle="dropdown" data-target="#" class="btn btn-light">
                                                <i class="fas fa-user"></i>
                                                <span class="adults_span_guide"><?php echo e($adults_guide??0); ?></span> Adults,
                                                <span class="childs_span_guide"><?php echo e($childs_guide??0); ?></span> Children,
                                                <span class="infants_span_guide"><?php echo e($infants_guide??0); ?></span> Infants
                                            </button>
                                            <!-- Dropdown Menu -->
                                            <div class="dropdown-menu guests_dropdown" role="menu" aria-labelledby="dLabel">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-12 dropdown_heading">Adults</div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_adults_guide">-</span></div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="adults_input_field_guide">
                                                        <input type="number" class="form-control adults_guide" name="adults_guide" value="<?php echo e($adults_guide??0); ?>" readonly min="2"></span></div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_adults_guide">+</span></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-12 dropdown_heading">Children</div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_childs_guide">-</span></div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field_guide">
                                                        <input type="number" class="form-control childs_guide" name="childs_guide" value="<?php echo e($childs_guide??0); ?>" readonly min="0"></span></div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_childs_guide">+</span></div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-12 dropdown_heading">Infants</div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-danger mx-2" id="remove_infants_guide">-</span></div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="childs_input_field_guide">
                                                        <input type="number" class="form-control infants_guide" name="infants_guide" value="<?php echo e($infants_guide??0); ?>" readonly min="0"></span></div>
                                                    <div class="col-lg-3 col-md-4 col-sm-4 col-4"><span class="btn btn-sm btn-success mx-2" id="add_infants_guide">+</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <script>
                                            $('.keep-open').on({
                                                "shown.bs.dropdown": function() { $(this).attr('closable', false); },
                                                "click":             function() { },
                                                "hide.bs.dropdown":  function() { return $(this).attr('closable') == 'true'; }
                                            });

                                            $('.keep-open #dLabel').on({
                                                "click": function() {
                                                    $(this).parent().attr('closable', true );
                                                }
                                            })
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-2">
                                <button class="btn book-now">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
			<div>
			<?php if($errors->any()): ?>
				<div class="alert alert-danger">
			<ul>
			<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<li><?php echo e($error); ?></li>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			</ul>
			</div>
			<?php endif; ?>
			<?php if(session('bookedDates')): ?>
				<?php $__currentLoopData = session('bookedDates'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="alert alert-danger">
						<ul>
								<li>This Guide is booked on this Date <?php echo e($error); ?></li>
						</ul>
					</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			<?php endif; ?>
			</div>
            <div class="row">
                <div class="col-md-12 pt-5">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('guide')); ?>">Guide</a></li>
                            <li class="breadcrumb-item"><a href=""><?php echo e(ucfirst($guides->GuidesName??'')); ?></a></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-7">
                    <div class="card-deck">

                        <?php if($guides->getGuideDefaultPic==null): ?>
                            <img class="card-img-top" src="<?php echo e(asset('website/img/not_available.png')); ?>" alt="Not Available" title="Not Available">														<input id="myimage" type="hidden" value="<?php echo e(asset('website/img/not_available.png')); ?>" >
                        <?php else: ?>
                            <img class="card-img-top" src="<?php echo e(asset('website')); ?>/<?php echo e($guides->getGuideDefaultPic->PhotoLocation); ?>" alt="<?php echo e($guides->AltText); ?>" title="<?php echo e($guides->PhotoTitle); ?>">														<input id="myimage" type="hidden" value="<?php echo e(asset('website')); ?>/<?php echo e($guides->getGuideDefaultPic->PhotoLocation); ?>" >
                        <?php endif; ?>
                    </div>

                </div>
                <div class="col-lg-5 transportation-imgs">
                    <div class="row">
                        <div class="col-md-12 pb-4">
                            <p class="three_star"><i class="fas fa-map-marker-alt"></i><?php echo e($guides->GuidesLocation??''); ?> </p>
                            <h2 class="card-title"><?php echo e($guides->GuidesName??''); ?></h2>
                            <p>
                                <?php for( $a=1 ; $a <= round($guides->getGuideReviewAverageForView->avg('averageRating')) ; $a++ ): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                                <?php for( $a=1 ; $a <= 5-round($guides->getGuideReviewAverageForView->avg('averageRating')) ; $a++ ): ?>
                                    <i class="far fa-star"></i>
                                <?php endfor; ?>
                                <?php if(count($guides->getGuideReview)>1): ?>
                                    <?php echo e(count($guides->getGuideReviewForView)); ?> reviews
                                <?php else: ?>
                                    <?php echo e(count($guides->getGuideReviewForView)); ?> review
                                <?php endif; ?>
                                <?php if(Auth::user() != null): ?>

                                    <!-- Button trigger review modal -->
                                    <a type="button" class="addReviewButton" data-toggle="modal" data-target="#addReviewModal">
                                        Write a review
                                    </a>

                                    <!-- Review Modal -->
                            <div class="modal fade" id="addReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Write A Review</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="<?php echo e(route('add-guide-review')); ?>">
                                                
                                                
                                                
                                                
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" value="<?php echo e($guides->GuidesID); ?>" name="GuidesID">
                                                <input type="hidden" value="<?php echo e(Auth::User()->name); ?>" name="Name">
                                                <input type="hidden" value="<?php echo e(Auth::User()->email); ?>" name="EmailAddress">
                                                <input type="hidden" value="<?php echo e(\Request::getClientIp(true)); ?>" name="IPAddress">
                                                <div class="form-group">
                                                    <label for="message-text" class="col-form-label">Message:</label>
                                                    <textarea class="form-control" id="message-text" name="Description" required></textarea>
                                                </div>
                                                <fieldset>
                                                    <span class="star-cb-group">
                                                        <input type="radio" id="rating-5" name="Rating" value="5" />
                                                        <label for="rating-5"></label>
                                                        <input type="radio" id="rating-4" name="Rating" value="4" />
                                                        <label for="rating-4"></label>
                                                        <input type="radio" id="rating-3" name="Rating" value="3" />
                                                        <label for="rating-3"></label>
                                                        <input type="radio" id="rating-2" name="Rating" value="2" />
                                                        <label for="rating-2"></label>
                                                        <input type="radio" id="rating-1" name="Rating" value="1" />
                                                        <label for="rating-1"></label>
                                                    </span>
                                                </fieldset>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Add Review</button>
                                            </form>
                                        </div>
                                        
                                        
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- Review Modal End-->
                            <?php endif; ?>
                            </p>
                            <div class="row recipt price_detail">
                                <div class="col-md-6"><p> Price Per Day:</p></div>
                                <div class="col-md-6 selected_col_right"><p> $<?php echo e(number_format($guides->PricePerDay, 0, '.', '')); ?></p></div>
                                <div class="col-md-6"><p>Max Occupancy:</p></div>
                                <div class="col-md-6 selected_col_right"><p> <?php echo e($guides->MaxOccupancy); ?></p></div>
                            </div>
							<div class="row  price_detail">
								<div class="col-md-6"><p>Guide Based in:</p></div>
                                <div class="col-md-6 selected_col_right"><p><?php echo e($guides->GuidesLocation); ?></p></div>
                                <div class="col-md-6"><p>Guide Languages:</p></div>
                                <div class="col-md-6 selected_col_right"><p><?php echo e($guides->Languages); ?></p></div>
                            </div>
                            

                            <a id="addtocart" onClick="getdefaultimage()" data-toggle="modal" data-target="#guide" class="btn book-now">Book Now</a>
                        </div>
                        <?php $__currentLoopData = $guides->getGuidePics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guidePic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($guidePic->DefaultFlag == 0): ?>
                                <div class="col-md-6">
                                    <div class="cards">
                                        <img class="card-img-top" src="<?php echo e(asset('website')); ?>/<?php echo e($guidePic->PhotoLocation); ?>" alt="<?php echo e($guidePic->AltText); ?>" title="<?php echo e($guidePic->PhotoTitle); ?>">
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="jump_to">
                        <p class="jump-to">Jump to:
                            
                            <a href="#description"> Description</a>
                            <a href="#reviews"> Reviews</a>
                            <a href="#house_rules"> House Rules</a>
                            <a href="#reviews"> Reviews</a>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
        
            
                
                    
                        
                    
                
                
                    
                
            
        
    
    <section id="description" class="transport-last-sect">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="review-title">Description</h3>
                    <p class="review-para"><?php echo $guides->GuidesDesc; ?></p>
                </div>
            </div>
			<div class="row" id="house_rules">
                <div class="col-md-12">
                    <h3 class="review-title">House Rules</h3>
                    <p class="review-para"><?php echo $guides->HouseRules; ?></p>
                </div>
            </div>
            
                
                    
                    
                
            
            <?php if($guides->getGuideReview->count()>1): ?>
                <div class="row" id="reviews">
                    <div class="col-md-12 review-one">
                        <h3 class="review-title">Reviews</h3>
                        <?php $__currentLoopData = $guides->getGuideReviewForView; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guidereview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <h5 class="rating">
                                <?php for( $a=1 ; $a <= $guidereview->Rating ; $a++ ): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                                <?php for( $a=1 ; $a <= 5-$guidereview->Rating ; $a++ ): ?>
                                    <i class="far fa-star"></i>
                                <?php endfor; ?>
                                <span>Reviewed <?php echo e(\Carbon\Carbon::parse($guidereview->ReviewOn)->diffForHumans()); ?></span>
                            </h5>
                            <p class="review-para"><?php echo e($guidereview->Description); ?></p>
                            <p class="review-para"><?php echo e($guidereview->Name); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="row" id="reviews">
                    <div class="col-md-12 review-one">
                        <h3 class="review-title">Reviews</h3>
                            <p class="review-para">No reviews found</p>

                    </div>
                </div>
            <?php endif; ?>
			<div class="modal fade" id="guide">
				<div class="modal-dialog">
					<div class="modal-content">
						<div id="loader"></div>
						
							
								

							
						
						
						<form action="<?php echo e(route('addtocart')); ?>" id="frmGuestPass" method="post">
						<?php echo e(csrf_field()); ?>

						<div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12 transportation-imgs">
                                    <div class="row">
                                        <div class="col-md-12 pb-4">
                                            <h2><?php echo e($guides->GuidesName??''); ?></h2>
                                            <p>
                                                <?php for( $a=1 ; $a <= round($guides->getGuideReviewAverageForView->avg('averageRating')) ; $a++ ): ?>
                                                    <i class="fas fa-star"></i>
                                                <?php endfor; ?>
                                                <?php for( $a=1 ; $a <= 5-round($guides->getGuideReviewAverageForView->avg('averageRating')) ; $a++ ): ?>
                                                    <i class="far fa-star"></i>
                                                <?php endfor; ?>
                                                <?php if(count($guides->getGuideReview)>1): ?>
                                                    <?php echo e(count($guides->getGuideReviewForView)); ?> reviews
                                                <?php else: ?>
                                                    <?php echo e(count($guides->getGuideReviewForView)); ?> review
                                                <?php endif; ?>
                                                <?php if(Auth::user() != null): ?>

                                                <?php endif; ?>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                                
                            </div>
							<div id="message"></div>
							<div class="form-group">
								<input type="hidden" name="id" value="<?php echo e($guides->GuidesID); ?>" />
								<input type="hidden" id="price" name="price" value="<?php echo e($guides->PricePerDay); ?>" />
								
								<input type="hidden" name="title" value="<?php echo e($guides->GuidesName); ?>" />
								<input type="hidden" name="category" value="<?php echo e($guides->Productcategory); ?>" />

								<input type="hidden" id="cartimage" name="image" value="" />

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="recipt">
                                           <div> <p>Price Per Day:</p> <p>$<?php echo e(number_format($guides->PricePerDay, 0, '.', '')); ?></p></div>
                                            <div> <p>Max Occupancy: </p><p><?php echo e($guides->MaxOccupancy); ?></p></div>
                                            <div> <p>	Guide Based in:</p>
                                               <p>	<?php echo e($guides->GuidesLocation); ?></p></div>
                                           <div> <p>Booking Duration: </p>
                                            <p>
                                                <input class="form-control"  type="text" name="date" value="<?php echo e($checkin_date??$tour_start_date); ?> - <?php echo e($checkout_date??$tour_end_date); ?>" placeholder="Please select a date"  required  readonly />
                                            </p>
                                           </div>
                                        </div>

                                    </div>
                                    </div>
								<div class="row">
									<div class="col-md-6">

									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										
									</div>
									<div class="col-md-6">
									
									</div>
								</div>
								<!--<lable for="addSDphone">Number of Tickets</lable>-->
								<input class="form-control" type="hidden" name="quantity" value="<?php echo e($guides->MaxOccupancy); ?>" min="1"/>

								
							</div>
						</div>
						<div class="modal-footer">
						<button type="submit" class="btn btn-primary">ADD TO CART</button>
						</div>
						</form>
					</div>
				</div>
			</div>
        </div>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script>

        <!-- for guide -->
        $(document).ready(function(){
            $("#add_adults_guide").click(function(){
                adults_guide = parseInt($(".adults_guide").val());

                if(adults_guide>=0 && adults_guide<30){
                    adults_guide = adults_guide+1;
                    $('.adults_guide').val(adults_guide);
                    $('#total_guests_guide').val(total_guests_guide);
                    total_guests_guide = parseInt($(".adults_guide").val())+parseInt($(".childs_guide").val())+parseInt($(".infants_guide").val());
                    $('#total_guests_guide').val(total_guests_guide);
                    $(".adults_span_guide").html(adults_guide);
                }
            });
            $("#remove_adults_guide").click(function(){
                adults = $(".adults_guide").val();
                if(adults_guide>0){
                    adults_guide = parseInt(adults_guide)-1;
                    $('.adults_guide').val(adults_guide);
                    total_guests_guide = parseInt($(".adults_guide").val())+parseInt($(".childs_guide").val())+parseInt($(".infants_guide").val());
                    $('#total_guests_guide').val(total_guests_guide);
                    $(".adults_span_guide").html(adults_guide);
                }
            });

            $("#add_childs_guide").click(function(){
                childs_guide = parseInt($(".childs_guide").val());
                if(childs_guide>=0 && childs_guide<30){
                    childs_guide = childs_guide+1;
                    $('.childs_guide').val(childs_guide);
                    total_guests_guide = parseInt($(".adults_guide").val())+parseInt($(".childs_guide").val())+parseInt($(".infants_guide").val());
                    $('#total_guests_guide').val(total_guests_guide);
                    $(".childs_span_guide").html(childs_guide);
                }
            });
            $("#remove_childs_guide").click(function(){
                childs = $(".childs_guide").val();
                if(childs_guide>0){
                    childs_guide = parseInt(childs_guide)-1;
                    $('.childs_guide').val(childs_guide);
                    total_guests_guide = parseInt($(".adults_guide").val())+parseInt($(".childs_guide").val())+parseInt($(".infants_guide").val());
                    $('#total_guests_guide').val(total_guests_guide);
                    $(".childs_span_guide").html(childs_guide);
                }
            });

            $("#add_infants_guide").click(function(){
                infants_guide = parseInt($(".infants_guide").val());
                if(infants_guide>=0 && infants_guide<30){
                    infants_guide = infants_guide+1;
                    $('.infants_guide').val(infants_guide);
                    // total_guests_guide = parseInt($(".adults_guide").val())+parseInt($(".childs_guide").val())+parseInt($(".infants_guide").val());
                    // $('#total_guests_guide').val(total_guests_guide);
                    $(".infants_span_guide").html(infants_guide);
                }
            });
            $("#remove_infants_guide").click(function(){
                infants_guide = $(".infants_guide").val();
                if(infants_guide>0){
                    infants_guide = parseInt(infants_guide)-1;
                    $('.infants_guide').val(infants_guide);
                    // total_guests_guide = parseInt($(".adults_guide").val())+parseInt($(".childs_guide").val())+parseInt($(".infants_guide").val());
                    // $('#total_guests_guide').val(total_guests_guide);
                    $(".infants_span_guide").html(infants_guide);
                }
            });
        });

			var start = moment();

			var end = moment();

			$('input[name="date"]').daterangepicker({

					minDate: new Date()

					});


		function getdefaultimage(){

			var guideImage = jQuery("#myimage").val();
			var guidesetImage = jQuery("#cartimage").val(guideImage);

		}

    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('website.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/guidedetails.blade.php ENDPATH**/ ?>