<div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo getEduAppGTLang('add_new_section');?></h6>
        </div>
        <div class="ui-block-content">
    <div class="row">
        <div class="col-md-12">
            <?php echo form_open(base_url() . 'teacher/lessons/create_section/', array('enctype' => 'multipart/form-data'));?>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo getEduAppGTLang('title');?></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" name="title_section"/>
                </div>
            </div>
        
            <div class="form-group">
                <div class="col-sm-12">
                    <input type="hidden" class="form-control" name="online_course_id" value="<?php echo $param2?>"/>
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
