<?php if(userPermission(56) && menuStatus(56)): ?>
<li data-position="<?php echo e(menuPosition(56)); ?>" class="sortable_li">
   <a href="<?php echo e(route('parent-dashboard')); ?>">
       <span class="flaticon-resume"></span>
       <?php echo app('translator')->get('lang.dashboard'); ?>
   </a>
</li>
<?php endif; ?>
<?php if(userPermission(66) && menuStatus(66)): ?>
   <li data-position="<?php echo e(menuPosition(66)); ?>" class="sortable_li">
       <a href="#subMenuParentMyChildren" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
           <span class="flaticon-reading"></span>
           <?php echo app('translator')->get('lang.my_children'); ?>
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentMyChildren">
           

           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                   <a href="<?php echo e(route('my_children', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>
<?php if(userPermission(71) && menuStatus(71)): ?>
   <li data-position="<?php echo e(menuPosition(71)); ?>" class="sortable_li">
       <a href="#subMenuParentFees" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
           <span class="flaticon-wallet"></span>
           <?php echo app('translator')->get('lang.fees'); ?>
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentFees">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <?php if(moduleStatusCheck('FeesCollection')== false ): ?>
               <li>
                   <a href="<?php echo e(route('parent_fees', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php else: ?>
               <li>
                   <a href="<?php echo e(route('feescollection/parent-fee-payment', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>

           <?php endif; ?>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>
<?php if(userPermission(72) && menuStatus(72)): ?>
   <li data-position="<?php echo e(menuPosition(72)); ?>" class="sortable_li">
       <a href="#subMenuParentClassRoutine" data-toggle="collapse" aria-expanded="false"
       class="dropdown-toggle">
           <span class="flaticon-calendar-1"></span>
           <?php echo app('translator')->get('lang.class_routine'); ?>
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentClassRoutine">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                   <a href="<?php echo e(route('parent_class_routine', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>

<?php if(userPermission(97) && menuStatus(97)): ?>
   <li data-position="<?php echo e(menuPosition(97)); ?>" class="sortable_li">
       <a href="#subMenuLessonPlan" data-toggle="collapse" aria-expanded="false"
       class="dropdown-toggle">
           <span class="flaticon-calendar-1"></span>
           <?php echo app('translator')->get('lang.lesson'); ?>
       </a>
       <ul class="collapse list-unstyled" id="subMenuLessonPlan">
            <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>           
             <?php if(userPermission(98) && menuStatus(98)): ?>
               <li data-position="<?php echo e(menuPosition(98)); ?>" >
                  <a href="<?php echo e(route('lesson-parent-lessonPlan',[$children->id])); ?>"> <?php echo e($children->full_name); ?>-Lesson plan</a>
               </li>
               <?php endif; ?>
               <?php if(userPermission(99) && menuStatus(99)): ?>
                 <li data-position="<?php echo e(menuPosition(99)); ?>" >
                 <a href="<?php echo e(route('lesson-parent-lessonPlan-overview',[$children->id])); ?>">  <?php echo e($children->full_name); ?>- Lesson plan overview</a>
               </li>
               <?php endif; ?>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>
<?php if(userPermission(73) && menuStatus(73)): ?>
   <li data-position="<?php echo e(menuPosition(73)); ?>" class="sortable_li">
       <a href="#subMenuParentHomework" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
           <span class="flaticon-book"></span>
           <?php echo app('translator')->get('lang.home_work'); ?>
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentHomework">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                   <a href="<?php echo e(route('parent_homework', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>
<?php if(userPermission(75) && menuStatus(75)): ?>
   <li data-position="<?php echo e(menuPosition(75)); ?>" class="sortable_li">
       <a href="#subMenuParentAttendance" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
           <span class="flaticon-authentication"></span>
           <?php echo app('translator')->get('lang.attendance'); ?>
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentAttendance">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                   <a href="<?php echo e(route('parent_attendance', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>
<?php if(userPermission(76) && menuStatus(76)): ?>
   <li data-position="<?php echo e(menuPosition(76)); ?>" class="sortable_li">
       <a href="#subMenuParentExamination" data-toggle="collapse" aria-expanded="false"
       class="dropdown-toggle">
           <span class="flaticon-test"></span>
           <?php echo app('translator')->get('lang.exam'); ?>
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentExamination">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <?php if(userPermission(77) && menuStatus(77)): ?>
                   <li  data-position="<?php echo e(menuPosition(77)); ?>">
                       <a href="<?php echo e(route('parent_examination', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
                   </li>
               <?php endif; ?>
               <?php if(userPermission(78) && menuStatus(78)): ?>
                   <li  data-position="<?php echo e(menuPosition(78)); ?>">
                       <a href="<?php echo e(route('parent_exam_schedule', [$children->id])); ?>"><?php echo app('translator')->get('lang.exam_schedule'); ?></a>
                   </li>
               <?php endif; ?>


               


               <hr>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>

<?php if(moduleStatusCheck('OnlineExam') == false): ?>
    
    <?php if(userPermission(2016) && menuStatus(2016)): ?>
    <li data-position="<?php echo e(menuPosition(2016)); ?>" class="sortable_li">
        <a href="#subMenuOnlineExam" data-toggle="collapse" aria-expanded="false"
        class="dropdown-toggle">
            <span class="flaticon-test"></span>
            <?php echo app('translator')->get('lang.online'); ?> <?php echo app('translator')->get('lang.exam'); ?>
        </a>
        <ul class="collapse list-unstyled" id="subMenuOnlineExam">
            <?php if(moduleStatusCheck('OnlineExam') == false ): ?> 
                <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <?php if(userPermission(2018) && menuStatus(2018)): ?>
                    <li  data-position="<?php echo e(menuPosition(2018)); ?>">
                        <a href="<?php echo e(route('parent_online_examination', [$children->id])); ?>"><?php echo app('translator')->get('lang.online_exam'); ?> - <?php echo e($children->full_name); ?></a>
                    </li>
                    <?php endif; ?>
                    <?php if(userPermission(2017) && menuStatus(2017)): ?>
                        <li  data-position="<?php echo e(menuPosition(2017)); ?>">
                        <a href="<?php echo e(route('parent_online_examination_result', [$children->id])); ?>"><?php echo app('translator')->get('lang.online_exam'); ?> <?php echo app('translator')->get('lang.result'); ?> - <?php echo e($children->full_name); ?></a>
                    </li>
                <?php endif; ?>
                <hr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endif; ?>      
            </ul>
        </li>
        <?php endif; ?> 
<?php endif; ?>
    <?php if(moduleStatusCheck('OnlineExam') == true): ?>
        
        <?php if(userPermission(2101) && menuStatus(2101)): ?>
        <li data-position="<?php echo e(menuPosition(79)); ?>" class="sortable_li">
            <a href="#subMenuOnlineExamModule" data-toggle="collapse" aria-expanded="false"
            class="dropdown-toggle">
                <span class="flaticon-test"></span>
                <?php echo app('translator')->get('lang.online'); ?> <?php echo app('translator')->get('lang.exam'); ?>
            </a>
            <ul class="collapse list-unstyled" id="subMenuOnlineExamModule">
                
                
                    <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(userPermission(2001) && menuStatus(2001)): ?>                           
                            <li data-position="<?php echo e(menuPosition(2001)); ?>">                                            
                                <a href="<?php echo e(route('om_parent_online_examination',$children->id)); ?>">  <?php echo app('translator')->get('lang.online_exam'); ?> - <?php echo e($children->full_name); ?> </a>
                            </li>  
                        <?php endif; ?>
                        <?php if(userPermission(2002) && menuStatus(2002)): ?>                           
                            <li data-position="<?php echo e(menuPosition(2002)); ?>">                                            
                                <a href="<?php echo e(route('om_parent_online_examination_result',$children->id)); ?>">  <?php echo app('translator')->get('lang.online_exam'); ?> <?php echo app('translator')->get('lang.result'); ?> - <?php echo e($children->full_name); ?> </a>
                            </li>  
                        <?php endif; ?>
                        <?php if(userPermission(2103) && menuStatus(2103)): ?>                           
                            <li data-position="<?php echo e(menuPosition(2103)); ?>">                                            
                                <a href="<?php echo e(route('parent_pdf_exam',$children->id)); ?>">  <?php echo app('translator')->get('lang.pdf_exam'); ?> - <?php echo e($children->full_name); ?> </a>
                            </li>  
                        <?php endif; ?>                                   
                        <?php if(userPermission(2104) && menuStatus(2104)): ?>   
                            <li data-position="<?php echo e(menuPosition(2104)); ?>"> 
                                <a href="<?php echo e(route('parent_view_pdf_result',$children->id)); ?>"> <?php echo app('translator')->get('lang.pdf_exam'); ?> <?php echo app('translator')->get('lang.result'); ?> - <?php echo e($children->full_name); ?> </a>
                            </li> 
                        <?php endif; ?> 
                                            
                        <hr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
                
                </ul>
            </li>
            <?php endif; ?> 
    <?php endif; ?> 


<?php if(userPermission(80) && menuStatus(80)): ?>
   <li data-position="<?php echo e(menuPosition(80)); ?>" class="sortable_li">
       <a href="#subMenuParentLeave" data-toggle="collapse" aria-expanded="false"
       class="dropdown-toggle">
           <span class="flaticon-test"></span>
           <?php echo app('translator')->get('lang.leave'); ?>
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentLeave">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li >
                   <a href="<?php echo e(route('parent_leave', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
           <?php if(userPermission(81) && menuStatus(81)): ?>
               <li  data-position="<?php echo e(menuPosition(81)); ?>">
                   <a href="<?php echo e(route('parent-apply-leave')); ?>"><?php echo app('translator')->get('lang.apply_leave'); ?></a>
               </li>
           <?php endif; ?>
           <?php if(userPermission(82) && menuStatus(82)): ?>
               <li  data-position="<?php echo e(menuPosition(82)); ?>">
                   <a href="<?php echo e(route('parent-pending-leave')); ?>"><?php echo app('translator')->get('lang.pending_leave_request'); ?></a>
               </li>
           <?php endif; ?>
           
       </ul>
   </li>
<?php endif; ?>
<?php if(userPermission(85) && menuStatus(85)): ?>
   <li data-position="<?php echo e(menuPosition(85)); ?>" class="sortable_li">
       <a href="<?php echo e(route('parent_noticeboard')); ?>">
           <span class="flaticon-poster"></span>
           <?php echo app('translator')->get('lang.notice_board'); ?>
       </a>
   </li>
<?php endif; ?>
<?php if(userPermission(86) && menuStatus(86)): ?>
   <li data-position="<?php echo e(menuPosition(86)); ?>" class="sortable_li">
       <a href="#subMenuParentSubject" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
           <span class="flaticon-reading-1"></span>
           <?php echo app('translator')->get('lang.subjects'); ?>
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentSubject">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                   <a href="<?php echo e(route('parent_subjects', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>
<?php if(userPermission(87) && menuStatus(87)): ?>
   <li data-position="<?php echo e(menuPosition(87)); ?>" class="sortable_li">
       <a href="#subMenuParentTeacher" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
           <span class="flaticon-professor"></span>
           <?php echo app('translator')->get('lang.teacher_list'); ?>
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentTeacher">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                   <a href="<?php echo e(route('parent_teacher_list', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>
<?php if(userPermission(88) && menuStatus(88)): ?>
   <li data-position="<?php echo e(menuPosition(88)); ?>" class="sortable_li">
       <a href="#subMenuStudentLibrary" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"
       href="#">
           <span class="flaticon-book-1"></span>
           <?php echo app('translator')->get('lang.library'); ?>
       </a>
       <ul class="collapse list-unstyled" id="subMenuStudentLibrary">
           <?php if(userPermission(89) && menuStatus(89)): ?>
               <li data-position="<?php echo e(menuPosition(89)); ?>">
                   <a href="<?php echo e(route('parent_library')); ?>"> <?php echo app('translator')->get('lang.book_list'); ?></a>
               </li>
           <?php endif; ?>
           <?php if(userPermission(90) && menuStatus(90)): ?>
               <li data-position="<?php echo e(menuPosition(90)); ?>">
                   <a href="<?php echo e(route('parent_book_issue')); ?>"><?php echo app('translator')->get('lang.book_issue'); ?></a>
               </li>
           <?php endif; ?>
       </ul>
   </li>
<?php endif; ?>
<?php if(userPermission(91) && menuStatus(91)): ?>
   <li data-position="<?php echo e(menuPosition(91)); ?>" class="sortable_li">
       <a href="#subMenuParentTransport" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
           <span class="flaticon-bus"></span>
           <?php echo app('translator')->get('lang.transport'); ?>
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentTransport">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                   <a href="<?php echo e(route('parent_transport', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>
<?php if(userPermission(92) && menuStatus(92)): ?>
   <li data-position="<?php echo e(menuPosition(92)); ?>" class="sortable_li">
       <a href="#subMenuParentDormitory" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
           <span class="flaticon-hotel"></span>
           <?php echo app('translator')->get('lang.dormitory_list'); ?>
       </a>
       <ul class="collapse list-unstyled" id="subMenuParentDormitory">
           <?php $__currentLoopData = $childrens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <li>
                   <a href="<?php echo e(route('parent_dormitory_list', [$children->id])); ?>"><?php echo e($children->full_name); ?></a>
               </li>
           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </ul>
   </li>
<?php endif; ?>

<!-- chat module sidebar -->

 <?php if(userPermission(910) && menuStatus(910)): ?>
<li  data-position="<?php echo e(menuPosition(900)); ?>" class="sortable_li">
    <a href="#subMenuChat" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
        <span class="flaticon-test"></span>
        <?php echo app('translator')->get('lang.chat'); ?>
    </a>
    <ul class="collapse list-unstyled" id="subMenuChat">
        <?php if(userPermission(911) && menuStatus(911)): ?>
        <li  data-position="<?php echo e(menuPosition(901)); ?>" >
            <a href="<?php echo e(route('chat.index')); ?>"><?php echo app('translator')->get('lang.chat'); ?> <?php echo app('translator')->get('lang.box'); ?></a>
        </li>
        <?php endif; ?>

        <?php if(userPermission(913) && menuStatus(913)): ?>
        <li data-position="<?php echo e(menuPosition(903)); ?>" >
            <a href="<?php echo e(route('chat.invitation')); ?>"><?php echo app('translator')->get('lang.invitation'); ?></a>
        </li>
        <?php endif; ?>

        <?php if(userPermission(914) && menuStatus(914)): ?>
            <li data-position="<?php echo e(menuPosition(904)); ?>" >
                <a href="<?php echo e(route('chat.blocked.users')); ?>"><?php echo app('translator')->get('lang.blocked'); ?> <?php echo app('translator')->get('lang.user'); ?></a>
            </li>
        <?php endif; ?>

     
    </ul>
</li>
<?php endif; ?>

<!-- BBB Menu  -->   
     <?php if(moduleStatusCheck('BBB') == true): ?>
        <?php if(userPermission(105) && menuStatus(105)): ?>
                <li data-position="<?php echo e(menuPosition(105)); ?>" class="sortable_li">
                <a href="#bigBlueButtonMenu" data-toggle="collapse" aria-expanded="false"
                class="dropdown-toggle">
                    <span class="flaticon-reading"></span>
                <?php echo app('translator')->get('lang.bbb'); ?>
                </a>
                            <ul class="collapse list-unstyled" id="bigBlueButtonMenu">
                                <?php if(userPermission(106) && menuStatus(106)): ?>
                                    <li data-position="<?php echo e(menuPosition(106)); ?>" >
                                        <a href="<?php echo e(route('bbb.virtual-class')); ?>"><?php echo app('translator')->get('lang.virtual_class'); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if(userPermission(107) && menuStatus(107)): ?>
                                    <li data-position="<?php echo e(menuPosition(107)); ?>" >
                                        <a href="<?php echo e(route('bbb.meetings')); ?>"><?php echo app('translator')->get('lang.virtual_meeting'); ?></a>
                                    </li>
                                <?php endif; ?>

                                <?php if(userPermission(115) && menuStatus(115)): ?>
                                <li data-position="<?php echo e(menuPosition(115)); ?>" >
                                    <a href="<?php echo e(route('bbb.parent.class.recording.list')); ?>"> <?php echo app('translator')->get('lang.class'); ?> <?php echo app('translator')->get('lang.record'); ?> <?php echo app('translator')->get('lang.list'); ?></a>
                                </li>
                                <?php endif; ?>
                            
                                <?php if(userPermission(116) && menuStatus(116)): ?>
                                    <li data-position="<?php echo e(menuPosition(116)); ?>" >
                                        <a href="<?php echo e(route('bbb.parent.meeting.recording.list')); ?>"> <?php echo app('translator')->get('lang.meeting'); ?> <?php echo app('translator')->get('lang.record'); ?> <?php echo app('translator')->get('lang.list'); ?></a>
                                    </li>
                                <?php endif; ?>

                            </ul>
                </li>

        <?php endif; ?>    

<?php endif; ?>
<!-- BBB  Menu end -->   
<!-- Jitsi Menu  -->      
    <?php if(moduleStatusCheck('Jitsi')==true): ?>
     <?php if(userPermission(108) && menuStatus(108)): ?>
        <li data-position="<?php echo e(menuPosition(108)); ?>" class="sortable_li">
                <a href="#subMenuJisti" data-toggle="collapse" aria-expanded="false"
                class="dropdown-toggle">
                    <span class="flaticon-reading"></span>
                <?php echo app('translator')->get('lang.jitsi'); ?>
                </a>
                <ul class="collapse list-unstyled" id="subMenuJisti">
                    <?php if(userPermission(109) && menuStatus(109)): ?>
                        <li data-position="<?php echo e(menuPosition(109)); ?>" >
                            <a href="<?php echo e(route('jitsi.virtual-class')); ?>"><?php echo app('translator')->get('lang.virtual_class'); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(userPermission(110) && menuStatus(110)): ?>
                        <li data-position="<?php echo e(menuPosition(110)); ?>" >
                            <a href="<?php echo e(route('jitsi.meetings')); ?>"><?php echo app('translator')->get('lang.virtual_meeting'); ?></a>
                        </li>
                    <?php endif; ?>
                
                </ul>
        </li>

    <?php endif; ?>        
<?php endif; ?>
<!-- jitsi Menu end -->

<!-- Zomm Menu  start -->
     <?php if(moduleStatusCheck('Zoom') == TRUE): ?>

        <?php if(userPermission(100) && menuStatus(100)): ?>
            <li data-position="<?php echo e(menuPosition(100)); ?>" class="sortable_li">
                <a href="#zoomMenu" data-toggle="collapse" aria-expanded="false"
                class="dropdown-toggle">
                    <span class="flaticon-reading"></span>
                <?php echo app('translator')->get('lang.zoom'); ?>
                </a>
                <ul class="collapse list-unstyled" id="zoomMenu">
                    <?php if(userPermission(101) && menuStatus(101)): ?>
                        <li data-position="<?php echo e(menuPosition(101)); ?>" >
                            <a href="<?php echo e(route('zoom.virtual-class')); ?>"><?php echo app('translator')->get('lang.virtual_class'); ?></a>
                        </li>
                    <?php endif; ?>
                    <?php if(userPermission(103) && menuStatus(103)): ?>
                        <li data-position="<?php echo e(menuPosition(103)); ?>" >
                            <a href="<?php echo e(route('zoom.meetings')); ?>"><?php echo app('translator')->get('lang.virtual_meeting'); ?></a>
                        </li>
                    <?php endif; ?>

                </ul>
            </li>
        <?php endif; ?>
<?php endif; ?>
<!-- zoom Menu  --><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/partials/parents_sidebar.blade.php ENDPATH**/ ?>