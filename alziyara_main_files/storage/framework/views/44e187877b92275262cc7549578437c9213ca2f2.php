<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
<!-- <link href="<?php echo e(asset('plugins/components/dashboard/css/customstyle.css')); ?>" rel="stylesheet" /> -->
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
    <p class="alert alert-success"><?php echo e(session('message')); ?></p>
</div>
<?php endif; ?>
<div class="container-fluid">
    <!-- .row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box sales_chart_border">
                <h3 class="box-title pull-left">Settings - Hotel</h3>
                <?php if(Auth::user()->hasRole('SuperAdmin') || Auth::user()->hasRole('user')): ?>
                    <div class="room_type_btn">
                        <a class="btn btn-success" href="<?php echo e(url('/roomType/room-type/')); ?>">Room Types</a>
                        <a class="btn btn-success" href="<?php echo e(url('/roomsFeatureList/rooms-feature-list/')); ?>">Room Features</a>
                    </div>

                <?php endif; ?>
                <div class="clearfix"></div>
                <hr>
                <!--<p class="text-muted m-b-30 font-13"> All bootstrap element classies </p>-->
                <table id="myTable" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <?php if(!Auth::user()->hasRole('HotelsAdmin')): ?>
                                <th>Service Provider</th>
                            <?php endif; ?>
                            <th>Property Image</th>
                            <th>Property Name</th>
                            <th>Publish Status</th>
                            <th>Actions</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $property; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $myproperty): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($key+1); ?></td>
                            <?php if(!Auth::user()->hasRole('HotelsAdmin')): ?>
                                <td><?php echo e($myproperty->getUserofProperty->name??''); ?></td>
                            <?php endif; ?>
                            <td><?php $__currentLoopData = $myproperty->getHotelPics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ht_pics): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if($ht_pics->DefaultFlag == '1'): ?>
												<img style="height:100px;width: 100px;" src="<?php echo e(asset('website').'/'.$ht_pics->PhotoLocation); ?>">
										<?php endif; ?>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</td>
                            <td><a href="<?php echo e(url('hotelsdetails/'.$myproperty->PropertyID.'/'.$myproperty->Name)); ?>" target="_blank"><?php echo e($myproperty->Name); ?></a></td>
								<?php if($myproperty->Admin_status == 1): ?>
										<th>Active</th>
								<?php elseif($myproperty->Admin_status == 0): ?>
										<td>Not Active</td>
								<?php elseif($myproperty->Admin_status == 2): ?>
										<td>Draft</td>
								<?php endif; ?>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        Change Status
                                    </button>
                                    
                                                
                                    <a class="btn btn-info" href="<?php echo e(route('myroom')); ?>/<?php echo e($myproperty->PropertyID); ?>"><i
                                                class="fa fa-eye"></i> View Rooms </a>
                                    <a  class="btn btn-warning" href="<?php echo e(route('edithotel',$myproperty->PropertyID)); ?>"><i
                                                class="fa fa-pencil"></i>Edit Hotel</a>
                                    <div class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" onclick="userstatus(<?php echo e($myproperty->PropertyID); ?>,'active')">ACTIVE</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" onclick="userstatus(<?php echo e($myproperty->PropertyID); ?>,'notactive')">NOT ACTIVE</a>
                                        </li>
                                        
                                            
                                        
                                    </div>
                                </div>
                            </td>
                            
                                
                                    
                                        
                                    
                                    
                                        
											
                                        
                                        
											
										
                                        
											
                                        
                                    
                                
                            
                            
                                
                                    
                                    
                                
                            
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




    <!-- ===== Right-Sidebar ===== -->
    <?php echo $__env->make('layouts.partials.right-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>

<script>
$('#myTable').DataTable();
function userstatus(id, status) {
    console.log(id);
    console.log(status);
    swal({
            title: "Are you sure?",
            text: "Do you really want to change the status!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {

                $.get('<?php echo e(URL::to("adminpropertystatus")); ?>/'+id+'/'+status,function(data){	
						window.location.reload();
						});
                swal("Your Property status has been updated!", {
                    icon: "success",
                });
            } else {
                swal("Your Property status has not changed!");
            }
        });
}
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/superadminviews/allproperty.blade.php ENDPATH**/ ?>