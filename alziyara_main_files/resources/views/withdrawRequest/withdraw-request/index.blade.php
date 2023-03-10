@extends('layouts.master')

@push('css')
<link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
<link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
      type="text/css"/>
@endpush

@section('content')
    <div class="modal fade" id="withdrawPaymentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{url('payment-confirmation')}}" method="post" name="paymentConfirmationForm" id="paymentConfirmationForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Payment Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf()
                        <div class="form-group">
                            <input class="form-control" type="hidden" id="paymentId" name="paymentId" rows="3" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Super Admin Comments for Payment</label>
                            <textarea class="form-control" id="paymentConfirmComments" name="super_admin_comments" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="paymentCommentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
{{--                <form action="{{url('payment-confirmation')}}" method="post" name="paymentConfirmationForm" id="paymentConfirmationForm">--}}
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Payment Confirmation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf()
                        {{--<div class="form-group">--}}
                            {{--<input class="form-control" type="hidden" id="paymentId" name="paymentId" rows="3" required>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            {{--<label for="exampleFormControlTextarea1">Super Admin Comments for Payment</label>--}}
                            <textarea class="form-control" id="paymentComment" name="super_admin_comments" rows="3" required readonly></textarea>
                        </div>
                    </div>
                    {{--<div class="modal-footer">--}}
                        {{--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>--}}
                        {{--<button type="submit" class="btn btn-primary">Send</button>--}}
                    {{--</div>--}}
                {{--</form>--}}
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Withdrawrequest</h3>
                    @can('add-'.str_slug('WithdrawRequest'))
                        <a class="btn btn-success pull-right" href="{{ url('/withdrawRequest/withdraw-request/create') }}"><i
                                    class="icon-plus"></i> Add Withdrawrequest</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>

                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Vendor Email</th>
                                <th>Vendor Name</th>
                                <th>Vendor Contact</th>
                                <th>Category</th>
                                <th>Requested Amount</th>
                                <th>Status</th>
                                {{--<th>Actions</th>--}}
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($withdrawrequest as $item)
                                <tr>
                                    <td class="id">{{ $item->id }}</td>
                                    <td>{{ $item->getVendorDetail->email }}</td>
                                    <td>{{ $item->getVendorDetail->name }}</td>
                                    <td>{{ $item->getVendorDetail->profile->phone }}</td>
                                    <td>
                                        @if($item->category == 1)
                                            Packages
                                        @elseif($item->category == 2)
                                            Hotels
                                        @elseif($item->category == 3)
                                            Transport
                                        @elseif($item->category == 4)
                                            GuestPass
                                        @else
                                            Guide
                                        @endif
                                    </td>
                                    <td class="requested_amount">${{number_format($item->requested_amount,2, '.', ',')}}</td>
                                    <td>
                                        @if($item->is_request_accepted == 1)
                                            <span class="badge badge-success badge-sm @if(Auth::user()->hasRole('SuperAdmin')) send @endif" style="cursor:pointer">@if(Auth::user()->hasRole('SuperAdmin')) SEND @else RECIEVED @endif<span>
                                        @else
                                            <span class="badge badge-danger badge-sm @if(Auth::user()->hasRole('SuperAdmin')) pending @endif" style="cursor:pointer" data-toggle="dropdown">PENDING<span>
                                        @endif
                                    {{--{{$item->is_request_accepted}}</td>--}}
                                    {{--<td>--}}
                                    {{--@can('view-'.str_slug('WithdrawRequest'))--}}
                                    {{--<a href="{{ url('/withdrawRequest/withdraw-request/' . $item->id) }}"--}}
                                    {{--title="View WithdrawRequest">--}}
                                    {{--<button class="btn btn-info btn-sm">--}}
                                    {{--<i class="fa fa-eye" aria-hidden="true"></i> View--}}
                                    {{--</button>--}}
                                    {{--</a>--}}
                                    {{--@endcan--}}
                                    {{----}}
                                    {{--@can('edit-'.str_slug('WithdrawRequest'))--}}
                                    {{--<a href="{{ url('/withdrawRequest/withdraw-request/' . $item->id . '/edit') }}"--}}
                                    {{--title="Edit WithdrawRequest">--}}
                                    {{--<button class="btn btn-primary btn-sm">--}}
                                    {{--<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit--}}
                                    {{--</button>--}}
                                    {{--</a>--}}
                                    {{--@endcan--}}
                                    {{----}}
                                    {{--@can('delete-'.str_slug('WithdrawRequest'))--}}
                                    {{--<form method="POST"--}}
                                    {{--action="{{ url('/withdrawRequest/withdraw-request' . '/' . $item->id) }}"--}}
                                    {{--accept-charset="UTF-8" style="display:inline">--}}
                                    {{--{{ method_field('DELETE') }}--}}
                                    {{--{{ csrf_field() }}--}}
                                    {{--<button type="submit" class="btn btn-danger btn-sm"--}}
                                    {{--title="Delete WithdrawRequest"--}}
                                    {{--onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete--}}
                                    {{--</button>--}}
                                    {{--</form>--}}
                                    {{--@endcan--}}
                                    {{----}}
                                    {{----}}
                                    {{--</td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $withdrawrequest->appends(['search' => Request::get('search')])->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
<script src="{{asset('plugins/components/toast-master/js/jquery.toast.js')}}"></script>

<script src="{{asset('plugins/components/datatables/jquery.dataTables.min.js')}}"></script>
<!-- start - This is for export functionality only -->
<!-- end - This is for export functionality only -->
<script>
    $(document).ready(function () {

        @if(\Session::has('message'))
$.toast({
            heading: 'Success!',
            position: 'top-center',
            text: '{{session()->get('message')}}',
            loaderBg: '#ff6849',
            icon: 'success',
            hideAfter: 3000,
            stack: 6
        });
        @endif
    })

    $(function () {
        $('#myTable').DataTable({
            'aoColumnDefs': [{
                'bSortable': false,
                'aTargets': [-1] /* 1st one, start by the right */
            }]
        });

    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $('.pending').click(function(e){
        $("#paymentId").val($(this).closest("tr").find(".id").text());
        $("#withdrawPaymentModal").modal('show');
    });
    $('.send').click(function(e){
//        alert();

        $.get('{{ URL::to("get-payment-comment")}}/'+$(this).closest("tr").find(".id").text(),function(data){
            console.log(data);
            Swal.fire({
//                icon: '<i class="fa fa-comment"></i>',
                title: '<i class="fa fa-comment" style="font-size: 45px"></i><br>Payment Comments',
                text: data['super_admin_comments'],
            })
        });

//        $("#paymentId").val($(this).closest("tr").find(".id").text());
//        $("#paymentComment").text();
//        $("#paymentCommentModal").modal('show');

    });

</script>

@endpush
