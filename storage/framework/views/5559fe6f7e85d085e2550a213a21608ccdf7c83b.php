<div class="white-box">


<div class="row">
    <div class="col-lg-12">
        <div id="accordion">
            <div class="card mt-10">
                <div class="card-header" id="pages">
                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <button class="btn btn-link cust-btn-link add_btn_link">
                            <?php echo app('translator')->get('lang.pages'); ?>
                        </button>
                    </h5>
                </div>
                <div id="collapseTwo" class="collapse" aria-labelledby="pages" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">
                                        <?php echo app('translator')->get('lang.pages'); ?> 
                                        <span class="text-danger">*</span></label>
                                    <select name="page[]" id="dPages" class="primary_select mb-15" multiple>
                                        <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($page->id); ?>"><?php echo e($page->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <spna id="elementError"></spna>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input type="checkbox" id="dPagesCheckbox" class="common-checkbox">
                                            <label for="dPagesCheckbox" class="mt-3"><?php echo app('translator')->get('lang.all'); ?> </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <?php if(env('APP_SYNC')==TRUE): ?>
                                                <button class="primary-btn fix-gr-bg submit_btn pull-right" title="Disable For Demo" data-toggle="tooltip" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.menu'); ?> 
                                                </button>
                                            <?php else: ?>
                                                <?php if(userPermission(651)): ?>
                                                <button id="add_page_btn" type="submit" class="primary-btn fix-gr-bg submit_btn pull-right" data-toggle="tooltip" title="" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.menu'); ?> 
                                                </button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="staticPages">
                    <h5 class="mb-0 collapsed create-title" data-toggle="collapse" data-target="#pages2" aria-expanded="false" aria-controls="collapseThree">
                        <button class="btn btn-link cust-btn-link add_btn_link">
                            <?php echo app('translator')->get('lang.static'); ?> <?php echo app('translator')->get('lang.pages'); ?>
                        </button>
                    </h5>
                </div>
                <div id="pages2" class="collapse" aria-labelledby="staticPages" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for=""><?php echo app('translator')->get('lang.pages'); ?> 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="static_pages[]" id="sPages" class="primary_select mb-15 e1" multiple>
                                        <?php $__currentLoopData = $static_pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $static_page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($static_page->id); ?>"><?php echo e($static_page->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input type="checkbox" id="sPagesCheckbox" class="common-checkbox">
                                            <label for="sPagesCheckbox" class="mt-3"><?php echo app('translator')->get('lang.all'); ?> </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <?php if(env('APP_SYNC')==TRUE): ?>
                                                <button class="primary-btn fix-gr-bg submit_btn pull-right" title="Disable For Demo" data-toggle="tooltip" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.menu'); ?> 
                                                </button>
                                            <?php else: ?>
                                                <?php if(userPermission(651)): ?>
                                                <button id="add_static_page_btn" type="submit" class="primary-btn fix-gr-bg submit_btn pull-right" data-toggle="tooltip" title="" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.menu'); ?> 
                                                </button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="course">
                    <h5 class="mb-0 collapsed create-title"  data-toggle="collapse" data-target="#pages6" aria-expanded="false" aria-controls="collapsePages">
                        <button class="btn btn-link cust-btn-link add_btn_link">
                            <?php echo app('translator')->get('lang.course'); ?>
                        </button>
                    </h5>
                </div>
                <div id="pages6" class="collapse" aria-labelledby="course" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">
                                        <?php echo app('translator')->get('lang.course'); ?>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="course[]" id="dCourse" class="primary_select mb-15 e1" multiple>
                                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($course->id); ?>"><?php echo e($course->title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input type="checkbox" id="courseCheckbox" class="common-checkbox">
                                            <label for="courseCheckbox" class="mt-3"><?php echo app('translator')->get('lang.all'); ?> </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <?php if(env('APP_SYNC')==TRUE): ?>
                                                <button class="primary-btn fix-gr-bg submit_btn pull-right" title="Disable For Demo" data-toggle="tooltip" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.menu'); ?> 
                                                </button>
                                            <?php else: ?>
                                                <?php if(userPermission(651)): ?>
                                                <button id="add_course_btn" type="submit" class="primary-btn fix-gr-bg submit_btn pull-right" data-toggle="tooltip" title="" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.menu'); ?> 
                                                </button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header" id="courseCategory">
                    <h5 class="mb-0 collapsed create-title"  data-toggle="collapse" data-target="#pages7" aria-expanded="false" aria-controls="collapsePages">
                        <button class="btn btn-link cust-btn-link add_btn_link">
                            <?php echo app('translator')->get('lang.course'); ?> <?php echo app('translator')->get('lang.category'); ?>
                        </button>
                    </h5>
                </div>
                <div id="pages7" class="collapse" aria-labelledby="courseCategory" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">
                                        <?php echo app('translator')->get('lang.category'); ?>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="course_category[]" id="dCourseCategory" class="primary_select mb-15 e1" multiple>
                                        <?php $__currentLoopData = $courseCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $courseCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($courseCategory->id); ?>"><?php echo e($courseCategory->category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input type="checkbox" id="courseCategoryCheckbox" class="common-checkbox">
                                            <label for="courseCategoryCheckbox" class="mt-3"><?php echo app('translator')->get('lang.all'); ?> </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <?php if(env('APP_SYNC')==TRUE): ?>
                                                <button class="primary-btn fix-gr-bg submit_btn pull-right" title="Disable For Demo" data-toggle="tooltip" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.menu'); ?> 
                                                </button>
                                            <?php else: ?>
                                                <?php if(userPermission(651)): ?>
                                                <button id="add_course_category_btn" type="submit" class="primary-btn fix-gr-bg submit_btn pull-right" data-toggle="tooltip" title="" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.menu'); ?> 
                                                </button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="news">
                    <h5 class="mb-0 collapsed create-title"  data-toggle="collapse" data-target="#pages3" aria-expanded="false" aria-controls="collapsePages">
                        <button class="btn btn-link cust-btn-link add_btn_link">
                            <?php echo app('translator')->get('lang.news'); ?>
                        </button>
                    </h5>
                </div>
                <div id="pages3" class="collapse" aria-labelledby="news" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">
                                        <?php echo app('translator')->get('lang.news'); ?>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="news[]" id="dNews" class="primary_select mb-15 e1" multiple>
                                        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $v_news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($v_news->id); ?>"><?php echo e($v_news->news_title); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input type="checkbox" id="dNewsCheckbox" class="common-checkbox">
                                            <label for="dNewsCheckbox" class="mt-3"><?php echo app('translator')->get('lang.all'); ?> </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <?php if(env('APP_SYNC')==TRUE): ?>
                                                <button class="primary-btn fix-gr-bg submit_btn pull-right" title="Disable For Demo" data-toggle="tooltip" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.menu'); ?> 
                                                </button>
                                            <?php else: ?>
                                                <?php if(userPermission(651)): ?>
                                                <button id="add_news_btn" type="submit" class="primary-btn fix-gr-bg submit_btn pull-right" data-toggle="tooltip" title="" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.menu'); ?> 
                                                </button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="newsCategory">
                    <h5 class="mb-0 collapsed create-title"  data-toggle="collapse" data-target="#pages4" aria-expanded="false" aria-controls="collapsePages">
                        <button class="btn btn-link cust-btn-link add_btn_link">
                            <?php echo app('translator')->get('lang.news'); ?> <?php echo app('translator')->get('lang.category'); ?>
                        </button>
                    </h5>
                </div>
                <div id="pages4" class="collapse" aria-labelledby="newsCategory" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="primary_input mb-15">
                                    <label class="primary_input_label" for="">
                                        <?php echo app('translator')->get('lang.category'); ?>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select name="news_category[]" id="dNewsCategory" multiple class="primary_select mb-15 e1" multiple>
                                        <?php $__currentLoopData = $news_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $news_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($news_category->id); ?>"><?php echo e($news_category->category_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <input type="checkbox" id="dNewsCategoryCheckbox" class="common-checkbox">
                                            <label for="dNewsCategoryCheckbox" class="mt-3"><?php echo app('translator')->get('lang.all'); ?> </label>
                                        </div>
                                        <div class="col-lg-8">
                                            <?php if(env('APP_SYNC')==TRUE): ?>
                                                <button class="primary-btn fix-gr-bg submit_btn pull-right" title="Disable For Demo" data-toggle="tooltip" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.menu'); ?> 
                                                </button>
                                            <?php else: ?>
                                                <?php if(userPermission(651)): ?>
                                                <button id="add_news_category_btn" type="submit" class="primary-btn fix-gr-bg submit_btn pull-right" data-toggle="tooltip" title="" data-original-title="">
                                                    <span class="ti-check"></span>
                                                    <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.menu'); ?> 
                                                </button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <span class="text-danger"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header" id="customLink">
                    <h5 class="mb-0 collapsed create-title"  data-toggle="collapse" data-target="#pages5" aria-expanded="false" aria-controls="collapsePages">
                        <button class="btn btn-link cust-btn-link add_btn_link">
                            <?php echo app('translator')->get('lang.custom_links'); ?>
                        </button>
                    </h5>
                </div>
                <div id="pages5" class="collapse" aria-labelledby="customLink" data-parent="#accordion">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class='input-effect'>
                                    <input class='primary-input form-control' type='text' id="tTitle" name='title' autocomplete='off'>
                                    <label><?php echo app('translator')->get('lang.title'); ?><span>*</span></label>
                                    <span class='focus-border'></span>
                                    <span class="text-danger" id="titleError"></span>
                                </div>
                                
                            </div>
                            <div class="col-lg-12 mt-40 mb-30">
                                <div class='input-effect'>
                                    <input class='primary-input form-control' type='text' id="tLink" name='link' autocomplete='off'>
                                    <label><?php echo app('translator')->get('lang.link'); ?></label>
                                    <span class='focus-border'></span>
                                </div>
                                <span class="text-danger" id="linkError"></span>
                            </div>
                            <div class="col-lg-12 text-center mt-10">
                                <?php if(env('APP_SYNC')==TRUE): ?>
                                    <button class="primary-btn fix-gr-bg submit_btn pull-right" title="Disable For Demo" data-toggle="tooltip" data-original-title="">
                                        <span class="ti-check"></span>
                                        <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.menu'); ?> 
                                    </button>
                                <?php else: ?>
                                    <?php if(userPermission(651)): ?>
                                    <button id="add_custom_link_btn" type="submit" class="primary-btn fix-gr-bg submit_btn" data-toggle="tooltip" title="" data-original-title="">
                                        <span class="ti-check"></span>
                                        <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.menu'); ?> 
                                    </button>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/frontEnd/headerMenuElementList.blade.php ENDPATH**/ ?>