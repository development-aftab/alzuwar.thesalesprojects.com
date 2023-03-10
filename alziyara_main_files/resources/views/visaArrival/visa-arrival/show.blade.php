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
                    <h3 class="box-title pull-left">VisaArrival {{ $visaarrival->id }}</h3>
                    @can('view-'.str_slug('VisaArrival'))
                        <a class="btn btn-success pull-right" href="{{ url('/visaArrival/visa-arrival') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $visaarrival->id }}</td>
                            </tr>
                            <tr><th> Image </th><td><img src="{{asset('website')}}/{{ $visaarrival->image??''}}" id="imagePreview_1" width="200" height="200"></td></tr><tr><th> Title </th><td> {{ $visaarrival->title }} </td></tr>
                            <tr><th> Case </th><td>@if($visaarrival->status==1) <span class="badge badge-success">Lower Case</span> @else <span class="badge badge-warning">Upper Case</span> @endif </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

