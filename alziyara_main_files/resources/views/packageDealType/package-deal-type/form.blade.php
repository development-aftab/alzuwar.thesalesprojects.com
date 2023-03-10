<div class="form-group {{ $errors->has('package_deals_type_desc') ? 'has-error' : ''}}">
    <label for="package_deals_type_desc" class="col-md-4 control-label">{{ 'Package Deals Type Desc' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="package_deals_type_desc" type="text" id="package_deals_type_desc" value="{{ $packagedealtype->package_deals_type_desc??''}}" >
        {!! $errors->first('package_deals_type_desc', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <select id="status" name="status" class="form-control"  value="{{ $packagedealtype->status??''}}">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
