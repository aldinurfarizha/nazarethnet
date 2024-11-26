<?php
$encode_data = $data;
$decode_data = base64_decode($encode_data);
$explode_data = explode("-", $decode_data);
$min = $this->db->get_where('academic_settings', array('type' => 'minium_mark'))->row()->description;
$running_year = $this->crud->getInfo('running_year');
$sub = $this->db->get_where('subject', array('subject_id' => $explode_data[2]))->result_array();
$is_final = false;
foreach ($sub as $rows):
    $class_id       = $explode_data[0];
    $section_id     = $explode_data[1];
    $subject_id     = $explode_data[2];
    $student_id     = $this->session->userdata('login_user_id');
    $nota_c         = $this->academic->getInfo('minium_mark');
?>
    <div class="content-w">
        <div class="conty">
            <?php $info = base64_decode($data); ?>
            <?php $ids = explode("-", $info); ?>
            <?php include 'fancy.php'; ?>
            <div class="header-spacer"></div>
            <div class="cursos cta-with-media" style="background: #<?php echo $rows['color']; ?>;">
                <div class="cta-content">
                    <div class="user-avatar">
                        <img alt="" src="<?php echo base_url(); ?>public/uploads/subject_icon/<?php echo $rows['icon']; ?>" class="icon-wi">
                    </div>
                    <h3 class="cta-header"><?php echo $rows['name']; ?> - <small><?php echo getEduAppGTLang('marks'); ?></small></h3>
                    <small class="subject-desc"><?php echo $this->db->get_where('class', array('class_id' => $explode_data[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $explode_data[1]))->row()->name; ?>"</small>
                </div>
            </div>
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/subject_dashboard/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/online_exams/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/homework/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/forum/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo getEduAppGTLang('forum'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/study_material/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url(); ?>student/subject_marks/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/meet/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo getEduAppGTLang('live'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/attendance_report/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/whiteboards/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0191_window_application_cursor"></i><span><?php echo getEduAppGTLang('whiteboards'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/gamification/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0659_medal_first_place_winner_award_prize_achievement"></i><span><?php echo getEduAppGTLang('gamification'); ?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="row">
                        <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                            <div id="newsfeed-items-grid">
                                <div class="pd00">
                                    <div id='cssmenu'>
                                        <ul>
                                            <?php
                                            $var = 0;
                                            $examss = $this->db->get_where('exam', array('class_id' => $explode_data[0], 'section_id' => $explode_data[1], 'subject_id' => $explode_data[2]))->result_array();
                                            foreach ($examss as $exam):
                                                $var++;
                                            ?>
                                                <li class='<?php if ($exam['exam_id'] == $exam_id) echo "act"; ?>'><a href="<?php echo base_url(); ?>student/subject_marks/<?php echo $data . '/' . $exam['exam_id']; ?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><?php echo $exam['name']; ?>
                                                        <?php if ($exam['is_final']) {
                                                            if ($exam['exam_id'] == $exam_id) {
                                                                $is_final = true;
                                                            }
                                                        ?>
                                                            <span class="badge badge-secondary">Final</span>
                                                        <?php } ?>
                                                    </a></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <div class="element-wrapper bg-white">
                                    <div class="element-box-tp">
                                        <div class="table-responsive">
                                            <table class="table table-lightborder">
                                                <thead>
                                                    <tr class="tblbg">
                                                        <th class="text-center"><?php echo getEduAppGTLang('activity'); ?></th>
                                                        <th class="text-center"><?php echo getEduAppGTLang('mark'); ?></th>
                                                        <th class="text-center"><?php echo getEduAppGTLang('status'); ?></th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $classID = $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->class_id;
                                                    $sectionID = $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->section_id;
                                                    $capacidades = $this->db->order_by('mark_activity_id', 'ASC')->get_where('mark_activity', array('class_id' => $classID, 'subject_id' => $rows['subject_id'], 'year' => $running_year, 'exam_id' => $exam_id))->result_array();
                                                    foreach ($capacidades as $cap) :
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $cap['name']; ?>
                                                                <?php if ($is_final) { ?>
                                                                    (<?= $cap['percent'] ?>%)
                                                                <?php } ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php
                                                                $nota_cap = $this->db->order_by('nota_capacidad_id', 'ASC')->get_where('nota_capacidad', array('mark_activity_id' => $cap['mark_activity_id'], 'student_id' => $this->session->userdata('login_user_id')))->row();
                                                                ?>
                                                                <?php if ($nota_cap->nota <= $min) : ?>
                                                                    <?php echo $nota_cap->nota; ?>
                                                                <?php else : ?>
                                                                    <?php echo $nota_cap->nota; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <?php if ($nota_cap->is_block) {
                                                                    echo "Bloquear - " . $nota_cap->reason;
                                                                } ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td><b>Total</b></td>
                                                        <td class="text-center"><b><?php echo $this->db->get_where('mark', array('subject_id' => $rows['subject_id'], 'exam_id' =>  $exam_id, 'student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->mark_obtained; ?></b></td>
                                                        <td></td>
                                                    </tr>
                                                    <?php if ($is_final) { ?>
                                                        <tr>
                                                            <td><b>EVALUACIONES FINALES</b></td>
                                                            <td class="text-center"><b><?= getFinalMark($this->session->userdata('login_user_id'), $rows['subject_id'], $exam_id, $running_year) ?></b></td>
                                                        </tr>
                                                    <?php } else { ?>
                                                        <tr>
                                                            <td><b>Prom</b></td>
                                                            <td class="text-center"><b><?php echo $this->db->get_where('mark', array('subject_id' => $rows['subject_id'], 'exam_id' =>  $exam_id, 'student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->final; ?></b></td>
                                                            <td></td>
                                                        </tr>
                                                    <?php } ?>

                                                </tfoot>
                                            </table>
                                        </div>
                                        <a class="btn btn-sm btn-success text-white mgleft" href="<?php echo base_url(); ?>student/my_marks/"><?php echo getEduAppGTLang('view_all_marks'); ?></a><br><br>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>