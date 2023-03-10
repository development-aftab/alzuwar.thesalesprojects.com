@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">PropertyFavorite {{ $propertyfavorite->id }}</h3>
                    @can('view-'.str_slug('PropertyFavorite'))
                        <a class="btn btn-success pull-right" href="{{ url('/propertyFavorite/property-favorite') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $propertyfavorite->id }}</td>
                            </tr>
                            <tr><th> User Id </th><td> {{ $propertyfavorite->user_id }} </td></tr><tr><th> Property Id </th><td> {{ $propertyfavorite->property_id }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

