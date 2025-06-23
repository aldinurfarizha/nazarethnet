<?php
$running_year = $this->crud->getInfo('running_year');
$info = base64_decode($data);
$ex = explode('-', $info);
$sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
foreach ($sub as $row) :
?>
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

        .emoji-insert {
            margin-right: 8px;
            font-size: 35px;
            text-decoration: none;
            cursor: pointer;
        }

        .post-comments-section {
            padding: 5px 5px 5px;
            font-family: Arial, sans-serif;
        }

        .reactions-summary {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 10px;
            font-size: 16px;
            color: #333;
        }

             .reaction-item {
         display: flex;
         align-items: center;
         gap: 5px;
         font-weight: bold;
         user-select: none;
         cursor: default;
         font-size: 1.2rem;
     }




        .comments-list {
            list-style-type: none;
            margin: 0;
            padding: 0 15px;
            max-height: 200px;
            overflow-y: auto;
            border-top: 1px solid #ddd;
        }

        .comments-list {
            list-style: none;
            padding-left: 0;
            margin-top: 5px;
        }

        .comments-list li {
            border-bottom: 1px solid #eee;
        }

        .comments-list strong {
            display: block;
            font-weight: bold;
            color: #333;
        }

        .comments-list span {
            display: block;
            color: #555;
        }

        .comments-list small {
            display: block;
            font-size: 12px;
            color: #888;
            margin-top: 3px;
        }

.summernote-content {
  all: unset; /* Lebih aman daripada all: initial */
  font-family: Arial, sans-serif;
  font-size: 14px;
  line-height: 1.6;
  color: #333;
  box-sizing: border-box;
  overflow-wrap: break-word;
  word-break: break-word;
}

.summernote-content * {
  all: unset;
  box-sizing: border-box;
  font-family: inherit;
  font-size: inherit;
  line-height: inherit;
  color: inherit;
  word-wrap: break-word;
  word-break: break-word;
}

/* Fix gambar */
.summernote-content img {
  max-width: 100% !important;
  height: auto !important;
  display: block;
}

/* Fix tabel */
.summernote-content table {
  width: 100% !important;
  max-width: 100%;
  table-layout: auto;
  overflow-x: auto;
  display: block;
  border-collapse: collapse;
}

.summernote-content th,
.summernote-content td {
  border: 1px solid #ccc;
  padding: 8px;
}

/* Fix iframe */
.summernote-content iframe {
  max-width: 100% !important;
  height: auto;
  display: block;
}

/* Fix pre/code */
.summernote-content pre,
.summernote-content code {
  max-width: 100%;
  white-space: pre-wrap;
  overflow-x: auto;
  display: block;
  background: #f4f4f4;
  padding: 10px;
  border-radius: 4px;
}

/* Fix heading */
.summernote-content h1,
.summernote-content h2,
.summernote-content h3,
.summernote-content h4,
.summernote-content h5,
.summernote-content h6 {
  font-weight: bold;
  margin: 1em 0 0.5em;
}

/* Link */
.summernote-content a {
  color: blue;
  text-decoration: underline;
}

.summernote-content a:hover {
  color: darkblue;
}
.summernote-preview {
  border: none;
  width: 100%;
  height: 300px;
  overflow: hidden;
}

    </style>
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
                            <a class="navs-links active" href="<?php echo base_url(); ?>student/subject_dashboard/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/online_exams/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/homework/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/forum/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo getEduAppGTLang('forum'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/study_material/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/subject_marks/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/meet/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo getEduAppGTLang('live'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/attendance_report/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/whiteboards/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0191_window_application_cursor"></i><span><?php echo getEduAppGTLang('whiteboards'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>student/gamification/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0659_medal_first_place_winner_award_prize_achievement"></i><span><?php echo getEduAppGTLang('gamification'); ?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="row">
                        <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                            <div id="newsfeed-items-grid">
                                <?php
                                 $db = $this->db->query("SELECT can_comment, can_reaction, post_file, post_file_type, post_content, description, publish_date, wall_type, homework_id FROM homework WHERE class_id = $ex[0] AND subject_id = $ex[2] AND section_id = $ex[1] 
                                UNION SELECT can_comment, can_reaction, post_file, post_file_type, post_content, description, publish_date, type, news_id FROM news WHERE class_id = $ex[0] AND subject_id = $ex[2] AND section_id = $ex[1]  
                                UNION SELECT can_comment, can_reaction, post_file, post_file_type, post_content, timestamp, publish_date, wall_type, post_id FROM forum WHERE class_id = $ex[0] AND subject_id = $ex[2] AND section_id = $ex[1]
                                UNION SELECT can_comment, can_reaction, post_file, post_file_type, post_content, question,publish_date,type,id FROM polls WHERE class_id = $ex[0] AND subject_id = $ex[2] AND section_id = $ex[1] 
                                UNION SELECT can_comment, can_reaction, post_file, post_file_type, post_content, description, publish_date, wall_type, document_id FROM document WHERE class_id = $ex[0] AND subject_id = $ex[2] AND section_id = $ex[1] 
                                UNION SELECT can_comment, can_reaction, post_file, post_file_type, post_content, title, publish_date, wall_type, online_exam_id FROM online_exam WHERE class_id = $ex[0] AND subject_id = $ex[2] AND section_id = $ex[1] 
                                 ORDER BY publish_date DESC;");
                                if ($db->num_rows() > 0) :
                                    foreach ($db->result_array() as $wall) :
                                ?>
                                        <?php if ($wall['wall_type'] == 'news') : ?>
                                            <div class="ui-block paddingtel">
                                                <?php
                                               $news_id = $wall['homework_id'];
                                            $news = $this->db->get_where('news', ['news_id' => $news_id])->row();
                                            $news_code = $news->news_code;
                                            $admin_id = 2;
                                            $user_type = 'student';
                                            $comments = getComments($news_id, 'news_comments');
                                            $post_id = $news_id;?>
                                                <article class="hentry post has-post-thumbnail thumb-full-width">
                                                    <div class="post__author author vcard inline-items">
                                                        <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_photo/complete/<?php echo base64_encode($this->crud->get_image_url($news->user, $admin_id)); ?>');">
                                                            <img src="<?php echo $this->crud->get_image_url($news->user, $admin_id); ?>">
                                                        </a>

                                                        <div class="author-date">
                                                            <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name($news->user, $admin_id); ?></a>
                                                            <div class="post__date">
                                                                <time class="published" style="color: #0084ff;"><?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description; ?></time>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <?php if(!empty($wall['post_content'])) : ?>
                                                        <iframe class="summernote-preview" srcdoc="<?= htmlspecialchars($wall['post_content']); ?>"></iframe>
                                                    <?php endif; ?>
                                                    <hr>
                                                    <?php if (!empty($wall['post_file'])) : ?>
                                                        <a href="<?= base_url('public/news/' . $wall['post_file']) ?>"><?= getEduAppGTLang('download_attachment'); ?> (.<?= $wall['post_file_type'] ?>) <i class="fa fa-paperclip"></i></a>
                                                        <hr>
                                                    <?php endif; ?>
                                                    <div class="col-md-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex gap-2">
                                                <?php if ($wall['can_reaction']) : ?>
                                                    <?php foreach (countReaction($post_id, 'news_reactions') as $reaction) : ?>
                                                        <span class="reaction-item"><?= $reaction->reaction_type . ' ' . $reaction->total; ?></span>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>

                                            <?php if ($wall['can_comment']) : ?>
                                                <a href="#" class="btn-toggle-comments">
                                                    <?= getEduAppGTLang('show_comments'); ?> (<?= count($comments); ?>)
                                                    <span class="arrow">▼</span>
                                                </a>
                                            <?php endif; ?>
                                    </div>

                                        <!-- Comments -->
                                        <div class="post-comments-section">
                                            <ul class="comments-list" style="display:none;">
                                                <?php foreach ($comments as $comment) : ?>
                                                    <li>
                                                        <strong><?= getUserIcon($comment['student_id'], $comment['teacher_id'], $comment['admin_id']) ?><?= $comment['first_name']; ?></strong>
                                                        <span><?= $comment['comments']; ?></span>
                                                        <small><?= timeElapsed($comment['created_at']); ?></small>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <?php if ($wall['can_comment']) : ?>
                                            <form class="commentForm">
                                            <input type="hidden" name="id" value="<?= $post_id; ?>">
                                            <input type="hidden" name="table" value="news_comments">
                                            <input type="text" name="comment" class="form-control" placeholder="<?= getEduAppGTLang('write_your_comment'); ?>">
                                            <div class="reaction-wrapper mb-2">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <!-- Tombol SEND -->
                                                    <div>
                                                        <button type="submit" class="btn btn-primary submit-comment">
                                                            <span id="btnText"><?= getEduAppGTLang('send'); ?> <i class="fa fa-paper-plane"></i></span>
                                                            <span id="btnLoading" class="d-none"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                                        </button>
                                                    </div>

                                                    <!-- Tombol REACTION & Daftar Reaction -->
                                                    <?php if (!$hasReacted = hasReacted('news_reactions', $post_id, $this->session->userdata('login_user_id'))) : ?>
                                                        <?php if ($wall['can_reaction']) : ?>
                                                            <div class="text-end" style="min-width: 120px;">
                                                                <button type="button" class="btn btn-primary toggle-reaction mb-2">
                                                                    <?= getEduAppGTLang('reaction'); ?> <i class="fa fa-smile"></i>
                                                                </button>

                                                                <div class="reaction-list" style="display: none;">
                                                                    <?php foreach (getAllReaction() as $reactionIcon) : ?>
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary me-1 mb-1 btn-reaction"
                                                                            data-content-id="<?= $post_id ?>"
                                                                            data-reaction-id="<?= $reactionIcon->reaction_id ?>"
                                                                            data-table="news_reactions">
                                                                            <?= $reactionIcon->reaction_type ?>
                                                                        </button>
                                                                    <?php endforeach; ?>
                                                                </div>

                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </form>
                                        <?php endif; ?>
                                </div>
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
                                                $news_code = $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->news_code;
                                                $news_embed = $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->embed;
                                                $admin_id = $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->admin_id; ?>
                                                <article class="hentry post has-post-thumbnail thumb-full-width">
                                                    <div class="post__author author vcard inline-items">
                                                        <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_photo/complete/<?php echo base64_encode($this->crud->get_image_url('admin', $admin_id)); ?>');">
                                                            <img src="<?php echo $this->crud->get_image_url('admin', $admin_id); ?>">
                                                        </a>

                                                        <div class="author-date">
                                                            <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name('admin', $admin_id); ?></a>
                                                            <div class="post__date">
                                                                <time class="published" style="color: #0084ff;"><?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description; ?></time>
                                                            </div>
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
                                                $news_code = $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->news_code;
                                                $news_embed = $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->embed;
                                                $admin_id = $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->admin_id; ?>
                                                <article class="hentry post has-post-thumbnail thumb-full-width">
                                                    <div class="post__author author vcard inline-items">
                                                        <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_photo/complete/<?php echo base64_encode($this->crud->get_image_url('admin', $admin_id)); ?>');">
                                                            <img src="<?php echo $this->crud->get_image_url('admin', $admin_id); ?>">
                                                        </a>

                                                        <div class="author-date">
                                                            <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name('admin', $admin_id); ?></a>
                                                            <div class="post__date">
                                                                <time class="published" style="color: #0084ff;"><?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description; ?></time>
                                                            </div>
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
                                        <?php if ($wall['wall_type'] == 'homework' && $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->status == 1) : 
                                            $post_id= $wall['homework_id'];
                                            $comments = getComments($post_id, 'homework_comments');
                                            ?>
                                            <?php $this->academic->setRead($wall['homework_id'], 'homework', $ex[2]); ?>
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
                                                    </div>
                                                        <div class="cta-content">
                                                            <div class="highlight-header morado"><?php echo $row['name']; ?></div>
                                                            <div class="grado">
                                                                <?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"
                                                            </div>
                                                            <h3 class="cta-header"><?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->title; ?></h3>
                                                            <div class="descripcion">
                                                                 <?php if(!empty($wall['post_content'])) : ?>
                                                                    <iframe class="summernote-preview" srcdoc="<?= htmlspecialchars($wall['post_content']); ?>"></iframe>
                                                                <?php endif; ?>
                                                                <br>
                                                                <?php if ($this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->media_type == 1) : ?>
                                                                    <video src="<?php echo base_url(); ?>public/uploads/homework/video/<?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->homework_code; ?>.mp4" controls type="video/mp4" style="width: auto; max-width:100%;"></video>
                                                                <?php elseif ($this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->media_type == 2) : ?>
                                                                    <audio controls type="video/mp3">
                                                                        <source src="<?php echo base_url(); ?>public/uploads/homework/audio/<?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->homework_code; ?>.mp3" type="audio/mpeg">
                                                                    </audio>
                                                                <?php endif; ?>
                                                            </div>
                                                            <?php if($wall['post_file']){ ?>
                                                                <div class="table-responsive">
                                                                <table class="table table-down">
                                                                    <tbody>
                                                                        <tr class="trdhs">
                                                                            <td class="text-left cell-with-media">
                                                                                <?php if($wall['post_file'] != '') { ?>
                                                                                <a href="<?php echo base_url() . 'public/homework/' . $wall['post_file']; ?>"><i class="picons-thin-icon-thin-0111_folder_files_documents px16 text-white"></i> <span><?php echo $wall['post_file']; ?></span></a>
                                                                                <?php } ?>
                                                                                
                                                                            </td>
                                                                            <td class="text-center bolder">
                                                                                <?php if($wall['post_file'] != '') { ?>
                                                                                <a href="<?php echo base_url() . 'public/homework/' . $wall['post_file']; ?>"><i class="picons-thin-icon-thin-0121_download_file px16 text-white"></i></a>
                                                                                <?php } ?>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                                <?php } ?>
                                                            <div class="deadtime">
                                                                <span><?php echo getEduAppGTLang('date'); ?>:</span><i class="picons-thin-icon-thin-0027_stopwatch_timer_running_time"></i><?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->date_end; ?> @ <?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->time_end; ?>
                                                            </div>
                                                            <a href="<?php echo base_url(); ?>student/homeworkroom/<?php echo $this->db->get_where('homework', array('homework_id' => $wall['homework_id']))->row()->homework_code; ?>/"><button class="btn btn-rounded btn-posts"><i class="picons-thin-icon-thin-0100_to_do_list_reminder_done"></i> <?php echo getEduAppGTLang('view_homework'); ?></button></a>
                                                        </div>
                                                        <div class="col-md-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex gap-2">
                                                <?php if ($wall['can_reaction']) : ?>
                                                    <?php foreach (countReaction($post_id, 'homework_reactions') as $reaction) : ?>
                                                        <span class="reaction-item"><?= $reaction->reaction_type . ' ' . $reaction->total; ?></span>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>

                                            <?php if ($wall['can_comment']) : ?>
                                                <a href="#" class="btn-toggle-comments">
                                                    <?= getEduAppGTLang('show_comments'); ?> (<?= count($comments); ?>)
                                                    <span class="arrow">▼</span>
                                                </a>
                                            <?php endif; ?>
                                    </div>

                                        <!-- Comments -->
                                        <div class="post-comments-section">
                                            <ul class="comments-list" style="display:none;">
                                                <?php foreach ($comments as $comment) : ?>
                                                    <li>
                                                        <strong><?= getUserIcon($comment['student_id'], $comment['teacher_id'], $comment['admin_id']) ?><?= $comment['first_name']; ?></strong>
                                                        <span><?= $comment['comments']; ?></span>
                                                        <small><?= timeElapsed($comment['created_at']); ?></small>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <?php if ($wall['can_comment']) : ?>
                                            <form class="commentForm">
                                            <input type="hidden" name="id" value="<?= $post_id; ?>">
                                            <input type="hidden" name="table" value="homework_comments">
                                            <input type="text" name="comment" class="form-control" placeholder="<?= getEduAppGTLang('write_your_comment'); ?>">
                                            <div class="reaction-wrapper mb-2">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <!-- Tombol SEND -->
                                                    <div>
                                                        <button type="submit" class="btn btn-primary submit-comment">
                                                            <span id="btnText"><?= getEduAppGTLang('send'); ?> <i class="fa fa-paper-plane"></i></span>
                                                            <span id="btnLoading" class="d-none"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                                        </button>
                                                    </div>

                                                    <!-- Tombol REACTION & Daftar Reaction -->
                                                    <?php if (!$hasReacted = hasReacted('homework_reactions', $post_id, $this->session->userdata('login_user_id'))) : ?>
                                                        <?php if ($wall['can_reaction']) : ?>
                                                            <div class="text-end" style="min-width: 120px;">
                                                                <button type="button" class="btn btn-primary toggle-reaction mb-2">
                                                                    <?= getEduAppGTLang('reaction'); ?> <i class="fa fa-smile"></i>
                                                                </button>

                                                                <div class="reaction-list" style="display: none;">
                                                                    <?php foreach (getAllReaction() as $reactionIcon) : ?>
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary me-1 mb-1 btn-reaction"
                                                                            data-content-id="<?= $post_id ?>"
                                                                            data-reaction-id="<?= $reactionIcon->reaction_id ?>"
                                                                            data-table="homework_reactions">
                                                                            <?= $reactionIcon->reaction_type ?>
                                                                        </button>
                                                                    <?php endforeach; ?>
                                                                </div>

                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </form>
                                        <?php endif; ?>
                                </div>
                                                    <div class="control-block-button post-control-button">
                                                        <a href="javascript:void(0);" class="btn btn-control featured-post grbg22" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('homework'); ?>">
                                                            <i class="picons-thin-icon-thin-0004_pencil_ruler_drawing"></i>
                                                        </a>
                                                    </div>
                                                    <br><br><br>
                                                </article>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($wall['wall_type'] == 'polls') : ?>
                                            <?php echo form_open(base_url() . 'student/polls/response/', array('enctype' => 'multipart/form-data')); ?>
                                            <?php
                                            $usrdb = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->user;
                                            $poll_code = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->poll_code;
                                            $admin_id = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->admin_id;
                                            $options = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->options;
                                            ?>
                                            <?php if ($usrdb == 'student' || $usrdb == 'all') : ?>
                                                <?php
                                                $type = 'student';
                                                $id = $this->session->userdata('login_user_id');
                                                $user = $type . "-" . $id;
                                                $query = $this->db->get_where('poll_response', array('poll_code' => $poll_code, 'user' => $user));
                                                ?>
                                                <?php if ($query->num_rows() <= 0) : ?>
                                                    <div class="ui-block paddingtel">
                                                        <input type="hidden" name="poll_code" id="poll_code" value="<?php echo $poll_code; ?>">
                                                        <article class="hentry post">
                                                            <div class="post__author author vcard inline-items">
                                                                <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_photo/complete/<?php echo base64_encode($this->crud->get_image_url('admin', $admin_id)); ?>');">
                                                                    <img src="<?php echo $this->crud->get_image_url('admin', $admin_id); ?>" alt="author">
                                                                </a>

                                                                <div class="author-date">
                                                                    <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name('admin', $admin_id); ?></a>
                                                                    <div class="post__date">
                                                                        <time class="published" style="color: #0084ff;"><?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description; ?></time>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="control-block-button post-control-button">
                                                                <a href="javascript:void(0);" class="btn btn-control" style="background-color:#99bf2d; color:#fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('polls'); ?>">
                                                                    <i class="picons-thin-icon-thin-0385_graph_pie_chart_statistics"></i>
                                                                </a>
                                                            </div>
                                                            <ul class="widget w-pool">
                                                                <li>
                                                                    <h4><?php echo $wall['description']; ?></h4>
                                                                </li><br>
                                                                <?php
                                                                $array = (explode(',', $options));
                                                                for ($i = 0; $i < count($array) - 1; $i++) :
                                                                ?>
                                                                    <li>
                                                                        <div class="skills-item">
                                                                            <div class="skills-item-info">
                                                                                <span class="skills-item-title">
                                                                                    <span class="radio">
                                                                                        <h6><label>
                                                                                                <input type="radio" id="answer" name="answer<?php echo $poll_code; ?>" value="<?php echo $array[$i]; ?>"><span class="circle"></span><span class="check"></span>
                                                                                                <?php echo $array[$i]; ?>
                                                                                            </label></h6>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                <?php endfor; ?>
                                                            </ul>
                                                            <a href="javascript:void(0);" class="btn btn-md-2 btn-border-think custom-color c-grey full-width" onClick="vote('<?php echo $poll_code; ?>')"><?php echo getEduAppGTLang('vote'); ?><div class="ripple-container"></div></a>
                                                        </article>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($query->num_rows() > 0) : ?>
                                                    <div class="ui-block paddingtel">
                                                        <article class="hentry post">
                                                            <div class="post__author author vcard inline-items">
                                                                <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_photo/complete/<?php echo base64_encode($this->crud->get_image_url('admin', $admin_id)); ?>');">
                                                                    <img src="<?php echo $this->crud->get_image_url('admin', $admin_id); ?>">
                                                                </a>

                                                                <div class="author-date">
                                                                    <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name('admin', $admin_id); ?></a>
                                                                    <div class="post__date">
                                                                        <time class="published" style="color: #0084ff;"><?php echo $this->db->get_where('settings', array('type' => 'system_title'))->row()->description; ?>
                                                                        </time>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="control-block-button post-control-button">
                                                                <a href="javascript:void(0);" class="btn btn-control" style="background-color:#99bf2d; color:#fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('polls'); ?>">
                                                                    <i class="picons-thin-icon-thin-0385_graph_pie_chart_statistics"></i>
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <ul class="widget w-pool">
                                                                    <li>
                                                                        <h4><?php echo $wall['description']; ?></h4>
                                                                    </li><br>
                                                                    <?php
                                                                    $this->db->where('poll_code', $poll_code);
                                                                    $polls = $this->db->count_all_results('poll_response');
                                                                    $array = (explode(',', $options));
                                                                    $questions = count($array) - 1;
                                                                    $op = 0;
                                                                    for ($i = 0; $i < count($array) - 1; $i++) :
                                                                    ?>
                                                                        <?php
                                                                        $this->db->group_by('poll_code');
                                                                        $po = $this->db->get_where('poll_response', array('poll_code' => $poll_code))->result_array();
                                                                        foreach ($po as $p) :
                                                                        ?>
                                                                            <li>
                                                                                <div class="skills-item">
                                                                                    <div class="skills-item-info">
                                                                                        <span class="skills-item-title">
                                                                                            <?php
                                                                                            $this->db->where('answer', $array[$i]);
                                                                                            $res = $this->db->count_all_results('poll_response');
                                                                                            ?>
                                                                                            <h6><label><?php echo $array[$i]; ?></label></h6>
                                                                                        </span>
                                                                                        <?php
                                                                                        $response = $res / $polls;
                                                                                        $response2 = $response * 100;
                                                                                        ?>
                                                                                        <span class="skills-item-count">
                                                                                            <span class="count-animate" data-speed="1000" data-refresh-interval="50" data-to="62" data-from="0"></span>
                                                                                            <span class="units"><?php echo round($response2); ?>/100%</span>
                                                                                        </span>
                                                                                    </div>
                                                                                    <div class="skills-item-meter">
                                                                                        <span class="skills-item-meter-active bg-primary skills-animate" style="width: <?php echo $response2; ?>%; opacity: 1;"></span>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        <?php endforeach; ?>
                                                                    <?php endfor; ?>
                                                                </ul>
                                                            </div>
                                                        </article>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <?php echo form_close(); ?>
                                        <?php endif; ?>
                                        <?php if ($wall['wall_type'] == 'exam' && $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->status != 'pending') : ?>
                                            <?php $this->academic->setRead($wall['homework_id'], 'exam', $ex[2]); ?>
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
                                                    </div>
                                                    <div class="edu-posts cta-with-media verde">
                                                        <div class="cta-content">
                                                            <div class="highlight-header celeste">
                                                                <?php echo $row['name']; ?>
                                                            </div>
                                                            <div class="grado">
                                                                <?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"
                                                            </div>
                                                            <h3 class="cta-header"><?php echo $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->title; ?></h3>
                                                            <div class="descripcion">
                                                                <?php echo html_entity_decode($this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->post_content); ?>
                                                            </div>
                                                            <div class="deadtime">
                                                                <span><?php echo getEduAppGTLang('date'); ?>:</span><i class="picons-thin-icon-thin-0027_stopwatch_timer_running_time"></i><?php echo date('M d, Y', $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->exam_date); ?>
                                                            </div>
                                                            <div class="deadtime">
                                                                <span><?php echo getEduAppGTLang('hour'); ?>:</span><i class="picons-thin-icon-thin-0027_stopwatch_timer_running_time"></i><?php echo $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->time_start . " - " . $this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->time_end; ?>
                                                            </div>
                                                            <div class="deadtime">
                                                                <span><?php echo getEduAppGTLang('duration'); ?>:</span><i class="picons-thin-icon-thin-0026_time_watch_clock"></i><?php $minutes = number_format($this->db->get_where('online_exam', array('online_exam_id' => $wall['homework_id']))->row()->duration / 60, 0);
                                                                                                                                                                                    echo $minutes; ?> mins.
                                                            </div>
                                                            <a href="<?php echo base_url(); ?>student/online_exams/<?php echo $data; ?>/"><button class="btn btn-rounded btn-posts verde"><i class="picons-thin-icon-thin-0014_notebook_paper_todo"></i> <?php echo getEduAppGTLang('go_to_exams'); ?></button></a>
                                                        </div>
                                                    </div>
                                                    <div class="control-block-button post-control-button">
                                                        <a href="javascript:void(0);" class="btn btn-control grbg22" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('online_exams'); ?>">
                                                            <i class="picons-thin-icon-thin-0207_list_checkbox_todo_done"></i>
                                                        </a>
                                                    </div>
                                                    <br><br><br>
                                                </article>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($wall['wall_type'] == 'material') : 
                                            $post_id= $wall['homework_id'];
                                            $comments = getComments($post_id, 'document_comments');
                                            ?>
                                            <?php $this->academic->setRead($wall['homework_id'], 'material', $ex[2]); ?>
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
                                                    </div>
                                                        <div class="cta-content">
                                                            <div class="highlight-header morado">
                                                                <?php echo $row['name']; ?>
                                                            </div>
                                                            <div class="grado">
                                                                <?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"
                                                            </div>
                                                            <h3 class="cta-header"><?php echo getEduAppGTLang('study_material'); ?></h3>
                                                             <?php if(!empty($wall['post_content'])) : ?>
                                                        <iframe class="summernote-preview" srcdoc="<?= htmlspecialchars($wall['post_content']); ?>"></iframe>
                                                    <?php endif; ?>
                                                            <?php if($wall['post_file']){ ?>
                                                                <div class="table-responsive">
                                                                <table class="table table-down">
                                                                    <tbody>
                                                                        <tr class="trdhs">
                                                                            <td class="text-left cell-with-media">
                                                                                <?php if($wall['post_file'] != '') { ?>
                                                                                <a href="<?php echo base_url() . 'public/material/' . $wall['post_file']; ?>"><i class="picons-thin-icon-thin-0111_folder_files_documents px16 text-white"></i> <span><?php echo $wall['post_file']; ?></span></a>
                                                                                <?php } ?>
                                                                                
                                                                            </td>
                                                                            <td class="text-center bolder">
                                                                                <?php if($wall['post_file'] != '') { ?>
                                                                                <a href="<?php echo base_url() . 'public/material/' . $wall['post_file']; ?>"><i class="picons-thin-icon-thin-0121_download_file px16 text-white"></i></a>
                                                                                <?php } ?>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                                <?php } ?>
                                                        </div>
                                                    <div class="col-md-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex gap-2">
                                                <?php if ($wall['can_reaction']) : ?>
                                                    <?php foreach (countReaction($post_id, 'document_reactions') as $reaction) : ?>
                                                        <span class="reaction-item"><?= $reaction->reaction_type . ' ' . $reaction->total; ?></span>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>

                                            <?php if ($wall['can_comment']) : ?>
                                                <a href="#" class="btn-toggle-comments">
                                                    <?= getEduAppGTLang('show_comments'); ?> (<?= count($comments); ?>)
                                                    <span class="arrow">▼</span>
                                                </a>
                                            <?php endif; ?>
                                    </div>

                                        <!-- Comments -->
                                        <div class="post-comments-section">
                                            <ul class="comments-list" style="display:none;">
                                                <?php foreach ($comments as $comment) : ?>
                                                    <li>
                                                        <strong><?= getUserIcon($comment['student_id'], $comment['teacher_id'], $comment['admin_id']) ?><?= $comment['first_name']; ?></strong>
                                                        <span><?= $comment['comments']; ?></span>
                                                        <small><?= timeElapsed($comment['created_at']); ?></small>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <?php if ($wall['can_comment']) : ?>
                                            <form class="commentForm">
                                            <input type="hidden" name="id" value="<?= $post_id; ?>">
                                            <input type="hidden" name="table" value="document_comments">
                                            <input type="text" name="comment" class="form-control" placeholder="<?= getEduAppGTLang('write_your_comment'); ?>">
                                            <div class="reaction-wrapper mb-2">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <!-- Tombol SEND -->
                                                    <div>
                                                        <button type="submit" class="btn btn-primary submit-comment">
                                                            <span id="btnText"><?= getEduAppGTLang('send'); ?> <i class="fa fa-paper-plane"></i></span>
                                                            <span id="btnLoading" class="d-none"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                                        </button>
                                                    </div>

                                                    <!-- Tombol REACTION & Daftar Reaction -->
                                                    <?php if (!$hasReacted = hasReacted('document_reactions', $post_id, $this->session->userdata('login_user_id'))) : ?>
                                                        <?php if ($wall['can_reaction']) : ?>
                                                            <div class="text-end" style="min-width: 120px;">
                                                                <button type="button" class="btn btn-primary toggle-reaction mb-2">
                                                                    <?= getEduAppGTLang('reaction'); ?> <i class="fa fa-smile"></i>
                                                                </button>

                                                                <div class="reaction-list" style="display: none;">
                                                                    <?php foreach (getAllReaction() as $reactionIcon) : ?>
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary me-1 mb-1 btn-reaction"
                                                                            data-content-id="<?= $post_id ?>"
                                                                            data-reaction-id="<?= $reactionIcon->reaction_id ?>"
                                                                            data-table="document_reactions">
                                                                            <?= $reactionIcon->reaction_type ?>
                                                                        </button>
                                                                    <?php endforeach; ?>
                                                                </div>

                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </form>
                                        <?php endif; ?>
                                </div>
                                                    <div class="control-block-button post-control-button">
                                                        <a href="javascript:void(0);" class="btn btn-control mdl-header text-white" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('study_material'); ?>">
                                                            <i class="picons-thin-icon-thin-0003_write_pencil_new_edit"></i>
                                                        </a>
                                                    </div>
                                                    <br><br><br>
                                                </article>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($wall['wall_type'] == 'forum' && $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->post_status == 1) : 
                                             $post_id= $wall['homework_id'];
                                            $comments = getComments($post_id, 'forum_comments');
                                            ?>
                                            <?php $this->academic->setRead($wall['homework_id'], 'forum', $ex[2]); ?>
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
                                                    </div>
                                                        <div class="cta-content">
                                                            <div class="highlight-header yellow">
                                                                <?php echo $row['name']; ?>
                                                            </div>
                                                            <div class="grado">
                                                                <?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"
                                                            </div>
                                                            <h3 class="cta-header"><?php echo $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->title; ?></h3>
                                                             <?php if(!empty($wall['post_content'])) : ?>
                                                        <iframe class="summernote-preview" srcdoc="<?= htmlspecialchars($wall['post_content']); ?>"></iframe>
                                                    <?php endif; ?>
                                                            <?php if($wall['post_file']){?>
                                                                <div class="table-responsive">
                                                                <table class="table table-down">
                                                                    <tbody>
                                                                        <tr class="trdhs">
                                                                            <td class="text-left cell-with-media">
                                                                                <?php if($wall['post_file'] != '') { ?>
                                                                                <a href="<?php echo base_url() . 'public/forum/' . $wall['post_file']; ?>"><i class="picons-thin-icon-thin-0111_folder_files_documents px16 text-white"></i> <span><?php echo $wall['post_file']; ?></span></a>
                                                                                <?php } ?>
                                                                                
                                                                            </td>
                                                                            <td class="text-center bolder">
                                                                                <?php if($wall['post_file'] != '') { ?>
                                                                                <a href="<?php echo base_url() . 'public/forum/' . $wall['post_file']; ?>"><i class="picons-thin-icon-thin-0121_download_file px16 text-white"></i></a>
                                                                                <?php } ?>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <?php } ?>
                                                            <a href="<?php echo base_url(); ?>student/forumroom/<?php echo $this->db->get_where('forum', array('post_id' => $wall['homework_id']))->row()->post_code; ?>/"><button class="btn btn-rounded btn-posts"><i class="picons-thin-icon-thin-0014_notebook_paper_todo"></i> <?php echo getEduAppGTLang('view_forum'); ?></button></a>
                                                        </div>
                                                    <div class="col-md-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex gap-2">
                                                <?php if ($wall['can_reaction']) : ?>
                                                    <?php foreach (countReaction($post_id, 'forum_reactions') as $reaction) : ?>
                                                        <span class="reaction-item"><?= $reaction->reaction_type . ' ' . $reaction->total; ?></span>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>

                                            <?php if ($wall['can_comment']) : ?>
                                                <a href="#" class="btn-toggle-comments">
                                                    <?= getEduAppGTLang('show_comments'); ?> (<?= count($comments); ?>)
                                                    <span class="arrow">▼</span>
                                                </a>
                                            <?php endif; ?>
                                    </div>

                                        <!-- Comments -->
                                        <div class="post-comments-section">
                                            <ul class="comments-list" style="display:none;">
                                                <?php foreach ($comments as $comment) : ?>
                                                    <li>
                                                        <strong><?= getUserIcon($comment['student_id'], $comment['teacher_id'], $comment['admin_id']) ?><?= $comment['first_name']; ?></strong>
                                                        <span><?= $comment['comments']; ?></span>
                                                        <small><?= timeElapsed($comment['created_at']); ?></small>
                                                    </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <?php if ($wall['can_comment']) : ?>
                                            <form class="commentForm">
                                            <input type="hidden" name="id" value="<?= $post_id; ?>">
                                            <input type="hidden" name="table" value="forum_comments">
                                            <input type="text" name="comment" class="form-control" placeholder="<?= getEduAppGTLang('write_your_comment'); ?>">
                                            <div class="reaction-wrapper mb-2">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <!-- Tombol SEND -->
                                                    <div>
                                                        <button type="submit" class="btn btn-primary submit-comment">
                                                            <span id="btnText"><?= getEduAppGTLang('send'); ?> <i class="fa fa-paper-plane"></i></span>
                                                            <span id="btnLoading" class="d-none"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                                        </button>
                                                    </div>

                                                    <!-- Tombol REACTION & Daftar Reaction -->
                                                    <?php if (!$hasReacted = hasReacted('forum_reactions', $post_id, $this->session->userdata('login_user_id'))) : ?>
                                                        <?php if ($wall['can_reaction']) : ?>
                                                            <div class="text-end" style="min-width: 120px;">
                                                                <button type="button" class="btn btn-primary toggle-reaction mb-2">
                                                                    <?= getEduAppGTLang('reaction'); ?> <i class="fa fa-smile"></i>
                                                                </button>

                                                                <div class="reaction-list" style="display: none;">
                                                                    <?php foreach (getAllReaction() as $reactionIcon) : ?>
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary me-1 mb-1 btn-reaction"
                                                                            data-content-id="<?= $post_id ?>"
                                                                            data-reaction-id="<?= $reactionIcon->reaction_id ?>"
                                                                            data-table="forum_reactions">
                                                                            <?= $reactionIcon->reaction_type ?>
                                                                        </button>
                                                                    <?php endforeach; ?>
                                                                </div>

                                                            </div>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </form>
                                        <?php endif; ?>
                                </div>
                                                    <div class="control-block-button post-control-button">
                                                        <a href="javascript:void(0);" class="btn btn-control crlt2" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('forum'); ?>">
                                                            <i class="picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i>
                                                        </a>
                                                    </div>
                                                    <br><br><br>
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
                                    <div class="ui-block paddingtel lined-danger">
                                        <div class="ui-block-title">
                                            <h6 class="title"><?php echo getEduAppGTLang('make_your_attendance'); ?></h6>
                                        </div>
                                        <div class="ui-block-content">
                                            <div class="widget w-about" style="text-align:center">
                                                <?php
                                                $tmst = strtotime(date('d-m-Y'));
                                                $query = $this->db->get_where('attendance', array(
                                                    'class_id' => $ex[0],
                                                    'section_id' => $ex[1],
                                                    'subject_id' => $ex[2],
                                                    'year' => $running_year,
                                                    'timestamp' => $tmst
                                                ));
                                                ?>
                                                <a href="javascript:void(0);" class="logo"><img src="<?php echo @$this->crud->attendanceQR($this->session->userdata('login_user_id'), $ex[2]); ?>" width="100px"></a>
                                                <h6><a href="javascript:void(0);"> <?php echo getEduAppGTLang('scan_qr_to_make_your_daily_attendance'); ?></a></h6>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui-block paddingtel lined-danger">
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
                                        $this->db->group_by('type');
                                        $notifications = $this->db->get_where('notification', array('class_id' => $ex[0], 'subject_id' => $ex[2], 'year' => $running_year));
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
                                                 if (!isStudentActiveEnroll($row2['student_id'], $ex[0], $ex[1], $running_year)) {
                                                    continue;
                                                }
                                                if (isStudentFinishSubject($row2['student_id'], $ex[2])) {
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
<?php endforeach; ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.btn-toggle-comments');

            toggleButtons.forEach(function(btn) {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();

                    // Ambil elemen .post-comments-section setelah tombol ini
                    const postSection = btn.closest('.d-flex').nextElementSibling;
                    const commentList = postSection.querySelector('.comments-list');

                    const isVisible = commentList.style.display === 'block';

                    commentList.style.display = isVisible ? 'none' : 'block';
                    btn.innerHTML = isVisible ?
                        'Show Comments <span class="arrow">▼</span>' :
                        'Hide Comments <span class="arrow">▲</span>';
                });
            });
            document.querySelectorAll('.toggle-reaction').forEach(function(button) {
                button.addEventListener('click', function() {
                    const wrapper = this.closest('.reaction-wrapper');
                    const reactionList = wrapper.querySelector('.reaction-list');
                    if (reactionList) {
                        reactionList.style.display = reactionList.style.display === 'none' ? 'block' : 'none';
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Init Summernote untuk edit
            $('#edit_post_content').summernote({
                placeholder: 'Write your content here...',
                tabsize: 2,
                height: 250,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear', 'fontsize', 'fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture', 'video', 'emoji']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });
            $('.emoji-insert-edit').on('click', function(e) {
                e.preventDefault();

                var emoji = $(this).data('emoji');
                $('#edit_post_content').summernote('insertText', emoji);
            });
            // Ketika tombol edit diklik
            function decodeHtml(html) {
                var txt = document.createElement("textarea");
                txt.innerHTML = html;
                return txt.value;
            }
            $('.edit-post-btn').on('click', function() {
                let content = $(this).data('content');
                let post_id = $(this).data('id');
                let comment = $(this).data('comment');
                let reaction = $(this).data('reaction');

                $('#edit_post_id').val(post_id);
                $('#edit_post_content').summernote('code', decodeHtml(content));

                $('#edit_can_comment').prop('checked', comment == 1);
                $('#edit_can_reaction').prop('checked', reaction == 1);
            });
        });
    </script>
        <script>
$(document).ready(function () {
    $('.btn-reaction').on('click', function () {
        const contentId = $(this).data('content-id');
        const reactionId = $(this).data('reaction-id');
        const table = $(this).data('table');

        // Tampilkan loader
        $('#reaction-loader').show();

        $.ajax({
            url: "<?= base_url('home/reaction') ?>",
            type: "POST",
            data: {
                'content$content_id': contentId,
                'reaction_id': reactionId,
                'table': table
            },
            dataType: 'json',
            success: function (response) {
                $('#reaction-loader').hide();
                if (response.status === 'success') {
                    toastr.success(response.messages);
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    toastr.error(response.messages || 'Give Reaction Failed.');
                }
            },
            error: function () {
                $('#reaction-loader').hide();
                toastr.error('Terjadi kesalahan saat mengirim reaksi.');
            }
        });
    });
});
</script>

<script>
$(document).ready(function() {
    $(document).on('submit', '.commentForm', function (e) {
        e.preventDefault();

        // Tombol loading aktif
        $('.submit-comment').prop('disabled', true);
        $('#btnText').addClass('d-none');
        $('#btnLoading').removeClass('d-none');

        $.ajax({
            url: "<?= base_url('home/comment'); ?>",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            success: function(response) {
                if (response.status === 'Success') {
                    toastr.success(response.messages);
                    setTimeout(function() {
                        location.reload();
                    }, 1500);
                } else {
                    toastr.error(response.messages);
                }
            },
            error: function(xhr) {
                alert("Something Wrong: " + xhr.responseText);
            },
            complete: function() {
                // Kembalikan tombol ke normal
                $('.submit-comment').prop('disabled', false);
                $('#btnText').removeClass('d-none');
                $('#btnLoading').addClass('d-none');
            }
        });
    });
});
</script>