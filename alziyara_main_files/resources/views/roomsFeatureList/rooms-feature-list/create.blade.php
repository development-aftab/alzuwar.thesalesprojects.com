@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <h3 class="box-title pull-left">Create New Room Feature</h3>
                    @can('view-'.str_slug('RoomsFeatureList'))
                    <a  class="btn btn-success pull-right" href="{{url('/roomsFeatureList/rooms-feature-list')}}"><i class="icon-arrow-left-circle"></i> Show all Room Features </a>
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

                    <form method="POST" action="{{ url('/roomsFeatureList/rooms-feature-list') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        @include ('roomsFeatureList.rooms-feature-list.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
