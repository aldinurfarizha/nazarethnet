<?php $min = $this->db->get_where('academic_settings' , array('type' =>'minium_mark'))->row()->description;?>
<?php $running_year = $this->crud->getInfo('running_year'); ?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="content-i">
                <div class="content-box">
                    <div class="os-tabs-w">
                        <div class="os-tabs-controls">
                            <ul class="navs navs-tabs upper">
                            <?php 
                                $n = 1;
                                $children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                                foreach ($children_of_parent as $row):
                            ?>
                                <li class="nav-item">
                                    <?php $active = $n++;?>
                                    <a class="navs-links <?php if($active == 1) echo 'active';?>" data-toggle="tab" href="#<?php echo $row['username'];?>"><img alt="" src="<?php echo $this->crud->get_image_url('student', $row['student_id']);?>" width="25px" class="tbl-st"> <?php echo $this->crud->get_name('student', $row['student_id']);?></a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                    <?php 
                        $n = 1;
                        $children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                        foreach ($children_of_parent as $row2):
                    ?>
                    <?php $active = $n++;?>
                        <div class="tab-pane <?php if($active == 1) echo 'active';?>" id="<?php echo $row2['username'];?>">
                            <div class="row">   
                                <div class="col-sm-12"> 
                                <?php 
                                    $student_info =   $this->db->get_where('enroll' , array('student_id' => $row2['student_id'] , 'year' => $running_year))->result_array(); 
                                    foreach($student_info as $row): ?>
                                    <div class="pipeline white lined-secondary">
                                        <div class="pipeline-header">
                                            <h5 class="pipeline-name"><?php echo getEduAppGTLang('student');?></h5>
                                        </div>
                                        <div class="pipeline-item">
                                            <div class="pi-foot">
                                                <a class="extra-info" href="javascript:void(0);"><img alt="" src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" width="40px" class="mrigth"><span class="text-white"><?php echo $this->crud->getInfo('system_name');?></span></a>
                                            </div>
                                            <div class="pi-body bglogo">
                                                <div class="avatar">
                                                    <img alt="" src="<?php echo $this->crud->get_image_url('student',$row['student_id']);?>">
                                                </div>
                                                <div class="pi-info">
                                                    <div class="h6 pi-name">
                                                        <?php echo $this->crud->get_name('student', $row['student_id'])?><br>
                                                        <small><?php echo getEduAppGTLang('roll');?>: <?php echo $this->db->get_where('enroll' , array('student_id' => $row2['student_id']))->row()->roll;?></small>
                                                    </div>
                                                    <div class="pi-sub">
                                                        <?php echo getEduAppGTLang('class');?>: <?php echo $this->crud->get_class_name($row['class_id']); ?><br>
                                                        <?php echo getEduAppGTLang('section');?>: <?php echo $this->db->get_where('section' , array('section_id' => $row['section_id']))->row()->name; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                        $class_id=$row['class_id'];
                                        $section_id=$row['section_id'];
                                        $student_id=$row2['student_id'];
                                    $exams = $this->db->get_where('exam',['class_id'=>$row['class_id'],'section_id'=>$row['section_id']])->result_array();
                                    foreach ($exams as $row2):
                                ?>
                                <div class="col-sm-12">
                                <div class="element-box lined-primary shadow">
                                    <h5 class="form-header"><?php echo getEduAppGTLang('your_marks'); ?><br>
                                        <small><?php echo $row2['name']; ?></small>
                                    </h5>
                                    <div class="table-responsive">
                                        <table class="table table-lightborder">
                                            <thead>
                                                <tr>
                                                    <th><?php echo getEduAppGTLang('subject'); ?></th>
                                                    <th><?php echo getEduAppGTLang('teacher'); ?></th>
                                                    <th><?php echo getEduAppGTLang('mark'); ?></th>
                                                    <th>Prom</th>
                                                    <th><?php echo getEduAppGTLang('comment'); ?></th>
                                                    <th><?php echo getEduAppGTLang('view_all'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $subjects = $this->db->get_where('subject', array('class_id' => $class_id, 'section_id' => $section_id))->result_array();
                                                foreach ($subjects as $row3) :
                                                    $obtained_mark_query = $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'class_id' => $class_id, 'student_id' => $student_id, 'year' => $running_year));
                                                    if ($obtained_mark_query->num_rows() > 0) {
                                                        $marks = $obtained_mark_query->result_array();
                                                        foreach ($marks as $row4) :
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
                                                                    }
                                                                    else
                                                                    {
                                                                        echo $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'student_id' => $student_id, 'year' => $running_year))->row()->final;
                                                                    }
                                                                     ?>
                                                                </td>
                                                                <td><?php echo $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'student_id' => $student_id, 'year' => $running_year))->row()->comment; ?></td>
                                                                <?php $data = base64_encode( $class_id."-".$section_id = $this->db->get_where('enroll' , array('student_id' => $student_id))->row()->section_id."-".$row3['subject_id'].'-'.$student_id); ?>
                                                                <td><a class="btn btn-rounded btn-sm btn-primary text-white" href="<?php echo base_url();?>parents/subject_marks/<?php echo $data;?>/<?php echo $row2['exam_id'];?>/"><?php echo getEduAppGTLang('view_all');?></a></td>
                                                            </tr>
                                                <?php endforeach;
                                                    }
                                                endforeach; ?>
                                            </tbody>
                                        </table>
                                        <div class="form-buttons-w text-right">
                                        <a target="_blank" href="<?php echo base_url();?>parents/marks_print_view/<?php echo base64_encode($student_id.'-'. $row2['exam_id']);?>/"><button class="btn btn-rounded btn-success" type="submit"><i class="picons-thin-icon-thin-0333_printer"></i>  <?php echo getEduAppGTLang('print');?></button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <?php endforeach; ?>
                                    </div>
                                    
                                <?php endforeach;?>
                                </div>
                                
                            </div>
                        </div>  
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
