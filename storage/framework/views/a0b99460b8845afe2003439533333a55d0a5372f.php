
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.bank'); ?>  <?php echo app('translator')->get('lang.payment'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box up_breadcrumb">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.bank'); ?>  <?php echo app('translator')->get('lang.payment'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.fees_collection'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.bank'); ?>  <?php echo app('translator')->get('lang.payment'); ?></a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        
         <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="main-title mt_0_sm mt_0_md">
                        <h3 class="mb-30"><?php echo app('translator')->get('lang.select_criteria'); ?> </h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'bank-payment-slip', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_studentA'])); ?>

                            <div class="row">
                                <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                                <div class="col-lg-3 col-md-3 sm_mb_20 sm2_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('class') ? ' is-invalid' : ''); ?>" id="select_class" name="class">
                                        <option data-display="<?php echo app('translator')->get('lang.select_class'); ?>" value=""><?php echo app('translator')->get('lang.select_class'); ?></option>
                                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($class->id); ?>" <?php echo e(isset($class_id)? ($class_id == $class->id? 'selected': ''):''); ?>><?php echo e($class->class_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                     <?php if($errors->has('class')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('class')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-3 col-md-3" id="select_section_div">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('section') ? ' is-invalid' : ''); ?>" id="select_section" name="section">
                                        <option data-display="<?php echo app('translator')->get('lang.select_section'); ?>" value=""><?php echo app('translator')->get('lang.select_section'); ?></option>
                                        <?php if(isset($section_id)): ?>
                                            <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($section->id); ?>" <?php echo e(isset($section_id)? ($section_id == $section->id? 'selected': ''):''); ?>><?php echo e($section->section_name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
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
                                <div class="col-lg-3 col-md-3 mt-30-md">
                                    <div class="row no-gutters input-right-icon">
                                        <div class="col">
                                            <div class="input-effect">
                                                <input class="primary-input date form-control<?php echo e($errors->has('payment_date') ? ' is-invalid' : ''); ?> <?php echo e(isset($date)? 'read-only-input': ''); ?>" id="startDate" type="text"
                                                    name="payment_date" autocomplete="off" value="<?php echo e(isset($date)? $date: ''); ?>">
                                                <label for="startDate"><?php echo app('translator')->get('lang.payment'); ?> <?php echo app('translator')->get('lang.date'); ?></label>
                                                <span class="focus-border"></span>
                                                <?php if($errors->has('payment_date')): ?>
                                                <span class="invalid-feedback" role="alert">
                                                    <strong><?php echo e($errors->first('payment_date')); ?></strong>
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
                                </div>
                                <div class="col-lg-3 col-md-3 sm_mb_20 sm2_mb_20">
                                    <select class="niceSelect w-100 bb form-control<?php echo e($errors->has('approve_status') ? ' is-invalid' : ''); ?>" name="approve_status">
                                        <option data-display="<?php echo app('translator')->get('lang.status'); ?>" value=""><?php echo app('translator')->get('lang.status'); ?></option>
                                        <option value="0" <?php echo e(isset($approve_status)? ($approve_status == 0? 'selected': ''):''); ?>><?php echo app('translator')->get('lang.pending'); ?></option>
                                        <option value="1" <?php echo e(isset($approve_status)? ($approve_status == 1? 'selected': ''):''); ?>><?php echo app('translator')->get('lang.approved'); ?></option>
                                    </select>
                                     <?php if($errors->has('approve_status')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                        <strong><?php echo e($errors->first('approve_status')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-12 mt-20 text-right">
                                    <button type="submit" class="primary-btn small fix-gr-bg">
                                        <span class="ti-search pr-2"></span>
                                        <?php echo app('translator')->get('lang.search'); ?>
                                    </button>
                                </div>
                            </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
            
            <div class="row mt-40">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-4 no-gutters">
                            <div class="main-title">
                                <h3 class="mb-0">  <?php echo app('translator')->get('lang.bank'); ?>  <?php echo app('translator')->get('lang.payment'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th><?php echo app('translator')->get('lang.student'); ?> <?php echo app('translator')->get('lang.name'); ?></th>
                                        <th><?php echo app('translator')->get('lang.fees_type'); ?></th>
                                        <th><?php echo app('translator')->get('lang.date'); ?></th>
                                        <th><?php echo app('translator')->get('lang.amount'); ?></th>
                                        <th><?php echo app('translator')->get('lang.note'); ?></th>
                                        <th><?php echo app('translator')->get('lang.slip'); ?></th>
                                        <th><?php echo app('translator')->get('lang.status'); ?></th>
                                        <th><?php echo app('translator')->get('lang.actions'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if( isset($all_bank_slips)): ?>
                                    <?php $__currentLoopData = $all_bank_slips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank_slip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(@$bank_slip->studentInfo->full_name); ?></td>
                                        <td><?php echo e(@$bank_slip->feesType->name); ?></td>
                                        <td  data-sort="<?php echo e(strtotime(@$bank_slip->date)); ?>" ><?php echo e(!empty($bank_slip->date)? dateConvert(@$bank_slip->date):''); ?></td>
                                        <td><?php echo e(@$bank_slip->amount); ?></td>
                                        <td><?php echo e(@$bank_slip->note); ?></td>
                                        
                                        <td>
                                            <?php if(!empty($bank_slip->slip)): ?>
                                                <a class="text-color" data-toggle="modal" data-target="#showCertificateModal<?php echo e(@$bank_slip->id); ?>"  href="#"><?php echo app('translator')->get('lang.view'); ?></a>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(@$bank_slip->approve_status== 0): ?>
                                                <button class="primary-btn small bg-warning text-white border-0"><?php echo app('translator')->get('lang.pending'); ?></button>
                                            <?php else: ?>
                                                <button class="primary-btn small bg-success text-white border-0  tr-bg"><?php echo app('translator')->get('lang.approved'); ?></button>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                    <?php echo app('translator')->get('lang.select'); ?>
                                                </button>
                                                <?php if($bank_slip->approve_status == 0): ?>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a onclick="enableId(<?php echo e($bank_slip->id); ?>);" class="dropdown-item" href="#" data-toggle="modal" data-target="#enableStudentModal" data-id="<?php echo e($bank_slip->id); ?>"  ><?php echo app('translator')->get('lang.approve'); ?>00</a>
                                                    <a onclick="rejectPayment(<?php echo e($bank_slip->id); ?>);" class="dropdown-item" href="#" data-toggle="modal" data-id="<?php echo e($bank_slip->id); ?>"  ><?php echo app('translator')->get('lang.reject'); ?></a>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade admin-query" id="showCertificateModal<?php echo e(@$bank_slip->id); ?>">
                                        <div class="modal-dialog modal-dialog-centered large-modal">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo app('translator')->get('lang.view'); ?> <?php echo app('translator')->get('lang.slip'); ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body p-0 mt-30">
                                                    <div class="container student-certificate">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-12 text-center">
                                                                <?php
                                                                    $pdf = @$bank_slip->slip ? explode('.', @$bank_slip->slip) : ""." . "."";
                                                                    $for_pdf =  $pdf[1];
                                                                ?>
                                                                <?php if(@$for_pdf=="pdf"): ?>
                                                                    <div class="mb-5">
                                                                        <a href="<?php echo e(url(@$bank_slip->slip)); ?>" download><?php echo app('translator')->get('lang.download'); ?> <span class="pl ti-download"></span></a>
                                                                    </div>
                                                                <?php else: ?>
                                                                    <div class="mb-5">
                                                                        <img class="img-fluid" src="<?php echo e(asset($bank_slip->slip)); ?>">
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php endif; ?>


                                    <?php if( isset($bank_slips)): ?>
                                    <?php $__currentLoopData = $bank_slips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bank_slip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e(@$bank_slip->studentInfo->full_name); ?></td>
                                        <td><?php echo e(@$bank_slip->feesType->name); ?></td>
                                        <td  data-sort="<?php echo e(strtotime(@$bank_slip->date)); ?>" ><?php echo e(!empty($bank_slip->date)? dateConvert(@$bank_slip->date):''); ?></td>
                                        <td><?php echo e(@$bank_slip->amount); ?></td>
                                        <td><?php echo e(@$bank_slip->note); ?></td>
                                        
                                        <td>
                                            <?php if(!empty($bank_slip->slip)): ?>
                                                <a class="text-color" data-toggle="modal" data-target="#showCertificateModal<?php echo e(@$bank_slip->id); ?>"  href="#"><?php echo app('translator')->get('lang.view'); ?></a>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if(@$bank_slip->approve_status== 0): ?>
                                                <button class="primary-btn small bg-warning text-white border-0"><?php echo app('translator')->get('lang.pending'); ?></button>
                                            <?php else: ?>
                                                <button class="primary-btn small bg-success text-white border-0  tr-bg"><?php echo app('translator')->get('lang.approved'); ?></button>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                                    <?php echo app('translator')->get('lang.select'); ?>
                                                </button>
                                                <?php if($bank_slip->approve_status == 0): ?>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a onclick="enableId(<?php echo e($bank_slip->id); ?>);" class="dropdown-item" href="#" data-toggle="modal" data-target="#enableStudentModal" data-id="<?php echo e($bank_slip->id); ?>"  ><?php echo app('translator')->get('lang.approve'); ?></a>
                                                    <a onclick="rejectPayment(<?php echo e($bank_slip->id); ?>);" class="dropdown-item" href="#" data-toggle="modal" data-id="<?php echo e($bank_slip->id); ?>"  ><?php echo app('translator')->get('lang.reject'); ?></a>
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade admin-query" id="showCertificateModal<?php echo e(@$bank_slip->id); ?>">
                                        <div class="modal-dialog modal-dialog-centered large-modal">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"><?php echo app('translator')->get('lang.view'); ?> <?php echo app('translator')->get('lang.slip'); ?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body p-0 mt-30">
                                                    <div class="container student-certificate">
                                                        <div class="row justify-content-center">
                                                            <div class="col-lg-12 text-center">
                                                                <?php
                                                                    $pdf = @$bank_slip->slip ? explode('.', @$bank_slip->slip) : ""." . "."";
                                                                    $for_pdf =  $pdf[1];
                                                                ?>
                                                                <?php if(@$for_pdf=="pdf"): ?>
                                                                    <div class="mb-5">
                                                                        <a href="<?php echo e(url(@$bank_slip->slip)); ?>" download><?php echo app('translator')->get('lang.download'); ?> <span class="pl ti-download"></span></a>
                                                                    </div>
                                                                <?php else: ?>
                                                                    <div class="mb-5">
                                                                        <img class="img-fluid" src="<?php echo e(asset($bank_slip->slip)); ?>">
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    <?php endif; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            

        
    </div>
</section>

<div class="modal fade admin-query" id="enableStudentModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.approve'); ?> <?php echo app('translator')->get('lang.payment'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
                <div class="text-center">
                    <h4><?php echo app('translator')->get('lang.are_you_sure_to_approve'); ?></h4>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                     <?php echo e(Form::open(['route' => 'approve-fees-payment', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                  
                     <input type="hidden" name="class" value="<?php echo e(@$class_id); ?>">
                     <input type="hidden" name="section" value="<?php echo e(@$section_id); ?>">
                     <input type="hidden" name="payment_date" value="<?php echo e(@$date); ?>">
                     <input type="hidden" name="id" value="" id="student_enable_i">
                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.approve'); ?></button>
                     <?php echo e(Form::close()); ?>

                </div>
            </div>

        </div>
    </div>
</div>


<!-- modal start here  -->

<div class="modal fade admin-query" id="rejectPaymentModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.bank'); ?>  <?php echo app('translator')->get('lang.payment'); ?> <?php echo app('translator')->get('lang.reject'); ?> </h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                        <h4><?php echo app('translator')->get('lang.are_you_sure_to_reject'); ?></h4>
                    </div>
              <?php echo e(Form::open(['route' => 'reject-fees-payment', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                <div class="form-group">
                    <input type="hidden" name="id" id="showId">
                    <label><strong><?php echo app('translator')->get('lang.reject'); ?>  <?php echo app('translator')->get('lang.note'); ?></strong></label>
                    <textarea name="payment_reject_reason" class="form-control" rows="6"></textarea>
                </div>

                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.close'); ?></button>
                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.submit'); ?></button>
                </div>
                <?php echo e(Form::close()); ?>


            </div>

        </div>
    </div>
</div>
<div class="modal fade admin-query" id="showReasonModal" >
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.view'); ?> <?php echo app('translator')->get('lang.bank'); ?>  <?php echo app('translator')->get('lang.payment'); ?> <?php echo app('translator')->get('lang.reject'); ?>  <?php echo app('translator')->get('lang.note'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label><strong><?php echo app('translator')->get('lang.reject'); ?>  <?php echo app('translator')->get('lang.note'); ?></strong></label>
                    <textarea readonly class="form-control" rows="4"></textarea>
                </div>
                <div class="mt-40 d-flex justify-content-between">
                    <button type="button" class="primary-btn fix-gr-bg" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php if(! isset($all_bank_slips)): ?>
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
                       url: "<?php echo e(url('bank-payment-slip-ajax')); ?>",
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
                       {data: 'student_info.full_name', name: 'student_name'},
                       {data: 'fees_type.name', name: 'fees_type'},
                       {data: 'date', name: 'date'},
                       {data: 'amount', name: 'amount'},
                       {data: 'note', name: 'note'},
                       {data: 'slip', name: 'slip'},
                       {data: 'status', name: 'status'},
                       {data: 'action', name: 'action',orderable: false, searchable: true},
                       
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
<?php endif; ?>
<?php $__env->startPush('script'); ?>
    <script>
        function rejectPayment(id){
            var modal = $('#rejectPaymentModal');
            modal.find('#showId').val(id)
            modal.modal('show');

        }
        function viewReason(id){
            var reason = $('.reason'+ id).data('reason');
            var modal = $('#showReasonModal');
            modal.find('textarea').val(reason)
            modal.modal('show');
        }
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/feesCollection/bank_payment_slip.blade.php ENDPATH**/ ?>