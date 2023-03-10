<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
    <label for="name" class="col-md-4 control-label">{{ 'Name' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="name" type="text" id="name" value="{{ $roomtype->name??''}}" required>
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
{{--<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">--}}
    {{--<label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<select class="form-control" name="Status" id="Status" required>--}}
            {{--<option value="1" @if(isset($roomtype->Status)) @if($roomtype->Status == "1") selected @endif @endif>Active</option>--}}
            {{--<option value="0" @if(isset($roomtype->Status)) @if($roomtype->Status == "0") selected @endif @endif>Inactive</option>--}}
        {{--</select>--}}

        {{--<input class="form-control" name="status" type="text" id="status" value="{{ $roomtype->status??''}}" >--}}
        {{--{!! $errors->first('status', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
