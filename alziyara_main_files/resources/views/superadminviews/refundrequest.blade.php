@extends('layouts.master')



@push('css')
<style>
table.table{
    display:block;
}
</style>
@endpush



@section('content')



	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <!-- <link href="{{ asset('plugins/components/dashboard/css/customstyle.css') }}" rel="stylesheet" /> -->
    <link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
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

    <?php
	
		/*

		$insurancecount = 0;
		$donationcount = 0;
		$donationamount = 0;
		$myfinalprice = 0;
		$insuranceamount = 0;
		$allfinal = 0;
		$myallfinalprice = 0;

    ?>


	@foreach($roomreservestatus as $key => $myroomgroup)


		@if(isset($myroomgroup->getReservationOrdersroom))

            <?php


            if(($myroomgroup->Insurance == 1) && ($myroomgroup->Donation == 0)){

                $myfinalprice = 0;

                $myfinalprice = $myroomgroup->TotalPrice - 10;

            }elseif(($myroomgroup->Donation == 1) && ($myroomgroup->Insurance == 0)){

                $myfinalprice = 0;

                $myfinalprice = $myroomgroup->TotalPrice - $myroomgroup->Donation_amount;

            }elseif(($myroomgroup->Insurance == 1) && ($myroomgroup->Insurance == 1) ){

                $myfinalprice = 0;

                $myfinalprice = $myroomgroup->TotalPrice - $myroomgroup->Donation_amount - 10;

            }else{

                $myfinalprice = 0;

                $myfinalprice = $myroomgroup->TotalPrice;

            }


            $allfinal += $myroomgroup->TotalPrice;


            if($myfinalprice){

                $myallfinalprice += $myfinalprice;

            }

            if($myroomgroup->Insurance == 1){

                $insurancecount++;

                $insuranceamount += 10;

            }


            if($myroomgroup->Donation == 1){

                $donationcount++;

                $donationamount += $myroomgroup->Donation_amount;

            }
			
			

            // $myjourneyarray = array($mytransport->PickupLocation,$mytransport->DropOffLocation);

            // $myjourney = implode('to',$myjourneyarray);

            ?>



		@endif

	@endforeach
	
	<?php */ ?>


	<div class="container-fluid">
        <div class="row colorbox-group-widget ">
            {{--<div class="col-md-2 col-sm-6 info-color-box dynamic_boxes">--}}
                {{--<div class="white-box">--}}
                    {{--<div class="media bg-primary">--}}
                        {{--<div class="media-body">--}}
                            {{--<h3 class="info-count">${{$totalSales??0}}<span class="pull-right"><i class="mdi mdi-comment-text-outline"></i></span></h3>--}}
                            {{--<p class="info-text font-12">Total Sales</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="col-md-2 col-sm-6 info-color-box dynamic_boxes">--}}
                {{--<div class="white-box">--}}
                    {{--<div class="media bg-success">--}}
                        {{--<div class="media-body">--}}
                            {{--<h3 class="info-count">${{$spEarning??0}}<span class="pull-right"><i class="mdi mdi-coin"></i></span></h3>--}}
                            {{--<p class="info-text font-12">Total SP Earning</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <div class="col-lg-4 col-md-6 col-sm-6 info-color-box dynamic_boxes">
                    <div class="white-box">
                        <div class="media bg-danger">
                            <div class="media-body">
                            <h3 class="info-count">$@convert($refundRequest??0) <span class="pull-right"><i class="mdi mdi-medical-bag"></i></span></h3>
                                <p class="info-text font-12">Refunds Requested</p>
								<!--<p class="info-ot font-15">Pending<span class="label label-rounded">0</span></p>-->
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-lg-4 col-md-6 col-sm-6 info-color-box dynamic_boxes">
                    <div class="white-box">
                        <div class="media bg-warning">
                            <div class="media-body">
                            <h3 class="info-count">$@convert($issuedRefund??0) <span class="pull-right"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span></h3>
                                <p class="info-text font-12">Refunds Issued</p>
								<!--<p class="info-ot font-15">Limit<span class="label label-rounded">0</span></p>-->
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-lg-4 col-md-6 col-sm-6 info-color-box dynamic_boxes">
                    <div class="white-box">
                        <div class="media bg-primary">
                            <div class="media-body">
                            <h3 class="info-count">$@convert($CancelledRefund??0) <span class="pull-right"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span></h3>
                                <p class="info-text font-12">Refunds Denied</p>
                                <!--<p class="info-ot font-15">Limit<span class="label label-rounded">0</span></p>-->
                            </div>
                        </div>
                    </div>
                </div>
        </div>

	</div>
	<div class="container-fluid">
		<!-- .row -->
		<div class="row">
			<div class="col-sm-12">

				<div class="white-box sales_chart_border">

					<h3 class="box-title pull-left">Sales - Refund Requests</h3>
                    <div class="pull-right">
                        <form method="post" action="{{route('search_refund_request_by_date')}}" class="form-inline" role="form">
                            @csrf
                                <div class="row form_custom">
                                    <div class="col-md-4 offset-md-2">
                            <div class="form-group">
                                <label for="date_from">Date from</label>
                                            <input type="date" class="form-control input-lg input-search" id="date_from" name="date_from">
                            </div>
                                    </div>
                                    <div class="col-md-4">
                            <div class="form-group">
                                <label for="date_to">Date to</label>
                                            <input type="date" class="form-control input-lg input-search" id="date_to" name="date_to">
                            </div>
                                    </div>
                                    <div class="col-md-2">
                            <button type="submit" id="submit" class="btn btn-info">Filter</button>
                                    <a href="{{url('allrefundrequests')}}">Reset</a>
                                    </div>
                                </div>



                        </form>
                    </div>
					<div class="clearfix"></div>
					<hr>
					<div class="table-responsive">
						<!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
					</div>
					<section class="cart_s1">
						<div class="container">
							<table id="refundrequest" class="table table-hover table-condensed">
								<thead>
									<tr>
                                    <th>S.No</th>
                                    <th>Recipt No</th>
                                    <th>Refund Requested On</th>
                                    <th>Product</th>
                                    {{--<th>Product Image</th>--}}
                                    <th>Customer</th>
                                    <th>Service Provider</th>
                                    <th>Order Placed On</th>
                                    <th>Cust Paid</th>
                                    <th>SP Earning</th>
                                    <th>App Fee</th>
                                    <th>Donation</th>
                                    {{--<th>Insurance</th>--}}
                                    <th>Payment Status</th>
                                    <th>Booking Status</th>
                                    <th>Customer Notes</th>
                                    <th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php $a = 1; ?>

									@if(isset($customerrefundrequests))
										@foreach($customerrefundrequests as $mybooking)
												<tr>
													<td>{{ $a++ }}</td>
													<td data-th="receipt_no" class="receipt_no"><p>{{$mybooking['reciptno']}}</p></td>
                                            <td data-th="refund_requested_on" class="refund_requested_on text-center"><p>@if(empty($mybooking['request_refund_date'])) - @else {{ \Carbon\Carbon::parse( $mybooking['request_refund_date']??'' )->toFormattedDateString() }} @endif</p></td>
                                            <td data-th="product_name" class="product_name"><p>{{$mybooking['name']??'-'}}</p></td>
                                            {{--<td data-th="Product" class="Product"><img src="{{asset('website').'/'.$mybooking['image']}}" alt="..." class="img-responsive"></td>--}}
                                            <td data-th="customer" class="customer">{{$mybooking['customer']??'-'}}</td>
                                            <td data-th="service_provider" class="service_provider">{{$mybooking['service_provider']??'-'}}</td>
                                            <td data-th="order_placed_on" class="order_placed_on"><p>{{ \Carbon\Carbon::parse( $mybooking['created_at']??'' )->toFormattedDateString() }}</p></td>
                                            <td data-th="customer_paid" class="customer_paid"><p>$ @convert($mybooking['price']??'-')</p></td>

                                            <td data-th="sp_earning" class="sp_earning">$ @convert((($mybooking['price']-($mybooking['insurance']*10+$mybooking['donation_amount']))*0.8)??'-')</td>
                                            <td data-th="app_fee" class="app_fee">$ @convert((($mybooking['price']-($mybooking['insurance']*10+$mybooking['donation_amount']))*0.2)??'-')</td>
                                            <td data-th="donation" class="donation">$ @convert($mybooking['donation_amount']??'-')</td>
                                            {{--<td data-th="insurance" class="insurance">$ @convert($mybooking['insurance']??'-')</td>--}}
                                            <td data-th="payment_status" class="payment_status">@if($mybooking['paymentstatus'] == "PAID") <p> Received </p> @else <p> Not Received </p> @endif</td>
                                            <td data-th="booking_status" class="booking_status"><p>{{$mybooking['bookingstatus']??'-'}}</p></td>
                                            <td data-th="customer_notes" class="customer_notes"><p>{{$mybooking['request_refund']??'-'}}</p></td>
                                            <td class="text-center">
														@can('delete-'.str_slug('Search'))
														<a href="{{$mybooking['route']}}"
														   title="Order Details">
															<button class="btn btn-primary btn-sm">
																<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Order Details
															</button>
														</a>
                                                        @endcan
														@if(!$mybooking['request_refund'] == '')
                                                            @if($mybooking['request_refund'] != '' &&  $mybooking['request_refund_reply'] == '')
                                                        <br><a class="refund_request" value="{{ $mybooking['reciptno']}}" attr="{{ $mybooking['request_refund']??''}}" category_id="{{$mybooking['category_id']??''}}">Refund Requested</a>
																{{--<a style="color: #00AEEF" data-toggle="modal" data-target="#exampleModalLong" id="request_refund" attr="{{$item->id}} ">
																	Request Ref
																</a>--}}
                                                            @elseif(isset($mybooking['request_refund']) &&  $mybooking['request_refund_reply']== 'REFUNDED')
                                                                <p style="color:green;" >
                                                                    Refund Issued
                                                                </p>
                                                            @elseif(isset($mybooking['request_refund']) &&  $mybooking['request_refund_reply'] == 'CANCELLED')
                                                                <p style="color:red" >
                                                            {{--Cancelled--}}
                                                            Refund Denied
                                                                </p>
                                                            @endif
                                                        @endif
													</td>
													{{--<td class="actions" data-th="">--}}
													{{--<a type="button" href="{{$mybooking['route']}}"	class="btn btn-warning btn-md add-tooltip"><i class="fa fa-eye"></i></a>--}}
													{{--</td>--}}
												</tr>

										@endforeach
									@endif
								</tbody>
							</table>
						</div>
                        <!-- Modal -->
                        <div class="modal fade" id="refund_request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        {{--<p>Customer Name Refund Request for order</p><p id="name_modal"></p>--}}
                                        {{--<p>Customer </p>(<p id="recipt_modal"></p>)<p>Comments:</p>--}}
                                        {{--<input>--}}
                                        {{--<p>Administrator Comments:</p>--}}
                                        {{--<input>--}}
                                        {{--<p>Please select all required option to issue Refund.</p>--}}
                                        {{--<p>--}}
                                            {{--Please select all required option to issue Refund.--}}
                                            {{--	Customer has requested refund of Subtotal + TAX amount of $X.XX--}}
                                            {{--	Customer has requested refund of Donation amount of $X.XX--}}
                                            {{--	Customer has requested refund of Medical Insurance amount of $X.XX--}}
                                            {{--	I understand that the total refund requested from Customer Name is $amount (total of what customer selected to be refunded) on order PKG-334555.--}}
                                            {{--	I have contacted and verified the payment mode from Customer Name--}}
                                        {{--</p>--}}
                                        <h5 class="modal-title" id="exampleModalLongTitle">Customer Refund Request</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="refund_request_id" id="refund_request_id">
                                        <input type="hidden" name="refund_request_category_id" id="refund_request_category_id">
                                        <p name="request_refund_by_customer" id="request_refund_by_customer"></p>
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-primary" id="accept_refund" onclick="acceptrefundcomment()">Approve Refund</a>
                                        <a type="button" class="btn btn-danger" id="cancel_refund" onclick="cancelrefund()">Deny Refund</a>
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
                                        <input type="hidden" name="refund_request_cancel_category_id" id="refund_request_cancel_category_id">
                                        <input type="hidden" name="refund_request_reply" id="refund_request_reply">
                                        <textarea class="form-control" rows="4" name="refund_request_comments" id="refund_request_comments"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-danger" id="cancel_refund" onclick="cancelrequest()">Submit</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="accept_refund_request_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle">Write Comments</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea class="form-control" rows="4" name="refund_request_accept_comments" id="refund_request_accept_comments"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <a type="button" class="btn btn-danger" id="cancel_refund" onclick="acceptrefund()">Submit</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
					
				</div>

			</div>

		</div>

		<!-- ===== Right-Sidebar ===== -->

		@include('layouts.partials.right-sidebar')

	</div>

@endsection



@push('js')



<script>

    $(document).ready(function() {
        var table = $('#refundrequest').DataTable({
//            aLengthMenu: [
//                    [15,25, 50,100,500, -1],
//                [15,25, 50,100,500,"All"]
//            ],
//            iDisplayLength:100,
//            stateSave: true,
//            order: [0, 'asc']

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
        // console.log(id);
        swal({
            title: "Are you sure?",
            text: "Do you really want to change the Payment status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
            if (willDelete) {

                $.get('{{ URL::to("room_mypayment_status")}}/'+id+'/'+status,function(data){
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
	
	{{--function acceptrefund() {--}}
        {{--var id = $('#refund_request_id').val();--}}
        {{--var status = 'REFUNDED';--}}
        {{--var value = 'Request Accepted';--}}
        {{--console.log(id);--}}
        {{--console.log(status);--}}
        {{--console.log(value);--}}
        {{--swal({--}}
            {{--title: "Are you sure?",--}}
            {{--text: "Do you really want to change the  status!",--}}
            {{--icon: "warning",--}}
            {{--buttons: true,--}}
            {{--dangerMode: true,--}}
        {{--})--}}
                {{--.then((willDelete) => {--}}
            {{--if (willDelete) {--}}

                {{--$.get('{{ URL::to("package_request_refund_reply")}}/'+id+'/'+status+'/'+value,function(data){--}}
                    {{--console.log(data);--}}
                    {{--window.location.reload();--}}
                {{--});--}}
                {{--swal("Your user status has been updated!", {--}}
                    {{--icon: "success",--}}

                {{--});--}}
            {{--}else {--}}
                {{--swal("Your user status has not changed!");--}}
    {{--}--}}
    {{--});--}}
    {{--}--}}
    {{--function cancelrequest() {--}}
        {{--var id = $('#refund_request_id_cancel').val();--}}
        {{--var status = 'CANCELLED';--}}
        {{--var value = $('#refund_request_comments').val();--}}
        {{--console.log(id);--}}
        {{--console.log(status);--}}
        {{--console.log(value);--}}

        {{--$.get('{{ URL::to("package_request_refund_reply")}}/'+id+'/'+status+'/'+value,function(data){--}}
            {{--window.location.reload();--}}
            {{--console.log(data);--}}
        {{--});--}}
        {{--swal("Your user status has been updated!", {--}}
            {{--icon: "success",--}}

        {{--});--}}

    {{--};--}}

    {{--function cancelrefund() {--}}
        {{--$('#cancel_refund_request_modal').modal('show');--}}
    {{--}--}}

    //Request Refund
    $(".refund_request").click(function(e){
        e.preventDefault();
        var id = $(this).attr('value');
        var request_refund = $(this).attr('attr');
        var category_id = $(this).attr('category_id');
        var product_name = $(this).closest("tr").find(".product_name").text();
        var receipt_no = $(this).closest("tr").find(".receipt_no").text();
        $('#name_modal').text(product_name);
        $('#recipt_modal').text(receipt_no);
        $('#request_refund_by_customer').text(request_refund);
        $('#refund_request_category_id').val(category_id);
        $('#refund_request_id').val(id);
        $('#refund_request_id_cancel').val(id);
        $('#refund_request_cancel_category_id').val(category_id);
        $('#refund_request_modal').modal('show');
    });

    function acceptrefund() {
        var receipt_num = $('#refund_request_id').val();
        var value = $('#refund_request_accept_comments').val();
        var status = 'REFUNDED';
        var category_id = $('#refund_request_cancel_category_id').val();
        $.get('{{ URL::to("request_refund_reply")}}/'+receipt_num+'/'+status+'/'+value+'/'+category_id,function(data){
            console.log(data);
            window.location.reload();
        });
        swal("Your user status has been updated!", {
            icon: "success",

        });
    }

    function cancelrequest() {
        var receipt_num = $('#refund_request_id_cancel').val();
            var status = 'CANCELLED';
        var value = $('#refund_request_comments').val();
        var category_id = $('#refund_request_cancel_category_id').val();
//        console.log(id);
//        console.log(status);
//        console.log(value);
//        console.log(category_id);
        $.get('{{ URL::to("request_refund_reply")}}/'+receipt_num+'/'+status+'/'+value+'/'+category_id,function(data){
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
    function acceptrefundcomment() {
        $('#accept_refund_request_modal').modal('show');
    }

</script>

@endpush