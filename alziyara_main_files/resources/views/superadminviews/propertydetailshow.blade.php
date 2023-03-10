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
                <h3 class="box-title m-b-0">Hotel/Property Details</h3>
                <br/>
                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                <form  class="form-horizontal" method="POST" action="{{route('savehotel')}}" enctype='multipart/form-data'  >

                {{csrf_field()}}
                    <div class="row">
                        <label class="col-md-2">Hotel/Property Name</label>
                        <div class="col-md-4">
                            <input type="text" name="HotelName" class="form-control" value="{{$data['property']->Name}}" placeholder="Hotel/Property Name">
						</div>
						
						<label class="col-md-2">Hotel/Property Type</label>
							<div class="col-md-4">
								<select class="form-control" name="propertytype">
									@foreach($data['propertytype'] as $mypropertytype)
										<option @if($mypropertytype->PropertyTypeID == $data['property']->PropertyTypeID ) selected @endif >{{$mypropertytype->PropertyTypeDesc}}</option>
									@endforeach
									
								</select>
							</div>
                    
                    </div>
                    <br/>
                    <div class="form-group">
					
					
							<label class="col-md-2" >Hotel/Property Country</label>
							
							<div class="col-md-4">
                        
                            <input type="text" name="HotelCountry" class="form-control" value="{{$data['property']->Country}}" placeholder="Hotel/Property Country"> 
							
							</div>
						
					
						<label class="col-md-2" >Hotel/Property City</label>
							
							<div class="col-md-4">
								<input type="text" class="form-control" value="{{$data['property']->City}}" >
							</div>
                        
                    </div>
					
					<div class="form-group">
					
						
						<label class="col-md-2">Hotel/Property Postal Code</label>
                        <div class="col-md-4">
                            <input type="number" name="HotelPostalCode" class="form-control" value="{{ $data['property']->PostalCode }}" placeholder="Hotel/Property Postal Code"> 
						</div>
						
					</div>
					
					<div class="form-group">
					
                        <label class="col-md-2">Hotel/Property Providing Shuttle Service</label>
                        <div class="col-md-1">
							<label>Yes</label>
						</div>
						<div class="col-md-1">
                            <input type="radio" name="HotelShuttleService" class="form-control" checked value = "1" placeholder="Hotel/Property Price">
						</div>
						<div class="col-md-1">
							<label>No</label>
						</div>
						<div class="col-md-1">
							<input type="radio" name="HotelShuttleService" class="form-control" value = "0"  placeholder="Hotel/Property Price">
						</div>	
							<!--<select name="hotelDistancetype" >
								<option value="">Select Option</option>
								<option value=""></option>
								<option value=""></option>
							</select>-->
						
						
						<label class="col-md-2">Distance Between Hotel/Property and Location </label>
                        <div class="col-md-4">
                            <input type="number" name="HotelDistance" class="form-control" value="{{ $data['property']->PropertyDistance }}">Km 
						</div>
						
					</div>
					
					<div class="form-group">
                        <label class="col-md-12">Hotel/Property Address</label>
                        <div class="col-md-12">
							
							<input type="type" name="HotelAddress" class="form-control" value="{!! $data['property']->Address !!}" placeholder="Hotel/Property Address"> </div>
                            
                    </div>
                    <div class="form-group">
                        <label class="col-md-12"><strong>Hotel/Property Description</strong></label>
                        <div class="col-md-12">
                            {!! $data['property']->Description !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12"><strong>Hotel/Property HouseRules</strong></label>
                        <div class="col-md-12">
                            {!! $data['property']->HouseRules !!}
                        </div>
                    </div>

					
					<div class="form-group">
                        <label class="col-md-12"><strong>Hotel/Property General</strong></label>
                        <div class="col-md-12">
                            {!! $data['property']->getHotelFeaturesAndAmenities->generl !!}
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12"><strong>Hotel/Property Food and Drink</strong></label>
                        <div class="col-md-12">
                            {!! $data['property']->getHotelFeaturesAndAmenities->food_and_drink !!}
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12"><strong>Hotel/Property Front Desk Services</strong></label>
                        <div class="col-md-12">
                            {!! $data['property']->getHotelFeaturesAndAmenities->front_desk_services !!}
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12"><strong>Hotel/Property Entertainment and Family Services</strong></label>
                        <div class="col-md-12">
                            {!! $data['property']->getHotelFeaturesAndAmenities->entertainment_and_family_services !!}
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12"><strong>Hotel/Property Living Area</strong></label>
                        <div class="col-md-12">
                            {!! $data['property']->getHotelFeaturesAndAmenities->living_area !!}
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12"><strong>Hotel/Property Health Facility</strong></label>
                        <div class="col-md-12">
                            {!! $data['property']->getHotelFeaturesAndAmenities->health_facility !!}
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12"><strong>Hotel/Property Safety and Security</strong></label>
                        <div class="col-md-12">
                            {!! $data['property']->getHotelFeaturesAndAmenities->safety_and_security !!}
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12"><strong>Hotel/Property Bussiness Facility</strong></label>
                        <div class="col-md-12">
                            {!! $data['property']->getHotelFeaturesAndAmenities->bussiness_facility !!}
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12"><strong>Hotel/Property Accessibility</strong></label>
                        <div class="col-md-12">
                            {!! $data['property']->getHotelFeaturesAndAmenities->accessibility !!}
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12"><strong>Hotel/Property Languages Spoken</strong></label>
                        <div class="col-md-12">
                            {!! $data['property']->getHotelFeaturesAndAmenities->languages_spoken !!}
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12"><strong>Hotel/Property Cleaning Services</strong></label>
                        <div class="col-md-12">
                            {!! $data['property']->getHotelFeaturesAndAmenities->cleaning_service !!}
                        </div>
                    </div>
                    
                    <!--<div class="form-group">
                        <label class="col-md-12">Hotel/Property Start Time</label>
                        <div class="col-md-12">
                            <input type="time" class="form-control" name="GuestPassstartTime" placeholder="GuestPass Time" value="{{ old('GuestPassstartTime') }}"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Hotel/Property End Time</label>
                        <div class="col-md-12">
                            <input type="time" class="form-control" name="GuestPassendTime" placeholder="GuestPass Time" value="{{ old('GuestPassendTime') }}"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12">File upload</label>
                        <div class="col-sm-12">
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"> <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div> <span class="input-group-addon btn btn-default btn-file"> <span class="fileinput-new">Select file</span> <span class="fileinput-exists">Change</span>
                                        <input type="file" name="[]"> </span> <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> </div>
                        </div>
                    </div>-->
                    <div class="form-group">
                        <div class="payroll-table card">
                        
                            
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
                                    
                                    <div class="text-right" >
                                        
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
                                            </tr>
                                            </thead>
                                            <tbody>
												
											@foreach($data['property']->getHotelPics as $key => $myphotos)
                                                <tr>
                                                <td><input type='number' step='any' class='form-control required_colom' required='required' placeholder='' value="{{$key}}" readonly /></td>
                                                <td><input type='text' step='any' value="{{$myphotos->PhotoTitle}}"  class='form-control required_colom' required='required'></td>
                                                <td><input type='text' step='any' value="{{$myphotos->AltText}}" id="can_edu_year"   class='form-control required_colom'  placeholder="Alternate Text" required='required'></td>
                                                <td><img src="{{asset('website').'/'.$myphotos->PhotoLocation}}" style="height:auto; width:50%;"></td>
												<td><input type='radio' @if($myphotos->DefaultFlag == 1) checked="checked" @endif class='form-control required_colom address' required='required'></td>
                                                
                                                </tr>
											@endforeach
                                            </tbody>
                                        </table>
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
	
    </script>
@endpush