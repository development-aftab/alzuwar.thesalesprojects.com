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
				<h3 class="box-title pull-left">Settings - Hotel</h3>
				{{--<div class="pull-right">--}}
				<a class="btn btn-success pull-right" href="{{ route('createhotel') }}"><i class="icon-plus"></i> Add Hotel</a>
				{{--</div>--}}
				<div class="clearfix"></div>
				<hr>
                {{--<h3 class="box-title m-b-0">My Property</h3>--}}

                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
				@if(sizeof($property)>0)
                	<table id="myTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>S.No</th>
							@if(!Auth::user()->hasRole('HotelsAdmin'))
                            	<th>Service Provider</th>
							@endif
                            <th>Image</th>
                            <th>Property Name</th>
                            <th>Publish Status</th>
							<th>Admin Approval</th>
							<th>Action</th>
                            {{--<th>Edit</th>--}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($property as $key => $myproperty)
                        <tr>
                            <td>{{$key+1}}</td>
							@if(!Auth::user()->hasRole('HotelsAdmin'))
								<td>{{$myproperty->getUserofProperty->name??''}}</td>
							@endif
							<td>
								@foreach($myproperty->getHotelPics as $ht_pics)
										@if($ht_pics->DefaultFlag == '1')
										<a href="{{url('hotelsdetails/'.$myproperty->PropertyID.'/'.$myproperty->Name)}}">
												<img style="height:100px;width: 100px;" src="{{asset('website').'/'.$ht_pics->PhotoLocation}}">
										</a>
										@endif
								@endforeach
                            </td>
							<td><a href="{{url('hotelsdetails/'.$myproperty->PropertyID.'/'.$myproperty->Name)}}">{{$myproperty->Name}}</a></td>
                            <td>@if($myproperty->Published == 1) 
									Active
								@else
									NotActive
								@endif</td>
							<td>@if($myproperty->Admin_status == 1) 
									Active
								@else
									Not Active
								@endif</td>
							<td>
								<div class="dropdown">
									<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
										Change Status
									</button>
									<a class="btn btn-success" href="{{route('createroom')}}/{{$myproperty->PropertyID}}"><i
												class="icon-plus"></i> Add Rooms </a>
									<a class="btn btn-info" href="{{route('myroom')}}/{{$myproperty->PropertyID}}"><i
												class="fa fa-eye"></i> View Rooms </a>
									<a  class="btn btn-warning" href="{{route('edithotel',$myproperty->PropertyID)}}"><i
												class="fa fa-pencil"></i>Edit Hotel</a>
							<div class="dropdown-menu">
										<li>
											<a class="dropdown-item" onclick="userstatus({{$myproperty->PropertyID}},'active')">ACTIVE</a>
										</li>
										<li>
											<a class="dropdown-item" onclick="userstatus({{$myproperty->PropertyID}},'notactive')">NOT ACTIVE</a>
										</li>
										{{--<li>--}}
											{{--<a class="dropdown-item" onclick="userstatus({{$myproperty->PropertyID}},'default')">DEFAULT</a>--}}
										{{--</li>--}}
									</div>
								</div>
							</td>
                            {{--<td>--}}
							{{--<a type="button" href="{{route('guestspassupdate',$myproperty->PropertyID)}}" class="btn btn-warning btn-s add-tooltip"><i class="fa fa-pencil "></i></a>--}}
							{{--<a type="button" href="{{route('edithotel',$myproperty->PropertyID)}}" class="btn btn-warning btn-s add-tooltip"><i class="fa fa-pencil "></i></a></td>--}}
                        </tr>

                        @endforeach

                    </tbody>

                </table>
				@else
					<h3 class="text-center">Welcome to the Hotels management page.</h3>
					<h3 class="text-center">You don’t have any hotels in our system yet.</h3>
				@endif
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
function userstatus(id, status) {
			// console.log(id);
			// console.log(status);
			swal({
					title: "Are you sure?",
					text: "Do you really want to change the status!",
					icon: "warning",
					buttons: true,
					dangerMode: true,
				})
				.then((willDelete) => {
					if (willDelete) {

						$.get('{{ URL::to("propertystatus")}}/'+id+'/'+status,function(data){
							
							 window.location.reload();
							 
						});
						swal("Your Property status has been updated!", {
							icon: "success",
						});
					} else {
						swal("Your user status has not changed!");
					}
				});
		}
    </script>

</script>

@endpush