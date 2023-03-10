@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>
@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Transporttype</h3>
                    @can('add-'.str_slug('TransportType'))
                        <a class="btn btn-success pull-right" href="{{ url('/transportType/transport-type/create') }}"><i
                                    class="icon-plus"></i> Add Transporttype</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Number Of Seats</th>
                                <th>Transportation Type Desccription</th>
                                <th>Luggage Capacity</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transporttype as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->TransportationTypeID }}</td>
                                    <td>{{ $item->NumOfSeats }}</td>
                                    <td>{{ $item->TransportationTypeDesc }}</td>
                                    <td>{{ $item->LuggageCapacity }}</td>
                                    <td>
                                        @can('view-'.str_slug('TransportType'))
                                            <a href="{{ url('/transportType/transport-type/' . $item->TransportationTypeID) }}"
                                               title="View TransportType">
                                                <button class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('edit-'.str_slug('TransportType'))
                                            <a href="{{ url('/transportType/transport-type/' . $item->TransportationTypeID . '/edit') }}"
                                               title="Edit TransportType">
                                                <button class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('delete-'.str_slug('TransportType'))
                                            <form method="POST"
                                                  action="{{ url('/transportType/transport-type' . '/' . $item->TransportationTypeID) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete TransportType"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $transporttype->appends(['search' => Request::get('search')])->render() !!} </div>
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

@endpush
