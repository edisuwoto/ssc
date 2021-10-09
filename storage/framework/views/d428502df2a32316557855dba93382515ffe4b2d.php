
<?php $__env->startSection('title'); ?> 
    <?php echo app('translator')->get('lang.id_card'); ?> <?php echo app('translator')->get('lang.list'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.id_card'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.admin_section'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.id_card'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                    <a href="<?php echo e(route('create-id-card')); ?>" class="primary-btn small fix-gr-bg">
                        <span class="ti-plus pr-2"></span>
                            <?php echo app('translator')->get('lang.create'); ?> <?php echo app('translator')->get('lang.id_card'); ?>
                    </a>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.id_card'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="row  ">
                    <div class="col-lg-12">
                        <table id="table_id" class="display data-table school-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.sl'); ?></th>
                                    <th><?php echo app('translator')->get('lang.title'); ?></th>
                                    <th><?php echo app('translator')->get('lang.role'); ?></th>
                                    <th><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                    <?php $__currentLoopData = $id_cards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$id_card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e($id_card->title); ?></td>
                                        <td>
                                            <?php
                                                $role_id= ($id_card->role_id == 2) ? 2 : 0;
                                                $role_names= App\SmStudentIdCard::roleName($id_card->id);
                                            ?>
                                            <?php $__currentLoopData = $role_names; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php echo e($role_name->name); ?>,
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                    <?php echo app('translator')->get('lang.select'); ?>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#previewIdCard<?php echo e($id_card->id); ?>" href="#">
                                                        <?php echo app('translator')->get('lang.preview'); ?>
                                                    </a>
                                                    
                                                    <a class="dropdown-item" href="<?php echo e(route('student-id-card-edit',['id' => $id_card->id])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                    
                                                    <a class="dropdown-item" data-toggle="modal" data-target="#deleteIdCard<?php echo e($id_card->id); ?>" href="#">
                                                        <?php echo app('translator')->get('lang.delete'); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    
                                    <div class="modal fade admin-query" id="previewIdCard<?php echo e($id_card->id); ?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo e($id_card->title); ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
                                                        $roleId= json_decode($id_card->role_id);
                                                    ?>
                                                    <?php if(!in_array(3,$roleId)): ?>
                                                        <?php if($id_card->page_layout_style=='horizontal'): ?>
                                                            <div id="horizontal" style="margin: 0; padding: 0; font-family: 'Poppins', sans-serif; font-weight: 500;  font-size: 12px; line-height:1.02 ; color: #000">
                                                                <div class="horizontal__card" style="line-height:1.02; background-image: url(<?php echo e(@$id_card->background_img != "" ? asset(@$id_card->background_img) : asset('public/backEnd/id_card/img/vertical_bg.png')); ?>); width: <?php echo e(!empty($id_card->pl_width) ? $id_card->pl_width : 57.15); ?>mm; height: <?php echo e(!empty($id_card->pl_height) ? $id_card->pl_height : 88.89999999999999); ?>mm; margin: auto; background-size: 100% 100%; background-position: center center; position: relative; background-color: #fff;">
                                                                    <div class="horizontal_card_header" style="line-height:1.02; display: flex; align-items:center; justify-content:space-between; padding:8px 12px">
                                                                        <div class="logo__img logoImage hLogo" style="line-height:1.02; width: 80px; background-image: url(<?php echo e($id_card->logo !=''? asset($id_card->logo) : asset('public/backEnd/img/logo.png')); ?>);height: 30px; background-size: cover; background-repeat: no-repeat; background-position: center center;"></div>
                                                                        <div class="qr__img" style="line-height:1.02; width: 30px;">
                                                                            
                                                                        </div>
                                                                    </div>
                                
                                                                    <div class="horizontal_card_body" style="line-height:1.02; display:flex; padding-top:<?php echo e(!empty($id_card->t_space) ? $id_card->t_space : 2.5); ?>mm ; padding-bottom: <?php echo e(!empty($id_card->b_space) ? $id_card->b_space : 2.5); ?>mm ; padding-right: <?php echo e(!empty($id_card->r_space) ? $id_card->r_space : 3); ?>mm ; padding-left: <?php echo e(!empty($id_card->l_space) ? $id_card->l_space : 3); ?>mm ; flex-direction: column;">
                                                                        <div class="thumb hRoundImg hSize photo hImg hRoundImg" style="
                                                                        <?php if(@$id_card->user_photo_style=='round'): ?>
                                                                            <?php echo e("border-radius : 50%;"); ?>

                                                                        <?php endif; ?>
                                                                        background-image: url(<?php echo e(@$id_card->profile_image != "" ? asset(@$id_card->profile_image) : asset('public/backEnd/id_card/img/thumb.png')); ?>); background-size: cover; background-position: center center; background-repeat: no-repeat; line-height:1.02; width: <?php echo e(!empty($id_card->user_photo_width) ? $id_card->user_photo_width : 21.166666667); ?>mm; flex: 80px 0 0; height: <?php echo e(!empty($id_card->user_photo_height) ? $id_card->user_photo_height : 21.166666667); ?>mm; margin: auto; padding: 3px; align-content: center; justify-content: center; display: flex; border: 3px solid #fff;"></div>
                                                                        <div class="card_text" style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; flex-direction: column;">
                                                                            <div class="card_text_head " style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; margin-top:25px; margin-bottom:10px">
                                                                                <div class="card_text_left hId">
                                                                                    <?php if($id_card->student_name==1): ?>
                                                                                        <div id="hName">
                                                                                            <h4 style="line-height:1.02; margin-top: 0; margin-bottom: 0px; font-size:11px; font-weight:600 ; text-transform: uppercase; color: #2656a6;">InfixEdu</h4>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                    <?php if($id_card->admission_no==1 ): ?>
                                                                                        <div id="hAdmissionNumber">
                                                                                            <?php if($role_id==2): ?>
                                                                                                <h3 style="line-height:1.02; margin-top: 0; margin-bottom: 3px; font-size:10px; font-weight:500"><?php echo app('translator')->get('lang.admission_no'); ?> : 001</h3>
                                                                                            <?php else: ?> 
                                                                                                <h3 style="line-height:1.02; margin-top: 0; margin-bottom: 3px; font-size:10px; font-weight:500"><?php echo app('translator')->get('lang.id'); ?> : 001</h3>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                    <?php if(in_array(2,$roleId)): ?>
                                                                                        <?php if($id_card->class==1): ?>
                                                                                            <div id="hClass">
                                                                                                <h3 style="line-height:1.02; margin-top: 0; margin-bottom: 3px; font-size:10px; font-weight:500"><?php echo app('translator')->get('lang.class'); ?> : One (A)</h3>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                
                                                                            <div class="card_text_head hStudentName" style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; margin-bottom:10px"> 
                                                                                <div class="card_text_left">
                                                                                    <?php if($id_card->father_name ==1): ?>
                                                                                        <div id="hFatherName">
                                                                                            <h4 style="line-height:1.02; margin-top: 0; margin-bottom: 3px; font-size:10px; font-weight:500"><?php echo app('translator')->get('lang.father_name'); ?> : InfixEdu</h4>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                    <?php if($id_card->mother_name==1): ?>
                                                                                        <div id="hMotherName">
                                                                                            <h4 style="line-height:1.02; margin-top: 0; margin-bottom: 0; font-size:10px; font-weight:500"><?php echo app('translator')->get('lang.mother_name'); ?> : InfixEdu</h4>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                
                                                                            <div class="card_text_head " style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; margin-bottom:10px"> 
                                                                                <div class="card_text_left">
                                                                                    <?php if($id_card->dob==1): ?>
                                                                                        <div id="hDob">
                                                                                            <h3 style="line-height:1.02; margin-top: 0; margin-bottom: 3px; font-size:10px; font-weight:500"><?php echo app('translator')->get('lang.date_of_birth'); ?> :  Dec 25 , 2022</h3>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                    <?php if(in_array(2,$roleId)): ?>
                                                                                        <?php if($id_card->blood==1): ?>
                                                                                            <div id="hBloodGroup">
                                                                                                <h3 style="line-height:1.02; margin-top: 0; margin-bottom: 3px; font-size:10px; font-weight:500"><?php echo app('translator')->get('lang.blood_group'); ?> : B+</h3>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                
                                                                            <div class="card_text_head " style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; margin-top:5px"> 
                                                                                <?php if($id_card->student_address==1): ?>
                                                                                    <div class="card_text_left" id="hAddress">
                                                                                        <h3 style="line-height:1.02; margin-top: 0; margin-bottom: 5px; font-size:10px; font-weight:500; text-transform:uppercase">89/2 Panthapath, Dhaka 1215, Bangladesh</h3>
                                                                                        <h4 style="line-height:1.02; margin-top: 0; margin-bottom: 0; font-size:9px; text-transform: uppercase; font-weight:500"><?php echo app('translator')->get('lang.address'); ?></h4>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="horizontal_card_footer" style="line-height:1.02; text-align: right;">
                                                                        <div class="singnature_img signPhoto hSign" style="background-image:url(<?php echo e($id_card->signature != "" ? asset($id_card->signature) : asset('public/backEnd/id_card/img/Signature.png')); ?>);line-height:1.02; width: 50px; flex: 50px 0 0; margin-left: auto; position: absolute; right: 10px; bottom: 7px;height: 25px; background-size: cover; background-repeat: no-repeat; background-position: center center;"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                            
                                                        <?php if($id_card->page_layout_style=='vertical'): ?>
                                                            <div id="vertical"  style="margin: 0; padding: 0; font-family: 'Poppins', sans-serif;  font-size: 12px; line-height:1.02 ;">
                                                                <div class="vertical__card" style="line-height:1.02; background-image: url(<?php echo e(@$id_card->background_img != "" ? asset(@$id_card->background_img) : asset('public/backEnd/id_card/img/horizontal_bg.png')); ?>); width: <?php echo e(!empty($id_card->pl_width) ? $id_card->pl_width : 86); ?>mm; height: <?php echo e(!empty($id_card->pl_height) ? $id_card->pl_height : 54); ?>mm; margin: auto; background-size: 100% 100%; background-position: center center; position: relative;">
                                                                    <div class="horizontal_card_header" style="line-height:1.02; display: flex; align-items:center; justify-content:space-between; padding: 12px">
                                                                        <div class="logo__img logoImage vLogo" style="line-height:1.02; width: 80px; background-image: url(<?php echo e($id_card->logo !=''? asset($id_card->logo) : asset('public/backEnd/img/logo.png')); ?>);background-size: cover; height: 30px;background-position: center center; background-repeat: no-repeat;"></div>
                                                                        <div class="qr__img" style="line-height:1.02; width: 48px; position: absolute; right: 4px; top: 4px;">
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="vertical_card_body" style="line-height:1.02; display:flex; padding-top: <?php echo e(!empty($id_card->t_space) ? $id_card->t_space : 2.5); ?>mm; padding-bottom: <?php echo e(!empty($id_card->b_space) ? $id_card->b_space : 2.5); ?>mm; padding-right: <?php echo e(!empty($id_card->r_space) ? $id_card->r_space : 3); ?>mm ; padding-left: <?php echo e(!empty($id_card->l_space) ? $id_card->l_space : 3); ?>mm; align-items: center;">
                                                                        <div class="thumb vSize vSizeX photo vImg vRoundImg" style="background-image: url(<?php echo e(@$id_card->profile_image != "" ? asset(@$id_card->profile_image) : asset('public/backEnd/id_card/img/thumb.png')); ?>);
                                                                        <?php if(@$id_card->user_photo_style=='round'): ?>
                                                                            <?php echo e("border-radius : 50%;"); ?>

                                                                        <?php endif; ?>
                                                                        line-height:1.02; width: <?php echo e(!empty($id_card->user_photo_width) ? $id_card->user_photo_width : 13.229166667); ?>mm; height: <?php echo e(!empty($id_card->user_photo_height) ? $id_card->user_photo_height : 13.229166667); ?>mm; flex-basis: <?php echo e(!empty($id_card->user_photo_width) ? $id_card->user_photo_width : 13.229166667); ?>mm; flex-grow: 0; flex-shrink: 0; margin-right: 20px; background-size: cover; background-position: center center;"></div>
                                                                        <div class="card_text" style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; flex-direction: column;">
                                                                            <div class="card_text_head" style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; margin-bottom:5px"> 
                                                                                <div class="card_text_left vId">
                                                                                    <?php if($id_card->student_name==1): ?>
                                                                                        <div id="vName">
                                                                                            <h3 style="line-height:1.02; margin-top: 0; margin-bottom: 3px; font-size:11px; font-weight:600 ; text-transform: uppercase; color: #2656a6;">InfixEdu</h3>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                    <?php if($id_card->admission_no==1): ?>
                                                                                        <div id="vAdmissionNumber">
                                                                                            <?php if(in_array(2,$roleId)): ?>
                                                                                                <h4 style="line-height:1.02; margin-top: 0; margin-bottom: 3px; font-size:10px;"><?php echo app('translator')->get('lang.admission_no'); ?> : 001</h4>
                                                                                            <?php else: ?> 
                                                                                                <h4 style="line-height:1.02; margin-top: 0; margin-bottom: 3px; font-size:10px;"><?php echo app('translator')->get('lang.id'); ?> : 001</h4>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                    <?php if(in_array(2,$roleId)): ?>
                                                                                        <?php if($id_card->class==1): ?>
                                                                                            <div id="vClass">
                                                                                                <h4 style="line-height:1.02; margin-top: 0; margin-bottom: 0; font-size:10px;"><?php echo app('translator')->get('lang.class'); ?> :  One (A)</h4>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                                <div class="card_text_right">
                                                                                </br>
                                                                                    <?php if($id_card->dob==1): ?>
                                                                                        <div id="vDob">
                                                                                            <h3 style="line-height:1.02; margin-top: 0; margin-bottom: 3px; font-size:10px; font-weight:500;"><?php echo app('translator')->get('lang.date_of_birth'); ?> :   jan 21. 2030</h3>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                    <?php if(in_array(2,$roleId)): ?>
                                                                                        <?php if($id_card->blood==1): ?>
                                                                                            <div id="vBloodGroup">
                                                                                                <h3 style="line-height:1.02; margin-top: 0; margin-bottom: 3px; font-size:10px; font-weight:500;"><?php echo app('translator')->get('lang.blood_group'); ?> : B+</h3>
                                                                                            </div>
                                                                                        <?php endif; ?>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                
                                                                            <div class="card_text_head vStudentName" style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; margin-bottom:5px"> 
                                                                                <div class="card_text_left">
                                                                                </div>
                                                                            </div>
                                
                                                                            <div class="card_text_head " style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; margin-bottom:5px"> 
                                                                                <div class="card_text_left">
                                                                                    <?php if($id_card->father_name ==1): ?>
                                                                                        <div id="vFatherName">
                                                                                            <h3 style="line-height:1.02; margin-top: 0; margin-bottom: 3px; font-size:10px; font-weight:500"><?php echo app('translator')->get('lang.father_name'); ?> : InfixEdu</h3>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                    <?php if($id_card->mother_name==1): ?>
                                                                                        <div id="vMotherName">
                                                                                            <h3 style="line-height:1.02; margin-top: 0; margin-bottom: 3px; font-size:10px; font-weight:500"><?php echo app('translator')->get('lang.mother_name'); ?> : InfixEdu</h3>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                                <div class="card_text_right">
                                
                                                                                </div>
                                                                            </div>
                                                                            <div class="card_text_head " style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; margin-top:5px"> 
                                                                                <?php if($id_card->student_address==1): ?>
                                                                                <div class="card_text_left vAddress">
                                                                                    <h3 style="line-height:1.02; margin-top: 0; margin-bottom: 5px; font-size:10px; font-weight:500; text-transform:uppercase;">89/2 Panthapath, Dhaka 1215, Bangladesh </h3>
                                                                                    <h4 style="line-height:1.02; margin-top: 0; margin-bottom: 0; font-size:9px; text-transform: uppercase; font-weight:500"><?php echo app('translator')->get('lang.address'); ?></h4>
                                                                                </div>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="horizontal_card_footer" style="line-height:1.02; text-align: right;">
                                                                        <div class="singnature_img signPhoto vSign" style="background-image: url(<?php echo e($id_card->signature != "" ? asset($id_card->signature) : asset('public/backEnd/id_card/img/Signature.png')); ?>); line-height:1.02; width: 50px; flex: 50px 0 0; margin-left: auto; position: absolute; right: 10px; bottom: 7px; height: 25px; background-size: cover; background-repeat: no-repeat; background-position: center center;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php else: ?>
                                                        <?php if($id_card->page_layout_style=='horizontal'): ?>
                                                            <div id="gHorizontal" style="margin: 0; padding: 0; font-family: 'Poppins', sans-serif; font-weight: 500;  font-size: 12px; line-height:1.02 ; color: #000">
                                                                <div class="horizontal__card" style="line-height:1.02; background-image: url(<?php echo e(@$id_card->background_img != "" ? asset(@$id_card->background_img) : asset('public/backEnd/id_card/img/vertical_bg.png')); ?>); width: <?php echo e(!empty($id_card->pl_width) ? $id_card->pl_width : 55); ?>mm; height: <?php echo e(!empty($id_card->pl_height) ? $id_card->pl_height : 106); ?>mm; margin: auto; background-size: 100% 100%; background-position: center center; position: relative; background-color: #fff;">
                                                                    <div class="horizontal_card_header" style="line-height:1.02; display: flex; align-items:center; justify-content:space-between; padding:8px 12px">
                                                                        <div class="logo__img logoImage hLogo" style="line-height:1.02; width: 80px; background-image: url(<?php echo e($id_card->logo !=''? asset($id_card->logo) : asset('public/backEnd/img/logo.png')); ?>);height: 30px; background-size: cover; background-repeat: no-repeat; background-position: center center;"></div>
                                                                        <div class="qr__img" style="line-height:1.02; width: 30px;">
                                                                            
                                                                        </div>
                                                                    </div>
                                                            
                                                                    <div class="horizontal_card_body" style="line-height:1.02; display:block; padding-top:<?php echo e(!empty($id_card->t_space) ? $id_card->t_space : 2.5); ?>mm ; padding-bottom: <?php echo e(!empty($id_card->b_space) ? $id_card->b_space : 2.5); ?>mm ; padding-right: <?php echo e(!empty($id_card->r_space) ? $id_card->r_space : 3); ?>mm ; padding-left: <?php echo e(!empty($id_card->l_space) ? $id_card->l_space : 3); ?>mm; flex-direction: column;">
                                                                        <div class="thumb hSize photo hImg hRoundImg" style="
                                                                        <?php if(@$id_card->user_photo_style=='round'): ?>
                                                                            <?php echo e("border-radius : 50%;"); ?>

                                                                        <?php endif; ?>
                                                                         background-image: url(<?php echo e(@$id_card->profile_image != "" ? asset(@$id_card->profile_image) : asset('public/backEnd/id_card/img/thumb.png')); ?>);background-size: cover; background-position: center center; background-repeat: no-repeat; line-height:1.02; flex: 80px 0 0; width: <?php echo e(!empty($id_card->user_photo_width) ? $id_card->user_photo_width : 21.166666667); ?>mm; flex: 80px 0 0; height: <?php echo e(!empty($id_card->user_photo_height) ? $id_card->user_photo_height : 21.166666667); ?>mm; margin: auto;border-radius: 50%; padding: 3px; align-content: center; justify-content: center; display: flex; border: 3px solid #fff;"></div>
                                                                        <div class="card_text" style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; flex-direction: column;">
                                                                            <div class="card_text_head " style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; margin-top:25px; margin-bottom:10px">
                                                                                <div class="card_text_left hId">
                                                                                    <?php if($id_card->student_name==1): ?>
                                                                                        <div id="gHName">
                                                                                            <h4 style="line-height:1.02; margin-top: 0; margin-bottom: 0px; font-size:11px; font-weight:600 ; text-transform: uppercase; color: #2656a6;">InfixEdu</h4>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                            
                                                                            <div class="card_text_head hStudentName" style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; margin-bottom:10px"> 
                                                                                <div class="card_text_left">
                                                                                    
                                                                                    <?php if($id_card->phone_number == 1): ?>
                                                                                        <div id="hPhoneNumber">
                                                                                            <h4 style="line-height:1.02; margin-top: 0; margin-bottom: 3px; font-size:10px; font-weight:500">phone : 0123456789</h4>
                                                                                        </div>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                            
                                                                            <div class="card_text_head " style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; margin-bottom:10px"> 
                                                                                <div class="child__thumbs" style="display:flex; align-items: center; margin: 15px 0 20px 0; display: flex;
                                                                                    align-items: flex-start;
                                                                                    margin: 15px 0 2px 0;
                                                                                    justify-content: space-between;">
                                                                                    <div class="single__child" style="text-align: center; flex: 45px 0 0; ">
                                                                                        <div class="single__child__thumb" style=" background-image: url('<?php echo e(asset('public/backEnd/id_card/img/thumb.png')); ?>');background-size: cover; background-position: center center; background-repeat: no-repeat; line-height:1.02; width: 45px;
                                                                                        flex: 45px 0 0;
                                                                                        height: 46px; margin: auto;border-radius: 50%; padding: 3px; align-content: center; justify-content: center; display: flex; border: 3px solid #fff;">
                                                                                        </div>
                                                                                        <p style="font-size:12px; font-weight:400">infixedu</p>
                                                                                    </div>
                                                                                    <div class="single__child" style="text-align: center;flex: 45px 0 0;">
                                                                                        <div class="single__child__thumb" style=" background-image: url('<?php echo e(asset('public/backEnd/id_card/img/thumb.png')); ?>');background-size: cover; background-position: center center; background-repeat: no-repeat; line-height:1.02; width: 45px;
                                                                                        flex: 45px 0 0;
                                                                                        height: 46px; margin: auto;border-radius: 50%; padding: 3px; align-content: center; justify-content: center; display: flex; border: 3px solid #fff;">
                                                                                        </div>
                                                                                        <p style="font-size:12px; font-weight:400">infixedu</p>
                                                                                    </div>
                                                                                    <div class="single__child" style="text-align: center;flex: 45px 0 0;">
                                                                                        <div class="single__child__thumb" style=" background-image: url('<?php echo e(asset('public/backEnd/id_card/img/thumb.png')); ?>');background-size: cover; background-position: center center; background-repeat: no-repeat; line-height:1.02; width: 45px;
                                                                                        flex: 45px 0 0;
                                                                                        height: 46px; margin: auto;border-radius: 50%; padding: 3px; align-content: center; justify-content: center; display: flex; border: 3px solid #fff;">
                                                                                        </div>
                                                                                        <p style="font-size:12px; font-weight:400">infixedu</p>
                                                                                    </div>
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            <div class="card_text_head " style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; margin-top:5px"> 
                                                                                <?php if($id_card->student_address==1): ?>
                                                                                    <div class="card_text_left" id="gHAddress">
                                                                                        <h3 style="line-height:1.02; margin-top: 0; margin-bottom: 5px; font-size:10px; font-weight:500; text-transform:uppercase">89/2 Panthapath, Dhaka 1215, Bangladesh</h3>
                                                                                        <h4 style="line-height:1.02; margin-top: 0; margin-bottom: 0; font-size:9px; text-transform: uppercase; font-weight:500"><?php echo app('translator')->get('lang.address'); ?></h4>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="horizontal_card_footer" style="line-height:1.02; text-align: right;">
                                                                        <div class="singnature_img signPhoto hSign" style="background-image:url(<?php echo e($id_card->signature != "" ? asset($id_card->signature) : asset('public/backEnd/id_card/img/Signature.png')); ?>);line-height:1.02; width: 50px; flex: 50px 0 0; margin-left: auto; position: absolute; right: 10px; bottom: 7px;height: 25px; background-size: cover; background-repeat: no-repeat; background-position: center center;"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php if($id_card->page_layout_style=='vertical'): ?>
                                                            <div class="vertical__card" style="line-height:1.02; background-image: url(<?php echo e(@$id_card->background_img != "" ? asset(@$id_card->background_img) : asset('public/backEnd/id_card/img/horizontal_bg.png')); ?>); width: <?php echo e(!empty($id_card->pl_width) ? $id_card->pl_width : 106); ?>mm; height: <?php echo e(!empty($id_card->pl_height) ? $id_card->pl_height : 55); ?>mm; margin: auto; background-size: 100% 100%; background-position: center center; position: relative;">
                                                                <div class="horizontal_card_header" style="line-height:1.02; display: flex; align-items:center; justify-content:space-between; padding: 12px">
                                                                    <div class="logo__img logoImage vLogo" style="line-height:1.02; width: 80px; background-image: url(<?php echo e($id_card->logo !=''? asset($id_card->logo) : asset('public/backEnd/img/logo.png')); ?>);background-size: cover; height: 30px;background-position: center center; background-repeat: no-repeat;"></div>
                                                                    <div class="qr__img" style="line-height:1.02; width: 48px; position: absolute; right: 4px; top: 4px;">
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="vertical_card_body" style="line-height:1.02; display:flex; padding-top:<?php echo e(!empty($id_card->t_space) ? $id_card->t_space : 2.5); ?>mm ; padding-bottom: <?php echo e(!empty($id_card->b_space) ? $id_card->b_space : 2.5); ?>mm ; padding-right: <?php echo e(!empty($id_card->r_space) ? $id_card->r_space : 3); ?>mm ; padding-left: <?php echo e(!empty($id_card->l_space) ? $id_card->l_space : 3); ?>mm;  align-items: center;">
                                                                    <div class="thumb vSize vSizeX photo vImg vRoundImg" style="
                                                                    <?php if(@$id_card->user_photo_style=='round'): ?>
                                                                        <?php echo e("border-radius : 50%;"); ?>

                                                                    <?php endif; ?>
                                                                    background-image: url(<?php echo e(@$id_card->profile_image != "" ? asset(@$id_card->profile_image) : asset('public/backEnd/id_card/img/thumb.png')); ?>); line-height:1.02; width: <?php echo e(!empty($id_card->user_photo_width) ? $id_card->user_photo_width : 13.229166667); ?>mm; height: <?php echo e(!empty($id_card->user_photo_height) ? $id_card->user_photo_height : 13.229166667); ?>mm; flex-basis: <?php echo e(!empty($id_card->user_photo_width) ? $id_card->user_photo_width : 13.229166667); ?>mm; flex-grow: 0; flex-shrink: 0; margin-right: 20px; background-size: cover; background-position: center center;"></div>
                                                                    <div class="card_text" style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; flex-direction: column;">
                                                                        <div class="card_text_head " style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; margin-bottom:0px"> 
                                                                            <div class="card_text_left vId">
                                                                                <?php if($id_card->student_name==1): ?>
                                                                                    <div id="gVName">
                                                                                        <h3 style="line-height:1.02; margin-top: 0; margin-bottom: 3px; font-size:11px; font-weight:600 ; text-transform: uppercase; color: #2656a6;">InfixEdu</h3>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                            <div class="card_text_right">
                                                                                </br>
                                                                                <?php if($id_card->phone_number == 1): ?>
                                                                                    <div id="gVAddress">
                                                                                        <h3 style="line-height:1.02; margin-top: 0; margin-bottom: 3px; font-size:10px; font-weight:500;">Phone : 0123456789</h3>
                                                                                    </div>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="child__thumbs" style="display:flex; align-items: center; margin:  0px 0 0px 0; display: flex;
                                                                            align-items: flex-start;
                                                                            margin: 0px 0 0px 0;
                                                                            justify-content: start;">
                                                                            <div class="single__child" style="text-align: center; flex: 75px 0 0; ">
                                                                                <div class="single__child__thumb" style=" background-image: url('<?php echo e(asset('public/backEnd/id_card/img/thumb.png')); ?>');background-size: cover; background-position: center center; background-repeat: no-repeat; line-height:1.02; width: 45px;
                                                                                flex: 45px 0 0;
                                                                                height: 46px; margin: auto;border-radius: 50%; padding: 3px; align-content: center; justify-content: center; display: flex; border: 3px solid #fff;">
                                                                                </div>
                                                                                <p style="font-size:12px; font-weight:400; margin-bottom: 0;">infixedu</p>
                                                                            </div>
                                                                            <div class="single__child" style="text-align: center;flex: 75px 0 0;">
                                                                                <div class="single__child__thumb" style=" background-image: url('<?php echo e(asset('public/backEnd/id_card/img/thumb.png')); ?>');background-size: cover; background-position: center center; background-repeat: no-repeat; line-height:1.02; width: 45px;
                                                                                flex: 45px 0 0;
                                                                                height: 46px; margin: auto;border-radius: 50%; padding: 3px; align-content: center; justify-content: center; display: flex; border: 3px solid #fff;">
                                                                                </div>
                                                                                <p style="font-size:12px; font-weight:400; margin-bottom: 0;">infixedu</p>
                                                                            </div>
                                                                            <div class="single__child" style="text-align: center;flex: 75px 0 0;">
                                                                                <div class="single__child__thumb" style=" background-image: url('<?php echo e(asset('public/backEnd/id_card/img/thumb.png')); ?>');background-size: cover; background-position: center center; background-repeat: no-repeat; line-height:1.02; width: 45px;
                                                                                flex: 45px 0 0;
                                                                                height: 46px; margin: auto;border-radius: 50%; padding: 3px; align-content: center; justify-content: center; display: flex; border: 3px solid #fff;">
                                                                                </div>
                                                                                <p style="font-size:12px; font-weight:400; margin-bottom: 0;">infixedu</p>
                                                                            </div>
                                                                        </div>
                                                        
                                                                        <div class="card_text_head " style="line-height:1.02; display: flex; align-items: center; justify-content: space-between; width: 100%; margin-top:5px"> 
                                                                            <?php if($id_card->student_address==1): ?>
                                                                                <div class="card_text_left gVAddress">
                                                                                    <h3 style="line-height:1.02; margin-top: 0; margin-bottom: 5px; font-size:10px; font-weight:500; text-transform:uppercase;">89/2 Panthapath, Dhaka 1215, Bangladesh </h3>
                                                                                    <h4 style="line-height:1.02; margin-top: 0; margin-bottom: 0; font-size:9px; text-transform: uppercase; font-weight:500">Address</h4>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="horizontal_card_footer" style="line-height:1.02; text-align: right;">
                                                                    <div class="singnature_img signPhoto vSign" style="background-image: url(<?php echo e($id_card->signature != "" ? asset($id_card->signature) : asset('public/backEnd/id_card/img/Signature.png')); ?>); line-height:1.02; width: 50px; flex: 50px 0 0; margin-left: auto; position: absolute; right: 10px; bottom: 7px; height: 25px; background-size: cover; background-repeat: no-repeat; background-position: center center;">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    
                                    <div class="modal fade admin-query" id="deleteIdCard<?php echo e($id_card->id); ?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.id_card'); ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="text-center">
                                                        <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                                    </div>
                                                    <div class="mt-40 d-flex justify-content-between">
                                                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal">
                                                            <?php echo app('translator')->get('lang.cancel'); ?>
                                                        </button>
                                                        <?php echo e(Form::open(['route' =>'student-id-card-delete', 'method' => 'POST'])); ?>

                                                            <input type="hidden" name="id" value="<?php echo e($id_card->id); ?>">
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/admin/idCard/student_id_card_list.blade.php ENDPATH**/ ?>