<div class="modal-body">
        <div class="modal-header" style="background-color:#00579c">
            <h6 class="title" style="color:white"><?php echo getEduAppGTLang('add_new_lesson');?></h6>
        </div>
        <div class="ui-block-content">
    <div class="row">
        <div class="col-md-12">
        <?php echo form_open(base_url() . 'admin/lessons/create_lesson/'.$param2.'/', array('method' => 'post', 'enctype' => 'multipart/form-data'));?>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo getEduAppGTLang('title');?></label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" required="" name="title_lesson"/>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-12">
                     <label class="control-label"><?php echo getEduAppGTLang('section');?></label>
                    <div class="select">
                        <select name="section_online_id" required="">
                            <option value=""><?php echo getEduAppGTLang('select');?></option>
                            <?php $parents = $this->db->get_where('section_online', array('online_course_id' => $param2))->result_array();
                                foreach($parents as $rows):?>
                                <option value="<?php echo $rows['section_online_id'];?>"><?php echo $rows['name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-12">
                <label class="control-label"><?php echo getEduAppGTLang('lesson_type');?></label>
                <div class="form-group">
                    <div class="row">
                        
                        <div class="col-sm-2">
                             <div class="custom-control custom-radio mr-sm-2">
                                <input type="radio" id="vid" name="type" value="videos" class="custom-control-input check">
                                <label class="custom-control-label" for="vid"><i class="icon-film"></i> Video</label>
                            </div>
                        </div>
                        
                        <div class="col-sm-2">
                             <div class="custom-control custom-radio mr-sm-2">
                                <input type="radio" id="text" name="type" value="text" class="custom-control-input check">
                                <label class="custom-control-label" for="text"><i class="icon-event"></i><?php echo getEduAppGTLang('Text');?></label>
                            </div>
                        </div>
                        
                        <div class="col-sm-2">
                            <div class="custom-control custom-radio mr-sm-2">
                                <input type="radio" id="pdf" name="type" value="pdf" class="custom-control-input check">
                                <label class="custom-control-label" for="pdf"><i class="icon-docs"></i> PDF</label>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                             <div class="custom-control custom-radio mr-sm-2">
                                <input type="radio" id="document" name="type" value="document" class="custom-control-input check">
                                <label class="custom-control-label" for="document"><i class="icon-doc"></i><?php echo getEduAppGTLang('Document');?></label>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                             <div class="custom-control custom-radio mr-sm-2">
                                <input type="radio" id="image" name="type" value="image" class="custom-control-input check">
                                <label class="custom-control-label" for="image"><i class="icon-picture"></i><?php echo getEduAppGTLang('Image');?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12"  id="videos" style="display: none;">
                <div class="col-sm-12">
                    <label class="control-label"><?php echo getEduAppGTLang('lesson_provider');?></label>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="custom-control custom-radio mr-sm-2">
                                    <input type="radio" id="YouTube" name="provider" value="youtube" class="custom-control-input check">
                                    <label class="custom-control-label" for="YouTube"><i class="os-icon picons-thin-icon-thin-0593_video_play_youtube"></i> YouTube</label>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                 <div class="custom-control custom-radio mr-sm-2">
                                    <input type="radio" id="Vimeo" name="provider" value="vimeo" class="custom-control-input check">
                                    <label class="custom-control-label" for="Vimeo"><i class="picons-social-icon-vimeo"></i> Vimeo</label>
                                </div>
                            </div>
                            
                            <!--<div class="col-sm-3">
                                <div class="custom-control custom-radio mr-sm-2">
                                    <input type="radio" id="HTML5" name="provider" value="html5" class="custom-control-input check">
                                    <label class="custom-control-label" for="HTML5"><i class="picons-social-icon-html5"></i> HTML5</label>
                                </div>
                            </div>-->
                            
                            <div class="col-sm-4">
                                 <div class="custom-control custom-radio mr-sm-2">
                                    <input type="radio" id="Local" name="provider" value="local" class="custom-control-input check">
                                    <label class="custom-control-label" for="Local"><i class="picons-social-icon-html5"></i><?php echo getEduAppGTLang('Local');?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
                
            <div class="col-sm-12"  id="files" style="display: none;">
                <div class="col-sm-12">
                    <label class="control-label"><?php echo getEduAppGTLang('Attachment');?></label>
                    <div class="form-group">
                        <input type="file" name="attachment" id="invoice_file"  class="form-control">
                    </div>
                </div>
            </div>    
                
            <div class="col-sm-12"  id="youtube" style="display: none;">
                <div class="form-group">
                    <label class="control-label"><?php echo getEduAppGTLang('Video_URL');?></label>
                        <input type="hidden" name="embed" id="embed2" value="">
                        
                        <div class="form-group" style="margin-bottom:-15px;">
                            <input type="text" name="url_youtube" id="url2" class="form-control" placeholder="<?php echo getEduAppGTLang('Video_URL');?>" onchange="set_video2()">
                        </div><br>
                        
                        <pre style="text-align:center;display:none;" id="myCode2"></pre>
                </div>
                
                <div class="form-group">
                    <label class="control-label"><?php echo getEduAppGTLang('Duration');?></label>
                    <input type="text" name="duration_youtube" id="invoice_file" placeholder="00:00:00" class="form-control">
                </div>
            </div>  
            
            
            <div class="col-sm-12"  id="vimeo" style="display: none;">
                <div class="form-group">
                    <label class="control-label"><?php echo getEduAppGTLang('Video_URL');?></label>
                    <input type="text" name="url_vimeo" placeholder="E.g: https://vimeo.com/26236963"id="invoice_file"  class="form-control">
                </div>
                
                <div class="form-group">
                    <label class="control-label"><?php echo getEduAppGTLang('Duration');?></label>
                    <input type="text" name="duration_vimeo" id="invoice_file" placeholder="00:00:00" class="form-control">
                </div>
            </div>  
            
            <div class="col-sm-12"  id="html" style="display: none;">
                <div class="form-group">
                    <label class="control-label"><?php echo getEduAppGTLang('Video_URL');?></label>
                    <input type="text" name="url_html" placeholder="E.g: https://itunes.apple.com/au/movie/view-from-a-blue-moon/id1041586323" id="invoice_file"  class="form-control">
                </div>
                
                <div class="form-group">
                    <label class="control-label"><?php echo getEduAppGTLang('Duration');?></label>
                    <input type="text" name="duration_html" id="invoice_file" placeholder="00:00:00" class="form-control">
                </div>
                
                <div class="form-group">
                    <label class="control-label"><?php echo getEduAppGTLang('Thumbnail');?></label>
                    <input type="file" name="image" id="invoice_file" class="form-control">
                </div>
            </div>
            
            <div class="col-sm-12"  id="local" style="display: none;">
                <div class="form-group">
                    <label class="control-label"><?php echo getEduAppGTLang('Video');?></label>
                    <input type="file" name="video_local" id="invoice_file"  class="form-control">
                </div>
                
                <div class="form-group">
                    <label class="control-label"><?php echo getEduAppGTLang('Duration');?></label>
                    <input type="text" name="duration_local" id="invoice_file" placeholder="00:00:00" class="form-control">
                </div>
                
                <div class="form-group">
                    <label class="control-label"><?php echo getEduAppGTLang('Thumbnail');?></label>
                    <input type="file" name="image_local" id="invoice_file" class="form-control">
                </div>
            </div>
               
            
            <div class="form-group">
                <label class="col-sm-3 control-label"><?php echo getEduAppGTLang('summary');?></label>
                <div class="col-sm-12">
                    <textarea type="text" class="form-control" name="summary"></textarea>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success btn-block"><?php echo getEduAppGTLang('add');?></button>
                </div>
            </div>
    
            <?php echo form_close();?>
        </div>
    </div>
</div>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="<?php echo base_url();?>style/cms/bower_components/bootstrap/js/dist/tooltip.js"></script>

 <script type="text/javascript">
        
        $(function()
        {
          $('[name="type"]').change(function()
          {
            if ($(this).val() == 'videos'){
                $('#videos').show(500);
                $('#files').hide(500);
              //  $("#provider_url").attr("required", true);
               
            }
            else
            {
                $('#files').show(500);
                $('#videos').hide(500);
                $('#youtube').hide(500);
                $('#vimeo').hide(500);
                $('#html').hide(500);
                $('#local').hide(500);
            };
          });
          
        $('[name="provider"]').change(function()
          {
            if ($(this).val() == 'youtube') {
                $('#youtube').show(500);
                $('#vimeo').hide(500);
                $('#html').hide(500);
                $('#local').hide(500);
            }
            
            else if ($(this).val() == 'vimeo'){
                $('#youtube').hide(500);
                $('#vimeo').show(500);
                $('#html').hide(500);
                 $('#local').hide(500);
            }
            
            else if ($(this).val() == 'html5'){
                $('#youtube').hide(500);
                $('#vimeo').hide(500);
                $('#html').show(500);
                 $('#local').hide(500);
            }
            
            else if ($(this).val() == 'local'){
                $('#youtube').hide(500);
                $('#vimeo').hide(500);
                $('#html').hide(500);
                $('#local').show(500);
            }
          }); 
        });
    </script>
    
    

<script>
    function getId2(url) 
    {
        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
        var match = url.match(regExp);
        if (match && match[2].length == 11) {
            return match[2];
        } else {
            return 'error';
        }
    }
    function set_video2()
    {
        var Id = getId2($("#url2").val());
        $('#myCode2').html('<br><iframe width="560" height="315" src="//www.youtube.com/embed/' + Id + '" frameborder="0" allowfullscreen></iframe>');   
        $("#embed2").val('//www.youtube.com/embed/'+Id)
        $("#myCode2").show(500);
    }
</script>
