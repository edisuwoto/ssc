
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.assignment'); ?> <?php echo app('translator')->get('lang.list'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.assignment'); ?> <?php echo app('translator')->get('lang.list'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.study_material'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.assignment'); ?> <?php echo app('translator')->get('lang.list'); ?></a>
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
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.assignment'); ?> <?php echo app('translator')->get('lang.list'); ?></h3>
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
                <h4 class="modal-title"><?php echo app('translator')->get('lang.delete'); ?> <?php echo app('translator')->get('lang.assignment'); ?></h4>
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
                           url: "<?php echo e(url('assignment-list-ajax')); ?>",
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


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/teacher/assignmentList.blade.php ENDPATH**/ ?>