<div class="modal-body">
    <div class="modal-header mdl-header">
        <h6 class="title text-white">añadir otro estado</h6>
    </div>
    <div class="ui-block-content">
        <?php echo form_open(base_url() . 'admin/add_custom_status_attendance', array('enctype' => 'multipart/form-data')); ?>
        <div class="row">
            <input type="hidden" name="teacher_id" value="<?php echo $param3 ?>">
            <input type="hidden" name="course" value="<?php echo $param2; ?>">
            <div class="col-12">
                <div class="form-group label-floating">
                    <label class="control-label">añadir otro estado</label>
                    <input class="form-control" name="status_name" type="text" placeholder="Vacaciones, Día de Marcado u otros" required="">
                </div>
            </div>
            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                <button class="btn btn-rounded btn-success btn-lg" type="submit"><?php echo getEduAppGTLang('add'); ?></button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>