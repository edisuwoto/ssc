<div class="white-box">
    <div class="add-visitor">
        <div class="row">
            <div class="col-lg-12">
                <div class="input-effect">
                    <input class="primary-input form-control<?php echo e($errors->has('title') ? ' is-invalid' : ''); ?>"
                        type="text" name="title" autocomplete="off" value="<?php echo e(isset($id_card)? $id_card->title: old('title')); ?>" id="title">
                    <label><?php echo app('translator')->get('lang.id_card_title'); ?> <span>*</span></label>
                    <span class="focus-border"></span>
                    <?php if($errors->has('title')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('title')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>

        <div class="row mt-25">
            <div class="col-lg-12">
                <div class="input-effect">
                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('page_layout_style') ? ' is-invalid' : ''); ?>" name="page_layout_style" id="pageLayoutStyle">
                        <option value="horizontal" <?php echo e(isset($id_card)? ($id_card->page_layout_style == "horizontal"? 'selected':''):''); ?>><?php echo app('translator')->get('lang.horizontal'); ?></option>
                        <option value="vertical" <?php echo e(isset($id_card)? ($id_card->page_layout_style == "vertical"? 'selected':''):''); ?>><?php echo app('translator')->get('lang.vertical'); ?></option>
                    </select>
                        <span class="focus-border"></span>
                        <?php if($errors->has('page_layout_style')): ?>
                        <span class="invalid-feedback invalid-select" role="alert">
                            <strong><?php echo e($errors->first('page_layout_style')); ?></strong>
                        </span>
                        <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="d-flex mt-25">
            <div class="row flex-grow-1 d-flex justify-content-between input-right-icon">
                <div class="col">
                    <div class="input-effect">
                        <input class="primary-input form-control<?php echo e($errors->has('background_img') ? ' is-invalid' : ''); ?>" type="text" id="backgroundImage" placeholder="<?php echo e(isset($id_card)? ($id_card->background_img != ""? getFilePath3($id_card->background_img): trans('lang.background').' '.trans('lang.image')):trans('lang.background').' '.trans('lang.image')); ?>"
                            readonly>
                        <span class="focus-border"></span>
                        <?php if($errors->has('background_img')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('background_img')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-auto">
                    <button class="primary-btn-small-input cust-margin" type="button">
                        <label class="primary-btn small fix-gr-bg" for="document_file_5"><?php echo app('translator')->get('lang.browse'); ?></label>
                        <input type="file" class="d-none" name="background_img" id="document_file_5" onchange="imageChangeWithBackFile(this)" value="<?php echo e(isset($id_card)? ($id_card->background_img != ""? getFilePath3($id_card->background_img):''): ''); ?>">
                    </button>
                </div>
            </div>
            <button class="primary-btn icon-only fix-gr-bg" type="button" id="deleteBackImg">
                <span class="ti-trash"></span>
            </button>
        </div>

        <div class="row mt-25">
            <div class="col-lg-12">
                <div class="input-effect">
                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('applicable_user') ? ' is-invalid' : ''); ?>" name="applicable_user[]" id="applicableUser">
                        <option data-display="<?php echo app('translator')->get('lang.applicable_user'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?>*</option>
                        <?php if(isset($id_card)): ?>
                            <?php
                                $applicableUsers = json_decode($id_card->role_id);
                            ?>
                                <option value="2" <?php echo e((in_array(2,$applicableUsers))? 'selected': ''); ?> selected><?php echo app('translator')->get('lang.student'); ?></option>
                                <option value="3" <?php echo e((in_array(3,$applicableUsers))? 'selected': ''); ?>><?php echo app('translator')->get('lang.guardian'); ?></option>
                                <option value="0" 
                                <?php if((!in_array(3,$applicableUsers)) && (!in_array(2,$applicableUsers))): ?>
                                    <?php echo e("selected"); ?> 
                                <?php endif; ?>
                                ><?php echo app('translator')->get('lang.staff'); ?></option>
                        <?php else: ?>
                            <option value="2"><?php echo app('translator')->get('lang.student'); ?></option>
                            <option value="3"><?php echo app('translator')->get('lang.guardian'); ?></option>
                            <option value="0"><?php echo app('translator')->get('lang.staff'); ?></option>
                        <?php endif; ?>
                    </select>
                        <div class="text-danger" id="applicableUserError"></div>
                        <span class="focus-border"></span>
                        <?php if($errors->has('applicable_user')): ?>
                        <span class="invalid-feedback invalid-select" role="alert">
                            <strong><?php echo e($errors->first('applicable_user')); ?></strong>
                        </span>
                        <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row mt-25 staffInfo 
            <?php if(isset($id_card)): ?>
                <?php if((!in_array(3,$applicableUsers)) && (!in_array(2,$applicableUsers))): ?>
                    <?php echo e("d-block"); ?>

                <?php else: ?>
                    <?php echo e("d-none"); ?>

                <?php endif; ?>
            <?php else: ?>
                <?php echo e("d-none"); ?>

            <?php endif; ?>
            ">
            <div class="col-lg-12">
                <label><?php echo app('translator')->get('lang.role'); ?>*</label><br> 
                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($role->id != 2 && $role->id != 3): ?>
                        <div class="">
                            <input type="checkbox" id="role_<?php echo e(@$role->id); ?>" class="common-checkbox" value="<?php echo e(@$role->id); ?>" name="role[]"
                            <?php echo e(isset($id_card)? (in_array($role->id,$applicableUsers)? 'checked':''):''); ?>>
                            <label for="role_<?php echo e(@$role->id); ?>"><?php echo e(@$role->name); ?></label>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                <?php if($errors->has('section')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('section')); ?></strong>
                    </span>
                <?php endif; ?>
            </div>
        </div>

        <div class="row mt-25">
            <div class="col-lg-6">
                <div class="input-effect">
                    <input class="primary-input form-control<?php echo e($errors->has('pl_width') ? ' is-invalid' : ''); ?>" type="text" name="pl_width" value="<?php echo e(isset($id_card)? $id_card->pl_width: old('pl_width')); ?>" id="plWidth" autocomplete="off">
                    <label><?php echo app('translator')->get('lang.page_layout'); ?> <?php echo app('translator')->get('lang.width'); ?> <span id="pWidth">(<?php echo app('translator')->get('lang.default'); ?> 57 mm)</span></label>
                    <span class="focus-border"></span>
                    <?php if($errors->has('pl_width')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('pl_width')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-effect">
                    <input class="primary-input form-control<?php echo e($errors->has('pl_height') ? ' is-invalid' : ''); ?>" type="text" name="pl_height" value="<?php echo e(isset($id_card)? $id_card->pl_height: old('pl_height')); ?>" id="plHeight" autocomplete="off">
                    <label><?php echo app('translator')->get('lang.page_layout'); ?> <?php echo app('translator')->get('lang.height'); ?> <span id="pHeight">(<?php echo app('translator')->get('lang.default'); ?> 89 mm)</span></label>
                    <span class="focus-border"></span>
                    <?php if($errors->has('pl_height')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('pl_height')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="d-flex mt-25">
            <div class="row flex-grow-1 d-flex justify-content-between input-right-icon">
                <div class="col">
                    <div class="input-effect">
                        <input class="primary-input form-control<?php echo e($errors->has('profile_image') ? ' is-invalid' : ''); ?>" type="text" id="profileImage" placeholder="<?php echo e(isset($id_card)? ($id_card->profile_image != ""? getFilePath3($id_card->profile_image): trans('lang.profile').' '.trans('lang.image')):trans('lang.profile').' '.trans('lang.image')); ?>"
                            readonly>
                        <span class="focus-border"></span>
                        <?php if($errors->has('profile_image')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('profile_image')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-auto">
                    <button class="primary-btn-small-input cust-margin" type="button">
                        <label class="primary-btn small fix-gr-bg" for="document_file_6"><?php echo app('translator')->get('lang.browse'); ?></label>
                        <input type="file" class="d-none" name="profile_image" id="document_file_6" onchange="imageChangeWithFile(this,'.photo')" value="<?php echo e(isset($id_card)? ($id_card->profile_image != ""? getFilePath3($id_card->profile_image):''): ''); ?>">
                    </button>
                </div>
            </div>
            <button class="primary-btn icon-only fix-gr-bg" type="button" id="deleteProImg">
                <span class="ti-trash"></span>
            </button>
        </div>

        <div class="row mt-25">
            <div class="col-lg-4 d-flex">
                <p class="text-uppercase fw-500 mb-10"> <?php echo app('translator')->get('lang.user'); ?> <?php echo app('translator')->get('lang.photo'); ?> <?php echo app('translator')->get('lang.style'); ?> </p>
            </div>
            <div class="col-lg-8">
                <div class="input-effect">
                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('user_photo_style') ? ' is-invalid' : ''); ?>" name="user_photo_style" id="userPhotoStyle">
                        <option data-display="<?php echo app('translator')->get('lang.user'); ?> <?php echo app('translator')->get('lang.photo'); ?> <?php echo app('translator')->get('lang.style'); ?>" value=""><?php echo app('translator')->get('lang.select'); ?></option>
                        <option value="squre" <?php echo e(isset($id_card)? ($id_card->user_photo_style == "squre"? 'selected':''):''); ?>><?php echo app('translator')->get('lang.squre'); ?></option>
                        <option value="round" <?php echo e(isset($id_card)? ($id_card->user_photo_style == "round"? 'selected':''):''); ?>><?php echo app('translator')->get('lang.round'); ?></option>
                    </select>
                    <div class="text-danger" id="applicableUserError"></div>
                    <span class="focus-border"></span>
                    <?php if($errors->has('user_photo_style')): ?>
                    <span class="invalid-feedback invalid-select" role="alert">
                        <strong><?php echo e($errors->first('user_photo_style')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row mt-25">
            <div class="col-lg-6">
                <div class="input-effect">
                    <input class="primary-input form-control<?php echo e($errors->has('user_photo_width') ? ' is-invalid' : ''); ?>" type="text" id="userPhotoWidth" name="user_photo_width" value="<?php echo e(isset($id_card)? $id_card->user_photo_width: old('user_photo_width')); ?>" autocomplete="off">
                    <label><?php echo app('translator')->get('lang.user'); ?> <?php echo app('translator')->get('lang.photo'); ?> <?php echo app('translator')->get('lang.size'); ?> <?php echo app('translator')->get('lang.width'); ?> <span id="profileWidth">(<?php echo app('translator')->get('lang.default'); ?> 21 mm)</span></label>
                    <span class="focus-border"></span>
                    <?php if($errors->has('user_photo_width')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('user_photo_width')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-effect">
                    <input class="primary-input form-control<?php echo e($errors->has('user_photo_height') ? ' is-invalid' : ''); ?>" type="text" id="userPhotoheight" name="user_photo_height" value="<?php echo e(@$id_card->user_photo_height); ?>" autocomplete="off">
                    <label><?php echo app('translator')->get('lang.user'); ?> <?php echo app('translator')->get('lang.photo'); ?> <?php echo app('translator')->get('lang.size'); ?> <?php echo app('translator')->get('lang.height'); ?> <span id="profileHeight">(<?php echo app('translator')->get('lang.default'); ?> 21 mm)</span></label>
                    <span class="focus-border"></span>
                    <?php if($errors->has('user_photo_height')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('user_photo_height')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row mt-25">
            <div class="col-lg-4">
                <span><?php echo app('translator')->get('lang.layout_spacing'); ?></span>
            </div>
            <div class="col-lg-4">
                <div class="input-effect">
                    <input class="primary-input form-control<?php echo e($errors->has('t_space') ? ' is-invalid' : ''); ?>" type="text" id="tSpace" name="t_space" value="<?php echo e(isset($id_card)? $id_card->t_space: old('t_space')); ?>" autocomplete="off">
                    <label><?php echo app('translator')->get('lang.top_space'); ?><span> (<?php echo app('translator')->get('lang.default'); ?> 2.5 mm)</span></label>
                    <span class="focus-border"></span>
                    <?php if($errors->has('t_space')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('t_space')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="input-effect">
                    <input class="primary-input form-control<?php echo e($errors->has('b_space') ? ' is-invalid' : ''); ?>" type="text" id="bSpace" name="b_space" value="<?php echo e(isset($id_card)? $id_card->b_space: old('b_space')); ?>" autocomplete="off">
                    <label><?php echo app('translator')->get('lang.bottom_space'); ?> <span>(<?php echo app('translator')->get('lang.default'); ?> 2.5 mm)</span></label>
                    <span class="focus-border"></span>
                    <?php if($errors->has('b_space')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('b_space')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <div class="row mt-25">
            <div class="col-lg-4">

            </div>
            <div class="col-lg-4">
                <div class="input-effect">
                    <input class="primary-input form-control<?php echo e($errors->has('l_space') ? ' is-invalid' : ''); ?>" type="text" id="lSpace" name="l_space" value="<?php echo e(isset($id_card)? $id_card->l_space: old('l_space')); ?>" autocomplete="off">
                    <label><?php echo app('translator')->get('lang.left_space'); ?> (<?php echo app('translator')->get('lang.default'); ?> 3 mm)</label>
                    <span class="focus-border"></span>
                    <?php if($errors->has('l_space')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('l_space')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="input-effect">
                    <input class="primary-input form-control<?php echo e($errors->has('r_space') ? ' is-invalid' : ''); ?>" type="text" id="rSpace" name="r_space" value="<?php echo e(isset($id_card)? $id_card->r_space: old('r_space')); ?>" autocomplete="off">
                    <label><?php echo app('translator')->get('lang.right_space'); ?> (<?php echo app('translator')->get('lang.default'); ?> 3 mm)</label>
                    <span class="focus-border"></span>
                    <?php if($errors->has('r_space')): ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($errors->first('r_space')); ?></strong>
                    </span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="d-flex mt-25">
            <div class="row flex-grow-1 d-flex justify-content-between input-right-icon">
                <div class="col">
                    <div class="input-effect">
                        <input class="primary-input form-control<?php echo e($errors->has('logo') ? ' is-invalid' : ''); ?>" type="text" id="placeholderFileThreeName" placeholder="<?php echo e(isset($id_card)? ($id_card->logo != ""? getFilePath3($id_card->logo): trans('lang.logo').' *'):trans('lang.logo') .' *'); ?>"
                            readonly>
                        <span class="focus-border"></span>
                        <?php if($errors->has('logo')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('logo')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-auto">
                    <button class="primary-btn-small-input cust-margin" type="button">
                        <label class="primary-btn small fix-gr-bg" for="document_file_3"><?php echo app('translator')->get('lang.browse'); ?></label>
                        <input type="file" class="d-none" name="logo" id="document_file_3" onchange="logoImageChangeWithFile(this,'.logoImage')" value="<?php echo e(isset($id_card)? ($id_card->logo != ""? getFilePath3($id_card->logo):''): ''); ?>">
                    </button>
                </div>
            </div>
            <button class="primary-btn icon-only fix-gr-bg" type="button" id="deleteLogoImg">
                <span class="ti-trash"></span>
            </button>
        </div>

        <div class="d-flex mt-25">
            <div class="row flex-grow-1 d-flex justify-content-between input-right-icon">
                <div class="col">
                    <div class="input-effect">
                        <input class="primary-input form-control<?php echo e($errors->has('signature') ? ' is-invalid' : ''); ?>" type="text" id="placeholderFileFourName" placeholder="<?php echo e(isset($id_card)? ($id_card->signature != ""? getFilePath3($id_card->signature):trans('lang.signiture').' *'):trans('lang.signiture'). ' *'); ?>"
                            readonly>
                        <span class="focus-border"></span>
                        <?php if($errors->has('signature')): ?>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php echo e($errors->first('signature')); ?></strong>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-auto">
                    <button class="primary-btn-small-input cust-margin" type="button">
                        <label class="primary-btn small fix-gr-bg" for="document_file_4"><?php echo app('translator')->get('lang.browse'); ?></label>
                        <input type="file" class="d-none" name="signature" id="document_file_4" onchange="signatureImageChangeWithFile(this,'.signPhoto')" value="<?php echo e(isset($id_card)? ($id_card->signature != ""? getFilePath3($id_card->signature):''): ''); ?>">
                    </button>
                </div>
            </div>
            <button class="primary-btn icon-only fix-gr-bg" type="button" id="deleteSignImg">
                <span class="ti-trash"></span>
            </button>
        </div>

        <div class="row mt-25 admissionNo">
            <div class="col-lg-4 d-flex">
                <p class="text-uppercase fw-500 mb-10 text"><?php echo app('translator')->get('lang.admission_no'); ?></p>
            </div>
            <div class="col-lg-8">
                <div class="d-flex radio-btn-flex ml-40">
                    <div class="mr-30">
                        <input type="radio" name="admission_no" id="id_roll_yes" value="1" class="common-radio relationButton" onclick="idRoll('1')" <?php echo e(isset($id_card)? ($id_card->admission_no == 1? 'checked': ''):'checked'); ?>>
                        <label for="id_roll_yes"><?php echo app('translator')->get('lang.yes'); ?></label>
                    </div>
                    <div class="mr-30">
                        <input type="radio" name="admission_no" id="id_roll_no" value="0" class="common-radio relationButton" onclick="idRoll('0')" <?php echo e(isset($id_card)? ($id_card->admission_no == 0? 'checked': ''):''); ?>>
                        <label for="id_roll_no"><?php echo app('translator')->get('lang.none'); ?></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-25">
            <div class="col-lg-4 d-flex">
                <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.name'); ?> </p>
            </div>
            <div class="col-lg-8">
                <div class="d-flex radio-btn-flex ml-40">
                    <div class="mr-30">
                        <input type="radio" name="student_name" id="student_name_yes" value="1" class="common-radio relationButton" onclick="studentName('1')" <?php echo e(isset($id_card)? ($id_card->student_name == 1? 'checked': ''):'checked'); ?>>
                        <label for="student_name_yes"><?php echo app('translator')->get('lang.yes'); ?></label>
                    </div>
                    <div class="mr-30">
                        <input type="radio" name="student_name" id="student_name_no" value="0" class="common-radio relationButton" onclick="studentName('0')" <?php echo e(isset($id_card)? ($id_card->student_name == 0? 'checked': ''):''); ?>>
                        <label for="student_name_no"><?php echo app('translator')->get('lang.none'); ?></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-25 classHide">
            <div class="col-lg-4 d-flex">
                <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.class'); ?> </p>
            </div>
            <div class="col-lg-8">
                <div class="d-flex radio-btn-flex ml-40">
                    <div class="mr-30">
                        <input type="radio" name="class" id="class_yes" value="1" class="common-radio relationButton" onclick="IDclass('1')" <?php echo e(isset($id_card)? ($id_card->class == 1? 'checked': ''):'checked'); ?>>
                        <label for="class_yes"><?php echo app('translator')->get('lang.yes'); ?></label>
                    </div>
                    <div class="mr-30">
                        <input type="radio" name="class" id="class_no" value="0" class="common-radio relationButton" onclick="IDclass('0')" <?php echo e(isset($id_card)? ($id_card->class == 0? 'checked': ''):''); ?>>
                        <label for="class_no"><?php echo app('translator')->get('lang.none'); ?></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-25 fatherName">
            <div class="col-lg-4 d-flex">
                <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.father'); ?> <?php echo app('translator')->get('lang.name'); ?></p>
            </div>
            <div class="col-lg-8">
                <div class="d-flex radio-btn-flex ml-40">
                    <div class="mr-30">
                        <input type="radio" name="father_name" id="father_name_yes" value="1" class="common-radio relationButton" onclick="fatherName('1')" <?php echo e(isset($id_card)? ($id_card->father_name == 1? 'checked': ''):'checked'); ?>>
                        <label for="father_name_yes"><?php echo app('translator')->get('lang.yes'); ?></label>
                    </div>
                    <div class="mr-30">
                        <input type="radio" name="father_name" id="father_name_no" value="0" class="common-radio relationButton" onclick="fatherName('0')" <?php echo e(isset($id_card)? ($id_card->father_name == 0? 'checked': ''):''); ?>>
                        <label for="father_name_no"><?php echo app('translator')->get('lang.none'); ?></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-25 motherName">
            <div class="col-lg-4 d-flex">
                <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.mother'); ?> <?php echo app('translator')->get('lang.name'); ?></p>
            </div>
            <div class="col-lg-8">
                <div class="d-flex radio-btn-flex ml-40">
                    <div class="mr-30">
                        <input type="radio" name="mother_name" id="mother_name_yes" value="1" class="common-radio relationButton" onclick="motherName('1')" <?php echo e(isset($id_card)? ($id_card->mother_name == 1? 'checked': ''):'checked'); ?>>
                        <label for="mother_name_yes"><?php echo app('translator')->get('lang.yes'); ?></label>
                    </div>
                    <div class="mr-30">
                        <input type="radio" name="mother_name" id="mother_name_no" value="0" class="common-radio relationButton" onclick="motherName('0')" <?php echo e(isset($id_card)? ($id_card->mother_name == 0? 'checked': ''):''); ?>>
                        <label for="mother_name_no"><?php echo app('translator')->get('lang.none'); ?></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-25">
            <div class="col-lg-4 d-flex">
                <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.address'); ?></p>
            </div>
            <div class="col-lg-8">
                <div class="d-flex radio-btn-flex ml-40">
                    <div class="mr-30">
                        <input type="radio" name="student_address" id="address_yes" value="1" class="common-radio relationButton" onclick="addRess('1')" <?php echo e(isset($id_card)? ($id_card->student_address == 1? 'checked': ''):'checked'); ?>>
                        <label for="address_yes"><?php echo app('translator')->get('lang.yes'); ?></label>
                    </div>
                    <div class="mr-30">
                        <input type="radio" name="student_address" id="address_no" value="0" class="common-radio relationButton" onclick="addRess('0')" <?php echo e(isset($id_card)? ($id_card->student_address == 0? 'checked': ''):''); ?>>
                        <label for="address_no"><?php echo app('translator')->get('lang.none'); ?></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-25 mobile <?php echo e((@$id_card->phone_number ==0)? 'd-none':''); ?>">
            <div class="col-lg-4 d-flex">
                <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.phone'); ?></p>
            </div>
            <div class="col-lg-8">
                <div class="d-flex radio-btn-flex ml-40">
                    <div class="mr-30">
                        <input type="radio" name="phone_number" id="phone_yes" value="1" class="common-radio relationButton" onclick="phoneNumber('1')" <?php echo e(isset($id_card)? ($id_card->phone_number == 1? 'checked': ''):'checked'); ?>>
                        <label for="phone_yes"><?php echo app('translator')->get('lang.yes'); ?></label>
                    </div>
                    <div class="mr-30">
                        <input type="radio" name="phone_number" id="phone_no" value="0" class="common-radio relationButton" onclick="phoneNumber('0')" <?php echo e(isset($id_card)? ($id_card->phone_number == 0? 'checked': ''):''); ?>>
                        <label for="phone_no"><?php echo app('translator')->get('lang.none'); ?></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-25 dateOfBirth">
            <div class="col-lg-4 d-flex">
                <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.date_of_birth'); ?></p>
            </div>
            <div class="col-lg-8">
                <div class="d-flex radio-btn-flex ml-40">
                    <div class="mr-30">
                        <input type="radio" name="dob" id="dob_yes" value="1" class="common-radio relationButton" onclick="dOB('1')"  <?php echo e(isset($id_card)? ($id_card->dob == 1? 'checked': ''):'checked'); ?>>
                        <label for="dob_yes"><?php echo app('translator')->get('lang.yes'); ?></label>
                    </div>
                    <div class="mr-30">
                        <input type="radio" name="dob" id="dob_no" value="0" class="common-radio relationButton" onclick="dOB('0')" <?php echo e(isset($id_card)? ($id_card->dob == 0? 'checked': ''):''); ?>>
                        <label for="dob_no"><?php echo app('translator')->get('lang.none'); ?></label>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-25 bloodGroup">
            <div class="col-lg-4 d-flex">
                <p class="text-uppercase fw-500 mb-10"><?php echo app('translator')->get('lang.blood_group'); ?></p>
            </div>
            <div class="col-lg-8">
                <div class="d-flex radio-btn-flex ml-40">
                    <div class="mr-30">
                        <input type="radio" name="blood" id="blood_yes" value="1" class="common-radio relationButton" onclick="bloodGroup('1')" <?php echo e(isset($id_card)? ($id_card->blood == 1? 'checked': ''):'checked'); ?>>
                        <label for="blood_yes"><?php echo app('translator')->get('lang.yes'); ?></label>
                    </div>
                    <div class="mr-30">
                        <input type="radio" name="blood" id="blood_no" value="0" class="common-radio relationButton" onclick="bloodGroup('0')" <?php echo e(isset($id_card)? ($id_card->blood == 0? 'checked': ''):''); ?>>
                        <label for="blood_no"><?php echo app('translator')->get('lang.none'); ?></label>
                    </div>
                </div>
            </div>
        </div>

        <?php 
          $tooltip = "";
          if(userPermission(46)){
                $tooltip = "";
            }else{
                $tooltip = "You have no permission to add";
            }
        ?>
        <div class="row mt-40">
            <div class="col-lg-12 text-center">
                <button class="primary-btn fix-gr-bg submit savaIdCard" type="submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                    <span class="ti-check"></span>
                    <?php if(isset($id_card)): ?>
                        <?php echo app('translator')->get('lang.update'); ?>
                    <?php else: ?>
                        <?php echo app('translator')->get('lang.save'); ?>
                    <?php endif; ?>
                <?php echo app('translator')->get('lang.id_card'); ?>
                </button>
            </div>
        </div>
    </div>
</div><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/admin/idCard/form_id_card.blade.php ENDPATH**/ ?>