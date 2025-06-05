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
        .emoji-insert {
            margin-right: 8px;
            font-size: 35px;
            text-decoration: none;
            cursor: pointer;
        }
        .summernote-preview {
  border: none;
  width: 100%;
  height: 150px;
  overflow: hidden;
}
.emoji-insert-edit {
            margin-right: 8px;
            font-size: 35px;
            text-decoration: none;
            cursor: pointer;
        }
</style>
<?php 
    $running_year = $this->crud->getInfo('running_year');
    $info = base64_decode($data);
    $ex = explode("-",$info);
    $class_info = $this->db->get('class')->result_array();
    $sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
    foreach($sub as $row):
?>
    <div class="content-w">
        <div class="conty">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
            <div class="cursos cta-with-media" style="background: #<?php echo $row['color'];?>;">
                <div class="cta-content">
                    <div class="user-avatar">
                        <img alt="" src="<?php echo base_url();?>public/uploads/subject_icon/<?php echo $row['icon'];?>" class="icon-wi">
                    </div>
                    <h3 class="cta-header"><?php echo $row['name'];?> - <small><?php echo getEduAppGTLang('study_material');?></small></h3>
                    <small class="subject-desc"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name;?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name;?>"</small>
                </div>
            </div>  
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/subject_dashboard/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/online_exams/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/homework/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/forum/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo getEduAppGTLang('forum');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>teacher/study_material/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/upload_marks/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/meet/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo getEduAppGTLang('live');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/attendance/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>teacher/attendance_report/<?php echo $data; ?>/"><i class="picons-thin-icon-thin-0100_to_do_list_reminder_done"></i><span><?php echo getEduAppGTLang('attendance_report'); ?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/whiteboards/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0191_window_application_cursor"></i><span><?php echo getEduAppGTLang('whiteboards');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/gamification/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0659_medal_first_place_winner_award_prize_achievement"></i><span><?php echo getEduAppGTLang('gamification');?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
                        <div class="content-i">
                <div class="content-box">
                    <div class="row">
                        <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                            <div id="newsfeed-items-grid">
                                <div class="element-wrapper">
                                    <div class="element-box-tp">
                                        <h6 class="element-header">
                                            <?php echo getEduAppGTLang('study_material'); ?>
                                            <div class="element-content"><a href="javascript:void(0);" data-target="#addmaterial" data-toggle="modal" class="text-white btn btn-control btn-grey-lighter btn-success"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i>
                                                    <div class="ripple-container"></div>
                                                </a></div>
                                        </h6>
                                        <div class="table-responsive">
                                            <table class="table table-padded">
                                                <tbody>
                                                    <?php
                                                    $this->db->order_by('timestamp', 'desc');
                                                    $this->db->where('class_id', $ex[0]);
                                                    $this->db->where('section_id', $ex[1]);
                                                    $this->db->where('subject_id', $ex[2]);
                                                    $study_material_info = $this->db->get('document')->result_array();
                                                    foreach ($study_material_info as $row):
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                 <?php if(!empty($row['post_content'])) : ?>
                                                                    <iframe class="summernote-preview" srcdoc="<?= htmlspecialchars($row['post_content']); ?>"></iframe>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td><?=getEduAppGTLang('can_comment');?>:<?php if($row['can_comment'] == 1) { echo getEduAppGTLang('yes'); } else { echo getEduAppGTLang('no'); } ?></td>
                                                            <td><?=getEduAppGTLang('can_reaction');?>:<?php if($row['can_reaction'] == 1) { echo getEduAppGTLang('yes'); } else { echo getEduAppGTLang('no'); } ?></td>
                                                            <td class="text-left cell-with-media ">
                                                                <a href="<?php echo base_url() . 'public/material/' . $row['post_file']; ?>" class="grey">
                                                                    <?php if ($row['file_type'] == 'PDF'): ?>
                                                                        <i class="picons-thin-icon-thin-0077_document_file_pdf_adobe_acrobat grey px20"></i>
                                                                    <?php endif; ?>
                                                                    <?php if ($row['file_type'] == 'Zip'): ?>
                                                                        <i class="picons-thin-icon-thin-0076_document_file_zip_archive_compressed_rar grey px20"></i>
                                                                    <?php endif; ?>
                                                                    <?php if ($row['file_type'] == 'RAR'): ?>
                                                                        <i class="picons-thin-icon-thin-0076_document_file_zip_archive_compressed_rar grey px20"></i>
                                                                    <?php endif; ?>
                                                                    <?php if ($row['file_type'] == 'Doc'): ?>
                                                                        <i class="picons-thin-icon-thin-0078_document_file_word_office_doc_text grey px20"></i>
                                                                    <?php endif; ?>
                                                                    <?php if ($row['file_type'] == 'Image'): ?>
                                                                        <i class="picons-thin-icon-thin-0082_image_photo_file grey px20"></i>
                                                                    <?php endif; ?>
                                                                    <?php if ($row['file_type'] == 'Other'): ?>
                                                                        <i class="picons-thin-icon-thin-0111_folder_files_documents grey px20"></i>
                                                                    <?php endif; ?><span><?php echo $row['post_file']; ?></span><span class="smaller">(<?php echo $row['post_file_type']; ?>)</span></a>
                                                            </td>
                                                            <td class="text-center bolder">
                                                                <a href="#" class="grey edit-post-btn"
                                                                        data-id="<?= $row['document_id'] ?>"
                                                                        data-content="<?= htmlspecialchars($row['post_content'], ENT_QUOTES, 'UTF-8') ?>"
                                                                        data-comment="<?= $row['can_comment'] ?>"
                                                                        data-reaction="<?= $row['can_reaction'] ?>"
                                                                        data-toggle="modal"
                                                                        data-target="#editPostModal""><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i></a>
                                                                <a target="_blank" href="<?php echo base_url() . 'public/material/' . $row['post_file']; ?>" class="grey"> <span><i class="picons-thin-icon-thin-0121_download_file"></i></span> </a>
                                                                <a class="grey" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>teacher/study_material/delete/<?php echo $row['document_id'] ?>/<?php echo $data; ?>"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addmaterial" tabindex="-1" role="dialog" aria-labelledby="addmaterial" aria-hidden="true">
        <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
            <div class="modal-content">
                <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                <div class="modal-body">
                    <div class="ui-block-title mdl-header">
                        <h6 class="title text-white"><?php echo getEduAppGTLang('upload_study_material'); ?></h6>
                    </div>
                    <div class="ui-block-content">
                        <?php echo form_open(base_url() . 'teacher/study_material/create/' . $data, array('enctype' => 'multipart/form-data')); ?>
                        <div class="row">
                            <input type="hidden" value="<?php echo $ex[0]; ?>" name="class_id" />
                            <input type="hidden" value="<?php echo $ex[1]; ?>" name="section_id" />
                            <input type="hidden" value="<?php echo $ex[2]; ?>" name="subject_id" />
                             <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="description-toggle mb-3">
                                        <div class="description-toggle-content">
                                            <div class="h6"><?php echo getEduAppGTLang('can_comment'); ?></div>
                                            <p><?php echo getEduAppGTLang('all_people_can_comment_on_this_post'); ?></p>
                                        </div>
                                        <div class="togglebutton">
                                            <label><input type="checkbox" id="can_comment" name="can_comment" value="1"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="description-toggle mb-3">
                                        <div class="description-toggle-content">
                                            <div class="h6"><?php echo getEduAppGTLang('can_reaction'); ?></div>
                                            <p><?php echo getEduAppGTLang('people_can_react_on_this_post'); ?></p>
                                        </div>
                                        <div class="togglebutton">
                                            <label><input type="checkbox" id="can_reaction" name="can_reaction" value="1"></label>
                                        </div>
                                    </div>
                                </div>
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="control-label"><?php echo getEduAppGTLang('description'); ?></label>
                                    <textarea class="form-control" id="summernote" name="description"></textarea>
                                    <?php foreach (getAllReaction() as $reactionIcon) { ?>
                                            <a href="#" class="emoji-insert" data-emoji="<?= $reactionIcon->reaction_type ?>">
                                                <?= $reactionIcon->reaction_type ?>
                                            </a>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label class="control-label"><?php echo getEduAppGTLang('file'); ?></label>
                                    <input class="form-control" name="file_name" type="file">
                                </div>
                            </div>
                            <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group label-floating is-select">
                                    <label class="control-label"><?php echo getEduAppGTLang('file_type'); ?></label>
                                    <div class="select">
                                        <select name="file_type" required="">
                                            <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                            <option value="PDF">PDF</option>
                                            <option value="Doc">Doc</option>
                                            <option value="Zip">Zip</option>
                                            <option value="RAR">RAR</option>
                                            <option value="Image"><?php echo getEduAppGTLang('image'); ?></option>
                                            <option value="Other"><?php echo getEduAppGTLang('other'); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-buttons-w text-right">
                            <center><button class="btn btn-rounded btn-success btn-lg" type="submit"><?php echo getEduAppGTLang('save'); ?></button></center>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
 <div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editPostModalLabel" aria-hidden="true">
        <div class="modal-dialog custom-modal-responsive" role="document">
            <div class="modal-content">
                <form action="<?= base_url('teacher/study_material/update/' . $data) ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="document_id" id="edit_post_id">
                    <div class="modal-header">
                        <h6 class="modal-title" id="editPostModalLabel"><?=getEduAppGTLang('edit_study_material')?></h6>
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
        $('.emoji-insert').on('click', function(e) {
            e.preventDefault();

            var emoji = $(this).data('emoji');
            $('#summernote').summernote('insertText', emoji);
        });
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
                console.log(comment);
                console.log(reaction);
                console.log(post_id);
                $('#edit_post_id').val(post_id);
                $('#edit_post_content').summernote('code', decodeHtml(content));

                $('#edit_can_comment').prop('checked', comment == 1);
                $('#edit_can_reaction').prop('checked', reaction == 1);
            });

    });
</script>