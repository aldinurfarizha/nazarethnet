<div class="content-w">
  <div class="conty">
  <?php include 'fancy.php';?>
  <div class="header-spacer"></div>
     <div class="top-header top-header-favorit">
        <div class="top-header-thumb">
          <img src="<?php echo base_url();?>public/uploads/<?php echo $this->db->get_where('settings', array('type'=>'bglogin'))->row()->description;?>" style="height:180px; object-fit:cover;">
          <div class="top-header-author">
            <div class="author-thumb">
              <img src="<?php echo base_url();?>public/uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description;?>" style="background-color: #fff; padding:10px">
            </div>
            <div class="author-content">
              <a href="javascript:void(0);" class="h3 author-name"><?php echo getEduAppGTLang('team_conferences');?> 
              </a>
              <div class="country"><?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;?>  |  <?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;?></div>
            </div>
          </div>
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
                    <div style="margin-top:auto;float:right;"><a href="#" data-target="#addlive" data-toggle="modal" class="text-white btn btn-control btn-grey-lighter btn-success"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i><div class="ripple-container"></div></a></div>
                    </h6>
                      <div class="table-responsive">
                        <table class="table table-padded">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo getEduAppGTLang('created_by');?></th>
                                    <th><?php echo getEduAppGTLang('title');?></th>
                                    <th><?php echo getEduAppGTLang('date');?></th>
                                    <th><?php echo getEduAppGTLang('start_time');?></th>
                                    <th><?php echo getEduAppGTLang('end_time');?></th>
                                    <th><?php echo getEduAppGTLang('description');?></th>
                                    <th><?php echo getEduAppGTLang('options');?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
                                    
                                    $n = 1;
            		                $this->db->order_by('team_conference_id', 'desc');
            		                $this->db->where('year', $running_year);
            		                
            		                $info = $this->db->get('team_conference')->result_array();
                		            
                		            foreach ($info as $row):
                		                
                		            if(in_array($this->session->userdata('login_user_id'), explode(',',$row['admin_members']))):
            	                ?>   
                                <tr>
                                    <td><?php echo $n++?></td>
                                    <td><?php echo $this->crud->get_name($row['user_type'],$row['user_id']);?></td>
                                    <td><?php echo $row['title']?></td>
                                    <td><?php echo $row['start_date'];?></td>
                                    <td><?php echo $row['start_time'];?></td>
                                    <td><?php echo $row['end_time'];?></td>
                                    <td><?php echo $row['description']?></td>
                                    <td class="bolder">
                                        <a title="<?php echo getEduAppGTLang('entry');?>"target="_blank" href="<?php echo base_url();?>admin/team_live/<?php echo base64_encode($row['team_conference_id']);?>" style="color:gray;"><span><i style="color:gray;" class="picons-thin-icon-thin-0139_window_new_extern_full_screen_maximize"></i></span></a>
                                        <a title="<?php echo getEduAppGTLang('choose_admins');?>" style="color:grey;" href="<?php echo base_url();?>admin/team_admin_live/<?php echo $row['team_conference_id']?>/" class="h5 author-name"><i class="picons-thin-icon-thin-0326_computer_screen_users_profile"></i></a>
                                        <a title="<?php echo getEduAppGTLang('choose_teachers');?>" style="color:grey;" href="<?php echo base_url();?>admin/team_teacher_live/<?php echo $row['team_conference_id']?>/" class="h5 author-name"><i class="picons-thin-icon-thin-0304_chat_contact_support_help_conversation"></i></a>
                                        <a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_team_conference/<?php echo $row['team_conference_id'];?>');" style="color:gray;"> <span><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i></span> </a>
                                        <a style="color:grey;" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/team_conferences/delete/<?php echo $row['team_conference_id']?>/"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                                    </td>
                                </tr>
                                <?php endif;
                                endforeach;?>
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
                  <h6 class="title" style="color:white"><?php echo getEduAppGTLang('create_team_conference');?></h6>
                </div>
                <div class="ui-block-content">
                	<?php echo form_open(base_url() . 'admin/team_conferences/create/', array('enctype' => 'multipart/form-data')); ?>
        	            <div class="row">
        	                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        		<div class="form-group">
                          			<label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                          			<input class="form-control" name="title" type="text">
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
