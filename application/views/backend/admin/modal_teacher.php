<?php 
    $admin = $this->db->get_where('teacher' , array('teacher_id' => $param2))->result_array();
    foreach($admin as $row):
?>
    <div class="modal-body">
        <div class="modal-header mdl-header">
            <h6 class="title text-white"><?php echo getEduAppGTLang('update_information');?></h6>
        </div>
        <div class="ui-block-content">
            <?php echo form_open(base_url() . 'admin/teachers/update/'.$row['teacher_id'], array('enctype' => 'multipart/form-data'));?>
                <div class="row">
              		<div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                		<div class="form-group">
                  			<label class="control-label"><?php echo getEduAppGTLang('photo');?></label>
                  			<input class="form-control" name="userfile" type="file">
	                	</div>
              		</div>
              		<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
	                	<div class="form-group label-floating">
                  			<label class="control-label"><?php echo getEduAppGTLang('first_name');?></label>
                  			<input class="form-control" name="first_name" type="text" required="" value="<?php echo $row['first_name'];?>">
	                	</div>
            		</div>
                	<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                		<div class="form-group label-floating">
                  			<label class="control-label"><?php echo getEduAppGTLang('last_name');?></label>
                  			<input class="form-control" name="last_name" type="text" required="" value="<?php echo $row['last_name'];?>">
                		</div>
              		</div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                		<div class="form-group label-floating">
                  			<label class="control-label"><?php echo getEduAppGTLang('username');?></label>
                  			<input class="form-control" placeholder="" type="text" name="username" value="<?php echo $row['username'];?>">
                  			<span class="input-group-addon">
	                    		<i class="icon-feather-mail"></i>
                  			</span>
                		</div>
              		</div> 
              		<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                		<div class="form-group label-floating">
                  			<label class="control-label"><?php echo getEduAppGTLang('password');?></label>
                  			<input class="form-control" placeholder="" type="password" name="password">
                  			<span class="input-group-addon">
	                    		<i class="icon-feather-mail"></i>
                  			</span>
                		</div>
              		</div> 
              		<div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                		<div class="form-group label-floating">
                  			<label class="control-label"><?php echo getEduAppGTLang('email');?></label>
                  			<input class="form-control" placeholder="" type="email" name="email" id="email" value="<?php echo $row['email'];?>">
                  			<small><span id="result_email"></span></small>
                  			<span class="input-group-addon">
	                    		<i class="icon-feather-mail"></i>
                  			</span>
                		</div>
              		</div>              
              		<div class="col col-lg-6 col-md-6 col-sm-12 col-12">              
                		<div class="form-group label-floating">
                  			<label class="control-label"><?php echo getEduAppGTLang('phone');?></label>
                  			<input class="form-control" name="phone" type="text" value="<?php echo $row['phone'];?>">
                  			<span class="input-group-addon">
                    			<i class="icon-feather-phone"></i>
                  			</span>
                		</div>
              		</div>
              		<div class="col col-lg-6 col-md-6 col-sm-12 col-12">              
                		<div class="form-group label-floating">
                  			<label class="control-label"><?php echo getEduAppGTLang('identification');?></label>
                  			<input class="form-control" name="idcard" type="text" value="<?php echo $row['idcard'];?>">
                  			<span class="input-group-addon">
                    			<i class="icon-feather-phone"></i>
                  			</span>
                		</div>
              		</div>
              		<div class="col col-lg-6 col-md-6 col-sm-12 col-12">          
                		<div class="form-group label-floating">
                  			<label class="control-label"><?php echo getEduAppGTLang('address');?></label>
                  			<input class="form-control" name="address" type="text" value="<?php echo $row['address'];?>">
                  			<span class="input-group-addon">
                    			<i class="icon-feather-map-pin"></i>
                  			</span>
                		</div>        
              		</div> 
              		<div class="col col-lg-6 col-md-6 col-sm-12 col-12">          
    	                <button class="btn btn-rounded btn-success btn-lg" type="submit" id="sub_form"><?php echo getEduAppGTLang('update');?></button>
          		    </div>
            	</div>
            <?php echo form_close();?>
        </div>
    </div>
<?php endforeach;?>