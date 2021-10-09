
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('lang.home'); ?> <?php echo app('translator')->get('lang.page'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>
    <section class="sms-breadcrumb mb-40 white-box">
        <div class="container-fluid">
            <div class="row justify-content-between">
                <h1><?php echo app('translator')->get('lang.home'); ?> <?php echo app('translator')->get('lang.settings'); ?> <?php echo app('translator')->get('lang.page'); ?></h1>
                <div class="bc-pages">
                    <a href="<?php echo e(route('dashboard')); ?>"><?php echo app('translator')->get('lang.dashboard'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.front'); ?> <?php echo app('translator')->get('lang.settings'); ?></a>
                    <a href="#"><?php echo app('translator')->get('lang.home'); ?> <?php echo app('translator')->get('lang.page'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <section class="admin-visitor-area">
        <div class="container-fluid p-0">
            <div class="row">
                        <div class="col-lg-12">
                            <div class="main-title">
                                <h3 class="mb-30">  <?php echo app('translator')->get('lang.home'); ?> <?php echo app('translator')->get('lang.page'); ?> <?php echo app('translator')->get('lang.update'); ?> </h3>
                            </div> 
                            <?php if(userPermission(494)): ?>
                                <?php echo e(Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'admin-home-page-update', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?> 
                            <?php endif; ?>
                                <div class="white-box">
                                            <div class="row"> 
                                                <div class="col-lg-6"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="title" autocomplete="off" value="<?php echo e(isset($links)?@$links->title:''); ?>">
                                                        <label><?php echo app('translator')->get('lang.title'); ?></label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div> 
                                                <div class="col-lg-6"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="long_title" autocomplete="off"  value="<?php echo e(isset($links)?@$links->long_title:''); ?>" >
                                                        <label><?php echo app('translator')->get('lang.heading'); ?></label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>
                                            </div>   
                                            <div class="row mt-25">  
                                                <div class="col-lg-12 mt-20"> 
                                                    <div class="input-effect">
                                                        <input class="primary-input form-control" type="text" name="short_description" autocomplete="off" value="<?php echo e(isset($links)?@$links->short_description:''); ?>">
                                                        <label><?php echo app('translator')->get('lang.short'); ?> <?php echo app('translator')->get('lang.description'); ?> </label>
                                                        <span class="focus-border"></span>
                                                    </div> 
                                                </div>  
                                            </div>   

 
                                            <div class="row mt-25">                                                 
                                               <script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/print/2.1.1_jquery.min.js"></script>
                                                <div class="col-lg-4 mt-40"> 
                                                    <img src="<?php echo e(isset($links)?@$links->image:''); ?>" style="width: 100%; height: auto;" alt="<?php echo e(isset($links)?@$links->title:''); ?>" id="blah">
                                              
                                                    
                                                    <div class="row no-gutters input-right-icon mt-20">
                                                        <div class="col">
                                                            <div class="input-effect">
                                                                <input class="primary-input" type="text" id="placeholderFileFourName" placeholder="<?php echo app('translator')->get('lang.upload'); ?> <?php echo app('translator')->get('lang.background'); ?> <?php echo app('translator')->get('lang.image'); ?> (1420x670)"
                                                                    readonly="">
                                                                <span class="focus-border"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <button class="primary-btn-small-input" type="button">
                                                                <label class="primary-btn small fix-gr-bg" for="imgInp"><?php echo app('translator')->get('lang.browse'); ?></label>
                                                                <input type="file" class="d-none" name="image" id="imgInp">
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div> 

                                                <div class="col-lg-4"> </div>
                                                <div class="col-lg-4 mt-25"> 
                                                    <p><?php echo app('translator')->get('lang.set_permission_in'); ?> <strong><?php echo app('translator')->get('lang.home'); ?></strong></p>

                                        <?php if(count(@$errors) > 0): ?>
                                                <div class="alert alert-danger">
                                                 
                                                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <p><?php echo e(@$error); ?></p>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                  
                                                </div>
                                        <?php endif; ?>
                                        
                                                    <hr>
                                                    <?php $__currentLoopData = $permisions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <input type="checkbox" id="P<?php echo e(@$row->id); ?>" class="common-checkbox form-control<?php echo e($errors->has('permisions') ? ' is-invalid' : ''); ?>"  name="permisions[]" value="<?php echo e(@$row->id); ?>" <?php echo e((@$row->is_published==1)? 'checked': ''); ?>>
                                                    <label for="P<?php echo e($row->id); ?>"> <?php echo e(@$row->name); ?> </label> 
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <span></span>

                                                </div>

                                            </div>    
                                            <?php 
                                                $tooltip = "";
                                                if(userPermission(494)){
                                                        $tooltip = "";
                                                    }else{
                                                        $tooltip = "You have no permission to add";
                                                    }
                                            ?>
                                            <div class="row mt-25">
                                                <div class="col-lg-12 text-center">
                                                    <?php if(Illuminate\Support\Facades\Config::get('app.app_sync')): ?>
                                                    <span class="d-inline-block" tabindex="0" data-toggle="tooltip" title="Disabled For Demo "> <button class="primary-btn fix-gr-bg  demo_view" style="pointer-events: none;" type="button" ><?php echo app('translator')->get('lang.update'); ?></button></span>
                                                        <?php else: ?>
                                                    <button class="primary-btn fix-gr-bg" data-toggle="tooltip" title="<?php echo e(@$tooltip); ?>">
                                                        <span class="ti-check"></span> 
                                                            <?php echo app('translator')->get('lang.update'); ?> 
                                                    </button>
                                                    <?php endif; ?>
                                                </div>
                                            </div>


                            </div>
                            <?php echo e(Form::close()); ?>

                        </div> 
                </div>
 
            </div>
        </div>
    </section>

 
<?php $__env->stopSection(); ?>


<?php echo $__env->make('backEnd.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/ssc/resources/views/backEnd/systemSettings/homePageBackend.blade.php ENDPATH**/ ?>