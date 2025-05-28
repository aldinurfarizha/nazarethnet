<style>
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
        all: initial;
        /* Reset semua style */
        font-family: Arial, sans-serif;
        /* Atur kembali font */
        font-size: 14px;
        line-height: 1.6;
        color: #333;
    }

    /* Izinkan kembali elemen umum */
    .summernote-content * {
        all: unset;
        display: revert;
        box-sizing: border-box;
        font-family: inherit;
        font-size: inherit;
        line-height: inherit;
        color: inherit;
    }

    .summernote-content img {
        max-width: 100%;
        height: auto;
    }

    .summernote-content a {
        color: blue;
        text-decoration: underline;
        cursor: pointer;
    }

    .summernote-content a:hover {
        color: darkblue;
    }
</style>

<?php
$running_year = $this->crud->getInfo('running_year');
$info = base64_decode(@$data);
$ex = explode('-', $info);
$current_homework = $this->db->get_where('homework', array('homework_code' => $homework_code))->result_array();
foreach ($current_homework as $row):
    $homework_id= $row['homework_id'];
    $comments = getComments($row['homework_id'], 'homework_comments');

?>

    <div class="content-w">
        <div class="conty">
            <?php include 'fancy.php'; ?>
            <div class="header-spacer"></div>
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url(); ?>admin/homeworkroom/<?php echo $homework_code; ?>/"><i class="os-icon picons-thin-icon-thin-0014_notebook_paper_todo"></i><span><?php echo getEduAppGTLang('homework_details'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/homework_details/<?php echo $homework_code; ?>/"><i class="os-icon picons-thin-icon-thin-0100_to_do_list_reminder_done"></i><span><?php echo getEduAppGTLang('deliveries'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/homework_edit/<?php echo $homework_code; ?>/"><i class="os-icon picons-thin-icon-thin-0001_compose_write_pencil_new"></i><span><?php echo getEduAppGTLang('edit'); ?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="back hidden-sm-down backbutton">
                        <a href="<?php echo base_url(); ?>admin/homework/<?php echo base64_encode($row['class_id'] . "-" . $row['section_id'] . "-" . $row['subject_id']); ?>/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>
                    </div>
                    <div class="row">
                        <main class="col col-xl-9 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                            <div id="newsfeed-items-grid">
                                <div class="ui-block">
                                    <article class="hentry post thumb-full-width">
                                        <div class="post__author author vcard inline-items">
                                            <img src="<?php echo $this->crud->get_image_url($row['uploader_type'], $row['uploader_id']); ?>" alt="author">
                                            <div class="author-date">
                                                <a class="h6 post__author-name fn" href="javascript:void(0);"><?php echo $this->crud->get_name($row['uploader_type'], $row['uploader_id']); ?></a>
                                                <div class="post__date">
                                                    <time class="published">
                                                        <?php if ($row['status'] == 1): ?>
                                                            <span class="text-success"><?php echo getEduAppGTLang('published'); ?></span>
                                                        <?php else: ?>
                                                            <span class="text-danger"><?php echo getEduAppGTLang('no_published'); ?></span>
                                                        <?php endif; ?>
                                                    </time>
                                                </div>
                                            </div>
                                            <div class="more">
                                                <i class="icon-options"></i>
                                                <ul class="more-dropdown">
                                                    <li><a href="<?php echo base_url(); ?>admin/homework_edit/<?php echo $row['homework_code']; ?>/"><?php echo getEduAppGTLang('edit'); ?></a></li>
                                                    <li><a href="<?php echo base_url(); ?>admin/homework_details/<?php echo $row['homework_code']; ?>/"><?php echo getEduAppGTLang('deliveries'); ?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="edu-posts cta-with-media verde">
                                            <div class="cta-content">
                                                <div class="highlight-header morado">
                                                    <?php echo $this->db->get_where('subject', array('subject_id' => $row['subject_id']))->row()->name; ?>
                                                </div>
                                                <div class="grado">
                                                    <?php echo $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name; ?>
                                                </div>
                                                <h3 class="cta-header"><?php echo $row['title']; ?></h3>
                                                <div class="descripcion">
                                                    <div class="summernote-content"><?= $row['post_content']; ?></div>
                                                    <?php if ($row['media_type'] == 1): ?>
                                                        <video src="<?php echo base_url(); ?>public/uploads/homework/video/<?php echo $row['homework_code']; ?>.mp4" controls type="video/mp4" style="width: auto; max-width:100%;"></video>
                                                    <?php elseif ($row['media_type'] == 2): ?>
                                                        <audio controls type="video/mp3">
                                                            <source src="<?php echo base_url(); ?>public/uploads/homework/audio/<?php echo $row['homework_code']; ?>.mp3" type="audio/mpeg">
                                                        </audio>
                                                    <?php endif; ?>
                                                </div>
                                                <?php if($row['post_file']){ ?>
                                                                <div class="table-responsive">
                                                                <table class="table table-down">
                                                                    <tbody>
                                                                        <tr class="trdhs">
                                                                            <td class="text-left cell-with-media">
                                                                                <?php if($row['post_file'] != '') { ?>
                                                                                <a href="<?php echo base_url() . 'public/homework/' . $row['post_file']; ?>"><i class="picons-thin-icon-thin-0111_folder_files_documents px16 text-white"></i> <span><?php echo $row['post_file']; ?></span></a>
                                                                                <?php } ?>
                                                                                
                                                                            </td>
                                                                            <td class="text-center bolder">
                                                                                <?php if($row['post_file'] != '') { ?>
                                                                                <a href="<?php echo base_url() . 'public/homework/' . $row['post_file']; ?>"><i class="picons-thin-icon-thin-0121_download_file px16 text-white"></i></a>
                                                                                <?php } ?>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                                <?php } ?>
                                                <div class="deadtime">
                                                    <span><?php echo getEduAppGTLang('delivery_date'); ?>:</span><i class="picons-thin-icon-thin-0027_stopwatch_timer_running_time"></i><?php echo $row['date_end']; ?> @ <?php echo $row['time_end']; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-block-button post-control-button">
                                            <a href="javascript:void(0);" class="btn btn-control featured-post grbg2 text-white" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('homework'); ?>">
                                                <i class="picons-thin-icon-thin-0004_pencil_ruler_drawing"></i>
                                            </a>
                                        </div>
                                       
                                        <?php
                                        $checkData = $this->academic->getRead($row['homework_id'], 'homework', $row['subject_id']);
                                        if (count($checkData) > 0):
                                        ?>
                                            <div class="post-additional-info inline-items">
                                                <ul class="friends-harmonic">
                                                    <?php foreach ($checkData as $readed): ?>
                                                        <li>
                                                            <a href="javascript:void(0);">
                                                                <img loading="lazy" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_students/<?php echo $row['homework_id'] . '/' . $row['subject_id'] . '/homework'; ?>');" title="<?php echo $this->crud->get_name('student', $readed['student_id']); ?>" src="<?php echo $this->crud->get_image_url('student', $readed['student_id']); ?>" alt="<?php echo $this->crud->get_name('student', $readed['student_id']); ?>" width="28" height="28">
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
                                        <?php else: ?>
                                            <br><br><br>
                                        <?php endif; ?>
                                         <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex gap-2">
                                                <?php if ($row['can_reaction']) : ?>
                                                    <?php foreach (countReaction($row['homework_id'], 'homework_reactions') as $reaction) : ?>
                                                        <span class="reaction-item"><?= $reaction->reaction_type . ' ' . $reaction->total; ?></span>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>

                                            <?php if ($row['can_comment']) : ?>
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
                                        <?php if ($row['can_comment']) : ?>
                                            <form id="commentForm">
                                            <input type="hidden" name="id" value="<?= $homework_id; ?>">
                                            <input type="hidden" name="table" value="homework_comments">
                                            <input type="text" name="comment" class="form-control" placeholder="<?= getEduAppGTLang('write_your_comment'); ?>">
                                            <div class="reaction-wrapper mb-2">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <!-- Tombol SEND -->
                                                    <div>
                                                        <button type="submit" class="btn btn-primary" id="submitComment">
                                                            <span id="btnText"><?= getEduAppGTLang('send'); ?> <i class="fa fa-paper-plane"></i></span>
                                                            <span id="btnLoading" class="d-none"><i class="fa fa-spinner fa-spin"></i> Loading...</span>
                                                        </button>
                                                    </div>

                                                    <!-- Tombol REACTION & Daftar Reaction -->
                                                    <?php if (!$hasReacted = hasReacted('homework_reactions', $homework_id, $this->session->userdata('login_user_id'))) : ?>
                                                        <?php if ($row['can_reaction']) : ?>
                                                            <div class="text-end" style="min-width: 120px;">
                                                                <button type="button" class="btn btn-primary toggle-reaction mb-2">
                                                                    <?= getEduAppGTLang('reaction'); ?> <i class="fa fa-smile"></i>
                                                                </button>

                                                                <div class="reaction-list" style="display: none;">
                                                                    <?php foreach (getAllReaction() as $reactionIcon) : ?>
                                                                        <button type="button"
                                                                            class="btn btn-outline-secondary me-1 mb-1 btn-reaction"
                                                                            data-content-id="<?= $homework_id ?>"
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
                                    </article>
                                </div>
                            </div>
                        </main>
                        <div class="col col-xl-3 order-xl-3 col-lg-6 order-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="eduappgt-sticky-sidebar">
                                <div class="sidebar__inner ">
                                    <div class="ui-block ">
                                        <div class="ui-block-title">
                                            <h6 class="title"><?php echo getEduAppGTLang('information'); ?></h6>
                                        </div>
                                        <div class="ui-block-content">
                                            <div class="table-responsive">
                                                <table class="table table-lightbor">
                                                    <tr>
                                                        <th><?php echo getEduAppGTLang('subject'); ?>:</th>
                                                        <td><?php echo $this->crud->get_type_name_by_id('subject', $row['subject_id']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php echo getEduAppGTLang('class'); ?>:</th>
                                                        <td><?php echo $this->crud->get_type_name_by_id('class', $row['class_id']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php echo getEduAppGTLang('section'); ?>:</th>
                                                        <td><?php echo $this->crud->get_type_name_by_id('section', $row['section_id']); ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php echo getEduAppGTLang('total_students'); ?>:</th>
                                                        <td><a class="btn nc btn-rounded btn-sm btn-secondary text-white">
                                                            <?php $students   =   $this->db->get_where('enroll', array('class_id' => $row['class_id'], 'section_id' => $row['section_id'], 'year' => $running_year))->result_array();
                                                             $totalStudents=0;
                                                                foreach ($students as $row2):
                                                                    if (!isStudentActiveEnroll($row2['student_id'], $row['class_id'], $row['section_id'], $running_year)) {
                                                                        continue;
                                                                    }
                                                                    if (isStudentFinishSubject($row2['student_id'], $row['subject_id'])) {
                                                                        continue;
                                                                    }
                                                                    if (!isActiveSubject($row2['student_id'], $row['subject_id'])) {
                                                                        continue;
                                                                    }
                                                                    $totalStudents++;
                                                                endforeach;
                                                                echo $totalStudents; ?>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php echo getEduAppGTLang('delivered'); ?>:</th>
                                                        <td><a class="btn nc btn-rounded btn-sm btn-success text-white"><?php $this->db->where('class_id', $row['class_id']);
                                                                                                                        $this->db->where('section_id', $row['section_id']);
                                                                                                                        $this->db->where('homework_code', $homework_code);
                                                                                                                        echo $this->db->count_all_results('deliveries'); ?></a></td>
                                                    </tr>
                                                    <tr>
                                                        <th><?php echo getEduAppGTLang('undeliverable'); ?>:</th>
                                                        <td>
                                                            <?php $this->db->where('class_id', $row['class_id']);
                                                            $this->db->where('section_id', $row['section_id']);
                                                            $this->db->where('homework_code', $homework_code);
                                                            $deliveries = $this->db->count_all_results('deliveries'); ?>
                                                            <a class="btn nc btn-rounded btn-sm btn-danger text-white"><?php echo $totalStudents - $deliveries; ?></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui-block">
                                        <div class="ui-block-title">
                                            <h6 class="title"><?php echo getEduAppGTLang('students'); ?></h6>
                                        </div>
                                        <ul class="widget w-friend-pages-added notification-list friend-requests">
                                            <?php $students   =   $this->db->get_where('enroll', array('class_id' => $row['class_id'], 'section_id' => $row['section_id'], 'year' => $running_year))->result_array();
                                            foreach ($students as $row2):
                                                if (!isStudentActiveEnroll($row2['student_id'], $row['class_id'], $row['section_id'], $running_year)) {
                                                    continue;
                                                }
                                                if (isStudentFinishSubject($row2['student_id'], $row['subject_id'])) {
                                                    continue;
                                                }
                                                if (!isActiveSubject($row2['student_id'], $row['subject_id'])) {
                                                    continue;
                                                }
                                             ?>
                                                <li class="inline-items">
                                                    <div class="author-thumb">
                                                        <img src="<?php echo $this->crud->get_image_url('student', $row2['student_id']); ?>" width="35px" alt="author">
                                                    </div>
                                                    <div class="notification-event">
                                                        <a href="javascript:void(0);" class="h6 notification-friend"><?php echo $this->crud->get_name('student', $row2['student_id']); ?></a>
                                                        <span class="chat-message-item"><?php echo getEduAppGTLang('roll'); ?>: <?php echo $this->db->get_where('enroll', array('student_id' => $row2['student_id']))->row()->roll; ?></span>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
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
    $('#commentForm').on('submit', function(e) {
        e.preventDefault();

        // Tombol loading aktif
        $('#submitComment').prop('disabled', true);
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
                alert("Something wrong: " + xhr.responseText);
            },
            complete: function() {
                // Kembalikan tombol ke normal
                $('#submitComment').prop('disabled', false);
                $('#btnText').removeClass('d-none');
                $('#btnLoading').addClass('d-none');
            }
        });
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
