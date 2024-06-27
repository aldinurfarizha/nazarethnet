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
                		                
                		            if(in_array($this->session->userdata('login_user_id'), explode(',',$row['members']))):
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
                                        <a title="<?php echo getEduAppGTLang('entry');?>"target="_blank" href="<?php echo base_url();?>teacher/team_live/<?php echo base64_encode($row['team_conference_id']);?>" style="color:gray;"><span><i style="color:gray;" class="picons-thin-icon-thin-0139_window_new_extern_full_screen_maximize"></i></span></a>
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
      