    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>public/style/cms/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>public/style/cms/css/main.css?version=3.3" rel="stylesheet">
    <script src="<?php echo base_url(); ?>public/style/js/scripts_eduappgt.js"></script>
    <?php
    $ex = explode('-', base64_decode($student_id));
    $class_name             =     $this->db->get_where('class', array('class_id' => $class_id))->row()->name;
    $section_id         =   $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id')))->row()->section_id;
    $exam_name          =     $this->db->get_where('exam', array('exam_id' => $ex[1]))->row()->name;
    $system_name        =    $this->crud->getInfo('system_name');
    $system_email       =   $this->crud->getInfo('system_email');
    $running_year       =   $this->crud->getInfo('running_year');
    $phone              =   $this->crud->getInfo('phone');
    $class_name = $sc_student->class_name;
    $section_id = $sc_student->section_id;
    $class_id = $sc_student->class_id;
    $exam_id=$sc_student->exam_id;
    ?>
        <div class="content-w">
            <div class="content-i">
                <div class="content-box">
                    <div class="element-wrapper">
                        <div class="rcard-wy" id="print_area">
                            <div class="rcard-w">
                                <div class="infos">
                                    <div class="info-1">
                                        <div class="rcard-logo-w">
                                            <img alt="" src="<?php echo base_url(); ?>public/uploads/<?php echo $this->crud->getInfo('logo'); ?>">
                                        </div>
                                        <div class="company-name"><?php echo $system_name; ?></div>
                                        <div class="company-address"><?php echo getEduAppGTLang('marks'); ?></div>
                                    </div>
                                    <div class="info-2">
                                        <div class="rcard-profile">
                                            <img alt="" src="<?php echo $this->crud->get_image_url('student', $this->session->userdata('login_user_id')); ?>">
                                        </div>
                                        <div class="company-name"><?php echo $this->crud->get_name('student', $this->session->userdata('login_user_id')); ?></div>
                                        <div class="company-address">
                                            <?php echo getEduAppGTLang('roll'); ?>: <?php echo $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id')))->row()->roll; ?><br /><?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?><br /><?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="rcard-heading">
                                    <h5><?php echo $exam_name; ?></h5>
                                    <div class="rcard-date"><?php echo $class_name; ?></div>
                                </div>
                                <div class="rcard-table table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><?php echo getEduAppGTLang('subject'); ?></th>
                                                <th class="text-center"><?php echo getEduAppGTLang('teacher'); ?></th>
                                                <th class="text-center"><?php echo getEduAppGTLang('mark'); ?></th>
                                                <th class="text-center">Prom</th>
                                                <th class="text-center"><?php echo getEduAppGTLang('comment'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $exams = $this->crud->get_exams();
                                            $subjects = $this->db->get_where('exam', array('exam_id' => $exam_id ))->result_array();
                                            foreach ($subjects as $row3) :
                                                $mark = $this->db->get_where('mark', array('student_id' => $this->session->userdata('login_user_id'), 'subject_id' => $row3['subject_id'], 'class_id' => $class_id, 'exam_id' => $ex[1], 'year' => $running_year));
                                                if ($mark->num_rows() > 0) {
                                                    $marks = $mark->result_array();
                                                }
                                                foreach ($marks as $row4) :
                                                    if (!isActiveSubject($this->session->userdata('login_user_id'), $row3['subject_id'])) {
                                                        continue;
                                                    }
                                                    $examDetail=getExamDetail($exam_id);
                                            ?>
                                                    <tr>
                                                        <td><?php echo $row3['name']; ?></td>
                                                        <td><?php echo $this->crud->get_name('teacher', $row3['teacher_id']); ?></td>
                                                        <td class="text-center"><?php echo $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $ex[1], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->mark_obtained; ?></td>
                                                        <td class="text-center">
                                                            <?php
                                                            if($examDetail->is_final)
                                                            {
                                                                echo countEvaluacionesFinales($examDetail->exam_id,  $this->session->userdata('login_user_id'));
                                                            }
                                                            else{
                                                                echo $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $ex[1], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->final; 
                                                            }

                                                            ?></td>
                                                        <td class="text-center"><?php echo $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $ex[1], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->comment; ?></td>
                                                    </tr>
                                            <?php endforeach;
                                            endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="rcard-footer">
                                    <div class="rcard-logo">
                                        <img alt="" src="<?php echo base_url(); ?>public/uploads/<?php echo $this->crud->getInfo('logo'); ?>"><span><?php echo $system_name; ?></span>
                                    </div>
                                    <div class="rcard-info">
                                        <span><?php echo $system_email; ?></span><span><?php echo $phone; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <button class="btn btn-info btn-rounded" onclick="Print('print_area')"><?php echo getEduAppGTLang('print'); ?></button>