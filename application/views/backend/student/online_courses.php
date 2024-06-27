<div class="content-w">
  <?php $cl_id = $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id')))->row()->class_id;?>
  <?php $section_id = $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id')))->row()->section_id;?>
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
                                <div class="ae-content-w" style="background-color: #f2f4f8;">
                                  <div class="top-header top-header-favorit">
                                    <div class="top-header-thumb">
                                      <img src="<?php echo base_url();?>public/uploads/bglogin.jpg" style="height:180px; object-fit:cover;">
                                      <div class="top-header-author">
                                        <div class="author-thumb">
                                          <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" style="background-color: #fff; padding:10px">
                                        </div>
                                        <div class="author-content">
                                          <a href="javascript:void(0);" class="h3 author-name"><?php echo getEduAppGTLang('my_online_courses');?> <small>(<?php echo $this->db->get_where('class', array('class_id' => $cl_id))->row()->name;?>)</small></a>
                                          <div class="country"><?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;?>  |  <?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;?></div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <br><br><br>
                                  <div class="aec-full-message-w">
                                    <div class="aec-full-message">
                                      <div class="container-fluid" style="background-color: #f2f4f8;">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tabss">
                                              <div class="row">
                                              <?php 
                                                $this->db->order_by('online_course_id', 'asc');
                                                $courses = $this->db->get_where('online_course', array('class_id' => $cl_id, 'section_id' => $section_id, 'status' => 1))->result_array();
                                                foreach($courses as $row):
                                              ?>
                                                <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                                    <div class="ui-block" data-mh="friend-groups-item">        
                                                    <div class="friend-item friend-groups">
                                                        <div class="friend-item-content">         
                                                        
                                                        <div class="friend-avatar">
                                                            <div class="author-thumb">
                                                                 <?php if($row['thumbnail'] != ''):?><img src="<?php echo base_url();?>public/uploads/online_course_image/<?php echo $row['thumbnail'];?>" width="120px"> 
                                                                 <?php else:?>
                                                                 <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" width="120px">
                                                                 <?php endif;?>
                                                            </div>
                                                            <div class="author-content">
                                                                <a href="<?php echo base_url();?>student/watch/<?php echo $row['online_course_id'];?>/" class="h5 author-name"><?php echo $row['title'];?></a><br>
                                                                <a class="button btn-info" style="color:white;"><?php echo $this->db->get_where('subject', array('subject_id' => $row['subject_id']))->row()->name;?></a><br><br>
                                                               <img src="<?php echo $this->crud_model->get_image_url($row['user'], $row['user_id']);?>" style="border-radius:50%; width:30px;"><span>  <?php echo $this->crud_model->get_name($row['user'], $row['user_id']);?></span>
                                                            </div><br>
                                                            <div class="col-sm-6; text-center">
                                                        <?php $cont = $this->db->get_where('progress_course', array('online_course_id' => $row['online_course_id'], 'student_id' => $this->session->userdata('login_user_id'), 'quiz_id' => '0'))->num_rows();
                                                            if($cont == 0):?>
                                                                <a  href="<?php echo base_url();?>student/watch/<?php echo $row['online_course_id'];?>/"><input style="width:50%;" type="submit" name="submit" class="btn btn-outline-success btn-lg btn-rounded" value="start"></a>
                                                        <?php else:?>
                                                                <a  href="<?php echo base_url();?>student/watch/<?php echo $row['online_course_id'];?>/"><input style="width:50%;" type="submit" name="submit" class="btn btn-outline-primary btn-lg btn-rounded" value="continue"></a>
                                                        <?php endif;?>
                                                            </div>
                                                        </div>  
                                                    </div>
                                                  </div>
                                                   <div style="padding:20px;" class="">
                                                        <ul class="widget w-pool">
                                                            <div class="skills-item">
                                                                <div class="skills-item-info">
                                                        
                                                                <span class="skills-item-count">
                                                                    <span class="count-animate" data-speed="1000" data-refresh-interval="50" data-to="62" data-from="0"></span>
                                                                    <span class="units"><?php  if($cont > 1): echo number_format((($cont-1)*100)/$row['lesson']); else: echo '0';endif;?>%</span>
                                                                </span>
                                                                </div>
                                                                <br>
                                                               <div class="skills-item-meter">
                                                                  <span class="skills-item-meter-active bg-primary skills-animate" style="width: <?php echo number_format((($cont-1)*100)/$row['lesson']);?>%; opacity: 1;"></span>
                                                                </div>
                                                            </div>
                                                        </ul>
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
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
            <div class="display-type"></div>
        </div>
    </div>
</div>   