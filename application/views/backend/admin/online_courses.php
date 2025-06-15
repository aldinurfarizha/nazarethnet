<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<div class="content-w">
    <?php include 'fancy.php';?>
    <div class="header-spacer"></div>
    <div class="conty">
        <div class="os-tabs-w menu-shad">       
        <div class="os-tabs-controls">        
            <ul class="navs navs-tabs upper">           
                <li class="navs-item">            
                    <a class="navs-links active" href="<?php echo base_url();?>admin/online_courses/"><i class="picons-thin-icon-thin-0593_video_play_youtube"></i>
                    <span><?php echo getEduAppGTLang('online_courses');?></span></a>
                </li>
                <li class="navs-item">            
                    <a class="navs-links" href="<?php echo base_url();?>admin/new_online_course/"><i class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
                    <span><?php echo getEduAppGTLang('new_online_course');?></span></a>
                </li>
            </ul>       
        </div>
    </div>  
        <div class="content-box">
            <div class="row">
             <div class="col col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="ui-block list" data-mh="friend-groups-item">
                    <div class="friend-item friend-groups">
                        <div class="friend-item-content">
                            <div class="friend-avatar">
                                <br><br>
                                <i class="picons-thin-icon-thin-0593_video_play_youtube" style="font-size:45px; color: #99bf2d;"></i>
                                <h1 style="font-weight:bold;"><?php echo $this->db->get_where('online_course')->num_rows();?></h1>
                                <div class="author-content">
                                    <div class="country"><b> <?php echo getEduAppGTLang('total_courses');?></b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="ui-block list" data-mh="friend-groups-item">
                    <div class="friend-item friend-groups">
                        <div class="friend-item-content">
                            <div class="friend-avatar">
                                <br><br>
                                <i class="picons-thin-icon-thin-0590_movie_recording_play_director_cut" style="font-size:45px; color: #dd2979;"></i>
                                <h1 style="font-weight:bold;"><?php echo $this->db->get_where('online_course', array('status' => 1))->num_rows();?></h1>
                                <div class="author-content">
                                    <div class="country"><b><?php echo getEduAppGTLang('active_courses');?></b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="col col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <div class="ui-block list" data-mh="friend-groups-item">
                    <div class="friend-item friend-groups">
                        <div class="friend-item-content">
                            <div class="friend-avatar">
                                <br><br>
                                <i class="picons-thin-icon-thin-0060_error_warning_danger_stop_delete_exit" style="font-size:45px; color: #f4af08 ;"></i>
                                <h1 style="font-weight:bold;"><?php echo $this->db->get_where('online_course', array('status' => 0))->num_rows();?></h1>
                                <div class="author-content">
                                    <div class="country"><b> <?php echo getEduAppGTLang('inactive_courses');?></b></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="content-i">
      <div class="content-box">
         <div class="row">
                        <div class="col-sm-12">
                            <?php echo form_open(base_url() . 'admin/online_courses', array('class' => 'form m-b')); ?>
                            <div class="row">
                                <div class="col col-sm-3">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('filter_branch'); ?></label>
                                        <div class="select">
                                            <select onchange="get_class(this.value);" name="branch_id">
                                                <option value=""><?php echo getEduAppGTLang('all'); ?></option>
                                                <?php
                                                if (isSuperAdmin()) {
                                                    $branch = $this->db->where('status', 'ACTIVE')->get('branch')->result_array();
                                                } else {
                                                    $branch = $this->db->where('branch_id', getMyBranchId()->branch_id)->get('branch')->result_array();
                                                }
                                                foreach ($branch as $row):
                                                ?>
                                                    <option value="<?php echo $row['branch_id']; ?>"<?php if ($branch_id == $row['branch_id']) echo "selected"; ?>><?php echo $row['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-sm-3">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('filter_class'); ?></label>
                                        <div class="select">
                                            <?php if ($class_id == ""): ?>
												<select name="class_id" id="class_holder" onchange="get_sections(this.value);">
													<option value=""><?php echo getEduAppGTLang('all'); ?></option>
												</select>
											<?php else: ?>
												<select name="class_id" id="class_holder" onchange="get_sections(this.value);">
													<option value=""><?php echo getEduAppGTLang('select'); ?></option>
													<?php
													$class = $this->db->get_where('class', array('class_id' => $class_id))->result_array();
													foreach ($class as $key):
													?>
														<option value="<?php echo $key['class_id']; ?>" <?php if ($class_id == $key['class_id']) echo "selected"; ?>><?php echo $key['name']; ?></option>
													<?php endforeach; ?>
												</select>
											<?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
									<div class="form-group label-floating is-select">
										<label class="control-label"><?php echo getEduAppGTLang('section'); ?></label>
										<div class="select">
											<?php if ($section_id == ""): ?>
												<select name="section_id" id="section_holder">
													<option value=""><?php echo getEduAppGTLang('all'); ?></option>
												</select>
											<?php else: ?>
												<select name="section_id" id="section_holder">
													<option value=""><?php echo getEduAppGTLang('all'); ?></option>
													<?php
													$sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();
													foreach ($sections as $key):
													?>
														<option value="<?php echo $key['section_id']; ?>" <?php if ($section_id == $key['section_id']) echo "selected"; ?>><?php echo $key['name']; ?></option>
													<?php endforeach; ?>
												</select>
											<?php endif; ?>
										</div>
									</div>
								</div>
                                <div class="col col-sm-2">
                                    <div class="form-group label-floating is-select">
                                        <label class="control-label"><?php echo getEduAppGTLang('filter_status'); ?></label>
                                        <div class="select">
                                            <select name="status">
                                                <option value="" <?= ($status == '') ? 'selected' : ''; ?>>
                                                    <?= getEduAppGTLang('all'); ?>
                                                </option>
                                                <option value="1" <?= ($status === '1') ? 'selected' : ''; ?>>
                                                    <?= getEduAppGTLang('active'); ?>
                                                </option>
                                                <option value="0" <?= ($status === '0') ? 'selected' : ''; ?>>
                                                    <?= getEduAppGTLang('inactive'); ?>
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col col-sm-1 text-right">
                                    <div class="form-group mb-0">
                                        <button class="btn btn-primary mt-2">
                                            <?php echo getEduAppGTLang('filter'); ?> <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
        <div class="row">
          <main class="col col-xl-12 order-xl-2 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
            <div id="newsfeed-items-grid">                
                <div class="element-wrapper">
                    <div class="element-box-tp">
                    <h6 class="element-header">
                    <?php echo getEduAppGTLang('online_courses');?>
                    </h6>
                  <div class="table-responsive bg-white">
                    <table id="onlineCourse" class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th><?php echo getEduAppGTLang('status');?></th>
                            <th><?php echo getEduAppGTLang('branch');?></th>
                            <th><?php echo getEduAppGTLang('title');?></th>
                            <th><?php echo getEduAppGTLang('class');?></th>
                            <th><?php echo getEduAppGTLang('lesson_and_section');?></th>
                            <th><?php echo getEduAppGTLang('options');?></th>
                          </tr>
                        </thead>
                          <tbody>
                          <?php
                            $counter = 1;
                            if(isSuperAdmin())
                            {
                                $this->db->select('online_course.*, class.name as class_name, class.branch_id');
                                $this->db->from('online_course');
                                $this->db->join('class', 'class.class_id = online_course.class_id');
                                $this->db->where('online_course.year', $running_year);
                                $this->db->order_by('online_course.online_course_id', 'desc');
                                $onlines = $this->db->get()->result_array();
                            }else{
                                $branch_id=getMyBranchId()->branch_id;
                                $this->db->select('online_course.*, class.name as class_name, class.branch_id');
                                $this->db->from('online_course');
                                $this->db->join('class', 'class.class_id = online_course.class_id');
                                $this->db->where('online_course.year', $running_year);
                                $this->db->where('class.branch_id', $branch_id);
                                $this->db->order_by('online_course.online_course_id', 'desc');
                                $onlines = $this->db->get()->result_array();
                            }
                            foreach ($onlines as $hm):
                                if($branch_id!=null){
                                        if($hm['branch_id']!=$branch_id){
                                            continue;
                                        }
                                    }
                                if($class_id!=null){
                                        if($hm['class_id']!=$class_id){
                                            continue;
                                        }
                                    }
                                if($section_id!=null){
                                        if($hm['section_id']!=$section_id){
                                            continue;
                                        }
                                    }
                                if($status!=null){
                                        if($hm['status']!=$status){
                                            continue;
                                        }
                                }
                          ?>
                          <tr>
                            <td>
                                <?php if($hm['status'] == 1):?>
                                    <span class="status-pill green"></span> <span><?php echo getEduAppGTLang('active');?></span>
                                <?php else:?>
                                    <span class="status-pill red"></span><span><?php echo getEduAppGTLang('inactive ');?></span>
                                <?php endif;?>
                            </td>
                            <td><?php if($hm['branch_id'])
                            {
                                $branchDetail=getDetailBranch($hm['branch_id']);
                                echo $branchDetail->name;
                            }else{
                                echo "-";
                            }
                            ?></td>
                            <td><span><?php echo $hm['title'];?></span></td>
                            <td>
                                <span class="badge badge-success"><?php echo $this->db->get_where('class', array('class_id' => $hm['class_id']))->row()->name.' - '.$this->db->get_where('section', array('section_id' => $hm['section_id']))->row()->name;?></span>
                            </td>
                            <td><?php echo getEduAppGTLang('Sections').': '.$hm['section']?>
                            <?php echo getEduAppGTLang('Lessons').': '.$hm['lesson'];?></td>
                            <td class="bolder">
                                <a style="color:grey;" href="<?php echo base_url();?>admin/watch/<?php echo $hm['online_course_id']?>" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('view_online_course');?>"><i class="picons-thin-icon-thin-0140_airplay_screen_sharing"></i></a>
                                <a style="color:grey;" href="<?php echo base_url();?>admin/lessons/<?php echo $hm['online_course_id']?>" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('lesson_and_quiz');?>"><i class="picons-thin-icon-thin-0003_write_pencil_new_edit"></i></a>
                                <?php if($hm['status'] == 1):?>
                                <a style="color:grey;" onClick="return confirm('<?php echo getEduAppGTLang('confirm_inactive');?>')" href="<?php echo base_url();?>admin/online_courses/inactive/<?php echo $hm['online_course_id']?>" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('mark_as_inactive');?>"><i class="picons-thin-icon-thin-0153_delete_exit_remove_close"></i></a>
                                <?php else:?>
                                <a style="color:grey;" onClick="return confirm('<?php echo getEduAppGTLang('confirm_active');?>')" href="<?php echo base_url();?>admin/online_courses/active/<?php echo $hm['online_course_id']?>" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('mark_as_active');?>"><i class="picons-thin-icon-thin-0154_ok_successful_check"></i></a>
                                <?php endif;?>
                                <a style="color:grey;" onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')"  href="<?php echo base_url();?>admin/online_courses/delete/<?php echo $hm['online_course_id']?>" data-toggle="tooltip" data-placement="top" data-original-title="<?php echo getEduAppGTLang('delete');?>"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty"></i></a>
                            </td>
                          </tr>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </main>
              </div>
            </div>
            <a class="back-to-top" href="javascript:void(0);" style="color:#fff;">
              <i class="picons-thin-icon-thin-0128_upload_load_share"></i>
            </a>
          </div>
    </div>      
  </div>
</div>
<div class="display-type"></div>
</div>

<script>
$(document).ready(function() {
    $('#onlineCourse').DataTable();
});
</script>