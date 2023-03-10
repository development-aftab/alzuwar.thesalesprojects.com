{{--@extends('layouts.master')--}}
{{--@section('content')--}}
{{--<div class="container-fluid">--}}
{{--<div class="row">--}}
{{--<div class="col-md-12">--}}
{{--<div class="white-box">--}}
{{--<h3 class="box-title pull-left">Edit Transportation #{{ $transportation->id }}</h3>--}}
{{--@can('view-'.str_slug('Transportation'))--}}
{{--<a class="btn btn-success pull-right" href="{{ url('/transportation/transportation') }}">--}}
{{--<i class="icon-arrow-left-circle" aria-hidden="true"></i> Back</a>--}}
{{--@endcan--}}
{{--<div class="clearfix"></div>--}}
{{--<hr>--}}
{{--@if ($errors->any())--}}
{{--<ul class="alert alert-danger">--}}
{{--@foreach ($errors->all() as $error)--}}
{{--<li>{{ $error }}</li>--}}
{{--@endforeach--}}
{{--</ul>--}}
{{--@endif--}}

{{--<form method="POST" action="{{ url('/transportation/transportation/' . $transportation->VehicleRouteID) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">--}}
{{--{{ method_field('PATCH') }}--}}
{{--{{ csrf_field() }}--}}

{{--@include ('transportation.transportation.form', ['submitButtonText' => 'Update'])--}}
{{--</form>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--</div>--}}
{{--@endsection--}}
@extends('layouts.master')
@push('css')
<link href="{{asset('css/customCss.css')}}" rel="stylesheet" />
<link href="{{asset('css/responsive.css')}}" rel="stylesheet" />
<style>.add-photo{width:-webkit-fill-available;}
    .fa-input {
        font-family: FontAwesome, 'Helvetica Neue', Helvetica, Arial, sans-serif;
    }
    .btn-danger{
        width:100%;
    }
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
                    <h3 class="box-title m-b-0">Edit Transportation</h3>
                    <hr>
                    <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                    <form  class="form-horizontal" method="POST" action="{{route('update-transportation')}}" enctype='multipart/form-data'  >
                        {{csrf_field()}}
                        <input type="hidden" name="VehicleRouteID" class="form-control" placeholder="" value="{{$transportation->VehicleRouteID}}">
                        <div class="form-group {{ $errors->has('TransportationTypeID') ? 'has-error' : ''}}">
                            <label for="TransportationTypeID" class="col-md-2 control-label">{{ 'Transportation Type' }}</label>
                            <div class="col-md-10">
                                <select class="form-control" name="TransportationTypeID" id="TransportationTypeID" required>
                                    <option selected disabled>Select Transportation Type</option>
                                    @foreach($transportationTypes as $transportationType)
                                        <option value="{{$transportationType->TransportationTypeID}}" @if(isset($transportation->getTransporttype->TransportationTypeID)) @if($transportationType->TransportationTypeID == $transportation->getTransporttype->TransportationTypeID??'') selected @endif @endif>{{ucfirst($transportationType->TransportationTypeDesc)}}</option>
                                    @endforeach
                                </select>
                                {{--<input class="form-control" name="TransportationTypeID" type="number" id="TransportationTypeID" value="{{ $transportation->TransportationTypeID??''}}" >--}}
                                {!! $errors->first('TransportationTypeID', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Status" class="col-md-2 control-label">{{ 'Routes and Prices' }}</label>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="transport_routes_and_price">
                                            <thead>
                                            <tr>
                                                <th  style="white-space: nowrap;">S.NO.</th>
                                                <th  style="white-space: nowrap;">Route </th>
                                                <th  style="white-space: nowrap;">One Way Route Price</th>
                                                <th  style="white-space: nowrap;">Two Way Route Price</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($transportation->getTransportRoutes))
                                                @foreach($transportation->getTransportRoutes as $key => $transportRoutes)
                                                    <?php $cnt=1; ?>
                                                    <tr>
                                                        <td class="text-center"><span class="s_no">{{ $loop->iteration }}</span></td>
                                                        <td>
                                                            <select class="form-control" name="RouteIDs[]" id="RouteID" required>
                                                                <option selected disabled value="">Select Route</option>
                                                                @foreach($transportationRoutes as $transportationRoute)
                                                                    <option value="{{$transportationRoute->RouteID}}" @if(isset($transportRoutes->RouteID)) @if($transportRoutes->RouteID == $transportationRoute->RouteID??'') selected @endif @endif>{{ucfirst($transportationRoute->RouteFrom)}} to {{ucfirst($transportationRoute->RouteTo)}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td><input type='number' step='any' name='OneWayRouteprice[]' value="{{$transportRoutes->Price??0}}" id="" class='form-control required_colom' placeholder="One Way Route Price" required></td>
                                                        <td><input type='number' step='any' name='TwoWayRouteprice[]' value="{{$transportRoutes->TwoWayPrice??0}}" id="" class='form-control required_colom' placeholder='Two Way Route Price' required></td>
                                                        <td>
                                                            @if($loop->iteration == 1)
                                                                <div class="text-right" style="margin-bottom : 2%">
                                                                    <button type="button" onclick="addTransportRoutesandPrice()" class="btn btn-primary add-photo">+ Add</button>
                                                                    <br />
                                                                </div>
                                                            @else
                                                                <button type='button' class='btn btn-danger remove' >- Remove</button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                        {{--<div class="form-group {{ $errors->has('RouteID') ? 'has-error' : ''}}">--}}
                        {{--<label for="RouteID" class="col-md-2 control-label">{{ 'Route' }}</label>--}}
                        {{--<div class="col-md-10">--}}
                        {{--@if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('user'))--}}
                        {{--<input type="text" value="{{$transportation->getTransportmainroute->RouteID??''}}" class="form-control" name="RouteID" id="RouteID" required readonly>--}}
                        {{--@else--}}
                        {{--<select class="form-control" name="RouteID" id="RouteID" required>--}}
                        {{--<option selected disabled>Select Route</option>--}}
                        {{--@foreach($transportationRoutes as $transportationRoute)--}}
                        {{--<option value="{{$transportationRoute->RouteID}}" @if(isset($transportation->getTransportmainroute->RouteID)) @if($transportationRoute->RouteID == $transportation->getTransportmainroute->RouteID??'') selected @endif @endif>{{ucfirst($transportationRoute->RouteFrom)}} to {{ucfirst($transportationRoute->RouteTo)}}</option>--}}
                        {{--@endforeach--}}
                        {{--</select>--}}
                        {{--@endif--}}
                        {{--{!! $errors->first('RouteID', '<p class="help-block">:message</p>') !!}--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group {{ $errors->has('Price') ? 'has-error' : ''}}">--}}
                        {{--<label for="Price" class="col-md-2 control-label">{{ 'One Way Price' }}</label>--}}
                        {{--<div class="col-md-10">--}}
                        {{--<input class="form-control" name="Price" type="number" id="Price" value="{{ $transportation->Price??''}}" required @if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('user')) readonly @endif>--}}
                        {{--{!! $errors->first('Price', '<p class="help-block">:message</p>') !!}--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group {{ $errors->has('TwoWayPrice') ? 'has-error' : ''}}">--}}
                        {{--<label for="TwoWayPrice" class="col-md-2 control-label">{{ 'Two Way Price' }}</label>--}}
                        {{--<div class="col-md-10">--}}
                        {{--<input class="form-control" name="TwoWayPrice" type="number" id="TwoWayPrice" value="{{ $transportation->TwoWayPrice??''}}" required  @if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('user')) readonly @endif>--}}
                        {{--{!! $errors->first('TwoWayPrice', '<p class="help-block">:message</p>') !!}--}}
                        {{--</div>--}}
                        {{--</div>--}}

                        <div class="form-group {{ $errors->has('FeatureID') ? 'has-error' : ''}}">
                            <label for="FeatureID" class="col-md-2 control-label">{{ 'Features' }}</label>
                            <div class="col-md-10">
                                <div class="row">
                                    @foreach($transportationFeaturesList as $transportationFeature)
                                        <div class="col-md-4">
                                            <input type="checkbox" id="FeatureID" name="FeatureID[]" value="{{$transportationFeature->FeatureID??''}}" @if(isset($transportation->FeatureID)) @if(in_array($transportationFeature->FeatureID, preg_split ("/\,/", $transportation->FeatureID))) checked @endif @endif>
                                            <label for="" title="{{ucfirst($transportationFeature->Description??'')}}"> {{ucfirst($transportationFeature->Title??'')}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                {{--<input class="form-control" name="FeatureID" type="text" id="FeatureID" value="{{ $transportation->FeatureID??''}}" >--}}
                                {!! $errors->first('FeatureID', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('NameofVehicle') ? 'has-error' : ''}}">
                            <label for="NameofVehicle" class="col-md-2 control-label">{{ 'Vehicle Name' }}</label>
                            <div class="col-md-10">
                                <input class="form-control" name="NameofVehicle" type="text" id="NameofVehicle" value="{{ $transportation->NameofVehicle??''}}" required>
                                {!! $errors->first('NameofVehicle', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('NumberPlate') ? 'has-error' : ''}}">
                            <label for="NumberPlate" class="col-md-2 control-label">{{ 'Number Plate #' }}</label>
                            <div class="col-md-10">
                                <input class="form-control" name="NumberPlate" type="text" id="NumberPlate" value="{{ $transportation->NumberPlate??''}}" required>
                                {!! $errors->first('NumberPlate', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('DriverName') ? 'has-error' : ''}}">
                            <label for="DriverName" class="col-md-2 control-label">{{ 'Driver Name' }}</label>
                            <div class="col-md-10">
                                <input class="form-control" name="DriverName" type="text" id="DriverName" value="{{ $transportation->DriverName??''}}" required>
                                {!! $errors->first('DriverName', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('DriverContactNum') ? 'has-error' : ''}}">
                            <label for="DriverContactNum" class="col-md-2 control-label">{{ 'Driver Contact Number' }}</label>
                            <div class="col-md-10">
                                <input class="form-control" name="DriverContactNum" type="text" id="DriverContactNum" value="{{ $transportation->DriverContactNum??''}}" required>
                                {!! $errors->first('DriverContactNum', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('Description') ? 'has-error' : ''}}">
                            <label for="Description" class="col-md-2 control-label">{{ 'Description' }}</label>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="5" name="Description" type="textarea" id="Description" required>{{ $transportation->Description??''}}</textarea>
                                {!! $errors->first('Description', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        <div class="form-group {{ $errors->has('FeaturesAndAmenities') ? 'has-error' : ''}}">
                            <label for="FeaturesAndAmenities" class="col-md-2 control-label">{{ 'FeaturesAndAmenities' }}</label>
                            <div class="col-md-10">
                                <textarea class="form-control" rows="5" name="FeaturesAndAmenities" type="textarea" id="FeaturesAndAmenities" required>{{ $transportation->FeaturesAndAmenities??''}}</textarea>
                                {!! $errors->first('FeaturesAndAmenities', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        {{--<div class="form-group {{ $errors->has('Type') ? 'has-error' : ''}}">--}}
                        {{--<label for="Type" class="col-md-2 control-label">{{ 'Trip Type' }}</label>--}}
                        {{--<div class="col-md-10">--}}
                        {{--<div class="radio_btn">--}}
                        {{--<label><input type="radio" name="Type" id="Type" value="One Way" @if(isset($transportation->Type)) @if($transportation->Type == "One Way") checked @endif @endif> One way</label>--}}
                        {{--<label><input type="radio" name="Type" id="Type" value="Round Trip" @if(isset($transportation->Type)) @if($transportation->Type != "One Way") checked @endif @else checked @endif> Round Trip</label>--}}
                        {{--</div>--}}
                        {{--<input class="form-control" name="Type" type="number" id="Type" value="{{ $transportation->Type??''}}" >--}}
                        {{--{!! $errors->first('Type', '<p class="help-block">:message</p>') !!}--}}
                        {{--</div>--}}
                        {{--</div>--}}


                        @if(Auth::user()->hasrole('SuperAdmin') || Auth::user()->hasrole('admin'))
                            <div class="form-group {{ $errors->has('status_from_admin') ? 'has-error' : ''}}">
                                <label for="Status" class="col-md-2 control-label">{{ 'Status' }}</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="status_from_admin" id="status_from_admin" required>
                                        <option value="1" @if(isset($transportation->status_from_admin)) @if($transportation->status_from_admin == "1") selected @endif @endif>Active</option>
                                        <option value="0" @if(isset($transportation->status_from_admin)) @if($transportation->status_from_admin == "0") selected @endif @endif>Inactive</option>
                                    </select>
                                    <input class="form-control" name="Status" type="hidden" id="Status" value="{{ $transportation->Status??''}}" >
                                    {!! $errors->first('Status', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        @else
                            <div class="form-group {{ $errors->has('Status') ? 'has-error' : ''}}">
                                @if(isset($transportation->status_from_admin)) @if($transportation->status_from_admin == "0")
                                    <p class="col-md-12 text-center text-danger">This transport is inactive by SuperAdmin, please contact our support.</p>
                                @endif @endif
                                <label for="Status" class="col-md-2 control-label">{{ 'Status' }}</label>
                                <div class="col-md-10">
                                    <select class="form-control" name="Status" id="Status" required>
                                        <option value="1" @if(isset($transportation->Status)) @if($transportation->Status == "1") selected @endif @endif>Active</option>
                                        <option value="0" @if(isset($transportation->Status)) @if($transportation->Status == "0") selected @endif @endif>Inactive</option>
                                    </select>
                                    <input class="form-control" name="status_from_admin" type="hidden" id="status_from_admin" value="{{ $transportation->status_from_admin??''}}" >
                                    {!! $errors->first('Status', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                        @endif
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
                                                            <th  style="white-space: nowrap;">PhotoLocation</th>																								<th  style="white-space: nowrap;">Default Image</th>
                                                            <th>Action</th>
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

                                                                    <input type='number' name="photoid[]" step='any' class='form-control required_colom' required='required' placeholder='' value="{{$loop->iteration}}" readonly />
                                                                </td>
                                                                <td>
                                                                    <input type='text' step='any' name='PhotoTitleupload[]' class='form-control required_colom' value="{{$myphotos->PhotoTitle}}" required='required'>
                                                                </td>
                                                                <td>
                                                                    <input type='text' step='any' name='AltTextupload[]' id="can_edu_year"   class='form-control required_colom' value="{{$myphotos->AltText}}"  placeholder="Alternate Text" required='required'>
                                                                </td>
                                                                <td>
                                                                    <img style="height:100px;width:100px;" src="{{asset('website').'/'.$myphotos->PhotoLocation}}">
                                                                </td>
                                                                <td>
                                                                    <input type='file'  step='any' name='PhotoLocationupload[]'  class='form-control required_colom address' >
                                                                </td>
                                                                <td>
                                                                    <input type='radio'  step='any' name='Showimage[]' value="{{$key}}" @if($myphotos->DefaultFlag == "1") checked="checked" @endif value='{{$key}}'  class='form-control required_colom address' >
                                                                </td>
                                                                <td>
                                                                    @if($key == 0)
                                                                        <div class="text-right" style="margin-bottom : 2%">
                                                                            <button type="button" onclick="addedudetails()" class="btn btn-primary add-photo">+ Add Photo</button>
                                                                            <br />
                                                                        </div>
                                                                    @else
                                                                        <button onclick="transportationImageRemove({{$cnt}})"  type='button' class='btn btn-danger removeimage' > - Remove Photo</button>
                                                                    @endif
                                                                </td>
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
                        <div class="form-group text-center">
                            <input class="btn btn-primary fa-input" type='submit' value="&#xf021; UPDATE">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- ===== Right-Sidebar ===== -->
        @include('layouts.partials.right-sidebar')
    </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="{{asset('js/jasny-bootstrap.js')}}"></script>
<script>
    $('#summernote').summernote({
        minHeight: null,             // set minimum height of editor
        maxHeight: 200,
        tabsize: 2,
        height: 200,
        blockquoteBreakingLevel: 0,
        disableDragAndDrop: true,
        toolbar: [
            // [groupName, [list of button]]
            ['fontname', ['fontname']],
            ['style', ['bold', 'italic', 'underline']],
            ['fontsize', ['fontsize']],
            ['fontNames', ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['color', ['color']],
            ['view', ['fullscreen', 'codeview']]
        ],
        placeholder: 'Write here...',
        insertOrderedList:true,
    });
    $('#Description,#FeaturesAndAmenities,#Houserules,#summerhousehours').summernote({
        minHeight: null,             // set minimum height of editor
        maxHeight: 200,
        tabsize: 2,
        height: 200,
        blockquoteBreakingLevel: 0,
        disableDragAndDrop: true,
        toolbar: [
            // [groupName, [list of button]]
            ['fontname', ['fontname']],
            ['style', ['bold', 'italic', 'underline']],
            ['fontsize', ['fontsize']],
            ['fontNames', ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['color', ['color']],
            ['table', ['table']],
            ['view', ['fullscreen', 'codeview']]
        ],
        placeholder: 'Write here...',
        insertOrderedList:true,
    });
    {{--function guestpassprogramdetailremove(id){--}}
    {{--// console.log(id);--}}
    {{--swal({--}}
    {{--title: "Are you sure?",--}}
    {{--text: "Once deleted, you will not be able to recover this Program!",--}}
    {{--icon: "warning",--}}
    {{--buttons: true,--}}
    {{--dangerMode: true,--}}
    {{--})--}}
    {{--.then((willDelete) => {--}}
    {{--if (willDelete) {--}}


    {{--// console.log($('.removeimage').closest('tr'));--}}

    {{--var rowid = "#myprogramremoverrow-"+id;--}}

    {{--console.log(rowid);--}}

    {{--jQuery(rowid).remove();--}}



    {{--$.get('{{ URL::to("guestprogramdetailpassremove")}}/'+id,function(data){--}}

    {{--// window.location.reload();--}}

    {{--});--}}


    {{--swal("Your Program status has been removed!", {--}}
    {{--icon: "success",--}}
    {{--});--}}
    {{--} else {--}}
    {{--swal("Your Program status has not changed!");--}}
    {{--}--}}
    {{--});--}}
    {{--}--}}

    function transportationImageRemove(id) {
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this Photo!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
            .then((willDelete) => {
            if (willDelete) {
                var rowid = "#myphotoremoverrow-"+id;
                jQuery(rowid).remove();
                $.get('{{ URL::to("transport-image-remove")}}/'+id,function(data){});
                swal("Your Image has been removed!", {
                    icon: "success",
                });
            } else {
                swal("Your Image status has not changed!");
    }
    });
    }
    {{--function transportationImageRemove(id) {--}}
    {{--swal({--}}
    {{--title: "Are you sure?",--}}
    {{--text: "Once deleted, you will not be able to recover this Photo!",--}}
    {{--icon: "warning",--}}
    {{--buttons: true,--}}
    {{--dangerMode: true,--}}
    {{--})--}}
    {{--.then((willDelete) => {--}}
    {{--if (willDelete) {--}}
    {{--var rowid = "#myphotoremoverrow-"+id;--}}
    {{--jQuery(rowid).remove();--}}
    {{--$.get('{{ URL::to("guestphotopassremove")}}/'+id,function(data){--}}
    {{--});--}}
    {{--swal("Your Image status has been removed!", {--}}
    {{--icon: "success",--}}
    {{--});--}}
    {{--} else {--}}
    {{--swal("Your Image status has not changed!");--}}
    {{--}--}}
    {{--});--}}
    {{--}--}}

    function addedudetails() {
        if($('#preempform tr').length<7){
            var table = document.getElementById("preempform");
            var rowCount = $('#preempform tr').length;
            var row = table.insertRow(rowCount);
            // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
            var hotelLocationId = "HotelLocation" + rowCount;
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            var cell4 = row.insertCell(3);
            var cell5 = row.insertCell(4);
            var cell6 = row.insertCell(5);
            var cell7 = row.insertCell(6);
            var jaja = 1;
            var pappu = rowCount;
            var jhama = pappu - jaja;
            var indexrowcount = jhama - jaja;
            // console.log(jhama) ;
            cell1.innerHTML = "<input type='number' step='any'  class='form-control required_colom' required='required' placeholder='' value=" + jhama + " readonly />";
            cell2.innerHTML = "<input type='text' step='any' name='PhotoTitle[]'    class='form-control required_colom' required='required' />";
            cell3.innerHTML = "<input type='text' step='any' name='AltText[]' id='can_edu_year'  class='form-control required_colom datepick' required='required' placeholder='Alternate Text' />";
            cell4.innerHTML = "";
            cell5.innerHTML = "<input type='file' step='any' name='PhotoLocation[]' accept='image/png, image/gif, image/jpeg' class='form-control required_colom address' required='required' />";
            cell6.innerHTML = "<input type='radio' step='any' name='Showimage[]' value=" + indexrowcount + " class='form-control required_colom address' required='required' />";
            $("#can_edu_year").each(function () {
            });
            if (jhama == 1) {
                cell7.innerHTML = "<button  type='button' class='btn btn-danger'>- Remove Photo</button>";
            } else {
                cell7.innerHTML = "<button  type='button' class='btn btn-danger remove'>- Remove Photo</button>";
            }
        }else {
            alert('You can not add more than 5 images');
        }
    }
    $('#preempform').on('click', '.remove', function(e){
        $(this).closest('tr').remove();
    })
    function addprogramdetails(){
        var table = document.getElementById("prodetail");
        var rowCount = $('#prodetail tr').length;
        var row = table.insertRow(rowCount);
        // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
        var hotelLocationId = "HotelLocation"+rowCount;
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        var cell4 = row.insertCell(3);
        var jaja = 1 ;
        var pappu =  rowCount;
        var jhama = pappu -  jaja ;
        // console.log(jhama) ;
        cell1.innerHTML = "<input type='number' step='any'  class='form-control required_colom' required='required' placeholder='' value="+ jhama +" readonly />";
        cell2.innerHTML = "<input type='time' step='any' name='programtime[]'    class='form-control required_colom' required='required' />";
        cell3.innerHTML = "<input type='text' step='any' name='programtimedes[]' id='can_edu_year'  class='form-control required_colom datepick' required='required' placeholder='Short Description' />";
        $("#can_edu_year").each(function() {
        });
        if(jhama == 1){
            cell4.innerHTML = "<button  type='button' class='btn btn-danger'>- Remove Photo</button>";
        }else{
            cell4.innerHTML = "<button  type='button' class='btn btn-danger remove'>- Remove Photo</button>";
        }
    }
    $('#prodetail').on('click', '.remove', function(e){
        $(this).closest('tr').remove();
    })
    {{--var myselectvalue = "[{{$guestPass->ScheduleDays}}]";--}}

    {{--var selectmydata = jQuery.parseJSON( myselectvalue );--}}

    {{--// console.log(selectmydata);--}}

    {{--$('.selectpicker').selectpicker('val',selectmydata);--}}

</script>
<script>
    function addTransportRoutesandPrice(){
        var rowCount = $('#transport_routes_and_price tr').length;
        $('#transport_routes_and_price tr:last').after(
            '<tr>' +
            '<td class="text-center"><span class="s_no">'+rowCount+'</span></td>' +
            '<td><select class="form-control" name="RouteIDs[]" id="RouteID" required><option selected disabled>Select Route</option>@foreach($transportationRoutes as $transportationRoute)<option value="{{$transportationRoute->RouteID}}" @if(isset($transportation->getTransportmainroute->RouteID)) @if($transportationRoute->RouteID == $transportation->getTransportmainroute->RouteID??'') selected @endif @endif>{{ucfirst($transportationRoute->RouteFrom)}} to {{ucfirst($transportationRoute->RouteTo)}}</option>@endforeach</select></td>' +
            '<td><input type="number" step="any" name="OneWayRouteprice[]" class="form-control required_colom datepick" required="required" placeholder="One Way Route Price" /></td>' +
            '<td><input type="number" step="any" name="TwoWayRouteprice[]" class="form-control required_colom datepick" required="required" placeholder="Two Way Route Price" /></td>' +
            '<td><button type="button" class="btn btn-danger remove" >- Remove</button></td>' +
            '</tr>');
    }
    $('#transport_routes_and_price').on('click', '.remove', function(e){
        $(this).closest('tr').remove();
        $("#transport_routes_and_price tr").each(function (index) { // traverse through all the rows
            if(index != 0) { // if the row is not the heading one
                $(this).find("td:first").html(index + ""); // set the index number in the first 'td' of the row
            }
        });
    })
</script>
@endpush