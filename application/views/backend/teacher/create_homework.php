 <style>
        video {
            margin-top: 2px;
            width: 100%;
            height: auto;
            min-width: 300px;
            min-height: 200px;
            border-radius:10px;
            border: 2px solid #eee;
        }
        .left {
            margin-right: 10px;
            width: 100%;
            padding: 0px;
        }
        .right {
            margin-left: 10px;
            width: 100%;
            padding: 0px;
        }
        .bottom {
            clear: both;
            padding-top: 10px;
        }
</style>
      <script>
          var base_url = '<?php echo base_url();?>';
          var user_type = 'teacher';
          var stop_lang = '<?php echo getEduAppGTLang('stop');?>';
          var start_lang = '<?php echo getEduAppGTLang('start');?>';
      </script>
      <div class="content-w">
       <div class="conty">
           <?php $dat = base64_decode($data);
           $ex = explode('-',$dat);
           ?>
  <?php include 'fancy.php';?>
  <div class="header-spacer"></div>
  <div class="os-tabs-w menu-shad">
    <div class="os-tabs-controls">
        <ul class="navs navs-tabs upper">
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>teacher/subject_dashboard/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0482_gauge_dashboard_empty"></i><span><?php echo getEduAppGTLang('dashboard');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>teacher/online_exams/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0207_list_checkbox_todo_done"></i><span><?php echo getEduAppGTLang('online_exams');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links active" href="<?php echo base_url();?>teacher/homework/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0004_pencil_ruler_drawing"></i><span><?php echo getEduAppGTLang('homework');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>teacher/forum/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0281_chat_message_discussion_bubble_reply_conversation"></i><span><?php echo getEduAppGTLang('forum');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>teacher/study_material/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0003_write_pencil_new_edit"></i><span><?php echo getEduAppGTLang('study_material');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>teacher/upload_marks/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i><span><?php echo getEduAppGTLang('marks');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>teacher/meet/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0591_presentation_video_play_beamer"></i><span><?php echo getEduAppGTLang('live');?></span></a>
          </li>
          <li class="navs-item">
            <a class="navs-links" href="<?php echo base_url();?>teacher/attendance/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0023_calendar_month_day_planner_events"></i><span><?php echo getEduAppGTLang('attendance');?></span></a>
            </li>
            <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/whiteboards/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0191_window_application_cursor"></i><span><?php echo getEduAppGTLang('whiteboards');?></span></a>
                        </li>
                        <li class="navs-item">
                            <a class="navs-links" href="<?php echo base_url();?>teacher/gamification/<?php echo $data;?>/"><i class="os-icon picons-thin-icon-thin-0659_medal_first_place_winner_award_prize_achievement"></i><span><?php echo getEduAppGTLang('gamification');?></span></a>
                        </li>
        </ul>
      </div>
    </div>
  <div class="content-i">
  <div class="content-box">
  <div class="col-lg-12">   
  <link rel="stylesheet" href="<?php echo base_url();?>public/style/video_main.css">
    <link rel="stylesheet" href="<?php echo base_url();?>public/style/video_tag.css">
  <div class="back hidden-sm-down" style="margin-top:-20px;margin-bottom:10px">   
  <a href="<?php echo base_url();?>teacher/homework/<?php echo $data;?>/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>  
  </div>  
  <div class="element-wrapper"> 
    <div class="element-box lined-primary shadow">
        <h5><?php echo getEduAppGTLang('create_homework');?></h5><hr>
      <?php echo form_open(base_url() . 'teacher/homework/create/', array('enctype' => 'multipart/form-data')); ?>
        <input type="hidden" value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 10);?>" id="homework_code" name="homework_code">
        <div class="row">
            <div class="col-sm-12" id='progress' style='display:none'><center>Uploading media file, please wait.<br><img src='<?php echo base_url();?>public/uploads/uploading.gif' style="width:190px"></center></div>
                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                    <label class="control-label"><?php echo getEduAppGTLang('media_type');?></label>
                </div>
                <div class="col col-lg-6 col-md-6 col-sm-6 col-6">
                    <center>
                        <div class="custom-control">
                            <input  type="radio" name="media_type" id="m1" required="" value="1" class="form-control"> 
                            <label for="m1" class="control-label"><?php echo getEduAppGTLang('video_record');?></label>
                        </div>
                    </center>
                </div>
                <div class="col col-lg-6 col-md-6 col-sm-6 col-6">
                    <div class="custom-control">
                        <center>
                            <input type="radio" name="media_type" id="m2" value="2" class="form-control">
                            <label for="m2" class="control-label"><?php echo getEduAppGTLang('audio_record');?></label>
                        </center>
                    </div>
                </div>
                
                <div class="col col-sm-12" id='video' style='display:none;'>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <center>
                                <video id="gum" playsinline autoplay muted></video><br>
                                <button type="button" id="start" class="btn btn-success"><?php echo getEduAppGTLang('start_camera');?></button>
                                <button type="button" id="record" class="btn btn-primary start" disabled><?php echo getEduAppGTLang('record');?></button>
                                <button type="button" id="play" class="btn btn-info" disabled><?php echo getEduAppGTLang('play');?></button>
                                <button type="button" class="btn btn-purple" onclick="videoReload()"><?php echo getEduAppGTLang('restart');?></button>
                                <button type="button" id="saveVideo" class="btn btn-warning" disabled><?php echo getEduAppGTLang('save');?></button>
                            </center>
                        </div>
                        <div class="col-sm-6">
                            <center>
                                <video id="recorded" playsinline></video>         
                                <br>
                                <h3 class="control-label"><?php echo getEduAppGTLang('video_preview');?></h3>
                            </center>
                            <div>
                                <span id="errorMsg"></span>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                
                <div class='col col-sm-12' id='audio' style='display:none;'>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <center>
                                <label class="control-label"><?php echo getEduAppGTLang('audio_controls');?></label><br>
                                <a class="btn btn-success" href="javascript:void(0);" id="recordButton"><?php echo getEduAppGTLang('start');?></a>
                                <a class="btn btn-info" href="javascript:void(0);" onclick="audioReload()"><?php echo getEduAppGTLang('again');?></a>
                                <a class="btn btn-primary" id="saveAudio" href="javascript:void(0);"><?php echo getEduAppGTLang('save');?></a>
                                <div>
                                    <span id="errorMsg"></span>
                                </div>  
                            </center>
                        </div>
                        <div class="col-sm-6">
                            <center><label class="control-label"><?php echo getEduAppGTLang('audio_preview');?></label><br><audio id="final" controls disabled></audio></center>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('title');?></label>
                            <input class="form-control" name="title" type="text" required="">
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                    <label class="control-label"><?php echo getEduAppGTLang('type');?></label>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-6 col-6">
                        <center><div class="custom-control custom-radio" style="float: right">
                            <input  type="radio" name="type" id="1" required="" value="1" class="custom-control-input"> <label for="1" class="custom-control-label"><?php echo getEduAppGTLang('online_text');?></label>
                        </div></center>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                                	<div class="form-group label-floating">
                                        <label class="control-label"><?php echo getEduAppGTLang('points_exp');?></label>
                                        <div class="input-group">
                                		    <input type="text" name="exp" class="form-control">
                                	      </div>
                                	    <small><?php echo getEduAppGTLang('if_is_enabled_in_rules');?></small>
                                    </div>
                                </div>
                    <div class="col col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="custom-control custom-radio">
                            <input  type="radio" name="type" id="2" value="2" class="custom-control-input"> <label for="2" class="custom-control-label"><?php echo getEduAppGTLang('files');?></label>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('date');?></label>
                            <input type='text' class="datepicker-here" required="" data-position="bottom left" data-language='en' name="date_end" data-multiple-dates-separator="/"/>
                        </div>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-6 col-12">
                        <div class="form-group label-floating">
                            <label class="control-label"><?php echo getEduAppGTLang('time');?></label>
                            <div class="input-group clockpicker" data-align="top" data-autoclose="true">
                                <input type="text" required="" name="time_end" class="form-control" value="09:30">
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="description-toggle">
                            <div class="description-toggle-content">
                                <div class="h6"><?php echo getEduAppGTLang('show_students');?></div>
                                <p><?php echo getEduAppGTLang('show_message');?></p>
                            </div>          
                            <div class="togglebutton">
                                <label><input name="status" value="1" type="checkbox"></label>
                            </div>
                        </div>
                    </div>
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="control-label"><?php echo getEduAppGTLang('description');?></label>
                            <textarea class="form-control" id="ckeditor1" name="description" required=""></textarea>
                        </div>
                    </div> 
                    <div class="col col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <label class="control-label"><?php echo getEduAppGTLang('file');?></label>
                            <input class="form-control" name="file_name" type="file">
                        </div>
                    </div>
                </div>
                <div class="form-buttons-w text-right">
                    <center><button class="btn btn-rounded btn-success" type="submit"><?php echo getEduAppGTLang('save');?></button></center>
                </div>
                <input type="hidden" value="<?php echo $ex[0];?>" name="class_id">
                <input type="hidden" value="<?php echo $ex[1];?>" name="section_id">
                <input type="hidden" value="<?php echo $ex[2];?>" name="subject_id">
            </div>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
    </div>  
            </div>
        </div>
    </div>

    <script src="<?php echo base_url();?>public/style/adapter-latest.js"></script>
    <script src="<?php echo base_url();?>public/style/video_main.js" async></script>

<script>
    function audioReload()
    {
        document.getElementById("final").src = '';
    }
    
    function videoReload()
    {
        document.getElementById("recorded").src = '';
    }

    $('input[type=radio][name=media_type]').change(function() {
        if (this.value == '1') 
        {
            $("#video").show(500);
            $("#audio").hide(500);
        }
        else if (this.value == '2') 
        {
            $("#audio").show(500);
            $("#video").hide(500);
        }
    });

    var recorders, gumStreams;
    var recordButtons = document.getElementById("recordButton");
    recordButtons.addEventListener("click", toggleRecording);
    
    function toggleRecording() 
    {
        if (recorders && recorders.state == "recording") 
        {
            $("#recordButton").html('<?php echo getEduAppGTLang('record');?>');
            $('#recordButton').removeClass('btn btn-danger');
            $('#recordButton').addClass('btn btn-success');
            recorders.stop();
            gumStreams.getAudioTracks()[0].stop();
        } else {
            $("#recordButton").html('<?php echo getEduAppGTLang('stop');?>');
            $('#recordButton').addClass('btn btn-danger');
            navigator.mediaDevices
                .getUserMedia({
                audio: true
            })
            .then(function (streams) 
            {
                gumStreams = streams;
                recorders = new MediaRecorder(streams);
                recorders.ondataavailable = function (e) {
                    var url = URL.createObjectURL(e.data);
                    document.getElementById("final").src = url;
                    
                    $( "#saveAudio").click(function() {
                        var audioName = $('#homework_code').val();
                        var audio_data = new FormData();
                        audio_data.append('audio', e.data); 
                        $("#progress").show(500);
                        $.ajax({
                            type: "POST",
                            enctype: 'multipart/form-data',
                            url: "<?php echo base_url();?>teacher/upload_audio/"+audioName,
                            data: audio_data,
                            processData: false,
                            contentType: false,
                            cache: false,
                            timeout: 600000,
                            success: function (data) {
                                $("#progress").hide(500);
                                console.log(data);
                            },
                            error: function (e) {
                                console.log("ERROR : ", e);
                            }
                        });
                    });
                };
                recorders.start();
            });
        }
    }
</script>