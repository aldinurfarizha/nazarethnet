<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<?php $info = base64_decode($data);
    $ex = explode('-', $info);
?>
<?php $sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
foreach($sub as $subs):
?>
<div class="content-w">
  <div class="conty">
  <?php include 'fancy.php';?>
  <div class="header-spacer"></div>
    <div class="cursos cta-with-media" style="background: #<?php echo $subs['color'];?>;">
      <div class="cta-content">
        <div class="user-avatar">
          <img alt="" src="<?php echo base_url();?>public/uploads/subject_icon/<?php echo $subs['icon'];?>" style="width:60px;">
        </div>
        <h3 class="cta-header"><?php echo $subs['name'];?> - <small><?php echo getEduAppGTLang('marks');?></small></h3>
        <small style="font-size:0.90rem; color:#fff;"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name;?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name;?>"</small>
      </div>
    </div> 
    <div class="os-tabs-w menu-shad">
      <div class="os-tabs-controls">
        <ul class="navs navs-tabs upper">
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>admin/subject_dashboard/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>admin/online_exams/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>admin/homework/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>admin/forum/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo getEduAppGTLang('forum');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>admin/study_material/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links " href="<?php echo base_url();?>admin/upload_marks/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>admin/meet/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo getEduAppGTLang('live');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>admin/attendance/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>admin/whiteboards/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0191_window_application_cursor"></i><span><?php echo getEduAppGTLang('whiteboards');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links active" href="<?php echo base_url();?>admin/gamification/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0659_medal_first_place_winner_award_prize_achievement"></i><span><?php echo getEduAppGTLang('gamification');?></span></a>
          </li>
        </ul>
      </div>
    </div>
    <div class="content-i">
      <div class="content-box">
        <div class="row">
          <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
              <div id="newsfeed-items-grid">       
            <div class="ui-block">
                <article class="hentry post thumb-full-width">                
                  <div class="post__author author vcard inline-items">
                    <img src="<?php echo base_url();?>public/uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description;?>" style="border-radius:0px">                
                    <div class="author-date">
                      <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo getEduAppGTLang('gamification');?>.</a>
                    </div>                
            </div>                
        <div class="edu-posts cta-with-media">
			<div style="padding:0% 0%">
				<div id='cssmenu'>
				    <ul>
				        <li class="<?php if($page == '') echo 'act';?>"><a href="<?php echo base_url();?>admin/gamification/<?php echo $data.'/';?>"><i class="os-icon picons-thin-icon-thin-0659_medal_first_place_winner_award_prize_achievement"></i><?php echo getEduAppGTLang('resume');?></a></li>
				        <li class="<?php if($page == 'levels') echo 'act';?>"><a href="<?php echo base_url();?>admin/gamification/<?php echo $data.'/levels';?>/"><i class="os-icon picons-thin-icon-thin-0659_medal_first_place_winner_award_prize_achievement"></i><?php echo getEduAppGTLang('levels');?></a></li>
				        <li class="<?php if($page == 'rules') echo 'act';?>"><a href="<?php echo base_url();?>admin/gamification/<?php echo $data.'/rules';?>/"><i class="os-icon picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i><?php echo getEduAppGTLang('rules');?></a></li>
				        <li class="<?php if($page == 'settings') echo 'act';?>"><a href="<?php echo base_url();?>admin/gamification/<?php echo $data.'/settings';?>/"><i class="os-icon picons-thin-icon-thin-0659_medal_first_place_winner_award_prize_achievement"></i><?php echo getEduAppGTLang('settings');?></a></li>
				    </ul>
				</div>
			</div>
			<?php if($page == 'rules'):?>
              <div class="element-wrapper"> 
                <div class="element-box lined-primary shadow">
                  <div class="modal-header">
                    <h5 class="modal-title"><?php echo getEduAppGTLang('gamification_rules');?></h5>
                  </div>
                  <br>
                  <?php echo form_open(base_url() . 'admin/gamification/update_rules/'.$data, array('enctype' => 'multipart/form-data')); ?>
                  <div class="row">
                   <div class="col-sm-6">
                       <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('exp_per_forum_reply');?></label>
                            <div class="select">
                                <select name="forum" required="">
                                    <option value="">Select</option>
                                    <option value="1" <?php if($subs['forum'] == 1) echo 'selected';?>><?php echo getEduAppGTLang('yes');?></option>
                                    <option value="0" <?php if($subs['forum'] == 0) echo 'selected';?>><?php echo getEduAppGTLang('no');?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                       <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('exp_per_homework_submited');?></label>
                            <div class="select">
                                <select name="homework" required="">
                                    <option value="">Select</option>
                                    <option value="1" <?php if($subs['homework'] == 1) echo 'selected';?>><?php echo getEduAppGTLang('yes');?></option>
                                    <option value="0" <?php if($subs['homework'] == 0) echo 'selected';?>><?php echo getEduAppGTLang('no');?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                       <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('exp_per_online_exam_submited');?></label>
                            <div class="select">
                                <select name="online_exam" required="">
                                    <option value="">Select</option>
                                    <option value="1" <?php if($subs['online_exam'] == 1) echo 'selected';?>><?php echo getEduAppGTLang('yes');?></option>
                                    <option value="0" <?php if($subs['online_exam'] == 0) echo 'selected';?>><?php echo getEduAppGTLang('no');?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                       <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('exp_per_live_class_joined');?></label>
                            <div class="select">
                                <select name="live_class" required="">
                                    <option value="">Select</option>
                                    <option value="1" <?php if($subs['live_class'] == 1) echo 'selected';?>><?php echo getEduAppGTLang('yes');?></option>
                                    <option value="0" <?php if($subs['live_class'] == 0) echo 'selected';?>><?php echo getEduAppGTLang('no');?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12" style="text-align: center;">
                        <button type="submit" class="btn btn-success"><?php echo getEduAppGTLang('save');?></button>
                      </div>
                    </div>
                    </div>
                        <?php echo form_close();?>
                      </div>
                    </div>
                    <?php endif;?>
        
			<?php if($page == ''):?>
			<br>
			    <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                      <tr style="background:#f2f4f8;">
                          <th><?php echo getEduAppGTLang('student');?></th>
                          <th><?php echo getEduAppGTLang('level');?></th>
                          <th>EXP</th>
                          <th><?php echo getEduAppGTLang('actions');?></th>
                      </tr>
                  </thead>
                  <tbody>
                <?php
                    $count = 1;
                        $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
                        $gam_of_students = $this->db->get_where('enroll' , array('class_id' => $ex[0], 'section_id' => $ex[1] ,'year' => $year))->result_array();
                        foreach($gam_of_students as $rowx):
                    ?>
                    <tr style="height:25px;">                    
                        <td style="min-width:190px">
                            <img alt="" src="<?php echo $this->crud->get_image_url('student', $rowx['student_id']);?>" width="25px" style="border-radius: 10px;margin-right:5px;"> <?php echo $this->crud->get_name('student', $rowx['student_id']);?>
                        </td>
                        <td>
                            <img src="<?php echo base_url();?>public/uploads/levels/<?php echo $this->crud->getExpImg($ex[2],$rowx['student_id'],$ex[0],$ex[1]);?>.png" width="45px"/>
                        </td>
                        <td>
                            +<?php echo $this->crud->getExp($ex[2],$rowx['student_id'],$ex[0],$ex[1]);?>
                        </td>
                        <td>
                            <a class="btn btn-danger btn-sm" href="<?php echo base_url();?>admin/gamification/delete/<?php echo $data;?>/<?php echo $rowx['student_id'];?>" onclick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>');">Clear EXP</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                  </tbody>
                </table>
              </div>
			<?php endif;?>
			<?php if($page == 'levels'):?>
			<div class="eleme nt-wrapper"> 
                <div class="elem ent-box lined-primary">
                  <div class="modal-header">
                    <h5 class="modal-title"><?php echo getEduAppGTLang('gamification_levels');?></h5>
                  </div>
                  <br>
                  <div class="table-responsive">
                    <table class="table table-padded">
                        <thead>
                  			<tr>
                    			<th><?php echo getEduAppGTLang('level');?></th>
                    			<th><?php echo getEduAppGTLang('require');?></th>
                    			<th><?php echo getEduAppGTLang('description');?></th>
                    			<th><?php echo getEduAppGTLang('actions');?></th>
                  			</tr>
                		</thead>
                        <tbody>
                        <?php
                            $number = $this->db->get_where('subject' , array('subject_id' => $ex[2]))->row()->levels;
                            $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
                            if($number > 0){
                                 
                            
                            $this->db->limit($number);   
                            $this->db->order_by('level', 'asc');
        		            $query = $this->db->get_where('gamification', array('class_id' => $ex[0], 'section_id' => $ex[1], 'subject_id' => $ex[2], 'year' => $year))->result_array();
        		            foreach ($query as $row):
        	            ?>   
                            <tr>
                                <td><img src="<?php echo base_url();?>public/uploads/levels/<?php echo $row['level'];?>.png" width="45px"></td>                     
                                <td><?php echo $row['point'];?>EXP</td>   
                                <td><?php echo $row['description'];?></td>   
                                <td class="bolder">
                                    <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_gamification/<?php echo $row['id'];?>');" style="color:gray;"> <span><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i></span> </a>
                                </td>
                            </tr>
                            <?php endforeach; } ?>
                        </tbody>
                    </table>
                  </div>
                  
                      </div>
                    </div>
                    <?php endif;?>
            <?php if($page == 'settings'):?>
              <div class="element-wrapper"> 
                <div class="element-box lined-primary shadow">
                  <div class="modal-header">
                    <h5 class="modal-title"><?php echo getEduAppGTLang('gamification_settings');?></h5>
                  </div>
                  <br>
                  <?php echo form_open(base_url() . 'admin/gamification/update_settings/'.$data, array('enctype' => 'multipart/form-data')); ?>
                  <div class="row">
                   <div class="col-sm-6">
                       <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('enable_gamification');?></label>
                            <div class="select">
                                <select name="gamification" required="">
                                    <option value="">Select</option>
                                    <option value="1" <?php if($subs['gamification'] == 1) echo 'selected';?>><?php echo getEduAppGTLang('yes');?></option>
                                    <option value="0" <?php if($subs['gamification'] == 0) echo 'selected';?>><?php echo getEduAppGTLang('no');?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                       <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('number_of_levels');?></label>
                            <div class="select">
                                <select name="levels" required="">
                                    <option value="">Select</option>
                                    <option value="1" <?php if($subs['levels'] == 1) echo 'selected';?>>1</option>
                                    <option value="2" <?php if($subs['levels'] == 2) echo 'selected';?>>2</option>
                                    <option value="3" <?php if($subs['levels'] == 3) echo 'selected';?>>3</option>
                                    <option value="4" <?php if($subs['levels'] == 4) echo 'selected';?>>4</option>
                                    <option value="5" <?php if($subs['levels'] == 5) echo 'selected';?>>5</option>
                                    <option value="6" <?php if($subs['levels'] == 6) echo 'selected';?>>6</option> 
                                    <option value="7" <?php if($subs['levels'] == 7) echo 'selected';?>>7</option>
                                    <option value="8" <?php if($subs['levels'] == 8) echo 'selected';?>>8</option>
                                    <option value="9" <?php if($subs['levels'] == 9) echo 'selected';?>>9</option>
                                    <option value="10" <?php if($subs['levels'] == 10) echo 'selected';?>>10</option>
                                </select>
                            </div>
                        </div>
                    </div>
                     <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('addon_title');?></label>
                            <input class="form-control" value="<?php echo $subs['addon_title'];?>" type="text" name="addon_title" required="">
                            <span class="material-input"></span>
                            <span class="material-input"></span>
                        </div>
                    </div>
                     <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('addon_short_description');?></label>
                            <input class="form-control" value="<?php echo $subs['addon_description'];?>" type="text" name="addon_description" required="">
                            <span class="material-input"></span>
                            <span class="material-input"></span>
                        </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-12" style="text-align: center;">
                        <button type="submit" class="btn btn-success"><?php echo getEduAppGTLang('save');?></button>
                      </div>
                    </div>
                    </div>
                        <?php echo form_close();?>
                      </div>
                    </div>
                    <?php endif;?>
        
                  </div>
                  
                </article>
              </div>
              </div>
          </main>
          
              </div>
            </div>
            <a class="back-to-top" href="javascript:void(0);">
              <img src="<?php echo base_url();?>public/style/olapp/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
            </a>
          </div>
        </div>
      </div>
      
      <?php endforeach;?>