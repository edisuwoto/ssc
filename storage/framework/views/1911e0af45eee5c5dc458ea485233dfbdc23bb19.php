
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.syllabus'); ?> <?php echo app('translator')->get('lang.list'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.syllabus'); ?> <?php echo app('translator')->get('lang.list'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.study_material'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.syllabus'); ?> <?php echo app('translator')->get('lang.list'); ?></a>
            </div>
        </div>
    </div>
</section>

<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">

<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-4 no-gutters">
                <div class="main-title">
                    <h3 class="mb-0"><?php echo app('translator')->get('lang.syllabus'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <table id="table_id" class="display data-table school-table" cellspacing="0" width="100%">

                    <thead>
                        <tr>
                            <th><?php echo app('translator')->get('lang.content_title'); ?></th>
                            <th><?php echo app('translator')->get('lang.type'); ?></th>
                            <th><?php echo app('translator')->get('lang.date'); ?></th>
                            <th><?php echo app('translator')->get('lang.available_for'); ?></th>
                            <th><?php echo app('translator')->get('lang.class_Sec'); ?></th>
                            <th><?php echo app('translator')->get('lang.action'); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- <?php if(isset($uploadContents)): ?>
                        <?php $__currentLoopData = $uploadContents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>

                            <td><?php echo e(@$value->content_title); ?></td>
                            <td>
                                <?php if(@$value->content_type == 'as'): ?>
                                    <?php echo e('Assignment'); ?>

                                <?php elseif(@$value->content_type == 'st'): ?>
                                    <?php echo e('Study Material'); ?>

                                <?php elseif(@$value->content_type == 'sy'): ?>
                                    <?php echo e('Syllabus'); ?>

                                <?php else: ?>
                                    <?php echo e('Others Download'); ?>

                                <?php endif; ?>
                            </td>
                            <td  data-sort="<?php echo e(strtotime(@$value->upload_date)); ?>" >
                               <?php echo e(@$value->upload_date != ""? dateConvert(@$value->upload_date):''); ?>


                            </td>
                            <td>
                                <?php if(@$value->available_for_admin == 1): ?>
                                    <?php echo app('translator')->get('lang.all_admins'); ?><br>
                                <?php endif; ?>
                                <?php if(@$value->available_for_all_classes == 1): ?>
                                    <?php echo app('translator')->get('lang.all_classes_student'); ?>
                                <?php endif; ?>

                                <?php if(@$value->classes != "" && $value->sections != ""): ?>
                                    <?php echo app('translator')->get('lang.all_students_of'); ?> (<?php echo e(@$value->classes->class_name.'->'.@$value->sections->section_name); ?>)
                                <?php endif; ?>
                             </td>
                            <td>

                            <?php if(@$value->class != ""): ?>
                                <?php echo e(@$value->classes->class_name); ?>

                            <?php endif; ?> 

                            <?php if(@$value->section != ""): ?>
                                (<?php echo e(@$value->sections->section_name); ?>)
                            <?php endif; ?>


                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        <?php echo app('translator')->get('lang.select'); ?>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right"> 
                                        <a data-modal-size="modal-lg" title="View Content Details" class="dropdown-item modalLink" href="<?php echo e(route('upload-content-view', $value->id)); ?>"><?php echo app('translator')->get('lang.view'); ?></a>

                                        <?php if(moduleStatusCheck('VideoWatch')== TRUE): ?>
                                            <a class="dropdown-item" href="<?php echo e(url('videowatch/view-log/'.$value->id)); ?>"><?php echo app('translator')->get('lang.seen'); ?> /<?php echo app('translator')->get('lang.unseen'); ?></a>
                                            <a class="dropdown-item" href="<?php echo e(url('study-content-watch-log/'.$value->id)); ?>"><?php echo app('translator')->get('lang.seen'); ?> /<?php echo app('translator')->get('lang.unseen'); ?> <?php echo app('translator')->get('lang.upload'); ?></a>
                                        <?php endif; ?>
                                            <a class="dropdown-item" href="<?php echo e(route('upload-content-edit',$value->id)); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>

                                     <?php if(userPermission(103)): ?>

                                    
                                        <a class="dropdown-item" data-toggle="modal" data-target="#deleteApplyLeaveModal<?php echo e(@$value->id); ?>"
                                            href="#"><?php echo app('translator')->get('lang.delete'); ?></a>
                                            <?php endif; ?>

                                            <?php if(userPermission(104)): ?>

                                        <?php if($value->upload_file != ""): ?>
                                         <a class="dropdown-item" href="<?php echo e(url(@$value->upload_file)); ?>" download>
                                             <?php echo app('translator')->get('lang.download'); ?> <span class="pl ti-download"></span>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade admin-query" id="deleteApplyLeaveModal<?php echo e(@$value->id); ?>" >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.syllabus'); ?></h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="text-center">
                                                <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                            </div>

                                            <div class="mt-40 d-flex justify-content-between">
                                                <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                <a href="<?php echo e(route('delete-upload-content', [@$value->id])); ?>" class="text-light">
                                                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</section>


<div class="modal fade admin-query" id="showReasonModal" >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.syllabus'); ?></h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <?php echo e(Form::open(['route' => 'delete-upload-content', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                                        <div class="modal-body">
                                            <div class="text-center">
                                                <h4><?php echo app('translator')->get('lang.are_you_sure_to_delete'); ?></h4>
                                            </div>

                                            <div class="mt-40 d-flex justify-content-between">
                                                <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                   
                                                <input type="hidden" name="id"> 
                                                <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                   
                                            </div>
                                        </div>
                                        <?php echo e(Form::close()); ?>



                                    </div>
                                </div>
                    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('script'); ?>  
    <?php echo $__env->make('backEnd.partials.server_side_datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 
   <script>

$(document).ready(function() {
       $('.data-table').DataTable({
                     processing: true,
                     serverSide: true,
                     "ajax": $.fn.dataTable.pipeline( {
                           url: "<?php echo e(route('syllabus-list-ajax')); ?>",
                           data: { 
                               
                            },
                           pages: "<?php echo e(generalSetting()->ss_page_load); ?>" // number of pages to cache
                           
                       } ),
                       columns: [
                           {data: 'content_title', name: 'content_title'},
                           {data: 'type', name: 'type'},
                           {data: 'date', name: 'date'},
                           {data: 'avaiable', name: 'avaiable'},
                           {data: 'class_sections', name: 'class_sections'},
                           {data: 'action', name: 'action', orderable: false, searchable: true},
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
       
            <script>
            
                function deleteAssignMent(id){
                    var modal = $('#showReasonModal');
                    modal.find('input[name=id]').val(id)
                    modal.modal('show');
                }
            </script>
   
   <?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/teacher/syllabusList.blade.php ENDPATH**/ ?>