<div class="presentation pd-bottom">
        <div class="row container-fluid">
            <div class="col-sm-12">
                <div class="feature__header d-flex justify-content-center align-items-center col-lg-8 mx-auto">
                    <br><br><br>
                    <h2><?php echo getEduAppGTLang('get_in_touch');?></h2>
                    <p><?php echo getEduAppGTLang('please_fill_all_fileds_in_the_form_for_contact_us');?>
                    </p>
                </div>
            </div>
            <div class="presentation__content col-12 col-md-6 pd-top">
            <div class="title-2"><?php echo $this->crud->getInfo('system_name');?> - <?php echo $this->crud->getInfo('system_title');?></div>
                <header class="presentation__content-header">
                <?php echo getEduAppGTLang('contact_information');?>
                </header>
                <br><br>
                <ul>
                    <li class="ul-bottom"><i class="picons-thin-icon-thin-0133_arrow_right_next"></i> <b><?php echo getEduAppGTLang('phone');?>:</b> <?php echo $this->crud->getInfo('phone');?></li>
                    <li class="ul-bottom"><i class="picons-thin-icon-thin-0133_arrow_right_next"></i> <b><?php echo getEduAppGTLang('email');?></b>: <?php echo $this->crud->getInfo('system_email');?></li>
                    <li class="ul-bottom"><i class="picons-thin-icon-thin-0133_arrow_right_next"></i> <b><?php echo getEduAppGTLang('address');?>:</b> <?php echo $this->crud->getInfo('address');?></li>
                    <?php if($this->crud->getInfo('facebook') != ''):?>
                    <li class="ul-bottom"><i class="picons-thin-icon-thin-0133_arrow_right_next"></i> <b><?php echo getEduAppGTLang('facebook');?>:</b> <a target="_blank" href="<?php echo $this->crud->getInfo('facebook');?>"><?php echo $this->crud->getInfo('facebook');?></a></li>
                    <?php endif;?>
                    <?php if($this->crud->getInfo('twitter') != ''):?>
                    <li class="ul-bottom"><i class="picons-thin-icon-thin-0133_arrow_right_next"></i> <b><?php echo getEduAppGTLang('twitter');?>:</b> <a target="_blank" href="<?php echo $this->crud->getInfo('twitter');?>"><?php echo $this->crud->getInfo('twitter');?></a></li>
                    <?php endif;?>
                    <?php if($this->crud->getInfo('instagram') != ''):?>
                    <li class="ul-bottom"><i class="picons-thin-icon-thin-0133_arrow_right_next"></i> <b><?php echo getEduAppGTLang('instagram');?>:</b> <a target="_blank" href="<?php echo $this->crud->getInfo('instagram');?>"><?php echo $this->crud->getInfo('instagram');?></a></li>
                    <?php endif;?>
                    <?php if($this->crud->getInfo('youtube') != ''):?>
                    <li class="ul-bottom"><i class="picons-thin-icon-thin-0133_arrow_right_next"></i> <b><?php echo getEduAppGTLang('youtube');?>:</b> <a target="_blank" href="<?php echo $this->crud->getInfo('instagram');?>"><?php echo $this->crud->getInfo('youtube');?></a></li>
                    <?php endif;?>
                    <li class="ul-bottom"><i class="picons-thin-icon-thin-0133_arrow_right_next"></i> <b><?php echo getEduAppGTLang('website');?>:</b> <a href="<?php echo base_url();?>"><?php echo base_url();?></a></li>
                </ul>
            </div>
            <div class="col-12 col-md-6 p-0">
                <div class="col-lg-6 justify-content-center"><br><br>
                    <div class="row align-items-center container-fluid presentation__content">
                        <form class="contact-frm" action="<?php echo base_url();?>contact/submitForm" method="POST" name="contact_form">
                            <?php if($this->session->flashdata('message') != ''):?>
                            <div class="alert-success">
                            <?php echo getEduAppGTLang('email_sent_success');?>
                            </div>
                            <br>
                            <?php endif;?>
                            <?php if($this->session->flashdata('error') != ''):?>
                            <div class="alert-success">
                            <?php echo getEduAppGTLang('please_verify_recaptcha');?>
                            </div>
                            <br>
                            <?php endif;?>
                            <div class="InputField-fbCPUI fzNyHE">
                                <label class="Label-gGgCgx kICVHN Label-ghyrbC ToFbo"><?php echo getEduAppGTLang('your_name');?>:</label>
                                <span class="InputContainer-kcTEuW hCEYWP">
                                    <input class="Input-hYNycR iWatyC kclDLO" type="text" required="" name="name">
                                </span>
                            </div>
                            <div class="InputField-fbCPUI fzNyHE">
                                <label class="Label-gGgCgx kICVHN Label-ghyrbC ToFbo"><?php echo getEduAppGTLang('your_email');?>:</label>
                                <span class="InputContainer-kcTEuW hCEYWP">
                                    <input class="Input-hYNycR iWatyC kclDLO" type="email" required="" name="email">
                                </span>
                            </div>
                            <div class="InputField-fbCPUI fzNyHE">
                                <label class="Label-gGgCgx kICVHN Label-ghyrbC ToFbo"><?php echo getEduAppGTLang('your_phone');?>:</label>
                                <span class="InputContainer-kcTEuW hCEYWP">
                                    <input class="Input-hYNycR iWatyC kclDLO" type="number" required="" name="phone">
                                </span>
                            </div>
                            <div class="InputField-fbCPUI fzNyHE">
                                <label class="Label-gGgCgx kICVHN Label-ghyrbC ToFbo"><?php echo getEduAppGTLang('your_message');?>:</label>
                                <span class="InputContainer-kcTEuW hCEYWP">
                                    <textarea class="Input-hYNycR iWatyC Input-fXckBj area" rows="5" name="message" required=""></textarea>
                                </span>
                            </div>
                            <center><div class="g-recaptcha" data-sitekey="<?php echo $this->crud->getFront('site_key');?>" data-callback="capcha_filled"></div></center>
                            <div class="submit-container">
                                <span class="ButtonContainer-cCzDqJ keumEd Span-hCfPsm ehhEci Button-jiBmQ" color="primary">
                                    <button class="btn-submit" type="submit"><span class="Label-jdylQG kKagzz Span-hCfPsm ehhEci"><i class="send-btn picons-thin-icon-thin-0160_arrow_next_right"></i> <?php echo getEduAppGTLang('send');?></span></button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <br><br><br>
                <h3><?php echo getEduAppGTLang('find_us_on_the_map');?></h3><br>
                <iframe class="no-brd" src="<?php echo $this->crud->getFront('map_contact');?>" width="100%" height="550" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url();?>public/style/jquery.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js"></script>
	<script>
        'use strict';
        window.onload = function() 
        {
            var recaptcha = document.forms["contact_form"]["g-recaptcha-response"];
            recaptcha.required = true;
            recaptcha.oninvalid = function(e) {
                alert("<?php echo getEduAppGTLang('the_captcha_is_required');?>");
            }
        }
    </script>            