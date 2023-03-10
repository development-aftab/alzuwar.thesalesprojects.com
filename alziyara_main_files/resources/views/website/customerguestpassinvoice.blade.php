@extends('website.layout.master')
@push('css')
@endpush

@section('content')<style>p.open {}p.open+#unpaymenttoggle {    display: block;}p.open+#paidtoggle {    display: block;}</style>
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
                        <p class="m-l-5">Guest Pass Name: <b><a href="{{url('guestdetails/'.$guestpassreserves->getGuestPassOrderssupadmin->GuestPassID??''.'/'.$guestpassreserves->getGuestPassOrderssupadmin->GuestPassName??'')}}" target="_blank"> {{$guestpassreserves->getGuestPassOrderssupadmin->GuestPassName??''}}</a></b>
                        <p class="m-l-5"> Service By: <b> {{$guestpassreserves->getGuestPassOrderssupadmin->getGuestPassUser->name??'Not Available'}}</b></p>
                        <p>Phone: <b> {{$guestpassreserves->getGuestPassOrderssupadmin->getGuestPassUser->profile->phone??''}}</b></p>
                        <p>Booking No: <b> {{ $guestpassreserves->ReceiptNum??'' }}</b></p>
                        <p>Booked On: <b> {{\Carbon\Carbon::parse( $guestpassreserves->created_at??'' )->toDayDateTimeString()}}</b></p>
                    </address>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left">
                            <address>
                                <h3> &nbsp;<b >Order Receipt</b></h3>
                                {{--                                    <h3> &nbsp;<b class="text-danger">{{auth()->user()->name??''}}</b></h3>--}}
                                <p class="m-l-5">Customer:<b>{{$guestpassreserves->getGuestPassOrdersbyusersupadmin->name??''}}</b>
                                <p class="m-l-5">Email:<b>{{$guestpassreserves->getGuestPassOrdersbyusersupadmin->email??''}}</b>
                                <p class="m-l-5">Phone:<b>{{$guestpassreserves->getGuestPassOrdersbyusersupadmin->profile->phone??''}}</b>
                                <p class="m-l-5">Program Time:<b>{{$guestpassreserves->getGuestPassOrderssupadmin->GuestPassTime??''}}</b>
                                <p class="m-l-5">Visitors:<b> {{$guestpassreserves->qty??''}}</b></p>
                            </address>
                        </div>
                    </div>
                    {{--<div class="row">--}}
                        {{--<div class="col-md-4 text-right">--}}
                            {{--<p><b>Payment Mode:</b> {{ucfirst($guestpassreserves->TypeofPayment??'')}}(charged by AlZuwar.com)</p>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4 text-center">--}}
                            {{--@if($guestpassreserves->TypeofPayment == "cashpayment" || $guestpassreserves->TypeofPayment == "bankpayment" || $guestpassreserves->TypeofPayment == "zelle")--}}
                                {{--@if ($guestpassreserves->PaymentStatus == 'PAID')--}}
                                    {{--<p><b>Payment Status: </b><span style='cursor:pointer; color:green'> PAID</span></p>--}}
                                {{--@else--}}
                                    {{--<p><b>Payment Status: </b><span style='cursor:pointer; color:red'> UNPAID</span><p>--}}
                                {{--@endif--}}
                            {{--@endif--}}
                        {{--</div>--}}
                        {{--<div class="col-md-4 text-center">--}}
                            {{--@if($guestpassreserves->request_refund_reply == "REFUNDED")--}}
                                {{--<p><b>Booking Status:</b><span style='cursor:pointer; color:red'> REFUNDED</span></p>--}}
                            {{--@elseif($guestpassreserves->BookingStatus == 'PENDING')--}}
                                {{--<p style='cursor:pointer;'><b>Booking Status:</b><span style="color:darkorange;">PENDING</span>--}}
                            {{--@elseif($guestpassreserves->booking_status == 'CANCELLED')--}}
                                {{--<p style='cursor:pointer;' class="dropdown-toggle" data-toggle="dropdown" for="cancel"><b>Booking Status:</b><span style="color:orangered;"> CANCELLED</span> </p>--}}
                            {{--@else--}}
                                {{--<p class="dropdown-toggle" data-toggle="dropdown"> <b>Booking Status:</b><span style='cursor:pointer; color: green;' >CONFIRMED</span></p>--}}
                            {{--@endif--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <?php



                    if(($guestpassreserves->Insurance == 1) && ($guestpassreserves->Donation == 0)){

                        $finalprice = 0;

                        $finalprice = $guestpassreserves->TotalPrice - 10;

                    }elseif(($guestpassreserves->Donation == 1) && ($guestpassreserves->Insurance == 0)){

                        $finalprice = 0;

                        $finalprice = $guestpassreserves->TotalPrice - $guestpassreserves->Donation_amount;

                    }elseif(($guestpassreserves->Insurance == 1) && ($guestpassreserves->Insurance == 1) ){

                        $finalprice = 0;

                        $finalprice = $guestpassreserves->TotalPrice - $guestpassreserves->Donation_amount - 10;

                    }else{

                        $finalprice = 0;

                        $finalprice = $guestpassreserves->TotalPrice;

                    }

                    $myjourneyarray = array($guestpassreserves->PickupLocation,$guestpassreserves->DropOffLocation);

                    $myjourney = implode('to',$myjourneyarray);

                    ?>
                    <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both;">
                            <table class="table table-hover re_table">
                                <thead>
                                <tr>
                                    <th class="text-center">Item</th>
                                    <th class="text-center">Description</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Subtotal</th>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center"><a href="{{url('guestdetails/'.$guestpassreserves->getGuestPassOrderssupadmin->GuestPassID??''.'/'.$guestpassreserves->getGuestPassOrderssupadmin->GuestPassName??'')}}" target="_blank"> {{$guestpassreserves->getGuestPassOrderssupadmin->GuestPassName??""}}</a></td>
                                    <td><div class="content">{!! $guestpassreserves->getGuestPassOrderssupadmin->GuestPassDesc??''!!}</div></td>
                                    <td class="text-right">$ {{number_format($guestpassreserves->getGuestPassOrderssupadmin->Price??'0',2)}}</td>
                                    <td class="text-right">{{$guestpassreserves->qty??'0'}}</td>
                                    <td class="text-right">$ {{number_format($guestpassreserves->getGuestPassOrderssupadmin->Price*$guestpassreserves->qty,2)}}</td>
                                </tr>
                                @if($guestpassreserves->Donation >= 1)
                                    <tr>
                                        <td>Donation to {{ $guestpassreserves->donation_shrine_name??''}}</td>
                                        <td>GuestPass donations</td>
                                        <td class="text-right"> $ {{number_format($guestpassreserves->Donation_amount??'',2)}}</td>
                                        <td class="text-center">-</td>
                                        <td class="text-right">$ {{number_format($guestpassreserves->Donation_amount??'',2)}}</td>
                                    </tr>
                                @endif
                                @if($guestpassreserves->Insurance >=1)
                                    <tr>
                                        <td>Medical Insurance for <b>{{$guestpassreserves->qty??''}} visitors</b></td>
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
                            @if($guestpassreserves->Insurance >=1)
                                <p><b>Subtotal : </b>$ {{ number_format(($guestpassreserves->getGuestPassOrderssupadmin->Price*$guestpassreserves->qty)+(10)+$guestpassreserves->Donation_amount,2)}}</p>
                                <p><b> Tax : </b>$ 25.00</p>
                                <hr>
                                <p><b>Total : </b>$ {{ number_format(($guestpassreserves->getGuestPassOrderssupadmin->Price*$guestpassreserves->qty)+(10)+$guestpassreserves->Donation_amount+25,2)}}</p>
                            @else
                                <p><b>Subtotal : </b>$ {{ number_format(($guestpassreserves->getGuestPassOrderssupadmin->Price*$guestpassreserves->qty)+$guestpassreserves->Donation_amount,2)}}</p>
                                <p><b> Tax : </b>$ 25.00</p>
                                <hr>
                                <p><b>Total : </b>$ {{ number_format(($guestpassreserves->getGuestPassOrderssupadmin->Price*$guestpassreserves->qty)+$guestpassreserves->Donation_amount+25,2)}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="text-left">
                        <p><b>Special Request - </b><span>{{$guestpassreserves->NotesByCustomer??''}}</span></p>
                        <p><b>Confirmation Policy –</b><span> This booking is subjected to confirmation from hotel. Typically it takes 1-2 business days for confirmation.</span></p>
                        <b>Cancelations, No Show Policy :</b>
                        <p> •	When your travel plans change, your reservation can too.</p>
                        <p> •	There are no fees to cancel reservations. However it has to be done 10 days before service day of the receipt - <b>({{\Carbon\Carbon::parse( $reservationStartDate??'')->toFormattedDateString()}})</b>Contact Alzuwar.com team for any assistance.</p>
                        <p> •	We recommend customers and service provider contact each other ahead of time to confirm plans.</p>
                        <p> •	No Shows – If service provider (<b>{{$guestpassreserves->getGuestPassOrderssupadmin->getGuestPassUser->name??'Not Available'}}</b>) did not show up or honor the bookings then customer (<b>{{$guestpassreserves->getGuestPassOrdersbyusersupadmin->name??''}}</b>) should contact alzuwar.com team immediately to provide another alternative service provider.</p>
                        <p> •	No Shows – If customer (<b>{{$guestpassreserves->getGuestPassOrdersbyusersupadmin->name??''}}</b>) did not show up at place of contact then service provider (<b>{{$guestpassreserves->getGuestPassOrderssupadmin->getGuestPassUser->name??'Not Available'}}</b>) should call alzuwar.com team immediately to notify.</p>
                        <b>House Rules:</b>
                        <p>{!!$guestpassreserves->getGuestPassOrderssupadmin->HouseRules??''!!}</p>
                    </div>

                    <div class="clearfix"></div>
                    <hr>
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
                $.get('{{ URL::to("guestpass_reservation_status")}}/'+id+'/'+status+'/'+value,function(data){
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
                $.get('{{ URL::to("guestpass_reservation_status")}}/'+id+'/'+status+'/'+value,function(data){
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
    function paymentstatus(id, status) {
        swal("Write something here:", {
            content: "input",
        })
                .then((value) => {
            if (value) {
                $.get('{{ URL::to("guestpass_mypayment_status")}}/'+id+'/'+status+'/'+value,function(data){
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