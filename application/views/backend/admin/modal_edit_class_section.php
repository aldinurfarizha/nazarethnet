<div class="modal-body">
    <div class="modal-header mdl-header">
        <h6 class="title text-white"><?php echo getEduAppGTLang('edit_class_section'); ?></h6>
    </div>
    <div class="ui-block-content">
        <?php echo form_open(base_url() . 'admin/edit_student_class_section', array('enctype' => 'multipart/form-data')); ?>
        <?php

        $enrollData = getEnrollById($param2);
        $classIdSelected = $enrollData->class_id;
        $sectionIdSelected = $enrollData->section_id;

        ?>
        <div class="row">
            <input type="hidden" name="enroll_id" value="<?php echo $param2; ?>">
            <input type="hidden" name="student_id" value="<?=$enrollData->student_id; ?>">
            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                    <label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
                    <div class="select">
                        <select name="class_id" onchange="get_sections(this.value);" required="">
                            <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                            <?php $classes = $this->db->get('class')->result_array();
                            foreach ($classes as $class) :
                            ?>
                                <option value="<?php echo $class['class_id']; ?>" <?php if ($class['class_id'] == $classIdSelected) echo "selected"; ?>><?php echo $class['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="form-group label-floating is-select">
                    <label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
                    <div class="select">
                        <select name="section_id" id="section_holder" required="">
                            <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                            <?php $sections = $this->db->get_where('section', array('class_id' => $classIdSelected))->result_array();
                            foreach ($sections as $section) :
                            ?>
                                <option value="<?php echo $section['section_id']; ?>" <?php if ($section['section_id'] == $sectionIdSelected) echo "selected"; ?>><?php echo $section['name']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="form-group label-floating">
                    <label class="control-label"><?php echo getEduAppGTLang('roll'); ?></label>
                    <input class="form-control" name="roll" value="<?= $enrollData->roll ?>" type="text" required="">
                </div>
            </div>
            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                <button class="btn btn-rounded btn-success btn-lg" type="submit"><?php echo getEduAppGTLang('update'); ?></button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>