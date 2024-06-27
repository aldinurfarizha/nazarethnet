<?php  
    $edit_data = $this->db->get_where('expense_category' , array('expense_category_id' => $param2) )->result_array();
    foreach($edit_data as $row):
?>    
    <?php echo form_open(base_url() . 'admin/expense_category/update/'.$row['expense_category_id'], array('enctype' => 'multipart/form-data')); ?>
        <div class="modal-body ">
            <div class="modal-header mdl-header">
                <h6 class="title text-white"><?php echo getEduAppGTLang('update_category');?></h6>
            </div>
            <div class="ui-block-content">
                <div class="form-group with-button">
                    <input class="form-control" type="text" name="name"  value="<?php echo $row['name'];?>" required="">
                </div>
                <button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo getEduAppGTLang('udate');?></button>  
            </div>
        </div>
    <?php echo form_close();?>
<?php endforeach; ?>