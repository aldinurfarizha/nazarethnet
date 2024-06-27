    <?php $running_year = $this->crud->getInfo('running_year');?>
    <div class="content-w" > 
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty">
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links active" href="<?php echo base_url();?>admin/payments/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('home');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/students_payments/"><i class="os-icon picons-thin-icon-thin-0426_money_payment_dollars_coins_cash"></i><span><?php echo getEduAppGTLang('payments');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/expense/"><i class="os-icon picons-thin-icon-thin-0420_money_cash_coins_payment_dollars"></i><span><?php echo getEduAppGTLang('expense');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>admin/accounting_settings/"><i class="os-icon picons-thin-icon-thin-0049_settings_panel_equalizer_preferences"></i><span><?php echo getEduAppGTLang('accounting_settings');?></span></a>
                        </li>
                    </ul>
                </div>
            </div><br>
    	    <div class="container-fluid">
	            <div class="layout-w">
          		    <div class="content-w">
	                  	<div class="content-i">
                		    <div class="content-box" >
                      			<div class="app-em ail-w">
                  				    <div class="ae-conte nt-w">                          
                            			<div class="aec-full-m essage-w">
                            			    <div class="aec-full -message">
                                  				<div class="container- fluid">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <h2 class="pull-left"><?php echo getEduAppGTLang('accounting');?></h2>
                                                        </div><hr>
	                                                    <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
		                                                    <div class="ui-block list" data-mh="friend-groups-item">
			                                                    <div class="friend-item friend-groups">
				                                                    <div class="friend-item-content">
                                        						        <div class="friend-avatar">
                                        						            <br><br>
                                        						            <i class="picons-thin-icon-thin-0383_graph_columns_growth_statistics iconcls"></i>
                                        							        <h1 class="text-bold"><?php echo $this->crud->getInfo('currency');?><?php $this->db->where('year' , $running_year); $this->db->where('status', 'completed'); $invoices  = $this->db->get('invoice')->result_array(); $to = 0; foreach($invoices as $r){$to+=$r['amount'];} echo number_format($to);?></h1>
                                        							        <div class="author-content">
                                        								        <div class="country"><b> <?php echo getEduAppGTLang('total_income');?></b></div>
                                        							        </div>
                                        						        </div>
				                                                    </div>
			                                                    </div>
		                                                    </div>
	                                                    </div>
	                                                    <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
		                                                    <div class="ui-block list" data-mh="friend-groups-item">
			                                                    <div class="friend-item friend-groups">
				                                                    <div class="friend-item-content">
					                                                    <div class="friend-avatar">
					                                                        <br><br>
					                                                        <i class="picons-thin-icon-thin-0384_graph_columns_drop_statistics iconcls"></i>
						                                                    <h1 class="text-bold"><?php echo $this->db->get_where('settings' , array('type'=>'currency'))->row()->description; ?><?php $this->db->where('payment_type' , 'expense'); $this->db->where('year' , $running_year); $expenses = $this->db->get('payment')->result_array(); $t=0;
        	                                                                foreach ($expenses as $rows){$t+= $rows['amount'];} echo number_format($t);?></h1>
						                                                    <div class="author-content">
							                                                    <div class="country"><b> <?php echo getEduAppGTLang('total_expense');?></b></div>
						                                                    </div>
					                                                    </div>
				                                                    </div>
			                                                    </div>
		                                                    </div>
	                                                    </div>
	                                                    <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
		                                                    <div class="ui-block list" data-mh="friend-groups-item">
			                                                    <div class="friend-item friend-groups">
				                                                    <div class="friend-item-content">
					                                                    <div class="friend-avatar">
					                                                    <br><br>
					                                                        <i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash iconcls"></i>
						                                                    <h1 class="text-bold"><?php $this->db->where('status', 'pending'); echo $this->db->count_all_results('invoice');?></h1>
						                                                    <div class="author-content">
							                                                    <div class="country"><b> <?php echo getEduAppGTLang('pending_payments');?></b></div>
						                                                    </div>
					                                                    </div>
				                                                    </div>
			                                                    </div>
		                                                    </div>
	                                                    </div>
	                                                    <div class="col col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
		                                                    <div class="ui-block list" data-mh="friend-groups-item">
			                                                    <div class="friend-item friend-groups">
				                                                    <div class="friend-item-content">
					                                                    <div class="friend-avatar">
					                                                        <br><br>
					                                                        <i class="picons-thin-icon-thin-0406_money_dollar_euro_currency_exchange_cash iconcls"></i>
						                                                    <h1 class="text-bold"><?php $this->db->where('status', 'completed'); echo $this->db->count_all_results('invoice');?></h1>
						                                                    <div class="author-content">
							                                                    <div class="country"><b> <?php echo getEduAppGTLang('completed_payments');?></b></div>
						                                                    </div> 
					                                                    </div>
				                                                    </div>
			                                                    </div>
		                                                    </div>
	                                                    </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row"> 
	                                                    <div class="col-sm-6">
		                                                    <div class="element-wrapper">
		                                                        <h6 class="element-header"><?php echo getEduAppGTLang('recent_income');?></h6>
                                                                <div class="element-box-tp">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-padded">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th><?php echo getEduAppGTLang('status');?></th>
                                                                                    <th><?php echo getEduAppGTLang('student');?></th>
                                                                                    <th><?php echo getEduAppGTLang('title');?></th>
                                                                                    <th><?php echo getEduAppGTLang('method');?></th>
                                                                                    <th><?php echo getEduAppGTLang('amount');?></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <?php
                                                                                $this->db->limit(10);
                                                                                $this->db->where('year' , $running_year);
                                                                                $this->db->order_by('creation_timestamp' , 'desc');
                                                                                $invoices = $this->db->get('invoice')->result_array();
                                                                                foreach($invoices as $row): ?>
                                                                                <tr>
                                                                                    <td>
                                                                                    <?php if($row['status'] == 'pending'):?>
                                                                                        <span class="status-pill yellow"></span><span><?php echo getEduAppGTLang('pending');?></span>
                                                                                    <?php endif;?>
                                                                                    <?php if($row['status'] == 'completed'):?>
                                                                                        <span class="status-pill green"></span><span><?php echo getEduAppGTLang('paid');?></span>
                                                                                    <?php endif;?>
                                                                                    </td>
                                                                                    <td class="cell-with-media">
                                                                                        <a class="grey" href="<?php echo base_url();?>admin/invoice_details/<?php echo $row['invoice_id'];?>/"><img alt="" src="<?php echo $this->crud->get_image_url('student', $row['student_id']);?>" class="height25"><span> <?php echo $this->crud->get_name('student', $row['student_id']);?></span></a>
                                                                                    </td>
                                                                                    <td><?php echo $row['title'];?></td>
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
                                                                                    <td><a class="badge badge-primary" href="javascript:void(0);"><?php echo $this->db->get_where('settings' , array('type'=>'currency'))->row()->description; ?><?php echo $row['amount'];?></a></td>
                                                                                </tr>
                                                                                <?php endforeach;?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
	                                                    </div>
	                                                    <div class="col-sm-6">
	                                                        <div class="element-wrapper">
                                                                <h6 class="element-header"><?php echo getEduAppGTLang('recent_expense');?></h6>
                                                                <div class="element-box-tp">
                                                                    <div class="table-responsive">
                                                                        <table class="table table-padded">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th><?php echo getEduAppGTLang('title');?></th>
                                                                                    <th><?php echo getEduAppGTLang('category');?></th>
                                                                                    <th><?php echo getEduAppGTLang('amount');?></th>
                                                                                    <th><?php echo getEduAppGTLang('method');?></th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <?php 
                                                                	            $this->db->limit(10);
                                                                	            $this->db->where('payment_type' , 'expense');
                                                                	            $this->db->where('year' , $running_year);
                                                                            	$this->db->order_by('timestamp' , 'desc');
                                                                	            $expenses = $this->db->get('payment')->result_array();
                                                                	            foreach ($expenses as $row):
    	                                                                    ?>
                                                                                <tr>
                                                                                    <td><?php echo $row['title'];?></td>
                                                                                    <td>
                                                                                        <a class="btn btn-sm btn-rounded btn-purple text-white">
                                                                                        <?php 
                                                                                            if ($row['expense_category_id'] != 0 || $row['expense_category_id'] != '')
                                                                                            echo $this->db->get_where('expense_category' , array('expense_category_id' => $row['expense_category_id']))->row()->name;
                                                                                        ?>
                                                                                        </a>
                                                                                    </td>
                                                                                    <td><?php echo $this->crud->getInfo('currency');?><?php echo $row['amount'];?></td>
                                                                                    <td>
                                                                                        <a class="btn nc btn-rounded btn-sm btn-primary text-white">
                                                                                        <?php 
                                                                                            if ($row['method'] == 1) echo getEduAppGTLang('cash');
                                                                                            if ($row['method'] == 2) echo getEduAppGTLang('check');
                                                                                            if ($row['method'] == 3) echo getEduAppGTLang('card');
                                                                                            ?>
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                                <?php endforeach;?>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                            </div>
	                                                    </div>
		                                            </div><br>                                      
                                  			    </div>
                                		    </div>
                            		    </div>
                              	    </div>
                			    </div>  
                    	    </div>
                  	    </div>
              	    </div>
                </div>
                <div class="display-type"></div>
            </div>
        </div>
    </div>