<?php $Quizzes = $this->db->get_where('quiz', array('quiz_id' => $param2))->result_array();
        foreach($Quizzes as $qq):
?>
<div class="modal-body">
    <div class="modal-header" style="background-color:#00579c">
        <h6 class="title" style="color:white"><?php echo get_phrase('update_quiz');?></h6>
    </div>
    <div class="ui-block-content">
        <div class="row">
            <div class="col-md-12">
                <?php echo form_open(base_url().'admin/lessons/change_quiz/'.$param2, array('method' => 'post', 'enctype' => 'multipart/form-data'));?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('quiz_title');?></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="title_quiz" value="<?php echo $qq['title'];?>">
                        <input type="hidden" class="form-control" name="online_course_id" value="<?php echo $qq['online_course_id'];?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-12">
                         <label class="control-label"><?php echo get_phrase('section');?></label>
                        <div class="select">
                            <select name="section_online_id" required="">
                                <option value=""><?php echo get_phrase('select');?></option>
                                <?php $parents = $this->db->get_where('section_online', array('online_course_id' => $qq['online_course_id']))->result_array();
                                    foreach($parents as $rows):?>
                                    <option value="<?php echo $rows['section_online_id'];?>" <?php if($rows['section_online_id'] == $qq['section_online_id']) echo "selected";?>><?php echo $rows['name'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
            
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo get_phrase('instruction');?></label>
                    <div class="col-sm-12">
                        <textarea type="text" class="form-control" name="instruction"><?php echo $qq['instruction'];?></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="submit" name="submit" class="btn btn-outline-danger btn-lg btn-rounded" value="delete">
                        </div>
                        
                        <div class="col-sm-6">
                            <input type="submit" name="submit" class="btn btn-outline-success btn-lg btn-rounded" value="update">
                        </div>
                    </div>
                </div>
        
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>