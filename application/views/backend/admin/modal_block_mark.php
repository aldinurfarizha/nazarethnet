<div class="modal-body">
    <div class="modal-header mdl-header">
        <h6 class="title text-white">bloque de valor</h6>
    </div>
    <div class="ui-block-content">
        <?php echo form_open(base_url() . 'admin/block_mark', array('enctype' => 'multipart/form-data')); ?>
        <div class="row">
            <input type="hidden" name="student_id" value="<?php echo $param4 ?>">
            <input type="hidden" name="subject_id" value="<?php echo $param3; ?>">
            <input type="hidden" name="course" value="<?php echo $param2; ?>">
            <div class="col-12">
                <div class="form-group label-floating">
                    <label class="control-label">Razon</label>
                    <input class="form-control" name="reason" type="text" placeholder="ejemplo:clase faltante" required="">
                </div>
            </div>
            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                <button class="btn btn-rounded btn-success btn-lg" type="submit"><?php echo getEduAppGTLang('add'); ?></button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>