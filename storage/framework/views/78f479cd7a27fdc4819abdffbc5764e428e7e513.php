
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.search_fees_payment'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php  $setting = App\SmGeneralSettings::find(1); if(!empty($setting->currency_symbol)){ $currency = $setting->currency_symbol; }else{ $currency = '$'; } ?>

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.search_fees_payment'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.fees_collection'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.search_fees_payment'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-12">
                <?php if(session()->has('message-success') != ""): ?>
                    <?php if(session()->has('message-success')): ?>
                    <div class="alert alert-success">
                        <?php echo e(session()->get('message-success')); ?>

                    </div>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="white-box">
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'fees_payment_search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                        <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            <div class="col-lg-3 mt-30-md">
                                <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                    <option data-display="<?php echo app('translator')->get('lang.select_class'); ?> *" value=""><?php echo app('translator')->get('lang.select_class'); ?> *</option>
                                    <?php $__currentLoopData = @$classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($class->id); ?>"  <?php echo e(( old("class") == $class->id ? "selected":"")); ?>><?php echo e($class->class_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('class')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('class')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-3 mt-30-md" id="select_section_div">
                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('current_section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                    <option data-display="<?php echo app('translator')->get('lang.select_section'); ?> *" value=""><?php echo app('translator')->get('lang.select_section'); ?></option>
                                </select>
                                <div class="pull-right loader loader_style" id="select_section_loader">
                                    <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                </div>
                                <?php if($errors->has('section')): ?>
                                <span class="invalid-feedback invalid-select d-block" role="alert">
                                    <strong><?php echo e($errors->first('section')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>

                            <div class="col-lg-6 mt-30-md">
                                <div class="input-effect">
                                    <input class="primary-input form-control" type="text" name="keyword">
                                    <label><?php echo app('translator')->get('lang.search_by_name'); ?>, <?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.no'); ?>, <?php echo app('translator')->get('lang.roll'); ?> <?php echo app('translator')->get('lang.no'); ?></label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                                                            

                            <div class="col-lg-12 mt-20 text-right">
                                <button type="submit" class="primary-btn small fix-gr-bg">
                                    <span class="ti-search pr-2"></span>
                                    <?php echo app('translator')->get('lang.search'); ?>
                                </button>
                            </div>
                        </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
        <?php if(@$fees_payments): ?>            
        <div class="row mt-40">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"> <?php echo app('translator')->get('lang.payment_ID_Details'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">

                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.payment'); ?> <?php echo app('translator')->get('lang.id'); ?></th>
                                    <th><?php echo app('translator')->get('lang.date'); ?></th>
                                    <th><?php echo app('translator')->get('lang.name'); ?></th>
                                    <th><?php echo app('translator')->get('lang.class'); ?></th>
                                    <th><?php echo app('translator')->get('lang.fees_group'); ?></th>
                                    <th><?php echo app('translator')->get('lang.fees_type'); ?></th>
                                    <th><?php echo app('translator')->get('lang.mode'); ?></th>
                                    <th><?php echo app('translator')->get('lang.amount'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>) </th>
                                    
                                    <th><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $fees_payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fees_payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($fees_payment->id.'/'.$fees_payment->fees_type_id); ?></td>
                                    <td>
                                        <?php echo e(dateConvert($fees_payment->payment_date)); ?>

                                      
                                    <!-- <?php echo e($fees_payment->payment_date != ""? dateConvert($fees_payment->payment_date):''); ?> -->

                                    </td>
                                    <td>
                                        <?php echo e($fees_payment->studentInfo->full_name!=""?$fees_payment->studentInfo->full_name:""); ?>

                                    </td>
                                    <td>
                                        <?php echo e($fees_payment->studentInfo->className->class_name); ?>

                                    </td>
                                    <td>
                                        <?php echo e($fees_payment->name !=""?$fees_payment->name: ""); ?>

                                    </td>
                                    <td>
                                        <?php echo e($fees_payment->feesType->name!=""?$fees_payment->feesType->name:""); ?>

                                    </td>
                                    <td>
                                        <?php echo e($fees_payment->payment_mode); ?>

                                    </td>
                                    <td><?php echo e($fees_payment->amount); ?></td>
                                    
                                    <td><div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                           

                                        
                                            <?php if(userPermission(115)): ?> 
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <?php if($fees_payment->assign_id !=null): ?>
                                                    <a class="dropdown-item modalLink" data-modal-size="modal-lg" title="<?php echo app('translator')->get('lang.edit'); ?> <?php echo app('translator')->get('lang.fees'); ?> <?php echo app('translator')->get('lang.payment'); ?>"  href="<?php echo e(route('edit-fees-payment', [$fees_payment->id])); ?>" ><?php echo app('translator')->get('lang.edit'); ?> <?php echo app('translator')->get('lang.fees'); ?> </a>
                                                    <?php endif; ?>
                                                    <a class="dropdown-item" href="<?php echo e(route('fees_collect_student_wise', [$fees_payment->student_id])); ?>"><?php echo app('translator')->get('lang.view'); ?></a>

                                                    <a class="dropdown-item" data-toggle="modal" data-target="#deleteFeesPayment_<?php echo e($fees_payment->id); ?>" ><?php echo app('translator')->get('lang.delete'); ?></a>
                                                </div>

                                                
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>


                                <div class="modal fade admin-query" id="deleteFeesPayment_<?php echo e($fees_payment->id); ?>" >
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.collect_fees'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>
                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                     <?php echo e(Form::open(['route' => 'fees-payment-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                                     <input type="hidden" name="id" id="feep_payment_id" value="<?php echo e($fees_payment->id); ?>">
                                                     <input type="hidden" name="assign_id" id="assign_id" value="<?php echo e($fees_payment->assign_id); ?>">
                                                     <input type="hidden" name="amount" id="feep_payment_amount" value="<?php echo e($fees_payment->amount); ?>">
                                                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                                                     <?php echo e(Form::close()); ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/feesCollection/search_fees_payment.blade.php ENDPATH**/ ?>