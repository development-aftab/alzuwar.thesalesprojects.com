@extends('layouts.master')



@push('css')

<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />

@endpush



@section('content')



	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
	<!-- <link href="{{ asset('plugins/components/dashboard/css/customstyle.css') }}" rel="stylesheet" /> -->



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


	<div class="container-fluid">
		<div class="row colorbox-group-widget">
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
							<h3 class="info-count">$@convert($totalDonation->sum('Donation_amount')??0) <span class="pull-right"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span></h3>
							<p class="info-text font-12">Total Donations</p>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>
	{{--<div class="container-fluid">--}}
		{{--<div class="row colorbox-group-widget">--}}
			{{--<div class="col-md-3 col-sm-6 info-color-box">--}}
				{{--<div class="white-box">--}}
					{{--<div class="media bg-primary">--}}
						{{--<div class="media-body">--}}
							{{--<h3 class="info-count">${{$myallfinalprice??0}}<span class="pull-right"><i class="mdi mdi-coin"></i></span></h3>--}}
							{{--<p class="info-text font-12">Running Total Amount</p>--}}
							{{--<!--<p class="info-ot font-15">Pending<span class="label label-rounded"></span></p>-->--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
			{{--<div class="col-md-3 col-sm-6 info-color-box">--}}
				{{--<div class="white-box">--}}
					{{--<div class="media bg-success">--}}
						{{--<div class="media-body">--}}
							{{--<h3 class="info-count">${{$allfinal??0}}<span class="pull-right"><i class="mdi mdi-comment-text-outline"></i></span></h3>--}}
							{{--<p class="info-text font-12">Total Sales</p>--}}
							{{--<!--<p class="info-ot font-15">Closed<span class="label label-rounded">0</span></p>-->--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</div>--}}
			{{--@if(!auth()->user()->hasrole('PackagesAdmin'))--}}
				{{--<div class="col-md-3 col-sm-6 info-color-box">--}}
					{{--<div class="white-box">--}}
						{{--<div class="media bg-danger">--}}
							{{--<div class="media-body">--}}
								{{--<h3 class="info-count">${{$donationamount??0}} <span class="pull-right"><i class="mdi mdi-medical-bag"></i></span></h3>--}}
								{{--<p class="info-text font-12">Total Donations</p>--}}
								{{--<!--<p class="info-ot font-15">Pending<span class="label label-rounded">0</span></p>-->--}}
							{{--</div>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
				{{--<div class="col-md-3 col-sm-6 info-color-box">--}}
					{{--<div class="white-box">--}}
						{{--<div class="media bg-warning">--}}
							{{--<div class="media-body">--}}
								{{--<h3 class="info-count">${{$insuranceamount??0}} <span class="pull-right"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span></h3>--}}
								{{--<p class="info-text font-12">Total Insurance</p>--}}
								{{--<!--<p class="info-ot font-15">Limit<span class="label label-rounded">0</span></p>-->--}}
							{{--</div>--}}
						{{--</div>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--@endif--}}
		{{--</div>--}}

	{{--</div>--}}
	<div class="container-fluid">

		<!-- .row -->

		<div class="row">

			<div class="col-sm-12">

				<div class="white-box sales_chart_border" >

					<h3 class="box-title pull-left">Sales - Hotel</h3>
					<div class="pull-right">
						<form method="post" action="{{route('search_room_by_date')}}" class="form-inline" role="form">
							@csrf
							<div class="row form_custom">
									<div class="col-md-4 offset-md-2">
							<div class="form-group">
											<label class="" for="date_from">Date from</label>
											<input type="date" class="form-control input-lg input-search" id="date_from" name="date_from" @if(isset($dateFrom)) value="{{$dateFrom}}" @endif>
							</div>
									</div>
									<div class="col-md-4">
							<div class="form-group">
											<label class="" for="date_to">Date to</label>
											<input type="date" class="form-control input-lg input-search" id="date_to" name="date_to" @if(isset($dateTo)) value="{{$dateTo}}" @endif>
							</div>
									</div>
									<div class="col-md-2">
										<button type="submit" id="submit" class="btn btn-info">Filter</button>
									<a class="" href="{{ url('/allroomorders') }}"> Reset</a>
									</div>

							</div>



						</form>
					</div>
					<div class="clearfix"></div>
					<hr>
					<div class="table-responsive">

						<!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->

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
								<th>Donation</th>
								<th>Insurance</th>
								<th>Payment Status</th>
								<th>Booking Status</th>
								<th>Actions</th>

							</tr>

							</thead>

							<tbody>

                            <?php $sno = 1; ?>

							@foreach($roomreserves as $key => $roomreserve)


								@if(isset($roomreserve->getRoomOrderssupadmin))

									<tr>

										<td>{{$sno++}}</td>

										<td>{{$roomreserve->ReceiptNum}}</td>
										<td>{{ \Carbon\Carbon::parse( $roomreserve->created_at??'' )->toDayDateTimeString() }}</td>
										<td>
											{{$roomreserve->getRoomOrdersbyusersupadmin->name??''}}
											<br>
											{{$roomreserve->getRoomOrdersbyusersupadmin->email??''}}
										</td>
										<td>
											{{$roomreserve->getReservationOrdersroom->getHotelRoomDetails->getUserofProperty->name??''}}
											<br>
											{{$roomreserve->getReservationOrdersroom->getHotelRoomDetails->getUserofProperty->email??''}}
										</td>
                                        <?php



                                        if(($roomreserve->Insurance == 1) && ($roomreserve->Donation == 0)){

                                            $finalprice = 0;

                                            $finalprice = $roomreserve->TotalPrice - 10;

                                        }elseif(($roomreserve->Donation == 1) && ($roomreserve->Insurance == 0)){

                                            $finalprice = 0;

                                            $finalprice = $roomreserve->TotalPrice - $roomreserve->Donation_amount;

                                        }elseif(($roomreserve->Insurance == 1) && ($roomreserve->Insurance == 1) ){

                                            $finalprice = 0;

                                            $finalprice = $roomreserve->TotalPrice - $roomreserve->Donation_amount - 10;

                                        }else{

                                            $finalprice = 0;

                                            $finalprice = $roomreserve->TotalPrice;

                                        }

                                        ?>

										<td>{{ \Carbon\Carbon::parse( $roomreserve->checkout??'' )->toFormattedDateString() }}</td>
										<td>${{number_format($roomreserve->TotalPrice??'0',2, '.', ',')}}</td>
										<td>${{number_format($finalprice/100*80??'0',2, '.', ',')}}</td>
										<td>${{number_format($finalprice/100*20??'0',2, '.', ',')}}</td>
										<td>${{number_format($roomreserve->Donation_amount??'0',2, '.', ',')}}</td>
										<td>$ @if($roomreserve->Insurance == 1) {{number_format(10,2, '.', ',')}} @else {{number_format(0,2, '.', ',')}} @endif</td>
										<td>
											@if($roomreserve->request_refund_reply =='REFUNDED')
												<label class='badge badge-danger badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown">REFUNDED</label>
											@elseif($roomreserve->TypeofPayment == "cashpayment" || $roomreserve->TypeofPayment == "bankpayment" || $roomreserve->TypeofPayment == "zelle")
												<div class="dropdown">
													@if ($roomreserve->PaymentStatus == 'PAID')
														<label class='badge badge-success badge-sm'  style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown" for="paidtoggle">PAID</label>
														<div class="dropdown-menu" id="paidtoggle">
															<li>
																<a class="dropdown-item" id="paid_status" onclick="paymentstatus('{{$roomreserve->ReceiptNum}}','UNPAID')" >UNPAID</a>
															</li>
														</div>
													@else
														<label class='badge badge-danger badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown" for="unpaymenttoggle" >UNPAID</label>
														<div class="dropdown-menu" id="unpaymenttoggle">
															<li>
																<a class="dropdown-item" id="paid_status" onclick="paymentstatus('{{$roomreserve->ReceiptNum}}','PAID')" >PAID</a>
															</li>
														</div>
													@endif
												</div>

											@else

												@if ($roomreserve->PaymentStatus == 'PAID')
													<span class='badge badge-success badge-sm' style='cursor:pointer'>PAID</span>
												@else
													<span class='badge badge-danger badge-sm' style='cursor:pointer'>UNPAID<span>
												@endif

											@endif
										</td>
										<td>
											<div class="dropdown">
												@if($roomreserve->request_refund_reply =='REFUNDED')
													<label class='badge badge-danger badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown">REFUNDED</label>
												@elseif($roomreserve->BookingStatus == 'PENDING')
													<span class='badge badge-alert badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown">PENDING</span>
													@if($roomreserve->PaymentStatus == 'PAID')
													<div class="dropdown-menu">
														<li>
															<a class="dropdown-item" id="accept_reservation" onclick="acceptstatus({{$roomreserve->ReservationID}},'CONFIRMED')" >CONFIRM</a>
														</li>
														<li>
															<a class="dropdown-item" id="reject_reservation" onclick="rejectstatus({{$roomreserve->ReservationID}},'CANCELLED')">CANCEL</a>
														</li>
													</div>
													@endif
												@elseif($roomreserve->BookingStatus  == 'CANCELLED')
													<label class='badge badge-danger badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown" for="cancel"> CANCELLED</label>
													@if($roomreserve->PaymentStatus == 'PAID')
													<div class="dropdown-menu" id="cancel">
														<li>
															<a class="dropdown-item" id="accept_reservation" onclick="acceptstatus({{$roomreserve->ReservationID}},'CONFIRMED')"  >CONFIRM</a>
														</li>
													</div>
												@endif
												@elseif($roomreserve->BookingStatus == 'CONFIRMED')
													<span class='badge badge-success badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown">CONFIRMED</span>
													@if(is_null($roomreserve->withdraw) || $roomreserve->withdraw == 2)
													<div class="dropdown-menu">
														<li>
															<a class="dropdown-item" id="reject_reservation" onclick="rejectstatus({{$roomreserve->ReservationID}},'CANCELLED')">CANCEL</a>
														</li>
											</div>
													@endif
												@endif
											</div>
											{{--@if ($roomreserve->BookingStatus == 'CONFIRMED')--}}
											{{--<span class='badge badge-success badge-sm' style='cursor:pointer'>CONFIRMED</span>--}}
											{{--@else--}}
											{{--<span class='badge badge-danger badge-sm' style='cursor:pointer'>UNCONFIRMED<span>--}}
											{{--@endif--}}
										</td>

										<td>
											{{--<a type="button" href="{{route('roomreservesadmin',$roomreserve->ReceiptNum)}}"--}}

											{{--class="btn btn-warning btn-s add-tooltip"><i class="fa fa-eye"></i></a>--}}
											<a href="{{ url('room_invoice/' . $roomreserve->ReservationID??'') }}"
											   title="Order Details">
												<button class="btn btn-primary btn-sm">
													<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Order Details
												</button>
											</a>
{{--											@if($roomreserve->request_refund_reply =='Refunded')--}}
												{{--<p style="color:red;" >--}}
													{{--Refunded--}}
												{{--</p>--}}
											{{--@endif--}}
										</td>

									</tr>

								@endif

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

    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            aLengthMenu: [
                [15,25, 50,100,500, -1],
                [15,25, 50,100,500,"All"]
            ],
            iDisplayLength:100,
            stateSave: true,
            order: [0, 'asc']

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
        swal("Write something here:", {
            content: "input",
        })
          .then((value) => {
            if (value) {

                $.get('{{ URL::to("room_mypayment_status")}}/'+id+'/'+status+'/'+value,function(data){
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
</script>

@endpush