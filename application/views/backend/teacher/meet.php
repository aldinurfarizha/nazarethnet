<?php 
    $running_year = $this->crud->getInfo('running_year');
    $info = base64_decode($data);
    $ex = explode("-",$info);
    $class_info = $this->db->get('class')->result_array();
    $sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
    foreach($sub as $row):
?>
    <div class="content-w">
        <div class="conty">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
            <div class="cursos cta-with-media" style="background: #<?php echo $row['color'];?>;">
                <div class="cta-content">
                    <div class="user-avatar">
                        <img alt="" src="<?php echo base_url();?>public/uploads/subject_icon/<?php echo $row['icon'];?>" class="icon-wi">
                    </div>
                    <h3 class="cta-header"><?php echo $row['name'];?> - <small><?php echo getEduAppGTLang('live');?></small></h3>
                    <small class="subject-desc"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name;?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name;?>"</small>
                </div>
            </div>  
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/subject_dashboard/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/online_exams/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/homework/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/forum/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo getEduAppGTLang('forum');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/study_material/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/upload_marks/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>teacher/meet/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo getEduAppGTLang('live');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/attendance/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>teacher/attendance_report/<?php echo $data; ?>/"><i class="picons-thin-icon-thin-0100_to_do_list_reminder_done"></i><span><?php echo getEduAppGTLang('attendance_report'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/whiteboards/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0191_window_application_cursor"></i><span><?php echo getEduAppGTLang('whiteboards');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/gamification/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0659_medal_first_place_winner_award_prize_achievement"></i><span><?php echo getEduAppGTLang('gamification');?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="row">
                        <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                            <div id="newsfeed-items-grid">                
                                <div class="element-wrapper">
                                    <div class="element-box-tp">
                                        <h6 class="element-header">
                                            <?php echo getEduAppGTLang('live');?>
                                            <div class="element-content"><a href="#" data-target="#addlive" data-toggle="modal" class="text-white btn btn-control btn-grey-lighter btn-success"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i><div class="ripple-container"></div></a></div>
                                        </h6>
                                        <div class="table-responsive">
                                            <table class="table table-padded">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th><?php echo getEduAppGTLang('title');?></th>
                                                        <th><?php echo getEduAppGTLang('date');?></th>
                                                        <th><?php echo getEduAppGTLang('start_time');?></th>
                                                        <th><?php echo getEduAppGTLang('end_time');?></th>
                                                        <th><?php echo getEduAppGTLang('description');?></th>
                                                        <th><?php echo getEduAppGTLang('status');?></th>
                                                        <th><?php echo getEduAppGTLang('options');?></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                    $n = 1;
                                                $this->db->order_by('zoom_id', 'desc');
                                                $this->db->where('class_id', $ex[0]);
                                                $this->db->where('section_id', $ex[1]);
                                                $this->db->where('subject_id', $ex[2]);
                                                $info = $this->db->get('zoom')->result_array();
                                                foreach ($info as $row):
                                              ?>   
                                                    <tr>
                                                        <td><?php echo $n++?></td>
                                                        <td><?php echo $row['title']?></td>
                                                        <td><?php echo $row['date']." ".$row['time'];?></td>
                                                        <td><?php echo $row['start_time'];?></td>
                                                        <td><?php echo $row['end_time'];?></td>
                                                        <td><?php echo $row['description']?></td>
                                                        <td><?php echo $row['date']." ".$row['time'];?></td>
                                                        <td class="bolder">
                                                            <a target="_blank" href="<?php echo base_url();?>teacher/live/<?php echo base64_encode($row['zoom_id']);?>" style="color:gray;"><span><i style="color:gray;" class="picons-thin-icon-thin-0139_window_new_extern_full_screen_maximize"></i></span></a>
                                                            <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_live/<?php echo $row['zoom_id'];?>');" style="color:gray;"> <span><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i></span> </a>
                                                            <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_attendance/<?php echo $row['zoom_id'];?>');" style="color:gray;"> <span><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i></span> </a>
                                                            <a style="color:grey;" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>teacher/meet/delete/<?php echo $row['zoom_id']?>/<?php echo $data;?>"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
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
            </div>
        </div>
    </div>
      
    <div class="modal fade" id="addlive" tabindex="-1" role="dialog" aria-labelledby="addlive" aria-hidden="true">
  <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
    <div class="modal-content">
      <a href="#" class="close icon-close" data-dismiss="modal" aria-label="Close">
      </a>
      <div class="modal-body">
        <div class="ui-block-title" style="background-color:#00579c">
          <h6 class="title" style="color:white"><?php echo getEduAppGTLang('create_live');?></h6>
        </div>
        <div class="ui-block-content">
          <?php echo form_open(base_url() . 'teacher/meet/create/'.$data, array('enctype' => 'multipart/form-data')); ?>
              <div class="row">
                  <input type="hidden" value="<?php echo $ex[0];?>" name="class_id"/>
                  <input type="hidden" value="<?php echo $ex[1];?>" name="section_id"/>
                    <input type="hidden" value="<?php echo $ex[2];?>" name="subject_id"/>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                        <input class="form-control" name="title" type="text" required="">
                    </div>
                  </div>
                  <div class="col col-lg-6 col-md-6 col-sm-12 col-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo getEduAppGTLang('zoom_meeting_id');?></label>
                        <input class="form-control" name="zoom_meeting_id" type="text" required="">
                    </div>
                  </div>
                  <div class="col col-lg-6 col-md-6 col-sm-12 col-6">
                    <div class="form-group">
                        <label class="control-label"><?php echo getEduAppGTLang('zoom_meeting_password');?></label>
                        <input class="form-control" name="zoom_meeting_password" type="text" required="">
                    </div>
                  </div>
                  <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                	<div class="form-group label-floating">
                                	    <label class="control-label"><?php echo getEduAppGTLang('points_exp');?></label>
                                	    <input class="form-control" name="exp" type="text">
                                	    <small><?php echo getEduAppGTLang('if_is_enabled_in_rules');?></small>
                                    </div>
                                </div>
                  <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="col-form-label" for=""><?php echo getEduAppGTLang('date');?></label>
                            <div class="input-group">
                                <input type='text' class="datepicker-here" data-position="top left" data-language='en' name="start_date" data-multiple-dates-separator="/"/>
                            </div>
                        </div>
                    </div>
                  <div class="col col-lg-6 col-md-6 col-sm-12 col-6">
                        <div class="form-group">
                            <label class="col-form-label" for=""><?php echo getEduAppGTLang('start_time');?></label>
                            <div class="input-group clockpicker" data-align="top" data-autoclose="true">
                                <input type="text" required="" name="start_time" class="form-control" value="00:00">
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-6">
                        <div class="form-group">
                            <label class="col-form-label" for=""><?php echo getEduAppGTLang('end_time');?></label>
                            <div class="input-group clockpicker" data-align="top" data-autoclose="true">
                                <input type="text" required="" name="end_time" class="form-control" value="00:00">
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="form-group">
                        <label class="control-label"><?php echo getEduAppGTLang('description');?></label>
                        <textarea class="form-control" rows="5" name="description"></textarea>
                    </div>
                  </div> 
              </div>
              <div class="form-buttons-w text-right">
                <center><button class="btn btn-rounded btn-success btn-lg" type="submit"><?php echo getEduAppGTLang('save');?></button></center>
              </div>
            <?php echo form_close();?>        
        </div>
      </div>
    </div>
  </div>
  </div>
<?php endforeach;?>