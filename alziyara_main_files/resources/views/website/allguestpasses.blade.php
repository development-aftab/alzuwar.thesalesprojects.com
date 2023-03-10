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


<div class="container-fluid">
    <!-- .row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box sales_chart_border">
                <h3 class="box-title pull-left">Settings - Shrine Programs</h3>
                @if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('user'))
                    <div class="room_type_btn">
                        <a class="btn btn-success" href="{{ url('/allcity') }}">Cities</a>
                    </div>
                @endif
                <hr>
                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                <table id="myTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            @if(Auth::user()->hasRole('SuperAdmin'))
                                <th class="text-center">Display On HomePage</th>
                            @endif
                            <th>Publish Status</th>
                            <th>Admin Approval</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($guestPass as $key => $myguestpass)
                        <tr guestpass_id="{{$myguestpass->GuestPassID}}">
                            <td>{{$key+1}}</td>
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
                            <td>$@convert($myguestpass->Price)</td>
                            @if(Auth::user()->hasRole('SuperAdmin'))
                                <td class="text-center">
                                    <input class="form-check-input package_id" type="checkbox" value="{{$myguestpass->GuestPassID}}" @if($myguestpass->DisplayOnHomePage=='1') checked @endif>
                                </td>
                            @endif
                                @if($myguestpass->Admin_status == 'Active')
                                        <th>{{$myguestpass->Admin_status}}</th>
                                @elseif($myguestpass->Admin_status == 'NotActive')
                                        <td>{{$myguestpass->Admin_status}}</td>
                                @elseif($myguestpass->Admin_status == 'Draft')
                                        <td>{{$myguestpass->Admin_status}}</td>
                                @endif

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        Publish Status
                                    </button>
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
                                @if(!Auth::user()->hasRole('SuperAdmin'))
                                <a type="button" href="{{route('guestshowpass',$myguestpass->GuestPassID)}}" class="btn btn-info btn-s add-tooltip">
                                    <i class="fa fa-eye"></i></a>
                                @endif
                                <a type="button" href="{{route('guestspassupdate',$myguestpass->GuestPassID)}}" class="btn btn-warning btn-s add-tooltip">
                                    <i class="fa fa-pencil "></i></a>
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

function guestpassstatus(id, status) {
//    console.log(id);
//    console.log(status);
    swal({
            title: "Are you sure?",
            text: "Do you really want to change the status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.get('{{ URL::to("adminguestpassstatus")}}/'+id+'/'+status,function(data){															window.location.reload();																				});
                swal("Your guestpass status has been updated!", {
                    icon: "success",
                });
            } else {
                swal("Your guestpass status has not changed!");
            }
        });
}
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('.package_id').change(function() {
//            alert($(this).closest("tr").attr('package_id'));
        if(this.checked) {
            $.get('{{ URL::to("add-guestpass-on-homepage")}}/'+$(this).closest("tr").attr('guestpass_id'),function(data){
                console.log(data);
                Swal.fire({
                    icon: 'success',
                    title: 'Show On Home Page',
                    text: 'Guests Pass added on home page...',
                })
            });
        }
        else {
            $.get('{{ URL::to("remove-guestpass-from-homepage")}}/'+$(this).closest("tr").attr('guestpass_id'),function(data){
                console.log(data);
                Swal.fire({
                    icon: 'success',
                    title: 'Remove From Home Page',
                    text: 'Guests Pass remove from home page...',
                })
            });
        }
        $('.package_id').val(this.checked);
    });
</script>
@endpush