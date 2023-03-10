@extends('layouts.master')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />

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
                <h3 class="box-title pull-left">Settings - Shrine Programs</h3>
                {{--<div class="pull-right">--}}
                <a class="btn btn-success pull-right" href="{{ route('addguestspass') }}"><i class="icon-plus"></i> Add Shrine Programs</a>
                {{--</div>--}}
                <div class="clearfix"></div>
                <hr>
                {{--<h3 class="box-title m-b-0">My Guests Passes</h3>--}}
                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                @if(sizeof($guestPass)>0)
                    <table id="myTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            @if(Auth::user()->hasRole('GuestsPassAdmin'))
                                <th>Service Provider</th>
                            @endif
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Publish Status</th>
                            <th>Admin Approval</th>
                            <th>Action</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($guestPass as $key => $myguestpass)
                        <tr>
                            <td>{{$key+1}}</td>
                            @if(Auth::user()->hasRole('GuestsPassAdmin'))
                                <td>{{$myguestpass->getGuestPassUser->name??''}}</td>
                            @endif
                            <td>
                                @if(isset($myguestpass->getGuestPassDetails[0]->PhotoLocation))
                                    <a href="{{route('guestsdetails')}}/{{$myguestpass->GuestPassID}}/{{$myguestpass->GuestPassName}}">
                                        <img style="height:100px;width: 100px;" src="{{asset('website').'/'.$myguestpass->getGuestPassDetails[0]->PhotoLocation}}">
                                    </a>
                                @else
                                <img style="height:100px;width: 100px;" src="">
                                @endif
                            </td>
                            <td><a href="{{route('guestsdetails')}}/{{$myguestpass->GuestPassID}}/{{$myguestpass->GuestPassName}}">{{$myguestpass->GuestPassName}}</a></td>
                            <td>{{$myguestpass->Price}}</td>
                            <td>{{$myguestpass->GuestPassStatus}}</td>
                            <th>{{$myguestpass->Admin_status}}</th>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Publish Status </button>
                                    <div class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" onclick="guestpassstatus({{$myguestpass->GuestPassID}},'active')">ACTIVE</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" onclick="guestpassstatus({{$myguestpass->GuestPassID}},'notactive')">NOT ACTIVE</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" onclick="guestpassstatus({{$myguestpass->GuestPassID}},'Draft')">DRAFT</a>
                                        </li>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a type="button" href="{{route('guestspassupdate',$myguestpass->GuestPassID)}}"  class="btn btn-warning btn-s add-tooltip">
                                    <i class="fa fa-pencil "></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                    <h2 class="text-center"> Welcome to the Shrine Programs management page.</h2>
                    <h2 class="text-center"> You don’t have any Shrine Programs yet.</h2>
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
$('#myTable').DataTable();function guestpassstatus(id, status) {    console.log(id);    console.log(status);    swal({            title: "Are you sure?",            text: "Do you want to change the status of this guestpass!",            icon: "warning",            buttons: true,            dangerMode: true,        })        .then((willDelete) => {            if (willDelete) {                $.get('{{ URL::to("guestpassstatus")}}/'+id+'/'+status,function(data){					                    window.location.reload();                });                swal("Your guestpass status has been updated!", {                    icon: "success",                });            } else {                swal("Your guestpass status has not changed!");            }        });    }
</script>
@endpush