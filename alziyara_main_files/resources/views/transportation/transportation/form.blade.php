@push('css')
    <style>
        .add-photo{width:-webkit-fill-available;}
        button.btn.btn-danger.remove {width: 100%;}
    </style>
@endpush
<input class="form-control" name="TransportationOwnerID" type="hidden" id="TransportationOwnerID" value="{{ Auth::user()->id??''}}">
<div class="form-group {{ $errors->has('TransportationTypeID') ? 'has-error' : ''}}">
    <label for="TransportationTypeID" class="col-md-2 control-label">{{ 'Transportation Type' }}</label>
    <div class="col-md-10">
        <select class="form-control" name="TransportationTypeID" id="TransportationTypeID" required>
            <option selected disabled>Select Transportation Type</option>
            @foreach($transportationTypes as $transportationType)
                <option value="{{$transportationType->TransportationTypeID}}"  {{ old('TransportationTypeID') == $transportationType->TransportationTypeID ? 'selected' : '' }} @if(isset($transportation->getTransporttype->TransportationTypeID)) @if($transportationType->TransportationTypeID == $transportation->getTransporttype->TransportationTypeID??'') selected @endif @endif>{{ucfirst($transportationType->TransportationTypeDesc)}}</option>
            @endforeach
        </select>
        {{--<input class="form-control" name="TransportationTypeID" type="number" id="TransportationTypeID" value="{{ $transportation->TransportationTypeID??''}}" >--}}
        {!! $errors->first('TransportationTypeID', '<p class="help-block">:message</p>') !!}
    </div>
</div>
{{--<div class="form-group {{ $errors->has('RouteID') ? 'has-error' : ''}}">
    <label for="RouteID" class="col-md-2 control-label">{{ 'Route' }}</label>
    <div class="col-md-10">
        <select class="form-control" name="RouteID" id="RouteID" required>
            <option selected disabled>Select Route</option>
            @foreach($transportationRoutes as $transportationRoute)
                <option value="{{$transportationRoute->RouteID}}" @if(isset($transportation->getTransportmainroute->RouteID)) @if($transportationRoute->RouteID == $transportation->getTransportmainroute->RouteID??'') selected @endif @endif>{{ucfirst($transportationRoute->RouteFrom)}} to {{ucfirst($transportationRoute->RouteTo)}}</option>
            @endforeach
        </select>--}}
        {{--<input class="form-control" name="RouteID" type="number" id="RouteID" value="{{ $transportation->RouteID??''}}" >--}}
        {{--{!! $errors->first('RouteID', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('Price') ? 'has-error' : ''}}">
    <label for="Price" class="col-md-2 control-label">{{ 'Price' }}</label>
    <div class="col-md-10">
        <input class="form-control" name="Price" type="number" id="Price" value="{{ $transportation->Price??''}}" required>
        {!! $errors->first('Price', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div id="PriceDiv"></div>

<button class="add" onclick="add()">Add</button>
<button class="remove" onclick="remove()">Remove</button>
<div id="route_and_price"></div>
<input type="hidden" value="1" id="total_route_and_price">--}}

<div class="form-group">
    <label for="Status" class="col-md-2 control-label">{{ 'Routes and Prices' }}</label>
    <div class="col-md-10">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="preempformrouteprice">
                    <thead>
                    <tr>
                        <th  style="white-space: nowrap;">S.NO.</th>
                        <th  style="white-space: nowrap;">Route </th>
                        <th  style="white-space: nowrap;">One Way Route Price</th>
                        <th  style="white-space: nowrap;">Two Way Route Price</th>
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
                                    <select class="form-control" name="RouteID" id="RouteID" required>
										<option selected disabled>Select Route</option>
										@foreach($transportationRoutes as $transportationRoute)
											<option value="{{$transportationRoute->RouteID}}" @if(isset($transportation->getTransportmainroute->RouteID)) @if($transportationRoute->RouteID == $transportation->getTransportmainroute->RouteID??'') selected @endif @endif>{{ucfirst($transportationRoute->RouteFrom)}} to {{ucfirst($transportationRoute->RouteTo)}}</option>
										@endforeach
									</select>
                                </td>
                                <td><input type='text' step='any' name='Routeprice[]' class='form-control required_colom' value="{{$transportPics->PhotoTitle}}" required='required'></td>

                                
                                <td>
                                    @if($key == 0)
                                        <div class="text-right" style="margin-bottom : 2%">
                                            <button type="button" onclick="addedudetailsrouteprice()" class="btn btn-primary add-photo">+ Add</button>
                                            <br />
                                        </div>
                                    @else
                                        <button onclick="transportImageRemoverouteprice({{$cnt}})"  type='button' class='btn btn-danger removeimage' >- Remove</button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <?php $cnt=1; ?>
                        <tr>
                        <td><input type='number' step='any' class='form-control required_colom' required='required' placeholder='' value="{{$cnt}}" readonly /></td>
                        <td>
							<select class="form-control" name="RouteIDs[]" id="RouteID" required>
										<option selected disabled value="">Select Route</option>
										@foreach($transportationRoutes as $transportationRoute)
											<option value="{{$transportationRoute->RouteID}}" @if(isset($transportation->getTransportmainroute->RouteID)) @if($transportationRoute->RouteID == $transportation->getTransportmainroute->RouteID??'') selected @endif @endif>{{ucfirst($transportationRoute->RouteFrom)}} to {{ucfirst($transportationRoute->RouteTo)}}</option>
										@endforeach
							</select>
						</td>
                        <td><input type='number' step='any' name='OneWayRouteprice[]' id="can_edu_year" class='form-control required_colom' placeholder="One Way Route Price" required></td>
                        <td><input type='number' step='any' name='TwoWayRouteprice[]' id='can_edu_year' class='form-control required_colom' placeholder='Two Way Route Price' required></td>
                        <td>
                            @if($cnt == 1)
                            <div class="text-right" style="margin-bottom : 2%">
                            <button type="button" onclick="addedudetailsrouteprice()" class="btn btn-primary add-photo">+ Add</button>
                            <br />
                            </div>
                            @else
                            <button onclick="removeRow(1)"  type='button' class='btn btn-danger remove' >- Remove</button>
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




<div class="form-group {{ $errors->has('FeatureID') ? 'has-error' : ''}}">
    <label for="FeatureID" class="col-md-2 control-label">{{ 'Features' }}</label>
    <div class="col-md-10">
        <div class="row">
        @foreach($transportationFeaturesList as $transportationFeature)
            <div class="col-md-4">
                <input type="checkbox" id="FeatureID" name="FeatureID[]" value="{{$transportationFeature->FeatureID??''}}" @if(isset($transportation->FeatureID)) @if(in_array($transportationFeature->FeatureID, preg_split ("/\,/", $transportation->FeatureID))) checked @endif @endif>
                <label for="" title="{{ucfirst($transportationFeature->Description??'')}}"> {{ucfirst($transportationFeature->Title??'')}}</label>
            </div>
        @endforeach
        </div>
        {{--<input class="form-control" name="FeatureID" type="text" id="FeatureID" value="{{ $transportation->FeatureID??''}}" >--}}
        {!! $errors->first('FeatureID', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('NameofVehicle') ? 'has-error' : ''}}">
    <label for="NameofVehicle" class="col-md-2 control-label">{{ 'Vehicle Name' }}</label>
    <div class="col-md-10">
        <input class="form-control" name="NameofVehicle" type="text" id="NameofVehicle" value="{{ $transportation->NameofVehicle??''}}" required>
        {!! $errors->first('NameofVehicle', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('NumberPlate') ? 'has-error' : ''}}">
    <label for="NumberPlate" class="col-md-2 control-label">{{ 'Number Plate #' }}</label>
    <div class="col-md-10">
        <input class="form-control" name="NumberPlate" type="text" id="NumberPlate" value="{{ $transportation->NumberPlate??''}}" required>
        {!! $errors->first('NumberPlate', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('DriverName') ? 'has-error' : ''}}">
    <label for="DriverName" class="col-md-2 control-label">{{ 'Driver Name' }}</label>
    <div class="col-md-10">
        <input class="form-control" name="DriverName" type="text" id="DriverName" value="{{ $transportation->DriverName??''}}" required>
        {!! $errors->first('DriverName', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('DriverContactNum') ? 'has-error' : ''}}">
    <label for="DriverContactNum" class="col-md-2 control-label">{{ 'Driver Contact Number' }}</label>
    <div class="col-md-10">
        <input class="form-control" name="DriverContactNum" type="text" id="DriverContactNum" value="{{ $transportation->DriverContactNum??''}}" required>
        {!! $errors->first('DriverContactNum', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('Description') ? 'has-error' : ''}}">
    <label for="Description" class="col-md-2 control-label">{{ 'Description' }}</label>
    <div class="col-md-10">
        <textarea class="form-control" rows="5" name="Description" type="textarea" id="Description" required>{{ $transportation->Description??''}}</textarea>
        {!! $errors->first('Description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('Houserules') ? 'has-error' : ''}}">
    <label for="Description" class="col-md-2 control-label">{{ 'Houserules' }}</label>
    <div class="col-md-10">
        <textarea class="form-control" rows="5" name="Houserules" type="textarea" id="Houserules" required>{{ $transportation->Houserules??''}}</textarea>
        {!! $errors->first('Houserules', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('FeaturesAndAmenities') ? 'has-error' : ''}}">
    <label for="FeaturesAndAmenities" class="col-md-2 control-label">{{ 'FeaturesAndAmenities' }}</label>
    <div class="col-md-10">
        <textarea class="form-control" rows="5" name="FeaturesAndAmenities" type="textarea" id="FeaturesAndAmenities" required>{{ $transportation->FeaturesAndAmenities??''}}</textarea>
        {!! $errors->first('FeaturesAndAmenities', '<p class="help-block">:message</p>') !!}
    </div>
</div>
{{--<div class="form-group {{ $errors->has('Type') ? 'has-error' : ''}}">--}}
    {{--<label for="Type" class="col-md-2 control-label">{{ 'Trip Type' }}</label>--}}
    {{--<div class="col-md-10">--}}
        {{--<div class="radio_btn">--}}
            {{--<label><input type="radio" name="Type" id="Type" value="One Way" @if(isset($transportation->Type)) @if($transportation->Type == "One Way") checked @endif @endif> One way</label>--}}
            {{--<label><input type="radio" name="Type" id="Type" value="Round Trip" @if(isset($transportation->Type)) @if($transportation->Type != "One Way") checked @endif @else checked @endif> Round Trip</label>--}}
        {{--</div>--}}
        {{--<input class="form-control" name="Type" type="number" id="Type" value="{{ $transportation->Type??''}}" >--}}
        {{--{!! $errors->first('Type', '<p class="help-block">:message</p>') !!}--}}
    {{--</div>--}}
    {{--</div>--}}
<div class="form-group {{ $errors->has('Status') ? 'has-error' : ''}}">
    <label for="Status" class="col-md-2 control-label">{{ 'Status' }}</label>
    <div class="col-md-10">
        <select class="form-control" name="Status" id="Status" required>
            <option value="1" @if(isset($transportation->Status)) @if($transportation->Status == "1") selected @endif @endif>Active</option>
            <option value="0" @if(isset($transportation->Status)) @if($transportation->Status == "0") selected @endif @endif>Inactive</option>
        </select>
        {{--<input class="form-control" name="Status" type="number" id="Status" value="{{ $transportation->Status??''}}" >--}}
        {!! $errors->first('Status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
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

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText??'Create' }}">
    </div>
</div>
@push('js')
    <script>
        $('#Description,#FeaturesAndAmenities,#Houserules').summernote({
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
                ['table', ['table']],
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
		
		
		function addedudetailsrouteprice(){
            @if(isset($transportation->getTransportPics))
                if($('#preempformrouteprice tr').length<10){
                    var table = document.getElementById("preempformrouteprice");
                    var rowCount = $('#preempformrouteprice tr').length;
                    var row = table.insertRow(rowCount);
                    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                    var hotelLocationId = "HotelLocation"+rowCount;
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    var cell4 = row.insertCell(3);
                    var cell5 = row.insertCell(4);
                    var jaja = 1 ;
                    var pappu =  rowCount;
                    var jhama = pappu -  jaja ;
                    var indexrowcount = jhama - jaja;
                    console.log(indexrowcount) ;
                    cell1.innerHTML = "<input type='number' step='any'  class='form-control required_colom' required='required' placeholder='' value="+ jhama +" readonly />";
                    cell2.innerHTML = '<select class="form-control" name="RouteIDs[]" id="RouteID" required><option selected disabled>Select Route</option>@foreach($transportationRoutes as $transportationRoute)<option value="{{$transportationRoute->RouteID}}" @if(isset($transportation->getTransportmainroute->RouteID)) @if($transportationRoute->RouteID == $transportation->getTransportmainroute->RouteID??'') selected @endif @endif>{{ucfirst($transportationRoute->RouteFrom)}} to {{ucfirst($transportationRoute->RouteTo)}}</option>@endforeach</select>';
                    cell3.innerHTML = "<input type='number' step='any' name='OneWayRouteprice[]' id='can_edu_year'  class='form-control required_colom datepick' required='required' placeholder='One Way Route Price' />";
                    cell4.innerHTML = "<input type='number' step='any' name='TwoWayRouteprice[]' id='can_edu_year'  class='form-control required_colom datepick' required='required' placeholder='Two Way Route Price' />";
                    $("#can_edu_year").each(function() {
                    });
                    if(jhama == 1){
                        cell5.innerHTML = "<button  type='button' class='btn btn-danger ' >- Remove</button>";
                    }else{
                        cell5.innerHTML = "<button  type='button' class='btn btn-danger remove' >- Remove</button>";
                    }
                }
                else{
                    alert('You can not add more than 10 rows');
                }
            @else
            if($('#preempformrouteprice tr').length<10){
                var table = document.getElementById("preempformrouteprice");
                var rowCount = $('#preempformrouteprice tr').length;
                var row = table.insertRow(rowCount);
                // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                var hotelLocationId = "HotelLocation"+rowCount;
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var jaja = 1 ;
                var pappu =  rowCount;
                var jhama = pappu -  jaja ;
                var indexrowcount = jhama - jaja;
                console.log(indexrowcount) ;
                cell1.innerHTML = "<input type='number' step='any'  class='form-control required_colom' required='required' placeholder='' value="+ jhama +" readonly />";
                cell2.innerHTML = '<select class="form-control" name="RouteIDs[]" id="RouteID" required ><option value=""  selected disabled>Select Route</option>@foreach($transportationRoutes as $transportationRoute)<option value="{{$transportationRoute->RouteID}}" @if(isset($transportation->getTransportmainroute->RouteID)) @if($transportationRoute->RouteID == $transportation->getTransportmainroute->RouteID??'') selected @endif @endif>{{ucfirst($transportationRoute->RouteFrom)}} to {{ucfirst($transportationRoute->RouteTo)}}</option>@endforeach</select>';
                cell3.innerHTML = "<input type='number' step='any' name='OneWayRouteprice[]' id='can_edu_year'  class='form-control required_colom datepick' placeholder='One Way Route Price' required/>";
                cell4.innerHTML = "<input type='number' step='any' name='TwoWayRouteprice[]' id='can_edu_year'  class='form-control required_colom datepick' placeholder='Two Way Route Price' required/>";
                $("#can_edu_year").each(function() {
                });
                if(jhama == 1){
                    cell5.innerHTML = "<button  type='button' class='btn btn-danger ' >- Remove</button>";
                }else{
                    cell5.innerHTML = "<button  type='button' class='btn btn-danger remove' >- Remove</button>";
                }
            }
            else{
                alert('You can not add more than 10 rows');
            }
            @endif
        }

        $('#preempformrouteprice').on('click', '.remove', function(e){
            $(this).closest('tr').remove();
        })

    </script>
    <script>
        function transportImageRemove(id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Photo!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                if (willDelete) {
                    var rowid = "#myphotoremoverrow-"+id;
                    jQuery(rowid).remove();
                    $.get('{{ URL::to("transport-image-remove")}}/'+id,function(data){});
                    swal("Your Image status has been removed!", {
                        icon: "success",
                    });
                } else {
                    swal("Your Image status has not changed!");
        }
        });
        }
		
		function transportImageRemoverouteprice(id) {
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this Photo!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                if (willDelete) {
                    var rowid = "#myphotoremoverrow-"+id;
                    jQuery(rowid).remove();
                    $.get('{{ URL::to("transport-image-remove")}}/'+id,function(data){});
                    swal("Your Image status has been removed!", {
                        icon: "success",
                    });
                } else {
                    swal("Your Image status has not changed!");
        }
        });
        }
    </script>
    <script>
        // $('.add').on('click', add);
        // $('.remove').on('click', remove);
        function add() {
            var route_and_price = parseInt($('#total_route_and_price').val()) + 1;
            var new_input =
                '<div class="form-group {{ $errors->has('RouteID') ? 'has-error' : ''}}">' +
                '    <label for="RouteID" class="col-md-2 control-label">{{ 'Route' }}</label>' +
                '    <div class="col-md-10">' +
                '        <select class="form-control" name="RouteID" id="RouteID" required>' +
                '            <option selected disabled>Select Route</option>' +
                '            @foreach($transportationRoutes as $transportationRoute)' +
                '                <option value="{{$transportationRoute->RouteID}}" @if(isset($transportation->getTransportmainroute->RouteID)) @if($transportationRoute->RouteID == $transportation->getTransportmainroute->RouteID??'') selected @endif @endif>{{ucfirst($transportationRoute->RouteFrom)}} to {{ucfirst($transportationRoute->RouteTo)}}</option>' +
                '            @endforeach' +
                '        </select>' +
                '        {{--<input class="form-control" name="RouteID" type="number" id="RouteID" value="{{ $transportation->RouteID??\'\'}}" >--}}' +
                '        {!! $errors->first('RouteID', '<p class="help-block">:message</p>') !!}' +
                '    </div>' +
                '</div>' +
                '<div class="form-group {{ $errors->has('Price') ? 'has-error' : ''}}" id="PriceDiv">' +
                '    <label for="Price" class="col-md-2 control-label">{{ 'Price' }}</label>' +
                '    <div class="col-md-10">' +
                '        <input class="form-control" name="Price" type="number" id="Price" value="{{ $transportation->Price??''}}" required>' +
                '        {!! $errors->first('Price', '<p class="help-block">:message</p>') !!}' +
                '    </div>' +
                '</div>';

            $('#PriceDiv').append(new_input);

            $('#total_route_and_price').val(new_chq_no);
        }
        function remove() {
            var last_chq_no = $('#total_route_and_price').val();

            if (last_chq_no > 1) {
                $('#new_' + route_and_price).remove();
                $('#total_route_and_price').val(route_and_price - 1);
            }
        }

    </script>
@endpush