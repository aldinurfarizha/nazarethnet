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
                            <a class="navs-links active" href="<?php echo base_url();?>admin/section/"><i class="os-icon picons-thin-icon-thin-0002_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('sections'); ?></span></a>
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
				            <a class="navs-links" href="<?php echo base_url();?>admin/certificates/"><i class="os-icon picons-thin-icon-thin-0178_add_more_layers_slides"></i><span><?php echo getEduAppGTLang('certificates'); ?></span></a>
				        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="col-sm-12">
                        <h5 class="form-header"><?php echo getEduAppGTLang('manage_sections');?></h5><br>
                        <div class="row">
                            <div class="col-sm-6">
                                <?php echo form_open(base_url() . 'admin/section/', array('class' => 'form m-b'));?>
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                                        <div class="select">
                                            <select name="class_id" onchange="submit();">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php $cl = $this->db->get('class')->result_array(); foreach($cl as $row):?>
                                                <option value="<?php echo $row['class_id'];?>" <?php if($class_id == $row['class_id']) echo 'selected';?>><?php echo $row['name'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                <?php echo form_close();?>
                            </div>
                            <div class="col-sm-6">
                                <div class="pull-right">
                                    <a href="javascript:void(0);" class="grbg22 btn btn-control bg-purple" data-toggle="modal" data-target="#crearadmin">
                                        <i class="picons-thin-icon-thin-0001_compose_write_pencil_new px25" title="<?php echo getEduAppGTLang('new_section');?>"></i>
                                        <div class="ripple-container"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-12">  
                                <div class="row">   
                                <?php $sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
                                foreach($sections as $row):?>
                                    <div class="col-sm-4">
                                        <div class="ui-block list">
                                            <div class="more mgr-right15 pull-right">
                                                <i class="icon-options"></i>                                
                                                <ul class="more-dropdown zin">
                                                    <li><a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_section/<?php echo $row['section_id'];?>');"><?php echo getEduAppGTLang('edit');?></a></li>
                                                    <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/section/delete/<?php echo $row['section_id'];?>"><?php echo getEduAppGTLang('delete');?></a></li>
                                                </ul>
                                            </div>
                                            <div class="birthday-item inline-items">
                                                <div class="circle blue"><?php echo $row['name'][0];?></div>&nbsp;
                                                <div class="birthday-author-name">
                                                    <div><b><?php echo getEduAppGTLang('teacher');?>:</b> <?php echo $this->crud->get_name('teacher', $row['teacher_id']);?></div>
                                                    <div><b><?php echo getEduAppGTLang('students');?>:</b> <?php $this->db->where('section_id', $row['section_id']); echo $this->db->count_all_results('enroll');?>.</div>
                                                    <div><b><?php echo getEduAppGTLang('class');?>:</b> <span class="badge badge-info px12"><?php echo $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;?></span></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <div class="modal fade top10p" id="crearadmin" tabindex="-1" role="dialog" aria-labelledby="crearadmin" aria-hidden="true">
        <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
            <div class="modal-content">
                <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                <div class="modal-body">
                    <div class="modal-header mdl-header">
                        <h6 class="title text-white"><?php echo getEduAppGTLang('new_section');?></h6>
                    </div>
                    <div class="ui-block-content">
                        <?php echo form_open(base_url() . 'admin/section/create');?>
                            <div class="row">
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label"><?php echo getEduAppGTLang('name');?></label>
                                        <input class="form-control" type="text" name="name" required="">
                                    </div>
                                </div>
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('teacher');?></label>
                                        <div class="select">
                                            <select name="teacher_id">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php $teachers = $this->db->get('teacher')->result_array(); 
                                                    foreach($teachers as $teacher):
                                                ?>
                                                <option value="<?php echo $teacher['teacher_id'];?>"><?php echo $teacher['first_name']." ".$teacher['last_name'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                                        <div class="select">
                                            <select name="class_id" required>
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php $classes = $this->db->get('class')->result_array(); 
                                                foreach($classes as $row2):
                                                ?>
                                                <option value="<?php echo $row2['class_id'];?>" <?php if($class_id == $row2['class_id']) echo 'selected';?>><?php echo $row2['name'];?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('save');?></button>
                                </div>
                            </div>
                        <?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </div>