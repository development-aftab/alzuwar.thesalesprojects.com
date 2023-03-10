<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?><style>p.open {}p.open+#unpaymenttoggle {    display: block;}p.open+#paidtoggle {    display: block;}</style>
<?php

$guideVendorName =  App\User::where('id',$guidereserves->getGuideOrderssupadmin->GuidesCreatedBy)->first();
$guideVendorProfile =  App\Profile::where('user_id',$guidereserves->getGuideOrderssupadmin->GuidesCreatedBy)->first();
// dd($transportVendorProfile);

?>
<div class="container-fluid">
    <!-- /.row -->
    <div class="row">
        <div class="col-md-12">
            <div class="white-box printableArea re_white">
                <div class="pull-left">
                    <address>
                        <h1><img src="<?php echo e(asset('website')); ?>/img/alziyara_white_background_logo.png" alt="Logo" style="height: 120px;"><b style="margin-left: 20px"><a>ALZUWAR.COM</a></b></h1>
                    </address>
                </div>
                <div class="pull-right text-right">
                    <address>
                        <p>Service By: <b> <?php echo e($guidereserves->getGuideDetails->getguideUser->name??'Not Available'); ?></b></p>
                        <p>Phone: <b> <?php echo e($guidereserves->getGuideDetails->getguideUser->profile->phone??'Not Available'); ?></b></p>
                        <p>Booking No: <b> <?php echo e($guidereserves->ReceiptNum??''); ?></b></p>
                        <p>Booked On: <b> <?php echo e(\Carbon\Carbon::parse(  $guidereserves->created_at??'' )->toDayDateTimeString()); ?></b></p>
                    </address>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="pull-left">
                            <address>
                                <h3><b>Order Receipt</b></h3>
                                
                                <p class="m-l-5">Customer: <b> <?php echo e($guidereserves->getGuidesUserDetail->name??''); ?></b>
                                <p class="m-l-5">Email: <b> <?php echo e($guidereserves->getGuidesUserDetail->email??''); ?></b>
                                <p class="m-l-5">Phone: <b> <?php echo e($guidereserves->getGuidesUserDetail->profile->phone??''); ?></b>
                                <p class="m-l-5">From: <b> <?php echo e(\Carbon\Carbon::parse( $guidereserves->getGuideDetails->guide_startdate??'' )->toFormattedDateString()); ?></b>
                                <p class="m-l-5">To: <b> <?php echo e(\Carbon\Carbon::parse( $guidereserves->getGuideDetails->guide_enddate??'' )->toFormattedDateString()); ?></b>
                                <?php if($message == 0): ?>
                                    <p class="m-l-5">Duration: <b> <?php echo e(1??''); ?> Day</b> | Visitors: <b><?php echo e($adults_guide??''); ?> Adults,</b> <b><?php echo e($childs_guide??''); ?> Children, </b> <b><?php echo e($infants_guide??''); ?> Infants</b></p>
                                <?php else: ?>
                                    <p class="m-l-5">Duration: <b> <?php echo e($message+1??''); ?> Days</b> | Visitors: <b><?php echo e($adults_guide??0); ?> Adults,</b> <b><?php echo e($childs_guide??0); ?> Children, </b> <b><?php echo e($infants_guide??0); ?> Infants</b></p>
                                <?php endif; ?>
                                
                            </address>
                        </div>
                    </div>
                    
                        
                            
                        
                        
                            
                                
                            
                                
                            
                        
                        
                            
                                
                            
                                
                            
                                
                            
                                
                            
                        

                    
                    <?php



                    if(($guidereserves->Insurance == 1) && ($guidereserves->Donation == 0)){

                        $finalprice = 0;

                        $finalprice = $guidereserves->TotalPrice - 10;

                    }elseif(($guidereserves->Donation == 1) && ($guidereserves->Insurance == 0)){

                        $finalprice = 0;

                        $finalprice = $guidereserves->TotalPrice - $guidereserves->Donation_amount;

                    }elseif(($guidereserves->Insurance == 1) && ($guidereserves->Insurance == 1) ){

                        $finalprice = 0;

                        $finalprice = $guidereserves->TotalPrice - $guidereserves->Donation_amount - 10;

                    }else{

                        $finalprice = 0;

                        $finalprice = $guidereserves->TotalPrice;

                    }


                    ?>

                    <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both;">
                            <table class="table table-hover re_table">
                                <thead>
                                <tr>
                                    <th class="text-center">Item</th>
                                    <th class="text-center">Tour Description</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Subtotal</th>

                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center"><a href="<?php echo e(url('guide-details/'.$guidereserves->getGuideDetails->GuidesID .'/'.$guidereserves->getGuideDetails->GuidesName)); ?>" target="_blank"><?php echo e($guidereserves->getGuideDetails->GuidesName??''); ?></a>  -  <?php echo e($guidereserves->getGuideDetails->Languages??''); ?> Speaking guide</td>
                                    <td><div class="content"><?php echo $guidereserves->getGuideDetails->GuidesDesc??""; ?></div></td>
                                    <td class="text-right">$ <?php echo e(number_format($guidereserves->getGuideDetails->PricePerDay??'0',2)); ?></td>
                                    <?php $qty = \Carbon\Carbon::parse( $guidereserves->reservation_start_date )->diffInDays( $guidereserves->reservation_end_date )?>
                                    <td class="text-right"><?php echo e($qty); ?></td>
                                    <td class="text-right"> $ <?php echo e(number_format($guidereserves->getGuideDetails->PricePerDay*$qty,2)); ?></td>

                                </tr>

                                <?php if($guidereserves->Donation >= 1): ?>
                                    <tr>
                                        <td>Donation to <?php echo e($guidereserves->donation_shrine_name??''); ?></td>
                                        <td>Guide donations</td>
                                        <td class="text-right"> $ <?php echo e(number_format($guidereserves->Donation_amount??'',2)); ?></td>
                                        <td class="text-center">-</td>
                                        <td class="text-right">$ <?php echo e(number_format($guidereserves->Donation_amount??'',2)); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if($guidereserves->Insurance >=1): ?>
                                    <tr>
                                        <td>Medical Insurance for <b><?php echo e($guidereserves->qty??''); ?> visitors</b></td>
                                        <td> Medical Insurance</td>
                                        <td class="text-right"> $ 10.00</td>
                                        <td class="text-center">-</td>
                                        <td class="text-right">$ 10.00</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="pull-right m-t-30 text-right">
                            <?php if($guidereserves->Insurance >=1): ?>
                                <p><b>Subtotal : </b> $ <?php echo e(number_format(($guidereserves->getGuideDetails->PricePerDay*$qty)+(10)+$guidereserves->Donation_amount,2)); ?></p>
                                <p><b> Tax : </b>$ 25.00</p>
                                <hr>
                                <p><b>Total : </b>$ <?php echo e(number_format(($guidereserves->getGuideDetails->PricePerDay*$qty)+(10)+$guidereserves->Donation_amount+25,2)); ?></p>
                            <?php else: ?>
                                <p><b>Subtotal : </b>$ <?php echo e(number_format(($guidereserves->getGuideDetails->PricePerDay*$qty)+$guidereserves->Donation_amount,2)); ?></p>
                                <p><b> Tax : </b>$ 25.00</p>
                                <hr>
                                <p><b>Total : </b>$ <?php echo e(number_format(($guidereserves->getGuideDetails->PricePerDay*$qty)+$guidereserves->Donation_amount+25,2)); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="text-left">
                            <p><b>Special Request - </b><span><?php echo e($guidereserves->NotesByCustomer??''); ?></span></p>
                            <p><b>Confirmation Policy –  </b><span>This booking is subjected to confirmation from guide. Typically it takes 1-2 business days for confirmation.</span></p>
                            <b>Cancelations, No Show Policy :</b>
                            <p>•    When your travel plans change, your reservation can too.</p>
                            <p>•	There are no fees to cancel reservations. However it has to be done 10 days before service day of the receipt - <b>(<?php echo e(\Carbon\Carbon::parse( $reservationStartDate??'')->toFormattedDateString()); ?>)</b>. Contact Alzuwar.com team for any assistance.</p>
                            <p>•    We recommend customers and service provider contact each other ahead of time to confirm plans.</p>
                            <p>•	No Shows – If service provider <b>(<?php echo e($guidereserves->getGuideDetails->GuidesName??""); ?>)</b> did not show up or honor the bookings then customer <b>(<?php echo e($guidereserves->getGuidesUserDetail->name??''); ?>)</b> should contact alzuwar.com team immediately to provide another alternative service provider.</p>
                            <p>•	No Shows – If customer <b>(<?php echo e($guidereserves->getGuidesUserDetail->name??''); ?>)</b> did not show up at place of contact then service provider <b>(<?php echo e($guidereserves->getGuideDetails->GuidesName??""); ?>)</b>should call alzuwar.com team immediately to notify.</p>
                            <b>House Rules: </b>
                            <p><?php echo $guidereserves->getGuideDetails->HouseRules??''; ?></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
<script src="<?php echo e(asset('js/jquery.PrintArea.js')); ?>" type="text/JavaScript"></script>
<script>
    $(function() {
        $("#print").on("click", function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };
            $("div.printableArea").printArea(options);
        });
    });

    function acceptstatus(id, status, value) {
        swal({
            title: "Are you sure?",
            text: "Do you really want to change the status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
                .then((willDelete) => {
            if (willDelete) {
                $.get('<?php echo e(URL::to("guide_reservation_status")); ?>/'+id+'/'+status+'/'+value,function(data){
                    window.location.reload();
                    $('#reject_reservation').hide();
                    $('#reject_reservation').css('display', 'none');
                    $('#accept_reservation').hide();
                    $('#accept_reservation').css('display', 'none');
                });
                swal("Your user status has been updated!", {
                    icon: "success",

                });
            } else {
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
                $.get('<?php echo e(URL::to("guide_reservation_status")); ?>/'+id+'/'+status+'/'+value,function(data){
                    window.location.reload();
                    $('#reject_reservation').hide();
                    $('#reject_reservation').css('display', 'none');
                    $('#accept_reservation').hide();
                    $('#accept_reservation').css('display', 'none');
                });
                swal("Your user status has been updated!", {
                    icon: "success",

                });
            } else {
                swal("Your user status has not changed!");
    }
    });
    }		function paymentstatus(id, status) {
        swal("Write something here:", {
            content: "input",
        })
                .then((value) => {
            if (value) {
                $.get('<?php echo e(URL::to("guide_mypayment_status")); ?>/'+id+'/'+status+'/'+value,function(data){
                    window.location.reload();
                });
                swal("Your Payment status has been updated!", {
                    icon: "success",
                });
            } else {
                swal("Your Payment status has not changed!");
    }
    });
    }

</script>
<script>
    $(document).ready(function(){
        length = 200;
        cHtml = $(".content").html();
        cText = $(".content").text().substr(0, length).trim();
        $(".content").addClass("compressed").html(cText + "... <a href='#' class='exp'>More</a>");
        window.handler = function()
        {
            $('.exp').click(function(){
                if ($(".content").hasClass("compressed"))
                {
                    $(".content").html(cHtml + "<a href='#' class='exp'>Less</a>");
                    $(".content").removeClass("compressed");
                    handler();
                    return false;
                }
                else
                {
                    $(".content").html(cText + "... <a href='#' class='exp'>More</a>");
                    $(".content").addClass("compressed");
                    handler();
                    return false;
                }
            });
        }
        handler();
    });
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('website.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/superadminviews/customerguideinvoice.blade.php ENDPATH**/ ?>