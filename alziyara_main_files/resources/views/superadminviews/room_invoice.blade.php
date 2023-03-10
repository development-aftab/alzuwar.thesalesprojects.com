@extends('layouts.master')
@push('css')
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
@endpush

@section('content')<style>p.open {}p.open+#unpaymenttoggle {    display: block;}p.open+#paidtoggle {    display: block;}</style>
    <?php
    $roomVendorName =  App\User::where('id',$roomreserves->getRoomOrderssupadmin[0]->PropertyCreatedBy)->first();
    $roomVendorProfile =  App\Profile::where('user_id',$roomreserves->getRoomOrderssupadmin[0]->PropertyCreatedBy)->first();
    // dd($roomVendorProfile);
    ?>
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">
                <div class="white-box printableArea">
                    <div class="pull-left">
                        <address>
                            <h1><img src="{{ asset('website') }}/img/alziyara_white_background_logo.png" alt="Logo" style="height: 120px;"><b style="margin-left: 20px"><a>ALZUWAR.COM</a></b></h1>
                        </address>
                    </div>
                    <div class="pull-right text-right">
                        <address>
                            <p class="m-l-5">Hotel Name: <b>{{ $roomreserves->getReservationOrdersroom->getHotelRoomDetails->Name??'' }}</b>
                            <p class="m-l-5">Service By: <b> {{$roomreserves->getReservationOrdersroom->getHotelRoomDetails->getUserofProperty->name??'Not Available'}}</b>
                            <p>Phone: <b> {{$roomreserves->getReservationOrdersroom->getHotelRoomDetails->getUserofProperty->profile->phone??''}}</b></p>
                            <p class="m-l-5">Address: <b>{{ $roomreserves->getReservationOrdersroom->getHotelRoomDetails->Address??'' }}</b>
                            <p>Booking No: <b>{{ $roomreserves->ReceiptNum??''}}</b></p>
                            <p>Booked On: <b>{{\Carbon\Carbon::parse( $roomreserves->CreatedOn??'' )->toDayDateTimeString()}}</b></p>

                        </address>
                    </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left">
                                    <address>
                                    <h3> &nbsp;<b >Order Receipt</b></h3>
                                    <p class="m-l-5">Customer: <b>{{$roomreserves->getRoomOrdersbyusersupadmin->name??''}}</b>
                                    <p class="m-l-5">Email: <b>{{$roomreserves->getRoomOrdersbyusersupadmin->email??''}}</b>
                                    <p class="m-l-5">Phone: <b>{{$roomreserves->getRoomOrdersbyusersupadmin->profile->phone??''}}</b>
                                    <p class="m-l-5">Check-in: <b>{{\Carbon\Carbon::parse( $roomreserves->checkin??'' )->toFormattedDateString()}}</b>
                                    <p class="m-l-5">Check-out: <b>{{\Carbon\Carbon::parse( $roomreserves->checkout??'' )->toFormattedDateString()}}</b>
                                    <p class="m-l-5">Duration: <b>{{$noOfDays??''}}</b></p>
                                    </p>
                                </address>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12 text-right col-offset-2">
                                <p><b>Payment By:</b> {{ucfirst($roomreserves->TypeofPayment??'')}}(charged by AlZuwar.com)</p>
                            </div>
                            <div class="col-md-4 col-sm-12 text-center col-offset-2">
                                <div class="dropdown">
                                    @if($roomreserves->request_refund_reply == "REFUNDED")
                                        <p><b>Payment Status: </b><span style='cursor:pointer; color:red'> REFUNDED</span><p>
                                    @elseif ($roomreserves->PaymentStatus == 'PAID')
                                            <p><b>Payment Status: </b><span style='cursor:pointer; color:green' class="dropdown-toggle" data-toggle="dropdown" for="paidtoggle"> PAID</span></p>
                                    @else
                                            <p><b>Payment Status: </b><span style='cursor:pointer; color:red' class="dropdown-toggle" data-toggle="dropdown" for="unpaymenttoggle" > UNPAID</span></p>

                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-12 text-left col-offset-2">
                                @if($roomreserves->request_refund_reply == "REFUNDED")
                                    <p><b>Booking Status: </b><span style='cursor:pointer; color:red'> REFUNDED</span></p>
                                @elseif($roomreserves->BookingStatus == 'PENDING')
                                    <div class="dropdown">
                                        <p  class="dropdown-toggle" data-toggle="dropdown"><b>Booking Status: </b><span style='cursor:pointer; color:darkorange;'>PENDING</span></p>
                                    </div>
                                @elseif($roomreserves->BookingStatus == 'CANCELLED')

                                    <p style='cursor:pointer;' class="dropdown-toggle" data-toggle="dropdown" for="cancel"> <b>Booking Status: </b><span style="color:orangered;"> CANCELLED</span> </p>
                                @else
                                    <p style='cursor:pointer;' class="dropdown-toggle" data-toggle="dropdown"> <b>Booking Status: </b><span style="color:green;"> CONFIRMED</span></p>
                                @endif
                            </div>

                        </div>
                        <?php



                        if(($roomreserves->Insurance == 1) && ($roomreserves->Donation == 0)){

                            $finalprice = 0;

                            $finalprice = $roomreserves->TotalPrice - 10;

                        }elseif(($roomreserves->Donation == 1) && ($roomreserves->Insurance == 0)){

                            $finalprice = 0;

                            $finalprice = $roomreserves->TotalPrice - $roomreserves->Donation_amount;

                        }elseif(($roomreserves->Insurance == 1) && ($roomreserves->Insurance == 1) ){

                            $finalprice = 0;

                            $finalprice = $roomreserves->TotalPrice - $roomreserves->Donation_amount - 10;

                        }else{

                            $finalprice = 0;

                            $finalprice = $roomreserves->TotalPrice;

                        }

                        $myjourneyarray = array($roomreserves->PickupLocation,$roomreserves->DropOffLocation);

                        $myjourney = implode('to',$myjourneyarray);

                        ?>
                            <div class="col-md-12">
                                <div class="table-responsive m-t-40" style="clear: both;">
                                    <table class="table table-hover">
                                        <thead>
                                        <tr>

                                            {{--<th>Room</th>--}}
                                            <th>Item</th>
                                            {{--<th>Bed Type</th>--}}
                                            <th>Description</th>
                                            {{--<th class="text-right">No of Days</th>--}}
                                            <th class="text-right">Price</th>
                                            <th class="text-right">Quantity</th>
                                            <th class="text-right">Duration</th>
                                            <th class="text-right">Subtotal</th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td ><a href="{{url('hotelsdetails/'.$roomreserves->getReservationOrdersroom->getHotelRoomDetails->PropertyID??''.'/'.$roomreserves->getReservationOrdersroom->getHotelRoomDetails->Name??'')}}" target="_blank">{{ $roomreserves->getReservationOrdersroom->RoomName??'' }}</a></td>
                                            <td><div class="content">{!!$roomreserves->getRoomOrderssupadmin[0]->Description??''!!}</div></td>
                                            <td class="text-right">$ {{ number_format($roomreserves->getReservationOrdersroom->Price+$roomreserves->getReservationOrdersroom->TaxAndCharges??"",2)}}</td>
                                            <td class="text-center">{{$roomreserves->qty??""}}</td>
                                            <?php $qty = \Carbon\Carbon::parse( $roomreserves->checkin )->diffInDays( $roomreserves->checkout )?>
                                            <td class="text-center">{{$qty}}</td>
                                            @if($qty>0)
                                                <td class="text-right"> $ {{ number_format((($roomreserves->getReservationOrdersroom->Price*$roomreserves->qty)+$roomreserves->getReservationOrdersroom->TaxAndCharges)*$qty,2)}} </td>
                                            @else
                                                <td class="text-right"> $ {{ number_format((($roomreserves->getReservationOrdersroom->Price*$roomreserves->qty)+$roomreserves->getReservationOrdersroom->TaxAndCharges),2)}} </td>
                                            @endif
                                        </tr>
                                        @if($roomreserves->Donation >= 1)
                                            <tr>
                                                <td>Donation to {{ $roomreserves->donation_shrine_name??''}}</td>
                                                <td>Hotel donations</td>
                                                <td class="text-right"> $ {{number_format($roomreserves->Donation_amount??'',2)}}</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">-</td>
                                                <td class="text-right">$ {{number_format($roomreserves->Donation_amount??'',2)}}</td>
                                            </tr>
                                        @endif
                                        @if($roomreserves->Insurance >=1)
                                            <tr>
                                                <td>Medical Insurance for <b>{{$roomreserves->qty??''}} visitors</b></td>
                                                <td> Medical Insurance</td>
                                                <td class="text-right"> $ 10.00</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">-</td>
                                                <td class="text-right">$ 10.00</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="pull-right m-t-30 text-right">

                                    @if($roomreserves->Insurance >=1)
                                        @if($qty>0)
                                            <p><b>Subtotal : </b>$ {{ number_format((($roomreserves->getReservationOrdersroom->Price*$roomreserves->qty)+$roomreserves->getReservationOrdersroom->TaxAndCharges)*$qty+(10)+$roomreserves->Donation_amount,2)}}</p>
                                        @else
                                            <p><b>Subtotal : </b>$ {{ number_format((($roomreserves->getReservationOrdersroom->Price*$roomreserves->qty)+$roomreserves->getReservationOrdersroom->TaxAndCharges)+(10)+$roomreserves->Donation_amount,2)}}</p>
                                        @endif
                                        <p><b> Tax : </b>$ 25.00</p>
                                        <hr>
                                        @if($qty>0)
                                            <p><b>Total : </b>$ {{ number_format((($roomreserves->getReservationOrdersroom->Price*$roomreserves->qty)+$roomreserves->getReservationOrdersroom->TaxAndCharges)*$qty+(10)+$roomreserves->Donation_amount+25,2)}}</p>
                                        @else
                                            <p><b>Total : </b>$ {{ number_format((($roomreserves->getReservationOrdersroom->Price*$roomreserves->qty)+$roomreserves->getReservationOrdersroom->TaxAndCharges)+(10)+$roomreserves->Donation_amount+25,2)}}</p>
                                        @endif
                                    @else
                                        @if($qty>0)
                                            <p><b>Subtotal : </b>$ {{ number_format((($roomreserves->getReservationOrdersroom->Price*$roomreserves->qty)+$roomreserves->getReservationOrdersroom->TaxAndCharges)*$qty+$roomreserves->Donation_amount,2)}}</p>
                                        @else
                                            <p><b>Subtotal : </b>$ {{ number_format((($roomreserves->getReservationOrdersroom->Price*$roomreserves->qty)+$roomreserves->getReservationOrdersroom->TaxAndCharges)+$roomreserves->Donation_amount,2)}}</p>
                                        @endif
                                        <p><b> Tax : </b>$ 25.00</p>
                                        <hr>
                                        @if($qty>0)
                                            <p><b>Total : </b>$ {{ number_format((($roomreserves->getReservationOrdersroom->Price*$roomreserves->qty)+$roomreserves->getReservationOrdersroom->TaxAndCharges)*$qty+$roomreserves->Donation_amount+25,2)}}</p>
                                        @else
                                            <p><b>Total : </b>$ {{ number_format((($roomreserves->getReservationOrdersroom->Price*$roomreserves->qty)+$roomreserves->getReservationOrdersroom->TaxAndCharges)+$roomreserves->Donation_amount+25,2)}}</p>
                                        @endif
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        <div class="text-left">
                            <p><b>Special Request - </b><span>{{$roomreserves->NotesByCustomer??''}}</span></p>
                            <p><b>Confirmation Policy –</b><span> This booking is subjected to confirmation from hotel. Typically it takes 1-2 business days for confirmation.</span></p>
                            <b>Cancelations, No Show Policy :</b>
                            <p> •	When your travel plans change, your reservation can too.</p>
                            <p> •	There are no fees to cancel reservations. However it has to be done 10 days before service day of the receipt - <b>({{\Carbon\Carbon::parse( $reservationStartDate??'')->toFormattedDateString()}})</b>Contact Alzuwar.com team for any assistance.</p>
                            <p> •	We recommend customers and service provider contact each other ahead of time to confirm plans.</p>
                            <p> •	No Shows – If service provider (<b>{{$roomreserves->getReservationOrdersroom->getHotelRoomDetails->getUserofProperty->name??'Not Available'}}</b>) did not show up or honor the bookings then customer (<b>{{$roomreserves->getRoomOrdersbyusersupadmin->name??''}}</b>) should contact alzuwar.com team immediately to provide another alternative service provider.</p>
                            <p> •	No Shows – If customer (<b>{{$roomreserves->getRoomOrdersbyusersupadmin->name??''}}</b>) did not show up at place of contact then service provider (<b>{{$roomreserves->getReservationOrdersroom->getHotelRoomDetails->getUserofProperty->name??'Not Available'}}</b>) should call alzuwar.com team immediately to notify.</p>
                            <b>House Rules:</b>
                            <p>{!!$roomreserves->getReservationOrderspropertycustomer->HouseRules??''!!}</p>
                        </div>
                        <hr>

                        <div class="text-right">
                            <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- .row -->
        <!-- /.row -->
        @include('layouts.partials.right-sidebar')
    </div>
@endsection

@push('js')
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

                $.get('{{ URL::to("hotels_reservation_status")}}/'+id+'/'+status+'/'+value,function(data){
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
                $.get('{{ URL::to("hotels_reservation_status")}}/'+id+'/'+status+'/'+value,function(data){
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
	$.get('{{ URL::to("room_mypayment_status")}}/'+id+'/'+status+'/'+value,function(data){
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
@endpush