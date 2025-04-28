<?php $running_year = $this->crud->getInfo('running_year'); ?>
<?php $class_info = $this->db->get('class')->result_array(); ?>
<?php
$info = base64_decode($data);
$ex = explode('-', $info);
?>
<?php
$sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
foreach ($sub as $row):
?>
    <div class="content-w">
        <div class="conty">
            <?php include 'fancy.php'; ?>
            <div class="header-spacer"></div>
            <div class="cursos cta-with-media" style="background: #<?php echo $row['color']; ?>;">
                <div class="cta-content">
                    <div class="user-avatar">
                        <img alt="" src="<?php echo base_url(); ?>public/uploads/subject_icon/<?php echo $row['icon']; ?>" class="icon-wi">
                    </div>
                    <h3 class="cta-header"><?php echo $row['name']; ?> - <small><?php echo getEduAppGTLang('homework'); ?></small></h3>
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
                            <a class="navs-links active" href="<?php echo base_url(); ?>admin/homework/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework'); ?></span></a>
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
                            <div id="newsfeed-items-grid">
                                <div class="element-wrapper">
                                    <div class="element-box-tp">
                                        <h6 class="element-header">
                                            <?php echo getEduAppGTLang('homework'); ?>
                                            <div class="element-content"><a href="<?php echo base_url(); ?>admin/create_homework/<?php echo $data; ?>" class="text-white btn btn-control btn-grey-lighter btn-success"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i>
                                                    <div class="ripple-container"></div>
                                                </a></div>
                                        </h6>
                                        <div class="table-responsive">
                                            <table class="table table-padded">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo getEduAppGTLang('status'); ?></th>
                                                        <th><?php echo getEduAppGTLang('title'); ?></th>
                                                        <th><?php echo getEduAppGTLang('type'); ?></th>
                                                        <th><?php echo getEduAppGTLang('allow_homework_deliveries'); ?></th>
                                                        <th><?php echo getEduAppGTLang('options'); ?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $counter = 1;
                                                    $this->db->order_by('homework_id', 'desc');
                                                    $homeworks = $this->db->get_where('homework', array('subject_id' => $row['subject_id'], 'year' => $running_year, 'class_id' => $ex[0], 'section_id' => $ex[1]))->result_array();
                                                    foreach ($homeworks as $hm):
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php if ($hm['status'] == 1): ?>
                                                                    <span class="status-pill green"></span> <span><?php echo getEduAppGTLang('published'); ?></span>
                                                                <?php else: ?>
                                                                    <span class="status-pill red"></span><span><?php echo getEduAppGTLang('no_published'); ?></span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td><span><?php echo $hm['title']; ?></span></td>
                                                            <td>
                                                                <?php if ($hm['type'] == 1): ?>
                                                                    <span class="badge badge-success"><?php echo getEduAppGTLang('online_text'); ?></span>
                                                                <?php endif; ?>
                                                                <?php if ($hm['type'] == 2): ?>
                                                                    <span class="badge badge-info"><?php echo getEduAppGTLang('files'); ?></span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td><?php echo $hm['date_end']; ?></td>
                                                            <td class="bolder">
                                                                <a class="grey" href="<?php echo base_url(); ?>admin/homeworkroom/<?php echo $hm['homework_code']; ?>" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('view_homework'); ?>"><i class="picons-thin-icon-thin-0043_eye_visibility_show_visible"></i></a>
                                                                <a data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('delete'); ?>" class="danger grey" href="<?php echo base_url(); ?>admin/homework/delete/<?php echo $hm['homework_code']; ?>/<?php echo $data; ?>/" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
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