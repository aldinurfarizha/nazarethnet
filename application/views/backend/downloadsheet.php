<!doctype html>
<html>
    <header>
    </header>
    <body>
    <?php 
        $data = $this->db->get_where('student', array('student_id' => $student_id))->result_array();
        foreach($data as $row):
    ?>
        <div class="dl1">
    	    <table cellpadding="0" cellspacing="0" class="dl2">
                <tr>
                    <td colspan="2">
                        <table class="dl3">
                            <tr>
                                <td class="dl4">
                                    <img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" alt="EduAppGT" class="dl5">
                                </td>
                                <td class="dl6"></td>
                                <td class="dl7">
                                    <p class="dl8"><b><?php echo $this->crud->getInfo('system_name');?></b></p>
                                    <p class="dl9"><?php echo $this->crud->getInfo('address');?></b></p>
                                    <p class="dl9"><?php echo $this->crud->getInfo('phone');?></p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr></tr>
		    </table>
            <table cellpadding="0" cellspacing="0" class="dl2">
                <tr>
                    <td class="dl10">
                        <b class="dl11"><?php echo getEduAppGTLang('enroll');?></b><br>
                        <?php echo $this->db->get_where('enroll', array('student_id' => $student_id))->row()->roll;?>
                    </td>
                    <td class="dl12">
                        <b class="dl11"><?php echo getEduAppGTLang('first_name');?></b><br>
                        <?php echo $row['first_name'];?>
                    </td>
                    <td class="dl12">
                        <b class="dl11"><?php echo getEduAppGTLang('last_name');?></b><br>
                        <?php echo $row['last_name'];?>
                    </td>
                    <td class="dl12">
                        <b class="dl11"><?php echo getEduAppGTLang('gender');?></b><br>
                        <?php if($row['sex'] == 'M') echo getEduAppGTLang('male'); else echo getEduAppGTLang('female');?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="dl12">
                        <b class="dl11"><?php echo getEduAppGTLang('address');?></b><br>
                        <?php echo $row['address'];?>
                    </td>
                    <td class="dl12">
                        <b class="dl11"><?php echo getEduAppGTLang('phone');?></b><br>
                        <?php echo $row['phone'];?>
                    </td>
                </tr>
                <tr>
                    <td class="dl12">
                        <b class="dl11"><?php echo getEduAppGTLang('date_of_birth');?></b><br>
                        <?php echo $row['birthday'];?>
                    </td>
                    <td class="dl12">
                        <b class="dl11"><?php echo getEduAppGTLang('email');?></b><br>
                        <?php echo $row['email'];?>
                    </td>
                    <td class="dl12">
                        <b class="dl11"><?php echo getEduAppGTLang('username');?></b><br>
                        <?php echo $row['username'];?>
                    </td>
                    <td class="dl12">
                        <b class="dl11"><?php echo getEduAppGTLang('password');?></b><br>
                        <?php echo base64_decode($pw);?>
                    </td>
                </tr>
                <?php $class_id   = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->class_id;?>
                <?php $section_id = $this->db->get_where('enroll', array('student_id' => $student_id))->row()->section_id;?>
                <tr>
                    <td colspan="2" class="dl12">
                        <b class="dl11"><?php echo getEduAppGTLang('parent');?></b><br>
                        <?php echo $this->crud->get_name('parent', $row['parent_id']);?>
                    </td>
                    <td class="dl12">
                        <b class="dl11"><?php echo getEduAppGTLang('class');?></b><br>
                        <?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name;?>
                    </td>
                    <td class="dl12">
                        <b class="dl11"><?php echo getEduAppGTLang('section');?></b><br>
                        <?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name;?>
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0" class="dl14">
                <tr>
                    <th class="dl13" colspan="3"><?php echo getEduAppGTLang('assigned_subjects');?></th>
                </tr>
                <tr>
                    <th class="dl13">#</th>
                    <th class="dl13"><?php echo getEduAppGTLang('subject');?></th>
                    <th class="dl13"><?php echo getEduAppGTLang('teacher');?></th>
                </tr>
                <?php 
                    $subjects = $this->db->get_where('subject', array('class_id' => $class_id, 'section_id' => $section_id))->result_array();
                    foreach($subjects as $sub):
                ?>
                <tr>
                    <td class="dl15">
                        <b class="dl11">1.</b>
                    </td>
                    <td class="dl15">
                        <?php echo $sub['name'];?>
                    </td>
                    <td class="dl15">
                        <?php echo $this->crud->get_name('teacher',$sub['teacher_id']);?>
                    </td>
                </tr>
            <?php endforeach;?>
            </table>
            <small class="dl16"><?php echo $this->db->get_where('academic_settings' , array('type' =>'terms'))->row()->description;?></small>
            <br>
            <table cellpadding="0" cellspacing="0" class="dl17">
                <tr>
                    <td class="dl18">
                        <center>____________________________________<br>
                        <?php echo getEduAppGTLang('parent');?>
                    </td>
                    <td colspan="1" class="dl19">
                    </td>
                    <td class="dl18">
                        ____________________________________<br><?php echo getEduAppGTLang('student');?>
                    </td>
                </tr>
            </table>
            <table cellpadding="0" cellspacing="0"  class="dl20">
                <tr>
                    <td colspan="2" class="dl21">
                        <table class="dl22">
                            <tr>
                                <td class="dl11">
                                    <b><?php echo getEduAppGTLang('address');?>:</b><br>
                                    <?php echo $this->crud->getInfo('address');?>
                                </td>
                                <td class="dl11">
                                    <b><?php echo getEduAppGTLang('phone');?>:</b><br>
                                    <?php echo $this->crud->getInfo('phone');?>
                                </td>
                                <td class="dl23">
    								<?php echo getEduAppGTLang('generated_by');?> <?php echo $this->crud->getInfo('system_name');?><br>
                                    <b><?php echo base_url();?></b>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
		    </table>
        </div> 
        <?php endforeach;?>
    </body>
</html>