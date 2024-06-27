<?php $questions = $this->db->get_where('quiz_bank', array('quiz_id' => $param2))->result_array();
    $title = $this->db->get_where('quiz', array('quiz_id' => $param2))->row()->title;
?>


<div class="modal-body">
    <div class="modal-header" style="background-color:#00579c">
        <h6 class="title" style="color:white"><?php echo getEduAppGTLang('questions_of_'). $title;?></h6>
    </div>
    <div class="ui-block-content">
        <div class="row">
         
            <br><br><br>
            <div class="col-md-12">
                <?php if(count($questions) > 0):?>
                <?php foreach($questions as $row): ?>
                <div class="ui-block" data-mh="friend-groups-item" style="height:auto;">
                    <div style="padding-left:20%;" class="text-left">
                    <h5><?php echo $row['question_title'];?> <a title="<?php echo getEduAppGTLang('update');?>" style="float:right; padding-right:20%;" href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/update_question_quiz/<?php echo $row['quiz_bank_id']?>')" class="h5 author-name"><i class="icon-share-alt"></i></a>
                    <a style="float:right; padding-right:2%;" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')"  href="<?php echo base_url();?>teacher/lessons/delete_question/<?php echo $row['quiz_bank_id']?>" title="<?php echo getEduAppGTLang('delete');?>"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a></h5>    
                    </div>
                </div>
                <?php endforeach;?>
                <?php else:?>
                <h5><?php echo getEduAppGTLang('Add_a_new_question');?> </h5>
                <?php endif;?>
                 <a title="<?php echo getEduAppGTLang('new_question');?>" style="float:right; padding-right:10px;" href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/question_quiz_online/<?php echo $param2;?>')" ><button style="float:right;" class="btn btn-success btn-block"><?php echo getEduAppGTLang('New_question');?></button></a>
            </div>
        </div>
    </div>
</div>