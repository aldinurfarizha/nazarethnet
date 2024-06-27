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
			                <a class="navs-links active" href="<?php echo base_url();?>admin/semesters/"><i class="os-icon picons-thin-icon-thin-0007_book_reading_read_bookmark"></i><span><?php echo getEduAppGTLang('semesters');?></span></a>
			            </li>
			            <li class="navs-item">
			                <a class="navs-links" href="<?php echo base_url();?>admin/student_promotion/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('student_promotion');?></span></a>
			            </li>
			            <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/certificates/"><i class="os-icon picons-thin-icon-thin-0178_add_more_layers_slides"></i><span><?php echo getEduAppGTLang('certificates'); ?></span></a>
				        </li>
		            </ul>
		        </div>
	        </div>
            <div class="content-i">
                <div class="content-box">
                    <?php echo form_open(base_url() . 'admin/semesters/apply', array('class' => 'form m-b'));?>
  			            <div class="row top-rd">
				            <div class="col-sm-4">
                                <div class="form-group label-floating is-select">
                                    <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                                    <div class="select">
                                        <select name="class_id" required="" onchange="get_sections(this.value)">
                                            <option value=""><?php echo getEduAppGTLang('select');?></option>
                                            <?php 
                                                $class = $this->db->get('class')->result_array();
                                                foreach ($class as $row): ?>
                                            <option value="<?php echo $row['class_id']; ?>" <?php if($class_id == $row['class_id']) echo "selected";?>><?php echo $row['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group label-floating is-select">
                                    <label class="control-label"><?php echo getEduAppGTLang('section');?></label>
                                        <div class="select">
                                            <?php if($section_id == ""):?>
  							                <select name="section_id" required id="section_holder" onchange="get_class_subjects(this.value);">
								                <option value=""><?php echo getEduAppGTLang('select');?></option>
							                </select>
						                    <?php else:?>
							                <select name="section_id" required id="section_holder" onchange="get_class_subjects(this.value);">
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
                                <div class="col-sm-4">
    		  				        <div class="form-group label-floating is-select">
    		  			                <label class="control-label"><?php echo getEduAppGTLang('subject');?></label>
    		  			                <div class="select">
    		  				            <?php if($subject_id == ""):?>
    		  				                <select name="subject_id" required id="subject_holder">
                				                <option value=""><?php echo getEduAppGTLang('select');?></option>
    						                </select>
    					                <?php else:?>
    						                <select name="subject_id" required id="subject_holder">
    	            			                <option value=""><?php echo getEduAppGTLang('select');?></option>
                				                <?php 
                					                $subjects = $this->db->get_where('subject', array('class_id' => $class_id, 'section_id' => $section_id))->result_array();
                					                foreach ($subjects as $key):
                				                ?>
    	            				            <option value="<?php echo $key['subject_id'];?>" <?php if($subject_id == $key['subject_id']) echo "selected";?>><?php echo $key['name'];?></option>
                				                <?php endforeach;?>
    						                </select>
    					                <?php endif;?>
    					                </div>
    		  			            </div>
    				            </div>
				            <div class="col-sm-2">
  					            <div class="form-group"> 
  						            <button class="btn btn-warning btn-upper top-20" type="submit"><span>Ver módulos</span></button>
  					            </div>
				            </div>
  			            </div>
		            <?php echo form_close();?>
		            <?php if($class_id > 0 && $section_id > 0 && $subject_id > 0):?>
                    <div class="expense-button"><button class="btn btn-success btn-rounded btn-upper" data-target="#new_semester" data-toggle="modal" type="button">+ <?php echo getEduAppGTLang('new_semester');?></button></div><br>
                    <div class="element-wrapper">
                        <h6 class="element-header"><?php echo getEduAppGTLang('semesters');?></h6>
                        <div class="element-box-tp">
                            <div class="table-responsive">
                                <table class="table table-padded">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th><?php echo getEduAppGTLang('name');?></th>
                                            <th><?php echo getEduAppGTLang('class');?></th>
                                            <th><?php echo getEduAppGTLang('section');?></th>
                                            <th><?php echo getEduAppGTLang('subject');?></th>
                                            <th><?php echo getEduAppGTLang('options');?></th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                           	            <?php $n = 1; $semesters = $this->db->get_where('exam', array('class_id' => $class_id, 'section_id' => $section_id, 'subject_id' => $subject_id))->result_array(); foreach($semesters as $row):?>
                                        <tr>
                                            <td><?php echo $n++;?></td>
                                            <td><span><?php echo $row['name'];?></span></td>
                                            <td><span><?php echo $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;?></span></td>
                                            <td><span><?php echo $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name;?></span></td>
                                            <td><span><?php echo $this->db->get_where('subject', array('subject_id' => $row['subject_id']))->row()->name;?></span></td>
                                            <td class="bolder">
                                                <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_semester/<?php echo $row['exam_id'];?>');" class="grey" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('edit');?>"><i class="os-icon picons-thin-icon-thin-0001_compose_write_pencil_new"></i></a>
                                                <a data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('delete');?>" class="danger grey" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/semesters/delete/<?php echo $row['exam_id'];?>"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                                            </td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                    
                    <div class="modal fade top10p" id="new_semester" tabindex="-1" role="dialog" aria-labelledby="new_semester" aria-hidden="true">
                        <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
                            <div class="modal-content">
                                <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                                <div class="modal-body">
                                    <div class="modal-header mdl-header">
                                        <h6 class="title text-white"><?php echo getEduAppGTLang('new_semester');?></h6>
                                    </div>
                                    <div class="ui-block-content">
                                        <form action="<?php echo base_url();?>admin/semesters/create" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                            <div class="row">
                                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('name');?></label>
                                                        <input class="form-control" type="text" name="name" required="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating is-select">
                                                        <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                                                        <div class="select">
                                                            <select name="class_id" required="" onchange="getSec(this.value)">
                                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                                <?php 
                                                                    $class = $this->db->get('class')->result_array();
                                                                    foreach ($class as $row): ?>
                                                                <option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating is-select">
                                                        <label class="control-label"><?php echo getEduAppGTLang('section');?></label>
                                                        <div class="select">
                                                            <select name="section_id" required="" id="secHol" onchange="getSubs(this.value);">
                                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group label-floating is-select">
                                                        <label class="control-label"><?php echo getEduAppGTLang('subject');?></label>
                                                        <div class="select">
                                                            <select name="subject_id" required="" id="subHol">
                                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('save');?></button>
                                                </div>
                                            </div>
                                        </form>          
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        function getSec(class_id) 
        {
            $.ajax({
                url: rootAppURI+'admin/get_class_section/' + class_id ,
                success: function(response)
                {
                    jQuery('#secHol').html(response);
                }
            });
        }
        
        function getSubs(section_id) 
        {
            $.ajax({
                url: rootAppURI+'admin/get_class_subject/' + section_id ,
                success: function(response)
                {
                    jQuery('#subHol').html(response);
                }
            });
        }

    </script>