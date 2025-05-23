<?php $running_year = $this->crud->getInfo('running_year'); ?>
<div class="content-w">
	<?php include 'fancy.php'; ?>
	<div class="header-spacer"></div>
	<div class="conty">
		<div class="os-tabs-w menu-shad">
			<div class="os-tabs-controls">
				<ul class="navs navs-tabs">
					<li class="navs-item">
						<a class="navs-links" href="<?php echo base_url(); ?>admin/general_reports/"><i class="picons-thin-icon-thin-0658_cup_place_winner_award_prize_achievement"></i> <span><?php echo getEduAppGTLang('classes'); ?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links <?php if ($page_name == 'students_report') echo "active"; ?>" href="<?php echo base_url(); ?>admin/students_report/"><i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i> <span><?php echo getEduAppGTLang('students'); ?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links" href="<?php echo base_url(); ?>admin/attendance_report/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i> <span><?php echo getEduAppGTLang('attendance'); ?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links" href="<?php echo base_url(); ?>admin/grades_report/"><i class="picons-thin-icon-thin-0101_notes_text_notebook"></i> <span><?php echo getEduAppGTLang('grades_report'); ?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links" href="<?php echo base_url(); ?>admin/marks_report/"><i class="picons-thin-icon-thin-0100_to_do_list_reminder_done"></i> <span><?php echo getEduAppGTLang('final_marks'); ?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links" href="<?php echo base_url(); ?>admin/final_evaluation/"><i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i> <span>Evaluaciones Finales</span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links" href="<?php echo base_url(); ?>admin/tabulation_report/"><i class="picons-thin-icon-thin-0070_paper_role"></i> <span><?php echo getEduAppGTLang('tabulation_sheet'); ?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links" href="<?php echo base_url(); ?>admin/accounting_report/"><i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash"></i> <span><?php echo getEduAppGTLang('accounting'); ?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links" href="<?php echo base_url(); ?>admin/import_data/"><i class="picons-thin-icon-thin-0126_cloud_upload_backup"></i> <span><?php echo getEduAppGTLang('import_data'); ?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links" href="<?php echo base_url(); ?>admin/export_data/"><i class="picons-thin-icon-thin-0122_download_file_computer_drive"></i> <span><?php echo getEduAppGTLang('export_data'); ?></span></a>
					</li>
				</ul>
			</div>
		</div>
		<div class="content-i">
			<div class="content-box">
				<h5 class="form-header"><?php echo getEduAppGTLang('students_report'); ?></h5>
				<div class="content-i">
					<div class="content-box">
						<?php echo form_open(base_url() . 'admin/students_report/', array('class' => 'form m-b')); ?>
						<div class="row top-rd">
							<div class="col-sm-3">
								<div class="form-group label-floating is-select">
									<label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
									<div class="select">
										<select name="class_id" required="" onchange="get_sections(this.value)">
											<option value=""><?php echo getEduAppGTLang('select'); ?></option>
											<?php
											if(isSuperAdmin()){
													$classes = $this->db->get('class')->result_array();
												}else{
													$classes = $this->db->where('branch_id',getMyBranchId()->branch_id)->get('class')->result_array();
												}
											foreach ($classes as $row):
											?>
												<option value="<?php echo $row['class_id']; ?>" <?php if ($class_id == $row['class_id']) echo "selected"; ?>><?php echo $row['name']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group label-floating is-select">
									<label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
									<div class="select">
										<?php if ($section_id == ""): ?>
											<select name="section_id" required id="section_holder" onchange="get_class_subjects(this.value)">
												<option value=""><?php echo getEduAppGTLang('select'); ?></option>
											</select>
										<?php else: ?>
											<select name="section_id" required id="section_holder" onchange="get_class_subjects(this.value)">
												<option value=""><?php echo getEduAppGTLang('select'); ?></option>
												<?php
												$sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
												foreach ($sections as $key):
												?>
													<option value="<?php echo $key['section_id']; ?>" <?php if ($section_id == $key['section_id']) echo "selected"; ?>><?php echo $key['name']; ?></option>
												<?php endforeach; ?>
											</select>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group label-floating is-select">
									<label class="control-label"><?php echo getEduAppGTLang('subject'); ?></label>
									<div class="select">
										<?php if ($subject_id == ""): ?>
											<select name="subject_id" required id="subject_holder">
												<option value=""><?php echo getEduAppGTLang('select'); ?></option>
											</select>
										<?php else: ?>
											<select name="subject_id" required id="subject_holder">
												<option value=""><?php echo getEduAppGTLang('select'); ?></option>
												<?php
												$subjects = $this->db->get_where('subject', array('class_id' => $class_id, 'section_id' => $section_id))->result_array();
												foreach ($subjects as $key):
												?>
													<option value="<?php echo $key['subject_id']; ?>" <?php if ($subject_id == $key['subject_id']) echo "selected"; ?>><?php echo $key['name']; ?></option>
												<?php endforeach; ?>
											</select>
										<?php endif; ?>
									</div>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<button class="btn btn-success btn-upper top-20" type="submit"><span><?php echo getEduAppGTLang('get_report'); ?></span></button>
								</div>
							</div>
						</div>
						<?php echo form_close(); ?>
						<?php if ($class_id != "" && $section_id != "" && $subject_id != ""):
							$studentList = getActiveStudentBySubjectId($subject_id, $class_id, $section_id, $running_year);
						?>
							<div class="row">
								<div class="text-center col-sm-12"><br>
									<h4><?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?> - <?php echo getEduAppGTLang('section'); ?>: <?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name; ?></h4>
									<p><b><?php echo getEduAppGTLang('teacher'); ?>:</b> <?php echo $this->crud->get_name('teacher', $this->db->get_where('class', array('class_id' => $class_id))->row()->teacher_id); ?><br><b><?php echo count($studentList); ?></b> <?php echo getEduAppGTLang('students'); ?> | <b><?= getSubjectDetailBySubjectId($subject_id)->name ?></b> <?php echo getEduAppGTLang('subjects'); ?>.<br><b><?php echo getEduAppGTLang('running_year'); ?>:</b> <?php echo $running_year; ?></p>
								</div>
								<hr>
								<div class="col-sm-3 brd">
									<h5 class="form-header"><?php echo getEduAppGTLang('gender'); ?></h5>
									<canvas id="myChart" width="400" height="400"></canvas>
								</div>
								<div class="col-sm-9">
									<div class="element-box">
										<div class="form-header">
											<h6><?php echo getEduAppGTLang('students'); ?></h6>
										</div>
										<div class="table-responsive">
											<table width="100%" class="table table-striped table-lightfont">
												<thead>
													<tr>
														<th class="text-center"><?php echo getEduAppGTLang('name'); ?></th>
														<th class="text-center"><?php echo getEduAppGTLang('roll'); ?></th>
														<th class="text-center"><?php echo getEduAppGTLang('parent'); ?></th>
														<th class="text-center"><?php echo getEduAppGTLang('status'); ?></th>
														<th class="text-center"><?php echo getEduAppGTLang('gender'); ?></th>
													</tr>
												</thead>
												<tbody>
													<?php
													foreach ($studentList as $row):
													?>
														<tr>
															<td><img src="<?php echo $this->crud->get_image_url('student', $row->student_id); ?>" width="25px" class="tbl-user"> <?php echo $this->crud->get_name('student', $row->student_id); ?></td>
															<td class="text-center"><?php echo getRoll($row->student_id, $class_id, $section_id, $running_year) ?></td>
															<?php $parent_id = $this->db->get_where('student', array('student_id' => $row->student_id))->row()->parent_id; ?>
															<td class="text-center"><?php echo $this->crud->get_name('parent', $parent_id); ?></td>
															<td class="text-center">
																<?php if (isStudentActiveEnroll($row->student_id, $class_id, $section_id, $running_year)): ?>
																	<div class="pt-btn">
																		<a class="btn nc btn-success btn-sm btn-rounded">
																			<font color="white"><?php echo getEduAppGTLang('active'); ?></font>
																		</a>
																	</div>
																<?php else: ?>
																	<div class="pt-btn">
																		<a class="btn nc btn-danger btn-sm btn-rounded">
																			<font color="white"><?php echo getEduAppGTLang('inactive') . '-' . getEduAppGTLang('enroll'); ?></font>
																		</a>
																	</div>
																<?php endif; ?>
															</td>
															<td class="text-center">
																<?php if ($this->db->get_where('student', array('student_id' => $row->student_id))->row()->sex == 'F'): ?>
																	<span class="btn btn-sm btn-purple"> <?php echo $this->db->get_where('student', array('student_id' => $row->student_id))->row()->sex; ?></span>
																<?php else: ?>
																	<span class="btn btn-sm btn-primary"> <?php echo $this->db->get_where('student', array('student_id' => $row->student_id))->row()->sex; ?></span>
																<?php endif; ?>
															</td>
														</tr>
													<?php endforeach; ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		$male = 0;
		$female = 0;
		foreach ($studentList as $row) {
			if ($this->db->get_where('student', array('student_id' => $row->student_id))->row()->sex == "F") {
				$female += 1;
			} else {
				$male += 1;
			}
		}
		?>
		<input type="hidden" value="<?php echo getEduAppGTLang('female'); ?>" id="female" />
		<input type="hidden" value="<?php echo getEduAppGTLang('male'); ?>" id="male" />
		<input type="hidden" value="<?php echo $female; ?>" id="femaleval" />
		<input type="hidden" value="<?php echo $male; ?>" id="maleval" />
	</div>
</div>