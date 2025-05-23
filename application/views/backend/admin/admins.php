    <div class="content-w">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
      	<div class="conty">
        	<div class="all-wrapper no-padding-content solid-bg-all">
	            <div class="layout-w">
              		<div class="content-w">
                  		<div class="content-i">
                    		<div class="content-box">
                      			<div class="app-email-w">
                    				<div class="app-email-i">
                      					<div class="ae-content-w bg-content-x">
											<div class="top-header top-header-favorit">
												<div class="top-header-thumb">
													<img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('bglogin');?>" class="bgcover">
													<div class="top-header-author">
														<div class="author-thumb">
															<img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" class="authorCv">
														</div>
														<div class="author-content">
															<a href="javascript:void(0);" class="h3 author-name"><?php echo getEduAppGTLang('admins');?></a>
															<div class="country"><?php echo $this->crud->getInfo('system_name');?>  |  <?php echo $this->crud->getInfo('system_title');?></div>
														</div>
													</div>
												</div>
												<div class="profile-section bg-white">
													<div class="control-block-button">
                            							<a href="javascript:viod(0);" class="btn btn-control bg-purple c-btn-purple" data-toggle="modal" data-target="#crearadmin">
                                                            <i class="icon-feather-plus" title="<?php echo getEduAppGTLang('new_account');?>"></i>
                                                        </a>
													</div>
												</div>
											</div>
            								<div class="aec-full-message-w">
                								<div class="aec-full-message">
                    								<div class="container-fluid bg-content-x"><br>
                    									<div class="col-sm-12">
                    									    <div class="row">
                                                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                                                    <div class="form-group label-floating bg-white">
                                                                        <label class="control-label"><?php echo getEduAppGTLang('search');?></label>
                                                                        <input class="form-control" id="filter" type="text" required="">
                                                                    </div>
                                                                </div>
                                                            </div>                           
															<div class="row" id="results">
															<?php 
															    $admins = $this->db->get_where('admin', array('admin_id !=' => $this->session->userdata('login_user_id')))->result_array();
                                                                foreach($admins as $row):
                                                            ?>
                                                                <div class="col-xl-4 col-md-6 results">
                                                                    <div class="card-box widget-user ui-block list">
                                                                        <div class="more pull-right">
                                                                            <i class="icon-options"></i>                                
                                                                            <ul class="more-dropdown">
                                                                                <li><a href="javascript:void(0);" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/modal_admin/<?php echo $row['admin_id'];?>');"><?php echo getEduAppGTLang('edit');?></a></li>
                                                                                <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/admins/delete/<?php echo $row['admin_id'];?>"><?php echo getEduAppGTLang('delete');?></a></li>
                                                                            </ul>
                                                                        </div>
                                                                        <div>
                                                                            <img src="<?php echo $this->crud->get_image_url('admin', $row['admin_id']);?>" class="img-responsive rounded-circle" alt="user">
                                                                            <div class="wid-u-info">
                                                                                <a href="<?php echo base_url();?>admin/admin_profile/<?php echo $row['admin_id'];?>/" class="h6 author-name"><h5 class="mt-0 m-b-5"> <?php echo $this->crud->get_name('admin', $row['admin_id']);?></h5></a>
                                                                                <p class="text-muted m-b-5 font-13"><b><i class="picons-thin-icon-thin-0291_phone_mobile_contact"></i></b> <?php  echo $row['phone'];?><br>
                                                                                <b><i class="picons-thin-icon-thin-0321_email_mail_post_at"></i></b> <?php  echo $row['email'];?><br>
                                                                                <b><i class="picons-thin-icon-thin-0701_user_profile_avatar_man_male"></i></b>  <?php if($row['owner_status'] == 1):?>
                                                                                    <span class="badge badge-success px10"><?php echo getEduAppGTLang('super_admin');?></span>
                                                                                <?php else:?>
                                                                                    <span class="badge badge-primary px10"><?php echo getEduAppGTLang('admin');?> - <?=getDetailBranch($row['branch_id'])->name?></span>
                                                                                <?php endif;?>
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
 
    <div class="modal fade" id="crearadmin" tabindex="-1" role="dialog" aria-labelledby="crearadmin" aria-hidden="true">
        <div class="modal-dialog window-popup edit-my-poll-popup" role="document">
            <div class="modal-content">
                <a href="javascript:void(0);" class="close icon-close" data-dismiss="modal" aria-label="Close"></a>
                <div class="modal-body">
                    <div class="modal-header mdl-header">
                        <h6 class="title text-white"><?php echo getEduAppGTLang('new_account');?></h6>
                    </div>
                    <div class="ui-block-content">
                        <?php echo form_open(base_url() . 'admin/admins/create/', array('enctype' => 'multipart/form-data'));?>
                            <div class="row">
               	                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="profile-side-user">
                                        <div class="form-group">
                                            <label class="control-label"><?php echo getEduAppGTLang('photo');?></label>
                                            <input class="form-control" type="file" name="userfile">
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label"><?php echo getEduAppGTLang('first_name');?></label>
                                        <input class="form-control" type="text" name="first_name" required="">
                                    </div>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label"><?php echo getEduAppGTLang('last_name');?></label>
                                        <input class="form-control" type="text" required="" name="last_name">
                                    </div>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                		            <div class="form-group label-floating">
                  			            <label class="control-label"><?php echo getEduAppGTLang('username');?></label>
                  			            <input class="form-control" placeholder="" type="text" name="username" id="user_accountant" required="">
                  			            <small><span id="result_accountant"></span></small>
                  			            <span class="input-group-addon">
	                    		            <i class="icon-feather-mail"></i>
                  			            </span>
                		            </div>
              		            </div> 
              		            <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                		            <div class="form-group label-floating">
                  			            <label class="control-label"><?php echo getEduAppGTLang('password');?></label>
                  			            <input class="form-control" placeholder="" type="password" name="password" required="">
                  			            <span class="input-group-addon">
	                    		            <i class="icon-feather-mail"></i>
                  			            </span>
                		            </div>
              		            </div> 
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label"><?php echo getEduAppGTLang('email');?></label>
                                        <input class="form-control" type="email" id="emailx" name="email">
                                        <small><span id="result_emailx"></span></small>
                                        <span class="input-group-addon">
                                            <i class="icon-feather-mail"></i>
                                        </span>
                                    </div>
                                    <div class="form-group date-time-picker label-floating">
                                        <label class="control-label"><?php echo getEduAppGTLang('birthday');?></label>
                                        <input type='text' class="datepicker-here" data-position="top left" data-language='en' name="datetimepicker" data-multiple-dates-separator="/"/>
                                        <span class="input-group-addon">
                                            <i class="icon-feather-calendar"></i>
                                        </span>
                                    </div>
                               	</div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group label-floating is-empty">
                                        <label class="control-label"><?php echo getEduAppGTLang('phone');?></label>
                                        <input class="form-control" placeholder="" name="phone" type="text">
                                        <span class="input-group-addon">
                                            <i class="icon-feather-phone"></i>
                                        </span>
                                    </div>
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('gender');?></label>
                                        <div class="select">
                                            <select name="gender" required="">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <option value="M"><?php echo getEduAppGTLang('male');?></option>
                                                <option value="F"><?php echo getEduAppGTLang('female');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="form-group label-floating is-empty">
                                        <label class="control-label"><?php echo getEduAppGTLang('address');?></label>
                                        <input class="form-control" placeholder="" name="address" type="text">
                                        <span class="input-group-addon">
                                            <i class="icon-feather-map-pin"></i>
                                        </span>
                                    </div>
                                </div>                  
                                <!-- Pilihan account_type -->
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('account_type');?></label>
                                        <div class="select">
                                            <select name="owner_status" id="ownerStatus" required="">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <option value="1"><?php echo getEduAppGTLang('super_admin');?></option>
                                                <option value="2"><?php echo getEduAppGTLang('admin');?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Pilihan branch -->
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12" id="branchContainer">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('branch');?></label>
                                        <div class="select">
                                            <select name="branch_id" required="">
                                                <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                <?php foreach(getActiveBranch() as $branch):?>
                                                    <option value="<?php echo $branch->branch_id;?>"><?php echo $branch->name;?></option>
                                                <?php endforeach;?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                                    <button class="btn btn-rounded btn-success btn-lg full-width" id="sub_accountant" type="submit"><?php echo getEduAppGTLang('save');?></button>
                                </div>
                            </div>
                        <?php echo form_close();?>    
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function(){
        $('#branchContainer').hide();

        $('#ownerStatus').on('change', function() {
            var selected = $(this).val();
            if (selected === '2') { // Admin
                $('#branchContainer').show();
            } else {
                $('#branchContainer').hide();
            }
        });
    });
</script>
