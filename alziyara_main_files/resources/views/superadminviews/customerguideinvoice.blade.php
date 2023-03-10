@extends('website.layout.master')
@push('css')
@endpush

@section('content')<style>p.open {}p.open+#unpaymenttoggle {    display: block;}p.open+#paidtoggle {    display: block;}</style>
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
                        <h1><img src="{{ asset('website') }}/img/alziyara_white_background_logo.png" alt="Logo" style="height: 120px;"><b style="margin-left: 20px"><a>ALZUWAR.COM</a></b></h1>
                    </address>
                </div>
                <div class="pull-right text-right">
                    <address>
                        <p>Service By: <b> {{$guidereserves->getGuideDetails->getguideUser->name??'Not Available'}}</b></p>
                        <p>Phone: <b> {{$guidereserves->getGuideDetails->getguideUser->profile->phone??'Not Available' }}</b></p>
                        <p>Booking No: <b> {{ $guidereserves->ReceiptNum??'' }}</b></p>
                        <p>Booked On: <b> {{\Carbon\Carbon::parse(  $guidereserves->created_at??'' )->toDayDateTimeString()}}</b></p>
                    </address>
                </div>
                <div class="row">

                    <div class="col-md-12">
                        <div class="pull-left">
                            <address>
                                <h3><b>Order Receipt</b></h3>
                                {{--<p class="m-l-5">Guide Name: <b><a href="{{url('guide-details/'.$guidereserves->getGuideDetails->GuidesID .'/'.$guidereserves->getGuideDetails->GuidesName)}}" target="_blank"> {{$guidereserves->getGuideDetails->GuidesName??''}}</a></b>--}}
                                <p class="m-l-5">Customer: <b> {{$guidereserves->getGuidesUserDetail->name??''}}</b>
                                <p class="m-l-5">Email: <b> {{$guidereserves->getGuidesUserDetail->email??''}}</b>
                                <p class="m-l-5">Phone: <b> {{$guidereserves->getGuidesUserDetail->profile->phone??''}}</b>
                                <p class="m-l-5">From: <b> {{\Carbon\Carbon::parse( $guidereserves->getGuideDetails->guide_startdate??'' )->toFormattedDateString()}}</b>
                                <p class="m-l-5">To: <b> {{\Carbon\Carbon::parse( $guidereserves->getGuideDetails->guide_enddate??'' )->toFormattedDateString()}}</b>
                                @if($message == 0)
                                    <p class="m-l-5">Duration: <b> {{ 1??'' }} Day</b> | Visitors: <b>{{$adults_guide??''}} Adults,</b> <b>{{$childs_guide??''}} Children, </b> <b>{{$infants_guide??''}} Infants</b></p>
                                @else
                                    <p class="m-l-5">Duration: <b> {{ $message+1??'' }} Days</b> | Visitors: <b>{{$adults_guide??0}} Adults,</b> <b>{{$childs_guide??0}} Children, </b> <b>{{$infants_guide??0}} Infants</b></p>
                                @endif
                                {{--Visitors: <b>{{$guidereserves->qty??''}}--}}
                            </address>
                        </div>
                    </div>
                    {{--<div class="row">--}}
                        {{--<div class="col-md-4 text-right">--}}
                            {{--<p><b>Payment Mode:</b> {{ucfirst($guidereserves->TypeofPayment??'')}}(charged by AlZuwar.com)</p>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4 text-center">--}}
                            {{--@if($guidereserves->TypeofPayment == "cashpayment" || $guidereserves->TypeofPayment == "bankpayment" || $guidereserves->TypeofPayment == "zelle")--}}
                                {{--<p><b>Payment Status: </b><span style='cursor:pointer; color:green'> PAID</span></p>--}}
                            {{--@else--}}
                                {{--<p><b>Payment Status: </b><span style='cursor:pointer; color:red'> UNPAID</span><p>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4 text-left">--}}
                            {{--@if($guidereserves->request_refund_reply == "REFUNDED")--}}
                                {{--<p><b>Booking Status:</b><span style='cursor:pointer; color:red'> REFUNDED</span></p>--}}
                            {{--@elseif($guidereserves->BookingStatus == 'PENDING')--}}
                                {{--<p style='cursor:pointer;' class="dropdown-toggle" data-toggle="dropdown"><b>Booking Status:</b><span style="color:darkorange;">PENDING</span>--}}
                            {{--@elseif($guidereserves->booking_status == 'CANCELLED')--}}
                                {{--<p style='cursor:pointer;' class="dropdown-toggle" data-toggle="dropdown" for="cancel"><b>Booking Status:</b><span style="color:orangered;"> CANCELLED</span> </p>--}}
                            {{--@else--}}
                                {{--<p style='cursor:pointer;' class="dropdown-toggle" data-toggle="dropdown"><b>Booking Status:</b><span style="color:green;"> CONFIRMED</span></p>--}}
                            {{--@endif--}}
                        {{--</div>--}}

                    {{--</div>--}}
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
                                    <td class="text-center"><a href="{{url('guide-details/'.$guidereserves->getGuideDetails->GuidesID .'/'.$guidereserves->getGuideDetails->GuidesName)}}" target="_blank">{{$guidereserves->getGuideDetails->GuidesName??''}}</a>  -  {{$guidereserves->getGuideDetails->Languages??''}} Speaking guide</td>
                                    <td><div class="content">{!!$guidereserves->getGuideDetails->GuidesDesc??""!!}</div></td>
                                    <td class="text-right">$ {{number_format($guidereserves->getGuideDetails->PricePerDay??'0',2)}}</td>
                                    <?php $qty = \Carbon\Carbon::parse( $guidereserves->reservation_start_date )->diffInDays( $guidereserves->reservation_end_date )?>
                                    <td class="text-right">{{$qty}}</td>
                                    <td class="text-right"> $ {{number_format($guidereserves->getGuideDetails->PricePerDay*$qty,2)}}</td>

                                </tr>

                                @if($guidereserves->Donation >= 1)
                                    <tr>
                                        <td>Donation to {{$guidereserves->donation_shrine_name??''}}</td>
                                        <td>Guide donations</td>
                                        <td class="text-right"> $ {{number_format($guidereserves->Donation_amount??'',2)}}</td>
                                        <td class="text-center">-</td>
                                        <td class="text-right">$ {{number_format($guidereserves->Donation_amount??'',2)}}</td>
                                    </tr>
                                @endif
                                @if($guidereserves->Insurance >=1)
                                    <tr>
                                        <td>Medical Insurance for <b>{{$guidereserves->qty??''}} visitors</b></td>
                                        <td> Medical Insurance</td>
                                        <td class="text-right"> $ 10.00</td>
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
                            @if($guidereserves->Insurance >=1)
                                <p><b>Subtotal : </b> $ {{ number_format(($guidereserves->getGuideDetails->PricePerDay*$qty)+(10)+$guidereserves->Donation_amount,2)}}</p>
                                <p><b> Tax : </b>$ 25.00</p>
                                <hr>
                                <p><b>Total : </b>$ {{ number_format(($guidereserves->getGuideDetails->PricePerDay*$qty)+(10)+$guidereserves->Donation_amount+25,2)}}</p>
                            @else
                                <p><b>Subtotal : </b>$ {{ number_format(($guidereserves->getGuideDetails->PricePerDay*$qty)+$guidereserves->Donation_amount,2)}}</p>
                                <p><b> Tax : </b>$ 25.00</p>
                                <hr>
                                <p><b>Total : </b>$ {{ number_format(($guidereserves->getGuideDetails->PricePerDay*$qty)+$guidereserves->Donation_amount+25,2)}}</p>
                            @endif
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="text-left">
                            <p><b>Special Request - </b><span>{{$guidereserves->NotesByCustomer??''}}</span></p>
                            <p><b>Confirmation Policy –  </b><span>This booking is subjected to confirmation from guide. Typically it takes 1-2 business days for confirmation.</span></p>
                            <b>Cancelations, No Show Policy :</b>
                            <p>•    When your travel plans change, your reservation can too.</p>
                            <p>•	There are no fees to cancel reservations. However it has to be done 10 days before service day of the receipt - <b>({{\Carbon\Carbon::parse( $reservationStartDate??'')->toFormattedDateString()}})</b>. Contact Alzuwar.com team for any assistance.</p>
                            <p>•    We recommend customers and service provider contact each other ahead of time to confirm plans.</p>
                            <p>•	No Shows – If service provider <b>({{$guidereserves->getGuideDetails->GuidesName??""}})</b> did not show up or honor the bookings then customer <b>({{$guidereserves->getGuidesUserDetail->name??''}})</b> should contact alzuwar.com team immediately to provide another alternative service provider.</p>
                            <p>•	No Shows – If customer <b>({{$guidereserves->getGuidesUserDetail->name??''}})</b> did not show up at place of contact then service provider <b>({{$guidereserves->getGuideDetails->GuidesName??""}})</b>should call alzuwar.com team immediately to notify.</p>
                            <b>House Rules: </b>
                            <p>{!!$guidereserves->getGuideDetails->HouseRules??''!!}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

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
        swal({
            title: "Are you sure?",
            text: "Do you really want to change the status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
                .then((willDelete) => {
            if (willDelete) {
                $.get('{{ URL::to("guide_reservation_status")}}/'+id+'/'+status+'/'+value,function(data){
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
                $.get('{{ URL::to("guide_reservation_status")}}/'+id+'/'+status+'/'+value,function(data){
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
                $.get('{{ URL::to("guide_mypayment_status")}}/'+id+'/'+status+'/'+value,function(data){
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

