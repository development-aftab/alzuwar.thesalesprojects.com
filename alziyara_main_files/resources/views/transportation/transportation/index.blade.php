@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>
    <style>.btn-group-sm>.btn, .btn-sm {padding: 8px 12px;}</style>
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
                    <h3 class="box-title pull-left">Settings - Transportation</h3>
                    @can('add-'.str_slug('Transportation'))
                        <a class="btn btn-success pull-right" href="{{ url('/transportation/transportation/create') }}"><i
                                    class="icon-plus"></i> Add Vehicle</a>
                    @endcan
                    @if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('SuperAdmin'))
                        <div class="btn_three">
                            <a class="btn btn-success" href="{{ url('/transportFeature/transport-feature') }}"><i
                                    class=""></i>Transport Features</a>
                            <a class="btn btn-success" href="{{ url('/transportRoute/transport-route') }}"><i
                                    class=""></i>Transport Routes</a>
                            <a class="btn btn-success" href="{{ url('/transportType/transport-type') }}"><i
                                    class=""></i>Transport Type</a>
                        </div>

                    @endif
                    <div class="clearfix"></div>
                    <hr>
                    {{--{{sizeof($transportation)}}--}}
                    @if(sizeof($transportation) > 0)
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>S. No</th>
                                <th>Transport Image</th>
                                @if(Auth::user()->hasRole('TransportAdmin'))
                                    <th>Service Provider</th>
                                @endif
                                <th>Type</th>
                                <th>Transport Name</th>
                                {{--<th>One Way Price</th>--}}
                                {{--<th>Two Way Price</th>--}}
                                <th>Transport Route - Price|One Way/Round Trip</th>
                                {{--<th>Transport Features</th>--}}
                                <th>Publish Status</th>
                                <th>Admin Approval</th>
                                <th style="width: 100px">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transportation as $item)

                                <tr>
                                    <td>{{ $loop->iteration ?? $item->id }}</td>
                                    <td>
                                        @if(isset($item->getTransportDefaultPic->PhotoLocation))
                                            <a href="{{route('Transportdetails')}}/{{$item->VehicleRouteID}}/{{$item->NameofVehicle}}"><img style="height:100px; width: 100px; object-fit: cover;" src="{{asset('website').'/'.$item->getTransportDefaultPic->PhotoLocation}}"></a>
                                        @else
                                            <a href="{{route('Transportdetails')}}/{{$item->VehicleRouteID}}/{{$item->NameofVehicle}}"><img style="height:100px; width: 100px; object-fit: cover;" src="{{asset('website/img/not_available.png')}}"></a>
                                        @endif
                                    </td>
                                    @if(Auth::user()->hasRole('TransportAdmin'))
                                        <td>{{ $item->getTransportServiceProvider->name??'' }}</td>
                                    @endif
                                    <td>{{ $item->getTransporttype->TransportationTypeDesc??'' }}</td>
                                    <td><a href="{{route('Transportdetails')}}/{{$item->VehicleRouteID}}/{{$item->NameofVehicle}}">{{ $item->NameofVehicle??'' }}</a></td>
                                    {{--<td>${{number_format($item->Price, 0, '.', '')}}</td>--}}
                                    {{--<td>${{number_format($item->TwoWayPrice, 0, '.', '')}}</td>--}}
                                    <td>
                                        @foreach($item->getTransportRoutes as $routes)
                                            {{$routes->getTransportmainroute->RouteFrom??''}} to {{$routes->getTransportmainroute->RouteTo??''}}    -    $@convert($routes->Price??0)    /    $@convert($routes->TwoWayPrice??0)</br>
                                        @endforeach
                                    </td>

                                    {{--<td><?php--}}
                                        {{--$featuresIds =  explode(',',$item->FeatureID);--}}
                                        {{--$features = App\VehicleFeaturesList::whereIn('FeatureID',$featuresIds)->take(4)->get();--}}
                                        {{--?>--}}
                                        {{--<ul class="list-unstyled">--}}
                                            {{--@foreach($features as $feature)--}}
                                                {{--<span class="stay" title="{{$feature->Title}}">--}}
                                                    {{--@if($feature->ImageIcon)--}}
                                                        {{--{!! $feature->ImageIcon !!}--}}
                                                    {{--@else--}}
                                                        {{--<i class="fas fa-dot-circle"></i>--}}
                                                    {{--@endif--}}

                                                {{--</span>--}}
                                            {{--@endforeach--}}
                                        {{--</ul>--}}
                                    {{--</td>--}}
                                    <td>@if($item->Status == '1') Active @else Inactive @endif</td>
                                    <td>@if($item->status_from_admin == '1') Active @else Inactive @endif</td>
                                    <td>
                                        {{--@can('view-'.str_slug('Transportation'))--}}
                                            {{--<a href="{{ url('/transportation/transportation/' . $item->VehicleRouteID) }}"--}}
                                               {{--title="View Transportation">--}}
                                                {{--<button class="btn btn-info btn-sm">--}}
                                                    {{--<i class="fa fa-eye" aria-hidden="true"></i>--}}
                                                {{--</button>--}}
                                            {{--</a>--}}
                                        {{--@endcan--}}

                                        @can('edit-'.str_slug('Transportation'))
                                            <a href="{{ url('/transportation/transportation/' . $item->VehicleRouteID . '/edit') }}"
                                               title="Edit Transportation">
                                                <button class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('delete-'.str_slug('Transportation'))
                                            <form method="POST"
                                                  action="{{ url('/transportation/transportation' . '/' . $item->VehicleRouteID) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete Transport"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $transportation->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                    @else
                        <h2 class="text-center"> Welcome to the Shrine Transportation management page.</h2>
                        <h2 class="text-center"> You don’t have any Vehicles in our system yet.</h2>
                    @endif
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
            @if(\Session::has('error'))
            $.toast({
                heading: 'Error!',
                position: 'top-center',
                text: '{{session()->get('error')}}',
                loaderBg: '#ff6849',
                icon: 'error',
                hideAfter: 3000,
                stack: 6
            });
            @endif
        })

        $(function () {
            $('#myTable').DataTable({
                stateSave: true,
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] /* 1st one, start by the right */
                }]
            });

        });
    </script>

@endpush
