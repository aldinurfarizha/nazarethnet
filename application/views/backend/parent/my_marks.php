<?php
$running_year = $this->crud->getInfo('running_year');
$min = $this->db->get_where('academic_settings', array('type' => 'minium_mark'))->row()->description;
$class_id = $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->class_id;
$section_id = $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->class_id;
?>
<div class="content-w">
	<div class="conty">
		<?php include 'fancy.php'; ?>
		<div class="header-spacer"></div>
		<div class="content-i">
			<div class="content-box">
				<form action="<?php echo base_url(); ?>student/my_marks/apply" method="POST">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group label-floating is-select">
								<label class="control-label"><?php echo getEduAppGTLang('subject'); ?></label>
								<div class="select">
									<select name="subject_id" required>
										<option value=""><?php echo getEduAppGTLang('select'); ?></option>
										<?php
										$datak = getAvailabeSubjectAll($this->session->userdata('login_user_id'));
										foreach ($datak as $key) :
											if (isActiveSubject($this->session->userdata('login_user_id'), $key->subject_id)) {
										?>
												<option value="<?php echo $key->subject_id; ?>" <?php if ($subject_id == $key->subject_id) echo "selected"; ?>><?php echo $key->name; ?></option>
										<?php }
										endforeach;

										?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								<button class="btn btn-warning btn-upper top-20" type="submit"><span>Ver calificaciones</span></button>
							</div>
						</div>
					</div>
				</form>
				<div class="row">
					<?php if ($subject_id > 0) : ?>
						<?php
						$detailSubject = getSubjectDetailBySubjectId($subject_id);
						$class_id = $detailSubject->class_id;
						$section_id = $detailSubject->section_id;
						$student_info = $this->db->get_where('enroll', array('student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year, 'is_active' => 1))->result_array();
						$exams = $this->db->get_where('exam', array('class_id' => $class_id, 'section_id' => $section_id, 'subject_id' => $subject_id))->result_array();
						foreach ($exams as $row2) :
						?>

							<div class="col-sm-12">
								<div class="element-box lined-primary shadow">
									<h5 class="form-header"><?php echo getEduAppGTLang('your_marks'); ?><br>
										<small><?php echo $row2['name']; ?></small>
									</h5>
									<div class="table-responsive">
										<table class="table table-lightborder">
											<thead>
												<tr>
													<th><?php echo getEduAppGTLang('subject'); ?></th>
													<th><?php echo getEduAppGTLang('teacher'); ?></th>
													<th><?php echo getEduAppGTLang('mark'); ?></th>
													<th>Prom</th>
													<th><?php echo getEduAppGTLang('comment'); ?></th>
													<th><?php echo getEduAppGTLang('view_all'); ?></th>
												</tr>
											</thead>
											<tbody>
												<?php
												$subjects = $this->db->get_where('subject', array('class_id' => $class_id, 'section_id' => $section_id))->result_array();
												foreach ($subjects as $row3) :
													$obtained_mark_query = $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'class_id' => $class_id, 'student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year));
													if ($obtained_mark_query->num_rows() > 0) {
														$marks = $obtained_mark_query->result_array();
														foreach ($marks as $row4) :

												?>
															<tr>
																<td><?php echo $row3['name']; ?></td>
																<td><img alt="" src="<?php echo $this->crud->get_image_url('teacher', $row3['teacher_id']); ?>" width="25px" class="tbl-user"> <?php echo $this->crud->get_name('teacher', $row3['teacher_id']); ?></td>
																<td>
																	<?php echo $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->mark_obtained; ?>
																</td>
																<td>
																	<?php echo $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->final; ?>
																</td>
																<td><?php echo $this->db->get_where('mark', array('subject_id' => $row3['subject_id'], 'exam_id' => $row2['exam_id'], 'student_id' => $this->session->userdata('login_user_id'), 'year' => $running_year))->row()->comment; ?></td>
																<?php $data = base64_encode($class_id . "-" . $section_id . "-" . $row3['subject_id']); ?>
																<td><a class="btn btn-rounded btn-sm btn-primary text-white" href="<?php echo base_url(); ?>student/subject_marks/<?php echo $data; ?>/<?php echo $row2['exam_id']; ?>"><?php echo getEduAppGTLang('view_all'); ?></a></td>
															</tr>
												<?php endforeach;
													}
												endforeach; ?>
											</tbody>
										</table>
										<div class="form-buttons-w text-right">
											<a target="_blank" href="<?php echo base_url(); ?>student/marks_print_view/<?php echo base64_encode($this->session->userdata('login_user_id') . '-' . $row2['exam_id']); ?>/"><button class="btn btn-rounded btn-success" type="submit"><i class="picons-thin-icon-thin-0333_printer"></i> <?php echo getEduAppGTLang('print'); ?></button></a>
										</div>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</div>