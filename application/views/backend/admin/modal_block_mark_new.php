<div class="modal-body">
    <div class="modal-header mdl-header">
        <h6 class="title text-white">Cambiar el valor del estado de llenado</h6>
    </div>
    <div class="ui-block-content">
        <?php echo form_open(base_url() . 'admin/change_marks_status', array('enctype' => 'multipart/form-data')); ?>
        <div class="row">
            <input type="hidden" name="nota_capacidad_id" value="<?php echo $param3 ?>">
            <input type="hidden" name="course" value="<?php echo $param2; ?>">
            <input type="hidden" name="exam_id" value="<?php echo $param5; ?>">
            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                    <label class="control-label">Estado</label>
                    <div class="select">
                        <select name="is_block">
                            <?php if ($param4 == 0) { ?>
                                <option value="0" selected>Gratis</option>
                                <option value="1">Bloqueado</option>
                            <?php } else { ?>
                                <option value="1" selected>Bloqueado</option>
                                <option value="0">Gratis</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group label-floating">
                    <label class="control-label">razón</label>
                    <input class="form-control" name="reason" type="text" placeholder="razón">
                </div>
            </div>
            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                <button class="btn btn-rounded btn-success btn-lg" type="submit"><?php echo getEduAppGTLang('add'); ?></button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>