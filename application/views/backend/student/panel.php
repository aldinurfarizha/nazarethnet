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
                        <div id="panel">
                            <?php
                            $db = $this->db->query('SELECT can_comment, can_reaction, post_file, post_file_type, post_content, description, publish_date, type,news_id FROM news WHERE class_id = 0 AND section_id = 0 AND subject_id = 0 UNION SELECT can_comment, can_reaction, post_file, post_file_type, post_content, question,publish_date,type,id FROM polls WHERE class_id = 0 AND section_id = 0 AND subject_id = 0 ORDER BY publish_date DESC')->result_array();
                            foreach ($db as $wall):
                                $this->crud->setRead($wall['news_id']);
                            ?>
                                <?php if ($wall['type'] == 'news'): ?>
                                    <div class="ui-block paddingtel">
                                        <?php
                                        $news_id = $wall['news_id'];
                                        $news = $this->db->get_where('news', ['news_id' => $news_id])->row();
                                        $news_code = $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->news_code;
                                        $admin_id = $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->admin_id;
                                        $user_type = 'student';
                                        $comments = getComments($news_id, 'news_comments');
                                        $post_id = $news_id;
                                        ?>
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
                                            <div class="control-block-button post-control-button">
                                                <a href="javascript:void(0);" class="btn btn-control" style="background-color:#001b3d; color:#fff;" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('news'); ?>">
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
                                        $admin_id = $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->admin_id;
                                        ?>
                                        <article class="hentry post has-post-thumbnail thumb-full-width">
                                            <div class="post__author author vcard inline-items">
                                                <img src="<?php echo $this->crud->get_image_url('admin', $admin_id); ?>">
                                                <div class="author-date">
                                                    <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name('admin', $admin_id); ?></a>
                                                    <div class="post__date">
                                                        <time class="published btcolor"><?php echo $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->date . " " . $this->db->get_where('news', array('news_id' => $wall['news_id']))->row()->date2; ?></time>
                                                    </div>
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
                                    <?php echo form_open(base_url() . 'student/polls/response/', array('enctype' => 'multipart/form-data')); ?>
                                    <?php
                                    $usrdb = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->user;
                                    $poll_code = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->poll_code;
                                    $admin_id = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->admin_id;
                                    $options = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->options;
                                    $branch_id = $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->branch_id;

                                    ?>
                                    <?php if ($usrdb == 'student' || $usrdb == 'all'): ?>
                                        <?php
                                        if ($branch_id != 0) {
                                            if ($branch_id != $this->session->userdata('branch_id')) {
                                                continue;
                                            }
                                        }
                                        $type = 'student';
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
                                                    </div>
                                                    <div class="control-block-button post-control-button">
                                                        <a href="javascript:void(0);" class="btn btn-control controlsbt" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('polls'); ?>">
                                                            <i class="picons-thin-icon-thin-0385_graph_pie_chart_statistics"></i>
                                                        </a>
                                                    </div>
                                                    <div class="wall-content">
                                                        <div>
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
                                                        </div>
                                                        <a href="javascript:void(0);" class="btn btn-md-2 btn-border-think custom-color c-grey btn-vote text-white" onClick="vote('<?php echo $poll_code; ?>')"><?php echo getEduAppGTLang('vote'); ?><div class="ripple-container"></div></a>
                                                    </div>
                                                    <br><br><br>
                                                </article>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($query->num_rows() > 0): ?>
                                            <div class="ui-block paddingtel">
                                                <article class="hentry post">
                                                    <div class="post__author author vcard inline-items">
                                                        <img src="<?php echo $this->crud->get_image_url('admin', $admin_id); ?>" alt="author">
                                                        <div class="author-date">
                                                            <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name('admin', $admin_id); ?></a>
                                                            <div class="post__date">
                                                                <time class="published btcolor"><?php echo $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->date . " " . $this->db->get_where('polls', array('id' => $wall['news_id']))->row()->date2; ?></time>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="control-block-button post-control-button">
                                                        <a href="javascript:void(0);" class="btn btn-control grbg22" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('polls'); ?>">
                                                            <i class="picons-thin-icon-thin-0385_graph_pie_chart_statistics"></i>
                                                        </a>
                                                    </div>
                                                    <div class="wall-content">
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
                                                    <br><br><br>
                                                </article>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <?php echo form_close(); ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                    </main>
                    <div class="col col-xl-3 order-xl-1 col-lg-6 order-lg-2 col-md-6 col-sm-12 col-12">
                        <div class="eduappgt-sticky-sidebar">
                            <div class="sidebar__inner">
                                <div class="ui-block paddingtel">
                                    <div class="ui-block-content">
                                        <div class="widget w-about">
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
                                    <div class="widget w-create-fav-page">
                                        <div class="icons-block btmmg">
                                            <i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate text-white px25"></i>
                                        </div>
                                        <div class="content">
                                            <h3 class="title"><?php echo getEduAppGTLang('student_welcome_dashboard_message'); ?></h3>
                                            <a href="<?php echo base_url(); ?>student/progress/" class="btn btn-warning btn-sm"><?php echo getEduAppGTLang('go_to_my_timeline'); ?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="ui-block paddingtel">
                                    <div class="ui-block-title">
                                        <h6 class="title"><?php echo getEduAppGTLang('chat_groups'); ?></h6>
                                    </div>
                                    <ul class="widget w-friend-pages-added notification-list friend-requests">
                                        <?php
                                        $this->db->limit(5);
                                        $group_messages = $this->db->get('group_message_thread')->result_array();
                                        foreach ($group_messages as $row):
                                            $members = json_decode($row['members']);
                                            if (in_array($this->session->userdata('login_type') . '_' . $this->session->userdata('login_user_id'), $members)):
                                        ?>
                                                <li class="inline-items">
                                                    <div class="author-thumb">
                                                        <div class="avatar with-status status-green">
                                                            <div class="circle purple"><?php echo strtoupper($row['group_name'][0]); ?></div>
                                                        </div>
                                                    </div>
                                                    <div class="notification-event">
                                                        <a href="<?php echo base_url(); ?>student/group/group_message_read/<?php echo $row['group_message_thread_code']; ?>/" class="h6 notification-friend"><?php echo $row['group_name']; ?></a>
                                                        <span class="chat-message-item"><?php echo count(json_decode($row['members'])); ?> <?php echo getEduAppGTLang('members_on_this_group'); ?>.</span>
                                                    </div>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
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
                                                            foreach ($usuarios as $row):
                                                            ?>
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
                                                                            <?php if ($row['type'] == 'parent'): ?>
                                                                                <span class="badge badge-purple"><?php echo getEduAppGTLang('parent'); ?></span>
                                                                            <?php endif; ?>
                                                                            <?php if ($row['type'] == 'accountant'): ?>
                                                                                <span class="badge badge-info"><?php echo getEduAppGTLang('accountant'); ?></span>
                                                                            <?php endif; ?>
                                                                            <?php if ($row['type'] == 'librarian'): ?>
                                                                                <span class="badge badge-info"><?php echo getEduAppGTLang('librarian'); ?></span>
                                                                            <?php endif; ?>
                                                                            <?php if ($row['type'] == 'admin'): ?>
                                                                                <span class="badge badge-primary"><?php echo getEduAppGTLang('admin'); ?></span>
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
                                            <?php $date = date('Y-m-d');
                                            $events = $this->db->get_where('events', array('start > ' => $date . ' ' . '00:00:00', 'start <' => $date . ' ' . '23:59:59')); ?>
                                            <div id="accordion-1" role="tablist" aria-multiselectable="true" class="day-event" data-month="12" data-day="2">
                                                <?php if ($events->num_rows() > 0): ?>
                                                    <?php foreach ($events->result_array() as $event): ?>
                                                        <div class="card">
                                                            <div class="card-header" role="tab" id="headingOne-1">
                                                                <div class="event-time">
                                                                    <h5 class="mb-0 title"><a href="<?php echo base_url(); ?>student/calendar/"><?php echo $event['title']; ?></a></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <center>
                                                        <div class="today-eventsx">
                                                            <p><?php echo getEduAppGTLang('no_today_events'); ?></p>
                                                            <img src="<?php echo base_url(); ?>public/uploads/calendar.png" width="20%" />
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
                                        <a href="<?php echo base_url(); ?>student/birthdays/" class="birthdays-btn"><?php echo getEduAppGTLang('view_all_birthdays'); ?></a>
                                    </center>
                                    <div class="header-spacer"></div>
                                </div><br>
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a class="back-to-top" href="#">
                <img src="<?php echo base_url(); ?>public/style/olapp/svg-icons/back-to-top.svg" alt="arrow" class="back-icon">
            </a>
        </div>
    </div>
</div>
</div>
<script>
    'use strict';
    var thanks = '<?php echo getEduAppGTLang('thank_you_polls'); ?>';
    var option = '<?php echo getEduAppGTLang('select_an_option'); ?>';
</script>
<script src="<?php echo base_url(); ?>public/style/js/student_panel.js"></script>
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