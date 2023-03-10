@extends('layouts.master')
{{--@php--}}
{{--DB::table('yacht_availabilities')->where('id',$->id)->update(array('notification'=>'0'));--}}
{{--@endphp--}}
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<style>
    .modal-xl{
        width:80%;
    }
    /*.fc-listYear-button{*/
    /*display: none;*/
    /*}*/
</style>
<link href="{{ asset('plugins/components/dashboard/css/customstyle.css') }}" rel="stylesheet" />
@endpush

@section('content')
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
                        <h3 class="box-title m-b-0">Bookings - Packages Deal</h3>
                        <hr>
                        <!--<label class="radio-inline"><input type="radio" class="calFilter" name="yacht_name" value="all"  checked>All</label>-->

                    </div>
                    @include('website.calender-conditions')
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        @include('layouts.partials.right-sidebar')
    </div>

    {{--Modal--}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel1">
                        <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                    </h4>
                </div>
                <form method="post" action="" id="availablity_modal_form">

                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="action_type" id="action_type">
                    <input type="hidden" name="package_id" id="package_id" value="" >
                    <input type="hidden" name="package_name" id="package_name" value="">


                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="white-box printableArea">
                                    <div class="pull-left">
                                        <h1><img src="{{ asset('website') }}/img/alziyara_white_background_logo.png" alt="Logo" style="height: 120px;"><b style="margin-left: 20px"><a>ALZUWAR.COM</a></b></h1>
                                    </div>
                                    <div class="pull-right text-right">
                                        <p class="m-l-30">Service By: <b><span class="service_provider_name" id="service_provider_name" name="service_provider_name"></span></b></p>
                                        <p class="m-l-30">Phone: <b><span id="phone_num"></span></b></p>
                                        <p class="m-l-30">Booking No: <b><span class="booking_no" id="booking_no" name="booking_no"></span></b></p>
                                        <p class="m-l-30">Booked On: <b><span class="fa fa-calendar booked_on" id="booked_on" name="booked_on"></span></b></p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pull-left">
                                                <h3> &nbsp;<b >Order Receipt</b></h3>
                                                <p>Customer: <b><span class="name" id="name" name="name"></span></b></p>
                                                <p>Email: <b><span class="email" id="email" name="email"></span></b></p>
                                                <p>Phone: <b><span class="phone" id="phone" name="phone"></span></b></p>
                                                <p>From: <b><span class="tour_start_date" id="tour_start_date" name="tour_start_date"></span></b></p>
                                                <p>To: <b><span class="tour_end_date" id="tour_end_date" name="tour_end_date"></span></b></p>
                                                <p>Visitors: <b><span class="participants" id="participants" name="participants"></span></b> | Duration: <b><span class="day" id="day" name="day"></span></b> </p>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 text-right col-offset-2">
                                                <p><b>Payment Mode:</b> <span  id="payment_mode" class="payment_mode" name="payment_mode"> </span>(charged by AlZuwar.com)</p>
                                            </div>
                                            <div class="col-md-4 col-sm-12 text-center col-offset-2">
                                                <p><b>Payment Status: </b> <span  id="payment_status" name="payment_status" class="payment_status"></span><p>
                                            </div>
                                            <div class="col-md-4 col-sm-12 text-left col-offset-2">
                                                <p><b>Booking Status:</b> <span  id="booking_status" class="booking_status" name="booking_status"> </span></p>
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
                                                        <th class="text-center">Subtotal</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td class="text-center"><span  style="cursor:pointer; color: #1DA1F2" id="tour_name"></span></td>
                                                        <td class="text-center"><span id="tour_description"></span></td>
                                                        <td class="text-center">$<span id="price_per_ticket"></span> USD</td>
                                                        <td class="text-center"><span id="quantity"></span></td>
                                                        <td class="text-center"> $<span id="final_price"></span>USD</td>
                                                    </tr>

                                                    <tr id="donation">
                                                        <td class="text-center">Doantion to <span id="donation_name"></span></td>
                                                        <td class="text-center">Package Donations<span id="donation_description"></span></td>
                                                        <td class="text-center">$<span id="donation_price"></span> USD</td>
                                                        <td class="text-center"><span id="donation_quantity">-</span></td>
                                                        <td class="text-center"> $<span id="donation_price_final"></span>USD</td>
                                                    </tr>

                                                    <tr id="insurance">
                                                        <td class="text-center">Medical Insurance for <span id="insurance_name"></span> visitors</td>
                                                        <td class="text-center">Medical insurance <span id="insurance_description"></span></td>
                                                        <td class="text-center">$10.00<span id="insurance_price"></span> USD</td>
                                                        <td class="text-center"><span id="insurance_quantity"></span></td>
                                                        <td class="text-center"> $<span id="insurance_price_final"></span>USD</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <p class="text-right"><b>SubTotal:</b>$<span id="sub_total" class="priceformat"> </span> USD</p>
                                                <hr>
                                                <p class="text-right"><b>Tax:</b>$<span id="tax">25.00</span> USD</p>
                                                <hr>
                                                <p class="text-right"><b>Total:</b>$<span id="total" class="priceformat"> </span> USD</p>
                                                <div class="text-left">
                                                    <p><b>Special Request - </b><span id="notes_by_customer"></span></p>
                                                    <p><b>Confirmation Policy –</b><span> This booking is subjected to confirmation from hotel. Typically it takes 1-2 business days for confirmation.</span></p>
                                                    <b>Cancelations, No Show Policy :</b>
                                                    <p> •	When your travel plans change, your reservation can too.</p>
                                                    <p> •	There are no fees to cancel reservations. However it has to be done 10 days before service day of the receipt - (<label id="package_start_date_minus"></label>) Contact Alzuwar.com team for any assistance.</p>
                                                    <p> •	We recommend customers and service provider contact each other ahead of time to confirm plans.</p>
                                                    <p> •	No Shows – If service provider (<label id="service_provider_name_policy"></label>) did not show up or honor the bookings then customer (<label id="name_policy"></label>) should contact alzuwar.com team immediately to provide another alternative service provider.</p>
                                                    <p> •	No Shows – If customer (<label id="name_next"></label>) did not show up at place of contact then service provider (<label id="service_provider_name_next"></label>) should call alzuwar.com team immediately to notify.</p>
                                                    <b>House Rules:</b>
                                                    <p id="house_rules"></p>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')

<script src="{{asset('plugins/components/calendar/jquery-ui.min.js')}}"></script>
<script src="{{asset('plugins/components/moment/moment.js')}}"></script>
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
            // $('#exampleModal').modal('show');
            $('#modalTitle').text(date.format());
            $('#action_type').val('new_record');
            $('#fullCalModal').modal('show');
        },
        events: [
                @foreach($packagebooking as $ourpackagebooking)
            {
                @if(( $ourpackagebooking->booking_status == 'CONFIRMED' ) && ($ourpackagebooking->payment_status == 'PAID' ) && ($ourpackagebooking->request_refund_reply == '' ) )
                //PAID //CONFIRMED // NO REFUND REQUEST Green color
                title:   	'{{$ourpackagebooking->receipt_num??"Not Available"}}/{{$ourpackagebooking->getPackageDealsUserDetail->name??''}}',
                start:   	'{{$ourpackagebooking->getPackageDealsOrderDetail->package_available_from}}',
                <?php
                        $your_date = strtotime("1 day", strtotime($ourpackagebooking->getPackageDealsOrderDetail->package_available_to));
                        $new_date = date("Y-m-d", $your_date);
                        ?>
                end:   	 	'{{$new_date}}',
                id:      	'{{$ourpackagebooking->receipt_num??""}}',
                comment: 	'{{$ourpackagebooking->sp_comments}}',
                color: 		'#2ecc71',
                textColor: 	'white',
//                        textDecoration: 'line-through',
                {{--@elseif(( $ourpackagebooking->booking_status == 'CONFIRMED' ) && ($ourpackagebooking->payment_status == 'UNPAID' ) && ($ourpackagebooking->request_refund_reply == '' ) )--}}
                {{--//UNPAID //CONFIRMED // NO REFUND REQUEST Silver color--}}
                {{--title:   	'{{$ourpackagebooking->receipt_num??"Not Available"}}/{{$ourpackagebooking->getPackageDealsUserDetail->name??''}}',--}}
                {{--start:   	'{{$ourpackagebooking->getPackageDealsOrderDetail->package_available_from}}',--}}
                {{--<?php--}}
                {{--$your_date = strtotime("1 day", strtotime($ourpackagebooking->getPackageDealsOrderDetail->package_available_to));--}}
                {{--$new_date = date("Y-m-d", $your_date);--}}
                {{--?>--}}
                {{--end:   	 	'{{$new_date}}',--}}
                {{--id:      	'{{$ourpackagebooking->receipt_num??""}}',--}}
                {{--comment: 	'{{$ourpackagebooking->sp_comments}}',--}}
                {{--color: 		'#c0c0c0',--}}
                {{--textColor: 	'black',--}}
                @elseif(( $ourpackagebooking->booking_status == 'PENDING' ) && ($ourpackagebooking->request_refund_reply == '' ))
                //UNPAID //PENDING // NO REFUND REQUEST Orange color
                title:   	'{{$ourpackagebooking->receipt_num??"Not Available"}}/{{$ourpackagebooking->getPackageDealsUserDetail->name??''}}',
                start:   	'{{$ourpackagebooking->getPackageDealsOrderDetail->package_available_from}}',
                <?php
                        $your_date = strtotime("1 day", strtotime($ourpackagebooking->getPackageDealsOrderDetail->package_available_to));
                        $new_date = date("Y-m-d", $your_date);
                        ?>
                end:   	 	'{{$new_date}}',
                id:      	'{{$ourpackagebooking->receipt_num??""}}',
                comment: 	'{{$ourpackagebooking->sp_comments}}',
                color: 		'#ffa500',
                textColor: 	'black',
                @elseif((( $ourpackagebooking->booking_status == 'CANCELLED' ) || ($ourpackagebooking->payment_status == 'UNPAID' )) && ($ourpackagebooking->request_refund_reply == '' ))
                //UNPAID //CANCELLED // NO REFUND REQUEST Red color
                title:   	'{{$ourpackagebooking->receipt_num??"Not Available"}}/{{$ourpackagebooking->getPackageDealsUserDetail->name??''}}',
                start:   	'{{$ourpackagebooking->getPackageDealsOrderDetail->package_available_from}}',
                <?php
                        $your_date = strtotime("1 day", strtotime($ourpackagebooking->getPackageDealsOrderDetail->package_available_to));
                        $new_date = date("Y-m-d", $your_date);
                        ?>
                end:   	 	'{{$new_date}}',
                id:      	'{{$ourpackagebooking->receipt_num??""}}',
                comment: 	'{{$ourpackagebooking->sp_comments}}',
                color: 		'#ff0000',
                textColor: 	'white',
                {{--@elseif(( $ourpackagebooking->booking_status == 'CANCELLED' ) && ($ourpackagebooking->payment_status == 'PAID' ) && ($ourpackagebooking->request_refund_reply == '' ) )--}}
                {{--//PAID //CANCELLED // NO REFUND REQUEST Lime color--}}
                {{--title:   	'{{$ourpackagebooking->receipt_num??"Not Available"}}/{{$ourpackagebooking->getPackageDealsUserDetail->name??''}}',--}}
                {{--start:   	'{{$ourpackagebooking->getPackageDealsOrderDetail->package_available_from}}',--}}
                {{--<?php--}}
                {{--$your_date = strtotime("1 day", strtotime($ourpackagebooking->getPackageDealsOrderDetail->package_available_to));--}}
                {{--$new_date = date("Y-m-d", $your_date);--}}
                {{--?>--}}
                {{--end:   	 	'{{$new_date}}',--}}
                {{--id:      	'{{$ourpackagebooking->receipt_num??""}}',--}}
                {{--comment: 	'{{$ourpackagebooking->sp_comments}}',--}}
                {{--color: 		'#00ff00',--}}
                {{--textColor: 	'white',--}}
                {{--@elseif(( $ourpackagebooking->booking_status == 'PENDING' ) && ($ourpackagebooking->payment_status == 'PAID') && ($ourpackagebooking->request_refund_reply == 'REFUNDED' ) )--}}
                {{--//PAID //PENDING // REFUNDED yellow color--}}
                {{--title:   	'{!! $ourpackagebooking->receipt_num??"Not Available"!!}',--}}
                {{--start:   	'{{$ourpackagebooking->getPackageDealsOrderDetail->package_available_from}}',--}}
                {{--<?php--}}
                {{--$your_date = strtotime("1 day", strtotime($ourpackagebooking->getPackageDealsOrderDetail->package_available_to));--}}
                {{--$new_date = date("Y-m-d", $your_date);--}}
                {{--?>--}}
                {{--end:   	 	'{{$new_date}}',--}}
                {{--id:      	'{{$ourpackagebooking->receipt_num??""}}',--}}
                {{--comment: 	'{{$ourpackagebooking->sp_comments}}',--}}
                {{--color: 		'#ffff00',--}}
                {{--textColor: 	'black',--}}
                {{--@elseif(( $ourpackagebooking->booking_status == 'CONFIRMED' ) && ($ourpackagebooking->payment_status == 'PAID' ) && ($ourpackagebooking->request_refund_reply == 'REFUNDED' ) )--}}
                {{--//PAID //CONFIRMED // REFUNDED Aqua color--}}
                {{--title:   	'{{$ourpackagebooking->receipt_num??"Not Available"}}/{{$ourpackagebooking->getPackageDealsUserDetail->name??''}}',--}}
                {{--start:   	'{{$ourpackagebooking->getPackageDealsOrderDetail->package_available_from}}',--}}
                {{--<?php--}}
                {{--$your_date = strtotime("1 day", strtotime($ourpackagebooking->getPackageDealsOrderDetail->package_available_to));--}}
                {{--$new_date = date("Y-m-d", $your_date);--}}
                {{--?>--}}
                {{--end:   	 	'{{$new_date}}',--}}
                {{--id:      	'{{$ourpackagebooking->receipt_num??""}}',--}}
                {{--comment: 	'{{$ourpackagebooking->sp_comments}}',--}}
                {{--color: 		'#0000ff',--}}
                {{--textColor: 	'white',--}}
                {{--@elseif(( $ourpackagebooking->booking_status == 'CONFIRMED' ) && ($ourpackagebooking->payment_status == 'PAID' ) && ($ourpackagebooking->request_refund_reply == 'CANCELLED' ) )--}}
                {{--//PAID //CONFIRMED // CANCELLED REFUND REQUEST teal color--}}
                {{--title:   	'{{$ourpackagebooking->receipt_num??"Not Available"}}/{{$ourpackagebooking->getPackageDealsUserDetail->name??''}}',--}}
                {{--start:   	'{{$ourpackagebooking->getPackageDealsOrderDetail->package_available_from}}',--}}
                {{--<?php--}}
                {{--$your_date = strtotime("1 day", strtotime($ourpackagebooking->getPackageDealsOrderDetail->package_available_to));--}}
                {{--$new_date = date("Y-m-d", $your_date);--}}
                {{--?>--}}
                {{--end:   	 	'{{$new_date}}',--}}
                {{--id:      	'{{$ourpackagebooking->receipt_num??""}}',--}}
                {{--comment: 	'{{$ourpackagebooking->sp_comments}}',--}}
                {{--color: 		'#008080',--}}
                {{--textColor: 	'white',--}}
                {{--@elseif(( $ourpackagebooking->booking_status == 'PENDING' ) && ($ourpackagebooking->payment_status == 'PAID' ) && ($ourpackagebooking->request_refund_reply == 'CANCELLED' ) )--}}
                {{--//PAID //PENDING // CANCELLED REFUND REQUEST Azure color--}}
                {{--title:   	'{{$ourpackagebooking->receipt_num??"Not Available"}}/{{$ourpackagebooking->getPackageDealsUserDetail->name??''}}',--}}
                {{--start:   	'{{$ourpackagebooking->getPackageDealsOrderDetail->package_available_from}}',--}}
                {{--<?php--}}
                {{--$your_date = strtotime("1 day", strtotime($ourpackagebooking->getPackageDealsOrderDetail->package_available_to));--}}
                {{--$new_date = date("Y-m-d", $your_date);--}}
                {{--?>--}}
                {{--end:   	 	'{{$new_date}}',--}}
                {{--id:      	'{{$ourpackagebooking->receipt_num??""}}',--}}
                {{--comment: 	'{{$ourpackagebooking->sp_comments}}',--}}
                {{--color: 		'#f0ffff',--}}
                {{--textColor: 	'black',--}}
                {{--@elseif(( $ourpackagebooking->booking_status == 'PENDING' ) && ($ourpackagebooking->payment_status == 'PAID' ) && ($ourpackagebooking->request_refund_reply == 'REQUESTED' ) )--}}
                {{--//PAID //PENDING // REFUND REQUESTED Khaki color--}}
                {{--title:   	'{{$ourpackagebooking->receipt_num??"Not Available"}}/{{$ourpackagebooking->getPackageDealsUserDetail->name??''}}',--}}
                {{--start:   	'{{$ourpackagebooking->getPackageDealsOrderDetail->package_available_from}}',--}}
                {{--<?php--}}
                {{--$your_date = strtotime("1 day", strtotime($ourpackagebooking->getPackageDealsOrderDetail->package_available_to));--}}
                {{--$new_date = date("Y-m-d", $your_date);--}}
                {{--?>--}}
                {{--end:   	 	'{{$new_date}}',--}}
                {{--id:      	'{{$ourpackagebooking->receipt_num??""}}',--}}
                {{--comment: 	'{{$ourpackagebooking->sp_comments}}',--}}
                {{--color: 		'#bdb76b',--}}
                {{--textColor: 	'black',--}}
                {{--@elseif(( $ourpackagebooking->booking_status == 'CANCELLED' ) && ($ourpackagebooking->payment_status == 'PAID' ) && ($ourpackagebooking->request_refund_reply == 'REFUNDED' ) )--}}
                {{--//PAID //CANCELLED // REFUNDED brown color #f4a460--}}
                {{--title:   	'{{$ourpackagebooking->receipt_num??"Not Available"}}/{{$ourpackagebooking->getPackageDealsUserDetail->name??''}}',--}}
                {{--start:   	'{{$ourpackagebooking->getPackageDealsOrderDetail->package_available_from}}',--}}
                {{--<?php--}}
                {{--$your_date = strtotime("1 day", strtotime($ourpackagebooking->getPackageDealsOrderDetail->package_available_to));--}}
                {{--$new_date = date("Y-m-d", $your_date);--}}
                {{--?>--}}
                {{--end:   	 	'{{$new_date}}',--}}
                {{--id:      	'{{$ourpackagebooking->receipt_num??""}}',--}}
                {{--comment: 	'{{$ourpackagebooking->sp_comments}}',--}}
                {{--color: 		'#f4a460',--}}
                {{--textColor: 	'black',--}}
                {{--@else--}}
                {{--//No Condition Cyan color--}}
                {{--title:   	'{{$ourpackagebooking->receipt_num??"Not Available"}}/{{$ourpackagebooking->getPackageDealsUserDetail->name??''}}',--}}
                {{--start:   	'{{$ourpackagebooking->getPackageDealsOrderDetail->package_available_from}}',--}}
                {{--<?php--}}
                {{--$your_date = strtotime("1 day", strtotime($ourpackagebooking->getPackageDealsOrderDetail->package_available_to));--}}
                {{--$new_date = date("Y-m-d", $your_date);--}}
                {{--?>--}}
                {{--end:   	 	'{{$new_date}}',--}}
                {{--id:      	'{{$ourpackagebooking->receipt_num??""}}',--}}
                {{--comment: 	'{{$ourpackagebooking->sp_comments}}',--}}
                {{--color: 		'#00ffff',--}}
                {{--textColor: 	'black',--}}
                @endif
            },
            @endforeach
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

            // $('#exampleModal').modal('show');
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
            data: { 'id':id,_token: "{{ csrf_token() }}"},
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
{{--<script src="https://momentjs.com/downloads/moment.ackjs"></script>--}}
<script>
    $(document).on('click','.fc-content',function(e){
        $.get('{{ URL::to("get-package-invoice")}}/'+$(this).find('span.fc-title').text(),function(data) {
            console.log(data);
            $('#insurance').hide();
            $('#donation').hide();
            $("#phone_num").text(data['get_package_deals_order_detail']['get_package_user']['profile']['phone'] || '');
            $("#service_provider_name").text(data['get_package_deals_order_detail']['get_package_user']['name'] || '');
            $("#service_provider_name_policy").text(data['get_package_deals_order_detail']['get_package_user']['name'] || '');
            $("#service_provider_name_next").text(data['get_package_deals_order_detail']['get_package_user']['name'] || '');
            $("#name").text(data['get_package_deals_user_detail']['name'] || '');
            $("#email").text(data['get_package_deals_user_detail']['email'] || '');
            $("#phone").text(data['get_package_deals_user_detail']['profile']['phone'] || '');
            $("#name_policy").text(data['get_package_deals_user_detail']['name'] || '');
            $("#name_next").text(data['get_package_deals_user_detail']['name'] || '');
            $("#tour_name").text(data['get_package_deals_order_detail']['package_deals_name'] || '');
            $("#donation_name").text(data['get_package_deals_order_detail']['package_deals_name'] || '');
            $("#package_name").val(data['get_package_deals_order_detail']['package_deals_name'] || '');
            $("#package_id").val(data['get_package_deals_order_detail']['id'] || '');
            $("#tour_start_date").text(data['get_package_deals_order_detail']['package_start_date'] || '');
            $("#tour_end_date").text(data['get_package_deals_order_detail']['package_end_date'] || '');
            $("#participants").text(data['qty'] || '');
            $("#insurance_name").text(data['qty'] || '');
            $("#insurance_quantity").text(data['qty'] || '');
            $("#quantity").text(data['qty'] || '');
            $("#day").text(data['get_package_deals_order_detail']['day'] || '');
            $("#booking_no").text(data['receipt_num'] || '');
            $("#booked_on").text(data['booked_on'] || '');
            $("#tour").text(data['get_package_deals_order_detail']['package_deals_name'] || '');
            $("#tour_description").text(data['get_package_deals_order_detail']['tour_description'] || '');
            $("#price_per_ticket").text(data['get_package_deals_order_detail']['price'] || '');
            $("#payment_status").text(data['payment_status'] || '');
            $("#booking_status").text(data['booking_status'] || '');
            $("#payment_mode").text(data['TypeofPayment'] || '');
            var insurance = data['package_insurance'];
            if (insurance >= 1){
                var num = (data['qty'] * 10 || '');
                var result = num.toFixed(2);
                $("#insurance_price_final").text(result);
                $('#insurance').show();
            }
            var donation = data['package_donation_amount'];
            if(donation >= 1){
                var num = (data['package_donation_amount'] || '');
                var result = num.toFixed(2);
                $("#donation_price").text(result);
                num = (data['package_donation_amount'] || '');
                result = num.toFixed(2);
                $("#donation_price_final").text(result);
                $('#donation').show();
            }
            var num = (data['get_package_deals_order_detail']['price_unformated'] * data['qty'] * 1.00 || '');
            var result = num.toFixed(2);
            $("#final_price").text(result);
            num = (data['get_package_deals_order_detail']['price_unformated'] * data['qty'] * 1.00) + (data['package_donation_amount']) + (10.00 * data['qty'] * 1.00);
            result = num.toFixed(2);
            $("#sub_total").text(result);
            num = (data['get_package_deals_order_detail']['price_unformated'] * data['qty'] * 1.00) + (data['package_donation_amount']) + (10.00 * data['qty'] * 1.00) + 25;
            result = num.toFixed(2);
            $("#total").text(result);
            $("#notes_by_customer").text(data['notes_by_customer']||'');
            $("#package_start_date_minus").text(data['package_start_date_minus']||'');
            $("#house_rules").text(data['get_package_deals_order_detail']['house_rules']||'');
        });
        $('#exampleModal').modal('show');
    });
</script>
<script src="{{asset('js/jquery.PrintArea.js')}}" type="text/JavaScript"></script>
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
</script>
<script>
    //    fcContent =
    $(document).ready(function(){
        document.getElementsByClassName('fc-content').innerHTML = '<span class="customer-name"> </span>';
    })
    //        alert()
    //    fcContent.innerHTML = '<span class="use-name"></span>';
</script>
<script>
    $(document).on('click','#tour_name',function(e){
        var id = $('#package_id').val();
        var name = $('#package_name').val();
//            window.location.href('packagesdetail/'+id+'/'+name);
        location.href = "{{ url('packagesdetail/')}}/"+id+'/'+name;
    });
</script>
@endpush

