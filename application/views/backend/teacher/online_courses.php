<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="content-w">
    <?php include 'fancy.php';?>
    <div class="header-spacer"></div>
    <div class="conty">
        <div class="os-tabs-w menu-shad">       
        <div class="os-tabs-controls">        
            <ul class="navs navs-tabs upper">           
                <li class="navs-item">            
                    <a class="navs-links active" href="<?php echo base_url();?>teacher/online_courses/"><i class="picons-thin-icon-thin-0593_video_play_youtube"></i>
                    <span><?php echo getEduAppGTLang('online_courses');?></span></a>
                </li>
                <li class="navs-item">            
                    <a class="navs-links" href="<?php echo base_url();?>teacher/new_online_course/"><i class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
                    <span><?php echo getEduAppGTLang('new_online_course');?></span></a>
                </li>
            </ul>       
        </div>
    </div>  
        <div class="content-box">
            <div class="row">
             <div class="col col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="ui-block list" data-mh="friend-groups-item" style="">
                    <div class="friend-item friend-groups">
                        <div class="friend-item-content">
                            <div class="friend-avatar">
                                <br><br>
                                <i class="picons-thin-icon-thin-0593_video_play_youtube" style="font-size:45px; color: #99bf2d;"></i>
                                <h1 style="font-weight:bold;"><?php echo $this->db->get_where('online_course', array('user' => 'teacher', 'user_id'=>$this->session->userdata('login_user_id')))->num_rows();?></h1>
                                <div class="author-content">
                                    <div class="country"><b> <?php echo getEduAppGTLang('total_courses');?></b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="ui-block list" data-mh="friend-groups-item" style="">
                    <div class="friend-item friend-groups">
                        <div class="friend-item-content">
                            <div class="friend-avatar">
                                <br><br>
                                <i class="picons-thin-icon-thin-0590_movie_recording_play_director_cut" style="font-size:45px; color: #dd2979;"></i>
                                <h1 style="font-weight:bold;"><?php echo $this->db->get_where('online_course', array('status' => 1 , 'user' => 'teacher', 'user_id'=>$this->session->userdata('login_user_id')))->num_rows();?></h1>
                                <div class="author-content">
                                    <div class="country"><b><?php echo getEduAppGTLang('active_courses');?></b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="ui-block list" data-mh="friend-groups-item" style="">
                    <div class="friend-item friend-groups">
                        <div class="friend-item-content">
                            <div class="friend-avatar">
                                <br><br>
                                <i class="picons-thin-icon-thin-0060_error_warning_danger_stop_delete_exit" style="font-size:45px; color: #f4af08 ;"></i>
                                <h1 style="font-weight:bold;"><?php echo $this->db->get_where('online_course', array('status' => 0, 'user' => 'teacher', 'user_id'=>$this->session->userdata('login_user_id')))->num_rows();?></h1>
                                <div class="author-content">
                                    <div class="country"><b> <?php echo getEduAppGTLang('inactive_courses');?></b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="content-i">
      <div class="content-box">
        <div class="row">
          <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
            <div id="newsfeed-items-grid">                
                <div class="element-wrapper">
                    <div class="element-box-tp">
                    <h6 class="element-header">
                    <?php echo getEduAppGTLang('online_courses');?>
                    </h6>
                  <div class="table-responsive">
                    <table class="table table-padded">
                        <thead>
                          <tr>
                            <th><?php echo getEduAppGTLang('status');?></th>
                            <th><?php echo getEduAppGTLang('title');?></th>
                            <th><?php echo getEduAppGTLang('class');?></th>
                            <th><?php echo getEduAppGTLang('lesson_and_section');?></th>
                            <th><?php echo getEduAppGTLang('options');?></th>
                          </tr>
                        </thead>
                          <tbody>
                          <?php
                            $counter = 1;
                            $this->db->order_by('online_course_id', 'desc');
                            $onlines = $this->db->get_where('online_course', array('year' => $running_year, 'user' => 'teacher', 'user_id'=>$this->session->userdata('login_user_id')))->result_array();
                            foreach ($onlines as $hm):
                          ?>
                          <tr>
                            <td>
                                <?php if($hm['status'] == 1):?>
                                    <span class="status-pill green"></span> <span><?php echo getEduAppGTLang('active');?></span>
                                <?php else:?>
                                    <span class="status-pill red"></span><span><?php echo getEduAppGTLang('inactive ');?></span>
                                <?php endif;?>
                            </td>
                            <td><span><?php echo $hm['title'];?></span></td>
                            <td>
                                <span class="badge badge-success"><?php echo $this->db->get_where('class', array('class_id' => $hm['class_id']))->row()->name.' - '.$this->db->get_where('section', array('section_id' => $hm['section_id']))->row()->name;?></span>
                            </td>
                            <td>Sections: <?php echo $hm['section']?>
                            Lessons: <?php echo $hm['lesson'];?></td>
                            <td class="bolder">
                                <a style="color:grey;" href="<?php echo base_url();?>teacher/watch/<?php echo $hm['online_course_id']?>" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('view_online_course');?>"><i class="picons-thin-icon-thin-0140_airplay_screen_sharing"></i></a>
                                <a style="color:grey;" href="<?php echo base_url();?>teacher/lessons/<?php echo $hm['online_course_id']?>" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('lesson_and_quiz');?>"><i class="picons-thin-icon-thin-0003_write_pencil_new_edit"></i></a>
                                <?php if($hm['status'] == 1):?>
                                <a style="color:grey;" onClick="return confirm('<?php echo getEduAppGTLang('confirm_inactive');?>')" href="<?php echo base_url();?>teacher/online_courses/inactive/<?php echo $hm['online_course_id']?>" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('mark_as_inactive');?>"><i class="picons-thin-icon-thin-0153_delete_exit_remove_close"></i></a>
                                <?php else:?>
                                <a style="color:grey;" onClick="return confirm('<?php echo getEduAppGTLang('confirm_active');?>')" href="<?php echo base_url();?>teacher/online_courses/active/<?php echo $hm['online_course_id']?>" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('mark_as_active');?>"><i class="picons-thin-icon-thin-0154_ok_successful_check"></i></a>
                                <?php endif;?>
                                <a style="color:grey;" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')"  href="<?php echo base_url();?>teacher/online_courses/delete/<?php echo $hm['online_course_id']?>" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('delete');?>"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                            </td>
                          </tr>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </main>
              </div>
            </div>
            <a class="back-to-top" href="javascript:void(0);" style="color:#fff;">
              <i class="picons-thin-icon-thin-0128_upload_load_share"></i>
            </a>
          </div>
    </div>      
  </div>
</div>
<div class="display-type"></div>
</div>
