<?php $__env->startPush('css'); ?>
<link href="<?php echo e(asset('css/customCss.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('css/responsive.css')); ?>" rel="stylesheet" />
<style>p.open {}p.open+#unpaymenttoggle {    display: block;}p.open+#paidtoggle {    display: block;}</style>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
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
                        <p class="m-l-5">Service By: <b> <?php echo e($transportreserves->getTransportOrderssupadmin->getTransportuser->name??'Not Available'); ?></b>
                        <p>Phone: <b> <?php echo e($transportreserves->getTransportOrderssupadmin->getTransportuser->profile->phone??''); ?></b></p>
                        <p>Booking No: <b> <?php echo e($transportreserves->ReceiptNum??''); ?></b></p>
                        <p>Booked On: <b> <?php echo e(\Carbon\Carbon::parse( $transportreserves->created_at??'' )->toDayDateTimeString()); ?></b></p>
                    </address>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <address>
                                <h2 class="m-l-5">Order Receipt</h2>
                                
                                <p class="m-l-5">Customer: <b><?php echo e($transportreserves->getTransportUserDetail->name??''); ?></b>
                                <p class="m-l-5">Email: <b><?php echo e($transportreserves->getTransportUserDetail->email??''); ?></b>
                                <p class="m-l-5">Phone: <b><?php echo e($transportreserves->getTransportUserDetail->profile->phone??''); ?></b>
                                <p class="m-l-5">Pickup Date/Time: <b><?php echo e(\Carbon\Carbon::parse( $transportreserves->PickUpDateTime??'' )->toDayDateTimeString()); ?></b>
                                <p class="m-l-5">Pickup Location: <b><?php echo e($transportreserves->PickupLocation??''); ?></b>
                                <p class="m-l-5">Drop-off Location: <b><?php echo e($transportreserves->DropOffLocation??''); ?></b>
                                
                                    
                                </p>
                            </address>
                        </div>
                    </div>
                    
                        
                            
                        
                        
                            
                                
                                    
                                
                                    
                                
                            
                        
                        
                            
                                
                            
                                
                            
                                
                            
                                
                            
                        
                    
                    <?php



                    if(($transportreserves->Insurance == 1) && ($transportreserves->Donation == 0)){

                        $finalprice = 0;

                        $finalprice = $transportreserves->TotalPrice - 10;

                    }elseif(($transportreserves->Donation == 1) && ($transportreserves->Insurance == 0)){

                        $finalprice = 0;

                        $finalprice = $transportreserves->TotalPrice - $transportreserves->Donation_amount;

                    }elseif(($transportreserves->Insurance == 1) && ($transportreserves->Insurance == 1) ){

                        $finalprice = 0;

                        $finalprice = $transportreserves->TotalPrice - $transportreserves->Donation_amount - 10;

                    }else{

                        $finalprice = 0;

                        $finalprice = $transportreserves->TotalPrice;

                    }

                    $myjourneyarray = array($transportreserves->PickupLocation,$transportreserves->DropOffLocation);

                    $myjourney = implode('to',$myjourneyarray);

                    ?>

                    <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both;">
                            <table class="table table-hover re_table">
                                <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    
                                    
                                    
                                    
                                    
                                    
                                    <th class="text-right">Subtotal</th>

                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-left">
                                        Vehicle Type:<?php echo e($transportreserves->getTransportOrderssupadmin->getTransporttype->TransporatationTypeDesc??""); ?><br>
                                        Vehicle:<a href="<?php echo e(url('transportdetails/'.$transportreserves->getTransportOrderssupadmin->VehicleRouteID.'/'.$transportreserves->getTransportOrderssupadmin->NameofVehicle??'')); ?>" target="_blank"> <?php echo e($transportreserves->getTransportOrderssupadmin->NameofVehicle??''); ?></a><br>
                                        <i class="fa fa-chair"></i> <?php echo e($transportreserves->getTransportOrderssupadmin->getTransporttype->NumOfSeats??""); ?>  |
                                        <i class="fa fa-briefcase"></i> <?php echo e($transportreserves->getTransportOrderssupadmin->getTransporttype->LuggageCapacity??""); ?><br>
                                        Driver:<?php echo e($transportreserves->getTransportOrderssupadmin->DriverName??''); ?> |
                                        Plate:<?php echo e($transportreserves->getTransportOrderssupadmin->NumberPlate??''); ?>



                                    </td>
                                    <td class="text-left"><div class="content"><?php echo $transportreserves->getTransportOrderssupadmin->Description??''; ?></div></td>
                                    <?php if($transportreserves->triptype == 'oneway'): ?>

                                        <td class="text-left">$ <?php echo e(number_format($route->Price??0,2)); ?></td>
                                    <?php else: ?>
                                        <td class="text-left">$ <?php echo e(number_format($route->TwoWayPrice??0,2)); ?></td>
                                    <?php endif; ?>
                                    <td class="text-left"><?php echo e($transportreserves->noofdaysqty??""); ?></td>
                                    <?php if($transportreserves->triptype == 'oneway'): ?>
                                        <td class="text-right">$ <?php echo e(number_format($route->Price*$transportreserves->noofdaysqty,2)); ?></td>
                                    <?php else: ?>
                                        <td class="text-right">$ <?php echo e(number_format($route->TwoWayPrice*$transportreserves->noofdaysqty,2)); ?></td>
                                    <?php endif; ?>
                                </tr>
                                <?php if($transportreserves->Donation >= 1): ?>
                                    <tr>
                                        <td>Donation to <?php echo e($transportreserves->donation_shrine_name??''); ?> </td>
                                        <td>Hotel donations</td>
                                        <td class="text-right"> $ <?php echo e(number_format($transportreserves->Donation_amount??0,2)); ?></td>
                                        <td class="text-center">-</td>
                                        <td class="text-right">$ <?php echo e(number_format($transportreserves->Donation_amount??0,2)); ?></td>
                                    </tr>
                                <?php endif; ?>
                                <?php if($transportreserves->Insurance >=1): ?>
                                    <tr>
                                        <td>Medical Insurance for <b><?php echo e($transportreserves->noofdaysqty??''); ?> visitors</b></td>
                                        <td> Medical Insurance</td>
                                        <td class="text-right"> $ 10.00</td>
                                        <td class="text-center"><?php echo e($transportreserves->noofdaysqty??''); ?></td>
                                        <td class="text-right">$ <?php echo e(number_format($transportreserves->noofdaysqty*10,2)); ?></td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="pull-right m-t-30 text-right">
                            <?php if($transportreserves->Insurance >=1): ?>
                                <?php if($transportreserves->triptype == 'oneway'): ?>
                                    <p><b>Subtotal : </b>$ <?php echo e(number_format(($route->Price*$transportreserves->noofdaysqty)+($transportreserves->noofdaysqty*10)+$transportreserves->Donation_amount,2)); ?></p>
                                    <p><b> Tax : </b>$ 25.00</p>
                                    <hr>
                                    <p><b>Total : </b>$ <?php echo e(number_format(($route->Price*$transportreserves->noofdaysqty)+($transportreserves->noofdaysqty*10)+$transportreserves->Donation_amount+25,2)); ?></p>
                                <?php else: ?>
                                    <p><b>Subtotal : </b>$ <?php echo e(number_format(($route->TwoWayPrice*$transportreserves->noofdaysqty)+($transportreserves->noofdaysqty*10)+$transportreserves->Donation_amount,2)); ?></p>
                                    <p><b> Tax : </b>$ 25.00</p>
                                    <hr>
                                    <p><b>Total : </b>$ <?php echo e(number_format(($route->TwoWayPrice*$transportreserves->noofdaysqty)+($transportreserves->noofdaysqty*10)+$transportreserves->Donation_amount+25,2)); ?></p>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if($transportreserves->triptype == 'oneway'): ?>
                                    <p><b>Subtotal : </b>$ <?php echo e(number_format(($route->Price*$transportreserves->noofdaysqty)+$transportreserves->Donation_amount,2)); ?></p>
                                    <p><b> Tax : </b>$ 25.00</p>
                                    <hr>
                                    <p><b>Total : </b>$ <?php echo e(number_format(($route->Price*$transportreserves->noofdaysqty)+$transportreserves->Donation_amount+25,2)); ?></p>
                                <?php else: ?>
                                    <p><b>Subtotal : </b>$ <?php echo e(number_format(($route->TwoWayPrice*$transportreserves->noofdaysqty)+$transportreserves->Donation_amount,2)); ?></p>
                                    <p><b> Tax : </b>$ 25.00</p>
                                    <hr>
                                    <p><b>Total : </b>$ <?php echo e(number_format(($route->TwoWayPrice*$transportreserves->noofdaysqty)+$transportreserves->Donation_amount+25,2)); ?></p>

                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="text-left">
                        <p><b>Special Request - </b><span><?php echo e($transportreserves->NotesByCustomer??''); ?></span></p>
                        <p><b>Round Trip Policy –  </b><span>A driver is booked for 6 hours on round trips. If customer requires additional time they should negotiated the additional fare directly with the driver of vehicle.</span></p>
                        <p><b>Confirmation Policy –</b> This booking is subjected to confirmation from transportation provider. Typically it takes 1-2 business days for confirmation.</p>
                        <b>Cancelations, No Show Policy :</b>
                        <p>    •	When your travel plans change, your reservation can too.</p>
                        <p>    •	There are no fees to cancel reservations. However it has to be done 10 days before service day of the receipt - <b>(<?php echo e(\Carbon\Carbon::parse( $reservationStartDate??'')->toFormattedDateString()); ?>)</b>. Contact Alzuwar.com team for any assistance.</p>
                        <p>    •	We recommend customers and service provider contact each other ahead of time to confirm plans.</p>
                        <p>    •	No Shows – If service provider <b>(<?php echo e($transportreserves->getTransportOrderssupadmin->DriverName??''); ?>)</b>  did not show up or honor the bookings then customer (<b><?php echo e($transportreserves->getTransportUserDetail->name??''); ?></b>) should contact alzuwar.com team immediately to provide another alternative service provider.</p>
                        <p>    •	No Shows – If customer (<b><?php echo e($transportreserves->getTransportUserDetail->name??''); ?></b>) did not show up at place of contact then service provider (<b><?php echo e($transportreserves->getTransportOrderssupadmin->DriverName??''); ?></b>) should call alzuwar.com team immediately to notify.</p>
                        <b>House Rules: </b>
                        <p><?php echo $transportreserves->getcustomerorder->HouseRules??''; ?></p>
                    </div>

                    <div class="clearfix"></div>
                    <hr>
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

                $.get('<?php echo e(URL::to("transport_reservation_status")); ?>/'+id+'/'+status+'/'+value,function(data){
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
                $.get('<?php echo e(URL::to("transport_reservation_status")); ?>/'+id+'/'+status+'/'+value,function(data){
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
        swal("Write something here:", {
            content: "input",
        })
                .then((value) => {
            if (value) {
                $.get('<?php echo e(URL::to("transport_mypayment_status")); ?>/'+id+'/'+status+'/'+value,function(data){
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
<?php echo $__env->make('website.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/superadminviews/customertransportinvoice.blade.php ENDPATH**/ ?>