<?php 
    $student_data = $this->db->get_where('enroll', array('student_id' => $param2))->result_array();
    foreach($student_data as $row):    
?>
<link href="<?php echo base_url();?>public/uploads/card.css" rel="stylesheet"/>
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="id-card-hook"></div>
        <div class="id-card-holder holder" id="id-card-holder">
          <div class="id-card">
            <div class="text-center">
              <img src="<?php echo base_url();?>public/uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description;?>" class="stitle">
            </div>
            <div class="school_title title"><?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;?></div>
            <div class="photo text-center">
              <img src="<?php echo $this->crud->get_image_url('student', $row['student_id']);?>" class="roudend-circle">
            </div>
            <h2 class="title_s"><?php echo $this->crud->get_name('student', $row['student_id']);?></h2>
            <div class="text-center">
              <table class="card-table">
                <tbody>
                  <tr>
                    <td class="text-right w-50"><?php echo getEduAppGTLang('roll');?> : </td>
                    <td class="text-left"><?php echo $row['roll'];?></td>
                  </tr>
                  <tr>
                    <td class="text-right"><?php echo getEduAppGTLang('class');?> : </td>
                    <td class="text-left "><?php echo $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;?></td>
                  </tr>
                  <tr>
                    <td class="text-right"><?php echo getEduAppGTLang('section');?> : </td>
                    <td class="text-left"><?php echo $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name;?></td>
                  </tr>
                  <tr>
                    <td class="text-right"><?php echo getEduAppGTLang('parent');?> : </td>
                    <td class="text-left"><?php echo $this->crud->get_name('parent',$this->db->get_where('student', array('student_id' => $row['student_id']))->row()->parent_id);?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <hr>
            <p class="ptext"><?php echo getEduAppGTLang('verification_code');?></p>
            <p><img src="<?php echo $this->crud->getStudentQR($row['student_id']);?>" width="90px"></p>
            <p class="ptext"><strong><?php echo getEduAppGTLang('generated_in');?> <?php echo base_url();?></strong></p>
            </div>
          </div>
          <div class="d-print-none mt-4">
            <div class="text-center">
              <a href="javascript:window.print()" class="btn btn-primary d-print-none"><i class="mdi mdi-printer"></i> <?php echo getEduAppGTLang('print');?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach;?>
<script>
    function printDiv(nombreDiv) 
 {
     var contenido= document.getElementById(nombreDiv).innerHTML;
     var contenidoOriginal= document.body.innerHTML;
     document.body.innerHTML = contenido;
     window.print();
     document.body.innerHTML = contenidoOriginal;
}
</script>