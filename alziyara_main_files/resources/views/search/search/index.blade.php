@extends('layouts.master')

@push('css')


<link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
<!-- <link href="{{ asset('plugins/components/dashboard/css/customstyle.css')}}" rel="stylesheet" /> -->
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
@endpush

<?php
	$insurancecount = 0;
	$donationcount = 0;
	$donationamount = 0;
	$myfinalprice = 0;
	$insuranceamount = 0;
	$allfinal = 0;
	$myallfinalprice = 0;
?>

@foreach($searchstatus as $key => $mypackagegroup)
    <?php
        if(isset($mypackagegroup->package_insurance)){
            if($mypackagegroup->package_insurance == 1){
                $insuranceamount += 10;
            }
        }
        if(isset($mypackagegroup->package_donation_amount)){
            if($mypackagegroup->package_donation_amount>0){
                $donationamount += $mypackagegroup->package_donation_amount;
            }
        }
        if(isset($mypackagegroup->total_price)){
            if($mypackagegroup->total_price>0){
                $allfinal += $mypackagegroup->total_price;
            }
        }
//        if(($mypackagegroup->package_insurance == 1) && ($mypackagegroup->package_donation == 0)){
//            $myfinalprice = 0;
//            $myfinalprice = $mypackagegroup->total_price - 10;
//        }elseif(($mypackagegroup->package_donation == 1) && ($mypackagegroup->package_insurance == 0)){
//            $myfinalprice = 0;
//            $myfinalprice = $mypackagegroup->total_price - $mypackagegroup->package_donation_amount;
//        }elseif(($mypackagegroup->package_insurance == 1) && ($mypackagegroup->package_insurance == 1) ){
//            $myfinalprice = 0;
//            $myfinalprice = $mypackagegroup->total_price - $mypackagegroup->package_donation_amount - 10;
//        }else{
//            $myfinalprice = 0;
//            $myfinalprice = $mypackagegroup->total_price;
//        }
//        $allfinal += $mypackagegroup->total_price;
//        if($myfinalprice){
//            $myallfinalprice += $myfinalprice;
//        }
//        if($mypackagegroup->package_insurance == 1){
//            $insurancecount++;
//            $insuranceamount += 10;
//        }
//        if($mypackagegroup->package_donation == 1){
//            $donationcount++;
//            $donationamount += $mypackagegroup->package_donation_amount;
//        }
    ?>
@endforeach

@section('content')

    <div class="container-fluid">
        <div class="row colorbox-group-widget">
            @if(auth()->user()->hasrole('SuperAdmin'))
                <div class="col-lg-2 col-md-4 col-sm-6 info-color-box dynamic_boxes">
                <div class="white-box">
                    <div class="media bg-primary">
                        <div class="media-body">
                                <h3 class="info-count">$@convert($mytotalprice??0)<span class="pull-right"><i class="mdi mdi-coin"></i></span></h3>
                            <p class="info-text font-12">Total Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-lg-2 col-md-4 col-sm-6 info-color-box dynamic_boxes">
                <div class="white-box">
                    <div class="media bg-success">
                        <div class="media-body">
                            <h3 class="info-count">{{$bookings??0}}<span class="pull-right"><i class="mdi mdi-comment-text-outline"></i></span></h3>
                            <p class="info-text font-12">Number of Boookings</p>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-lg-2 col-md-4 col-sm-6 info-color-box dynamic_boxes">
                <div class="white-box">
                    <div class="media bg-danger">
                        <div class="media-body">
                            <h3 class="info-count">${{$spEarning??0}} <span class="pull-right"><i class="mdi mdi-medical-bag"></i></span></h3>
                            <p class="info-text font-12">Service Provider Earning</p>
                        </div>
                    </div>
                </div>
            </div>

                <div class="col-lg-2 col-md-4 col-sm-6 info-color-box dynamic_boxes">
                <div class="white-box">
                    <div class="media bg-warning">
                        <div class="media-body">
                            <h3 class="info-count">${{$appFee??0}} <span class="pull-right"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span></h3>
                            <p class="info-text font-12">Application Fees</p>
                        </div>
                    </div>
                </div>
            </div>
                <div class="col-lg-2 col-md-4 col-sm-6 info-color-box dynamic_boxes">
                <div class="white-box">
                    <div class="media bg-success">
                        <div class="media-body">
                                <h3 class="info-count">$@convert($totalDonation->sum('package_donation_amount')??0) <span class="pull-right"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span></h3>
                            <p class="info-text font-12">Total Donations</p>
                        </div>
                    </div>
                </div>
            </div>

            @elseif(auth()->user()->hasrole('PackagesAdmin'))

                <div class="col-md-3 col-sm-6 info-color-box dynamic_boxes">
                    <div class="white-box">
                        <div class="media bg-primary">
                            <div class="media-body">
                                <h3 class="info-count">${{$mytotalprice??0}}<span class="pull-right"><i class="mdi mdi-coin"></i></span></h3>
                                <p class="info-text font-12">Total Revenue</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 info-color-box dynamic_boxes">
                    <div class="white-box">
                        <div class="media bg-success">
                            <div class="media-body">
                                <h3 class="info-count">{{$bookings??0}}<span class="pull-right"><i class="mdi mdi-comment-text-outline"></i></span></h3>
                                <p class="info-text font-12">Number of Boookings</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 info-color-box dynamic_boxes">
                    <div class="white-box">
                        <div class="media bg-danger">
                            <div class="media-body">
                                <h3 class="info-count">${{$spEarning??0}} <span class="pull-right"><i class="mdi mdi-medical-bag"></i></span></h3>
                                <p class="info-text font-12">Service Provider Earning</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 info-color-box dynamic_boxes">
                    <div class="white-box">
                        <div class="media bg-warning">
                            <div class="media-body">
                                <h3 class="info-count">${{$spEarningWithdraw??0}} <span class="pull-right"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span></h3>
                                <p class="info-text font-12">Eligible to Withdrawal</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
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
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box sales_chart_border">
                    <h3 class="box-title pull-left">Sales - Packages Deal</h3>
                    <div class="pull-right">

                    <form method="post" action="{{route('search_package_by_date')}}" class="form-inline" role="form">
                        @csrf
                            <div class="row form_custom">
                                <div class="col-md-2">
                                    <p>Filter by Order placed</p>
                                </div>
                                <div class="col-md-6">
                            <div class="form-group">
                                        <label class="" for="date_from">Date from</label>
                                <input type="date" class="form-control input-lg input-search" id="date_from" name="date_from" @if(isset($dateFrom)) value="{{$dateFrom}}" @endif>
                            </div>
                                </div>
                                <div class="col-md-6">
                        <div class="form-group">
                                        <label class="" for="date_to">Date to</label>
                            <input type="date" class="form-control input-lg input-search" id="date_to" name="date_to" @if(isset($dateTo)) value="{{$dateTo}}" @endif>
                        </div>
                                </div>
                                <div class="col-md-2">
                        <button type="submit" id="submit" class="btn btn-info">Filter</button>
                                </div>

                            </div>




                    </form>
                    </div>
                    @can('add-'.str_slug('Search'))
                    <a class="btn btn-success pull-right" href="{{ url('/search/search/create') }}"><i
                                class="icon-plus"></i> Add Search</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Receipt Num</th>
                                <th>Ordered On</th>
                                <th>Product</th>
                                <th>Customer</th>
                                <th>Service Provider</th>
                                <th>Package End Date</th>
                                <th>Cust Paid</th>
                                <th>SP Earning</th>
                                <th>App Fee</th>
                                @if(auth()->user()->hasrole('SuperAdmin'))
                                <th>Donation</th>
                                <th>Insurance</th>
                                @endif
                                <th>Payment Status</th>
                                <th>Booking Status</th>
                                @if(Auth::user()->hasRole('PackagesAdmin'))
                                    <th class="text-center">Withdraw</th>
                                @endif
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($search as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->id }}</td>
                                    <td class="receipt_num">{{ $item->receipt_num??'' }}</td>
                                    <td>{{ \Carbon\Carbon::parse( $item->created_at??'' )->toDayDateTimeString() }}</td>
                                    <td>{{ $item->getPackageDealsOrderDetail->package_deals_name??'' }}</td>
                                    <td>
                                        {{ $item->getUserDetail->name}}
                                        <br>
                                        {{ $item->getUserDetail->email??'' }}
                                    </td>
                                    <td>
                                        {{$item->getPackageDealsOrderDetail->getPackageUser->name??'' }}
                                        <br>
                                        {{$item->getPackageDealsOrderDetail->getPackageUser->email??'' }}
                                    </td>
                                    <td>{{\Carbon\Carbon::parse( $item->getPackageDealsOrderDetail->package_available_from??'' )->toFormattedDateString() }}</td>
									<?php
										if(($item->package_insurance == 1) && ($item->package_donation == 0)){
											$finalprice = 0;
											$finalprice = $item->total_price - 10;
										}elseif(($item->package_donation == 1) && ($item->package_insurance == 0)){
											$finalprice = 0;
											$finalprice = $item->total_price - $item->package_donation_amount;
										}elseif(($item->package_insurance == 1) && ($item->package_insurance == 1) ){
											$finalprice = 0;
											$finalprice = $item->total_price - $item->package_donation_amount - 10;
										}else{
											$finalprice = 0;
											$finalprice = $item->total_price;
										}
									?>
									@if(auth()->user()->hasrole('SuperAdmin'))
                                    <td>${{ number_format($item->total_price??'',2, '.', ',')}}</td>
									@else
									<td>${{ number_format($finalprice??'',2, '.', ',')}}</td>
									@endif
                                    <td>${{ number_format($finalprice/100*80??'',2, '.', ',')}}</td>
                                    <td>${{ number_format($finalprice/100*20??'',2, '.', ',')}}</td>
                                    @if(auth()->user()->hasrole('SuperAdmin'))
                                    <td>${{ number_format((float)$item->package_donation_amount??'',2, '.', ',')}}</td>
                                    <td>$ @if($item->package_insurance == 1){{number_format(10,2, '.', ',')}} @else {{number_format(0,2, '.', ',')}} @endif</td>
                                    @endif
                                    <td>

									@if($item->TypeofPayment == "cashpayment" || $item->TypeofPayment == "bankpayment" || $item->TypeofPayment == "zelle")

										<div class="dropdown">
											@if ($item->payment_status == 'PAID')
												<label class='badge badge-success badge-sm'  style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown" for="paidtoggle">PAID</label>
												<div class="dropdown-menu" id="paidtoggle">
														<li>
															<a class="dropdown-item" id="paid_status" onclick="paymentstatus({{$item->id}},'UNPAID')" >UNPAID</a>
														</li>
												</div>
											@else
												<label class='badge badge-danger badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown" for="unpaymenttoggle" >UNPAID</label>
												<div class="dropdown-menu" id="unpaymenttoggle">
														<li>
															<a class="dropdown-item" id="paid_status" onclick="paymentstatus({{$item->id}},'PAID')" >PAID</a>
														</li>
												</div>
											@endif
										</div>

									@else

                                        @if ($item->payment_status == 'PAID')
                                            <span class='badge badge-success badge-sm' style='cursor:pointer'>PAID</span>
                                        @else
                                            <span class='badge badge-danger badge-sm' style='cursor:pointer'>UNPAID<span>
                                        @endif


									@endif
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            @if ($item->booking_status == 'PENDING')
                                                <span class='badge badge-alert badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown">PENDING</span>
                                                <div class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" id="accept_reservation" onclick="acceptstatus({{$item->id}},'CONFIRMED')" >CONFIRM</a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" id="reject_reservation" onclick="rejectstatus({{$item->id}},'CANCELLED')">CANCEL</a>
                                                    </li>
                                                </div>
                                            @elseif($item->booking_status == 'CANCELLED')
                                                <label class='badge badge-danger badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown" for="cancel"> CANCELLED</label>
                                                <div class="dropdown-menu" id="cancel">
                                                    <li>
                                                        <a class="dropdown-item" id="accept_reservation" onclick="acceptstatus({{$item->id}},'CONFIRMED')"  >CONFIRM</a>
                                                    </li>
                                                </div>
                                            @elseif($item->booking_status == 'CONFIRMED')
                                            <label class='badge badge-success badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown" for="accept">CONFIRMED</label>
                                               <div class="dropdown-menu" id="accept">
                                                   <li>
                                                       <a class="dropdown-item" id="reject_reservation" onclick="rejectstatus({{$item->id}},'CANCELLED')">CANCEL</a>
                                                   </li>
                                               </div>
                                            @endif

                                        </div>

                                    </td>
                                    @if(Auth::user()->hasRole('HotelsAdmin'))
                                        <td class="text-center">
                                            @if(is_null($item->withdraw) && is_null($item->request_refund) && $item->booking_status == 'CONFIRMED' && $item->payment_status == 'PAID')
                                                <a type="button" class="text-center" href="{{ url('withdraw-request/1/'.$item->receipt_num??'') }}">Withdraw ${{number_format($finalprice/100*80??'0',2, '.', ',')}}</a>
                                            @elseif($item->withdraw === 0)
                                                <p class="text-center">Requested for Withdrawal</p>
                                            @elseif($item->withdraw == 1)
                                                <p class="text-center text-success">Withdrawed</p>
                                                <i class="fa fa-comment fa-2x text-success withdrawComment" data-toggle="modal"></i>
                                            @elseif($item->withdraw == 2)
                                                <p class="text-center text-danger">Rejected Request</p>
                                                <i class="fa fa-comment fa-2x text-danger withdrawComment" data-toggle="modal"></i>
                                            @endif
                                        </td>
                                    @endif
                                    <td>
                                        @can('edit-'.str_slug('Search'))
                                        <a href="{{ url('/search/search/' . $item->id . '/edit') }}"
                                           title="Edit Search">
                                            <button class="btn btn-primary btn-sm">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                            </button>
                                        </a>
                                        @endcan
                                                <a href="{{ url('package_deals_invoice/' . $item->id) }}"
                                                   title="Order Details">
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Order Details
                                                    </button>
                                                </a>

                                        {{--@if(!$item->request_refund == '')--}}
                                            {{--@if($item->request_refund != '' &&  $item->request_refund_reply == '')--}}
                                                {{--<a class="refund_request" value="{{ $item->id}}" attr="{{ $item->request_refund??''}}">Request Refund</a>--}}
{{--                                                <a style="color: #00AEEF" data-toggle="modal" data-target="#exampleModalLong" id="request_refund" attr="{{$item->id}} ">--}}
                                                    {{--Request Ref--}}
                                                {{--</a>--}}
                                            {{--@elseif(isset($item->request_refund) &&  $item->request_refund_reply == 'REFUNDED')--}}
                                                {{--<p style="color:green;" >--}}
                                                    {{--REFUNDED--}}
                                                {{--</p>--}}
                                            {{--@elseif(isset($item->request_refund) &&  $item->request_refund_reply == 'CANCELLED')--}}
                                                {{--<p style="color:red" >--}}
                                                    {{--Cancelled--}}
                                                {{--</p>--}}
                                            {{--@endif--}}
                                        {{--@endif--}}
                                        @if($item->request_refund_reply =='REFUNDED')
                                            <p style="color:red;" >
                                                Refunded
                                            </p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $search->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div >
</div>
    <!-- Modal -->
    <div class="modal fade" id="refund_request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Customer Refund Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="refund_request_id" id="refund_request_id">
                    <p name="request_refund_by_customer" id="request_refund_by_customer"></p>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-primary" id="accept_refund" onclick="acceptrefund()">Refund</a>
                    <a type="button" class="btn btn-danger" id="cancel_refund" onclick="cancelrefund()">Cancel</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="cancel_refund_request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Reason of Cancelation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <input type="hidden" name="refund_request_id_cancel" id="refund_request_id_cancel" >
                        <input type="hidden" name="refund_request_reply" id="refund_request_reply">
                        <textarea class="form-control" rows="4" name="refund_request_comments" id="refund_request_comments"></textarea>
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-danger" id="cancel_refund" onclick="cancelrequest()">Submit</a>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>

<script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
<!-- start - This is for export functionality only -->
<!-- end - This is for export functionality only -->
<script>
    $(document).ready(function () {

        @if(\Session::has('message'))
        $.toast({
            heading: 'Success!',
            position: 'top-center',
            text: '{{session()->get('message')}}',
            loaderBg: '#ff6849',
            icon: 'success',
            hideAfter: 3000,
            stack: 6
        });
        @endif
    })

    $(function () {
        $('#myTable').DataTable({
            scrollCollapse: true,
            responsive: true,
            'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [-1], /* 1st one, start by the right */
            }]
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

	function paymentstatus(id, status) {

		 swal("Write something here:", {
            content: "input",
        })
          .then((value) => {
            if (value) {

                $.get('{{ URL::to("packages_mypayment_status")}}/'+id+'/'+status+'/'+value,function(data){
                    window.location.reload();
//                    $('#reject_reservation').hide();
//                    $('#reject_reservation').css('display', 'none');
//                    $('#accept_reservation').hide();
//                    $('#accept_reservation').css('display', 'none');
                });
                swal("Your Payment status has been updated!", {
                    icon: "success",
                });
            } else {
                swal("Your Payment status has not changed!");
            }
        });
    }
    //Request Refund

    $(".refund_request").click(function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        var request_refund = $(this).attr('attr');
        $('#request_refund_by_customer').text(request_refund);
        $('#refund_request_id').val(id);
        $('#refund_request_id_cancel').val(id);
        $('#refund_request_modal').modal('show');
    });


    //     var id = $('#refund_request_id_cancel').val();
    //            var status = $('#refund_request_reply').val();
    //            var value = $('#refund_request_comments').val();
    //            $('#modal_for_cancel_request').attr('action','package_request_refund_reply');
    function acceptrefund() {
        var id = $('#refund_request_id').val();
        var status = 'REFUNDED';
        var value = 'Request Accepted';
        console.log(id);
        console.log(status);
        console.log(value);
        swal({
            title: "Are you sure?",
            text: "Do you really want to change the  status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
                .then((willDelete) => {
            if (willDelete) {

                $.get('{{ URL::to("package_request_refund_reply")}}/'+id+'/'+status+'/'+value,function(data){
                    console.log(data);
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
    function cancelrequest() {
        var id = $('#refund_request_id_cancel').val();
        var status = 'CANCELLED';
        var value = $('#refund_request_comments').val();
        console.log(id);
        console.log(status);
        console.log(value);

        $.get('{{ URL::to("package_request_refund_reply")}}/'+id+'/'+status+'/'+value,function(data){
            window.location.reload();
            console.log(data);
        });
        swal("Your user status has been updated!", {
            icon: "success",

        });

    };

    function cancelrefund() {
        $('#cancel_refund_request_modal').modal('show');
    }
    $( ".withdrawComment" ).click(function() {
        var $item = $(this).closest("tr").find(".receipt_num").text();
        $('.withdraw-request-comment').empty();
        $.get('{{ URL::to("get-withdraw-request-comment")}}/1/'+$item,function(data){
            $('.withdraw-request-comment').text(data);
            $('#withdrawComment').modal('show')
        });
    });
</script>

@endpush
