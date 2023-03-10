@extends('layouts.master')

@push('css')
@endpush

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


                @if(session('message'))
                  <!-- <div class="account-title">{{session('message')}}</div> -->
                  <div class="account-title">  

                     <p class="alert alert-success" >{{session('message')}}</p>
                     
                  </div>
                @endif


<div class="container-fluid">
    <!-- .row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Guests Pass Details</h3>
                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                <form  class="form-horizontal" >

                {{csrf_field()}}

                
                    <div class="form-group">
                        <label class="col-md-12">GuestPass Vendor Name</label>
                        <div class="col-md-12">
                            <input type="text" name="GuestPassVendorName" class="form-control" placeholder="GuestPass Vendor Name" value="{{$guestPass->guestpassbyuser->name??''}}"> </div>
                    </div>
                
                    <div class="form-group">
                        <label class="col-md-2">GuestPass Name</label>
                        <div class="col-md-4">
                            <input type="text" name="GuestPassName" class="form-control" placeholder="GuestPass Name" value="{{$guestPass->GuestPassName}}">						</div>												<label class="col-md-2" >GuestsPass Location</label>                        <div class="col-md-4">                            <input type="text" name="GuestPassLocation" class="form-control" placeholder="GuestsPass Location" value="{{$guestPass->GuestPassLocation}}">                         </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2">GuestPass Price</label>
                        <div class="col-md-4">
                            <input type="number" name="Price" class="form-control" placeholder="GuestsPass Price" value="{{$guestPass->Price}}">
                         </div>						 						 <label class="col-md-2">GuestPass Max Occupancy</label>                        <div class="col-md-4">                            <input type="text" class="form-control" name="MaxOccupancy" placeholder="GuestPass Max Occupancy" value="{{$guestPass->MaxOccupancy}}">                         </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">GuestPass Description</label>
                        <div class="col-md-12">
                            {!! $guestPass->GuestPassDesc !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">GuestPass HouseRules</label>
                        <div class="col-md-12">
                            {!! $guestPass->HouseRules !!}
                        </div>
                    </div>
                    <div class="form-group">
                    <?php   $days = explode(',',$guestPass->ScheduleDays); 
                            $time = explode(' to ',$guestPass->GuestPassTime); 
                            $starttime = date("H:i", strtotime($time[0])); $endtime = date("H:i", strtotime($time[1])); ?>
                        <label class="col-sm-12">GuestPass ScheduleDays</label>
                        <div class="col-sm-12">                            
                            <select class="form-control selectpicker" multiple name="scheduledays[]" >
                                
                                    <option value=2 >Monday</option>
                                    <option value=3 >Tuesday</option>
                                    <option value=4 >Wednesday</option>
                                    <option value=5 >Thursday</option>
                                    <option value=6 >Friday</option>
                                    <option value=7 >Saturday</option>
                                    <option value=1 >Sunday</option>
                               
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">GuestPass Start Time</label>
                        <div class="col-md-12">
                            <input type="time" class="form-control" name="GuestPassstartTime" placeholder="GuestPass Time" value="{{$starttime}}"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">GuestPass End Time</label>
                        <div class="col-md-12">
                            <input type="time" class="form-control" name="GuestPassendTime" placeholder="GuestPass Time" value="{{$endtime}}"> 
                        </div>
                    </div>
                    <!--<div class="form-group">
                        <label class="col-sm-12">File upload</label>
                        <div class="col-sm-12">
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                        <input type="file" name="[]"> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                        </div>
                    </div>-->
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
                                        <!--<button type="button" onclick="addedudetails()" class="btn btn-primary">+ Add Photo</button>-->
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
                                                <th  style="white-space: nowrap;">Photo</th>
                                                <th  style="white-space: nowrap;">PhotoLocation</th>
                                                <!--<th>Action</th>-->
                                            </tr>
                                            <tr>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach($guestPass->getGuestPassDetails as $key => $myphotos)
                                                <?php $cnt=$myphotos->PhotoID; ?>
                                                <tr>
                                                <td><input type='number' name="photoid[]" step='any' class='form-control required_colom' required='required' placeholder='' value="{{$cnt}}" readonly /></td>
                                                <td><input type='text' step='any' name='PhotoTitle[]'    class='form-control required_colom' value="{{$myphotos->PhotoTitle}}" required='required'></td>
                                                <td><input type='text' step='any' name='AltText[]' id="can_edu_year"   class='form-control required_colom' value="{{$myphotos->AltText}}"  placeholder="Alternate Text" required='required'></td>
                                                <td><img style="height:100px;width:100px;" src="{{asset('website').'/'.$myphotos->PhotoLocation}}"></td>
                                                <td><input type='file'  step='any' name='PhotoLocation[]'   class='form-control required_colom address' value="{{$myphotos->PhotoLocation}}"></td>
                                                <!--<td>
                                                {{--@if($cnt != 1)
                                                <button onclick="removeRow(1)"  type='button' class='btn btn-danger remove' >remove</button>
                                                @endif--}}
                                                </td>-->
                                                </tr>
                                                @endforeach
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
                                    <h4 class="card-title mb-0">PROGRAM DETAILS</h4>
                                </div>
                            </div>
                            </div>
                            </div>
                                <div class="card-body">
                                    
                                    <div class="text-right" style="margin-bottom : 2%">
                                        <!--<button type="button" onclick="addprogramdetails()" class="btn btn-primary">+ Add Program Detail</button>-->
                                    <br />
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="prodetail">
                                            <thead>
                                            <p>PROGRAM DETAILS A/C TO THE TIME RANGE</p>
                                            <tr>
                                                <th  style="white-space: nowrap;">S.NO.</th>
                                                <th  style="white-space: nowrap;">Program Time</th>
                                                <th  style="white-space: nowrap;">Program Short Description</th>
                                                <!--<th>Action</th>-->
                                            </tr>
                                            <tr>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($guestPass->getGuestPassprogramDetails as $prokey => $myprogramdetails)
                                                <?php $cnt=$prokey+1; ?>
                                                <tr>
                                                <td><input type='number' step='any' class='form-control required_colom' required='required' placeholder='' value="{{$cnt}}" readonly /></td>
                                                <td><input type='time' step='any' name='programtime[]'    class='form-control required_colom' required='required' value="{{$myprogramdetails->GuestProDetailTime}}"></td>
                                                <td><input type='text' step='any' name='programtimedes[]' id="can_edu_year"   class='form-control required_colom'  placeholder="Short Description" required='required' value="{{$myprogramdetails->GuestProDetailDis}}"></td>
                                                <!--<td>
                                                {{--@if($cnt != 1)
                                                <button onclick="removeRow(1)"  type='button' class='btn btn-danger remove' >remove</button>
                                                @endif--}}
                                                </td>-->
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>




<!-- ===== Right-Sidebar ===== -->
@include('layouts.partials.right-sidebar')
</div>
@endsection

@push('js')

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="{{asset('js/jasny-bootstrap.js')}}"></script>

    <script>
        function addedudetails(){
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
                        
                        // console.log(jhama) ;

                cell1.innerHTML = "<input type='number' step='any'  class='form-control required_colom' required='required' placeholder='' value="+ jhama +" readonly />";
                cell2.innerHTML = "<input type='text' step='any' name='PhotoTitle[]'    class='form-control required_colom' required='required' />";
                cell3.innerHTML = "<input type='text' step='any' name='AltText[]' id='can_edu_year'  class='form-control required_colom datepick' required='required' placeholder='Alternate Text' />";
                cell4.innerHTML = "";
                cell5.innerHTML = "<input type='file' step='any' name='PhotoLocation[]'   class='form-control required_colom address' required='required' />";
                
                    $("#can_edu_year").each(function() {
                    
            });
                if(jhama == 1){
                        cell6.innerHTML = "<button  type='button' class='btn btn-danger ' >remove</button>";
                }else{
                        cell6.innerHTML = "<button  type='button' class='btn btn-danger remove' >remove</button>";
                }

                }

                $('#preempform').on('click', '.remove', function(e){
			   $(this).closest('tr').remove();
			})



            function addprogramdetails(){
                var table = document.getElementById("prodetail");
                var rowCount = $('#prodetail tr').length;
                var row = table.insertRow(rowCount);
                // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                var hotelLocationId = "HotelLocation"+rowCount;
                    
                    
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                
                var jaja = 1 ;
                var pappu =  rowCount;
                    var jhama = pappu -  jaja ;
                        
                        // console.log(jhama) ;

                cell1.innerHTML = "<input type='number' step='any'  class='form-control required_colom' required='required' placeholder='' value="+ jhama +" readonly />";
                cell2.innerHTML = "<input type='time' step='any' name='programtime[]'    class='form-control required_colom' required='required' />";
                cell3.innerHTML = "<input type='text' step='any' name='programtimedes[]' id='can_edu_year'  class='form-control required_colom datepick' required='required' placeholder='Short Description' />";
                    $("#can_edu_year").each(function() {
                    
            });
                if(jhama == 1){
                        cell4.innerHTML = "<button  type='button' class='btn btn-danger ' >remove</button>";
                }else{
                        cell4.innerHTML = "<button  type='button' class='btn btn-danger remove' >remove</button>";
                }

                }

                $('#prodetail').on('click', '.remove', function(e){
			   $(this).closest('tr').remove();
			})

            var myselectvalue = "[{{$guestPass->ScheduleDays}}]";

             var selectmydata = jQuery.parseJSON( myselectvalue );

            // console.log(selectmydata);

            $('.selectpicker').selectpicker('val',selectmydata);

    </script>
@endpush