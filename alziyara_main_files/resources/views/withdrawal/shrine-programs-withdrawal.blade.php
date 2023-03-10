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
                            <input type="hidden" name="category_id" class="form-control" id="category_id" value="4">
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
                    <h3 class="box-title pull-left">Sales - Shrine Programs</h3>
                    <div class="pull-right">
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                {{--<h3 class="box-title m-b-0">My Guests Passes Reservations</h3>--}}
                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                    <div class="clearfix"></div>
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
{{--                                @if(Auth::user()->hasRole('GuestsPassAdmin'))--}}
                                    <th class="text-center">Withdraw</th>
                                {{--@endif--}}
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
<!--                            --><?// echo $guestpassreserves; ?>
                            <?php $sno = 1; ?>
                            @foreach($guestpassreserves as $key => $myguestpass)
{{--                                @if(isset($myguestpass->getGuestPassOrders))--}}
                                    <tr>
                                        <td>{{$sno++}}</td>
                                        <td class="receipt_num">{{$myguestpass->ReceiptNum}}</td>
                                        <td>{{ \Carbon\Carbon::parse( $item->created_at??'' )->toDayDateTimeString() }}</td>

                                        <td>
                                            {{$myguestpass->getGuestPassOrdersbyusersupadmin->name??''}}
                                            <br>
                                            {{$myguestpass->getGuestPassOrdersbyusersupadmin->email??''}}
                                        </td>
                                        <td>
                                            {{$myguestpass->getcustomerorder->getGuestPassUser->name??''}}
                                            <br>
                                            {{$myguestpass->getcustomerorder->getGuestPassUser->email??''}}
                                        </td>
                                        <td>{{\Carbon\Carbon::parse( $myguestpass->ReservationForDate??'' )->toFormattedDateString()}}</td>
                                        <?php
                                        if(($myguestpass->Insurance == 1) && ($myguestpass->Donation == 0)){
                                            $finalprice = 0;
                                            $finalprice = $myguestpass->TotalPrice - 10;
                                        }elseif(($myguestpass->Donation == 1) && ($myguestpass->Insurance == 0)){
                                            $finalprice = 0;
                                            $finalprice = $myguestpass->TotalPrice - $myguestpass->Donation_amount;
                                        }elseif(($myguestpass->Insurance == 1) && ($myguestpass->Insurance == 1) ){
                                            $finalprice = 0;
                                            $finalprice = $myguestpass->TotalPrice - $myguestpass->Donation_amount - 10;
                                        }else{
                                            $finalprice = 0;
                                            $finalprice = $myguestpass->TotalPrice;
                                        }
                                        ?>
                                        <td>${{number_format($myguestpass->TotalPrice??'0',2, '.', ',')}}</td>
                                        <td>{{number_format($finalprice/100*80??'0',2, '.', ',')}}</td>
                                        <td>{{number_format($finalprice/100*20??'0',2, '.', ',')}}</td>
                                        <td>
                                            @if ($myguestpass->PaymentStatus == 'PAID')
                                                <span class='badge badge-success badge-sm' style='cursor:pointer'>PAID</span>
                                            @else
                                                <span class='badge badge-danger badge-sm' style='cursor:pointer'>UNPAID<span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                @if ($myguestpass->BookingStatus == 'PENDING')
                                                    <span class='badge badge-alert badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown">PENDING</span>
                                                    <div class="dropdown-menu">
                                                        <li>
                                                            <a class="dropdown-item" id="accept_reservation" onclick="acceptstatus({{$myguestpass->ReservationID}},'CONFIRMED')" >CONFIRM</a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item" id="reject_reservation" onclick="rejectstatus({{$myguestpass->ReservationID}},'CANCELLED')">CANCEL</a>
                                                        </li>
                                                    </div>
                                                @elseif($myguestpass->BookingStatus  == 'CANCELLED')
                                                    <label class='badge badge-danger badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown" for="cancel"> CANCELLED</label>
                                                    <div class="dropdown-menu" id="cancel">
                                                        <li>
                                                            <a class="dropdown-item" id="accept_reservation" onclick="acceptstatus({{$myguestpass->ReservationID}},'CONFIRMED')"  >CONFIRM</a>
                                                        </li>
                                                    </div>
                                                @else
                                                    <span class='badge badge-success badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown">CONFIRMED<span>
                                                @endif

                                            </div>
                                        </td>
                                        {{--@if(Auth::user()->hasRole('GuestsPassAdmin'))--}}
                                            <td class="text-center">
                                                @if(is_null($myguestpass->withdraw) && $myguestpass->request_refund === "" && $myguestpass->BookingStatus == 'CONFIRMED' && $myguestpass->PaymentStatus == 'PAID')
                                                <a type="button" class="text-center" href="{{ url('withdraw-request/4/'.$myguestpass->ReceiptNum??'') }}">Withdraw ${{number_format($myguestpass->TotalPrice/100*80??'0',2, '.', ',')}}</a>
                                                @elseif($myguestpass->withdraw === 0)
                                                    <p class="text-center">Requested for Withdrawal</p>
                                                    @if(Auth::user()->hasRole('SuperAdmin'))
                                                        <button type="button" title="Reject Withdraw Request" class="btn btn-danger reject_withdraw_request" data-toggle="modal"><i class="fa fa-close"></i>Decline</button>
                                                        <button type="button" title="Accept Withdraw Request" class="btn btn-success accept_withdraw_request" data-toggle="modal"><i class="fa fa-check"></i></button>Accept
                                                    @endif
                                                @elseif($myguestpass->withdraw == 1)
                                                <p class="text-center text-success">Withdrawed</p>
                                                <i class="fa fa-comment fa-2x text-success withdrawComment" data-toggle="modal"></i>
                                                @elseif($myguestpass->withdraw == 2)
                                                <p class="text-center text-danger">Rejected Request</p>
                                                <i class="fa fa-comment fa-2x text-danger withdrawComment" data-toggle="modal"></i>
                                                @endif
                                            </td>
                                            {{--@endif--}}
                                            <td>
                                                {{--<a type="button" href="{{route('guestsreverses',$myguestpass->ReceiptNum)}}"--}}

                                                       {{--class="btn btn-warning btn-s add-tooltip"><i class="fa fa-eye"></i></a>--}}
                                                <a href="{{ url('guestpass_invoice/' .$myguestpass->ReservationID??'') }}"
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

        $('#myTable').DataTable();
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
        $( ".withdrawComment" ).click(function() {
            var $item = $(this).closest("tr").find(".receipt_num").text();
            $('.withdraw-request-comment').empty();
            $.get('{{ URL::to("get-withdraw-request-comment")}}/4/'+$item,function(data){
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