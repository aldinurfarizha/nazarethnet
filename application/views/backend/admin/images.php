<div class="content-w">
    <?php include 'fancy.php';?>
    <div class="header-spacer"></div>
    <div class="conty">
        <div class="os-tabs-w menu-shad">
            <div class="os-tabs-controls">
                <ul class="navs navs-tabs upper">
                    <li class="navs-item">
                        <a class="navs-links" href="<?php echo base_url();?>admin/system_settings/"><i class="os-icon picons-thin-icon-thin-0050_settings_panel_equalizer_preferences"></i><span><?php echo getEduAppGTLang('system_settings');?></span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links" href="<?php echo base_url();?>admin/sms/"><i class="os-icon picons-thin-icon-thin-0287_mobile_message_sms"></i><span><?php echo getEduAppGTLang('sms');?></span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links" href="<?php echo base_url();?>admin/email/"><i class="os-icon picons-thin-icon-thin-0315_email_mail_post_send"></i><span><?php echo getEduAppGTLang('email_settings');?></span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links" href="<?php echo base_url();?>admin/translate/"><i class="os-icon picons-thin-icon-thin-0307_chat_discussion_yes_no_pro_contra_conversation"></i><span><?php echo getEduAppGTLang('translate');?></span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links" href="<?php echo base_url();?>admin/database/"><i class="picons-thin-icon-thin-0356_database"></i><span><?php echo getEduAppGTLang('database');?></span></a>
                    </li>
                    <li class="navs-item">
                        <a class="navs-links active" href="<?php echo base_url();?>admin/frontend/"><i class="picons-thin-icon-thin-0180_www_website_address_url_browser"></i><span><?php echo getEduAppGTLang('frontend');?></span></a>
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
                                <div class="os-tabs-w">
                                    <div class="os-tabs-controls">
                                        <ul class="navs navs-tabs upper">
                                            <li class="navs-item">
                                                <a class="navs-links" href="<?php echo base_url();?>admin/frontend/"><?php echo getEduAppGTLang('frontend');?></a>
                                            </li>
                                            <li class="navs-item">
                                                <a class="navs-links" href="<?php echo base_url();?>admin/about/"><?php echo getEduAppGTLang('about_us');?></a>
                                            </li> 
                                            <li class="navs-item">
                                                <a class="navs-links active" href="<?php echo base_url();?>admin/gallery/"><?php echo getEduAppGTLang('gallery');?></a>
                                            </li>   
                                            <li class="navs-item">
                                                <a class="navs-links" href="<?php echo base_url();?>admin/recaptcha/"><?php echo getEduAppGTLang('recaptcha');?></a>
                                            </li> 
                                            <li class="navs-item">
                                                <a class="navs-links" href="<?php echo base_url();?>admin/footer/"><?php echo getEduAppGTLang('footer');?></a>
                                            </li>   
                                        </ul>
                                    </div>
                                </div>
                                <div class="element-box">
                                    <a href="<?php echo base_url();?>admin/gallery/" class="btn btn-purple btn-rounded"><i class="picons-thin-icon-thin-0124_upload_cloud_file_sync_backup"></i> <?php echo getEduAppGTLang('upload');?></a>
                                    <a href="<?php echo base_url();?>admin/images/" class="btn btn-success btn-rounded"><i class="picons-thin-icon-thin-0618_album_picture_image_photo"></i> <?php echo getEduAppGTLang('uploaded_images');?></a>
                                    <hr>
                                        <div class="ae-content-w">
                                          <div class="message-head">
                                            <div class="user-w with-status status-green">
                                                <div class="user-name">
                                                    <h6 class="user-title"><?php echo getEduAppGTLang('gallery');?></h6>
                                                    <div class="user-role"><?php echo getEduAppGTLang('uploaded_images');?></div>
                                                  </div>
                                                </div>
                                              </div>
                                              <div class="message -content">
                                                <div class="table-responsive">
                                                  <table width="100%" class="table table-striped table-lightfont">
                                                    <thead>
                                                      <tr>
                                                        <th class="text-center"><?php echo getEduAppGTLang('id');?></th>
                                                        <th class="text-center"><?php echo getEduAppGTLang('image');?></th>
                                                        <th class="text-center"><?php echo getEduAppGTLang('date');?></th>
                                                        <th class="text-center"><?php echo getEduAppGTLang('actions');?></th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      <?php
                                                        $i = 1;
                                                        $this->db->order_by('gallery_id', 'desc');
                                                        $files = $this->db->get('gallery')->result_array();
                                                        foreach($files as $file):
                                                      ?>
                                                      <tr>
                                                        <td class="text-center"><?php echo $i++;?></td>
                                                        <td class="text-center"><img src="<?php echo base_url();?>public/uploads/gallery/<?php echo $file['name'];?>" width="80px"></td>
                                                        <td class="text-center"><?php echo $file['date'];?></td>
                                                        <td class="text-center">
                                                          <a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/images/delete/<?php echo $file['gallery_id'];?>"><i class="picons-thin-icon-thin-0057_bin_trash_recycle_delete_garbage_full" style="font-size:15px;color:black"></i></a>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="display-type"></div>
        </div>
    </div>
</div>