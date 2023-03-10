@section('content')

    <style>
        p.open {}

        p.open+#unpaymenttoggle {
            display: block;
        }

        p.open+#paidtoggle {
            display: block;
        }
    </style>
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
            <div class="col-md-12">

                <div class="white-box printableArea re_white">
                    <div class="pull-left text-left">
                        <address>
                        <h1><img src="{{ asset('website')}}/img/alziyara_white_background_logo.png" alt="Logo" style="height: 120px;"><b style="margin-left: 20px"><a>ALZUWAR.COM</a></b></h1>
                        </address>
                    </div>
                    <div class="pull-right text-right">
                        <address>
                            <p>Service By: <b>{{$search->getPackageDealsOrderDetail->getPackageUser->name??'Not Available'}}</b></p>
                            <p>Phone: <b>{{$search->getPackageDealsOrderDetail->getPackageUser->profile->phone??'Not Available' }}</b></p>
                            <p>Booking No: <b>{{ $search->receipt_num??'' }}</b></p>
                            <p>Booked On : <b>{{ \Carbon\Carbon::parse( $search->created_at??'')->toDayDateTimeString() }}</b></p>
                        </address>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="pull-left">
                                <address>
                                    <h2 class="m-l-5">Order Receipt</h2>
                                    <p class="m-l-5">Customer:<b> {{$search->getUserDetail->name??''}}</b>
                                    <p class="m-l-5">Email:<b> {{$search->getUserDetail->email??''}}</b>
                                    <p class="m-l-5">Phone:<b> {{$search->getUserDetail->profile->phone??''}}</b>
                                    <p class="m-l-5">From:<b> {{ \Carbon\Carbon::parse( $search->getPackageDealsOrderDetail->package_available_from??'')->toFormattedDateString() }}</b>
                                    <p class="m-l-5">To: <b> {{ \Carbon\Carbon::parse( $search->getPackageDealsOrderDetail->package_available_to??'' )->toFormattedDateString() }}</b>
                                    <p class="m-l-5">Duration: <b> {{ $message }}</b> | Visitors: <b> {{$search->qty??''}}</b>
                                    </p>
                                </address>
                            </div>
                        </div>

                        @if(!auth()->user()->hasrole('customer'))
                        <div class="row">
                            <div class="col-md-4 col-sm-12 text-right col-offset-2">
                                <p><b>Payment By:</b> {{ucfirst($search->TypeofPayment??'')}}(charged by AlZuwar.com)</p>
                            </div>
                            <div class="col-md-4 col-sm-12 text-center col-offset-2">
                                <div class="dropdown">
                                    @if($search->request_refund_reply == "REFUNDED")
                                        <p><b>Payment Status: </b><span style='cursor:pointer; color:red'> REFUNDED</span><p>
                                    @elseif($search->TypeofPayment == "cashpayment" || $search->TypeofPayment == "bankpayment" || $search->TypeofPayment == "zelle")
                                        @if ($search->payment_status == 'PAID')
                                            <p><b>Payment Status: </b><span style='cursor:pointer; color:green' class="dropdown-toggle" data-toggle="dropdown" for="paidtoggle"> PAID</span></p>
                                        @else
                                            <p><b>Payment Status: </b><span style='cursor:pointer; color:red' class="dropdown-toggle" data-toggle="dropdown" for="unpaymenttoggle" > UNPAID</span></p>

                                        @endif
                                    @else
                                        @if ($search->payment_status == 'PAID')
                                            <p><b>Payment Status: </b><span style='cursor:pointer; color:green'> PAID</span></p>
                                        @else
                                            <p><b>Payment Status: </b><span style='cursor:pointer; color:red'> UNPAID</span><p>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12 text-left col-offset-2">
                                @if($search->request_refund_reply == "REFUNDED")
                                    <p><b>Booking Status: </b><span style='cursor:pointer; color:red'> REFUNDED</span></p>
                                @elseif($search->booking_status == 'PENDING')
                                    <div class="dropdown">
                                        <p  class="dropdown-toggle" data-toggle="dropdown"><b>Booking Status: </b><span style='cursor:pointer; color:darkorange;'>PENDING</span></p>
                                    </div>
                                @elseif($search->booking_status == 'CANCELLED')

                                    <p style='cursor:pointer;' class="dropdown-toggle" data-toggle="dropdown" for="cancel"> <b>Booking Status: </b><span style="color:orangered;"> CANCELLED</span> </p>
                                @else
                                    <p style='cursor:pointer;' class="dropdown-toggle" data-toggle="dropdown"><b>Booking Status:</b><span style="color:green;">CONFIRMED</span></p>
                                @endif
                            </div>
                        </div>
                        @endif

                        <div class="col-md-12">
                            <div class="table-responsive m-t-40" style="clear: both;">
                                <table class="table table-hover re_table">
                                    <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th class="text-center">Description</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Subtotal</th>


                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><a href="{{url('packagesdetail/'.$search->getPackageDealsOrderDetail->id.'/'.$search->getPackageDealsOrderDetail->package_deals_name)}}" target="_blank">{{$search->getPackageDealsOrderDetail->package_deals_name??''}}</a></td>
                                        <td> <div class="content">{!! $search->getPackageDealsOrderDetail->package_deals_desc??'' !!}</div></td>
                                        <td> $ {{ number_format($search->getPackageDealsOrderDetail->price,2)}}</td>
                                        <td>{{ $search->qty??''}}</td>
                                        <td> $ {{ number_format($search->getPackageDealsOrderDetail->price*$search->qty,2)}}</td>
                                    </tr>
                                    @if($search->package_donation >= 1)
                                    <tr>
                                        <td>Donation to {{$search->donation_shrine_name??''}}</td>
                                        <td>Package donations</td>

                                        <td> $ {{ number_format($search->package_donation_amount??'',2)}}</td>
                                        <td>-</td>
                                        <td>$ {{ number_format($search->package_donation_amount??'',2)}}</td>
                                    </tr>
                                    @endif
                                    @if($search->package_insurance>=1)
                                    <tr>
                                        <td>Medical Insurance for <b>{{$search->qty??''}} visitors</b></td>
                                        <td> Medical Insurance</td>
                                        <td> $ 10.00</td>
                                        <td>{{ $search->qty??''}}</td>
                                        <td>$ {{ number_format($search->qty*10,2)}}</td>
                                    </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <hr>

                        <div class="col-md-12">
                            <div class="pull-right m-t-30 text-right">
                                @if($search->package_insurance>=1)
                                    <p><b>Subtotal : </b>$ {{ number_format(($search->getPackageDealsOrderDetail->price*$search->qty)+($search->qty*10)+$search->package_donation_amount,2)}}</p>
                                    <p><b> Tax : </b>$ 25.00</p>
                                    <hr>
                                    <p><b>Total : </b>$ {{ number_format(($search->getPackageDealsOrderDetail->price*$search->qty)+($search->qty*10)+$search->package_donation_amount+25,2)}}</p>
                                @else
                                    <p><b>Subtotal : </b>${{ number_format(($search->getPackageDealsOrderDetail->price*$search->qty)+$search->package_donation_amount,2)}}</p>
                                    <p><b> Tax : </b>$ 25.00</p>
                                    <hr>
                                    <p><b>Total : </b>$ {{ number_format(($search->getPackageDealsOrderDetail->price*$search->qty)+$search->package_donation_amount+25,2)}}</p>
                                @endif
                            </div>
                        </div>
                        <div class="text-left">
                            <p><b>Special Request - </b><span>{{$search->notes_by_customer??''}}</span></p>
                            <p><b>Confirmation Policy –</b><span> This booking is subjected to confirmation from hotel. Typically it takes 1-2 business days for confirmation.</span></p>
                            <b>Cancelations, No Show Policy :</b>
                            <p> •	When your travel plans change, your reservation can too.</p>
                            <p> •	There are no fees to cancel reservations. However it has to be done 10 days before service day of the receipt - <b>({{\Carbon\Carbon::parse( $reservationStartDate??'')->toFormattedDateString()}})</b>Contact Alzuwar.com team for any assistance.</p>
                            <p> •	We recommend customers and service provider contact each other ahead of time to confirm plans.</p>
                            <p> •	No Shows – If service provider (<b>{{$search->getPackageDealsOrderDetail->getPackageUser->name??'Not Available'}}</b>) did not show up or honor the bookings then customer (<b>{{$search->getUserDetail->name??''}}</b>) should contact alzuwar.com team immediately to provide another alternative service provider.</p>
                            <p> •	No Shows – If customer (<b>{{$search->getUserDetail->name??''}}</b>) did not show up at place of contact then service provider (<b>{{$search->getPackageDealsOrderDetail->getPackageUser->name??'Not Available'}}</b>) should call alzuwar.com team immediately to notify.</p>
                            <b>House Rules:</b>
                            <p>{!!$search->getPackageDealsOrderDetail->house_rules??''!!}</p>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        @if (!auth()->user()->hasrole('customer'))
                        <div class="text-right">
                            <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                        </div>
                        @endif
                    </div>
                    {{--</div>--}}
                </div>

            </div>
        </div>
        @if (!auth()->user()->hasrole('customer'))
        @include('layouts.partials.right-sidebar')
            @endif
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
        console.log(id);
        swal({
            title: "Are you sure?",
            text: "Do you really want to change the status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
                .then((willDelete) => {
            if (willDelete) {

                $.get('{{ URL::to("packages_reservation_status")}}/'+id+'/'+status+'/'+value,function(data){
                    console.log(data);
                    window.location.reload();
//                    $('#reject_reservation').hide();
//                    $('#reject_reservation').css('display', 'none');
//                    $('#accept_reservation').hide();
//                    $('#accept_reservation').css('display', 'none');
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
                $.get('{{ URL::to("packages_reservation_status")}}/'+id+'/'+status+'/'+value,function(data){
                    window.location.reload();
//                    $('#reject_reservation').hide();
//                    $('#reject_reservation').css('display', 'none');
//                    $('#accept_reservation').hide();
//                    $('#accept_reservation').css('display', 'none');
                });
                swal("Your user status has been updated!", {
                    icon: "success",

                });
            } else {
                swal("Your user status has not changed!");
    }
    });
    }

    $("accept_reservation").on('click',function() {
        $(this).hide();
        this.style.display = 'none'
        $('#reject_reservation').hide();
        $('#reject_reservation').css('display', 'none');
    });
    $("#reject_reservation").on('click',function() {
        $(this).hide();
        this.style.display = 'none'
        $('#accept_reservation').hide();
        $('#accept_reservation').css('display', 'none');
    });

    function paymentstatus(id, status) {
        swal("Write something here:", {
            content: "input",
        })
                .then((value) => {
            if (value) {
                $.get('{{ URL::to("packages_mypayment_status")}}/'+id+'/'+status+'/'+value,function(data){
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

