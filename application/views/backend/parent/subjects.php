    <div class="content-w">
    <?php $running_year = $this->crud->getInfo('running_year');?>
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="all-wrapper no-padding-content solid-bg-all">
                <div class="layout-w">
                    <div class="content-w">
                        <div class="content-i">
                            <div class="content-box">
                                <div class="app-email-w">
                                    <div class="app-email-i">
                                        <div class="ae-content-w grbg">
                                            <div class="top-header top-header-favorit">
                                                <div class="top-header-thumb">
                                                    <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('bglogin');?>" class="bgcover">
                                                    <div class="top-header-author">
                                                        <div class="author-thumb">
                                                            <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" class="authorCv">
                                                        </div>
                                                        <div class="author-content">
                                                            <a href="javascript:void(0);" class="h3 author-name"><?php echo getEduAppGTLang('academic');?></a>
                                                            <div class="country"><?php echo $this->crud->getInfo('system_name');?>  |  <?php echo $this->crud->getInfo('system_title');?></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="profile-section">
                                                    <div class="container-fluid">
                                                        <div class="row">
                                                            <div class="col col-xl-8 m-auto col-lg-8 col-md-12">
                                                                <div class="os-tabs-w">
                                                                    <div class="os-tabs-controls">
                                                                        <ul class="navs navs-tabs upper">
                                                                        <?php 
                        			  	                                    $n = 1;
                    			  	                                        $children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                                                                            foreach ($children_of_parent as $row):?>
                                                                            <li class="navs-item">
                                                                        	<?php $active = $n++;?>
                    				  		                                    <a class="navs-links <?php if($active == 1) echo 'active';?>" data-toggle="tab" href="#<?php echo $row['username'];?>"><img alt="" src="<?php echo $this->crud->get_image_url('student', $row['student_id']);?>" width="25px" class="tbl-st"> <?php echo $this->crud->get_name('student', $row['student_id']);?></a>
                    					                                    </li>
                                                                        <?php endforeach; ?>
                                                                        </ul>
                                                                    </div> 
                                                                </div>                                        
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="aec-full-message-w">
                                                <div class="aec-full-message">
                                                    <div class="container-fluid grbg">
                                                        <div class="tab-content">
                                                        <?php 
                                			                $n = 1;
			                                                $children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                                                            foreach ($children_of_parent as $row3):
                                                            $class_id = $this->db->get_where('enroll' , array('student_id' => $row3['student_id'] , 'year' => $running_year))->row()->class_id;
                                                            $section_id = $this->db->get_where('enroll' , array('student_id' => $row3['student_id'] , 'year' => $running_year))->row()->section_id;
                                                        ?>
        	                                            <?php $active = $n++;?>
	 		                                                <div class="tab-pane <?php if($active == 1) echo 'active';?>" id="<?php echo $row3['username'];?>">
                                                                <div class="row">
                                                                <?php 
                                                                $classAndSection=getStudentClassAndSectionById($row3['student_id']);
                                                                foreach($classAndSection as $cs):
                                                                    $subjects = getSubjectByClassIdandSectionId($cs->class_id, $cs->section_id);
                                                                    foreach($subjects as $row2):
                                                                        $finish=0;
                                                                            if(isStudentFinishSubject($row3['student_id'], $row2->subject_id)){
                                                                                $finish=1;
                                                                            }
                                                                            if (!isActiveSubject($row3['student_id'], $row2->subject_id)) {
                                                                                continue;
                                                                            }
                                                                ?>
                                                                    <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                                                        <div class="ui-block" data-mh="friend-groups-item">        
                                                                            <div class="friend-item friend-groups">
                                                                                <div class="friend-item-content">         
                                                                                    <div class="more">
                                                                                        <i class="icon-feather-more-horizontal"></i>
                                                                                        <ul class="more-dropdown">
                                                                                        <?php if($finish){
                                                                                            ?>
                                                                                                <li><a href="<?php echo base_url();?>parents/subject_marks/<?php echo base64_encode($class_id."-".$section_id."-".$row2->subject_id);?>/"><?php echo getEduAppGTLang('dashoard');?></a></li>
                                                                                            <?php }else{?>
                                                                                                <li><a href="<?php echo base_url();?>parents/subject_dashboard/<?php echo base64_encode($class_id."-".$section_id."-".$row2->subject_id);?>/"><?php echo getEduAppGTLang('dashoard');?></a></li>
                                                                                                <?php } ?>
                                                                                          
                                                                                        </ul>
                                                                                    </div>
                                                                                    <div class="friend-avatar">
                                                                                        <div class="author-thumb">
                                                                                            <img src="<?php echo base_url();?>public/uploads/subject_icon/<?php echo $row2->icon;?>" width="120px" class="sb" style="background-color:#<?php echo $row2->color;?>;">
                                                                                        </div>
                                                                                        <div class="author-content">
                                                                                        <?php
                                                                                            if($finish){?>
                                                                                            <span class="badge badge-success">Finalizado <i class="fa fa-check"></i></span>
                                                                                            <br>
                                                                                            <a href="<?php echo base_url();?>parents/subject_marks/<?php echo base64_encode($class_id."-".$section_id."-".$row2->subject_id.'-'.$row3['student_id']);?>/" class="h5 author-name"><?php echo $row2->name;?></a><br><br>
                                                                                            <?php }else{?>
                                                                                                <a href="<?php echo base_url();?>parents/subject_dashboard/<?php echo base64_encode($class_id."-".$section_id."-".$row2->subject_id.'-'.$row3['student_id']);?>/" class="h5 author-name"><?php echo $row2->name;?></a><br><br>
                                                                                            <?php } ?>
                                                                                            <img src="<?php echo $this->crud->get_image_url('teacher', $row2->teacher_id);?>" class="img-teacher"><span>  <?php echo $this->crud->get_name('teacher', $row2->teacher_id);?></span>
                                                                                        </div>                          
                                                                                    </div>                        
                                                                                </div>
                                                                            </div>        
                                                                        </div>
                                                                    </div>
                                                                    <?php endforeach; endforeach;?>
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
                        </div>
                    </div>
                </div>
                <div class="display-type"></div>
            </div>
        </div>
    </div>   