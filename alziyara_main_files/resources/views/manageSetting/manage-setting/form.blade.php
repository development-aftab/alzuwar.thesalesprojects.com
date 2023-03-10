                        <div class="form-group">
                            <label class="col-md-2">Package Deal name</label>
                            <div class="col-md-4">
                                <input class="form-control" name="package_deals_name" type="text" id="package_deals_name" value="{{ $managesetting->package_deals_name??''}}" required>
                            </div>
                            <label class="col-md-2">Package Deal Type</label>
                            <div class="col-md-4">
                                <select class="form-control" name="package_deals_type_id" id="package_deals_type_id" required>
                                    @foreach($PackageDealType as $PackageDealTypes)
                                        <option value="{{$PackageDealTypes->id}}" >{{$PackageDealTypes->package_deals_type_desc??''}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br/>

                        <div class="form-group">
                            <label class="col-md-2">Package Deal Status</label>
                            <div class="col-md-4">
                                <select id="status" name="status" class="form-control"  value="{{ $managesetting->package_deals_status??''}}" required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>

                            </div>
                                <label class="col-md-2">Price</label>
                            <div class="col-md-4">
                                <input class="form-control" name="price" type="number" id="price" value="{{ $managesetting->price??''}}" required >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2">Max Occupancy</label>
                            <div class="col-md-4">
                                <input class="form-control" name="max_occupancy" type="number" id="max_occupancy" value="{{ $managesetting->max_occupancy??''}}" required >
                            </div>
                                {{--<label class="col-md-2">Package Deal Time</label>--}}
                            {{--<div class="col-md-4">--}}
                                {{--<input class="form-control" name="package_deals_time" type="time" id="package_deals_time" value="{{ $managesetting->package_deals_time??''}}" required>--}}
                            {{--</div>--}}
                            <label class="col-md-2">Package Deal Location</label>
                            <div class="col-md-4">
                                <input class="form-control" name="package_deals_location" type="text" id="package_deals_location" value="{{ $managesetting->package_deals_location??''}}" required>
                                {!! $errors->first('package_deals_location', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        @if(Auth::user()->hasRole('SuperAdmin'))
                        <div class="form-group">
                            <label class="col-md-2">Display on Homepage</label>
                            <div class="col-md-4">
                                    <select id="display_on_home_page" name="display_on_home_page" class="form-control" required>
                                        <option value="1" @if($managesetting->display_on_home_page == 1) selected @endif>Yes</option>
                                        <option value="0" @if($managesetting->display_on_home_page == 0) selected @endif>No</option>
                                    </select>
                                {!! $errors->first('package_deals_location', '<p class="help-block">:message</p>') !!}
                            </div>
                            <label class="col-md-2">Package Created by</label>
                            <div class="col-md-4">
                                <input class="form-control" name="package_deals_create_by" type="email" id="package_deals_create_by" value="{{ Auth::user()->email??$managesetting->package_deals_create_by??''}}" required >
                                {!! $errors->first('package_deals_location', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>
                        @endif
                        {{--<div class="form-group">--}}
                            {{--<label class="col-md-2">Sort Order</label>--}}
                            {{--<div class="col-md-4">--}}
                                {{--<input class="form-control" name="sort_order" type="number" id="sort_order" value="{{ $managesetting->sort_order??''}}" >--}}
                                {{--{!! $errors->first('package_deals_location', '<p class="help-block">:message</p>') !!}--}}
                            {{--</div>--}}

                        {{--</div>--}}
                        <div class="form-group">
                            <label class="col-md-12">Package Description</label>
                            <div class="col-md-12">
                                <textarea class="form-control"  type="text" name="package_deals_desc" id="package_deals_desc" rows="5" required>{{ $managesetting->package_deals_desc??''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Package Deal Itinerary</label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="package_deals_itinerary" type="text" id="package_deals_itinerary" required>{{ $managesetting->package_deals_itinerary??''}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">House Rules</label>
                            <div class="col-md-12">
                                <textarea class="form-control" name="house_rules" type="text" id="house_rules" required >{{ $managesetting->house_rules??''}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="payroll-table card">
                                <div class="table-responsive">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card mb-0">
                                                <div class="card-header">
                                                    <h4 class="card-title mb-0">PHOTO RECORD</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        <div class="text-right" style="margin-bottom : 2%">
                                            <button type="button" onclick="addedudetails()" class="btn btn-primary">+ Add Photo</button>
                                            <br />
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="preempform">
                                                <thead>
                                                <p>PHOTOS AND DETAILS OF PHOTOS</p>
                                                <tr>
                                                    <th  style="white-space: nowrap;">S.NO.</th>
                                                    <th  style="white-space: nowrap;">Photo Title</th>
                                                    <th  style="white-space: nowrap;">AltText</th>
                                                    <th  style="white-space: nowrap;">PhotoLocation</th>
                                                    <th  style="white-space: nowrap;">Default Image</th>
                                                    <th>Action</th>
                                                </tr>
                                                <tr>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php $cnt=1; ?>
                                                <tr>
                                                    <td><input type='number' step='any' class='form-control required_colom' required='required' placeholder='' value="{{$cnt}}" readonly  required/></td>
                                                    <td><input type='text' step='any' name='PhotoTitle[]'    class='form-control required_colom' required='required'></td>
                                                    <td><input type='text' step='any' name='AltText[]' id="can_edu_year"   class='form-control required_colom'  placeholder="Alternate Text" required></td>
                                                    <td><input type='file'  step='any' name='PhotoLocation[]'   class='form-control required_colom address' required></td>


                                                    <td><input type='radio' value='0' checked="checked"  name='Showimage[]' class='form-control required_colom address' required></td>
                                                    <td>
                                                        @if($cnt != 1)
                                                            <button onclick="removeRow(1)"  type='button' class='btn btn-danger remove' >remove</button>
                                                    @endif
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="payroll-table card">
                                <div class="table-responsive">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card mb-0">
                                                <div class="card-header">
                                                    <h4 class="card-title mb-0">PACKAGE DETAILS</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                        {{--<div class="text-right" style="margin-bottom : 2%">--}}
                                            {{--<button type="button" onclick="addprogramdetails()" class="btn btn-primary">+ Add Program Detail</button>--}}
                                            {{--<br />--}}
                                        {{--</div>--}}
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="prodetail">
                                                <thead>
                                                <tr>
                                                    <th  style="white-space: nowrap;">Avalible From</th>
                                                    <th  style="white-space: nowrap;">Available To</th>
                                                    <th  style="white-space: nowrap;">Accomodations</th>
                                                    <th  style="white-space: nowrap;">Meals</th>

                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php $cnt=1; ?>
                                                <tr>
                                                    <td><input type='date' step='any' class='form-control required_colom' required='required' placeholder='' id="available_from" name="available_from" value="{{$managesetting->package_available_from??''}}" required/></td>
                                                    <td><input type='date' step='any' name='available_to' id="available_to"   class='form-control required_colom'   required='required'  value="{{$managesetting->package_available_to??''}}"></td>
                                                    <td><input type='text' step='any' class='form-control required_colom' required='required' id="accomodation" name="accomodation" placeholder="Luxury view hotel" value="{{$managesetting->accomodation??''}}" required></td>
                                                    <td><input type='text' step='any' name='meal' id="meal"   class='form-control required_colom'  placeholder="High quality meal" required='required' value="{{$managesetting->meal??''}}" required></td>
                                               </tr>

                                                </tbody>
                                                <thead>
                                                <tr>
                                                    <th  style="white-space: nowrap;">Transportation</th>
                                                    <th  style="white-space: nowrap;">locations</th>
                                                    <th  style="white-space: nowrap;">Airfare</th>
                                                    <th  style="white-space: nowrap;">Departure Airport</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td><input type='text' step='any' name='transportation' id="transportation"   class='form-control required_colom'  placeholder="Mercedes Benz" required='required'  value="{{$managesetting->transportation??''}}" required></td>
                                                    <td><input type='text' step='any' name='location' id="location"   class='form-control required_colom'  placeholder="Baghdad" required='required'  value="{{$managesetting->meal??''}}" required></td>
                                                    <td><input type='text' step='any' name='airfare' id="airfare"   class='form-control required_colom'  placeholder="1200" required='required'  value="{{$managesetting->location??''}}" required></td>
                                                    <td><input type='text' step='any' name='departure_place' id="AJK New Airport, Kuwait"   class='form-control required_colom'  placeholder="Mercedes Benz" required='required'  value="{{$managesetting->departure_place??''}}" required></td>
                                                    <input class="form-control" name="product_category" type="hidden" id="product_category" value="Package" >
                                                    <td>

                                                </tr>

                                                </tbody>
                                                <thead>
                                                <tr>
                                                    <th  style="white-space: nowrap;">Guide</th>
                                                    <th  style="white-space: nowrap;">Deadline to Register</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>

                                                    <td><input type='text' step='any' name='guide' id="guide"   class='form-control required_colom'  placeholder="Abu Huziafa" required='required'  value="{{$managesetting->guide??''}}" required></td>
                                                    <td><input type='date' step='any' name='deadline' id="deadline"   class='form-control required_colom'   required='required'  value="{{$managesetting->deadline??''}}"></td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type='submit' >
                        </div>






@push('js')

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="{{asset('js/jasny-bootstrap.js')}}"></script>

<script>



    $('#package_deals_desc').summernote({
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




    $('#package_deals_itinerary').summernote({
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
    $('#house_rules').summernote({
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



    function addedudetails(){
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
        cell4.innerHTML = "<input type='file' step='any' name='PhotoLocation[]' accept='image/*'  class='form-control required_colom address' required='required' />";
        cell5.innerHTML = "<input type='radio'  name='Showimage[]' value="+ indexrowcount +" class='form-control required_colom address' required='required'>"
        $("#can_edu_year").each(function() {

        });
        if(jhama == 1){
            cell6.innerHTML = "<button  type='button' class='btn btn-danger ' >remove</button>";
        }else{
            cell6.innerHTML = "<button  type='button' class='btn btn-danger remove' >remove</button>";
        }
        }else {
            alert('You can not add more than 5 images');
        }
    }

    $('#preempform').on('click', '.remove', function(e){
        $(this).closest('tr').remove();
    })



//    function addprogramdetails(){
//        var table = document.getElementById("prodetail");
//        var rowCount = $('#prodetail tr').length;
//        var row = table.insertRow(rowCount);
//        // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
//        var hotelLocationId = "HotelLocation"+rowCount;
//
//
//        var cell1 = row.insertCell(0);
//        var cell2 = row.insertCell(1);
//        var cell3 = row.insertCell(2);
//        var cell4 = row.insertCell(3);
//
//        var jaja = 1 ;
//        var pappu =  rowCount;
//        var jhama = pappu -  jaja ;
//
//        // console.log(jhama) ;
//
//        cell1.innerHTML = "<input type='number' step='any'  class='form-control required_colom' required='required' placeholder='' value="+ jhama +" readonly />";
//        cell2.innerHTML = "<input type='time' step='any' name='programtime[]'    class='form-control required_colom' required='required' />";
//        cell3.innerHTML = "<input type='text' step='any' name='programtimedes[]' id='can_edu_year'  class='form-control required_colom datepick' required='required' placeholder='Short Description' />";
//        $("#can_edu_year").each(function() {
//
//        });
//        if(jhama == 1){
//            cell4.innerHTML = "<button  type='button' class='btn btn-danger ' >remove</button>";
//        }else{
//            cell4.innerHTML = "<button  type='button' class='btn btn-danger remove' >remove</button>";
//        }
//
//    }
//
//    $('#prodetail').on('click', '.remove', function(e){
//        $(this).closest('tr').remove();
//    })
</script>
@endpush