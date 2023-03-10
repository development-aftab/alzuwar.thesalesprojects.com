@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">WithdrawRequest {{ $withdrawrequest->id }}</h3>
                    @can('view-'.str_slug('WithdrawRequest'))
                        <a class="btn btn-success pull-right" href="{{ url('/withdrawRequest/withdraw-request') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $withdrawrequest->id }}</td>
                            </tr>
                            <tr><th> Vendor Id </th><td> {{ $withdrawrequest->vendor_id }} </td></tr><tr><th> Category </th><td> {{ $withdrawrequest->category }} </td></tr><tr><th> Requested Amount </th><td> {{ $withdrawrequest->requested_amount }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

