<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<link href="<?php echo e(asset('plugins/components/dashboard/css/customstyle.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('css/customCss.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('css/responsive.css')); ?>" rel="stylesheet" />



                <?php if($errors->any()): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>


                <?php if(session('message')): ?>
                  <!-- <div class="account-title"><?php echo e(session('message')); ?></div> -->
                  <div class="account-title">  

                     <p class="alert alert-success" ><?php echo e(session('message')); ?></p>
                     
                  </div>
                <?php endif; ?>


<div class="container-fluid">
    <!-- .row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title pull-left">Settings - Add Hotel</h3>
                <a class="btn btn-success pull-right" href="<?php echo e(URL('myhotels')); ?>">View All hotels</a>
                
                
                <div class="clearfix"></div>
                <hr>
                
                
                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                <form  class="form-horizontal" method="POST" action="<?php echo e(route('savehotel')); ?>" enctype='multipart/form-data'  >

                <?php echo e(csrf_field()); ?>

                    <div class="row">
                        <label class="col-md-2">Hotel/Property Name</label>
                        <div class="col-md-4">
                            <input type="text" name="HotelName" class="form-control" value="<?php echo e(old('HotelName')); ?>" placeholder="Name" required>
						</div>
						
						<label class="col-md-2">Hotel/Property Type</label>
							<div class="col-md-4">
								<select class="form-control" name="propertytype" required>
									<?php $__currentLoopData = $data['propertytype']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mypropertytype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($mypropertytype->PropertyTypeID); ?>"><?php echo e($mypropertytype->PropertyTypeDesc); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									
								</select>
							</div>
                    
                    </div>
                    <br/>
                    <div class="form-group">
					
					
							<label class="col-md-2" >Hotel/Property Country</label>
							
							<div class="col-md-4">
                        
                            <input type="text" name="HotelCountry" class="form-control" value="<?php echo e(old('HotelCountry')); ?>" placeholder="Country" required>
							
							</div>
						
					
						<label class="col-md-2" >Hotel/Property City</label>
							
							<div class="col-md-4">
								<select class="form-control" name="HotelCity" required>
										<?php $__currentLoopData = $data['cities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mycity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($mycity->GuestPassLocation); ?>"><?php echo e($mycity->GuestPassLocation); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										
								</select>
							</div>
                        
                    </div>
					
					
					
                        <!--<label class="col-md-2">Hotel/Property Price</label>
                        <div class="col-md-4">
                            <input type="number" name="HotelPrice" class="form-control" value="<?php echo e(old('Price')); ?>" placeholder="Price">
						</div>-->
						
						
                        
                            
                            <input type="hidden" name="HotelPostalCode" class="form-control" value="000000" placeholder="Postal Code" required>
						
						
					
					
					<div class="form-group">
					
                        <label class="col-md-2">Hotel/Property Providing Shuttle Service</label>
                        <div class="col-md-1">
							<label>Yes</label>
						</div>
						<div class="col-md-1">
                            <input type="radio" name="HotelShuttleService" class="form-control" checked value = "1" placeholder="Price" required>
						</div>
						<div class="col-md-1">
							<label>No</label>
						</div>
						<div class="col-md-1">
							<input type="radio" name="HotelShuttleService" class="form-control" value = "0"  placeholder="Price" required>
						</div>	
							<!--<select name="hotelDistancetype" >
								<option value="">Select Option</option>
								<option value=""></option>
								<option value=""></option>
							</select>-->
						
						
						<label class="col-md-2">Distance Between Hotel/Property and Nearest Shrine </label>
                        <div class="col-md-4">
                            <input type="number" name="HotelDistance" class="form-control" value="<?php echo e(old('HotelDistance')); ?>" required>Km
						</div>
						
					</div>
					
					<div class="form-group">
                        <label class="col-md-12">Hotel/Property Address</label>
                        <div class="col-md-12">
							
							<input type="type" name="HotelAddress" class="form-control" value="<?php echo e(old('HotelAddress')); ?>" placeholder="Address" required> </div>
                            
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Hotel/Property Description</label>
                        <div class="col-md-12">
                            <textarea maxlength="1000" max class="form-control" name="HotelDesc"  rows="5" required><?php echo e(old('HotelDesc')); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Hotel/Property HouseRules</label>
                        <div class="col-md-12">
                            <textarea maxlength="1000" class="form-control summerhousehours" name="HotelHouseRules" rows="5" required><?php echo e(old('HotelHouseRules')); ?></textarea>
                        </div>
                    </div>

					
					<div class="form-group">
                        <label class="col-md-12">Hotel/Property General</label>
                        <div class="col-md-12">
                            <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenaryGeneral" rows="5" required><?php echo e(old('HotelItenaryGeneral')); ?></textarea>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12">Hotel/Property Food and Drink</label>
                        <div class="col-md-12">
                            <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenaryfood_and_drink" rows="5" required><?php echo e(old('HotelItenaryfood_and_drink')); ?></textarea>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12">Hotel/Property Front Desk Services</label>
                        <div class="col-md-12">
                            <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenaryfront_desk_services" rows="5" required><?php echo e(old('HotelItenaryfront_desk_services')); ?></textarea>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12">Hotel/Property Entertainment and Family Services</label>
                        <div class="col-md-12">
                            <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenaryentertainment_and_family_services" rows="5" required><?php echo e(old('HotelItenaryentertainment_and_family_services')); ?></textarea>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12">Hotel/Property Living Area</label>
                        <div class="col-md-12">
                            <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenaryliving_area" rows="5" required><?php echo e(old('HotelItenaryliving_area')); ?></textarea>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12">Hotel/Property Health Facility</label>
                        <div class="col-md-12">
                            <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenaryhealth_facility" rows="5" required><?php echo e(old('HotelItenaryhealth_facility')); ?></textarea>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12">Hotel/Property Safety and Security</label>
                        <div class="col-md-12">
                            <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenarysafety_and_security" rows="5" required><?php echo e(old('HotelItenarysafety_and_security')); ?></textarea>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12">Hotel/Property Bussiness Facility</label>
                        <div class="col-md-12">
                            <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenarybussiness_facility"  rows="5" required><?php echo e(old('HotelItenarybussiness_facility')); ?></textarea>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12">Hotel/Property Accessibility</label>
                        <div class="col-md-12">
                            <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenaryaccessibility"  rows="5" required><?php echo e(old('HotelItenaryaccessibility')); ?></textarea>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12">Hotel/Property Languages Spoken</label>
                        <div class="col-md-12">
                            <textarea maxlength="1000" class="form-control summerhousehours" name="HotelItenarylanguages_spoken" rows="5" required><?php echo e(old('HotelItenarylanguages_spoken')); ?></textarea>
                        </div>
                    </div>
					
					<div class="form-group">
                        <label class="col-md-12">Hotel/Property Cleaning Services</label>
                        <div class="col-md-12">
                            <textarea maxlength="1000" class="form-control summerhousehours " name="HotelItenarycleaning_service" rows="5" required><?php echo e(old('HotelItenarycleaning_service')); ?></textarea>
                        </div>
                    </div>
                    
                    <!--<div class="form-group">
                        <label class="col-md-12">Hotel/Property Start Time</label>
                        <div class="col-md-12">
                            <input type="time" class="form-control" name="GuestPassstartTime" placeholder="GuestPass Time" value="<?php echo e(old('GuestPassstartTime')); ?>"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Hotel/Property End Time</label>
                        <div class="col-md-12">
                            <input type="time" class="form-control" name="GuestPassendTime" placeholder="GuestPass Time" value="<?php echo e(old('GuestPassendTime')); ?>"> 
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
                                                <td><input type='number' step='any' class='form-control required_colom' required='required' placeholder='' value="<?php echo e($cnt); ?>" readonly /></td>
                                                <td><input type='text' step='any' name='PhotoTitle[]'    class='form-control required_colom' required='required'></td>
                                                <td><input type='text' step='any' name='AltText[]' id="can_edu_year"   class='form-control required_colom'  placeholder="Alternate Text" required='required'></td>
                                                <td><input type='file'  step='any' name='PhotoLocation[]'   class='form-control required_colom address' required='required'></td>

												
												<td><input type='radio' value='0' checked="checked"  name='Showimage[]' class='form-control required_colom address' required='required'></td>
                                                <td>
                                                <?php if($cnt != 1): ?>
                                                <button onclick="removeRow(1)"  type='button' class='btn btn-danger remove' >remove</button>
                                                <?php endif; ?>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--<div class="form-group">
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
                                        <button type="button" onclick="addprogramdetails()" class="btn btn-primary">+ Add Program Detail</button>
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
                                                <th>Action</th>
                                            </tr>
                                            <tr>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php $cnt=1; ?>
                                                <tr>
                                                <td><input type='number' step='any' class='form-control required_colom' required='required' placeholder='' value="<?php echo e($cnt); ?>" readonly /></td>
                                                <td><input type='time' step='any' name='programtime[]'    class='form-control required_colom' required='required'></td>
                                                <td><input type='text' step='any' name='programtimedes[]' id="can_edu_year"   class='form-control required_colom'  placeholder="Short Description" required='required'></td>
                                                <td>
                                                <?php if($cnt != 1): ?>
                                                <button onclick="removeRow(1)"  type='button' class='btn btn-danger remove' >remove</button>
                                                <?php endif; ?>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>--->
                    <div class="form-group">
                        <input class="btn btn-primary" type='submit' >
                    </div>
                </form>
            </div>
        </div>
    </div>




<!-- ===== Right-Sidebar ===== -->
<?php echo $__env->make('layouts.partials.right-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="<?php echo e(asset('js/jasny-bootstrap.js')); ?>"></script>

    <script>
	
	

$('#summernote').summernote({
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
	   



       $('.summerhousehours').summernote({
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
                cell4.innerHTML = "<input type='file' step='any' name='PhotoLocation[]'   class='form-control required_colom address' required='required' />";
				cell5.innerHTML = "<input type='radio'  name='Showimage[]' value="+ indexrowcount +" class='form-control required_colom address' required='required'>"
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
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/hotelsviews/addhotels.blade.php ENDPATH**/ ?>