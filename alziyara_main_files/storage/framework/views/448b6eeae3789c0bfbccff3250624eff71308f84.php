<?php $__env->startPush('css'); ?>
<style>
    span.adults_span {padding-left: 25px;}
    input.form-control.adults {text-align: right;padding: 0;width: 40px;}
    input.form-control.childs {text-align: right;padding: 0;width: 40px;}
    input.form-control.infants {text-align: right;padding: 0;width: 40px;}
    #add_adults{margin-top: 3px}
    #remove_adults{margin-top: 3px}
    #add_childs{margin-top: 3px}
    #remove_childs{margin-top: 3px}
    #add_infants{margin-top: 3px}
    #remove_infants{margin-top: 3px}
    .dropdown_heading{display: inline-block;color:#365ca9;padding-left: 30px;padding-top: 5px;}
    .guests_dropdown{width: 250px; background-color: #ffffff}
    .addReviewButton{padding: 0px !important;width: auto;background: none;color: #365ca9 !important;border: none;text-decoration: underline !important;}
    .modal-header{display: block !important;}
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
        .col-12 div {
            display: flex;
            justify-content: space-between;
        }
        .col-md-12.pb-4 p i.fas.fa-star{
            margin-top: 10px;
        }
        .getGuestPass_Price .col-lg-6:nth-child(even) {
    text-align: right;
}
</style>
<?php $__env->stopPush(); ?>
<body class="hotels transportation package transportation-details">

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
                            <li class="breadcrumb-item"><a href="<?php echo e(route('guestspasses')); ?>"> Guest Passes</a></li>
							<li class="breadcrumb-item"><?php echo e($guestPass->GuestPassLocation); ?></li>
                            <li class="breadcrumb-item"><?php echo e($guestPass->GuestPassName); ?></li>
                            
                            
                                
                                
                                    
                                
                            
                        </ol>
                    </nav>
                </div>
                <div class="col-lg-7">
                    <div class="card-deck">
                        <img src="<?php echo e(asset('website').'/'.$guestPass->getGuestPassDefaultPic->PhotoLocation); ?>" alt=""
                            class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-5 transportation-imgs">
                    <div class="row no-gutters">
                        <div class="col-md-12 pb-4">
                            
                            <p class="three_star"><i class="fas fa-map-marker-alt"></i><?php echo e($guestPass->GuestPassLocation); ?></p>
                            <h3 class="card-title" title="<?php echo e($guestPass->GuestPassName); ?>"> <?php echo e($guestPass->GuestPassName); ?></h3>
                            <small> <strong>By: SP Tester</strong>  <?php echo e($guestPass->getGuestPassUser->name); ?></small>
                            <p>
                                <?php for( $a=1 ; $a <= round($guestPass->getGuestPassreviewdetails->avg('Rating')) ; $a++ ): ?>
                                    <i class="fas fa-star"></i>
                                <?php endfor; ?>
                                <?php for( $a=1 ; $a <= 5-round($guestPass->getGuestPassreviewdetails->avg('Rating')) ; $a++ ): ?>
                                    <i class="far fa-star"></i>
                                <?php endfor; ?>
                                <?php echo e($guestPass->getGuestPassreviewdetails->count()); ?> Reviews
                                    <?php if(Auth::user() != null): ?>
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
                                                        <form method="post" action="<?php echo e(route('add-guest-pass-review')); ?>">
                                                            
                                                                
                                                                
                                                            
                                                            <?php echo csrf_field(); ?>
                                                            <input type="hidden" value="<?php echo e($guestPass->GuestPassID); ?>" name="GuestPassID">
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
                            <p>
                            <div class="row getGuestPass_Price">
                               
                                 <div class="col-lg-6">Price</div>
                                <div class="col-lg-6 "> $<?php echo e(number_format($guestPass->Price, 2, '.', '')); ?> Per Person</div>
                                 <div class="col-lg-6">Max Occupancy </div>
                                <div class="col-lg-6 "><?php echo e($guestPass->MaxOccupancy); ?></div>
                            </div>

                            </p>
                            
                            <a id="addtocart" data-toggle="modal" data-target="#guestpass" class="btn cartwork">Book
                                Now</a>
                        </div>


                            <?php $__currentLoopData = $guestPass->getGuestPassDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$getGuestPassDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6">
                            <div class="cards">
                                <img src="<?php echo e(asset('website').'/'.$getGuestPassDetail->PhotoLocation); ?>"
                                    alt="<?php echo e($getGuestPassDetail->AltText); ?>" class="img-fluid">
                            </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                    </div>
                </div>
                <div class="package_detail_link">
                    <span class="jump_to">Jump to:</span>
                    <a href="#itinerary">Itinerary</a>
                    <a href="#description">Description</a>
                    <a href="#house_rules">House Rules</a>
                    <a href="#reviews">Reviews</a>
                </div>
            </div>
        </div>
    </section>
    <section class="itinerary">
        <div class="container">
            <div class="row" id="itinerary">
                <div class="col-md-12">
                    <div class="itinerary_content">
                        <h1>Itinerary</h1>
                        <table class="table itinerary_table">
                            <tbody>
                                <tr>
                                    <th scope="row">Days</th>
                                    <td>
                                        <ul>
                                            <?php  
                                                
                                                $days =  explode(',',$guestPass->ScheduleDays); 
                                            
                                            ?>

                                            <li><span class="check_icon"><i class="fas fa-check"></i>
                                                    <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $availabledays): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                    <?php if($availabledays == "2"): ?>
                                                    Monday,
                                                    <?php elseif($availabledays == "3"): ?>
                                                    Tuesday,
                                                    <?php elseif($availabledays == "4"): ?>
                                                    Wednesday,
                                                    <?php elseif($availabledays == "5"): ?>
                                                    Thursday,
                                                    <?php elseif($availabledays == "6"): ?>
                                                    Friday,
                                                    <?php elseif($availabledays == "7"): ?>
                                                    Saturday,
                                                    <?php elseif($availabledays == "1"): ?>
                                                    Sunday
                                                    <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></span></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">DURATION</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i
                                                        class="fas fa-check"></i><?php echo e($guestPass->GuestPassTime); ?></span>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">COST</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i
                                                        class="fas fa-check"></i>$<?php echo e(number_format($guestPass->Price, 2, '.', '')); ?>

                                                </span></li>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">PROGRAM</th>
                                    <td>
                                        <ul>
                                            <?php $__currentLoopData = $guestPass->getGuestPassprogramDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$getGuestPassDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <span class="check_icon"><i class="fas fa-check"></i><?php echo e(date("g:iA", strtotime($getGuestPassDetail->GuestProDetailTime))); ?></span>
                                                <span class="updated_to_be"><?php echo e($getGuestPassDetail->GuestProDetailDis); ?></span>
                                            </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">Maximum Capacity</th>
                                    <td>
                                        <ul>
                                            <li><span class="check_icon"><i
                                                        class="fas fa-check"></i><?php echo e($guestPass->MaxOccupancy); ?>

                                                    people</span>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--  <div class="form-group col-md-12 text-center mt-5">-->
            <!--    <button class="btn book-now check_avail">BOOK NOW</button>-->
            <!--</div>-->
        </div>
    </section>

    <section class="review_sec">
        <div class="container">
            <div class="row" id="description">
                <div class="col-md-12">
                    <h3 class="review-title">Description</h3>
                    <p class="review-para"><?php echo $guestPass->GuestPassDesc; ?>

                    </p>

                </div>
            </div>
            <div class="row" id="house_rules">
                <div class="col-md-12">
                    <h3 class="review-title">House Rules</h3>
                    <p class="review-para"><?php echo $guestPass->HouseRules; ?>

                    </p>
                </div>
            </div>
                <div class="row" id="reviews">
                    <h3 class="review-title">Reviews</h3>
            <?php if($guestPass->getGuestPassreviewdetails->count()>1): ?>
                    <?php $__currentLoopData = $guestPass->getGuestPassreviewdetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$getGuestPassreviewDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($getGuestPassreviewDetail->ReviewerName != "Admin"): ?>
                        <div class="col-md-12">
                            <div class="review-one">
                                <h5 class="rating">
                                    <?php for( $a=1 ; $a <= $getGuestPassreviewDetail->Rating ; $a++ ): ?>
                                        <i class="fas fa-star"></i>
                                    <?php endfor; ?>
                                    <?php for( $a=1 ; $a <= 5-$getGuestPassreviewDetail->Rating ; $a++ ): ?>
                                        <i class="far fa-star"></i>
                                    <?php endfor; ?>
                                    <span>Review <?php echo e($getGuestPassreviewDetail->created_at->diffForHumans()); ?></span></h5>
                                <p class="review-para"><?php echo e($getGuestPassreviewDetail->Description); ?></p>
                                <h4><?php echo e($getGuestPassreviewDetail->ReviewerName); ?></h4>
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="col-md-12">
                    <div class="review-one">
                        <p class="review-para">No Record Found</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="modal fade" id="guestpass">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div id="loader"></div>
                    <div class="modal-header">
					
						<div class="col-lg-12 transportation-imgs">
								<div class="row no-gutters">
									<div class="col-md-12 pb-4">
										<h2 class="card-title"><?php echo e($guestPass->GuestPassName); ?></h2>
                                    <small><strong>By: SP Tester </strong> <?php echo e($guestPass->getGuestPassUser->name); ?></small>
										<p>
											<?php for( $a=1 ; $a <= round($guestPass->getGuestPassreviewdetails->avg('Rating')) ; $a++ ): ?>
												<i class="fas fa-star"></i>
											<?php endfor; ?>
											<?php for( $a=1 ; $a <= 5-round($guestPass->getGuestPassreviewdetails->avg('Rating')) ; $a++ ): ?>
												<i class="far fa-star"></i>
											<?php endfor; ?>
											<?php echo e($guestPass->getGuestPassreviewdetails->count()); ?> Reviews
												<?php if(Auth::user() != null): ?>

													<!-- Button trigger review modal -->
													
																		
																			
																			
																		
																		<?php echo csrf_field(); ?>
																		
																			  
																			  
																			  
																
																	
																	
																
															
													<!-- Review Modal End-->
                                                <?php endif; ?>
										</p>
										<p>
										<div class="row">
											<div class="col-lg-6">Max Occupancy <?php echo e($guestPass->MaxOccupancy); ?></div>
											<div class="col-lg-6">Price $<?php echo e(number_format($guestPass->Price, 2, '.', '')); ?> per Person</div>
										</div>

										</p>
										<h4><?php echo e($guestPass->GuestPassLocation); ?></h4>
											
									</div>

								</div>
							</div>
					
                        
                    </div>

                    <form action="<?php echo e(route('addtocart')); ?>" id="frmGuestPass" method="post">
                        <?php echo e(csrf_field()); ?>

                        <div class="modal-body">
                            <div id="message"></div>
                            <div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo e($guestPass->GuestPassID); ?>" />
                                    <input type="hidden" id="price" name="price" value="<?php echo e($guestPass->Price); ?>" />
                                    <!--<input type="hidden" id="quantityprice" name="guestpasssingle" value="<?php echo e($guestPass->Price); ?>" />-->
                                    <input type="hidden" name="title" value="<?php echo e($guestPass->GuestPassName); ?>" />
                                    <input type="hidden" name="category" value="<?php echo e($guestPass->Productcategory); ?>" />
                                    <input type="hidden" name="image" value="<?php echo e(asset('website').'/'.$guestPass->getGuestPassDetails[0]->PhotoLocation); ?>" />
                                    <br />

                                        <div  class="row" id="sandbox-container">
                                            <div class="col-md-6">
                                            <label for="addSDphone">Event Date</label>
                                            </div>
                                            <div class="col-md-6">
                                            <input type="text" id="date" name="date" class="form-control datepicker"
                                                data-provide="datepicker" placeholder="Please select a date" value=""
                                                  readonly required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                            <label for="addSDphone">Number of Tickets</label>
                                            </div>
                                            <div class="col-md-6">
                                            <input class="form-control" type="number" name="quantity" value="1" min="1"/>
                                            </div>
                                        </div>
                                        <!--<br />
                                        <lable for="addSDstatus">Guest Pass Booking Quantity</label>
                                            <input type="number" class="form-control" id="gpquanttiy" name="gpquantity" id="addSDstatus" placeholder="Guest Pass Booking Quantity"
                                                name="addstatus" required>-->
                                                <script>
                                                var y = [0, 1, 2, 3, 4, 5, 6];
                                                </script>
                                                <?php $__currentLoopData = $days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $availabledays): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <?php if($availabledays == "2"): ?>
                                                
                                                <script>
                                                //  days.push(1); 

                                                var removeItem = 1;

                                                y = jQuery.grep(y, function(value) {
                                                    return value != removeItem;
                                                });
                                                </script>
                                                <?php elseif($availabledays == "3"): ?>

                                                <script>
                                                //  days.push(1); 

                                                var removeItem = 2;

                                                y = jQuery.grep(y, function(value) {
                                                    return value != removeItem;
                                                });
                                                </script>
                                                <?php elseif($availabledays == "4"): ?>
                                                

                                                <script>
                                                //  days.push(1); 

                                                var removeItem = 3;

                                                y = jQuery.grep(y, function(value) {
                                                    return value != removeItem;
                                                });
                                                </script>
                                                <?php elseif($availabledays == "5"): ?>
                                                

                                                <script>
                                                //  days.push(1); 

                                                var removeItem = 4;

                                                y = jQuery.grep(y, function(value) {
                                                    return value != removeItem;
                                                });
                                                </script>
                                                <?php elseif($availabledays == "6"): ?>
                                                

                                                <script>
                                                //  days.push(1); 

                                                var removeItem = 5;

                                                y = jQuery.grep(y, function(value) {
                                                    return value != removeItem;
                                                });
                                                </script>
                                                <?php elseif($availabledays == "7"): ?>
                                                

                                                <script>
                                                //  days.push(1); 

                                                var removeItem = 6;

                                                y = jQuery.grep(y, function(value) {
                                                    return value != removeItem;
                                                });
                                                </script>
                                                <?php elseif($availabledays == "1"): ?>


                                                <script>
                                                //  days.push(1); 

                                                var removeItem = 0;

                                                y = jQuery.grep(y, function(value) {
                                                    return value != removeItem;
                                                });
                                                </script>
                                                <?php endif; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    
                                           
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


    <script>
    $('#sandbox-container input').datepicker({
        startDate: "today",
        daysOfWeekDisabled: y
    });

    function showdataform() {
        console.log('here');
        var x = document.getElementById("guestpass");
        $('#modals').empty();
        $('#guestpass').modal('show');
        // var x = document.getElementById("guestpass");
        // console.log(x);
        // if (x.style.display === "none") {
        //     x.style.display = "block";
        // } else {
        //     x.style.display = "none";
        // }
    }
    jQuery("#frmGuestPass").delegate("#gpquanttiy", "change", function(){
        // console.log("badar");
        var gpquantity = $('#gpquanttiy').val();
        var gpprice = $('#gpprice').val();
        var totalprice = gpquantity * gpprice;
        $('#gpprice').val(totalprice);
    });
    // $(document).on("click","#addtocart",function(){
    //     console.log("data");
    //         var myoptionid = $(this).attr('id');
    //         //  console.log(myoptionid);
    //         //  e.preventDefault();
    //         var res = myoptionid.split("-");
    //         var price = <?php echo e($guestPass->Price); ?>;
    //         var name =  <?php echo e($guestPass->Price); ?>;
    //         var slotid = document.getElementById('slotid').value;
    //         var section = res[1];
    //         var playerTeamarray = res[0].split(",");
    //         var playerTeam = playerTeamarray[0];
    // console.log(selectvalue);
    // console.log(matchid);
    // console.log(slotid);
    // console.log(section);
    // console.log(playerTeam);
    //         var values = new Array(selectvalue,matchid,slotid,section);	
    //         $.ajax({	
    //         url: "<?php echo e(URL::to('admin/playerscore')); ?>",
    //         type: "post",	
    //         data: {'_token':"<?php echo e(csrf_token()); ?>",'matchid':matchid,'slotid':slotid,'selectvalue':selectvalue,'section':section,'playerTeam':playerTeam},		
    //         success: function (response) {
    //         },		
    //         error: function(jqXHR, textStatus, errorThrown) {
    //             console.log(textStatus, errorThrown);		
    //             }	
    //     })
    // });
    </script>
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
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('website.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/website/guest-details.blade.php ENDPATH**/ ?>