<style>
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
$info = base64_decode($data);
$ex = explode("-", $info);
$class_info = $this->db->get('class')->result_array();
$sub = $this->db->get_where('subject', array('subject_id' => $ex[2]))->result_array();
foreach ($sub as $row):
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
                    <h3 class="cta-header"><?php echo $row['name']; ?> - <small><?php echo getEduAppGTLang('study_material'); ?></small></h3>
                    <small class="subject-desc"><?php echo $this->db->get_where('class', array('class_id' => $ex[0]))->row()->name; ?> "<?php echo $this->db->get_where('section', array('section_id' => $ex[1]))->row()->name; ?>"</small>
                </div>
            </div>
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/subject_dashboard/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard'); ?></span></a>
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
                            <a class="navs-links active" href="<?php echo base_url(); ?>admin/study_material/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material'); ?></span></a>
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
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/certificate_list/<?php echo $data; ?>/"><i class="os-icon picons-thin-icon-thin-0012_notebook_paper_certificate"></i><span><?php echo getEduAppGTLang('certificate'); ?></span></a>
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
                                                            <td><div class="summernote-content"><?= $row['post_content']; ?></div></td>
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
                                                                <a target="_blank" href="<?php echo base_url() . 'public/material/' . $row['post_file']; ?>" class="grey"> <span><i class="picons-thin-icon-thin-0121_download_file"></i></span> </a>
                                                                <a class="grey" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/study_material/delete/<?php echo $row['document_id'] ?>/<?php echo $data; ?>"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
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
                        <?php echo form_open(base_url() . 'admin/study_material/create/' . $data, array('enctype' => 'multipart/form-data')); ?>
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