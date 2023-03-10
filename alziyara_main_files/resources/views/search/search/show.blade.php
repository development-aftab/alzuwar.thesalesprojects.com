@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Search {{ $search->id }}</h3>
                    @can('view-'.str_slug('Search'))
                        <a class="btn btn-success pull-right" href="{{ url('/search/search') }}">
                            <i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{ $search->id??'' }}</td>
                            </tr>
                            <tr><th> Package Vendor Name </th><td> {{ $user->name??'' }} </td></tr>
                            <tr><th> Package Vendor Email </th><td> {{ $user->email??'' }} </td></tr>


                            <tr><th> Receipt Num </th><td> {{ $search->receipt_num??'' }} </td></tr>
                            <tr><th> Package Deals Type </th><td> {{ $search->package_deals_id??'' }} </td></tr>
                            @if(auth()->user()->hasrole('SuperAdmin'))
                                <tr><th> Package Donation </th><td> {!!  $search->donation_detail !!} </td></tr>
                                <tr><th> Package Insurance </th><td> {!! $search->insurance_detail !!} </td></tr>
                            @endif
                            <tr><th> Qty </th><td> {{ $search->qty??'' }} </td></tr>
                            <tr><th> Created By </th><td> {{ $search->created_by??'' }} </td></tr>
                            <tr><th> Reservation for date </th><td> {{ $search->reservation_for_date??'' }} </td></tr>
                            <tr><th> Notes for customer </th><td> {{ $search->notes_by_customer??'' }} </td></tr>
                            <tr><th> Booking status </th><td> {{ $search->booking_status??'' }} </td></tr>
                            <tr><th> Payment status </th><td> {{ $search->payment_status??'' }} </td></tr>
                            <tr><th> SP Comments </th><td> {{ $search->	sp_comments??'' }} </td></tr>
                            <tr><th> SP Comments Date/Time </th><td> {{ $search->sp_comments_date_time??'' }} </td></tr>
                            <tr><th> Reservation For Date </th><td> {{ $search->reservation_for_date??'' }} </td></tr>
                            <tr><th> Notes For Customer </th><td> {{ $search->notes_by_customer??'' }} </td></tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

