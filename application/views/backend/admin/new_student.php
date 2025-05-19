    <div class="content-w">
    	<?php include 'fancy.php'; ?>
    	<div class="header-spacer"></div>
    	<div class="content-i">
    		<div class="content-box">
    			<div class="conty">
    				<div class="ui-block">
    					<div class="ui-block-content">
    						<?php echo form_open(base_url() . 'admin/student/addmission/', array('enctype' => 'multipart/form-data', 'autocomplete' => 'off', 'id' => 'classSectionForm')); ?>
    						<div class="steps-w">
    							<div class="step-triggers">
    								<a class="step-trigger active" href="#stepContent1"><?php echo getEduAppGTLang('student_details'); ?></a>
    								<a class="step-trigger" href="#stepContent2"><?php echo getEduAppGTLang('class_section'); ?></a>
    								<a class="step-trigger" href="#stepContent3"><?php echo getEduAppGTLang('parent_details'); ?></a>
    								<a class="step-trigger" href="#stepContent4"><?php echo getEduAppGTLang('complementary_data'); ?></a>
    							</div>
    							<div class="step-contents">
    								<div class="step-content active" id="stepContent1">
    									<div class="row">
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('first_name'); ?></label>
    												<input class="form-control" name="first_name" type="text" required="">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('last_name'); ?></label>
    												<input class="form-control" name="last_name" type="text" required="">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group date-time-picker label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('birthday'); ?></label>
    												<input type='text' class="datepicker-here" data-position="bottom left" data-language='en' name="datetimepicker" data-multiple-dates-separator="/" />
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('email'); ?></label>
    												<input class="form-control" name="email" id="student_email" type="email">
    												<small><span id="email_result_student"></span></small>
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('phone'); ?></label>
    												<input class="form-control" name="phone" type="text">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating is-select">
    												<label class="control-label"><?php echo getEduAppGTLang('gender'); ?></label>
    												<div class="select">
    													<select name="gender" required="">
    														<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														<option value="M"><?php echo getEduAppGTLang('male'); ?></option>
    														<option value="F"><?php echo getEduAppGTLang('female'); ?></option>
    													</select>
    												</div>
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('username'); ?></label>
    												<input class="form-control" name="username" autocomplete="false" required="" type="text" id="user_student">
    												<small><span id="result_student"></span></small>
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('password'); ?></label>
    												<input class="form-control" name="password" required="" autocomplete="false" type="password">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('address'); ?></label>
    												<input class="form-control" name="address" type="text">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating is-select">
    												<label class="control-label"><?php echo getEduAppGTLang('transport'); ?></label>
    												<div class="select">
    													<select name="transport_id">
    														<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														<?php
															$bus = $this->db->get('transport')->result_array();
															foreach ($bus as $trans) :
															?>
    															<option value="<?php echo $trans['transport_id']; ?>"><?php echo $trans['route_name']; ?></option>
    														<?php endforeach; ?>
    													</select>
    												</div>
    											</div>
    										</div>
    										<div class="col col-lg-12 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating is-select">
    												<label class="control-label"><?php echo getEduAppGTLang('classroom'); ?></label>
    												<div class="select">
    													<select name="dormitory_id">
    														<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														<?php
															$classroom = $this->db->get('dormitory')->result_array();
															foreach ($classroom as $room) :
															?>
    															<option value="<?php echo $room['dormitory_id']; ?>"><?php echo $room['name']; ?></option>
    														<?php endforeach; ?>
    													</select>
    												</div>
    											</div>
    										</div>
											<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group label-floating is-select">
													<label class="control-label"><?php echo getEduAppGTLang('branch'); ?></label>
													<div class="select">
														<select name="branch_id" required="" onchange="get_shifts(this.value)">
															<option value=""><?php echo getEduAppGTLang('select'); ?></option>
															<?php
															foreach (getActiveBranch() as $row): ?>
																<option value="<?php echo $row->branch_id; ?>"><?php echo $row->name; ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
											</div>
											<hr>
											<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
												<div class="form-group label-floating is-select">
													<label class="control-label"><?php echo getEduAppGTLang('shifts'); ?></label>
													<div class="select">
													<select name="shifts_id" required id="shifts_holder">
														<option value=""><?php echo getEduAppGTLang('select'); ?></option>
													</select>
													</div>
												</div>
											</div>
    										<div class="col col-lg-12 col-md-12 col-sm-12 col-12">
    											<div class="form-group">
    												<label class="control-label"><?php echo getEduAppGTLang('photo'); ?></label>
    												<input class="form-control" placeholder="" name="userfile" type="file">
    											</div>
    										</div>
    									</div>
    									<div class="form-buttons-w text-right">
    										<a class="btn btn-rounded btn-success btn-lg step-trigger-btn" href="#stepContent2"><?php echo getEduAppGTLang('next'); ?></a>
    									</div>
    								</div>
    								<div class="step-content" id="stepContent2">
    									<div class="row" id="class_section">
    										<div class="col-3">
    											<div class="form-group label-floating is-select">
    												<label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
    												<div class="select">
    													<select name="class_id_temp" id="class_id" onchange="get_sections(this.value);">
    														<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														<?php $classes = $this->db->get('class')->result_array();
															foreach ($classes as $class) :
															?>
    															<option value="<?php echo $class['class_id']; ?>"><?php echo $class['name']; ?></option>
    														<?php endforeach; ?>
    													</select>
    												</div>
    											</div>
    										</div>
    										<div class="col-3">
    											<div class="form-group label-floating is-select">
    												<label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
    												<div class="select">
    													<select name="section_id_temp" id="section_holder">
    														<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    													</select>
    												</div>
    											</div>
    										</div>
    										<div class="col-3">
    											<div class="form-group label-floating is-select">
    												<label class="control-label"><?php echo getEduAppGTLang('roll'); ?></label>
    												<input type="text" name="roll_temp" id="roll" class="form-control">
    											</div>
    										</div>
    										<div class="col-3">
    											<div class="form-group label-floating is-select">
    												<label class="control-label">Status</label>
    												<div class="select">
    													<select name="is_active_temp" id="is_active">
    														<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														<option value="1">Active</option>
    														<option value="0">Disable</option>

    													</select>
    												</div>
    											</div>
    										</div>
    										<div class="col-12 text-right">
    											<button class="btn btn-primary" type="button" onclick="addClassSection()">
    												<i class="fa fa-plus"></i> <?= getEduAppGTLang('add') . ' ' . getEduAppGTLang('class_section'); ?>
    											</button>
    										</div>
    									</div>
    									<div class="row mt-3">
    										<div class="col-12">
    											<table class="table table-bordered" id="classSectionTable">
    												<thead>
    													<tr>
    														<th><?php echo getEduAppGTLang('class'); ?></th>
    														<th><?php echo getEduAppGTLang('section'); ?></th>
    														<th><?php echo getEduAppGTLang('roll'); ?></th>
    														<th><?php echo getEduAppGTLang('status'); ?></th>
    														<th><?php echo getEduAppGTLang('actions'); ?></th>
    													</tr>
    												</thead>
    												<tbody id="classSectionTableBody">
    													<!-- Data akan ditambahkan di sini -->
    												</tbody>
    											</table>
    										</div>
    									</div>
    									<div class="form-buttons-w text-right">
    										<a class="btn btn-rounded btn-success btn-lg step-trigger-btn" href="#stepContent3"><?php echo getEduAppGTLang('next'); ?></a>
    									</div>
    								</div>
    								<div class="step-content" id="stepContent3">
    									<div class="row">
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="description-toggle">
    												<div class="description-toggle-content">
    													<div class="h6"><?php echo getEduAppGTLang('new_parent_admission'); ?></div>
    													<p><?php echo getEduAppGTLang('new_parent_admission_message'); ?></p>
    												</div>
    												<div class="togglebutton">
    													<label><input type="checkbox" id="check" value="1" name="account"></label>
    												</div>
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12" id="initial">
    											<div class="form-group label-floating is-select">
    												<label class="control-label"><?php echo getEduAppGTLang('select_parent'); ?></label>
    												<div class="select">
    													<select name="parent_id">
    														<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														<?php $parents = $this->db->get('parent')->result_array();
															foreach ($parents as $parent) :
															?>
    															<option value="<?php echo $parent['parent_id']; ?>"><?php echo $parent['first_name'] . " " . $parent['last_name']; ?></option>
    														<?php endforeach; ?>
    													</select>
    												</div>
    											</div>
    										</div>
    									</div>
    									<div class="row" id="new_parent">
    										<div class="ui-block-title btm">
    											<h6 class="title"><?php echo getEduAppGTLang('parent_details'); ?></h6>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('first_name'); ?></label>
    												<input class="form-control" name="parent_first_name" type="text">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('last_name'); ?></label>
    												<input class="form-control" name="parent_last_name" type="text">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating is-select">
    												<label class="control-label"><?php echo getEduAppGTLang('gender'); ?></label>
    												<div class="select">
    													<select name="parent_gender">
    														<option value=""><?php echo getEduAppGTLang('select'); ?></option>
    														<option value="M"><?php echo getEduAppGTLang('male'); ?></option>
    														<option value="F"><?php echo getEduAppGTLang('female'); ?></option>
    													</select>
    												</div>
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('email'); ?></label>
    												<input class="form-control" name="parent_email" id="parent_email" type="email">
    												<small><span id="email_result_parent"></span></small>
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('username'); ?></label>
    												<input class="form-control" name="parent_username" autocomplete="false" type="text" id="parent_username">
    												<small><span id="result"></span></small>
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('password'); ?></label>
    												<input class="form-control" name="parent_password" autocomplete="false" type="password">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('phone'); ?></label>
    												<input class="form-control" name="parent_phone" type="text">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('identification'); ?></label>
    												<input class="form-control" name="parent_idcard" type="text">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('profession'); ?></label>
    												<input class="form-control" name="parent_profession" type="text">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('address'); ?></label>
    												<input class="form-control" name="parent_address" type="text">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('home_phone'); ?></label>
    												<input class="form-control" name="parent_home_phone" type="text">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('business_work'); ?></label>
    												<input class="form-control" name="parent_business" type="text">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('phone_work'); ?></label>
    												<input class="form-control" name="parent_business_phone" type="text">
    											</div>
    										</div>
    									</div>
    									<div class="form-buttons-w text-right">
    										<a class="btn btn-rounded btn-success btn-lg step-trigger-btn" href="#stepContent4"><?php echo getEduAppGTLang('next'); ?></a>
    									</div>
    								</div>
    								<div class="step-content" id="stepContent4">
    									<div class="row">
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('conditions_or_diseases'); ?></label>
    												<input class="form-control" name="diseases" type="text">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('allergies'); ?></label>
    												<input class="form-control" name="allergies" type="text">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('personal_doctor'); ?></label>
    												<input class="form-control" name="doctor" type="text">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('doctor_phone'); ?></label>
    												<input class="form-control" name="doctor_phone" type="text">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('athorized_person'); ?></label>
    												<input class="form-control" name="auth_person" type="text">
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('phone_authorized_person'); ?></label>
    												<input class="form-control" name="auth_phone" type="text">
    											</div>
    										</div>
    										<div class="col col-lg-12 col-md-12 col-sm-12 col-12">
    											<div class="form-group label-floating">
    												<label class="control-label"><?php echo getEduAppGTLang('notes'); ?>:</label>
    												<textarea class="form-control" name="note"></textarea>
    											</div>
    										</div>
    										<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
    											<div class="description-toggle">
    												<div class="description-toggle-content">
    													<div class="h6"><?php echo getEduAppGTLang('download_adminssion_sheet'); ?></div>
    													<p><?php echo getEduAppGTLang('download_adminssion_sheet_message'); ?></p>
    												</div>
    												<div class="togglebutton">
    													<label><input type="checkbox" value="1" name="download_pdf"></label>
    												</div>
    											</div>
    										</div>
    									</div>
    									<div class="form-buttons-w text-right">
    										<button class="btn btn-rounded btn-success btn-lg" type="submit" onclick="prepareFormData()" id="sub_form"><?php echo getEduAppGTLang('register'); ?></button>
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
    </div>
    <script>
    	let classSections = [];

    	function addClassSection() {
    		const classId = document.getElementById('class_id').value;
    		const sectionId = document.getElementById('section_holder').value;
    		const roll = document.getElementById('roll').value;
    		const is_active = document.getElementById('is_active').value;


    		if (classId === '' || sectionId === '' || roll === '' || is_active === '') {
    			alert('Please fill all fields');
    			return;
    		}
    		for (const section of classSections) {
    			if (section.classId === classId && section.sectionId === sectionId) {
    				alert('Class and Section already added.');
    				return;
    			}
    		}


    		const className = document.querySelector('#class_id option:checked').textContent;
    		const sectionName = document.querySelector('#section_holder option:checked').textContent;
    		const isActiveName = document.querySelector('#is_active option:checked').textContent;

    		classSections.push({
    			classId,
    			className,
    			sectionId,
    			sectionName,
    			isActiveName,
    			is_active,
    			roll
    		});

    		document.getElementById('class_id').value = '';
    		document.getElementById('section_holder').value = '';
    		document.getElementById('roll').value = '';
    		document.getElementById('is_active').value = '';

    		renderClassSectionTable();
    	}

    	function renderClassSectionTable() {
    		const tableBody = document.getElementById('classSectionTableBody');
    		tableBody.innerHTML = '';

    		classSections.forEach((section, index) => {
    			const row = document.createElement('tr');

    			row.innerHTML = `
            <td>${section.className}</td>
            <td>${section.sectionName}</td>
            <td>${section.roll}</td>
			<td>${section.isActiveName}</td>
            <td><button class="btn btn-danger" onclick="removeClassSection(${index})">Delete</button></td>
        `;

    			tableBody.appendChild(row);
    		});
    	}

    	function removeClassSection(index) {
    		classSections.splice(index, 1);
    		renderClassSectionTable();
    	}

    	function prepareFormData() {
    		const form = document.getElementById('classSectionForm');

    		const hiddenInputs = document.querySelectorAll('.hidden-input');
    		hiddenInputs.forEach(input => input.remove());


    		classSections.forEach((section, index) => {
    			const classInput = document.createElement('input');
    			classInput.type = 'hidden';
    			classInput.name = `class_id[${index}]`;
    			classInput.value = section.classId;
    			classInput.classList.add('hidden-input');
    			form.appendChild(classInput);

    			const sectionInput = document.createElement('input');
    			sectionInput.type = 'hidden';
    			sectionInput.name = `section_id[${index}]`;
    			sectionInput.value = section.sectionId;
    			sectionInput.classList.add('hidden-input');
    			form.appendChild(sectionInput);

    			const rollInput = document.createElement('input');
    			rollInput.type = 'hidden';
    			rollInput.name = `roll[${index}]`;
    			rollInput.value = section.roll;
    			rollInput.classList.add('hidden-input');
    			form.appendChild(rollInput);

    			const isActiveInput = document.createElement('input');
    			isActiveInput.type = 'hidden';
    			isActiveInput.name = `is_active[${index}]`;
    			isActiveInput.value = section.is_active;
    			isActiveInput.classList.add('hidden-input');
    			form.appendChild(isActiveInput);
    		});
    	}
    </script>