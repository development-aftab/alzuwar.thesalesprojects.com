<div class="form-group {{ $errors->has('VehicleRouteID') ? 'has-error' : ''}}">
    <label for="VehicleRouteID" class="col-md-4 control-label">{{ 'Vehiclerouteid' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="VehicleRouteID" type="text" id="VehicleRouteID" value="{{ $vendortransportroute->VehicleRouteID or ''}}" required>
        {!! $errors->first('VehicleRouteID', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('RouteID') ? 'has-error' : ''}}">
    <label for="RouteID" class="col-md-4 control-label">{{ 'Routeid' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="RouteID" type="text" id="RouteID" value="{{ $vendortransportroute->RouteID or ''}}" required>
        {!! $errors->first('RouteID', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('Price') ? 'has-error' : ''}}">
    <label for="Price" class="col-md-4 control-label">{{ 'Price' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="Price" type="text" id="Price" value="{{ $vendortransportroute->Price or ''}}" >
        {!! $errors->first('Price', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('TwoWayPrice') ? 'has-error' : ''}}">
    <label for="TwoWayPrice" class="col-md-4 control-label">{{ 'Twowayprice' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="TwoWayPrice" type="text" id="TwoWayPrice" value="{{ $vendortransportroute->TwoWayPrice or ''}}" >
        {!! $errors->first('TwoWayPrice', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
