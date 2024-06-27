<?php 
    $running_year   = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; 
    $start_1        = $this->db->get_where('settings', array('type' => 'start_1'))->row()->description;
    $final_1        = $this->db->get_where('settings', array('type' => 'final_1'))->row()->description;
    $start_2        = $this->db->get_where('settings', array('type' => 'start_2'))->row()->description;
    $final_2        = $this->db->get_where('settings', array('type' => 'final_2'))->row()->description;
    $class_duration = $this->db->get_where('settings', array('type' => 'class_duration'))->row()->description;
    $sundays = $this->db->get_where('academic_settings' , array('type' =>'routine'))->row()->description;
$hrs_fin = 0; ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/theme/css/styles.css" type="text/css" media="screen"/>
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/theme/js/script.js"></script>

<div class="content-w">
    <div class="conty">
  <?php include 'fancy.php';?>
  <div class="header-spacer"></div>
 <div class="os-tabs-w menu-shad">
        <div class="os-tabs-controls">
          <ul class="navs navs-tabs upper">
            <li class="navs-item">
              <a class="navs-links active" href="<?php echo base_url();?>teacher/my_routine/"><i class="os-icon picons-thin-icon-thin-0024_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('class_routine');?></span></a>
            </li>
          </ul>
        </div>
      </div>
  <div class="content-i">
    <div class="content-box"><div class="element-wrapper">

          <div class="element-wrapper">
            <div class="element-box table-responsive lined-primary shadow" id="print_area">
            <div class="row m-b">
                <div style="display:inline-block">
                <img style="max-height:60px;margin:0px 10px 20px 20px" src="<?php echo $this->crud->get_image_url('teacher', $this->session->userdata('login_user_id'));?>" alt=""/>        
                </div>
                <div style="padding-left:20px;display:inline-block;">
                <h5><?php echo getEduAppGTLang('my_routine');?></h5>
                <p><?php echo $this->crud->get_name('teacher', $this->session->userdata('login_user_id'));?></p>
                </div>
            </div>
            
            
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
                                    <?php $this->crud->teacher_timetable($horas[$i] . " - ".$horas[$i+1], $i+1, $this->session->userdata('login_user_id')); ?>
                                    <?php $hrs_fin +=1;?>
                                <?php endfor;?>
                                <tr>
                                    <td class="redips-mark dark">--</td>
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
                                    <?php $this->crud->teacher_timetable($horas2[$j] . " - ".$horas2[$j+1], $j+$despues, $this->session->userdata('login_user_id')); ?>
                                <?php endfor;?>
                              </tbody>
                          </table>
                          </div>
                        </div>
                      </div>
                    </div>  
                    </div>    
                
            </div>
            <button class="btn btn-rounded btn-primary pull-right" onclick="printDiv('print_area')" ><?php echo getEduAppGTLang('print');?></button><br><br><br>
          </div>
        </div>
      </div>
    </div>
  </div>
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