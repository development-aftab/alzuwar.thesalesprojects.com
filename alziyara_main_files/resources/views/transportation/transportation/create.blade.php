@extends('layouts.master')
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Create New Transportation</h3>
                    @can('view-'.str_slug('Transportation'))
                    <a  class="btn btn-success pull-right" href="{{url('/transportation/transportation')}}"><i class="icon-arrow-left-circle"></i> Show All Transportation</a>
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

                    <form method="POST" action="{{ url('/transportation/transportation') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('transportation.transportation.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
