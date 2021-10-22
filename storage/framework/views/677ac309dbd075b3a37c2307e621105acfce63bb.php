
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.book_list'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
<section class="sms-breadcrumb mb-50 white-box">
    <div class="container-fluid">
        <div class="row justify-content-between">
            <h1><?php echo app('translator')->get('lang.book_list'); ?></h1>
            <div class="bc-pages">
                <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.library'); ?></a>
                <a href="#"><?php echo app('translator')->get('lang.book_list'); ?></a>
            </div>
        </div>
    </div>
</section>
<section class="admin-visitor-area up_admin_visitor">
    <div class="container-fluid p-0">
    <div class="row mt-50">
        <div class="col-lg-12">
           <div class="row">
               <div class="col-lg-12">
                    <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                        <thead> 
                            <?php if(session()->has('message-success') != "" ||
                                session()->get('message-danger') != ""): ?>
                            <tr>
                                <td colspan="10">
                                     <?php if(session()->has('message-success')): ?>
                                      <div class="alert alert-success">
                                          <?php echo e(session()->get('message-success')); ?>

                                      </div>
                                    <?php elseif(session()->has('message-danger')): ?>
                                      <div class="alert alert-danger">
                                          <?php echo e(session()->get('message-danger')); ?>

                                      </div>
                                    <?php endif; ?>
                                </td>
                            </tr> 
                            <?php endif; ?>
                            <tr>
                                <th><?php echo app('translator')->get('lang.sl'); ?></th>
                                <th><?php echo app('translator')->get('lang.book_title'); ?></th>
                                <th><?php echo app('translator')->get('lang.book'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                <th><?php echo app('translator')->get('lang.isbn'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                <th><?php echo app('translator')->get('lang.category'); ?></th>
                                
                                <th><?php echo app('translator')->get('lang.publisher'); ?> <?php echo app('translator')->get('lang.name'); ?></th>
                                <th><?php echo app('translator')->get('lang.author_name'); ?></th>
                                <th><?php echo app('translator')->get('lang.quantity'); ?></th>
                                <th><?php echo app('translator')->get('lang.price'); ?></th>
                                <th><?php echo app('translator')->get('lang.action'); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $count=1; ?>
                            <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($count++); ?></td>
                                <td class="text-center"><?php echo e($value->book_title); ?> </td>
                                <td class="text-center"><?php echo e($value->book_number); ?></td>
                                <td class="text-center"><?php echo e($value->isbn_no); ?></td>
                                <td class="text-center">
                                <?php if(!empty($value->book_category_id)): ?>
                                    <?php echo e((@$value->book_category_id != "")? $value->category_name:''); ?>

                                <?php endif; ?>
                                </td>
                                
                                <td class="text-center"><?php echo e($value->publisher_name); ?></td>
                                <td class="text-center"><?php echo e($value->author_name); ?></td>
                                <td class="text-center"><?php echo e($value->quantity); ?></td>
                               <td class="text-center"><?php echo e($value->book_price); ?></td>
                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                            <?php echo app('translator')->get('lang.select'); ?>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                           <?php if(userPermission(302)): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('edit-book',$value->id)); ?>"><?php echo app('translator')->get('lang.edit'); ?></a>
                                        <?php endif; ?>
                                        <?php if(userPermission(303)): ?>
                                            <a class="deleteUrl dropdown-item" data-modal-size="modal-md" title="Delete Book" href="<?php echo e(route('delete-book-view',$value->id   )); ?>"><?php echo app('translator')->get('lang.delete'); ?></a>
                                        <?php endif; ?>
                                       </div>
                                   </div>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/library/bookList.blade.php ENDPATH**/ ?>