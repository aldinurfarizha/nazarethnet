    <div class="content-w">
        <?php include 'fancy.php';?>
	    <div class="header-spacer"></div>
	    <div class="conty">
		    <div class="os-tabs-w menu-shad">
			    <div class="os-tabs-controls">
			        <ul class="navs navs-tabs upper">
				        <li class="navs-item">
    				        <a class="navs-links" href="<?php echo base_url();?>admin/academic_settings/"><i class="os-icon picons-thin-icon-thin-0006_book_writing_reading_read_manual"></i><span><?php echo getEduAppGTLang('academic_settings'); ?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/section/"><i class="os-icon picons-thin-icon-thin-0002_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('sections'); ?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/grade/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('grades'); ?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/semesters/"><i class="os-icon picons-thin-icon-thin-0007_book_reading_read_bookmark"></i><span><?php echo getEduAppGTLang('semesters'); ?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/student_promotion/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('student_promotion'); ?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links active" href="<?php echo base_url();?>admin/certificates/"><i class="os-icon picons-thin-icon-thin-0178_add_more_layers_slides"></i><span><?php echo getEduAppGTLang('certificates'); ?></span></a>
				        </li>
			        </ul>
			    </div>
		    </div>
            <div class="content-i">
                <div class="content-box">
		            <div class="col-sm-12">
                        <div class="element-box lined-primary shadow">
    		                <h5 class="form-header"><?php echo getEduAppGTLang('certificates_settings');?></h5><br>
		                    <?php echo form_open(base_url() . 'admin/certificates/update' , array('target'=>'_top', 'enctype' => 'multipart/form-data'));?>
		                        <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                          		            <label class="control-label"><?php echo getEduAppGTLang('teacher_signature'); ?></label>
                  			                <p><b><?php echo getEduAppGTLang('teacher_must_be_upload_her_signature_on_teacher_profile');?>.</b></p>
                		                </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                          		            <label class="control-label"><?php echo getEduAppGTLang('ceo_name'); ?></label>
                  			                <input class="form-control" name="ceo_name" value="<?php echo $this->db->get_where('academic_settings', array('type' => 'ceo_name'))->row()->description;?>" type="text" required="">
                		                </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <center><img src="<?php echo base_url();?>public/uploads/<?php echo $this->db->get_where('academic_settings', array('type' => 'ceo_signature'))->row()->description;?>" width="80px"></center>
                                        <div class="form-group">
                          		            <label class="control-label"><?php echo getEduAppGTLang('ceo_signature'); ?></label>
                  			                <input class="form-control" name="ceo_signature" type="file">
                		                </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                          		            <label class="control-label"><?php echo getEduAppGTLang('title'); ?></label>
                  			                <input class="form-control" name="certificate_title" value="<?php echo $this->db->get_where('academic_settings', array('type' => 'certificate_title'))->row()->description;?>" type="text" required="">
                		                </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                          		            <label class="control-label"><?php echo getEduAppGTLang('subtitle'); ?></label>
                  			                <input class="form-control" name="certificate_subtitle" type="text" value="<?php echo $this->db->get_where('academic_settings', array('type' => 'certificate_subtitle'))->row()->description;?>" required="">
                		                </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                          		            <label class="control-label"><?php echo getEduAppGTLang('text_certificate'); ?></label>
                  			                <input class="form-control" name="certificate_text" type="text" value="<?php echo $this->db->get_where('academic_settings', array('type' => 'certificate_text'))->row()->description;?>" required="">
                		                </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                          		            <label class="control-label"><?php echo getEduAppGTLang('location'); ?></label>
                  			                <input class="form-control" name="location" type="text" value="<?php echo $this->db->get_where('academic_settings', array('type' => 'location'))->row()->description;?>" required="">
                		                </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                          		            <label class="control-label"><?php echo getEduAppGTLang('footer'); ?></label>
                  			                <input class="form-control" name="certificate_footer" type="text" value="<?php echo $this->db->get_where('academic_settings', array('type' => 'certificate_footer'))->row()->description;?>" required="">
                		                </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label"><?php echo getEduAppGTLang('certificate_style');?></label>
                                        <div class="form-group is-select">
                                            <div class="select">
                                                <select name="certificate_style" required="">
                                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                    <option value="1" <?php if ($this->db->get_where('academic_settings', array('type' => 'certificate_style'))->row()->description == 1) echo 'selected';?>> 1</option>
                                                    <option value="2" <?php if ($this->db->get_where('academic_settings', array('type' => 'certificate_style'))->row()->description == 2) echo 'selected';?>> 2</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
		                        <div class="form-buttons-w">
                                    <button class="btn btn-rounded btn-success" type="submit"> <?php echo getEduAppGTLang('update');?></button>
                                </div>
                            <?php echo form_close();?>
		                </div>
		            </div>
	            </div>
            </div>
        </div>
    </div>