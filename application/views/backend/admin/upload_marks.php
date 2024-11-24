<?php
$running_year = $this->crud->getInfo('running_year');
$info = base64_decode($data);
$ex = explode('-', $info);
$sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
$is_final = false;
foreach ($sub as $subs) :
?>
    <div class="content-w">
        <div class="conty">
            <?php include 'fancy.php'; ?>
            <div class="header-spacer"></div>
            <div class="cursos cta-with-media" style="background: #<?php echo $subs['color']; ?>;">
                <div class="cta-content">
                    <div class="user-avatar">
                        <img alt="" src="<?php echo base_url(); ?>public/uploads/subject_icon/<?php echo $subs['icon']; ?>" class="icon-wi">
                    </div>
                    <h3 class="cta-header"><?php echo $subs['name']; ?> - <small><?php echo getEduAppGTLang('marks'); ?></small></h3>
                    <small class="subject-desc"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"</small>
                </div>
            </div>
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/subject_dashboard/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/online_exams/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/homework/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/forum/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo getEduAppGTLang('forum'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/study_material/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url(); ?>admin/upload_marks/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/blocked_mark/<?php echo $data; ?>/"><i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i><span>Marcas Bloqueadas</span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/meet/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo getEduAppGTLang('live'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/attendance/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/student_list/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i><span><?php echo getEduAppGTLang('student'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/whiteboards/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0191_window_application_cursor"></i><span><?php echo getEduAppGTLang('whiteboards'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/gamification/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0659_medal_first_place_winner_award_prize_achievement"></i><span><?php echo getEduAppGTLang('gamification'); ?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="row">
                        <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                            <div class="ui-block">
                                <article class="hentry post thumb-full-width">
                                    <div class="post__author author vcard inline-items">
                                        <img src="<?php echo base_url(); ?>public/uploads/<?php echo $this->crud->getInfo('logo'); ?>" class="no-border">
                                        <div class="author-date">
                                            <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo getEduAppGTLang('upload_marks'); ?> <small>(<?php echo $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name; ?>)</small>.</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#crearcapacidad"><button type="button" class="btn btn-rounded btn-warning">Crear actividad</button></a>
                                            <button class="btn btn-success btn-rounded" id="btn-trigger-update" type="button"><?php echo getEduAppGTLang('update'); ?></button>
                                        </div>
                                    </div>
                                    <div class="edu-posts cta-with-media">
                                        <div class="pd00">
                                            <div id='cssmenu'>
                                                <ul>
                                                    <?php
                                                    $var = 0;
                                                    $examss = $this->db->get_where('exam', array('class_id' => $ex[0], 'section_id' => $ex[1], 'subject_id' => $ex[2]))->result_array();
                                                    foreach ($examss as $exam) :
                                                        $var++;

                                                    ?>
                                                        <li class='<?php if ($exam['exam_id'] == $exam_id) echo "act"; ?>'>
                                                            <a href="<?php echo base_url(); ?>admin/upload_marks/<?php echo $data . '/' . $exam['exam_id']; ?>/">
                                                                <i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i>
                                                                <?php echo $exam['name']; ?>
                                                                <?php if ($exam['is_final']) {
                                                                    if ($exam['exam_id'] == $exam_id) {
                                                                        $is_final = true;
                                                                    }
                                                                ?>
                                                                    <span class="badge badge-secondary">Final</span>
                                                                <?php } ?>
                                                            </a>

                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <?php echo form_open(base_url() . 'admin/notas_update/' . $data . '/' . $exam_id . '/' . $order . '/'); ?>
                                            <table class="studentInfo">
                                                <tbody>
                                                    <tr class="bg-primary text-white" style="padding:0px">
                                                        <td class="text-center col-sticky nums bg-white" width="85px">
                                                            <span style="display:inline-block;" class="full-width text-black"><?php echo getEduAppGTLang('ID'); ?></span>
                                                            <?php $studentsOrder = 0;
                                                            if ($order == 1) $studentsOrder = 2;
                                                            elseif ($order == 2) $studentsOrder = 1; ?>
                                                            <a style="display:inline-block;margin-bottom:2px" href="<?php echo base_url(); ?>admin/upload_marks/<?php echo $data; ?>/<?php echo $exam_id; ?>/<?php echo $studentsOrder; ?>/" class="btn btn-primary btn-sm"><?php if ($order == 1) echo 'A-Z';
                                                                                                                                                                                                                                                                            elseif ($order == 2) echo 'Z-A'; ?></a>
                                                        </td>
                                                        <td class="col-sticky studs bg-white text-black" style="min-width:300px;padding:5px">
                                                            <span style="display:inline-block;" class="full-width"><?php echo getEduAppGTLang('student') ?></span>
                                                            <input type="text" class="searchInput" id="filter" placeholder="<?php echo getEduAppGTLang('search_student') ?>...">
                                                        </td>
                                                        <?php $capacidades = $this->db->order_by('mark_activity_id', 'ASC')->get_where('mark_activity', array('subject_id' => $subs['subject_id'], 'exam_id' => $exam_id, 'class_id' => $ex[0], 'section_id' => $ex[1], 'year' => $running_year))->result_array(); ?>
                                                        <?php foreach ($capacidades as $cap) : ?>
                                                            <td class="text-center" style="padding:5px">
                                                                <span class="full-width" style="display:inline-block;"><?php if($cap['is_calculate_avg']){echo '<i class="fa fa-balance-scale"></i>';}?> <?php echo $cap['name']; ?><?php if($cap['is_calculate_avg']){echo '<i class="fa fa-balance-scale"></i>';}?></span>
                                                                <a class="text-white" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_capacities/<?php echo $cap['mark_activity_id']; ?>/<?php echo $data . '/' . $exam_id . '/' . $order . '/'; ?>');" href="javascript:void(0);"><svg class="align-sub" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24">
                                                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844l2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565l6.844-6.844a2.015 2.015 0 0 1 2.852 0Z" />
                                                                    </svg>
                                                                    <?php if ($is_final) { ?>
                                                                        <a style="display:inline-block;margin-bottom:2px" class="btn btn-primary btn-sm"><?= $cap['percent'] . ' %' ?></a>
                                                                    <?php } ?>
                                                                </a>
                                                                <a class="text-white" href="<?php echo base_url() . 'admin/manage_marks/delete_capacity/' . $data . '/' . $exam_id . '/' . $order . '/' . $cap['mark_activity_id'] . '/'; ?>" onclick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>');"><svg class="align-sub" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24">
                                                                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 11v6m-4-6v6M6 7v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V7M4 7h16M7 7l2-4h6l2 4" />
                                                                    </svg></a>
                                                            </td>
                                                        <?php endforeach; ?>
                                                        <?php if ($is_final) { ?>
                                                            <td class="text-center" style="padding:5px">
                                                                Evaluaciones Finales
                                                            </td>
                                                        <?php }else{?>
                                                            <td class="text-center" style="padding:5px">
                                                            <i class="fa fa-balance-scale"></i> Prom <i class="fa fa-balance-scale"></i>
                                                            </td>
                                                        <?php } ?>
                                                        <td class="text-center" style="padding:5px">
                                                            Comentario
                                                        </td>
                                                    </tr>
                                                <tbody id="results">
                                                    <?php
                                                    $studs = $this->mark->get_enroll_students($subs['subject_id'], $ex[0], $ex[1], $running_year, $order);
                                                    foreach ($studs as $rows) :
                                                        if (!isStudentActiveEnroll($rows['student_id'], $ex[0], $ex[1], $running_year)) {
                                                            continue;
                                                        }
                                                        $block = false;
                                                        $reason = '';
                                                        if (isActiveSubject($rows['student_id'], $subs['subject_id'])) {
                                                            if (isMarkBlocked($rows['student_id'], $subs['subject_id'])) {
                                                                $block = true;
                                                                $reason = getMarkBlockedReason($rows['student_id'], $subs['subject_id']);
                                                            }
                                                    ?>
                                                            <tr class="altRow">
                                                                <td class="text-center col-sticky nums bg-white"><?php echo $rows['student_id']; ?></td>
                                                                <td class="col-sticky studs bg-white">
                                                                    <div class="studentContainer">
                                                                        <a href="<?php echo base_url(); ?>admin/student_portal/<?php echo $rows['student_id']; ?>"><img alt="" src="<?php echo $this->crud->get_image_url('student', $rows['student_id']); ?>" width="25px" style="border-radius: 10px;margin-right:5px;"> <?php echo $this->crud->get_name('student', $rows['student_id']); ?> <?php if ($block) { ?><span class="badge badge-danger"><i class="fa fa-danger"></i> <?= $reason ?></span><?php } ?></a>
                                                                    </div>
                                                                </td>
                                                                <?php
                                                                $total = 0;
                                                                $finalEvaluaciones = 0;
                                                                $capacidades = $this->db->order_by('mark_activity_id', 'ASC')->get_where('mark_activity', array('subject_id' => $subs['subject_id'], 'exam_id' => $exam_id, 'class_id' => $ex[0], 'section_id' => $ex[1], 'year' => $running_year))->result_array();
                                                                foreach ($capacidades as $cap) :
                                                                ?>
                                                                    <td align="center" style="text-align: center; vertical-align: middle; height: 100px;" style="border: 1px solid black;">
                                                                        <?php
                                                                        $notas = $this->db->order_by('nota_capacidad_id', 'ASC')->get_where('nota_capacidad', array('mark_activity_id' => $cap['mark_activity_id'], 'student_id' => $rows['student_id']));

                                                                        $nota_cap = $notas->result_array();
                                                                        foreach ($nota_cap as $nota) :
                                                                            $finalEvaluaciones += ((int)$nota['nota'] * $cap['percent'] / 100);
                                                                        ?>
                                                                            <?php $total += (int)$nota['nota']; ?>
                                                                            <?php if($cap['is_calculate_avg']){?>
                                                                                <input type="text" data-title="asd"
                                                                                <?php if ($nota['is_block']) { ?>
                                                                                class="bg-danger" readonly
                                                                                <?php } ?>
                                                                                <?php if ($block) { ?> class="bg-danger" readonly <?php } ?> onwheel="this.blur()" style="background-color: #d3d3d3;" readonly value="<?php
                                                                                                                                                                        if ($nota['nota'] == "0") {
                                                                                                                                                                            echo "";
                                                                                                                                                                        } else {
                                                                                                                                                                            echo $nota['nota'];
                                                                                                                                                                        } ?>" onkeyup="calcAverage(this)" min="0" name="mark_<?php echo $rows['student_id'] . '_' . $cap['mark_activity_id']; ?>" class="markInput text-center" placeholder="0">
                                                                                <div class="status-pilli blue" data-title="<?=countAllFinalMarkExplain($rows['student_id'],$subs['subject_id'],$running_year)?>" data-toggle="tooltip" data-original-title="" title=""></div>
                                                                            <?php }else{?>
                                                                                <input type="number"
                                                                                <?php if ($nota['is_block']) { ?>
                                                                                class="bg-danger" readonly
                                                                                <?php } ?>
                                                                                <?php if ($block) { ?> class="bg-danger" readonly <?php } ?> onwheel="this.blur()" value="<?php
                                                                                                                                                                        if ($nota['nota'] == "0") {
                                                                                                                                                                            echo "";
                                                                                                                                                                        } else {
                                                                                                                                                                            echo $nota['nota'];
                                                                                                                                                                        } ?>" onkeyup="calcAverage(this)" min="0" name="mark_<?php echo $rows['student_id'] . '_' . $cap['mark_activity_id']; ?>" class="markInput" placeholder="0">
                                                                                <?php } ?>
                                                                            
                                                                            <?php if ($nota['is_block']) { ?>
                                                                                <small><?= $nota['reason'] ?></small>
                                                                            <?php } ?>
                                                                        <?php endforeach; ?>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                                <?php if ($is_final) { ?>
                                                                    <td>
                                                                        <input type="text" class="commentInput text-center" style="background-color: #d3d3d3;" value="<?= $finalEvaluaciones ?>" disabled>
                                                                    </td>
                                                                <?php }else{ ?>
                                                                    <td>
                                                                        <input type="text" class="commentInput text-center" style="background-color: #d3d3d3;" value="<?= getFinalMark($rows['student_id'],$ex[2],$exam_id,$running_year) ?>" disabled>
                                                                    </td>
                                                                <?php } ?>
                                                                <td>
                                                                    <input type="hidden" id="final_avg_<?php echo $rows['student_id']; ?>" name="final_avg_<?php echo $rows['student_id']; ?>" value="<?php if (count($capacidades) > 0) echo number_format($total / count($capacidades), 2, ".", ",");
                                                                                                                                                                                                        else echo '0.00'; ?>">
                                                                    <input type="hidden" id="mark_obtained_<?php echo $rows['student_id']; ?>" name="mark_obtained_<?php echo $rows['student_id']; ?>" value="<?php echo $total; ?>">
                                                                    <?php
                                                                    $comment = $this->db->order_by('mark_id', 'ASC')->get_where('mark', array('exam_id' => $exam_id, 'student_id' => $rows['student_id'], 'class_id' => $ex[0], 'section_id' => $ex[1], 'subject_id' => $ex[2], 'year' => $running_year))->result_array();
                                                                    foreach ($comment as $com) :
                                                                    ?>
                                                                        <input type="text" <?php if ($block) { ?> class="bg-danger" readonly <?php } ?> class="commentInput" name="comment_<?php echo $rows['student_id']; ?>" value="<?php echo $com['comment']; ?>" placeholder="Comment...">
                                                                    <?php endforeach; ?>
                                                                </td>

                                                            </tr>
                                                    <?php }
                                                    endforeach; ?>
                                                </tbody>
                                                </tbody>
                                            </table>
                                            <div class="form-buttons-w text-center">
                                                <button class="btn btn-success btn-rounded" id="btn-update-mark" type="submit"><?php echo getEduAppGTLang('update'); ?></button>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        </main>
                    </div>
                </div>
                <a class="back-to-top" href="javascript:void(0);">
                    <img src="<?php echo base_url(); ?>public/style/olapp/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
                </a>
            </div>
        </div>



        <div class="modal fade" id="crearcapacidad" tabindex="-1" role="dialog" aria-labelledby="fav-page-popup" aria-hidden="true">
            <div class="modal-dialog window-popup fav-page-popup" role="document">
                <div class="modal-content">
                    <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                    <div class="modal-header">
                        <h6 class="title"><?php echo getEduAppGTLang('create_new_activity'); ?></h6>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open(base_url() . 'admin/manage_marks/new_activity/' . $data . '/' . $exam_id . '/' . $order . '/', array('enctype' => 'multipart/form-data')); ?>
                        <div class="row">
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"><?php echo getEduAppGTLang('name'); ?></label>
                                    <input class="form-control" name="name" type="text" required>
                                </div>
                            </div>
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <button class="btn btn-success btn-lg full-width" type="submit"><?php echo getEduAppGTLang('save'); ?></button>
                            </div>
                        </div>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script>
    $("#filter").on("keyup", function() {
        var filter = $(this).val();
        $('#results .altRow').each(function() {
            if ($(this).text().search(new RegExp(filter, "i")) < 0) {
                $(this).hide();
            } else {
                $(this).show();

            }
        });
    });
</script>
<script>
    document.getElementById('btn-trigger-update').addEventListener('click', function() {
        document.getElementById('btn-update-mark').click();
    });
</script>