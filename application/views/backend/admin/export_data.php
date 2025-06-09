    <?php $running_year = $this->crud->getInfo('running_year'); ?>
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
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/final_evaluation/"><i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i> <span>Evaluaciones Finales</span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url(); ?>admin/transfer_data/"><i class="picons-thin-icon-thin-0125_cloud_sync"></i> <span><?php echo getEduAppGTLang('transfer_data'); ?></span></a>
                        </li>
						<li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url(); ?>admin/export_data/"><i class="picons-thin-icon-thin-0088_download_file"></i> <span><?php echo getEduAppGTLang('export_data'); ?></span></a>
                        </li>
			        </ul>
    			</div>
    		</div>
    		<div class="content-w">
    			<?php include 'fancy.php'; ?>
    			<div class="content-i">
    				<div class="content-box">
    					<div class="ui-block">
    						<div class="ui-block-content">
								 <div class="content-box">
    				<h5 class="form-header"><?php echo getEduAppGTLang('export_data'); ?></h5>
    				<hr>
    				<div class="row bg-white">
    					<div class="col-sm-12">
    						<div class="container-fluid">
    							<div class="row w-100">
    								<div class="os-tabs-w w-100">
    									<div class="os-tabs-controls w-100">
    										<ul class="navs navs-tabs upper d-flex justify-content-between w-100" style="gap: 10px;">
    											<li class="navs-item">
    												<a class="navs-links active" data-toggle="tab" href="#branch"><?php echo getEduAppGTLang('student'); ?></a>
    											</li>
    											<li class="navs-item">
    												<a class="navs-links" data-toggle="tab" href="#shifts"><?php echo getEduAppGTLang('class'); ?></a>
    											</li>
    											<li class="navs-item">
    												<a class="navs-links" data-toggle="tab" href="#student"><?php echo getEduAppGTLang('course'); ?></a>
    											</li>
                          						<li class="navs-item">
    												<a class="navs-links" data-toggle="tab" href="#class"><?php echo getEduAppGTLang('section'); ?></a>
    											</li>
    										</ul>
    									</div>
    								</div>
    							</div>
    							<div class="container-fluid">
    								<div class="tab-content">

    									<!-- STUDENT TAB -->
    									<div class="tab-pane active" id="branch">
    										<div class="row">
                              					<div class="col-sm-12">
														<?php echo form_open(base_url() . 'admin/students/', array('class' => 'form m-b')); ?>
														<div class="row">
															<div class="col col-sm-6">
																<div class="form-group label-floating is-select">
																	<label class="control-label"><?php echo getEduAppGTLang('branch'); ?></label>
																	<div class="select">
																		<select onchange="get_class(this.value); get_shifts(this.value);" name="branch_id">
																			<option value=""><?php echo getEduAppGTLang('all'); ?></option>
																			<?php
																			if (isSuperAdmin()) {
																				$branch = $this->db->where('status', 'ACTIVE')->get('branch')->result_array();
																			} else {
																				$branch = $this->db->where('branch_id', getMyBranchId()->branch_id)->get('branch')->result_array();
																			}
																			foreach ($branch as $row):
																			?>
																				<option value="<?php echo $row['branch_id']; ?>" <?php if (@$branch_id == $row['branch_id']) echo 'selected'; ?>><?php echo $row['name']; ?></option>
																			<?php endforeach; ?>
																		</select>
																	</div>
																</div>
															</div>
															<div class="col col-sm-6">
																<div class="form-group label-floating is-select">
																	<label class="control-label"><?php echo getEduAppGTLang('shifts'); ?></label>
																	<div class="select">
																		<select name="shifts_id" id="shifts_holder">
																			<?php if($shifts_id!=null){?>
																				<option value="<?php echo $shifts_id; ?>"><?php echo $this->db->get_where('shifts', array('shifts_id' => $shifts_id))->row()->name; ?></option>
																			<?php }else{?>
																			<option value=""><?php echo getEduAppGTLang('all'); ?></option>
																			<?php }?>
																		</select>
																	</div>
																</div>
															</div>
															<div class="col col-sm-6">
																<div class="form-group label-floating is-select">
																	<label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
																	<div class="select">
																		<select name="class_id" onchange="get_sections(this.value);" id="class_holder">
																			<?php if($class_id!=null){?>
																				<option selected value="<?php echo $class_id; ?>"><?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?></option>
																				<?php
																			if (isSuperAdmin()) {
																				 $class=$this->db->get('class')->result_array();
																			} else {
																				 $class=$this->db->get_where('class', array('branch_id' => $branch_id))->result_array();
																			}?>
																			<option value=""><?php echo getEduAppGTLang('all'); ?></option>

																			<?php foreach ($class as $row):?>
																				<option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
																			<?php endforeach; ?>
																			<?php }else{?>
																				<?php
																			if (isSuperAdmin()) {
																				 $class=$this->db->get('class')->result_array();
																			} else {
																				 $class=$this->db->get_where('class', array('branch_id' => $branch_id))->result_array();
																			}?>
																			<option value=""><?php echo getEduAppGTLang('all'); ?></option>

																			<?php foreach ($class as $row):?>
																				<option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
																			<?php endforeach; ?>
																			<?php }?>
																		</select>
																	</div>
																</div>
															</div>
															<div class="col col-sm-6">
																<div class="form-group label-floating is-select">
																	<label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
																	<div class="select">
																		<select name="section_id" id="section_holder" onchange="get_class_subjects(this.value);">
																			<?php if($section_id!=null){?>
																				<option value="<?php echo $section_id; ?>"><?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name; ?></option>
																			<?php }else{?>
																			<option value=""><?php echo getEduAppGTLang('all'); ?></option>
																			<?php }?>
																		</select>
																	</div>
																</div>
															</div>
															<div class="col-sm-6">
																<div class="form-group label-floating is-select">
																	<label class="control-label"><?php echo getEduAppGTLang('subject'); ?></label>
																	<div class="select">
																			<select name="subject_id" required id="subject_holder" onchange="get_exam(this.value);">
																				<option value=""><?php echo getEduAppGTLang('all'); ?></option>
																			</select>
																	</div>
																</div>
															</div>
															<div class="col col-sm-12 text-right">
																<div class="form-group mb-0">
																	<button class="btn btn-success mt-2">
																		<?php echo getEduAppGTLang('export'); ?> <i class="fa fa-download"></i>
																	</button>
																</div>
															</div>

														</div>
														<?php echo form_close(); ?>
													</div>
    										</div>
    									</div>

    									<!-- Shifts TAB -->
    									<div class="tab-pane" id="shifts">
    										<div class="row">
                          <hr>
											<div class="col-md-12 mb-3">
                      <button class="btn btn-primary" type="button" data-target="#add_conferences" data-toggle="modal">
                        <i class="fa fa-plus"></i> <?= getEduAppGTLang('add') . ' ' . getEduAppGTLang('shifts'); ?>
                      </button>
                    </div>
                        <div class="table-responsive">
                        <table class="table table-padded">
                          <thead>
                            <tr>
                              <th><?php echo getEduAppGTLang('branche'); ?></th>
                              <th><?php echo getEduAppGTLang('shifts'); ?></th>
                              <th><?php echo getEduAppGTLang('status'); ?></th>
                              <th class="text-center"><?php echo getEduAppGTLang('action'); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                          $shifts = $this->db->query('SELECT shifts.name as shifts_name,shifts.shifts_id,shifts.status,branch.branch_id,branch.* FROM shifts inner join branch on shifts.branch_id = branch.branch_id')->result_array();
                          foreach ($shifts as $row):
                          ?>
                            <tr>
                              <td><?php echo $row['name']; ?></td>
                              <td><?php echo $row['shifts_name']; ?></td>
                              <td><?php echo getEduAppGTLang($row['status']); ?></td>
                              <td class="row-actions">
                                <a href="javascript:void(0);"
                                  class="grey btn-edit-conference"
                                  data-id="<?= $row['shifts_id']; ?>"
                                  data-name="<?= $row['shifts_name']; ?>"
                                  data-branch="<?= $row['branch_id']; ?>"
                                  data-status="<?= $row['status']; ?>">
                                  <i class="picons-thin-icon-thin-0002_write_pencil_new_edit"></i>
                                  <i class="picons-thin-icon-thin-0002_write_pencil px20"></i>
                                </a>

                                <a class="grey" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/shifts_delete/<?php echo $row['shifts_id']; ?>"><i class="os-icon picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
    										</div>
    									</div>

    									<!-- STUDENT TAB -->
    									<div class="tab-pane" id="student">
    										<div class="row justify-content-center">
                          <span class="badge badge-warning p-3 text-center m-2">This page will show all students who are not assigned to any branch</span>
                      <div class="table-responsive">
                        <table id="studentTable" class="table table-striped table-hover">
                          <thead>
                            <tr>
                              <th><?php echo getEduAppGTLang('number'); ?></th>
                              <th><?php echo getEduAppGTLang('name'); ?></th>
                              <th class="text-center"><?php echo getEduAppGTLang('action'); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                          $students = $this->db->query('SELECT * FROM student where branch_id is null and is_active=1')->result_array();
                          $no=1;
                          foreach ($students as $row):
                          ?>
                            <tr>
                              <td><?= $no;?></td>
                              <td><?php echo $row['first_name'] . ' ' . $row['last_name']; ?></td>
                              <td class="row-actions">
                                <a href="#" onclick="showAjaxModal('<?= base_url('modal/popup/modal_add_branch_shifts_student/' . $row['student_id']) ?>');" class="btn btn-primary text-white"><i class="fa fa-sync"></i> <?php echo getEduAppGTLang('assign'); ?></a>
                            </tr>
                          <?php $no++; endforeach; ?>
                          </tbody>
                        </table>
                      </div>
    										</div>
    									</div>

                      <div class="tab-pane" id="class">
    										<div class="row justify-content-center">
                        <span class="badge badge-warning p-3 text-center m-2">This page will show all class who are not assigned to any branch</span>
                      <div class="table-responsive">
                        <table id="classTable" class="table table-striped table-hover">
                          <thead>
                            <tr>
                              <th><?php echo getEduAppGTLang('number'); ?></th>
                              <th><?php echo getEduAppGTLang('name'); ?></th>
                              <th class="text-center"><?php echo getEduAppGTLang('action'); ?></th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                          $class = $this->db->query('SELECT * FROM class where branch_id is null')->result_array();
                          $no=1;
                          foreach ($class as $row):
                          ?>
                            <tr>
                              <td><?= $no;?></td>
                              <td><?php echo $row['name']; ?></td>
                              <td class="row-actions">
                                <a href="#" onclick="showAjaxModal('<?= base_url('modal/popup/modal_add_branch_class/' . $row['class_id']) ?>');" class="btn btn-primary text-white"><i class="fa fa-sync"></i> <?php echo getEduAppGTLang('assign'); ?></a>
                            </tr>
                          <?php $no++; endforeach; ?>
                          </tbody>
                        </table>
                      </div>
    										</div>
    									</div>

    								</div>
    							</div>

    						</div>
    					</div>
    				</div>
    			</div>
    						</div>
    					</div>

    				</div>
    			</div>
    		</div>
    		<script>
    			document.getElementById('transferBtn').addEventListener('click', function(event) {
    				// prevent default submit
    				event.preventDefault();
    				const btn = this;
    				// Ambil nilai source
    				const branchSource = document.querySelector('select[name="branch_id_source"]').value.trim();
    				const shiftsSource = document.querySelector('select[name="shifts_id_source"]').value.trim();
    				const classSource = document.querySelector('select[name="class_id_source"]').value.trim();
    				const sectionSource = document.querySelector('select[name="section_id_source"]').value.trim();
    				const subjectSource = document.querySelector('select[name="subject_id_source"]').value.trim();

    				// Ambil nilai target
    				const branchTarget = document.querySelector('select[name="branch_id_target"]').value.trim();
    				const shiftsTarget = document.querySelector('select[name="shifts_id_target"]').value.trim();
    				const classTarget = document.querySelector('select[name="class_id_target"]').value.trim();
    				const sectionTarget = document.querySelector('select[name="section_id_target"]').value.trim();
    				const subjectTarget = document.querySelector('select[name="subject_id_target"]').value.trim();

    				// Validasi source
    				if (!branchSource) {
    					alert("<?php echo getEduAppGTLang('please_select_branch_source'); ?>");
    					return false;
    				}
    				if (!shiftsSource) {
    					alert("<?php echo getEduAppGTLang('please_select_shifts_source'); ?>");
    					return false;
    				}
    				if (!classSource) {
    					alert("<?php echo getEduAppGTLang('please_select_class_source'); ?>");
    					return false;
    				}
    				if (!sectionSource) {
    					alert("<?php echo getEduAppGTLang('please_select_section_source'); ?>");
    					return false;
    				}
    				if (!subjectSource) {
    					alert("<?php echo getEduAppGTLang('please_select_subject_source'); ?>");
    					return false;
    				}

    				// Validasi target
    				if (!branchTarget) {
    					alert("<?php echo getEduAppGTLang('please_select_branch_target'); ?>");
    					return false;
    				}
    				if (!shiftsTarget) {
    					alert("<?php echo getEduAppGTLang('please_select_shifts_target'); ?>");
    					return false;
    				}
    				if (!classTarget) {
    					alert("<?php echo getEduAppGTLang('please_select_class_target'); ?>");
    					return false;
    				}
    				if (!sectionTarget) {
    					alert("<?php echo getEduAppGTLang('please_select_section_target'); ?>");
    					return false;
    				}
    				if (!subjectTarget) {
    					alert("<?php echo getEduAppGTLang('please_select_subject_target'); ?>");
    					return false;
    				}

					if(subjectSource == subjectTarget){
						alert("<?php echo getEduAppGTLang('source_and_target_subject_must_be_different'); ?>");
						return false;
					}
    				const checkboxes = ['exam', 'activity', 'grade', 'attendance'];
    				const isAnyChecked = checkboxes.some(name => {
    					const checkbox = document.querySelector(`input[name="${name}"]`);
    					return checkbox && checkbox.checked;
    				});

    				if (!isAnyChecked) {
    					alert("<?php echo getEduAppGTLang('please_check_at_least_one_transfer_option'); ?>");
    					return false;
    				}

    				btn.disabled = true;
    				btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
					
    				document.getElementById('transferForm').submit();
    			});
    		</script>

    		<script>
    			$(document).ready(function() {
    				function toggleDependencies() {
    					const examChecked = $('input[name="exam"]').is(':checked');
    					const activityCheckbox = $('input[name="activity"]');
    					const gradeCheckbox = $('input[name="grade"]');

    					activityCheckbox.prop('disabled', !examChecked);
    					if (!examChecked) {
    						activityCheckbox.prop('checked', false);
    					}

    					const activityChecked = activityCheckbox.is(':checked');
    					gradeCheckbox.prop('disabled', !activityChecked);
    					if (!activityChecked) {
    						gradeCheckbox.prop('checked', false);
    					}
    				}

    				// Inisialisasi
    				toggleDependencies();

    				// Event listener saat checkbox berubah
    				$('input[name="exam"], input[name="activity"]').on('change', function() {
    					toggleDependencies();
    				});
    			});
    		</script>

    		<script>
    			const select = document.getElementById('class_holder');

    			const observer = new MutationObserver(() => {
    				const options = select.querySelectorAll('option');
    				for (let i = 0; i < options.length; i++) {
    					if (options[i].value !== '') {
    						select.value = options[i].value;
    						get_sections(options[i].value);
    						break;
    					}
    				}
    			});
    			observer.observe(select, {
    				childList: true,
    				subtree: false
    			});
    			const select2 = document.getElementById('class_holder2');

    			const observer2 = new MutationObserver(() => {
    				const options = select2.querySelectorAll('option');
    				for (let i = 0; i < options.length; i++) {
    					if (options[i].value !== '') {
    						select2.value = options[i].value;
    						get_sections2(options[i].value);
    						break;
    					}
    				}
    			});
    			observer2.observe(select2, {
    				childList: true,
    				subtree: false
    			});
    		</script>

    	</div>
    </div>