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
                    <h3 class="box-title pull-left">Discover {{ $discover->id }}</h3>
                    @can('view-'.str_slug('Discover'))
                        <a class="btn btn-success pull-right" href="{{ url('/discover/discover') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $discover->id }}</td>
                            </tr>
                            <tr><th> Image </th><td> <img src="{{asset('website')}}/{{ $discover->image??''}}" id="imagePreview_1" width="100" height="100"></td></tr><tr><th> Title </th><td> {{ $discover->title }} </td></tr><tr><th> Link </th><td> {{ $discover->link }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

