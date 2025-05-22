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
    						<a class="navs-links <?php if ($page_name == 'transfer_data') echo "active"; ?>" href="<?php echo base_url(); ?>admin/transfer_data/"><i class="picons-thin-icon-thin-0125_cloud_sync"></i> <span><?php echo getEduAppGTLang('transfer_data'); ?></span></a>
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
    							<?php echo form_open(base_url() . 'admin/transfer_data_action', array('class' => 'form m-b')); ?>
    							<div class="steps-w">
    								<div class="step-triggers">
    									<a class="step-trigger active" href="#stepContent1"><?php echo getEduAppGTLang('source'); ?></a>
    									<a class="step-trigger" href="#stepContent2"><?php echo getEduAppGTLang('target'); ?></a>
    									<a class="step-trigger" href="#stepContent3"><?php echo getEduAppGTLang('option'); ?></a>
    								</div>
    								<div class="step-contents">
    									<div class="step-content active" id="stepContent1">
    										<div class="row">
    											<div class="col-md-12">
    												<h3 class="text-center mb-3"><?php echo getEduAppGTLang('source'); ?></h3>
    											</div>
    											<div class="col-sm-6">
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
    											<div class="col-sm-6">
    												<div class="form-group label-floating is-select">
    													<label class="control-label"><?php echo getEduAppGTLang('shifts'); ?></label>
    													<div class="select">
    														<select name="shifts_id" required id="shifts_holder">
    															<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														</select>
    													</div>
    												</div>
    											</div>
    											<div class="col-sm-6">
    												<div class="form-group label-floating is-select">
    													<label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
    													<div class="select">
    														<select name="class_id" id="class_holder" required="" onchange="get_sections(this.value)">
    															<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														</select>
    													</div>
    												</div>
    											</div>
    											<div class="col-sm-6">
    												<div class="form-group label-floating is-select">
    													<label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
    													<div class="select">
    														<select name="section_id" required id="section_holder" onchange="get_class_subjects(this.value);">
    															<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														</select>
    													</div>
    												</div>
    											</div>
    											<div class="col-sm-6">
    												<div class="form-group label-floating is-select">
    													<label class="control-label"><?php echo getEduAppGTLang('subject'); ?></label>
    													<div class="select">
    														<select name="subject_id_source" required id="subject_holder">
    															<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														</select>
    													</div>
    												</div>
    											</div>
    											<hr>
    										</div>
    										<div class="form-buttons-w text-right">
    											<a class="btn btn-rounded btn-success btn-lg step-trigger-btn" href="#stepContent2"><?php echo getEduAppGTLang('next'); ?></a>
    										</div>
    									</div>
    									<div class="step-content" id="stepContent2">
    										<div class="row">
    											<div class="col-md-12">
    												<h3 class="text-center mb-3"><?php echo getEduAppGTLang('target'); ?></h3>
    											</div>
    											<div class="col-sm-6">
    												<div class="form-group label-floating is-select">
    													<label class="control-label"><?php echo getEduAppGTLang('branch'); ?></label>
    													<div class="select">
    														<select name="branch_id" required="" onchange="get_shifts2(this.value); get_class2(this.value);">
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
    											<div class="col-sm-6">
    												<div class="form-group label-floating is-select">
    													<label class="control-label"><?php echo getEduAppGTLang('shifts'); ?></label>
    													<div class="select">
    														<select name="shifts_id" required id="shifts_holder2">
    															<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														</select>
    													</div>
    												</div>
    											</div>
    											<div class="col-sm-6">
    												<div class="form-group label-floating is-select">
    													<label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
    													<div class="select">
    														<select name="class_id" id="class_holder2" required="" onchange="get_sections2(this.value)">
    															<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														</select>
    													</div>
    												</div>
    											</div>
    											<div class="col-sm-6">
    												<div class="form-group label-floating is-select">
    													<label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
    													<div class="select">
    														<select name="section_id" required id="section_holder2" onchange="get_class_subjects2(this.value);">
    															<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														</select>
    													</div>
    												</div>
    											</div>
    											<div class="col-sm-6">
    												<div class="form-group label-floating is-select">
    													<label class="control-label"><?php echo getEduAppGTLang('subject'); ?></label>
    													<div class="select">
    														<select name="subject_id_target" required id="subject_holder2">
    															<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														</select>
    													</div>
    												</div>
    											</div>
    											<hr>
    										</div>
    										<div class="form-buttons-w text-right">
    											<a class="btn btn-rounded btn-success btn-lg step-trigger-btn" href="#stepContent3"><?php echo getEduAppGTLang('next'); ?></a>
    										</div>
    									</div>
    									<div class="step-content" id="stepContent3">
    										<div class="row" id="new_parent">
    											<div class="col-md-12">
    												<div class="description-toggle">
    													<div class="description-toggle-content">
    														<div class="h6"><?php echo getEduAppGTLang('transfer_exam'); ?></div>
    														<p><?php echo getEduAppGTLang('transfer_all_exam'); ?></p>
    													</div>
    													<div class="togglebutton">
    														<label><input type="checkbox" checked name="exam"></label>
    													</div>
    												</div>
    											</div>
    											<div class="col-md-12">
    												<div class="description-toggle">
    													<div class="description-toggle-content">
    														<div class="h6"><?php echo getEduAppGTLang('transfer_activities'); ?></div>
    														<p><?php echo getEduAppGTLang('transfer_all_activities'); ?></p>
    													</div>
    													<div class="togglebutton">
    														<label><input type="checkbox" checked name="activity"></label>
    													</div>
    												</div>
    											</div>
    											<div class="col-md-12">
    												<div class="description-toggle">
    													<div class="description-toggle-content">
    														<div class="h6"><?php echo getEduAppGTLang('transfer_students_grade'); ?></div>
    														<p><?php echo getEduAppGTLang('transfer_all_student_grade'); ?></p>
    													</div>
    													<div class="togglebutton">
    														<label><input type="checkbox" checked name="grade"></label>
    													</div>
    												</div>
    											</div>
    											<div class="col-md-12">
    												<div class="description-toggle">
    													<div class="description-toggle-content">
    														<div class="h6"><?php echo getEduAppGTLang('transfer_attendance'); ?></div>
    														<p><?php echo getEduAppGTLang('transfer_all_attendance'); ?></p>
    													</div>
    													<div class="togglebutton">
    														<label><input type="checkbox" checked name="attendance"></label>
    													</div>
    												</div>
    											</div>
    										</div>
    										<div class="form-buttons-w text-right">
    											<button class="btn btn-rounded btn-success btn-lg" type="submit"><?php echo getEduAppGTLang('transfer'); ?></button>
    										</div>
    									</div>
    								</div>
    							</div>
    							<?php echo form_close(); ?>
    						</div>
    					</div>

    				</div>
    			</div>
    		</div>
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
    						get_sections(options[i].value);
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