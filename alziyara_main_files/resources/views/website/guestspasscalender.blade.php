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
</style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row">
            <br>

            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Bookings - Shrine Programs</h3>
                    <div class="pull-right">
                    </div>
                    <div class="clearfix"></div>
                    <hr>
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
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="action_type" id="action_type">
                    <input type="hidden" name="guestpass_name_hidden" id="guestpass_name_hidden" value="">
                    <input type="hidden" name="guestpass_id" id="guestpass_id" value="">

                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="white-box printableArea">
                                    <div class="pull-left">
                                    <h1><img src="{{ asset('website') }}/img/alziyara_white_background_logo.png" alt="Logo" style="height: 120px;"><b style="margin-left: 20px"><a>ALZUWAR.COM</a></b></h1>
                                    </div>
                                    <div class="pull-right text-right">
                                        <p class="m-l-30">Service By: <b><span class="service_provider_name" id="service_provider_name" name="service_provider_name"></span></b></p>
                                        <p class="m-l-30">Phone No:<b><span id="phone_num"></span></b></p>
                                        <p class="m-l-30">Booking No: <b><span class="booking_no" id="booking_no" name="booking_no"></span></b></p>
                                        <p class="m-l-30">Booked On: <b><span class="booked_on" id="booked_on" name="booked_on"> </span></b></p>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="pull-left">
                                                <h3> &nbsp;<b >Order Receipt</b></h3>
                                                <p><b>Guest Pass Name: </b><span class="guestpass_name" id="guestpass_name" name="guestpass_name"></span></p>
                                                <p><b>Name: </b><span class="name" id="name" name="name"></span></p>
                                                <p><b>Guest Pass Date: </b><span class="guestpass_date" id="guestpass_date" name="guestpass_date"></span></p>
                                                <p><b>Participants: </b><span class="number_of_tickets" id="number_of_tickets" name="number_of_tickets"></span></p>
                                                <p><b>Day: </b><span class="day" id="day" name="day"></span></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 text-right col-offset-2">
                                                <p><b>Payment Status: </b><span  id="payment_status" name="payment_status" class="payment_status"></span><p>
                                            </div>

                                            <div class="col-md-4 col-sm-12 text-center col-offset-2">
                                                <p><b>Booking Status:</b><span  id="booking_status" class="booking_status" name="booking_status"> </span></p>
                                            </div>
                                            <div class="col-md-4 col-sm-12 text-left col-offset-2">
                                                <p><b>Payment Mode:</b><span  id="payment_mode" class="payment_mode" name="payment_mode"> </span>(charged by AlZuwar.com)</p>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="table-responsive m-t-40" style="clear: both;">
                                                <table class="table table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th>Guest Pass Name</th>
                                                        <th class="text-center">GuestPass Description</th>
                                                        <th class="text-center">Price per Ticket</th>
                                                        @if(Auth::user()->hasRole('SuperAdmin'))
                                                            <th class="text-center">Insurance</th>
                                                            <th class="text-center">Donation</th>
                                                        @endif
                                                        <th class="text-center">Price(No. of Tickets x Price)</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td class="text-center">  <span id="guestpass"></span></td>
                                                        <td class="text-center">  <span id="guestpass_description"></span></td>
                                                        <td class="text-center"> $<span id="price_per_guestpass"></span> USD</td>
                                                        @if(Auth::user()->hasRole('SuperAdmin'))
                                                            <td class="text-center"> $<span id="insurance"></span> USD</td>
                                                            <td class="text-center"> $<span id="donation"></span> USD</td>
                                                        @endif
                                                        <td class="text-center"> $<span id="price"></span>USD</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                                <p class="text-right"><b>SubTotal:</b>$ <span id="sub_total"> </span> USD</p>
                                                <hr>
                                                <p class="text-right"><b>Tax:</b>$<span id="tax"> 40</span> USD</p>
                                                <hr>
                                                <p class="text-right"><b>Total:</b>$<span id="total"> </span> USD</p>
                                                <div class="text-left">
                                                    <p><b>Special Request - </b><span id="notes_by_customer"></span></p>
                                                    <p><b>Confirmation Policy –  </b><span>This booking is subjected to confirmation from guide. Typically it takes 1-2 business days for confirmation.</span></p>
                                                    <b>Cancelations, No Show Policy :</b>
                                                    <p>•    When your travel plans change, your reservation can too.</p>
                                                    <p>•	There are no fees to cancel reservations. However it has to be done 10 days before service day of the receipt - (<label id="guestpass_start_date_minus"></label>). Contact Alzuwar.com team for any assistance.</p>
                                                    <p>•    We recommend customers and service provider contact each other ahead of time to confirm plans.</p>
                                                    <p>•	No Shows – If service provider (<label id="service_provider_name_policy"></label>) did not show up or honor the bookings then customer (<label id="name_policy"></label>) should contact alzuwar.com team immediately to provide another alternative service provider.</p>
                                                    <p>•	No Shows – If customer (<label id="name_next"></label>)  did not show up at place of contact then service provider (<label id="service_provider_name_next"></label>) should call alzuwar.com team immediately to notify.</p>
                                                    <b>House Rules: </b>
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
                @foreach($guestpassbooking as $ourguestpassbooking){
                @if($ourguestpassbooking->getGuestPassOrders != null)
                    @if(( $ourguestpassbooking->BookingStatus == 'CONFIRMED' ) && ($ourguestpassbooking->PaymentStatus == 'PAID' ) && ($ourguestpassbooking->request_refund_reply == '') )
                title:   '{{$ourguestpassbooking->ReceiptNum??"Not Available"}}/{{$ourguestpassbooking->getGuestPassOrdersbyuser->name??''}}',
                start:   '{{$ourguestpassbooking->ReservationForDate}}',
                id:      '{{$ourguestpassbooking->ReservationID??""}}',
                comment: '{{$ourguestpassbooking->SPComments}}',
                color: 	'#2ecc71',
                textColor: 'black',
                    @elseif(( $ourguestpassbooking->BookingStatus == 'PENDING')  && ($ourguestpassbooking->request_refund_reply == ''))
                        title:   '{{$ourguestpassbooking->ReceiptNum??"Not Available"}}/{{$ourguestpassbooking->getGuestPassOrdersbyuser->name??''}}',
                        start:   '{{$ourguestpassbooking->ReservationForDate}}',
                        id:      '{{$ourguestpassbooking->ReservationID??""}}',
                        comment: '{{$ourguestpassbooking->SPComments}}',
                        color: 	'#ffa500',
                        textColor: 'black',
                    @elseif((( $ourguestpassbooking->BookingStatus == 'CANCELLED') || ($ourguestpassbooking->PaymentStatus == 'UNPAID')) && ($ourguestpassbooking->request_refund_reply == ''))
                        title:   '{{$ourguestpassbooking->ReceiptNum??"Not Available"}}/{{$ourguestpassbooking->getGuestPassOrdersbyuser->name??''}}',
                        start:   '{{$ourguestpassbooking->ReservationForDate}}',
                        id:      '{{$ourguestpassbooking->ReservationID??""}}',
                        comment: '{{$ourguestpassbooking->SPComments}}',
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
        $.get('{{ URL::to("get-guestpass-invoice")}}/'+$(this).find('span.fc-title').text(),function(data){
            console.log(data);
            $("#phone_num").text(data['get_guest_pass_ordersbyuser']['profile']['phone']||'');
            $("#service_provider_name").text(data['get_guest_pass_orderssupadmin']['guestpassbyuser']['name']||'');
            $("#service_provider_name_policy").text(data['get_guest_pass_orderssupadmin']['guestpassbyuser']['name']||'');
            $("#service_provider_name_next").text(data['get_guest_pass_orderssupadmin']['guestpassbyuser']['name']||'');
            $("#guestpass_name").text(data['get_guest_pass_orderssupadmin']['GuestPassName']||'');
            $("#guestpass_name_hidden").text(data['get_guest_pass_orderssupadmin']['GuestPassName']||'');
            $("#guestpass_id").text(data['get_guest_pass_orderssupadmin']['GuestPassID']||'');
            $("#name").text(data['get_guest_pass_ordersbyuser']['name']||'');
            $("#name_policy").text(data['get_guest_pass_ordersbyuser']['name']||'');
            $("#name_next").text(data['get_guest_pass_ordersbyuser']['name']||'');
            $("#guestpass_date").text(data['guestpass_date']||'');
//                $("#tour_end_date").text(data['get_package_deals_order_detail']['package_end_date']);
            $("#number_of_tickets").text(data['qty']||'');
            $("#day").text(data['day']||'');
            $("#booking_no").text(data['ReceiptNum']||'');
            $("#booked_on").text(data['booked_on']||'');
            $("#payment_status").text(data['PaymentStatus']||'');
            $("#booking_status").text(data['BookingStatus']||'');
            $("#payment_mode").text(data['TypeofPayment']||'');
            $("#guestpass").text(data['get_guest_pass_orderssupadmin']['GuestPassName']||'');
            $("#guestpass_description").text(data['Description']||'');
            $("#price_per_guestpass").text(data['get_guest_pass_orderssupadmin']['Price']||'');
            @if(Auth::user()->hasrole('SuperAdmin'))
                $("#insurance").text(data['Insurance']*10||'');
                $("#donation").text(data['Donation']*10||'');
            @endif
            @if(Auth::user()->hasrole('SuperAdmin'))
                $("#price").text(data['TotalPrice']*1||'');
                $("#sub_total").text(data['TotalPrice']*1||'');
                $("#total").text(data['TotalPrice']*1+40||'');
            @else
                $("#price").text(data['get_guest_pass_orderssupadmin']['Price'] * data['qty']*1||'');
                $("#sub_total").text(data['get_guest_pass_orderssupadmin']['Price'] * data['qty']*1||'');
                $("#total").text(data['get_guest_pass_orderssupadmin']['Price'] * data['qty']*1+40||'');
            @endif
            $("#notes_by_customer").text(data['NotesByCustomer']||'');
            $("#guestpass_start_date_minus").text(data['guestpass_start_date_minus']||'');
            $("#house_rules").text(data['house_rules']||'');
        });
        $('#exampleModal').modal('show');
    });

    $(document).on('click','#guestpass',function(e){
        var id = $('#guestpass_id').val();
        var name = $('#guestpass_name_hidden').val();
        location.href = "{{ url('guestdetails/')}}/"+id+'/'+name;
    });
</script>
@endpush