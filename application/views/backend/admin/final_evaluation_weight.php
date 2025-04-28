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
                                <a title="Return" href="<?=base_url('admin/final_evaluation/')?>"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>
                            </div>
                            Pesos de evaluación final
                            <p><?= $exam->name; ?></p>
                            <p><?= getClassNameById($exam->class_id) . ' | ' . getSectionNameById($exam->section_id) . '|' . getSubjectNameById($exam->subject_id); ?> </p>
                            <a class="btn btn-primary" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_add_is_average/<?php echo $exam->exam_id ?>');" href="javascript:void(0);">Relleno automático</a>
                        </h6>
                        <div class="element-box-tp">
                            <div class="table-responsive">
                                <table class="table table-padded">
                                    <thead>
                                        <tr>
                                            <th><?php echo getEduAppGTLang('name'); ?></th>
                                            <th><?php echo getEduAppGTLang('year'); ?></th>
                                            <th class="text-center"><?php echo getEduAppGTLang('percent'); ?></th>
                                            <th class="text-center">Autocompletar</th>
                                            <th class="text-center">Configuración de Autocompletar</th>
                                            <th class="text-center"><?php echo getEduAppGTLang('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $exam_id = $exam->exam_id;
                                    $markActivity = $this->db->query("SELECT * FROM mark_activity where exam_id=$exam_id")->result();
                                    $totalPercent = 0;
                                    foreach ($markActivity as $row):
                                        $totalPercent += $row->percent;
                                    ?>
                                        <tr>
                                            <td><?= $row->name; ?></td>
                                            <td><?= $row->year; ?></td>
                                            <td class="text-center"><?= $row->percent . ' %' ?></td>
                                            <td class="text-center">
                                                <?php if ($row->is_calculate_avg) { ?>
                                                    <span class="badge badge-success"><?php echo getEduAppGTLang('active'); ?></span>
                                                <?php } else { ?>
                                                    <span class="badge badge-warning"><?php echo getEduAppGTLang('inactive'); ?></span>
                                                <?php } ?>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($row->is_calculate_avg) { ?>
                                                    <a class="btn btn-secondary btn-sm" href="<?= base_url('admin/final_evaluation_selected/' . $exam_id . '/' . $row->mark_activity_id) ?>">Acuerdo <i class="fa fa-cog"></i></a>
                                                    <a class="btn btn-sm btn-danger"
                                                        href="<?= base_url('admin/disable_calculate_avg/' . $exam_id . '/' . $row->mark_activity_id) ?>"
                                                        onclick="return confirm('Está seguro de que desea desactivar esto?')">
                                                        <?php echo getEduAppGTLang('disable'); ?> <i class="fa fa-times"></i>
                                                    </a>
                                                <?php } ?>
                                            </td>
                                            <td class="row-actions">
                                                <a class="grey" href="#" data-target="#update_percent" data-toggle="modal"
                                                    data-mark_activity_id="<?= $row->mark_activity_id; ?>"
                                                    data-percent="<?= $row->percent; ?>">
                                                    <i class="os-icon picons-thin-icon-thin-0001_compose_write_pencil_new"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2">Total</td>
                                            <td class="text-center">
                                                <h4><?= $totalPercent . ' %' ?></h4>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($totalPercent == 100) { ?>
                                                    <span class="badge badge-success">OK <i class="fa fa-check"></i></span>
                                                <?php } else { ?>
                                                    <span class="badge badge-warning">Por favor recalcule <i class="fa fa-times"></i></span>
                                                <?php } ?>


                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="update_percent" tabindex="-1" role="dialog" aria-labelledby="update_percent" aria-hidden="true">
                        <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
                            <div class="modal-content">
                                <?php echo form_open(base_url() . 'admin/final_evaluation_update_percent'); ?>
                                <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                                <div class="modal-header">
                                    <h6 class="title"><?php echo getEduAppGTLang('update'); ?></h6>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group is-select">
                                                <label class="control-label"><?php echo getEduAppGTLang('percent'); ?></label>
                                                <input type="hidden" name="mark_activity_id" value="">
                                                <input type="hidden" name="exam_id" value="<?= $exam->exam_id ?>">
                                                <input type="number" name="percent" value="" class="form-control">
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
                var markActivityId = this.dataset.mark_activity_id;
                var percent = this.dataset.percent;
                document.querySelector('#update_percent input[name="mark_activity_id"]').value = markActivityId;
                document.querySelector('#update_percent input[name="percent"]').value = percent;
            });
        });
    </script>