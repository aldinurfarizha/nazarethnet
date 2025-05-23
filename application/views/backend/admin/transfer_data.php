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
    							<?php echo form_open(base_url() . 'admin/transfer_data_action', array('class' => 'form m-b', 'id' => 'transferForm')); ?>
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
    														<select name="branch_id_source" onchange="get_shifts(this.value); get_class(this.value);">
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
    														<select name="shifts_id_source" id="shifts_holder">
    															<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														</select>
    													</div>
    												</div>
    											</div>
    											<div class="col-sm-6">
    												<div class="form-group label-floating is-select">
    													<label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
    													<div class="select">
    														<select name="class_id_source" id="class_holder" onchange="get_sections(this.value)">
    															<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														</select>
    													</div>
    												</div>
    											</div>
    											<div class="col-sm-6">
    												<div class="form-group label-floating is-select">
    													<label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
    													<div class="select">
    														<select name="section_id_source" id="section_holder" onchange="get_class_subjects(this.value);">
    															<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														</select>
    													</div>
    												</div>
    											</div>
    											<div class="col-sm-6">
    												<div class="form-group label-floating is-select">
    													<label class="control-label"><?php echo getEduAppGTLang('subject'); ?></label>
    													<div class="select">
    														<select name="subject_id_source" id="subject_holder">
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
    														<select name="branch_id_target" onchange="get_shifts2(this.value); get_class2(this.value);">
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
    														<select name="shifts_id_target" id="shifts_holder2">
    															<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														</select>
    													</div>
    												</div>
    											</div>
    											<div class="col-sm-6">
    												<div class="form-group label-floating is-select">
    													<label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
    													<div class="select">
    														<select name="class_id_target" id="class_holder2" onchange="get_sections2(this.value)">
    															<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														</select>
    													</div>
    												</div>
    											</div>
    											<div class="col-sm-6">
    												<div class="form-group label-floating is-select">
    													<label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
    													<div class="select">
    														<select name="section_id_target" id="section_holder2" onchange="get_class_subjects2(this.value);">
    															<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														</select>
    													</div>
    												</div>
    											</div>
    											<div class="col-sm-6">
    												<div class="form-group label-floating is-select">
    													<label class="control-label"><?php echo getEduAppGTLang('subject'); ?></label>
    													<div class="select">
    														<select name="subject_id_target" id="subject_holder2">
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
    											<button class="btn btn-rounded btn-success btn-lg" id="transferBtn" type="submit"><?php echo getEduAppGTLang('transfer'); ?></button>
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