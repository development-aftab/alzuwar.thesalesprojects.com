@extends('layouts.master')

@push('css')
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
                <h3 class="box-title pull-left">Settings - Cities</h3>
				<a class="btn btn-success pull-right" href="{{route('createmycity')}}"><i
                            class="icon-plus"></i>Add City</a>
                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                <div class="clearfix"></div>
                <hr>
                <table id="myTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>City Name</th>
                            <th>City Status</th>
                            <th>City Action</th>
                            <th>City Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($city as $key => $mycity)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$mycity->GuestPassLocation}}</td>
								@if($mycity->citystatus == 1)
										<th>Active</th>
								@elseif($mycity->citystatus == 0)
										<td>NotActive</td>
								@elseif($mycity->citystatus == 2)
										<td>Draft</td>
								@endif
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        Change City Status
                                    </button>
                                    <div class="dropdown-menu">
                                        <li>
											<a class="dropdown-item" onclick="citystatus({{$mycity->id}},'active')">ACTIVE</a>
                                        </li>
                                        <li>
											<a class="dropdown-item" onclick="citystatus({{$mycity->id}},'notactive')">NOT ACTIVE</a>
										</li>
                                        <li>
											<a class="dropdown-item" onclick="citystatus({{$mycity->id}},'Draft')">DRAFT</a>
                                        </li>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <center>
                                    <a type="button" href="{{route('ourcity',$mycity->id)}}"
                                    class="btn btn-primary btn-outline btn-s add-tooltip"><i class="fa fa-pencil"></i></a>
                                </center>
                            </td>
                        </tr>
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

function citystatus(id, status) {

    console.log(id);

    console.log(status);

    swal({
            title: "Are you sure?",
            text: "Do you really want to change the status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.get('{{ URL::to("citystatus")}}/'+id+'/'+status,function(data){
					
					window.location.reload();			
					 
				});


                swal("Your city status has been updated!", {
                    icon: "success",
                });
            } else {
                swal("Your city status has not changed!");
            }
        });

    

}
</script>
@endpush