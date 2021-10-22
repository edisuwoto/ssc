
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.issued_Book_List'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.issued_Book_List'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.library'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.issued_Book_List'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area up_admin_visitor">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="main-title">
                        <h3 class="mb-30 "><?php echo app('translator')->get('lang.select_criteria'); ?></h3>
                    </div>
                </div>
                <div class="col-lg-4 text-md-right text-left col-md-6 mb-30-lg">
                    <a href="<?php echo e(route('addStaff')); ?>" class="primary-btn small fix-gr-bg">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="white-box">
                        <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'search-issued-book', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <div class="row">
                            <div class="col-lg-4">
                                <select class="niceSelect w-100 bb form-control" name="book_id" id="book_id">
                                    <option data-display="<?php echo app('translator')->get('lang.select_Book_Name'); ?>" value=""><?php echo app('translator')->get('lang.select'); ?> </option>
                                    <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->id); ?>" <?php echo e(isset($book_id)? ($book_id == $value->id? 'selected':''):''); ?>><?php echo e($value->book_title); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>

                            <div class="col-lg-4 mt-30-md">
                                <div class="input-effect">
                                    <input class="primary-input" type="text" name="book_number"
                                            value="<?php echo e(isset($book_number)? $book_number:''); ?>">
                                    <label><?php echo app('translator')->get('lang.search_By_Book_ID'); ?></label>
                                    <span class="focus-border"></span>
                                </div>
                            </div>
                            <div class="col-lg-4 mt-30-md">
                                <select class="niceSelect w-100 bb form-control" name="subject_id" id="subject_id">
                                    <option data-display="<?php echo app('translator')->get('lang.select_subjects'); ?>"
                                            value=""><?php echo app('translator')->get('lang.select'); ?> </option>
                                    <?php $__currentLoopData = $subjects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($value->id); ?>" <?php echo e(isset($subject_id)? ($subject_id == $value->id? 'selected':''):''); ?>>
                                            <?php echo e($value->subject_name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
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
                                <h3 class="mb-0"><?php echo app('translator')->get('lang.all_issued_book'); ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <table id="table_id" class="display school-table" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th><?php echo app('translator')->get('lang.book'); ?> <?php echo app('translator')->get('lang.title'); ?></th>
                                    <th><?php echo app('translator')->get('lang.book'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                    <th><?php echo app('translator')->get('lang.isbn'); ?> <?php echo app('translator')->get('lang.no'); ?></th>
                                    <th><?php echo app('translator')->get('lang.member'); ?> <?php echo app('translator')->get('lang.name'); ?></th>
                                    <th><?php echo app('translator')->get('lang.author'); ?></th>
                                    
                                    <th><?php echo app('translator')->get('lang.issue_date'); ?></th>
                                    <th><?php echo app('translator')->get('lang.return_date'); ?></th>
                                    <th><?php echo app('translator')->get('lang.Status'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $issueBooks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($value->books->book_title); ?></td>
                                        <td><?php echo e($value->books->book_number); ?></td>
                                        <td><?php echo e($value->books->isbn_no); ?></td>
                                        <td><?php echo e($value->memberDetails); ?></td>
                                        <td><?php echo e(@$value->books->author_name); ?></td>
                                        
                                        <td  data-sort="<?php echo e(strtotime($value->given_date)); ?>"><?php echo e($value->given_date != ""? dateConvert($value->given_date):''); ?> </td>
                                        <td  data-sort="<?php echo e(strtotime($value->due_date)); ?>"><?php echo e($value->due_date != ""? dateConvert($value->due_date):''); ?></td>
                                        <td>
                                            <?php if($value->issue_status == 'I'): ?>
                                                <button class="primary-btn small bg-success text-white border-0">
                                                     <?php echo app('translator')->get('lang.issued'); ?>
                                                </button>
                                            <?php endif; ?>
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

<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/library/allIssuedBook.blade.php ENDPATH**/ ?>