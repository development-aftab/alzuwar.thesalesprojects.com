@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">TransportType {{ $transporttype->TransportationTypeID }}</h3>
                    @can('view-'.str_slug('TransportType'))
                        <a class="btn btn-success pull-right" href="{{ url('/transportType/transport-type') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $transporttype->id }}</td>
                            </tr>
                            <tr><th> TransportationTypeID </th><td> {{ $transporttype->TransportationTypeID }} </td>
                            </tr><tr><th> NumOfSeats </th><td> {{ $transporttype->NumOfSeats }} </td></tr>
                            <tr><th> TransportationTypeDesc </th><td> {{ $transporttype->TransportationTypeDesc }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

