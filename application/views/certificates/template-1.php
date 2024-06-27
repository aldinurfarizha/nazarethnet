<?php
    $online_exam_info = $this->db->get_where('online_exam', array('online_exam_id' => $onlineExamId))->row();
    $class = $this->db->get_where('class', array('class_id' => $online_exam_info->class_id))->row()->name;
    $section = $this->db->get_where('section', array('section_id' => $online_exam_info->section_id))->row()->name;
    $subject = $this->db->get_where('subject', array('subject_id' => $online_exam_info->subject_id))->row()->name;
    $submitted_answer_script_details = $this->db->get_where('online_exam_result', array('online_exam_id' => $onlineExamId, 'student_id' => $this->session->userdata('login_user_id')))->row();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,900&display=swap" rel="stylesheet">
</head>
<body>
	<div class="contenedor">
		<img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" class="logo">
		<h1 class="text-center"><?php echo $this->db->get_where('academic_settings', array('type' => 'certificate_title'))->row()->description;?></h1>
		<p class="text-center"><?php echo $this->db->get_where('academic_settings', array('type' => 'certificate_subtitle'))->row()->description;?></p>
		<h1 class="text-center student"><?php echo $this->crud->get_name('student', $this->session->userdata('login_user_id'));?></h1>
		<p class="text-center"><?php echo $this->db->get_where('academic_settings', array('type' => 'certificate_text'))->row()->description;?> <b><?php echo $subject;?></b>.</p>
		<p><small style="text-align:center"><?php echo $this->db->get_where('academic_settings', array('type' => 'location'))->row()->description;?></small></p>
		<div style="min-width: 100%;display:inline-block" class="signatures">
            <div style="width: 45%; height: 100px; float: left;"> 
                <center><img src="<?php echo base_url();?>public/uploads/teacher_image/<?php echo $this->db->get_where('teacher', array('teacher_id' => $online_exam_info->uploader_id))->row()->signature;?>" style="width: 100px;display:inline-block;"></center>
    	        <small style="display:inline-block;"><?php echo $this->crud->get_name($online_exam_info->uploader_type, $online_exam_info->uploader_id);?></small>
    	        <br>
    	        <?php echo getEduAppGTLang('teacher');?>    
            </div>
            <div style="margin-left: 45%; height: 100px;"> 
                <center><img src="<?php echo base_url();?>public/uploads/<?php echo $this->db->get_where('academic_settings', array('type' => 'ceo_signature'))->row()->description;?>" style="width: 100px;display:inline-block;"></center>
	            <small style="display:inline-block"><?php echo $this->db->get_where('academic_settings', array('type' => 'ceo_name'))->row()->description;?></small>
	            <br>
	            <?php echo getEduAppGTLang('CEO').' '. $this->crud->getInfo('system_name');?>
            </div>
        </div>
        <div class="text-center" style="padding-top:0px;padding-bottom:45px">
        	<small style="line-height: 0px;"><?php echo $this->db->get_where('academic_settings', array('type' => 'certificate_footer'))->row()->description;?></small>
        	<h4 class="text-center" style="line-height: 0px;"><?php echo getEduAppGTLang('approved_on');?> <?php echo date($this->db->get_where('settings', array('type' => 'date_format'))->row()->description, $submitted_answer_script_details->exam_started_timestamp);?></h4>
        	<h6 class="text-center" style="line-height: 0px;"><?php echo base_url();?></h6>
        </div>
	</div>
</body>
</html>