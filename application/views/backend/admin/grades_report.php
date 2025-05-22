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
						<a class="navs-links" href="<?php echo base_url(); ?>admin/students_report/"><i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i> <span><?php echo getEduAppGTLang('students'); ?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links" href="<?php echo base_url(); ?>admin/attendance_report/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i> <span><?php echo getEduAppGTLang('attendance'); ?></span></a>
					</li>
					<li class="navs-item">
						<a class="navs-links active" href="<?php echo base_url(); ?>admin/grades_report/"><i class="picons-thin-icon-thin-0101_notes_text_notebook"></i> <span><?php echo getEduAppGTLang('grades_report'); ?></span></a>
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
						<a class="navs-links" href="<?php echo base_url(); ?>admin/transfer_data/"><i class="picons-thin-icon-thin-0125_cloud_sync"></i> <span><?php echo getEduAppGTLang('transfer_data'); ?></span></a>
					</li>
				</ul>
			</div>
		</div>
		<div class="content-i">
			<div class="content-box">
				<h5 class="form-header"><?php echo getEduAppGTLang('grades_report'); ?></h5>
				<div class="row">
					<div class="content-i">
						<div class="content-box">
							<?php echo form_open(base_url() . 'admin/grades_report/check', array('class' => 'form m-b')); ?>
							<div class="row top-rd">
								<div class="col-sm-3">
									<div class="form-group label-floating is-select">
										<label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
										<div class="select">
											<select name="class_id" required="" onchange="get_sections(this.value)">
												<option value=""><?php echo getEduAppGTLang('select'); ?></option>
												<?php
												if (isSuperAdmin()) {
													$class = $this->db->get('class')->result_array();
												} else {
													$class = $this->db->where('branch_id', getMyBranchId()->branch_id)->get('class')->result_array();
												}
												foreach ($class as $row): ?>
													<option value="<?php echo $row['class_id']; ?>" <?php if ($class_id == $row['class_id']) echo "selected"; ?>><?php echo $row['name']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group label-floating is-select">
										<label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
										<div class="select">
											<?php if ($section_id == ""): ?>
												<select name="section_id" required id="section_holder" onchange="get_class_subjects(this.value);">
													<option value=""><?php echo getEduAppGTLang('select'); ?></option>
												</select>
											<?php else: ?>
												<select name="section_id" required id="section_holder" onchange="get_class_subjects(this.value);">
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
												<select name="subject_id" required id="subject_holder" onchange="get_exam(this.value);">
													<option value=""><?php echo getEduAppGTLang('select'); ?></option>
												</select>
											<?php else: ?>
												<select name="subject_id" required id="subject_holder" onchange="get_exam(this.value);">
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
									<div class="form-group label-floating is-select">
										<label class="control-label"><?php echo getEduAppGTLang('exam'); ?></label>
										<div class="select">
											<?php if ($exam_id == ""): ?>
												<select name="exam_id" required id="exam_holder">
													<option value=""><?php echo getEduAppGTLang('select'); ?></option>
												</select>
											<?php else: ?>
												<select name="exam_id" required id="exam_holder">
													<option value=""><?php echo getEduAppGTLang('select'); ?></option>
													<?php
													$exams = $this->db->get_where('exam', array('subject_id' => $subject_id, 'section_id' => $section_id))->result_array();
													foreach ($exams as $key):
													?>
														<option value="<?php echo $key['exam_id']; ?>" <?php if ($exam_id == $key['exam_id']) echo "selected"; ?>><?php echo $key['name']; ?></option>
													<?php endforeach; ?>
												</select>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										<button class="btn btn-success btn-upper top-20" type="submit"><span><?php echo getEduAppGTLang('get_report'); ?></span></button>
									</div>
								</div>
							</div>
							<?php echo form_close(); ?>
							<?php if ($class_id != '' && $section_id != '' && $subject_id != '' && $exam_id != ''): ?>
								<?php
								$finalEvaluaciones = 0;
								$is_final = $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->is_final; ?>
								<div class="row">
									<div class="text-center col-sm-12"><br>
										<h5><?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?> <br> <?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name; ?> <br> <?php echo $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->name; ?> <br><?php echo $this->db->get_where('exam', array('exam_id' => $exam_id))->row()->name; ?></h5>
										<a href="<?php echo base_url(); ?>admin/grades_report_excel/<?= $class_id . '/' . $section_id . '/' . $subject_id . '/' . $exam_id ?>" class="btn btn-success"> <?php echo getEduAppGTLang('excel'); ?> <i class="fa fa-download"></i></a>
									</div>
									<hr>
									<div class="col-7 text-left">
										<h5 class="form-header"><?php ?>
										</h5>
									</div>
								</div>
								<div class="table-responsive bg-white">
									<table class="table table-sm table-lightborder table-bordered">
										<thead>
											<tr class="text-center" height="30px">
												<td class="tbl-student"><?php echo getEduAppGTLang('student'); ?> </td>
												<?php $mark_activity = $this->db->get_where('mark_activity', array('exam_id' => $exam_id))->result_array();
												foreach ($mark_activity as $row): ?>
													<td class="tbl-student"><?php echo $row['name']; ?></td>
												<?php endforeach; ?>
												<?php if ($is_final) { ?>
													<td class="tbl-student" style="padding:5px">
														Evaluaciones Finales
													</td>
												<?php } else { ?>
													<td class="tbl-student">
														Prom
													</td>
												<?php } ?>
											</tr>
										</thead>
										<tbody>
											<?php $data = array();
											$students = $this->db->get_where('enroll', array('class_id' => $class_id, 'year' => $running_year, 'section_id' => $section_id))->result_array();
											foreach ($students as $row):
												if (!isStudentActiveEnroll($row['student_id'], $class_id, $section_id, $running_year)) {
													continue;
												}
												if (isStudentDeactive($row['student_id'])) {
													continue;
												}
												if (isStudentFinishSubject($row['student_id'], $subject_id)) {
													continue;
												}
												if (!isActiveSubject($row['student_id'], $subject_id)) {
													continue;
												}

											?>

												<tr>
													<td nowrap>
														<?php
														$student_id = $row['student_id'];
														$image_url = $this->crud->get_image_url('student', $student_id);
														$student_name = $this->crud->get_name('student', $student_id);
														?>
														<img src="<?= htmlspecialchars($image_url) ?>" width="20px" class="tbl-st" alt="">
														<?= htmlspecialchars($student_name) ?>
													</td>

													<?php foreach ($mark_activity as $row2): ?>
														<?php
														$nota_row = $this->db
															->order_by('nota_capacidad_id', 'ASC')
															->get_where('nota_capacidad', [
																'mark_activity_id' => $row2['mark_activity_id'],
																'student_id'       => $student_id
															])
															->row();
														$nota = isset($nota_row->nota) ? $nota_row->nota : '-';
														$finalEvaluaciones += ((int)$nota_row->nota * $row2['percent'] / 100);
														$updated_at = isset($nota_row->updated_at) ? $nota_row->updated_at : '-';
														?>
														<td class="text-center">
															<div class="fw-bold fs-6 mb-1">
																<span class="badge bg-primary"><?= htmlspecialchars($nota) ?></span>
															</div>
															<div class="text-muted small mb-1">
																<span class="badge bg-secondary"><?= $updated_at ?></span>
															</div>
															<div class="text-secondary small">
																<span class="badge bg-info"><?= getHistoryNotaCapacidad($nota_row->nota_capacidad_id) ?></span>
															</div>
														</td>
													<?php endforeach; ?>
													<?php if ($is_final) { ?>
														<td>
															<input type="text" class="commentInput text-center" style="background-color: #d3d3d3;" value="<?= $finalEvaluaciones ?>" disabled>
														</td>
													<?php } else { ?>
														<td class="text-center"><?= getFinalMark($student_id, $subject_id, $exam_id, $running_year) ?></td>
													<?php } ?>
												</tr>


											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>