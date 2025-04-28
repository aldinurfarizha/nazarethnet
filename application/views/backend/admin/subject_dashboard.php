<?php
$running_year = $this->crud->getInfo('running_year');
$info = base64_decode($data);
$ex = explode('-', $info);
$sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
foreach ($sub as $row) :
?>
    <div class="content-w">
        <div class="conty">
            <?php include 'fancy.php'; ?>
            <div class="header-spacer"></div>
            <div class="cursos cta-with-media" style="background: #<?php echo $row['color']; ?>;">
                <div class="cta-content">
                    <div class="user-avatar">
                        <img alt="" src="<?php echo base_url(); ?>public/uploads/subject_icon/<?php echo $row['icon']; ?>" class="icon-wi">
                    </div>
                    <h3 class="cta-header"><?php echo $row['name']; ?> - <small><?php echo getEduAppGTLang('dashboard'); ?></small></h3>
                    <small class="subject-desc"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"</small>
                </div>
            </div>
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url(); ?>admin/subject_dashboard/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/online_exams/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/homework/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/forum/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo getEduAppGTLang('forum'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/study_material/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/upload_marks/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/blocked_mark/<?php echo $data; ?>/"><i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i><span>Marcas Bloqueadas</span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/meet/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo getEduAppGTLang('live'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/attendance/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/student_list/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0704_users_profile_group_couple_man_woman"></i><span><?php echo getEduAppGTLang('student'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/whiteboards/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0191_window_application_cursor"></i><span><?php echo getEduAppGTLang('whiteboards'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/gamification/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0659_medal_first_place_winner_award_prize_achievement"></i><span><?php echo getEduAppGTLang('gamification'); ?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="row">
                        <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">

                            <div class="ui-block paddingtel">
                                <div class="news-feed-form">
                                    <div class="tab-content">

                                        <div class="edu-wall-content ng-scope" id="new_post">
                                            <div class="tab-pane active show">
                                                <?php echo form_open(base_url() . 'admin/news/create/' . $data . '/', array('enctype' => 'multipart/form-data')); ?>
                                                <div class="author-thumb" style="padding-right:15px;">

                                                    <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_photo/complete/<?php echo base64_encode($this->crud->get_image_url('admin', $this->session->userdata('login_user_id'))); ?>');">
                                                        <img src="<?php echo $this->crud->get_image_url('admin', $this->session->userdata('login_user_id')); ?>" style="width:45px;">
                                                    </a>
                                                </div>
                                                <div class="form-group with-icon label-floating is-empty" style="padding-left:10px;">
                                                    <textarea onkeyup="textAreaAdjust(this)" style="overflow:hidden" class="form-control" placeholder="<?php echo getEduAppGTLang('hi'); ?> <?php echo $this->db->get_where('admin', array('admin_id' => $this->session->userdata('login_user_id')))->row()->first_name; ?> <?php echo getEduAppGTLang('what_publish'); ?>" name="description" required=""></textarea>
                                                    <span class="material-input"></span>
                                                </div>
                                                <div class="form-group" style="margin-bottom:-15px;">
                                                    <input type="file" name="userfile" onchange="imagePreview()" id="userfile" class="inputfile inputfile-3" style="display:none" accept="image/x-png,image/gif,image/jpeg">
                                                    <label style="font-size:15px;" for="userfile"><i class="os-icon picons-thin-icon-thin-0042_attachment"></i> <span><?php echo getEduAppGTLang('upload_image'); ?>...</span></label>
                                                </div>
                                                <center><img id="logoPreview" src="" width="40%" style="display:none;border-radius:5%;border:2px solid #eee;padding:5px" /></center>
                                                <div class="add-options-message btm-post edupostfoot edu-wall-actions" style="padding:10px 5px;">
                                                    <a href="javascript:void(0);" class="options-message" onclick="post()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('news'); ?>">
                                                        <i class="os-icon picons-thin-icon-thin-0032_flag"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="options-message" onclick="poll()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('polls'); ?>">
                                                        <i class="os-icon picons-thin-icon-thin-0385_graph_pie_chart_statistics"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="options-message" onclick="video()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('youtube_video'); ?>">
                                                        <i class="os-icon picons-thin-icon-thin-0593_video_play_youtube"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="options-message" onclick="vimeo()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('vimeo_video'); ?>">
                                                        <i class="ti-vimeo-alt"></i>
                                                    </a>
                                                    <button class="btn btn-rounded btn-success" style="float:right"><i class="picons-thin-icon-thin-0317_send_post_paper_plane" style="font-size:12px"></i> <?php echo getEduAppGTLang('publish'); ?></button>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                        <script>
                                            function textAreaAdjust(o) {
                                                o.style.height = "1px";
                                                o.style.height = (25 + o.scrollHeight) + "px";
                                            }
                                        </script>
                                        <div class="edu-wall-content ng-scope" id="new_video" style="display: none;">
                                            <div class="tab-pane show">
                                                <?php echo form_open(base_url() . 'admin/news/create_video/' . $data . '/', array('enctype' => 'multipart/form-data')); ?>
                                                <input type="hidden" name="embed" id="embed">
                                                <div class="author-thumb" style="padding-right:15px;">
                                                    <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_photo/complete/<?php echo base64_encode($this->crud->get_image_url('admin', $this->session->userdata('login_user_id'))); ?>');">
                                                        <img src="<?php echo $this->crud->get_image_url('admin', $this->session->userdata('login_user_id')); ?>" style="width:45px;">
                                                    </a>
                                                </div>
                                                <div class="form-group with-icon label-floating is-empty" style="padding-left:10px;">
                                                    <textarea onkeyup="textAreaAdjust(this)" style="overflow:hidden" class="form-control" placeholder="<?php echo getEduAppGTLang('hi'); ?> <?php echo $this->db->get_where('admin', array('admin_id' => $this->session->userdata('login_user_id')))->row()->first_name; ?> <?php echo getEduAppGTLang('what_publish'); ?>" name="description" required=""></textarea>
                                                    <span class="material-input"></span>
                                                </div>
                                                <div class="form-group" style="margin-bottom:-15px;">
                                                    <input type="text" name="url" id="url" class="form-control" placeholder="YouTube URL" onchange="set_video()">
                                                </div><br>
                                                <pre style="text-align:center;display:none;" id="myCode"></pre>
                                                <div class="add-options-message btm-post edupostfoot edu-wall-actions" style="padding:10px 5px;">
                                                    <a href="javascript:void(0);" class="options-message" onclick="post()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('news'); ?>">
                                                        <i class="os-icon picons-thin-icon-thin-0032_flag"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="options-message" onclick="poll()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('polls'); ?>">
                                                        <i class="os-icon picons-thin-icon-thin-0385_graph_pie_chart_statistics"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="options-message" onclick="video()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('youtube_video'); ?>">
                                                        <i class="os-icon picons-thin-icon-thin-0593_video_play_youtube"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="options-message" onclick="vimeo()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('vimeo_video'); ?>">
                                                        <i class="ti-vimeo-alt"></i>
                                                    </a>
                                                    <button class="btn btn-rounded btn-success" style="float:right"><i class="picons-thin-icon-thin-0317_send_post_paper_plane" style="font-size:12px"></i> <?php echo getEduAppGTLang('publish'); ?></button>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                        <div class="edu-wall-content ng-scope" id="new_vimeo" style="display: none;">
                                            <div class="tab-pane show">
                                                <?php echo form_open(base_url() . 'admin/news/create_vimeo/' . $data . '/', array('enctype' => 'multipart/form-data')); ?>
                                                <input type="hidden" name="embedvimeo" id="embedvimeo">
                                                <div class="author-thumb" style="padding-right:15px;">
                                                    <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_photo/complete/<?php echo base64_encode($this->crud->get_image_url('admin', $this->session->userdata('login_user_id'))); ?>');">
                                                        <img src="<?php echo $this->crud->get_image_url('admin', $this->session->userdata('login_user_id')); ?>" style="width:45px;">
                                                    </a>
                                                </div>
                                                <div class="form-group with-icon label-floating is-empty" style="padding-left:10px;">
                                                    <textarea onkeyup="textAreaAdjust(this)" style="overflow:hidden" class="form-control" placeholder="<?php echo getEduAppGTLang('hi'); ?> <?php echo $this->db->get_where('admin', array('admin_id' => $this->session->userdata('login_user_id')))->row()->first_name; ?> <?php echo getEduAppGTLang('what_publish'); ?>" name="description" required=""></textarea>
                                                    <span class="material-input"></span>
                                                </div>
                                                <div class="form-group" style="margin-bottom:-15px;">
                                                    <input type="text" name="urlvimeo" id="urlvimeo" class="form-control" placeholder="Vimeo URL" onchange="set_videoVimeo()">
                                                </div><br>
                                                <pre style="text-align:center;display:none;" id="myCodeVimeo"></pre>

                                                <div class="add-options-message btm-post edupostfoot edu-wall-actions" style="padding:10px 5px;">
                                                    <a href="javascript:void(0);" class="options-message" onclick="post()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('news'); ?>">
                                                        <i class="os-icon picons-thin-icon-thin-0032_flag"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="options-message" onclick="poll()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('polls'); ?>">
                                                        <i class="os-icon picons-thin-icon-thin-0385_graph_pie_chart_statistics"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="options-message" onclick="video()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('youtube_video'); ?>">
                                                        <i class="os-icon picons-thin-icon-thin-0593_video_play_youtube"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="options-message" onclick="vimeo()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('vimeo_video'); ?>">
                                                        <i class="ti-vimeo-alt"></i>
                                                    </a>
                                                    <button class="btn btn-rounded btn-success" style="float:right"><i class="picons-thin-icon-thin-0317_send_post_paper_plane" style="font-size:12px"></i> <?php echo getEduAppGTLang('publish'); ?></button>
                                                </div>
                                                <?php echo form_close(); ?>
                                            </div>
                                        </div>
                                        <div class="edu-wall-content ng-scope" id="new_poll" style="display: none;">
                                            <?php echo form_open(base_url() . 'admin/polls/create/' . $data . '/', array('enctype' => 'multipart/form-data')); ?>
                                            <div class="tab-pane active show"><br>
                                                <div class="col-sm-12">
                                                    <h5 class="form-header"><?php echo getEduAppGTLang('create_poll'); ?></h5>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <div class="form-group label-floating">
                                                            <label class="control-label"><?php echo getEduAppGTLang('question'); ?></label>
                                                            <input class="form-control" type="text" name="question">
                                                            <span class="material-input"></span>
                                                            <span class="material-input"></span>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div id="bulk_add_form">
                                                    <div id="student_entry">
                                                        <div class="form-group">
                                                            <div class="col-sm-12">
                                                                <label class="col-form-label" for=""><?php echo getEduAppGTLang('options'); ?></label>
                                                                <div class="input-group">
                                                                    <input class="form-control" name="options[]" placeholder="<?php echo getEduAppGTLang('options'); ?>" type="text">
                                                                    <button class="btn btn-sm btn-danger bulk text-center" href="javascript:void(0);" onclick="deleteParentElement(this)"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="student_entry_append"></div>
                                                </div> <br>
                                                <center><a href="javascript:void(0);" class="btn btn-rounded btn-primary btn-sm" onclick="append_student_entry()">+ <?php echo getEduAppGTLang('more_options'); ?></a></center><br>
                                                <div class="form-group">
                                                    <div class="col-sm-12">
                                                        <div class="form-group label-floating is-select">
                                                            <label class="control-label"><?php echo getEduAppGTLang('users'); ?></label>
                                                            <div class="select">
                                                                <select name="user" id="slct">
                                                                    <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                                                    <option value="student"><?php echo getEduAppGTLang('students'); ?></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <?php echo form_close(); ?>
                                                <div class="add-options-message btm-post edupostfoot edu-wall-actions" style="padding:10px 5px;">
                                                    <a href="javascript:void(0);" class="options-message" onclick="post()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('news'); ?>">
                                                        <i class="os-icon picons-thin-icon-thin-0032_flag"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="options-message" onclick="poll()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('poll'); ?>">
                                                        <i class="os-icon picons-thin-icon-thin-0385_graph_pie_chart_statistics"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="options-message" onclick="video()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('youtube_video'); ?>">
                                                        <i class="os-icon picons-thin-icon-thin-0593_video_play_youtube"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="options-message" onclick="vimeo()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('vimeo_video'); ?>">
                                                        <i class="ti-vimeo-alt"></i>
                                                    </a>
                                                    <button class="btn btn-rounded btn-success" style="float:right"><i class="picons-thin-icon-thin-0317_send_post_paper_plane" style="font-size:12px"></i> <?php echo getEduAppGTLang('publish'); ?></button>
                                                </div>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="newsfeed-items-grid">
                                <?php
                                $db = $this->db->query("SELECT description, publish_date, wall_type, homework_id FROM homework WHERE class_id = $ex[0] AND subject_id = $ex[2] AND section_id = $ex[1] 
                                UNION SELECT description, publish_date, type, news_id FROM news WHERE class_id = $ex[0] AND subject_id = $ex[2] AND section_id = $ex[1]  
                                UNION SELECT timestamp, publish_date, wall_type, post_id FROM forum WHERE class_id = $ex[0] AND subject_id = $ex[2] AND section_id = $ex[1]
                                UNION SELECT question,publish_date,type,id FROM polls WHERE class_id = $ex[0] AND subject_id = $ex[2] AND section_id = $ex[1] 
                                UNION SELECT description, publish_date, wall_type, document_id FROM document WHERE class_id = $ex[0] AND subject_id = $ex[2] AND section_id = $ex[1] 
                                UNION SELECT title, publish_date, wall_type, online_exam_id FROM online_exam WHERE class_id = $ex[0] AND subject_id = $ex[2] AND section_id = $ex[1] 
                                 ORDER BY publish_date DESC;");
                                if ($db->num_rows() > 0) :
                                    foreach ($db->result_array() as $wall) :
                                ?>
                                        <?php if ($wall['wall_type'] == 'news') : ?>
                                            <div class="ui-block paddingtel">
                                                <?php
                                                $news_code = $this->db->get_where('news', array('news_id' => $wall['homework_id']))->row()->news_code;
                                                $admin_id = $this->db->get_where('news', array('news_id' => $wall['homework_id']))->row()->admin_id;
                                                $user = $this->db->get_where('news', array('news_id' => $wall['homework_id']))->row()->user; ?>
                                                <article class="hentry post has-post-thumbnail thumb-full-width">
                                                    <div class="post__author author vcard inline-items">
                                                        <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_photo/complete/<?php echo base64_encode($this->crud->get_image_url($user, $admin_id)); ?>');">
                                                            <img src="<?php echo $this->crud->get_image_url($user, $admin_id); ?>">
                                                        </a>

                                                        <div class="author-date">
                                                            <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name('admin', $admin_id); ?></a>
                                                            <div class="post__date">
                                                                <time class="published" style="color: #0084ff;"><?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description; ?></time>
                                                            </div>
                                                        </div>
                                                        <div class="more">
                                                            <i class="icon-options"></i>
                                                            <ul class="more-dropdown">
                                                                <li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_wall/<?php echo $news_code; ?>/<?php echo $data; ?>');"><?php echo getEduAppGTLang('edit'); ?></a></li>
                                                                <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/news/delete/<?php echo $news_code; ?>/<?php echo $data; ?>"><?php echo getEduAppGTLang('delete'); ?></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <p><?php echo $this->crud->check_text($wall['description']); ?></p>
                                                    <?php if (file_exists('uploads/news_images/' . $news_code . '.jpg')) : ?>
                                                        <div class="post-thumb">
                                                            <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_photo/news_images/<?php echo $news_code . '.jpg'; ?>');">
                                                                <img src="<?php echo base_url(); ?>uploads/news_images/<?php echo $news_code; ?>.jpg">
                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div class="control-block-button post-control-button">
                                                        <a href="javascript:void(0);" class="btn btn-control" style="background-color:#001b3d; color:#fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('news'); ?>">
                                                            <i class="picons-thin-icon-thin-0032_flag"></i>
                                                        </a>
                                                    </div>
                                                </article>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($wall['wall_type'] == 'video') : ?>
                                            <div class="ui-block paddingtel">
                                                <?php
                                                $news_code = $this->db->get_where('news', array('news_id' => $wall['homework_id']))->row()->news_code;
                                                $news_embed = $this->db->get_where('news', array('news_id' => $wall['homework_id']))->row()->embed;
                                                $admin_id = $this->db->get_where('news', array('news_id' => $wall['homework_id']))->row()->admin_id;
                                                $user = $this->db->get_where('news', array('news_id' => $wall['homework_id']))->row()->user; ?>
                                                <article class="hentry post has-post-thumbnail thumb-full-width">
                                                    <div class="post__author author vcard inline-items">
                                                        <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_photo/complete/<?php echo base64_encode($this->crud->get_image_url($user, $admin_id)); ?>');">
                                                            <img src="<?php echo $this->crud->get_image_url($user, $admin_id); ?>">
                                                        </a>

                                                        <div class="author-date">
                                                            <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name($user, $admin_id); ?></a>
                                                            <div class="post__date">
                                                                <time class="published" style="color: #0084ff;"><?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description; ?></time>
                                                            </div>
                                                        </div>
                                                        <div class="more">
                                                            <i class="icon-options"></i>
                                                            <ul class="more-dropdown">
                                                                <li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_wall/<?php echo $news_code; ?>/<?php echo $data; ?>');"><?php echo getEduAppGTLang('edit'); ?></a></li>
                                                                <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/news/delete/<?php echo $news_code; ?>/<?php echo $data; ?>"><?php echo getEduAppGTLang('delete'); ?></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <p><?php echo $this->crud->check_text($wall['description']); ?></p>

                                                    <div class="post-thumb">
                                                        <iframe src="<?php echo $news_embed; ?>" height="360" width="100%" frameborder="0" allowfullscreen=""></iframe>
                                                    </div>
                                                    <div class="control-block-button post-control-button">
                                                        <a href="javascript:void(0);" class="btn btn-control" style="background-color:#001b3d; color:#fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('news'); ?>">
                                                            <i class="picons-thin-icon-thin-0032_flag"></i>
                                                        </a>
                                                    </div>
                                                </article>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($wall['wall_type'] == 'vimeo') : ?>
                                            <div class="ui-block paddingtel">
                                                <?php
                                                $news_code = $this->db->get_where('news', array('news_id' => $wall['homework_id']))->row()->news_code;
                                                $news_embed = $this->db->get_where('news', array('news_id' => $wall['homework_id']))->row()->embed;
                                                $admin_id = $this->db->get_where('news', array('news_id' => $wall['homework_id']))->row()->admin_id;
                                                $user = $this->db->get_where('news', array('news_id' => $wall['homework_id']))->row()->user;  ?>
                                                <article class="hentry post has-post-thumbnail thumb-full-width">
                                                    <div class="post__author author vcard inline-items">
                                                        <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_photo/complete/<?php echo base64_encode($this->crud->get_image_url($user, $this->session->userdata('login_user_id'))); ?>');">
                                                            <img src="<?php echo $this->crud->get_image_url('admin', $admin_id); ?>">
                                                        </a>

                                                        <div class="author-date">
                                                            <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name($user, $admin_id); ?></a>
                                                            <div class="post__date">
                                                                <time class="published" style="color: #0084ff;"><?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description; ?></time>
                                                            </div>
                                                        </div>
                                                        <div class="more">
                                                            <i class="icon-options"></i>
                                                            <ul class="more-dropdown">
                                                                <li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_wall/<?php echo $news_code; ?>/<?php echo $data; ?>');"><?php echo getEduAppGTLang('edit'); ?></a></li>
                                                                <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/news/delete/<?php echo $news_code; ?>/<?php echo $data; ?>"><?php echo getEduAppGTLang('delete'); ?></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <p><?php echo $this->crud->check_text($wall['description']); ?></p>

                                                    <div class="post-thumb">
                                                        <iframe src="https://player.vimeo.com/<?php echo $news_embed; ?>?color=ff0004&title=0&byline=0&portrait=0" width="100%" height="360" frameborder="0" allowfullscreen></iframe>
                                                    </div>
                                                    <div class="control-block-button post-control-button">
                                                        <a href="javascript:void(0);" class="btn btn-control" style="background-color:#001b3d; color:#fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('news'); ?>">
                                                            <i class="picons-thin-icon-thin-0032_flag"></i>
                                                        </a>
                                                    </div>
                                                </article>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($wall['wall_type'] == 'homework') : ?>
                                            <div class="ui-block">
                                                <article class="hentry post thumb-full-width">
                                                    <div class="post__author author vcard inline-items">
                                                        <img src="<?php echo $this->crud->get_image_url($this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->uploader_type, $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->uploader_id); ?>">
                                                        <div class="author-date">
                                                            <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name($this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->uploader_type, $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->uploader_id); ?></a>
                                                            <div class="post__date">
                                                                <time class="published"><?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->upload_date; ?></time>
                                                            </div>
                                                        </div>
                                                        <div class="more">
                                                            <i class="icon-options"></i>
                                                            <ul class="more-dropdown">
                                                                <li><a href="<?php echo base_url(); ?>admin/homework_edit/<?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->homework_code; ?>/"><?php echo getEduAppGTLang('edit'); ?></a></li>
                                                                <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/homework/delete/<?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->homework_code; ?>/<?php echo $data; ?>/"><?php echo getEduAppGTLang('delete'); ?></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="edu-posts cta-with-media verde">
                                                        <div class="cta-content">
                                                            <div class="highlight-header morado"><?php echo $row['name']; ?></div>
                                                            <div class="grado">
                                                                <?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"
                                                            </div>
                                                            <h3 class="cta-header"><?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->title; ?></h3>
                                                            <div class="descripcion">
                                                                <?php echo html_entity_decode($this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->description); ?>
                                                                <?php if ($this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->media_type == 1) : ?>
                                                                    <hr>
                                                                    <video src="<?php echo base_url(); ?>public/uploads/homework/video/<?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->homework_code; ?>.mp4" controls type="video/mp4" style="width: auto; max-width:100%;"></video>
                                                                <?php elseif ($this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->media_type == 2) : ?>
                                                                    <hr>
                                                                    <audio controls type="video/mp3">
                                                                        <source src="<?php echo base_url(); ?>public/uploads/homework/audio/<?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->homework_code; ?>.mp3" type="audio/mpeg">
                                                                    </audio>
                                                                <?php endif; ?>
                                                            </div>
                                                            <?php if ($this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->file_name != "") : ?>
                                                                <div class="table-responsive">
                                                                    <table class="table table-down">
                                                                        <tbody>
                                                                            <tr class="trdhs">
                                                                                <td class="text-left cell-with-media">
                                                                                    <a href="<?php echo base_url() . 'admin/viewFile/' . $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->file_name; ?>"><i class="picons-thin-icon-thin-0111_folder_files_documents px16 text-white"></i> <span><?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->file_name; ?></span><span class="smaller">(<?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->filesize; ?>)</span></a>
                                                                                </td>
                                                                                <td class="text-center bolder">
                                                                                    <a href="<?php echo base_url() . 'admin/viewFile/' . $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->file_name; ?>"> <span><i class="picons-thin-icon-thin-0121_download_file"></i></span> </a>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            <?php endif; ?>
                                                            <div class="deadtime">
                                                                <span><?php echo getEduAppGTLang('date'); ?>:</span><i class="picons-thin-icon-thin-0027_stopwatch_timer_running_time"></i><?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->date_end; ?> @ <?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->time_end; ?>
                                                            </div>
                                                            <a href="<?php echo base_url(); ?>admin/homeworkroom/<?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->homework_code; ?>/"><button class="btn btn-rounded btn-posts"><i class="picons-thin-icon-thin-0100_to_do_list_reminder_done"></i> <?php echo getEduAppGTLang('view_homework'); ?></button></a>
                                                        </div>
                                                    </div>
                                                    <div class="control-block-button post-control-button">
                                                        <a href="javascript:void(0);" class="btn btn-control featured-post grbg22" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('homework'); ?>">
                                                            <i class="picons-thin-icon-thin-0004_pencil_ruler_drawing"></i>
                                                        </a>
                                                    </div>
                                                    <?php
                                                    $checkData = $this->academic->getRead($wall['homework_id'], 'homework', $ex[2]);
                                                    if (count($checkData) > 0) :
                                                    ?>
                                                        <div class="post-additional-info inline-items">
                                                            <ul class="friends-harmonic">
                                                                <?php foreach ($checkData as $readed) : ?>
                                                                    <li>
                                                                        <a href="javascript:void(0);">
                                                                            <img loading="lazy" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_students/<?php echo $wall['homework_id'] . '/' . $ex[2] . '/homework'; ?>');" title="<?php echo $this->crud->get_name('student', $readed['student_id']); ?>" src="<?php echo $this->crud->get_image_url('student', $readed['student_id']); ?>" alt="<?php echo $this->crud->get_name('student', $readed['student_id']); ?>" width="28" height="28">
                                                                        </a>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                            <div class="names-people-likes">
                                                                <?php if (count($checkData) > 5) : ?>
                                                                    <?php echo getEduAppGTLang('and'); ?> <?php echo count($checkData) - 5; ?> <?php echo getEduAppGTLang('other_people_viewed_this_post'); ?>.
                                                                <?php else : ?>
                                                                    <?php echo getEduAppGTLang('have_seen_this_post'); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="comments-shared">
                                                                <a href="javascript:void(0);" class="post-add-icon inline-items"></a>
                                                                <a href="javascript:void(0);" class="post-add-icon inline-items"></a>
                                                            </div>
                                                        </div>
                                                    <?php else : ?>
                                                        <br><br><br>
                                                    <?php endif; ?>
                                                </article>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($wall['wall_type'] == 'exam') : ?>
                                            <div class="ui-block">
                                                <article class="hentry post thumb-full-width">
                                                    <div class="post__author author vcard inline-items">
                                                        <img src="<?php echo $this->crud->get_image_url($this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->uploader_type, $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->uploader_id); ?>">
                                                        <div class="author-date">
                                                            <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name($this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->uploader_type, $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->uploader_id); ?></a>
                                                            <div class="post__date">
                                                                <time class="published"><?php echo $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->upload_date; ?></time>
                                                            </div>
                                                        </div>
                                                        <div class="more">
                                                            <i class="icon-options"></i>
                                                            <ul class="more-dropdown">
                                                                <li><a href="<?php echo base_url(); ?>admin/exam_edit/<?php echo $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->online_exam_id; ?>/"><?php echo getEduAppGTLang('edit'); ?></a></li>
                                                                <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/manage_exams/delete/<?php echo $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->online_exam_id; ?>/<?php echo $data; ?>"><?php echo getEduAppGTLang('delete'); ?></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="edu-posts cta-with-media verde">
                                                        <div class="cta-content">
                                                            <div class="highlight-header celeste"><?php echo $row['name']; ?></div>
                                                            <div class="grado">
                                                                <?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"
                                                            </div>
                                                            <h3 class="cta-header"><?php echo $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->title; ?></h3>
                                                            <div class="descripcion">
                                                                <?php echo html_entity_decode($this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->instruction); ?>
                                                            </div>
                                                            <div class="deadtime">
                                                                <span><?php echo getEduAppGTLang('date'); ?>:</span><i class="picons-thin-icon-thin-0027_stopwatch_timer_running_time"></i><?php echo date('M d, Y', $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->exam_date); ?>
                                                            </div>
                                                            <div class="deadtime">
                                                                <span><?php echo getEduAppGTLang('hour'); ?>:</span><i class="picons-thin-icon-thin-0027_stopwatch_timer_running_time"></i><?php echo $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->time_start . " - " . $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->time_end; ?>
                                                            </div>
                                                            <div class="deadtime">
                                                                <span><?php echo getEduAppGTLang('duration'); ?>:</span><i class="picons-thin-icon-thin-0026_time_watch_clock"></i><?php $minutes = number_format($this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->duration / 60, 0);
                                                                                                                                                                                    echo $minutes; ?> <?php echo getEduAppGTLang('minutes'); ?>.
                                                            </div>
                                                            <a href="<?php echo base_url(); ?>admin/examroom/<?php echo $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->online_exam_id; ?>/"><button class="btn btn-rounded btn-posts verde"><i class="picons-thin-icon-thin-0014_notebook_paper_todo"></i> <?php echo getEduAppGTLang('view_exam'); ?></button></a>
                                                        </div>
                                                    </div>
                                                    <div class="control-block-button post-control-button">
                                                        <a href="javascript:void(0);" class="btn btn-control crlbs" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('online_exams'); ?>">
                                                            <i class="picons-thin-icon-thin-0207_list_checkbox_todo_done"></i>
                                                        </a>
                                                    </div>
                                                    <?php
                                                    $checkData = $this->academic->getRead($wall['homework_id'], 'exam', $ex[2]);
                                                    if (count($checkData) > 0) :
                                                    ?>
                                                        <div class="post-additional-info inline-items">
                                                            <ul class="friends-harmonic">
                                                                <?php foreach ($checkData as $readed) : ?>
                                                                    <li>
                                                                        <a href="javascript:void(0);">
                                                                            <img loading="lazy" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_students/<?php echo $wall['homework_id'] . '/' . $ex[2] . '/exam'; ?>');" title="<?php echo $this->crud->get_name('student', $readed['student_id']); ?>" src="<?php echo $this->crud->get_image_url('student', $readed['student_id']); ?>" alt="<?php echo $this->crud->get_name('student', $readed['student_id']); ?>" width="28" height="28">
                                                                        </a>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                            <div class="names-people-likes">
                                                                <?php if (count($checkData) > 5) : ?>
                                                                    <?php echo getEduAppGTLang('and'); ?> <?php echo count($checkData) - 5; ?> <?php echo getEduAppGTLang('other_people_viewed_this_post'); ?>.
                                                                <?php else : ?>
                                                                    <?php echo getEduAppGTLang('have_seen_this_post'); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="comments-shared">
                                                                <a href="javascript:void(0);" class="post-add-icon inline-items"></a>
                                                                <a href="javascript:void(0);" class="post-add-icon inline-items"></a>
                                                            </div>
                                                        </div>
                                                    <?php else : ?>
                                                        <br><br><br>
                                                    <?php endif; ?>
                                                </article>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($wall['wall_type'] == 'material') : ?>
                                            <div class="ui-block">
                                                <article class="hentry post thumb-full-width">
                                                    <div class="post__author author vcard inline-items">
                                                        <img src="<?php echo $this->crud->get_image_url($this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->type, $this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->teacher_id); ?>">
                                                        <div class="author-date">
                                                            <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name($this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->type, $this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->teacher_id); ?></a>
                                                            <div class="post__date">
                                                                <time class="published"><?php echo $this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->upload_date; ?></time>
                                                            </div>
                                                        </div>
                                                        <div class="more">
                                                            <i class="icon-options"></i>
                                                            <ul class="more-dropdown">
                                                                <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/study_material/delete/<?php echo $this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->document_id; ?>/<?php echo $data; ?>"><?php echo getEduAppGTLang('delete'); ?></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="edu-posts cta-with-media verde">
                                                        <div class="cta-content">
                                                            <div class="highlight-header morado"><?php echo $row['name']; ?></div>
                                                            <div class="grado">
                                                                <?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"
                                                            </div>
                                                            <h3 class="cta-header"><?php echo getEduAppGTLang('study_material'); ?></h3>
                                                            <div class="descripcion">
                                                                <?php echo html_entity_decode($this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->description); ?>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table class="table table-down">
                                                                    <tbody>
                                                                        <tr class="trdhs">
                                                                            <td class="text-left cell-with-media">
                                                                                <a href="<?php echo base_url() . 'admin/viewFile/' . $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->file_name; ?>"><i class="picons-thin-icon-thin-0111_folder_files_documents px16 text-white"></i> <span><?php echo $this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->file_name; ?></span><span class="smaller">(<?php echo $this->db->get_where('document', array('document_id' => $wall['homework_id']))->row()->filesize; ?>)</span></a>
                                                                            </td>
                                                                            <td class="text-center bolder">
                                                                                <a href="<?php echo base_url() . 'admin/viewFile/' . $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->file_name; ?>"> <span><i class="picons-thin-icon-thin-0121_download_file"></i></span> </a>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-block-button post-control-button">
                                                        <a href="javascript:void(0);" class="mdl-header btn btn-control text-white" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('study_material'); ?>">
                                                            <i class="picons-thin-icon-thin-0003_write_pencil_new_edit"></i>
                                                        </a>
                                                    </div>
                                                    <?php
                                                    $checkData = $this->academic->getRead($wall['homework_id'], 'material', $ex[2]);
                                                    if (count($checkData) > 0) :
                                                    ?>
                                                        <div class="post-additional-info inline-items">
                                                            <ul class="friends-harmonic">
                                                                <?php foreach ($checkData as $readed) : ?>
                                                                    <li>
                                                                        <a href="javascript:void(0);">
                                                                            <img loading="lazy" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_students/<?php echo $wall['homework_id'] . '/' . $ex[2] . '/material'; ?>');" title="<?php echo $this->crud->get_name('student', $readed['student_id']); ?>" src="<?php echo $this->crud->get_image_url('student', $readed['student_id']); ?>" alt="<?php echo $this->crud->get_name('student', $readed['student_id']); ?>" width="28" height="28">
                                                                        </a>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                            <div class="names-people-likes">
                                                                <?php if (count($checkData) > 5) : ?>
                                                                    <?php echo getEduAppGTLang('and'); ?> <?php echo count($checkData) - 5; ?> <?php echo getEduAppGTLang('other_people_viewed_this_post'); ?>.
                                                                <?php else : ?>
                                                                    <?php echo getEduAppGTLang('have_seen_this_post'); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="comments-shared">
                                                                <a href="javascript:void(0);" class="post-add-icon inline-items"></a>
                                                                <a href="javascript:void(0);" class="post-add-icon inline-items"></a>
                                                            </div>
                                                        </div>
                                                    <?php else : ?>
                                                        <br><br><br>
                                                    <?php endif; ?>
                                                </article>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($wall['wall_type'] == 'forum') : ?>
                                            <div class="ui-block">
                                                <article class="hentry post thumb-full-width">
                                                    <div class="post__author author vcard inline-items">
                                                        <img src="<?php echo $this->crud->get_image_url($this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->type, $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->teacher_id); ?>">
                                                        <div class="author-date">
                                                            <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name($this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->type, $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->teacher_id); ?></a>
                                                            <div class="post__date">
                                                                <time class="published"><?php echo $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->upload_date; ?></time>
                                                            </div>
                                                        </div>
                                                        <div class="more">
                                                            <i class="icon-options"></i>
                                                            <ul class="more-dropdown">
                                                                <li><a href="<?php echo base_url(); ?>admin/edit_forum/<?php echo $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->post_code; ?>/"><?php echo getEduAppGTLang('edit'); ?></a></li>
                                                                <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/forum/delete/<?php echo $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->post_code; ?>/<?php echo $data; ?>"><?php echo getEduAppGTLang('delete'); ?></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="edu-posts cta-with-media verde">
                                                        <div class="cta-content">
                                                            <div class="highlight-header yellow"><?php echo $row['name']; ?></div>
                                                            <div class="grado">
                                                                <?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"
                                                            </div>
                                                            <h3 class="cta-header"><?php echo $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->title; ?></h3>
                                                            <div class="descripcion">
                                                                <?php echo html_entity_decode($this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->description); ?>
                                                            </div>
                                                            <a href="<?php echo base_url(); ?>admin/forumroom/<?php echo $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->post_code; ?>/"><button class="btn btn-rounded btn-posts"><i class="picons-thin-icon-thin-0014_notebook_paper_todo"></i> <?php echo getEduAppGTLang('view_forum'); ?></button></a>
                                                        </div>
                                                    </div>
                                                    <div class="control-block-button post-control-button">
                                                        <a href="javascript:void(0);" class="btn btn-control crlt2" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('forum'); ?>">
                                                            <i class="picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i>
                                                        </a>
                                                    </div>
                                                    <?php
                                                    $checkData = $this->academic->getRead($wall['homework_id'], 'forum', $ex[2]);
                                                    if (count($checkData) > 0) :
                                                    ?>
                                                        <div class="post-additional-info inline-items">
                                                            <ul class="friends-harmonic">
                                                                <?php foreach ($checkData as $readed) : ?>
                                                                    <li>
                                                                        <a href="javascript:void(0);">
                                                                            <img loading="lazy" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_students/<?php echo $wall['homework_id'] . '/' . $ex[2] . '/forum'; ?>');" title="<?php echo $this->crud->get_name('student', $readed['student_id']); ?>" src="<?php echo $this->crud->get_image_url('student', $readed['student_id']); ?>" alt="<?php echo $this->crud->get_name('student', $readed['student_id']); ?>" width="28" height="28">
                                                                        </a>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                            <div class="names-people-likes">
                                                                <?php if (count($checkData) > 5) : ?>
                                                                    <?php echo getEduAppGTLang('and'); ?> <?php echo count($checkData) - 5; ?> <?php echo getEduAppGTLang('other_people_viewed_this_post'); ?>.
                                                                <?php else : ?>
                                                                    <?php echo getEduAppGTLang('have_seen_this_post'); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="comments-shared">
                                                                <a href="javascript:void(0);" class="post-add-icon inline-items"></a>
                                                                <a href="javascript:void(0);" class="post-add-icon inline-items"></a>
                                                            </div>
                                                        </div>
                                                    <?php else : ?>
                                                        <br><br><br>
                                                    <?php endif; ?>
                                                </article>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                <?php elseif ($db->num_rows() == 0) : ?>
                                    <div class="ui-block">
                                        <article class="hentry post thumb-full-width">
                                            <div class="edu-posts cta-with-media">
                                                <br><br>
                                                <center>
                                                    <h3><?php echo getEduAppGTLang('no_recent_activity'); ?></h3>
                                                </center><br>
                                                <center><img src="<?php echo base_url(); ?>public/uploads/icons/norecent.svg" width="55%"></center>
                                                <br><br>
                                            </div>
                                        </article>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </main>
                        <div class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12">
                            <div class="eduappgt-sticky-sidebar">
                                <div class="sidebar__inner">
                                    <div class="ui-block">
                                        <div class="ui-block-title">
                                            <h6 class="title"><?php echo getEduAppGTLang('teacher_of_the_subject'); ?></h6>
                                        </div>
                                        <div class="ui-block-content">
                                            <div class="widget w-about text-center">
                                                <?php $tch = $this->db->get_where('subject', array('subject_id' => $ex[2]))->row()->teacher_id; ?>
                                                <a href="javascript:void(0);" class="logo"><img src="<?php echo $this->crud->get_image_url('teacher', $tch); ?>" class="w90"></a>
                                                <h5><?php echo $this->crud->get_name('teacher', $tch) ?><br> <small><?php echo $this->db->get_where('teacher', array('teacher_id' => $tch))->row()->email; ?></small></h5>
                                                <h6><a class="badge badge-primary" href="javascript:void(0);"> <?php echo getEduAppGTLang('teacher'); ?></a></h6>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui-block">
                                        <div class="ui-block-title">
                                            <h6 class="title"><?php echo getEduAppGTLang('subject_activity'); ?></h6>
                                        </div>
                                        <?php
                                        $this->db->order_by('id', 'desc');
                                        $this->db->group_by('notify');
                                        $notifications = $this->db->get_where('notification', array('class_id' => $ex[0], 'section_id' => $ex[1], 'subject_id' => $ex[2], 'year' => $running_year));
                                        if ($notifications->num_rows() > 0) :
                                        ?>
                                            <ul class="widget w-activity-feed notification-list">
                                                <?php foreach ($notifications->result_array() as $notify) : ?>
                                                    <li>
                                                        <div class="author-thumb">
                                                            <img src="<?php echo base_url(); ?>public/uploads/notify.svg">
                                                        </div>
                                                        <div class="notification-event">
                                                            <a href="javascript:void(0);" class="notification-friend"><?php echo $notify['notify']; ?>.</a>
                                                            <span class="notification-date"><time class="entry-date updated"><?php echo $notify['date']; ?> <?php echo getEduAppGTLang('at'); ?> <?php echo $notify['time']; ?></time></span>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        <?php else : ?>
                                            <br><br><br>
                                            <center>
                                                <h6><?php echo getEduAppGTLang('no_subject_activity'); ?></h6>
                                            </center>
                                            <br><br><br>
                                        <?php endif; ?>
                                    </div>
                                    <div class="ui-block">
                                        <div class="ui-block-title">
                                            <h6 class="title"><?php echo getEduAppGTLang('latest_news'); ?></h6>
                                        </div>
                                        <div class="ui-block-content">
                                            <ul class="widget w-personal-info item-block">
                                                <?php
                                                $this->db->limit(5);
                                                $this->db->order_by('news_id', 'desc');
                                                $news = $this->db->get('news')->result_array();
                                                foreach ($news as $row5) :
                                                ?>
                                                    <li><span class="text"><?php echo $row5['description']; ?></span></li>
                                                    <hr>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="eduappgt-sticky-sidebar">
                                <div class="sidebar__inner">
                                    <div class="ui-block paddingtel">
                                        <div class="ui-block-title">
                                            <h6 class="title"><?php echo getEduAppGTLang('about_the_subject'); ?></h6>
                                        </div>
                                        <div class="ui-block-content">
                                            <ul class="widget item-block">
                                                <li>
                                                    <span class="text"><?php echo $row['about']; ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="ui-block paddingtel">
                                        <div class="ui-block-title">
                                            <h6 class="title"><?php echo getEduAppGTLang('subject_stats'); ?></h6>
                                        </div>
                                        <div class="ui-block-content">
                                            <div class="btm">
                                                <span class="subjectCounter"><?php echo $this->academic->countOnlineExams($ex[0], $ex[1], $ex[2]); ?></span>
                                                <span class="counterText"><?php echo getEduAppGTLang('online_exams'); ?>.</span>
                                            </div>
                                            <div class="btm">
                                                <span class="subjectCounter"><?php echo $this->academic->countHomeworks($ex[0], $ex[1], $ex[2]); ?></span>
                                                <span class="counterText"><?php echo getEduAppGTLang('homeworks'); ?>.</span>
                                            </div>
                                            <div class="btm">
                                                <span class="subjectCounter"><?php echo $this->academic->countForums($ex[0], $ex[1], $ex[2]); ?></span>
                                                <span class="counterText"><?php echo getEduAppGTLang('forums'); ?>.</span>
                                            </div>
                                            <div class="btm">
                                                <span class="subjectCounter"><?php echo $this->academic->countMaterial($ex[0], $ex[1], $ex[2]); ?></span>
                                                <span class="counterText"><?php echo getEduAppGTLang('study_material'); ?>.</span>
                                            </div>
                                            <div class="btm">
                                                <span class="subjectCounter"><?php echo $this->academic->countLive($ex[0], $ex[1], $ex[2]); ?></span>
                                                <span class="counterText"><?php echo getEduAppGTLang('live_classes'); ?>.</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui-block paddingtel">
                                        <div class="ui-block-title">
                                            <h6 class="title"><?php echo getEduAppGTLang('students'); ?></h6>
                                        </div>
                                        <ul class="widget w-friend-pages-added notification-list friend-requests">
                                            <?php $students   =   $this->db->get_where('enroll', array('class_id' => $ex[0], 'section_id' => $ex[1], 'year' => $running_year))->result_array();
                                            foreach ($students as $row2) :
                                                if(!isStudentActiveEnroll($row2['student_id'], $ex[0], $ex[1], $running_year)){
                                                    continue;
                                                }
                                                if(isStudentFinishSubject($row2['student_id'], $ex[2])){
                                                    continue;
                                                }
                                                if (isActiveSubject($row2['student_id'], $ex[2])) {
                                            ?>
                                                    <li class="inline-items">
                                                        <div class="author-thumb">
                                                            <img src="<?php echo $this->crud->get_image_url('student', $row2['student_id']); ?>" width="35px">
                                                        </div>
                                                        <div class="notification-event">
                                                            <a href="javascript:void(0);" class="h6 notification-friend"><?php echo $this->crud->get_name('student', $row2['student_id']) ?></a>
                                                            <span class="chat-message-item"><?php echo getEduAppGTLang('roll'); ?>: <?php echo $this->db->get_where('enroll', array('student_id' => $row2['student_id']))->row()->roll; ?></span>
                                                        </div>
                                                    </li>
                                            <?php }
                                            endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a class="back-to-top" href="javascript:void(0);">
                    <img src="<?php echo base_url(); ?>public/style/olapp/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
                </a>
            </div>
        </div>
    </div>


    <script>
        function post() {
            $("#new_post").show(500);
            $("#new_poll").hide(500);
            $("#new_video").hide(500);
            $("#new_vimeo").hide(500);
        }

        function poll() {
            $("#new_post").hide(500);
            $("#new_video").hide(500);
            $("#new_poll").show(500);
            $("#new_vimeo").hide(500);
        }

        function video() {
            $("#new_post").hide(500);
            $("#new_poll").hide(500);
            $("#new_video").show(500);
            $("#new_vimeo").hide(500);
        }

        function vimeo() {
            $("#new_post").hide(500);
            $("#new_poll").hide(500);
            $("#new_video").hide(500);
            $("#new_vimeo").show(500);
        }
    </script>

    <script type="text/javascript">
        var blank_student_entry = '';
        $(document).ready(function() {
            blank_student_entry = $('#student_entry').html();
            for ($i = 1; $i < 1; $i++) {
                $("#student_entry").append(blank_student_entry);
            }
        });

        function append_student_entry() {
            $("#student_entry_append").append(blank_student_entry);
        }

        function deleteParentElement(n) {
            n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
        }
    </script>

    <script>
        function getId(url) {
            var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            var match = url.match(regExp);
            if (match && match[2].length == 11) {
                return match[2];
            } else {
                return 'error';
            }
        }

        function set_video() {
            var Id = getId($("#url").val());
            $('#myCode').html('<br><iframe width="560" height="315" src="//www.youtube.com/embed/' + Id + '" frameborder="0" allowfullscreen></iframe>');
            $("#embed").val('//www.youtube.com/embed/' + Id)
            $("#myCode").show(500);
        }

        function getIdVimeo(url) {
            var regExp = /https:\/\/(www\.)?vimeo.com\/(\d+)($|\/)/;
            var match = url.match(regExp);
            if (match[2].length > 0) {
                return match[2];
            } else {
                return 'error';
            }
        }

        function set_videoVimeo() {
            var IdV = getIdVimeo($("#urlvimeo").val());
            $('#myCodeVimeo').html('<br><iframe width="560" height="315" src="https://player.vimeo.com/video/' + IdV + '?color=ff0004&title=0&byline=0&portrait=0" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>');
            $("#embedvimeo").val('https://player.vimeo.com/video/' + IdV)
            $("#myCodeVimeo").show(500);
        }
    </script>

    <script type="text/javascript">
        //File Preview
        if (window.FileReader) {
            var reader = new FileReader(),
                rFilter = /^(image\/bmp|image\/cis-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x-cmu-raster|image\/x-cmx|image\/x-icon|image\/x-portable-anymap|image\/x-portable-bitmap|image\/x-portable-graymap|image\/x-portable-pixmap|image\/x-rgb|image\/x-xbitmap|image\/x-xpixmap|image\/x-xwindowdump)$/i;
            reader.onload = function(oFREvent) {
                $("#logoPreview").show();
                lgpreview = document.getElementById("logoPreview")
                lgpreview.src = oFREvent.target.result;
            };

            function imagePreview() {
                if (document.getElementById("userfile").files.length === 0) {
                    return;
                }
                var file = document.getElementById("userfile").files[0];
                if (!rFilter.test(file.type)) {
                    alert("You must select a valid image file!");
                    return;
                }
                reader.readAsDataURL(file);
            }
        } else {
            alert("Try using Chrome, Firefox or WebKit");
        }
    </script>
<?php endforeach; ?>