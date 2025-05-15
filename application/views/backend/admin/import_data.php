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
    																<label for="file_excel"><strong>Select Excel/CSV File:</strong></label>
    																<input type="file" name="file_excel" id="file_excel" accept=".csv, .xlsx" class="form-control" required>
    															</div>
    															<div class="form-group mt-3">
    																<a href="<?= base_url('uploads/sample/student_sample.csv'); ?>" class="btn btn-sm btn-info">
    																	<i class="fas fa-download"></i> Download Sample CSV
    																</a>
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
    										<div class="row">
    											<h2>Grade</h2>
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