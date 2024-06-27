<div class="modal-body">
    <div class="modal-header" style="background-color:#00579c">
        <h6 class="title" style="color:white"><?php echo getEduAppGTLang('add_new_quiz');?></h6>
    </div>
    <div class="ui-block-content">
        <div class="row">
            <div class="col-md-12">
                <?php echo form_open(base_url() . 'admin/lessons/create_quiz/', array('method' => 'post', 'enctype' => 'multipart/form-data'));?>
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo getEduAppGTLang('quiz_title');?></label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" name="title_quiz"/>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-12">
                         <label class="control-label"><?php echo getEduAppGTLang('section');?></label>
                        <div class="select">
                            <select name="section_online_id" required="">
                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                <?php $parents = $this->db->get_where('section_online', array('online_course_id' => $param2))->result_array();
                                    foreach($parents as $rows):?>
                                    <option value="<?php echo $rows['section_online_id'];?>"><?php echo $rows['name'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
            
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="hidden" class="form-control" name="online_course_id" value="<?php echo $param2?>"/>
                    </div>
                </div>
                
                
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo getEduAppGTLang('instruction');?></label>
                    <div class="col-sm-12">
                        <textarea type="text" class="form-control" name="instruction"/></textarea>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success btn-block"><?php echo getEduAppGTLang('add');?></button>
                    </div>
                </div>
        
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
