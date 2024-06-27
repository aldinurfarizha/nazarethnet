<?php 
    $system_name = $this->crud->getInfo('system_name');
    $running_year = $this->crud->getInfo('running_year');
    $system_email = $this->crud->getInfo('system_email');
    $min = $this->db->get_where('academic_settings' , array('type' =>'minium_mark'))->row()->description;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta charset="UTF-8">
            <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
            <link href="<?php echo base_url();?>public/style/cms/css/email_css.css" rel="stylesheet">
            <meta name="viewport" content="width=device-width" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        </head>
        <body class="hdr">
            <div width="100%" class="hemail">
                <div class="sbemail">
                    <div class="trr" align="center"><a href="#"><img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logow');?>" alt="<?php echo $system_name;?>" class="mxsimg"></a></div>
                    <div class="tblh">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td><b><?php echo getEduAppGTLang('student');?>:</b> <?php echo $student_name;?></td>
                                </tr>
                                <tr>
                                    <td><b><?php echo getEduAppGTLang('student_marksheet_are_there');?>:</b></td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td>
                                        <table class="tablemarks">
                                            <tr>
                                                <th class="thbr"><?php echo getEduAppGTLang('subject');?></th>
                                                <th class="thbr"><?php echo getEduAppGTLang('teacher');?></th>
                                                <th class="thbr"><?php echo getEduAppGTLang('mark');?></th>
                                                <th class="thbr"><?php echo getEduAppGTLang('comment');?></th>
                                            </tr>
                                            <?php 
                                                $subjects = $this->db->get_where('subject' , array('class_id' => $class_id))->result_array();
                                                foreach ($subjects as $row3): 
                                                $obtained_mark_query = $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exam_id,'class_id' => $class_id, 'student_id' => $student_id, 'year' => $running_year));
                                                $marks = $obtained_mark_query->result_array();
                                                foreach ($marks as $row4):
                                            ?>
                                            <?php $mark = $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exam_id, 'student_id' => $student_id, 'year' => $running_year))->row()->labtotal;?>
                                            <tr>
                                                <td class="tbr"><?php echo $row3['name'];?></td>
                                                <td class="tbr"><?php echo $this->crud->get_name('teacher', $row3['teacher_id']); ?></td>
                                                <td class="tbr"><?php $mark = $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exam_id, 'student_id' => $student_id, 'year' => $running_year))->row()->labtotal;?>
                                                    <?php if($mark < $min || $mark == 0):?>
                                                        <b class="txcolor"><?php if($this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exam_id, 'student_id' => $student_id, 'year' => $running_year))->row()->labtotal == 0) echo '0'; else echo $mark;?></b>
                                                    <?php endif;?>
                                                    <?php if($mark >= $min):?>
                                                        <b class="tx2color"><?php echo $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exam_id, 'student_id' => $student_id, 'year' => $running_year))->row()->labtotal;?></b>
                                                    <?php endif;?>
                                                </td>
                                                <td class="tbr"><?php echo $this->db->get_where('mark' , array('subject_id' => $row3['subject_id'], 'exam_id' => $exam_id, 'student_id' => $student_id, 'year' => $running_year))->row()->comment; ?></td>
                                            </tr>
                                            <?php endforeach; endforeach;?>
                                        </table>
                                        <br><br>
                                        <span class="fts"><?php echo $system_name;?></span> 
                                    </td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="ftr">
                        <p> <img alt="" src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" class="imgftr"><?php echo $system_name;?><br>
                    </div>
                </div>
            </div>
        </body>
    </html>