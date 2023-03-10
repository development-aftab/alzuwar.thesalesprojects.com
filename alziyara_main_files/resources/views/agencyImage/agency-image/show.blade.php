@extends('layouts.master')
@push('css')
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
@endpush
@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">AgencyImage {{ $agencyimage->id }}</h3>
                    @can('view-'.str_slug('AgencyImage'))
                        <a class="btn btn-success pull-right" href="{{ url('/agencyImage/agency-image') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $agencyimage->id }}</td>
                            </tr>
                            <tr><th> Image </th><td><img src="{{asset('website')}}/{{ $agencyimage->image??''}}" id="imagePreview_1" width="200" height="200"></td></tr><tr><th> Status </th><td>@if($agencyimage->status==1) <span class="badge badge-success">Active</span> @else <span class="badge badge-danger">Inactive</span> @endif </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

