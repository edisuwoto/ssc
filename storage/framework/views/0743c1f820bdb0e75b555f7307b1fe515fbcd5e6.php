
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.leave_define'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php if(isset($leave_define)): ?>
    <?php if( is_null($staff) ): ?> 
        <style>
            #selectStaffsDiv{
                display: none;
            }
            .forStudentWrapper{
                display:block;
            }
        </style>
    <?php endif; ?>
    <?php if( is_null($student)): ?> 
        <style>
            #selectStaffsDiv{
                display: block;
            }
            .forStudentWrapper{
                display:none;
            }
        </style>
    <?php endif; ?>
<?php else: ?> 
<style type="text/css">
    #selectStaffsDiv, .forStudentWrapper{
        display: none;
    }
</style>
<?php endif; ?> 
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.leave_define'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.leave'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.leave_define'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <?php if(isset($leave_define)): ?>
            <?php if(userPermission(200)): ?>  
                <div class="row">
                    <div class="offset-lg-10 col-lg-2 text-right col-md-12 mb-20">
                        <a href="<?php echo e(route('leave-define')); ?>" class="primary-btn small fix-gr-bg">
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
                            <h3 class="mb-30">
                                <?php if(isset($leave_define)): ?>
                                    <?php echo app('translator')->get('lang.edit'); ?>
                                <?php else: ?>
                                    <?php echo app('translator')->get('lang.add'); ?>
                                <?php endif; ?>
                                    <?php echo app('translator')->get('lang.leave_define'); ?>
                            </h3>
                        </div>
                            <?php if(isset($leave_define)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => array('leave-define-update',$leave_define->id), 'method' => 'PUT', 'enctype' => 'multipart/form-data'])); ?>

                            <?php else: ?>
                                <?php if(userPermission(200)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'leave-define',
                                'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                <?php endif; ?>
                            <?php endif; ?>
                            <input type="hidden" name="id" value="<?php echo e(isset($leave_define)? $leave_define->id:''); ?>">
                        <div class="white-box">
                            <div class="add-visitor">
                                <div class="row">
                                    <div class="col-lg-12 mb-30">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('member_type') ? ' is-invalid' : ''); ?>" name="member_type" id="member_type">
                                            <option data-display=" <?php echo app('translator')->get('lang.select_role'); ?> *" value=""><?php echo app('translator')->get('lang.select_role'); ?> *</option>
                                                <?php if(isset($leave_define)): ?>
                                                    <?php if(! is_null($student)): ?> 
                                                        <option value="<?php echo e(@$student->role_id); ?>" selected ><?php echo e(@$student->roles->name); ?></option>
                                                    <?php endif; ?>

                                                    <?php if(! is_null($staff)): ?> 
                                                        <option value="<?php echo e(@$staff->role_id); ?>" selected><?php echo e(@$staff->roles->name); ?></option>
                                                    <?php endif; ?>
                                                <?php else: ?> 
                                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($value->id); ?>" ><?php echo e($value->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                        </select>
                                        <?php if($errors->has('member_type')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('member_type')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="forStudentWrapper col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-12 mb-30">
                                                <select class="w-100 bb niceSelect form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                                    <option data-display="<?php echo app('translator')->get('lang.select_class'); ?>" value=""><?php echo app('translator')->get('lang.select_class'); ?></option>
                                                    <?php if(! isset($leave_define)): ?>
                                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($class->id); ?>"  <?php echo e(( old("class") == $class->id ? "selected":"")); ?>><?php echo e($class->class_name); ?></option>    
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <option value="<?php echo e(@$student->class_id); ?>"  selected }}><?php echo e(@$student->className->class_name); ?></option>
                                                    <?php endif; ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-12 mb-30" id="select_section__member_div">
                                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section_member" name="section">
                                                    <option data-display="<?php echo app('translator')->get('lang.select_section'); ?>" value=""><?php echo app('translator')->get('lang.select_section'); ?></option>
                                                    <?php if(isset($leave_define)): ?>
                                                        <option value="<?php echo e(@$student->user_id); ?>"  selected ><?php echo e(@$student->section->section_name); ?></option>
                                                    <?php endif; ?>
                                                </select>
                                                <div class="pull-right loader loader_style" id="select_section_loader">
                                                    <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                                </div>
                                            </div>
                                            <div class="col-lg-12 mb-30" id="select_student_div">
                                                <select class="w-100 bb niceSelect form-control<?php echo e($errors->has('student') ? ' is-invalid' : ''); ?>" id="select_student" name="student">
                                                    <option data-display="<?php echo app('translator')->get('lang.select_student'); ?> " value=""><?php echo app('translator')->get('lang.select_student'); ?></option>
                                                    <?php if(isset($leave_define)): ?>
                                                        <option value="<?php echo e(@$student->user_id); ?>"  selected ><?php echo e(@$student->full_name); ?></option>
                                                    <?php endif; ?>
                                                </select>
                                                <div class="pull-right loader loader_style" id="select_student_loader">
                                                    <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-30" id="selectStaffsDiv">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('staff_id') ? ' is-invalid' : ''); ?>" name="staff" id="selectStaffs">
                                            <option data-display="<?php echo app('translator')->get('lang.name'); ?> " value=""><?php echo app('translator')->get('lang.name'); ?> </option>
                                            <?php if(! isset($leave_define)): ?>
                                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($value->id); ?>" ><?php echo e($value->full_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php else: ?>
                                                <option value="<?php echo e(@$staff->user_id); ?>" selected ><?php echo e(@$staff->full_name); ?></option>
                                            <?php endif; ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('leave_type') ? ' is-invalid' : ''); ?>" name="leave_type">
                                            <option data-display="<?php echo app('translator')->get('lang.leave_type'); ?>  *" value=""><?php echo app('translator')->get('lang.leave_type'); ?> *</option>
                                            <?php $__currentLoopData = $leave_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($leave_type->id); ?>" <?php echo e(isset($leave_define)? ($leave_define->type_id == $leave_type->id? 'selected':''):''); ?>><?php echo e($leave_type->type); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('leave_type')): ?>
                                        <span class="invalid-feedback invalid-select" role="alert">
                                            <strong><?php echo e($errors->first('leave_type')); ?></strong>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-lg-12">
                                        <div class="input-effect">
                                            <input class="primary-input form-control<?php echo e($errors->has('days') ? ' is-invalid' : ''); ?>" type="text" name="days" autocomplete="off" value="<?php echo e(isset($leave_define)? $leave_define->days:''); ?>">
                                            <label><?php echo app('translator')->get('lang.days'); ?> <span>*</span> </label>
                                            <span class="focus-border"></span>
                                            <?php if($errors->has('days')): ?>
                                            <span class="invalid-feedback" role="alert">
                                                <strong><?php echo e($errors->first('days')); ?></strong>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                 <?php
                                  $tooltip = "";
                                    if(userPermission(309) ){
                                            $tooltip = "";
                                        }else{
                                            $tooltip = "You have no permission to add";
                                        }
                                ?>
                                <div class="row mt-40">
                                    <div class="col-lg-12 text-center">
                                       <button class="primary-btn fix-gr-bg submit" data-toggle="tooltip" title="<?php echo e($tooltip); ?>">
                                            <span class="ti-check"></span>
                                            <?php if(isset($editData)): ?>
                                                <?php echo app('translator')->get('lang.update'); ?>
                                            <?php else: ?>
                                                <?php echo app('translator')->get('lang.save'); ?>
                                            <?php endif; ?>
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
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.leave_define'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table id="table_id" class="display school-table data-table" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.user'); ?></th>
                                    <th><?php echo app('translator')->get('lang.role'); ?></th>
                                    <th><?php echo app('translator')->get('lang.leave_type'); ?></th>
                                    <th><?php echo app('translator')->get('lang.days'); ?></th>
                                    <th><?php echo app('translator')->get('lang.action'); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- <?php $__currentLoopData = $leave_defines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave_define): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($leave_define->user !=""?$leave_define->user->full_name:""); ?></td>
                                    <td><?php echo e($leave_define->role !=""?$leave_define->role->name:""); ?></td>
                                    <td><?php echo e($leave_define->leaveType !=""?$leave_define->leaveType->type:""); ?></td>
                                    <td><?php echo e($leave_define->days); ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                <?php echo app('translator')->get('lang.select'); ?>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right">

                                                <?php if(userPermission(201)): ?>

                                                <a class="dropdown-item" href="<?php echo e(route('leave-define-edit', [@$leave_define->id
                                                    ])); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                                    <?php endif; ?>
                                                    <?php if(userPermission(202)): ?>

                                                    <a class="dropdown-item" data-toggle="modal" data-target="#deleteLeaveDefineModal<?php echo e($leave_define->id); ?>"
                                                        href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                                    <?php endif; ?>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


  <!-- MOdal Here  -->
<div class="modal fade admin-query" id="deleteLeaveDefineModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.leave_define'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                        <?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?>
                </div>
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                    <?php echo e(Form::open(['route' => array('leave-define-delete'), 'method' => 'DELETE', 'enctype' => 'multipart/form-data'])); ?>

                    <input type="hidden" name="id" id="showId">
                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- add Days Modal  -->
<div class="modal fade admin-query" id="addLeaveDayModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.update'); ?> <?php echo app('translator')->get('lang.leave_define'); ?> </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <?php echo e(Form::open(['route' => 'leave-define-updateLeave', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                <div class="form-group">
                    <input type="hidden" name="id" id="showId">
                    <div class="row mt-20">
                        <div class="col-lg-12">
                            <div class="input-effect">
                                <input class="primary-input form-control has-content" type="text" name="days" autocomplete="off" id="showDays">
                                <label><?php echo app('translator')->get('lang.days'); ?> <span>*</span> </label>
                                <span class="focus-border"></span>
                                <?php if($errors->has('days')): ?>
                                <span class="invalid-feedback" role="alert">
                                    <strong><?php echo e($errors->first('days')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.close'); ?></button>
                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.update'); ?></button>
                </div>
                <?php echo e(Form::close()); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script'); ?>
    <script>
        function deleteLeaveDefine(id){
            var modal = $('#deleteLeaveDefineModal');
            modal.find('#showId').val(id)
            modal.modal('show');

        }

        function addLeaveDay(id){ 
            var modal = $('#addLeaveDayModal');
            var total_days = $('.reason'+ id).data('total_days');
            modal.find('#showId').val(id);
            modal.find('#showDays').val(total_days);
            modal.modal('show');
        }
        
    </script>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('script'); ?>  
<?php echo $__env->make('backEnd.partials.server_side_datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>
//
// DataTables initialisation
//
$(document).ready(function() {
   $('.data-table').DataTable({
                 processing: true,
                 serverSide: true,
                 "ajax": $.fn.dataTable.pipeline( {
                       url: "<?php echo e(url('leave-define-ajax')); ?>",
                       data: { 
                            
                        },
                       pages: "<?php echo e(generalSetting()->ss_page_load); ?>" // number of pages to cache
                       
                   } ),
                   columns: [
                       {data: 'user.full_name', name: 'userName'},
                       {data: 'role.name', name: 'role'},
                       {data: 'leave_type.type', name: 'leaveType'},
                       {data: 'days', name: 'totalDays'},
                       {data: 'action', name: 'action', orderable: true, searchable: true},
                       
                    ],
                    bLengthChange: false,
                    bDestroy: true,
                    language: {
                        search: "<i class='ti-search'></i>",
                        searchPlaceholder: window.jsLang('quick_search'),
                        paginate: {
                            next: "<i class='ti-arrow-right'></i>",
                            previous: "<i class='ti-arrow-left'></i>",
                        },
                    },
                    dom: "Bfrtip",
                    buttons: [{
                        extend: "copyHtml5",
                        text: '<i class="fa fa-files-o"></i>',
                        title: $("#logo_title").val(),
                        titleAttr: window.jsLang('copy_table'),
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        },
                    },
                    {
                        extend: "excelHtml5",
                        text: '<i class="fa fa-file-excel-o"></i>',
                        titleAttr: window.jsLang('export_to_excel'),
                        title: $("#logo_title").val(),
                        margin: [10, 10, 10, 0],
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        },
                    },
                    {
                        extend: "csvHtml5",
                        text: '<i class="fa fa-file-text-o"></i>',
                        titleAttr: window.jsLang('export_to_csv'),
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        },
                    },
                    {
                        extend: "pdfHtml5",
                        text: '<i class="fa fa-file-pdf-o"></i>',
                        title: $("#logo_title").val(),
                        titleAttr: window.jsLang('export_to_pdf'),
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        },
                        orientation: "landscape",
                        pageSize: "A4",
                        margin: [0, 0, 0, 12],
                        alignment: "center",
                        header: true,
                        customize: function(doc) {
                            doc.content[1].margin = [100, 0, 100, 0]; //left, top, right, bottom
                            doc.content.splice(1, 0, {
                                margin: [0, 0, 0, 12],
                                alignment: "center",
                                image: "data:image/png;base64," + $("#logo_img").val(),
                            });
                        },
                    },
                    {
                        extend: "print",
                        text: '<i class="fa fa-print"></i>',
                        titleAttr: window.jsLang('print'),
                        title: $("#logo_title").val(),
                        exportOptions: {
                            columns: ':visible:not(.not-export-col)'
                        },
                    },
                    {
                        extend: "colvis",
                        text: '<i class="fa fa-columns"></i>',
                        postfixButtons: ["colvisRestore"],
                    },
                ],
                columnDefs: [{
                    visible: false,
                }, ],
                responsive: true,
            });
        } );
        </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/humanResource/leave_define.blade.php ENDPATH**/ ?>