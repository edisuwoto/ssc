<div class="row">
    <div class="col-lg-4">
        <div class="input-effect">
            <input class="primary-input form-control<?php echo e($errors->has('label') ? ' is-invalid' : ''); ?>" type="text" name="label" autocomplete="off"
                    value="<?php echo e(isset($v_custom_field)? $v_custom_field->label: old('label')); ?>">
            <label><?php echo app('translator')->get('lang.label'); ?><span>*</span></label>
            <span class="focus-border"></span>
            <?php if($errors->has('label')): ?>
                <span class="invalid-feedback" role="alert">
                <strong><?php echo e($errors->first('label')); ?></strong>
            </span>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-lg-4">
        <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('type') ? ' is-invalid' : ''); ?>" name="type" id="inputType">
            <option data-display="<?php echo app('translator')->get('lang.type'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.type'); ?> *</option>
            <option value="textInput" <?php echo e(isset($v_custom_field)? ($v_custom_field->type =="textInput" ?'selected':''): (old('type') == 'textInput' ? 'selected' : '')); ?>><?php echo app('translator')->get('lang.text'); ?> <?php echo app('translator')->get('lang.input'); ?></option>
            <option value="numericInput" <?php echo e(isset($v_custom_field)? ($v_custom_field->type =="numericInput"?'selected':''): (old('type') == 'numericInput' ? 'selected' : '')); ?>><?php echo app('translator')->get('lang.numeric'); ?> <?php echo app('translator')->get('lang.input'); ?></option>
            <option value="multilineInput" <?php echo e(isset($v_custom_field)? ($v_custom_field->type =="multilineInput"?'selected':''): (old('type') == 'multilineInput' ? 'selected' : '')); ?>><?php echo app('translator')->get('lang.multiline'); ?> <?php echo app('translator')->get('lang.input'); ?></option>
            <option value="datepickerInput" <?php echo e(isset($v_custom_field)? ($v_custom_field->type =="datepickerInput"?'selected':''): (old('type') == 'datepickerInput' ? 'selected' : '')); ?>><?php echo app('translator')->get('lang.datepicker'); ?> <?php echo app('translator')->get('lang.input'); ?></option>
            <option value="checkboxInput" <?php echo e(isset($v_custom_field)? ($v_custom_field->type =="checkboxInput"?'selected':''): (old('type') == 'checkboxInput' ? 'selected' : '')); ?>><?php echo app('translator')->get('lang.checkbox'); ?> <?php echo app('translator')->get('lang.input'); ?></option>
            <option value="radioInput" <?php echo e(isset($v_custom_field)? ($v_custom_field->type =="radioInput"?'selected':''): (old('type') == 'radioInput' ? 'selected' : '')); ?>><?php echo app('translator')->get('lang.radio'); ?> <?php echo app('translator')->get('lang.input'); ?></option>
            <option value="dropdownInput" <?php echo e(isset($v_custom_field)? ($v_custom_field->type =="dropdownInput"?'selected':''):(old('type') == 'dropdownInput' ? 'selected' : '')); ?>><?php echo app('translator')->get('lang.dropdown'); ?> <?php echo app('translator')->get('lang.input'); ?></option>
            <option value="fileInput" <?php echo e(isset($v_custom_field)? ($v_custom_field->type =="fileInput"?'selected':''):(old('type') == 'fileInput' ? 'selected' : '')); ?>><?php echo app('translator')->get('lang.file'); ?> <?php echo app('translator')->get('lang.input'); ?></option>
        </select>
        <?php if($errors->has('type')): ?>
            <span class="invalid-feedback invalid-select" role="alert">
                <strong><?php echo e($errors->first('type')); ?></strong>
            </span>
        <?php endif; ?>
    </div>
    <div class="col-lg-4">
        <div class="input-effect sm_mb_20 sm2_mb_20 md_mb_20">
            <input type="checkbox" name="required" id="labalRequired" class="common-radio permission-checkAll" value="1"
            <?php echo e(isset($v_custom_field)? ($v_custom_field->required == 1?'checked':''):(old('required') ? 'checked' : '')); ?>>
            <label for="labalRequired"><?php echo app('translator')->get('lang.required'); ?></label>
        </div>
    </div>
</div>

<?php
    if(isset($v_custom_field)){
        $v_lengths = json_decode($v_custom_field->min_max_length);
        $v_values = json_decode($v_custom_field->min_max_value);
    }
?>
<div class="row">
    <div class="col-xl-8">
        <div class="row mt-30 text_input d-none">
            <div class="col-lg-6">
                <div class="input-effect sm_mb_20 sm2_mb_20 md_mb_20">
                    <input class="primary-input" type="text" name="min_max_length[]" value="<?php echo e(isset($v_custom_field)? $v_lengths[0]:(old('min_max_length') ? old('min_max_length')[0] : '')); ?>">
                    <label><?php echo app('translator')->get('lang.min'); ?> <?php echo app('translator')->get('lang.length'); ?></label>
                    <span class="focus-border"></span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-effect sm_mb_20 sm2_mb_20 md_mb_20">
                    <input class="primary-input" type="text" name="min_max_length[]" value="<?php echo e(isset($v_custom_field)? $v_lengths[1]:(old('min_max_length') ? old('min_max_length')[1] : '')); ?>">
                    <label><?php echo app('translator')->get('lang.max'); ?> <?php echo app('translator')->get('lang.length'); ?></label>
                    <span class="focus-border"></span>
                </div>
            </div>
        </div>

        <div class="row mt-30 numeric_input d-none">
            <div class="col-lg-6">
                <div class="input-effect sm_mb_20 sm2_mb_20 md_mb_20">
                    <input class="primary-input" type="text" name="min_max_value[]" value="<?php echo e(isset($v_custom_field)? $v_values[0]:(old('min_max_value') ? old('min_max_value')[0] : '')); ?>">
                    <label><?php echo app('translator')->get('lang.min'); ?> <?php echo app('translator')->get('lang.value'); ?></label>
                    <span class="focus-border"></span>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-effect sm_mb_20 sm2_mb_20 md_mb_20">
                    <input class="primary-input" type="text" name="min_max_value[]" value="<?php echo e(isset($v_custom_field)? $v_values[1]:(old('min_max_value') ? old('min_max_value')[1] : '')); ?>">
                    <label><?php echo app('translator')->get('lang.max'); ?> <?php echo app('translator')->get('lang.value'); ?></label>
                    <span class="focus-border"></span>
                </div>
            </div>
        </div>

        <div class="row mt-30 checkbox_input d-none">
            <div class="col-lg-8 mt-20 text-right">
                <button type="button" class="primary-btn small fix-gr-bg" onclick="customFieldAddRow();" id="customFieldaddRowBtn">
                    <span class="ti-plus pr-2"></span>
                        <?php echo app('translator')->get('lang.add'); ?>
                </button>
            </div>
        </div>

        <?php
            if(isset($v_custom_field)){
                $v_name_values= json_decode($v_custom_field->name_value);
            }
        ?>
        <input type="hidden" value="<?php echo app('translator')->get('lang.value'); ?>" id="rowLang" >
        <?php if(isset($v_custom_field)): ?>
            <?php if($v_custom_field->type == "checkboxInput" || $v_custom_field->type == "radioInput" || $v_custom_field->type == "dropdownInput"): ?>
                <?php $__currentLoopData = $v_name_values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v_name_value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row mt-30 static d-none">
                        <div class="col-lg-6">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('value') ? ' is-invalid' : ''); ?>" type="text" name="name_value[]" autocomplete="off"
                                value='<?php echo e(isset($v_custom_field)? $v_name_value:''); ?>'>
                                <label><?php echo e(isset($v_custom_field)? $v_name_value: trans('lang.value')); ?></label>
                                <span class="focus-border"></span>
                            </div>
                            <?php if($errors->has('value')): ?>
                                <span class="invalid-feedback" role="alert">
                                <strong><?php echo e($errors->first('value')); ?></strong>
                                </span>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-4">
                            <button class="primary-btn icon-only fix-gr-bg" type="button" id="deleteCustRow" <?php echo e(isset($v_custom_field)? '':'disabled'); ?> >
                                <span class="ti-trash"></span>
                            </button>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endif; ?>
        <div id="addCustRow"></div>
    </div>
    <div class="col-xl-4 mt-30">
        <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('width') ? ' is-invalid' : ''); ?>" name="width">
            <option data-display="<?php echo app('translator')->get('lang.width'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.width'); ?> *</option>
            <option value="col-12" <?php echo e(isset($v_custom_field)? ($v_custom_field->width =="col-12"?'selected':''):(old('width') == 'col-12' ? 'selected' : '')); ?>><?php echo app('translator')->get('lang.full'); ?> <?php echo app('translator')->get('lang.width'); ?></option>
            <option value="col-6" <?php echo e(isset($v_custom_field)? ($v_custom_field->width =="col-6"?'selected':''):(old('width') == 'col-6' ? 'selected' : '')); ?>><?php echo app('translator')->get('lang.half'); ?> <?php echo app('translator')->get('lang.width'); ?></option>
            <option value="col-3" <?php echo e(isset($v_custom_field)? ($v_custom_field->width =="col-3"?'selected':''):(old('width') == 'col-3' ? 'selected' : '')); ?>><?php echo app('translator')->get('lang.one_thired'); ?> <?php echo app('translator')->get('lang.width'); ?></option>
            <option value="col-4" <?php echo e(isset($v_custom_field)? ($v_custom_field->width =="col-4"?'selected':''):(old('width') == 'col-4' ? 'selected' : '')); ?>><?php echo app('translator')->get('lang.one_fourth'); ?> <?php echo app('translator')->get('lang.width'); ?></option>
        </select>
        <?php if($errors->has('width')): ?>
            <span class="invalid-feedback invalid-select" role="alert">
                <strong><?php echo e($errors->first('width')); ?></strong>
            </span>
        <?php endif; ?>
    </div>
</div>
<?php if(userPermission(1102) || userPermission(1106)): ?>
    <div class="col-lg-12 mt-20 text-right">
        <button type="submit" class="primary-btn small fix-gr-bg">
            <span class="ti-save pr-2"></span>
            <?php echo e(isset($v_custom_field)?trans('lang.update'):trans('lang.save')); ?>

        </button>
    </div>
<?php endif; ?>

<script type="text/javascript">
    $( document ).ready(function() {
        let inputType= $('#inputType').val();
        if(inputType == "checkboxInput" || inputType == "radioInput" ||inputType == "dropdownInput")
        {
            $('.static').removeClass('d-none');
            $('.checkbox_input').removeClass('d-none');
        }
        
        showHideFields(inputType);

        $(document).on("change","#inputType", function(event)
        {
            let inputType = $(this).val();
            showHideFields(inputType);
        });

        $(document).on("click","#customFieldaddRowBtn", function(event)
        {
            $('.addRow').removeClass('d-none');
        });
    });

    function showHideFields(inputType){
        if(inputType == "textInput" || inputType == "multilineInput")
        {
            $('.text_input').removeClass('d-none');
            $('.addRow').addClass('d-none');
            $('.static').addClass('d-none');
        }else{
            $('.text_input').addClass('d-none');
        }
        if(inputType == "numericInput")
        {
            $('.numeric_input').removeClass('d-none');
            $('.addRow').addClass('d-none');
            $('.static').addClass('d-none');
        }else{
            $('.numeric_input').addClass('d-none');
        }
        if(inputType == "datepickerInput")
        {
            $('.static').addClass('d-none');
            $('.addRow').addClass('d-none');
        }
        if(inputType == "checkboxInput" || inputType == "radioInput" ||inputType == "dropdownInput")
        {
            $('.static').removeClass('d-none');
            $('.checkbox_input').removeClass('d-none');
        }else{
            $('.checkbox_input').addClass('d-none');
        }
        if(inputType == "fileInput")
        {
            $('.static').addClass('d-none');
            $('.addRow').addClass('d-none');
        }
    }
    
    customFieldAddRow = () => 
        {
            var divLength = $(".addRow").length;
            var rowLang = $("#rowLang").val();
            var count = divLength + 1;
            var newRow = `<div class="row mt-30 addRow d-none">
                            <div class="col-lg-6">
                                <div class="input-effect">
                                    <input class="primary-input form-control has-content" type="text" name="name_value[]" autocomplete="off"">
                                    <label>${rowLang} ${count}*</label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <button class="primary-btn icon-only fix-gr-bg" type="button" id="deleteCustRow">
                                    <span class="ti-trash"></span>
                                </button>
                            </div>
                        </div>`;
            $("#addCustRow").append(newRow);
    };
    
    $(document).on('click', '#deleteCustRow', function() 
    {
        $(this).parent().parent().remove();
    });
</script><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/customField/_custom_form.blade.php ENDPATH**/ ?>