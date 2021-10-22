
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.member'); ?> <?php echo app('translator')->get('lang.list'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-40 white-box">
  <div class="container-fluid">
    <div class="row justify-content-between">
      <h1><?php echo app('translator')->get('lang.issue_books'); ?></h1>
      <div class="bc-pages">
        <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
        <a href="#"><?php echo app('translator')->get('lang.library'); ?></a>
        <a href="#"><?php echo app('translator')->get('lang.issue_books'); ?></a>
      </div>
    </div>
  </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
  <div class="container-fluid p-0">

    <div class="row mt-40">
      <div class="col-lg-12">
        <?php echo $__env->make('backEnd.partials.alertMessage', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="row">
         <div class="col-lg-12">
          <table id="table_id" class="display school-table" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th width="15%"><?php echo app('translator')->get('lang.member'); ?> <?php echo app('translator')->get('lang.id'); ?></th>
                <th width="15%"><?php echo app('translator')->get('lang.full_name'); ?></th>
                <th width="15%"><?php echo app('translator')->get('lang.member_type'); ?></th>
                <th width="15%"><?php echo app('translator')->get('lang.phone'); ?></th>
                <th width="15%"><?php echo app('translator')->get('lang.email'); ?></th>
                <th width="15%"><?php echo app('translator')->get('lang.action'); ?></th>
              </tr>
            </thead>

            <tbody>
               <?php $__currentLoopData = $activeMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
                <td><?php echo e($value->member_ud_id); ?></td>

                <td>

                  <?php if($value->member_type == '2'): ?>
                      <?php echo e($value->studentDetails != ""? $value->studentDetails->full_name:''); ?>

                  <?php elseif($value->member_type == '3'): ?>
                      <?php echo e($value->parentsDetails != ""? $value->parentsDetails->fathers_name:''); ?>

                  <?php else: ?>
                      <?php echo e($value->staffDetails != ""? $value->staffDetails->full_name:''); ?>

                  <?php endif; ?>

                </td>

                <td><?php echo e($value->memberTypes->name); ?></td>
                <td>
                  <?php if($value->member_type == '2'): ?>
                      <?php echo e($value->studentDetails != ""? $value->studentDetails->mobile:''); ?>

                  <?php elseif($value->member_type == '3'): ?>
                      <?php echo e($value->parentsDetails != ""? $value->parentsDetails->fathers_mobile:''); ?>

                  <?php else: ?>
                      <?php echo e($value->staffDetails != ""? $value->staffDetails->mobile:''); ?>

                  <?php endif; ?>

                  </td>
                <td>
                  <?php if($value->member_type == '2'): ?>
                      <?php echo e($value->studentDetails != ""? $value->studentDetails->email:''); ?>

                  <?php elseif($value->member_type == '3'): ?>
                      <?php echo e($value->parentsDetails != ""? $value->parentsDetails->guardians_email:''); ?>

                  <?php else: ?>
                      <?php echo e($value->staffDetails != ""? $value->staffDetails->email:''); ?>

                  <?php endif; ?>
                </td>
                <td>
                    <a class="primary-btn fix-gr-bg nowrap" href="<?php echo e(route('issue-books',[@$value->member_type,@$value->student_staff_id])); ?>"><?php echo app('translator')->get('lang.issue_return_Book'); ?></a>
                </td>
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
  <?php $__env->stopSection(); ?>

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/library/memberLists.blade.php ENDPATH**/ ?>