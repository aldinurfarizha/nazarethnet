ALTER TABLE nota_capacidad 
  ADD INDEX idx_mark_activity (mark_activity_id),
  ADD INDEX idx_student (student_id),
  ADD INDEX idx_is_block (is_block),
  ADD INDEX idx_updated_at (updated_at);
ALTER TABLE mark
  ADD INDEX idx_student (student_id),
  ADD INDEX idx_class (class_id),
  ADD INDEX idx_subject (subject_id),
  ADD INDEX idx_exam (exam_id);
ALTER TABLE language 
  MODIFY phrase VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;
ALTER TABLE language 
  ADD INDEX idx_phrase (phrase(191));
