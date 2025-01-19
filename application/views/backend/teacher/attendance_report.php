<?php 
    $running_year = $this->crud->getInfo('running_year');
    $info = base64_decode($data);
    $ex = explode('-', $info);
    $sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
    $class_id=$ex[0];
    $section_id=$ex[1];
    $subject_id=$ex[2];
    foreach($sub as $subs):
?>
    <div class="content-w">
        <div class="conty">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
            <div class="cursos cta-with-media" style="background: #<?php echo $subs['color'];?>;">
                <div class="cta-content">
                    <div class="user-avatar">
                        <img alt="" src="<?php echo base_url();?>public/uploads/subject_icon/<?php echo $subs['icon'];?>" class="icon-wi">
                    </div>
                    <h3 class="cta-header"><?php echo $subs['name'];?> - <small><?php echo getEduAppGTLang('attendance');?></small></h3>
                    <small class="subject-desc"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name;?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name;?>"</small>
                </div>
            </div> 
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/subject_dashboard/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/online_exams/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/homework/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/forum/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo getEduAppGTLang('forum');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/study_material/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/upload_marks/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/meet/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo getEduAppGTLang('live');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/attendance/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url(); ?>teacher/attendance_report/<?php echo $data; ?>/"><i class="picons-thin-icon-thin-0100_to_do_list_reminder_done"></i><span><?php echo getEduAppGTLang('attendance_report'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/whiteboards/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0191_window_application_cursor"></i><span><?php echo getEduAppGTLang('whiteboards');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/gamification/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0659_medal_first_place_winner_award_prize_achievement"></i><span><?php echo getEduAppGTLang('gamification');?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="row">
                        <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
	                        <?php echo form_open(base_url() . 'teacher/attendance_report/'.$data.'/', array('class' => 'form m-b'));?>
	                            <input type="hidden" name="subject_id" value="<?php echo $ex[2];?>"/>
	                            <input type="hidden" name="class_id" value="<?php echo $ex[0];?>"/>
	                            <input type="hidden" name="year" value="<?php echo $running_year;?>"/>
	                            <input type="hidden" name="section_id" value="<?php echo $ex[1];?>"/>
	                            <input type="hidden" name="data" value="<?php echo $data;?>"/>
	                            <div class="row">
                                <div class="col-sm-2">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label"><?php echo getEduAppGTLang('month'); ?></label>
                                            <div class="select">
                                                <select name="month" required id="month" onchange="show_year()">
                                                    <?php
                                                    for ($i = 1; $i <= 12; $i++):
                                                        if ($i == 1)
                                                            $m = getEduAppGTLang('january');
                                                        else if ($i == 2)
                                                            $m = getEduAppGTLang('february');
                                                        else if ($i == 3)
                                                            $m = getEduAppGTLang('march');
                                                        else if ($i == 4)
                                                            $m = getEduAppGTLang('april');
                                                        else if ($i == 5)
                                                            $m = getEduAppGTLang('may');
                                                        else if ($i == 6)
                                                            $m = getEduAppGTLang('june');
                                                        else if ($i == 7)
                                                            $m = getEduAppGTLang('july');
                                                        else if ($i == 8)
                                                            $m = getEduAppGTLang('august');
                                                        else if ($i == 9)
                                                            $m = getEduAppGTLang('september');
                                                        else if ($i == 10)
                                                            $m = getEduAppGTLang('october');
                                                        else if ($i == 11)
                                                            $m = getEduAppGTLang('november');
                                                        else if ($i == 12)
                                                            $m = getEduAppGTLang('december');
                                                    ?>
                                                        <option value="<?php echo $i; ?>" <?php if ($month == $i) echo 'selected'; ?>><?php echo $m; ?></option>
                                                    <?php endfor; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
		                            <div class="col-sm-2">
                                        <div class="form-group label-floating is-select">
                                            <label class="control-label"><?php echo getEduAppGTLang('year'); ?></label>
                                            <div class="select">
                                            <select name="year" required>
                                                <?php
                                                $current_year = date('Y');
                                                $start_year = 2024;
                                                for ($i = $start_year; $i <= $current_year; $i++):
                                                    $selected = (!isset($year) && $i == $current_year) || (isset($year) && $year == $i) ? 'selected' : '';
                                                ?>
                                                    <option value="<?php echo $i; ?>" <?php echo $selected; ?>>
                                                        <?php echo $i; ?>
                                                    </option>
                                                <?php endfor; ?>
                                            </select>
                                            </div>
                                        </div>
                                    </div>
		                            <div class="col-sm-2">
		                                <div class="form-group"> <button class="btn btn-success top-10" type="submit"><span><?php echo getEduAppGTLang('view');?></span></button></div>
		                            </div>
	                            </div>
	                        <?php echo form_close();?>
                            <div class="ui-block">
                            <?php if ($class_id != '' && $section_id != '' && $month != '' && $year != ''): ?>
                                    <div class="row">
                                        <div class="text-center col-sm-12"><br>
                                            <h4><?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?> - <?php echo getEduAppGTLang('section'); ?> : <?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name; ?> - <?php echo getEduAppGTLang('subject'); ?> : <?php echo $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->name; ?></h4>
                                            <p><b><?php echo getEduAppGTLang('year'); ?>:</b> <?php echo $year; ?></p>
                                        </div>
                                        <hr>
                                        <div class="col-7 text-left">
                                            <h5 class="form-header"><?php
                                                                    if ($month == 1) {
                                                                        $mo = getEduAppGTLang('january');
                                                                    } else if ($month == 2) {
                                                                        $mo = getEduAppGTLang('february');
                                                                    } else if ($month == 3) {
                                                                        $mo = getEduAppGTLang('march');
                                                                    } else if ($month == 4) {
                                                                        $mo = getEduAppGTLang('april');
                                                                    } else if ($month == 5) {
                                                                        $mo = getEduAppGTLang('may');
                                                                    } else if ($month == 6) {
                                                                        $mo = getEduAppGTLang('june');
                                                                    } else if ($month == 7) {
                                                                        $mo = getEduAppGTLang('july');
                                                                    } else if ($month == 8) {
                                                                        $mo = getEduAppGTLang('august');
                                                                    } else if ($month == 9) {
                                                                        $mo = getEduAppGTLang('september');
                                                                    } else if ($month == 10) {
                                                                        $mo = getEduAppGTLang('october');
                                                                    } else if ($month == 11) {
                                                                        $mo = getEduAppGTLang('november');
                                                                    } else if ($month == 12) {
                                                                        $mo = getEduAppGTLang('december');
                                                                    }
                                                                    echo $mo; ?>
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="table-responsive bg-white" style="overflow-x: auto;">
                                        <table class="table table-sm table-lightborder table-bordered">
                                            <thead>
                                                <tr class="text-center" height="30px">
                                                    <td class="tbl-student"><?php echo getEduAppGTLang('student'); ?> </td>
                                                    <?php
                                                    $days = cal_days_in_month(CAL_GREGORIAN, $month, $year);
                                                    for ($i = 1; $i <= $days; $i++) {
                                                        $dateTimestamp = strtotime("$year-$month-$i");
                                                        $dayName = date('D', $dateTimestamp);
                                                    ?>
                                                        <td class="tbl-student"><?php echo getEduAppGTLang($dayName) . ' ' . $i; ?></td>
                                                    <?php } ?>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $data = array();
                                                $students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year, 'section_id' => $section_id))->result_array();
                                                foreach ($students as $row):
                                                    if (!isStudentActiveEnroll($row['student_id'], $class_id, $section_id, $running_year)) {
                                                        continue;
                                                    }
                                                    if(isStudentFinishSubject($row['student_id'], $subject_id)){
                                                        continue;
                                                    }
                                                    if (!isActiveSubject($row['student_id'], $subject_id)) {
                                                        continue;
                                                        }
                                                ?>
                                                    <tr>
                                                        <td nowrap> <img alt="" src="<?php echo $this->crud->get_image_url('student', $row['student_id']); ?>" width="20px" class="tbl-st"> <?php echo $this->crud->get_name('student', $row['student_id']); ?> </td>
                                                        <?php
                                                        $status = 0;
                                                        for ($i = 1; $i <= $days; $i++) {
                                                            $timestamps = strtotime($i . '-' . $month . '-' . $year);
                                                            $this->db->group_by('timestamp');
                                                            $attendance = $this->db->get_where('attendance', array('subject_id' => $subject_id, 'section_id' => $section_id, 'class_id' => $class_id, 'year' => $running_year, 'timestamp' => $timestamps, 'student_id' => $row['student_id']))->result_array();
                                                            foreach ($attendance as $row1):
                                                                $month_dummy = date('d', $row1['timestamp']);
                                                                if ($i == $month_dummy){
                                                                    $status = $row1['status'];
                                                                    if($row1['updated_at'] == '0000-00-00 00:00:00'){
                                                                        $takenTime='';
                                                                    }else{
                                                                        $takenTime = $row1['updated_at'];
                                                                    }
                                                                    
                                                                }

                                                                
                                                            endforeach; ?>
                                                            <td class="text-center">
                                                                <?php if ($status == 1) { ?>
                                                                    <div class="status-pilli green" data-title="<?php echo getEduAppGTLang('present'); ?>" data-toggle="tooltip"></div>
                                                                    <p><?= $takenTime ?></p>
                                                                <?php } elseif ($status == 2) { ?>
                                                                    <div class="status-pilli red" data-title="<?php echo getEduAppGTLang('absent'); ?>" data-toggle="tooltip"></div>
                                                                    <p><?= $takenTime ?></p>
                                                                <?php } elseif ($status == 3) { ?>
                                                                    <div class="status-pilli yellow" data-title="<?php echo getEduAppGTLang('late'); ?>" data-toggle="tooltip"></div>
                                                                    <p><?= $takenTime ?></p>
                                                                <?php } elseif ($status == 0) { ?>
                                                                    -
                                                                <?php } else { ?>
                                                                    <?php echo getStatusNameFromId($status).'<br>'.$takenTime; ?>
                                                                <?php }
                                                                $status=0;
                                                                ?>
                                                            </td>

                                                        <?php } ?>
                                                    <?php endforeach; ?>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>
                                    </div>
                                </article>
                            </div>
                        </main>
                    </div>
                </div>
                <a class="back-to-top" href="javascript:void(0);">
                    <img src="<?php echo base_url();?>public/style/olapp/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
                </a>
            </div>
        </div>
    </div>
      <?php endforeach;?>