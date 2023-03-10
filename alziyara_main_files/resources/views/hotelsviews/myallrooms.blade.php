@extends('layouts.master')



@push('css')
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





	<div class="container-fluid">

		<!-- .row -->

		<div class="row">

			<div class="col-sm-12">

				<div class="white-box">
					<h3 class="box-title pull-left">Settings - View Rooms in {{$room[0]->gethotelrooms->Name??''}}</h3>
					<a class="btn btn-success pull-right" href="{{URL('myhotels')}}">View All Hotels</a>
					<div class="pull-right">
					</div>
					<div class="clearfix"></div>
					<hr>
				{{--<h3 class="box-title m-b-0">My Rooms</h3>--}}

				<!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->

					<table id="myTable" class="table table-striped" style="width:100%">

						<thead>

						<tr>

							<th>S.No</th>

							<th>Room Image</th>

							{{--<th>Hotel Name</th>--}}

							<th>Room Name</th>

							<th>Room Type</th>

							<th>Room Status</th>

							<th>Price</th>

							<th>Action</th>

							<th>Edit</th>

						</tr>

						</thead>

						<tbody>

                        <?php $i = 1; ?>

						@foreach($room as $key => $myroom)

							@if($myroom->gethotelrooms != null)

								<tr>

									<td>{{$i++}}</td>


									<td>
										<img style="height: 80px; width: 80px; object-fit: cover;"	src="{{asset('website').'/'.$myroom->RoomImage}}">
									</td>
									{{--<td>{{$myroom->gethotelrooms->Name}}</td>--}}

									<td>{{$myroom->RoomName}}</td>

									<td>{{$myroom->RoomType}}</td>

									<td>{{$myroom->RoomStatus}}</td>

									<td>$ @convert($myroom->Price??0)</td>

									<td>
										<div class="dropdown">
											<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
												Change Status
											</button>
											<div class="dropdown-menu">
												<li>
													<a class="dropdown-item" onclick="roomstatus({{$myroom->id}},'active')">READY</a>
												</li>
												<li>
													<a class="dropdown-item" onclick="roomstatus({{$myroom->id}},'notactive')">NOT READY</a>
												</li>
											</div>
										</div>
									</td>
									<td>{{--<a type="button" href=""

											class="btn btn-warning btn-s add-tooltip"><i class="fa fa-pencil "></i></a>--}}
										<a type="button" href="{{route('myeditrooms',$myroom->id)}}" class="btn btn-warning btn-s add-tooltip"><i class="fa fa-pencil "></i></a></td>

								</tr>

							@endif

						@endforeach

						</tbody>

					</table>

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
    function roomstatus(id, status) {
        swal({
            title: "Are you sure?",
            text: "Do you really want to change the status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                $.get("{{ url('roomstatus')}}"+'/'+id+'/'+status,function(data){
//                    console.log(data);
                    window.location.reload();
                });
                swal("Your Room status has been updated!", {
                    icon: "success",
                });
            } else {
                swal("Your Room status has not changed!");
            }
        });
    }
</script>

@endpush