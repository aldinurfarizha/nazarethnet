<?php  $edit_data = $this->db->get_where('homework_files' , array('delivery_id' => $param2) )->result_array(); ?>    
    <div class="modal-body">
        <div class="modal-header mdl-header">
            <h6 class="title text-white"><?php echo getEduAppGTLang('files');?></h6>
        </div>
        <div class="ui-block-content">
            <div class="row">
                <div class="col-sm-12">
                     <?php $edit_datas	=	$this->db->get_where('deliveries' , array('homework_code' => $param3))->result_array();
	foreach ($edit_datas as $row2):
?>  
                    <?php if($row2['media_type'] == 1):?>
			            <hr>
                        <video width="100%" src="<?php echo base_url();?>public/uploads/homework_delivery/video/<?php echo $row2['delivery_code'];?>.mp4" controls type="video/mp4"></video>
                        <?php elseif($row2['media_type'] == 2):?>
                            <hr>
                            <audio controls type="video/mp3">
                                <source src="<?php echo base_url();?>public/uploads/homework_delivery/audio/<?php echo $row2['delivery_code'];?>.mp3" type="audio/mpeg">
                            </audio>
                        <?php endif;?>
                        <hr>
                         <?php endforeach;?>
                </div>
                <div class="col-sm-12">
                <div class="table-responsive">
                    <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td><?php echo getEduAppGTLang('student');?></td>
                                <td><?php echo getEduAppGTLang('date');?></td>
                                <td><?php echo getEduAppGTLang('file');?></td>
                                <td><?php echo getEduAppGTLang('actions');?></td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                            $count = 1;
                            foreach($edit_data as $row):
                            $mimeType = $row['mime'];
                        ?>
                            <?php $class_id = $this->db->get_where('enroll', array('student_id' => $row['student_id']))->row()->class_id;?>
                            <tr>
                                <td><?php echo $count++;?></td>
                                <td><?php echo $this->crud->get_name('student', $row['student_id']);?></td>
                                <td><?php echo $this->db->get_where('deliveries', array('id' => $row['delivery_id']))->row()->date;?></td>
                                <td><a href="<?php echo base_url();?>teacher/viewFile/<?php echo $row['file'];?>" target="_blank"><?php echo getEduAppGTLang('download');?></a></td>
                                <td>
                                    <?php if($mimeType == 'application/pdf'):?>
                                        <a href="<?php echo base_url();?>teacher/annotator/<?php echo $row['fhomework_file_id'];?>/<?php echo $row['homework_code'];?>/"><?php echo getEduAppGTLang('annotate');?></a>
                                        <?php if($row['edited'] == 1):?>
                                            - (<a target="_blank" href="<?php echo base_url();?>public/uploads/homework_delivery/edited/<?php echo $row['edited_file_name'];?>"><?php echo getEduAppGTLang('view_edited');?></a>)
                                        <?php endif;?>
                                    <?php else:?>
                                        --
                                    <?php endif;?>
                                </td>
                            </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>    
                </div>
                </div>
            </div>
        </div>
    </div>