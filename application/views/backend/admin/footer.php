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
                                                    <a class="navs-links" href="<?php echo base_url();?>admin/gallery/"><?php echo getEduAppGTLang('gallery');?></a>
                                                </li>   
                                                <li class="navs-item">
                                                    <a class="navs-links" href="<?php echo base_url();?>admin/recaptcha/"><?php echo getEduAppGTLang('recaptcha');?></a>
                                                </li> 
                                                <li class="navs-item">
                                                    <a class="navs-links active" href="<?php echo base_url();?>admin/footer/"><?php echo getEduAppGTLang('footer');?></a>
                                                </li>   
                                            </ul>
                                        </div>
                                    </div>
                                        <div class="element-box lined-success shadow rad10">
                                            <?php echo form_open(base_url() . 'admin/frontend/footer', array('enctype' => 'multipart/form-data'));?>
                                                <h4 class="form-header"><?php echo getEduAppGTLang('footer');?></h4><br>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="control-label"><?php echo getEduAppGTLang('footer_text');?></label>
                                                                <input class="form-control" value="<?php echo $this->crud->getFront('footer_text');?>" type="text" name="footer_text" required="">
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="control-label"><?php echo getEduAppGTLang('footer_logo_white');?></label>
                                                                <input class="form-control" type="file" name="footer_logo">
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group text-center"><br>
                                                                <img class="ft-logo" src="<?php echo base_url();?>public/uploads/frontend/<?php echo $this->crud->getFront('footer_logo');?>" width="180px">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <button class="btn btn-primary btn-rounded pull-right" type="submit"> <?php echo getEduAppGTLang('update');?></button>
                                                        </div>
                                                    <div>
                                                </div>
                                            </div>
                                        <?php echo form_close();?>
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