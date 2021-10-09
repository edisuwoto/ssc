
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.income'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>

<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.income'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.accounts'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.income'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($add_income)): ?>
        <?php if(userPermission(140)): ?>

        <div class="row">
            <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                <a href="<?php echo e(route('add_income')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('lang.add'); ?>
                </a>
            </div>
        </div>
        <?php endif; ?>
        <?php endif; ?>
        <div class="row">
           
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-title">
                            <h3 class="mb-30"><?php if(isset($add_income)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                <?php echo app('translator')->get('lang.income'); ?>
                            </h3>
                        </div>
                        <?php if(isset($add_income)): ?>
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'add_income_update',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'add-income-update'])); ?>

                        <?php else: ?>
                         <?php if(userPermission(140)): ?>

                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'add_income_store',
                        'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'add-income'])); ?>

                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e(@$errors->has('name') ? ' is-invalid' : ''); ?>"
                                                type="text" name="name" autocomplete="off" value="<?php echo e(isset($add_income)? $add_income->name: old('name')); ?>">
                                            <input type="hidden" name="id" value="<?php echo e(isset($add_income)? $add_income->id: ''); ?>">
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
                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control<?php echo e(@$errors->has('income_head') ? ' is-invalid' : ''); ?>" name="income_head">
                                            <option data-display="<?php echo app('translator')->get('lang.a_c_Head'); ?> *" value=""><?php echo app('translator')->get('lang.a_c_Head'); ?> *</option>
                                            <?php $__currentLoopData = $income_heads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income_head): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(isset($add_income)): ?>
                                                <option value="<?php echo e(@$income_head->id); ?>"
                                                    <?php echo e(@$add_income->income_head_id == @$income_head->id? 'selected': ''); ?>><?php echo e(@$income_head->head); ?></option>
                                                <?php else: ?>
                                                <option value="<?php echo e(@$income_head->id); ?>" <?php echo e(old('income_head') == @$income_head->id? 'selected' : ''); ?>><?php echo e(@$income_head->head); ?></option>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if(@$errors->has('income_head')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e(@$errors->first('income_head')); ?></strong>
                                        </span>
                                        <?php endif; ?> 
                                    </div>
                                </div>
                                
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control<?php echo e(@$errors->has('payment_method') ? ' is-invalid' : ''); ?>" name="payment_method" id="payment_method">
                                            <option data-display="<?php echo app('translator')->get('lang.payment_method'); ?> *" value=""><?php echo app('translator')->get('lang.payment_method'); ?> *</option>
                                            <?php $__currentLoopData = $payment_methods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment_method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($add_income)): ?>
                                            <option data-string="<?php echo e($payment_method->method); ?>" value="<?php echo e(@$payment_method->id); ?>"<?php echo e(@$add_income->payment_method_id == @$payment_method->id? 'selected': ''); ?>>
                                                <?php echo e(@$payment_method->method); ?>

                                            </option>
                                            <?php else: ?>
                                            <option data-string="<?php echo e($payment_method->method); ?>" value="<?php echo e(@$payment_method->id); ?>"><?php echo e(@$payment_method->method); ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if(@$errors->has('payment_method')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e(@$errors->first('payment_method')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row mt-25 d-none" id="bankAccount">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control<?php echo e(@$errors->has('accounts') ? ' is-invalid' : ''); ?>" name="accounts">
                                            <option data-display="<?php echo app('translator')->get('lang.bank'); ?> <?php echo app('translator')->get('lang.accounts'); ?> *" value=""><?php echo app('translator')->get('lang.bank'); ?> <?php echo app('translator')->get('lang.accounts'); ?> *</option>
                                            <?php $__currentLoopData = $bank_accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank_account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if(isset($add_income)): ?>
                                            <option value="<?php echo e(@$bank_account->id); ?>"
                                                <?php echo e(@$add_income->account_id == @$bank_account->id? 'selected': ''); ?>><?php echo e(@$bank_account->account_name); ?> (<?php echo e(@$bank_account->bank_name); ?>)</option>
                                            <?php else: ?>
                                            <option value="<?php echo e(@$bank_account->id); ?>"><?php echo e(@$bank_account->account_name); ?> (<?php echo e(@$bank_account->bank_name); ?>)</option>
                                            <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                         <?php if($errors->has('accounts')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e(@$errors->first('accounts')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>


                                <div class="row no-gutters input-right-icon mt-25">
                                    <div class="col">
                                        <div class="input-effect">
                                            <input class="primary-input date form-control<?php echo e(@$errors->has('date') ? ' is-invalid' : ''); ?>"
                                                id="startDate" type="text" placeholder="<?php echo app('translator')->get('lang.date'); ?> *" name="date" value="<?php echo e(isset($add_income)? date('m/d/Y', strtotime($add_income->date)): date('m/d/Y')); ?>">
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('date')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e(@$errors->first('date')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <button class="" type="button">
                                            <i class="ti-calendar" id="start-date-icon"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="row  mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input oninput="numberCheckWithDot(this)" class="primary-input form-control<?php echo e(@$errors->has('amount') ? ' is-invalid' : ''); ?>"
                                                type="text" step="0.1" name="amount" value="<?php echo e(isset($add_income)? $add_income->amount: old('amount')); ?>">
                                            <label><?php echo app('translator')->get('lang.amount'); ?> (<?php echo e(generalSetting()->currency_symbol); ?>) <span>*</span></label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('amount')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e(@$errors->first('amount')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                     <div class="col">
                                        <div class="row no-gutters input-right-icon">
                                            <div class="col">
                                                <div class="input-effect">
                                                    <input class="primary-input" type="text" id="placeholderFileOneName" placeholder="<?php echo e(isset($add_income)? ($add_income->file != ""? getFilePath3($add_income->file):trans('lang.file')):trans('lang.file')); ?>" readonly
                                                        >
                                                    <span class="focus-border"></span>
                                                    <?php if($errors->has('file')): ?>
                                                        <span class="invalid-feedback d-block" role="alert">
                                                            <strong><?php echo e(@$errors->first('file')); ?></strong>
                                                        </span>
                                                <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-auto">
                                                <button class="primary-btn-small-input" type="button">
                                                    <label class="primary-btn small fix-gr-bg" for="document_file_1"><?php echo app('translator')->get('lang.browse'); ?></label>
                                                    <input type="file" class="d-none" name="file" id="document_file_1">
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-25">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <textarea class="primary-input form-control" cols="0" rows="4" name="description"><?php echo e(isset($add_income)? $add_income->description: old('description')); ?></textarea>
                                            <label><?php echo app('translator')->get('lang.description'); ?> <span></span></label>
                                            <span class="focus-border textarea"></span>
                                        </div>
                                    </div>
                                </div>
                 				<?php 
                                  $tooltip = "";
                                  if(userPermission(140)){
                                        $tooltip = "";
                                    }else{
                                        $tooltip = "You have no permission to add";
                                    }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                        <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(@$add_income): ?>
                                                <?php echo app('translator')->get('lang.save'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.update'); ?>
                                            <?php endif; ?>
                                            <?php echo app('translator')->get('lang.income'); ?>
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
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.income'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.name'); ?></th>
                                    <th><?php echo app('translator')->get('lang.payment_method'); ?></th>
                                    <th><?php echo app('translator')->get('lang.date'); ?></th>
                                    <th><?php echo app('translator')->get('lang.a_c_Head'); ?></th>
                                    <th><?php echo app('translator')->get('lang.amount'); ?>(<?php echo e(generalSetting()->currency_symbol); ?>)</th>
                                    <th><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $__currentLoopData = $add_incomes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $add_income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(@$add_income->name); ?></td>
                                    <td><?php echo e(@$add_income->paymentMethod !=""?@$add_income->paymentMethod->method:trans('lang.bank')); ?> <?php echo e(@$add_income->payment_method_id == "3"? '('.@$add_income->account->account_name.')':''); ?></td>
                                    <td data-sort="<?php echo e(strtotime(@$add_income->date)); ?>" ><?php echo e(@$add_income->date != ""? dateConvert(@$add_income->date):''); ?></td>
                                    <td><?php echo e(isset($add_income->ACHead->head)? $add_income->ACHead->head: ''); ?></td>
                                    <td><?php echo e(@$add_income->amount); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <?php if($add_income->name != "Opening Balance"): ?>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <?php if(userPermission(141)): ?>
                                                    <a class="dropdown-item" href="<?php echo e(route('add_income_edit', [@$add_income->id])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                <?php endif; ?>
                                                <?php if(@$add_income->file != ""): ?>
                                                        <a class="dropdown-item" 
                                                            href="<?php echo e(url(@$add_income->file)); ?>" download>
                                                            <?php echo app('translator')->get('lang.download'); ?> <span class="pl ti-download"></span>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if(userPermission(142)): ?>
                                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteAddIncomeModal<?php echo e(@$add_income->id); ?>"><?php echo app('translator')->get('lang.delete'); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade admin-query" id="deleteAddIncomeModal<?php echo e(@$add_income->id); ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.income'); ?></h4>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>

                                            <div class="modal-body">
                                                <div class="text-center">
                                                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                </div>

                                                <div class="mt-40 d-flex justify-content-between">
                                                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                    <?php echo e(Form::open(['route' => 'add_income_delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                                    <input type="hidden" name="id" value="<?php echo e(@$add_income->id); ?>">
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
    </div>
</section>





<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/accounts/add_income.blade.php ENDPATH**/ ?>