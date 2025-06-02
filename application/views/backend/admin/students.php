<?php $running_year = $this->crud->getInfo('running_year'); ?>
<div class="content-w">
	<?php include 'fancy.php'; ?>
	<div class="header-spacer"></div>
	<div class="conty">
		<div class="all-wrapper no-padding-content solid-bg-all">
			<div class="layout-w">
				<div class="content-w">
					<div class="content-i">
						<div class="content-box">
							<div class="app-email-w">
								<div class="app-email-i">
									<div class="ae-content-w grbg">
										<div class="top-header top-header-favorit">
											<div class="top-header-thumb">
												<img src="<?php echo base_url(); ?>public/uploads/<?php echo $this->crud->getInfo('bglogin'); ?>" class="bgcover">
												<div class="top-header-author">
													<div class="author-thumb">
														<img src="<?php echo base_url(); ?>public/uploads/<?php echo $this->crud->getInfo('logo'); ?>" class="authorCv">
													</div>
													<div class="author-content">
														<a href="javascript:void(0);" class="h3 author-name"><?php echo getEduAppGTLang('students'); ?></a>
														<div class="country"><?php echo $this->crud->getInfo('system_name'); ?> | <?php echo $this->crud->getInfo('system_title'); ?></div>
													</div>
												</div>
											</div>
											<div class="profile-section bg-white">
												<div class="control-block-button">
													<a data-toggle="modal" data-target="#bulkstudents" href="javascript:void(0);" class="btn btn-control bg-purple c-btn-purple">
														<i class="picons-thin-icon-thin-0089_upload_file" title="<?php echo getEduAppGTLang('upload_from_excel'); ?>"></i>
													</a>
													<a href="javascript:void(0);" data-toggle="modal" data-target="#student_export" class="btn btn-control bg-purple grbg22">
														<i class="picons-thin-icon-thin-0129_download" title="<?php echo getEduAppGTLang('export_students'); ?>"></i>
													</a>
												</div>
											</div>
										</div>
										<div class="aec-full-message-w">
											<div class="aec-full-message">
												<div class="container-fluid grbg"><br>
													<div class="col-sm-12">
														<?php echo form_open(base_url() . 'admin/students/', array('class' => 'form m-b')); ?>
														<div class="row">
															<div class="col col-lg-2 col-md-6 col-sm-12 col-12">
																<div class="form-group label-floating is-select">
																	<label class="control-label"><?php echo getEduAppGTLang('filter_by_branch'); ?></label>
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
															<div class="col col-lg-2 col-md-6 col-sm-12 col-12">
																<div class="form-group label-floating is-select">
																	<label class="control-label"><?php echo getEduAppGTLang('filter_by_shifts'); ?></label>
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
															<div class="col col-lg-4 col-md-6 col-sm-12 col-12">
																<div class="form-group label-floating is-select">
																	<label class="control-label"><?php echo getEduAppGTLang('filter_by_class'); ?></label>
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
															<div class="col col-lg-3 col-md-6 col-sm-12 col-12">
																<div class="form-group label-floating is-select">
																	<label class="control-label"><?php echo getEduAppGTLang('filter_by_section'); ?></label>
																	<div class="select">
																		<select name="section_id" id="section_holder">
																			<?php if($section_id!=null){?>
																				<option value="<?php echo $section_id; ?>"><?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name; ?></option>
																			<?php }else{?>
																			<option value=""><?php echo getEduAppGTLang('all'); ?></option>
																			<?php }?>
																		</select>
																	</div>
																</div>
															</div>
															<div class="col col-lg-1 col-md-6 col-sm-12 col-12 d-flex justify-content-center">
																<div class="form-group mb-0">
																	<button class="btn btn-primary mt-2">
																		<?php echo getEduAppGTLang('filter'); ?> <i class="fa fa-search"></i>
																	</button>
																</div>
															</div>

														</div>
														<?php echo form_close(); ?>
														<div class="row">
															<div class="col-md-12">
																<div class="card">
																<div class="card-body">
																	<div class="content-box">
																		<div class="row">
																			<div class="table-responsive">
																				<table id="studentTable" class="table table-striped table-hover">
																					<thead>
																						<tr>
																							<td>No.</td>
																							<td><?= getEduAppGTLang('name'); ?></td>
																							<td><?= getEduAppGTLang('phone'); ?></td>
																							<td><?= getEduAppGTLang('email'); ?></td>
																							<td><?= getEduAppGTLang('branch_and_shifts'); ?></td>
																							<td><?= getEduAppGTLang('class_section'); ?></td>
																							<td><?= getEduAppGTLang('action'); ?></td>
																						</tr>
																					</thead>
																					<tbody>
																						<?php
																						$where['is_active'] = 1;
																						$students = $this->db->get_where('student', $where)->result();
																						$no = 1;
																						foreach($students as $row): 
																						$branch_shifts='<span class="badge bg-danger">'.getEduAppGTLang('not_assigned').'</span>';
																						if($row->branch_id!=null && $row->shifts_id!=null){
																							$branch=getDetailBranch($row->branch_id);
																							$shifts=getDetailShifts($row->shifts_id);
																							$branch_shifts=$branch->name.' - '.$shifts->name;
																						}
																						if($branch_id!=null){
																							if($row->branch_id!=$branch_id){
																								continue;
																							}
																							
																						}
																						if($shifts_id!=null){
																							if($row->shifts_id!=$shifts_id){
																								continue;
																							}
																						}
																						$activeClassAndSection=getStudentClassAndSectionById($row->student_id);
																						if($class_id!=null){
																							$totalClassMatched=0;
																							foreach($activeClassAndSection as $classAndSection){
																								if($classAndSection->class_id==$class_id){
																									$totalClassMatched++;
																								}
																							}
																							if($totalClassMatched==0){
																								continue;
																							}
																						}
																						if($section_id!=null){
																							$totalSectionMatched=0;
																							foreach($activeClassAndSection as $classAndSection){
																								if($classAndSection->section_id==$section_id){
																									$totalSectionMatched++;
																								}
																							}
																							if($totalSectionMatched==0){
																								continue;
																							}
																						}
																						
																						$classSection='';
																						if(count($activeClassAndSection)==0){
																							$classSection='<span class="badge bg-danger">'.getEduAppGTLang('not_assigned').'</span>';
																						}else{
																							foreach($activeClassAndSection as $classAndSection){
																							$classSection.='<span class="badge bg-primary">'.$classAndSection->class_name.' - '.$classAndSection->section_name.'</span><br/>';
																							}
																						}
																						
																						?>
																						<tr>
																							<td><?=$no;?></td>
																							<td><a href="<?=base_url('admin/student_profile_active_course/'.$row->student_id.'');?>"><?=$row->first_name.' '.$row->last_name; ?></a></td>
																							<td><?=$row->phone; ?></td>
																							<td><?=$row->email; ?></td>
																							<td><?=$branch_shifts; ?></td>
																							<td><?=$classSection; ?></td>
																							<td>
																								<div class="more">
																									<i class="icon-options"></i>
																									<ul class="more-dropdown">
																										<li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url(); ?>modal/popup/modal_estudiante/<?php echo $row->student_id; ?>');"><?php echo getEduAppGTLang('edit'); ?></a></li>
																										<li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete'); ?>')" href="<?php echo base_url(); ?>admin/delete_student/<?php echo $row->student_id; ?>"><?php echo getEduAppGTLang('delete'); ?></a></li>
																										<li><a href="<?=base_url('admin/student_profile_active_course/'.$row->student_id.'');?>"><?=getEduAppGTLang('profile'); ?></a></li>
																									</ul>
																								</div>
																							</td>
																						</tr>
																						<?php $no++; endforeach;?>
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
						</div>
					</div>
				</div>
			</div>
			<div class="display-type"></div>
		</div>
	</div>
</div>


<div class="modal fade top150" id="student_export" tabindex="-1" role="dialog" aria-labelledby="student_export" aria-hidden="true">
	<div class="modal-dialog window-popup edit-widget edit-widget-twitter" role="document">
		<div class="modal-content">
			<a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
			<div class="modal-header mdl-header">
				<h6 class="title text-white"><?php echo getEduAppGTLang('export_students'); ?></h6>
			</div>
			<div class="modal-body">
				<?php echo form_open(base_url() . 'admin/student/excel', array('enctype' => 'multipart/form-data')); ?>
				<div class="form-group label-floating is-select">
					<label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
					<div class="select">
						<select name="class_id" required="" onchange="get_sections(this.value);">
							<option value=""><?php echo getEduAppGTLang('select'); ?></option>
							<?php $classes = $this->db->get('class')->result_array();
							foreach ($classes as $row):
							?>
								<option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="form-group label-floating is-select">
					<label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
					<div class="select">
						<select name="section_id" id="section_holder">
							<option value=""><?php echo getEduAppGTLang('select'); ?></option>
						</select>
					</div>
				</div>
				<button class="btn btn-rounded btn-purple  btn-icon-left" type="submit"><i class="picons-thin-icon-thin-0129_download"></i> <?php echo getEduAppGTLang('export'); ?></button></center>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="bulkstudents" tabindex="-1" role="dialog" aria-labelledby="bulkstudents" aria-hidden="true">
	<div class="modal-dialog window-popup create-friend-group create-friend-group-1" role="document">
		<div class="modal-content">
			<?php echo form_open(base_url() . 'admin/student/bulk', array('enctype' => 'multipart/form-data')); ?>
			<a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
			<div class="modal-header">
				<h6 class="title"><?php echo getEduAppGTLang('upload_students'); ?></h6>
			</div>
			<div class="modal-body">
				<div class="form-group label-floating is-select">
					<label class="control-label"><?php echo getEduAppGTLang('class'); ?></label>
					<div class="select">
						<select name="class_id" required="" onchange="get_class_sections2(this.value);">
							<option value=""><?php echo getEduAppGTLang('select'); ?></option>
							<?php $classes = $this->db->get('class')->result_array();
							foreach ($classes as $row):
							?>
								<option value="<?php echo $row['class_id']; ?>"><?php echo $row['name']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="form-group label-floating is-select">
					<label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
					<div class="select">
						<select name="section_id" id="section_selector_holder2">
							<option value=""><?php echo getEduAppGTLang('select'); ?></option>
						</select>
					</div>
				</div>
				<div class="form-group with-button">
					<a href="<?php echo base_url(); ?>public/uploads/templates/students.xlsx"><input class="form-control dwl" readonly value="<?php echo getEduAppGTLang('download_template'); ?>" type="text">
						<button class="bg-primary"><i class="icon-feather-download"></i></button></a>
				</div>
				<div class="form-group">
					<input type="file" class="form-control" name="upload_student" required="">
				</div>
				<button type="submit" class="btn btn-rounded btn-success btn-lg full-width"><?php echo getEduAppGTLang('upload'); ?></button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<script>
    $(document).ready(function() {
        $('#studentTable').DataTable();
    });
</script>