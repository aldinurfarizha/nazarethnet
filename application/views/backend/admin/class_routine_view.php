<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<link rel="stylesheet" href="<?php echo base_url();?>public/uploads/styles.css" type="text/css" media="screen"/>
<?php 
    $start_1 = $this->db->get_where('settings', array('type' => 'start_1'))->row()->description;
    $final_1 = $this->db->get_where('settings', array('type' => 'final_1'))->row()->description;
    $start_2 = $this->db->get_where('settings', array('type' => 'start_2'))->row()->description;
    $final_2 = $this->db->get_where('settings', array('type' => 'final_2'))->row()->description;
    $class_duration = $this->db->get_where('settings', array('type' => 'class_duration'))->row()->description;
    $sundays = $this->db->get_where('academic_settings' , array('type' =>'routine'))->row()->description;
?>
<script type="text/javascript">
  var redipsURL = '<?php echo base_url();?>';
  var redipsMsg = '<?php echo getEduAppGTLang('the content has changed dont forget to save the changes');?>';
  var redipsMsgd = '<?php echo getEduAppGTLang('content_deleted');?>';
</script>
<script type="text/javascript" src="<?php echo base_url();?>public/uploads/redips-drag-min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>public/uploads/script.js"></script>
<style>
    .no_schedules{
        background: repeating-linear-gradient( 45deg, #eee, #eee 2px, #F7F7F7 2px, #F7F7F7 14px );
    }
</style>
<div class="content-w">
    <?php include 'fancy.php';?>
    <div class="header-spacer"></div>
    <div class="conty">
      <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
          <ul class="navs navs-tabs upper">
            <li class="navs-item">
              <a class="navs-links active" href="<?php echo base_url();?>admin/class_routine_view/"><i class="os-icon picons-thin-icon-thin-0024_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('class_routine');?></span></a>
            </li>
            <li class="navs-item">
              <a class="navs-links" href="<?php echo base_url();?>admin/teacher_routine/"><i class="os-icon picons-thin-icon-thin-0011_reading_glasses"></i><span><?php echo getEduAppGTLang('teacher_routine');?></span></a>
            </li>
          </ul>     
        </div>
      </div>
      <div class="content-box">
        <?php echo form_open(base_url() . 'admin/class_routine_view/apply', array('class' => 'form m-b'));?>
            <div class="row">
                <div class="col-sm-5">
            <div class="form-group label-floating is-select">
                        <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                        <div class="select">
                            <select name="class_id" required="" onchange="get_class_sections(this.value)" >
                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                <?php
                    $classes = $this->db->get('class')->result_array();
                    foreach($classes as $row):                        
                  ?>                
                    <option value="<?php echo $row['class_id'];?>" <?php if($id == $row['class_id']) echo "selected";?>><?php echo $row['name'];?></option>            
                  <?php endforeach;?>
                            </select>
                        </div>
                    </div>
          </div>
          <div class="col-sm-5">
            <div class="form-group label-floating is-select">
                        <label class="control-label"><?php echo getEduAppGTLang('section');?></label>
                        <div class="select">
                            <?php if($section_id == ""):?>
                      <select name="section_id" required id="section_holder" onchange="submit();">
                          <option value=""><?php echo getEduAppGTLang('select');?></option>
                  </select>
                <?php else:?>
                    <select name="section_id" required id="section_holder" onchange="submit();">
                          <option value=""><?php echo getEduAppGTLang('select');?></option>
                          <?php 
                            $sections = $this->db->get_where('section', array('class_id' => $id))->result_array();
                              foreach ($sections as $key):
                          ?>
                            <option value="<?php echo $key['section_id'];?>" <?php if($section_id == $key['section_id']) echo "selected";?>><?php echo $key['name'];?></option>
                          <?php endforeach;?>
                  </select>
                <?php endif;?>
                        </div>
                    </div>
          </div>
            </div>    
        <?php echo form_close();?>
         
        <?php if($id > 0 && $section_id > 0):?>
            <div class="tab-content">
            <script type="text/javascript">
              var cl_id = '<?php echo $id;?>';
              var sc_id = '<?php echo $section_id;?>';
            </script>
            <div class="element-wraper">
            <h3 class="element-header"><i class="
                      picons-thin-icon-thin-0025_alarm_clock_ringer_time_morning"></i> <?php echo getEduAppGTLang('class_routine');?> <small>(<?php echo $this->db->get_where('class', array('class_id' => $id))->row()->name;?> <b><?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name;?></b>)</small>
            </h3>
            <hr>    
            <div id="main_container">
            <div id="redips-drag">
              <div class="row">
                <div class="col-sm-12">
                  <center><div id="message" class="alert alert-info" style="background:#00a1c4; color:#fff; border: #00a1c4"><?php echo getEduAppGTLang('Drag the subjects to the table (you can clone subjects using SHIFT)');?></div></center>
                </div>
                <div class="col-sm-2">
                  <div class="element-box-tp" style="background:#fff"> 
                    <div class="table-responsive">
                      <table id="table1" style="width: 100%; min-height: 50vh;">
                        <tbody>
                          <tr>
                            <td class="no_schedules"><h6 style="padding-top:10px"><?php echo getEduAppGTLang('subjects');?></h6></td>
                          </tr>
                          <?php $subjects = $this->crud->getSubjects($id, $section_id); 
                            foreach($subjects as $curso):
                            $sbid = $curso['subject_id'];
                            $name = $curso['name'];
                          ?>
                          <tr>
                            <td class="dark">
                              <div id="<?php echo $sbid;?>" class="redips-drag redips-clone <?php echo $sbid;?>" style="border: 2px solid #<?php echo $curso['color'];?>;color:#<?php echo $curso['color'];?>;padding:10px; font-weight: bold;background-color:#fff;"><?php echo $name;?></div>
                              <input id="b_<?php echo $sbid;?>" class="<?php echo $sbid;?>" type="hidden"/>
                            </td>
                          </tr>
                          <?php endforeach;?> 
                          <tr>
                            <td class="redips-trash" title="<?php echo getEduAppGTLang('drag_here_to_delete');?>" style="width: 50%; height: 50px; padding: 5px;"><center><?php echo getEduAppGTLang('delete');?></center></td>
                          </tr>
                        </tbody>
                      </table>              
                    </div>
                  </div>
                    </div>
                      <div class="col-sm-10" id="prints">
                        <div class="custom-control custom-checkbox" style="display: inline-block; padding-right: 20px;">
                          <input type="checkbox" id="week" class="custom-control-input"> 
                          <label for="week" class="custom-control-label"><?php echo getEduAppGTLang('apply_all_week');?></label>
                        </div>
                        <div class="table-responsive">
                        <table id="table2" style="width: 100%; min-height: 55vh;">
                          <tbody>
                            <tr style="background:#1b55e2;">
                              <td height="10" class="redips-mark dark"><span style="font-size: 15px;color:#fff;"><b><?php echo getEduAppGTLang('time');?></b></span></td>
                              <td class="redips-mark dark"><span style="font-size: 15px;color:#fff"><b><?php echo getEduAppGTLang('monday');?></b></span></td>
                              <td class="redips-mark dark"><span style="font-size: 15px;color:#fff"><b><?php echo getEduAppGTLang('tuesday');?></b></span></td>
                              <td class="redips-mark dark"><span style="font-size: 15px;color:#fff"><b><?php echo getEduAppGTLang('wednesday');?></b></span></td>
                              <td class="redips-mark dark"><span style="font-size: 15px;color:#fff"><b><?php echo getEduAppGTLang('thursday');?></b></span></td>
                              <td class="redips-mark dark"><span style="font-size: 15px;color:#fff"><b><?php echo getEduAppGTLang('friday');?></b></span></td>
                              <?php if($sundays == 1): ?>
                                <td class="redips-mark dark"><span style="font-size: 15px;color:#fff"><b><?php echo getEduAppGTLang('saturday');?></b></span></td>
                                <td class="redips-mark dark"><span style="font-size: 15px;color:#fff"><b><?php echo getEduAppGTLang('sunday');?></b></span></td>
                            <?php endif;?>
                            </tr>
                            <?php
                                $horas = $this->crud->intervalo($start_1, $final_1, $class_duration);
                                for($i = 0; $i < count($horas)-1; $i++):
                            ?>
                                <?php $this->crud->timetable($horas[$i] . " - ".$horas[$i+1], $i+1, $id, $section_id); ?>
                                <?php $hrs_fin +=1;?>
                            <?php endfor;?>
                            <tr>
                                <td class="redips-mark dark">-----</td>
                                <td class="redips-mark lunch no_schedules" <?php if($sundays == 1):?>colspan="7" <?php else: ?>colspan="5"<?php endif;?>><h6><?php echo getEduAppGTLang('break');?></h6></td>
                            </tr>
                            <?php
                                $despues = $hrs_fin+2;
                                $horas2 = $this->crud->intervalo($start_2, $final_2, $class_duration);
                                for($j = 0; $j < count($horas2)-1; $j++):
                            ?>
                                <?php $this->crud->timetable($horas2[$j] . " - ".$horas2[$j+1], $j+$despues, $id, $section_id); ?>
                            <?php endfor;?>
                          </tbody>
                      </table>
                      </div>
                      <br/>
                      <button style="float: right;" type="submit" class="btn btn-warning btn-rounded" onclick="redips.save()"><?php echo getEduAppGTLang('apply_changes');?></button>
                    </div>
                  </div>
                </div>  
                </div>    
              </div>
            </div>
        <?php endif;?>
        </div>
    </div>
<div class="display-type"></div>
</div>

<script type="text/javascript">
    function get_class_sections(class_id) 
    {
        $.ajax({
            url: '<?php echo base_url();?>admin/get_class_section/' + class_id ,
            success: function(response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
</script>