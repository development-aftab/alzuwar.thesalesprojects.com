@extends('layouts.master')



@push('css')

@endpush
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
						{{--{{$myallfinalprice??0}}--}}
						<h3 class="info-count">${{$mytotalprice??0}}<span class="pull-right"><i class="mdi mdi-coin"></i></span></h3>
						<p class="info-text font-12">Total Sales</p>
						<!--<p class="info-ot font-15">Pending<span class="label label-rounded"></span></p>-->
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 info-color-box">
			<div class="white-box">
				<div class="media bg-success">
					<div class="media-body">
						{{--{{$allfinal??0}}--}}
						<h3 class="info-count">{{$bookings??0}}<span class="pull-right"><i class="mdi mdi-comment-text-outline"></i></span></h3>
						<p class="info-text font-12">Total Boookings</p>
						<!--<p class="info-ot font-15">Closed<span class="label label-rounded">0</span></p>-->
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 info-color-box">
			<div class="white-box">
				<div class="media bg-danger">
					<div class="media-body">
						{{--$donationamount--}}
						<h3 class="info-count">${{$spEarning??0}} <span class="pull-right"><i class="mdi mdi-medical-bag"></i></span></h3>
						<p class="info-text font-12">Total SP Earning</p>
						<!--<p class="info-ot font-15">Pending<span class="label label-rounded">0</span></p>-->
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-6 info-color-box">
			<div class="white-box">
				<div class="media bg-warning">
					<div class="media-body">
						{{--{{$insuranceamount??0}}--}}
						<h3 class="info-count">${{$spEarningWithdraw??0}}<span class="pull-right"><i class="mdi mdi-checkbox-marked-circle-outline"></i></span></h3>
						<p class="info-text font-12">Eligible to Withdrawal</p>
						<!--<p class="info-ot font-15">Limit<span class="label label-rounded">0</span></p>-->
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
<div class="container-fluid">
    <!-- .row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title pull-left">Sales - Guide</h3>
				<div class="pull-right">
					<form method="post" action="{{route('search_guide_by_date')}}" class="form-inline" role="form">
						@csrf
						<div class="row form_custom">
							<div class="col-md-4 offset-md-2">
								<div class="form-group">
									<label for="date_from">From:</label>
									<input type="date" class="form-control input-lg input-search" id="date_from" name="date_from" @if(isset($dateFrom)) value="{{$dateFrom}}" @endif>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="date_to">To:</label>
									<input type="date" class="form-control input-lg input-search" id="date_to" name="date_to" @if(isset($dateTo)) value="{{$dateTo}}" @endif>
								</div>
							</div>
							<div class="col-md-2">
								<button type="submit" id="submit" class="btn btn-info">Filter</button>
								<a href="{{url('/allguideorders')}}">Reset</a>
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
						<th>Cust Paid</th>
						<th>SP Earning</th>
						<th>App Fee</th>
						<th>Payment Status</th>
						<th>Booking Status</th>
						@if(Auth::user()->hasRole('GuideAdmin'))
							<th class="text-center">Withdraw</th>
						@endif
						<th>Actions</th>

					</tr>
					</thead>
					<tbody>
					<?php $sno = 1; ?>
					@foreach($guidereserves as $key => $myguide)
{{--						@if(isset($myguide->getGuideOrderssupadmin))--}}
							<tr>
								<td>{{$sno++}}</td>
								<td class="receipt_num">{{$myguide->ReceiptNum}}</td>
								<td>{{ \Carbon\Carbon::parse( $myguide->created_at??'' )->toDayDateTimeString() }}</td>
								<td>
									{{$myguide->getGuideOrdersbyusersupadmin->name??''}}
									<br>
									{{$myguide->getGuideOrdersbyusersupadmin->email??''}}
								</td>
								<td>
									{{$myguide->getGuideOrderssupadmin->getguideUser->name??''}}
									<br>
									{{$myguide->getGuideOrderssupadmin->getguideUser->email??''}}
								</td>
								<td>{{\Carbon\Carbon::parse( $myguide->getGuideOrdersbyusersupadmin->reservation_end_date??'' )->toFormattedDateString()}}</td>
								<?php
								if(($myguide->Insurance == 1) && ($myguide->Donation == 0)){
									$finalprice = 0;
									$finalprice = $myguide->TotalPrice - 10;
								}elseif(($myguide->Donation == 1) && ($myguide->Insurance == 0)){
									$finalprice = 0;
									$finalprice = $myguide->TotalPrice - $myguide->Donation_amount;
								}elseif(($myguide->Insurance == 1) && ($myguide->Insurance == 1) ){
									$finalprice = 0;
									$finalprice = $myguide->TotalPrice - $myguide->Donation_amount - 10;
								}else{
									$finalprice = 0;
									$finalprice = $myguide->TotalPrice;
								}
								?>
								<td>${{number_format($finalprice??'0',2, '.', ',')}}</td>
								<td>${{number_format($finalprice/100*80??'0',2, '.', ',')}}</td>
								<td>${{number_format($finalprice/100*20??'0',2, '.', ',')}}</td>
									<td>
										@if($myguide->request_refund_reply == "REFUNDED")
											<label class='badge badge-danger badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown" for="cancel">REFUNDED</label>
										@elseif($myguide->PaymentStatus == 'PAID')
										<span class='badge badge-success badge-sm' style='cursor:pointer'>PAID</span>
									@else
										<span class='badge badge-danger badge-sm' style='cursor:pointer'>UNPAID</span>
									@endif
								</td>
								<td>
									<div class="dropdown">
										@if($myguide->request_refund_reply == "REFUNDED")
											<label class='badge badge-danger badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown" for="cancel">REFUNDED</label>
										@elseif($myguide->BookingStatus == 'PENDING')
											<span class='badge badge-alert badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown">PENDING</span>
											@if($myguide->PaymentStatus == 'PAID')
											<div class="dropdown-menu">
												<li>
													<a class="dropdown-item" id="accept_reservation" onclick="acceptstatus({{$myguide->ReservationID}},'CONFIRMED')" >CONFIRM</a>
												</li>
												<li>
													<a class="dropdown-item" id="reject_reservation" onclick="rejectstatus({{$myguide->ReservationID}},'CANCELLED')">CANCEL</a>
												</li>
											</div>
											@endif
										@elseif($myguide->BookingStatus   == 'CANCELLED')
											<label class='badge badge-danger badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown" for="cancel"> CANCELLED</label>
											@if($myguide->PaymentStatus == 'PAID')
											<div class="dropdown-menu" id="cancel">
												<li>
													<a class="dropdown-item" id="accept_reservation" onclick="acceptstatus({{$myguide->ReservationID}},'CONFIRMED')"  >CONFIRM</a>
												</li>
											</div>
											@endif
										@else
											<span class='badge badge-success badge-sm' style='cursor:pointer' class="btn btn-primary dropdown-toggle" data-toggle="dropdown">CONFIRMED</span>
											@if(is_null($myguide->withdraw) || $myguide->withdraw == 2)
												<div class="dropdown-menu">
													<li>
														<a class="dropdown-item" id="reject_reservation" onclick="rejectstatus({{$myguide->ReservationID}},'CANCELLED')">CANCEL</a>
													</li>
												</div>
											@endif
										@endif

									</div>
								</td>
								<td class="text-center">
								@if(Auth::user()->hasRole('GuideAdmin'))
									@if($myguide->request_refund_reply !='Refunded')

										@if(is_null($myguide->withdraw) && is_null($myguide->request_refund) && $myguide->BookingStatus == 'CONFIRMED' && $myguide->PaymentStatus == 'PAID')
											<a type="button" class="text-center" href="{{ url('withdraw-request/5/'.$myguide->ReceiptNum??'') }}">Withdraw ${{number_format($myguide->TotalPrice/100*80??'0',2, '.', ',')}}</a>
										@elseif($myguide->withdraw === 0)
											<p class="text-center">Requested for Withdrawal</p>
										@elseif($myguide->withdraw == 1)
											<p class="text-center text-success">Withdrawed</p>
											<i class="fa fa-comment fa-2x text-success withdrawComment" data-toggle="modal"></i>
										@elseif($myguide->withdraw == 2)
											<p class="text-center text-danger">Rejected Request</p>
											<i class="fa fa-comment fa-2x text-danger withdrawComment" data-toggle="modal"></i>
										@endif
									@endif
								@endif
								</td>
								<td>
								{{--<a type="button" href="{{route('guidereservesadmin',$myguide->ReceiptNum)}}"--}}

									   {{--class="btn btn-warning btn-s add-tooltip"><i class="fa fa-eye"></i></a>--}}

									<a href="{{ url('guide_invoice/' . $myguide->ReservationID??'') }}"
									   title="Order Details">
										<button class="btn btn-primary btn-sm">
											<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Order Details
										</button>
									</a>
									@if($myguide->request_refund_reply =='Refunded')
										<p style="color:red;" >
											Refunded
										</p>
									@endif
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
				aLengthMenu: [
			  [15,25, 50,100,500, -1],
			  [15,25, 50,100,500,"All"]
				],
				iDisplayLength:100,
				stateSave: true,
				order: [0, 'asc']});
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
		}
$( ".withdrawComment" ).click(function() {
    var $item = $(this).closest("tr").find(".receipt_num").text();
    $('.withdraw-request-comment').empty();
    $.get('{{ URL::to("get-withdraw-request-comment")}}/5/'+$item,function(data){
        $('.withdraw-request-comment').text(data);
        $('#withdrawComment').modal('show')
    });
});
</script>

@endpush