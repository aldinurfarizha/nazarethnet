    <script src="<?php echo base_url();?>public/style/js/jquery.twbsPagination.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/cms/css/take_exam.css">
    <?php 
        $questions_number = $this->db->get_where('question_bank', array('online_exam_id' => $online_exam_id))->num_rows();
        $rnd = $this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id))->row()->show_random;
        $exam_ends_timestamp = strtotime(date('d-M-Y', $this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id))->row()->exam_date)." ".$this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id))->row()->time_end);
        $current_timestamp = strtotime("now");
        $datainfo = base64_encode($this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id))->row()->class_id.'-'.$this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id))->row()->section_id.'-'.$this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id))->row()->subject_id);
        $total_duration   = $exam_ends_timestamp - $current_timestamp;
        $total_hour     =   intval($total_duration / 3600);
        $total_duration   -=  $total_hour * 3600;
        $total_minute     = intval($total_duration / 60);
        $total_second     = intval($total_duration % 60);
        $online_exam_row = $exam_info->row();
        if($rnd == 1){
            $this->db->order_by('question_bank_id', 'RANDOM');   
        }
        $questions = $this->db->get_where('question_bank', array('online_exam_id' => $online_exam_id))->result_array();
        $total_marks = 0;
        foreach ($questions as $row) {
            $total_marks += $row['mark'];
        }
    ?>
    <div class="content-w">
        <div class="conty">
            <?php include 'fancy.php';?>
            <div class="header-spacer"></div>
            <div class="ui-block responsive-flex1200">
                <div class="ui-block-title">
                    <h4><?php echo $online_exam_row->title;?></h4>
                    <h4><b><?php echo getEduAppGTLang('duration');?></b>: <?php echo ($online_exam_row->duration / 60).' '.getEduAppGTLang('minutes');?></h4>
                    <div class="tmval" id="timer_value">
                        <span id="hour_timer"> 0 </span>
                        <span class="px20"><?php echo getEduAppGTLang('hour');?> </span>
                        <span class="blink_text">:</span>
                        <span id="minute_timer"> 0 </span>
                        <span class="px20"><?php echo getEduAppGTLang('minute');?> </span>
                        <span class="blink_text">:</span>
                        <span id="second_timer"> 0 </span>
                        <span class="px20"><?php echo getEduAppGTLang('second');?> </span>
                    </div>
                </div>
            </div><hr>
            <div class="content-i">
                <div class="content-box">
                    <form class="" action="<?php echo base_url();?>student/submit_online_exam/<?php echo $online_exam_id;?>/" method="post" enctype="multipart/form-data" id="answer_script">
                        <div class="row">
                            <?php $var = 0; $id1 = 1; $id2 = 1; $id3=1; $id4 =1; $count = 1; foreach ($questions as $question): $var++; ?>
                            <element class="col-sm-6 col-aligncenter page " id="page<?php echo $var;?>">
                                <div class="pipeline white lined-primary">            
                                    <div class="pipeline-header">
                                        <h5>
                                            <b><?php echo $count++;?>.</b>  <?php echo ($question['type'] == 'fill_in_the_blanks') ? str_replace('^', '__________', $question['question_title']) : $question['question_title'];?> 
                                        </h5>
                                        <span><?php echo getEduAppGTLang('mark');?>: <?php echo $question['mark'];?></span>
                                    </div>
                                    <?php if ($question['type'] == 'multiple_choice'): ?>
                                    <?php
                                      if ($question['options'] != '' || $question['options'] != null)
                                      $options = json_decode($question['options']);
                                      else
                                      $options = array();
                                      for ($i = 0; $i < $question['number_of_options']; $i++):
                                    ?>
                                    <div class="col-sm-12">
                                        <label class="containers"><?php echo $options[$i];?>
                                            <input type="checkbox" name="<?php echo $question['question_bank_id'].'[]'; ?>" value="<?php echo $i + 1;?>">
                                            <span class="checkmark"></span>
                                        </label>    
                                    </div>
                                    <?php endfor; endif;?>
                                    <?php if ($question['type'] == 'image'):
                                        if ($question['options'] != '' || $question['options'] != null)
                                        $options = json_decode($question['options']);
                                        else
                                        $options = array();
                                        for ($i = 0; $i < $question['number_of_options']; $i++):
                                    ?>
                                    <div class="col-sm-12">
                                        <label class="containers h200">
                                            <img class="example-image w150" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_question_image/<?php echo $options[$i];?>');" src="<?php echo base_url();?>public/uploads/online_exam/<?php echo $options[$i];?>">
                                            <input type="radio" name="<?php echo $question['question_bank_id'].'[]'; ?>" value="<?php echo $i + 1;?>">
                                            <span class="checkmark"></span>
                                        </label>   
                                    </div>
                                <?php endfor; endif;?>
                                <?php if ($question['type'] == 'true_false'): ?>
                                    <div class="skills-item">
                                        <div class="skills-item-info">
                                            <span class="skills-item-title">
                                                <span class="radio">
                                                    <h6>
                                                        <label>
                                                            <input type="radio" name="<?php echo $question['question_bank_id'].'[]'; ?>" value="true"><span class="circle"></span><span class="check"></span>
                                                            <?php echo getEduAppGTLang('true');?>
                                                        </label>
                                                    </h6>
                                                </span>
                                            </span>
                                        </div>
                                    </div> 
                                    <div class="skills-item">
                                        <div class="skills-item-info">
                                            <span class="skills-item-title">
                                                <span class="radio">
                                                    <h6>
                                                        <label>
                                                            <input type="radio" name="<?php echo $question['question_bank_id'].'[]'; ?>" value="false"><span class="circle"></span><span class="check"></span>
                                                            <?php echo getEduAppGTLang('false');?>
                                                        </label>
                                                    </h6>
                                                </span>
                                            </span>
                                        </div>
                                    </div> 
                                <?php endif; ?>
                                <?php if ($question['type'] == 'fill_in_the_blanks'): ?>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type="text" name="<?php echo $question['question_bank_id'].'[]'; ?>" value="" class="form-control" placeholder="<?php echo getEduAppGTLang('answer');?>">
                                        </div>
                                    </div>
                                <?php endif; ?>   
                                </div>
                            </element>
                            <?php endforeach; ?>
                        </div>  
                        
                        <input type="hidden" value="<?php echo $questions_number;?>" id="totalP"/>
                        <input type="hidden" value="<?php echo $total_hour;?>" id="totalH"/>
                        <input type="hidden" value="<?php echo $total_minute;?>" id="totalM"/>
                        <input type="hidden" value="<?php echo $total_second;?>" id="totalS"/>
                        <div class="container">
                            <ul id="pagination-demo" class="pagination justify-content-center"></ul>
                        </div>
                        <input type="hidden" value="<?php echo $datainfo;?>" name="datainfo">
                        <div class="col-sm-12 text-center">
                            <button class="btn btn-rounded btn-success text-center" id="subbutton"><?php echo getEduAppGTLang('finish_exam');?></button>
                        </div>
                    </form>
                </div>  
            </div>  
        </div>
    </div>  
    
    <script src="<?php echo base_url();?>public/style/js/exam_script.js"></script>