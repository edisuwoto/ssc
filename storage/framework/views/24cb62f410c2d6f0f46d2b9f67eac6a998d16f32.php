
<?php $__env->startSection('main_content'); ?>
<?php $__env->startPush('css'); ?>
<style>
    .success-color{
        color: #79838b;
    }
    .danger-color{
        color: #ff0000;
    }
    .ft {
        font-size: 11px;
        position: absolute;
        bottom: -21px;
        left: 0;
    }
</style>
<?php $__env->stopPush(); ?>
    <!--================ Home Banner Area =================-->
    <section class="container box-1420">
        <div class="banner-area" style="background: linear-gradient(0deg, rgba(124, 50, 255, 0.6), rgba(199, 56, 216, 0.6)), url(<?php echo e($contact_info->image != ""? $contact_info->image : '../img/client/common-banner1.jpg'); ?>) no-repeat center;">

            <div class="banner-inner">
                <div class="banner-content">
                    <h2><?php echo e($contact_info->title); ?></h2>
                    <p><?php echo e($contact_info->description); ?></p>

                    <a class="primary-btn fix-gr-bg semi-large" href="<?php echo e(url($contact_info->button_url)); ?>"><?php echo e($contact_info->button_text); ?></a>

                </div>
            </div>
        </div>
    </section>
    <!--================ End Home Banner Area =================-->

   <!--================Contact Area =================-->
   <section class="contact_area section-gap-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="map mapBox"></div>
                </div>
                <div class="offset-lg-1 col-lg-5">
                    <div class="contact_info">
                        <div class="info_item">
                            <i class="ti-home"></i>
                            <h6><?php echo e($contact_info->address); ?></h6>
                            <p><?php echo e($contact_info->address_text); ?></p>
                        </div>
                        <div class="info_item">
                            <i class="ti-headphone-alt"></i>
                            <h6><a href="#"><?php echo e($contact_info->phone); ?></a></h6>
                            <p><?php echo e($contact_info->phone_text); ?></p>
                        </div>
                        <div class="info_item">
                            <i class="ti-envelope"></i>
                            <h6>
                                <a href="#"><?php echo e($contact_info->email); ?></a>
                            </h6>
                            <p><?php echo e($contact_info->email_text); ?></p>
                        </div>
                    </div>
                    <section class="container box-1420 mt-30">
                        </section>
                        <div class="col-lg-12">
                            <div class="input-effect">
                                <input class="primary-input form-control<?php echo e($errors->has('name') ? ' is-invalid' : ''); ?>"
                                    type="text" name="name" id="name" autocomplete="off" value="<?php echo e(old('name')); ?>">
                                <label><?php echo app('translator')->get('lang.Enter_your'); ?> <?php echo app('translator')->get('lang.name'); ?> <span>*</span></label>
                                <span class="focus-border"></span>
                                <span id="nameError" class="text-danger ft"></span>
                            </div>
                            <div class="input-effect mt-30">
                                <input oninput="emailCheck(this)" class="primary-input form-control<?php echo e($errors->has('email') ? ' is-invalid' : ''); ?>" autocomplete="off" type="text" id="email" name="email" value="<?php echo e(old('email')); ?>">
                                <label><?php echo app('translator')->get('lang.Enter_your'); ?> <?php echo app('translator')->get('lang.email'); ?> <span>*</span></label>
                                <span class="focus-border"></span>
                                <span id="emailError" class="text-danger ft"></span>
                            </div>
                            <div class="input-effect mt-30">
                                <input class="primary-input form-control<?php echo e($errors->has('subject') ? ' is-invalid' : ''); ?>" autocomplete="off" type="text" id="subject" name="subject" value="<?php echo e(old('subject')); ?>">
                                <label><?php echo app('translator')->get('lang.enter'); ?> <?php echo app('translator')->get('lang.subject'); ?> <span>*</span></label>
                                <span class="focus-border"></span>
                                <span id="subjectError" class="text-danger ft"></span>
                            </div>
                            <div class="input-effect mt-30 mb-10">
                                <textarea class="primary-input form-control" autocomplete="off" name="message" id="message" cols="0" rows="4"><?php echo e(old('email')); ?></textarea>
                                <label><?php echo app('translator')->get('lang.enter'); ?> <?php echo app('translator')->get('lang.message'); ?> <span>*</span></label>
                                <span class="focus-border textarea"></span>
                                <span id="messageError" class="text-danger ft"></span>
                            </div>
                                <p class=" mt-3 text-success"></p>
                                <p class=" mt-3 text-danger"></p>
                        </div>
                        <input type="hidden" name="url" id="url" value="<?php echo e(URL::to('/')); ?>">
                        <div class="col-md-12 ">
                            <button type="submit" value="submit" id="click_btn" class=" mt-30 primary-btn fix-gr-bg submit">
                               <?php echo app('translator')->get('lang.send_message'); ?>
                            </button>
                        </div>
                    
                </div>
            </div>
        </div>
    </section>
    <!--================Contact Area =================-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/gmap3.min.js"></script>
<script>
    $('.map')
      .gmap3({
        center:[<?php echo $contact_info->latitude;?>, <?php echo $contact_info->longitude;?>],
        zoom:<?php echo $contact_info->zoom_level;?>
      })
      .marker([
        {position:[<?php echo $contact_info->latitude;?>, <?php echo $contact_info->longitude;?>]},
        {address:"<?php echo $contact_info->google_map_address;?>"},
        {address:"<?php echo $contact_info->google_map_address;?>", icon: "https://maps.google.com/mapfiles/marker_grey.png"}
      ])
      .on('click', function (marker) {
        marker.setIcon('https://maps.google.com/mapfiles/marker_green.png');
      });

</script>

<script>
        $(document).ready(function(){
            $("#click_btn").click(function(){
                let url = $('#url').val();
                let name = $('#name').val();
                let email = $('#email').val();
                let subject= $('#subject').val();
                let message = $('#message').val();

                $.ajax({
                    url: url + '/' + 'send-message',
                    method : "POST",
                    data : {
                        name : name,
                        email : email,
                        subject : subject,
                        message : message,
                    },
                    success : function (result){
                        if(result.success){
                            $('#name').val('');
                            $('#email').val('');
                            $('#subject').val('');
                            $('#message').val('');
                            $('.primary-input').removeClass('has-content');
                            $('.text-success').html('Email Sent Successfully');
                            $('#nameError').html();
                            $('#emailError').html();
                            $('#subjectError').html();
                            $('#messageError').html();
                        }else{
                            $('#name').val('');
                            $('#email').val('');
                            $('#subject').val('');
                            $('#message').val('');
                            $('#nameError').html();
                            $('#emailError').html();
                            $('#subjectError').html();
                            $('#messageError').html();
                            $('.primary-input').removeClass('has-content');
                            $('.text-danger').html('Something Went Wrong');
                            $('#nameError').html();
                            $('#emailError').html();
                            $('#subjectError').html();
                            $('#messageError').html();
                        }
                    },
                    error:function (xhr){
                        $('#nameError').html(xhr.responseJSON.errors.name);
                        $('#emailError').html(xhr.responseJSON.errors.email);
                        $('#subjectError').html(xhr.responseJSON.errors.subject);
                        $('#messageError').html(xhr.responseJSON.errors.message);
                    }
                })
            });
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontEnd.home.front_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/frontEnd/home/light_contact.blade.php ENDPATH**/ ?>