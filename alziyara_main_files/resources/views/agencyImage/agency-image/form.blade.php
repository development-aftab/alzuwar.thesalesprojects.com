<div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
    <label for="image" class="col-md-4 control-label">{{ 'Image' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="image" type="file" id="image" value="{{ $agencyimage->image??''}}" onchange="PreviewImage_1();">
        <img src="{{asset('website')}}/{{ $agencyimage->image??''}}" id="imagePreview_1" width="200" height="200">
        {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="col-md-4 control-label">{{ 'Status' }}</label>
    <div class="col-md-6">
        <select class="form-control" name="status" id="status">
            <option value="1" @if(isset($agencyimage) && $agencyimage->status==1) selected @endif>Active</option>
            <option value="0" @if(isset($agencyimage) && $agencyimage->status==0) selected @endif>Inactive</option>
        </select>
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
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