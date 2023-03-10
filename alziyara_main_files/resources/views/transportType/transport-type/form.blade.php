{{--<div class="form-group {{ $errors->has('TransportationTypeID') ? 'has-error' : ''}}">--}}
    {{--<label for="TransportationTypeID" class="col-md-4 control-label">{{ 'Transportationtypeid' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="TransportationTypeID" type="text" id="TransportationTypeID" value="{{ $transporttype->TransportationTypeID??''}}" required>--}}
        {{--{!! $errors->first('TransportationTypeID', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
<div class="form-group {{ $errors->has('NumOfSeats') ? 'has-error' : ''}}">
    <label for="NumOfSeats" class="col-md-4 control-label">{{ 'Numofseats' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="NumOfSeats" type="number" id="NumOfSeats" value="{{ $transporttype->NumOfSeats??''}}" required>
        {!! $errors->first('NumOfSeats', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('TransportationTypeDesc') ? 'has-error' : ''}}">
    <label for="TransportationTypeDesc" class="col-md-4 control-label">{{ 'Transportationtypedesc' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="TransportationTypeDesc" type="text" id="TransportationTypeDesc" value="{{ $transporttype->TransportationTypeDesc??''}}" required>
        {!! $errors->first('TransportationTypeDesc', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('LuggageCapacity') ? 'has-error' : ''}}">
    <label for="LuggageCapacity" class="col-md-4 control-label">{{ 'Luggagecapacity' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="LuggageCapacity" type="number" id="LuggageCapacity" value="{{ $transporttype->LuggageCapacity??''}}" required>
        {!! $errors->first('LuggageCapacity', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
