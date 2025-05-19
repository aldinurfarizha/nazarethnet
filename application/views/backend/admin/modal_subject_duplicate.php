<?php
$edit_data = $this->db->get_where('subject', array('subject_id' => $param2))->result_array();
foreach ($edit_data as $row):
?>
    <script src="<?php echo base_url(); ?>public/style/js/modal_validation.js"></script>
    <div class="modal-content">
        <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
        <div class="modal-header">
            <h6 class="title"><?php echo getEduAppGTLang('duplicate_subject'); ?> <i class="fa fa-copy"></i></h6>
        </div>
        <?php echo form_open(base_url() . 'admin/courses/duplicate/' . $row['class_id'], array('enctype' => 'multipart/form-data')); ?>
        <div class="modal-body">
            <div class="ui-block-content">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label"><?php echo getEduAppGTLang('name'); ?></label>
                            <input class="form-control" placeholder="" value="<?php echo $row['name'] . ' - ' . getEduAppGTLang('duplicate') . ' ' . rand(1000, 9999); ?>" name="name" type="text" required>
                            <input type="hidden" name="subject_id" value="<?php echo $row['subject_id']; ?>">
                            <input type="hidden" name="duplicate" value="1">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label"><?php echo getEduAppGTLang('about_the_subject'); ?></label>
                            <textarea class="form-control" name="about" required><?php echo $row['about']; ?></textarea>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label class="control-label"><?php echo getEduAppGTLang('icon'); ?></label>
                            <input class="form-control" name="userfile" type="file">
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
                            <div class="select">
                                <select name="class_id" required="">
                                    <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                    <?php
                                    $class_info = $this->db->get('class')->result_array();
                                    foreach ($class_info as $rowd) { ?>
                                        <option value="<?php echo $rowd['class_id']; ?>" <?php if ($row['class_id'] == $rowd['class_id']) echo "selected"; ?>><?php echo $rowd['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
                            <div class="select">
                                <select name="section_id" required="">
                                    <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                    <?php
                                    $class_info = $this->db->get_where('section', array('class_id' => $row['class_id']))->result_array();
                                    foreach ($class_info as $rowd) { ?>
                                        <option value="<?php echo $rowd['section_id']; ?>" <?php if ($row['section_id'] == $rowd['section_id']) echo "selected"; ?>><?php echo $rowd['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('teacher'); ?></label>
                            <div class="select">
                                <select name="teacher_id" required="">
                                    <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                    <?php $teachers = $this->db->get('teacher')->result_array();
                                    foreach ($teachers as $teacher):
                                    ?>
                                        <option value="<?php echo $teacher['teacher_id']; ?>" <?php if ($row['teacher_id'] == $teacher['teacher_id']) echo 'selected'; ?>><?php echo $teacher['first_name'] . " " . $teacher['last_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="control-label"><?php echo getEduAppGTLang('duplicate'); ?></label>
                            <div style="display: flex; flex-wrap: wrap; gap: 20px; padding-top: 10px;">
                                <label style="display: flex; align-items: center; gap: 6px;">
                                    <input type="checkbox" name="duplicate_grades" checked> <?= getEduAppGTLang('grade') ?>
                                </label>
                                <label style="display: flex; align-items: center; gap: 6px;">
                                    <input type="checkbox" name="duplicate_exam" checked> <?= getEduAppGTLang('exam') ?>
                                </label>
                                <label style="display: flex; align-items: center; gap: 6px;">
                                    <input type="checkbox" name="duplicate_home_work" checked> <?= getEduAppGTLang('home_work') ?>
                                </label>
                                <label style="display: flex; align-items: center; gap: 6px;">
                                    <input type="checkbox" name="duplicate_forum" checked> <?= getEduAppGTLang('forum') ?>
                                </label>
                                <label style="display: flex; align-items: center; gap: 6px;">
                                    <input type="checkbox" name="duplicate_study_material" checked> <?= getEduAppGTLang('study_material') ?>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label text-white"><?php echo getEduAppGTLang('color'); ?></label>
                            <input class="jscolor" name="color" value="<?php echo $row['color']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-success btn-lg full-width" type="submit"><?php echo getEduAppGTLang('duplicate'); ?> <i class="fa fa-copy"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
<?php endforeach; ?>