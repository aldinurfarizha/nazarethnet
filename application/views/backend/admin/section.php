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
                         <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/final_evaluation/"><i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i> <span>Evaluaciones Finales</span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/transfer_data/"><i class="picons-thin-icon-thin-0125_cloud_sync"></i> <span><?php echo getEduAppGTLang('transfer_data'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/export_data/"><i class="picons-thin-icon-thin-0088_download_file"></i> <span><?php echo getEduAppGTLang('export_data'); ?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="col-sm-12">
                        <h5 class="form-header"><?php echo getEduAppGTLang('manage_sections');?></h5><br>
                        <div class="row">
                            
                            <div class="col-sm-5">
                                <div class="form-group label-floating is-select">
                                    <label class="control-label"><?php echo getEduAppGTLang('filter_by_branch'); ?></label>
                                    <div class="select">
                                        <?php echo form_open(base_url() . 'admin/section/', array('class' => 'form m-b'));?>
                                        <select onchange="get_class(this.value);" name="branch_id">
                                            <option value=""><?php echo getEduAppGTLang('all'); ?></option>
                                            <?php
                                            if (isSuperAdmin()) {
                                                $branch = $this->db->where('status', 'ACTIVE')->get('branch')->result_array();
                                            } else {
                                                $branch = $this->db->where('branch_id', getMyBranchId()->branch_id)->get('branch')->result_array();
                                            }
                                            foreach ($branch as $row):
                                            ?>
                                                <option value="<?php echo $row['branch_id']; ?>" <?php if ($branch_id == $row['branch_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                                        <div class="select">
                                            <?php if ($class_id == ""): ?>
                                        <select onchange="submit();" name="class_id" required id="class_holder" onchange="get_sections(this.value);">
                                            <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                        </select>
                                    <?php else: ?>
                                        <select onchange="submit();" name="class_id" required id="class_holder" onchange="get_sections(this.value);">
                                            <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                            <?php
                                            $class = $this->db->get_where('class', array('class_id' => $class_id))->result_array();
                                            foreach ($class as $key):
                                            ?>
                                                <option value="<?php echo $key['class_id']; ?>" <?php if ($class_id == $key['class_id']) echo "selected"; ?>><?php echo $key['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    <?php endif; ?>
                                        </div>
                                    </div>
                                <?php echo form_close();?>
                            </div>
                            <div class="col-sm-1">
                                <div class="pull-right">
                                    <a href="javascript:void(0);" class="grbg22 btn btn-control bg-purple" data-toggle="modal" data-target="#crearadmin">
                                        <i class="picons-thin-icon-thin-0001_compose_write_pencil_new px25" title="<?php echo getEduAppGTLang('new_section');?>"></i>
                                        <div class="ripple-container"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-12">  
                                <div class="row">   
                                <?php 
                                if($class_id){
                                $sections = $this->db->get_where('section' , array('class_id' => $class_id))->result_array();
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
                            <?php } ?>
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
                                <div class="col-sm-6">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('branch'); ?></label>
                                        <div class="select">
                                            <select name="branch_id" required="" onchange="get_class2(this.value)">
                                                <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                                <?php
                                                if (isSuperAdmin()) {
                                                    $branch = $this->db->where('status', 'ACTIVE')->get('branch')->result_array();
                                                } else {
                                                    $where = [
                                                        'status' => 'ACTIVE',
                                                        'branch_id' => getMyBranchId()->branch_id
                                                    ];
                                                    $branch = $this->db->where($where)->get('branch')->result_array();
                                                }
                                                foreach ($branch as $row): ?>
                                                    <option value="<?php echo $row['branch_id']; ?>"><?php echo $row['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                                        <div class="select">
                                            <select name="class_id" id="class_holder2" required>
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