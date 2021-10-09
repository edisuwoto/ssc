<?php $page_title="All about Infix School management system; School management software"; ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/')); ?>/frontend/css/new_style.css"/>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('main_content'); ?>
    <!--================ Home Banner Area =================-->
    <section class="container box-1420">
        <div class="banner-area" style="background: linear-gradient(0deg, rgba(124, 50, 255, 0.6), rgba(199, 56, 216, 0.6)), url(<?php echo e($about->image != ""? $about->image : '../img/client/common-banner1.jpg'); ?>) no-repeat center;" >
            <div class="banner-inner">
                <div class="banner-content">
                    <h2><?php echo e($about->title); ?></h2>
                    <p><?php echo e($about->description); ?></p>
                    <a class="primary-btn fix-gr-bg semi-large" href="<?php echo e($about->button_url); ?>"><?php echo e($about->button_text); ?></a>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Home Banner Area =================-->

    <!--================ Start Facts Area =================-->
    <section class="fact-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3><?php echo app('translator')->get('lang.Opened_in'); ?></h3>
                                    <p class="mb-0"><?php echo app('translator')->get('lang.total_students'); ?></p>
                                </div>
                                <h1 class="gradient-color2">
                                    <?php if(isset($totalStudents)): ?>
                                        <?php echo e(count($totalStudents)); ?>

                                    <?php endif; ?>
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 mt-20-lg">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3><?php echo app('translator')->get('lang.students'); ?></h3>
                                    <p class="mb-0"><?php echo app('translator')->get('lang.total_students'); ?></p>
                                </div>
                                <h1 class="gradient-color2">
                                    <?php if(isset($totalStudents)): ?>
                                        <?php echo e(count($totalStudents)); ?>

                                    <?php endif; ?>
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 mt-20-lg">
                    <a href="#" class="d-block">
                        <div class="white-box single-summery">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3><?php echo app('translator')->get('lang.Faculty'); ?></h3>
                                    <p class="mb-0"><?php echo app('translator')->get('lang.Total_Teachers_count'); ?></p>
                                </div>
                                <h1 class="gradient-color2">
                                    <?php if(isset($totalTeachers)): ?>
                                        <?php echo e(count($totalTeachers)); ?>

                                    <?php endif; ?></h1>
                                </h1>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Facts Area =================-->

    <!--================ Our History Area =================-->
    <section class="academics-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title"><?php echo e(@$history->first()->category->category_name); ?></h3>
                        </div>
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="<?php echo e(asset($value->image)); ?>" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="<?php echo e(url('news-details/'.$value->id)); ?>"><?php echo e($value->news_title); ?></a>
                                    </h4>
                                    <p>
                                        <?php echo e($value->news_body); ?>

                                    </p>
                                    <div>
                                        <a href="<?php echo e(url('news-details/'.$value->id)); ?>" class="client-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Our History Area =================-->

    <!--================ Start About Us Area =================-->
    <section class="info-area section-gap-bottom">
        <div class="container">				
            <div class="single-info row mt-40 align-items-center">
                <div class="col-lg-6 col-md-12 text-center pr-lg-0 info-left">
                    <div class="info-thumb">
                        <img src="<?php echo e(asset($about->main_image)); ?>" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 pl-lg-0 info-rigth">
                    <div class="info-content">
                        <h2><?php echo e($about->main_title); ?></h2>
                        <p>
                            <?php echo e($about->main_description); ?>

                        </p>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End About Us Area =================-->

    <!--================ Our Mission and Vision Area =================-->
    <section class="academics-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 class="title"><?php echo e(@$mission->first()->category->category_name); ?></h3>
                        </div>
                    </div>
                    <div class="row">
                        <?php $__currentLoopData = $mission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="academic-item">
                                <div class="academic-img">
                                    <img class="img-fluid" src="<?php echo e(asset($value->image)); ?>" alt="">
                                </div>
                                <div class="academic-text">
                                    <h4>
                                        <a href="<?php echo e(url('news-details/'.$value->id)); ?>"><?php echo e($value->news_title); ?></a>
                                    </h4>
                                    <p>
                                        <?php echo e($value->news_body); ?>

                                    </p>
                                    <div>
                                        <a href="<?php echo e(url('news-details/'.$value->id)); ?>" class="client-btn">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Our Mission and Vision Area =================-->

    <!--================ Start Testimonial Area =================-->
    <section class="testimonial-area relative section-gap">
        <div class="overlay overlay-bg"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="active-testimonial owl-carousel">
                    <?php $__currentLoopData = $testimonial; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="single-testimonial text-center">
                            <div class="d-flex justify-content-center">
                                <div class="thumb">
                                    <?php if(!empty($value->image)): ?>
                                        <img class="img-fluid rounded-circle testimonial-image" src="<?php echo e(asset($value->image)); ?>" alt="">
                                    <?php else: ?>
                                        <img class="img-fluid rounded-circle testimonial-image" src="<?php echo e(asset('public/uploads/sample.jpg')); ?>" alt="">
                                    <?php endif; ?>
                                </div>
                                <div class="meta text-left">
                                    <h4><?php echo e($value->name); ?></h4>
                                    <p><?php echo e($value->designation); ?>, <?php echo e($value->institution_name); ?></p>
                                </div>
                            </div>
                            <p class="desc">
                                <?php echo e($value->description); ?>

                            </p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </section>
    <!--================ End Testimonial Area =================-->
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontEnd.home.front_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/ssc/resources/views/frontEnd/home/light_about.blade.php ENDPATH**/ ?>