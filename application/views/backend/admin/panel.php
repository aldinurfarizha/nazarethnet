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

    .emoji-insert-edit {
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
        all: unset;
        /* Lebih aman daripada all: initial */
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
    <?php include 'fancy.php'; ?>
    <div class="header-spacer"></div>
    <div class="content-i">
        <div class="content-box">
            <div class="conty">
                <div class="row">
                    <main class="col col-xl-6 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                        <div class="ui-block paddingtel">
                            <div class="news-feed-form">
                                <div class="tab-content">
                                    <div class="edu-wall-content container" id="new_post" style="background: #f9f9fb; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
                                        <div class="row align-items-center p-3">
                                            <div class="col-auto pr-0">
                                                <a href="javascript:void(0)" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_photo/complete/<?php echo base64_encode($this->crud->get_image_url('admin', $this->session->userdata('login_user_id'))); ?>');">
                                                    <img src="<?php echo $this->crud->get_image_url('admin', $this->session->userdata('login_user_id')); ?>" alt="Profile" style="width:50px; height:50px; border-radius:50%; object-fit:cover; border: 2px solid #e5e5e5;">
                                                </a>
                                            </div>
                                            <div class="col">
                                                <h6 class="mb-1" style="font-weight:600; color:#333;"><?php echo $this->crud->get_name('admin', $this->session->userdata('login_user_id')); ?></h6>
                                                <small class="text-muted"><?php echo getEduAppGTLang('ready_to_post_something'); ?> ?</small>
                                            </div>
                                            <div class="col-auto">
                                                <button class="btn btn-success btn-rounded" type="button" data-toggle="modal" data-target="#add_conferences" style="padding: 8px 20px; font-weight: 500; transition: 0.3s;">
                                                    <i class="fa fa-pencil-alt mr-1"></i> <?= getEduAppGTLang('create_post'); ?>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <img id="logoPreview" src="" alt="Preview" style="display:none; max-width:100%; border-radius:10px; border:2px solid #eee; padding:5px; margin:15px 0;" />
                                        </div>
                                    </div>
                                    <div class="edu-wall-content ng-scope hidde" id="new_video">
                                        <div class="tab-pane show">
                                            <?php echo form_open(base_url() . 'admin/news/create_video/', array('enctype' => 'multipart/form-data')); ?>
                                            <input type="hidden" name="embed" id="embed">
                                            <div class="author-thumb pdright15">
                                                <img src="<?php echo $this->crud->get_image_url('admin', $this->session->userdata('login_user_id')); ?>" class="imgwidth">
                                            </div>
                                            <div class="form-group with-icon label-floating is-empty leftp10">
                                                <textarea onkeyup="textAreaAdjust(this)" class="form-control no-over" placeholder="<?php echo getEduAppGTLang('hi'); ?> <?php echo $this->db->get_where('admin', array('admin_id' => $this->session->userdata('login_user_id')))->row()->first_name; ?> <?php echo getEduAppGTLang('what_publish'); ?>" name="description" required=""></textarea>
                                                <span class="material-input"></span>
                                            </div>
                                            <div class="form-group btmmin15">
                                                <input type="text" name="url" id="url" class="form-control" placeholder="YouTube URL" onchange="set_video()">
                                            </div><br>
                                            <pre class="text-center hidde" id="myCode"></pre>
                                            <div class="add-options-message btm-post edupostfoot edu-wall-actions wallpd">
                                                <a href="javascript:void(0);" class="options-message" onclick="post()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('news'); ?>">
                                                    <i class="os-icon picons-thin-icon-thin-0032_flag"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="options-message" onclick="poll()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('polls'); ?>">
                                                    <i class="os-icon picons-thin-icon-thin-0385_graph_pie_chart_statistics"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="options-message" onclick="vimeo()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('vimeo_video'); ?>">
                                                    <i class="ti-vimeo-alt"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="options-message" onclick="video()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('youtube_video'); ?>">
                                                    <i class="os-icon picons-thin-icon-thin-0593_video_play_youtube"></i>
                                                </a>
                                                <button class="btn btn-rounded btn-edu pull-righ"><i class="picons-thin-icon-thin-0317_send_post_paper_plane px12"></i> <?php echo getEduAppGTLang('publish'); ?></button>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                    <div class="edu-wall-content ng-scope" id="new_vimeo" style="display: none;">
                                        <div class="tab-pane show">
                                            <?php echo form_open(base_url() . 'admin/news/create_vimeo/', array('enctype' => 'multipart/form-data')); ?>
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
                                                <a href="javascript:void(0);" class="options-message" onclick="vimeo()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('vimeo_video'); ?>">
                                                    <i class="ti-vimeo-alt"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="options-message" onclick="video()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('youtube_video'); ?>">
                                                    <i class="os-icon picons-thin-icon-thin-0593_video_play_youtube"></i>
                                                </a>
                                                <button class="btn btn-rounded btn-success" style="float:right"><i class="picons-thin-icon-thin-0317_send_post_paper_plane" style="font-size:12px"></i> <?php echo getEduAppGTLang('publish'); ?></button>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div>
                                    </div>
                                    <div class="edu-wall-content ng-scope hidde" id="new_poll">
                                        <?php echo form_open(base_url() . 'admin/polls/create/', array('enctype' => 'multipart/form-data')); ?>
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
                                                                <option value="all"><?php echo getEduAppGTLang('all'); ?></option>
                                                                <option value="admin"><?php echo getEduAppGTLang('admins'); ?></option>
                                                                <option value="student"><?php echo getEduAppGTLang('students'); ?></option>
                                                                <option value="parent"><?php echo getEduAppGTLang('parents'); ?></option>
                                                                <option value="teacher"><?php echo getEduAppGTLang('teachers'); ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="add-options-message btm-post edupostfoot edu-wall-actions wallpd">
                                                <a href="javascript:void(0);" class="options-message" onclick="post()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('news'); ?>">
                                                    <i class="os-icon picons-thin-icon-thin-0032_flag"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="options-message" onclick="poll()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('poll'); ?>">
                                                    <i class="os-icon picons-thin-icon-thin-0385_graph_pie_chart_statistics"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="options-message" onclick="vimeo()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('vimeo_video'); ?>">
                                                    <i class="ti-vimeo-alt"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="options-message" onclick="video()" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('youtube_video'); ?>">
                                                    <i class="os-icon picons-thin-icon-thin-0593_video_play_youtube"></i>
                                                </a>
                                                <button class="btn btn-rounded btn-edu pull-right"><i class="picons-thin-icon-thin-0317_send_post_paper_plane px12"></i> <?php echo getEduAppGTLang('publish'); ?></button>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="panel">
                            <?php
                            $db = $this->db->query('SELECT can_comment, can_reaction, post_file, post_file_type, post_content, description, publish_date, type,news_id FROM news WHERE class_id = 0 AND section_id = 0 AND subject_id = 0 UNION SELECT can_comment, can_reaction, post_file, post_file_type, post_content,question,publish_date,type,id FROM polls WHERE class_id = 0 AND section_id = 0 AND subject_id = 0 ORDER BY publish_date DESC')->result_array();
                            foreach ($db as $wall):
                                $this->crud->setRead($wall['news_id']);
                            ?>
                                <?php if ($wall['type'] == 'news'): ?>
                                    <?php
                                    $news_id = $wall['news_id'];
                                    $news = $this->db->get_where('news', ['news_id' => $news_id])->row();
                                    $news_code = $news->news_code;
                                    $admin_id = $this->session->userdata('login_user_id');
                                    $user_type = 'admin';
                                    $comments = getComments($news_id, 'news_comments');
                                    $post_id = $news_id;
                                    ?>
                                    <div class="ui-block paddingtel">
                                        <article class="hentry post has-post-thumbnail thumb-full-width">
                                            <!-- Author Info -->
                                            <div class="post__author author vcard inline-items">
                                                <a href="javascript:void(0)" onclick="showAjaxModal('<?= base_url(); ?>modal/popup/modal_photo/complete/<?= base64_encode($this->crud->get_image_url($user_type, $admin_id)); ?>');">
                                                    <img src="<?= $this->crud->get_image_url($user_type, $admin_id); ?>">
                                                </a>
                                                <div class="author-date">
                                                    <a class="h6 post__author-name fn" href="javascript:void(0);"><?= $this->crud->get_name('admin', $admin_id); ?></a>
                                                    <div class="post__date">
                                                        <time class="published" style="color: #0084ff;">
                                                            <?= $this->db->get_where('settings', ['type' => 'system_title'])->row()->description; ?>
                                                        </time>
                                                    </div>
                                                </div>
                                                <div class="more">
                                                    <i class="icon-options"></i>
                                                    <ul class="more-dropdown">
                                                        <li>
                                                            <button
                                                                type="button"
                                                                class="btn btn-sm btn-primary edit-post-btn"
                                                                data-id="<?= $news_id ?>"
                                                                data-content="<?= htmlspecialchars($wall['post_content'], ENT_QUOTES, 'UTF-8') ?>"
                                                                data-comment="<?= $wall['can_comment'] ?>"
                                                                data-reaction="<?= $wall['can_reaction'] ?>"
                                                                data-toggle="modal"
                                                                data-target="#editPostModal">Edit Post</button>
                                                        </li>
                                                        <li>
                                                            <a href="<?= base_url("admin/news/delete/$news_code"); ?>" onclick="return confirm('<?= getEduAppGTLang('confirm_delete'); ?>')">
                                                                <?= getEduAppGTLang('delete'); ?>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <!-- Post Content -->
                                            <hr>
                                            <?php if (!empty($wall['post_content'])) : ?>
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



                                            <!-- Footer Icon -->
                                            <div class="control-block-button post-control-button">
                                                <a href="javascript:void(0);" class="btn btn-control" style="background-color:#001b3d; color:#fff;" data-toggle="tooltip" data-placement="top" title="<?= getEduAppGTLang('news'); ?>">
                                                    <i class="picons-thin-icon-thin-0032_flag"></i>
                                                </a>
                                            </div>
                                        </article>
                                    </div>
                                <?php endif; ?>
                                <?php if ($wall['type'] == 'video'): ?>
                                    <div class="ui-block paddingtel">
                                        <?php
                                        $news_code = $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->news_code;
                                        $news_embed = $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->embed;
                                        $admin_id = $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->admin_id; ?>
                                        <article class="hentry post has-post-thumbnail thumb-full-width">
                                            <div class="post__author author vcard inline-items">
                                                <img src="<?php echo $this->crud->get_image_url('admin', $admin_id); ?>">
                                                <div class="author-date">
                                                    <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name('admin', $admin_id); ?></a>
                                                    <div class="post__date">
                                                        <time class="published btcolor"><?php echo $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->date . " " . $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->date2; ?></time>
                                                    </div>
                                                </div>
                                                <div class="more">
                                                    <i class="icon-options"></i>
                                                    <ul class="more-dropdown">
                                                        <li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_wall/<?php echo $news_code; ?>');"><?php echo getEduAppGTLang('edit'); ?></a></li>
                                                        <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/news/delete/<?php echo $news_code; ?>"><?php echo getEduAppGTLang('delete'); ?></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <hr>
                                            <p><?php echo $this->crud->check_text($wall['description']); ?></p>
                                            <div class="post-thumb">
                                                <iframe src="<?php echo $news_embed; ?>" height="360" width="100%" frameborder="0" allowfullscreen=""></iframe>
                                            </div>
                                            <div class="control-block-button post-control-button">
                                                <a href="javascript:void(0);" class="btn btn-control controlsbt" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('news'); ?>">
                                                    <i class="picons-thin-icon-thin-0032_flag"></i>
                                                </a>
                                            </div>
                                            <?php
                                            $checkData = $this->crud->getRead($wall['news_id']);
                                            if (count($checkData) > 0):
                                            ?>
                                                <div class="post-additional-info inline-items">
                                                    <ul class="friends-harmonic">
                                                        <?php foreach ($checkData as $readed): ?>
                                                            <li>
                                                                <a href="javascript:void(0);">
                                                                    <img loading="lazy" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_users/<?php echo $wall['news_id']; ?>');" title="<?php echo $this->crud->get_name($readed['user_type'], $readed['user_id']); ?>" src="<?php echo $this->crud->get_image_url($readed['user_type'], $readed['user_id']); ?>" alt="<?php echo $this->crud->get_name($readed['user_type'], $readed['user_id']); ?>" width="28" height="28">
                                                                </a>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                    <div class="names-people-likes">
                                                        <?php if (count($checkData) > 5): ?>
                                                            <?php echo getEduAppGTLang('and'); ?> <?php echo count($checkData) - 5; ?> <?php echo getEduAppGTLang('other_people_viewed_this_post'); ?>.
                                                        <?php else: ?>
                                                            <?php echo getEduAppGTLang('have_seen_this_post'); ?>.
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="comments-shared">
                                                        <a href="javascript:void(0);" class="post-add-icon inline-items"></a>
                                                        <a href="javascript:void(0);" class="post-add-icon inline-items"></a>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </article>
                                    </div>
                                <?php endif; ?>

                                <?php if ($wall['type'] == 'vimeo'): ?>
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
                                                <div class="more">
                                                    <i class="icon-options"></i>
                                                    <ul class="more-dropdown">
                                                        <li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_wall/<?php echo $news_code; ?>');"><?php echo getEduAppGTLang('edit'); ?></a></li>
                                                        <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/news/delete/<?php echo $news_code; ?>"><?php echo getEduAppGTLang('delete'); ?></a></li>
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

                                <?php if ($wall['type'] == 'polls'): ?>
                                    <?php echo form_open(base_url() . 'admin/polls/response/', array('enctype' => 'multipart/form-data')); ?>
                                    <?php
                                    $usrdb = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->user;
                                    $poll_code = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->poll_code;
                                    $admin_id = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->admin_id;
                                    $options = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->options;
                                    $branch_id = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->branch_id;
                                    ?>
                                    <?php if ($usrdb == 'admin' || $usrdb == 'all'): ?>
                                        <?php
                                        if (isSuperAdmin() == false) {
                                            $my_branch_id = getMyBranchId()->branch_id;
                                            if ($branch_id != $my_branch_id) {
                                                continue;
                                            }
                                        }
                                        $type = 'admin';
                                        $id = $this->session->userdata('login_user_id');
                                        $user = $type . "-" . $id;
                                        $query = $this->db->get_where('poll_response', array('poll_code' => $poll_code, 'user' => $user));
                                        ?>
                                        <?php if ($query->num_rows() <= 0): ?>
                                            <div class="ui-block paddingtel">
                                                <input type="hidden" name="poll_code" id="poll_code" value="<?php echo $poll_code; ?>">
                                                <article class="hentry post">
                                                    <div class="post__author author vcard inline-items">
                                                        <img src="<?php echo $this->crud->get_image_url('admin', $admin_id); ?>" alt="author">
                                                        <div class="author-date">
                                                            <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name('admin', $admin_id); ?></a>
                                                            <div class="post__date">
                                                                <time class="published btcolor"><?php echo $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->date . " " . $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->date2; ?></time>
                                                            </div>
                                                        </div>
                                                        <div class="more">
                                                            <i class="icon-options"></i>
                                                            <ul class="more-dropdown">
                                                                <li><a href="<?php echo base_url(); ?>admin/view_poll/<?php echo $poll_code; ?>/"><?php echo getEduAppGTLang('go_to_details'); ?></a></li>
                                                                <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/polls/delete/<?php echo $poll_code; ?>"><?php echo getEduAppGTLang('delete'); ?></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="control-block-button post-control-button">
                                                        <a href="javascript:void(0);" class="grbg22 btn btn-control" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('polls'); ?>">
                                                            <i class="picons-thin-icon-thin-0385_graph_pie_chart_statistics"></i>
                                                        </a>
                                                    </div>
                                                    <div class="wall-content">
                                                        <ul class="widget w-pool">
                                                            <li>
                                                                <h4><?php echo $wall['description']; ?></h4>
                                                            </li><br>
                                                            <?php
                                                            $array = (explode(',', $options));
                                                            for ($i = 0; $i < count($array) - 1; $i++):
                                                            ?>
                                                                <li>
                                                                    <div class="skills-item">
                                                                        <div class="skills-item-info">
                                                                            <span class="skills-item-title">
                                                                                <span class="radio">
                                                                                    <h6>
                                                                                        <label>
                                                                                            <input type="radio" id="answer" name="answer<?php echo $poll_code; ?>" value="<?php echo $array[$i]; ?>"><span class="circle circlebrd"></span><span class="check"></span>
                                                                                            <?php echo $array[$i]; ?>
                                                                                        </label>
                                                                                    </h6>
                                                                                </span>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            <?php endfor; ?>
                                                        </ul>
                                                        <a href="javascript:void(0);" class="btn btn-md-2 btn-vote text-white btn-border-think custom-color c-grey" onClick="vote('<?php echo $poll_code; ?>')"><?php echo getEduAppGTLang('vote'); ?><div class="ripple-container"></div></a>
                                                    </div>
                                                    <?php
                                                    $checkData = $this->crud->getRead($wall['news_id']);
                                                    if (count($checkData) > 0):
                                                    ?>
                                                        <div class="post-additional-info inline-items">
                                                            <ul class="friends-harmonic">
                                                                <?php foreach ($checkData as $readed): ?>
                                                                    <li>
                                                                        <a href="javascript:void(0);">
                                                                            <img loading="lazy" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_users/<?php echo $wall['news_id']; ?>');" title="<?php echo $this->crud->get_name($readed['user_type'], $readed['user_id']); ?>" src="<?php echo $this->crud->get_image_url($readed['user_type'], $readed['user_id']); ?>" alt="<?php echo $this->crud->get_name($readed['user_type'], $readed['user_id']); ?>" width="28" height="28">
                                                                        </a>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                            <div class="names-people-likes">
                                                                <?php if (count($checkData) > 5): ?>
                                                                    <?php echo getEduAppGTLang('and'); ?> <?php echo count($checkData) - 5; ?> <?php echo getEduAppGTLang('other_people_viewed_this_post'); ?> .
                                                                <?php else: ?>
                                                                    <?php echo getEduAppGTLang('have_seen_this_post'); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="comments-shared">
                                                                <a href="javascript:void(0);" class="post-add-icon inline-items"></a>
                                                                <a href="javascript:void(0);" class="post-add-icon inline-items"></a>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </article>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($query->num_rows() > 0): ?>
                                            <div class="ui-block paddingtel">
                                                <article class="hentry post">
                                                    <div class="post__author author vcard inline-items">
                                                        <img src="<?php echo $this->crud->get_image_url('admin', $admin_id); ?>">
                                                        <div class="author-date">
                                                            <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name('admin', $admin_id); ?></a>
                                                            <div class="post__date">
                                                                <time class="published btcolor"><?php echo $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->date . " " . $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->date2; ?></time>
                                                            </div>
                                                        </div>
                                                        <div class="more">
                                                            <i class="icon-options"></i>
                                                            <ul class="more-dropdown">
                                                                <li><a href="<?php echo base_url(); ?>admin/view_poll/<?php echo $poll_code; ?>/"><?php echo getEduAppGTLang('go_to_details'); ?></a></li>
                                                                <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/polls/delete/<?php echo $poll_code; ?>"><?php echo getEduAppGTLang('delete'); ?></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="control-block-button post-control-button">
                                                        <a href="javascript:void(0);" class="btn btn-control grbg22" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('polls'); ?>">
                                                            <i class="picons-thin-icon-thin-0385_graph_pie_chart_statistics"></i>
                                                        </a>
                                                    </div>
                                                    <div>
                                                        <div class="wall-content">
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
                                                                for ($i = 0; $i < count($array) - 1; $i++):
                                                                ?>
                                                                    <?php
                                                                    $this->db->group_by('poll_code');
                                                                    $po = $this->db->get_where('poll_response', array('poll_code' => $poll_code))->result_array();
                                                                    foreach ($po as $p):
                                                                    ?>
                                                                        <li>
                                                                            <div class="skills-item">
                                                                                <div class="skills-item-info">
                                                                                    <span class="skills-item-title">
                                                                                        <?php
                                                                                        $this->db->where('answer', $array[$i]);
                                                                                        $this->db->where('poll_code', $poll_code);
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
                                                    </div>
                                                    <?php
                                                    $checkData = $this->crud->getRead($wall['news_id']);
                                                    if (count($checkData) > 0): ?>
                                                        <div class="post-additional-info inline-items">
                                                            <ul class="friends-harmonic">
                                                                <?php foreach ($checkData as $readed): ?>
                                                                    <li>
                                                                        <a href="javascript:void(0);">
                                                                            <img loading="lazy" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_users/<?php echo $wall['news_id']; ?>');" title="<?php echo $this->crud->get_name($readed['user_type'], $readed['user_id']); ?>" src="<?php echo $this->crud->get_image_url($readed['user_type'], $readed['user_id']); ?>" alt="<?php echo $this->crud->get_name($readed['user_type'], $readed['user_id']); ?>" width="28" height="28">
                                                                        </a>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                            <div class="names-people-likes">
                                                                <?php if (count($checkData) > 5): ?>
                                                                    <?php echo getEduAppGTLang('and'); ?> <?php echo count($checkData) - 5; ?> <?php echo getEduAppGTLang('other_people_viewed_this_post'); ?>.
                                                                <?php else: ?>
                                                                    <?php echo getEduAppGTLang('have_seen_this_post'); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="comments-shared">
                                                                <a href="javascript:void(0);" class="post-add-icon inline-items"></a>
                                                                <a href="javascript:void(0);" class="post-add-icon inline-items"></a>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                </article>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php echo form_close(); ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </main>
                    <div class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12">
                        <div class="eduappgt-sticky-sidebar">
                            <div class="sidebar__inner">
                                <div class="ui-block paddingtel">
                                    <div class="ui-block-content">
                                        <div class="widget w-about">
                                            <br>
                                            <a href="javascript:void(0);" class="logo"><img src="<?php echo base_url(); ?>public/uploads/<?php echo $this->crud->getInfo('logo'); ?>" title="<?php echo $this->crud->getInfo('system_name'); ?>"></a>
                                            <ul class="socials">
                                                <li><a class="socialDash fb" href="<?php echo $this->crud->getInfo('facebook'); ?>"><i class="fab fa-facebook-square" aria-hidden="true"></i></a></li>
                                                <li><a class="socialDash tw" href="<?php echo $this->crud->getInfo('twitter'); ?>"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                                <li><a class="socialDash yt" href="<?php echo $this->crud->getInfo('youtube'); ?>"><i class="fab fa-youtube" aria-hidden="true"></i></a></li>
                                                <li><a class="socialDash ig" href="<?php echo $this->crud->getInfo('instagram'); ?>"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="ui-block paddingtel">
                                    <div class="ui-block-title">
                                        <h6 class="title"><?php echo getEduAppGTLang('chat groups'); ?></h6>
                                    </div>
                                    <ul class="widget w-friend-pages-added notification-list friend-requests">
                                        <?php
                                        $this->db->limit(5);
                                        $group_messages = $this->db->get('group_message_thread')->result_array();
                                        if (sizeof($group_messages) > 0):
                                            foreach ($group_messages as $row):
                                        ?>
                                                <li class="inline-items">
                                                    <div class="author-thumb">
                                                        <div class="avatar with-status status-green">
                                                            <div class="circle purple"><?php echo strtoupper($row['group_name'][0]); ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="notification-event">
                                                        <a href="<?php echo base_url(); ?>admin/group/group_message_read/<?php echo $row['group_message_thread_code']; ?>/" class="h6 notification-friend"><?php echo $row['group_name']; ?></a>
                                                        <span class="chat-message-item"><?php echo count(json_decode($row['members'])); ?> <?php echo getEduAppGTLang('members_on_this_group'); ?>.</span>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <br>
                                            <center>
                                                <h5><?php echo getEduAppGTLang('create_your_first_group'); ?></h5>
                                            </center><br>
                                            <center><img src="<?php echo base_url(); ?>public/uploads/mensajeseducaby.svg" width="250px"></center>
                                            <br>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                                <div class="ui-block paddingtel">
                                    <div class="pipeline white lined-success">
                                        <div class="element-wrapper">
                                            <h6 class="element-header"><?php echo getEduAppGTLang('online_users'); ?></h6>
                                            <?php $this->crud->saveUser(); ?>
                                            <div class="full-ch at-w">
                                                <div class="chat-content-w min">
                                                    <div class="chat-content min">
                                                        <div class="users-list-w">
                                                            <?php
                                                            $this->db->group_by('gp');
                                                            $usuarios = $this->db->get('online_users')->result_array();
                                                            foreach ($usuarios as $row): ?>
                                                                <div class="user-w with-status min status-green">
                                                                    <div class="user-avatar-w min">
                                                                        <div class="user-avatar">
                                                                            <img alt="" src="<?php echo $this->crud->get_image_url($row['type'], $row['id_usuario']); ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="user-name">
                                                                        <h6 class="user-title min"><?php echo $this->crud->get_name($row['type'], $row['id_usuario']); ?></h6>
                                                                        <div class="user-role min">
                                                                            <?php if ($row['type'] == 'student'): ?>
                                                                                <span class="badge badge-warning"><?php echo getEduAppGTLang('student'); ?></span>
                                                                            <?php endif; ?>
                                                                            <?php if ($row['type'] == 'accountant'): ?>
                                                                                <span class="badge badge-info"><?php echo getEduAppGTLang('accountant'); ?></span>
                                                                            <?php endif; ?>
                                                                            <?php if ($row['type'] == 'librarian'): ?>
                                                                                <span class="badge badge-info"><?php echo getEduAppGTLang('librarian'); ?></span>
                                                                            <?php endif; ?>
                                                                            <?php if ($row['type'] == 'parent'): ?>
                                                                                <span class="badge badge-purple"><?php echo getEduAppGTLang('parent'); ?></span>
                                                                            <?php endif; ?>
                                                                            <?php if ($row['type'] == 'admin'): ?>
                                                                                <span class="badge badge-primary"><?php echo getEduAppGTLang('admin'); ?><?php if (getBranchByAdminId($row['id_usuario']) != null) {
                                                                                                                                                                echo ' - ' . getBranchByAdminId($row['id_usuario'])->name;
                                                                                                                                                            } ?></span>
                                                                            <?php endif; ?>
                                                                            <?php if ($row['type'] == 'teacher'): ?>
                                                                                <span class="badge badge-success"><?php echo getEduAppGTLang('teacher'); ?></span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ui-block paddingtel">
                                    <div class="ui-block-title">
                                        <h6 class="title"><?php echo getEduAppGTLang('accounting'); ?></h6>
                                    </div>
                                    <div class="ui-block-content">
                                        <canvas id="myChart" width="400" height="400"></canvas>
                                    </div>
                                </div>
                                <div class="header-spacer"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
                        <div class="eduappgt-sticky-sidebar">
                            <div class="sidebar__inner">
                                <div class="ui-block paddingtel">
                                    <div class="today-events calendar ">
                                        <div class="today-events-thumb">
                                            <div class="date">
                                                <div class="day-number"><?php echo date('d'); ?></div>
                                                <div class="day-week"><?php echo getEduAppGTLang(date('l')); ?></div>
                                                <div class="month-year text-white"><?php echo getEduAppGTLang(date('F')); ?>, <?php echo date('Y'); ?>.</div>
                                            </div>
                                        </div>
                                        <div class="list">
                                            <div class="control-block-button">
                                                <a href="<?php echo base_url(); ?>admin/calendar/" class="btn btn-control bg-breez bgcl">
                                                    <i class="fa fa-plus text-white"></i>
                                                </a>
                                            </div>
                                            <?php $date = date('Y-m-d');
                                            $events = $this->db->get_where('events', array('start > ' => $date . ' ' . '00:00:00', 'start <' => $date . ' ' . '23:59:59')); ?>
                                            <div id="accordion-1" role="tablist" aria-multiselectable="true" class="day-event" data-month="12" data-day="2">
                                                <?php if ($events->num_rows() > 0): ?>
                                                    <?php foreach ($events->result_array() as $event): ?>
                                                        <div class="card">
                                                            <div class="card-header" role="tab" id="headingOne-1">
                                                                <div class="event-time">
                                                                    <h5 class="mb-0 title"><a href="<?php echo base_url(); ?>admin/calendar/"><?php echo $event['title']; ?></a></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <center>
                                                        <div class="today-eventsx">
                                                            <p><?php echo getEduAppGTLang('no_today_events'); ?></p><img src="<?php echo base_url(); ?>public/uploads/calendar.png" width="20%" />
                                                        </div>
                                                    </center>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ui-block paddingtel">
                                    <div class="ui-block-title">
                                        <h6 class="title"><?php echo getEduAppGTLang('birthdays'); ?></h6>
                                    </div>
                                    <br><br>
                                    <center>
                                        <img src="<?php echo base_url(); ?>public/uploads/icons/cake.svg" width="85px"><br><br>
                                        <h4><?php echo getEduAppGTLang('birthdays'); ?></h4>
                                        <p><?php echo $this->crud->get_birthdays(); ?> <?php echo getEduAppGTLang('users_have_a_birthday_this_month'); ?>.</p>
                                        <a href="<?php echo base_url(); ?>admin/birthdays/" class="birthdays-btn"><?php echo getEduAppGTLang('view_all_birthdays'); ?></a>
                                    </center>
                                    <div class="header-spacer"></div>
                                </div><br>
                                <div class="ui-block paddingtel">
                                    <div class="ui-block-title">
                                        <h6 class="title"><?php echo getEduAppGTLang('absent_students'); ?></h6>
                                    </div>
                                    <?php
                                    $check  = array('timestamp' => strtotime(date('Y-m-d')), 'status' => '2');
                                    $query = $this->db->get_where('attendance', $check);
                                    $absent_today   = $query->result_array();
                                    ?>
                                    <?php if ($query->num_rows() > 0): ?>
                                        <ul class="widget w-friend-pages-added notification-list friend-requests">
                                            <?php foreach ($absent_today as $attendance): ?>
                                                <li class="inline-items">
                                                    <div class="author-thumb">
                                                        <img src="<?php echo $this->crud->get_image_url('student', $attendance['student_id']); ?>" alt="author" width="35px">
                                                    </div>
                                                    <div class="notification-event">
                                                        <a href="<?php echo base_url(); ?>admin/student_portal/<?php echo $attendance['student_id']; ?>/" class="h6 notification-friend"><?php echo $this->crud->get_name('student', $attendance['student_id']); ?></a>
                                                        <span class="chat-message-item"><?php echo $this->db->get_where('class', array('class_id' => $attendance['class_id']))->row()->name; ?></span>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <center>
                                            <div class="today-events">
                                                <p><?php echo getEduAppGTLang('no_absent_students'); ?></p><img src="<?php echo base_url(); ?>public/uploads/plan.png" width="20%">
                                            </div>
                                        </center>
                                    <?php endif; ?>
                                    <div class="header-spacer"></div>
                                </div><br>
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
<div class="modal fade" id="add_conferences" tabindex="-1" role="dialog" aria-labelledby="add_conferences" aria-hidden="true">
    <div class="modal-dialog custom-modal-responsive" role="document">
        <div class="modal-content">
            <?php echo form_open(base_url() . 'admin/news/create/', array('enctype' => 'multipart/form-data')); ?>
            <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
            <div class="modal-header">
                <h6 class="title"><?php echo getEduAppGTLang('add') . ' ' . getEduAppGTLang('post'); ?></h6>
            </div>
            <div class="modal-body">
                <div class="description-toggle mb-3">
                    <div class="description-toggle-content">
                        <div class="h6"><?php echo getEduAppGTLang('can_comment'); ?></div>
                        <p><?php echo getEduAppGTLang('all_people_can_coment_to_this_posting'); ?></p>
                    </div>
                    <div class="togglebutton">
                        <label><input type="checkbox" checked name="can_comment"></label>
                    </div>
                </div>
                <div class="description-toggle mb-3">
                    <div class="description-toggle-content">
                        <div class="h6">Allow Reactions</div>
                        <p>People can react using emojis to this post</p>
                    </div>
                    <div class="togglebutton">
                        <label><input type="checkbox" checked name="can_reaction"></label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="content" class="form-label">Post Content</label>
                    <textarea id="summernote" name="post_content"></textarea>
                    <?php foreach (getAllReaction() as $reactionIcon) { ?>
                        <a href="#" class="emoji-insert" data-emoji="<?= $reactionIcon->reaction_type ?>">
                            <?= $reactionIcon->reaction_type ?>
                        </a>
                    <?php } ?>

                </div>
                <div class="mb-3">
                    <label for="attachments" class="form-label"><?php echo getEduAppGTLang('file'); ?></label>
                    <input type="file" class="form-control" id="post_file" name="post_file"
                        accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,video/*,image/*">
                    <small><?php echo getEduAppGTLang('accepted_file_photos_videos_documents_pdf_excel_powerpoint'); ?></small>
                </div>
                <button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo getEduAppGTLang('post'); ?></button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<!-- Modal Edit Post -->
<div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog custom-modal-responsive" role="document">
        <div class="modal-content">
            <form action="<?= base_url('admin/update_news_panel/') ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="news_id" id="edit_post_id">
                <div class="modal-header">
                    <h6 class="modal-title" id="editPostModalLabel">Edit Post</h6>
                    <button type="button" class="close icon-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="description-toggle mb-3">
                        <div class="description-toggle-content">
                            <div class="h6"><?php echo getEduAppGTLang('can_comment'); ?></div>
                            <p><?php echo getEduAppGTLang('all_people_can_comment_on_this_post'); ?></p>
                        </div>
                        <div class="togglebutton">
                            <label><input type="checkbox" id="edit_can_comment" name="can_comment" value="1"></label>
                        </div>
                    </div>

                    <div class="description-toggle mb-3">
                        <div class="description-toggle-content">
                            <div class="h6"><?php echo getEduAppGTLang('can_reaction'); ?></div>
                            <p><?php echo getEduAppGTLang('people_can_react_on_this_post'); ?></p>
                        </div>
                        <div class="togglebutton">
                            <label><input type="checkbox" id="edit_can_reaction" name="can_reaction" value="1"></label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="edit_post_content" class="form-label">Post Content</label>
                        <textarea id="edit_post_content" name="post_content"></textarea>
                        <?php foreach (getAllReaction() as $reactionIcon) { ?>
                            <a href="#" class="emoji-insert-edit" data-emoji="<?= $reactionIcon->reaction_type ?>">
                                <?= $reactionIcon->reaction_type ?>
                            </a>
                        <?php } ?>
                    </div>

                    <div class="mb-3">
                        <label for="edit_post_file" class="form-label">File</label>
                        <input type="file" class="form-control" name="post_file" id="edit_post_file">
                        <small><?= getEduAppGTLang('accepted_file_photos_videos_documents_pdf_excel_powerpoint'); ?></small>
                        <small><?= getEduAppGTLang('fill_if_want_to_update'); ?></small>
                    </div>
                    <button type="submit" class="btn btn-success btn-rounded btn-lg full-width">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    'use strict';
    var expense = '<?php echo getEduAppGTLang('expense'); ?>';
    var income = '<?php echo getEduAppGTLang('income'); ?>';
    var thanks = '<?php echo getEduAppGTLang('thank_you_polls'); ?>';
    var option = '<?php echo getEduAppGTLang('select_an_option'); ?>';

    function set_videoVimeo() {
        var IdV = getIdVimeo($("#urlvimeo").val());
        $('#myCodeVimeo').html('<br><iframe width="560" height="315" src="https://player.vimeo.com/video/' + IdV + '?color=ff0004&title=0&byline=0&portrait=0" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>');
        $("#embedvimeo").val('https://player.vimeo.com/video/' + IdV)
        $("#myCodeVimeo").show(500);
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

    function vimeo() {
        $("#new_post").hide(500);
        $("#new_poll").hide(500);
        $("#new_video").hide(500);
        $("#new_vimeo").show(500);
    }
</script>
<script src="<?php echo base_url(); ?>public/style/js/admin_panel.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote').summernote({
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
        $('.emoji-insert').on('click', function(e) {
            e.preventDefault();

            var emoji = $(this).data('emoji');
            $('#summernote').summernote('insertText', emoji);
        });

    });
</script>
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
    $(document).ready(function() {
        $('.btn-reaction').on('click', function() {
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
                success: function(response) {
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
                error: function() {
                    $('#reaction-loader').hide();
                    toastr.error('Terjadi kesalahan saat mengirim reaksi.');
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on('submit', '.commentForm', function(e) {
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