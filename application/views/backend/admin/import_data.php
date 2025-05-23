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
    						<a class="navs-links" href="<?php echo base_url(); ?>admin/tabulation_report/"><i class="picons-thin-icon-thin-0070_paper_role"></i> <span><?php echo getEduAppGTLang('tabulation_sheet'); ?></span></a>
    					</li>
    					<li class="navs-item">
    						<a class="navs-links" href="<?php echo base_url(); ?>admin/accounting_report/"><i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash"></i> <span><?php echo getEduAppGTLang('accounting'); ?></span></a>
    					</li>
    					<li class="navs-item">
    						<a class="navs-links <?php if ($page_name == 'import_data') echo "active"; ?>" href="<?php echo base_url(); ?>admin/import_data/"><i class="picons-thin-icon-thin-0126_cloud_upload_backup"></i> <span><?php echo getEduAppGTLang('import_data'); ?></span></a>
    					</li>
    					<li class="navs-item">
    						<a class="navs-links" href="<?php echo base_url(); ?>admin/export_data/"><i class="picons-thin-icon-thin-0122_download_file_computer_drive"></i> <span><?php echo getEduAppGTLang('export_data'); ?></span></a>
    					</li>
    				</ul>
    			</div>
    		</div>
    		<div class="content-i">
    			<div class="content-box">
    				<h5 class="form-header"><?php echo getEduAppGTLang('import_data'); ?></h5>
    				<hr>
    				<div class="row bg-white">
    					<div class="col-sm-12">
    						<div class="container-fluid">
    							<div class="row w-100">
    								<div class="os-tabs-w w-100">
    									<div class="os-tabs-controls w-100">
    										<ul class="navs navs-tabs upper d-flex justify-content-between w-100" style="gap: 10px;">
    											<li class="navs-item">
    												<a class="navs-links active" data-toggle="tab" href="#student">Student</a>
    											</li>
    											<li class="navs-item">
    												<a class="navs-links" data-toggle="tab" href="#grade">Grade</a>
    											</li>
    											<li class="navs-item">
    												<a class="navs-links" data-toggle="tab" href="#attendance">Attendance</a>
    											</li>
    										</ul>
    									</div>
    								</div>
    							</div>
    							<div class="container-fluid">
    								<div class="tab-content">

    									<!-- STUDENT TAB -->
    									<div class="tab-pane active" id="student">
    										<div class="row my-4">
    											<div class="col-md-12">
    												<div class="card shadow-sm border-0">
    													<div class="card-body">
    														<h5 class="card-title mb-3">
    															<i class="fas fa-file-excel text-success"></i> Import Student Data
    														</h5>
    														<form action="<?= base_url('admin/import/student'); ?>" method="POST" enctype="multipart/form-data">
    															<div class="form-group">
    																<label for="upload_student"><strong>Select Excel/CSV File:</strong></label>
    																<input type="file" name="upload_student" id="upload_student" accept=".xlsx" class="form-control" required>
    															</div>
    															<div class="form-group mt-3">
    																<a href="<?= base_url('public/uploads/sample_students.xlsx'); ?>" class="btn btn-sm btn-info">
    																	<i class="fas fa-download"></i> Download Sample CSV
    																</a>
    															</div>
    															<div class="row">
    																<div class="col-sm-3">
    																	<div class="form-group label-floating is-select">
    																		<label class="control-label"><?php echo getEduAppGTLang('branch'); ?></label>
    																		<div class="select">
    																			<select name="branch_id" required="" onchange="get_shifts(this.value); get_class(this.value);">
    																				<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    																				<?php
																					if (isSuperAdmin()) {
																						$branch = $this->db->where(['status' => 'ACTIVE'])->get('branch')->result_array();
																					} else {
																						$branch = $this->db->where(['branch_id' => getMyBranchId()->branch_id, 'status' => 'ACTIVE'])->get('branch')->result_array();
																					}

																					foreach ($branch as $row):
																					?>
    																					<option value="<?php echo $row['branch_id']; ?>"><?php echo $row['name']; ?></option>
    																				<?php endforeach; ?>
    																			</select>
    																		</div>
    																	</div>
    																</div>
    																<div class="col-sm-3">
    																	<div class="form-group label-floating is-select">
    																		<label class="control-label"><?php echo getEduAppGTLang('shifts'); ?></label>
    																		<div class="select">
    																			<select name="shifts_id" required id="shifts_holder">
    																				<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    																			</select>
    																		</div>
    																	</div>
    																</div>
    																<div class="col-sm-3">
    																	<div class="form-group label-floating is-select">
    																		<label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
    																		<div class="select">
    																			<select name="class_id" id="class_holder" required="" onchange="get_sections(this.value)">
    																				<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    																			</select>
    																		</div>
    																	</div>
    																</div>
    																<div class="col-sm-3">
    																	<div class="form-group label-floating is-select">
    																		<label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
    																		<div class="select">
    																			<select name="section_id" required id="section_holder">
    																				<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    																			</select>
    																		</div>
    																	</div>
    																</div>
    																<div class="col-sm-3">
    																	<div class="form-group">
    																		<label class="control-label"><?php echo getEduAppGTLang('roll'); ?></label>
    																		<input type="text" name="roll" class="form-control">
    																	</div>
    																</div>
    															</div>
    															<div class="form-group mt-4 text-end">
    																<button type="submit" class="btn btn-success">
    																	<i class="picons-thin-icon-thin-0089_upload_file"></i> Import Data
    																</button>
    															</div>
    														</form>
    													</div>
    												</div>
    											</div>
    										</div>
    									</div>

    									<!-- GRADE TAB -->
    									<div class="tab-pane" id="grade">
    										<div class="row my-4">
    											<div class="col-md-12">
    												<div class="card shadow-sm border-0">
    													<div class="card-body">
    														<div class="row">
    															<div class="col-md-6 border">
    																<h5 class="card-title mb-3">
    																	<i class="fas fa-file-excel text-success"></i> Import Exam Data
    																</h5>
    																<form action="<?= base_url('admin/import/grade'); ?>" method="POST" enctype="multipart/form-data">
    																	<img class="img-fluid img-rounded img-responsive" src="<?= base_url('public/uploads/exam_banner.png'); ?>" alt="">
    																	<div class="form-group">
    																		<label for="upload_exam"><strong>Select Excel/CSV File:</strong></label>
    																		<input type="file" name="upload_student" id="upload_student" accept=".xlsx" class="form-control" required>
    																	</div>
    																	<div class="form-group mt-3">
    																		<a href="<?= base_url('public/uploads/sample_exam.xlsx'); ?>" class="btn btn-sm btn-info">
    																			<i class="fas fa-download"></i> Download Sample CSV
    																		</a>
    																	</div>
    																	<div class="row">
    																		<div class="col-sm-3">
    																			<div class="form-group label-floating is-select">
    																				<label class="control-label"><?php echo getEduAppGTLang('branch'); ?></label>
    																				<div class="select">
    																					<select name="branch_id" required="" onchange="get_shifts(this.value); get_class(this.value);">
    																						<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    																						<?php
																							if (isSuperAdmin()) {
																								$branch = $this->db->where(['status' => 'ACTIVE'])->get('branch')->result_array();
																							} else {
																								$branch = $this->db->where(['branch_id' => getMyBranchId()->branch_id, 'status' => 'ACTIVE'])->get('branch')->result_array();
																							}

																							foreach ($branch as $row):
																							?>
    																							<option value="<?php echo $row['branch_id']; ?>"><?php echo $row['name']; ?></option>
    																						<?php endforeach; ?>
    																					</select>
    																				</div>
    																			</div>
    																		</div>
    																		<div class="col-sm-3">
    																			<div class="form-group label-floating is-select">
    																				<label class="control-label"><?php echo getEduAppGTLang('shifts'); ?></label>
    																				<div class="select">
    																					<select name="shifts_id" required id="shifts_holder">
    																						<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    																					</select>
    																				</div>
    																			</div>
    																		</div>
    																		<div class="col-sm-3">
    																			<div class="form-group label-floating is-select">
    																				<label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
    																				<div class="select">
    																					<select name="class_id" id="class_holder" required="" onchange="get_sections(this.value)">
    																						<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    																					</select>
    																				</div>
    																			</div>
    																		</div>
    																		<div class="col-sm-3">
    																			<div class="form-group label-floating is-select">
    																				<label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
    																				<div class="select">
    																					<select name="section_id" required id="section_holder">
    																						<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    																					</select>
    																				</div>
    																			</div>
    																		</div>
    																	</div>
    																	<div class="form-group mt-4 text-end">
    																		<button type="submit" class="btn btn-success">
    																			<i class="picons-thin-icon-thin-0089_upload_file"></i> Import Data
    																		</button>
    																	</div>
    																</form>
    															</div>
    															<div class="col-md-6">

    															</div>
    														</div>
    													</div>
    												</div>
    											</div>
    										</div>
    									</div>

    									<!-- ATTENDANCE TAB -->
    									<div class="tab-pane" id="attendance">
    										<div class="row">
    											<h2>Attendance</h2>
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