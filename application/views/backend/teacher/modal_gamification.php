<?php  
    $year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description;
    $edit_data = $this->db->get_where('gamification' , array('id' => $param2))->result_array();
    foreach($edit_data as $row):
?>    
      <div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo getEduAppGTLang('update_level');?></h6>
        </div>
        <div class="ui-block-content">
              <?php echo form_open(base_url() . 'teacher/gamification/update_level/'.$param2, array('enctype' => 'multipart/form-data')); ?>
                        <div class="row">
                            <input type="hidden" name="section_id" value="<?php echo $row['section_id'];?>">
                            <input type="hidden" name="class_id"  value="<?php echo $row['class_id'];?>">
                            <input type="hidden" name="subject_id" value="<?php echo $row['subject_id'];?>">
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"><?php echo getEduAppGTLang('require');?> (EXP)</label>
                                    <input class="form-control" type="text" value="<?php echo $row['point'];?>" name="require">
                                </div>
                            </div>
                            
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group label-floating">
                                    <label class="control-label"><?php echo getEduAppGTLang('description');?></label>
                                    <textarea class="form-control" type="text" name="description"><?php echo $row['description'];?></textarea>
                                </div>
                            </div>
                             
                            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                <button class="btn btn-rounded btn-success btn-lg " type="submit"><?php echo getEduAppGTLang('update');?></button>
                            </div>
                        </div>
                    <?php echo form_close();?>
                </div>
            </div>
    <?php endforeach;?>