<div class="form-group {{ $errors->has('city_name') ? 'has-error' : ''}}">
    <label for="city_name" class="col-md-4 control-label">{{ 'City Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="city_name" type="text" id="city_name" value="{{ $guidecity->city_name??''}}" required>
        {!! $errors->first('city_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="status" id="status" required>
            <option value="1" @if(isset($guidecity->status)) @if($guidecity->status == "1") selected @endif @endif>Active</option>
            <option value="0" @if(isset($guidecity->status)) @if($guidecity->status== "0") selected @endif @endif>Inactive</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
