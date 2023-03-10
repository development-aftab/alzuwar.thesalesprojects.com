@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">VendorTransportRoute {{ $vendortransportroute->id }}</h3>
                    @can('view-'.str_slug('VendorTransportRoute'))
                        <a class="btn btn-success pull-right" href="{{ url('/vendor-transport-route') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $vendortransportroute->id }}</td>
                            </tr>
                            <tr><th> VehicleRouteID </th><td> {{ $vendortransportroute->VehicleRouteID }} </td></tr><tr><th> RouteID </th><td> {{ $vendortransportroute->RouteID }} </td></tr><tr><th> Price </th><td> {{ $vendortransportroute->Price }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

