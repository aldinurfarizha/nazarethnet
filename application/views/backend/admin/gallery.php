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
                    <li class="navs-item">
                        <a class="navs-links" href="<?php echo base_url();?>admin/drive/"><i class="picons-thin-icon-thin-0119_folder_open_full_documents"></i><span><?php echo getEduAppGTLang('google_drive');?></span></a>
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
                                      <div class="aec-full-message-w">
                                          <div class="aec-full-message">
                                                <h6 class="user-title"><?php echo getEduAppGTLang('upload_your_images');?></h6>
                                              <div class="text-center">
                                                  <div id="dropzone" class="bdrp">
                                                      <form action="<?php echo base_url();?>images/upload" class="dropzone no-brd" id="dropzonewidget">
                                                          <div class="dz-message needsclick mh" id="dropzonePreview">
                                                              <p><img src="<?php echo base_url();?>public/uploads/drop.svg" class="wp"></p>
                                                              <h3><?php echo getEduAppGTLang('drag_your_images_here');?>.<br></h3>
                                                              <span class="note needsclick">(<?php echo getEduAppGTLang('upload_to_your_gallery');?>).</span>
                                                          </div>
                                                      </form>
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
            </div>
            <div class="display-type"></div>
        </div>
    </div>
</div>

<script>
    "use strict";
    Dropzone.options.dropzonewidget = 
    {
        acceptedFiles: 'image/*',
    };   
</script>