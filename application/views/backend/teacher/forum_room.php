<style>
            .emoji-insert {
            margin-right: 8px;
            font-size: 20px;
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
    $posts = $this->db->get_where('forum' , array('post_code' => $post_code))->result_array();
    foreach ($posts as $row):
        $post_id= $row['post_id'];
    $comments = getComments($row['post_id'], 'forum_comments');
?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="content-i">
                <div class="content-box">
                    <div class="back">
                        <a href="<?php echo base_url();?>teacher/forum/<?php echo base64_encode($row['class_id']."-".$row['section_id']."-".$row['subject_id']);?>/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>
                    </div>
                   <div class="row">
                        <div class="col-sm-8">
                            <div class="ui-block responsive-flex">
                                <table class="open-topic-table" id="panel">
                                    <thead>
                                        <tr>
                                            <th class="author"><?php echo getEduAppGTLang('author');?></th>
                                            <th class="posts"><?php echo getEduAppGTLang('topic');?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="topic-date" colspan="2"><?php echo $row['timestamp'];?></td>
                                        </tr>
                                        <tr>
                                            <td class="author f-author" width="50px">
                                                <div class="author-thumb">
                                                    <img src="<?php echo $this->crud->get_image_url($row['type'], $row['teacher_id']); ?>" alt="author">
                                                </div>
                                                <div class="author-content">
                                                    <a href="javascript:void(0);" class="h6 author-name"><?php echo $this->crud->get_name($row['type'], $row['teacher_id']);?></a>
                                                    <div class="country"><span class="badge badge-success"><?php echo ucwords($row['type']);?></span></div>
                                                </div>
                                            </td>
                                            <td class="posts">
                                                <h3><?php echo $row['title'];?></h3>
                                                 <div class="summernote-content"><?= $row['post_content']; ?></div>
                                                <?php if($row['post_file']){ ?>
                                                                <div class="table-responsive">
                                                                <table class="table table-down">
                                                                    <tbody>
                                                                        <tr class="trdhs">
                                                                            <td class="text-left cell-with-media">
                                                                                <?php if($row['post_file'] != '') { ?>
                                                                                <a href="<?php echo base_url() . 'public/forum/' . $row['post_file']; ?>"><i class="picons-thin-icon-thin-0111_folder_files_documents px16 text-white"></i> <span><?php echo $row['post_file']; ?></span></a>
                                                                                <?php } ?>
                                                                                
                                                                            </td>
                                                                            <td class="text-center bolder">
                                                                                <?php if($row['post_file'] != '') { ?>
                                                                                <a href="<?php echo base_url() . 'public/forum/' . $row['post_file']; ?>"><i class="picons-thin-icon-thin-0121_download_file px16 text-white"></i></a>
                                                                                <?php } ?>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                                <?php } ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                            <div class="d-flex gap-2">
                                                <?php if ($row['can_reaction']) : ?>
                                                    <?php foreach (countReaction($row['post_id'], 'forum_reactions') as $reaction) : ?>
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
                                            <input type="hidden" name="id" value="<?= $post_id; ?>">
                                            <input type="hidden" name="table" value="forum_comments">
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
                                                    <?php if (!$hasReacted = hasReacted('forum_reactions', $post_id, $this->session->userdata('login_user_id'))) : ?>
                                                        <?php if ($row['can_reaction']) : ?>
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
                            </div>
                        </div>
                        <div class="col-sm-4 ">
                            <div class="eduappgt-sticky-sidebar">
                                <div class="ui-block paddingtel">
                                    <div class="ui-block-title"> 
                                        <h6 class="title"><?php echo getEduAppGTLang('students');?></h6>
                                    </div>
                                    <ul class="widget w-friend-pages-added notification-list friend-requests">
                                    <?php $students = $this->db->get_where('enroll' , array('class_id' => $row['class_id'], 'section_id' => $row['section_id'] , 'year' => $running_year))->result_array();
                                    foreach($students as $row2):
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
                                                <img src="<?php echo $this->crud->get_image_url('student', $row2['student_id']); ?>" alt="author" width="35px">
                                            </div>
                                            <div class="notification-event">
                                                <a href="javascript:void(0);" class="h6 notification-friend"><?php echo $this->crud->get_name('student', $row2['student_id']);?></a>
                                                <span class="chat-message-item"><?php echo getEduAppGTLang('roll');?>: <?php echo $this->db->get_where('enroll' , array('student_id' => $row2['student_id']))->row()->roll; ?></span>
                                            </div>
                                        </li>
                                    <?php endforeach;?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;?>
    <script>
        'use strict';
        var ulogin    = 'teacher';
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
                alert("Something Wrong: " + xhr.responseText);
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