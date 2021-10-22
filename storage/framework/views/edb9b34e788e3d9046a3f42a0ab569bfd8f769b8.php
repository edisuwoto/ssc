
<?php $__env->startSection('title'); ?> 
<?php echo app('translator')->get('lang.parent'); ?> <?php echo app('translator')->get('lang.dashboard'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="student-details">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-3">
                    <div class="main-title">
                        <h3 class="mb-20"><?php echo app('translator')->get('lang.my_children'); ?></h3>
                    </div>
                </div>
            </div>
            
            <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Start Student Meta Information -->
                        <div class="main-title">
                            <h3 class="mb-20"><strong> <?php echo e($children->full_name); ?></strong></h3>
                        </div>

                        <?php
                            $student_detail=$children;

                            $totalSubjects = $student_detail->assignSubjects->where('academic_id', generalSetting()->session_id);

                            $online_exams = $student_detail->studentOnlineExams->where('academic_id', generalSetting()->session_id);

                            $teachers =  $student_detail->assignSubject->where('academic_id', generalSetting()->session_id);

                            $issueBooks = $student_detail->bookIssue;
                            $exams = $student_detail->examSchedule->where('academic_id', generalSetting()->session_id) ;

                            $homeworkLists =  $student_detail->homework->where('academic_id', generalSetting()->session_id) ;

                            $attendances =  $student_detail->studentAttendances->where('academic_id', generalSetting()->session_id);

                        ?>
                    </div>
                </div>
                <div class="row">
                    <?php if(userPermission(57)): ?>
                        <div class="col-lg-3 col-md-6">
                            <a href="#" class="d-block">
                                <div class="white-box single-summery">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3><?php echo app('translator')->get('lang.subject'); ?></h3>
                                            <p class="mb-0"><?php echo app('translator')->get('lang.total'); ?> <?php echo app('translator')->get('lang.subject'); ?></p>
                                        </div>
                                        <h1 class="gradient-color2">

                                            <?php if(isset($totalSubjects)): ?>
                                                <?php echo e(count($totalSubjects)); ?>

                                            <?php endif; ?>
                                        </h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if(userPermission(58)): ?>
                        <div class="col-lg-3 col-md-6">
                            <a href="#" class="d-block">
                                <div class="white-box single-summery">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3><?php echo app('translator')->get('lang.notice'); ?></h3>
                                            <p class="mb-0"><?php echo app('translator')->get('lang.total'); ?> <?php echo app('translator')->get('lang.notice'); ?></p>
                                        </div>
                                        <h1 class="gradient-color2">
                                            <?php if(isset($totalNotices)): ?>
                                                <?php echo e(count($totalNotices)); ?>

                                            <?php endif; ?>
                                        </h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if(userPermission(59)): ?>
                        <div class="col-lg-3 col-md-6">
                            <a href="#" class="d-block">
                                <div class="white-box single-summery">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3><?php echo app('translator')->get('lang.exam'); ?></h3>
                                            <p class="mb-0"><?php echo app('translator')->get('lang.total'); ?> <?php echo app('translator')->get('lang.exam'); ?></p>
                                        </div>
                                        <h1 class="gradient-color2">
                                            <?php if(isset($exams)): ?>
                                                <?php echo e(count($exams)); ?>

                                            <?php endif; ?>
                                        </h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if(userPermission(60)): ?>
                        <div class="col-lg-3 col-md-6">
                            <a href="<?php echo e(route('student_online_exam')); ?>" class="d-block">
                                <div class="white-box single-summery">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3><?php echo app('translator')->get('lang.online_exam'); ?></h3>
                                            <p class="mb-0"><?php echo app('translator')->get('lang.total'); ?> <?php echo app('translator')->get('lang.online_exam'); ?></p>
                                        </div>
                                        <h1 class="gradient-color2">
                                            <?php if(isset($online_exams)): ?>
                                                <?php echo e(count($online_exams)); ?>

                                            <?php endif; ?>
                                        </h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if(userPermission(61)): ?>

                        <div class="col-lg-3 col-md-6">
                            <a href="#" class="d-block">
                                <div class="white-box single-summery">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3><?php echo app('translator')->get('lang.teachers'); ?></h3>
                                            <p class="mb-0"><?php echo app('translator')->get('lang.total'); ?> <?php echo app('translator')->get('lang.teachers'); ?></p>
                                        </div>
                                        <h1 class="gradient-color2"> <?php if(isset($teachers)): ?>
                                                <?php echo e(count($teachers)); ?>

                                            <?php endif; ?></h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if(userPermission(62)): ?>
                        <div class="col-lg-3 col-md-6">
                            <a href="#" class="d-block">
                                <div class="white-box single-summery">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3><?php echo app('translator')->get('lang.issued'); ?> <?php echo app('translator')->get('lang.book'); ?></h3>
                                            <p class="mb-0"><?php echo app('translator')->get('lang.total'); ?> <?php echo app('translator')->get('lang.issued'); ?> <?php echo app('translator')->get('lang.book'); ?></p>
                                        </div>
                                        <h1 class="gradient-color2">
                                            <?php if(isset($issueBooks)): ?>
                                                <?php echo e(count($issueBooks)); ?>

                                            <?php endif; ?>
                                        </h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if(userPermission(63)): ?>
                        <div class="col-lg-3 col-md-6">
                            <a href="#" class="d-block">
                                <div class="white-box single-summery">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3><?php echo app('translator')->get('lang.pending'); ?> <?php echo app('translator')->get('lang.home_work'); ?></h3>
                                            <p class="mb-0"><?php echo app('translator')->get('lang.total'); ?> <?php echo app('translator')->get('lang.pending'); ?> <?php echo app('translator')->get('lang.home_work'); ?></p>
                                        </div>
                                        <h1 class="gradient-color2">
                                            <?php if(isset($homeworkLists)): ?>
                                                <?php echo e(count($homeworkLists)); ?>

                                            <?php endif; ?>
                                        </h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if(userPermission(64)): ?>
                        <div class="col-lg-3 col-md-6">
                            <a href="#" class="d-block">
                                <div class="white-box single-summery">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3><?php echo app('translator')->get('lang.attendance'); ?> <?php echo app('translator')->get('lang.in'); ?>  <?php echo app('translator')->get('lang.current_month'); ?></h3>
                                            <p class="mb-0"><?php echo app('translator')->get('lang.total'); ?> <?php echo app('translator')->get('lang.attendance'); ?> <?php echo app('translator')->get('lang.in'); ?>  <?php echo app('translator')->get('lang.current_month'); ?></p>
                                        </div>
                                        <h1 class="gradient-color2">
                                            <?php if(isset($attendances)): ?>
                                                <?php echo e(count($attendances)); ?>

                                            <?php endif; ?>
                                        </h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
                
                <br>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if(userPermission(65)): ?>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30"><?php echo app('translator')->get('lang.calendar'); ?></h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="white-box">
                                <div class='common-calendar'>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>


    </section>

    <div id="fullCalModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span
                                class="sr-only">close</span></button>
                    <h4 id="modalTitle" class="modal-title"></h4>
                </div>
                <div class="modal-body text-center">
                    <img src="" alt="There are no image" id="image" height="150" width="auto">
                    <div id="modalBody"></div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="primary-btn tr-bg" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <?php
    ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>

    <script type="text/javascript">
        /*-------------------------------------------------------------------------------
           Full Calendar Js
        -------------------------------------------------------------------------------*/
        if ($('.common-calendar').length) {
            $('.common-calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                eventClick: function (event, jsEvent, view) {
                    $('#modalTitle').html(event.title);
                    $('#modalBody').html(event.description);
                    $('#image').attr('src', event.url);
                    $('#fullCalModal').modal();
                    return false;
                },
                height: 650,
                events: <?php echo json_encode($calendar_events);?> ,
            });
        }


    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/parentPanel/parent_dashboard.blade.php ENDPATH**/ ?>