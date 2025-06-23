<?php
// encode background
$backgroundBase64 = '';
if (file_exists($backgroundFilePath)) {
    $imgData = base64_encode(file_get_contents($backgroundFilePath));
    $ext = pathinfo($backgroundFilePath, PATHINFO_EXTENSION);
    $mime = 'image/jpeg';
    if (strtolower($ext) === 'png') $mime = 'image/png';
    elseif (strtolower($ext) === 'gif') $mime = 'image/gif';
    $backgroundBase64 = "data:$mime;base64,$imgData";
}

// encode qr code
$qrCodeBase64 = '';
if (file_exists($qrCodeFilePath)) {
    $qrData = base64_encode(file_get_contents($qrCodeFilePath));
    $qrMime = 'image/png';
    $qrCodeBase64 = "data:$qrMime;base64,$qrData";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Certificate</title>
    <style>
        @page {
            margin: 0;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: <?=$settings->font_face?>,Arial;
            color: #333;
            position: relative;
            width: <?=$settings->width?>mm;
            height: <?=$settings->height?>mm;
        }

        #bg-image {
            position: fixed;
            top: 0;
            left: 0;
            width: <?=$settings->width?>mm;
            height: <?=$settings->height?>mm;
            z-index: -1;
        }

        .student-name {
            position: absolute;
            left: <?=$settings->student_name_text_x?>mm;
            top: <?=$settings->student_name_text_y?>mm;
            font-size:  <?=$settings->student_name_text_size?>px;
            color: <?=$settings->student_name_text_color?>;
            text-align: center;
            width: 100%;
        }

        .course-title {
            position: absolute;
            left: <?=$settings->course_text_x?>mm;
            top: <?=$settings->course_text_y?>mm;
            font-size:  <?=$settings->course_text_size?>px;
            color: <?=$settings->course_text_color?>;
            text-align: center;
            width: 100%;
        }
        .certificate-code {
            position: absolute;
            left: <?=$settings->certificate_code_text_x?>mm;
            top: <?=$settings->certificate_code_text_y?>mm;
            font-size:  <?=$settings->certificate_code_text_size?>px;
            color: <?=$settings->certificate_code_text_color?>;
            text-align: center;
            width: 100%;
        }
        .certificate-issue-date {
            position: absolute;
            left: <?=$settings->certificate_issue_date_text_x?>mm;
            top: <?=$settings->certificate_issue_date_text_y?>mm;
            font-size:  <?=$settings->certificate_issue_date_text_size?>px;
            color: <?=$settings->certificate_issue_date_text_color?>;
            text-align: center;
            width: 100%;
        }

        .qr-code {
            position: absolute;
            width: <?=$settings->qr_size?>mm;
            height: <?=$settings->qr_size?>mm;
            
        }
        .info-bottom-right-qr {
            position: absolute;
            left: <?=$settings->qr_x?>mm;
            top: <?=$settings->qr_y?>mm;
        }
         .text-1 {
            position: absolute;
            left: <?=$settings->text_1_x?>mm;
            top: <?=$settings->text_1_y?>mm;
            font-size:  <?=$settings->text_1_size?>px;
            color: <?=$settings->text_1_color?>;
            text-align: center;
            width: 100%;
        }
        .text-2 {
            position: absolute;
            left: <?=$settings->text_2_x?>mm;
            top: <?=$settings->text_2_y?>mm;
            font-size:  <?=$settings->text_2_size?>px;
            color: <?=$settings->text_2_color?>;
            text-align: center;
            width: 100%;
        }
        .text-3 {
            position: absolute;
            left: <?=$settings->text_3_x?>mm;
            top: <?=$settings->text_3_y?>mm;
            font-size:  <?=$settings->text_3_size?>px;
            color: <?=$settings->text_3_color?>;
            text-align: center;
            width: 100%;
        }
        .text-4 {
            position: absolute;
            left: <?=$settings->text_4_x?>mm;
            top: <?=$settings->text_4_y?>mm;
            font-size:  <?=$settings->text_4_size?>px;
            color: <?=$settings->text_4_color?>;
            text-align: center;
            width: 100%;
        }
        .text-5 {
            position: absolute;
            left: <?=$settings->text_5_x?>mm;
            top: <?=$settings->text_5_y?>mm;
            font-size:  <?=$settings->text_5_size?>px;
            color: <?=$settings->text_5_color?>;
            text-align: center;
            width: 100%;
        }
    </style>
</head>

<body>
    <img id="bg-image" src="<?= $backgroundBase64 ?>" alt="Background" />
    
    <?php if($settings->student_name_text_status){?>
        <p class="student-name"><?= htmlspecialchars($studentName) ?></p>
    <?php } ?>
    <?php if($settings->course_text_status){?>
        <p class="course-title"><?= htmlspecialchars($courseTitle) ?></p>
    <?php } ?>
    <?php if($settings->certificate_code_text_status){?>
        <p class="certificate-code"><?=$certificateCode?></p>
    <?php } ?>
    <?php if($settings->qr_status){?>
    <div class="info-bottom-right-qr">
            <img src="<?= $qrCodeBase64 ?>" alt="QR Code" class="qr-code" />
        </div>
    <?php } ?>
    <p class="certificate-code"><?=$certificateCode?></p>
    <p class="certificate-issue-date"><?=$issueDate?></p>
    <?php if($settings->text_1_status){?>
    <p class="text-1"><?=$settings->text_1?></p>
        <?php } ?>
    <?php if($settings->text_2_status){?>
    <p class="text-2"><?=$settings->text_2?></p>
        <?php } ?>
    <?php if($settings->text_3_status){?>
    <p class="text-3"><?=$settings->text_3?></p>
        <?php } ?>
    <?php if($settings->text_4_status){?>
    <p class="text-4"><?=$settings->text_4?></p>
        <?php } ?>
    <?php if($settings->text_5_status){?>
    <p class="text-5"><?=$settings->text_5?></p>
        <?php } ?>
</body>

</html>