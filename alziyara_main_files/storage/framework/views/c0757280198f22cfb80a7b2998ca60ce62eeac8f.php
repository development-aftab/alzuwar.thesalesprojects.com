<?php $__env->startPush('css'); ?>
<style>
table.table{
    display:block;
}
</style>
<?php $__env->stopPush(); ?>



<?php $__env->startSection('content'); ?>



	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <!-- <link href="<?php echo e(asset('plugins/components/dashboard/css/customstyle.css')); ?>" rel="stylesheet" /> -->
    <link href="<?php echo e(asset('css/customCss.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('css/responsive.css')); ?>" rel="stylesheet" />
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



			<p class="alert alert-success"><?php echo e(session('message')); ?></p>



		</div>

	<?php endif; ?>

    <?php
	
		/*

		$insurancecount = 0;
		$donationcount = 0;
		$donationamount = 0;
		$myfinalprice = 0;
		$insuranceamount = 0;
		$allfinal = 0;
		$myallfinalprice = 0;

    ?>


	@foreach($roomreservestatus as $key => $myroomgroup)


		@if(isset($myroomgroup->getReservationOrdersroom))

            <?php


            if(($myroomgroup->Insurance == 1) && ($myroomgroup->Donation == 0)){

                $myfinalprice = 0;

                $myfinalprice = $myroomgroup->TotalPrice - 10;

            }elseif(($myroomgroup->Donation == 1) && ($myroomgroup->Insurance == 0)){

                $myfinalprice = 0;

                $myfinalprice = $myroomgroup->TotalPrice - $myroomgroup->Donation_amount;

            }elseif(($myroomgroup->Insurance == 1) && ($myroomgroup->Insurance == 1) ){

                $myfinalprice = 0;

                $myfinalprice = $myroomgroup->TotalPrice - $myroomgroup->Donation_amount - 10;

            }else{

                $myfinalprice = 0;

                $myfinalprice = $myroomgroup->TotalPrice;

            }


            $allfinal += $myroomgroup->TotalPrice;


            if($myfinalprice){

                $myallfinalprice += $myfinalprice;

            }

            if($myroomgroup->Insurance == 1){

                $insurancecount++;

                $insuranceamount += 10;

            }


            if($myroomgroup->Donation == 1){

                $donationcount++;

                $donationamount += $myroomgroup->Donation_amount;

            }
			
			

            // $myjourneyarray = array($mytransport->PickupLocation,$mytransport->DropOffLocation);

            // $myjourney = implode('to',$myjourneyarray);

            ?>



		@endif

	@endforeach
	
	<?php */ ?>


	<div class="container-fluid">
        <div class="row colorbox-group-widget ">
            
                
                    
                        
                            
                            
                        
                    
                
            
            
                
                    
                        
                            
                            
                        
                    
                
            
            <div class="col-lg-4 col-md-6 col-sm-6 info-color-box dynamic_boxes">
                    <div class="white-box">
                        <div class="media bg-danger">
                            <div class="media-body">
                            <h3 class="info-count">$<?php echo number_format($refundRequest??0, 2); ?> <span class="pull-right"><i class="mdi mdi-medical-bag"></i></span></h3>
                                <p class="info-text font-12">Refunds Requested</p>
								<!--<p class="info-ot font-15">Pending<span class="label label-rounded">0</span></p>-->
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-lg-4 col-md-6 col-sm-6 info-color-box dynamic_boxes">
                    <div class="white-box">
                        <div class="media bg-warning">
                            <div class="media-body">
                            <h3 class="info-count">$<?php echo number_format($issuedRefund??0, 2); ?> <span class="pull-right"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span></h3>
                                <p class="info-text font-12">Refunds Issued</p>
								<!--<p class="info-ot font-15">Limit<span class="label label-rounded">0</span></p>-->
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-lg-4 col-md-6 col-sm-6 info-color-box dynamic_boxes">
                    <div class="white-box">
                        <div class="media bg-primary">
                            <div class="media-body">
                            <h3 class="info-count">$<?php echo number_format($CancelledRefund??0, 2); ?> <span class="pull-right"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span></h3>
                                <p class="info-text font-12">Refunds Denied</p>
                                <!--<p class="info-ot font-15">Limit<span class="label label-rounded">0</span></p>-->
                            </div>
                        </div>
                    </div>
                </div>
        </div>

	</div>
	<div class="container-fluid">
		<!-- .row -->
		<div class="row">
			<div class="col-sm-12">

				<div class="white-box sales_chart_border">

					<h3 class="box-title pull-left">Sales - Refund Requests</h3>
                    <div class="pull-right">
                        <form method="post" action="<?php echo e(route('search_refund_request_by_date')); ?>" class="form-inline" role="form">
                            <?php echo csrf_field(); ?>
                                <div class="row form_custom">
                                    <div class="col-md-4 offset-md-2">
                            <div class="form-group">
                                <label for="date_from">Date from</label>
                                            <input type="date" class="form-control input-lg input-search" id="date_from" name="date_from">
                            </div>
                                    </div>
                                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="date_to">Date to</label>
                                            <input type="date" class="form-control input-lg input-search" id="date_to" name="date_to">
                            </div>
                                    </div>
                                    <div class="col-md-2">
                            <button type="submit" id="submit" class="btn btn-info">Filter</button>
                                    <a href="<?php echo e(url('allrefundrequests')); ?>">Reset</a>
                                    </div>
                                </div>



                        </form>
                    </div>
					<div class="clearfix"></div>
					<hr>
					<div class="table-responsive">
						<!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
					</div>
					<section class="cart_s1">
						<div class="container">
							<table id="refundrequest" class="table table-hover table-condensed">
								<thead>
									<tr>
                                    <th>S.No</th>
                                    <th>Recipt No</th>
                                    <th>Refund Requested On</th>
                                    <th>Product</th>
                                    
                                    <th>Customer</th>
                                    <th>Service Provider</th>
                                    <th>Order Placed On</th>
                                    <th>Cust Paid</th>
                                    <th>SP Earning</th>
                                    <th>App Fee</th>
                                    <th>Donation</th>
                                    
                                    <th>Payment Status</th>
                                    <th>Booking Status</th>
                                    <th>Customer Notes</th>
                                    <th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php $a = 1; ?>

									<?php if(isset($customerrefundrequests)): ?>
										<?php $__currentLoopData = $customerrefundrequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mybooking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<tr>
													<td><?php echo e($a++); ?></td>
													<td data-th="receipt_no" class="receipt_no"><p><?php echo e($mybooking['reciptno']); ?></p></td>
                                            <td data-th="refund_requested_on" class="refund_requested_on text-center"><p><?php if(empty($mybooking['request_refund_date'])): ?> - <?php else: ?> <?php echo e(\Carbon\Carbon::parse( $mybooking['request_refund_date']??'' )->toFormattedDateString()); ?> <?php endif; ?></p></td>
                                            <td data-th="product_name" class="product_name"><p><?php echo e($mybooking['name']??'-'); ?></p></td>
                                            
                                            <td data-th="customer" class="customer"><?php echo e($mybooking['customer']??'-'); ?></td>
                                            <td data-th="service_provider" class="service_provider"><?php echo e($mybooking['service_provider']??'-'); ?></td>
                                            <td data-th="order_placed_on" class="order_placed_on"><p><?php echo e(\Carbon\Carbon::parse( $mybooking['created_at']??'' )->toFormattedDateString()); ?></p></td>
                                            <td data-th="customer_paid" class="customer_paid"><p>$ <?php echo number_format($mybooking['price']??'-', 2); ?></p></td>

                                            <td data-th="sp_earning" class="sp_earning">$ <?php echo number_format((($mybooking['price']-($mybooking['insurance']*10+$mybooking['donation_amount']))*0.8)??'-', 2); ?></td>
                                            <td data-th="app_fee" class="app_fee">$ <?php echo number_format((($mybooking['price']-($mybooking['insurance']*10+$mybooking['donation_amount']))*0.2)??'-', 2); ?></td>
                                            <td data-th="donation" class="donation">$ <?php echo number_format($mybooking['donation_amount']??'-', 2); ?></td>
                                            
                                            <td data-th="payment_status" class="payment_status"><?php if($mybooking['paymentstatus'] == "PAID"): ?> <p> Received </p> <?php else: ?> <p> Not Received </p> <?php endif; ?></td>
                                            <td data-th="booking_status" class="booking_status"><p><?php echo e($mybooking['bookingstatus']??'-'); ?></p></td>
                                            <td data-th="customer_notes" class="customer_notes"><p><?php echo e($mybooking['request_refund']??'-'); ?></p></td>
                                            <td class="text-center">
														<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-'.str_slug('Search'))): ?>
														<a href="<?php echo e($mybooking['route']); ?>"
														   title="Order Details">
															<button class="btn btn-primary btn-sm">
																<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Order Details
															</button>
														</a>
                                                        <?php endif; ?>
														<?php if(!$mybooking['request_refund'] == ''): ?>
                                                            <?php if($mybooking['request_refund'] != '' &&  $mybooking['request_refund_reply'] == ''): ?>
                                                        <br><a class="refund_request" value="<?php echo e($mybooking['reciptno']); ?>" attr="<?php echo e($mybooking['request_refund']??''); ?>" category_id="<?php echo e($mybooking['category_id']??''); ?>">Refund Requested</a>
																
                                                            <?php elseif(isset($mybooking['request_refund']) &&  $mybooking['request_refund_reply']== 'REFUNDED'): ?>
                                                                <p style="color:green;" >
                                                                    Refund Issued
                                                                </p>
                                                            <?php elseif(isset($mybooking['request_refund']) &&  $mybooking['request_refund_reply'] == 'CANCELLED'): ?>
                                                                <p style="color:red" >
                                                            
                                                            Refund Denied
                                                                </p>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
													</td>
													
													
													
												</tr>

										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>
								</tbody>
							</table>
						</div>
                        <!-- Modal -->
                        <div class="modal fade" id="refund_request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                            
                                            
                                            
                                            
                                            
                                            
                                        
                                        <h5 class="modal-title" id="exampleModalLongTitle">Customer Refund Request</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="refund_request_id" id="refund_request_id">
                                        <input type="hidden" name="refund_request_category_id" id="refund_request_category_id">
                                        <p name="request_refund_by_customer" id="request_refund_by_customer"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-primary" id="accept_refund" onclick="acceptrefundcomment()">Approve Refund</a>
                                        <a type="button" class="btn btn-danger" id="cancel_refund" onclick="cancelrefund()">Deny Refund</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="cancel_refund_request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Reason of Cancelation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="refund_request_id_cancel" id="refund_request_id_cancel" >
                                        <input type="hidden" name="refund_request_cancel_category_id" id="refund_request_cancel_category_id">
                                        <input type="hidden" name="refund_request_reply" id="refund_request_reply">
                                        <textarea class="form-control" rows="4" name="refund_request_comments" id="refund_request_comments"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-danger" id="cancel_refund" onclick="cancelrequest()">Submit</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="accept_refund_request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Write Comments</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea class="form-control" rows="4" name="refund_request_accept_comments" id="refund_request_accept_comments"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-danger" id="cancel_refund" onclick="acceptrefund()">Submit</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
					
				</div>

			</div>

		</div>

		<!-- ===== Right-Sidebar ===== -->

		<?php echo $__env->make('layouts.partials.right-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	</div>

<?php $__env->stopSection(); ?>



<?php $__env->startPush('js'); ?>



<script>

    $(document).ready(function() {
        var table = $('#refundrequest').DataTable({
//            aLengthMenu: [
//                    [15,25, 50,100,500, -1],
//                [15,25, 50,100,500,"All"]
//            ],
//            iDisplayLength:100,
//            stateSave: true,
//            order: [0, 'asc']

        });

    });
    function acceptstatus(id, status, value) {
        console.log(value);
        swal({
            title: "Are you sure?",
            text: "Do you really want to change the status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
            if (willDelete) {

                $.get('<?php echo e(URL::to("hotels_reservation_status")); ?>/'+id+'/'+status+'/'+value,function(data){
                    window.location.reload();
                });
                swal("Your user status has been updated!", {
                    icon: "success",

                });
            }else {
                swal("Your user status has not changed!");
    }
    });
    }
    function rejectstatus(id, status) {
        swal("Write something here:", {
            content: "input",
        })
            .then((value) => {
            if (value) {
                $.get('<?php echo e(URL::to("hotels_reservation_status")); ?>/'+id+'/'+status+'/'+value,function(data){
                    window.location.reload();
                });
                swal("Your user status has been updated!", {
                    icon: "success",

                });
            } else {
                swal("Your user status has not changed!");
    }
    });
    }

    function paymentstatus(id, status) {
        // console.log(id);
        swal({
            title: "Are you sure?",
            text: "Do you really want to change the Payment status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
            if (willDelete) {

                $.get('<?php echo e(URL::to("room_mypayment_status")); ?>/'+id+'/'+status,function(data){
                    window.location.reload();
//                    $('#reject_reservation').hide();
//                    $('#reject_reservation').css('display', 'none');
//                    $('#accept_reservation').hide();
//                    $('#accept_reservation').css('display', 'none');
                });
                swal("Your Payment status has been updated!", {
                    icon: "success",
                });
            } else {
                swal("Your Payment status has not changed!");
    }
    });
    }
	
	
        
        
        
        
        
        
        
            
            
            
            
            
        
                
            

                
                    
                    
                
                
                    

                
            
                
    
    
    
    
        
        
        
        
        
        

        
            
            
        
        
            

        

    

    
        
    

    //Request Refund
    $(".refund_request").click(function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        var request_refund = $(this).attr('attr');
        var category_id = $(this).attr('category_id');
        var product_name = $(this).closest("tr").find(".product_name").text();
        var receipt_no = $(this).closest("tr").find(".receipt_no").text();
        $('#name_modal').text(product_name);
        $('#recipt_modal').text(receipt_no);
        $('#request_refund_by_customer').text(request_refund);
        $('#refund_request_category_id').val(category_id);
        $('#refund_request_id').val(id);
        $('#refund_request_id_cancel').val(id);
        $('#refund_request_cancel_category_id').val(category_id);
        $('#refund_request_modal').modal('show');
    });

    function acceptrefund() {
        var receipt_num = $('#refund_request_id').val();
        var value = $('#refund_request_accept_comments').val();
        var status = 'REFUNDED';
        var category_id = $('#refund_request_cancel_category_id').val();
        $.get('<?php echo e(URL::to("request_refund_reply")); ?>/'+receipt_num+'/'+status+'/'+value+'/'+category_id,function(data){
            console.log(data);
            window.location.reload();
        });
        swal("Your user status has been updated!", {
            icon: "success",

        });
    }

    function cancelrequest() {
        var receipt_num = $('#refund_request_id_cancel').val();
            var status = 'CANCELLED';
        var value = $('#refund_request_comments').val();
        var category_id = $('#refund_request_cancel_category_id').val();
//        console.log(id);
//        console.log(status);
//        console.log(value);
//        console.log(category_id);
        $.get('<?php echo e(URL::to("request_refund_reply")); ?>/'+receipt_num+'/'+status+'/'+value+'/'+category_id,function(data){
            window.location.reload();
            console.log(data);
        });
        swal("Your user status has been updated!", {
            icon: "success",

        });

    };

    function cancelrefund() {
        $('#cancel_refund_request_modal').modal('show');
    }
    function acceptrefundcomment() {
        $('#accept_refund_request_modal').modal('show');
    }

</script>

<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/superadminviews/refundrequest.blade.php ENDPATH**/ ?>