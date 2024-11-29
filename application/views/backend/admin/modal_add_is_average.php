<div class="modal-body">
    <div class="modal-header mdl-header">
        <h6 class="title text-white">Relleno automático</h6>
    </div>
    <div class="ui-block-content">
        <?php echo form_open(base_url() . 'admin/update_is_calculate_avg', array('enctype' => 'multipart/form-data')); ?>
        <?php
        $markActivity = $this->db->query("SELECT * FROM mark_activity where exam_id=$param2 and is_calculate_avg=0")->result();?>
        <div class="row">
            <input type="hidden" name="exam_id" value="<?php echo $param2; ?>">
            <div class="col-12">
                <div class="form-group label-floating is-select">
                    <label class="control-label">Seleccionar</label>
                    <div class="select">
                        <select name="mark_activity_id" id="mark_activity_id" required="">
                                <option value="">--Seleccionar--</option>
                            <?php foreach($markActivity as $row):?>
                                <option <?php if($row->is_calculate_avg){echo 'Selected';}?> value="<?=$row->mark_activity_id?>"><?=$row->name?></option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                <button class="btn btn-rounded btn-success btn-lg" type="submit">Seleccionar</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>