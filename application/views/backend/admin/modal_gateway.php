<?php $edit_data = $this->db->get_where('payment_gateways' , array('name' => $param2) )->result_array();?> 
<?php foreach($edit_data as $row):?>
    <div class="modal-body">
        <div class="modal-header mdl-header">
            <h6 class="title text-white"><?php echo getEduAppGTLang('update_gateway');?></h6>
        </div>
        <div class="ui-block-content">
            <?php echo form_open(base_url() . 'admin/accounting_settings/update/'.$param2);?>
            <?php if($param2 == 'paypal'):?>
                <?php $paypal_data = json_decode($row['settings']);?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="description-toggle">
                            <div class="description-toggle-content">
                                <div class="h6"><?php echo getEduAppGTLang('sandbox_mode');?></div>
                            </div>          
                            <div class="togglebutton">
                                <label><input name="sandbox_mode" value="1" <?php if($paypal_data->sandbox == 1) echo 'checked';?> type="checkbox"><span class="toggle"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="description-toggle">
                            <div class="description-toggle-content">
                                <div class="h6"><?php echo getEduAppGTLang('enable_paypal');?></div>
                            </div>          
                            <div class="togglebutton">
                                <label><input name="status" value="1" <?php if($row['status'] == 1) echo 'checked';?> type="checkbox"><span class="toggle"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('currency');?></label>
                            <input class="form-control" type="text" required="" name="paypal_currency" value="<?php echo $paypal_data->currency;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('client_id_sandbox');?></label>
                            <input class="form-control" type="text" name="client_id_sandbox" value="<?php echo $paypal_data->clientIdSandbox;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('client_id_production');?></label>
                            <input class="form-control" type="text" name="client_id_production" value="<?php echo $paypal_data->clientIdProduction;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('sandbox_email');?></label>
                            <input class="form-control" type="text" name="sandbox_email" value="<?php echo $paypal_data->sandbox_email;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('production_email');?></label>
                            <input class="form-control" type="text" name="production_email" value="<?php echo $paypal_data->production_email;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('update');?></button>
                    </div>
                </div>
            <?php endif;?>
            <?php if($param2 == 'stripe'):?>
            <?php $stripe_data = json_decode($row['settings']);?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="description-toggle">
                            <div class="description-toggle-content">
                                <div class="h6"><?php echo getEduAppGTLang('test_mode');?></div>
                            </div>          
                            <div class="togglebutton">
                                <label><input name="test_mode" <?php if($stripe_data->test_mode == 1) echo 'checked';?> value="1" type="checkbox"><span class="toggle"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="description-toggle">
                            <div class="description-toggle-content">
                                <div class="h6"><?php echo getEduAppGTLang('enable_stripe');?></div>
                            </div>          
                            <div class="togglebutton">
                                <label><input name="status" value="1" <?php if($row['status'] == 1) echo 'checked';?> type="checkbox"><span class="toggle"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('currency');?></label>
                            <input class="form-control" type="text"  name="stripe_currency" value="<?php echo $stripe_data->currency;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('test_secret_key');?></label>
                            <input class="form-control" type="text"  name="test_secret" value="<?php echo $stripe_data->test_secret;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('test_public_key');?></label>
                            <input class="form-control" type="text"  name="test_public_key" value="<?php echo $stripe_data->test_public_key;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('live_secret_key');?></label>
                            <input class="form-control" type="text"  name="live_secret_key" value="<?php echo $stripe_data->live_secret_key;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('live_public_key');?></label>
                            <input class="form-control" type="text"  name="live_public_key" value="<?php echo $stripe_data->live_public_key;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('update');?></button>
                    </div>
                </div>
            <?php endif;?>
            <?php if($param2 == 'razorpay'):?>
            <?php $razorpay_data = json_decode($row['settings']);?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="description-toggle">
                            <div class="description-toggle-content">
                                <div class="h6"><?php echo getEduAppGTLang('test_mode');?></div>
                            </div>          
                            <div class="togglebutton">
                                <label><input name="test_mode" <?php if($razorpay_data->test_mode == 1) echo 'checked';?> value="1" type="checkbox"><span class="toggle"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="description-toggle">
                            <div class="description-toggle-content">
                                <div class="h6"><?php echo getEduAppGTLang('enable_razorpay');?></div>
                            </div>          
                            <div class="togglebutton">
                                <label><input name="status" value="1" <?php if($row['status'] == 1) echo 'checked';?> type="checkbox"><span class="toggle"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('currency');?></label>
                            <input class="form-control" type="text" name="razorpay_currency" value="<?php echo $razorpay_data->currency;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('test_key_id');?></label>
                            <input class="form-control" type="text" name="test_key_id" value="<?php echo $razorpay_data->test_key_id;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('test_key_secret');?></label>
                            <input class="form-control" type="text" name="test_key_secret" value="<?php echo $razorpay_data->test_key_secret;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('production_key_id');?></label>
                            <input class="form-control" type="text" name="production_key_id" value="<?php echo $razorpay_data->production_key_id;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('production_key_secret');?></label>
                            <input class="form-control" type="text" name="production_key_secret" value="<?php echo $razorpay_data->production_key_secret;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('update');?></button>
                    </div>
                </div>
            <?php endif;?>
            <?php if($param2 == 'paystack'):?>
            <?php $paystack_data = json_decode($row['settings']);?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="description-toggle">
                            <div class="description-toggle-content">
                                <div class="h6"><?php echo getEduAppGTLang('test_mode');?></div>
                            </div>          
                            <div class="togglebutton">
                                <label><input name="test_mode" <?php if($paystack_data->test_mode == 1) echo 'checked';?> value="1" type="checkbox"><span class="toggle"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="description-toggle">
                            <div class="description-toggle-content">
                                <div class="h6"><?php echo getEduAppGTLang('enable_paystack');?></div>
                            </div>          
                            <div class="togglebutton">
                                <label><input name="status" value="1" <?php if($row['status'] == 1) echo 'checked';?> type="checkbox"><span class="toggle"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('currency');?></label>
                            <input class="form-control" type="text" name="paystack_currency" value="<?php echo $paystack_data->currency;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('test_public_key');?></label>
                            <input class="form-control" type="text" name="test_public_key" value="<?php echo $paystack_data->test_public_key;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('test_secret_key');?></label>
                            <input class="form-control" type="text" name="test_secret_key" value="<?php echo $paystack_data->test_secret_key;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('live_public_key');?></label>
                            <input class="form-control" type="text" name="live_public_key" value="<?php echo $paystack_data->live_public_key;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('live_secret_key');?></label>
                            <input class="form-control" type="text" name="live_secret_key" value="<?php echo $paystack_data->live_secret_key;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('update');?></button>
                    </div>
                </div>
            <?php endif;?>
            <?php if($param2 == 'flutterwave'):?>
            <?php $flutterwave_data = json_decode($row['settings']);?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="description-toggle">
                            <div class="description-toggle-content">
                                <div class="h6"><?php echo getEduAppGTLang('test_mode');?></div>
                            </div>          
                            <div class="togglebutton">
                                <label><input name="test_mode" <?php if($flutterwave_data->test_mode == 1) echo 'checked';?> value="1" type="checkbox"><span class="toggle"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="description-toggle">
                            <div class="description-toggle-content">
                                <div class="h6"><?php echo getEduAppGTLang('enable_flutterwave');?></div>
                            </div>          
                            <div class="togglebutton">
                                <label><input name="status" value="1" <?php if($row['status'] == 1) echo 'checked';?> type="checkbox"><span class="toggle"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('currency');?></label>
                            <input class="form-control" type="text" name="flutterwave_currency" value="<?php echo $flutterwave_data->currency;?>">
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <p>---------------------------------------- <?php echo getEduAppGTLang('test_credentials');?> ----------------------------------------</p>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('test_public_key');?></label>
                            <input class="form-control" type="text" name="test_public_key" value="<?php echo $flutterwave_data->test_public_key;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('test_secret_key');?></label>
                            <input class="form-control" type="text" name="test_secret_key" value="<?php echo $flutterwave_data->test_secret_key;?>">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('test_encryption_key');?></label>
                            <input class="form-control" type="text" name="test_encryption_key" value="<?php echo $flutterwave_data->test_encryption_key;?>">
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <p>---------------------------------------- <?php echo getEduAppGTLang('live_credentials');?> ----------------------------------------</p>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('live_public_key');?></label>
                            <input class="form-control" type="text" name="live_public_key" value="<?php echo $flutterwave_data->live_public_key;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('live_secret_key');?></label>
                            <input class="form-control" type="text" name="live_secret_key" value="<?php echo $flutterwave_data->live_secret_key;?>">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('live_encryption_key');?></label>
                            <input class="form-control" type="text" name="live_encryption_key" value="<?php echo $flutterwave_data->live_encryption_key;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('update');?></button>
                    </div>
                </div>
            <?php endif;?>
            <?php if($param2 == 'pesapal'):?>
            <?php $pesapal_data = json_decode($row['settings']);?>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="description-toggle">
                            <div class="description-toggle-content">
                                <div class="h6"><?php echo getEduAppGTLang('test_mode');?></div>
                            </div>          
                            <div class="togglebutton">
                                <label><input name="test_mode" <?php if($pesapal_data->test_mode == 1) echo 'checked';?> value="1" type="checkbox"><span class="toggle"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="description-toggle">
                            <div class="description-toggle-content">
                                <div class="h6"><?php echo getEduAppGTLang('enable_pesapal');?></div>
                            </div>          
                            <div class="togglebutton">
                                <label><input name="status" value="1" <?php if($row['status'] == 1) echo 'checked';?> type="checkbox"><span class="toggle"></span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('currency');?></label>
                            <input class="form-control" type="text" name="pesapal_currency" value="<?php echo $pesapal_data->currency;?>">
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <p>---------------------------------------- <?php echo getEduAppGTLang('test_credentials');?> ----------------------------------------</p>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('test_pesapal_consumer_key');?></label>
                            <input class="form-control" type="text" name="test_pesapal_consumer_key" value="<?php echo $pesapal_data->test_pesapal_consumer_key;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('test_pesapal_consumer_secret');?></label>
                            <input class="form-control" type="text" name="test_pesapal_consumer_secret" value="<?php echo $pesapal_data->test_pesapal_consumer_secret;?>">
                        </div>
                    </div>
                    <div class="col-sm-12 text-center">
                        <p>---------------------------------------- <?php echo getEduAppGTLang('live_credentials');?> ----------------------------------------</p>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('live_pesapal_consumer_key');?></label>
                            <input class="form-control" type="text" name="live_pesapal_consumer_key" value="<?php echo $pesapal_data->live_pesapal_consumer_key;?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('live_pesapal_consumer_secret');?></label>
                            <input class="form-control" type="text" name="live_pesapal_consumer_secret" value="<?php echo $pesapal_data->live_pesapal_consumer_secret;?>">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="form-group label-floating">
                            <label class="control-label">Pesapal IPN Listener URL</label>
                            <input class="form-control" type="text" readonly value="<?php echo base_url();?>payments/pesapal_response">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('update');?></button>
                    </div>
                </div>
            <?php endif;?>
            <?php echo form_close();?>
        </div>
    </div>
<?php endforeach;?>