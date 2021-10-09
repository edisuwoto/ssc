

<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.module'); ?> <?php echo app('translator')->get('lang.manage'); ?>
<?php $__env->stopSection(); ?> 

<?php $__env->startSection('mainContent'); ?>
   <link rel="stylesheet" href="<?php echo e(asset('public/vendor/spondonit/css/parsley.css')); ?>">
    <style type="text/css">
        #selectStaffsDiv, .forStudentWrapper {
            display: none;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        #waiting_loader{
            display: none;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background: linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
        }

        input:focus + .slider {
            box-shadow: 0 0 1px linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.module'); ?> <?php echo app('translator')->get('lang.manage'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.system_settings'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.module'); ?> <?php echo app('translator')->get('lang.manage'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-10 col-xs-6 col-md-6 col-6 no-gutters ">
                            <div class="main-title sm_mb_20 sm2_mb_20 md_mb_20 mb-30 ">
                                <h3 class="mb-0"> <?php echo app('translator')->get('lang.module'); ?> <?php echo app('translator')->get('lang.manage'); ?></h3>
                            </div>
                        </div>
                        <div class="col-lg-2 col-xs-6 col-md-6 col-6 no-gutters mb-30 breadcumb-lawngreen">
                            <div class="row">
                                    <div class="col-lg-12">
                                    <a href="#" data-toggle="modal" class="primary-btn small fix-gr-bg" data-target="#add_to_do" title="Add To Do" data-modal-size="modal-md">
                                        <span class="ti-plus pr-2"></span>
                                        <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.module'); ?>
                                        </a>
                                   </div>
                             </div>
                        </div>   
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <!--<table id="default_table" class="display school-table school-table-style" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang.sl'); ?></th>
                                        <th><?php echo app('translator')->get('lang.name'); ?></th>
                                        <th><?php echo app('translator')->get('lang.status'); ?></th>
                                        <th><?php echo app('translator')->get('lang.action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                    <?php
                                        $modules= App\InfixModuleManager::get();
                                        $count=1;
                                        $module_array=[];
                                    ?>
                                    <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $is_module_available = 'Modules/' . $module->name. '/Providers/' .$module->name. 'ServiceProvider.php';
                                            $configName = $module->name;
                                            $module_array[]=$module->name;
                                        ?>
                                        <tr>
                                            <?php if($module->is_default==0): ?>
                                                <td><?php echo e($count++); ?></td>
                                                <td>
                                                    <?php if($module->name == "Saas"): ?>
                                                    <strong><?php echo app('translator')->get('lang.saas'); ?></strong>
                                                    <?php else: ?>
                                                    <strong><?php echo e($module->name); ?></strong>
                                                    <?php endif; ?>
                                                    <small class="text-success text-bold"> ( Version: <?php echo e(@moduleVersion($module->name)); ?></small> )
                                                    <p><?php echo e($module->notes); ?></p>

                                                    <?php if(!empty($module->purchase_code)): ?> 
                                                        <p class="text-success">
                                                            Verified | Published on 
                                                        <?php echo e(date("F jS, Y", strtotime($module->activated_date))); ?></p> 
                                                    <?php elseif(file_exists($is_module_available)): ?>
                                                        <p class="text-success"> Purchased </p> 
                                                    <?php else: ?>
                                                        <p class="text-danger"> Not Purchase </p>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if( moduleStatusCheck($module->name) == False): ?> 
                                                        <a class="primary-btn small <?php echo e($module->name); ?> bg-warning text-white border-0"href="#"><?php echo app('translator')->get('lang.disable'); ?></a>
                                                    <?php elseif(moduleStatusCheck($module->name) == True): ?>
                                                        <a class="primary-btn small <?php echo e($module->name); ?> bg-success text-white border-0" href="#"><?php echo app('translator')->get('lang.active'); ?> </a>
                                                    <?php else: ?>
                                                        <a class="primary-btn small <?php echo e($module->name); ?> bg-success text-white border-0" href="#">Purchased</a>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if(is_null($module->purchase_code) && (!file_exists($is_module_available))): ?>
                                                        <a class="primary-btn fix-gr-bg" href="<?php echo e($module->addon_url); ?>" target="_blank">Buy Now</a>
                                                    <?php elseif(is_null($module->purchase_code) && (moduleStatusCheck($module->name) == False) && (file_exists($is_module_available) )): ?>
                                                        <input type="hidden" name="name" value="<?php echo e($configName); ?>">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="col-lg-12 text-center">
                                                                    <?php if(userPermission(400)): ?>
                                                                        <?php if(Illuminate\Support\Facades\Config::get('app.app_pro')): ?>
                                                                            <a class="primary-btn fix-gr-bg" data-toggle="modal" data-target="#proVerify<?php echo e($configName); ?>" href="#"><?php echo app('translator')->get('lang.verify'); ?></a>
                                                                        <?php else: ?>
                                                                            <a class="primary-btn fix-gr-bg" data-toggle="modal" data-target="#Verify<?php echo e($configName); ?>" href="#"><?php echo app('translator')->get('lang.verify'); ?></a>
                                                                        <?php endif; ?>
                                                                    <?php endif; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php else: ?>
                                                        <div id="waiting_loader" class="waiting_loader<?php echo e($module->name); ?>"><img src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" width="44" height="44" /><br>Installing..</div>
                                                        <?php if(! Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                                            <label class="switch module_switch_label<?php echo e($module->name); ?>">
                                                                <input type="checkbox" data-id="<?php echo e($module->name); ?>" id="ch<?php echo e($module->name); ?>" class="switch-input1 module_switch" <?php echo e(moduleStatusCheck($module->name) == false? '':'checked'); ?>>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        <?php endif; ?> 
                                                        <?php if( Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                                            <label class="switch module_switch_demo">
                                                                <input  type="checkbox" onClick="module_switch_demo()"  class="switch-input1 module_switch_demo" <?php echo e(moduleStatusCheck($module->name) == false? '':'checked'); ?>>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        <?php endif; ?> 
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                        <div class="modal fade admin-query" id="proVerify<?php echo e($configName); ?>">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Module Verification</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'ManageAddOnsValidation', 'method' => 'POST'])); ?>

                                                            <input type="hidden" name="name" value="<?php echo e($configName); ?>">
                                                            <?php echo e(csrf_field()); ?>

                                                            <div class="form-group">
                                                                <label for="user">Email :</label>
                                                                <input type="text" class="form-control " name="email" required="required" placeholder="Enter Your Email" value="<?php echo e(old('email')); ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="purchasecode">Purchase Code:</label>
                                                                <input type="text" class="form-control" name="purchase_code" required="required" placeholder="Enter Your Purchase Code" value="<?php echo e(old('purchasecode')); ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="domain">Installation Path:</label>
                                                                <input type="text" class="form-control" name="domain" required="required" value="<?php echo e(url('/')); ?>" readonly>
                                                            </div>
                                                            <div class="row mt-40">
                                                                <div class="col-lg-12 text-center">
                                                                    <button class="primary-btn fix-gr-bg"><span class="ti-check"></span><?php echo app('translator')->get('lang.verify'); ?> </button>
                                                                </div>
                                                            </div>
                                                        <?php echo e(Form::close()); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade admin-query" id="Verify<?php echo e($configName); ?>">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Module Verification</h4>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php echo e(Form::open(['class' => 'form-horizontal', 'id' => 'content_form_'.$count , 'files' => true, 'route' => 'ManageAddOnsValidation', 'method' => 'POST'])); ?>

                                                            <input type="hidden" name="name" value="<?php echo e($configName); ?>">
                                                            <?php echo e(csrf_field()); ?>

                                                            <div class="form-group">
                                                                <label for="user">Envato Email :</label>
                                                                <input type="email" class="form-control" name="envatouser" required="required" placeholder="Enter Your Envato Email" value="<?php echo e(old('envatouser')); ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="purchasecode">Purchase Code:</label>
                                                                <input type="text" class="form-control" name="purchase_code" required id="purchase_code" placeholder="Enter Your Purchase Code" value="<?php echo e(old('purchase_code')); ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="domain">Installation Domain:</label>
                                                                <input type="text" class="form-control" name="installationdomain" required="required" placeholder="Enter Your Installation Domain" value="<?php echo e(url('/')); ?>" readonly>
                                                            </div>
                                                            <div class="row mt-40">
                                                                <div class="col-lg-12 text-center">
                                                                    <button class="primary-btn fix-gr-bg"><span class="ti-check"></span><?php echo app('translator')->get('lang.verify'); ?></button>
                                                                </div>
                                                            </div>
                                                        <?php echo e(Form::close()); ?>


                                                        <?php $__env->startPush('script'); ?>
                                                        <?php if($count == 2): ?>
                                                            <script type="text/javascript" src="<?php echo e(asset('public/vendor/spondonit/js/parsley.min.js')); ?>"></script>
                                                            <script type="text/javascript" src="<?php echo e(asset('public/vendor/spondonit/js/function.js')); ?>"></script>
                                                            <script type="text/javascript" src="<?php echo e(asset('public/vendor/spondonit/js/common.js')); ?>"></script>
                                                        <?php endif; ?>
                                                            <script type="text/javascript">
                                                                _formValidation('content_form_<?php echo e($count); ?>');
                                                            </script>
                                                        <?php $__env->stopPush(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        
                                                    
                                                    
                                                    
                                                    
                                                                
                                                                    

                                                                    
                                </tbody>
                            </table>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <!-- Module Add Modal Start Here -->
         <div class="modal fade admin-query" id="add_to_do">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.new'); ?> <?php echo app('translator')->get('lang.module'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid"> 
                            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'moduleFileUpload', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'onsubmit' => 'return validateToDoForm()'])); ?>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row no-gutters input-right-icon mb-20">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input form-control <?php echo e($errors->has('module_file') ? ' is-invalid' : ''); ?>" readonly="true" type="text"
                                                    placeholder="<?php echo e(isset($editData->upload_file) && @$editData->upload_file != ""? getFilePath3(@$editData->upload_file):trans('lang.file').' *'); ?>"
                                                    id="placeholderUploadContent">
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('module_file')): ?>
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong><?php echo e($errors->first('module_file')); ?></strong>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button class="primary-btn-small-input" type="button">
                                                <label class="primary-btn small fix-gr-bg"
                                                        for="upload_content_file"><?php echo app('translator')->get('lang.browse'); ?></label>
                                                    
                                                <input type="file" class="d-none form-control" name="module_file"
                                                        id="upload_content_file">
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 text-center">
                                        <div class="mt-40 d-flex justify-content-between">
                                            <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                            <input class="primary-btn fix-gr-bg submit" type="submit" value="<?php echo app('translator')->get('lang.submit'); ?>">
                                        </div>
                                    </div>
                                </div>
                            <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      <!-- Module Add Modal End Here -->
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
    function module_switch_demo(){
        toastr.warning("This function disabled for demo mode");
    }

        $(document).on('click','.module_switch',function (){
            var url = $("#url").val();
            var module = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                beforeSend: function(){
                    $(".module_switch_label"+module).hide();
                    $(".waiting_loader"+module).show();
                },
                url: url + "/" + "manage-adons-enable/" + module,
                success: function(data) {
                    $(".waiting_loader"+module).hide();
                    $(".module_switch_label"+module).show();
                    if (data["success"]) {
                        if (data["data"] == "enable") {
                            $(`.${module}`).removeClass("bg-warning");
                            $(`.${module}`).addClass("bg-success");
                            $(`.${module}`).text("Enable");
                        } else {
                            $(`.${module}`).removeClass("bg-success");
                            $(`.${module}`).addClass("bg-warning");
                            $(`.${module}`).text("Disable");
                        }
                        toastr.success(data["success"], "Success Alert");
                        location.reload();
                    } else {
                        toastr.error(data["error"], "Faild Alert");
                    }
                },
                error: function(data) {
                    console.log("Error:", data["error"]);
                },
            })
        })

    </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/ssc/resources/views/backEnd/systemSettings/ManageAddOns.blade.php ENDPATH**/ ?>