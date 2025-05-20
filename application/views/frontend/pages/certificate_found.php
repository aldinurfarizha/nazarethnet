<!-- Tambahkan ini di <head> halaman kamu untuk Font Awesome -->
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
    .certificate-check-form {
        max-width: 520px;
        margin: 50px auto;
        padding: 35px 30px;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.07);
        text-align: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    .certificate-check-form h2 {
        margin-bottom: 30px;
        font-weight: 700;
        font-size: 1.9rem;
        color: #222;
        letter-spacing: 1px;
    }

    .certificate-check-form .info-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        /* jarak label dan value berjauhan */
        margin-bottom: 18px;
        font-size: 1.1rem;
        gap: 12px;
    }

    .certificate-check-form .info-row i {
        color: #007bff;
        font-size: 22px;
        min-width: 28px;
    }

    .certificate-check-form .info-label {
        font-weight: 600;
        color: #555;
        flex: 1;
        text-align: left;
    }

    .certificate-check-form .info-value {
        font-weight: 700;
        color: #111;
        flex: 1;
        text-align: right;
        word-break: break-word;
    }

    .certificate-check-form a.btn-download {
        display: inline-block;
        margin-top: 30px;
        padding: 12px 28px;
        background-color: #007bff;
        color: #fff !important;
        font-weight: 600;
        font-size: 1rem;
        border-radius: 8px;
        text-decoration: none;
        box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    .certificate-check-form a.btn-download:hover {
        background-color: #0056b3;
        box-shadow: 0 6px 18px rgba(0, 86, 179, 0.5);
        text-decoration: none;
    }

    /* Error message style (optional) */
    .alert-error {
        margin-top: 25px;
        padding: 15px;
        background-color: #ffe5e5;
        border-left: 6px solid #ff4c4c;
        color: #a70000;
        font-weight: 500;
        border-radius: 8px;
        animation: fadeIn 0.5s ease-in-out;
        max-width: 520px;
        margin-left: auto;
        margin-right: auto;
        text-align: left;
        font-size: 1rem;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
</style>

<section id="hero" class="homepage-hero container-fluid">
    <div class="certificate-check-form">
        <h2><?php echo getEduAppGTLang("certificate_validation"); ?>✔️</h2>

        <div class="info-row">
            <i class="fa-solid fa-user"></i>
            <div class="info-label"><?php echo getEduAppGTLang("first_name"); ?>:</div>
            <div class="info-value"><?php echo htmlspecialchars($student->first_name); ?></div>
        </div>

        <div class="info-row">
            <i class="fa-solid fa-user"></i>
            <div class="info-label"><?php echo getEduAppGTLang("last_name"); ?>:</div>
            <div class="info-value"><?php echo htmlspecialchars($student->last_name); ?></div>
        </div>

        <div class="info-row">
            <i class="fa-solid fa-book"></i>
            <div class="info-label"><?php echo getEduAppGTLang("subject"); ?>:</div>
            <div class="info-value"><?php echo htmlspecialchars($subject->name); ?></div>
        </div>

        <div class="info-row">
            <i class="fa-solid fa-calendar-check"></i>
            <div class="info-label"><?php echo getEduAppGTLang("certificate_date"); ?>:</div>
            <div class="info-value">
                <?php echo date('Y-m-d', strtotime($student_subject->cert_generated_at)); ?>
            </div>
        </div>

        <a href="<?php echo base_url("certificate/download/" . $student_subject->cert_code); ?>" class="btn-download" target="_blank" rel="noopener">
            <i class="fa-solid fa-download" style="margin-right: 8px;"></i>
            <?php echo getEduAppGTLang("download_certificate"); ?>
        </a>
    </div>
</section>