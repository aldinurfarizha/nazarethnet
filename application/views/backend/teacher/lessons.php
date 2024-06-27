<script src="<?php echo base_url();?>style/js/jquery.twbsPagination.js"></script>
 <style>
  .page {
    display: none;
  }
  .sactive a {
    background:#0084ff;
    color:#fff;
  }
  .page-active {
    display: block;
  }
 </style>


<?php $questions_number = $this->db->get_where('quiz_bank', array('quiz_id' => $quiz_id))->num_rows();?>

<?php 


$quizz = $this->db->get_where('quiz', array('quiz_id' => $quiz_id))->result_array();
foreach($quizz as $row):?> 

<div class="content-w">
    <?php include 'fancy.php';?>
    <div class="header-spacer">
    </div>
    <div class="conty">
        <div class="content-i">
          <div class="content-box">
              
                <div class="row" id="container">
                    <div class="col-lg-9 course_col order-md-1">
                        <?php
                        if($questions_number > 0):
                        $questions = $this->db->get_where('quiz_bank', array('quiz_id' => $quiz_id))->result_array();
                        $total_marks = 0;
                        
                       foreach ($questions as $n) {
                            $total_marks += $n['mark'];
                          }
                          ?> 
                        <div class="conty">
                            <div class="content-i">
                              <div class="content-box">
                        
                                <?php $count = 1; foreach ($questions as $question): $var++; ?>
                                <element class="col-sm-12 col-aligncenter page " id="page<?php echo $var;?>">
                                      <div class="pipeline white lined-primary">            
                                        <div class="pipeline-header">
                                          <h5><b><?php echo $count++;?>.</b>  <?php echo $question['question_title'];?> 
                                            </h5><span><?php echo getEduAppGTLang('mark');?>: <?php echo $question['mark'];?></span>
                                        </div>
                                   
                                        
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
                                        <?php endfor;  ?>   
                                      </div>
                                    </element>
                                    <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                                     <div class="container">
                                        <ul id="pagination-demo" class="pagination justify-content-center"></ul>
                                    </div>
                  
                          <div class="col-sm-12 text-center">
                            <a href="<?php echo base_url();?>teacher/online_courses/" ><button class="btn btn-rounded btn-success text-center" id="subbutton"><?php echo getEduAppGTLang('finish_exam');?></button></a>
                          </div>
                          
                           <br><br>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo getEduAppGTLang('Note');?>:</h5>
                                    <p class="card-text"><?php echo $row['instruction'];?></p>
                                </div>
                            </div>
                          <?php else:?>
                          <br><br>
                            <div class="col-sm-12 text-center">
                                <h5><b><?php echo getEduAppGTLang('No');?></b><?php echo getEduAppGTLang('Questions');?> </h5>
                            </div>
                          <?php endif;?>
                    </div>  

                  
                    <div class="col-lg-3 order-md-2 course_col">
                        <div class="text-center" style="margin: 12px 10px;">
                            <h4 style="color:#1b55e2;" ><?php echo $this->db->get_where('online_course', array('online_course_id' => $online_course_id))->row()->title;?> </h4><br>
                            <h6><b><?php echo getEduAppGTLang('content');?></b></h6>
                        </div>
                        <div class="row" style="margin: 12px -1px">
                            <div class="col-12">
                               <?php 
                                $this->db->order_by('section_online_id', 'asc');
                                $sections = $this->db->get_where('section_online', array('online_course_id'=>$online_course_id))->result_array();
                                $n=1; 
                                if(count($sections) > 0):
                                foreach($sections as $rr): ?>
                                <div class="card" style="margin:0px 0px;">
                                    <div class="card-header course_card">
                                        <h5 class="mb-0">
                                            <h6 style="color: #959aa2; font-size: 13px;">Section <?php echo $n++;?></h6>
                                                <?php echo $rr['name'];?>
                                        </h5>
                                    </div>
                                    <?php 
                                      $this->db->order_by('lesson_online_id', 'asc');
                                      $less = $this->db->get_where('lesson_online', array('section_online_id'=> $rr['section_online_id']))->result_array();
                                      $n2=1;
                                      $this->db->order_by('quiz_id', 'asc');
                                      $quizz = $this->db->get_where('quiz', array('section_online_id'=> $rr['section_online_id']))->result_array();?>
                                        <div class="card-body" style="padding:0px;">
                                            <table style="width: 100%;">
                                                <tbody>
                                                    <?php foreach($less as $ss):?>
                                                        <?php if($ss['type'] == 'videos'):?>
                                                        <tr style="width: 100%; padding: 5px 0px;background-color: #E6F2F5;">
                                                            <td style="text-align: left; padding:7px 10px;">
                                                                <div class="form-group">
                                                                    <a href="<?php echo base_url();?>teacher/view_lesson/video/<?php echo $online_course_id;?>/<?php echo $ss['lesson_online_id'];?>" id="1" style="font-size: 14px;font-weight: 400;">
                                                                    <?php echo $n2++; ?>: <b><?php echo $ss['name'];?></b></a>
                                                                </div>
                                                                <div class="lesson_duration">
                                                                    <i class="fa fa-play-circle"></i>    <b>  <?php echo $ss['duration'];?></b>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php else: ?>
                                                        <tr style="width: 100%; padding: 5px 0px;background-color: #E6F2F5;">
                                                            <td style="text-align: left; padding:7px 10px;">
                                                                <div class="form-group">
                                                                    <a href="<?php echo base_url();?>teacher/view_lesson/archive/<?php echo $online_course_id;?>/<?php echo $ss['lesson_online_id'];?>" id="1" style="font-size: 14px;font-weight: 400;">
                                                                    <?php echo $n2++; ?>: <b><?php echo $ss['name'];?></b></a>
                                                                </div>
                                                                <div>
                                                                    <i class="picons-thin-icon-thin-0042_attachment"></i>    <b>  <?php echo $ss['type'];?></b>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    <?php foreach($quizz as $qq):?>
                                                    <tr style="width: 100%; padding: 5px 0px;background-color: #E6F2F5;">
                                                        <td style="text-align: left; padding:7px 10px;">
                                                            <div class="form-group">
                                                                <a href="<?php echo base_url();?>teacher/quiz_contest/<?php echo $online_course_id;?>/<?php echo $qq['quiz_id'];?>" id="1" <?php if($qq['quiz_id'] == $quiz_id):?>style="color:red; font-size: 20px;font-weight: 500;" <?php else: ?> style="font-size: 14px;font-weight: 400;" <?php endif;?>>
                                                                <?php echo $n2++; ?>: <b><?php echo $qq['title'];?></b></a>
                                                            </div>
                                                            <div>
                                                                <i class="picons-thin-icon-thin-0061_error_warning_alert_attention"></i>    <b>  <?php echo $qq['instruction'];?></b>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><br><br>
                                    <?php endforeach; ?>
                                    <?php else:?>
                                    <div class="card" style="margin:0px 0px;">
                                        <div class="card-header course_card">
                                            <a href="<?php echo base_url();?>teacher/lessons/<?php echo $online_course_id;?>" ><h5 class="text-center">
                                            <?php echo getEduAppGTLang('Create_sections_here');?>
                                            </h5></a>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
             <br><br>
            </div>
        </div>
    </div>
<?php endforeach;?>




<script>
    $(document).ready(function () {
        $(".pagination").rPage();
    });
</script>
<script type="text/javascript">
  $('#pagination-demo').twbsPagination({
    totalPages: <?php echo $questions_number;?>,
    startPage: 1,
    visiblePages: 5,
    initiateStartPageClick: true,
    href: false,
    hrefVariable: '{{number}}',
    first: 'First',
    prev: 'Previous',
    next: 'Next',
    last: 'Last',
    loop: false,
    onPageClick: function (event, page) {
      $('.page-active').removeClass('page-active');
      $('#page'+page).addClass('page-active');
    },
    paginationClass: 'pagination',
    nextClass: 'next',
    prevClass: 'prev',
    lastClass: 'last',
    firstClass: 'first',
    pageClass: 'pages',
    activeClass: 'active sactive',
    disabledClass: 'disabled'
});
</script>


<style type="text/css">
.col-aligncenter{float: none;margin: 0 auto;}
.blink_text {
-webkit-animation-name: blinker;
 -webkit-animation-duration: 1s;
 -webkit-animation-timing-function: linear;
 -webkit-animation-iteration-count: infinite;
 -moz-animation-name: blinker;
 -moz-animation-duration: 1s;
 -moz-animation-timing-function: linear;
 -moz-animation-iteration-count: infinite;
 animation-name: blinker;
 animation-duration: 1s;
 animation-timing-function: linear;
    animation-iteration-count: infinite;
}

@-moz-keyframes blinker {
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@-webkit-keyframes blinker {
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}

@keyframes blinker {
    0% { opacity: 1.0; }
    50% { opacity: 0.0; }
    100% { opacity: 1.0; }
}
</style>
<style media="screen">
  .containers {
    display: block;
    position: relative;
    padding-left: 35px;
    margin-bottom: 12px;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
  }
  .containers input {
    position: absolute;
    opacity: 0;
    cursor: pointer;
    height: 0;
    width: 0;
  }
  .checkmark {
    position: absolute;
    top: 0; 
    left: 0;
    height: 20px;
    width: 23px;
    background-color: #eee;
  }
  .containers:hover input ~ .checkmark {
    background-color: #ccc;
  }
  .containers input:checked ~ .checkmark {
    background-color: #2196F3;
  }
  .checkmark:after {
    content: "";
    position: absolute;
    display: none;
  }
  .containers input:checked ~ .checkmark:after {
    display: block;
  }
  .containers .checkmark:after {
    left: 9px;
    top: 5px;
    width: 5px;
    height: 10px;
    border: solid white;
    border-width: 0 3px 3px 0;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
  }
</style>
