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
                    <h3 class="box-title pull-left">TravelAgency {{ $travelagency->id }}</h3>
                    @can('view-'.str_slug('TravelAgency'))
                        <a class="btn btn-success pull-right" href="{{ url('/travelAgency/travel-agency') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $travelagency->id }}</td>
                            </tr>
                            <tr><th> Name </th><td> {{ $travelagency->name }} </td></tr><tr><th> Contact </th><td> {{ $travelagency->contact }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

