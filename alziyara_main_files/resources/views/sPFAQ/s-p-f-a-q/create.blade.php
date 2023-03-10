@extends('layouts.master')

@push('css')

<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Create New SPFAQ</h3>
                    @can('view-'.str_slug('SPFAQ'))
                    <a  class="btn btn-success pull-right" href="{{url('/sPFAQ/s-p-f-a-q')}}"><i class="icon-arrow-left-circle"></i> Add SPFAQ</a>
                    @endcan

                    <div class="clearfix"></div>
                    <hr>
                    @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <form method="POST" action="{{ url('/sPFAQ/s-p-f-a-q') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('sPFAQ.s-p-f-a-q.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection