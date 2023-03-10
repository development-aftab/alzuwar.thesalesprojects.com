<div class="form-group {{ $errors->has('user_id') ? 'has-error' : ''}}">
    <label for="user_id" class="col-md-4 control-label">{{ 'User Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="user_id" type="number" id="user_id" value="{{ $propertyfavorite->user_id or ''}}" required>
        {!! $errors->first('user_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('property_id') ? 'has-error' : ''}}">
    <label for="property_id" class="col-md-4 control-label">{{ 'Property Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="property_id" type="number" id="property_id" value="{{ $propertyfavorite->property_id or ''}}" required>
        {!! $errors->first('property_id', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
    </div>
</div>
