<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="col-md-4 control-label">{{ 'Image' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="image" type="file" id="image" value="{{ $discover->image??''}}" onchange="PreviewImage_1();">
        <img src="{{asset('website')}}/{{ $discover->image??''}}" id="imagePreview_1" width="100" height="100">
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="col-md-4 control-label">{{ 'Title' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="title" type="text" id="title" value="{{ $discover->title??''}}" >
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
    <label for="link" class="col-md-4 control-label">{{ 'Link' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="link" type="text" id="link" value="{{ $discover->link??''}}" >
        {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('title_link') ? 'has-error' : ''}}">
    <label for="title_link" class="col-md-4 control-label">{{ 'Title Link' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="title_link" type="text" id="title_link" value="{{ $discover->title_link??''}}" >
        {!! $errors->first('title_link', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
@push('js')
<script type="text/javascript">
            function PreviewImage_1() {
                var oFReader = new FileReader();
                oFReader.readAsDataURL(document.getElementById("image").files[0]);
                oFReader.onload = function (oFREvent) {
                document.getElementById("imagePreview_1").src = oFREvent.target.result;
                };
            };
</script>
@endpush