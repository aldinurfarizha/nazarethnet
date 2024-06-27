<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<?php
    $online_exam_details = $this->db->get_where('quiz', array('quiz_id' => $quiz_id))->row_array();
    $online_course_details = $this->db->get_where('online_course', array('online_course_id' => $online_course_id))->row_array();
    $students_array = $this->db->get_where('enroll', array('class_id' => $online_course_details['class_id'], 'section_id' => $online_course_details['section_id'], 'year' => $online_course_details['year']))->result_array();
    $subject_info = $this->academic->get_subject_info($online_exam_details['subject_id']);
    $total_mark = $this->academic->get_total_mark($quiz_id);

?>
<div class="content-w">
          <div class="conty">
  <?php include 'fancy.php';?>
  <div class="header-spacer"></div>
   
   
  <div class="content-i">
    <div class="content-box">
        
  <div class="row">
  
  <div class="col-sm-12">
    <div class="pipeline white lined-primary">
    <div class="back hidden-sm-down" style="margin-top:-20px;margin-bottom:10px">		
        <a title="back" href="<?php echo base_url();?>teacher/lessons/<?php echo $online_course_id?>"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>	
	</div>
      <div class="pipeline-header">
      <h5 class="pipeline-name">
        <?php echo getEduAppGTLang('results_for');?> <?php echo $online_exam_details['title']; ?>
      </h5>
      </div>
      
      <div class="table-responsive">
            <table class="table table-lightborder">
              <thead>
                <tr>
                    <th><?php echo getEduAppGTLang('student');?></th>
                    <th><?php echo getEduAppGTLang('result');?></th>
                    <th><?php echo getEduAppGTLang('answers');?></th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($students_array as $row):?>
                    <tr>
                      <td><?php $student_details = $this->academic->get_student_info_by_id($row['student_id']); echo $student_details['first_name']." ".$student_details['last_name']; ?></td>
                      <td><?php $query = $this->db->get_where('online_quiz_result', array('quiz_id' => $quiz_id, 'student_id' => $row['student_id']));
                                if ($query->num_rows() > 0){
                                    $query_result = $query->row_array();
                                    echo $query_result['obtained_mark'].'/'.$query_result['result'];
                                }
                                else {
                                    echo 0;
                        }?>
                      </td>
                    
                      <td><?php  if ($query->num_rows() > 0){?><a href="<?php echo base_url();?>teacher/online_quiz_result/<?php echo $quiz_id;?>/<?php echo $online_course_id;?>/<?php echo $row['student_id'];?>/" class="btn btn-success btn-sm btn-rounded"><?php echo getEduAppGTLang('view_results');?></a><?php } else echo getEduAppGTLang('no_actions');?></td>
                    </tr>
            <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>