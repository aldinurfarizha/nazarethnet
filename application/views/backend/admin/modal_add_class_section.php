<div class="modal-body">
    <div class="modal-header mdl-header">
        <h6 class="title text-white"><?php echo getEduAppGTLang('add_class_section'); ?></h6>
    </div>
    <div class="ui-block-content">
        <?php echo form_open(base_url() . 'admin/add_student_class_section', array('enctype' => 'multipart/form-data')); ?>
        <div class="row">
            <input type="hidden" name="student_id" value="<?php echo $param2; ?>">
            <div class="col-12">
                <div class="form-group label-floating is-select">
                    <label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
                    <div class="select">
                        <select name="class_id" required="" onchange="get_sections(this.value);">
                            <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                            <?php $classes = $this->db->get('class')->result_array();
                            foreach ($classes as $class) :
                            ?>
                                <option value="<?php echo $class['class_id']; ?>"><?php echo $class['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group label-floating is-select">
                    <label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
                    <div class="select">
                        <select name="section_id" id="section_holder" required="">
                            <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group label-floating">
                    <label class="control-label"><?php echo getEduAppGTLang('roll'); ?></label>
                    <input class="form-control" name="roll" type="text" required="">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group label-floating is-select">
                    <label class="control-label">Status</label>
                    <div class="select">
                        <select name="is_active" id="is_active" required="">
                            <option value="" selected="true"><?php echo getEduAppGTLang('select'); ?></option>
                            <option value="1">Active</option>
                            <option value="0">Disable</option>
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