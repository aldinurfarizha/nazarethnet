    <div class="content-w">
        <?php include 'fancy.php'; ?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs">
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/general_reports/"><i class="picons-thin-icon-thin-0658_cup_place_winner_award_prize_achievement"></i> <span><?php echo getEduAppGTLang('classes'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/students_report/"><i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i> <span><?php echo getEduAppGTLang('students'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/attendance_report/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i> <span><?php echo getEduAppGTLang('attendance'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/grades_report/"><i class="picons-thin-icon-thin-0101_notes_text_notebook"></i> <span><?php echo getEduAppGTLang('grades_report'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/marks_report/"><i class="picons-thin-icon-thin-0100_to_do_list_reminder_done"></i> <span><?php echo getEduAppGTLang('final_marks'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url(); ?>admin/final_evaluation/"><i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i> <span>Evaluaciones Finales</span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/tabulation_report/"><i class="picons-thin-icon-thin-0070_paper_role"></i> <span><?php echo getEduAppGTLang('tabulation_sheet'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/accounting_report/"><i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash"></i> <span><?php echo getEduAppGTLang('accounting'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/import_data/"><i class="picons-thin-icon-thin-0126_cloud_upload_backup"></i> <span><?php echo getEduAppGTLang('import_data'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/export_data/"><i class="picons-thin-icon-thin-0122_download_file_computer_drive"></i> <span><?php echo getEduAppGTLang('export_data'); ?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="expense-button"><button class="btn btn-success btn-rounded btn-upper" data-target="#new_grade" data-toggle="modal" type="button">+ <?php echo getEduAppGTLang('add'); ?></button></div><br>
                    <div class="element-wrapper">
                        <h6 class="element-header"><?php echo getEduAppGTLang('exam'); ?></h6>
                        <div class="element-box-tp">
                            <div class="table-responsive">
                                <table class="table table-padded">
                                    <thead>
                                        <tr>
                                            <th><?php echo getEduAppGTLang('exam'); ?></th>
                                            <th><?php echo getEduAppGTLang('class'); ?></th>
                                            <th><?php echo getEduAppGTLang('section'); ?></th>
                                            <th><?php echo getEduAppGTLang('subject'); ?></th>
                                            <th class="text-center"><?php echo getEduAppGTLang('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $grades = $this->db->query('SELECT * FROM exam where is_final=1')->result_array();
                                    foreach ($grades as $row):
                                        if(isSuperAdmin()===false){
                                            $classDetail=$this->db->get_where('class',array('class_id'=>$row['class_id']))->row();
                                            if($classDetail->branch_id != getMyBranchId()->branch_id){
                                                continue;
                                            }
                                        }
                                        $class_id = $row['class_id'];
                                        $section_id = $row['section_id'];
                                        $subject_id = $row['subject_id'];
                                    ?>
                                        <tr>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?= getClassNameById($class_id) ?></td>
                                            <td><?= getSectionNameById($section_id) ?></td>
                                            <td><?= getSubjectNameById($subject_id) ?></td>
                                            <td class="row-actions">
                                                <a class="grey" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/final_evaluation_delete_exam/<?php echo $row['exam_id']; ?>"><i class="os-icon picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                                                <a href="<?php echo base_url(); ?>admin/final_evaluation_weight/<?php echo $row['exam_id']; ?>" class="grey"><i class="picons-thin-icon-thin-0133_arrow_right_next px20"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="new_grade" tabindex="-1" role="dialog" aria-labelledby="new_grade" aria-hidden="true">
                        <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
                            <div class="modal-content">
                                <?php echo form_open(base_url() . 'admin/final_evaluation_add_exam'); ?>
                                <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                                <div class="modal-header">
                                    <h6 class="title">añadir nuevo examen final</h6>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group is-select">
                                                <label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
                                                <div class="select">
                                                    <select name="class_id" required="" onchange="get_sections(this.value)">
                                                        <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                                        <?php
                                                        $class = $this->db->get('class')->result_array();
                                                        foreach ($class as $row): ?>
                                                            <option value="<?php echo $row['class_id']; ?>" <?php if ($class_id == $row['class_id']) echo "selected"; ?>><?php echo $row['name']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group is-select">
                                                <label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
                                                <div class="select">
                                                    <?php if ($section_id == ""): ?>
                                                        <select name="section_id" required id="section_holder" onchange="get_class_subjects(this.value)">
                                                            <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                                        </select>
                                                    <?php else: ?>
                                                        <select name="section_id" required id="section_holder" onchange="get_class_subjects(this.value)">
                                                            <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                                            <?php
                                                            $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
                                                            foreach ($sections as $key):
                                                            ?>
                                                                <option value="<?php echo $key['section_id']; ?>" <?php if ($section_id == $key['section_id']) echo "selected"; ?>><?php echo $key['name']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group is-select">
                                                <label class="control-label"><?php echo getEduAppGTLang('subject'); ?></label>
                                                <div class="select">
                                                    <?php if ($subject_id == ""): ?>
                                                        <select name="subject_id" required id="subject_holder" onchange="get_exam(this.value)">
                                                            <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                                        </select>
                                                    <?php else: ?>
                                                        <select name="subject_id" required id="subject_holder" onchange="get_exam(this.value)">
                                                            <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                                            <?php
                                                            $subject = $this->db->get_where('subject', array('section_id' => $section_id))->result_array();
                                                            foreach ($subject as $key):
                                                            ?>
                                                                <option value="<?php echo $key['subject_id']; ?>" <?php if ($section_id == $key['section_id']) echo "selected"; ?>><?php echo $key['name']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group is-select">
                                                <label class="control-label"><?php echo getEduAppGTLang('exam'); ?></label>
                                                <div class="select">
                                                    <?php if ($exam_id == ""): ?>
                                                        <select name="exam_id" required id="exam_holder">
                                                            <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                                        </select>
                                                    <?php else: ?>
                                                        <select name="exam_id" required id="exam_holder">
                                                            <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                                            <?php
                                                            $exam = $this->db->get_where('exam', array('class_id' => $class_id, 'section_id' => $section_id))->result_array();
                                                            foreach ($exam as $key):
                                                            ?>
                                                                <option value="<?php echo $key['exam_id']; ?>" <?php if ($exam_id == $key['exam_id']) echo "selected"; ?>><?php echo $key['name']; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo getEduAppGTLang('add'); ?></button>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>