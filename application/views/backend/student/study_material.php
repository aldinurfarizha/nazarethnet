<?php 
    $running_year = $this->crud->getInfo('running_year'); 
    $info = base64_decode($data);
    $ex = explode('-', $info);
    $sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
    foreach($sub as $rows):
        $finish=0;
        if(isStudentFinishSubject($this->session->userdata('login_user_id'), $ex[2])){
            $finish=1;
        }
?>
    <div class="content-w">
        <div class="conty">
        <?php $info = base64_decode($data);?>
        <?php $ids = explode("-",$info);?>
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
            <div class="cursos cta-with-media" style="background: #<?php echo $rows['color'];?>;">
                <div class="cta-content">
                    <div class="user-avatar">
                        <img alt="" src="<?php echo base_url();?>public/uploads/subject_icon/<?php echo $rows['icon'];?>" class="icon-wi">
                    </div>
                    <h3 class="cta-header"><?php echo $rows['name'];?> - <small><?php echo getEduAppGTLang('study_material');?></small></h3>
                    <small class="subject-desc"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name;?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name;?>"</small>
                </div>
            </div> 
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                    <?php if($finish){?>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url(); ?>student/study_material/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/subject_marks/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/attendance_report/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance'); ?></span></a>
                        </li>
                        <?php }else{?>
                            <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/subject_dashboard/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/online_exams/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/homework/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/forum/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo getEduAppGTLang('forum'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url(); ?>student/study_material/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/subject_marks/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/meet/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo getEduAppGTLang('live'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/attendance_report/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/whiteboards/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0191_window_application_cursor"></i><span><?php echo getEduAppGTLang('whiteboards'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/gamification/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0659_medal_first_place_winner_award_prize_achievement"></i><span><?php echo getEduAppGTLang('gamification'); ?></span></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="row">
                        <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                            <div id="newsfeed-items-grid">                
                                <div class="element-wrapper">
                                    <div class="element-box-tp">
                                        <h6 class="element-header"><?php echo getEduAppGTLang('study_material');?></h6>
                                        <div class="table-responsive">
                                            <table class="table table-padded">
                                                <tbody>
                                                <?php
        		                                    $this->db->order_by('timestamp', 'desc');
        		                                    $study_material_info = $this->db->get_where('document', array('class_id' => $ids[0], 'section_id' => $ids[1], 'subject_id' => $ids[2]))->result_array();
        		                                    foreach ($study_material_info as $row):
        	                                    ?>   
                                                    <tr>
                                                        <td><?php echo $row['description']?></td>
                                                        <td class="text-left cell-with-media ">
                                                            <a href="<?php echo base_url().'student/viewFile/'.$row['file_name']; ?>" class="grey">
                                                                <?php if($row['file_type'] == 'PDF'):?>
							                                    <i class="picons-thin-icon-thin-0077_document_file_pdf_adobe_acrobat px20 grey"></i>
						                                    <?php endif;?>
						                                    <?php if($row['file_type'] == 'Zip'):?>
							                                    <i class="picons-thin-icon-thin-0076_document_file_zip_archive_compressed_rar px20 grey"></i>
						                                    <?php endif;?>
						                                    <?php if($row['file_type'] == 'RAR'):?>
							                                    <i class="picons-thin-icon-thin-0076_document_file_zip_archive_compressed_rar px20 grey"></i>
						                                    <?php endif;?>
						                                    <?php if($row['file_type'] == 'Doc'):?>
							                                    <i class="picons-thin-icon-thin-0078_document_file_word_office_doc_text px20 grey"></i>
						                                    <?php endif;?>
						                                    <?php if($row['file_type'] == 'Image'):?>
							                                    <i class="picons-thin-icon-thin-0082_image_photo_file px20 grey"></i>
						                                    <?php endif;?>
						                                    <?php if($row['file_type'] == 'Other'):?>
    							                                <i class="picons-thin-icon-thin-0111_folder_files_documents px20 grey"></i>
						                                    <?php endif;?>
						                                        <span><?php echo $row['file_name'];?></span>
						                                        <span class="smaller">(<?php echo $row['filesize'];?>)</span>
						                                    </a>
                                                        </td>                     
                                                        <td class="text-center bolder">
                                                            <a href="<?php echo base_url().'student/viewFile/'.$row['file_name']; ?>" class="grey"> <span><i class="picons-thin-icon-thin-0121_download_file"></i></span> </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;?>