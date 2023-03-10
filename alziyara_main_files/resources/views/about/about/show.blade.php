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
                    <h3 class="box-title pull-left">pages {{ $about->id }}</h3>
                    @can('view-'.str_slug('About'))
                        <a class="btn btn-success pull-right" href="{{ url('/about/about') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $about->id }}</td>
                            </tr>
                            <tr><th> Title </th><td> {{ $about->title }} </td></tr><tr><th> Description </th><td> {!! $about->description !!} </td></tr>
                            @if($about->image)
                            <tr><th> Image </th><td><img src="{{asset('website')}}/{{ $about->image??''}}" id="imagePreview_1" width="200" height="200"></td></tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

