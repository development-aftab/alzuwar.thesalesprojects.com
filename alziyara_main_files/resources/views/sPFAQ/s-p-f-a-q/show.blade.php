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
                    <h3 class="box-title pull-left">SPFAQ {{ $spfaq->id }}</h3>
                    @can('view-'.str_slug('SPFAQ'))
                        <a class="btn btn-success pull-right" href="{{ url('/sPFAQ/s-p-f-a-q') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $spfaq->id }}</td>
                            </tr>
                            <tr><th> Title </th><td> {{ $spfaq->title }} </td></tr><tr><th> Description </th><td> {!! $spfaq->description !!}  </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

