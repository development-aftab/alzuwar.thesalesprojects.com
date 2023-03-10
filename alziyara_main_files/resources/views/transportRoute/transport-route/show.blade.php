@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">TransportRoute
                        {{--{{ $transportroute->RouteID }}--}}
                    </h3>
                    @can('view-'.str_slug('TransportRoute'))
                        <a class="btn btn-success pull-right" href="{{ url('/transportRoute/transport-route') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            {{--<tr>--}}
                                {{--<th>ID</th>--}}
                                {{--<td>{{ $transportroute->RouteID }}</td>--}}
                            {{--</tr>--}}
                            {{--<tr><th> RouteID </th><td> {{ $transportroute->RouteID }} </td></tr>--}}
                            <tr><th> Route Name </th><td> {{ $transportroute->RouteName }} </td></tr>
                            <tr><th> From </th><td> {{ $transportroute->RouteFrom }} </td></tr>
                            <tr><th> To </th><td> {{ $transportroute->RouteTo }} </td></tr>
                            <tr><th> Distance </th><td> {{ $transportroute->Distance }} </td></tr>
                            <tr><th> Driving Time </th><td> {{ $transportroute->DrivingTime }} </td></tr>
                            <tr><th> Pickup Date Time </th><td> {{ $transportroute->PickupDateTime }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

