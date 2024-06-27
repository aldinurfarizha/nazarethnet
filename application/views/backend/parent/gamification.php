<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<?php $info = base64_decode($data);?>
<?php $ex = explode("-",$info);?>
<?php $class_info = $this->db->get('class')->result_array(); ?>
<?php $sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
foreach($sub as $row):
?>
<div class="content-w">
  <div class="conty">
  <?php include 'fancy.php';?>
  <div class="header-spacer"></div>
    <div class="cursos cta-with-media" style="background: #<?php echo $row['color'];?>;">
      <div class="cta-content">
        <div class="user-avatar">
          <img alt="" src="<?php echo base_url();?>public/uploads/subject_icon/<?php echo $row['icon'];?>" style="width:60px;">
        </div>
        <h3 class="cta-header"><?php echo $row['name'];?> - <small><?php echo getEduAppGTLang('live');?></small></h3>
        <small style="font-size:0.90rem; color:#fff;"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name;?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name;?>"</small>
      </div>
    </div>  
    <div class="os-tabs-w menu-shad">
      <div class="os-tabs-controls">
        <ul class="navs navs-tabs upper">
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>parents/subject_dashboard/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>parents/online_exams/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>parents/homework/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>parents/forum/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo getEduAppGTLang('forum');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>parents/study_material/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>parents/subject_marks/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>parents/attendance_report/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance');?></span></a>
            </li>
          <li class="navs-item">
            <a class="navs-links active" href="<?php echo base_url();?>parents/gamification/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0659_medal_first_place_winner_award_prize_achievement"></i><span><?php echo getEduAppGTLang('gamification');?></span></a>
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
                    <div class="element-box">
                    <h6 class="element-header">
                        <?php echo $this->db->get_where('subject' , array('class_id' => $ex[0], 'subject_id' => $ex[2], 'section_id' => $ex[1]))->row()->addon_title;?>
                    </h6>
                    <p><?php echo $this->db->get_where('subject' , array('class_id' => $ex[0], 'subject_id' => $ex[2], 'section_id' => $ex[1]))->row()->addon_description;?></p>
			    <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                      <tr style="background:#f2f4f8;">
                          <th><?php echo getEduAppGTLang('student');?></th>
                          <th><?php echo getEduAppGTLang('level');?></th>
                          <th>EXP</th>
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
      

<?php endforeach;?>

<script>
    $('input[type=radio][name=livetype]').change(function() {
        if (this.value == '1') {
            $('#siteUrl').hide(500);
        }
        else if (this.value == '2') {
            $('#siteUrl').show(500);
        }
    });
</script>