<div class="container-fluid">
    <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'parentregistration/assign-section-store', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'name' => 'myForm'])); ?>

        <input type="hidden" name="id" value="<?php echo e(@$student->id); ?>">
        <div class="row">
            <div class="col-lg-12">
                <select class="niceSelect1 w-100 bb form-control <?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" name="section" id="sectionSelectStudent" >
                    <option data-display="<?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.section'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.section'); ?> *</option>
                        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $old_section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($old_section->id); ?>" <?php echo e($student->section_id == $old_section->id ? 'selected' : ''); ?> >
                            <?php echo e($old_section->section_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <!-- <div class="col-lg-12 text-center mt-40">
                <button class="primary-btn fix-gr-bg" id="save_button_sibling" type="button">
                    <span class="ti-check"></span>
                    save information
                </button>
            </div> -->
            <div class="col-lg-12 text-center mt-40">
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                    <button class="primary-btn fix-gr-bg submit" type="submit"> <?php echo app('translator')->get('lang.save'); ?> <?php echo app('translator')->get('lang.information'); ?></button>
                </div>
            </div>
        </div>
    <?php echo e(Form::close()); ?>

</div>
<script>
    if ($(".niceSelect1").length) {
        $(".niceSelect1").niceSelect();
    }
</script>
<?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/Modules/ParentRegistration/Resources/views/assign_section.blade.php ENDPATH**/ ?>