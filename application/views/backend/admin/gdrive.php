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
                        <a class="navs-links active" href="<?php echo base_url(); ?>admin/drive/"><i class="picons-thin-icon-thin-0119_folder_open_full_documents"></i><span><?php echo getEduAppGTLang('google_drive'); ?></span></a>
                    </li>
                </ul>
            </div>
        </div><br>
        <div class="all-wrapper solid-bg-all">
            <div class="layout-w">
                <div class="content-w">
                    <div class="content-i">
                        <div class="content-box">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="element-box lined-primary shadow rad10">
                                        <?php echo form_open(base_url() . 'admin/drive/drive'); ?>
                                        <h4 class="form-header"><?php echo getEduAppGTLang('google_drive'); ?></h4><br>
                                        <?php if ($this->db->get_where('settings', array('type' => 'account_id'))->row()->description != '') : ?>
                                            <div class="text-center row">
                                                <div class="col-sm-12">
                                                    <img style="border-radius:50%;" src="" class="apiImg">
                                                    <p><br>
                                                        <b><?php echo getEduAppGTLang('id'); ?>:</b> <?php echo $this->db->get_where('settings', array('type' => 'account_id'))->row()->description; ?>
                                                        <br>
                                                        <?php echo $this->db->get_where('settings', array('type' => 'account_name'))->row()->description; ?>
                                                        <br>
                                                        <?php echo $this->db->get_where('settings', array('type' => 'account_email'))->row()->description; ?>
                                                        <br>
                                                        <?php echo $this->drive_model->formatBytes($this->db->get_where('settings', array('type' => 'account_usage'))->row()->description); ?> / <?php echo $this->drive_model->formatBytes($this->db->get_where('settings', array('type' => 'account_limit'))->row()->description); ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                        <?php endif; ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"><?php echo getEduAppGTLang('google_client_id'); ?></label>
                                                    <input class="form-control" value="<?php echo $this->db->get_where('settings', array('type' => 'clientId'))->row()->description; ?>" type="text" name="clientId" required="">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"><?php echo getEduAppGTLang('google_client_secret'); ?></label>
                                                    <input class="form-control" value="<?php echo $this->db->get_where('settings', array('type' => 'ClientSecret'))->row()->description; ?>" type="text" name="ClientSecret" required="">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group label-floating">
                                                    <label class="control-label"><?php echo getEduAppGTLang('authorized_redirect_uri'); ?></label>
                                                    <input class="form-control" value="https://nazarethnet.com/authorizeapp" readonly type="text">
                                                    <span class="material-input"></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group label-floating is-select">
                                                        <label class="control-label">Notif Me when have google drive issues</label>
                                                        <div class="select">
                                                            <select name="gdrive_notif" required="">
                                                            <?php 
                                                            if($this->db->get_where('settings', array('type' => 'gdrive_notif'))->row()->description){?>
                                                                <option value="1" selected="true">Yes</option>
                                                                <option value="0">No</option>
                                                            <?php }else{?>
                                                                <option value="1">Yes</option>
                                                                <option value="0"selected="true">No</option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <a href="<?=base_url('admin/testing_mail_notif')?>" class="btn btn-primary">Test Send Notif (<?php echo $this->db->get_where('settings', array('type' => 'account_email'))->row()->description; ?>) <i class="fa fa-paper-plane"></i></a>
                                            </div>
                                            <?php if ($this->db->get_where('settings', array('type' => 'clientId'))->row()->description != '') : ?>
                                                <?php
                                                $client = $this->drive_model->getClient();
                                                if (filter_var($client, FILTER_VALIDATE_URL) === FALSE) : ?>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">GDrive Account Status</label><br>
                                                            <span class="badge badge-success">Active Sync <i class="fa fa-check-circle"></i></span>
                                                        </div>
                                                    </div>
                                                <?php else : ?>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">GDrive Account Status</label><br>
                                                            <span class="badge badge-danger">Inactive Sync <i class="fa fa-ban"></i></span>
                                                            <p class="text-muted">*Please Authorized Account to active Google Drive Auto Sync</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <a class="btn btn-info" href="javascript:poptastic('<?php echo $client; ?>')"><img src="<?php echo base_url(); ?>public/uploads/drive.png" width="20px">&nbsp; <?php echo getEduAppGTLang('authorize_google_drive'); ?></a>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($this->db->get_where('settings', array('type' => 'school_folder'))->row()->description == '' && $this->db->get_where('settings', array('type' => 'account_id'))->row()->description != '') : ?>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">GDrive Folder Status:</label><br>
                                                            <span class="badge badge-danger">Gdrive Folder Not Found <i class="fa fa-ban"></i></span><br>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <a class="btn btn-warning full-width" href="<?php echo base_url(); ?>admin/gdrive">
                                                            Create Folder On Gdrive
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($this->db->get_where('settings', array('type' => 'school_folder'))->row()->description != '') : ?>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="control-label">GDrive Folder Status:</label><br>
                                                            <span class="badge badge-success">Gdrive Folder Available <i class="fa fa-check-circle"></i></span><br>
                                                            <a href="#" onclick="showAjaxModal('<?= base_url('modal/popup/modal_having_problem/') ?>');">Having Problem?</a>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <div class="col-sm-12">
                                                <button class="btn btn-primary btn-rounded pull-right" type="submit"> <?php echo getEduAppGTLang('update'); ?></button>
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="element-box lined-success shadow rad10">
                                        <?php echo form_open(base_url() . 'admin/drive/settings'); ?>
                                        <h4 class="form-header"><?php echo getEduAppGTLang('drive_settings'); ?></h4><br>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="description-toggle">
                                                    <div class="description-toggle-content">
                                                        <div class="h6"><?php echo getEduAppGTLang('keep_old_files_after_sync'); ?></div>
                                                        <p><?php echo getEduAppGTLang('it_only_applies_to_old_files_the_new_ones_will_be_deleted_automatically.'); ?></p>
                                                    </div>
                                                    <div class="togglebutton">
                                                        <label><input name="delete_drive" value="1" type="checkbox" <?php if ($this->crud->getInfo('delete_drive') == 1) echo "checked"; ?>></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if ($this->db->get_where('settings', array('type' => 'account_id'))->row()->description != '') : ?>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <a class="btn btn-danger full-width" onclick="return confirm('<?php echo getEduAppGTLang('are_you_sure'); ?>');" href="<?php echo base_url(); ?>admin/drive/remove_drive/"><?php echo getEduAppGTLang('unlink_google_drive'); ?></a>
                                                        <small><?php echo getEduAppGTLang('if_you_unlink_the_account_all_the_files_will_be_deleted_and_you_will_not_be_able_to_recover_them'); ?>. <b>(<?php echo getEduAppGTLang('files_will_still_be_in_your_drive_account'); ?>)</b></small>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <div class="col-sm-12">
                                                <button class="btn btn-success btn-rounded pull-right" type="submit"> <?php echo getEduAppGTLang('update'); ?></button>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
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
    'use strict';

    function poptastic(url) {
        var newWindow = window.open(url, 'name', 'toolbar=yes,scrollbars=yes,resizable=yes,width=600,height=900');
        if (window.focus) {
            newWindow.focus();
        }
    }
</script>