<!DOCTYPE html>
<html lang="en">
<head>
    <title>Stripe | <?php echo $this->crud->getInfo('system_name');?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="<?php echo base_url();?>public/style/cms/css/stripe.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('favicon');?>" rel="icon">
</head>
<body>
    <?php
        if ($stripe_data->test_mode == 1) {
            $public_key = $stripe_data->test_public_key;
            $private_key = $stripe_data->test_secret;
        } else {
            $public_key = $stripe_data->live_public_key;
            $private_key = $stripe_data->live_secret_key;
        }
    ?>
    <script>
        var stripe_key = '<?php echo $public_key;?>';
    </script>
    <center>
        <br>
        <form method="post" action="<?php echo base_url().'payments/stripe_success/'.$invoice_id;?>">
            <center><img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" width="120px"></center>
            <br>
            <label>
                <div id="card-element" class="field is-empty"></div>
                <span><span><?php echo getEduAppGTLang('credit_/_debit_card');?></span></span>
            </label>
            <button type="submit">
                <?php echo getEduAppGTLang('pay');?> <?php echo $stripe_data->currency.''.$stripe_amount;?>
            </button>
            <div class="outcome">
                <div class="error" role="alert"></div>
                <div class="success">
                    <span class="token"></span>
                </div>
            </div>
            <div class="student-details">
                <?php $student_id = $this->db->get_where('invoice' , array('invoice_id' => $invoice_id))->row()->student_id;?>
                <strong><?php echo getEduAppGTLang('payment_of');?>: <?php echo $this->crud->get_name('student', $student_id);?>.</strong> <br>
            </div>
            <input type="hidden" name="stripeToken" value="">
        </form>
    </center>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="<?php echo base_url();?>public/style/cms/js/stripe.js"></script>
    <script type="text/javascript">
        "use strict";
        stripe_currency('<?php echo $stripe_data->currency; ?>');
    </script>
</body>
</html>
