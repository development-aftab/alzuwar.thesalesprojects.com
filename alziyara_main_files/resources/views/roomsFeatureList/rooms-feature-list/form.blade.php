{{--<div class="form-group {{ $errors->has('FeatureID') ? 'has-error' : ''}}">--}}
    {{--<label for="FeatureID" class="col-md-4 control-label">{{ 'Featureid' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="FeatureID" type="number" id="FeatureID" value="{{ $roomsfeaturelist->FeatureID??''}}" required>--}}
        {{--{!! $errors->first('FeatureID', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
<div class="form-group {{ $errors->has('Title') ? 'has-error' : ''}}">
    <label for="Title" class="col-md-4 control-label">{{ 'Title' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="Title" type="text" id="Title" value="{{ $roomsfeaturelist->Title??''}}" required>
        {!! $errors->first('Title', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('ImageIcon') ? 'has-error' : ''}}">
    <label for="ImageIcon" class="col-md-4 control-label">{{ 'Image Icon' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="ImageIcon" type="text" id="ImageIcon" value="{{ $roomsfeaturelist->ImageIcon??''}}" >
        {!! $errors->first('ImageIcon', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('Description') ? 'has-error' : ''}}">
    <label for="Description" class="col-md-4 control-label">{{ 'Description' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="Description" type="text" id="Description" value="{{ $roomsfeaturelist->Description??''}}" >
        {!! $errors->first('Description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
{{--<div class="form-group {{ $errors->has('SortOrder') ? 'has-error' : ''}}">--}}
    {{--<label for="SortOrder" class="col-md-4 control-label">{{ 'Sortorder' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="SortOrder" type="number" id="SortOrder" value="{{ $roomsfeaturelist->SortOrder??''}}" >--}}
        {{--{!! $errors->first('SortOrder', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
