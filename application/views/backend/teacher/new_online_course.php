 <div class="content-w">
      <div class="header-spacer"></div>
       <div class="conty">
        <div class="os-tabs-w menu-shad">       
            <div class="os-tabs-controls">        
                <ul class="navs navs-tabs upper">           
                    <li class="navs-item">            
                        <a class="navs-links" href="<?php echo base_url();?>teacher/online_courses/"><i class="picons-thin-icon-thin-0593_video_play_youtube"></i>
                        <span><?php echo getEduAppGTLang('online_courses');?></span></a>
                    </li>
                    <li class="navs-item">            
                        <a class="navs-links active" href="<?php echo base_url();?>teacher/new_online_course/"><i class="os-icon picons-thin-icon-thin-0086_import_file_load"></i>
                        <span><?php echo getEduAppGTLang('new_online_course');?></span></a>
                    </li>
                </ul>       
            </div>
        </div>  
         
  <?php include 'fancy.php';?>
  <div class="header-spacer"></div>
 
  <div class="content-i">
  <div class="content-box">
  <div class="col-lg-12">   
 
  <div class="element-wrapper"> 
    <div class="element-box lined-primary shadow">
      <div class="modal-header">
        <h5 class="modal-title"><?php echo getEduAppGTLang('new_online_course');?></h5>
      </div>
      <br>
      <?php echo form_open(base_url() . 'teacher/create_online_course/', array('method' => 'post', 'enctype' => 'multipart/form-data')); ?>
        <div class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label class="col-form-label" for=""><?php echo getEduAppGTLang('title');?></label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="title">
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4"><br>
                <label class="control-label"><?php echo getEduAppGTLang('class');?></label>
                <div class="select">
                    <select name="class_id" required onchange="select_section(this.value),select_subject(this.value)">
                        <option value=""><?php echo getEduAppGTLang('select');?></option>
                        <?php
                            $classes = $this->db->get('class')->result_array();
                            foreach($classes as $row):                        
                        ?> 
                            <option value="<?php echo $row['class_id'];?>"><?php echo $row['name'];?></option>    
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
            
            <div class="col-sm-4"><br>
                <label class="control-label"><?php echo getEduAppGTLang('section');?></label>
                <div class="select">
                    <select name="section_id" required id="section_holder">
                        <option value=""><?php echo getEduAppGTLang('select');?></option>
                    </select>
                </div>
            </div>
            
            <div class="col-sm-4"><br>
                <label class="control-label"><?php echo getEduAppGTLang('subject');?></label>
                <div class="select">
                    <select name="subject_id" required id="subject_holder">
                        <option value=""><?php echo getEduAppGTLang('select');?></option>
                    </select>
                </div>
            </div>
           
            <div class="col-sm-8">
                <div class="form-group">
                    <label class="col-form-label" for=""><?php echo getEduAppGTLang('outcomes');?></label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="outcomes">
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
                                    <label for="course_thumbnail" class="btn pb-1"> <i class="mdi mdi-camera"></i> <?php echo getEduAppGTLang('Course_Thumbnail');?> <br> <small>(800 X 530)</small> </label>
                                    <input id="course_thumbnail"  type="file" class="image-upload" name="imgLocal" accept="image/*">
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="add-options-message btm-post edupostfoot edu-wall-actions" style="padding:10px 5px;">  
                          <a href="javascript:void(0);" class="options-message" onclick="post()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('local_video');?>">
                             <i class="picons-social-icon-html5"></i>
                          </a>
                           <!--<a href="javascript:void(0);" class="options-message" onclick="html5()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('html5_video');?>">
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
                 
                        <input type="hidden" name="embed" id="embed">
                        
                        <div class="form-group" style="margin-bottom:-15px;">
                          <input type="text" name="url_youtube" id="url" class="form-control" placeholder="YouTube URL" onchange="set_video()">
                        </div><br>
                        <pre style="text-align:center;display:none;" id="myCode"></pre>
                        
                        <div class="col-md-12">
                            <div class="wrapper-image-preview" style="margin-left: -6px;">
                                <div class="box" style="width: 250px;">
                                    <div class="js--image-preview" style="background-color: #fefefe;"></div>
                                  <div class="upload-options">
                                    <label for="course_thumbnail" class="btn pb-1"> <i class="mdi mdi-camera"></i> <?php echo getEduAppGTLang('Course_Thumbnail');?> <br> <small>(800 X 530)</small> </label>
                                    <input id="course_thumbnail"  type="file" class="image-upload" name="imgYoutube" accept="image/*">
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="add-options-message btm-post edupostfoot edu-wall-actions" style="padding:10px 5px;">
                          <a href="javascript:void(0);" class="options-message" onclick="post()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('local_video');?>">
                             <i class="picons-social-icon-html5"></i>
                          </a>
                           <!--<a href="javascript:void(0);" class="options-message" onclick="html5()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('html5_video');?>">
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
                          <input type="text" name="url_html5" id="url" class="form-control" placeholder="URL Video">
                        </div><br>
                      
                        <div class="col-md-12">
                            <div class="wrapper-image-preview" style="margin-left: -6px;">
                                <div class="box" style="width: 250px;">
                                    <div class="js--image-preview" style="background-color: #fefefe;"></div>
                                  <div class="upload-options">
                                    <label for="course_thumbnail" class="btn pb-1"> <i class="mdi mdi-camera"></i> <?php echo getEduAppGTLang('Course_Thumbnail');?> <br> <small>(800 X 530)</small> </label>
                                    <input id="course_thumbnail"  type="file" class="image-upload" name="imghtml5" accept="image/*">
                                  </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="add-options-message btm-post edupostfoot edu-wall-actions" style="padding:10px 5px;">
                          <a href="javascript:void(0);" class="options-message" onclick="post()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('local_video');?>">
                             <i class="picons-social-icon-html5"></i>
                          </a>
                           <!--<a href="javascript:void(0);" class="options-message" onclick="html5()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('html5_video');?>">
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
                          <input type="hidden" name="type" id="type" value="local">
                          <input type="text" name="url_vimeo" id="url" class="form-control" placeholder="Vimeo URL">
                        </div><br>
                        <div class="col-md-12">
                            <div class="wrapper-image-preview" style="margin-left: -6px;">
                                <div class="box" style="width: 250px;">
                                    <div class="js--image-preview" style="background-color: #fefefe;"></div>
                                  <div class="upload-options">
                                    <label for="course_thumbnail" class="btn pb-1"> <i class="mdi mdi-camera"></i> <?php echo getEduAppGTLang('Course_Thumbnail');?> <br> <small>(800 X 530)</small> </label>
                                    <input id="course_thumbnail"  type="file" class="image-upload" name="imgVimeo" accept="image/*">
                                  </div>
                                </div>
                            </div>
                        </div>
                        <div class="add-options-message btm-post edupostfoot edu-wall-actions" style="padding:10px 5px;">
                          <a href="javascript:void(0);" class="options-message" onclick="post()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('local_video');?>">
                             <i class="picons-social-icon-html5"></i>
                          </a>
                           <!--<a href="javascript:void(0);" class="options-message" onclick="html5()" data-toggle="tooltip" data-placement="top"   data-original-title="<?php echo getEduAppGTLang('html5_video');?>">
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
                    <textarea class="form-control" name="description"></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-12" style="text-align: center;">
                    <button type="submit" class="btn btn-success"><?php echo getEduAppGTLang('save');?></button>
                </div>
            </div>
        </div>
            <?php echo form_close();?>
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
            url: '<?php echo base_url(); ?>teacher/get_sectionss/' + class_id,
            success:function (response)
            {
                jQuery('#section_holder').html(response);
            }
        });
    }
    
     function select_subject(class_id) 
    {
        $.ajax({
            url: '<?php echo base_url(); ?>teacher/get_subjects/' + class_id,
            success:function (response)
            {
                jQuery('#subject_holder').html(response);
            }
        });
    }
</script>

<script>

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

