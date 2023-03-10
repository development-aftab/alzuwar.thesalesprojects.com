
@extends('layouts.master')
@push('css')
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
@endpush

@section('content')<style>p.open {}p.open+#unpaymenttoggle {    display: block;}p.open+#paidtoggle {    display: block;}</style>
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
                            <p class="m-l-5">Service By: <b> {{$transportreserves->getTransportOrderssupadmin->getTransportuser->name??'Not Available'}}</b>
                            <p>Phone: <b> {{$transportreserves->getTransportOrderssupadmin->getTransportuser->profile->phone??''}}</b></p>
                            <p>Booking No: <b> {{ $transportreserves->ReceiptNum??''}}</b></p>
                            <p>Booked On: <b> {{\Carbon\Carbon::parse( $transportreserves->created_at??'' )->toDayDateTimeString()}}</b></p>
                        </address>
                    </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pull-left">
                                    <address>
                                    <h2 class="m-l-5">Order Receipt</h2>
                                    {{--<p class="m-l-5">Driver Name: <b><a href="{{url('transportdetails/'.$transportreserves->getTransportOrderssupadmin->VehicalRouteID??''.'/'.$transportreserves->getTransportOrderssupadmin->NameofVehicle??'')}}" target="_blank">{{$transportreserves->getTransportOrderssupadmin->DriverName??''}}</a></b>--}}
                                    <p class="m-l-5">Customer: <b>{{$transportreserves->getTransportUserDetail->name??''}}</b>
                                    <p class="m-l-5">Email: <b>{{$transportreserves->getTransportUserDetail->email??''}}</b>
                                    <p class="m-l-5">Phone: <b>{{$transportreserves->getTransportUserDetail->profile->phone??''}}</b>
                                    <p class="m-l-5">Pickup Date/Time: <b>{{\Carbon\Carbon::parse( $transportreserves->PickUpDateTime??'' )->toDayDateTimeString()}}</b>
                                    <p class="m-l-5">Pickup Location: <b>{{$transportreserves->PickupLocation??''}}</b>
                                    <p class="m-l-5">Drop-off Location: <b>{{$transportreserves->DropOffLocation??''}}</b>
                                    {{--<p class="m-l-5">Passengers: <b>{{\Carbon\Carbon::parse( $transportreserves->PickUpDateTime??'' )->toDayDateTimeString()}}</b>--}}
                                            {{-- | Day: <b>{{$transportreserves->noofdaysqty??''}}</b>--}}
                                    </p>
                                </address>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 text-right">
                                <p><b>Payment Mode:</b> {{ucfirst($transportreserves->TypeofPayment??'')}}(charged by AlZuwar.com)</p>
                            </div>
                            <div class="col-md-4 text-center">
                                    @if($transportreserves->request_refund_reply == "REFUNDED")
                                    <p><b>Booking Status:</b><span style='cursor:pointer; color:red'> REFUNDED</span></p>
                                    @elseif ($transportreserves->PaymentStatus == 'PAID')
                                        <p><b>Payment Status: </b><span style='cursor:pointer; color:green'> PAID</span></p>
                                    @else
                                        <p><b>Payment Status: </b><span style='cursor:pointer; color:red'> UNPAID</span><p>
                                    @endif

                            </div>
                        <div class="col-md-4 text-left">
                        @if($transportreserves->request_refund_reply == "REFUNDED")
                            <p><b>Booking Status:</b><span style='cursor:pointer; color:red'> REFUNDED</span></p>
                        @elseif($transportreserves->BookingStatus == 'PENDING')
                                    <p style='cursor:pointer;' class="dropdown-toggle" data-toggle="dropdown"><b>Booking Status:</b><span style="color:darkorange;">PENDING</span></p>
                                @elseif($transportreserves->booking_status == 'CANCELLED')
                                    <p style='cursor:pointer;' class="dropdown-toggle" data-toggle="dropdown" for="cancel"><b>Booking Status:</b><span style="color:orangered;"> CANCELLED</span> </p>
                                @else
                                    <p style='cursor:pointer;' class="dropdown-toggle" data-toggle="dropdown"><b>Booking Status:</b><span style="color:green;"> CONFIRMED</span></p>
                                @endif
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
                                <table class="table table-hover">
                                        <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Description</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            {{--<th>Vehicle</th>--}}
                                            {{--<th>Vehicle Plate</th>--}}
                                            {{--<th>Passengers</th>--}}
                                            {{--<th class="text-right">Seats</th>--}}
                                            {{--<th class="text-right">Suitcases</th>--}}
                                            {{--<th class="text-right">Suitcase Capacity</th>--}}
                                            <th class="text-right">Subtotal</th>

                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td class="text-left">
                                                Vehicle Type:{{$transportreserves->getTransportOrderssupadmin->getTransporttype->TransporatationTypeDesc??""}}<br>
                                                Vehicle:<a href="{{url('transportdetails/'.$transportreserves->getTransportOrderssupadmin->VehicleRouteID.'/'.$transportreserves->getTransportOrderssupadmin->NameofVehicle??'')}}" target="_blank"> {{$transportreserves->getTransportOrderssupadmin->NameofVehicle??''}}</a><br>
                                                <i class="fa fa-chair"></i> {{$transportreserves->getTransportOrderssupadmin->getTransporttype->NumOfSeats??""}}  |
                                                <i class="fa fa-briefcase"></i> {{$transportreserves->getTransportOrderssupadmin->getTransporttype->LuggageCapacity??""}}<br>
                                                Driver:{{$transportreserves->getTransportOrderssupadmin->DriverName??''}} |
                                                Plate:{{$transportreserves->getTransportOrderssupadmin->NumberPlate??''}}


                                            </td>
                                            <td class="text-left"><div class="content">{!!$transportreserves->getTransportOrderssupadmin->Description??'' !!}</div></td>
                                            @if($transportreserves->triptype == 'oneway')

                                                <td class="text-left">$ {{number_format($route->Price??0,2)}}</td>
                                            @else
                                                <td class="text-left">$ {{number_format($route->TwoWayPrice??0,2)}}</td>
                                            @endif
                                            <td class="text-left">{{$transportreserves->noofdaysqty??""}}</td>
                                            @if($transportreserves->triptype == 'oneway')
                                                <td class="text-right">$ {{number_format($route->Price*$transportreserves->noofdaysqty,2)}}</td>
                                            @else
                                                <td class="text-right">$ {{number_format($route->TwoWayPrice*$transportreserves->noofdaysqty,2)}}</td>
                                            @endif
                                        </tr>
                                        @if($transportreserves->Donation >= 1)
                                            <tr>
                                                <td>Donation to {{$transportreserves->donation_shrine_name??''}} </td>
                                                <td>Hotel donations</td>
                                                <td class="text-right"> $ {{number_format($transportreserves->Donation_amount??0,2)}}</td>
                                                <td class="text-center">-</td>
                                                <td class="text-right">$ {{number_format($transportreserves->Donation_amount??0,2)}}</td>
                                            </tr>
                                        @endif
                                        @if($transportreserves->Insurance >=1)
                                            <tr>
                                                <td>Medical Insurance for <b>{{$transportreserves->noofdaysqty??''}} visitors</b></td>
                                                <td> Medical Insurance</td>
                                                <td class="text-right"> $ 10.00</td>
                                                <td class="text-center">{{ $transportreserves->noofdaysqty??''}}</td>
                                                <td class="text-right">$ {{ number_format($transportreserves->noofdaysqty*10,2)}}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="pull-right m-t-30 text-right">
                                    @if($transportreserves->Insurance >=1)
                                        @if($transportreserves->triptype == 'oneway')
                                            <p><b>Subtotal : </b>$ {{ number_format(($route->Price*$transportreserves->noofdaysqty)+($transportreserves->noofdaysqty*10)+$transportreserves->Donation_amount,2)}}</p>
                                            <p><b> Tax : </b>$ 25.00</p>
                                            <hr>
                                            <p><b>Total : </b>$ {{ number_format(($route->Price*$transportreserves->noofdaysqty)+($transportreserves->noofdaysqty*10)+$transportreserves->Donation_amount+25,2)}}</p>
                                        @else
                                            <p><b>Subtotal : </b>$ {{ number_format(($route->TwoWayPrice*$transportreserves->noofdaysqty)+($transportreserves->noofdaysqty*10)+$transportreserves->Donation_amount,2)}}</p>
                                            <p><b> Tax : </b>$ 25.00</p>
                                            <hr>
                                            <p><b>Total : </b>$ {{ number_format(($route->TwoWayPrice*$transportreserves->noofdaysqty)+($transportreserves->noofdaysqty*10)+$transportreserves->Donation_amount+25,2)}}</p>
                                        @endif
                                    @else
                                        @if($transportreserves->triptype == 'oneway')
                                            <p><b>Subtotal : </b>$ {{ number_format(($route->Price*$transportreserves->noofdaysqty)+$transportreserves->Donation_amount,2)}}</p>
                                            <p><b> Tax : </b>$ 25.00</p>
                                            <hr>
                                            <p><b>Total : </b>$ {{ number_format(($route->Price*$transportreserves->noofdaysqty)+$transportreserves->Donation_amount+25,2)}}</p>
                                        @else
                                            <p><b>Subtotal : </b>$ {{ number_format(($route->TwoWayPrice*$transportreserves->noofdaysqty)+$transportreserves->Donation_amount,2)}}</p>
                                            <p><b> Tax : </b>$ 25.00</p>
                                            <hr>
                                            <p><b>Total : </b>$ {{ number_format(($route->TwoWayPrice*$transportreserves->noofdaysqty)+$transportreserves->Donation_amount+25,2)}}</p>

                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="text-left">
                                <p><b>Special Request - </b><span>{{$transportreserves->NotesByCustomer??''}}</span></p>
                                <p><b>Round Trip Policy –  </b><span>A driver is booked for 6 hours on round trips. If customer requires additional time they should negotiated the additional fare directly with the driver of vehicle.</span></p>
                                <p><b>Confirmation Policy –</b> This booking is subjected to confirmation from transportation provider. Typically it takes 1-2 business days for confirmation.</p>
                                <b>Cancelations, No Show Policy :</b>
                                <p>    •	When your travel plans change, your reservation can too.</p>
                                <p>    •	There are no fees to cancel reservations. However it has to be done 10 days before service day of the receipt - <b>({{\Carbon\Carbon::parse( $reservationStartDate??'')->toFormattedDateString()}})</b>. Contact Alzuwar.com team for any assistance.</p>
                                <p>    •	We recommend customers and service provider contact each other ahead of time to confirm plans.</p>
                                <p>    •	No Shows – If service provider <b>({{$transportreserves->getTransportOrderssupadmin->DriverName??''}})</b>  did not show up or honor the bookings then customer (<b>{{$transportreserves->getTransportUserDetail->name??''}}</b>) should contact alzuwar.com team immediately to provide another alternative service provider.</p>
                                <p>    •	No Shows – If customer (<b>{{$transportreserves->getTransportUserDetail->name??''}}</b>) did not show up at place of contact then service provider (<b>{{$transportreserves->getTransportOrderssupadmin->DriverName??''}}</b>) should call alzuwar.com team immediately to notify.</p>
                                <b>House Rules: </b>
                                <p>{!!$transportreserves->getcustomerorder->HouseRules??''!!}</p>
                            </div>

                            <div class="clearfix"></div>
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

                $.get('{{ URL::to("transport_reservation_status")}}/'+id+'/'+status+'/'+value,function(data){
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
                $.get('{{ URL::to("transport_reservation_status")}}/'+id+'/'+status+'/'+value,function(data){
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
	$.get('{{ URL::to("transport_mypayment_status")}}/'+id+'/'+status+'/'+value,function(data){
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