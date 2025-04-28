<?php
$running_year = $this->crud->getInfo('running_year');
$min = $this->db->get_where('academic_settings', array('type' => 'minium_mark'))->row()->description;
?>
<?php $student_info = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $running_year))->result_array();
$student_infos = $this->db->get_where('enroll', array('student_id' => $student_id, 'year' => $this->db->get_where('settings', array('type' => 'running_year'))->row()->description))->row();

foreach (getAvailabeSubject($student_id) as $row):
    if (isActiveSubject($student_id, $row->subject_id) && $this->session->userdata('login_user_id') == $row->teacher_id) {
        $studentDetails = getStudentInfo($student_id);
?>
        <div class="content-w">
            <?php include 'fancy.php'; ?>
            <div class="header-spacer"></div>
            <div class="conty">
                <div class="content-i">
                    <div class="content-box">
                        <div class="back"> <a href="<?php echo base_url(); ?>teacher/students_area/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a> </div>
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="pipeline white lined-secondary">
                                    <div class="pipeline-header">
                                        <h5 class="pipeline-name"><?php echo getEduAppGTLang('student'); ?></h5>
                                    </div>
                                    <div class="pipeline-item">
                                        <div class="pi-foot">
                                            <a class="extra-info" href="javascript:void(0);"><img alt="" src="<?php echo base_url(); ?>public/uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description; ?>" width="15%" class="mrigth"><span class="text-white"><?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description; ?></span></a>
                                        </div>
                                        <div class="pi-body">
                                            <div class="avatar w75">
                                                <img alt="" width="15%" src="<?php echo $this->crud->get_image_url('student', $student_id); ?>">
                                            </div>
                                            <div class="pi-info">
                                                <div class="h6 pi-name">
                                                    <?php echo $this->crud->get_name('student', $student_id); ?><br>
                                                    <small><?php echo getEduAppGTLang('roll'); ?>: <?= $studentDetails->roll ?></small>
                                                </div>
                                                <div class="pi-sub">
                                                    <?php echo getEduAppGTLang('class'); ?>: <?php echo $this->crud->get_class_name($row->class_id); ?><br>
                                                    <?php echo getEduAppGTLang('section'); ?>: <?php echo $this->db->get_where('section', array('section_id' => $row->section_id))->row()->name; ?> <br>
                                                    <?php echo getEduAppGTLang('subject'); ?>: <?php echo $this->db->get_where('subject', array('subject_id' => $row->subject_id))->row()->name; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            $exams = $this->db->get_where('exam', array('class_id' => $row->class_id, 'section_id' => $row->section_id))->result_array();
                                foreach ($exams as $row2):
                            ?>
                                    <div class="col-sm-12">
                                        <div class="element-box lined-primary">
                                            <h5 class="form-header"><?php echo getEduAppGTLang('marks'); ?><br> <small><?php echo $row2['name']; ?></small></h5>
                                            <div class="table-responsive">
                                                <table class="table table-lightborder">
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo getEduAppGTLang('subject'); ?></th>
                                                            <th><?php echo getEduAppGTLang('teacher'); ?></th>
                                                            <th><?php echo getEduAppGTLang('mark'); ?></th>
                                                            <th><?php echo getEduAppGTLang('average'); ?></th>
                                                            <th><?php echo getEduAppGTLang('grade'); ?></th>
                                                            <th><?php echo getEduAppGTLang('comment'); ?></th>
                                                            <th><?php echo getEduAppGTLang('view_all'); ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $subjects = $this->db->get_where('subject', array('class_id' => $row->class_id, 'section_id' => $row->section_id, 'subject_id' => $row->subject_id))->result_array();
                                                        foreach ($subjects as $row3):
                                                            $obtained_mark_query = $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'class_id' => $row->class_id, 'student_id' => $student_id, 'year' => $running_year));
                                                            if ($obtained_mark_query->num_rows() > 0) {
                                                                $marks = $obtained_mark_query->result_array();
                                                                foreach ($marks as $row4):
                                                                    $examDetail=getExamDetail($row2['exam_id']);
                                                        ?>
                                                                    <tr>
                                                                        <td><?php echo $row3['name']; ?></td>
                                                                        <td><img alt="" src="<?php echo $this->crud->get_image_url('teacher', $row3['teacher_id']); ?>" width="25px" class="tbl-user"> <?php echo $this->crud->get_name('teacher', $row3['teacher_id']); ?></td>
                                                                        <td>
                                                                            <?php echo $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'student_id' => $student_id, 'year' => $running_year))->row()->mark_obtained; ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                            if($examDetail->is_final)
                                                                            {
                                                                                echo countEvaluacionesFinales($examDetail->exam_id,  $student_id);
                                                                            }else
                                                                            {
                                                                                $avg = $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'student_id' => $student_id, 'year' => $running_year))->row()->final;
                                                                            if ($avg < $min || $avg == 0):
                                                                            ?>
                                                                                <span class="badge badge-danger text-white"><?php echo $avg; ?></span>
                                                                            <?php endif; ?>
                                                                            <?php if ($avg >= $min): ?>
                                                                                <span class="badge badge-success text-white"><?php echo $avg; ?></span>
                                                                            <?php endif; 
                                                                            }
                                                                            ?>
                                                                        </td>
                                                                        <td><?php echo $grade = $this->crud->get_grade($avg); ?></td>
                                                                        <td><?php echo $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'student_id' => $student_id, 'year' => $running_year))->row()->comment; ?></td>
                                                                        <?php $data = base64_encode($row2['exam_id'] . "-" . $student_id . "-" . $row3['subject_id']); ?>
                                                                        <td><a class="btn btn-rounded btn-sm btn-primary text-white" href="<?php echo base_url(); ?>teacher/subject_marks/<?php echo $data; ?>"><?php echo getEduAppGTLang('view_all'); ?></a></td>
                                                                    </tr>
                                                        <?php endforeach;
                                                            }
                                                        endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div><?php
            }

        endforeach; ?>