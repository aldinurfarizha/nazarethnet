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
    						<a class="navs-links" href="<?php echo base_url(); ?>admin/grades_report/"><i class="picons-thin-icon-thin-0101_notes_text_notebook"></i> <span><?php echo getEduAppGTLang('grades_report'); ?></span></a>
    					</li>
    					<li class="navs-item">
    						<a class="navs-links" href="<?php echo base_url(); ?>admin/marks_report/"><i class="picons-thin-icon-thin-0100_to_do_list_reminder_done"></i> <span><?php echo getEduAppGTLang('final_marks'); ?></span></a>
    					</li>
    					<li class="navs-item">
    						<a class="navs-links" href="<?php echo base_url(); ?>admin/final_evaluation/"><i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i> <span>Evaluaciones Finales</span></a>
    					</li>
    					<li class="navs-item">
    						<a class="navs-links <?php if ($page_name == 'tabulation_report') echo "active"; ?>" href="<?php echo base_url(); ?>admin/tabulation_report/"><i class="picons-thin-icon-thin-0070_paper_role"></i> <span><?php echo getEduAppGTLang('tabulation_sheet'); ?></span></a>
    					</li>
    					<li class="navs-item">
    						<a class="navs-links" href="<?php echo base_url(); ?>admin/accounting_report/"><i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash"></i> <span><?php echo getEduAppGTLang('accounting'); ?></span></a>
    					</li>
    					<li class="navs-item">
    						<a class="navs-links" href="<?php echo base_url(); ?>admin/import_data/"><i class="picons-thin-icon-thin-0122_download_file_computer_drive"></i> <span><?php echo getEduAppGTLang('import_data'); ?></span></a>
    					</li>
    					<li class="navs-item">
    						<a class="navs-links" href="<?php echo base_url(); ?>admin/export_data/"><i class="picons-thin-icon-thin-0126_cloud_upload_backup"></i> <span><?php echo getEduAppGTLang('export_data'); ?></span></a>
    					</li>
    				</ul>
    			</div>
    		</div>
    		<div class="content-i">
    			<div class="content-box">
    				<h5 class="form-header"><?php echo getEduAppGTLang('tabulation_sheet'); ?></h5>
    				<hr>
    				<?php echo form_open(base_url() . 'admin/tabulation_report/', array('class' => 'form m-b')); ?>
    				<div class="row">
    					<div class="col-sm-3">
    						<div class="form-group is-select">
    							<label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
    							<div class="select">
    								<select name="class_id" required="" onchange="get_sections(this.value);">
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
    					<div class="col-sm-3">
    						<div class="form-group is-select">
    							<label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
    							<div class="select">
    								<?php if ($section_id == ""): ?>
    									<select name="section_id" required id="section_holder" onchange="get_class_subjects(this.value);get_student(this.value)">
    										<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    									</select>
    								<?php else: ?>
    									<select name="section_id" required id="section_holder" onchange="get_class_subjects(this.value);get_student(this.value)">
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
    					<div class="col-sm-4">
    						<div class="form-group is-select">
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
    					<div class="col-sm-2">
    						<div class="form-group">
    							<button class="btn btn-success btn-upper top-20" type="submit"><span><?php echo getEduAppGTLang('get_report'); ?></span></button>
    						</div>
    					</div>
    				</div>
    				<?php echo form_close(); ?>
    				<hr>
    				<?php if ($class_id != "" && $section_id != "" && $subject_id != ""): ?>
    					<div class="row"><br><br>
    						<a href="<?php echo base_url(); ?>admin/tab_sheet_print/<?php echo $class_id; ?>/<?php echo $section_id; ?>/<?php echo $subject_id; ?>" target="_blank"><button class="btn btn-purple btn-sm btn-rounded"><i class="picons-thin-icon-thin-0333_printer smxh"></i></button></a>
    						<a href="#" id="btnExport"><button class="btn btn-info btn-sm btn-rounded"><i class="picons-thin-icon-thin-0123_download_cloud_file_sync smxh"></i></button></a>
    						<div class="cuadro" id="print_area">
    							<center><img src="<?php echo base_url(); ?>public/uploads/<?php echo $this->crud->getInfo('logo'); ?>" alt="" width="5%" /></center>
    							<div class="titulosincss">
    								<div class="grande"><?php echo $this->crud->getInfo('system_name'); ?></div>
    								<div class="mediano"><?php echo $this->crud->getInfo('system_title'); ?></div>
    								<div class="grande"><?php echo getEduAppGTLang('tabulation_sheet'); ?></div>
    								<div class="mediano"><?php echo $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->name; ?></div>
    								<div class="mediano"><?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?> | <?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name; ?></div>
    							</div>
    							<table cellpading="0" cellspacing="0" border="1" class="bg-white pdauto" id="dvData">
    								<tr class="printbl">
    									<th class="text-center">#</th>
    									<th class="text-center"><?php echo getEduAppGTLang('gender'); ?></th>
    									<th class="text-center"><?php echo getEduAppGTLang('student'); ?></th>
    									<?php
										$exam = $this->db->get_where('exam', array('class_id' => $class_id, 'section_id' => $section_id, 'subject_id' => $subject_id))->result_array();
										foreach ($exam as $row):
										?>
    										<th class="text-center"><?php echo $row['name']; ?></th>
    									<?php endforeach; ?>
    								</tr>
    								<?php
									$n = 1;
									$m = 0;
									$f = 0;
									$students = $this->db->get_where('enroll', array('class_id' => $class_id, 'section_id' => $section_id, 'year' => $running_year))->result_array();
									foreach ($students as $row):
										if (isStudentFinishSubject($row['student_id'], $subject_id)) {
											continue;
										}
										if (!isActiveSubject($row['student_id'], $subject_id)) {
											continue;
										}
										if ($this->db->get_where('student', array('student_id' => $row['student_id']))->row()->sex == 'M') {
											$m += 1;
										} else {
											$f += 1;
										}
									?>
    									<tr class="text-center" id="student-<?php echo $row['student_id']; ?>">
    										<td class="text-center"><?php echo $n++; ?></td>
    										<td class="text-center"><?php if ($this->db->get_where('student', array('student_id' => $row['student_id']))->row()->sex == 'M') echo "M";
																	else echo "F"; ?></td>
    										<td class="text-center"><?php echo $this->crud->get_name('student', $row['student_id']); ?></td>
    										<?php
											$average = 0;
											$exams = $this->db->get_where('exam', array('class_id' => $class_id, 'section_id' => $section_id, 'subject_id' => $subject_id))->result_array();
											foreach ($exams as $key):
												if ($key['is_final']) {
													$average += countEvaluacionesFinales($key['exam_id'], $row['student_id']);
												} else {
													$average += $this->db->get_where('mark', array('student_id' => $row['student_id'], 'year' => $running_year, 'exam_id' => $key['exam_id'], 'subject_id' => $subject_id))->row()->final;
												}
											?>
    											<?php if ($key['is_final']) { ?>
    												<td class="text-center"><?php echo countEvaluacionesFinales($key['exam_id'], $row['student_id']); ?></td>
    											<?php } else { ?>
    												<td class="text-center"><?php echo $this->db->get_where('mark', array('student_id' => $row['student_id'], 'year' => $running_year, 'exam_id' => $key['exam_id'], 'subject_id' => $subject_id))->row()->final; ?></td>
    											<?php } ?>

    										<?php endforeach; ?>
    									</tr>
    								<?php endforeach; ?>
    							</table>
    							<table cellpading="0" cellspacing="0" border="0" class="pdauto wauto40">
    								<tr>
    									<td><?php echo getEduAppGTLang('mens'); ?></td>
    									<td><?php echo $m; ?></td>
    									<td><?php echo getEduAppGTLang('women'); ?></td>
    									<td><?php echo $f; ?></td>
    								</tr>
    							</table>
    							<table cellpading="0" cellspacing="0" border="0">
    								<tr>
    									<td><?php echo getEduAppGTLang('teacher'); ?></td>
    									<?php $teacher_id = $this->db->get_where('class', array('class_id' => $class_id))->row()->teacher_id; ?>
    									<td><?php echo $this->crud->get_name('teacher', $teacher_id); ?></td>
    								</tr>
    								<tr>
    									<td>&nbsp;</td>
    									<td></td>
    								</tr>
    								<tr>
    									<td><?php echo getEduAppGTLang('signature'); ?></td>
    									<td>_________________________________________</td>
    								</tr>
    							</table>
    						</div>
    					</div>
    				<?php endif; ?>
    			</div>
    		</div>
    	</div>
    </div>