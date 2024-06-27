<?php  
    $edit_data = $this->db->order_by('mark_activity_id', 'ASC')->get_where('mark_activity' , array('mark_activity_id' => $param2) )->result_array();
?>    
    <?php echo form_open(base_url() . 'admin/manage_marks/edit_capacities/'.$param3.'/'.$param4.'/'.$param5.'/'.$param2.'/', array('enctype' => 'multipart/form-data')); ?>
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title"><?php echo getEduAppGTLang('update_activity');?></h6>
            </div>
            <div class="modal-body">
                <div class="ui-block-content">
                    <div class="row">
                        <?php foreach($edit_data as $row): ?>
                        <input type="hidden" value="<?php echo $row['mark_activity_id'];?>" name="mark_activity_id">
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group label-floating">
                                <label class="control-label"><?php echo getEduAppGTLang('name').': ';?></label>
                                <input class="form-control" placeholder="" name="name" value="<?php echo $row['name'];?>" type="text" required>
                            </div>
                        </div>
                        <?php endforeach; ?>
                        <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                            <button class="btn btn-success full-width" type="submit"><?php echo getEduAppGTLang('save_changes');?></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php echo form_close();?>
    </div>