    
        
            
                
                    
                    
                        
                            
                    
                    
                    
                    
                        
                            
                                
                            
                        
                    

                    
                        
                        

                        

                    
                
            
        
    


































<?php $__env->startPush('css'); ?>
<link href="<?php echo e(asset('css/customCss.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('css/responsive.css')); ?>" rel="stylesheet" />
    <style>.add-photo{width:-webkit-fill-available;}
        .fa-input {
            font-family: FontAwesome, 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }
        label{
            color:#000;
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
                    <h3 class="box-title m-b-0">Edit Guide</h3>
                    <hr>
                    <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                    <form  class="form-horizontal" method="POST" action="<?php echo e(route('update-guide')); ?>" enctype='multipart/form-data'  >
                        <?php echo e(csrf_field()); ?>

                        <input class="form-control" name="GuidesID" type="hidden" id="GuidesID" value="<?php echo e($guid->GuidesID); ?>">

                        <div class="form-group <?php echo e($errors->has('GuidesName') ? 'has-error' : ''); ?>">
                            <label for="GuidesName" class="col-md-2 control-label"><?php echo e('Guides Name'); ?></label>
                            <div class="col-md-10">
                                <input class="form-control" name="GuidesName" type="text" id="GuidesName" value="<?php echo e($guid->GuidesName??''); ?>" required>
                                <?php echo $errors->first('GuidesName', '<p class="help-block">:message</p>'); ?>

                            </div>
                        </div>

                        <div class="form-group <?php echo e($errors->has('GuidesDesc') ? 'has-error' : ''); ?>">
                            <label for="GuidesDesc" class="col-md-2 control-label"><?php echo e('Guides Description'); ?></label>
                            <div class="col-md-10">
                                <textarea maxlength="1000" class="form-control" rows="5" name="GuidesDesc" type="textarea" id="GuidesDesc" ><?php echo e($guid->GuidesDesc??''); ?></textarea>
                                <?php echo $errors->first('GuidesDesc', '<p class="help-block">:message</p>'); ?>

                            </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        

                        <div class="form-group <?php echo e($errors->has('PricePerDay') ? 'has-error' : ''); ?>">
                            <label for="PricePerDay" class="col-md-2 control-label"><?php echo e('Price Per Day'); ?></label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon" title="Dollars">$</span>
                                    <input class="form-control" name="PricePerDay" type="number" id="PricePerDay" value="<?php echo e($guid->PricePerDay??''); ?>" <?php if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('user')): ?> readonly <?php endif; ?>>
                                    <?php echo $errors->first('PricePerDay', '<p class="help-block">:message</p>'); ?>

                                </div>
                            </div>
                        </div>

                        <div class="form-group <?php echo e($errors->has('MaxOccupancy') ? 'has-error' : ''); ?>">
                            <label for="MaxOccupancy" class="col-md-2 control-label"><?php echo e('Maximum Occupancy'); ?></label>
                            <div class="col-md-10">
                                <input class="form-control" name="MaxOccupancy" type="number" id="MaxOccupancy" value="<?php echo e($guid->MaxOccupancy??''); ?>" >
                                <?php echo $errors->first('MaxOccupancy', '<p class="help-block">:message</p>'); ?>

                            </div>
                        </div>

                        <div class="form-group <?php echo e($errors->has('GuidesLocation') ? 'has-error' : ''); ?>">
                            <label for="GuidesLocation" class="col-md-2 control-label"><?php echo e('Guides Based at City'); ?> <?php if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('user')): ?> (<a href="<?php echo e('/guideCity/guide-city/'); ?>">Manage</a>) <?php endif; ?> </label>
                            <div class="col-md-10">
                                <select class="form-control" name="GuidesLocation" id="GuidesLocation" required>
                                    <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($city->city_name??''); ?>" <?php if(isset($guid->GuidesLocation)): ?> <?php if($city->city_name == $guid->GuidesLocation): ?> selected <?php endif; ?> <?php endif; ?>><?php echo e($city->city_name??''); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                
                                <?php echo $errors->first('GuidesLocation', '<p class="help-block">:message</p>'); ?>

                            </div>
                        </div>

                        <div class="form-group <?php echo e($errors->has('GuidePhoneno') ? 'has-error' : ''); ?>">
                            <label for="GuidePhoneno" class="col-md-2 control-label"><?php echo e('Guide Phone no'); ?></label>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <input class="form-control" name="GuidePhoneno" type="text" id="GuidePhoneno" value="<?php echo e($guid->GuidePhoneno??''); ?>" >
                                    <!--<span class="input-group-addon" title="Days">Days</span>-->
                                    <?php echo $errors->first('GuidePhoneno', '<p class="help-block">:message</p>'); ?>

                                </div>
                            </div>
                        </div>

						

                        <div class="form-group <?php echo e($errors->has('HouseRules') ? 'has-error' : ''); ?>">
                            <label for="HouseRules" class="col-md-2 control-label"><?php echo e('Houserules (Rules,Meeting Location and Time)'); ?></label>
                            <div class="col-md-10">
                                <textarea maxlength="1000" class="form-control" rows="5" name="HouseRules" type="textarea" id="HouseRules" ><?php echo e($guid->HouseRules??''); ?></textarea>
                                <?php echo $errors->first('HouseRules', '<p class="help-block">:message</p>'); ?>

                            </div>
                        </div>

                        <div class="form-group <?php echo e($errors->has('Languages') ? 'has-error' : ''); ?>">
                            <label for="FeatureID" class="col-md-2 control-label"><?php echo e('Languages'); ?></label>
                            <div class="col-md-10">
                                <div class="row">
                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-md-4">
                                            <input type="checkbox" id="Languages" name="Languages[]" value="<?php echo e($language->language_name??''); ?>"
                                                   <?php if(isset($guid->Languages)): ?> <?php if(in_array($language->language_name, preg_split ("/\,/", $guid->Languages))): ?> checked <?php endif; ?> <?php endif; ?>
                                            >
                                            <label for="" title="<?php echo e(ucfirst($language->language_name??'')); ?>"> <?php echo e(ucfirst($language->language_name??'')); ?></label>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <?php echo $errors->first('Languages', '<p class="help-block">:message</p>'); ?>

                            </div>
                        </div>




                        <?php if(Auth::user()->hasrole('SuperAdmin') || Auth::user()->hasrole('admin')): ?>
                            <div class="form-group <?php echo e($errors->has('Admin_status') ? 'has-error' : ''); ?>">

                                <label for="Status" class="col-md-2 control-label"><?php echo e('Status'); ?></label>
                                <div class="col-md-10">
                                    <select class="form-control" name="Admin_status" id="Admin_status" required>
                                        <option value="1" <?php if(isset($guid->Admin_status)): ?> <?php if($guid->Admin_status == "1"): ?> selected <?php endif; ?> <?php endif; ?>>Active</option>
                                        <option value="0" <?php if(isset($guid->Admin_status)): ?> <?php if($guid->Admin_status == "0"): ?> selected <?php endif; ?> <?php endif; ?>>Inactive</option>
                                    </select>
                                    <input class="form-control" name="GuidesStatus" type="hidden" id="GuidesStatus" value="<?php echo e($guid->GuidesStatus??''); ?>" >
                                    <?php echo $errors->first('Status', '<p class="help-block">:message</p>'); ?>

                                </div>
                            </div>
                        <?php else: ?>
                        <div class="form-group <?php echo e($errors->has('Status') ? 'has-error' : ''); ?>">
                            <?php if(isset($guid->Admin_status)): ?> <?php if($guid->Admin_status == "0"): ?>
                            <p class="col-md-12 text-center text-danger">This guide is inactive by SuperAdmin, please contact our support.</p>
                            <?php endif; ?> <?php endif; ?>
                            <label for="GuidesStatus" class="col-md-2 control-label"><?php echo e('Status'); ?></label>
                            <div class="col-md-10">
                                <select class="form-control" name="GuidesStatus" id="GuidesStatus" required>
                                    <option value="1" <?php if(isset($guid->GuidesStatus)): ?> <?php if($guid->GuidesStatus == "1"): ?> selected <?php endif; ?> <?php endif; ?>>Active</option>
                                    <option value="0" <?php if(isset($guid->GuidesStatus)): ?> <?php if($guid->GuidesStatus == "0"): ?> selected <?php endif; ?> <?php endif; ?>>Inactive</option>
                                </select>
                                <input class="form-control" name="Admin_status" type="hidden" id="Admin_status" value="<?php echo e($guid->Admin_status??''); ?>" >
                                
                                <?php echo $errors->first('GuidesStatus', '<p class="help-block">:message</p>'); ?>

                            </div>
                        </div>
                            
                                
                                    
                                
                                
                                
                                    
                                        
                                        
                                    
                                    
                                    
                                
                            
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="Status" class="col-md-2 control-label"><?php echo e('Guide Images'); ?></label>
                            <div class="col-md-10">
                                <div class="form-group">
                                    <div class="payroll-table card">
                                        <div class="table-responsive">
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="preempform">
                                                        <thead>
                                                        <tr>
                                                            <th  style="white-space: nowrap;">S.NO.</th>
                                                            <th  style="white-space: nowrap;">Photo Title</th>
                                                            <th  style="white-space: nowrap;">AltText</th>
                                                            <th  style="white-space: nowrap;">Photo</th>
                                                            <th  style="white-space: nowrap;">PhotoLocation</th>																								<th  style="white-space: nowrap;">Default Image</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        <tr>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $__currentLoopData = $guid->getGuidePics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $myphotos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php $cnt=$myphotos->PhotoID; ?>
                                                            <tr id="myphotoremoverrow-<?php echo e($cnt); ?>">
                                                                <td>
                                                                    <input type='hidden' name="photoidupload[]" step='any' class='form-control required_colom' required='required' placeholder='' value="<?php echo e($cnt); ?>" readonly />

                                                                    <input type='number' name="photoid[]" step='any' class='form-control required_colom' required='required' placeholder='' value="<?php echo e($key); ?>" readonly />
                                                                </td>
                                                                <td>
                                                                    <input type='text' step='any' name='PhotoTitleupload[]' class='form-control required_colom' value="<?php echo e($myphotos->PhotoTitle); ?>" required='required'>
                                                                </td>
                                                                <td>
                                                                    <input type='text' step='any' name='AltTextupload[]' id="can_edu_year"   class='form-control required_colom' value="<?php echo e($myphotos->AltText); ?>"  placeholder="Alternate Text" required='required'>
                                                                </td>
                                                                <td>
                                                                    <img style="height:100px;width:100px;" src="<?php echo e(asset('website').'/'.$myphotos->PhotoLocation); ?>">
                                                                </td>
                                                                <td>
                                                                    <input type='file'  step='any' name='PhotoLocationupload[]'  class='form-control required_colom address' >
                                                                </td>
                                                                <td>
                                                                    <input type='radio'  step='any' name='Showimage[]' value="<?php echo e($key); ?>" <?php if($myphotos->DefaultFlag == "1"): ?> checked="checked" <?php endif; ?> value='<?php echo e($key); ?>'  class='form-control required_colom address' >
                                                                </td>
                                                                <td>
                                                                    <?php if($key == 0): ?>
                                                                        <div class="text-right" style="margin-bottom : 2%">
                                                                            <button type="button" onclick="addedudetails()" class="btn btn-primary add-photo">+ Add Photo</button>
                                                                            <br />
                                                                        </div>
                                                                    <?php else: ?>
                                                                        <button onclick="transportationImageRemove(<?php echo e($cnt); ?>)"  type='button' class='btn btn-danger removeimage' > - Remove Photo</button>
                                                                    <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <input class="btn btn-primary fa-input" type='submit' value="&#xf021; UPDATE">
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
        function transportationImageRemove(id) {
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
                    $.get('<?php echo e(URL::to("guide-image-remove")); ?>/'+id,function(data){});
                    swal("Your Image status has been removed!", {
                        icon: "success",
                    });
                } else {
                    swal("Your Image status has not changed!");
        }
        });
        }
        function addedudetails() {
            if($('#preempform tr').length<7){
                var table = document.getElementById("preempform");
                var rowCount = $('#preempform tr').length;
                var row = table.insertRow(rowCount);
                // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                var hotelLocationId = "HotelLocation" + rowCount;
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                var cell4 = row.insertCell(3);
                var cell5 = row.insertCell(4);
                var cell6 = row.insertCell(5);
                var cell7 = row.insertCell(6);
                var jaja = 1;
                var pappu = rowCount;
                var jhama = pappu - jaja;
                var indexrowcount = jhama - jaja;
                // console.log(jhama) ;
                cell1.innerHTML = "<input type='number' step='any'  class='form-control required_colom' required='required' placeholder='' value=" + jhama + " readonly />";
                cell2.innerHTML = "<input type='text' step='any' name='PhotoTitle[]'    class='form-control required_colom' required='required' />";
                cell3.innerHTML = "<input type='text' step='any' name='AltText[]' id='can_edu_year'  class='form-control required_colom datepick' required='required' placeholder='Alternate Text' />";
                cell4.innerHTML = "";
                cell5.innerHTML = "<input type='file' step='any' name='PhotoLocation[]' accept='image/png, image/gif, image/jpeg' class='form-control required_colom address' required='required' />";
                cell6.innerHTML = "<input type='radio' step='any' name='Showimage[]' value=" + indexrowcount + " class='form-control required_colom address' required='required' />";
                $("#can_edu_year").each(function () {
                });
                if (jhama == 1) {
                    cell7.innerHTML = "<button  type='button' class='btn btn-danger'>- Remove Photo</button>";
                } else {
                    cell7.innerHTML = "<button  type='button' class='btn btn-danger remove'>- Remove Photo</button>";
                }
            }else {
                alert('You can not add more than 5 images');
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
                cell4.innerHTML = "<button  type='button' class='btn btn-danger'>- Remove Photo</button>";
            }else{
                cell4.innerHTML = "<button  type='button' class='btn btn-danger remove'>- Remove Photo</button>";
            }
        }
        $('#prodetail').on('click', '.remove', function(e){
            $(this).closest('tr').remove();
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/guid/guid/edit.blade.php ENDPATH**/ ?>