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
                                                    <a class="navs-links active" href="<?php echo base_url();?>admin/about/"><?php echo getEduAppGTLang('about_us');?></a>
                                                </li> 
                                                <li class="navs-item">
                                                    <a class="navs-links" href="<?php echo base_url();?>admin/gallery/"><?php echo getEduAppGTLang('gallery');?></a>
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
                                        <div class="element-box lined-success shadow rad10">
                                            <?php echo form_open(base_url() . 'admin/frontend/about', array('enctype' => 'multipart/form-data'));?>
                                                <h4 class="form-header"><?php echo getEduAppGTLang('about_us');?></h4><br>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                                                                <input class="form-control" value="<?php echo $this->crud->getFront('about_title');?>" type="text" name="about_title" required="">
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6"> 
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('subtitle');?></label>
                                                                <input class="form-control" value="<?php echo $this->crud->getFront('about_subtitle');?>" type="text" name="about_subtitle" required="">
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('text_button');?></label>
                                                                <input class="form-control" value="<?php echo $this->crud->getFront('about_text_button');?>" type="text" name="about_text_button">
                                                                <small><?php echo getEduAppGTLang('if_left_blank_it_will_hide');?></small>
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('redirect_button');?></label>
                                                                <input class="form-control" value="<?php echo $this->crud->getFront('about_redirect_button');?>" type="text" name="about_redirect_button">
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="control-label"><?php echo getEduAppGTLang('image');?></label>
                                                                <input class="form-control" type="file" name="about_image">
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group text-center">
                                                            <img src="<?php echo base_url();?>public/uploads/frontend/<?php echo $this->crud->getFront('about_image');?>" width="300px">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('widget_title');?></label>
                                                                <input class="form-control" value="<?php echo $this->crud->getFront('widget_title');?>" type="text" name="about_why" required="">
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6"> 
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('widget_subtitle');?></label>
                                                                <input class="form-control" value="<?php echo $this->crud->getFront('widget_subtitle');?>" type="text" name="about_why_subtitle" required="">
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group label-floating">
                                                                        <label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                                                                        <input class="form-control" value="<?php echo $this->crud->getFront('about_mission');?>" type="text" name="about_mission" required="">
                                                                        <span class="material-input"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group label-floating">
                                                                        <label class="control-label"><?php echo getEduAppGTLang('description');?></label>
                                                                        <textarea class="form-control" name="about_mission_description"><?php echo $this->crud->getFront('about_mission_description');?></textarea>
                                                                        <span class="material-input"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group label-floating">
                                                                        <label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                                                                        <input class="form-control" value="<?php echo $this->crud->getFront('about_vission');?>" type="text" name="about_vission" required="">
                                                                        <span class="material-input"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="form-group label-floating">
                                                                        <label class="control-label"><?php echo getEduAppGTLang('description');?></label>
                                                                        <textarea class="form-control" name="about_vission_description" required=""><?php echo $this->crud->getFront('about_vission_description');?></textarea>
                                                                        <span class="material-input"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('bottom_title');?></label>
                                                                <input class="form-control" value="<?php echo $this->crud->getFront('about_bottom_title');?>" type="text" name="about_bottom_title" required="">
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('bottom_subtitle');?></label>
                                                                <input class="form-control" value="<?php echo $this->crud->getFront('about_bottom_subtitle');?>" type="text" name="about_bottom_subtitle" required="">
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('intro_text');?></label>
                                                                <input class="form-control" value="<?php echo $this->crud->getFront('about_intro_text');?>" type="text" name="about_intro_text" required="">
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                                                                <input class="form-control" value="<?php echo $this->crud->getFront('about_title_1');?>" type="text" name="about_title_1" required="">
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('description');?></label>
                                                                <textarea class="form-control" name="about_description_1"><?php echo $this->crud->getFront('about_description_1');?></textarea>
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('text_button');?></label>
                                                                <input class="form-control" value="<?php echo $this->crud->getFront('about_text_button');?>" type="text" name="about_text_button">
                                                                <small><?php echo getEduAppGTLang('if_left_blank_it_will_hide');?></small>
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('redirect_button');?></label>
                                                                <input class="form-control" value="<?php echo $this->crud->getFront('about_redirect_button');?>" type="text" name="about_redirect_button">
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <label class="control-label"><?php echo getEduAppGTLang('image');?></label>
                                                                <input class="form-control" type="file" name="about_image_widget">
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group text-center">
                                                                <img src="<?php echo base_url();?>public/uploads/frontend/<?php echo $this->crud->getFront('about_image_widget');?>" width="300px">
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