@push('css')
    <style>
        .add-photo{width:-webkit-fill-available;}
        button.btn.btn-danger.remove {width: 100%;}
    </style>
@endpush
<input class="form-control" name="GuidesCreatedBy" type="hidden" id="GuidesCreatedBy" value="{{ Auth::user()->id??''}}">
{{--<div class="form-group {{ $errors->has('GuidesID') ? 'has-error' : ''}}">--}}
    {{--<label for="GuidesID" class="col-md-4 control-label">{{ 'Guidesid' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="GuidesID" type="number" id="GuidesID" value="{{ old(GuidesID,$guid->GuidesID??'')}}" required>--}}
        {{--{!! $errors->first('GuidesID', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group {{ $errors->has('Productcategory') ? 'has-error' : ''}}">--}}
    {{--<label for="Productcategory" class="col-md-4 control-label">{{ 'Productcategory' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="Productcategory" type="number" id="Productcategory" value="{{ old('Productcategory',$guid->Productcategory??'') }}" required>--}}
        {{--{!! $errors->first('Productcategory', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
<div class="form-group {{ $errors->has('GuidesName') ? 'has-error' : ''}}">
    <label for="GuidesName" class="col-md-2 control-label">{{ 'Guides Name' }}</label>
    <div class="col-md-10">
        <input class="form-control" name="GuidesName" type="text" id="GuidesName" value="{{ old('GuidesName',$guid->GuidesName??'') }}" required>
        {!! $errors->first('GuidesName', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('GuidesDesc') ? 'has-error' : ''}}">
    <label for="GuidesDesc" class="col-md-2 control-label">{{ 'Guides Description' }}</label>
    <div class="col-md-10">
        <textarea class="form-control" rows="5" name="GuidesDesc" type="textarea" id="GuidesDesc" >{!! old('GuidesDesc',$guid->GuidesDesc??'')  !!}</textarea>
        {!! $errors->first('GuidesDesc', '<p class="help-block">:message</p>') !!}
    </div>
</div>
{{--<div class="form-group {{ $errors->has('GuidesItinerary') ? 'has-error' : ''}}">--}}
    {{--<label for="GuidesItinerary" class="col-md-4 control-label">{{ 'Guidesitinerary' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<textarea class="form-control" rows="5" name="GuidesItinerary" type="textarea" id="GuidesItinerary" >{{ old($guid->GuidesItinerary??'','GuidesItinerary') }}</textarea>--}}
        {{--{!! $errors->first('GuidesItinerary', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group {{ $errors->has('Admin_status') ? 'has-error' : ''}}">--}}
    {{--<label for="Admin_status" class="col-md-4 control-label">{{ 'Admin Status' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="Admin_status" type="number" id="Admin_status" value="{{ old('Admin_status',$guid->Admin_status??'')}}" required>--}}
        {{--{!! $errors->first('Admin_status', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}
{{--<div class="form-group {{ $errors->has('userstatus') ? 'has-error' : ''}}">--}}
    {{--<label for="userstatus" class="col-md-4 control-label">{{ 'Userstatus' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="userstatus" type="number" id="userstatus" value="{{ old('userstatus',$guid->userstatus??''}}" required>--}}
        {{--{!! $errors->first('userstatus', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group {{ $errors->has('PricePerDay') ? 'has-error' : ''}}">
    <label for="PricePerDay" class="col-md-2 control-label">{{ 'Price Per Day' }}</label>

    <div class="col-md-10">
        <div class="input-group">
            <span class="input-group-addon" title="Dollars">$</span>
            <input class="form-control" name="PricePerDay" type="number" id="PricePerDay" value="{{ old('PricePerDay',$guid->PricePerDay??'') }}" >
            {!! $errors->first('PricePerDay', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
<div class="form-group {{ $errors->has('MaxOccupancy') ? 'has-error' : ''}}">
    <label for="MaxOccupancy" class="col-md-2 control-label">{{ 'Maximum Occupancy' }}</label>
    <div class="col-md-10">
        <input class="form-control" name="MaxOccupancy" type="number" id="MaxOccupancy" value="{{ old('MaxOccupancy',$guid->MaxOccupancy??'') }}" >
        {!! $errors->first('MaxOccupancy', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('GuidesLocation') ? 'has-error' : ''}}">
    <label for="GuidesLocation" class="col-md-2 control-label">{{ 'Guides Base at City' }} @if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('user')) (<a href="{{'/guideCity/guide-city/'}}">Manage</a>) @endif </label>
    <div class="col-md-10">
        <select class="form-control" name="GuidesLocation" id="GuidesLocation" required>
            @foreach($cities as $city)
                <option value="{{$city->city_name??''}}" @if(isset($city->city_name)) @if($city->city_name == "1") selected @endif @endif>{{$city->city_name??''}}</option>
            @endforeach
        </select>
        {{--<input class="form-control" name="GuidesLocation" type="text" id="GuidesLocation" value="{{ old('GuidesLocation',$guid->GuidesLocation??''}}" >--}}
        {!! $errors->first('GuidesLocation', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('GuidePhoneno') ? 'has-error' : ''}}">
    <label for="GuidePhoneno" class="col-md-2 control-label">{{ 'Guide Phone no' }}</label>
    <div class="col-md-10">
        <div class="input-group">
            <input class="form-control" name="GuidePhoneno" type="text" id="GuidePhoneno" value="{{ old('GuidePhoneno',$guid->GuidePhoneno??'') }}" >
            <!--<span class="input-group-addon" title="Days">Days</span>-->
            {!! $errors->first('GuidePhoneno', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>
{{--<div class="form-group {{ $errors->has('guide_startdate') ? 'has-error' : ''}}">
    <label for="guide_startdate" class="col-md-2 control-label">{{ 'Guide Start Date' }}</label>
    <div class="col-md-10">
        <input class="form-control" name="guide_startdate" type="date" id="guide_startdate" value="{{ old('guide_startdate',$guid->guide_startdate??'') }}" >
        {!! $errors->first('guide_startdate', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('guide_enddate') ? 'has-error' : ''}}">
    <label for="guide_enddate" class="col-md-2 control-label">{{ 'Guide End Date' }}</label>
    <div class="col-md-10">
        <input class="form-control" name="guide_enddate" type="date" id="guide_enddate" value="{{ old('guide_enddate',$guid->guide_enddate??'') }}" >
        {!! $errors->first('guide_enddate', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('guide_deadlinedate') ? 'has-error' : ''}}">
    <label for="guide_deadlinedate" class="col-md-2 control-label">{{ 'Guide Deadline Date' }}</label>
    <div class="col-md-10">
        <input class="form-control" name="guide_deadlinedate" type="date" id="guide_deadlinedate" value="{{ old('guide_deadlinedate',$guid->guide_deadlinedate??'') }}" >
        {!! $errors->first('guide_deadlinedate', '<p class="help-block">:message</p>') !!}
    </div>
</div>--}}
<div class="form-group {{ $errors->has('HouseRules') ? 'has-error' : ''}}">
    <label for="HouseRules" class="col-md-2 control-label">{{ 'Houserules (Rules,Meeting Location and Time)' }}</label>
    <div class="col-md-10">
        <textarea class="form-control" rows="5" name="HouseRules" type="textarea" id="HouseRules" >{{ old('HouseRules',$guid->HouseRules??'') }}</textarea>
        {!! $errors->first('HouseRules', '<p class="help-block">:message</p>') !!}
    </div>
</div>

{{--<div class="form-group {{ $errors->has('DisplayOnHomePage') ? 'has-error' : ''}}">--}}
    {{--<label for="DisplayOnHomePage" class="col-md-2 control-label">{{ 'Displayonhomepage' }}</label>--}}
    {{--<div class="col-md-10">--}}
        {{--<input class="form-control" name="DisplayOnHomePage" type="number" id="DisplayOnHomePage" value="{{ $guid->DisplayOnHomePage??''}}" >--}}
        {{--{!! $errors->first('DisplayOnHomePage', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}

{{--<div class="form-group {{ $errors->has('SortOrder') ? 'has-error' : ''}}">--}}
    {{--<label for="SortOrder" class="col-md-2 control-label">{{ 'Sortorder' }}</label>--}}
    {{--<div class="col-md-10">--}}
        {{--<input class="form-control" name="SortOrder" type="number" id="SortOrder" value="{{ $guid->SortOrder??''}}" >--}}
        {{--{!! $errors->first('SortOrder', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}

{{--<div class="form-group {{ $errors->has('GuidesCreatedBy') ? 'has-error' : ''}}">--}}
    {{--<label for="GuidesCreatedBy" class="col-md-2 control-label">{{ 'Guidescreatedby' }}</label>--}}
    {{--<div class="col-md-10">--}}
        {{--<input class="form-control" name="GuidesCreatedBy" type="number" id="GuidesCreatedBy" value="{{ $guid->GuidesCreatedBy??''}}" >--}}
        {{--{!! $errors->first('GuidesCreatedBy', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}



<div class="form-group {{ $errors->has('Languages') ? 'has-error' : ''}}">
    <label for="FeatureID" class="col-md-2 control-label">{{ 'Languages' }}</label>
    <div class="col-md-10">
        <div class="row">
            @foreach($languages as $language)
                <div class="col-md-4">
                    <input type="checkbox" id="Languages" name="Languages[]" value="{{$language->language_name??''}}">
                    <label for="" title="{{ucfirst($language->language_name??'')}}"> {{ucfirst($language->language_name??'')}}</label>
                </div>
            @endforeach
        </div>
        {{--<input class="form-control" name="FeatureID" type="text" id="FeatureID" value="{{ $transportation->FeatureID??''}}" >--}}
        {!! $errors->first('FeatureID', '<p class="help-block">:message</p>') !!}
    </div>
</div>



{{--<div class="form-group {{ $errors->has('Languages') ? 'has-error' : ''}}">--}}
    {{--<label for="Languages" class="col-md-2 control-label">{{ 'Languages' }}</label>--}}
    {{--<div class="col-md-10">--}}
        {{--<input class="form-control" name="Languages" type="text" id="Languages" value="{{ $guid->Languages??''}}" >--}}
        {{--{!! $errors->first('Languages', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group">
    <label for="Status" class="col-md-2 control-label">{{ 'Transport Images' }}</label>
    <div class="col-md-10">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="preempform">
                    <thead>
                    <tr>
                        <th  style="white-space: nowrap;">S.NO.</th>
                        <th  style="white-space: nowrap;">Photo Title</th>
                        <th  style="white-space: nowrap;">AltText</th>
                        @if(isset($transportation->getTransportPics))
                            <th  style="white-space: nowrap;">Photo</th>
                        @endif
                        <th  style="white-space: nowrap;">PhotoLocation</th>
                        <th  style="white-space: nowrap;">Default Image</th>
                        <th>Action</th>
                    </tr>
                    <tr>
                    </tr>
                    </thead>
                    <tbody>
                    @if(isset($transportation->getTransportPics))
                        @foreach($transportation->getTransportPics as $key => $transportPics)
                            <?php $cnt=$transportPics->PhotoID; ?>
                            <tr id="myphotoremoverrow-{{$cnt}}">
                                <td>
                                    {{--<input type='hidden' name="photoidupload[]" step='any' class='form-control required_colom' required='required' placeholder='' value="{{$cnt}}" readonly />--}}
                                    <input type='number' name="photoid[]" step='any' class='form-control required_colom' required='required' placeholder='' value="{{$key}}" readonly />
                                </td>
                                <td><input type='text' step='any' name='PhotoTitle[]' class='form-control required_colom' value="{{$transportPics->PhotoTitle}}" required='required'></td>
                                <td><input type='text' step='any' name='AltText[]' id="can_edu_year"   class='form-control required_colom' value="{{$transportPics->AltText}}"  placeholder="Alternate Text" required='required'></td>
                                <td><img style="height:100px;width:100px;" src="{{asset('website').'/'.$transportPics->PhotoLocation}}"></td>
                                <td>
                                    <input type='file'  step='any' name='PhotoLocation[]' accept="image/png, image/gif, image/jpeg" class='form-control required_colom address' >
                                    <input type='hidden'  step='any' name='PhotoLocation[]' value="{{ $transportPics->PhotoLocation??''}}" class='form-control required_colom address' >
                                </td>

                                <td><input type='radio'  step='any' name='Showimage[]' value="{{$key}}" @if($transportPics->DefaultFlag == "1") checked @endif class='form-control required_colom address' ></td>
                                <td>
                                    @if($key == 0)
                                        <div class="text-right" style="margin-bottom : 2%">
                                            <button type="button" onclick="addedudetails()" class="btn btn-primary add-photo">+ Add Photo</button>
                                            <br />
                                        </div>
                                    @else
                                        <button onclick="transportImageRemove({{$cnt}})"  type='button' class='btn btn-danger removeimage' >- Remove Photo</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <?php $cnt=1; ?>
                        <tr>
                            <td><input type='number' step='any' class='form-control required_colom' required='required' placeholder='' value="{{$cnt}}" readonly /></td>
                            <td><input type='text' step='any' name='PhotoTitle[]' class='form-control required_colom' required='required'></td>
                            <td><input type='text' step='any' name='AltText[]' id="can_edu_year"   class='form-control required_colom'  placeholder="Alternate Text" required='required'></td>
                            <td><input type='file'  step='any' name='PhotoLocation[]' accept="image/png, image/gif, image/jpeg" class='form-control required_colom address' required='required'></td>
                            <td><input type='radio' value='0' checked="checked"  name='Showimage[]' class='form-control required_colom address' required='required'></td>
                            <td>
                                @if($cnt == 1)
                                    <div class="text-right" style="margin-bottom : 2%">
                                        <button type="button" onclick="addedudetails()" class="btn btn-primary add-photo">+ Add Photo</button>
                                        <br />
                                    </div>
                                @else
                                    <button onclick="removeRow(1)"  type='button' class='btn btn-danger remove' >- Remove Photo</button>
                                @endif
                            </td>
                        </tr>
                    @endif

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

{{--<div class="form-group {{ $errors->has('Status') ? 'has-error' : ''}}">--}}
    {{--<label for="GuidesStatus" class="col-md-4 control-label">{{ 'Guides Status' }}</label>--}}
    {{--<div class="col-md-6">--}}
        {{--<input class="form-control" name="GuidesStatus" type="number" id="GuidesStatus" value="{{ $guid->GuidesStatus??''}}" required>--}}
        {{--{!! $errors->first('GuidesStatus', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
{{--</div>--}}

<div class="form-group {{ $errors->has('Status') ? 'has-error' : ''}}">
    <label for="Status" class="col-md-2 control-label">{{ 'Status' }}</label>
    <div class="col-md-10">
        <select class="form-control" name="GuidesStatus" id="Status" required>
            <option value="1" @if(isset($guid->GuidesStatus)) @if($guid->GuidesStatus == "1") selected @endif @endif>Active</option>
            <option value="0" @if(isset($guid->GuidesStatus)) @if($guid->GuidesStatus == "0") selected @endif @endif>Inactive</option>
        </select>
        {{--<input class="form-control" name="Status" type="number" id="Status" value="{{ $guid->GuidesStatus??''}}" >--}}
        {!! $errors->first('Status', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
@push('js')
    <script>
        $('#GuidesDesc,#HouseRules').summernote({
            minHeight: null,             // set minimum height of editor
            maxHeight: 200,
            tabsize: 2,
            height: 200,
            blockquoteBreakingLevel: 0,
            disableDragAndDrop: true,
            toolbar: [
                // [groupName, [list of button]]
                ['fontname', ['fontname']],
                ['style', ['bold', 'italic', 'underline']],
                ['fontsize', ['fontsize']],
                ['fontNames', ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['color', ['color']],
                ['view', ['fullscreen', 'codeview']]
            ],
            placeholder: 'Write here...',
            insertOrderedList:true,
        });
    </script>
    <script>
        function addedudetails(){
            @if(isset($transportation->getTransportPics))
                if($('#preempform tr').length<7){
                    var table = document.getElementById("preempform");
                    var rowCount = $('#preempform tr').length;
                    var row = table.insertRow(rowCount);
                    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                    var hotelLocationId = "HotelLocation"+rowCount;
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    var cell5 = row.insertCell(4);
                    var cell6 = row.insertCell(5);
                    var cell7 = row.insertCell(6);
                    var jaja = 1 ;
                    var pappu =  rowCount;
                    var jhama = pappu -  jaja ;
                    var indexrowcount = jhama - jaja;
                    console.log(indexrowcount) ;
                    cell1.innerHTML = "<input type='number' step='any'  class='form-control required_colom' required='required' placeholder='' value="+ jhama +" readonly />";
                    cell2.innerHTML = "<input type='text' step='any' name='PhotoTitle[]'    class='form-control required_colom' required='required' />";
                    cell3.innerHTML = "<input type='text' step='any' name='AltText[]' id='can_edu_year'  class='form-control required_colom datepick' required='required' placeholder='Alternate Text' />";
                    cell4.innerHTML = "";
                    cell5.innerHTML = "<input type='file' step='any' name='PhotoLocation[]' accept='image/png, image/gif, image/jpeg' class='form-control required_colom address' required='required' />";
                    cell6.innerHTML = "<input type='radio'  name='Showimage[]' value="+ indexrowcount +" class='form-control required_colom address' required='required'>"
                    $("#can_edu_year").each(function() {
                    });
                    if(jhama == 1){
                        cell7.innerHTML = "<button  type='button' class='btn btn-danger ' >- Remove Photo</button>";
                    }else{
                        cell7.innerHTML = "<button  type='button' class='btn btn-danger remove' >- Remove Photo</button>";
                    }
                }
                else{
                    alert('You can not add more than 5 images');
                }
            @else
                if($('#preempform tr').length<7){
                    var table = document.getElementById("preempform");
                    var rowCount = $('#preempform tr').length;
                    var row = table.insertRow(rowCount);
                    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                    var hotelLocationId = "HotelLocation"+rowCount;
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    var cell5 = row.insertCell(4);
                    var cell6 = row.insertCell(5);
                    var jaja = 1 ;
                    var pappu =  rowCount;
                    var jhama = pappu -  jaja ;
                    var indexrowcount = jhama - jaja;
                    console.log(indexrowcount) ;
                    cell1.innerHTML = "<input type='number' step='any'  class='form-control required_colom' required='required' placeholder='' value="+ jhama +" readonly />";
                    cell2.innerHTML = "<input type='text' step='any' name='PhotoTitle[]'    class='form-control required_colom' required='required' />";
                    cell3.innerHTML = "<input type='text' step='any' name='AltText[]' id='can_edu_year'  class='form-control required_colom datepick' required='required' placeholder='Alternate Text' />";
                    cell4.innerHTML = "<input type='file' step='any' name='PhotoLocation[]' accept='image/png, image/gif, image/jpeg' class='form-control required_colom address' required='required' />";
                    cell5.innerHTML = "<input type='radio'  name='Showimage[]' value="+ indexrowcount +" class='form-control required_colom address' required='required'>"
                    $("#can_edu_year").each(function() {
                    });
                    if(jhama == 1){
                        cell6.innerHTML = "<button  type='button' class='btn btn-danger ' >- Remove Photo</button>";
                    }else{
                        cell6.innerHTML = "<button  type='button' class='btn btn-danger remove' >- Remove Photo</button>";
                    }
                }
                else{
                    alert('You can not add more than 5 images');
                }
            @endif
        }
        $('#preempform').on('click', '.remove', function(e){
            $(this).closest('tr').remove();
        })

    </script>

@endpush