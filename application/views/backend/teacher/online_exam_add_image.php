    <?php echo form_open(base_url() . 'teacher/manage_online_exam_question/'.$online_exam_id.'/add/image' , array('enctype' => 'multipart/form-data'));?>
        <input type="hidden" name="type" value="teacher" id="uslg">
        <input type="hidden" name="type" value="<?php echo $question_type;?>">
        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo getEduAppGTLang('mark');?></label>
            <div class="col-sm-12">
                <input type="number" class="form-control" name="mark" required="" min="0"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo getEduAppGTLang('question');?></label>
            <div class="col-sm-12">
                <textarea name="question_title" class="form-control" id="question_title" rows="8" cols="80"></textarea>
            </div>
        </div>
        <div class="form-group" id='multiple_choice_question'>
            <label class="col-sm-6 control-label"><?php echo getEduAppGTLang('options_number');?></label>
            <div class="col-sm-12">
                <div class="form-group with-icon label-floating is-empty">
		            <label class="control-label"><?php echo getEduAppGTLang('options_number');?></label>
		            <input class="form-control" type="number"  name="number_of_options" id = "number_of_options" required="" min="0">
		            <button type="button" class = 'ooptionsx btn btn-sm' name="button" onclick="showOptions(jQuery('#number_of_options').val())"><i class="picons-thin-icon-thin-0154_ok_successful_check min35"></i></button>
		        </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success btn-block"><?php echo getEduAppGTLang('save');?></button>
            </div>
        </div>
    <?php echo form_close();?>