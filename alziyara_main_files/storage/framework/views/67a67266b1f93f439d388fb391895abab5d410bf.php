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
                    <h3 class="box-title pull-left">Settings - Packages Deal</h3>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add-'.str_slug('ManageSetting'))): ?>
                        <a class="btn btn-success pull-right" href="<?php echo e(url('/manageSetting/manage-setting/create')); ?>"><i
                                    class="icon-plus"></i> Add Packages Deal</a>
                    <?php endif; ?>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="table-responsive">
                        <table class="table" id="myTable">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <?php if(!Auth::user()->hasRole('PackagesAdmin')): ?>
                                    <th class="text-center">Service Provider</th>
                                <?php endif; ?>
                                <th class="text-center">Type</th>
                               <th class="text-center">Package Deals</th>
                                <th class="text-center">Price</th>
                                <?php if(Auth::user()->hasRole('SuperAdmin')): ?>
                                <th class="text-center">Display On HomePage</th>
                                <?php endif; ?>
                                <th class="text-center">Publish Status</th>
                                <th class="text-center">Admin Approval</th>

                                    <th class="text-center">Actions</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $managesetting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr package_id="<?php echo e($item->id); ?>">
                                    <td class="text-center id"><?php echo e($loop->iteration??$item->id); ?></td>
                                    <?php if(!Auth::user()->hasRole('PackagesAdmin')): ?>
                                        <td class="text-center id"><?php echo e($item->getPackageUser->name??''); ?></td>
                                    <?php endif; ?>
                                    <td class="text-center id"><?php echo e($item->getPackageDealsType->package_deals_type_desc??''); ?></td>
                                    <td class="text-center name"><a href="<?php echo e(url('packagesdetail/'.$item->id.'/'.$item->package_deals_name)); ?>" target="_blank"><?php echo e($item->package_deals_name); ?></a></td>
                                    <td class="text-center">$<?php echo number_format($item->price, 2); ?></td>
                                    <?php if(Auth::user()->hasRole('SuperAdmin')): ?>
                                        <td class="text-center">
                                            <input class="form-check-input package_id" type="checkbox" value="<?php echo e($item->id); ?>" <?php if($item->display_on_home_page=='1'): ?> checked <?php endif; ?>>
                                        </td>
                                    <?php endif; ?>
                                    <?php if(auth()->user()->hasrole('PackagesAdmin') || auth()->user()->hasrole('SuperAdmin') || auth()->user()->hasrole('admin')): ?>
                                        <td class="text-center"><a href="<?php echo e(route('update_package_status',['PackageDealsID'=>$item->id,'status'=>$item->package_deals_status])); ?>" onclick="return confirm('Are you sure?')"><?php echo $item->status_detail??"Not Available"; ?></a></td>
                                    <?php else: ?>
                                        <td class="text-center"><?php echo $item->status_detail??"Not Available"; ?></td>
                                    <?php endif; ?>
                                    <td class="text-center">
                                        <?php if($item->status_from_admin == 1): ?>
                                            <span class='badge badge-success badge-sm' style='cursor:pointer'>Active</span>
                                        <?php else: ?>
                                            <span class='badge badge-danger badge-sm' style='cursor:pointer'>Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if(!Auth::user()->hasRole('SuperAdmin') && !Auth::user()->hasRole('admin')): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view-'.str_slug('ManageSetting'))): ?>
                                            <a href="<?php echo e(url('/manageSetting/manage-setting/' . $item->id)); ?>"
                                               title="View ManageSetting">
                                                
                                            </a>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit-'.str_slug('ManageSetting'))): ?>
                                            <a href="<?php echo e(url('/manageSetting/manage-setting/' . $item->id . '/edit')); ?>"
                                               title="Edit ManageSetting">
                                                <button class="btn btn-primary btn-sm">
                                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
                                                </button>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-'.str_slug('ManageSetting'))): ?>
                                            <form method="POST"
                                                  action="<?php echo e(url('/manageSetting/manage-setting' . '/' . $item->id)); ?>"
                                                  accept-charset="UTF-8" style="display:inline">
                                                <?php echo e(method_field('DELETE')); ?>

                                                <?php echo e(csrf_field()); ?>

                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        title="Delete ManageSetting"
                                                        onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="pagination-wrapper"> <?php echo $managesetting->appends(['search' => Request::get('search')])->render(); ?> </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        $('.package_id').change(function() {
//            alert($(this).closest("tr").attr('package_id'));
            if(this.checked) {
                $.get('<?php echo e(URL::to("add-package-on-homepage")); ?>/'+$(this).closest("tr").attr('package_id'),function(data){
                    console.log(data);
                    Swal.fire({
                        icon: 'success',
                        title: 'Show On Home Page',
                        text: 'Package added on home page...',
                    })
                });
            }
            else {
                $.get('<?php echo e(URL::to("remove-package-from-homepage")); ?>/'+$(this).closest("tr").attr('package_id'),function(data){
                    console.log(data);
                    Swal.fire({
                        icon: 'success',
                        title: 'Remove From Home Page',
                        text: 'Package remove from home page...',
                    })
                });
            }
            $('.package_id').val(this.checked);
        });


        $('#myTable_length').css("display","none");
    </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home2/democustompro/public_html/laravel/alzuwar/alziyara_main_files/resources/views/manageSetting/manage-setting/index.blade.php ENDPATH**/ ?>