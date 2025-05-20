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
                                        <div class="container mt-4">
                                            <div class="text-center">
                                                <div class="card shadow-sm border-0 mb-4" style="overflow: hidden;">
                                                    <center><img src="<?php echo base_url('public/certificates/' . $image); ?>"
                                                            alt="Certificate"
                                                            class="img-fluid text-center"
                                                            style="width: 50%; object-fit: cover;"></center>
                                                </div>

                                                <button class="btn btn-primary mt-3" data-toggle="modal" data-target="#changeImageModal">
                                                    Change Image
                                                </button>
                                                <a class="btn btn-success mt-3" href="<?= base_url('certificate/download/TESTING123/view') ?>" target="_blank"><?php echo getEduAppGTLang('open_sample'); ?></a>
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
    <div class="modal fade" id="changeImageModal" tabindex="-1" role="dialog" aria-labelledby="changeImageModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="<?php echo base_url('admin/change_certificate_image'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><?php echo getEduAppGTLang('change_image'); ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="certificate_image" class="form-control" required accept="image/*">
                        <small class="text-muted">*Image must be 1122 X 794</small>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success"><?php echo getEduAppGTLang('save'); ?></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo getEduAppGTLang('cancel'); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>