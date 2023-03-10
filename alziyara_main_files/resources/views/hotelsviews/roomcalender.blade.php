@extends('layouts.master')
{{--@php--}}
{{--DB::table('yacht_availabilities')->where('id',$->id)->update(array('notification'=>'0'));--}}
{{--@endphp--}}
@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
<style>
    .modal-xl{
        width:80%;
    }
</style>
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
            {{--<br>--}}

            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Bookings - Hotel</h3>
                    <div class="pull-right">
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    {{--<div class="check-box-b" style="margin-left: 21px !important;">--}}
                        <!--<label class="radio-inline"><input type="radio" class="calFilter" name="yacht_name" value="all"  checked>All</label>-->

                    {{--</div><br>--}}
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
                    <h4 class="modal-title" id="exampleModalLabel1">Calendar Information</h4>
                </div>
                <form method="post" action="" id="availablity_modal_form">

                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="action_type" id="action_type">

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="white-box printableArea">
                                    <h1><img src="{{ asset('website') }}/img/alziyara_white_background_logo.png" alt="Logo" style="height: 120px;"><b style="margin-left: 20px"><a>ALZUWAR.COM</a></b></h1>
                                    <h3><b>Order Receipt</b><p class="pull-right small"><b>Phone No:</b><span id="phone_num"></span></p></h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pull-left">
                                                <p><b>Hotel Name: </b><span class="hotel_name" id="hotel_name" name="hotel_name"></span></p>
                                                <p><b>Service Provider Name: </b><span class="service_provider_name" id="service_provider_name" name="service_provider_name"></span></p>
                                                <p><b>Address: </b><span class="address" id="address" name="address"></span></p>
                                                <p><b>Full Name: </b><span class="name" id="name" name="name"></span></p>
                                                <p><b>Checkin Date: </b><span class="checkin_date" id="checkin_date" name="checkin_date"></span></p>
                                                <p><b>Checkout Date: </b><span class="checkout_date" id="checkout_date" name="checkout_date"></span></p>
                                                {{--<p><b>Participants: </b><span class="participants" id="participants" name="participants"></span></p>--}}
                                                <p><b>Total Guests: </b><span class="total_guests" id="total_guests" name="total_guests"></span></p>
                                                <p><b>Quantity of Rooms: </b><span class="room_quantity" id="room_quantity" name="room_quantity"></span></p>
                                                {{--<p><b>Day: </b><span class="day" id="day" name="day"></span></p>--}}
                                            </div>
                                            <div class="pull-right text-right">
                                                <h4 class="font-bold">Booking No: <span class="booking_no" id="booking_no" name="booking_no"></span></h4>
                                                <p class="text-muted m-l-30">Booked On: <span class="fa fa-calendar booked_on" id="booked_on" name="booked_on"> </span></p>

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="table-responsive m-t-40" style="clear: both;">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Room</th>
                                                        <th>Room Type</th>
                                                        <th class="text-center">Room Description</th>
                                                        <th class="text-center">Bed Type</th>
                                                        <th class="text-center">No. of Days</th>
                                                        <th class="text-center">Price per Night</th>
                                                        @if(Auth::user()->hasRole('SuperAdmin'))
                                                            <th class="text-center">Insurance</th>
                                                            <th class="text-center">Donation</th>
                                                        @endif
                                                        @if(Auth::user()->hasRole('SuperAdmin'))
                                                            <th class="text-center">Total Price</th>
                                                        @else
                                                            <th class="text-center">Price(Nights x Price)</th>
                                                        @endif
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td class="text-center">  <span id="room"></span></td>
                                                        <td class="text-center">  <span id="room_type"></span></td>
                                                        <td class="text-center">  <span id="room_description"></span></td>
                                                        <td class="text-center">  <span id="bed_type"></span></td>
                                                        <td class="text-center">  <span id="day"></span></td>
                                                        <td class="text-center"> $<span id="price_per_ticket"></span> USD</td>
                                                        @if(Auth::user()->hasRole('SuperAdmin'))
                                                            <td class="text-center"> $<span id="insurance"></span> USD</td>
                                                            <td class="text-center"> $<span id="donation"></span> USD</td>
                                                        @endif
                                                        <td class="text-center"> $<span id="price"></span>USD</td>
                                                    </tr>
                                                    {{--<tr>--}}
                                                    {{--<td class="text-center" colspan="">Total:$<span id="total"> </span> USD </td>--}}
                                                    {{--</tr>--}}
                                                    </tbody>
                                                </table>
                                                <p class="text-right"><b>SubTotal:</b>$<span id="sub_total"> </span> USD</p>
                                                <hr>
                                                <p class="text-right"><b>Tax:</b>$<span id="tax"> 40</span> USD</p>
                                                <hr>
                                                <p class="text-right"><b>Total:</b>$<span id="total"> </span> USD</p>
                                                <div class="text-left">
                                                    <p><b>Special Request - </b><span id="notes_by_customer"></span></p>
                                                    <p><b>Confirmation Policy –</b><span> This booking is subjected to confirmation from hotel. Typically it takes 1-2 business days for confirmation.</span></p>
                                                    <b>Cancelations, No Show Policy :</b>
                                                    <p> •	When your travel plans change, your reservation can too.</p>
                                                    <p> •	There are no fees to cancel reservations. However it has to be done 10 days before service day of the receipt - (<label id="room_start_date_minus"></label>) Contact Alzuwar.com team for any assistance.</p>
                                                    <p> •	We recommend customers and service provider contact each other ahead of time to confirm plans.</p>
                                                    <p> •	No Shows – If service provider (<label id="sp_name_policy"></label>) did not show up or honor the bookings then customer (<label id="user_name_policy"></label>) should contact alzuwar.com team immediately to provide another alternative service provider.</p>
                                                    <p> •	No Shows – If customer (<label id="user_name_next"></label>) did not show up at place of contact then service provider (<label id="sp_name_next"></label>) should call alzuwar.com team immediately to notify.</p>
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
                    </div>
                    <div class="modal-footer">
                        <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <!--<button type="submit" class="btn btn-primary" id="save_record">Save</button>
                        <button type="button" class="btn btn-danger" style="display: none;" id="delete_record">Delete</button>
                        <button type="submit" class="btn btn-info" style="display: none;" id="update_record">Update</button>-->
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
            $('#exampleModal').modal('show');
            $('#modalTitle').text(date.format());
            $('#action_type').val('new_record');
            $('#fullCalModal').modal('show');
        },
        events: [
                @foreach($roombooking as $ourroombooking){
                    @if($ourroombooking->getReservationOrdersproperty != null)
                        @if(( $ourroombooking->BookingStatus == 'CONFIRMED') && ($ourroombooking->PaymentStatus == 'PAID') && ($ourroombooking->request_refund_reply == ''))
                            title:   '{{$ourroombooking->ReceiptNum??"Not Available"}}/{{$ourroombooking->getRoomtUserDetail->name??''}}',
                            start:   '{{$ourroombooking->checkin}}',
                            <?php
                                $your_date = strtotime("1 day", strtotime($ourroombooking->checkout));
                                $new_date = date("Y-m-d", $your_date);
                                ?>
                            end:   	 '{{$new_date}}',
                            id:      '{{$ourroombooking->ReservationID??""}}',
                            comment: '{{$ourroombooking->SPComments}}',
                            color: 	'#2ecc71',
                            textColor: 'black',
                        @elseif(( $ourroombooking->BookingStatus == 'PENDING' ) && ($ourroombooking->request_refund_reply == '' ) )
                            title:   '{{$ourroombooking->ReceiptNum??"Not Available"}}/{{$ourroombooking->getRoomtUserDetail->name??''}}',
                            start:   '{{$ourroombooking->checkin}}',
                            <?php
                                $your_date = strtotime("1 day", strtotime($ourroombooking->checkout));
                                $new_date = date("Y-m-d", $your_date);
                                ?>
                            end:   	 '{{$new_date}}',
                            id:      '{{$ourroombooking->ReservationID??""}}',
                            comment: '{{$ourroombooking->SPComments}}',
                            color: 	'#ffa500',
                            textColor: 'black',
                        @elseif((( $ourroombooking->BookingStatus == 'CANCELLED' ) || ($ourroombooking->PaymentStatus == 'UNPAID' )) && ($ourroombooking->request_refund_reply == '' ))
                            title:   '{{$ourroombooking->ReceiptNum??"Not Available"}}/{{$ourroombooking->getRoomtUserDetail->name??''}}',
                            start:   '{{$ourroombooking->checkin}}',
                            <?php
                                $your_date = strtotime("1 day", strtotime($ourroombooking->checkout));
                                $new_date = date("Y-m-d", $your_date);
                                ?>
                            end:   	 '{{$new_date}}',
                            id:      '{{$ourroombooking->ReservationID??""}}',
                            comment: '{{$ourroombooking->SPComments}}',
                            color: 	'#ff0000',
                            textColor: 'black',
                        @endif
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
<script>
    $('.fc-content').click(function(e){
        $.get('{{ URL::to("get-room-invoice")}}/'+$(this).find('span.fc-title').text(),function(data){
            console.log(data);
            $("#phone_num").text(data['get_roomt_user_detail']['profile']['phone']||'');
            $("#hotel_name").text(data['get_room_details']['get_hotel_room_details']['Name']||'');
            $("#service_provider_name").text(data['get_room_details']['get_hotel_room_details']['get_userof_property']['name']||'');
            $("#sp_name_policy").text(data['get_room_details']['get_hotel_room_details']['get_userof_property']['name']||'');
            $("#sp_name_next").text(data['get_room_details']['get_hotel_room_details']['get_userof_property']['name']||'');
            $("#address").text(data['get_room_details']['get_hotel_room_details']['Address']||'');
            $("#name").text(data['get_roomt_user_detail']['name']||'');
            $("#user_name_policy").text(data['get_roomt_user_detail']['name']||'');
            $("#user_name_next").text(data['get_roomt_user_detail']['name']||'');
            $("#checkin_date").text(data['checkin_date']||'');
            $("#checkout_date").text(data['checkout_date']||'');
            $("#total_guests").text(data['qty'] * data['get_room_details']['MaxOccupancy']||'');
            $("#room_quantity").text(data['qty']||'');
            $("#room_name").text(data['get_room_details']['RoomName']||'');
            $("#room_type").text(data['get_room_details']['RoomType']||'');
            $("#bed_type").text(data['get_room_details']['get_bed_type']['BedTypeDesc']||'');
            $("#day").text(data['day']||'');
            $("#booking_no").text(data['ReceiptNum']||'');
            $("#booked_on").text(data['booked_on']||'');
            $("#room").text(data['get_room_details']['RoomName']||'');
            $("#room_description").text(data['Description']||'');
            $("#price_per_ticket").text(data['get_room_details']['Price']||'');
            @if(Auth::user()->hasrole('SuperAdmin'))
                $("#insurance").text(data['Insurance']*10||'');
                $("#donation").text(data['Donation_amount']||'');
            @endif
            @if(Auth::user()->hasrole('SuperAdmin'))
                $("#price").text(data['TotalPrice']*1||'');
            $("#sub_total").text(data['TotalPrice']*1||'');
            $("#total").text(data['TotalPrice']*1+40||'');
            @else
                $("#price").text(data['get_room_details']['Price'] * data['qty']*1||'');
            $("#sub_total").text(data['get_room_details']['Price'] * data['qty']*1||'');
            $("#total").text(data['get_room_details']['Price'] * data['qty']*1+40||'');
            @endif
            //                $("#price").text(data['total_price']);
            $("#notes_by_customer").text(data['NotesByCustomer']||'');
            $("#room_start_date_minus").text(data['room_start_date_minus']||'');
            $("#house_rules").text(data['house_rules']||'');
        });
        $('#exampleModal').modal('show');
    });
</script>
@endpush
