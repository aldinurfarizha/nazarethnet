<?php 
    $running_year = $this->crud->getInfo('running_year');
    $min = $this->db->get_where('academic_settings' , array('type' =>'minium_mark'))->row()->description;
	$encode_data = $data;
	$decode_data = base64_decode($encode_data);
	$explode_data = explode("-", $decode_data);
?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
	       <div class="content-i">
                <div class="content-box">
                    <div class="back"><a href="<?php echo base_url();?>teacher/view_marks/<?php echo $explode_data[1];?>/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a></div>
	                <div class="row">
	                    <div class="col-sm-8">
		                    <div class="element-box lined-primary">
                                <h5 class="form-header">
                                    <?php echo getEduAppGTLang('subject_marks');?><br>
	                                <small><?php echo $this->db->get_where('subject', array('subject_id' => $explode_data[2]))->row()->name;?></small>
                                </h5>
                                <div class="table-responsive">
                                    <table class="table table-lightborder">
                                        <thead>
                                            <tr>
                                                <th><?php echo getEduAppGTLang('activity');?></th>
                                                <th><?php echo getEduAppGTLang('mark');?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $classID = $this->db->get_where('enroll' , array('student_id' => $explode_data[1], 'year' => $running_year))->row()->class_id;
                                                $sectionID = $this->db->get_where('enroll' , array('student_id' => $explode_data[1], 'year' => $running_year))->row()->section_id;
                                                $capacidades = $this->db->order_by('mark_activity_id', 'ASC')->get_where('mark_activity', array('class_id' => $classID, 'subject_id' => $explode_data[2], 'year' => $running_year, 'exam_id' => $explode_data[0]))->result_array();
                                                foreach ($capacidades as $cap) : 
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $cap['name'];?>
                                                </td>
					                            <td>
					                            <?php 
					                                $nota_cap = $this->db->order_by('nota_capacidad_id', 'ASC')->get_where('nota_capacidad', array('mark_activity_id' => $cap['mark_activity_id'], 'student_id' => $explode_data[1]))->row()->nota;
                                                ?>
                                                    <?php if ($nota_cap <= $min) : ?>
                                                        <?php echo $nota_cap;?>
                                                    <?php else : ?>
                                                        <?php echo $nota_cap;?>
                                                    <?php endif; ?>
					                            </td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
		                </div>
	                    <div class="col-sm-4">
	                        <div class="pipeline white lined-secondary">
		                        <div class="pipeline-header">
			                        <h5 class="pipeline-name"><?php echo getEduAppGTLang('student');?></h5>
		                        </div>
		                        <div class="pipeline-item">
		                            <div class="pi-foot">
			                            <a class="extra-info" href="javascript:void(0);"><img alt="" src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" width="10%" class="mrigth"><span class="text-white"><?php echo $this->crud->getInfo('system_name');?></span></a>
		                            </div>
		                            <div class="pi-body">
			                            <div class="avatar">
			                                <img alt="" src="<?php echo $this->crud->get_image_url('student',$explode_data[1]);?>">
			                            </div>  
			                            <div class="pi-info">
			                                <div class="h6 pi-name">
				                                <?php echo $this->crud->get_name('student', $explode_data[1]);?><br>
				                                <small><?php echo getEduAppGTLang('roll');?>: <?php echo $this->db->get_where('enroll', array('student_id' => $explode_data[1]))->row()->roll;?></small>
			                                </div>
			                                <?php $class_id = $this->db->get_where('subject', array('subject_id' => $explode_data[2]))->row()->class_id;?>
			                                <?php $section_id = $this->db->get_where('section', array('class_id' => $class_id))->row()->section_id;?>
			                                <div class="pi-sub">
				                                <?php echo getEduAppGTLang('class');?>: <?php echo $this->crud->get_class_name($class_id); ?><br>
        		                                <?php echo getEduAppGTLang('section');?>: <?php echo $this->db->get_where('section' , array('section_id' => $section_id))->row()->name; ?>
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