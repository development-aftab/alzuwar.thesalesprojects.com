{{--@extends('layouts.master')--}}

{{--@section('content')--}}
    {{--<div class="container-fluid">--}}
        {{--<!-- .row -->--}}
        {{--<div class="row">--}}
            {{--<div class="col-sm-12">--}}
                {{--<div class="white-box">--}}
                    {{--<h3 class="box-title pull-left">Transportation {{ $transportation->id }}</h3>--}}
                    {{--@can('view-'.str_slug('Transportation'))--}}
                        {{--<a class="btn btn-success pull-right" href="{{ url('/transportation/transportation') }}">--}}
                            {{--<i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>--}}
                    {{--@endcan--}}
                    {{--<div class="clearfix"></div>--}}
                    {{--<hr>--}}
                    {{--<div class="table-responsive">--}}
                        {{--<table class="table table">--}}
                            {{--<tbody>--}}
                            {{--<tr>--}}
                                {{--<th>ID</th>--}}
                                {{--<td>{{ $transportation->id }}</td>--}}
                            {{--</tr>--}}
                            {{--<tr><th> VehicleRouteID </th><td> {{ $transportation->VehicleRouteID }} </td></tr>--}}
                            {{--<tr><th> TransportationOwnerID </th><td> {{ $transportation->TransportationOwnerID }} </td></tr>--}}
                            {{--<tr><th> TransportationTypeID </th><td> {{ $transportation->TransportationTypeID }} </td></tr>--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}

@extends('layouts.master')
@push('css')
    <style>
        .add-photo{width:-webkit-fill-available;}
        .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {background-color: #f7fbff;opacity: 1;}
        .form-control {border: 0px !important;}
    </style>
@endpush
@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(session('message'))
        <!-- <div class="account-title">{{session('message')}}</div> -->
        <div class="account-title">
            <p class="alert alert-success" >{{session('message')}}</p>
        </div>
    @endif

    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">View Transportation</h3>
                    <hr>
                    <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                    <div  class="form-horizontal">
                        {{--{{csrf_field()}}--}}
                        <input type="hidden" name="VehicleRouteID" class="form-control" placeholder="" value="{{$transportation->VehicleRouteID}}">
                        <div class="form-group {{ $errors->has('TransportationTypeID') ? 'has-error' : ''}}">
                            <label for="TransportationTypeID" class="col-md-2 control-label">{{ 'Transportation Type' }}</label>
                            <div class="col-md-10">
                                {{--<label for="Price" class="col-md-2 control-label">{{ 'Transportation Type' }}</label>--}}
                                {{--<div class="col-md-10">--}}
                                @foreach($transportationTypes as $transportationType)
                                    @if(isset($transportation->getTransporttype->TransportationTypeID))
                                        @if($transportationType->TransportationTypeID == $transportation->getTransporttype->TransportationTypeID??'')
                                    <input class="form-control" name="TransportationTypeID" type="text" id="TransportationTypeID" value="{{ucfirst($transportationType->TransportationTypeDesc)}}" required readonly>
                                        @endif
                                    @endif
                                @endforeach
{{--                                    {!! $errors->first('Price', '<p class="help-block">:message</p>') !!}--}}
                                {{--</div>--}}
                                {{--<select class="form-control" name="TransportationTypeID" id="TransportationTypeID" required>--}}
                                    {{--<option selected disabled>Select Transportation Type</option>--}}
                                    {{--@foreach($transportationTypes as $transportationType)--}}
                                        {{--<option value="{{$transportationType->TransportationTypeID}}" @if(isset($transportation->getTransporttype->TransportationTypeID)) @if($transportationType->TransportationTypeID == $transportation->getTransporttype->TransportationTypeID??'') selected @endif @endif>{{ucfirst($transportationType->TransportationTypeDesc)}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                                {{--<input class="form-control" name="TransportationTypeID" type="number" id="TransportationTypeID" value="{{ $transportation->TransportationTypeID??''}}" >--}}
                                {!! $errors->first('TransportationTypeID', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('RouteID') ? 'has-error' : ''}}">
                            <label for="RouteID" class="col-md-2 control-label">{{ 'Route' }}</label>
                            <div class="col-md-10">
                                {{--<select class="form-control" name="RouteID" id="RouteID" required>--}}
                                    {{--<option selected disabled>Select Route</option>--}}
                                    {{--@foreach($transportationRoutes as $transportationRoute)--}}
                                        {{--<option value="{{$transportationRoute->RouteID}}" @if(isset($transportation->getTransportmainroute->RouteID)) @if($transportationRoute->RouteID == $transportation->getTransportmainroute->RouteID??'') selected @endif @endif>{{ucfirst($transportationRoute->RouteFrom)}} to {{ucfirst($transportationRoute->RouteTo)}}</option>--}}
                                    {{--@endforeach--}}
                                {{--</select>--}}
                                @foreach($transportationRoutes as $transportationRoute)
                                    @if(isset($transportation->getTransportmainroute->RouteID))
                                        @if($transportationRoute->RouteID == $transportation->getTransportmainroute->RouteID??'')
                                            <input class="form-control" name="RouteID" type="text" id="RouteID" value="{{ucfirst($transportationRoute->RouteFrom)}} to {{ucfirst($transportationRoute->RouteTo)}}" readonly>
                                        @endif
                                    @endif
                                @endforeach
                                {!! $errors->first('RouteID', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('Price') ? 'has-error' : ''}}">
                            <label for="Price" class="col-md-2 control-label">{{ 'One Way Price' }}</label>
                            <div class="col-md-10">
                                <input class="form-control" name="Price" type="number" id="Price" value="{{number_format($transportation->Price??'', 0, '.', '')}}" required readonly>
                                {!! $errors->first('Price', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('TwoWayPrice') ? 'has-error' : ''}}">
                            <label for="TwoWayPrice" class="col-md-2 control-label">{{ 'TwoWayPrice' }}</label>
                            <div class="col-md-10">
                                <input class="form-control" name="TwoWayPrice" type="number" id="TwoWayPrice" value="{{number_format($transportation->TwoWayPrice??'', 0, '.', '')}}" required readonly>
                                {!! $errors->first('Price', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('FeatureID') ? 'has-error' : ''}}">
                            <label for="FeatureID" class="col-md-2 control-label">{{ 'Features' }}</label>
                            <div class="col-md-10">
                                {{--<div class="row">--}}
                                    {{--@foreach($transportationFeaturesList as $transportationFeature)--}}
                                        {{--<div class="col-md-4">--}}
                                            {{--<input type="checkbox" id="FeatureID" name="FeatureID[]" value="{{$transportationFeature->FeatureID??''}}" @if(isset($transportation->FeatureID)) @if(in_array($transportationFeature->FeatureID, preg_split ("/\,/", $transportation->FeatureID))) checked @endif @endif>--}}
                                            {{--<label for="" title="{{ucfirst($transportationFeature->Description??'')}}"> {{ucfirst($transportationFeature->Title??'')}}</label>--}}
                                        {{--</div>--}}
                                    {{--@endforeach--}}
                                {{--</div>--}}
                                @foreach($transportationFeaturesList as $transportationFeature)
                                {{--<input class="form-control" name="FeatureID" type="text" id="FeatureID" value="{{ $transportation->FeatureID??''}}" >--}}
                                    @if(isset($transportation->FeatureID))
                                        @if(in_array($transportationFeature->FeatureID, preg_split ("/\,/", $transportation->FeatureID)))
                                    <div class="col-md-4">
                                    <input type="checkbox" id="FeatureID" name="FeatureID[]" value="{{$transportationFeature->FeatureID??''}}" @if(isset($transportation->FeatureID)) @if(in_array($transportationFeature->FeatureID, preg_split ("/\,/", $transportation->FeatureID))) checked @endif @endif disabled>
                                    <label for="" title="{{ucfirst($transportationFeature->Description??'')}}"> {{ucfirst($transportationFeature->Title??'')}}</label>
                                    </div>
                                        @endif
                                    @endif
                                @endforeach
                                {!! $errors->first('FeatureID', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('NameofVehicle') ? 'has-error' : ''}}">
                            <label for="NameofVehicle" class="col-md-2 control-label">{{ 'Vehicle Name' }}</label>
                            <div class="col-md-10">
                                <input class="form-control" name="NameofVehicle" type="text" id="NameofVehicle" value="{{ $transportation->NameofVehicle??''}}" required readonly>
                                {!! $errors->first('NameofVehicle', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('NumberPlate') ? 'has-error' : ''}}">
                            <label for="NumberPlate" class="col-md-2 control-label">{{ 'Number Plate #' }}</label>
                            <div class="col-md-10">
                                <input class="form-control" name="NumberPlate" type="text" id="NumberPlate" value="{{ $transportation->NumberPlate??''}}" required readonly>
                                {!! $errors->first('NumberPlate', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('DriverName') ? 'has-error' : ''}}">
                            <label for="DriverName" class="col-md-2 control-label">{{ 'Driver Name' }}</label>
                            <div class="col-md-10">
                                <input class="form-control" name="DriverName" type="text" id="DriverName" value="{{ $transportation->DriverName??''}}" required readonly>
                                {!! $errors->first('DriverName', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('DriverContactNum') ? 'has-error' : ''}}">
                            <label for="DriverContactNum" class="col-md-2 control-label">{{ 'Driver Contact Number' }}</label>
                            <div class="col-md-10">
                                <input class="form-control" name="DriverContactNum" type="text" id="DriverContactNum" value="{{ $transportation->DriverContactNum??''}}" required readonly>
                                {!! $errors->first('DriverContactNum', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('Description') ? 'has-error' : ''}}">
                            <label for="Description" class="col-md-2 control-label">{{ 'Description' }}</label>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="5" name="Description" type="textarea" id="Description" required readonly>{{ $transportation->Description??''}}</textarea>
                                {!! $errors->first('Description', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
						<div class="form-group {{ $errors->has('Houserules') ? 'has-error' : ''}}">
                            <label for="Houserules" class="col-md-2 control-label">{{ 'Houserules' }}</label>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="5" name="Houserules" type="textarea" id="Houserules" required readonly>{{ $transportation->Houserules??''}}</textarea>
                                {!! $errors->first('Houserules', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('FeaturesAndAmenities') ? 'has-error' : ''}}">
                            <label for="FeaturesAndAmenities" class="col-md-2 control-label">{{ 'FeaturesAndAmenities' }}</label>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="5" name="FeaturesAndAmenities" type="textarea" id="FeaturesAndAmenities" required readonly>{{ $transportation->FeaturesAndAmenities??''}}</textarea>
                                {!! $errors->first('FeaturesAndAmenities', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('Type') ? 'has-error' : ''}}">
                            <label for="Type" class="col-md-2 control-label">{{ 'Trip Type' }}</label>
                            <div class="col-md-10">
                                {{--<div class="radio_btn">--}}
                                    {{--<label><input type="radio" name="Type" id="Type" value="One Way" @if(isset($transportation->Type)) @if($transportation->Type == "One Way") checked @endif @endif> One way</label>--}}
                                    {{--<label><input type="radio" name="Type" id="Type" value="Round Trip" @if(isset($transportation->Type)) @if($transportation->Type != "One Way") checked @endif @else checked @endif> Round Trip</label>--}}
                                {{--</div>--}}
                                <input class="form-control" name="Type" type="text" id="Type" value="{{ $transportation->Type??''}}" readonly>
                                {!! $errors->first('Type', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('Status') ? 'has-error' : ''}}">
                            @if(isset($transportation->status_from_admin)) @if($transportation->status_from_admin == "0")
                                <p class="col-md-12 text-center text-danger">This transport is inactive by SuperAdmin, please contact our support.</p>
                            @endif @endif
                            <label for="Status" class="col-md-2 control-label">{{ 'Status' }}</label>
                            <div class="col-md-10">
                                {{--<select class="form-control" name="Status" id="Status" required>--}}
                                    {{--<option value="1" @if(isset($transportation->Status)) @if($transportation->Status == "1") selected @endif @endif>Active</option>--}}
                                    {{--<option value="0" @if(isset($transportation->Status)) @if($transportation->Status == "0") selected @endif @endif>Inactive</option>--}}
                                {{--</select>--}}
                                <input class="form-control" name="Status" type="text" id="Status" value="@if($transportation->Status == "1") Active @else Inactive @endif" readonly>
                                {!! $errors->first('Status', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Status" class="col-md-2 control-label">{{ 'Transport Images' }}</label>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <div class="payroll-table card">
                                        <div class="table-responsive">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="preempform">
                                                        <thead>
                                                        <tr>
                                                            <th  style="white-space: nowrap;">S.NO.</th>
                                                            <th  style="white-space: nowrap;">Photo Title</th>
                                                            <th  style="white-space: nowrap;">AltText</th>
                                                            <th  style="white-space: nowrap;">Photo</th>
                                                            <th  style="white-space: nowrap;">Default Image</th>
                                                            {{--<th>Action</th>--}}
                                                        </tr>
                                                        <tr>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($transportation->getTransportPics as $key => $myphotos)
                                                            <?php $cnt=$myphotos->PhotoID; ?>
                                                            <tr id="myphotoremoverrow-{{$cnt}}">
                                                                <td>
                                                                    <input type='hidden' name="photoidupload[]" step='any' class='form-control required_colom' required='required' placeholder='' value="{{$cnt}}" readonly />

                                                                    <input type='number' name="photoid[]" step='any' class='form-control required_colom' required='required' placeholder='' value="{{$key}}" readonly />
                                                                </td>
                                                                <td>
                                                                    <input type='text' step='any' name='PhotoTitleupload[]' class='form-control required_colom' value="{{$myphotos->PhotoTitle}}" required='required' readonly>
                                                                </td>
                                                                <td>
                                                                    <input type='text' step='any' name='AltTextupload[]' id="can_edu_year"   class='form-control required_colom' value="{{$myphotos->AltText}}"  placeholder="Alternate Text" required='required' readonly>
                                                                </td>
                                                                <td>
                                                                    <img style="height:100px;width:100px;" src="{{asset('website').'/'.$myphotos->PhotoLocation}}">
                                                                </td>
                                                                {{--<td>--}}
                                                                    {{--<input type='file'  step='any' name='PhotoLocationupload[]'  class='form-control required_colom address' >--}}
                                                                {{--</td>--}}
                                                                <td>
                                                                    <input type='radio'  step='any' name='Showimage[]' value="{{$key}}" @if($myphotos->DefaultFlag == "1") checked="checked" @endif value='{{$key}}'  class='form-control required_colom address' disabled>
                                                                </td>
                                                                {{--<td>--}}
                                                                    {{--@if($key == 0)--}}
                                                                        {{--<div class="text-right" style="margin-bottom : 2%">--}}
                                                                            {{--<button type="button" onclick="addedudetails()" class="btn btn-primary add-photo">+ Add Photo</button>--}}
                                                                            {{--<br />--}}
                                                                        {{--</div>--}}
                                                                    {{--@else--}}
                                                                        {{--<button onclick="transportationImageRemove({{$cnt}})"  type='button' class='btn btn-danger removeimage' > - Remove Photo</button>--}}
                                                                    {{--@endif--}}
                                                                {{--</td>--}}
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<input class="btn btn-primary" type='submit' value="UPDATE">--}}
                        {{--</div>--}}
                    </div>
                </div>
            </div>
        </div>
        <!-- ===== Right-Sidebar ===== -->
        @include('layouts.partials.right-sidebar')
    </div>
@endsection

@push('js')
@endpush