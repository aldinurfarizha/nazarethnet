    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="content-i">
            <div class="content-box">
                <div class="conty">
                    <div class="row">
                        <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12 margintelbot">
                            <div class="friend-item min-h250 friend-groups create-group" data-mh="friend-groups-item">      
                                <a href="javascript:void(0);" class="full-block"></a>
                                <div class="content">      
                                    <a data-toggle="modal" data-target="#creargrado" href="javascript:void(0);" class="text-white btn btn-control bg-success"><i class="icon-feather-plus"></i></a>      
                                    <div class="author-content">
                                        <a  href="javascript:void(0);" class="h5 author-name"><?php echo getEduAppGTLang('new_class');?></a>
                                        <div class="country"><?php echo getEduAppGTLang('create_new_class');?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php 
                        if(isSuperAdmin()){
                            $classes = $this->db->get('class')->result_array();
                        }else{
                            $classes = $this->db->where('branch_id',getMyBranchId()->branch_id)->get('class')->result_array();
                        }
			                foreach($classes as $class):
		                ?>
                        <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="ui-block" data-mh="friend-groups-item">        
                                <div class="friend-item friend-groups">
                                    <div class="friend-item-content">
                                        <div class="more">
                                            <i class="icon-feather-more-horizontal"></i>
                                            <ul class="more-dropdown">
                                                <li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_class/<?php echo $class['class_id'];?>');"><?php echo getEduAppGTLang('edit');?></a></li>
                                                <li><a href="<?php echo base_url();?>admin/cursos/<?php echo base64_encode($class['class_id']);?>/"><?php echo getEduAppGTLang('subjects');?></a></li>
                                                <li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_send_marks/<?php echo $class['class_id'];?>');"><?php echo getEduAppGTLang('send_marks_by_email');?></a></li>
                                                <li><a href="<?php echo base_url();?>admin/manage_classes/delete/<?php echo $class['class_id'];?>" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')"><?php echo getEduAppGTLang('delete');?></a></li>
                                            </ul>
                                        </div>
                                        <div class="friend-avatar">
                                            <div class="author-thumb">
                                                <img src="<?php echo base_url();?>public/uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description;?>" width="120px" class="no-border bg-white padd15">
                                            </div>
                                            <div class="author-content">
                                                <a href="<?php echo base_url();?>admin/cursos/<?php echo base64_encode($class['class_id']);?>/" class="h5 author-name"><?php echo $class['name'];?></a>
                                                <div class="country"><b><?php echo getEduAppGTLang('teacher');?>:</b> <?php if($class['teacher_id']) echo $this->crud->get_name('teacher', $class['teacher_id']);?>.</div>
                                                <div class="country"><b><?php echo getEduAppGTLang('branch');?>:</b> <?php if($class['branch_id']) echo getDetailBranch($class['branch_id'])->name?>.</div>
                                                <div class="country"><b><?php echo getEduAppGTLang('sections');?>:</b> <?php $sections = $this->db->get_where('section', array('class_id' => $class['class_id']))->result_array(); foreach($sections as $sec):?> <?php if(count($sections) > 1) echo $sec['name']." "."|"; else echo $sec['name'].'.';?><?php endforeach;?></div>
                                            </div>
                                        </div>        
                                    </div>          
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
      
        <div class="modal fade" id="creargrado" tabindex="-1" role="dialog" aria-labelledby="fav-page-popup" aria-hidden="true">
            <div class="modal-dialog window-popup fav-page-popup" role="document"> 
                <div class="modal-content">
                    <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                    <div class="modal-header">
                        <h6 class="title"><?php echo getEduAppGTLang('create_new_class');?></h6>
                    </div>
                    <div class="modal-body">
                        <?php echo form_open(base_url() . 'admin/manage_classes/create/', array('enctype' => 'multipart/form-data')); ?>
                            <div class="row">
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label"><?php echo getEduAppGTLang('name');?></label>
                                        <input class="form-control" placeholder="" name="name" type="text" required>
                                    </div>
                                </div>
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('teacher');?></label>
                                        <div class="select">
                                            <select name="teacher_id" required="">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php $teachers = $this->db->get('teacher')->result_array();
                                                    foreach($teachers as $row):
                                                ?>
                                                <option value="<?php echo $row['teacher_id'];?>"><?php echo $row['first_name']." ".$row['last_name'];?></option>
                                            <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('branch');?></label>
                                        <div class="select">
                                            <select name="branch_id" required="">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php
                                                 if(isSuperAdmin()){
                                                        $branch = $this->db->where(['status'=>'ACTIVE'])->get('branch')->result_array();
                                                    }else{
                                                        $branch = $this->db->where([
                                                            'branch_id'=>getMyBranchId()->branch_id,
                                                            'status'=>'ACTIVE'
                                                        ])->get('branch')->result_array();
                                                    }
                                                    foreach($branch as $row):
                                                ?>
                                                <option value="<?php echo $row['branch_id'];?>"><?php echo $row['name'];?></option>
                                            <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <button class="btn btn-success btn-lg full-width" type="submit"><?php echo getEduAppGTLang('save');?></button>
                                </div>
                            </div>
                        </div>
                    <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>