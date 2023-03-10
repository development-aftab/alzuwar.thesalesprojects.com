<div class="form-group {{ $errors->has('language_name') ? 'has-error' : ''}}">
    <label for="language_name" class="col-md-4 control-label">{{ 'Language Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="language_name" type="text" id="language_name" value="{{ $guidelanguage->language_name??''}}" required>
        {!! $errors->first('language_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="status" id="status" required>
            <option value="1" @if(isset($guidelanguage->status)) @if($guidelanguage->status == "1") selected @endif @endif>Active</option>
            <option value="0" @if(isset($guidelanguage->status)) @if($guidelanguage->status== "0") selected @endif @endif>Inactive</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
