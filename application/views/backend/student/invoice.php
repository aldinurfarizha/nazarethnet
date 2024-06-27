    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="content-i">
                <div class="content-box">
                    <div class="element-wrapper">
                        <h6 class="element-header"><?php echo getEduAppGTLang('payments');?></h6>
                        <div class="element-box-tp">
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white">
                                    <thead>
                                        <tr class="bg-primary text-white text-bold">
                                            <th><?php echo getEduAppGTLang('id');?></th>
				                            <th><?php echo getEduAppGTLang('student');?></th>
				                            <th><?php echo getEduAppGTLang('title');?></th>
				                            <th><?php echo getEduAppGTLang('amount');?></th>
				                            <th><?php echo getEduAppGTLang('status');?></th>
				                            <th><?php echo getEduAppGTLang('date');?></th>
				                            <th><?php echo getEduAppGTLang('invoice');?></th>
				                            <th><?php echo getEduAppGTLang('method');?></th>
				                            <th><?php echo getEduAppGTLang('options');?></th>
			                            </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($invoices as $row):?>
				                        <tr>
                                            <td><?php echo sprintf("%06d", $row['invoice_id']);?></td>
					                        <td><img alt="" src="<?php echo $this->crud->get_image_url('student', $this->session->userdata('login_user_id'));?>" width="25px" class="tbl-user"> <?php echo $this->crud->get_name('student', $row['student_id']);?></td>
					                        <td><?php echo $row['title'];?></td>
					                        <td><strong><?php echo $this->db->get_where('settings' , array('type' =>'currency'))->row()->description;?><?php echo $row['amount'];?></strong></td>
					                        <td><?php if($row['status'] == 'completed'):?>
						                        <div class="status-pill green" data-title="<?php echo getEduAppGTLang('paid');?>" data-toggle="tooltip"></div>
					                            <?php endif;?>
					                            <?php if($row['status'] == 'pending'):?>
						                        <div class="status-pill red" data-title="<?php echo getEduAppGTLang('pending');?>" data-toggle="tooltip"></div>
					                            <?php endif;?>
					                        </td> 
					                        <td><a class="btn nc btn-rounded btn-sm btn-secondary text-white"><?php echo $row['creation_timestamp'];?></a></td>
					                        <td><a class="btn btn-rounded btn-primary btn-sm text-white" href="<?php echo base_url();?>student/view_invoice/<?php echo $row['invoice_id'];?>"><i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash"></i> <?php echo getEduAppGTLang('invoice');?></a></td>
					                        <td class="text-primary text-bold">
					                            <?php if($row['payment_method'] != ''): ?>
					                                <?php if($row['payment_method'] == 'pp'):?>
					                                    <img alt="" width="60px" src="<?php echo base_url();?>public/style/images/gateways/paypal.png"></a>
					                                <?php elseif($row['payment_method'] == 'stripe'):?>
					                                    <img alt="" width="45px" src="<?php echo base_url();?>public/style/images/gateways/stripe.png"></a>
					                                <?php elseif($row['payment_method'] == 'razorpay'):?>
					                                    <img alt="" width="85px" src="<?php echo base_url();?>public/style/images/gateways/razorpay.png"></a>
					                                <?php elseif($row['payment_method'] == 'paystack'):?>
					                                    <img alt="" width="85px" src="<?php echo base_url();?>public/style/images/gateways/paystack.png"></a>
					                                <?php elseif($row['payment_method'] == 'flutterwave'):?>
					                                    <img alt="" width="85px" src="<?php echo base_url();?>public/style/images/gateways/flutterwave.png"></a>
					                                <?php elseif($row['payment_method'] == 'pesapal'):?>
					                                    <img alt="" width="85px" src="<?php echo base_url();?>public/style/images/gateways/pesapal.png"></a>
					                                <?php else:?>
					                                    --
					                                <?php endif;?>
					                            <?php else:?>
					                                --
					                            <?php endif;?>
					                        </td>
					                        <td>
					                            <?php if($row['status'] == 'pending'):?>
                                                <button class="btn btn-success btn-rounded btn-sm dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton1" type="button"><?php echo getEduAppGTLang('pay_now');?></button>
                                                <div aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
                                                    <?php if($this->payment->isActive('paypal')):?>
                                                        <a class="dropdown-item text-black" href="<?php echo base_url();?>payments/paypal/<?php echo base64_encode($row['invoice_id']);?>"><span class="text-bold"><?php echo getEduAppGTLang('pay_with');?>:</span> 
                                                        <img alt="" width="60px" src="<?php echo base_url();?>public/style/images/gateways/paypal.png"></a>
                                                    <?php endif;?>
                                                    <?php if($this->payment->isActive('stripe')):?>
                                                        <a class="dropdown-item text-black" href="<?php echo base_url();?>payments/stripe/<?php echo base64_encode($row['invoice_id']);?>"><span class="text-bold"><?php echo getEduAppGTLang('pay_with');?>:</span> 
                                                        <img alt="" width="45px" src="<?php echo base_url();?>public/style/images/gateways/stripe.png"></a>
                                                    <?php endif;?>
                                                    <?php if($this->payment->isActive('razorpay')):?>
                                                        <a class="dropdown-item text-black" href="<?php echo base_url();?>payments/razorpay/<?php echo base64_encode($row['invoice_id']);?>"><span class="text-bold"><?php echo getEduAppGTLang('pay_with');?>:</span> 
                                                        <img alt="" width="70px" src="<?php echo base_url();?>public/style/images/gateways/razorpay.png"></a>
                                                    <?php endif;?>
                                                    <?php if($this->payment->isActive('paystack')):?>
                                                        <a class="dropdown-item text-black" href="<?php echo base_url();?>payments/paystack/<?php echo base64_encode($row['invoice_id']);?>"><span class="text-bold"><?php echo getEduAppGTLang('pay_with');?>:</span> 
                                                        <img alt="" width="70px" src="<?php echo base_url();?>public/style/images/gateways/paystack.png"></a>
                                                    <?php endif;?>
                                                    <?php if($this->payment->isActive('flutterwave')):?>
                                                        <a class="dropdown-item text-black" href="<?php echo base_url();?>payments/flutterwave/<?php echo base64_encode($row['invoice_id']);?>"><span class="text-bold"><?php echo getEduAppGTLang('pay_with');?>:</span> 
                                                        <img alt="" height="60px" width="75px" src="<?php echo base_url();?>public/style/images/gateways/flutterwave.png"></a>
                                                    <?php endif;?>
                                                    <?php if($this->payment->isActive('payu')):?>
                                                        <a class="dropdown-item text-black" href="<?php echo base_url();?>payments/payu/<?php echo base64_encode($row['invoice_id']);?>"><span class="text-bold"><?php echo getEduAppGTLang('pay_with');?>:</span> 
                                                        <img alt="" width="40px" src="<?php echo base_url();?>public/style/images/gateways/payu.png"></a>
                                                    <?php endif;?>
                                                    <?php if($this->payment->isActive('pesapal')):?>
                                                        <a class="dropdown-item text-black" href="<?php echo base_url();?>payments/pesapal/<?php echo base64_encode($row['invoice_id']);?>"><span class="text-bold"><?php echo getEduAppGTLang('pay_with');?>:</span> 
                                                        <img alt="" width="60px" src="<?php echo base_url();?>public/style/images/gateways/pesapal.png"></a>
                                                    <?php endif;?>
                                                </div>
                                                <?php else:?>
                                                    <?php echo getEduAppGTLang('without_options');?>
                                                <?php endif;?>
                                            </td>
				                        </tr>
			                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>