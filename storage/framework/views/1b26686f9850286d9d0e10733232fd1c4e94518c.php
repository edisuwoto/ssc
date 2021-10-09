
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.student_list'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 up_breadcrumb white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.manage'); ?> <?php echo app('translator')->get('lang.student'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.information'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.student_list'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6 col-sm-6">
                    <div class="main-title mt_0_sm mt_0_md">
                        <h3 class="mb-30  "><?php echo app('translator')->get('lang.select_criteria'); ?></h3>
                    </div>
                </div>

                <?php if(userPermission(62)): ?>
                 <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg col-sm-6 text_sm_right">
                    <a href="<?php echo e(route('student_admission')); ?>" class="primary-btn small fix-gr-bg">
                        <span class="ti-plus pr-2"></span>
                        <?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.student'); ?>
                    </a>
                </div>
            <?php endif; ?>
            </div>
            <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'student-list-search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'infix_form'])); ?>

            <div class="row">
                <div class="col-lg-12">
                <div class="white-box">
                    <div class="row">
                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                        <div class="col-lg-3">
                            <div class="input-effect sm2_mb_20 md_mb_20">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('academic_year') ? ' is-invalid' : ''); ?>" name="academic_year" id="academic_year">
                                    <option data-display="<?php echo app('translator')->get('lang.academic_year'); ?> *" value=""><?php echo app('translator')->get('lang.academic_year'); ?> *</option>
                                    <?php $__currentLoopData = $sessions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $session): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($session->id); ?>" <?php echo e(isset($academic) && $academic == $session->id? 'selected': ''); ?>><?php echo e($session->year); ?>[<?php echo e($session->title); ?>]</option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <span class="focus-border"></span>
                                <?php if($errors->has('academic_year')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('academic_year')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-lg-3 sm_mb_20 sm2_mb_20 md_mb_20" id="class-div">
                            <select class="niceSelect w-100 bb form-control <?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="classSelectStudent" name="class">
                                <option data-display="<?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.class'); ?> *" value=""><?php echo app('translator')->get('lang.select'); ?> <?php echo app('translator')->get('lang.class'); ?></option>
                                <?php if(isset($academic)): ?>
                                    <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($class->id); ?>" <?php echo e(isset($class_id) && $class_id == $class->id ? 'selected' : ''); ?>><?php echo e($class->class_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            </select>
                            <div class="pull-right loader loader_style" id="select_class_loader">
                                <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                            </div>
                            <?php if($errors->has('class')): ?>
                            <span class="invalid-feedback invalid-select" role="alert">
                                <strong><?php echo e($errors->first('class')); ?></strong>
                            </span>
                            <?php endif; ?>
                        </div>
                        <div class="col-lg-2 col-md-3" id="sectionStudentDiv">
                                <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="sectionSelectStudent" name="section">
                                    <option data-display="<?php echo app('translator')->get('lang.select_section'); ?>" value=""><?php echo app('translator')->get('lang.select_section'); ?></option>
                                </select>
                                <div class="pull-right loader loader_style" id="select_section_loader">
                                    <img class="loader_img_style" src="<?php echo e(asset('public/backEnd/img/demo_wait.gif')); ?>" alt="loader">
                                </div>
                                <?php if($errors->has('section')): ?>
                                <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('section')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                        <div class="col-lg-2">
                            <div class="input-effect sm_mb_20 sm2_mb_20 md_mb_20">
                                <input class="primary-input" type="text" name="name" value="<?php echo e(isset($name)?$name:old('name')); ?>">
                                <label><?php echo app('translator')->get('lang.search_by_name'); ?></label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="input-effect sm_mb_20 sm2_mb_20 md_mb_20">
                                <input class="primary-input" type="text" name="roll_no" value="<?php echo e(isset($roll_no)?$roll_no:old('roll_no')); ?>">
                                <label><?php echo app('translator')->get('lang.search_by_roll_no'); ?></label>
                                <span class="focus-border"></span>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-20 text-right">
                            <button type="submit" class="primary-btn small fix-gr-bg" id="btnsubmit">
                                <span class="ti-search pr-2"></span>
                                <?php echo app('translator')->get('lang.search'); ?>
                            </button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="academic_id" value="<?php echo e(@$academic_year); ?>">
            <input type="hidden" id="class" value="<?php echo e(@$class_id); ?>">
            <input type="hidden" id="section" value="<?php echo e(@$section); ?>">
            <input type="hidden" id="roll" value="<?php echo e(@$roll_no); ?>">
            <input type="hidden" id="name" value="<?php echo e(@$name); ?>">
            <?php echo e(Form::close()); ?>

            
            <div class="row mt-40 full_wide_table">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0"><?php echo app('translator')->get('lang.student_list'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row  ">
                        <div class="col-lg-12">
                            <table id="table_id" class="display data-table school-table" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang.admission'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                        <th><?php echo app('translator')->get('lang.roll'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                        <th><?php echo app('translator')->get('lang.name'); ?></th>
                                        <th><?php echo app('translator')->get('lang.class'); ?></th>
                                        <th><?php echo app('translator')->get('lang.section'); ?></th>
                                        <th><?php echo app('translator')->get('lang.father_name'); ?></th>
                                        <th><?php echo app('translator')->get('lang.date_of_birth'); ?></th>
                                        <th><?php echo app('translator')->get('lang.gender'); ?></th>
                                        <th><?php echo app('translator')->get('lang.type'); ?></th>
                                        <th><?php echo app('translator')->get('lang.phone'); ?></th>
                                        <th><?php echo app('translator')->get('lang.actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
    </div>
</section>

    <div class="modal fade admin-query" id="deleteStudentModal" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo app('translator')->get('lang.disable'); ?> <?php echo app('translator')->get('lang.student'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <h4><?php echo app('translator')->get('lang.are_you_sure_to_disable'); ?></h4>
                    </div>
                    <div class="mt-40 d-flex justify-content-between">
                        <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                        <?php echo e(Form::open(['route' => 'student-delete', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                    <input type="hidden" name="id" value="<?php echo e(@$student->id); ?>" id="student_delete_i">  
                            <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.disable'); ?></button>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
<?php
    if(isset($academic_year) || isset($class_id)){
        $ajax_url=url('student-list-datatable?academic_year='.
        $academic_year.'&class='.
        $class_id.'&section='.
        $section.'&roll_no='.
        $roll_no.'&name='.$name);
    }else{
        $ajax_url = url('student-list-datatable');
    }
?>
    <?php $__env->stopSection(); ?>
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
                           url: "<?php echo e(url('student-list-datatable')); ?>",
                           data: { 
                                academic_year: $('#academic_id').val(), 
                                class: $('#class').val(), 
                                section: $('#section').val(), 
                                roll_no: $('#roll').val(), 
                                name: $('#name').val()
                            },
                           pages: "<?php echo e(generalSetting()->ss_page_load); ?>" // number of pages to cache
                       } ),
                       columns: [
                           {data: 'admission_no', name: 'admission_no'},
                           {data: 'roll_no', name: 'roll_no'},
                           {data: 'full_name', name: 'full_name'},
                           {data: 'class_name.class_name', name: 'class_name.class_name'},
                           {data: 'section.section_name', name: 'section.section_name'},
                           {data: 'parents.fathers_name', name: 'parents.fathers_name'},
                           {data: 'dob', name: 'dob'},
                           {data: 'gender.base_setup_name', name: 'gender.base_setup_name'},
                           {data: 'category.category_name', name: 'category.category_name'},
                           {data: 'mobile', name: 'mobile'},
                           {data: 'action', name: 'action', orderable: false, searchable: false},
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
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/studentInformation/student_details.blade.php ENDPATH**/ ?>