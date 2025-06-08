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
            font-weight: 500;
            text-align: center;
            width: 100%;
        }

        .qr-code {
            position: absolute;
            bottom: 20mm;
            right: 20mm;
            width: 40mm;
            height: 40mm;
        }

        .info-bottom-right {
            position: absolute;
            top: 150mm;
            right: 50mm;
            width: 100%;
            text-align: right;
            font-size: 24px;
            margin: 0;
        }

        .info-bottom-right-qr {
            position: absolute;
            top: 155mm;
            right: 5mm;
            width: 100%;
            text-align: right;
            font-size: 24px;
            margin: 0;
        }
    </style>
</head>

<body>
    <img id="bg-image" src="<?= $backgroundBase64 ?>" alt="Background" />

    <h1 class="student-name"><?= htmlspecialchars($studentName) ?></h1>
    <h3 class="course-title"><?= htmlspecialchars($courseTitle) ?></h3>

<p class="certificate-code"><?=$certificateCode?></p>
    <div class="info-bottom-right-qr">
        <img src="<?= $qrCodeBase64 ?>" alt="QR Code" class="qr-code" />
    </div>
        <p class="certificate-code"><?=$certificateCode?></p>
        <p>Emitido el: <br><strong><?= htmlspecialchars($certificateCode) ?></strong></p>
        <p>Codigo: <br><strong><?= htmlspecialchars($issueDate) ?></strong></p>
</body>

</html>