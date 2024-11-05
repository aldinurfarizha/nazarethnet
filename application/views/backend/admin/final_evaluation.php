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
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="expense-button"><button class="btn btn-success btn-rounded btn-upper" data-target="#new_grade" data-toggle="modal" type="button">+ <?php echo getEduAppGTLang('new'); ?></button></div><br>
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
                                            <th class="text-center"><?php echo getEduAppGTLang('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $grades = $this->db->query('SELECT * FROM exam where is_final=1')->result_array();
                                    foreach ($grades as $row):
                                        $class_id = $row['class_id'];
                                        $section_id = $row['section_id'];
                                    ?>
                                        <tr>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?php echo $this->db->query("SELECT name from class where class_id=$class_id")->row()->name ?></td>
                                            <td><?php echo $this->db->query("SELECT name from section where section_id=$section_id")->row()->name ?></td>
                                            <td class="row-actions">
                                                <a class="grey" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/grade/delete/<?php echo $row['grade_id']; ?>"><i class="os-icon picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                                                <a href="#" class="grey"><i class="picons-thin-icon-thin-0133_arrow_right_next px20"></i></a>
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
                                <?php echo form_open(base_url() . 'admin/grade/create/'); ?>
                                <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                                <div class="modal-header">
                                    <h6 class="title"><?php echo getEduAppGTLang('new'); ?></h6>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group with-button">
                                        <label><?php echo getEduAppGTLang('name'); ?></label>
                                        <input class="form-control" name="name" type="text" required="">
                                    </div>
                                    <div class="form-group with-button">
                                        <label><?php echo getEduAppGTLang('point'); ?></label>
                                        <input class="form-control" name="point" type="text" required="">
                                    </div>
                                    <div class="form-group with-button">
                                        <label><?php echo getEduAppGTLang('mark_from'); ?></label>
                                        <input class="form-control" name="from" type="text" required="">
                                    </div>
                                    <div class="form-group with-button">
                                        <label><?php echo getEduAppGTLang('mark_to'); ?></label>
                                        <input class="form-control" name="to" type="text" required="">
                                    </div>
                                    <button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo getEduAppGTLang('save'); ?></button>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>