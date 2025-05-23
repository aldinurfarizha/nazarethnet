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
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/blocked_mark/<?php echo $data; ?>/"><i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i><span>Marcas Bloqueadas</span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/meet/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo getEduAppGTLang('live'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url(); ?>admin/attendance/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/student_list/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i><span><?php echo getEduAppGTLang('student'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/certificate_list/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0012_notebook_paper_certificate"></i><span><?php echo getEduAppGTLang('certificate'); ?></span></a>
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
                            <?php echo form_open(base_url() . 'admin/attendance_selector/', array('class' => 'form m-b')); ?>
                            <input type="hidden" name="subject_id" value="<?php echo $ex[2]; ?>" />
                            <input type="hidden" name="class_id" value="<?php echo $ex[0]; ?>" />
                            <input type="hidden" name="year" value="<?php echo $running_year; ?>" />
                            <input type="hidden" name="section_id" value="<?php echo $ex[1]; ?>" />
                            <input type="hidden" name="data" value="<?php echo $data; ?>" />
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group label-floating bg-white"
                                        <label class="control-label"><?php echo getEduAppGTLang('date'); ?></label>
                                        <input type='text' class="datepicker-here" data-position="bottom left" data-language='en' name="timestamp" value="<?php if ($timestamp != '') {
                                                                                                                                                                echo date("m/d/Y", $timestamp);
                                                                                                                                                            } else {
                                                                                                                                                                echo date('m/d/Y');
                                                                                                                                                            } ?>" data-multiple-dates-separator="/" />
                                        <span class="material-input"></span>
                                    </div>
                                </div>
                                <input type="hidden" name="year" value="<?php echo $running_year; ?>">
                                <div class="col-sm-2">
                                    <div class="form-group"> <button class="btn btn-success top-10" type="submit"><span><?php echo getEduAppGTLang('view'); ?></span></button></div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                            <?php if ($timestamp != ''): ?>
                                <div class="ui-block">
                                    <article class="hentry post thumb-full-width">
                                        <div class="post__author author vcard inline-items">
                                            <img src="<?php echo base_url(); ?>public/uploads/<?php echo $this->crud->getInfo('logo'); ?>" class="no-border">
                                            <div class="author-date d-flex justify-content-between">
                                                <a class="h6 post__author-name fn" href="javascript:void(0);">
                                                    <?php echo getEduAppGTLang('manage_attendance'); ?>
                                                    <small>(<?php echo date("m/d/Y", $timestamp); ?>)</small>
                                                </a>
                                                <a class="btn btn-primary" href="<?= base_url('admin/custom_attendance_status/' . $data) ?>">
                                                    añadir otro estado <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="edu-posts cta-with-media">
                                            <?php echo form_open(base_url() . 'admin/attendance_update/' . $ex[0] . '/' . $ex[1] . '/' . $ex[2] . '/' . $timestamp); ?>
                                            <div class="table-responsive">
                                                <table class="table table-lightborder table-bordered">
                                                    <thead>
                                                        <tr class="cls-table">
                                                            <th><?php echo getEduAppGTLang('student'); ?></th>
                                                            <th class="text-center"><?php echo getEduAppGTLang('status'); ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $count = 1;
                                                        $attendance_of_students = $this->db->get_where('attendance', array(
                                                            'class_id' => $ex[0],
                                                            'section_id' => $ex[1],
                                                            'year' => $running_year,
                                                            'timestamp' => $timestamp,
                                                            'subject_id' => $ex[2]
                                                        ))->result_array();
                                                        foreach ($attendance_of_students as $row):
                                                            if (!isStudentActiveEnroll($row['student_id'], $ex[0], $ex[1], $running_year)) {
                                                                continue;
                                                            }
                                                            if (isStudentFinishSubject($row['student_id'], $ex[2])) {
                                                                continue;
                                                            }
                                                            if (!isActiveSubject($row['student_id'], $ex[2])) {
                                                                continue;
                                                            }
                                                        ?>
                                                            <tr>
                                                                <td class="min-w-170">
                                                                    <img alt="" src="<?php echo $this->crud->get_image_url('student', $row['student_id']); ?>" width="25px" class="tbl-user"> <?php echo $this->crud->get_name('student', $row['student_id']); ?>
                                                                </td>
                                                                <td class="text-center" nowrap>
                                                                    <span class="radio">
                                                                        <h6 data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('present'); ?>">
                                                                            <label>
                                                                                <input type="radio" <?php if ($row['status'] == 1) echo 'checked'; ?> value="1" name="status_<?php echo $row['attendance_id']; ?>"><span class="circle"></span><span class="check"></span>
                                                                            </label>
                                                                        </h6>
                                                                    </span>
                                                                    <span class="radio">
                                                                        <h6 data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('late'); ?>">
                                                                            <label>
                                                                                <input type="radio" <?php if ($row['status'] == 3) echo 'checked'; ?> value="3" name="status_<?php echo $row['attendance_id']; ?>"><span class="circle"></span><span class="check"></span>
                                                                            </label>
                                                                        </h6>
                                                                    </span>
                                                                    <span class="radio">
                                                                        <h6 data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('absent'); ?>">
                                                                            <label>
                                                                                <input type="radio" value="2" <?php if ($row['status'] == 2) echo 'checked'; ?> name="status_<?php echo $row['attendance_id']; ?>"><span class="circle"></span><span class="check"></span>
                                                                            </label>
                                                                        </h6>
                                                                    </span>
                                                                    <span class="radio">
                                                                        <h6 data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('no_classs'); ?>">
                                                                            <label>
                                                                                <input type="radio" value="0" <?php if ($row['status'] == 0) echo 'checked'; ?> name="status_<?php echo $row['attendance_id']; ?>"><span class="circle"></span><span class="check"></span>
                                                                            </label>
                                                                        </h6>
                                                                    </span>
                                                                    <?php foreach (getCustomStatusAttendanceByTeacherId(getTeacherIdFromSubject($ex[2])) as $status) { ?>
                                                                        <span class="radio">
                                                                            <h6 data-toggle="tooltip" data-placement="top" data-original-title="<?php echo $status->status_name; ?>">
                                                                                <label>
                                                                                    <input type="radio" value="<?= $status->custom_status_id ?>" <?php if ($row['status'] == $status->custom_status_id) echo 'checked'; ?> name="status_<?php echo $row['attendance_id']; ?>"><span class="circle"></span><span class="check"></span>
                                                                                </label>
                                                                            </h6>
                                                                        </span>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                                <div class="form-buttons-w text-center">
                                                    <button class="btn btn-success btn-rounded" type="submit"><?php echo getEduAppGTLang('update'); ?></button>
                                                </div>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                </div>
                                </article>
                    </div>
                <?php endif; ?>
                </main>
                </div>
            </div>
            <a class="back-to-top" href="javascript:void(0);">
                <img src="<?php echo base_url(); ?>public/style/olapp/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
            </a>
        </div>
    </div>
    </div>
<?php endforeach; ?>