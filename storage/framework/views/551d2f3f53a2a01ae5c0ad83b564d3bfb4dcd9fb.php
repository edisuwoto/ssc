
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.staff_list'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<?php $__env->startPush('css'); ?>
<style type="text/css">
     .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background: linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
}

input:focus + .slider {
  box-shadow: 0 0 1px linear-gradient(90deg, #7c32ff 0%, #c738d8 51%, #7c32ff 100%);
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
/* th,td{
    font-size: 9px !important;
    padding: 5px !important

} */
</style>
<?php $__env->stopPush(); ?>
<section class="sms-breadcrumb mb-40 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.staff_list'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.human_resource'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.staff_list'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-6">
                <div class="main-title xs_mt_0 mt_0_sm">
                    <h3 class="mb-30"><?php echo app('translator')->get('lang.select_criteria'); ?> </h3>
                </div>
            </div>
            
<?php if(userPermission(162)): ?>

            <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg col-6 text_sm_right">
                <a href="<?php echo e(route('addStaff')); ?>" class="primary-btn small fix-gr-bg">
                    <span class="ti-plus pr-2"></span>
                    <?php echo app('translator')->get('lang.add_staff'); ?>
                </a>
            </div>
<?php endif; ?>
        </div>
        <div class="row">
            <div class="col-lg-12"> 
              <?php if(session()->has('message-success')): ?>
                  <div class="alert alert-success">
                  <?php echo e(session()->get('message-success')); ?>

                  </div>
                  <?php elseif(session()->has('message-danger')): ?>
                  <div class="alert alert-danger">
                      <?php echo e(session()->get('message-danger')); ?>

                  </div>
              <?php endif; ?>
              </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="white-box">
                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'searchStaff', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <div class="row">
                          <?php if( moduleStatusCheck('MultiBranch') && isset($branches )): ?>
                             <div class="col-lg-3">
                              <select class="niceSelect w-100 bb form-control" name="branch_id" id="branch_id">
                                    <option data-display="Branch" value=""> <?php echo app('translator')->get('lang.select'); ?> </option>
                                    <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->branch_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                          <?php endif; ?>
                            <div class="col-lg-4">
                              <select class="niceSelect w-100 bb form-control" name="role_id" id="role_id">
                                    <option data-display="<?php echo app('translator')->get('lang.role'); ?>" value=""> <?php echo app('translator')->get('lang.select'); ?> </option>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>"><?php echo e($value->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-lg-4 mt-30-md">
                               <div class="col-lg-12">
                                <div class="input-effect">
                                    <input class="primary-input" type="text" placeholder=" <?php echo app('translator')->get('lang.search_by_staff_id'); ?>" name="staff_no">
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                           </div>
                            <div class="col-lg-4 mt-30-md">
                               <div class="col-lg-12">
                                <div class="input-effect">
                                    <input class="primary-input" type="text" placeholder="<?php echo app('translator')->get('lang.search_by_name'); ?>" name="staff_name">
                                    <span class="focus-border"></span>
                                </div>
                            </div>
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
 <div class="row mt-40 full_wide_table">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-4 no-gutters">
                    <div class="main-title">
                        <h3 class="mb-0"><?php echo app('translator')->get('lang.staff_list'); ?></h3>
                    </div>
                </div>
            </div>

         <div class="row">
                <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?php echo app('translator')->get('lang.staff'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                <th><?php echo app('translator')->get('lang.name'); ?></th>
                                <th><?php echo app('translator')->get('lang.role'); ?></th>
                                <th><?php echo app('translator')->get('lang.department'); ?></th>
                                <th><?php echo app('translator')->get('lang.designation'); ?></th>
                                <th><?php echo app('translator')->get('lang.mobile'); ?></th>
                                <th><?php echo app('translator')->get('lang.email'); ?></th>
                                <th><?php echo app('translator')->get('lang.status'); ?></th>
                                <th><?php echo app('translator')->get('lang.action'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            
                            
                            <?php $__currentLoopData = $allstaffs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="<?php echo e(@$value->id); ?>">
                                <td><?php echo e($value->staff_no); ?></td>
                                <td><?php echo e($value->first_name); ?>&nbsp;<?php echo e($value->last_name); ?></td>
                                <td><?php echo e(!empty($value->roles->name)?$value->roles->name:''); ?></td>
                                <td><?php echo e($value->departments !=""?$value->departments->name:""); ?></td>
                                <td><?php echo e($value->designations !=""?$value->designations->title:""); ?></td>
                                <td><?php echo e($value->mobile); ?></td>
                                <td><?php echo e($value->email); ?></td>
                                <td>
                                    <?php if($value->role_id!=1): ?>
                                        
                                        <label class="switch">
                                        <input type="checkbox" id="<?php echo e($value->id); ?>" class="switch-input-staff" <?php echo e(@$value->active_status == 0? '':'checked'); ?> <?php echo e(@$value->role_id == 1? 'disabled':''); ?>>
                                        
                                        <span class="slider round"></span>
                                        </label>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            <?php echo app('translator')->get('lang.select'); ?>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="<?php echo e(route('viewStaff', $value->id)); ?>"><?php echo app('translator')->get('lang.view'); ?></a>
                                           <?php if(userPermission(163)): ?>

                                            <a class="dropdown-item" href="<?php echo e(route('editStaff', $value->id)); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                           <?php endif; ?>
                                           <?php if(userPermission(164)): ?>

                                            <?php if($value->role_id != Auth::user()->role_id ): ?>
                                           
                                            
                                            <a  class="dropdown-item" href="#" data-toggle="modal" data-target="#deleteStaffModal<?php echo e($value->id); ?>" data-id="<?php echo e($value->id); ?>"  ><?php echo app('translator')->get('lang.delete'); ?></a>
                                               
                                            <?php endif; ?>
                                            <?php endif; ?>
                                       
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <div class="modal fade admin-query" id="deleteStaffModal<?php echo e($value->id); ?>" >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Confirmation Required</h4>
                                            
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                            
                                        <div class="modal-body">
                                            <div class="text-center">
                                                
                                                <h4 class="text-danger">You are going to remove <?php echo e(@$value->first_name.' '.@$value->last_name); ?>. Removed data CANNOT be restored! Are you ABSOLUTELY Sure!</h4>
                                                
                                            </div>
                            
                                            <div class="mt-40 d-flex justify-content-between">
                                                <button type="button" class="primary-btn tr-bg" data-dismiss="modal"><?php echo app('translator')->get('lang.cancel'); ?></button>
                                                <a href="<?php echo e(route('deleteStaff',$value->id)); ?>" class="text-light">
                                                    <button class="primary-btn fix-gr-bg" type="submit"><?php echo app('translator')->get('lang.delete'); ?></button>
                                                
                                                     </a>
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
<?php if(!isset($allstaffs)): ?>

<?php $__env->startSection('script'); ?>  
<?php echo $__env->make('backEnd.partials.server_side_datatable', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script>

$(document).ready(function() {
   $('.data-table').DataTable({
                 processing: true,
                 serverSide: true,
                 "ajax": $.fn.dataTable.pipeline( {
                       url: "<?php echo e(url('staff-directory-ajax')); ?>",
                       data: { 
                           
                        },
                       pages: "<?php echo e(generalSetting()->ss_page_load); ?>" // number of pages to cache
                       
                   } ),
                   columns: [
                       {data:'staff_no', name:'staff_no'},
                       {data: 'full_name', name: 'full_name'},
                       {data: 'roles.name', name: 'role'},
                       {data: 'departments.name', name: 'department'},
                       {data: 'designations.title', name: 'designations'},
                       {data: 'mobile', name: 'mobile'},
                       {data: 'email', name: 'email'},
                       {data: 'switch', name: 'switch'},
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
   


<?php $__env->stopSection(); ?>

<?php endif; ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/uint/resources/views/backEnd/humanResource/staff_list.blade.php ENDPATH**/ ?>