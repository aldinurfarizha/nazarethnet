CREATE TABLE student_certificate (
    student_certificate_code VARCHAR(10) PRIMARY KEY,

    height INT,
    width INT,
    title_font_face VARCHAR(100),

    qr_size INT,
    qr_x INT,
    qr_y INT,
    qr_status TINYINT(1),

    certificate_code_text_size INT,
    certificate_code_text_weight VARCHAR(50),
    certificate_code_text_x INT,
    certificate_code_text_y INT,
    certificate_code_text_color VARCHAR(20),
    certificate_code_text_status TINYINT(1),

    certificate_issue_date_text_size INT,
    certificate_issue_date_text_weight VARCHAR(50),
    certificate_issue_date_text_x INT,
    certificate_issue_date_text_y INT,
    certificate_issue_date_text_color VARCHAR(20),
    certificate_issue_date_text_status TINYINT(1),

    course_text_size INT,
    course_text_weight VARCHAR(50),
    course_text_x INT,
    course_text_y INT,
    course_text_color VARCHAR(20),
    course_text_status TINYINT(1),

    student_name_text_size INT,
    student_name_text_weight VARCHAR(50),
    student_name_text_x INT,
    student_name_text_y INT,
    student_name_text_color VARCHAR(20),
    student_name_text_status TINYINT(1),

    text_1 TEXT,
    text_1_size INT,
    text_1_weight VARCHAR(50),
    text_1_x INT,
    text_1_y INT,
    text_1_color VARCHAR(20),
    text_1_status TINYINT(1),

    text_2 TEXT,
    text_2_size INT,
    text_2_weight VARCHAR(50),
    text_2_x INT,
    text_2_y INT,
    text_2_color VARCHAR(20),
    text_2_status TINYINT(1),

    text_3 TEXT,
    text_3_size INT,
    text_3_weight VARCHAR(50),
    text_3_x INT,
    text_3_y INT,
    text_3_color VARCHAR(20),
    text_3_status TINYINT(1),

    text_4 TEXT,
    text_4_size INT,
    text_4_weight VARCHAR(50),
    text_4_x INT,
    text_4_y INT,
    text_4_color VARCHAR(20),
    text_4_status TINYINT(1),

    text_5 TEXT,
    text_5_size INT,
    text_5_weight VARCHAR(50),
    text_5_x INT,
    text_5_y INT,
    text_5_color VARCHAR(20),
    text_5_status TINYINT(1),

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

