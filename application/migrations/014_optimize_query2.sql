ALTER TABLE mark_activity 
  ADD INDEX idx_exam_id (exam_id),
  ADD INDEX idx_subject_id (subject_id),
  ADD INDEX idx_class_id (class_id),
  ADD INDEX idx_section_id (section_id);
ALTER TABLE student_subject 
  ADD INDEX idx_student_id (student_id),
  ADD INDEX idx_subject_id (subject_id),
  ADD INDEX idx_is_finish (is_finish);
ALTER TABLE enroll 
  ADD INDEX idx_student_id (student_id),
  ADD INDEX idx_class_id (class_id),
  ADD INDEX idx_section_id (section_id),
  ADD INDEX idx_is_active (is_active);
ALTER TABLE attendance 
  ADD INDEX idx_student_id (student_id),
  ADD INDEX idx_class_id (class_id),
  ADD INDEX idx_section_id (section_id),
  ADD INDEX idx_subject_id (subject_id);

