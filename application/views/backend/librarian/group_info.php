<?php
	$group_info = $this->db->get_where('group_message_thread', array('group_message_thread_code' => $param2))->row_array();
	$user_info  = json_decode($group_info['members']);
 ?>
    <div class="modal-body top-0">
        <div class="modal-header mdl-header">
            <h6 class="title text-white"><?php echo getEduAppGTLang('group_information');?></h6>
        </div>
        <div class="ui-block-content">
            <div class="row">
                <div class="col-md-12 top-10px">
                    <table  class="table table-bordered">
                        <span class="col-md-12 col-group-name"><?php echo ucfirst($group_info['group_name']); ?></span>
                        <thead>
                            <tr class="bg-primary">
                                <th class="text-white text-center"><?php echo getEduAppGTLang('photo'); ?></th>
                                <th class="text-white text-center"><?php echo getEduAppGTLang('name'); ?></th>
                                <th class="text-white text-center"><?php echo getEduAppGTLang('email'); ?></th>
                            </tr>
                        </thead>
                        <?php for($i = 0; $i < sizeof($user_info); $i++):
      	                    $user_data = explode('_', $user_info[$i]);
      	                    $user_type = $user_data[0];
      	                    $user_id   = $user_data[1];
                        ?>
                            <tr>
                                <td><img src="<?php echo $this->crud->get_image_url($user_type, $user_id); ?>" class="img-circle" width="35"></td>
                                <td width="40%"><span><?php echo $this->crud->get_name($user_type,$user_id); ?></span></td>
                                <td width="40%"><span><?php echo $this->db->get_where($user_type, array($user_type . '_id' => $user_id))->row()->email; ?></span></td>
                            </tr>
                        <?php endfor ?>
                    </table>
                </div>
            </div>
        </div>
    </div>