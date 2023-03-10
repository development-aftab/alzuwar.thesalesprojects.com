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
                    <h3 class="box-title pull-left">Contact {{ $contact->id }}</h3>
                    @can('view-'.str_slug('Contact'))
                        <a class="btn btn-success pull-right" href="{{ url('/contact/contact') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $contact->id }}</td>
                            </tr>
                            <tr><th> First Name </th><td> {{ $contact->first_name }} </td></tr><tr><th> Last Name </th><td> {{ $contact->last_name }} </td></tr><tr><th> Email </th><td> {{ $contact->email }} </td></tr>
                            <tr><th> Message </th><td> {{ $contact->description }} </td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

