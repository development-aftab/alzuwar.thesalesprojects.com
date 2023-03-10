@extends('layouts.master')



@push('css')
<style>
	.search{border: 1px solid black;}
</style>
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
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



<div class="container-fluid">

    <!-- .row -->

    <div class="row">

        <div class="col-sm-12">

            <div class="white-box">
                <h3 class="box-title pull-left">Sales - Shrine Programs</h3>
				<div class="pull-right">
					<form method="post" action="{{route('search_guestpass_by_date')}}" class="form-inline" role="form">
						@csrf
						<div class="row form_custom">
							<div class="col-md-4">
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
						@if(Auth::user()->hasRole('GuestsPassAdmin'))
							<th class="text-center">Withdraw</th>
						@endif
						<th>Actions</th>
					</tr>
					</thead>
                    <tbody>
						<?php $sno = 1; ?>
                        @foreach($guestpassreserves as $key => $myguestpass)
							@if(isset($myguestpass->getGuestPassOrders))
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
											@if($myguestpass->request_refund_reply == "REFUNDED")
												<label class='badge badge-danger badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown" for="cancel">REFUNDED</label>
											@elseif($myguestpass->PaymentStatus == 'PAID')
											<span class='badge badge-success badge-sm' style='cursor:pointer'>PAID</span>
										@else
											<span class='badge badge-danger badge-sm' style='cursor:pointer'>UNPAID<span>
										@endif
									</td>
									<td>
									<div class="dropdown">
												@if($myguestpass->request_refund_reply == "REFUNDED")
													<label class='badge badge-danger badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown" for="cancel">REFUNDED</label>
												@elseif($myguestpass->BookingStatus == 'PENDING')
											<span class='badge badge-alert badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown">PENDING</span>
													@if($myguestpass->PaymentStatus == 'PAID')
											<div class="dropdown-menu">
												<li>
													<a class="dropdown-item" id="accept_reservation" onclick="acceptstatus({{$myguestpass->ReservationID}},'CONFIRMED')" >CONFIRM</a>
												</li>
												<li>
													<a class="dropdown-item" id="reject_reservation" onclick="rejectstatus({{$myguestpass->ReservationID}},'CANCELLED')">CANCEL</a>
												</li>
											</div>
													@endif
										@elseif($myguestpass->BookingStatus  == 'CANCELLED')
											<label class='badge badge-danger badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown" for="cancel"> CANCELLED</label>
													@if($myguestpass->PaymentStatus == 'PAID')
											<div class="dropdown-menu" id="cancel">
												<li>
													<a class="dropdown-item" id="accept_reservation" onclick="acceptstatus({{$myguestpass->ReservationID}},'CONFIRMED')"  >CONFIRM</a>
												</li>
											</div>
													@endif
										@else
													<span class='badge badge-success badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown">CONFIRMED</span>
													@if(is_null($myguestpass->withdraw) || $myguestpass->withdraw == 2)
														<div class="dropdown-menu">
															<li>
																<a class="dropdown-item" id="reject_reservation" onclick="rejectstatus({{$myguestpass->ReservationID}},'CANCELLED')">CANCEL</a>
															</li>
														</div>
													@endif
										@endif

									</div>
									</td>
									@if(Auth::user()->hasRole('GuestsPassAdmin'))
										<td class="text-center">
<!--											--><?// echo is_null($myguestpass->withdraw); ?>
<!--											--><?// echo $myguestpass->request_refund === ""; ?>
											@if(is_null($myguestpass->withdraw) && $myguestpass->request_refund === "" && $myguestpass->BookingStatus == 'CONFIRMED' && $myguestpass->PaymentStatus == 'PAID')
												<a type="button" class="text-center" href="{{ url('withdraw-request/4/'.$myguestpass->ReceiptNum??'') }}">Withdraw ${{number_format($myguestpass->TotalPrice/100*80??'0',2, '.', ',')}}</a>
											@elseif($myguestpass->withdraw === 0)
												<p class="text-center">Requested for Withdrawal</p>
											@elseif($myguestpass->withdraw == 1)
												<p class="text-center text-success">Withdrawed</p>
												<i class="fa fa-comment fa-2x text-success withdrawComment" data-toggle="modal"></i>
											@elseif($myguestpass->withdraw == 2)
												<p class="text-center text-danger">Rejected Request</p>
												<i class="fa fa-comment fa-2x text-danger withdrawComment" data-toggle="modal"></i>
											@endif
										</td>
									@endif
									<td>
										{{--<a type="button" href="{{route('guestsreverses',$myguestpass->ReceiptNum)}}"--}}

											{{--class="btn btn-warning btn-s add-tooltip"><i class="fa fa-eye"></i></a>--}}
										<a href="{{ url('guestpass_invoice/' .$myguestpass->ReservationID??'') }}"
										   title="Order Details">
											<button class="btn btn-primary btn-sm">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Order Details
											</button>
										</a>
										@if($myguestpass->request_refund_reply =='REFUNDED')
										<p style="color:red;" >
											Refunded
										</p>
										@endif
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

</script>

@endpush