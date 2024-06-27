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
                                                    <a class="navs-links active" href="<?php echo base_url();?>admin/frontend/"><?php echo getEduAppGTLang('frontend');?></a>
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
                                                    <a class="navs-links" href="<?php echo base_url();?>admin/footer/"><?php echo getEduAppGTLang('footer');?></a>
                                                </li>   
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="element-box lined-primary shadow rad10">
                                        <?php echo form_open(base_url() . 'admin/frontend/home_widget', array('enctype' => 'multipart/form-data'));?>
                                            <h4 class="form-header"><?php echo getEduAppGTLang('home_widget');?></h4><br>
                                            <div class="row">   
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('home_title');?>" type="text" name="home_title" required="">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6"> 
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('subtitle');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('home_subtitle');?>" type="text" name="home_subtitle" required="">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('text_button_1');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('home_text_button_1');?>" type="text" name="home_text_button_1">
                                                        <small><?php echo getEduAppGTLang('if_left_blank_it_will_hide');?></small>
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('redirect_button_1');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('home_redirect_button_1');?>" type="text" name="home_redirect_button_1">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('text_button_2');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('home_text_button_2');?>" type="text" name="home_text_button_2">
                                                        <small><?php echo getEduAppGTLang('if_left_blank_it_will_hide');?></small>
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('redirect_button_2');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('home_redirect_button_2');?>" type="text" name="home_redirect_button_2">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo getEduAppGTLang('image');?></label>
                                                        <input class="form-control" type="file" name="home_image">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group text-center">
                                                        <img src="<?php echo base_url();?>public/uploads/frontend/<?php echo $this->crud->getFront('home_image');?>" width="300px">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="pull-right">
                                                        <button class="btn btn-primary btn-rounded pull-right" type="submit"> <?php echo getEduAppGTLang('update');?></button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php echo form_close();?>
                                    </div>
                                    <div class="element-box lined-purple shadow rad10">
                                        <?php echo form_open(base_url() . 'admin/frontend/why_us', array('enctype' => 'multipart/form-data'));?>
                                            <h4 class="form-header"><?php echo getEduAppGTLang('why_us_widget');?></h4><br>
                                            <div class="row">   
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('why_us_title');?>" type="text" name="why_us_title" required="">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('subtitle');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('why_us_subtitle');?>" type="text" name="why_us_subtitle" required="">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                                                                <input class="form-control" value="<?php echo $this->crud->getFront('why_us_card_1_title');?>" type="text" name="why_us_card_1_title" required="">
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('description');?></label>
                                                                <textarea class="form-control" name="why_us_card_1_description" required><?php echo $this->crud->getFront('why_us_card_1_description');?></textarea>
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                                                                <input class="form-control" value="<?php echo $this->crud->getFront('why_us_card_2_title');?>" type="text" name="why_us_card_2_title" required="">
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('description');?></label>
                                                                <textarea class="form-control" name="why_us_card_2_description" required><?php echo $this->crud->getFront('why_us_card_2_description');?></textarea>
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                                                                <input class="form-control" value="<?php echo $this->crud->getFront('why_us_card_3_title');?>" type="text" name="why_us_card_3_title" required="">
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group label-floating">
                                                                <label class="control-label"><?php echo getEduAppGTLang('description');?></label>
                                                                <textarea class="form-control" name="why_us_card_3_description" required><?php echo $this->crud->getFront('why_us_card_3_description');?></textarea>
                                                                <span class="material-input"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('bottom_title');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('why_us_bottom_title');?>" type="text" name="why_us_bottom_title" required="">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('bottom_subtitle');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('why_us_bottom_subtitle');?>" type="text" name="why_us_bottom_subtitle" required="">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="pull-right">
                                                        <button class="btn btn-success btn-rounded pull-right" type="submit"> <?php echo getEduAppGTLang('update');?></button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php echo form_close();?>
                                    </div>
                                    <div class="element-box lined-warning shadow rad10">
                                        <?php echo form_open(base_url() . 'admin/frontend/principal', array('enctype' => 'multipart/form-data'));?>
                                            <h4 class="form-header"><?php echo getEduAppGTLang('principal_widget');?></h4><br>
                                            <div class="row">   
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('intro_text');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('principal_intro');?>" type="text" name="principal_intro" required="">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('principal_title');?>" type="text" name="principal_title" required="">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('description');?></label>
                                                        <textarea class="form-control" name="principal_description" required=""><?php echo $this->crud->getFront('principal_description');?></textarea>
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('text_button');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('principal_text_button');?>" type="text" name="principal_text_button">
                                                        <small><?php echo getEduAppGTLang('if_left_blank_it_will_hide');?></small>
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('redirect_button');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('principal_redirect_button');?>" type="text" name="principal_redirect_button">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo getEduAppGTLang('image');?></label>
                                                        <input class="form-control" type="file" name="principal_image">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group text-center">
                                                        <img src="<?php echo base_url();?>public/uploads/frontend/<?php echo $this->crud->getFront('principal_image');?>" width="300px">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="pull-right">
                                                        <button class="btn btn-purple btn-rounded pull-right" type="submit"> <?php echo getEduAppGTLang('update');?></button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php echo form_close();?>
                                    </div>
                                    <div class="element-box lined-danger shadow rad10">
                                        <?php echo form_open(base_url() . 'admin/frontend/second', array('enctype' => 'multipart/form-data'));?>
                                            <h4 class="form-header"><?php echo getEduAppGTLang('second_widget');?></h4><br>
                                            <div class="row">   
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('intro_text');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('second_intro');?>" type="text" name="second_intro" required="">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('second_title');?>" type="text" name="second_title" required="">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('description');?></label>
                                                        <textarea class="form-control" name="second_description" required=""><?php echo $this->crud->getFront('second_description');?></textarea>
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('text_button');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('second_text_button');?>" type="text" name="second_text_button">
                                                        <small><?php echo getEduAppGTLang('if_left_blank_it_will_hide');?></small>
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label"><?php echo getEduAppGTLang('redirect_button');?></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('second_redirect_button');?>" type="text" name="second_redirect_button">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo getEduAppGTLang('image');?></label>
                                                        <input class="form-control" type="file" name="second_image">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group text-center">
                                                    <img src="<?php echo base_url();?>public/uploads/frontend/<?php echo $this->crud->getFront('second_image');?>" width="300px">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="pull-right">
                                                        <button class="btn btn-purple btn-rounded pull-right" type="submit"> <?php echo getEduAppGTLang('update');?></button>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php echo form_close();?>
                                    </div>
                                    <div class="element-box lined-success shadow rad10">
                                        <?php echo form_open(base_url() . 'admin/frontend/contact', array('enctype' => 'multipart/form-data'));?>
                                            <h4 class="form-header"><?php echo getEduAppGTLang('contact');?></h4><br>
                                            <div class="row">   
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="control-label"><?php echo getEduAppGTLang('map');?> <b>(<?php echo getEduAppGTLang('google_maps');?>)</b></label>
                                                        <input class="form-control" value="<?php echo $this->crud->getFront('map_contact');?>" type="text" name="map_contact" required="">
                                                        <span class="material-input"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="pull-right">
                                                        <button class="btn btn-info btn-rounded pull-right" type="submit"> <?php echo getEduAppGTLang('update');?></button>
                                                    </div>
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