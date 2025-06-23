<div class="modal-body">
    <div class="modal-header mdl-header">
        <h6 class="title text-white"><?php echo getEduAppGTLang('add_this_student_to_branch_and_shift'); ?></h6>
    </div>
    <div class="ui-block-content">
        <?php echo form_open(base_url() . 'admin/add_student_to_branch_shifts', array('enctype' => 'multipart/form-data')); ?>
        <div class="row">
            <input type="hidden" name="student_id" value="<?php echo $param2; ?>">
            <?php $studentDetail = getStudentInfo($param2); ?>
            <div class="col-12">
                <div class="form-group label-floating">
                    <label class="control-label"><?php echo getEduAppGTLang('student'); ?></label>
                    <input type="text" disabled class="form-control" value="<?=$studentDetail->first_name?>">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group label-floating is-select">
                    <label class="control-label"><?php echo getEduAppGTLang('branch'); ?></label>
                    <div class="select">
                        <select name="branch_id" required onchange="get_shifts(this.value);">
                            <option value="">--Select Branch--</option>
                            <?php foreach (getActiveBranch() as $branch): ?>
                                <option value="<?=$branch->branch_id;?>"><?=$branch->name;?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group label-floating is-select">
                    <label class="control-label"><?php echo getEduAppGTLang('shifts'); ?></label>
                    <div class="select">
                        <select name="shifts_id" id="shifts_holder" required>
                            <option disabled value="">--Select Shifts--</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                <button class="btn btn-rounded btn-success btn-lg" type="submit"><?php echo getEduAppGTLang('add'); ?></button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>