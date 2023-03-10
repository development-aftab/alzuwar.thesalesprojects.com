@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">PackageDealType {{ $packagedealtype->id }}</h3>
                    @can('view-'.str_slug('PackageDealType'))
                        <a class="btn btn-success pull-right" href="{{ url('/packageDealType/package-deal-type') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $packagedealtype->id }}</td>
                            </tr>
                            <tr><th> Package Deals Type Desc </th><td> {{ $packagedealtype->package_deals_type_desc }} </td></tr><tr><th> Status </th><td> {!! $packagedealtype->status_detail !!} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

