<?php $running_year = $this->crud->getInfo('running_year');?>
    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="content-i">
                <div class="content-box">
        	        <div class="os-tabs-w">
			            <div class="os-tabs-controls">
			                <ul class="navs navs-tabs upper">
			  	                <?php 
			  	                    $n = 1;
			  	                    $children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                                    foreach ($children_of_parent as $row):
                                ?>
                                <li class="navs-item">
                        	        <?php $active = $n++;?>
				  		            <a class="navs-links <?php if($active == 1) echo 'active';?>" data-toggle="tab" href="#<?php echo $row['username'];?>"><img alt="" src="<?php echo $this->crud->get_image_url('student', $row['student_id']);?>" width="25px" class="tbl-st"> <?php echo $this->crud->get_name('student', $row['student_id']);?></a>
					            </li>
                                <?php endforeach; ?>
			                </ul>
			            </div>
		            </div>
                    <div class="tab-content">
                        <?php 
			                $n = 1;
			                $children_of_parent = $this->db->get_where('student' , array('parent_id' => $this->session->userdata('parent_id')))->result_array();
                            foreach ($children_of_parent as $row3):
                            $class_id = $this->db->get_where('enroll' , array('student_id' => $row3['student_id'] , 'year' => $running_year))->row()->class_id;
	    	                $section_id = $this->db->get_where('enroll' , array('student_id' => $row3['student_id'] , 'year' => $running_year))->row()->section_id;
                        ?>
        	            <?php $active = $n++;?>
	 		            <div class="tab-pane <?php if($active == 1) echo 'active';?>" id="<?php echo $row3['username'];?>">
                            <div class="element-wrapper">
                                <h6 class="element-header"><?php echo getEduAppGTLang('invoices');?></h6>
                                <div class="element-box-tp">
                                    <div class="table-responsive">
                                        <table class="table bg-white table-bordered">
                                            <thead>
                                                <tr>
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
                                            <?php 
                                                $invoices = $this->db->get_where('invoice' , array('student_id' => $row3['student_id']))->result_array();
               	                                foreach($invoices as $row2):
                                            ?>
				                                <tr>
                                                    <td><?php echo sprintf("%06d", $row2['invoice_id']);?></td>
					                                <td><img alt="" src="<?php echo $this->crud->get_image_url('student', $row2['student_id']);?>" width="25px" class="tbl-st"> <?php echo $this->crud->get_name('student', $row2['student_id']);?></td>
					                                <td><?php echo $row2['title'];?></td>
					                                <td><strong><?php echo $this->crud->getInfo('currency');?><?php echo $row2['amount'];?></strong></td>
					                                <td><?php if($row2['status'] == 'completed'):?>
						                                <div class="status-pill green" data-title="Pagado" data-toggle="tooltip"></div>
					                                    <?php endif;?>
					                                    <?php if($row2['status'] == 'pending'):?>
						                                <div class="status-pill red" data-title="Sin pagar" data-toggle="tooltip"></div>
					                                    <?php endif;?>
					                                </td>
					                                <td><a class="btn nc btn-rounded btn-sm btn-secondary text-white"><?php echo $row2['creation_timestamp'];?></a></td>
					                                <td><a class="btn btn-rounded btn-primary btn-sm text-white" href="<?php echo base_url();?>parents/view_invoice/<?php echo $row2['invoice_id'];?>"><i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash"></i> <?php echo getEduAppGTLang('invoice');?></a></td>
					                                <td class="text-primary text-bold">
        					                            <?php if($row2['payment_method'] != ''): ?>
        					                                <?php if($row2['payment_method'] == 'pp'):?>
        					                                    <img alt="" width="60px" src="<?php echo base_url();?>public/style/images/gateways/paypal.png"></a>
        					                                <?php elseif($row2['payment_method'] == 'stripe'):?>
        					                                    <img alt="" width="45px" src="<?php echo base_url();?>public/style/images/gateways/stripe.png"></a>
        					                                <?php elseif($row2['payment_method'] == 'razorpay'):?>
        					                                    <img alt="" width="85px" src="<?php echo base_url();?>public/style/images/gateways/razorpay.png"></a>
        					                                <?php elseif($row2['payment_method'] == 'paystack'):?>
        					                                    <img alt="" width="85px" src="<?php echo base_url();?>public/style/images/gateways/paystack.png"></a>
        					                                <?php elseif($row2['payment_method'] == 'flutterwave'):?>
        					                                    <img alt="" width="85px" src="<?php echo base_url();?>public/style/images/gateways/flutterwave.png"></a>
        					                                <?php elseif($row2['payment_method'] == 'pesapal'):?>
        					                                    <img alt="" width="85px" src="<?php echo base_url();?>public/style/images/gateways/pesapal.png"></a>
        					                                <?php else:?>
        					                                    --
        					                                <?php endif;?>
        					                            <?php else:?>
        					                                --
        					                            <?php endif;?>
        					                        </td>
					                                <td>
					                                    <?php if($row2['status'] == 'pending'):?>
                                                        <button class="btn btn-success btn-rounded btn-sm dropdown-toggle" data-disabled="true" data-toggle="dropdown" id="dropdownMenuButton1" type="button"><?php echo getEduAppGTLang('pay_now');?></button>
                                                        <div aria-labelledby="dropdownMenuButton1" class="dropdown-menu">
                                                            <?php if($this->payment->isActive('paypal')):?>
                                                                <a class="dropdown-item text-black" href="<?php echo base_url();?>payments/paypal/<?php echo base64_encode($row2['invoice_id']);?>"><span class="text-bold"><?php echo getEduAppGTLang('pay_with');?>:</span> 
                                                                <img alt="" width="60px" src="<?php echo base_url();?>public/style/images/gateways/paypal.png"></a>
                                                            <?php endif;?>
                                                            <?php if($this->payment->isActive('stripe')):?>
                                                                <a class="dropdown-item text-black" href="<?php echo base_url();?>payments/stripe/<?php echo base64_encode($row2['invoice_id']);?>"><span class="text-bold"><?php echo getEduAppGTLang('pay_with');?>:</span> 
                                                                <img alt="" width="45px" src="<?php echo base_url();?>public/style/images/gateways/stripe.png"></a>
                                                            <?php endif;?>
                                                            <?php if($this->payment->isActive('razorpay')):?>
                                                                <a class="dropdown-item text-black" href="<?php echo base_url();?>payments/razorpay/<?php echo base64_encode($row2['invoice_id']);?>"><span class="text-bold"><?php echo getEduAppGTLang('pay_with');?>:</span> 
                                                                <img alt="" width="70px" src="<?php echo base_url();?>public/style/images/gateways/razorpay.png"></a>
                                                            <?php endif;?>
                                                            <?php if($this->payment->isActive('paystack')):?>
                                                                <a class="dropdown-item text-black" href="<?php echo base_url();?>payments/paystack/<?php echo base64_encode($row2['invoice_id']);?>"><span class="text-bold"><?php echo getEduAppGTLang('pay_with');?>:</span> 
                                                                <img alt="" width="70px" src="<?php echo base_url();?>public/style/images/gateways/paystack.png"></a>
                                                            <?php endif;?>
                                                            <?php if($this->payment->isActive('flutterwave')):?>
                                                                <a class="dropdown-item text-black" href="<?php echo base_url();?>payments/flutterwave/<?php echo base64_encode($row2['invoice_id']);?>"><span class="text-bold"><?php echo getEduAppGTLang('pay_with');?>:</span> 
                                                                <img alt="" height="60px" width="75px" src="<?php echo base_url();?>public/style/images/gateways/flutterwave.png"></a>
                                                            <?php endif;?>
                                                            <?php if($this->payment->isActive('payu')):?>
                                                                <a class="dropdown-item text-black" href="<?php echo base_url();?>payments/payu/<?php echo base64_encode($row2['invoice_id']);?>"><span class="text-bold"><?php echo getEduAppGTLang('pay_with');?>:</span> 
                                                                <img alt="" width="40px" src="<?php echo base_url();?>public/style/images/gateways/payu.png"></a>
                                                            <?php endif;?>
                                                            <?php if($this->payment->isActive('pesapal')):?>
                                                                <a class="dropdown-item text-black" href="<?php echo base_url();?>payments/pesapal/<?php echo base64_encode($row2['invoice_id']);?>"><span class="text-bold"><?php echo getEduAppGTLang('pay_with');?>:</span> 
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
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>