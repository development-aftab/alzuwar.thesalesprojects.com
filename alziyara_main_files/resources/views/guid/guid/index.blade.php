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
                    <h3 class="box-title pull-left">Settings - Guide</h3>
                    @can('add-'.str_slug('Guid'))
                        <a class="btn btn-success pull-right" href="{{ url('/guid/guid/create') }}"><i
                                    class="icon-plus"></i> Add Guide</a>
                    @endcan
                    @if(Auth::user()->hasRole('SuperAdmin'))
                        <div class="btn_three">
                            <a class="btn btn-success pull-right" href="{{url('guideLanguage/guide-language')}}"><i class="fa fa-language"></i> Guide Languages </a>
                            <a class="btn btn-success pull-right" href="{{url('guideCity/guide-city')}}"><i class="fa fa-globe"></i> Guide Cities </a>
                        {{--<a class="btn btn-success pull-right" href="{{route('cities')}}"><i class="fa fa-globe"></i> Cities </a>--}}
                        </div>
                    @endif
                    <div class="clearfix"></div>
                    <hr>
                    @if(sizeof($guid)>0)
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                @if(Auth::user()->hasRole('SuperAdmin'))
                                    <th>Service Provider</th>
                                @endif
                                <th>Image</th>
                                <th>Guide Name</th>
                                <th>Guides Created By</th>
                                <th>Price/Day</th>
                                <th>Languages</th>
                                {{--<th>Maximum Occupancy</th>
                                <th>Days In Trip</th>--}}
                                <th>Publish Status</th>
                                <th>Admin Approval</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($guid as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->id }}</td>
                                    @if(Auth::user()->hasRole('SuperAdmin'))
                                        <td>{{ $item->getGuideOwner->name??'' }}</td>
                                    @endif
                                    <td>
                                        <a href="{{url('guide-details/'.$item->GuidesID.'/'.$item->GuidesName)}}">
                                        @if(isset($item->getGuideDefaultPic->PhotoLocation))
                                            <img style="height:100px; width: 100px; object-fit: cover;"
                                                 src="{{asset('website').'/'.$item->getGuideDefaultPic->PhotoLocation}}">
                                        @else
                                            <img style="height:100px; width: 100px; object-fit: cover;"
                                                 src="{{asset('website/img/not_available.png')}}">
                                        @endif
                                        </a>
                                    </td>
                                    <td><a href="{{url('guide-details/'.$item->GuidesID.'/'.$item->GuidesName)}}" target="_blank">{{ $item->GuidesName }}</a></td>
                                    <td>{{ $item->getGuideOwner->email??'' }}</td>
                                    <td>$@convert($item->PricePerDay)</td>
                                    <td>{{ $item->Languages }}</td>
                                    {{--<td>{{ $item->MaxOccupancy }}</td>--}}
										{{--<td>{{ $item->DaysInTrip??0 }} days</td>--}}
                                    <td>@if($item->GuidesStatus == '1') <span class="label label-success">Active</span> @else <span class="label label-warning">Inactive</span> @endif</td>
                                    <td>@if($item->Admin_status == '1') <span class="label label-success">Active</span> @else <span class="label label-warning">Inactive</span> @endif</td>
                                    <td>
                                        {{--@can('view-'.str_slug('Guid'))--}}
                                            {{--<a href="{{ url('/guid/guid/' . $item->GuidesID) }}"--}}
                                               {{--title="View Guide">--}}
                                                {{--<button class="btn btn-info btn-sm">--}}
                                                    {{--<i class="fa fa-eye" aria-hidden="true"></i>--}}
                                                {{--</button>--}}
                                            {{--</a>--}}
                                        {{--@endcan--}}

                                        @can('edit-'.str_slug('Guid'))
                                            <a href="{{ url('/guid/guid/' . $item->GuidesID . '/edit') }}"
                                               title="Edit Guide">
                                                <button class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('delete-'.str_slug('Guid'))
                                            <form method="POST"
                                                  action="{{ url('/guid/guid' . '/' . $item->GuidesID) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete Guide"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                            {{--<a href="{{ url('guide_invoice/' .$item->id??'') }}"--}}
                                               {{--title=" Invoice">--}}
                                                {{--<button class="btn btn-primary btn-sm">--}}
                                                    {{--<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Invoice--}}
                                                {{--</button>--}}
                                            {{--</a>--}}
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $guid->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                    @else
                        <h3 class="text-center">Welcome to the Guides management page.</h3>
                        <h3 class="text-center">You don’t have any Guides in our system yet.</h3>
                    @endif
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

@endpush
