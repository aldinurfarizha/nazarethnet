<?php 
    $running_year = $this->crud->getInfo('running_year');
    $next_year               = $running_year+1;
?>
    <div class="content-w">
        <?php include 'fancy.php';?>
	    <div class="header-spacer"></div>
	    <div class="conty">
	        <div class="os-tabs-w menu-shad">
		        <div class="os-tabs-controls">
		            <ul class="navs navs-tabs upper">
			            <li class="navs-item">
			                <a class="navs-links" href="<?php echo base_url();?>admin/academic_settings/"><i class="os-icon picons-thin-icon-thin-0006_book_writing_reading_read_manual"></i><span><?php echo getEduAppGTLang('academic_settings');?></span></a>
			            </li>
			            <li class="navs-item">
			                <a class="navs-links" href="<?php echo base_url();?>admin/section/"><i class="os-icon picons-thin-icon-thin-0002_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('sections');?></span></a>
			            </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/grade/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('grades'); ?></span></a>
                        </li>
			            <li class="navs-item">
			                <a class="navs-links" href="<?php echo base_url();?>admin/semesters/"><i class="os-icon picons-thin-icon-thin-0007_book_reading_read_bookmark"></i><span><?php echo getEduAppGTLang('semesters');?></span></a>
			            </li>
			            <li class="navs-item">
    			            <a class="navs-links active" href="<?php echo base_url();?>admin/student_promotion/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('student_promotion');?></span></a>
			            </li>
			            <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/certificates/"><i class="os-icon picons-thin-icon-thin-0178_add_more_layers_slides"></i><span><?php echo getEduAppGTLang('certificates'); ?></span></a>
				        </li>
		            </ul>
		        </div>
	        </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="element-wrapper">
                        <?php echo form_open(base_url() . 'admin/student_promotion/promote', array('class' => 'form m-b'));?>
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('running_year');?></label>
                                        <div class="select">
                                            <select name="running_year" required="">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <option value="<?php echo $running_year;?>"><?php echo $running_year;?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('year_to_promote');?></label>
                                        <div class="select">
                                            <select name="promotion_year" required="" id="promotion_year">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <option value="<?php echo $next_year;?>"><?php echo $next_year;?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('current_class');?></label>
                                        <div class="select">
                                            <select name="promotion_from_class_id" required="" id="from_class_id" onchange="get_sections(this.value);">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php
                                                    $classes = $this->db->get('class')->result_array();
                                                    foreach($classes as $row):
                                                ?>
                                                    <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('current_section');?></label>
                                        <div class="select">
                                            <select name="promotion_from_section_id" required="" id="section_holder">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('class_to_promote');?></label>
                                        <div class="select">
                                            <select name="promotion_to_class_id" required="" id="to_class_id">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php foreach($classes as $row):?>
                                                    <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <button class="top-20 btn btn-rounded btn-success btn-upper" type="button" onclick="get_students_to_promote('<?php echo $running_year;?>')"><span><?php echo getEduAppGTLang('promote');?></span></button>
                                    </div>
                                </div>
                            </div>
                            <div id="students_for_promotion_holder"></div>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </div>