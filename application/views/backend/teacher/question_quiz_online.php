<div class="modal-body">
    <div class="modal-header" style="background-color:#00579c">
        <h6 class="title" style="color:white"><?php echo getEduAppGTLang('add_new_question');?></h6>
    </div>
    <div class="ui-block-content">
        <div class="row">
            <div class="col-md-12">
                <?php echo form_open(base_url() . 'teacher/lessons/create_question/', array('method' => 'post', 'enctype' => 'multipart/form-data'));?>
                <input type="hidden" class="form-control" name="quiz_id" value="<?php echo $param2?>"/>
    
                
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo getEduAppGTLang('mark');?></label>
                    <div class="col-sm-12">
                        <input type="number" class="form-control" name="mark" required="" min="0"/>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label"><?php echo getEduAppGTLang('question');?></label>
                    <div class="col-sm-12">
                        <textarea onkeyup="changeTheBlankColor()" name="question_title" class="form-control" id="question_title" rows="8" cols="80"></textarea>
                    </div>
                </div>
                <div class="form-group" id='multiple_choice_question'>
                    <label class="col-sm-6 control-label"><?php echo getEduAppGTLang('options_number');?> <small><b>(Click on Check icon to show options)</b></small></label>
                    <div class="col-sm-12">
                        <div class="form-group with-icon label-floating is-empty">
                            <label class="control-label"><?php echo getEduAppGTLang('options_number');?></label>
                            <input class="form-control" type="number"  name="number_of_options" id = "number_of_options" required="" min="0">
                            <button type="button" class = 'btn btn-sm' name="button" onclick="showOptions(jQuery('#number_of_options').val())" style="border-radius: 0px; background-color: #fff; margin-top:-10px;"><i class="picons-thin-icon-thin-0154_ok_successful_check" style="margin-top:-35px;"></i></button>
                        </div>
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



 <script type="text/javascript">
    function showOptions(number_of_options){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url();?>teacher/manage_multiple_choices_options",
            data: {number_of_options : number_of_options},
            success: function(response){
                console.log(response);
                jQuery('.options').remove();
                jQuery('#multiple_choice_question').after(response);
            }
        });
    }
</script>




