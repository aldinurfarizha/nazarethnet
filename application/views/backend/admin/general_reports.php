<?php $running_year = $this->crud->getInfo('running_year');?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
        	<div class="os-tabs-w menu-shad">
        		<div class="os-tabs-controls">
			        <ul class="navs navs-tabs">
				        <li class="navs-item">
				            <a class="navs-links <?php if($page_name == 'general_reports') echo "active";?>" href="<?php echo base_url();?>admin/general_reports/"><i class="picons-thin-icon-thin-0658_cup_place_winner_award_prize_achievement"></i> <span><?php echo getEduAppGTLang('classes');?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/students_report/"><i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i>  <span><?php echo getEduAppGTLang('students');?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/attendance_report/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i>  <span><?php echo getEduAppGTLang('attendance');?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/marks_report/"><i class="picons-thin-icon-thin-0100_to_do_list_reminder_done"></i>  <span><?php echo getEduAppGTLang('final_marks');?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/tabulation_report/"><i class="picons-thin-icon-thin-0070_paper_role"></i> <span><?php echo getEduAppGTLang('tabulation_sheet');?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/accounting_report/"><i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash"></i>  <span><?php echo getEduAppGTLang('accounting');?></span></a>
				        </li>
			        </ul>
		        </div>
	        </div>
  	        <div class="content-i">
	            <div class="content-box">
	  	            <h5 class="form-header"><?php echo getEduAppGTLang('class_report');?></h5>
	  		        <div class="row">
				        <div class="content-i">
					        <div class="content-box">
					            <?php echo form_open(base_url() . 'admin/general_reports/', array('class' => 'form m-b'));?>
	  					            <div class="row top-rd">
							            <div class="col-sm-5">
							                <div class="form-group label-floating is-select">
                                                <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                                                <div class="select">
                                                    <select name="class_id" required="" onchange="get_sections(this.value)">
                                                        <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                        <?php
											                $classes = $this->db->get('class')->result_array();
											                foreach($classes as $row):                        
										                ?>                
										                <option value="<?php echo $row['class_id'];?>" <?php if($class_id == $row['class_id']) echo "selected";?>><?php echo $row['name'];?></option>            
										                <?php endforeach;?>
                                                    </select>
                                                </div>
                                            </div>
							            </div>
							            <div class="col-sm-5">
							                <div class="form-group label-floating is-select">
                                                <label class="control-label"><?php echo getEduAppGTLang('section');?></label>
                                                <div class="select">
                                                <?php if($section_id == ""):?>
		  								            <select name="section_id" required id="section_holder">
            								            <option value=""><?php echo getEduAppGTLang('select');?></option>
										            </select>
									            <?php else:?>
    										        <select name="section_id" required id="section_holder">
    	            							        <option value=""><?php echo getEduAppGTLang('select');?></option>
                								        <?php 
                									        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
                									        foreach ($sections as $key):
                								        ?>
    	            								        <option value="<?php echo $key['section_id'];?>" <?php if($section_id == $key['section_id']) echo "selected";?>><?php echo $key['name'];?></option>
                								        <?php endforeach;?>
    										        </select>
									            <?php endif;?>
                                                </div>
                                            </div>
							            </div>
							            <div class="col-sm-2">
		  						            <div class="form-group"> 
		  							            <button class="btn btn-success btn-upper top-20" type="submit"><span><?php echo getEduAppGTLang('get_report');?></span></button>
		  						            </div>
							            </div>
	  					            </div>
					            <?php echo form_close();?>
					            <?php if($class_id != "" && $section_id != ""):?>
						        <div class="row">
						            <div class="text-center col-sm-6"><br>
							            <h4><?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name;?> - <?php echo getEduAppGTLang('section');?>: <?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name;?></h4>
							            <p><b><?php echo getEduAppGTLang('teacher');?>:</b> <?php echo $this->crud->get_name('teacher', $this->db->get_where('class', array('class_id' => $class_id))->row()->teacher_id);?><br><b><?php $this->db->where('class_id', $class_id); $this->db->where('section_id', $section_id); echo $this->db->count_all_results('enroll');?></b> <?php echo getEduAppGTLang('students');?>  |  <b><?php $this->db->where('class_id', $class_id); echo $this->db->count_all_results('subject');?></b> <?php echo getEduAppGTLang('subjects');?>.<br><b><?php echo getEduAppGTLang('running_year');?>:</b> <?php echo $this->db->get_where('settings', array('type' => 'running_year'))->row()->description;?></p>
						            </div>
						            <div class="col-sm-6 text-center">
							            <div class="up-main-info">
								            <div class="user-avatar-w"> 
									            <div class="user-avatar">
  										            <img alt="" src="<?php echo $this->crud->get_image_url('teacher', $this->db->get_where('class', array('class_id' => $class_id))->row()->teacher_id);?>" width="80">
  									            </div>
  								            </div>
      							            <h4 class="up-header"><?php echo $this->crud->get_name('teacher', $this->db->get_where('class', array('class_id' => $class_id))->row()->teacher_id);?></h4>
      							            <h6 class="up-sub-header"><div class="value badge badge-pill badge-success"><?php echo getEduAppGTLang('teacher');?></div></h6>
    						            </div>
						            </div><hr>
						            <div class="col-sm-6">
							            <div class="element-box">
								            <h5 class="form-header"><?php echo getEduAppGTLang('gender');?></h5>
								            <canvas id="myChart" width="100" height="100"></canvas>
							            </div>
						            </div>
						            <input type="hidden" value="<?php echo getEduAppGTLang('female');?>" id="female"/>
						            <input type="hidden" value="<?php echo getEduAppGTLang('male');?>" id="male"/>
							        <div class="col-sm-6">
								        <div class="element-box">
      								        <div class="form-header">
      									         <h6><?php echo getEduAppGTLang('subjects');?></h6>
      								        </div>
      								        <div class="table-responsive">
      									        <table width="100%" class="table table-lightborder table-lightfont">
      										        <thead>
          											    <tr>
      												        <th class="pull-left full-width"><?php echo getEduAppGTLang('subject');?></th>
          												    <th class="text-center full-width"><?php echo getEduAppGTLang('teacher');?></th>
      											        </tr>
      										        </thead>
      										        <tbody>
      											        <?php 
      												        $subjects = $this->db->get_where('subject',array('class_id' => $class_id, 'section_id' => $section_id))->result_array();
      												        foreach ($subjects as $subject): ?>
    										            <tr>
      											            <td class="pull-left full-width"><?php echo $subject['name'];?></td>
      											            <td class="text-center full-width"><a class="btn btn-rounded btn-sm btn-purple text-white"><?php echo $this->crud->get_name('teacher', $subject['teacher_id']);?></a></td>
    										            </tr>
      											        <?php endforeach;?>
      										        </tbody>
      									        </table>
      								        </div>
    							        </div>
							        </div>
						        </div>
					            <?php endif;?>
  				            </div>
			             </div>
	                </div>
    	        </div>
            </div>
        </div>
    </div>
    <?php
    	$male = 0;
    	$female = 0;
    	$students = $this->db->get_where('enroll', array('class_id' => $class_id, 'section_id' => $section_id, 'year' => $running_year))->result_array();
    	foreach($students as $row){
    		if($this->db->get_where('student', array('student_id' => $row['student_id']))->row()->sex == "F")
    		{
    			$female+= 1;
    		}else{
    			$male += 1;
    		}
    	}
    ?>  
    <input type="hidden" value="<?php echo $female;?>" id="femaleval"/>
    <input type="hidden" value="<?php echo $male;?>" id="maleval"/>