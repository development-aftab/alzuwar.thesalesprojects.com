@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Package {{ $managesetting->id }}</h3>
                    @can('view-'.str_slug('ManageSetting'))
                        <a class="btn btn-success pull-right" href="{{ url('/manageSetting/manage-setting') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $managesetting->id }}</td>
                            </tr>
                            <tr><th> Product Category </th><td> {{ $managesetting->product_category??''}} </td></tr><tr><th> Package Deals Type</th><td> {{ $managesetting->getPackageDealsType->package_deals_type_desc??'' }} </td></tr><tr><th> Package Deals Name </th><td> {{ $managesetting->package_deals_name??'' }} </td></tr>
                            <tr><th>Status</th><td>{!! $managesetting->status_detail??'' !!}</td></tr>
                            <tr><th>Price</th><td>${{ $managesetting->price??'' }}</td></tr>
                            <tr><th>Maximum occupancy</th><td>{{ $managesetting->max_occupancy??'' }}</td></tr>
                            <tr><th>Package deals time</th><td>{{ $managesetting->package_deals_time??'' }}</td></tr>
                            <tr><th>Package deals location</th><td>{{ $managesetting->package_deals_location??''}}</td></tr>
                            <tr><th>Display on homepage</th><td>{{ $managesetting->display_on_home_page??'' }}</td></tr>
                            <tr><th>Package deals create by</th><td>{{ $managesetting->package_deals_create_by??''}}</td></tr>
                            <tr><th>Package Available From </th><td>{{ \Carbon\Carbon::parse( $managesetting->package_available_from??'' )->toFormattedDateString() }}</td></tr>
                            <tr><th>Deadline to Register</th><td>{{ \Carbon\Carbon::parse( $managesetting->deadline??'' )->toFormattedDateString() }}</td></tr>
                            <tr><th>Accomodations</th><td>{{ $managesetting->accomodation??''}}</td></tr>
                            <tr><th>Departure Airport</th><td>{{ $managesetting->departure_place??''}}</td></tr>
                            <tr><th>Airfare</th><td>{{ $managesetting->airfare??''}}</td></tr>
                            <tr><th>Guide</th><td>{{ $managesetting->guide??''}}</td></tr>
                            <tr><th>Meals</th><td>{{ $managesetting->meal??''}}</td></tr>
                            <tr> <th>Package deals description</th> <td>{!!$managesetting->package_deals_desc??''!!}</td></tr>
                            <tr><th>Package deals itenerary</th><td>{!! $managesetting->package_deals_itinerary??''!!}</td></tr>
                            <tr><th>Package House Rules</th><td>{!! $managesetting->house_rules??''!!}</td></tr>
                            <tr><th>Images</th>
                                <td>
                                @foreach($managesetting->getPackageDealsAllPhotos as $photo)
                                <img src="{{asset('website/' .$photo->PhotoLocation)}}" width="200px" height="200px">
                                @endforeach
                                </td>
                            </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

