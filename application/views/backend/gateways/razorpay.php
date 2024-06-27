<link href="<?php echo base_url();?>public/style/cms/css/main.css" media="all" rel="stylesheet">
<?php 
	$invoice_info = $this->db->get_where('invoice', array('invoice_id' => $invoice_id))->result_array();
	foreach($invoice_info as $row):
?>
    <?php
        $txnid              = date("YmdHis");    
        if($razorpay_data->test_mode == 1){
            $key_id             = $razorpay_data->test_key_id;   
        }else{
            $key_id             = $razorpay_data->production_key_id;   
        }
        $total              = ($row['amount']*100);
        $amount             = ($row['amount']*100);
        $merchant_order_id  = $row['invoice_id']."-".date("YmdHis");
    ?>
    <div class="full-width invoice-w payment">
        <div class="invoice-heading top-0">
            <h3><?php echo getEduAppGTLang('invoice');?>: <?php echo $this->crud->get_name('student',$row['student_id']);?>. <input style="z-index:99999" id="pay-btn" type="submit" onclick="razorpaySubmit(this);" value="<?php echo getEduAppGTLang('pay_now');?>" class="btn btn-success btn-rounded"/></h3> 
            <div class="invoice-date">
                <?php echo $row['creation_timestamp'];?>
            </div>
        </div>
        <div class="invoice-body">
            <div class="invoice-table full-width">
                <table class="table">
                    <thead>
                        <tr>
                              <th><?php echo getEduAppGTLang('title');?></th>
                            <th><?php echo getEduAppGTLang('description');?></th>
                            <th class="text-right"><?php echo getEduAppGTLang('amount');?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                              <td><?php echo $row['title'];?></td>
                            <td><?php echo $row['description'];?></td>
                            <td class="text-right"><?php echo $this->crud->getInfo('currency'); ?><?php echo $row['amount'];?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><?php echo getEduAppGTLang('total');?></td>
                            <td class="text-right" colspan="2"><?php echo $this->crud->getInfo('currency'); ?><?php echo $row['amount'];?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <hr>
        <div class="invoice-footer">
            <div class="invoice-logo">
                <img alt="" src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>"><span><?php echo $this->crud->getInfo('system_name');?></span>
            </div>
            <div class="invoice-info">
                <span><?php echo $this->crud->getInfo('system_email');?></span><span><?php echo $this->crud->getInfo('phone');?></span>
            </div>
        </div>
    </div>
    <form name="razorpay-form" id="razorpay-form" action="<?php echo base_url().'payments/razorpay_callback';?>" method="POST">
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" />
        <input type="hidden" name="merchant_order_id" id="merchant_order_id" value="<?php echo $merchant_order_id; ?>"/>
        <input type="hidden" name="merchant_trans_id" id="merchant_trans_id" value="<?php echo $txnid; ?>"/>
        <input type="hidden" name="merchant_product_info_id" id="merchant_product_info_id" value="<?php echo $row['description']; ?>"/>
        <input type="hidden" name="merchant_surl_id" id="merchant_surl_id" value="<?php echo $surl; ?>"/>
        <input type="hidden" name="merchant_furl_id" id="merchant_furl_id" value="<?php echo $furl; ?>"/>
        <input type="hidden" name="card_holder_name_id" id="card_holder_name_id" value="<?php echo $card_holder_name; ?>"/>
        <input type="hidden" name="merchant_total" id="merchant_total" value="<?php echo $total; ?>"/>
        <input type="hidden" name="merchant_amount" id="merchant_amount" value="<?php echo $amount; ?>"/>
    </form>
<?php endforeach;?>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        'use strict';
        var razorKey      = '<?php echo $key_id; ?>';
        var razorTotal    = '<?php echo $total; ?>';
        var razorName     = '<?php echo $this->crud->get_name('student',$row['student_id']); ?>';
        var razorDesc     = '<?php echo getEduAppGTLang('payment');?> #<?php echo $merchant_order_id; ?>';
        var razorCurrency = '<?php echo $razorpay_data->currency;?>';
        var razorEmail    = '<?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->email; ?>';
        var razorContact  = '<?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->phone; ?>';
        var razorOid      = '<?php echo $merchant_order_id; ?>';
        var razorWait     = '<?php echo getEduAppGTLang('please_wait');?>';
        var razorNow     = '<?php echo getEduAppGTLang('pay_now');?>';
    </script>
    <script src="<?php echo base_url();?>public/style/js/razorpay.js"></script>
</body>
</html>