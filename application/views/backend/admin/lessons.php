 <div class="content-w">
      <div class="header-spacer"></div>
       <div class="conty">
  <?php include 'fancy.php';?>
  <div class="header-spacer"></div>
 
    <div class="content-i">
        <div class="content-box">
           <div class="ui-block">
            <div class="ui-block-content">
                    <div class="steps-w">
                        <div class="step-triggers">
                            <a class="step-trigger active" href="#stepContent1"><?php echo getEduAppGTLang('lesson_and_quiz');?></a>
                            <a class="step-trigger" href="#stepContent2"><?php echo getEduAppGTLang('update_online_course');?></a>
                            
                        </div>
                        <div class="step-contents">
                            <div class="step-content active" id="stepContent1">
                               
                               <div class="back hidden-sm-down" style="margin-top:-20px;margin-bottom:10px">        
                                <a  title="back" href="<?php echo base_url();?>admin/online_courses/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>    
                                <a  style="padding-left:20px;" title="Start online course" href="<?php echo base_url();?>admin/watch/<?php echo $course_id?>"><i class="picons-thin-icon-thin-0140_airplay_screen_sharing"></i></a> 
                                </div>
                               
                                    <div class="row">
                                       <div class="col col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12"><br>
                                            <center><a class="btn btn-rounded btn-info btn-lg step-trigger-btn" style="width:100%;font-size: 100%;" href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/new_secction_online/<?php echo $course_id?>')"><?php echo getEduAppGTLang('add_section');?></a></center>
                                       </div>
                                       <div class="col col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12"><br>
                                            <center><a class="btn btn-rounded btn-warning btn-lg step-trigger-btn" style="width:100%;font-size: 100%;" href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/new_lesson_online/<?php echo $course_id?>')"><?php echo getEduAppGTLang('add_lesson');?></a></center>
                                       </div>
                                       <div class="col col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12"><br>
                                            <center><a class="btn btn-rounded btn-primary btn-lg step-trigger-btn" style="width:100%;font-size: 100%;" href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/new_quiz_online/<?php echo $course_id?>')"><?php echo getEduAppGTLang('add_quiz');?></a></center>
                                       </div>
                                    </div><br><br>
                                    
                                    <div class="col-sm-12">     
                                        <div class="row">
                                            <?php
                                                $this->db->order_by('section_online_id', 'asc');
                                                $sections = $this->db->get_where('section_online', array('online_course_id'=>$course_id))->result_array();
                                                $n=1; foreach($sections as $rr): ?>
                                            <div class="col col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="ui-block" data-mh="friend-groups-item" style="background-color:#f2f4f8;height: 264px;">
                                                    <div class="friend-item friend-groups">
                                                        <div class="friend-item-content">
                                                            <div class="more">
                                                                <i class="icon-feather-more-horizontal"></i>
                                                                  <ul class="more-dropdown">
                                                                    <li><a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/update_secction_online/<?php echo $rr['section_online_id']?>')">Edit section</a></li>
                                                                    <li><a onClick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>')" href="<?php echo base_url();?>admin/lessons/delete_section/<?php echo $rr['section_online_id']?>">Delete section</a></li>
                                                                  </ul>
                                                            </div>
                                                    
                                                            <div style="height:100%;" class="friend-avatar">
                                                               
                                                                  <b><h3 style="font-size:100%;">Section <?php echo $n++;?>: <?php echo $rr['name'];?></h3></b>
                                                               
                                                                <?php $this->db->order_by('lesson_online_id', 'asc');
                                                                      $less = $this->db->get_where('lesson_online', array('section_online_id'=> $rr['section_online_id']))->result_array();
                                                                      $n2=1;
                                                                      $this->db->order_by('quiz_id', 'asc');
                                                                      $quizz = $this->db->get_where('quiz', array('section_online_id'=> $rr['section_online_id']))->result_array();
                                                                      $n3=1;?>
                                                                <div class="ui-block" data-mh="friend-groups-item" style="height:100%;">
                                                                    <div style="padding-left:5%;" class="text-left">
                                                                        <?php foreach($less as $ss):?>
                                                                            <h4 style="font-size:100%;">
                                                                            <?php if($ss['type'] == 'videos' && $ss['type_video'] == 'youtube'):?><i class="os-icon picons-thin-icon-thin-0593_video_play_youtube"></i><?php endif;?>
                                                                            <?php if($ss['type'] == 'videos' && $ss['type_video'] == 'vimeo'):?><i class="picons-social-icon-vimeo"></i><?php endif;?>
                                                                            <?php if($ss['type'] == 'videos' && $ss['type_video'] == 'html5'):?><i class="picons-social-icon-html5"></i><?php endif;?>
                                                                            <?php if($ss['type'] == 'videos' && $ss['type_video'] == 'local'):?><i class="picons-social-icon-html5"></i> <?php endif;?>
                                                                            <?php if($ss['type'] == 'text'):?><i class="icon-event"></i> <?php endif;?>
                                                                            <?php if($ss['type'] == 'pdf'):?><i class="icon-docs"></i> <?php endif;?>
                                                                            <?php if($ss['type'] == 'document'):?><i class="icon-doc"></i> <?php endif;?>
                                                                            <?php if($ss['type'] == 'image'):?><i class="icon-picture"></i> <?php endif;?>
                                                                            Lesson <?php echo $n2++;?> : <b><?php echo $ss['name'];?></b>
                                                                            <a title="<?php echo getEduAppGTLang('update');?>" style="font-size:100%; float:right; padding-right:15%;" href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/update_lesson_online/<?php echo $ss['lesson_online_id']?>')" class="h5 author-name"><i class="icon-share-alt"></i></a></h4>
                                                                        <?php endforeach;?>
                                                                        <?php foreach($quizz as $qq):?>
                                                                            <h4 style="font-size:100%;"><i class="icon-exclamation"></i>
                                                                            Quiz <?php echo $n3++;?> : <b><?php echo $qq['title'];?></b> 
                                                                            <a title="<?php echo getEduAppGTLang('update');?>" style="float:right; font-size:100%; padding-right:15%;" href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/update_quiz_online/<?php echo $qq['quiz_id']?>')" class="h5 author-name"><i class="icon-share-alt"></i></a>
                                                                            <a title="<?php echo getEduAppGTLang('questions');?>" style="float:right; font-size:100%; padding-right:1%;" href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/view_question_quiz/<?php echo $qq['quiz_id']?>')" class="h5 author-name"><i class="picons-thin-icon-thin-0061_error_warning_alert_attention"></i></a>
                                                                            <a title="<?php echo getEduAppGTLang('answers');?>" style="float:right; font-size:100%; padding-right:1%;" href="<?php echo base_url();?>admin/quiz_response/<?php echo $course_id;?>/<?php echo $qq['quiz_id']?>/" class="h5 author-name"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i></a></h4>
                                                                        <?php endforeach;?>
                                                                    </div>
                                                                </div>
                                                                   
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach;?>
                                        </div>
                                    </div>
                                <div class="form-buttons-w text-right">
                                    <a class="btn btn-rounded btn-success btn-lg step-trigger-btn" href="#stepContent2"><?php echo getEduAppGTLang('next');?></a>
                                </div>          
                            </div>

                            <div class="step-content" id="stepContent2">
                                  <div class="col-lg-12">   
                                        <?php 
                                        $this->db->order_by('online_course_id', 'asc');
                                        $this->db->where('online_course_id',$course_id);
                                        $course = $this->db->get('online_course')->result_array();
                                        foreach($course as $row):?>
                                        
                           
                                          <div class="modal-header">
                                            <h5 class="modal-title"><?php echo getEduAppGTLang('Update_lesson');?></h5>
                                          </div>
                                          <br>
                                           <?php echo form_open(base_url() . 'admin/update_online_course/'.$course_id, array('method' => 'post', 'enctype' => 'multipart/form-data')); ?>
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for=""><?php echo getEduAppGTLang('title');?></label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="title" value="<?php echo $row['title'];?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-4"><br>
                                                    <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                                                    <div class="select">
                                                        <select name="class_id" required onchange="select_section(this.value),select_subject(this.value)">
                                                            <option value=""><?php echo getEduAppGTLang('select');?></option>
                                                            <?php
                                                                $classes = $this->db->get_where('class')->result_array();
                                                                foreach($classes as $row2):                        
                                                            ?> 
                                                                <option value="<?php echo $row2['class_id'];?>" <?php if($row['class_id'] == $row2['class_id']) echo "selected";?>><?php echo $row2['name'];?></option>    
                                                            <?php endforeach;?>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-4"><br>
                                                    <label class="control-label"><?php echo getEduAppGTLang('section');?></label>
                                                    <div class="select">
                                                        <select name="section_id" required id="section_holder">
                                                            <option value="<?php echo $row['section_id']?>"><?php echo $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name;?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-sm-4"><br>
                                                    <label class="control-label"><?php echo getEduAppGTLang('subject');?></label>
                                                    <div class="select">
                                                        <select name="subject_id" required id="subject_holder">
                                                             <option value="<?php echo $row['subject_id']?>"><?php echo $this->db->get_where('subject', array('subject_id' => $row['subject_id']))->row()->name;?></option>
                                                        </select>
                                                    </div>
                                                </div>
                                               
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for=""><?php echo getEduAppGTLang('outcomes');?></label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="outcomes" value="<?php echo $row['outcomes'];?>">
                                                            <input type="hidden" name="type" id="type" value="<?php echo $row['provider']?>">
                                                        </div>
                                                    </div>  
                                                </div>
                                      
                                                <div class="col-sm-12">
                                                <div class="ui-block paddingtel">                                
                                                    <div class="news-feed-form">
                                                      <div class="tab-content">
                                                        <div class="edu-wall-content ng-scope" id="new_local">
                                                          <div class="tab-pane active show">
                                                            <div class="form-group" style="margin-bottom:-15px;">
                                                              <input type="file" name="video" id="userfile" class="inputfile inputfile-3" style="display:none">
                                                              <label style="font-size:15px;" for="userfile"><i class="os-icon picons-thin-icon-thin-0042_attachment"></i> <span><?php echo getEduAppGTLang('upload_video');?>...</span></label>
                                                            </div>
                                                            <br><br> 
                                                            <div class="col-md-12">
                                                                <div class="wrapper-image-preview" style="margin-left: -6px;">
                                                                    <div class="box" style="width: 250px;">
                                                                        <div class="js--image-preview" style="background-color: #fefefe;"></div>
                                                                      <div class="upload-options">
                                                                        <label for="course_thumbnail" class="btn pb-1"> <i class="mdi mdi-camera"></i><?php echo getEduAppGTLang('course_thumbnail');?><br> <small>(800 X 530)</small> </label>
                                                                        <input id="course_thumbnail"  type="file" class="image-upload" name="imgLocal" accept="image/*">
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="add-options-message btm-post edupostfoot edu-wall-actions" style="padding:10px 5px;">  
                                                              <a href="javascript:void(0);" class="options-message" onclick="post()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('local_video');?>">
                                                                <i class="picons-social-icon-html5"></i>
                                                              </a>
                                                              <!--<a href="javascript:void(0);" class="options-message" onclick="html5()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php //echo getEduAppGTLang('html5_video');?>">
                                                                <i class="picons-social-icon-html5"></i>
                                                              </a>-->
                                                              <a href="javascript:void(0);" class="options-message" onclick="poll()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('vimeo_video');?>">
                                                                <i class="picons-social-icon-vimeo"></i>
                                                              </a>
                                                              <a href="javascript:void(0);" class="options-message" onclick="video()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('youtube_video');?>">
                                                                <i class="os-icon picons-thin-icon-thin-0593_video_play_youtube"></i>
                                                              </a>
                                                            </div>        
                                                          </div>                          
                                                        </div>
                                                        
                                                       
                                                         <div class="edu-wall-content ng-scope" id="new_video_youtube"  style="display: none;">
                                                          <div class="tab-pane show">
                                                     
                                                            <input type="hidden" name="embed" id="embed" <?php if ($row['provider'] == 'youtube'):?> value="<?php echo $row['embed'];?>" <?php endif;?>>
                                                            
                                                            <div class="form-group" style="margin-bottom:-15px;">
                                                                
                                                       
                                                              <input type="text" name="url_youtube" <?php if($row['provider'] == 'youtube'):?> value="<?php echo $row['url_video']?>" <?php endif;?> id="url" class="form-control" placeholder="YouTube URL" onchange="set_video()">
                                                              
                                                            </div><br>
                                                              <pre style="text-align:center;display:none;" id="myCode"></pre>
                                                            
                                                            <div class="col-md-12">
                                                                <div class="wrapper-image-preview" style="margin-left: -6px;">
                                                                    <div class="box" style="width: 250px;">
                                                                        <div class="js--image-preview" style="background-color: #fefefe;"></div>
                                                                      <div class="upload-options">
                                                                        <label for="course_thumbnail" class="btn pb-1"> <i class="mdi mdi-camera"></i><?php echo getEduAppGTLang('course_thumbnail');?><br> <small>(800 X 530)</small> </label>
                                                                        <input id="course_thumbnail"  type="file" class="image-upload" name="imgYoutube" accept="image/*">
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="add-options-message btm-post edupostfoot edu-wall-actions" style="padding:10px 5px;">
                                                              <a href="javascript:void(0);" class="options-message" onclick="post()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('local_video');?>">
                                                                <i class="picons-social-icon-html5"></i>
                                                              </a>
                                                              <!--<a href="javascript:void(0);" class="options-message" onclick="html5()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php //echo getEduAppGTLang('html5_video');?>">
                                                                <i class="picons-social-icon-html5"></i>
                                                              </a>-->
                                                              <a href="javascript:void(0);" class="options-message" onclick="poll()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('vimeo_video');?>">
                                                                <i class="picons-social-icon-vimeo"></i>
                                                              </a>
                                                              <a href="javascript:void(0);" class="options-message" onclick="video()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('youtube_video');?>">
                                                                <i class="os-icon picons-thin-icon-thin-0593_video_play_youtube"></i>
                                                              </a>
                                                            </div>        
                                                          </div>                          
                                                        </div>
                                                        
                                                        <div class="edu-wall-content ng-scope" id="new_html5"  style="display: none;">
                                                          <div class="tab-pane show">
                                                            <div class="form-group" style="margin-bottom:-15px;">
                                                              <input type="text"  id="url_html5" name="url_html5" <?php if($row['provider'] == 'html5'):?> value="<?php echo $row['url_video']?>" <?php endif;?> class="form-control" placeholder="URL Video">
                                                            </div><br>
                                                          
                                                            <div class="col-md-12">
                                                                <div class="wrapper-image-preview" style="margin-left: -6px;">
                                                                    <div class="box" style="width: 250px;">
                                                                        <div class="js--image-preview" style="background-color: #fefefe;"></div>
                                                                      <div class="upload-options">
                                                                        <label for="course_thumbnail" class="btn pb-1"> <i class="mdi mdi-camera"></i><?php echo getEduAppGTLang('course_thumbnail');?><br> <small>(800 X 530)</small> </label>
                                                                        <input id="course_thumbnail"  type="file" class="image-upload" name="imghtml5" accept="image/*">
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="add-options-message btm-post edupostfoot edu-wall-actions" style="padding:10px 5px;">
                                                             <a href="javascript:void(0);" class="options-message" onclick="post()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('local_video');?>">
                                                                <i class="picons-social-icon-html5"></i>
                                                              </a>
                                                              <!--<a href="javascript:void(0);" class="options-message" onclick="html5()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php//echo getEduAppGTLang('html5_video');?>">
                                                                <i class="picons-social-icon-html5"></i>
                                                              </a>-->
                                                              <a href="javascript:void(0);" class="options-message" onclick="poll()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('vimeo_video');?>">
                                                                <i class="picons-social-icon-vimeo"></i>
                                                              </a>
                                                              <a href="javascript:void(0);" class="options-message" onclick="video()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('youtube_video');?>">
                                                                <i class="os-icon picons-thin-icon-thin-0593_video_play_youtube"></i>
                                                              </a>
                                                            </div>       
                                                          </div>                          
                                                        </div>
                                                          
                                                        <div class="edu-wall-content ng-scope" id="new_video_vimeo" style="display: none;"> 
                                                          <div class="tab-pane active show"><br>
                                                            <div class="form-group" style="margin-bottom:-15px;">
                                                             
                                                              <input type="text" id="url_vimeo" name="url_vimeo" <?php if($row['provider'] == 'vimeo'):?> value="<?php echo $row['url_video']?>" <?php endif;?> class="form-control" placeholder="Vimeo URL">
                                                            </div><br>
                                                            <div class="col-md-12">
                                                                <div class="wrapper-image-preview" style="margin-left: -6px;">
                                                                    <div class="box" style="width: 250px;">
                                                                        <div class="js--image-preview" style="background-color: #fefefe;"></div>
                                                                      <div class="upload-options">
                                                                        <label for="course_thumbnail" class="btn pb-1"> <i class="mdi mdi-camera"></i><?php echo getEduAppGTLang('course_thumbnail');?><br> <small>(800 X 530)</small> </label>
                                                                        <input id="course_thumbnail"  type="file" class="image-upload" name="imgVimeo" accept="image/*">
                                                                      </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="add-options-message btm-post edupostfoot edu-wall-actions" style="padding:10px 5px;">
                                                             <a href="javascript:void(0);" class="options-message" onclick="post()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('local_video');?>">
                                                                <i class="picons-social-icon-html5"></i>
                                                              </a>
                                                              <!--<a href="javascript:void(0);" class="options-message" onclick="html5()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php //echo getEduAppGTLang('html5_video');?>">
                                                                <i class="picons-social-icon-html5"></i>
                                                              </a>-->
                                                              <a href="javascript:void(0);" class="options-message" onclick="poll()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('vimeo_video');?>">
                                                                <i class="picons-social-icon-vimeo"></i>
                                                              </a>
                                                              <a href="javascript:void(0);" class="options-message" onclick="video()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('youtube_video');?>">
                                                                <i class="os-icon picons-thin-icon-thin-0593_video_play_youtube"></i>
                                                              </a>
                                                            </div>     
                                                          </div>    
                                                      </div> 
                                                    </div>
                                                  </div>                
                                                </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for=""><?php echo getEduAppGTLang('description');?></label>
                                                        <textarea class="form-control" name="description"><?php echo $row['description']?></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <div class="col-sm-12" style="text-align: center;">
                                                        <button type="submit" class="btn btn-success"><?php echo getEduAppGTLang('update');?></button>
                                                    </div>
                                                </div>
                                            </div>
                                         <?php echo form_close();?>
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



 <script type="text/javascript">
        //File Preview
        if (window.FileReader) 
        {
            var reader = new FileReader(), rFilter = /^(image\/bmp|image\/cis-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x-cmu-raster|image\/x-cmx|image\/x-icon|image\/x-portable-anymap|image\/x-portable-bitmap|image\/x-portable-graymap|image\/x-portable-pixmap|image\/x-rgb|image\/x-xbitmap|image\/x-xpixmap|image\/x-xwindowdump)$/i; 
            reader.onload = function (oFREvent) 
            {
              $("#logoPreview").show(); 
                lgpreview = document.getElementById("logoPreview")
                lgpreview.src = oFREvent.target.result;  
            };  
            function imagePreview() 
            {
                if (document.getElementById("userfile").files.length === 0) { return; }  
                var file = document.getElementById("userfile").files[0];  
                if (!rFilter.test(file.type)) { alert("You must select a valid image file!"); return; }  
                reader.readAsDataURL(file); 
            }
        } else {
            alert("Try using Chrome, Firefox or WebKit");
        }
</script>

<script type="text/javascript">
    function select_section(class_id) 
    {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/get_sectionss/' + class_id,
            success:function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
    
     function select_subject(class_id) 
    {
        $.ajax({
            url: '<?php echo base_url(); ?>admin/get_subjects/' + class_id,
            success:function (response)
            {
                jQuery('#subject_holder').html(response);
            }
        });
    }
</script>

<script>

    if( $("#type").val() == 'html5')
    {
        $("#new_local").hide();
        $("#new_html5").show();
        $("#new_video_vimeo").hide();
        $("#new_video_youtube").hide();
        $("#type").val('html5');
        
    }
    
    if( $("#type").val() == 'local')
    {
        $("#new_local").show();
        $("#new_html5").hide();
        $("#new_video_vimeo").hide();
        $("#new_video_youtube").hide();
        $("#type").val('local');
    }
    
    if( $("#type").val() == 'vimeo')
    {
        $("#new_local").hide();
        $("#new_html5").hide();
        $("#new_video_vimeo").show();
        $("#new_video_youtube").hide();
        $("#type").val('vimeo');
    }
    
    
    if( $("#type").val() == 'youtube')
    {
        $("#new_local").hide();
        $("#new_html5").hide();
        $("#new_video_vimeo").hide();
        $("#new_video_youtube").show();
        $("#type").val('youtube');
    }
  
  function html5()
  {
    $("#new_local").hide(500);
    $("#new_html5").show(500);
    $("#new_video_vimeo").hide(500);
    $("#new_video_youtube").hide(500);
    $("#type").val('html5');
  }
  function post()
  {
    $("#new_local").show(500);
    $("#new_html5").hide(500);
    $("#new_video_vimeo").hide(500);
    $("#new_video_youtube").hide(500);
    $("#type").val('local');
  }
  
  function poll()
  {
    $("#new_local").hide(500);
    $("#new_html5").hide(500);   
    $("#new_video_youtube").hide(500);
    $("#new_video_vimeo").show(500);
    $("#type").val('vimeo');
  }
  function video()
  {
    $("#new_local").hide(500);    
    $("#new_html5").hide(500);
    $("#new_video_vimeo").hide(500);
    $("#new_video_youtube").show(500);
    $("#type").val('youtube');
  }
</script>


<script>
    function getId(url) 
    {
        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        var match = url.match(regExp);
        if (match && match[2].length == 11) {
            return match[2];
        } else {
            return 'error';
        }
    }
    function set_video()
    {
        var Id = getId($("#url").val());
        $('#myCode').html('<br><iframe width="560" height="315" src="//www.youtube.com/embed/' + Id + '" frameborder="0" allowfullscreen></iframe>');   
        $("#embed").val('//www.youtube.com/embed/'+Id)
        $("#myCode").show(500);
    }
</script>

