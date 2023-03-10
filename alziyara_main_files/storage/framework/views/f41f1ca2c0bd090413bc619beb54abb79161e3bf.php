<?php $__env->startPush('css'); ?>
<style>
    label{
        color: #000000;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">



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
                <h3 class="box-title pull-left">Edit Room</h3>
                <a class="btn btn-success pull-right" href="<?php echo e(URL('myrooms')); ?>/<?php echo e($data['room']['PropertyId']??0); ?>">View All Rooms</a>
                
                <div class="clearfix"></div>
                <hr>
                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                <form  class="form-horizontal" method="POST" action="<?php echo e(route('myupdaterooms')); ?>" enctype='multipart/form-data'  >

                <?php echo e(csrf_field()); ?>

						
						
				
                    <div class="row">
					<input type="hidden" name="roomid" class="form-control" value="<?php echo e($data['room']->id); ?>" required >
                        <label class="col-md-2">Room Name/No</label>
                        <div class="col-md-4">
                            <input type="text" name="RoomName" class="form-control" value="<?php echo e(old('RoomName', $data['room']->RoomName)); ?>" required placeholder="Room Name/No">
						</div>
						
						<label class="col-md-2">Hotel</label>
							<div class="col-md-4">
								<select class="form-control" name="roomproperty" required >
									<?php $__currentLoopData = $data['property']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myproperty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($myproperty->PropertyID); ?>" <?php if($myproperty->PropertyID == $data['room']->PropertyId): ?> selected <?php endif; ?> ><?php echo e($myproperty->Name); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									
								</select>
							</div>
                    
                    </div>
                    <br/>
                    <div class="form-group">
						
						<label class="col-md-2" >Room Type Pricing</label>
                        <div class="col-md-4">
                            
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                <input type="number" name="RoomPrice" class="form-control" value="<?php echo e(number_format((float)old('RoomPrice', $data['room']->Price), 2, '.', '')); ?>" placeholder="Room Price" required <?php if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('user')): ?> readonly <?php endif; ?>>
                                <span class="input-group-addon">.00</span>
                            </div>
                        </div>
					
					
						<label class="col-md-2" >Room Type</label>
                        <div class="col-md-4">
							<select class="form-control" name="RoomType"  required >
                                <?php $__currentLoopData = $data['room_types']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($room_type->name); ?>" <?php if($room_type->name == $data['room']->RoomType): ?> selected <?php endif; ?>><?php echo e($room_type->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								
								
								
								
								
								
								
							</select>
                        </div>
                        
                    </div>
					
					<div class="form-group">
					
                        <!--<label class="col-md-2">Hotel/Property Price</label>
                        <div class="col-md-4">
                            <input type="number" name="HotelPrice" class="form-control" value="<?php echo e(old('Price')); ?>" placeholder="Hotel/Property Price"> 
						</div>-->
						
						<label class="col-md-2">Quantity Of Room Beds</label>
                        <div class="col-md-4">
                            <input type="number" name="qtyofbed" class="form-control" value="<?php echo e(old('qtyofbed', $data['room']->QtyOfBed)); ?>" placeholder="Quantity Of Bed" required> 
						</div>
						
						<label class="col-md-2">Room Bed Type</label>
                        <div class="col-md-4">
                            
							<select class="form-control" name="bedtype" required >
									<?php $__currentLoopData = $data['bedtype']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mybedtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($mybedtype->BedTypeID); ?>"><?php echo e($mybedtype->BedTypeDesc); ?></option>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									
							</select>
						</div>
						
						
					</div>
					
					<div class="form-group">
					
                        <label class="col-md-2">Maximum Occupancy of Rooms</label>
                        <div class="col-md-4">
							<input type="number" name="roomoccupancy" class="form-control" value="<?php echo e(old('roomoccupancy', $data['room']->MaxOccupancy )); ?>" placeholder="Room Occupancy" required> 
						</div>	
							
							
						<label class="col-md-2">Room Photo</label>
						<div class="col-md-2">
							<img style="height:100%;width:100%;" src="<?php echo e(asset('website').'/'.$data['room']->RoomImage); ?>" > 
						</div>
                        <div class="col-md-2">
                            <input type="file" name="roomphoto" class="form-control"  > 
						</div>
						
					</div>
					
					<div class="form-group">
					
						<label class="col-md-3">Quantity Of Rooms Availabl in this Room Type</label>
							
							<div class="col-md-3">
								<input type="number" name="qtyofroom" class="form-control" value="<?php echo e(old('qtyofroom', $data['room']->AvailableQty)); ?>" placeholder="Quantity Of Room" required> 
							</div>
							
						<label class="col-md-3">Rooms Tax and Charges</label>
							
							<div class="col-md-3">
								<input type="number" name="roomoftax" class="form-control" value="<?php echo e(old('roomoftax', $data['room']->TaxAndCharges)); ?>" placeholder="Rooms Tax and Charges" required> 
							</div>
							
							
					</div>
					
					
					<div class="form-group">
					
						<label class="col-md-12">Room Description</label>
						
							<textarea maxlength="500" name="roomdescription" class="form-control" id="summernote" row="4"><?php echo old('roomdescription', $data['room']->RoomDescription ); ?></textarea>
					
					</div>
					
					<div class="form-group">

                        <h3 class="col-sm-12"><b>Room Features</b> <?php if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('user')): ?> <a href="<?php echo e(url('roomsFeatureList/rooms-feature-list/')); ?>">Manage</a> <?php endif; ?></h3>
						<br/>
						<br/>
						<br/>
						
						<?php $__currentLoopData = $data['RoomFeatureList']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $roomfeatures): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<div class="col-sm-4">
									<input class="form-check-input" name="roomfeature[]" <?php $__currentLoopData = $data['room']->roomFeatureList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $myroomfeature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php if($roomfeatures->FeatureID == $myroomfeature->FeatureID): ?> checked <?php endif; ?> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> type="checkbox" value="<?php echo e($roomfeatures->id); ?>" id="defaultCheck1">
									  <label class="form-check-label" for="defaultCheck1">
										<?php echo e($roomfeatures->Title); ?>

									  </label>
							</div>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
					
                    <!--<div class="form-group">
                        <label class="col-md-12">Hotel/Property Description</label>
                        <div class="col-md-12">
                            <textarea maxlength="500" class="form-control" name="HotelDesc"  rows="5"><?php echo e(old('HotelDesc')); ?></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Hotel/Property HouseRules</label>
                        <div class="col-md-12">
                            <textarea maxlength="500" class="form-control summerhousehours" name="HotelHouseRules" rows="5"><?php echo e(old('HotelHouseRules')); ?></textarea>
                        </div>
                    </div>
                    
                    <div class="form-group">
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
                   <!--<div class="form-group">
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/hotelsviews/editmyroom.blade.php ENDPATH**/ ?>