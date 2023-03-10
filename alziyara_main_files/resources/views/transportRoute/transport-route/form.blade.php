{{--<div class="form-group {{ $errors->has('RouteID') ? 'has-error' : ''}}">--}}
    {{--<label for="RouteID" class="col-md-4 control-label">{{ 'Routeid' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="RouteID" type="number" id="RouteID" value="{{ $transportroute->RouteID??''}}" >--}}
        {{--{!! $errors->first('RouteID', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group {{ $errors->has('RouteName') ? 'has-error' : ''}}">--}}
    {{--<label for="RouteName" class="col-md-4 control-label">{{ 'Route Name' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="RouteName" type="text" id="RouteName" value="{{ $transportroute->RouteName??''}}" >--}}
        {{--{!! $errors->first('RouteName', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
@push('css')
    <link href="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
    <style>
        ._jw-tpk-hour,._jw-tpk-minute {color: black;}
        ._jw-tpk-container{border: 2px solid #7199E9;}
        ._jw-tpk-header{border-bottom: 2px solid #7199E9;}
    </style>
@endpush
<div class="form-group {{ $errors->has('RouteFrom') ? 'has-error' : ''}}">
    <label for="RouteFrom" class="col-md-4 control-label">{{ 'From' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="RouteFrom" type="text" id="RouteFrom" value="{{ $transportroute->RouteFrom??''}}" {!!  old('RouteFrom') !!} required @if(request()->segment(count(request()->segments()))=='edit') readonly @endif>
        {{--{!! $errors->first('RouteFrom', '<p class="help-block">:message</p>') !!}--}}
    </div>
</div>
<div class="form-group {{ $errors->has('RouteFrom') ? 'has-error' : ''}}">
    <label for="RouteTo" class="col-md-4 control-label">{{ 'To' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="RouteTo" type="text" id="RouteTo" value="{{ $transportroute->RouteTo??''}}" required @if(request()->segment(count(request()->segments()))=='edit') readonly @endif>
        {{--{!! $errors->first('RouteTo', '<p class="help-block">:message</p>') !!}--}}
        {!! $errors->first('RouteFrom', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('Distance') ? 'has-error' : ''}}">
    <label for="Distance" class="col-md-4 control-label">{{ 'Driving Distance' }}</label>
    <div class="col-md-6">
        <div class="input-group">
            <input class="form-control" name="Distance" type="number" id="Distance" placeholder="Distance in KM" value="{{ $transportroute->Distance??''}}" required>
            <span class="input-group-addon" title="Kilometer">KM</span>
            {!! $errors->first('Distance', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div><div class="form-group {{ $errors->has('DrivingTime') ? 'has-error' : ''}}">
    <label for="DrivingTime" class="col-md-4 control-label">{{ 'Driving Time' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="DrivingTime" type="text" id="time" value="{{ old('DrivingTime',$transportroute->DrivingTime??'')}}" required readonly>
        {!! $errors->first('DrivingTime', '<p class="help-block">:message</p>') !!}
    </div>
</div>
{{--<div class="form-group {{ $errors->has('PickupDateTime') ? 'has-error' : ''}}">--}}
    {{--<label for="PickupDateTime" class="col-md-4 control-label">{{ 'Pickup Date Time' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="PickupDateTime" step="2" type="datetime-local" id="PickupDateTime" value="{{ $transportroute->PickupDateTime??''}}" required>--}}
        {{--{!! $errors->first('PickupDateTime', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
@push('js')
    <script src="https://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
    <script>
        var timepicker = new TimePicker('time', {
            lang: 'en',
            theme: 'light'
        });
        timepicker.on('change', function(evt) {
            var value = (evt.hour || '00') + ':' + (evt.minute || '00');
            evt.element.value = value;
        });
    </script>

@endpush