<?php
    $teachers_array = $this->db->get('teacher')->result_array();
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
                    <form action="<?php echo base_url();?>admin/team_teacher_live/apply/<?php echo $team_conference_id;?>" method="POST">          
                        <div class="pipeline white lined-primary">
                            <div class="back hidden-sm-down" style="margin-top:-20px;margin-bottom:10px">		
                                <a title="back" href="<?php echo base_url();?>admin/team_conferences"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>	
                        	</div>
                              <div class="pipeline-header">
                              <h5 class="pipeline-name">
                                <?php echo getEduAppGTLang('choose_teachers_for_session_live');?>
                              </h5>
                              </div>
                              
                              <div class="table-responsive">
                                    <table class="table table-lightborder">
                                      <thead>
                                        <tr>
                                            <th><?php echo getEduAppGTLang('teachers');?></th>
                                            <th><?php echo getEduAppGTLang('yes');?>/<?php echo getEduAppGTLang('no');?></th>
                                            <th>-----</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php foreach ($teachers_array as $row):?>
                                            <tr>
                                                <td><?php echo $row['first_name']." ".$row['last_name']; ?>
                                               </td>
                                                <td><div class="custom-control custom-checkbox">
                                                     <input type="checkbox" name="teachers[]" id="<?php echo $row['teacher_id']; ?>" value="<?php echo $row['teacher_id']; ?>" class="custom-control-input" <?php if(in_array($row['teacher_id'] , explode(',',$rr['members']))) echo 'checked';?>> <label for="<?php echo $row['teacher_id']; ?>" class="custom-control-label"></label>
                                                </div>
                                                </td>
                                                <td>
                                                -----
                                                </td>
                                            </tr>
                                    <?php endforeach; ?>
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




