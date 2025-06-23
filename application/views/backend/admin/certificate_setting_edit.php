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
                                            <div class="text-right">
                                                <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#changeImageModal">
                                                    <i class="fa fa-sync"></i> <?=getEduAppGTLang('change_image')?>
                                                </button>
                                                <button class="btn btn-warning mt-3" data-toggle="modal" data-target="#adjustCertificate">
                                                    <i class="fa fa-edit"></i> <?=getEduAppGTLang('reference')?>
                                                </button>
                                                <a class="btn btn-success mt-3" href="<?= base_url('certificate/download/TESTING123/view') ?>" target="_blank">
                                                    <i class="fa fa-file-pdf"></i> <?php echo getEduAppGTLang('open_sample'); ?></a>
                                            </div>

                                        <?php 
                                        $certificateSettings=$this->db->where('id', '1')->get('certificate_settings')->row();
                                        echo form_open(base_url() . 'admin/certificate_setting');?>
                                        <div class="row mt-3">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="height"><?=getEduAppGTLang('paper_height')?></label>
                                                    <input type="text" class="form-control" name="height" value="<?=$certificateSettings->height?>" placeholder="mm">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="height"><?=getEduAppGTLang('paper_width')?></label>
                                                    <input type="text" class="form-control" name="width" value="<?=$certificateSettings->width?>" placeholder="mm">
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                    <div class="form-group is-select">
                                                        <label class="control-label"><?=getEduAppGTLang('font_face')?></label>
                                                        <div class="select">
                                                            <select name="title_font_face" required="">
                                                                <option <?= $certificateSettings->title_font_face == 'Arial' ? 'selected' : '' ?> value="Arial">Arial</option>
                                                                <option <?= $certificateSettings->title_font_face == 'Helvetica' ? 'selected' : '' ?> value="Helvetica">Helvetica</option>
                                                                <option <?= $certificateSettings->title_font_face == 'Verdana' ? 'selected' : '' ?> value="Verdana">Verdana</option>
                                                                <option <?= $certificateSettings->title_font_face == 'Tahoma' ? 'selected' : '' ?> value="Tahoma">Tahoma</option>
                                                                <option <?= $certificateSettings->title_font_face == 'Trebuchet MS' ? 'selected' : '' ?> value="Trebuchet MS">Trebuchet MS</option>
                                                                <option <?= $certificateSettings->title_font_face == 'Times New Roman' ? 'selected' : '' ?> value="Times New Roman">Times New Roman</option>
                                                                <option <?= $certificateSettings->title_font_face == 'Georgia' ? 'selected' : '' ?> value="Georgia">Georgia</option>
                                                                <option <?= $certificateSettings->title_font_face == 'Palatino Linotype' ? 'selected' : '' ?> value="Palatino Linotype">Palatino Linotype</option>
                                                                <option <?= $certificateSettings->title_font_face == 'Book Antiqua' ? 'selected' : '' ?> value="Book Antiqua">Book Antiqua</option>
                                                                <option <?= $certificateSettings->title_font_face == 'Courier New' ? 'selected' : '' ?> value="Courier New">Courier New</option>
                                                                <option <?= $certificateSettings->title_font_face == 'Lucida Console' ? 'selected' : '' ?> value="Lucida Console">Lucida Console</option>
                                                                <option <?= $certificateSettings->title_font_face == 'Lucida Sans Unicode' ? 'selected' : '' ?> value="Lucida Sans Unicode">Lucida Sans Unicode</option>
                                                                <option <?= $certificateSettings->title_font_face == 'Calibri' ? 'selected' : '' ?> value="Calibri">Calibri</option> <!-- Opsional, tidak selalu tersedia di Linux -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="height"><?=getEduAppGTLang('qr_code_barcode')?></label>
                                                    <input type="text" class="form-control" readonly value="<?php echo getEduAppGTLang('qr_image'); ?>" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">Size</label>
                                                    <input type="text" class="form-control" name="qr_size" placeholder="11" value="<?=$certificateSettings->qr_size?>">
                                                    <small><?=getEduAppGTLang('qr_image_size')?></small>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="x">x</label>
                                                    <input type="text" class="form-control" name="qr_x" placeholder="mm" value="<?=$certificateSettings->qr_x?>">
                                                    <small><?=getEduAppGTLang('x_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="y">y</label>
                                                    <input type="text" class="form-control" name="qr_y" placeholder="mm" value="<?=$certificateSettings->qr_y?>">
                                                    <small><?=getEduAppGTLang('y_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="status"><?=getEduAppGTLang('status')?></label>
                                                        <div class="togglebutton">
                                                        <label><input type="checkbox" name="qr_status" value="1" <?=$certificateSettings->qr_status == 1 ? 'checked' : ''?>></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="height"><?=getEduAppGTLang('certificate_code_text')?></label>
                                                    <input type="text" class="form-control" readonly value="<?php echo getEduAppGTLang('certificate_code_text'); ?>" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">Size</label>
                                                    <input type="text" class="form-control" name="certificate_code_text_size" placeholder="11" value="<?=$certificateSettings->certificate_code_text_size?>">
                                                    <small><?=getEduAppGTLang('text_size')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">x</label>
                                                    <input type="text" class="form-control" name="certificate_code_text_x" placeholder="mm" value="<?=$certificateSettings->certificate_code_text_x?>">
                                                    <small><?=getEduAppGTLang('x_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="y">y</label>
                                                    <input type="text" class="form-control" name="certificate_code_text_y" placeholder="mm" value="<?=$certificateSettings->certificate_code_text_y?>">
                                                    <small><?=getEduAppGTLang('y_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="text_color">Color</label><br>
                                                    <input type="color" id="text_color" name="certificate_code_text_color" value="<?=$certificateSettings->certificate_code_text_color?>" style="width: 100%; height: 38px; padding: 2px; border: 1px solid #ced4da; border-radius: 4px;">
                                                    <small class="form-text text-muted"><?= getEduAppGTLang('text_color') ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="status"><?=getEduAppGTLang('status')?></label>
                                                        <div class="togglebutton">
                                                        <label><input type="checkbox" name="certificate_code_text_status" value="1" <?=$certificateSettings->certificate_code_text_status == 1 ? 'checked' : ''?>></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="height"><?=getEduAppGTLang('certificate_issue_date_text')?></label>
                                                    <input type="text" class="form-control" readonly value="<?php echo getEduAppGTLang('certificate_issue_date_text'); ?>" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">Size</label>
                                                    <input type="text" class="form-control" name="certificate_issue_date_text_size" placeholder="11" value="<?=$certificateSettings->certificate_issue_date_text_size?>">
                                                    <small><?=getEduAppGTLang('text_size')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">x</label>
                                                    <input type="text" class="form-control" name="certificate_issue_date_text_x" placeholder="mm" value="<?=$certificateSettings->certificate_issue_date_text_x?>">
                                                    <small><?=getEduAppGTLang('x_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="y">y</label>
                                                    <input type="text" class="form-control" name="certificate_issue_date_text_y" placeholder="mm" value="<?=$certificateSettings->certificate_issue_date_text_y?>">
                                                    <small><?=getEduAppGTLang('y_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="text_color">Color</label><br>
                                                    <input type="color" id="text_color" name="certificate_issue_date_text_color" value="<?=$certificateSettings->certificate_issue_date_text_color?>" style="width: 100%; height: 38px; padding: 2px; border: 1px solid #ced4da; border-radius: 4px;">
                                                    <small class="form-text text-muted"><?= getEduAppGTLang('text_color') ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="status"><?=getEduAppGTLang('status')?></label>
                                                        <div class="togglebutton">
                                                        <label><input type="checkbox" name="certificate_issue_date_text_status" value="1" <?=$certificateSettings->certificate_issue_date_text_status == 1 ? 'checked' : ''?>></label>
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="col-md-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="height"><?=getEduAppGTLang('course_text')?></label>
                                                    <input type="text" class="form-control" readonly value="<?php echo getEduAppGTLang('course_text'); ?>" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">Size</label>
                                                    <input type="text" class="form-control" name="course_text_size" placeholder="11" value="<?=$certificateSettings->course_text_size?>">
                                                    <small><?=getEduAppGTLang('text_size')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">x</label>
                                                    <input type="text" class="form-control" name="course_text_x" placeholder="mm" value="<?=$certificateSettings->course_text_x?>">
                                                    <small><?=getEduAppGTLang('x_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="y">y</label>
                                                    <input type="text" class="form-control" name="course_text_y" placeholder="mm" value="<?=$certificateSettings->course_text_y?>">
                                                    <small><?=getEduAppGTLang('y_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="text_color">Color</label><br>
                                                    <input type="color" id="text_color" name="course_text_color" value="<?=$certificateSettings->course_text_color?>" style="width: 100%; height: 38px; padding: 2px; border: 1px solid #ced4da; border-radius: 4px;">
                                                    <small class="form-text text-muted"><?= getEduAppGTLang('text_color') ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="status"><?=getEduAppGTLang('status')?></label>
                                                        <div class="togglebutton">
                                                        <label><input type="checkbox" name="course_text_status" value="1" <?=$certificateSettings->course_text_status == 1 ? 'checked' : ''?>></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="height"><?=getEduAppGTLang('student_name_text')?></label>
                                                    <input type="text" class="form-control" readonly value="<?php echo getEduAppGTLang('student_name_text'); ?>" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">Size</label>
                                                    <input type="text" class="form-control" name="student_name_text_size" placeholder="11" value="<?=$certificateSettings->student_name_text_size?>">
                                                    <small><?=getEduAppGTLang('text_size')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">x</label>
                                                    <input type="text" class="form-control" name="student_name_text_x" placeholder="mm" value="<?=$certificateSettings->student_name_text_x?>">
                                                    <small><?=getEduAppGTLang('x_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="y">y</label>
                                                    <input type="text" class="form-control" name="student_name_text_y" placeholder="mm" value="<?=$certificateSettings->student_name_text_y?>">
                                                    <small><?=getEduAppGTLang('y_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="text_color">Color</label><br>
                                                    <input type="color" id="text_color" name="student_name_text_color" value="<?=$certificateSettings->student_name_text_color?>" style="width: 100%; height: 38px; padding: 2px; border: 1px solid #ced4da; border-radius: 4px;">
                                                    <small class="form-text text-muted"><?= getEduAppGTLang('text_color') ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="status"><?=getEduAppGTLang('status')?></label>
                                                        <div class="togglebutton">
                                                        <label><input type="checkbox" name="student_name_text_status" value="1" <?php if($certificateSettings->student_name_text_status == 1){echo 'checked';} ?>></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="height"><?=getEduAppGTLang('text_1')?></label>
                                                    <input type="text" class="form-control" name="text_1" placeholder="" value="<?=$certificateSettings->text_1?>">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">Size</label>
                                                    <input type="text" class="form-control" name="text_1_size" placeholder="11" value="<?=$certificateSettings->text_1_size?>">
                                                    <small><?=getEduAppGTLang('text_size')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">x</label>
                                                    <input type="text" class="form-control" name="text_1_x" placeholder="mm" value="<?=$certificateSettings->text_1_x?>">
                                                    <small><?=getEduAppGTLang('x_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="y">y</label>
                                                    <input type="text" class="form-control" name="text_1_y" placeholder="mm" value="<?=$certificateSettings->text_1_y?>">
                                                    <small><?=getEduAppGTLang('y_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="text_color">Color</label><br>
                                                    <input type="color" id="text_color" name="text_1_color" value="<?=$certificateSettings->text_1_color?>" style="width: 100%; height: 38px; padding: 2px; border: 1px solid #ced4da; border-radius: 4px;">
                                                    <small class="form-text text-muted"><?= getEduAppGTLang('text_color') ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="status"><?=getEduAppGTLang('status')?></label>
                                                        <div class="togglebutton">
                                                        <label><input type="checkbox" name="text_1_status" value="1" <?php if($certificateSettings->text_1_status == 1){echo 'checked';} ?>></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="height"><?=getEduAppGTLang('text_2')?></label>
                                                    <input type="text" class="form-control" name="text_2" placeholder="" value="<?=$certificateSettings->text_2?>">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">Size</label>
                                                    <input type="text" class="form-control" name="text_2_size" placeholder="11" value="<?=$certificateSettings->text_2_size?>">
                                                    <small><?=getEduAppGTLang('text_size')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">x</label>
                                                    <input type="text" class="form-control" name="text_2_x" placeholder="mm" value="<?=$certificateSettings->text_2_x?>">
                                                    <small><?=getEduAppGTLang('x_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="y">y</label>
                                                    <input type="text" class="form-control" name="text_2_y" placeholder="mm" value="<?=$certificateSettings->text_2_y?>">
                                                    <small><?=getEduAppGTLang('y_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="text_color">Color</label><br>
                                                    <input type="color" id="text_color" name="text_2_color" value="<?=$certificateSettings->text_2_color?>" style="width: 100%; height: 38px; padding: 2px; border: 1px solid #ced4da; border-radius: 4px;">
                                                    <small class="form-text text-muted"><?= getEduAppGTLang('text_color') ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="status"><?=getEduAppGTLang('status')?></label>
                                                        <div class="togglebutton">
                                                        <label><input type="checkbox" name="text_2_status" value="1" <?php if($certificateSettings->text_2_status == 1){echo 'checked';} ?>></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="height"><?=getEduAppGTLang('text_3')?></label>
                                                    <input type="text" class="form-control" name="text_3" value="<?=$certificateSettings->text_3?>" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">Size</label>
                                                    <input type="text" class="form-control" name="text_3_size" value="<?=$certificateSettings->text_3_size?>" placeholder="11">
                                                    <small><?=getEduAppGTLang('text_size')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">x</label>
                                                    <input type="text" class="form-control" name="text_3_x" value="<?=$certificateSettings->text_3_x?>" placeholder="mm">
                                                    <small><?=getEduAppGTLang('x_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="y">y</label>
                                                    <input type="text" class="form-control" name="text_3_y" value="<?=$certificateSettings->text_3_y?>" placeholder="mm">
                                                    <small><?=getEduAppGTLang('y_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="text_color">Color</label><br>
                                                    <input type="color" id="text_color" name="text_3_color" value="<?=$certificateSettings->text_3_color?>" style="width: 100%; height: 38px; padding: 2px; border: 1px solid #ced4da; border-radius: 4px;">
                                                    <small class="form-text text-muted"><?= getEduAppGTLang('text_color') ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="status"><?=getEduAppGTLang('status')?></label>
                                                        <div class="togglebutton">
                                                        <label><input type="checkbox" name="text_3_status" value="1" <?php if($certificateSettings->text_3_status == 1){echo 'checked';} ?> value="1"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="height"><?=getEduAppGTLang('text_4')?></label>
                                                    <input type="text" class="form-control" name="text_4" value="<?=$certificateSettings->text_4?>" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">Size</label>
                                                    <input type="text" class="form-control" name="text_4_size" value="<?=$certificateSettings->text_4_size?>" placeholder="11">
                                                    <small><?=getEduAppGTLang('text_size')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">x</label>
                                                    <input type="text" class="form-control" name="text_4_x value="<?=$certificateSettings->text_4_x?>" placeholder="mm">
                                                    <small><?=getEduAppGTLang('x_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="y">y</label>
                                                    <input type="text" class="form-control" name="text_4_y" value="<?=$certificateSettings->text_4_y?>" placeholder="mm">
                                                    <small><?=getEduAppGTLang('y_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="text_color">Color</label><br>
                                                    <input type="color" id="text_color" name="text_4_color" value="<?=$certificateSettings->text_4_color?>" style="width: 100%; height: 38px; padding: 2px; border: 1px solid #ced4da; border-radius: 4px;">
                                                    <small class="form-text text-muted"><?= getEduAppGTLang('text_color') ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="status"><?=getEduAppGTLang('status')?></label>
                                                        <div class="togglebutton">
                                                        <label><input type="checkbox" name="text_4_status" value="1" <?php if($certificateSettings->text_4_status == 1){echo 'checked';} ?> value="1"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <hr>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="height"><?=getEduAppGTLang('text_5')?></label>
                                                    <input type="text" class="form-control" name="text_5" value="<?=$certificateSettings->text_5?>" placeholder="">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">Size</label>
                                                    <input type="text" class="form-control" name="text_5_size" value="<?=$certificateSettings->text_5_size?>" placeholder="11">
                                                    <small><?=getEduAppGTLang('text_size')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="x">x</label>
                                                    <input type="text" class="form-control" name="text_5_x" value="<?=$certificateSettings->text_5_x?>" placeholder="mm">
                                                    <small><?=getEduAppGTLang('x_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="y">y</label>
                                                    <input type="text" class="form-control" name="text_5_y" value="<?=$certificateSettings->text_5_y?>" placeholder="mm">
                                                    <small><?=getEduAppGTLang('y_position')?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="text_color">Color</label><br>
                                                    <input type="color" id="text_color" name="text_5_color" value="<?=$certificateSettings->text_5_color?>" style="width: 100%; height: 38px; padding: 2px; border: 1px solid #ced4da; border-radius: 4px;">
                                                    <small class="form-text text-muted"><?= getEduAppGTLang('text_color') ?></small>
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                    <div class="form-group">
                                                        <label for="status"><?=getEduAppGTLang('status')?></label>
                                                        <div class="togglebutton">
                                                        <label><input type="checkbox" name="text_5_status" value="1" <?php if($certificateSettings->text_5_status == 1){echo 'checked';} ?> ></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                    <input class="btn btn-rounded btn-primary" id="sub_teacher" type="submit" value="<?php echo getEduAppGTLang('update_settings');?>">
                                            </div>
                                            <?php echo form_close();?>
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
    <div class="modal fade" id="changeImageModal" tabindex="-1" role="dialog" aria-labelledby="changeImageModalLabel" aria-hidden="true">
        <div class="modal-dialog custom-modal-responsive" role="document">
            <form action="<?php echo base_url('admin/change_certificate_image'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo getEduAppGTLang('change_image'); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <label for=""><?=getEduAppGTLang('exiting_image')?></label>
                        <div class="card shadow-sm border-0 mb-4" style="overflow: hidden;">
                                                    <center><img src="<?php echo base_url('public/certificates/' . $image); ?>"
                                                            alt="Certificate"
                                                            class="img-fluid text-center"
                                                            style="width: 50%; object-fit: cover;"></center>
                                                </div>

                        <div class="form-group">
                            <label>Change Image</label>
                            <input type="file" name="certificate_image" class="form-control" required accept="image/*">
                                <small class="text-muted">*Image must be same with paper size</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><?php echo getEduAppGTLang('save'); ?></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo getEduAppGTLang('cancel'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
        <div class="modal fade" id="adjustCertificate" tabindex="-1" role="dialog" aria-labelledby="adjustCertificateLabel" aria-hidden="true">
        <div class="modal-dialog custom-modal-responsive" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo getEduAppGTLang('settings_reference'); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="modal-body">
                         <div class="row">
                            <div class="col-md-12">
                                <h3><?=getEduAppGTLang('papper_reference')?></h3>
                                <div class="table-responsive">
                                   <table border="1" cellspacing="0" cellpadding="4" style="font-size: 12px; width: 100%;">
                                    <thead>
                                        <tr>
                                        <th>Paper Size</th>
                                        <th>Width (w)</th>
                                        <th>Height (h)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>A4</td><td>210</td><td>297</td></tr>
                                        <tr><td>A3</td><td>297</td><td>420</td></tr>
                                        <tr><td>A5</td><td>148</td><td>210</td></tr>
                                        <tr><td>A6</td><td>105</td><td>148</td></tr>
                                        <tr><td>F4</td><td>215</td><td>330</td></tr>
                                        <tr><td>Legal</td><td>215</td><td>355</td></tr>
                                        <tr><td>Letter</td><td>215</td><td>279</td></tr>
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h3><?=getEduAppGTLang('font_weight_reference')?></h3>
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Weight Value</th>
                                        <th>Example Text</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>100 (Thin)</td>
                                        <td class="fw" style="font-weight: 100;">The quick brown fox jumps over the lazy dog</td>
                                    </tr>
                                    <tr>
                                        <td>300 (Light)</td>
                                        <td class="fw" style="font-weight: 300;">The quick brown fox jumps over the lazy dog</td>
                                    </tr>
                                    <tr>
                                        <td>400 (Normal)</td>
                                        <td class="fw" style="font-weight: 400;">The quick brown fox jumps over the lazy dog</td>
                                    </tr>
                                    <tr>
                                        <td>500 (Medium)</td>
                                        <td class="fw" style="font-weight: 500;">The quick brown fox jumps over the lazy dog</td>
                                    </tr>
                                    <tr>
                                        <td>600 (Semi-Bold)</td>
                                        <td class="fw" style="font-weight: 600;">The quick brown fox jumps over the lazy dog</td>
                                    </tr>
                                    <tr>
                                        <td>700 (Bold)</td>
                                        <td class="fw" style="font-weight: 700;">The quick brown fox jumps over the lazy dog</td>
                                    </tr>
                                    <tr>
                                        <td>900 (Black)</td>
                                        <td class="fw" style="font-weight: 900;">The quick brown fox jumps over the lazy dog</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                         </div>
                    </div>
                </div>
            </form>
        </div>
    </div>