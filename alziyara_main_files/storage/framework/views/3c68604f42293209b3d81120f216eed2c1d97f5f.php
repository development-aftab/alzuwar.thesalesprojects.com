<?php $__env->startPush('css'); ?>
    <link href="<?php echo e(asset('plugins/components/datatables/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet"
          type="text/css"/>
<!-- <link href="<?php echo e(asset('plugins/components/dashboard/css/customstyle.css')); ?>" rel="stylesheet" /> -->
<link href="<?php echo e(asset('css/customCss.css')); ?>" rel="stylesheet" />
<link href="<?php echo e(asset('css/responsive.css')); ?>" rel="stylesheet" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <!-- .row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="white-box sales_chart_border">
                    <h3 class="box-title pull-left">Settings - Guide</h3>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add-'.str_slug('Guid'))): ?>
                        <a class="btn btn-success pull-right" href="<?php echo e(url('/guid/guid/create')); ?>"><i
                                    class="icon-plus"></i> Add Guide</a>
                    <?php endif; ?>
                    <?php if(Auth::user()->hasRole('SuperAdmin')): ?>
                        <div class="btn_three">
                            <a class="btn btn-success pull-right" href="<?php echo e(url('guideLanguage/guide-language')); ?>"><i class="fa fa-language"></i> Guide Languages </a>
                            <a class="btn btn-success pull-right" href="<?php echo e(url('guideCity/guide-city')); ?>"><i class="fa fa-globe"></i> Guide Cities </a>
                        
                        </div>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                    <hr>
                    <?php if(sizeof($guid)>0): ?>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th>S.No.</th>
                                <?php if(Auth::user()->hasRole('SuperAdmin')): ?>
                                    <th>Service Provider</th>
                                <?php endif; ?>
                                <th>Image</th>
                                <th>Guide Name</th>
                                <th>Guides Created By</th>
                                <th>Price/Day</th>
                                <th>Languages</th>
                                
                                <th>Publish Status</th>
                                <th>Admin Approval</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $guid; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration??$item->id); ?></td>
                                    <?php if(Auth::user()->hasRole('SuperAdmin')): ?>
                                        <td><?php echo e($item->getGuideOwner->name??''); ?></td>
                                    <?php endif; ?>
                                    <td>
                                        <a href="<?php echo e(url('guide-details/'.$item->GuidesID.'/'.$item->GuidesName)); ?>">
                                        <?php if(isset($item->getGuideDefaultPic->PhotoLocation)): ?>
                                            <img style="height:100px; width: 100px; object-fit: cover;"
                                                 src="<?php echo e(asset('website').'/'.$item->getGuideDefaultPic->PhotoLocation); ?>">
                                        <?php else: ?>
                                            <img style="height:100px; width: 100px; object-fit: cover;"
                                                 src="<?php echo e(asset('website/img/not_available.png')); ?>">
                                        <?php endif; ?>
                                        </a>
                                    </td>
                                    <td><a href="<?php echo e(url('guide-details/'.$item->GuidesID.'/'.$item->GuidesName)); ?>" target="_blank"><?php echo e($item->GuidesName); ?></a></td>
                                    <td><?php echo e($item->getGuideOwner->email??''); ?></td>
                                    <td>$<?php echo number_format($item->PricePerDay, 2); ?></td>
                                    <td><?php echo e($item->Languages); ?></td>
                                    
										
                                    <td><?php if($item->GuidesStatus == '1'): ?> <span class="label label-success">Active</span> <?php else: ?> <span class="label label-warning">Inactive</span> <?php endif; ?></td>
                                    <td><?php if($item->Admin_status == '1'): ?> <span class="label label-success">Active</span> <?php else: ?> <span class="label label-warning">Inactive</span> <?php endif; ?></td>
                                    <td>
                                        
                                            
                                               
                                                
                                                    
                                                
                                            
                                        

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-'.str_slug('Guid'))): ?>
                                            <a href="<?php echo e(url('/guid/guid/' . $item->GuidesID . '/edit')); ?>"
                                               title="Edit Guide">
                                                <button class="btn btn-warning btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                </button>
                                            </a>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-'.str_slug('Guid'))): ?>
                                            <form method="POST"
                                                  action="<?php echo e(url('/guid/guid' . '/' . $item->GuidesID)); ?>"
                                                  accept-charset="UTF-8" style="display:inline">
                                                <?php echo e(method_field('DELETE')); ?>

                                                <?php echo e(csrf_field()); ?>

                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete Guide"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i>
                                                </button>
                                            </form>
                                            
                                               
                                                
                                                    
                                                
                                            
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> <?php echo $guid->appends(['search' => Request::get('search')])->render(); ?> </div>
                    </div>
                    <?php else: ?>
                        <h3 class="text-center">Welcome to the Guides management page.</h3>
                        <h3 class="text-center">You don’t have any Guides in our system yet.</h3>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="<?php echo e(asset('plugins/components/toast-master/js/jquery.toast.js')); ?>"></script>

    <script src="<?php echo e(asset('plugins/components/datatables/jquery.dataTables.min.js')); ?>"></script>
    <!-- start - This is for export functionality only -->
    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function () {

            <?php if(\Session::has('message')): ?>
            $.toast({
                heading: 'Success!',
                position: 'top-center',
                text: '<?php echo e(session()->get('message')); ?>',
                loaderBg: '#ff6849',
                icon: 'success',
                hideAfter: 3000,
                stack: 6
            });
            <?php endif; ?>
        })

        $(function () {
            $('#myTable').DataTable({
                'aoColumnDefs': [{
                    'bSortable': false,
                    'aTargets': [-1] /* 1st one, start by the right */
                }]
            });

        });
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/guid/guid/index.blade.php ENDPATH**/ ?>