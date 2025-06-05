    <div class="content-w">
        <?php include 'fancy.php'; ?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
				        <li class="navs-item">
    				        <a class="navs-links" href="<?php echo base_url();?>admin/academic_settings/"><i class="os-icon picons-thin-icon-thin-0006_book_writing_reading_read_manual"></i><span><?php echo getEduAppGTLang('academic_settings'); ?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/section/"><i class="os-icon picons-thin-icon-thin-0002_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('sections'); ?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/grade/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('grades'); ?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/semesters/"><i class="os-icon picons-thin-icon-thin-0007_book_reading_read_bookmark"></i><span><?php echo getEduAppGTLang('semesters'); ?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/student_promotion/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('student_promotion'); ?></span></a>
				        </li>
				        <li class="navs-item">
				            <a class="navs-links" href="<?php echo base_url();?>admin/certificates/"><i class="os-icon picons-thin-icon-thin-0178_add_more_layers_slides"></i><span><?php echo getEduAppGTLang('certificates'); ?></span></a>
				        </li>
						 <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url(); ?>admin/final_evaluation/"><i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i> <span>Evaluaciones Finales</span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/transfer_data/"><i class="picons-thin-icon-thin-0125_cloud_sync"></i> <span><?php echo getEduAppGTLang('transfer_data'); ?></span></a>
                        </li>
			        </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="expense-button"><button class="btn btn-success btn-rounded btn-upper" data-target="#new_grade" data-toggle="modal" type="button">+ <?php echo getEduAppGTLang('add'); ?></button></div><br>
                    <div class="element-wrapper">
                        <h6 class="element-header"><?php echo getEduAppGTLang('exam'); ?></h6>
                        <div class="element-box-tp">
                            <div class="table-responsive">
                                <table id="classTable" class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th><?php echo getEduAppGTLang('exam'); ?></th>
                                            <th><?php echo getEduAppGTLang('branch'); ?></th>
                                            <th><?php echo getEduAppGTLang('class'); ?></th>
                                            <th><?php echo getEduAppGTLang('section'); ?></th>
                                            <th><?php echo getEduAppGTLang('subject'); ?></th>
                                            <th class="text-center"><?php echo getEduAppGTLang('action'); ?></th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $grades = $this->db->query('SELECT * FROM exam where is_final=1')->result_array();
                                    foreach ($grades as $row):
                                        $classDetail = $this->db->get_where('class', array('class_id' => $row['class_id']))->row();
                                        if (isSuperAdmin() === false) {
                                            if ($classDetail->branch_id != getMyBranchId()->branch_id) {
                                                continue;
                                            }
                                        }
                                        $branch_detail=getDetailBranch($classDetail->branch_id);
                                        $class_id = $row['class_id'];
                                        $section_id = $row['section_id'];
                                        $subject_id = $row['subject_id'];
                                    ?>
                                        <tr>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><?= $branch_detail->name ?></td>
                                            <td><?= getClassNameById($class_id) ?></td>
                                            <td><?= getSectionNameById($section_id) ?></td>
                                            <td><?= getSubjectNameById($subject_id) ?></td>
                                            <td class="row-actions">
                                                <a class="grey" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/final_evaluation_delete_exam/<?php echo $row['exam_id']; ?>"><i class="os-icon picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                                                <a href="<?php echo base_url(); ?>admin/final_evaluation_weight/<?php echo $row['exam_id']; ?>" class="grey"><i class="picons-thin-icon-thin-0133_arrow_right_next px20"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="new_grade" tabindex="-1" role="dialog" aria-labelledby="new_grade" aria-hidden="true">
                        <div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
                            <div class="modal-content">
                                <?php echo form_open(base_url() . 'admin/final_evaluation_add_exam'); ?>
                                <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                                <div class="modal-header">
                                    <h6 class="title">añadir nuevo examen final</h6>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group label-floating is-select">
                                                <label class="control-label"><?php echo getEduAppGTLang('branch'); ?></label>
                                                <div class="select">
                                                    <select name="branch_id" required="" onchange="get_class(this.value)">
                                                        <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                                        <?php
                                                        if (isSuperAdmin()) {
                                                            $branch = $this->db->where('status', 'ACTIVE')->get('branch')->result_array();
                                                        } else {
                                                            $where = [
                                                                'status' => 'ACTIVE',
                                                                'branch_id' => getMyBranchId()->branch_id
                                                            ];
                                                            $branch = $this->db->where($where)->get('branch')->result_array();
                                                        }
                                                        foreach ($branch as $row): ?>
                                                            <option value="<?php echo $row['branch_id']; ?>"><?php echo $row['name']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
										</div>
									</div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group label-floating is-select">
										<label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
										<div class="select">
                                            <select name="class_id" required id="class_holder" onchange="get_sections(this.value);">
                                                <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                            </select>
										</div>
									</div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group label-floating is-select">
                                                <label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
                                                <div class="select">
                                                     <select name="section_id" required id="section_holder" onchange="get_class_subjects(this.value);">
                                                            <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                                        </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group label-floating is-select">
                                                <label class="control-label"><?php echo getEduAppGTLang('subject'); ?></label>
                                                <div class="select">
                                                    <select name="subject_id" required id="subject_holder" onchange="get_exam(this.value);">
                                                        <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group label-floating is-select">
                                                <label class="control-label"><?php echo getEduAppGTLang('exam'); ?></label>
                                                <div class="select">
                                                        <select name="exam_id" required id="exam_holder">
                                                            <option value=""><?php echo getEduAppGTLang('select'); ?></option>
                                                        </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo getEduAppGTLang('add'); ?></button>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function() {
        $('#classTable').DataTable();
    });
</script>