<?php $__env->startPush('css'); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<link href="<?php echo e(asset('css/customCss.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('css/responsive.css')); ?>" rel="stylesheet" />
<style>
    .modal-xl{
        width:80%;
    }
    @media(max-width:768px){
        .modal-xl{
        width:100%;
        }
        .table-responsive .table tbody .text-center:first-child{
            white-space: normal;
        }
        #guestpass{
            word-break: break-word;
            white-space: normal;
        }
    }
</style>
<!-- <link href="<?php echo e(asset('plugins/components/dashboard/css/customstyle.css')); ?>" rel="stylesheet" /> -->
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <style type="text/css">
/*        .fc-content{
            cursor: pointer !important;
        }
        .check-box-b {
        }
        .check-box-b input.calFilter {
            width: 18px;
            height: 15px!important;
        }
        ul.list-inline {
            float: none;
            position: relative;
            z-index: 0;
            display: block;
            width: 100% !important;
            margin: 0 !important;
            padding-bottom: 50px !important;
            margin-left: 30px !important;
        }

        .white-box {float: none;padding: 45px 0;}*/
    </style>
    <div class="container-fluid">
        <div class="row">
            <br>

            <div class="col-md-12">
                <div class="white-box sales_chart_border">
                    <div class="check-box-b">
                        <h3 class="box-title m-b-0">Bookings - Shrine Programs</h3>
                        <hr>
                        

							</div>
                    <?php echo $__env->make('website.calender-conditions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <?php echo $__env->make('layouts.partials.right-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel1">                                    <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                    </h4>
                </div>
                <form method="post" action="" id="availablity_modal_form">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="action_type" id="action_type">
                    <input type="hidden" name="guestpass_name_hidden" id="guestpass_name_hidden" value="">
                    <input type="hidden" name="guestpass_id" id="guestpass_id" value="">


                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="white-box printableArea">
                                    <div class="pull-left">
                                    <p><img src="<?php echo e(asset('website')); ?>/img/alziyara_white_background_logo.png" alt="Logo" style="height: 120px;"><b style="margin-left: 20px"><a>ALZUWAR.COM</a></b></p>
                                    </div>
                                        <div class="pull-right text-right">
                                            <p>Guest Pass Name: <b><span class="guestpass_name" id="guestpass_name" name="guestpass_name"></span></b></p>
                                        <p class="m-l-30">Service By: <b><span class="service_provider_name" id="service_provider_name" name="service_provider_name"></span></b></p>
                                        <p class="m-l-30">Phone:<b><span id="phone_num"></span></b></p>
                                        <p class="m-l-30">Booking No: <b><span class="booking_no" id="booking_no" name="booking_no"></span></b></p>
                                        <p class="m-l-30">Booked On: <b><span class="booked_on" id="booked_on" name="booked_on"> </span></b></p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pull-left">
                                                <h3> &nbsp;<b >Order Receipt</b></h3>
                                                <p>Customer: <b><span class="name" id="name" name="name"></span></b></p>
                                                <p>Email: <b><span class="email" id="email" name="email"></span></b></p>
                                                <p>Phone: <b><span class="phone" id="phone" name="phone"></span></b></p>
                                                <p>Guest Pass Date: <b><span class="guestpass_date" id="guestpass_date" name="guestpass_date"></span></b></p>
                                                <p>Participants: <b><span class="number_of_tickets" id="number_of_tickets" name="number_of_tickets"></span></b> | Duration: <b><span class="day" id="day" name="day"></span></b></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 text-right col-offset-2">
                                                <p><b>Payment Mode:</b><span  id="payment_mode" class="payment_mode" name="payment_mode"> </span> (charged by AlZuwar.com)</p>
                                            </div>
                                            <div class="col-md-4 col-sm-12 text-center col-offset-2">
                                                <p><b>Payment Status: </b><span  id="payment_status" name="payment_status" class="payment_status"></span><p>
                                            </div>

                                            <div class="col-md-4 col-sm-12 text-left col-offset-2">
                                                <p><b>Booking Status:</b><span  id="booking_status" class="booking_status" name="booking_status"> </span></p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="table-responsive m-t-40" style="clear: both;">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Item</th>
                                                        <th class="text-center">Description</th>
                                                        <th class="text-center">Price</th>
                                                        <th class="text-center">Quantity</th>
                                                        <th class="text-center">Subtototal</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td class="text-center">  <span style="cursor:pointer; color: #1DA1F2" id="guestpass"></span></td>
                                                        <td class="text-center">  <span id="guestpass_description"></span></td>
                                                        <td class="text-center"> $ <span id="price_per_guestpass"></span></td>
                                                        <td class="text-center"> <span id="guestpass_quantity"></span></td>
                                                        <td class="text-center"> $ <span id="price"></span></td>
                                                    </tr>
                                                    <tr id="donation">
                                                        <td class="text-center">Doantion to <span id="donation_name"></span></td>
                                                        <td class="text-center">Package Donations<span id="donation_description"></span></td>
                                                        <td class="text-center"> $ <span id="donation_price"></span></td>
                                                        <td class="text-center"><span id="donation_quantity">-</span></td>
                                                        <td class="text-center"> $ <span id="donation_price_final"></span></td>
                                                    </tr>
                                                    <tr id="insurance">
                                                        <td class="text-center">Medical Insurance for <span id="insurance_name"></span> visitors</td>
                                                        <td class="text-center">Medical insurance <span id="insurance_description"></span></td>
                                                        <td class="text-center"> $ 10.00<span id="insurance_price"></span></td>
                                                        
                                                        <td class="text-center">-</td>
                                                        
                                                        <td class="text-center"> $ 10.00</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <p class="text-right"><b>SubTotal: </b>$ <span id="sub_total"> </span></p>
                                                <hr>
                                                <p class="text-right"><b>Tax:</b> $ <span id="tax">25.00</span></p>
                                                <hr>
                                                <p class="text-right"><b>Total:</b> $ <span id="total"> </span></p>
                                                <div class="text-left">
                                                    <p><b>Special Request - </b><span id="notes_by_customer"></span></p>
                                                    <p><b>Confirmation Policy –  </b><span>This booking is subjected to confirmation from guide. Typically it takes 1-2 business days for confirmation.</span></p>
                                                    <b>Cancelations, No Show Policy :</b>
                                                    <p>•    When your travel plans change, your reservation can too.</p>
                                                    <p>•	There are no fees to cancel reservations. However it has to be done 10 days before service day of the receipt - <b>(<span id="guestpass_start_date_minus"></span>)</b>. Contact Alzuwar.com team for any assistance.</p>
                                                    <p>•    We recommend customers and service provider contact each other ahead of time to confirm plans.</p>
                                                    <p>•	No Shows – If service provider <b>(<span id="service_provider_name_policy"></span>)</b> did not show up or honor the bookings then customer <b>(<span id="name_policy"></span>)</b> should contact alzuwar.com team immediately to provide another alternative service provider.</p>
                                                    <p>•	No Shows – If customer <b>(<span id="name_next"></span>)</b>  did not show up at place of contact then service provider <b>(<span id="service_provider_name_next"></span>)</b> should call alzuwar.com team immediately to notify.</p>
                                                    <b>House Rules: </b>
                                                    <p id="house_rules"></p>
                                                </div>
                                            </div>

                                            </div>
                                        </div>
                                    </div>
                                <div class="modal-footer">
                                    <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>

                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <!--<button type="submit" class="btn btn-primary" id="save_record">Save</button>
                                    <button type="button" class="btn btn-danger" style="display: none;" id="delete_record">Delete</button>
                                    <button type="submit" class="btn btn-info" style="display: none;" id="update_record">Update</button>-->
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

    <script src="<?php echo e(asset('plugins/components/calendar/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/components/moment/moment.js')); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">

        $('#calendar').fullCalendar({
            header: {
                right: 'month,listYear,prev,next',
            },
            dayClick: function(date, jsEvent, view) {
                $('#availablity_modal_form').trigger("reset");
                $('#save_record').show();
                $('#delete_record').hide();
                $('#update_record').hide();
                $('#selected_date').val(date.format());
                $('#exampleModal').modal('show');
                $('#modalTitle').text(date.format());
                $('#action_type').val('new_record');
                $('#fullCalModal').modal('show');
            },
            events: [

                <?php $__currentLoopData = $guestpassbooking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ourguestpassbooking): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   {	
						<?php if(( $ourguestpassbooking->BookingStatus == 'CONFIRMED' ) && ($ourguestpassbooking->PaymentStatus == 'PAID' ) && ($ourguestpassbooking->request_refund_reply == '' ) ): ?>
						//PAID //CONFIRMED // request_refund == null Green color
                        title:   	'<?php echo e($ourguestpassbooking->ReceiptNum??"Not Available"); ?>/<?php echo e($ourguestpassbooking->getGuestPassOrdersbyuser->name??''); ?>',
                        start:   	'<?php echo e($ourguestpassbooking->ReservationForDate); ?>',
                        id:      	'<?php echo e($ourguestpassbooking->ReservationID??""); ?>',
                        comment: 	'<?php echo e($ourguestpassbooking->SPComments); ?>',
                        color: 		'#2ecc71',
                        textColor: 	'white',
						
						
						
							
						
                        
                        
                        
                        
                        
						<?php elseif(( $ourguestpassbooking->BookingStatus == 'PENDING')  && ($ourguestpassbooking->request_refund_reply == '')): ?>
						//UNPAID //PENDING // request_refund == null Orange color
							
						title:   	'<?php echo e($ourguestpassbooking->ReceiptNum??"Not Available"); ?>/<?php echo e($ourguestpassbooking->getGuestPassOrdersbyuser->name??''); ?>',
                        start:   	'<?php echo e($ourguestpassbooking->ReservationForDate); ?>',
                        id:      	'<?php echo e($ourguestpassbooking->ReservationID??""); ?>',
                        comment: 	'<?php echo e($ourguestpassbooking->SPComments); ?>',
                        color: 		'#ffa500',
                        textColor: 	'black',
						<?php elseif((( $ourguestpassbooking->BookingStatus == 'CANCELLED') || ($ourguestpassbooking->PaymentStatus == 'UNPAID')) && ($ourguestpassbooking->request_refund_reply == '')): ?>
						//UNPAID //CANCELLED // request_refund == null Red color
							
						title:   	'<?php echo e($ourguestpassbooking->ReceiptNum??"Not Available"); ?>/<?php echo e($ourguestpassbooking->getGuestPassOrdersbyuser->name??''); ?>',
                        start:   	'<?php echo e($ourguestpassbooking->ReservationForDate); ?>',
                        id:      	'<?php echo e($ourguestpassbooking->ReservationID??""); ?>',
                        comment: 	'<?php echo e($ourguestpassbooking->SPComments); ?>',
                        color: 		'#ff0000',
                        textColor: 	'white',
						
						
						
							
						
                        
                        
                        
                        
                        
						
						
						
						
							
						
                        
                        
                        
                        
                        
						
						
						
						
							
						
                        
                        
                        
                        
                        
						
						
						
						
						
							
						
                        
                        
                        
                        
                        
						
						
						
						
							
						
                        
                        
                        
                        
                        
						
						
						
						
							
						
                        
                        
                        
                        
                        
						
						
						
						
							
						
                        
                        
                        
                        
                        
						
						
							
						
                        
                        
                        
                        
                        
						<?php endif; ?>
						
                    },
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            ]   // an option!
            ,eventClick: function(calEvent, jsEvent, view) {
                var id          = calEvent['id'];
                var yacht_id    = calEvent['yacht_id'];
                var date        = calEvent['start'];
                var title        = calEvent['title'];
                var subject        = calEvent['subject'];
                var option      = calEvent['option'];
                var comment     = calEvent['comment'];
                $('#id').val(id);
                $('#selected_date').val(date.format());
                $("#yacht_id option[value='"+yacht_id+"']").attr("selected", true);
                $("#yacht_option option[value='"+option+"']").attr("selected", true);
                $("#title").val(title);
                $("#subject").val(subject);
                $("#comment").val(comment);
                $('#action_type').val('update_record');
                $('#save_record').hide();
                $('#delete_record').show();
                $('#update_record').show();
                $('#exampleModal').modal('show');
                $('#fullCalModal').modal('show');
            },eventDidMount: function(info) {

            },eventRender: function(calEvent, element, view) {
                element.popover({
                    // title: eventObj.name,
                    title: " View Details",
                    trigger: 'hover',
                    placement: 'top',
                    container: 'body'
                });
                return ['all', calEvent.yacht_id].indexOf($('input[name="yacht_name"]:checked').val()) >= 0;
            },viewRender: function(view, element) {
                $('.fc-left')[0].children[0].innerText = view.title.replace(new RegExp("undefined", 'g'), ""); ;
            },
        });

        $('#delete_record').click(function(e){
                var id = $('#id').val();
                $.ajax({
                    url: '',
                    type: 'POST',
                    data: { 'id':id,_token: "<?php echo e(csrf_token()); ?>"},
                    dataType: 'JSON',
                    success: function (data) {
                        if(data.result=='success'){
                            window.location.href = "";
                            swal.fire("Success", "Event deleted Successfully.", "info");
                        }else{
                            swal.fire("Sorry", "Unable unable to delete record, try again.", "info");
                        }//end if else.
                    }//end
                });


        });
        $('.fc-day').attr('title',"Click Here To Add Availablity.");
        $('input:radio.calFilter').on('change', function() {
            $('#calendar').fullCalendar('rerenderEvents');
            if ($('input[name="yacht_name"]:checked').val() == "all") {
                $('#calendar').fullCalendar( 'changeView', 'month');
            }else{
                $('#calendar').fullCalendar( 'changeView', 'listYear');
            }
        });
        function filter_client(calEvent) {
            var valss = [];
            $('input:checkbox.calFilter:checked').each(function() {
                valss.push($(this).val());
            });
            return valss.indexOf(calEvent.name) !== -1;
        }//end
    </script>
    <script>
        $('.fc-content').click(function(e){
            $.get('<?php echo e(URL::to("get-guestpass-invoice")); ?>/'+$(this).find('span.fc-title').text(),function(data){
                console.log(data);
                $('#donation').hide();
                $('#insurance').hide();
                $("#phone_num").text(data['get_guest_pass_ordersbyuser']['profile']['phone']||'');
                $("#service_provider_name").text(data['get_guest_pass_orderssupadmin']['guestpassbyuser']['name']||'');
                $("#service_provider_name_policy").text(data['get_guest_pass_orderssupadmin']['guestpassbyuser']['name']||'');
                $("#service_provider_name_next").text(data['get_guest_pass_orderssupadmin']['guestpassbyuser']['name']||'');
                $("#guestpass_name").text(data['get_guest_pass_orderssupadmin']['GuestPassName']||'');
                $("#guestpass_name_hidden").val(data['get_guest_pass_orderssupadmin']['GuestPassName']||'');
                $("#guestpass_id").val(data['get_guest_pass_orderssupadmin']['GuestPassID']||'');
                $("#name").text(data['get_guest_pass_ordersbyuser']['name']||'');
                $("#email").text(data['get_guest_pass_ordersbyuser']['email']||'');
                $("#phone").text(data['get_guest_pass_ordersbyuser']['profile']['phone']||'');
                $("#name_policy").text(data['get_guest_pass_ordersbyuser']['name']||'');
                $("#name_next").text(data['get_guest_pass_ordersbyuser']['name']||'');
                $("#guestpass_date").text(data['guestpass_date']||'');
                $("#number_of_tickets").text(data['qty']||'');
                $("#day").text(data['day']||'');
                $("#booking_no").text(data['ReceiptNum']||'');
                $("#booked_on").text(data['booked_on']||'');
                $("#payment_status").text(data['PaymentStatus']||'');
                $("#booking_status").text(data['BookingStatus']||'');
                $("#payment_mode").text(data['TypeofPayment']||'');
                $("#guestpass").text(data['get_guest_pass_orderssupadmin']['GuestPassName']||'');
                $("#donation_name").text(data['donation_shrine_name']||'');
                $("#guestpass_description").text(data['Description']||'');
                $("#price_per_guestpass").text(data['get_guest_pass_orderssupadmin']['Price']||'');
                $("#guestpass_quantity").text(data['qty']||'');
                $("#notes_by_customer").text(data['NotesByCustomer']||'');
                $("#guestpass_start_date_minus").text(data['guestpass_start_date_minus']||'');
                $("#house_rules").text(data['house_rules']||'');
                $("#insurance_quantity").text(data['qty']||'');
//                $("#donation_price").text(data['Donation_amount']||'');
                var insurance = data['Insurance'];
                if (insurance >= 1){
                   var  num = (data['qty'] * 10.00||'');
                    var result = num.toFixed(2);
                    $("#insurance_price_final").text(result);
                    $('#insurance').show();
                }
                var donation = data['Donation'];
                if(donation >= 1){
                    var num = (data['Donation_amount']||'');
                    var result = num.toFixed(2);
                    $("#donation_price_final").text(result);
                    num = (data['Donation_amount']||'');
                    result = num.toFixed(2);
                    $("#donation_price").text(result);
                    $('#donation').show();
                }
                var num = (data['get_guest_pass_orderssupadmin']['Price'] * data['qty']||'');
                var result = num.toFixed(2);
                $("#price").text(result);
                num = ((data['get_guest_pass_orderssupadmin']['Price'] * data['qty']||'')+(data['Donation_amount']||'')+(10.00)||'');
                result = num.toFixed(2);
                $("#sub_total").text(result);
                num = ((data['get_guest_pass_orderssupadmin']['Price'] * data['qty']||'')+(data['Donation_amount']||'')+(10.00)+25||'');
                result = num.toFixed(2);
                $("#total").text(result);
            });
            $('#exampleModal').modal('show');
            setTimeout(function () {
                length = 200;
                cHtml = $("#guestpass_description").html();
                cText = $("#guestpass_description").text().substr(0, length).trim();
                $("#guestpass_description").addClass("compressed").html(cText + "... <a href='#' class='exp'>More</a>");
                window.handler = function () {
                    $('.exp').click(function () {
                        if ($("#guestpass_description").hasClass("compressed")) {
                            $("#guestpass_description").html(cHtml + "<a href='#' class='exp'>Less</a>");
                            $("#guestpass_description").removeClass("compressed");
                            handler();
                            return false;
                        }
                        else {
                            $("#guestpass_description").html(cText + "... <a href='#' class='exp'>More</a>");
                            $("#guestpass_description").addClass("compressed");
                            handler();
                            return false;
                        }
                    });
                }
                handler();
            }, 2000)
        });

        $(document).on('click','#guestpass',function(e){
            var id = $('#guestpass_id').val();
            var name = $('#guestpass_name_hidden').val();
            location.href = "<?php echo e(url('guestdetails/')); ?>/"+id+'/'+name;
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/superadminviews/guestpasscalender.blade.php ENDPATH**/ ?>