@extends('layouts.master')

@push('css')
<link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/components/dashboard/css/customstyle.css') }}" rel="stylesheet" />
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
@endpush

@section('content')
<div class="container-fluid">
    <!-- .row -->

    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                @php
                    $route = Request::segments();
                @endphp
                    {{-- <?
                        // $route = Request::segments();
                    ?> --}}
                    @if($route[0] == 'service-provider-request')
                        <h3 class="box-title pull-left">Manage Users – Service Providers Account Activations</h3>
                            @else
                        <h3 class="box-title pull-left">Manage Users – All Users</h3>
                    @endif
                {{--<a class="btn btn-success pull-right" href="{{url('user/create')}}"><i class="icon-plus"></i> Add user</a>--}}
                <div class="clearfix"></div>
                <hr>
                <div class="table-responsive">

                    <div class="container">
                        <table class="table table-hover table-condensed" id="myTable">
                            <thead>
                                <tr>
                                    <th>S.NO</th>
                                    <th>Register Date</th>
                                    <th>Name, Email , Phone</th>
                                    <th>Company Name</th>
                                    <th>Role</th>
                                    <th>Email Confirmed?</th>
                                    <th>Status, Actions</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($allusers as $key=>$user)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{\Carbon\Carbon::parse($user->created_at??'' )->toFormattedDateString()}}</td>
                                    <td>{{$user->name??''}}<br>{{$user->email??''}}<br>{{$user->profile->phone??''}}</td>
                                    <td>{{$user->profile->company_name??''}}</td>
                                    <td>{!! $user->roles()->pluck('name')->implode('<br> ')??'' !!}</td>
                                    @if($user->email_verify_status == 1)
                                    <td class="text-success">Confirmed</td>
                                    @else
                                    <td class="text-warning">Pending</td>
                                    @endif
                                    @if($user->status == 1)
                                    <td class="text-center">Active
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                Change User Status
                                            </button>
                                            <div class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" onclick="userstatus({{$user->id}},'active')">ACTIVE</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" onclick="userstatus({{$user->id}},'notactive')">NOT ACTIVE</a>
                                                </li>
                                            </div>
                                        </div>
                                    </td>
                                    @else
                                    <td class="text-danger text-center">Not Active
                                        <div class="dropdown">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                Change User Status
                                            </button>
                                            <div class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" onclick="userstatus({{$user->id}},'active')">ACTIVE</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" onclick="userstatus({{$user->id}},'notactive')">NOT ACTIVE</a>
                                                </li>
                                            </div>
                                        </div>
                                    </td>
                                    @endif
                                    {{--<a class="delete" href="{{url('user/delete/'.$user->id)}}"><i class="icon-trash"></i> Delete</a>--}}
                                    <td><a href="{{url('user/edit/'.$user->id)}}"><i class="icon-pencil"></i> Edit</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.partials.right-sidebar')
@endsection

@push('js')
<script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
{{--<script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>--}}
{{--<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>--}}
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
    $(document).ready(function() {
        $(document).on('click', '.delete', function(e) {
            if (confirm('Are you sure want to delete?')) {} else {
                return false;
            }
        });
        @if(\Session::has('message'))
        $.toast({   
            heading: 'Success!',
            position: 'top-center',
            text: '{{session()->get('
            message ')}}',
            loaderBg: '#ff6849',
            icon: 'success',
            hideAfter: 3000,
            stack: 6
        });

        @endif
    })
    $(document).ready(function() {
        $('#example').DataTable();
    });

    function userstatus(id, status) {
        swal({
                title: "Are you sure?",
                text: "Do you really want to change the status!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.get('{{ URL::to("userstatus")}}/' + id + '/' + status, function(data) {
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
</script>
@endpush