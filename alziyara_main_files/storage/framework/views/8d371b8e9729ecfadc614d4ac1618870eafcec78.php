<body class="visa package_detail transportation-details">

    <?php $__env->startSection('content'); ?>

<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('css/customCss.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('css/responsive.css')); ?>" rel="stylesheet" />
<style>

@media (max-width: 1200px) {
    /* Hotels Reservation inline style start-------------  */
    .transportation-details #form_transport_details .book-now {
        padding: 2px 40px !important;
    }
    .table th {
        text-align: center;
    }
    .table td,
    .table th {
        padding: 0.25rem;
    }
    /* Hotels Reservation inline style end-------------  */
    }
@media (max-width: 991px) {
    /* Packages innerpages inline style start------------- */
    .all-jumpto-bttns {
        margin-left: 50px;
    }
    /* Packages innerpages inline style end------------- */
    }

@media (max-width: 768px) {
    /* Packages innerpages inline style start------------- */
    .package_detail .jumpto-buttons {
        padding: 7px;
    }
    /* Packages innerpages inline style end------------- */
    }

@media (max-width: 767px) {
    /* Packages innerpages inline style start------------- */
    .sec-4 .transportation-imgs img {
        height: auto;
        width: 100%;
    }
    .all-jumpto-bttns {
        margin-left: 0px;
    }
    .package_detail .jumpto-buttons {
        padding: 7px;
    }
    /* Packages innerpages inline style end------------- */
}

@media (max-width: 480px) {
    /* Packages innerpages inline style start------------- */
    .package_detail .jumpto-buttons {
        padding: 0px;
        font-size: 15px;
    }
    .itinerary {
        padding: 0 31px;
    }
    .review_sec {
        padding: 50px 31px;
    }
    .package_detail .all-jumpto-bttns {
        display: flex;
        flex-direction: column;
        width: 35%;
        margin: 10px auto;
    }
    .package_detail .all-jumpto-bttns a {
        margin-bottom: 10px;
        padding: 7px;
    }
    /* Packages innerpages inline style end------------- */
}

@media (max-width: 425px) {
    /* Packages innerpages inline style start------------- */
    .package_detail .all-jumpto-bttns {
        display: flex;
        flex-direction: column;
    }
    .package_detail .jumpto-buttons {
        margin-bottom: 20px;
        padding: 8px;
    }
    .transport-sec .transportation-imgs a.btn {
        width: 38%;
        /* Packages innerpages inline style end------------- */
    }
}

</style>

<?php $__env->stopPush(); ?>
<body class="visa package_detail transportation-details">

    <?php $__env->startSection('content'); ?>


    <section class="transport-sec sec-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-bg-color">
                    
                        
                            
                                
                                    
                                    
                                        
                                            
                                        
                                    
                                
                            
                            
                                
                                
                                     
                                        
                                            
                                                
                                                    
                                                    
                                                        
                                                        
                                                        
                                                        
                                                    
                                                    
                                                    
                                                        
                                                            
                                                            
                                                            
                                                            
                                                        
                                                        
                                                            
                                                            
                                                            
                                                            
                                                        
                                                        
                                                            
                                                            
                                                            
                                                            
                                                        
                                                    
                                                
                                                
                                                    
                                                        
                                                        
                                                        
                                                    

                                                    
                                                        
                                                            
                                                        
                                                    
                                                
                                            
                                        
                                    
                                
                            
                            
                                
                            
                        
                    
                    <?php if($errors->any()): ?>
                        <div class="account-title">
                            <p class="alert alert-success" ><?php echo e($errors->first()); ?></p>
                        </div>
                    <?php endif; ?>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo e(route('packages')); ?>">Package Deals</a></li>
                            <li class="breadcrumb-item"><a href="#"><?php echo e($packages->getPackageDealsType->package_deals_type_desc??''); ?></a></li>
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-7" id="book_now">
                    <div class="card-deck">
                        <?php if($packages->getPackageDealsDefaultPhoto != null): ?>
                        <img src="<?php echo e(asset('website/' . $packages->getPackageDealsDefaultPhoto->PhotoLocation??'NOt Available')); ?>" alt="" class="img-fluid">
					
						<input id="myimage" type="hidden" value="<?php echo e(asset('website/' . $packages->getPackageDealsDefaultPhoto->PhotoLocation??'NOt Available')); ?>" >
                    </div>
                    <?php else: ?>
                    <img class="card-img-top" src="<?php echo e(asset('website/img/not_available.png')); ?>" alt="Not Available" title="Not Available">
				
					<input id="myimage" type="hidden" value="<?php echo e(asset('website/img/not_available.png')); ?>" >
                    <?php endif; ?>
                </div>
                <div class="col-lg-5 transportation-imgs">
                    <div class="row no-gutters">
                        <div class="col-md-12 pb-4">
                            <h2><?php echo e($packages->package_deals_name??''); ?></h2>
                            <small>By: <?php echo e($packages->getPackageUser->name); ?></small>
                            <p>
                                <?php for( $a=1 ; $a <= round($packages->getPackageReviewForView->avg('Rating')) ; $a++ ): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                                <?php for( $a=1 ; $a <= 5-round($packages->getPackageReviewForView->avg('Rating')) ; $a++ ): ?>
                                    <i class="far fa-star"></i>
                                <?php endfor; ?>
                                    <a href="#reviews"><?php echo e($packages->getPackageReviewCountForView->count()); ?> <?php if($packages->getPackageReviewCountForView->count()==1): ?> Review <?php else: ?> Reviews <?php endif; ?></a>
                                <?php if(Auth::user() != null && sizeof($is_user_book_this_before)>0): ?>
                                    /
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
                                            <form method="post" action="<?php echo e(route('add-package-review')); ?>">
                                                
                                                
                                                
                                                
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" value="<?php echo e($packages->id??''); ?>" name="PackageDealsID">
                                                <input type="hidden" value="<?php echo e(Auth::User()->name??''); ?>" name="ReviewerName">
                                                <input type="hidden" value="<?php echo e(Auth::User()->email??''); ?>" name="EmailAddress">
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

                            <p>Group Capacity :<?php echo e($packages->max_occupancy??''); ?></p>

                            <div class="pull-right">
                                <p><b>$<?php echo e(number_format($packages->price, 2, '.', '')); ?></b></p>
                            </div>
                            <h4><?php echo e($packages->package_deals_location??''); ?></h4>
                            <a onclick="getdefaultimage()" data-toggle="modal" data-target="#guestpass" class="btn">Book Now</a>
                        </div>
                        <?php $__currentLoopData = $packages->getPackageDealsPhoto; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $packageImages): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-6">
                            <div class="cards">
                                <img src="<?php echo e(asset('website/' . $packageImages->PhotoLocation??'')); ?>" alt="" class="img-fluid">
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="all-jumpto-bttns">
                            <p class="jump-to-package">Jump to:</p>
                            <a class="btn jumpto-buttons" href="#itinerary" role="button">Itinerary</a>
                            <a class="btn jumpto-buttons" href="#description" role="button">Description</a>
                            <a class="btn jumpto-buttons" href="#house_rules" role="button">House Rules</a>
                            <a class="btn jumpto-buttons" href="#reviews" role="button">Reviews</a>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <section class="itinerary" id="itinerary">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="itinerary_content">
                        <h1>Itinerary</h1>
                        <table class="table itinerary_table">
                            <tbody>
                                <tr>
                                    <th scope="row">DEPARTURE</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i>
                                                    <?php echo e($packages->departure_place??''); ?>  </span></li>
                                        </ul>
                                    </td>
                                </tr>
                                
                                    
                                    
                                        
                                            
                                        
                                    
                                
                                <tr>
                                    <th scope="row">Package Start </th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i><?php echo e(\Carbon\Carbon::parse( $packages->package_available_from??'' )->toFormattedDateString()); ?></span></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Package Ends </th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i><?php echo e(\Carbon\Carbon::parse( $packages->package_available_to??'' )->toFormattedDateString()); ?></span></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">COST</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i>$<?php echo e($packages->price??''); ?></span></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">HOTELS</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i><?php echo e($packages->accomodation??''); ?></span>
                                                
                                            </li>
                                            
                                                
                                            
                                            
                                                        
                                                
                                            
                                            
                                                    
                                        </ul>
                                    </td>

                                </tr>
                                <tr>
                                    <th scope="row">Guide</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i><?php echo e($packages->guide??''); ?></span></li>
                                            <li><span class="check_icon"><i class="fas fa-check"></i>Multilingual
                                                    guides</span></li>
                                        </ul>
                                    </td>

                                </tr>
                                <tr>
                                    <th scope="row">PACKAGE INCLUDE</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i>
                                                    <?php echo e($packages->transportation??''); ?></span></li>
                                            <li><span class="check_icon"><i class="fas fa-check"></i><?php echo e($packages->accomodation??''); ?></span></li>
                                            <li><span class="check_icon"><i class="fas fa-check"></i><?php echo e($packages->meal??''); ?></span></li>
                                            
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Deadline to register</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i><?php echo e(\Carbon\Carbon::parse( $packages->deadline??'' )->toFormattedDateString()); ?></span></li>
                                        </ul>
                                    </td>

                                </tr>
                                <tr>
                                    <th scope="row">Maximum Capacity</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i class="fas fa-check"></i><?php echo e($packages->max_occupancy??''); ?> people</span>
                                            </li>
                                        </ul>
                                    </td>

                                </tr>
                                <tr>
                                    <th scope="row">Package Deadline</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon" style="color:red;"><i class="fas fa-check"></i><?php echo e(\Carbon\Carbon::parse( $packages->deadline??'' )->toFormattedDateString()); ?></span>
                                            </li>
                                        </ul>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                        <div class="package_remain"><a href="#book_now">Book Now (<?php echo e($packages->max_occupancy??''); ?> reservations available)</a></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="review_sec">
        <div class="container">
            <div class="row" id="description">
                <div class="col-md-12">
                    <h3 class="review-title">Description</h3>
                    <p class="review-para"><?php echo $packages->package_deals_desc??''; ?></p>
                </div>
            </div>
            <div class="row" id="house_rules">
                <div class="col-md-12">
                    <h3 class="review-title">House Rules</h3>
                    <p class="review-para"><?php echo $packages->house_rules??''; ?></p>
                </div>
            </div>
                <div class="row" id="reviews">
                    <div class="col-md-12">
                        <div class="review-one">
                            <?php if($packages->getPackageReviewForView->count() != 0): ?>
                            <h3 class="review-title">Reviews</h3>
                            <?php $__currentLoopData = $packages->getPackageReviewForView; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $packageReview): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p><?php for( $a=1 ; $a <= round($packageReview->Rating) ; $a++ ): ?>
                                <i class="fas fa-star"></i>
                            <?php endfor; ?>
                            <?php for( $a=1 ; $a <= 5-round($packageReview->Rating) ; $a++ ): ?>
                                <i class="far fa-star"></i>
                            <?php endfor; ?>
                            </p>
                                <span>Review <?php echo e($packageReview->created_at->diffForHumans()??''); ?></span></h5>
                            </h5>
                            <p class="review-para"><?php echo $packageReview->Description??''; ?></p>
                            <p><?php echo e($packageReview->ReviewerName??''); ?></p>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <div class="row" id="reviews">
                                    <div class="col-md-12 review-one">
                                        <h3 class="review-title">Reviews</h3>
                                        <p class="review-para">No reviews found</p>

                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                    </div>
                </div>		
				<div class="modal fade" id="guestpass">		
					<div class="modal-dialog">		
						<div class="modal-content">		
							<div id="loader"></div>			
							<div class="modal-header">	
								<div class="col-lg-12 transportation-imgs">
									<div class="row no-gutters">
										<div class="col-md-12 pb-4">
											<h2><?php echo e($packages->package_deals_name??''); ?></h2>
												
											<p>
												<?php for( $a=1 ; $a <= round($packages->getPackageReviewForView->avg('Rating')) ; $a++ ): ?>
													<i class="fas fa-star"></i>
												<?php endfor; ?>
												<?php for( $a=1 ; $a <= 5-round($packages->getPackageReviewForView->avg('Rating')) ; $a++ ): ?>
													<i class="far fa-star"></i>
												<?php endfor; ?>
													<a href="#reviews"><?php echo e($packages->getPackageReviewCountForView->count()); ?> <?php if($packages->getPackageReviewCountForView->count()==1): ?> Review <?php else: ?> Reviews <?php endif; ?></a>
												<?php if(Auth::user() != null && sizeof($is_user_book_this_before)>0): ?>
													/
													<!-- Button trigger review modal -->
													

													<!-- Review Modal -->
											
																
																
																
																
																<?php echo csrf_field(); ?>
																
																					
																					
																						
														</div>
														
														
														
														
											<!-- Review Modal End-->
											<?php endif; ?>
											</p>

											<p>Group Capacity  <span> <?php echo e($packages->max_occupancy??''); ?></span></p>

												
										</div>
									</div>
								</div>
							
							
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>	
							</div>                  
							<form action="<?php echo e(route('addtocart')); ?>" id="frmGuestPass" method="post">    
								<?php echo e(csrf_field()); ?>            
								<div class="modal-body">    
								<div id="message"></div>    
								<div class="form-group">     
								<input type="hidden" name="id" value="<?php echo e($packages->id); ?>" />     
								<input type="hidden" id="price" name="price" value="<?php echo e($packages->price); ?>" />  
								<input type="hidden" name="title" value="<?php echo e($packages->package_deals_name); ?>" /> 
								<input type="hidden" name="category" value="1" />                
								<input type="hidden" name="image" id="cartimage" value="" />	
								<input type="hidden" name="date" value="<?php echo e($packages->package_available_from); ?>" />   
								<br />
								<div class="row ml-2 mr-2">
									<div class="col-md-6 ">
									<lable for="addSDphone">Number of Tickets</lable>
									</div>


									<div class="col-md-6 ">
									<input class="form-control" type="number" name="quantity" value="1" min="1"/> 
									</div>
								</div>        
								</div>         
								<div class="modal-footer">   
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

    $(document).ready(function(){
        $("#add_adults").click(function(){
            adults = parseInt($(".adults").val());

            if(adults>=1 && adults<30){
                adults = adults+1;
                $('.adults').val(adults);
                $('#total_guests').val(total_guests);
                total_guests = parseInt($(".adults").val())+parseInt($(".childs").val())+parseInt($(".infants").val());
                $('#total_guests').val(total_guests);
                $(".adults_span").html(adults);
            }
        });
        $("#remove_adults").click(function(){
            adults = $(".adults").val();
            if(adults>1){
                adults = parseInt(adults)-1;
                $('.adults').val(adults);
                total_guests = parseInt($(".adults").val())+parseInt($(".childs").val())+parseInt($(".infants").val());
                $('#total_guests').val(total_guests);
                $(".adults_span").html(adults);
            }
        });

        $("#add_childs").click(function(){
            childs = parseInt($(".childs").val());
            if(childs>=0 && childs<30){
                childs = childs+1;
                $('.childs').val(childs);
                total_guests = parseInt($(".adults").val())+parseInt($(".childs").val())+parseInt($(".infants").val());
                $('#total_guests').val(total_guests);
                $(".childs_span").html(childs);
            }
        });
        $("#remove_childs").click(function(){
            childs = $(".childs").val();
            if(childs>0){
                childs = parseInt(childs)-1;
                $('.childs').val(childs);
                total_guests = parseInt($(".adults").val())+parseInt($(".childs").val())+parseInt($(".infants").val());
                $('#total_guests').val(total_guests);
                $(".childs_span").html(childs);
            }
        });

        $("#add_infants").click(function(){
            infants = parseInt($(".infants").val());
            if(infants>=0 && infants<30){
                infants = infants+1;
                $('.infants').val(infants);
                total_guests = parseInt($(".adults").val())+parseInt($(".childs").val())+parseInt($(".infants").val());
                $('#total_guests').val(total_guests);
                $(".infants_span").html(infants);
            }
        });
        $("#remove_infants").click(function(){
            infants = $(".infants").val();
            if(infants>0){
                infants = parseInt(infants)-1;
                $('.infants').val(infants);
                total_guests = parseInt($(".adults").val())+parseInt($(".childs").val())+parseInt($(".infants").val());
                $('#total_guests').val(total_guests);
                $(".infants_span").html(infants);
            }
        });
    });
    $('#itinerary').click(function() {
        $('.itinerary_content').focus();
    });
    $('#description').click(function() {
        $('.review-para').focus();
    });
    $('#reviews').click(function() {
        $('.review-one').focus();
    });	

	function getdefaultimage(){	
	
		var packageImage = jQuery("#myimage").val();	
		var packagesetImage = jQuery("#cartimage").val(packageImage);
		
	}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('website.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/packagedetail.blade.php ENDPATH**/ ?>