
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.general'); ?> <?php echo app('translator')->get('lang.settings'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.update'); ?> <?php echo app('translator')->get('lang.general_settings'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="<?php echo e(route('general-settings')); ?>"><?php echo app('translator')->get('lang.general_settings'); ?> <?php echo app('translator')->get('lang.view'); ?></a>
              </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-6">
                <div class="main-title">
                    <h3 class="mb-30">
                        <?php echo app('translator')->get('lang.update'); ?>
                   </h3>
                </div>
            </div>
        </div>
        <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admin-dashboard', 'method' => 'GET', 'enctype' => 'multipart/form-data'])); ?>

        <?php else: ?>
            <?php if(userPermission(409)): ?>
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'update-general-settings-data', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

            <?php endif; ?>
        <?php endif; ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                    <div class="">
                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">


                        <div class="row mb-40">
                            <div class="col-lg-4">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('school_name') ? ' is-invalid' : ''); ?>"
                                    type="text" name="school_name" autocomplete="off" value="<?php echo e(isset($editData)? @$editData->school_name : old('school_name')); ?>">
                                    <label><?php echo app('translator')->get('lang.school_name'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('school_name')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('school_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('site_title') ? ' is-invalid' : ''); ?>"
                                    type="text" name="site_title" autocomplete="off" value="<?php echo e(isset($editData)? @$editData->site_title : old('site_title')); ?>">
                                    <label><?php echo app('translator')->get('lang.site_title'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('site_title')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('site_title')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('session_id') ? ' is-invalid' : ''); ?>" name="session_id" id="session_id">
                                        <option data-display="<?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.academic_year'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.academic_year'); ?></option>
                                        <?php $__currentLoopData = academicYears(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(@$value->id); ?>"
                                        <?php if(isset($editData)): ?>
                                        <?php if(@$editData->session_id == @$value->id): ?>
                                        selected
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        ><?php echo e(@$value->year); ?> (<?php echo e(@$value->title); ?>)</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('session_id')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('session_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-40">
                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('school_code') ? ' is-invalid' : ''); ?>"
                                    type="text" name="school_code" autocomplete="off" value="<?php echo e(isset($editData)? @$editData->school_code: old('school_code')); ?>">
                                    <label><?php echo app('translator')->get('lang.school_code'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('school_code')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('school_code')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>"
                                    type="text" name="phone" autocomplete="off" value="<?php echo e(isset($editData) ? @$editData->phone : old('phone')); ?>">
                                    <label><?php echo app('translator')->get('lang.phone'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('phone')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>"
                                    type="text" name="email" autocomplete="off" value="<?php echo e(isset($editData)? @$editData->email: old('email')); ?>">
                                    <label><?php echo app('translator')->get('lang.email'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('email')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('income_head') ? ' is-invalid' : ''); ?>" name="income_head" id="income_head_id">
                                        <option data-display="<?php echo app('translator')->get('lang.fees'); ?> <?php echo app('translator')->get('lang.income'); ?> <?php echo app('translator')->get('lang.head'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?></option>
                                        <?php $__currentLoopData = $sell_heads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sell_head): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($sell_head->id); ?>"
                                            <?php echo e(isset($editData)? ($editData->income_head_id == $sell_head->id? 'selected':''):''); ?>

                                            ><?php echo e($sell_head->head); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="focus-border"></span>
                                        <?php if($errors->has('income_head')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('income_head')); ?></strong>
                                    </span>
                                        <?php endif; ?>
                                    <span class="modal_input_validation red_alert"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-40">
                            

                           <div class="col-lg-2">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('language_id') ? ' is-invalid' : ''); ?>" name="language_id" id="language_id">
                                        <option data-display="<?php echo app('translator')->get('lang.language'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <span>*</span></option>
                                        <?php $lang = App\SmLanguage::all(); ?>
                                        <?php if(isset($lang)): ?>
                                        <?php $__currentLoopData = $lang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(@$value->id); ?>"
                                        <?php if(isset($editData)): ?>
                                        <?php if(@$editData->language_id == @$value->id): ?>
                                        selected
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        ><?php echo e(@$value->language_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('language_id')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('language_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                           <div class="col-lg-2">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('week_start_id') ? ' is-invalid' : ''); ?>" name="week_start_id" id="week_start_id">
                                        <option data-display="<?php echo app('translator')->get('lang.week'); ?> <?php echo app('translator')->get('lang.start'); ?> <?php echo app('translator')->get('lang.day'); ?> *" value=""><?php echo app('translator')->get('lang.week'); ?> <?php echo app('translator')->get('lang.start'); ?> <?php echo app('translator')->get('lang.day'); ?> <span>*</span></option>
                                        <?php $__currentLoopData = $weekends; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $weekend): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($weekend->id); ?>" <?php if(isset($editData)): ?> <?php if(@$editData->week_start_id == @$weekend->id): ?> selected <?php endif; ?>  <?php endif; ?>><?php echo e($weekend->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('week_start_id')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('week_start_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="input-effect">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('date_format_id') ? ' is-invalid' : ''); ?>" name="date_format_id" id="date_format_id">
                                        <option data-display="<?php echo app('translator')->get('lang.select_date_format'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <span>*</span></option>
                                        <?php if(isset($dateFormats)): ?>
                                        <?php $__currentLoopData = $dateFormats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(@$value->id); ?>"
                                        <?php if(isset($editData)): ?>
                                        <?php if(@$editData->date_format_id == @$value->id): ?>
                                        selected
                                        <?php endif; ?>
                                        <?php endif; ?>
                                        ><?php echo e(@$value->normal_view); ?> [<?php echo e(@$value->format); ?>]</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                    </select>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('date_format_id')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('date_format_id')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="input-effect">
                                     <select name="time_zone" class="niceSelect w-100 bb form-control <?php echo e($errors->has('time_zone') ? ' is-invalid' : ''); ?>" id="time_zone">
                                        <option data-display="<?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.time_zone'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.time_zone'); ?> *</option>

                                        <?php $__currentLoopData = $time_zones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $time_zone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e(@$time_zone->id); ?>" <?php echo e(@$time_zone->id == @$editData->time_zone_id? 'selected':''); ?>><?php echo e(@$time_zone->time_zone); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                                    </select>

                                    <span class="focus-border"></span>
                                        <?php if($errors->has('time_zone')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('time_zone')); ?></strong>
                                        </span>
                                        <?php endif; ?>


                                 </div>
                            </div>
                        </div>

                        </div>

                        <div class="row mb-40">

                            <div class="col-lg-4">
                                <div class="input-effect">
                                     <select name="currency" class="niceSelect w-100 bb form-control <?php echo e($errors->has('currency') ? ' is-invalid' : ''); ?>" id="currency">
                                        <option data-display="<?php echo app('translator')->get('lang.select_currency'); ?>" value=""><?php echo app('translator')->get('lang.select_currency'); ?></option>
                                         <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(@$currency->code); ?>" <?php echo e(isset($editData)? (@$editData->currency  == @$currency->code? 'selected':''):''); ?>><?php echo e($currency->name); ?> (<?php echo e($currency->code); ?>)</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php if($errors->has('currency')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('currency')); ?></strong>
                                    </span>
                                    <?php endif; ?>

                                 </div>
                            </div>

                                

                                <div class="col-lg-4">
                                    <div class="input-effect">
                                        <input class="primary-input form-control<?php echo e($errors->has('currency_symbol') ? ' is-invalid' : ''); ?>"
                                        type="text" name="currency_symbol" autocomplete="off" value="<?php echo e(isset($editData)? @$editData->currency_symbol : old('currency_symbol')); ?>" id="currency_symbol" readonly="">
                                        <label><?php echo app('translator')->get('lang.currency_symbol'); ?> <span>*</span></label>
                                        <span class="focus-border"></span>
                                        <?php if($errors->has('currency_symbol')): ?>
                                        <span class="invalid-feedback" role="alert">
                                            <strong><?php echo e($errors->first('currency_symbol')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
    
                            <div class="col-lg-4">
                                <div class="input-effect">
                                    <input oninput="numberCheck(this)" class="primary-input form-control<?php echo e($errors->has('file_size') ? ' is-invalid' : ''); ?>"
                                    type="text" name="file_size" <?php echo e(moduleStatusCheck('Saas')== TRUE && Auth::user()->is_administrator != "yes" ? 'readonly':''); ?> autocomplete="off" value="<?php echo e(isset($editData)? @$editData->file_size : old('file_size')); ?>" id="file_size" >
                                    <label><?php echo app('translator')->get('lang.max_upload_file_size'); ?> (MB) <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('file_size')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('file_size')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            

                        </div>
                        <div class="row mb-30 mt-20">
                            <div class="col-lg-6 d-flex relation-button">
                                <p class="text-uppercase mb-0"><?php echo app('translator')->get('lang.promossion_without'); ?> <?php echo app('translator')->get('lang.exam'); ?></p>
                                <div class="d-flex radio-btn-flex ml-30">
                                    <div class="mr-20">
                                        <input type="radio" name="promotionSetting" id="relationFather" value="1" class="common-radio relationButton" <?php echo e(@$editData->promotionSetting == "1"? 'checked': ''); ?>>
                                        <label for="relationFather"><?php echo app('translator')->get('lang.enable'); ?></label>
                                    </div>
                                    <div class="mr-20">
                                        <input type="radio" name="promotionSetting" id="relationMother" value="0" class="common-radio relationButton" <?php echo e(@$editData->promotionSetting == "0"? 'checked': ''); ?>>
                                        <label for="relationMother"><?php echo app('translator')->get('lang.disable'); ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex relation-button">
                                <div class="input-effect">
                                    <input class="primary-input form-control<?php echo e($errors->has('ss_page_load') ? ' is-invalid' : ''); ?>"
                                    type="text" oninput="numberCheck(this)" name="ss_page_load" autocomplete="off" value="<?php echo e(isset($editData)? @$editData->ss_page_load : old('ss_page_load')); ?>" id="ss_page_load" >
                                    <label><?php echo app('translator')->get('lang.ss_page_load'); ?> <span>*</span></label>
                                    <span class="focus-border"></span>
                                    <?php if($errors->has('ss_page_load')): ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($errors->first('ss_page_load')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row mb-30 mt-20">
                            <div class="col-lg-12 d-flex relation-button">
                                <p class="text-uppercase mb-0"><?php echo app('translator')->get('lang.subject_attendance_layout'); ?></p>
                                <div class="d-flex radio-btn-flex ml-30">
                                    <div class="mr-20">
                                        
                                            <input type="radio" name="attendance_layout" id="first_layout" value="1" class="common-radio relationButton attendance_layout"  <?php echo e(@$editData->attendance_layout == "1"? 'checked': ''); ?>>
                                            <label for="first_layout">
                                                <img src="<?php echo e(asset('public/backEnd/img/first_layout.png')); ?>" width="200px" height="auto" class="layout_image" for="first_layout" alt="">
                                            </label>
                                            
                                    </div>
                                    <div class="mr-20">
                                        <input type="radio" name="attendance_layout" id="second_layout" value="0" class="common-radio relationButton attendance_layout" <?php echo e(@$editData->attendance_layout == "0"? 'checked': ''); ?>>
                                        <label for="second_layout">
                                            <img src="<?php echo e(asset('public/backEnd/img/second_layout.png')); ?>" width="200px" height="auto" class="layout_image" for="second_layout" alt="">
                                        </label>
                                        </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="row md-30">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                <textarea class="primary-input form-control" cols="0" rows="4" name="address" id="address"><?php echo e(isset($editData) ? @$editData->address : old('address')); ?></textarea>
                                    <label><?php echo app('translator')->get('lang.school_address'); ?> <span></span> </label>
                                    <span class="focus-border textarea"></span>

                                </div>
                            </div>
                            
                        </div>
                        <div class="row md-30 mt-40">
                            <div class="col-lg-12">
                                <div class="input-effect">
                                <textarea class="primary-input form-control" cols="0" rows="4" name="copyright_text" id="copyright_text"><?php echo e(isset($editData) ? @$editData->copyright_text : old('copyright_text')); ?></textarea>
                                    <label><?php echo app('translator')->get('lang.copyright_text'); ?> <span></span> </label>
                                    <span class="focus-border textarea"></span>

                                </div>
                            </div>
                        </div>

        
                    <div class="row mt-40">
                        <div class="col-lg-12 text-center">

                            <?php if(env('APP_SYNC')==TRUE): ?>
                                <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> <button class="primary-btn small fix-gr-bg  demo_view" style="pointer-events: none;" type="button" > <?php echo app('translator')->get('lang.update'); ?></button></span>
                            <?php else: ?>
                                <?php if(userPermission(409)): ?>
                                <button type="submit" class="primary-btn fix-gr-bg submit">
                                    <span class="ti-check"></span>
                                    <?php echo app('translator')->get('lang.update'); ?>
                                </button>
                                <?php endif; ?>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php echo e(Form::close()); ?>

    </div>

</div>
</section>
<div class="modal fade admin-query question_image_preview"  >
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.layout'); ?> <?php echo app('translator')->get('lang.image'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <img src="" width="100%" class="question_image_url" alt="">
            </div>

        </div>
    </div>
</div>
<script>
    
    $(document).on('click', '.layout_image', function(){

         console.log(this.src);
            // $('.question_image_url').src(this.src);
            $('.question_image_url').attr('src',this.src);   
            $('.question_image_preview').modal('show');
        })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/systemSettings/updateGeneralSettings.blade.php ENDPATH**/ ?>