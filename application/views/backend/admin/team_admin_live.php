<?php
    $admins_array = $this->db->get('admin')->result_array();
?>
<div class="content-w">
    <div class="conty">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
   
            <div class="content-i">
                <div class="content-box">
                    <div class="row">
                        <div class="col-sm-12">
                        <?php $data = $this->db->get_where('team_conference', array('team_conference_id' => $team_conference_id)); 
                        foreach($data->result_array() as $rr):
                        ?>
                            <form action="<?php echo base_url();?>admin/team_admin_live/apply/<?php echo $team_conference_id;?>" method="POST">        
                                <div class="pipeline white lined-primary">
                                    <div class="back hidden-sm-down" style="margin-top:-20px;margin-bottom:10px">		
                                        <a title="back" href="<?php echo base_url();?>admin/team_conferences"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>	
                                	</div>
                                      <div class="pipeline-header">
                                      <h5 class="pipeline-name">
                                        <?php echo getEduAppGTLang('choose_admins_for_session_live');?>
                                      </h5>
                                      </div>
                                      
                                      <div class="table-responsive">
                                            <table class="table table-lightborder">
                                              <thead>
                                                <tr>
                                                    <th><?php echo getEduAppGTLang('admins');?></th>
                                                    <th><?php echo getEduAppGTLang('yes');?>/<?php echo getEduAppGTLang('no');?></th>
                                                    <th>-----</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php foreach ($admins_array as $row):
                                                if($row['admin_id'] != $this->session->userdata('login_user_id')):
                                            ?>
                                                    <tr>
                                                        <td><?php echo $row['first_name']." ".$row['last_name']; ?>
                                                       </td>
                                                        <td><div class="custom-control custom-checkbox">
                                                             <input type="checkbox" name="admins[]" id="<?php echo $row['admin_id']; ?>" value="<?php echo $row['admin_id']; ?>" class="custom-control-input" <?php if(in_array($row['admin_id'] , explode(',',$rr['admin_members']))) echo 'checked';?>> <label for="<?php echo $row['admin_id']; ?>" class="custom-control-label"></label>
                                                        </div>
                                                        </td>
                                                        <td>
                                                        -----
                                                        </td>
                                                    </tr>
                                                <?php endif;
                                                endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                        <div class="widget-content widget-content-area">
                                            <button type="submit" class="btn btn-info"><?php echo getEduAppGTLang('apply')?></button>
                                        </div>
                                </form>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
