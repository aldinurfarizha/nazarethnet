    <div class="content-w">
        <?php
        $cl_id = $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id')))->row()->class_id;
        $section_id = $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id')))->row()->section_id;
        ?>
        <?php include 'fancy.php'; ?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="all-wrapper no-padding-content solid-bg-all">
                <div class="layout-w">
                    <div class="content-w">
                        <div class="content-i">
                            <div class="content-box">
                                <div class="app-email-w">
                                    <div class="app-email-i">
                                        <div class="ae-content-w bg-content-x">
                                            <div class="top-header top-header-favorit">
                                                <div class="top-header-thumb">
                                                    <img src="<?php echo base_url(); ?>public/uploads/<?php echo $this->crud->getInfo('bglogin'); ?>" class="bgcover">
                                                    <div class="top-header-author">
                                                        <div class="author-thumb">
                                                            <img src="<?php echo base_url(); ?>public/uploads/<?php echo $this->crud->getInfo('logo'); ?>" class="authorCv">
                                                        </div>
                                                        <div class="author-content">
                                                            <a href="javascript:void(0);" class="h3 author-name"><?php echo getEduAppGTLang('my_subjects'); ?> <small>
                                                                    <?php
                                                                    $studentClassGroup = getStudentGroupClassById($this->session->userdata('login_user_id'));
                                                                    foreach ($studentClassGroup as $scg) {
                                                                        echo '(' . $scg->class_name . ') ';
                                                                    }
                                                                    ?>
                                                                </small></a>
                                                            <div class="country"><?php echo $this->crud->getInfo('system_name'); ?> | <?php echo $this->crud->getInfo('system_title'); ?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br><br>
                                            <div class="aec-full-message-w">
                                                <div class="aec-full-message">
                                                    <div class="container-fluid grbg">
                                                        <div class="tab-content">
                                                            <div class="tab-pane active" id="tabss">
                                                                <div class="row">
                                                                    <?php foreach ($class_Section as $cs) : ?>
                                                                        <div class="col-md-12">
                                                                            <h3><?= $cs->class_name . ' (' . $cs->section_name . ')'; ?></h3>
                                                                        </div>
                                                                        <?php
                                                                        $class_id = $cs->class_id;
                                                                        $section_id = $cs->section_id;

                                                                        foreach (getSubjectByClassIdandSectionId($class_id, $section_id) as $data) :
                                                                            $finish = 0;
                                                                            if (isStudentFinishSubject($student_id, $data->subject_id)) {
                                                                                $finish = 1;
                                                                            }
                                                                            if (isActiveSubject($student_id, $data->subject_id)) {
                                                                                $studentSubject = getStudentSubject($student_id, $data->subject_id);
                                                                        ?>
                                                                                <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                                                                    <div class="ui-block" data-mh="friend-groups-item">
                                                                                        <div class="friend-item friend-groups">
                                                                                            <div class="friend-item-content">
                                                                                                <div class="more">
                                                                                                    <i class="icon-feather-more-horizontal"></i>
                                                                                                    <ul class="more-dropdown">
                                                                                                        <li>
                                                                                                            <?php if ($finish) {
                                                                                                            ?>
                                                                                                                <a href="<?php echo base_url(); ?>student/subject_marks/<?php echo base64_encode($class_id . "-" . $section_id . "-" . $data->subject_id); ?>/"><?php echo getEduAppGTLang('dashboard'); ?></a>

                                                                                                            <?php } else { ?>
                                                                                                                <a href="<?php echo base_url(); ?>student/subject_dashboard/<?php echo base64_encode($class_id . "-" . $section_id . "-" . $data->subject_id); ?>/"><?php echo getEduAppGTLang('dashboard'); ?></a>
                                                                                                            <?php } ?>

                                                                                                        </li>
                                                                                                    </ul>
                                                                                                </div>
                                                                                                <div class="friend-avatar">
                                                                                                    <div class="author-thumb">
                                                                                                        <img src="<?php echo base_url(); ?>public/uploads/subject_icon/<?php echo $data->icon; ?>" width="120px" class="sb" style="background-color:#<?php echo $data->color; ?>;">
                                                                                                    </div>
                                                                                                    <div class="author-content">
                                                                                                        <?php
                                                                                                        if ($finish) { ?>
                                                                                                            <span class="badge badge-success">Finalizado <i class="fa fa-check"></i></span> - <a class="btn btn-primary btn-sm" href="<?= base_url('certificate/download/' . $studentSubject->cert_code) ?>" target="_blank"><?php echo getEduAppGTLang('certificate'); ?> <i class="fa fa-file-pdf"></i></a>
                                                                                                            <br>
                                                                                                            <a href="<?php echo base_url(); ?>student/subject_marks/<?php echo base64_encode($class_id . "-" . $section_id . "-" . $data->subject_id); ?>/" class="h5 author-name"><?php echo $data->name; ?></a><br><br>
                                                                                                        <?php } else { ?>
                                                                                                            <a href="<?php echo base_url(); ?>student/subject_dashboard/<?php echo base64_encode($class_id . "-" . $section_id . "-" . $data->subject_id); ?>/" class="h5 author-name"><?php echo $data->name; ?></a><br><br>
                                                                                                        <?php } ?>

                                                                                                        <img src="<?php echo $this->crud->get_image_url('teacher', $data->teacher_id); ?>" class="img-teacher"><span> <?php echo $this->crud->get_name('teacher', $data->teacher_id); ?></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        <?php }
                                                                        endforeach; ?>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="display-type"></div>
            </div>
        </div>
    </div>