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
                    <div class="element-wrapper">
                        <h6 class="element-header">
                            <div class="back backbutton">
                                <a title="Return" href="<?= base_url('admin/final_evaluation_weight/' . $exam_id) ?>"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>
                            </div>
                            Seleccione la prueba que se calculará en el informe final
                            <br>
                            <?= $mark_activity->name ?>
                        </h6>
                        <div class="element-box-tp">
                            <div class="table-responsive">
                                <table class="table table-padded">
                                    <thead>
                                        <tr>
                                            <th><?php echo getEduAppGTLang('name'); ?></th>
                                            <th class="text-center"><?php echo getEduAppGTLang('status'); ?></th>
                                            <th class="text-center"><?php echo getEduAppGTLang('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <?php
                                    foreach ($exam as $row):
                                        $isCounted = 0;
                                        if (isExamCounted($row->exam_id, $mark_activity->mark_activity_id)) {
                                            $isCounted = 1;
                                        }
                                    ?>
                                        <tr>
                                            <td><?= $row->name; ?></td>
                                            <td class="text-center">
                                                <?php if ($isCounted) { ?>
                                                    <span class="badge badge-success">Calculado <i class="fa fa-check"></i></span>
                                                <?php } else { ?>
                                                    <span class="badge badge-danger">No Contado <i class="fa fa-times"></i></span>
                                                <?php } ?>
                                            </td>
                                            <td class="row-actions">
                                                <a class="grey" href="#" data-target="#update_status" data-toggle="modal"
                                                    data-exam_id="<?= $row->exam_id; ?>"
                                                    data-mark_activity_id="<?= $mark_activity->mark_activity_id ?>"
                                                    data-exam_id_final="<?= $exam_id ?>"
                                                    data-is_count="<?= $isCounted; ?>">
                                                    <i class="os-icon picons-thin-icon-thin-0001_compose_write_pencil_new"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="update_status" tabindex="-1" role="dialog" aria-labelledby="update_status" aria-hidden="true">
                        <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
                            <div class="modal-content">
                                <?php echo form_open(base_url() . 'admin/final_evaluation_selected_update'); ?>
                                <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                                <div class="modal-header">
                                    <h6 class="title"><?php echo getEduAppGTLang('update'); ?></h6>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="hidden" name="exam_id" value="">
                                            <input type="hidden" name="mark_activity_id" value="">
                                            <input type="hidden" name="exam_id_final" value="">
                                            <div class="form-group label-floating is-select">
                                                <label class="control-label">Seleccione</label>
                                                <div class="select">
                                                    <select name="is_count" id="">
                                                        <option value="1">Calculado</option>
                                                        <option value="0">No Contado</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo getEduAppGTLang('update'); ?></button>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('[data-toggle="modal"]').forEach(function(button) {
            button.addEventListener('click', function() {
                var examId = this.dataset.exam_id;
                var isCount = this.dataset.is_count;
                var markActivityId = this.dataset.mark_activity_id;
                var examIdFinal = this.dataset.exam_id_final;
                document.querySelector('#update_status input[name="exam_id"]').value = examId;
                document.querySelector('#update_status input[name="mark_activity_id"]').value = markActivityId;
                document.querySelector('#update_status input[name="exam_id_final"]').value = examIdFinal;
                var selectElement = document.querySelector('#update_status select[name="is_count"]');
                selectElement.value = isCount;
            });
        });
    </script>