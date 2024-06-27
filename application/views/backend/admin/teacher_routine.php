<?php 
    $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; 
    $start_1 = $this->db->get_where('settings', array('type' => 'start_1'))->row()->description;
    $final_1 = $this->db->get_where('settings', array('type' => 'final_1'))->row()->description;
    $start_2 = $this->db->get_where('settings', array('type' => 'start_2'))->row()->description;
    $final_2 = $this->db->get_where('settings', array('type' => 'final_2'))->row()->description;
    $class_duration = $this->db->get_where('settings', array('type' => 'class_duration'))->row()->description;
    $sundays = $this->db->get_where('academic_settings' , array('type' =>'routine'))->row()->description;
    

?>

<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/theme/css/styles.css" type="text/css" media="screen"/>
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/theme/js/script.js"></script>

<div class="content-w">
    <?php include 'fancy.php';?>
    <div class="header-spacer"></div>
    <div class="conty">
      <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
          <ul class="navs navs-tabs upper">
            <li class="navs-item">
              <a class="navs-links" href="<?php echo base_url();?>admin/class_routine_view/"><i class="os-icon picons-thin-icon-thin-0024_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('class_routine');?></span></a>
            </li>
            <li class="navs-item">
              <a class="navs-links active" href="<?php echo base_url();?>admin/teacher_routine/"><i class="os-icon picons-thin-icon-thin-0011_reading_glasses"></i><span><?php echo getEduAppGTLang('teacher_routine');?></span></a>
            </li>
          </ul>     
        </div>
      </div>
      <div class="content-box">
        <div class="row">
          <div class="col col-lg-9 col-md-9 col-sm-12 col-12">
            <?php echo form_open(base_url() . 'admin/teacher_routine/', array('class' => 'form m-b'));?>
            <div class="form-group label-floating is-select">
              <label class="control-label"><?php echo getEduAppGTLang('teacher');?></label>
              <div class="select">
                <select onchange="submit();" name="teacher_id" id="slct">
                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                    <?php 
                $teachers = $this->db->get('teacher')->result_array();
                      foreach($teachers as $row):?>
                    <option  value="<?php echo $row['teacher_id'];?>" <?php if($teacher_id == $row['teacher_id']) echo 'selected';?>><?php echo $row['first_name']." ".$row['last_name'];?></option>
                    <?php endforeach;?>
                </select>
              </div>
            </div>
            <?php echo form_close();?>
          </div>
        </div>               
 
      <div class="element-box">
      <?php if($teacher_id > 0):?>
              <div class="tab-content">
                <div class="element-wraper">
                <h3 class="element-header"><i class="
                          picons-thin-icon-thin-0025_alarm_clock_ringer_time_morning"></i> Horarios de Clase <small>(<b><?php echo $this->crud->get_name('teacher', $teacher_id);?></b>)</small>
                </h3>
                <hr>    
                <div id="main_container">
                <div id="redips-drag">
                  <div class="row">
                         <div class="col-sm-12" id="prints">
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
                                    <?php $this->crud->teacher_timetable($horas[$i] . " - ".$horas[$i+1], $i+1, $teacher_id); ?>
                                    <?php $hrs_fin +=1;?>
                                <?php endfor;?>
                                <tr>
                                    <td class="redips-mark dark"><?php echo $receso;?></td>
                                    <?php if($sundays == 1):?>
                                    <td class="redips-mark lunch no_schedules" colspan="7"><h6><?php echo getEduAppGTLang('break');?></h6></td>
                                    <?php else:?>
                                    <td class="redips-mark lunch no_schedules" colspan="5"><h6><?php echo getEduAppGTLang('break');?></h6></td>
                                    <?php endif;?>
                                </tr>
                                <?php
                                    $despues = $hrs_fin+2;
                                    $horas2 = $this->crud->intervalo($start_2, $final_2, $class_duration);
                                    for($j = 0; $j < count($horas2)-1; $j++):
                                ?>
                                    <?php $this->crud->teacher_timetable($horas2[$j] . " - ".$horas2[$j+1], $j+$despues, $teacher_id); ?>
                                <?php endfor;?>
                              </tbody>
                          </table>
                          </div>
                        </div>
                      </div>
                    </div>  
                    </div>    
                  </div>
              </div>
              <?php else:?>
                <div class="container">
                  <br><br>
                  <h1 class="text-center"><?php echo getEduAppGTLang('Organize your schedules easily and quickly.');?></h1>
                  <center><img src="<?php echo base_url();?>public/assets/images/horarios.svg" alt="" style="width: 50%;"></center>
                </div>
              <?php endif;?>
            </div>     
            </div>
        </div>
    <div class="display-type"></div>
</div>


  <script>
 function printDiv(nombreDiv) 
 {
     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;
     document.body.innerHTML = contenido;
     window.print();
     document.body.innerHTML = contenidoOriginal;
}
</script> 