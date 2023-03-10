@extends('layouts.master')
@push('css')
<!-- <link href="{{ asset('plugins/components/dashboard/css/customstyle.css') }}" rel="stylesheet" /> -->
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
@endpush
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('message'))
        <!-- <div class="account-title">{{session('message')}}</div> -->
        <div class="account-title">
            <p class="alert alert-success">{{session('message')}}</p>
        </div>
    @endif
    {{--<div class="container-fluid">--}}
        {{--<div class="row colorbox-group-widget">--}}
            {{--<div class="col-md-3 col-sm-6 info-color-box">--}}
                {{--<div class="white-box">--}}
                    {{--<div class="media bg-primary">--}}
                        {{--<div class="media-body">--}}
                            {{--<h3 class="info-count">${{$RuningTotal??0}}<span class="pull-right"><i class="mdi mdi-coin"></i></span></h3>--}}
                            {{--<p class="info-text font-12">Running Total</p>--}}
                            {{--<p class="info-ot font-15">Pending<span class="label label-rounded"></span></p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-3 col-sm-6 info-color-box">--}}
                {{--<div class="white-box">--}}
                    {{--<div class="media bg-success">--}}
                        {{--<div class="media-body">--}}
                            {{--<h3 class="info-count">{{$totalSales??0}}<span class="pull-right"><i class="mdi mdi-comment-text-outline"></i></span></h3>--}}
                            {{--<p class="info-text font-12">Total Sales</p>--}}
                            {{--<p class="info-ot font-15">Closed<span class="label label-rounded">0</span></p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
    <div class="modal fade" id="withdrawComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Comment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center withdraw-request-comment">Comment...</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    @if(Auth::user()->hasRole('SuperAdmin'))
        <div class="modal fade" id="accept_or_reject_withdraw_request" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="withdrawRequestTitle">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{route('withdraw-request-accept-reject')}}">
                            @csrf()
                            <input type="hidden" name="category_id" class="form-control" id="category_id" value="3">
                            <div class="form-group">
                                <label for="receipt_number" class="col-form-label">Receipt:</label>
                                <input type="text"   name="ReceiptNum" class="form-control" id="receipt_number" readonly>
                                <input type="hidden" name="withdraw" class="form-control" id="withdraw_request_condition">
                            </div>

                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Comment:</label>
                                <textarea name="withdraw_super_admin_comment" class="form-control" id="withdraw_super_admin_comment" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" id="withdrawRequestButton"></button>
                        </form>
                    </div>
                    {{--<div class="modal-footer">--}}
                    {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    @endif
    <div class="container-fluid">

        <!-- .row -->

        <div class="row">

            <div class="col-sm-12">

                <div class="white-box sales_chart_border">
                    <h3 class="box-title pull-left">Withdrawal Request - Transportation</h3>
                    <div class="pull-right">
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                {{--<h3 class="box-title m-b-0">My Transport Reservations</h3>--}}

                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                    {{--<div class="clearfix"></div>--}}
                    {{--<hr>--}}
                    <div class="table-responsive">
                        <table id="myTable" class="table table-striped" style="width:100%">

                            <thead>

                            <tr>

                                <th>S.No</th>
                                <th>Receipt Number</th>
                                <th>Ordered On</th>
                                <th>Customer</th>
                                <th>Service Provider</th>
                                <th>Service End Date</th>
                                <th>Cust Paid</th>
                                <th>SP Earning</th>
                                <th>App Fee</th>
                                <th>Payment Status</th>
                                <th>Booking Status</th>
                                {{--@if(Auth::user()->hasRole('TransportAdmin'))--}}
                                    <th class="text-center">Withdraw</th>
                                {{--@endif--}}
                                <th>Actions</th>
                            </tr>

                            </thead>

                            <tbody>
                            <?php $sno = 1; ?>
                            @foreach($transportreserves as $key => $mytransport)
{{--                                @if(isset($mytransport->getTransportOrderssupadmin))--}}
                                    <tr>
                                        <td>{{$sno++}}</td>
                                        <td class="receipt_num">{{$mytransport->ReceiptNum}}</td>
                                        <td>{{ \Carbon\Carbon::parse( $mytransport->created_at??'' )->toDayDateTimeString() }}</td>
                                        <td>
                                            {{$mytransport->getTransportOrdersbyusersupadmin->name??''}}
                                            <br>
                                            {{$mytransport->getTransportOrdersbyusersupadmin->email??''}}
                                        </td>
                                        <td>
                                            {{$mytransport->getTransportOrderssupadmin->getTransportuser->name??''}}
                                            <br>
                                            {{$mytransport->getTransportOrderssupadmin->getTransportuser->email??''}}
                                        </td>
                                        <td>{{\Carbon\Carbon::parse( $mytransport->DropOffDateTime??'' )->toFormattedDateString()}}</td>
                                        <?php
                                        if(($mytransport->Insurance == 1) && ($mytransport->Donation == 0)){
                                            $finalprice = 0;
                                            $finalprice = $mytransport->TotalPrice - 10;
                                        }elseif(($mytransport->Donation == 1) && ($mytransport->Insurance == 0)){
                                            $finalprice = 0;
                                            $finalprice = $mytransport->TotalPrice - $mytransport->Donation_amount;
                                        }elseif(($mytransport->Insurance == 1) && ($mytransport->Insurance == 1) ){
                                            $finalprice = 0;
                                            $finalprice = $mytransport->TotalPrice - $mytransport->Donation_amount - 10;
                                        }else{
                                            $finalprice = 0;
                                            $finalprice = $mytransport->TotalPrice;
                                        }
                                        $myjourneyarray = array($mytransport->PickupLocation,$mytransport->DropOffLocation);
                                        $myjourney = implode('to',$myjourneyarray);
                                        ?>
                                        <td>${{number_format($finalprice??'0',2, '.', ',')}}</td>
                                        <td>${{number_format($finalprice/100*80??'0',2, '.', ',')}}</td>
                                        <td>${{number_format($finalprice/100*20??'0',2, '.', ',')}}</td>
                                        <td>
                                            @if ($mytransport->PaymentStatus == 'PAID')
                                                <span class='badge badge-success badge-sm' style='cursor:pointer'>PAID</span>
                                            @else
                                                <span class='badge badge-danger badge-sm' style='cursor:pointer'>UNPAID<span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                @if ($mytransport->BookingStatus == 'PENDING')
                                                    <span class='badge badge-alert badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown">PENDING</span>
                                                    <div class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" id="accept_reservation" onclick="acceptstatus({{$mytransport->ReservationID}},'CONFIRMED')" >CONFIRM</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" id="reject_reservation" onclick="rejectstatus({{$mytransport->ReservationID}},'CANCELLED')">CANCEL</a>
                                                        </li>
                                                    </div>
                                                @elseif($mytransport->BookingStatus == 'CANCELLED')
                                                    <label class='badge badge-danger badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown" for="cancel"> CANCELLED</label>
                                                    <div class="dropdown-menu" id="cancel">
                                                        <li>
                                                            <a class="dropdown-item" id="accept_reservation" onclick="acceptstatus({{$mytransport->ReservationID}},'CONFIRMED')"  >CONFIRM</a>
                                                        </li>
                                                    </div>
                                                @else
                                                    <span class='badge badge-success badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown">CONFIRMED</span>
                                                @endif
                                            </div>
                                        </td>
                                        {{--@if(Auth::user()->hasRole('TransportAdmin'))--}}
                                            <td class="text-center">
                                                @if(is_null($mytransport->withdraw) && is_null($mytransport->request_refund) && $mytransport->BookingStatus == 'CONFIRMED' && $mytransport->PaymentStatus == 'PAID')
                                                    <a type="button" class="text-center" href="{{ url('withdraw-request/3/'.$mytransport->ReceiptNum??'') }}">Withdraw ${{number_format($mytransport->TotalPrice/100*80??'0',2, '.', ',')}}</a>
                                                @elseif($mytransport->withdraw === 0)
                                                    <p class="text-center">Requested for Withdrawal</p>
                                                    @if(Auth::user()->hasRole('SuperAdmin'))
                                                        <button type="button" title="Reject Withdraw Request" class="btn btn-danger reject_withdraw_request" data-toggle="modal"><i class="fa fa-close"></i>Decline</button>
                                                        <button type="button" title="Accept Withdraw Request" class="btn btn-success accept_withdraw_request" data-toggle="modal"><i class="fa fa-check"></i>Accept</button>
                                                    @endif
                                                @elseif($mytransport->withdraw == 1)
                                                    <p class="text-center text-success">Withdrawed</p>
                                                    <i class="fa fa-comment fa-2x text-success withdrawComment" data-toggle="modal"></i>
                                                @elseif($mytransport->withdraw == 2)
                                                    <p class="text-center text-danger">Rejected Request</p>
                                                    <i class="fa fa-comment fa-2x text-danger withdrawComment" data-toggle="modal"></i>
                                                @endif
                                            </td>
                                        {{--@endif--}}
                                        <td>
                                            {{--<a type="button" href="{{route('transportreservesadmin',$mytransport->ReceiptNum)}}"--}}

                                            {{--class="btn btn-warning btn-s add-tooltip"><i class="fa fa-eye"></i></a>--}}
                                            <a href="{{ url('transport_invoice/' . $mytransport->ReservationID??'') }}"
                                               title="Order Details">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Order Details
                                                </button>
                                            </a>
                                        </td>

                                    </tr>

                                {{--@endif--}}

                            @endforeach

                            </tbody>

                        </table>


                    </div>
                </div>

            </div>

        </div>


        <!-- ===== Right-Sidebar ===== -->

        @include('layouts.partials.right-sidebar')

    </div>

@endsection



@push('js')



<script>

    $('#myTable').DataTable({
//	"scrollX": true
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
                $.get('{{ URL::to("transport_reservation_status")}}/'+id+'/'+status+'/'+value,function(data){
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
                $.get('{{ URL::to("transport_reservation_status")}}/'+id+'/'+status+'/'+value,function(data){
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
    $( ".withdrawComment" ).click(function() {
        var $item = $(this).closest("tr").find(".receipt_num").text();
        $('.withdraw-request-comment').empty();
        $.get('{{ URL::to("get-withdraw-request-comment")}}/3/'+$item,function(data){
            $('.withdraw-request-comment').text(data);
            $('#withdrawComment').modal('show')
        });
    });
    @if(Auth::user()->hasRole('SuperAdmin'))
        $( ".reject_withdraw_request" ).click(function() {
            var $item = $(this).closest("tr").find(".receipt_num").text();
            $('#withdrawRequestTitle').text('Reject Request');
            $('#withdrawRequestButton').text('Reject Withdraw Request');
            $('#receipt_number').val($item);
            $('#withdraw_request_condition').val(2);
            $('#accept_or_reject_withdraw_request').modal('show');
        });
        $( ".accept_withdraw_request" ).click(function() {
            var $item = $(this).closest("tr").find(".receipt_num").text();
            $('#withdrawRequestTitle').text('Accept Request');
            $('#withdrawRequestButton').text('Accept Withdraw Request');
            $('#receipt_number').val($item);
            $('#withdraw_request_condition').val(1);
            $('#accept_or_reject_withdraw_request').modal('show');
        });
    @endif

</script>

@endpush