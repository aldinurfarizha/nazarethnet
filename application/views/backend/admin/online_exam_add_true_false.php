    <link href="<?php echo base_url();?>public/style/cms/css/exam_style.css" rel="stylesheet">

    <?php echo form_open(base_url() . 'admin/manage_online_exam_question/'.$online_exam_id.'/add/true_false' , array('enctype' => 'multipart/form-data'));?>
        <input type="hidden" name="type" value="<?php echo $question_type;?>">
        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo getEduAppGTLang('mark');?></label>
            <div class="col-sm-12">
                <input type="number" class="form-control" name="mark" data-validate="required" data-message-required="<?php echo getEduAppGTLang('value_required');?>" min="0"/>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label"><?php echo getEduAppGTLang('question');?></label>
            <div class="col-sm-12">
                <textarea onkeyup="changeTheBlankColor()" name="question_title" class="form-control" id="question_title" rows="8" cols="80" required></textarea>
            </div>
        </div>
        <div class="row top-10px text-left">
            <div class="col-sm-12 col-sm-offset-3">
                <p>
                    <input type="radio" id="true" name="true_false_answer" value="true" checked>
                    <label for="true"><?php echo getEduAppGTLang('true');?></label>
                </p>
            </div>
            <div class="col-sm-12 col-sm-offset-3">
                <p>
                    <input type="radio" id="false" name="true_false_answer" value="false">
                    <label for="false"><?php echo getEduAppGTLang('false');?></label>
                </p>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-success btn-block"><?php echo getEduAppGTLang('save');?></button>
            </div>
        </div>
    <?php echo form_close();?>