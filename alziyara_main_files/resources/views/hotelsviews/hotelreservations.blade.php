@extends('layouts.master')
@push('css')
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
<style>
	.search{border: 1px solid black;}
</style>
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
<?php
	$insurancecount = 0;
	$donationcount = 0;
	$donationamount = 0;
	$myfinalprice = 0;
	$insuranceamount = 0;
	$allfinal = 0;
	$myallfinalprice = 0;
?>

<?php
$total_sales = 0;
foreach($roompassreserves as $key => $roomreserve){
    if($roomreserve->BookingStatus == "CONFIRMED" && $roomreserve->PaymentStatus == "PAID"){
        if(isset($roomreserve->getRoomOrderssupadmin)){
            $cust_paid = 0;
            $cust_paid = $roomreserve->TotalPrice;
            if($roomreserve->Insurance == 1){
                $cust_paid -= 10;
            }
            if($roomreserve->Donation == 1){
                $cust_paid -= $roomreserve->Donation_amount;
            }
            $total_sales +=$cust_paid;
        }
    }
}
$wthdrawed_amount = 0;
foreach($roompassreserves as $key => $roomreserve){
    if($roomreserve->BookingStatus == "CONFIRMED" && $roomreserve->PaymentStatus == "PAID" && $roomreserve->withdraw == 1){
        if(isset($roomreserve->getRoomOrderssupadmin)){
            $cust_paid = 0;
            $cust_paid = $roomreserve->TotalPrice;
            if($roomreserve->Insurance == 1){
                $cust_paid -= 10;
            }
            if($roomreserve->Donation == 1){
                $cust_paid -= $roomreserve->Donation_amount;
            }
            $wthdrawed_amount +=$cust_paid;
        }
    }
}
?>
<div class="container-fluid">
	<div class="row colorbox-group-widget">
		<div class="col-md-3 col-sm-6 info-color-box">
			<div class="white-box">
				<div class="media bg-primary">
					<div class="media-body">
						<h3 class="info-count">${{$mytotalprice??0}}<span class="pull-right"><i class="mdi mdi-coin"></i></span></h3>
						<p class="info-text font-12">Total Revenue</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 info-color-box">
			<div class="white-box">
				<div class="media bg-success">
					<div class="media-body">
						<h3 class="info-count">{{$bookings??0}}<span class="pull-right"><i class="mdi mdi-comment-text-outline"></i></span></h3>
						<p class="info-text font-12">Number of Boookings</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 info-color-box">
			<div class="white-box">
				<div class="media bg-danger">
					<div class="media-body">
						<h3 class="info-count">${{$spEarning??0}} <span class="pull-right"><i class="mdi mdi-medical-bag"></i></span></h3>
						<p class="info-text font-12">Service Provider Earning</p>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 info-color-box">
			<div class="white-box">
				<div class="media bg-warning">
					<div class="media-body">
						<h3 class="info-count">${{$spEarningWithdraw??0}} <span class="pull-right"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span></h3>
						<p class="info-text font-12">Eligible to Withdrawal</p>
					</div>
				</div>
			</div>
		</div>
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


<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header border-bottom-0">
				<h5 class="modal-title" id="exampleModalLabel">Withdraw Amount</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{route('withdraw-request')}}" method="post">
				@csrf()
				<div class="modal-body">
					<div class="start_date">
						<label for="amount">Amount</label>
						<input type="number" class="form-control" id="requested_amount" min = "1" max="{{($total_sales*0.8)-$wthdrawed_amount??0}}" aria-describedby="" name="requested_amount">
						<input type="hidden" class="form-control" id="category" aria-describedby="" name="category" value="2">
						<input type="hidden" class="form-control" id="vendor_id" aria-describedby="" name="vendor_id" value="{{Auth::user()->id}}">
					</div>
				</div>
				<div class="modal-footer border-top-0 d-flex justify-content-center">
					<button type="submit" class="btn btn-success">Submit</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="container-fluid">
    <!-- .row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title pull-left">Sales - Rooms</h3>
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
				<table id="myTable" class="table table-striped" style="width:100%">
					<thead>
					<tr>
						<th>S.No</th>
						<th>Receipt Number</th>
						<th>Ordered On</th>
						<th>Customer</th>
						<th>Service Provider</th>
						<th>Service End Date</th>
						{{--<th>Total</th>--}}
						<th>Cust Paid</th>
						<th>SP Earning</th>
						<th>App Fee</th>
						<th>Payment Status</th>
						<th>Booking Status</th>
						@if(Auth::user()->hasRole('HotelsAdmin'))
							<th class="text-center">Withdraw</th>
						@endif
						<th>Actions</th>
					</tr>
					</thead>
					<tbody>
					<?php $sno = 1; ?>
					@foreach($roompassreserves as $key => $roomreserve)
						@if(isset($roomreserve->getRoomOrderssupadmin))
							<tr>
								<td>{{$sno++}}</td>
								<td class="receipt_num">{{$roomreserve->ReceiptNum}}</td>
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
								<td>{{\Carbon\Carbon::parse( $roomreserve->checkout??'' )->toFormattedDateString()}}</td>
								{{--<td>{{ $roomreserve->TotalPrice }}</td>--}}
								<td>
									<?php
										$cust_paid=0;
                                    	$cust_paid = $roomreserve->TotalPrice;
										if($roomreserve->Insurance == 1){
											$cust_paid -= 10;
										}
										if($roomreserve->Donation == 1){
											$cust_paid -= $roomreserve->Donation_amount;
										}
										?>
									${{number_format($cust_paid??'0',2, '.', ',')}}
								</td>
								<td>${{number_format($cust_paid/100*80??'0',2, '.', ',')}}</td>
								<td>${{number_format($cust_paid/100*20??'0',2, '.', ',')}}</td>
								<td>
											@if($roomreserve->request_refund_reply == "REFUNDED")
												<label class='badge badge-danger badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown" for="cancel">REFUNDED</label>
											@elseif($roomreserve->PaymentStatus == 'PAID')
										<span class='badge badge-success badge-sm' style='cursor:pointer'>PAID</span>
									@else
												<span class='badge badge-danger badge-sm' style='cursor:pointer'>UNPAID</span>
									@endif
								</td>
								<td>
									<div class="dropdown">
												@if($roomreserve->request_refund_reply == "REFUNDED")
													<label class='badge badge-danger badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown" for="cancel">REFUNDED</label>
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
										@else
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
								</td>
								@if(Auth::user()->hasRole('HotelsAdmin'))
									<td class="text-center">
										@if(is_null($roomreserve->withdraw) && is_null($roomreserve->request_refund) && $roomreserve->BookingStatus == 'CONFIRMED' && $roomreserve->PaymentStatus == 'PAID')
											<a type="button" class="text-center" href="{{ url('withdraw-request/2/'.$roomreserve->ReceiptNum??'') }}">Withdraw ${{number_format($cust_paid/100*80??'0',2, '.', ',')}}</a>
										@elseif($roomreserve->withdraw === 0)
											<p class="text-center">Requested for Withdrawal</p>
										@elseif($roomreserve->withdraw == 1)
											<p class="text-center text-success">Withdrawed</p>
											<i class="fa fa-comment fa-2x text-success withdrawComment" data-toggle="modal"></i>
										@elseif($roomreserve->withdraw == 2)
											<p class="text-center text-danger">Rejected Request</p>
											<i class="fa fa-comment fa-2x text-danger withdrawComment" data-toggle="modal"></i>
										@endif
									</td>
								@endif
								<td>
									{{--<a type="button" href="{{route('roomreservesadmin',$roomreserve->ReceiptNum)}}"--}}
									   {{--class="btn btn-warning btn-s add-tooltip"><i class="fa fa-eye"></i></a>--}}
									<a href="{{ url('room_invoice/' . $roomreserve->ReservationID??'') }}"
									   title="Order Details">
										<button class="btn btn-primary btn-sm">
											<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Order Details
										</button>
									</a>
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
					$.get('{{ URL::to("hotels_reservation_status")}}/'+id+'/'+status+'/'+value,function(data){
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
					$.get('{{ URL::to("hotels_reservation_status")}}/'+id+'/'+status+'/'+value,function(data){
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
            $.get('{{ URL::to("get-withdraw-request-comment")}}/2/'+$item,function(data){
            $('.withdraw-request-comment').text(data);
            $('#withdrawComment').modal('show')
        });
        });
</script>

@endpush