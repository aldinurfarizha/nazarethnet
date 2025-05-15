<?php
$running_year = $this->crud->getInfo('running_year');
$min = $this->db->get_where('academic_settings', array('type' => 'minium_mark'))->row()->description;
?>
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
						<a class="navs-links" href="<?php echo base_url(); ?>admin/students_report/"><i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i> <span><?php echo getEduAppGTLang('students'); ?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links" href="<?php echo base_url(); ?>admin/attendance_report/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i> <span><?php echo getEduAppGTLang('attendance'); ?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links <?php if ($page_name == 'grades_report') echo "active"; ?>" href="<?php echo base_url(); ?>admin/grades_report/"><i class="picons-thin-icon-thin-0101_notes_text_notebook"></i> <span><?php echo getEduAppGTLang('grades_report'); ?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links <?php if ($page_name == 'marks_report') echo "active"; ?>" href="<?php echo base_url(); ?>admin/marks_report/"><i class="picons-thin-icon-thin-0100_to_do_list_reminder_done"></i> <span><?php echo getEduAppGTLang('final_marks'); ?></span></a>
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
				<h5 class="form-header"><?php echo getEduAppGTLang('student_card'); ?></h5>
				<hr>
				<?php echo form_open(base_url() . 'admin/marks_report/', array('class' => 'form m-b')); ?>
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group is-select">
							<label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
							<div class="select">
								<select name="class_id" required="" onchange="get_sections(this.value)">
									<option value=""><?php echo getEduAppGTLang('select'); ?></option>
									<?php
									$class = $this->db->get('class')->result_array();
									foreach ($class as $row): ?>
										<option value="<?php echo $row['class_id']; ?>" <?php if ($class_id == $row['class_id']) echo "selected"; ?>><?php echo $row['name']; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group is-select">
							<label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
							<div class="select">
								<?php if ($section_id == ""): ?>
									<select name="section_id" required id="section_holder" onchange="get_student(this.value); get_exam_section(this.value);">
										<option value=""><?php echo getEduAppGTLang('select'); ?></option>
									</select>
								<?php else: ?>
									<select name="section_id" required id="section_holder" onchange="get_student(this.value); get_exam_section(this.value);">
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
						<div class="form-group is-select">
							<label class="control-label"><?php echo getEduAppGTLang('student'); ?></label>
							<div class="select">
								<?php if ($student_id == ""): ?>
									<select name="student_id" required id="student_holder">
										<option value=""><?php echo getEduAppGTLang('select'); ?></option>
									</select>
								<?php else: ?>
									<select name="student_id" required id="student_holder">
										<option value=""><?php echo getEduAppGTLang('select'); ?></option>
										<?php
										$students = $this->db->get_where('enroll', array('class_id' => $class_id))->result_array();
										foreach ($students as $key):
										?>
											<option value="<?php echo $key['student_id']; ?>" <?php if ($student_id == $key['student_id']) echo "selected"; ?>><?php echo $this->crud->get_name('student', $key['student_id']); ?></option>
										<?php endforeach; ?>
									</select>
								<?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group is-select">
							<label class="control-label"><?php echo getEduAppGTLang('semester'); ?></label>
							<div class="select">
								<select name="exam_id" required id="exam_holder">
									<?php if ($exam_id) {
										$this->db->select('exam.*, subject.name as subject_name');
										$this->db->from('exam');
										$this->db->join('subject', 'exam.subject_id = subject.subject_id', 'inner');
										$this->db->where('exam.exam_id', $exam_id);
										$selectedExam = $this->db->get()->row();
									?>
										<option value="<?= $exam_id ?>" selected><?= $selectedExam->name . ' (' . $selectedExam->subject_name . ')' ?></option>
										<?php
										$this->db->select('exam.*, subject.name as subject_name');
										$this->db->from('exam');
										$this->db->join('subject', 'exam.subject_id = subject.subject_id', 'inner');
										$this->db->where('exam.section_id', $selectedExam->section_id);
										$examData = $this->db->get()->result();
										foreach ($examData as $exa) {
											if ($exa->exam_id == $exam_id) {
												continue;
											}
										?>
											<option value="<?= $exa->exam_id ?>"><?= $exa->name . ' (' . $exa->subject_name . ')' ?> </option>
										<?php } ?>
									<?php } else { ?>
										<option value="" selected><?php echo getEduAppGTLang('select'); ?></option>
									<?php } ?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-sm-1">
						<div class="form-group">
							<button class="btn btn-success btn-upper top-20" type="submit"><i class="picons-thin-icon-thin-0154_ok_successful_check"></i></button>
						</div>
					</div>
				</div>
				<hr>
				<?php echo form_close(); ?>
				<?php if ($class_id != "" && $section_id != "" && $student_id != "" && $exam_id != ""): ?>
					<div class="element-wrapper">
						<div class="rcard-w">
							<div class="infos">
								<div class="info-1">
									<div class="rcard-logo-w">
										<img alt="" src="<?php echo base_url(); ?>public/uploads/<?php echo $this->crud->getInfo('logo'); ?>">
									</div>
									<div class="company-name"><?php echo $system_name; ?></div>
									<div class="company-address"><?php echo getEduAppGTLang('marks'); ?></div>
									<div class="company-address"><?php echo $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name; ?></div>
								</div>
								<div class="info-2">
									<div class="rcard-profile">
										<img alt="" src="<?php echo $this->crud->get_image_url('student', $student_id); ?>">
									</div>
									<div class="company-name"><?php echo $this->crud->get_name('student', $student_id); ?></div>
									<div class="company-address">
										<?php echo getEduAppGTLang('roll'); ?>: <?php echo $this->db->get_where('enroll', array('student_id' => $student_id))->row()->roll; ?><br /><?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?><br /><?php echo $this->db->get_where('section', array('class_id' => $class_id))->row()->name; ?>
									</div>
								</div>
							</div>
							<div class="rcard-heading">
								<h5><?php echo $exam_name; ?></h5>
								<div class="rcard-date"><?php echo $class_name; ?></div>
							</div>
							<div class="rcard-table table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th class="text-center"><?php echo getEduAppGTLang('subject'); ?></th>
											<th class="text-center"><?php echo getEduAppGTLang('teacher'); ?></th>
											<th class="text-center"><?php echo getEduAppGTLang('mark'); ?></th>
											<th class="text-center"><?php echo getEduAppGTLang('prom'); ?></th>
											<th class="text-center"><?php echo getEduAppGTLang('comment'); ?></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$exams = $this->crud->get_exams();
										$subjects = $this->db->get_where('subject', array('class_id' => $class_id, 'section_id' => $section_id))->result_array();
										foreach ($subjects as $row3):
											$mark = $this->db->get_where('mark', array('student_id' => $student_id, 'subject_id' => $row3['subject_id'], 'class_id' => $class_id, 'exam_id' => $exam_id, 'year' => $running_year));
											if ($mark->num_rows() > 0) {
												$marks = $mark->result_array();
												foreach ($marks as $row4):
													$examDetail = getExamDetail($exam_id);
										?>
													<tr>
														<td><?php echo $row3['name']; ?></td>
														<td><?php echo $this->crud->get_name('teacher', $row3['teacher_id']); ?></td>
														<td class="text-center"><?php echo $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $exam_id, 'student_id' => $student_id, 'year' => $running_year))->row()->mark_obtained; ?></td>
														<td>
															<?php if ($examDetail->is_final) {
																echo countEvaluacionesFinales($examDetail->exam_id,  $student_id);
															} else {
																echo $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $exam_id, 'student_id' => $student_id, 'year' => $running_year))->row()->final;
															}
															?>
														</td>
														<td class="text-center"><?php echo $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $exam_id, 'student_id' => $student_id, 'year' => $running_year))->row()->comment; ?></td>
													</tr>
										<?php endforeach;
											}
										endforeach; ?>
									</tbody>
								</table>
							</div>
							<div class="rcard-footer">
								<div class="rcard-logo">
									<img alt="" src="<?php echo base_url(); ?>public/uploads/<?php echo $this->crud->getInfo('logo'); ?>"><span><?php echo $system_name; ?></span>
								</div>
								<div class="rcard-info">
									<span><?php echo $system_email; ?></span><span><?php echo $phone; ?></span>
								</div>
							</div>
						</div>
					</div>
			</div>
		<?php endif; ?>
		</div>
	</div>
</div>