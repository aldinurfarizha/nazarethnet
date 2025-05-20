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
            font-family: Arial, sans-serif;
            color: #333;
            position: relative;
            width: 297mm;
            height: 210mm;
        }

        #bg-image {
            position: fixed;
            top: 0;
            left: 0;
            width: 297mm;
            height: 210mm;
            z-index: -1;
        }

        .student-name {
            position: absolute;
            top: 70mm;
            width: 100%;
            text-align: center;
            font-size: 48px;
            margin: 0;
        }

        .course-title {
            position: absolute;
            top: 110mm;
            width: 100%;
            text-align: center;
            font-size: 24px;
            margin: 0;
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


    <div class="info-bottom-right-qr">
        <img src="<?= $qrCodeBase64 ?>" alt="QR Code" class="qr-code" />
    </div>
    <div class="info-bottom-right">
        <p>Emitido el: <br><strong><?= htmlspecialchars($certificateCode) ?></strong></p>
        <p>Codigo: <br><strong><?= htmlspecialchars($issueDate) ?></strong></p>
    </div>
</body>

</html>