@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>
<!-- <link href="{{ asset('plugins/components/dashboard/css/customstyle.css') }}" rel="stylesheet" /> -->
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />

@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box sales_chart_border">
                    <h3 class="box-title pull-left">Settings - Packages Deal</h3>
                    @can('add-'.str_slug('ManageSetting'))
                        <a class="btn btn-success pull-right" href="{{ url('/manageSetting/manage-setting/create') }}"><i
                                    class="icon-plus"></i> Add Packages Deal</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                @if(!Auth::user()->hasRole('PackagesAdmin'))
                                    <th class="text-center">Service Provider</th>
                                @endif
                                <th class="text-center">Type</th>
                               <th class="text-center">Package Deals</th>
                                <th class="text-center">Price</th>
                                @if(Auth::user()->hasRole('SuperAdmin'))
                                <th class="text-center">Display On HomePage</th>
                                @endif
                                <th class="text-center">Publish Status</th>
                                <th class="text-center">Admin Approval</th>
{{--                                @if(!Auth::user()->hasRole('SuperAdmin') && !Auth::user()->hasRole('admin'))--}}
                                    <th class="text-center">Actions</th>
                                {{--@endif--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($managesetting as $item)
                                <tr package_id="{{$item->id}}">
                                    <td class="text-center id">{{ $loop->iteration??$item->id }}</td>
                                    @if(!Auth::user()->hasRole('PackagesAdmin'))
                                        <td class="text-center id">{{$item->getPackageUser->name??''}}</td>
                                    @endif
                                    <td class="text-center id">{{ $item->getPackageDealsType->package_deals_type_desc??'' }}</td>
                                    <td class="text-center name"><a href="{{url('packagesdetail/'.$item->id.'/'.$item->package_deals_name)}}" target="_blank">{{ $item->package_deals_name }}</a></td>
                                    <td class="text-center">$@convert($item->price)</td>
                                    @if(Auth::user()->hasRole('SuperAdmin'))
                                        <td class="text-center">
                                            <input class="form-check-input package_id" type="checkbox" value="{{$item->id}}" @if($item->display_on_home_page=='1') checked @endif>
                                        </td>
                                    @endif
                                    @if(auth()->user()->hasrole('PackagesAdmin') || auth()->user()->hasrole('SuperAdmin') || auth()->user()->hasrole('admin'))
                                        <td class="text-center"><a href="{{route('update_package_status',['PackageDealsID'=>$item->id,'status'=>$item->package_deals_status])}}" onclick="return confirm('Are you sure?')">{!! $item->status_detail??"Not Available" !!}</a></td>
                                    @else
                                        <td class="text-center">{!! $item->status_detail??"Not Available" !!}</td>
                                    @endif
                                    <td class="text-center">
                                        @if($item->status_from_admin == 1)
                                            <span class='badge badge-success badge-sm' style='cursor:pointer'>Active</span>
                                        @else
                                            <span class='badge badge-danger badge-sm' style='cursor:pointer'>Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if(!Auth::user()->hasRole('SuperAdmin') && !Auth::user()->hasRole('admin'))
                                        @can('view-'.str_slug('ManageSetting'))
                                            <a href="{{ url('/manageSetting/manage-setting/' . $item->id) }}"
                                               title="View ManageSetting">
                                                {{-- <button class="btn btn-info btn-sm btn_blue">
                                                    <i class="fa fa-eye" aria-hidden="true"></i> View
                                                </button> --}}
                                            </a>
                                        @endcan
                                        @endif
                                        @can('edit-'.str_slug('ManageSetting'))
                                            <a href="{{ url('/manageSetting/manage-setting/' . $item->id . '/edit') }}"
                                               title="Edit ManageSetting">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                        @endcan
                                        @can('delete-'.str_slug('ManageSetting'))
                                            <form method="POST"
                                                  action="{{ url('/manageSetting/manage-setting' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete ManageSetting"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $managesetting->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>
    <script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
    <!-- start - This is for export functionality only -->
    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function () {

            @if(\Session::has('message'))
            $.toast({
                heading: 'Success!',
                position: 'top-center',
                text: '{{session()->get('message')}}',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
            });
            @endif
        })

        $(function () {
            $('#myTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] /* 1st one, start by the right */
                }]
            });

        });

    </script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.package_id').change(function() {
//            alert($(this).closest("tr").attr('package_id'));
            if(this.checked) {
                $.get('{{ URL::to("add-package-on-homepage")}}/'+$(this).closest("tr").attr('package_id'),function(data){
                    console.log(data);
                    Swal.fire({
                        icon: 'success',
                        title: 'Show On Home Page',
                        text: 'Package added on home page...',
                    })
                });
            }
            else {
                $.get('{{ URL::to("remove-package-from-homepage")}}/'+$(this).closest("tr").attr('package_id'),function(data){
                    console.log(data);
                    Swal.fire({
                        icon: 'success',
                        title: 'Remove From Home Page',
                        text: 'Package remove from home page...',
                    })
                });
            }
            $('.package_id').val(this.checked);
        });


        $('#myTable_length').css("display","none");
    </script>

@endpush
