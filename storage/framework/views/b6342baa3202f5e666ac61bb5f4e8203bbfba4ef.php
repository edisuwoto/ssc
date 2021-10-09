
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.email_sms_log'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.email_sms_log'); ?> <?php echo app('translator')->get('lang.list'); ?> </h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.communicate'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.email_sms_log'); ?></a>
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
                <a href="<?php echo e(route('send-email-sms-view')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('lang.send_email'); ?>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">

                <table id="table_id" class="display data-table school-table" cellspacing="0" width="100%">

                    <thead>
                        <?php if(session()->has('message-success-delete') != "" ||
                        session()->get('message-danger-delete') != ""): ?>
                        <tr>
                            <td colspan="2">
                                <?php if(session()->has('message-success-delete')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session()->get('message-success-delete')); ?>

                                </div>
                                <?php elseif(session()->has('message-danger-delete')): ?>
                                <div class="alert alert-danger">
                                    <?php echo e(session()->get('message-danger-delete')); ?>

                                </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <th> Si</th>
                            <th> <?php echo app('translator')->get('lang.title'); ?></th>
                            <th> <?php echo app('translator')->get('lang.description'); ?></th>
                            <th> <?php echo app('translator')->get('lang.date'); ?></th>
                            <th> <?php echo app('translator')->get('lang.type'); ?></th>
                            
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
                       url: "<?php echo e(url('email-sms-log-ajax')); ?>",
                       data: { 
                            
                        },
                       pages: "<?php echo e(generalSetting()->ss_page_load); ?>" // number of pages to cache
                       
                   } ),
                   columns: [
                        {data: 'id', name: 'id'},
                       {data: 'title', name: 'title'},
                       {data: 'description', name: 'description'},
                       {data: 'date', name: 'date'},
                       {data: 'send_via', name: 'type'},
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/communicate/emailSmsLog.blade.php ENDPATH**/ ?>