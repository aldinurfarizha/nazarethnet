   <style>
     .custom-modal-responsive {
            width: 90%;
            max-width: 90%;
        }

        @media (min-width: 768px) {
            .custom-modal-responsive {
                width: 50%;
                max-width: 50%;
            }
        }
   </style>
   <div class="content-w">
        <?php include 'fancy.php'; ?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/system_settings/"><i class="os-icon picons-thin-icon-thin-0050_settings_panel_equalizer_preferences"></i><span><?php echo getEduAppGTLang('system_settings'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/sms/"><i class="os-icon picons-thin-icon-thin-0287_mobile_message_sms"></i><span><?php echo getEduAppGTLang('sms'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/email/"><i class="os-icon picons-thin-icon-thin-0315_email_mail_post_send"></i><span><?php echo getEduAppGTLang('email_settings'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/translate/"><i class="os-icon picons-thin-icon-thin-0307_chat_discussion_yes_no_pro_contra_conversation"></i><span><?php echo getEduAppGTLang('translate'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/database/"><i class="picons-thin-icon-thin-0356_database"></i><span><?php echo getEduAppGTLang('database'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/frontend/"><i class="picons-thin-icon-thin-0180_www_website_address_url_browser"></i><span><?php echo getEduAppGTLang('frontend'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/drive/"><i class="picons-thin-icon-thin-0119_folder_open_full_documents"></i><span><?php echo getEduAppGTLang('google_drive'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url(); ?>admin/certificate/"><i class="picons-thin-icon-thin-0656_medal_award_rating_prize_achievement"></i><span><?php echo getEduAppGTLang('certificates'); ?></span></a>
                        </li>
                    </ul>
                </div>
            </div><br>
            <div class="all-wrapper no-padding-content solid-bg-all">
                <div class="layout-w">
                    <div class="content-w">
                        <div class="content-i">
                            <div class="content-box">
                                <div class="col-sm-12">
                                    <div class="element-box lined-success shadow rad10">
                                        <div class="row justify-content-between  m-3">
                                        <h5 class="form-header"><?php echo getEduAppGTLang('certificate_setting_list'); ?></h5>
                                            <div class="text-right">
                                                <a class="btn btn-success" href="<?= base_url('certificate/create_new') ?>" target="_blank">
                                                    <i class="fa fa-plus"></i> <?php echo getEduAppGTLang('create_new'); ?></a>
                                            </div>
                                        </div>
                                        
                                            <div class="table-responsive">
                                <table id="certificateTable" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th><?php echo getEduAppGTLang('no'); ?></th>
                                            <th><?php echo getEduAppGTLang('name'); ?></th>
                                            <th><?php echo getEduAppGTLang('background'); ?></th>
                                            <th><?php echo getEduAppGTLang('papper_size'); ?></th>
                                            <th><?php echo getEduAppGTLang('default'); ?></th>
                                            <th><?php echo getEduAppGTLang('course'); ?></th>
                                            <th class="text-center"><?php echo getEduAppGTLang('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $certificate = $this->db->query('SELECT * FROM certificate_settings')->result_array();
                                    $no=1;
                                    foreach ($certificate as $row):
                                        $id=$row['id'];
                                        $subject=$this->db->query("SELECT * FROM subject where certificate_setting=$id")->result();
                                        $course='';
                                        foreach($subject as $sub){
                                            $class=getClassNameById($sub->class_id);
                                            $section=getSectionNameById($sub->section_id);
                                            $subjectName=getSubjectNameById($sub->subject_id);
                                            $course .= '<a href="#" class="badge badge-primary mr-1">'
                                                        . $class . ' - ' . $section . ' - ' . $subjectName
                                                        . '</a> ';
                                        }
                                    ?>
                                        <tr>
                                            <td><?= $no; ?></td>
                                            <td><?= $row['name']; ?></td>
                                            <td><img src="<?php echo base_url('public/certificates/' . $row['background']); ?>"
                                                            alt="Certificate"
                                                            class="img-fluid text-center"
                                                            style="width: 100px; object-fit: cover;"></td>
                                            <td><?= $row['height'].'(H) X '.$row['width'].'(W)'; ?></td>                                            
                                            <td>
                                                <?php if ($row['is_default'] == 1): ?>
                                                    <span class="badge badge-success"><?php echo getEduAppGTLang('yes'); ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-secondary"><?php echo getEduAppGTLang('no'); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $course; ?></td>
                                            <td class="row-actions">
                                                <div class="more">
																									<i class="icon-options"></i>
																									<ul class="more-dropdown">
																										<li><a href="<?=base_url('admin/edit_certificate_settings/'.$row['id'].'');?>"><?php echo getEduAppGTLang('edit'); ?></a></li>
																										<li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/delete_certificate_setting/<?php echo $row['id']; ?>"><?php echo getEduAppGTLang('delete'); ?></a></li>
																										<?php if($row['is_default'] == 0): ?>
                                                                                                            <li><a href="<?=base_url('admin/change_default_certificate_settings/'.$row['id'].'');?>"><?=getEduAppGTLang('make_default'); ?></a></li>
                                                                                                        <?php endif; ?>
																									</ul>
																								</div>
                                            </td>
                                        </tr>
                                    <?php $no++; endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="display-type"></div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('#certificateTable').DataTable();
    });
</script>