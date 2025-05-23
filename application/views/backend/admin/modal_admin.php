<?php 
    $admin = $this->db->get_where('admin' , array('admin_id' => $param2))->result_array();
    foreach($admin as $row):
?>
    <div class="modal-body">
        <div class="modal-header mdl-header">
            <h6 class="title text-white"><?php echo getEduAppGTLang('update_information');?></h6>
        </div>
        <div class="ui-block-content">
            <?php echo form_open(base_url() . 'admin/admins/update/'.$row['admin_id'], array('enctype' => 'multipart/form-data'));?>
                <div class="row">
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                         <div class="form-group">
                            <label class="control-label"><?php echo getEduAppGTLang('photo');?></label>
                            <input name="userfile" accept="image/x-png,image/gif,image/jpeg" id="imgpre" type="file"/>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('first_name');?></label>
                            <input class="form-control" type="text" name="first_name" required="" value="<?php echo $row['first_name'];?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('last_name');?></label>
                            <input class="form-control" type="text" required="" name="last_name" value="<?php echo $row['last_name'];?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('username');?></label>
                            <input class="form-control" type="text" name="username" required="" value="<?php echo $row['username'];?>">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('password');?></label>
                            <input class="form-control" type="text" name="password">
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('email');?></label>
                            <input class="form-control" type="email" name="email" id="emailx" value="<?php echo $row['email'];?>">
                            <small><span id="result_emailx"></span></small>
                            <span class="input-group-addon">
                                <i class="icon-feather-mail"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('account_type');?></label>
                            <div class="select">
                                <select name="owner_status" id="slct">
                                    <option value="">Seleccionar</option>
                                    <option value="1" <?php if($row['owner_status'] == 1) echo 'selected';?>><?php echo getEduAppGTLang('suer_admin');?></option>
                                    <option value="2" <?php if($row['owner_status'] == 2) echo "selected";?>><?php echo getEduAppGTLang('admin');?></option>
                                </select>
                            </div>
                        </div>
                    </div> 
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12" id="branchContainerEdit">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('branch');?></label>
                            <div class="select">
                                <select name="branch_id" required="">
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                    <?php foreach(getActiveBranch() as $branch):
                                        if($row['branch_id'] == $branch->branch_id){
                                            $selected = 'selected';
                                        }else{
                                            $selected = '';
                                        }
                                        ?>
                                        <option value="<?php echo $branch->branch_id;?>" <?=$selected?>><?php echo $branch->name;?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('phone');?></label>
                            <input class="form-control" placeholder="" name="phone" type="text" value="<?php echo $row['phone'];?>">
                            <span class="input-group-addon">
                                <i class="icon-feather-phone"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-group label-floating is-select">
                            <label class="control-label"><?php echo getEduAppGTLang('gender');?></label>
                            <div class="select">
                                <select name="gender" id="slct">
                                    <option value=""><?php echo getEduAppGTLang('select');?></option>
                                    <option value="M" <?php if($row['gender'] == 'M') echo 'selected';?>><?php echo getEduAppGTLang('male');?></option>
                                    <option value="F" <?php if($row['gender'] == 'F') echo 'selected';?>><?php echo getEduAppGTLang('female');?></option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('address');?></label>
                            <input class="form-control" placeholder="" name="address" type="text" value="<?php echo $row['address'];?>">
                            <span class="input-group-addon">
                                <i class="icon-feather-map-pin"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-12 col-12">
                        <button class="btn btn-rounded btn-success btn-lg " id="sub_form" type="submit"><?php echo getEduAppGTLang('update');?></button>
                    </div>
                </div>
            <?php echo form_close();?>
        </div>
    </div>
    <?php endforeach;?>
    <script>
    $(document).ready(function(){
        if($('#slct').val() == 1){
            $('#branchContainerEdit').hide();
        }
        $('#slct').on('change', function() {
            var selected = $(this).val();
            if (selected === '2') { // Admin
                $('#branchContainerEdit').show();
            } else {
                $('#branchContainerEdit').hide();
            }
        });
    });
</script>