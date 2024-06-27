    <div class="content-w"> 
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
        <div class="conty bg-white">
            <div class="full-chat-w">
                <div class="full-chat-i">
                    <div class="full-chat-left support-tickets">          
				        <div class="tab-content">
                            <div class="os-tabs-w bg-white">
                                <ul class="navs navs-tabs upper centered">
                                    <li class="navs-item">
                                        <a class="navs-links text-black <?php if($page_name == 'message' && $message_inner_page_name != 'message_new') echo "active";?>" href="<?php echo base_url();?>accountant/message/"><i class="os-icon picons-thin-icon-thin-0306_chat_message_discussion_bubble_conversation nav-color"></i><span><?php echo getEduAppGTLang('chats');?></span></a>
                                    </li>
                                    <li class="navs-item">
                                        <a class="navs-links text-black <?php if($message_inner_page_name == 'message_new') echo "active";?>" href="<?php echo base_url();?>accountant/message/message_new/"><i class="os-icon picons-thin-icon-thin-0001_compose_write_pencil_new nav-color"></i><span><?php echo getEduAppGTLang('write');?></span></a>
                                    </li>
                                    <li class="navs-item">
                                        <a class="navs-links text-black" href="<?php echo base_url();?>accountant/group/"><i class="os-icon picons-thin-icon-thin-0719_group_users_circle nav-color"></i><span><?php echo getEduAppGTLang('groups');?></span></a>
                                    </li>
                                </ul>
                            </div>
          				    <div class="tab-pane active" id="chats">
                        		<div class="user-list">
                    		    <?php 
                    		        $current_user = $this->session->userdata('login_type') . '-' . $this->session->userdata('login_user_id');
                          		    $message_threads = $this->crud->getChat();
                          		    foreach ($message_threads as $row):
                            	    if ($row['sender'] == $current_user)
                            	    {
                                  		$user_to_show = explode('-', $row['reciever']);
                            	    }
                            	    if ($row['reciever'] == $current_user)
                            	    {
                                  		$user_to_show = explode('-', $row['sender']);
                            	    }
                            	    $user_to_show_type = $user_to_show[0];
                            	    $user_to_show_id = $user_to_show[1];
                            	    $unread_message_number = $this->crud->count_unread_message_of_thread($row['message_thread_code']);
                    		    ?>
                    		        <?php $this->db->where('message_thread_code',$row['message_thread_code']); $rw= $this->db->get('message')->last_row();?>
                    		        <?php $dbinfo = explode('-',$rw->sender);?>
                        			<a href="<?php echo base_url(); ?>accountant/message/message_read/<?php echo $row['message_thread_code']; ?>">
                          				<div class="user-w box <?php if (isset($current_message_thread_code) && $current_message_thread_code == $row['message_thread_code']) echo 'active'; ?>">
                            				<div class="avatar with-status status-green">
    	                          				<img alt="" src="<?php echo $this->crud->get_image_url($user_to_show_type, $user_to_show_id);?>">
                            				</div>
                            				<div class="user-info">
                            					<?php if ($unread_message_number > 0): ?>
                              						<div class="user-date"><?php echo $unread_message_number; ?></div>
                              					<?php else:?>
    	                          					<div class="user-date">
                                						<?php echo $rw->timestamp;?>
    	                          					</div>
                              					<?php endif;?>
                              					<div class="user-name" title="<?php echo $this->crud->get_name($user_to_show_type, $user_to_show_id);?>">
                                				    <?php echo $this->crud->get_name($user_to_show_type, $user_to_show_id);?>
                              					</div>
                              					<div class="last-message">
                                                    <?php if($current_user == $rw->sender) echo getEduAppGTLang('you').": ". substr($rw->message, 0, 40).'...'; else echo substr($rw->message, 0, 40).'...';?>
                                                </div>
                              					<div class="last-message">
                                					<?php if($user_to_show_type =='admin') : ?>
                                 						<a class="badge badge-success text-white" href="<?php echo base_url(); ?>accountant/message/message_read/<?php echo $row['message_thread_code']; ?>"><?php echo getEduAppGTLang('admin');?></a>
                               						<?php endif;?>
                              					</div>
                            				</div>
                          				</div>
                          			</a>
                    			    <?php endforeach;?>
          					    </div>
          				    </div>
                  	    </div>
          		    </div>
          		    <?php include $message_inner_page_name . '.php'; ?>
                </div>
            </div>
        </div>
    </div>