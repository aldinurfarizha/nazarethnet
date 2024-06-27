<script src="<?php echo base_url();?>style/js/jquery.twbsPagination.js"></script>
 <style>
  .page 
  {
    display: none;
  }
  
  .sactive a 
  {
   background:#0084ff;
   color:#fff;
  }
  .page-active {
    display: block;
  }
 </style>

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
                    <div class="col-lg-12 course_col order-md-1">
                    <?php
                        $online_exam_info = $this->db->get_where('quiz', array('quiz_id' => $quiz_id))->row();
                            $submitted_answer_script_details = $this->db->get_where('online_quiz_result', array('quiz_id' => $quiz_id, 'student_id' => $student_id))->row_array();
                               $questions = $this->db->get_where('quiz_bank', array('quiz_id' => $quiz_id))->result_array();
                                $answers = "answers";
                                $total_marks = 0;
                             
                                $submitted_answer_script = json_decode($submitted_answer_script_details['answer_script'], true);
                                foreach ($questions as $question)
                                    $total_marks += $question['mark'];?>
                                    <div style="text-align: center;">
                                        <h3><?php echo getEduAppGTLang('results');?>: <b><?php echo $online_exam_info->title;?></b></h3> of <?php echo $this->crud_model->get_name('student', $student_id); ?><br>
                                    </div>
                                     <div class="back hidden-sm-down" style="margin-top:-20px;margin-bottom:10px">    
                                            <a title="back" href="<?php echo base_url();?>teacher/quiz_response/<?php echo $online_course_id ?>/<?php echo $quiz_id?>/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>  
                                      </div>
                                        <?php
                                            $count = 1; foreach ($submitted_answer_script as $row2):
                                          
                                            $question_title = $this->db->get_where('quiz_bank' , array('quiz_bank_id' => $row2['quiz_bank_id']))->row()->question_title;
                                            $mark = $this->db->get_where('quiz_bank' , array('quiz_bank_id' => $row2['quiz_bank_id']))->row()->mark;
                                            $submitted_answer = "";
                                        ?>
                                          <element class="col-sm-6 col-aligncenter">
                                            <div class="pipeline white lined-danger">            
                                              <div class="pipeline-header">
                                                <h5>
                                                  <b><?php echo $count++;?>. <?php echo  $question_title;?></b>
                                                </h5>
                                                <span><?php echo getEduAppGTLang('mark');?>: <?php echo $mark;?></span>
                                              </div>
                                              <?php 
                                                $options_json = $this->db->get_where('quiz_bank' , array('quiz_bank_id' => $row2['quiz_bank_id']))->row()->options; 
                                                $number_of_options = $this->db->get_where('quiz_bank' , array('quiz_bank_id' => $row2['quiz_bank_id']))->row()->number_of_options; 
                                                if($options_json != '' || $options_json != null)
                                                  $options = json_decode($options_json);
                                                else $options = array();
                                              ?>
                                                <ul>
                                                  <?php for ($i = 0; $i < $number_of_options; $i++): ?>
                                                    <li><?php echo $options[$i];?></li>
                                                  <?php endfor; ?>
                                                </ul>
                                                <?php
                                                  if ($row2['submitted_answer'] != "" || $row2['submitted_answer'] != null) 
                                                  {
                                                    $submitted_answer = json_decode($row2['submitted_answer']);
                                                    $r = '';
                                                    for ($i = 0; $i < count($submitted_answer); $i++) 
                                                    {
                                                      $x = $submitted_answer[$i];
                                                      $r .= $options[$x-1].',';
                                                    }
                                                  } else {
                                                    $submitted_answer = array();
                                                    $r = getEduAppGTLang('no_reply');
                                                  }
                                                ?>
                                                <i><strong>[<?php echo getEduAppGTLang('answer');?> - <?php echo rtrim(trim($r), ',');?>]</strong></i>
                                                <br>
                                                <?php
                                                  if ($row2['correct_answers'] != "" || $row2['correct_answers'] != null) {
                                                  $correct_options = json_decode($row2['correct_answers']);
                                                  $r = '';
                                                  for ($i = 0; $i < count($correct_options); $i++) {
                                                    $x = $correct_options[$i];
                                                    $r .= $options[$x-1].',';
                                                  }
                                                } else {
                                                  $correct_options = array();
                                                  $r = getEduAppGTLang('none_of_them.');
                                                }
                                              ?>
                                                <i><strong>[<?php echo getEduAppGTLang('correct_answer');?> - <?php echo rtrim(trim($r), ',');?>]</strong></i>
                                    
                                            </div>
                                          </element>
                                    <?php endforeach;?>
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
