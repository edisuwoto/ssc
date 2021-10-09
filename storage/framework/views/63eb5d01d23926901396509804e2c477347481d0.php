<?php
$setting = generalSetting();
if(isset($setting->copyright_text)){
$copyright_text = $setting->copyright_text;
}else{
$copyright_text = 'Copyright 2019 All rights reserved by Codethemes';
}
?>
</div>
</div>

<?php if(env('APP_SYNC') == True): ?>
    <a target="_blank" href="https://1.envato.market/9WVoZ3" class="float_button"> <i class="ti-shopping-cart-full"></i>
        <h3>Purchase InfixEdu</h3>
    </a>
 
<?php endif; ?>    

<div class="has-modal modal fade" id="showDetaildModal">
    <div class="modal-dialog modal-dialog-centered" id="modalSize">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title" id="showDetaildModalTile"><?php echo app('translator')->get('lang.new_client_information'); ?></h4>
                <button type="button" class="close icons" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="showDetaildModalBody">

            </div>
        </div>
    </div>
</div>
<!--  Start Modal Area -->
<div class="modal fade invoice-details" id="showDetaildModalInvoice">
    <div class="modal-dialog large-modal modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo app('translator')->get('lang.add'); ?> <?php echo app('translator')->get('lang.invoice'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="showDetaildModalBodyInvoice">
            </div>
        </div>
    </div>
</div>
<!--================Footer Area ================= -->
<footer class="footer-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <?php if(Auth::check()): ?>
                <p><?php echo $copyright_text; ?> </p>
                <?php else: ?>
                <p><?php echo $copyright_text; ?> </p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>

<!-- ================End Footer Area ================= -->

<script>
    window.jsLang = function(key, replace) {
        let translation, translationNotFound = true

        try {
            translation = key.split('.').reduce((t, i) => t[i] || null, window._translations[window._locale].php)

            if (translation) {
                translationNotFound = false
            }
        } catch (e) {
            translation = key
        }

        if (translationNotFound) {
            translation = window._translations[window._locale]['json'][key]
                ? window._translations[window._locale]['json'][key]
                : key
        }

        $.each(replace, (value, key) => {
            translation = translation.replace(':' + key, value)
        })

        return translation
    }
</script>

<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery-ui.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery.data-tables.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/dataTables.buttons.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/buttons.flash.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jszip.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/pdfmake.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/vfs_fonts.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/buttons.html5.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/buttons.print.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/dataTables.rowReorder.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/dataTables.responsive.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/buttons.colVis.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/popper.js"></script>


<script src="<?php echo e(asset('public/backEnd/')); ?>/css/rtl/bootstrap.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/nice-select.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/fastselect.standalone.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/raphael-min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/morris.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/toastr.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/moment.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/ckeditor.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap_datetimepicker.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?php echo e(asset('public/backEnd/')); ?>/js/jquery.validate.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/select2/select2.min.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/main.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/lesson_plan.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/custom.js"></script>
<script src="<?php echo e(asset('public/')); ?>/js/registration_custom.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/developer.js"></script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/vendors/js/daterangepicker.min.js"></script>



<script type="text/javascript">
    //$('table').parent().addClass('table-responsive pt-4');
    // for select2 multiple dropdown in send email/Sms in Individual Tab
    $("#selectStaffss").select2();
    $("#checkbox").click(function() {
        if ($("#checkbox").is(':checked')) {
            $("#selectStaffss > option").prop("selected", "selected");
            $("#selectStaffss").trigger("change");
        } else {
            $("#selectStaffss > option").removeAttr("selected");
            $("#selectStaffss").trigger("change");
        }
    });

    // for select2 multiple dropdown in send email/Sms in Class tab
    $("#selectSectionss").select2();
    $("#checkbox_section").click(function() {
        if ($("#checkbox_section").is(':checked')) {
            $("#selectSectionss > option").prop("selected", "selected");
            $("#selectSectionss").trigger("change");
        } else {
            $("#selectSectionss > option").removeAttr("selected");
            $("#selectSectionss").trigger("change");
        }
    });
</script>
<script>
    $('.close_modal').on('click', function() {
        $('.custom_notification').removeClass('open_notification');
    });
    $('.notification_icon').on('click', function() {
        $('.custom_notification').addClass('open_notification');
    });
    $(document).click(function(event) {
        if (!$(event.target).closest(".custom_notification").length) {
            $("body").find(".custom_notification").removeClass("open_notification");
        }
    });

    function isNumberKey(evt) {
        var charCode = (evt.which) ? evt.which : (event.keyCode);
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
<script src="<?php echo e(asset('public/backEnd/')); ?>/js/search.js"></script>


<?php echo Toastr::message(); ?>



    <script src="<?php echo e(asset('public/js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('public/chat/js/custom.js')); ?>"></script>





<?php echo $__env->yieldContent('script'); ?>
<?php echo $__env->yieldPushContent('script'); ?>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>

</html><?php /**PATH /Users/edisuwoto/Documents/webdev/ssc/resources/views/backEnd/partials/footer.blade.php ENDPATH**/ ?>