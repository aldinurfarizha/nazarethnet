<?php
$running_year = $this->crud->getInfo('running_year');
$info = base64_decode($data);
$ex = explode('-', $info);
$sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
foreach ($sub as $subs):
?>
    <div class="content-w">
        <div class="conty">
            <?php include 'fancy.php'; ?>
            <div class="header-spacer"></div>
            <div class="cursos cta-with-media" style="background: #<?php echo $subs['color']; ?>;">
                <div class="cta-content">
                    <div class="user-avatar">
                        <img alt="" src="<?php echo base_url(); ?>public/uploads/subject_icon/<?php echo $subs['icon']; ?>" class="width-60">
                    </div>
                    <h3 class="cta-header"><?php echo $subs['name']; ?> - <small><?php echo getEduAppGTLang('attendance'); ?></small></h3>
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
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/upload_marks/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks'); ?></span></a>
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
                            <a class="navs-links active" href="<?php echo base_url(); ?>admin/certificate_list/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0012_notebook_paper_certificate"></i><span><?php echo getEduAppGTLang('certificate'); ?></span></a>
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
            <div class="content-w">
                <div class="row p-5">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title"><?= getEduAppGTLang('certificate'); ?></h6>
                            </div>
                            <div class="card-body">
                                <div class="content-box">
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <td>No.</td>
                                                        <td><?= getEduAppGTLang('name'); ?></td>
                                                        <td class="text-center"><?= getEduAppGTLang('course_status'); ?></td>
                                                        <td class="text-center"><?= getEduAppGTLang('qr_code'); ?></td>
                                                        <td><?= getEduAppGTLang('action'); ?></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $students   =   $this->db->get_where('enroll', array('class_id' => $ex[0], 'section_id' => $ex[1], 'year' => $running_year))->result_array();
                                                    $no = 1;
                                                    foreach ($students as $row2) :
                                                        if (!isStudentActiveEnroll($row2['student_id'], $ex[0], $ex[1], $running_year)) {
                                                            continue;
                                                        }
                                                        if (isStudentDeactive($row2['student_id'])) {
                                                            continue;
                                                        }
                                                        if (isActiveSubject($row2['student_id'], $ex[2])) {
                                                            $studentData=getStudentInfo($row2['student_id']);
                                                            $studentSubject=getStudentSubject($row2['student_id'], $ex[2]);
                                                    ?>
                                                            <tr>
                                                                <td><?= $no ?></td>
                                                                <td><?= $this->crud->get_name('student', $row2['student_id']) ?></td>
                                                                <td class="text-center"><?php 
                                                                    if (isStudentFinishSubject($row2['student_id'], $ex[2])) {?>
                                                                        <div class="value badge badge-pill badge-success"><?= getEduAppGTLang('finished'); ?></div>
                                                                        <?php }else{?>
                                                                        <div class="value badge badge-pill badge-warning"><?= getEduAppGTLang('in_progress'); ?></div>
                                                                        <?php } ?>
                                                                </td>
                                                                <td class="text-center">
                                                                    <?= $studentSubject->cert_code ?>
                                                                </td>
                                                                <td>
                                                                    <?php if (isMarkBlocked($row2['student_id'], $ex[2])) { ?>
                                                                        <a class="btn btn-sm btn-success" href="<?= base_url('admin/unblock_mark/' . $row2['student_id'] . '/' . $ex[2] . '/' . $data) ?>"> abrir el bloque de valor <i class="fa fa-check-circle"></i></a>
                                                                    <?php } else { ?>
                                                                        <button class="btn btn-sm btn-danger" onclick="showAjaxModal('<?= base_url('modal/popup/modal_block_mark/' . $data . '/' . $ex[2] . '/' . $row2['student_id']) ?>');">bloque de valor</button>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                            $no++;
                                                        }
                                                    endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                                <a class="back-to-top" href="javascript:void(0);">
                                    <img src="<?php echo base_url(); ?>public/style/olapp/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>