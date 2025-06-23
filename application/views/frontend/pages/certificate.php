<style>
    .certificate-check-form {
        max-width: 500px;
        margin: 50px auto;
        padding: 30px 25px;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        text-align: center;
    }

    .certificate-check-form h2 {
        margin-bottom: 20px;
        font-weight: 700;
        color: #333;
    }

    .certificate-check-form input[type="text"] {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .certificate-check-form button {
        width: 100%;
        padding: 12px;
        font-size: 16px;
        background-color: #007bff;
        border: none;
        border-radius: 6px;
        color: white;
        font-weight: 600;
        transition: background-color 0.3s ease;
    }

    .certificate-check-form button:hover {
        background-color: #0056b3;
    }

    .alert-error {
        margin-top: 20px;
        padding: 15px;
        background-color: #ffe5e5;
        border-left: 6px solid #ff4c4c;
        color: #a70000;
        font-weight: 500;
        border-radius: 6px;
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .certificate-check-form .icon {
        font-size: 48px;
        color: #ff4c4c;
        margin-bottom: 10px;
    }
</style>

<section id="hero" class="homepage-hero container-fluid">
    <div class="certificate-check-form mt-5">
        <h2><?php echo getEduAppGTLang("certificate_verification"); ?></h2>

        <form method="post" action="<?php echo base_url('certificate/check'); ?>">
            <label for="certCode" class="form-label">
                <?php echo getEduAppGTLang("enter_your_certificate_code"); ?>
            </label>
            <input type="text" id="certCode" name="certCode" maxlength="10"
                placeholder="<?php echo getEduAppGTLang('XXXXXXXXXX'); ?>"
                style="text-transform: uppercase;" required>
            <button type="submit" class="btn btn-primary">
                <?php echo getEduAppGTLang("check_the_authenticity_of_the_certificate"); ?>
            </button>
        </form>

        <?php if (isset($certificate_status) && $certificate_status === 'invalid'): ?>
            <div class="alert-error mt-4">
                <div class="icon">⚠️</div>
                <?php echo getEduAppGTLang("certificate_not_found")." : $certCode"; ?>
            </div>
        <?php endif; ?>
    </div>
</section>