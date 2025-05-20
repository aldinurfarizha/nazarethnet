<div class="modal-body">
    <div class="modal-header mdl-header">
        <h6 class="title text-white"><?php echo getEduAppGTLang('confirm'); ?></h6>
    </div>
    <div class="ui-block-content">
        <?php echo form_open(base_url() . 'admin/generate_certificate', array('enctype' => 'multipart/form-data')); ?>
        <div class="row justify-content-center">
            <!-- Hidden Inputs -->
            <input type="hidden" name="student_id" value="<?php echo $param4 ?>">
            <input type="hidden" name="subject_id" value="<?php echo $param3; ?>">
            <input type="hidden" name="course" value="<?php echo $param2; ?>">
            <!-- Header -->
            <div class="col-12 text-center mb-3">
                <h4 class="text-danger font-weight-bold">
                    <?php echo getEduAppGTLang('are_you_sure'); ?>?
                </h4>
            </div>

            <!-- Description -->
            <div class="col-12 col-md-10 mb-4">
                <div class="alert alert-warning rounded shadow-sm">
                    <ul class="mb-0">
                        <li><?php echo getEduAppGTLang('this_will_mark_this_student_to_finished_on_this_subject'); ?></li>
                        <li><?php echo getEduAppGTLang('this_student_will_be_able_to_view_the_certificate'); ?></li>
                        <li><?php echo getEduAppGTLang('this_student_no_longer_will_appear_in_this_subject'); ?></li>
                    </ul>
                </div>
            </div>

            <!-- Confirm Button -->
            <div class="col-12 text-center">
                <button class="btn btn-success btn-lg btn-rounded px-4 shadow" type="submit">
                    <?php echo getEduAppGTLang('confirm'); ?>
                </button>
            </div>
        </div>

        <?php echo form_close(); ?>
    </div>
</div>