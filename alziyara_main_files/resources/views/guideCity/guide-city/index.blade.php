@extends('layouts.master')

@push('css')
    <link href="{{asset('plugins/components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
@endpush

@section('content')
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Settings - Guide Cities</h3>
                    @can('add-'.str_slug('GuideCity'))
                        <a class="btn btn-success pull-right" href="{{ url('/guideCity/guide-city/create') }}"><i
                                    class="icon-plus"></i> Add Guide City</a>
                    @endcan
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>City Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($guidecity as $item)
                                <tr>
                                    <td>{{ $loop->iteration??$item->id }}</td>
                                    <td>{{ $item->city_name }}</td>
                                    <td>@if($item->status == 1) <span class="label label-success">Active</span> @else <span class="label label-warning">Inactive</span> @endif</td>
                                    <td>
                                        {{--@can('view-'.str_slug('GuideCity'))--}}
                                            {{--<a href="{{ url('/guideCity/guide-city/' . $item->id) }}"--}}
                                               {{--title="View GuideCity">--}}
                                                {{--<button class="btn btn-info btn-sm">--}}
                                                    {{--<i class="fa fa-eye" aria-hidden="true"></i>--}}
                                                {{--</button>--}}
                                            {{--</a>--}}
                                        {{--@endcan--}}

                                        @can('edit-'.str_slug('GuideCity'))
                                            <a href="{{ url('/guideCity/guide-city/' . $item->id . '/edit') }}"
                                               title="Edit GuideCity">
                                                <button class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        @endcan

                                        @can('delete-'.str_slug('GuideCity'))
                                            <form method="POST"
                                                  action="{{ url('/guideCity/guide-city' . '/' . $item->id) }}"
                                                  accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete GuideCity"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                        @endcan


                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> {!! $guidecity->appends(['search' => Request::get('search')])->render() !!} </div>
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
