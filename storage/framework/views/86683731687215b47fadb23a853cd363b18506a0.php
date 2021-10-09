

<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.update'); ?>  <?php echo app('translator')->get('lang.system'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>


    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.update'); ?>  <?php echo app('translator')->get('lang.system'); ?> </h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.system_settings'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.update'); ?>  <?php echo app('translator')->get('lang.system'); ?> </a>
                </div>
            </div>
        </div>
    </section>   

    <section class="admin-visitor-area up_admin_visitor empty_table_tab">
        <div class="container-fluid p-0">

        

            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-40 cust-lawngreen"><?php echo app('translator')->get('lang.upload_from_local_directory'); ?></h3>
                            </div>
                            <?php if(userPermission(479)): ?>
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'url' => 'versionUpdateInstall', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <?php endif; ?>   
                            <div class="white-box sm_mb_20 sm2_mb_20 md_mb_20 ">
                                    <div class="add-visitor">

                                        <div class="row no-gutters input-right-icon mb-20">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input form-control <?php echo e($errors->has('updateFile') ? ' is-invalid' : ''); ?>" readonly="true" type="text"
                                                    placeholder="<?php echo e(isset($editData->file) && @$editData->file != ""? getFilePath3(@$editData->file):'Upload File'); ?> "  id="placeholderUploadContent" name="updateFile">
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('updateFile')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('updateFile')); ?></strong>
                                                </span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg" for="upload_content_file"><?php echo app('translator')->get('lang.browse'); ?></label>
                                                    <input type="file" class="d-none form-control" name="updateFile" id="upload_content_file">
                                                </button>

                                            </div>
                                        </div>
                                        <?php 
                                            $tooltip = "";
                                            if(userPermission(479)){
                                                    $tooltip = "";
                                                }else{
                                                    $tooltip = "You have no permission to add";
                                                }
                                        ?>
                                        <div class="row mt-40">
                                            <div class="col-lg-12 text-center"> 
                                                <button class="primary-btn fix-gr-bg submit"  data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                                    <span class="ti-check"></span>
                                                    <?php if(isset($session)): ?>
                                                        <?php echo app('translator')->get('lang.update'); ?>
                                                    <?php else: ?>
                                                        <?php echo app('translator')->get('lang.save'); ?>
                                                    <?php endif; ?>
                                                    <?php echo app('translator')->get('lang.file'); ?>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="main-title mb-20" >
                                <h3 ><?php echo app('translator')->get('lang.update'); ?> <?php echo app('translator')->get('lang.details'); ?></h3>
                            </div>
                        </div>

                        <div class="col-lg-9 text-right mb-20 title_custom_margin">
                            <div class="main-title">
                                <h3>
                                    <a href="<?php echo e(route('database-upgrade')); ?>" class="primary-btn small fix-gr-bg  demo_view">
                                        <span class="ti-support"></span>
                                        <?php echo app('translator')->get('lang.database'); ?>   <?php echo e(__('sync')); ?>

                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="white-box">
                                <h1> <?php echo app('translator')->get('lang.system'); ?> <?php echo app('translator')->get('lang.info'); ?> </h1>
                                <div class="add-visitor">
                                    <table style="width:100%; box-shadow: none;" class="display school-table school-table-style">
                                      
                                        <tr>
                                            <td><?php echo app('translator')->get('lang.software_version'); ?></td>
                                            <td><?php echo e(@file_get_contents('storage/app/.version')); ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo app('translator')->get('lang.check_update'); ?></td>
                                            <td><a href="#" target="_blank"> <i class="ti-new-window"> </i> Update </a> </td>
                                        </tr> 
                                        <tr>
                                            <td> <?php echo app('translator')->get('lang.PHP_version'); ?></td>
                                            <td><?php echo e(phpversion()); ?></td>
                                        </tr>
                                        <tr>
                                            <td> <?php echo app('translator')->get('lang.curl_enable'); ?></td>
                                            <td><?php
                                            if  (in_array  ('curl', get_loaded_extensions())) {
                                                echo 'enable';
                                            }
                                            else {
                                                echo 'disable';
                                            }
                                            ?></td>
                                        </tr>
                            
                                        
                                        <tr>
                                            <td> <?php echo app('translator')->get('lang.purchase_code'); ?></td>

                                            <td><?php echo e(__('Verified')); ?>

                                            <!--<?php if(! Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                                 <?php if ($__env->exists('service::license.revoke')) echo $__env->make('service::license.revoke', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                             <?php endif; ?> -->
                                             </td>
                                        </tr>
                            

                                        <tr>
                                            <td> <?php echo app('translator')->get('lang.install_domain'); ?></td>
                                            <td><?php echo e(@$data->system_domain); ?></td>
                                        </tr>

                                        <tr>
                                            <td> <?php echo app('translator')->get('lang.system_activation_date'); ?></td>
                                            <td><?php echo e(@dateConvert($data->system_activated_date)); ?></td>
                                        </tr>
                                        <tr>
                                            <td> <?php echo app('translator')->get('lang.last'); ?> <?php echo app('translator')->get('lang.update'); ?></td>
                                            <td>
                                            <?php if(is_null($data->last_update)): ?>
                                                 <?php echo e(@dateConvert($data->system_activated_date)); ?>

                                            <?php else: ?>
                                                    <?php echo e(@dateConvert($data->last_update)); ?>

                                            <?php endif; ?>
                                            </td>
                                        </tr>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script language="JavaScript">

        $('#selectAll').click(function () {
            $('input:checkbox').prop('checked', this.checked);

        });


    </script>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/systemSettings/updateSettings.blade.php ENDPATH**/ ?>