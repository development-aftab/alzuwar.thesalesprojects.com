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
                    <h3 class="box-title pull-left">Blog {{ $blog->id }}</h3>
                    @can('view-'.str_slug('Blog'))
                        <a class="btn btn-success pull-right" href="{{ url('/blog/blog') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $blog->id }}</td>
                            </tr>
                            <tr><th> Main Image </th><td><img src="{{asset('website')}}/{{ $blog->image??''}}" id="imagePreview_1"  width="auto" height="auto"></td></tr><tr><th> Title </th><td> {{ $blog->title }} </td></tr><tr><th> Blog </th><td> {!! $blog->blog !!} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

