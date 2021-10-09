
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.admin_setup'); ?>
<?php $__env->stopSection(); ?>


<link rel="stylesheet" href="<?php echo e(asset('/Modules/RolePermission/public/css/style.css')); ?>">
<style type="text/css">
    .erp_role_permission_area {
    display: block !important;
    width: 100%;
    background: #ffffff;
    padding: 40px 30px;
    border-radius: 5px;
    box-shadow: 0px 10px 15px rgba(236, 208, 244, 0.3);
    margin: 0 auto;
    clear: both;
    border-collapse: separate;
    border-spacing: 0;
}


.single_permission {
    margin-bottom: 0px;
}
.erp_role_permission_area .single_permission .permission_body > ul > li ul {
    display: grid;
    margin-left: 25px;
    grid-template-columns: repeat(3, 1fr);
    /* grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); */
}
.erp_role_permission_area .single_permission .permission_body > ul > li ul li {
    margin-right: 20px;

}
.mesonary_role_header{
    column-count: 2;
    column-gap: 30px;
}
.single_role_blocks {
    display: inline-block;
    background: #fff;
    box-sizing: border-box;
    width: 100%;
    margin: 0 0 5px;
}
.erp_role_permission_area .single_permission .permission_body > ul > li {
  padding: 15px 25px 12px 25px;
}
.erp_role_permission_area .single_permission .permission_header {
  padding: 20px 25px 11px 25px;
  position: relative;
}
@media (min-width: 320px) and (max-width: 1199.98px) {
    .mesonary_role_header{
    column-count: 1;
    column-gap: 30px;
}
 }
@media (min-width: 320px) and (max-width: 767.98px) {
    .erp_role_permission_area .single_permission .permission_body > ul > li ul {
    grid-template-columns: repeat(2, 1fr);
    grid-gap:10px
    /* grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); */
}
 }




.permission_header{
    position: relative;
}

.arrow::after {
    position: absolute;
    content: "\e622";
    top: 50%;
    right: 12px;
    height: auto;
    font-family: 'themify';
    color: #fff;
    font-size: 18px;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
        transform: translateY(-50%);
    right: 22px;
}
.arrow.collapsed::after {
    content: "\e61a";
    color: #fff;
    font-size: 18px;
}
.erp_role_permission_area .single_permission .permission_header div {
    position: relative;
    top: -5px;
    position: relative;
    z-index: 999;
}
.erp_role_permission_area .single_permission .permission_header div.arrow {
    position: absolute;
    width: 100%;
    z-index: 0;
    left: 0;
    bottom: 0;
    top: 0;
    right: 0;
}
.erp_role_permission_area .single_permission .permission_header div.arrow i{
    color:#FFF;
    font-size: 20px;
}

.mesonary_role_header {
    column-count: 1 !important; 
    column-gap: 30px;
}

.dropdown .dropdown-toggle {
    background: transparent;
    color: #415094;
    font-size: 13px;
    font-weight: 500;
    border: 1px solid #7c32ff;
    border-radius: 32px;
    padding: 5px 20px;
    text-transform: uppercase;
    overflow: hidden;
    -webkit-transition: all 0.15s ease-in-out;
    -moz-transition: all 0.15s ease-in-out;
    -o-transition: all 0.15s ease-in-out;
    transition: all 0.15s ease-in-out;
}
.dropdown .dropdown-toggle:after {
    content: "\e62a";
    font-family: "themify";
    border: none;
    border-top: 0px;
    font-size: 10px;
    position: relative;
    top: 3px;
    left: 0;
    font-weight: 600;
    -webkit-transition: all 0.15s ease-in-out;
    -moz-transition: all 0.15s ease-in-out;
    -o-transition: all 0.15s ease-in-out;
    transition: all 0.15s ease-in-out;
}
.dropdown .dropdown-menu .dropdown-item {
    color: #828bb2;
    text-align: right;
    font-size: 12px;
    padding: 4px 1.5rem;
    text-transform: uppercase;
    cursor: pointer;
    -webkit-transition: all 0.15s ease-in-out;
    -moz-transition: all 0.15s ease-in-out;
    -o-transition: all 0.15s ease-in-out;
    transition: all 0.15s ease-in-out;
}
</style>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
        <h1><?php echo app('translator')->get('lang.admin_setup'); ?></h1>
        <div class="bc-pages">
            <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
            <a href="#"><?php echo app('translator')->get('lang.admin_section'); ?></a>
            <a href="#"><?php echo app('translator')->get('lang.admin_setup'); ?></a>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($admin_setup)): ?>
        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('setup-admin')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <div class="row">
           
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($admin_setup)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>

                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>

                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.admin_setup'); ?>
                            </h3>
                        </div>
                        <?php if(isset($admin_setup)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('setup-admin-update',@$admin_setup->id),
                        'method' => 'PUT'])); ?>

                        <?php else: ?>
                          <?php if(userPermission(42)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'setup-admin',
                        'method' => 'POST'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <?php if(session()->has('message-success')): ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <?php echo e(session()->get('message-success')); ?>

                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?php elseif(session()->has('message-danger')): ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?php echo e(session()->get('message-danger')); ?>

                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <?php endif; ?>
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('type') ? ' is-invalid' : ''); ?>"
                                            name="type">
                                            <option data-display="<?php echo app('translator')->get('lang.type'); ?> *" value=""><?php echo app('translator')->get('lang.type'); ?> *</option>
                                           
                                            <option value="1" <?php echo e(isset($admin_setup)? ($admin_setup->type == '1'? 'selected':''):''); ?>><?php echo app('translator')->get('lang.purpose'); ?></option>
                                            <option value="2" <?php echo e(isset($admin_setup)? ($admin_setup->type == '2'? 'selected':''):''); ?>><?php echo app('translator')->get('lang.complaint'); ?> <?php echo app('translator')->get('lang.type'); ?></option>
                                            <option value="3" <?php echo e(isset($admin_setup)? ($admin_setup->type == '3'? 'selected':''):''); ?>><?php echo app('translator')->get('lang.source'); ?></option>
                                            <option value="4" <?php echo e(isset($admin_setup)? ($admin_setup->type == '4'? 'selected':''):''); ?>><?php echo app('translator')->get('lang.reference'); ?></option>
                                           
                                        </select>
                                        <?php if($errors->has('type')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('type')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                                type="text" name="name" maxlength="50" value="<?php echo e(isset($admin_setup)? $admin_setup->name: ''); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($admin_setup)? $admin_setup->id: ''); ?>">
                                            <label><?php echo app('translator')->get('lang.name'); ?> <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('name')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('name')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4" name="description"><?php echo e(isset($admin_setup)? $admin_setup->description: ''); ?></textarea>
                                            <label><?php echo app('translator')->get('lang.description'); ?> <span></span></label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                    </div>
                                </div>
                                    <?php 
                                  $tooltip = "";
                                  if(userPermission(42) ){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($admin_setup)): ?>
                                                <?php echo app('translator')->get('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.save'); ?>
                                            <?php endif; ?>
                                           <?php echo app('translator')->get('lang.setup'); ?>
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
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.admin_setup'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="row base-setup mt-30">
                    <div class="col-lg-12">
                    <div class="erp_role_permission_area ">
                    <!-- single_permission  -->
                        <div  class="mesonary_role_header">
                            <?php $i = 0; ?>
                            <?php $__currentLoopData = $admin_setups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <!-- single_role_blocks  -->
                            <div class="single_role_blocks">
                                <div class="single_permission" id="">
                                    <div class="permission_header d-flex align-items-center justify-content-between">
                                        <div>
                                            <input  name="module_id[]" value="" id="Main_Module" class="common-radio permission-checkAll main_module_id_" >
                                        <label for="Main_Module">
                                        <?php
                                            if($key == 1){
                                                echo trans('lang.purpose');
                                            }elseif($key == 2){
                                                echo trans('lang.complaint') .' ' .trans('lang.type');
                                            }elseif($key == 3){
                                                echo trans('lang.source');
                                            }elseif($key == 4){
                                                echo trans('lang.reference');
                                            }
                                        ?>
                                        </label>
                                        </div>
                                        
                                    <div class="arrow collapsed" data-toggle="collapse" data-target="#Role<?php echo e($key); ?>">
                                       

            
                                        </div>
            
                                    </div>
            
                                    <div id="Role<?php echo e($key); ?>" class="collapse">
                                        <div  class="permission_body school-table">
                                            <ul>
                                                <li>
                                                    <ul class="option">
                                                    <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index=> $admin_setup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <li>
                                                        <div class="module_link_option_div" id="">
                                                            
                                                            <div class="dropdown p-2">
                                                                <button type="button" class="btn dropdown-toggle infix_csk module_id_ module_option_ module_link_option"
                                                                    data-toggle="dropdown"><?php echo e(@$admin_setup->name); ?> </button>
                                                                
                                                                <div class="dropdown-menu dropdown-menu-right">
                                                                    <?php if(userPermission(43)): ?>
                                                                   <a class="dropdown-item" href="<?php echo e(route('setup-admin-edit',@$admin_setup->id)); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                                    <?php endif; ?>
                                                                     <?php if(userPermission(44)): ?>
                                                                    <a class="dropdown-item deleteSetupAdminModal" href="#" data-toggle="modal" data-target="#deleteSetupAdminModal" data-id="<?php echo e(@$admin_setup->id); ?>"><?php echo app('translator')->get('lang.delete'); ?></a>
                                                                <?php endif; ?>
                                                                </div>
                                                            </div>
                    
                                                
                                                        </div>
                                                    </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                   
                                                
                                                    </ul>
                                                </li>
                                            
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<div class="modal fade admin-query" id="deleteSetupAdminModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.admin_setup'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                </div>


                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                    <a href="" class="primary-btn fix-gr-bg"><?php echo app('translator')->get('lang.delete'); ?></a>
                     
                </div>
            </div>

        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/admin/setup_admin.blade.php ENDPATH**/ ?>