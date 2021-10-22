
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.staff_attendance_report'); ?>
<?php $__env->stopSection(); ?> 

<?php $__env->startPush('css'); ?>
<style>
        #table_id1{
            border: 1px solid #ddd;
        }

        #table_id1 td{
            border: 1px solid #ddd;
            text-align:center;
        }

        #table_id1 th{
            border: 1px solid #ddd;
            text-align:center;
        }

        .main-wrapper {
            display: block;
            width: auto;
            align-items: stretch;
        }

        .main-wrapper {
            display: block;
            width: auto;
            align-items: stretch;
        }

        #main-content {
            width: auto;
        }

        #table_id1 td {
            border: 1px solid #ddd;
            text-align: center;
            padding: 7px;
            flex-wrap: nowrap;
            white-space: nowrap;
            font-size: 11px
        }

        .table-responsive::-webkit-scrollbar-thumb {
        background: #828bb2;
        height:5px;
        border-radius: 0;
        }

        .table-responsive::-webkit-scrollbar {
        width: 5px;
        height: 5px
        }

        .table-responsive::-webkit-scrollbar-track {
        height: 5px !important ;
        background: #ddd;
        border-radius: 0;
        box-shadow: inset 0 0 5px grey
        }

        .attendance_hr{
            margin-top: 0 !important;
            margin-bottom: 0 !important;
        }
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.staff_attendance_report'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.human_resource'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.staff_attendance_report'); ?></a>
                </div>
            </div>
        </div>
    </section>

    <section class="admin-visitor-area ">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30"><?php echo app('translator')->get('lang.select_criteria'); ?></h3>
                    </div>
                </div>

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
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'staff_attendance_report_search', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'search_student'])); ?>

                        <div class="row">
                            <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                            <div class="col-lg-4">
                                <select class="w-100 niceSelect bb form-control <?php echo e($errors->has('role') ? ' is-invalid' : ''); ?>"
                                        id="select_class" name="role">
                                    <option data-display="<?php echo app('translator')->get('lang.select_role'); ?>*" value=""><?php echo app('translator')->get('lang.select_role'); ?>
                                        *
                                    </option>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($role->id); ?>" <?php echo e(isset($role_id)? ($role->id == $role_id? 'selected':''):''); ?>><?php echo e($role->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php if($errors->has('role')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('role')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <?php $current_month = date('m'); ?>
                            <div class="col-lg-4">
                                <select class="w-100 niceSelect bb form-control<?php echo e($errors->has('month') ? ' is-invalid' : ''); ?>"
                                        name="month">
                                    <option data-display="Select Month *" value=""><?php echo app('translator')->get('lang.select_month'); ?> *</option>
                                    <option value="01" <?php echo e(isset($month)? ($month == "01"? 'selected':''):($current_month == "01"? 'selected':'')); ?>><?php echo app('translator')->get('lang.january'); ?></option>
                                    <option value="02" <?php echo e(isset($month)? ($month == "02"? 'selected':''):($current_month == "02"? 'selected':'')); ?>><?php echo app('translator')->get('lang.february'); ?></option>
                                    <option value="03" <?php echo e(isset($month)? ($month == "03"? 'selected':''):($current_month == "03"? 'selected':'')); ?>><?php echo app('translator')->get('lang.march'); ?></option>
                                    <option value="04" <?php echo e(isset($month)? ($month == "04"? 'selected':''):($current_month == "04"? 'selected':'')); ?>><?php echo app('translator')->get('lang.april'); ?></option>
                                    <option value="05" <?php echo e(isset($month)? ($month == "05"? 'selected':''):($current_month == "05"? 'selected':'')); ?>><?php echo app('translator')->get('lang.may'); ?></option>
                                    <option value="06" <?php echo e(isset($month)? ($month == "06"? 'selected':''):($current_month == "06"? 'selected':'')); ?>><?php echo app('translator')->get('lang.june'); ?></option>
                                    <option value="07" <?php echo e(isset($month)? ($month == "07"? 'selected':''):($current_month == "07"? 'selected':'')); ?>><?php echo app('translator')->get('lang.july'); ?></option>
                                    <option value="08" <?php echo e(isset($month)? ($month == "08"? 'selected':''):($current_month == "08"? 'selected':'')); ?>><?php echo app('translator')->get('lang.august'); ?></option>
                                    <option value="09" <?php echo e(isset($month)? ($month == "09"? 'selected':''):($current_month == "09"? 'selected':'')); ?>><?php echo app('translator')->get('lang.september'); ?></option>
                                    <option value="10" <?php echo e(isset($month)? ($month == "10"? 'selected':''):($current_month == "10"? 'selected':'')); ?>><?php echo app('translator')->get('lang.october'); ?></option>
                                    <option value="11" <?php echo e(isset($month)? ($month == "11"? 'selected':''):($current_month == "11"? 'selected':'')); ?>><?php echo app('translator')->get('lang.november'); ?></option>
                                    <option value="12" <?php echo e(isset($month)? ($month == "12"? 'selected':''):($current_month == "12"? 'selected':'')); ?>><?php echo app('translator')->get('lang.december'); ?></option>
                                </select>
                                <?php if($errors->has('month')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('month')); ?></strong>
                                </span>
                                <?php endif; ?>
                            </div>
                            <div class="col-lg-4">
                                <select class="niceSelect w-100 bb form-control <?php echo e($errors->has('year') ? 'is-invalid' : ''); ?>"
                                        name="year" id="year">
                                    <option data-display="<?php echo app('translator')->get('lang.select_year'); ?> *"
                                            value=""><?php echo app('translator')->get('lang.select_year'); ?> *
                                    </option>
                                    <?php
                                        $current_year = date('Y');
                                        $ini = date('y');
                                        $limit = $ini + 30;
                                    ?>
                                    <?php for($i = $ini; $i <= $limit; $i++): ?>
                                        <option value="<?php echo e($current_year); ?>" <?php echo e(isset($year)? ($year == $current_year? 'selected':''):(date('Y') == $current_year? 'selected':'')); ?>><?php echo e($current_year--); ?></option>
                                    <?php endfor; ?>
                                </select>
                                <?php if($errors->has('year')): ?>
                                    <span class="invalid-feedback invalid-select" role="alert">
                                    <strong><?php echo e($errors->first('year')); ?></strong>
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
        </div>
    </section>


    <?php if(isset($attendances)): ?>

        <section class="student-attendance up_admin_visitor">
            <div class="container-fluid p-0">
                <div class="row mt-40">
                    <div class="col-lg-6 no-gutters">
                        <div class="main-title">
                            <h3 class="mb-0"><?php echo app('translator')->get('lang.staff_attendance_report'); ?></h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <a href="<?php echo e(route('staff-attendance/print', [$role_id, $month, $year])); ?>"
                           class="primary-btn small fix-gr-bg pull-right" target="_blank"><i
                                    class="ti-printer"> </i> <?php echo app('translator')->get('lang.print'); ?></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="lateday d-flex mt-4">
                            <div class="mr-3"><?php echo app('translator')->get('lang.present'); ?>: <span class="text-success">P</span></div>
                            <div class="mr-3"><?php echo app('translator')->get('lang.late'); ?>: <span class="text-warning">L</span></div>
                            <div class="mr-3"><?php echo app('translator')->get('lang.absent'); ?>: <span class="text-danger">A</span></div>
                            <div class="mr-3"><?php echo app('translator')->get('lang.holiday'); ?>: <span class="text-dark">H</span></div>
                            <div><?php echo app('translator')->get('lang.half_day'); ?>: <span class="text-info">F</span></div>
                        </div>
                        <div class="table-responsive pt-30">
                        <div id="table_id_student_wrapper" class="dataTables_wrapper no-footer">
                        <table id="table_id1" style="margin-bottom:25px" class="display school-table table-responsive" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th width="6%"><?php echo app('translator')->get('lang.staff'); ?> <?php echo app('translator')->get('lang.name'); ?></th>
                                <th width="6%"><?php echo app('translator')->get('lang.staff'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                <th width="6%">P</th>
                                <th width="6%">L</th>
                                <th width="6%">A</th>
                                <th width="6%">H</th>
                                <th width="6%">F</th>
                                <th width="6%">%</th>
                                <?php for($i = 1;  $i<=$days; $i++): ?>
                                <th width="3%" class="<?php echo e(($i<=18)? 'all':'none'); ?>">
                                        <?php echo e($i); ?> <br>
                                        <?php
                                            $date = $year.'-'.$month.'-'.$i;
                                            $day = date("D", strtotime($date));
                                            echo $day;
                                        ?>
                                    </th>
                                <?php endfor; ?>
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $values): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $total_attendance = 0; ?>
                                <?php $count_absent = 0; ?>
                                <tr>
                                    <td>
                                        <?php $student = 0; ?>
                                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $student++; ?>
                                            <?php if($student == 1): ?>
                                                <?php echo e($value->staffInfo->full_name); ?>

                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td>
                                        <?php $student = 0; ?>
                                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $student++; ?>
                                            <?php if($student == 1): ?>
                                                <?php echo e($value->staffInfo->staff_no); ?>

                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td>
                                        <?php $p = 0; ?>
                                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($value->attendence_type == 'P'): ?>
                                                <?php $p++; $total_attendance++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($p); ?>

                                    </td>
                                    <td>
                                        <?php $l = 0; ?>
                                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($value->attendence_type == 'L'): ?>
                                                <?php $l++; $total_attendance++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($l); ?>

                                    </td>
                                    <td>
                                        <?php $a = 0; ?>
                                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($value->attendence_type == 'A'): ?>
                                                <?php $a++; $count_absent++; $total_attendance++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($a); ?>

                                    </td>
                                    <td>
                                        <?php $h = 0; ?>
                                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($value->attendence_type == 'H'): ?>
                                                <?php $h++; $total_attendance++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($h); ?>

                                    </td>
                                    <td>
                                        <?php $f = 0; ?>
                                        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($value->attendence_type == 'F'): ?>
                                                <?php $f++; $total_attendance++; ?>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo e($f); ?>

                                    </td>
                                    <td>
                                        <?php
                                            $total_present = $total_attendance - $count_absent;
                                            if($count_absent == 0){
                                                echo '100%';
                                            }else{
                                                $percentage = $total_present / $total_attendance * 100;
                                                echo number_format((float)$percentage, 2, '.', '').'%';
                                            }
                                        ?>

                                    </td>
                                    <?php for($i = 1;  $i<=$days; $i++): ?>
                                        <?php
                                            $date = $year.'-'.$month.'-'.$i;
                                        ?>
                                        <td width="3%" class="<?php echo e(($i<=18)? 'all':'none'); ?>">
                                            <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(strtotime($value->attendence_date) == strtotime($date)): ?>
                                                    <?php echo e($value->attendence_type); ?>

                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </td>

                                    <?php endfor; ?>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/humanResource/staff_attendance_report.blade.php ENDPATH**/ ?>