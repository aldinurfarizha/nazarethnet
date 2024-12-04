<?php
$class_name		 	= 	$this->db->get_where('class', array('class_id' => $class_id))->row()->name;
$system_name        =	$this->crud->getInfo('system_name');
$system_title        =	$this->crud->getInfo('system_title');
$running_year       =	$this->crud->getInfo('running_year');
?>
<link href="<?php echo base_url(); ?>public/style/cms/css/main.css" media="all" rel="stylesheet">
<div class="cuadro" id="print_area">
	<div class="logo">
		<center><img src="<?php echo base_url(); ?>public/uploads/<?php echo $this->crud->getInfo('logo'); ?>" alt="" width="5%" /></center>
	</div>
	<div class="titulosincss">
		<div class="grande"><?php echo $system_name; ?></div>
		<div class="mediano"><?php echo $system_title; ?></div>
		<div class="grande"><?php echo getEduAppGTLang('tabulation_sheet'); ?></div>
		<div class="mediano"><?php echo $this->db->get_where('subject', array('subject_id' => $subject_id))->row()->name; ?></div>
		<div class="mediano"><?php echo $this->db->get_where('class', array('class_id' => $class_id))->row()->name; ?> | <?php echo $this->db->get_where('section', array('section_id' => $section_id))->row()->name; ?></div>
	</div>
	<table cellpading="0" cellspacing="0" border="1" class="pdauto">
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
				<td class="text-center"><?php echo $this->crud->get_name('student', $row['student_id']) ?></td>
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