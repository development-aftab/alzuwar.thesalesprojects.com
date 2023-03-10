<div class="form-group {{ $errors->has('vendor_id') ? 'has-error' : ''}}">
    <label for="vendor_id" class="col-md-4 control-label">{{ 'Vendor Id' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="vendor_id" type="number" id="vendor_id" value="{{ $withdrawrequest->vendor_id??''}}" required>
        {!! $errors->first('vendor_id', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    <label for="category" class="col-md-4 control-label">{{ 'Category' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="category" type="number" id="category" value="{{ $withdrawrequest->category??''}}" required>
        {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('requested_amount') ? 'has-error' : ''}}">
    <label for="requested_amount" class="col-md-4 control-label">{{ 'Requested Amount' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="requested_amount" type="number" id="requested_amount" value="{{ $withdrawrequest->requested_amount??''}}" required>
        {!! $errors->first('requested_amount', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('is_request_accepted') ? 'has-error' : ''}}">
    <label for="is_request_accepted" class="col-md-4 control-label">{{ 'Is Request Accepted' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="is_request_accepted" type="number" id="is_request_accepted" value="{{ $withdrawrequest->is_request_accepted??''}}" >
        {!! $errors->first('is_request_accepted', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
