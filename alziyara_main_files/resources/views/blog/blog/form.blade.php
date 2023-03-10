<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="col-md-4 control-label">{{ 'Main Image' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="image" type="file" id="image" value="{{ $blog->image??''}}" onchange="PreviewImage_1();">
        <input class="form-control" name="old_image" type="hidden" id="old_image" value="{{ $blog->image??''}}">
        <img src="{{asset('website')}}/{{ $blog->image??''}}" id="imagePreview_1"  width="100" height="100">
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
    <label for="title" class="col-md-4 control-label">{{ 'Title' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="title" type="text" id="title" value="{{ $blog->title??''}}" required>
        {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('blog') ? 'has-error' : ''}}">
    <label for="blog" class="col-md-4 control-label">{{ 'Blog' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="blog" type="textarea" id="blog" required>{{ $blog->blog??''}}</textarea>
        {!! $errors->first('blog', '<p class="help-block">:message</p>') !!}
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