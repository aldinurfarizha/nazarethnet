<?php 
    $running_year = $this->crud->getInfo('running_year');
    $info = $this->db->get_where('teacher', array('teacher_id' => $teacher_id))->result_array();
    foreach($info as $row):
?>
<?php 
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
    	<div class="content-i">
		    <div class="content-box">
    			<div class="conty">
			        <div class="back" style="margin-top:-20px;margin-bottom:10px">		
    	                <a title="<?php echo getEduAppGTLang('return');?>" href="<?php echo base_url();?>admin/teachers/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>	
	                </div>
    			    <div class="row">
            			<main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">                
            			    <div id="newsfeed-items-grid">
        						<div class="ui-block paddingtel">
          						    <div class="user-profile">
              							<div class="up-head-w" style="background-image:url(<?php echo base_url();?>public/uploads/bglogin.jpg)">
          								    <div class="up-main-info">
              								   	<div class="user-avatar-w">
          								            <div class="user-avatar">
          								                <img alt="" src="<?php echo $this->crud->get_image_url('teacher', $row['teacher_id']);?>" style="background-color:#fff;">
          								            </div>
          								        </div>
          								        <h3 class="text-white"><?php echo $row['first_name'];?> <?php echo $row['last_name'];?></h3>
          								        <h5 class="up-sub-header">@<?php echo $row['username'];?></h5>
          								    </div>
          								    <svg class="decor" width="842px" height="219px" viewBox="0 0 842 219" preserveAspectRatio="xMaxYMax meet" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g transform="translate(-381.000000, -362.000000)" fill="#FFFFFF"><path class="decor-path" d="M1223,362 L1223,581 L381,581 C868.912802,575.666667 1149.57947,502.666667 1223,362 Z"></path></g></svg>
          							    </div>
          							    <div class="up-controls">
              								<div class="row">
          								        <div class="col-lg-6">
              								        <div class="value-pair">
          								                <div><?php echo getEduAppGTLang('account_type');?>:</div>
          								                <div class="value badge badge-pill badge-success"><?php echo getEduAppGTLang('teacher');?></div>
          								            </div>
          								            <div class="value-pair">
              								            <div><?php echo getEduAppGTLang('member_since');?>:</div>
          								                <div class="value"><?php echo $row['since'];?>.</div>
          								            </div>
          								        </div>
          								    </div>
          							    </div>
          							    <div class="ui-block">
    										<div class="ui-block-title">		
											    <h6 class="title"><?php echo getEduAppGTLang('teacher_schedules');?></h6>
										    </div>
										    <div class="ui-block-content">
										        <div id="redips-drag">
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
        			    </main>
        			    <div class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12">
                			<div class="eduappgt-sticky-sidebar">
                			    <div class="sidebar__inner">
                    				<div class="ui-block paddingtel">
                					    <div class="ui-block-content">
                        					<div class="widget w-about">
                        					    <a href="javascript:void(0);" class="logo"><img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>"></a>
                        					    <ul class="socials">
                                					<li><a class="socialDash fb" href="<?php echo $this->crud->getInfo('facebook');?>"><i class="fab fa-facebook-square" aria-hidden="true"></i></a></li>
                                                    <li><a class="socialDash tw" href="<?php echo $this->crud->getInfo('twitter');?>"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                                    <li><a class="socialDash yt" href="<?php echo $this->crud->getInfo('youtube');?>"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                                                    <li><a class="socialDash ig" href="<?php echo $this->crud->getInfo('instagram');?>"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                        					    </ul>
                    					    </div>
                					    </div>
            					    </div>
                				    <div class="ui-block paddingtel">
                    					<div class="ui-block-content">
                						    <div class="help-support-block">
    											<h3 class="title"><?php echo getEduAppGTLang('quick_links');?></h3>
											    <ul class="help-support-list">
    												<li>
													    <i class="picons-thin-icon-thin-0133_arrow_right_next" style="font-size:20px"></i> &nbsp;&nbsp;&nbsp;
													    <a href="<?php echo base_url();?>admin/teacher_profile/<?php echo $teacher_id;?>/"><?php echo getEduAppGTLang('personal_information');?></a>
												    </li>
												    <li>
    													<i class="picons-thin-icon-thin-0133_arrow_right_next" style="font-size:20px"></i> &nbsp;&nbsp;&nbsp;
													    <a href="<?php echo base_url();?>admin/teacher_update/<?php echo $teacher_id;?>/"><?php echo getEduAppGTLang('update_information');?></a>
												    </li>
												    <li>
    													<i class="picons-thin-icon-thin-0133_arrow_right_next" style="font-size:20px"></i> &nbsp;&nbsp;&nbsp;
													    <a href="<?php echo base_url();?>admin/teacher_schedules/<?php echo $teacher_id;?>/"><?php echo getEduAppGTLang('schedules');?></a>
												    </li>
												    <li>
    													<i class="picons-thin-icon-thin-0133_arrow_right_next" style="font-size:20px"></i> &nbsp;&nbsp;&nbsp;
													    <a href="<?php echo base_url();?>admin/teacher_subjects/<?php echo $teacher_id;?>/"><?php echo getEduAppGTLang('subjects');?></a>
												    </li>
											    </ul>
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
<?php endforeach;?>