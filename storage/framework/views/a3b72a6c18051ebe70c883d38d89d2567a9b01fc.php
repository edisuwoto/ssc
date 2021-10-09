
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.payment_method_settings'); ?>
<?php $__env->stopSection(); ?> 
<?php $__env->startSection('mainContent'); ?>
<?php $__env->startPush('css'); ?>
<style>
    table.dataTable thead th {
        padding: 10px 30px !important;
    }

    table.dataTable tbody th, table.dataTable tbody td {
        padding: 20px 30px 20px 30px !important;
    }

    table.dataTable tfoot th, table.dataTable tfoot td {
        padding: 10px 30px 6px 30px;
    }
    a.disabled {
    pointer-events: none;
    cursor: default;
    }
</style>

<style>
    .CustomPaymentMethod{
        padding: 5px 0px 0px 0px !important;
        border-top: 0px !important;
    }
</style>
<?php $__env->stopPush(); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.payment_method_settings'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.system_settings'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.payment_method_settings'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="mb-40 student-details">
    <div class="container-fluid p-0">
        <div class="row pt-20">
            <div class="col-lg-3">
                <div class="main-title pt-30">
                    <h3 class="mb-30"><?php echo app('translator')->get('lang.select_a_payment_gateway'); ?>   </h3>  
                </div>
                <?php if(userPermission(413)): ?>
                    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'is-active-payment'])); ?>

                <?php endif; ?>
                <div class="white-box">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table">
                                <?php $__currentLoopData = $paymeny_gateway; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(moduleStatusCheck('RazorPay') == FALSE && $value->method =="RazorPay" ): ?> 
                                <?php else: ?>
                                    <tr>
                                        <td class="CustomPaymentMethod">                                              
                                            <div class="input-effect">
                                                <input type="checkbox" id="gateway_<?php echo e(@$value->method); ?>" class="common-checkbox class-checkbox" name="gateways[<?php echo e(@$value->id); ?>]" 
                                                value="<?php echo e(@$value->id); ?>" <?php echo e(@$value->active_status == 1? 'checked':''); ?>>
                                                <label for="gateway_<?php echo e(@$value->method); ?>"><?php echo e(@$value->method); ?>    
                                                </label>
                                            </div>
                                        </td> 
                                        <td class="CustomPaymentMethod"> 
                                            
                                        </td>
                                    </tr>                               
                                <?php endif; ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>

                            <?php if($errors->has('gateways')): ?>
                                <span class="text-danger validate-textarea-checkbox" role="alert">
                                    <strong><?php echo e($errors->first('gateways')); ?></strong>
                                </span>
                            <?php endif; ?>

                        </div>
                    </div>
                    <?php 
                        $tooltip = "";
                        if(userPermission(413)){ $tooltip = ""; }else{  $tooltip = "You have no permission to Update"; }
                    ?>
                    <div class="row mt-40">
                        <div class="col-lg-12 text-center">
                            <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> <button class="primary-btn fix-gr-bg  demo_view" style="pointer-events: none;" type="button" ><?php echo app('translator')->get('lang.update'); ?> </button></span>
                            <?php else: ?>
                                <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->get('lang.update'); ?>
                                </button>
                          <?php endif; ?>  

                        </div>
                    </div>
                </div>
            <?php echo e(Form::close()); ?>

            </div>

            <div class="col-lg-9"> 
                 <div class="row pt-20">
                    <div class="main-title pt-10">
                        <h3 class="mb-30"><?php echo app('translator')->get('lang.gateway_setting'); ?></h3>  
                    </div>
                    <ul class="nav nav-tabs justify-content-end mt-sm-md-20 mb-30" role="tablist">
                        <?php $__currentLoopData = $paymeny_gateway_settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <?php if(moduleStatusCheck('RazorPay') == FALSE && $row->gateway_name =="RazorPay"): ?>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link 
                                <?php if(!empty(Session::get('gateway_name')) && !empty(Session::get('active_status'))): ?>
                                    <?php if(Session::get('gateway_name') == @$row->gateway_name && Session::get('active_status') == "active"): ?> active show 
                                    <?php endif; ?>
                                 <?php else: ?>
                                    <?php if(@$row->gateway_name=='PayPal'): ?> active show <?php endif; ?>
                                  <?php endif; ?> "
                                 href="#<?php echo e(@$row->gateway_name); ?>" role="tab" data-toggle="tab"><?php echo e(@$row->gateway_name); ?></a> 
                            </li> 
                        <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    </ul>
                 </div>
                <!-- Tab panes -->
             
                <div class="tab-content">
                    <?php $__currentLoopData = $paymeny_gateway_settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                            <div role="tabpanel" class="tab-pane fade   <?php if(@$row->gateway_name=='PayPal'): ?> active show <?php endif; ?> " id="<?php echo e(@$row->gateway_name); ?>">
                                <?php if(userPermission(414)): ?>
                                    <form class="form-horizontal" action="<?php echo e(route('update-payment-gateway')); ?>" method="POST">
                                <?php endif; ?>   
                                    <?php echo csrf_field(); ?> 
                                    <div class="white-box">
                                        <div class="">
                                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>"> 
                                            <input type="hidden" name="gateway_name" id="gateway_<?php echo e(@$row->gateway_name); ?>" value="<?php echo e(@$row->gateway_name); ?>"> 
                                            <div class="row mb-30">
                                               <div class="col-md-12">
                                                <?php 
                                                if(@$row->gateway_name=="PayPal")
                                                {
                                                    @$paymeny_gateway = ['gateway_name','gateway_username','gateway_password','gateway_signature','gateway_client_id','gateway_mode','gateway_secret_key'];
                                                } 
                                                else if(@$row->gateway_name=="Stripe")
                                                { 
                                                    @$paymeny_gateway = ['gateway_name','gateway_username','gateway_secret_key','gateway_publisher_key']; 
                                                }
                                                else if(@$row->gateway_name=="Paystack")
                                                { 
                                                    @$paymeny_gateway = ['gateway_name','gateway_username','gateway_secret_key','gateway_publisher_key'];

                                                }
                                                else if(@$row->gateway_name=="RazorPay")
                                                { 
                                                    @$paymeny_gateway = ['gateway_name','gateway_secret_key','gateway_publisher_key'];

                                                }
                                                else if(@$row->gateway_name=="Xendit")
                                                { 
                                                    @$paymeny_gateway = ['gateway_name','gateway_secret_key','gateway_username'];

                                                }
                                                else if(@$row->gateway_name=="Bank"){
                                                    @$paymeny_gateway = ['gateway_name', 'bank_details'];

                                                }else if(@$row->gateway_name=="Cheque"){ 
                                                    @$paymeny_gateway = ['gateway_name','cheque_details'];

                                                }
                                                    if(@$row->gateway_name=="Stripe" || @$row->gateway_name=="Paystack" || @$row->gateway_name=="RazorPay" || @$row->gateway_name=="Xendit" || @$row->gateway_name=="PayPal"){
                                                    $count=0;
                                                    foreach ($paymeny_gateway as $input_field) {
                                                        @$newStr = @$input_field;
                                                        @$label_name = str_replace('_', ' ', @$newStr);  
                                                        @$value= @$row->$input_field; ?>
                                                        <div class="row">
                                                            <div class="col-lg-12 mb-30">
                                                                <div class="input-effect">
                                                                    <input class="primary-input form-control<?php echo e($errors->has($input_field) ? ' is-invalid' : ''); ?>"
                                                                    type="text" name="<?php echo e($input_field); ?>" id="gateway_<?php echo e($input_field); ?>" autocomplete="off" value="<?php echo e(isset($value)? $value : ''); ?>" <?php if(@$count==0): ?> readonly="" <?php endif; ?>>
                                                                    <label><?php echo e(@$label_name); ?> <span></span> </label>
                                                                    <span class="focus-border"></span>
                                                                    <?php if($errors->has($input_field)): ?>
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong><?php echo e($errors->first($input_field)); ?></strong>
                                                                        </span>
                                                                    <?php endif; ?>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                            <?php $count++; } ?>
                                              <?php  }elseif(@$row->gateway_name=="Bank"){?>
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-4 no-gutters">
                                                            <div class="main-title">
                                                                <h3 class="mb-0"><?php echo app('translator')->get('lang.bank'); ?> <?php echo app('translator')->get('lang.account'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                                                                <strong><?php echo app('translator')->get('lang.note'); ?>: </strong><small><?php echo app('translator')->get('lang.Available'); ?> <?php echo app('translator')->get('lang.for'); ?> <?php echo app('translator')->get('lang.students'); ?> <?php echo app('translator')->get('lang.and'); ?> <?php echo app('translator')->get('lang.parents'); ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <table id="noSearch" class="display school-table shadow-none" cellspacing="0" width="100%">
                                                                <thead>
                                                                    <tr>
                                                                        <th><?php echo app('translator')->get('lang.value'); ?></th>
                                                                        <th><?php echo app('translator')->get('lang.bank'); ?> <?php echo app('translator')->get('lang.name'); ?></th>
                                                                        <th><?php echo app('translator')->get('lang.account_name'); ?></th>
                                                                        <th><?php echo app('translator')->get('lang.account'); ?> <?php echo app('translator')->get('lang.number'); ?></th>
                                                                        <th><?php echo app('translator')->get('lang.account'); ?> <?php echo app('translator')->get('lang.type'); ?></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $__currentLoopData = $bank_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank_account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td>
                                                                            <div class="input-effect">
                                                                                <input type="checkbox" data-id="<?php echo e(@$bank_account->id); ?>" id="bank<?php echo e(@$bank_account->id); ?>" class="common-checkbox class-checkbox accountStatus" name="account_status" 
                                                                                value="<?php echo e(@$bank_account->id); ?>" <?php echo e(@$bank_account->active_status == 1? 'checked':''); ?>>
                                                                                <label for="bank<?php echo e(@$bank_account->id); ?>"><?php echo e(@$value->method); ?></label>
                                                                            </div>
                                                                        </td>
                                                                        <td><?php echo e(@$bank_account->bank_name); ?></td>
                                                                        <td><?php echo e(@$bank_account->account_name); ?></td>
                                                                        <td><?php echo e(@$bank_account->account_number); ?></td>
                                                                        <td><?php echo e(@$bank_account->account_type); ?></td>
                                                                    </tr>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>    
                                        <?php }elseif(@$row->gateway_name=="Cheque") {
                                                $count=0;
                                                    foreach ($paymeny_gateway as $input_field) {
                                                        @$newStr = @$input_field;
                                                        @$label_name = str_replace('_', ' ', @$newStr);  
                                                        @$value= @$row->$input_field; ?>
                                                        <?php if($count == 0): ?>
                                                        <div class="row">
                                                            <div class="col-lg-12 mb-30">
                                                                <div class="input-effect">
                                                                    <input class="primary-input form-control<?php echo e($errors->has($input_field) ? ' is-invalid' : ''); ?>"
                                                                    type="text" name="<?php echo e($input_field); ?>" id="gateway_<?php echo e($input_field); ?>" autocomplete="off" value="<?php echo e(isset($value)? $value : ''); ?>" <?php if(@$count==0): ?> readonly="" <?php endif; ?>>
                                                                    <label><?php echo e(@$label_name); ?> <span></span> </label>
                                                                    <span class="focus-border"></span>
                                                                    <span class="modal_input_validation red_alert"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php else: ?>
                                                        <div class="row">
                                                            <div class="col-lg-12 mt-50">
                                                                <div class="input-effect sm2_mb_20">
                                                                    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
                                                                    <textarea class="primary-input article-ckeditor form-control" cols="0" rows="3" name="<?php echo e($input_field); ?>" id="article-ckeditor"><?php echo e(@$value); ?></textarea>

                                                                    <script>
                                                                        CKEDITOR.replace( "<?php echo $input_field ?>" );
                                                                    </script>
                                                                    <span class="focus-border textarea"></span>
                                                                    <label class="textarea-label"> <?php echo app('translator')->get('lang'.'.'.$input_field); ?> <span></span> </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endif; ?>
                                                        <?php $count++; } 
                                              }
                                              ?>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="row justify-content-center">
                                                    <?php if(!empty(@$row->logo)): ?>
                                                        <img class="logo"  src="<?php echo e(URL::asset(@$row->logo)); ?>" style="width: auto; height: 100px; ">  
                                                    <?php endif; ?>
                                                </div>
                                                <div class="row justify-content-center">
                                                  
                                                        <?php if(session()->has('message-success')): ?>
                                                          <p class=" text-success">
                                                              <?php echo e(session()->get('message-success')); ?>

                                                          </p>
                                                        <?php elseif(session()->has('message-danger')): ?>
                                                          <p class=" text-danger">
                                                              <?php echo e(session()->get('message-danger')); ?>

                                                          </p>
                                                        <?php endif; ?> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                        $tooltip = "";
                                        if(userPermission(414)){
                                                $tooltip = "";
                                            }else{
                                                $tooltip = "You have no permission to add";
                                            }
                                    ?>
                                    <?php if(@$row->gateway_name!="Bank"): ?>
                                                <?php if(@$row->gateway_name=="Paystack"): ?>
                                                <strong class="main-title"> N.B: Please Set This url  <a class="disabled" href="<?php echo e(route('handleGatewayCallback')); ?>" disable><?php echo e(route('handleGatewayCallback')); ?></a>  As Paystack Callback Url </strong>  
                                                <?php endif; ?>      
                                            <div class="row mt-40">
                                                <div class="col-lg-12 text-center">
                                                    <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> <button class="primary-btn fix-gr-bg  demo_view" style="pointer-events: none;" type="button" ><?php echo app('translator')->get('lang.update'); ?> </button></span>
                                                    <?php else: ?> 
                                                    <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                                        <span class="ti-check"></span>
                                                        <?php echo app('translator')->get('lang.update'); ?>
                                                    </button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                    <?php endif; ?>
                                
                                </div>
                            </form>
                        </div> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script'); ?>
    <script>
        $(document).on('change','.accountStatus',function (){
            let account_id = $(this).data('id');
            let account_status =0;
            if ($(this).is(':checked'))
            {
                account_status = 1;
            }
            $.ajax({
                url : "<?php echo e(route('bank-status')); ?>",
                method : "POST",
                data : {
                    account_id : account_id,
                    account_status : account_status,
                },
                success : function (result){
                    toastr.success('Operation successful', 'Successful', {
                        timeOut: 5000
                    })
                }
            })
        })
    </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/systemSettings/paymentMethodSettings.blade.php ENDPATH**/ ?>