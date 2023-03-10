@extends('layouts.master')
@push('css')
    <style>
        .add-photo{width:-webkit-fill-available;}
        .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {background-color: #f7fbff;opacity: 1;}
        .form-control {border: 0px !important;}
    </style>
@endpush
@section('content')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box">
                    <h3 class="box-title m-b-0">View Guide</h3>
                    <hr>
                    <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                    <div  class="form-horizontal">
    <input class="form-control" name="GuidesCreatedBy" type="hidden" id="GuidesCreatedBy" value="{{ Auth::user()->id??''}}">

<div class="form-group {{ $errors->has('GuidesName') ? 'has-error' : ''}}">
    <label for="GuidesName" class="col-md-2 control-label">{{ 'Guides Name' }}</label>
    <div class="col-md-10">
        <input class="form-control" name="GuidesName" type="text" id="GuidesName" value="{{ $guid->GuidesName??''}}" required readonly>
        {!! $errors->first('GuidesName', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('GuidesDesc') ? 'has-error' : ''}}">
    <label for="GuidesDesc" class="col-md-2 control-label">{{ 'Guides Description' }}</label>
    <div class="col-md-10">
        <textarea class="form-control" rows="5" name="GuidesDesc" type="textarea" id="GuidesDesc" readonly>{!! $guid->GuidesDesc??'' !!}</textarea>
        {!! $errors->first('GuidesDesc', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('PricePerDay') ? 'has-error' : ''}}">
    <label for="PricePerDay" class="col-md-2 control-label">{{ 'Price Per Day' }}</label>

    <div class="col-md-10">
        <div class="input-group">
            <input class="form-control" name="PricePerDay" type="number" id="PricePerDay" value="{{ $guid->PricePerDay??''}}" readonly>
            <span class="input-group-addon" title="Dollars">$</span>
            {!! $errors->first('PricePerDay', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('MaxOccupancy') ? 'has-error' : ''}}">
    <label for="MaxOccupancy" class="col-md-2 control-label">{{ 'Maximum Occupancy' }}</label>
    <div class="col-md-10">
        <input class="form-control" name="MaxOccupancy" type="number" id="MaxOccupancy" value="{{ $guid->MaxOccupancy??''}}" readonly>
        {!! $errors->first('MaxOccupancy', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('GuidesLocation') ? 'has-error' : ''}}">
    <label for="GuidesLocation" class="col-md-2 control-label">{{ 'Guideslocation' }}</label>
    <div class="col-md-10">
        {{--<select class="form-control" name="GuidesLocation" id="GuidesLocation" required>--}}
            {{--@foreach($cities as $city)--}}
                {{--<option value="{{$city->city_name??''}}" @if(isset($city->city_name)) @if($city->city_name == "1") selected @endif @endif>{{$city->city_name??''}}</option>--}}
            {{--@endforeach--}}
        {{--</select>--}}
        <input class="form-control" name="GuidesLocation" type="text" id="GuidesLocation" value="{{ $guid->GuidesLocation??''}}" readonly>
        {!! $errors->first('GuidesLocation', '<p class="help-block">:message</p>') !!}
    </div>
</div>

{{--<div class="form-group {{ $errors->has('DaysInTrip') ? 'has-error' : ''}}">
    <label for="DaysInTrip" class="col-md-2 control-label">{{ 'Days In Trip' }}</label>
    <div class="col-md-10">
        <div class="input-group">
            <input class="form-control" name="DaysInTrip" type="number" id="DaysInTrip" value="{{ $guid->DaysInTrip??''}}" readonly>
            <span class="input-group-addon" title="Days">Days</span>
            {!! $errors->first('DaysInTrip', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group {{ $errors->has('guide_startdate') ? 'has-error' : ''}}">
    <label for="guide_startdate" class="col-md-2 control-label">{{ 'Guide Start Date' }}</label>
    <div class="col-md-10">
        <input class="form-control" name="guide_startdate" type="text" id="guide_startdate" value="{{ $guid->guide_startdate??''}}" readonly>
        {!! $errors->first('guide_startdate', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('guide_enddate') ? 'has-error' : ''}}">
    <label for="guide_enddate" class="col-md-2 control-label">{{ 'Guide End Date' }}</label>
    <div class="col-md-10">
        <input class="form-control" name="guide_enddate" type="text" id="guide_enddate" value="{{ $guid->guide_enddate??''}}" readonly>
        {!! $errors->first('guide_enddate', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('guide_deadlinedate') ? 'has-error' : ''}}">
    <label for="guide_deadlinedate" class="col-md-2 control-label">{{ 'Guide Deadline Date' }}</label>
    <div class="col-md-10">
        <input class="form-control" name="guide_deadlinedate" type="text" id="guide_deadlinedate" value="{{ $guid->guide_deadlinedate??''}}" readonly>
        {!! $errors->first('guide_deadlinedate', '<p class="help-block">:message</p>') !!}
    </div>
</div>--}}

<div class="form-group {{ $errors->has('HouseRules') ? 'has-error' : ''}}">
    <label for="HouseRules" class="col-md-2 control-label">{{ 'Houserules (Rules,Meeting Location and Time)' }}</label>
    <div class="col-md-10">
        <textarea class="form-control" rows="5" name="HouseRules" type="textarea" id="HouseRules" readonly>{!! $guid->HouseRules??''!!}</textarea>
        {!! $errors->first('HouseRules', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('Languages') ? 'has-error' : ''}}">
    <label for="Languages" class="col-md-2 control-label">{{ 'Languages' }}</label>
    <div class="col-md-10">
    <input class="form-control" name="Languages" type="text" id="Languages" value="{{ $guid->Languages??''}}" readonly>
    {!! $errors->first('Languages', '<p class="help-block">:message</p>') !!}
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
                                    @foreach($guid->getGuidePics as $key => $myphotos)
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
                                            <td>
                                                <input type='radio'  step='any' name='Showimage[]' value="{{$key}}" @if($myphotos->DefaultFlag == "1") checked="checked" @endif value='{{$key}}'  class='form-control required_colom address' disabled>
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

<div class="form-group {{ $errors->has('Status') ? 'has-error' : ''}}">
    <label for="Status" class="col-md-2 control-label">{{ 'Status' }}</label>
    <div class="col-md-10">
        <input class="form-control" name="Status" type="text" id="Status" value="@if($guid->GuidesStatus == 1) Active @else Inactive @endif" readonly>
        {!! $errors->first('Status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
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