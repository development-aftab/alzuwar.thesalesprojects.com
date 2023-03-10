@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">TransportFeature {{ $transportfeature->id }}</h3>
                    @can('view-'.str_slug('TransportFeature'))
                        <a class="btn btn-success pull-right" href="{{ url('/transportFeature/transport-feature') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $transportfeature->id }}</td>
                            </tr>
                            <tr><th> FeatureID </th><td> {{ $transportfeature->FeatureID }} </td></tr><tr><th> Title </th><td> {{ $transportfeature->Title }} </td></tr><tr><th> ImageIcon </th><td> {{ $transportfeature->ImageIcon }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

