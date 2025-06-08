CREATE TABLE certificate_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    
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

INSERT INTO certificate_settings (
    height, width, title_font_face,

    qr_size, qr_x, qr_y, qr_status,

    certificate_code_text_size, certificate_code_text_weight, certificate_code_text_x,
    certificate_code_text_y, certificate_code_text_color, certificate_code_text_status,

    course_text_size, course_text_weight, course_text_x,
    course_text_y, course_text_color, course_text_status,

    student_name_text_size, student_name_text_weight, student_name_text_x,
    student_name_text_y, student_name_text_color, student_name_text_status,

    text_1, text_1_size, text_1_weight, text_1_x, text_1_y, text_1_color, text_1_status,

    text_2, text_2_size, text_2_weight, text_2_x, text_2_y, text_2_color, text_2_status,

    text_3, text_3_size, text_3_weight, text_3_x, text_3_y, text_3_color, text_3_status,

    text_4, text_4_size, text_4_weight, text_4_x, text_4_y, text_4_color, text_4_status,

    text_5, text_5_size, text_5_weight, text_5_x, text_5_y, text_5_color, text_5_status
) VALUES (
    842, 595, 'Arial',

    100, 500, 700, 1,

    12, '300', 50,
    800, '#000000', 1,

    14, '700', 100,
    300, '#222222', 1,

    16, '300', 120,
    400, '#111111', 1,

    'Text 1 example', 10, '700', 150, 500, '#333333', 1,

    'Text 2 example', 10, '700', 150, 550, '#333333', 1,

    'Text 3 example', 10, '700', 150, 600, '#333333', 1,

    'Text 4 example', 10, '700', 150, 650, '#333333', 1,

    'Text 5 example', 10, '700', 150, 700, '#333333', 1
);

