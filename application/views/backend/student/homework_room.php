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
        var user_type = 'student';
        var stop_lang = '<?php echo getEduAppGTLang('stop');?>';
        var start_lang = '<?php echo getEduAppGTLang('start');?>';
</script>
<link rel="stylesheet" href="<?php echo base_url();?>public/style/video_main.css">
<link rel="stylesheet" href="<?php echo base_url();?>public/style/video_tag.css">
<?php 
    $running_year = $this->crud->getInfo('running_year');
    $current_homework = $this->db->get_where('homework' , array('homework_code' => $homework_code))->result_array();
    foreach ($current_homework as $row):
?>
    <?php $query = $this->db->get_where('deliveries', array('homework_code' => $homework_code, 'student_id' => $this->session->userdata('login_user_id')));?>
    <link href="<?php echo base_url();?>public/uploads/fonts/font-fileuploader.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/uploads/fonts/script.css" media="all" rel="stylesheet">
    <div class="content-w">
        <div class="conty">
        <?php include 'fancy.php';?>
        <div class="header-spacer"></div>
            <div class="os-tabs-w menu-shad">
                <div class="os-tabs-controls">
                    <ul class="navs navs-tabs upper">
                        <li class="navs-item">
                            <a class="navs-links active" href="#"><i class="os-icon picons-thin-icon-thin-0014_notebook_paper_todo"></i><span><?php echo getEduAppGTLang('homework_details');?></span></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="content-i">
                <div class="content-box">
                    <div class="back" style="margin-top:-20px;margin-bottom:10px">      
                        <a href="<?php echo base_url();?>student/homework/<?php echo base64_encode($row['class_id'].'-'.$row['section_id'].'-'.$row['subject_id']);?>/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>  
                    </div>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="pipeline white lined-primary shadow">
                                <div class="pipeline-header">
                                    <h5 class="pipeline-name"><?php echo $row['title'];?></h5>
                                    <div class="pipeline-header-numbers">
                                        <div class="pipeline-count">
                                            <i class="os-icon picons-thin-icon-thin-0024_calendar_month_day_planner_events"></i> <?php echo $row['date_end'];?> <br>
                                            <i class="os-icon picons-thin-icon-thin-0025_alarm_clock_ringer_time_morning"></i> <?php echo $row['time_end'];?>
                                        </div>
                                    </div>
                                </div>
                                <p><?php echo $row['description'];?></p>
                                <?php if($row['media_type'] == 1):?>
                                    <hr>
                                    <video src="<?php echo base_url();?>public/uploads/homework/video/<?php echo $row['homework_code'];?>.mp4" controls type="video/mp4" style="width: auto; max-width:100%;"></video>
                                <?php elseif($row['media_type'] == 2):?>
                                    <hr>
                                    <audio controls type="video/mp3">
                                        <source src="<?php echo base_url();?>public/uploads/homework/audio/<?php echo $row['homework_code'];?>.mp3" type="audio/mpeg">
                                    </audio>
                                <?php endif;?>
                                <?php if($row['file_name'] != ""):?>
                                <div class="b-t padded-v-big">
                                    <?php echo getEduAppGTLang('file');?>: <a class="btn btn-rounded btn-sm btn-primary" href="<?php echo base_url() . 'public/uploads/homework/' . $row['file_name']; ?>" style="color:white"><i class="os-icon picons-thin-icon-thin-0042_attachment"></i> <?php echo $row['file_name'];?></a>
                                </div>
                                <?php endif;?>
                                <div class="col-sm-12" id='progress' style='display:none'><center><?php echo getEduAppGTLang('uploading_media_file_please wait');?><br><img src='<?php echo base_url();?>public/uploads/uploading.gif' style="width:190px"></center></div>
                                <?php if($row['type'] != 1 && $query->num_rows() <= 0):?>
                                <div class="b-t padded-v-big">
                                    <?php echo form_open(base_url() . 'student/delivery/file/'.$homework_code , array('enctype' => 'multipart/form-data'));?>
                                    <input type="hidden" value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 10);?>" id="homework_code" name="delivery_code">
                                    <hr>
            <div class="row">
                <div class="col col-lg-6 col-md-6 col-sm-6 col-6">
                        <center>
                            <div class="custom-control">
                                <input  type="radio" name="media_type" required id="m1" required="" value="1" class="form-control"> 
                                <label for="m1" class="control-label"><?php echo getEduAppGTLang('submit_your_answer_as_video');?></label>
                            </div>
                        </center>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="custom-control">
                            <center>
                                <input type="radio" name="media_type" id="m2" value="2" class="form-control">
                                <label for="m2" class="control-label"><?php echo getEduAppGTLang('submit_your_answer_as_audio');?></label>
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
            </div>
                                        <div class="form-group">
                                            <label><?php echo getEduAppGTLang('upload_files');?>:</label><br>
                                            <input type="file" name="files">
                                        </div>
                                        <input type="hidden" name="class_id" value="<?php echo $row['class_id'];?>">
                                        <input type="hidden" name="section_id" value="<?php echo $row['section_id'];?>">
                                        <input type="hidden" name="subject_id" value="<?php echo $row['subject_id'];?>">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <textarea class="form-control" placeholder="<?php echo getEduAppGTLang('send_teacher_comment');?>" name="comment" rows="5" style="width:100%"></textarea>
                                                <button type="submit" class="btn btn-success pull-right text-white"><?php echo getEduAppGTLang('send');?></button>
                                            </div>
                                        </div>
                                    <?php echo form_close();?>
                                </div>
                                <?php endif;?>
                                <?php if($row['type'] == 1 && $query->num_rows() <= 0):?>
                                <div class="alert alert-info" role="alert"><?php echo getEduAppGTLang('no_required');?></div>
                                <?php echo form_open(base_url() . 'student/delivery/text/'.$homework_code);?>
                                    <input type="hidden" value="<?php echo substr(md5(rand(100000000, 200000000)), 0, 10);?>" id="homework_code" name="delivery_code">
                                    <hr>
            <div class="row">
                <div class="col col-lg-6 col-md-6 col-sm-6 col-6">
                        <center>
                            <div class="custom-control">
                                <input  type="radio" name="media_type" required id="m1" required="" value="1" class="form-control"> 
                                <label for="m1" class="control-label"><?php echo getEduAppGTLang('submit_your_answer_as_video');?></label>
                            </div>
                        </center>
                    </div>
                    <div class="col col-lg-6 col-md-6 col-sm-6 col-6">
                        <div class="custom-control">
                            <center>
                                <input type="radio" name="media_type" id="m2" value="2" class="form-control">
                                <label for="m2" class="control-label"><?php echo getEduAppGTLang('submit_your_answer_as_audio');?></label>
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
            </div>
                                    <div class="b-t padded-v-big">
                                        <textarea cols="80" id="ckeditor1" required="" name="reply" rows="10"></textarea>
                                        <input type="hidden" name="class_id" value="<?php echo $row['class_id'];?>"> 
                                        <input type="hidden" name="section_id" value="<?php echo $row['section_id'];?>">
                                        <input type="hidden" name="subject_id" value="<?php echo $row['subject_id'];?>">
                                        <br>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <textarea class="form-control" placeholder="<?php echo getEduAppGTLang('send_teacher_comment');?>" name="comment" rows="5" style="width:100%"></textarea>
                                                <button type="submit" class="btn btn-success pull-right text-white" href="javascript:void(0);"><?php echo getEduAppGTLang('send');?></button>
                                            </div>
                                        </div>
                                    </div>
                                <?php echo form_close();?>
                                <?php endif;?>
                                <?php if($query->num_rows() > 0):?>
                                <hr>
                                <p><b><?php echo getEduAppGTLang('your_comment');?>:</b></p>
                                <p><?php echo $query->row()->student_comment;?></p><hr>
                                <p><b><?php echo getEduAppGTLang('your_submit');?>:</b></p>
                                <?php if($query->row()->media_type == 1):?>
                                <hr>
                                <video width="100%" src="<?php echo base_url();?>public/uploads/homework_delivery/video/<?php echo $query->row()->delivery_code;?>.mp4" controls type="video/mp4"></video>
                                <?php elseif($query->row()->media_type == 2):?>
                                    <hr>
                                    <audio controls type="video/mp3">
                                        <source src="<?php echo base_url();?>public/uploads/homework_delivery/audio/<?php echo $query->row()->delivery_code;?>.mp3" type="audio/mpeg">
                                    </audio>
                                <?php endif;?>
                                <hr>
                        <?php if($row['file_name'] != ""):?>
                            <?php echo getEduAppGTLang('download_file');?>
                            <br>
                            <a class="btn btn-rounded btn-sm btn-primary" href="<?php echo base_url();?>uploads/homework_delivery/<?php echo $row['file_name'];?>" style="color:white"><i class="os-icon picons-thin-icon-thin-0042_attachment"></i> <?php echo $row['file_name'];?></a>
                        <?php endif;?>
                        
                                <?php if($row['type'] != 1):?>
                                <hr>
                                <p><b><?php echo getEduAppGTLang('your_submitted_files');?>:</b></p>
                                <ul>
                                <?php 
                                    $qw = $this->db->get_where('homework_files', array('homework_code' => $homework_code,'student_id' => $this->session->userdata('login_user_id')))->result_array();
                                    foreach($qw as $fm):
                                ?>
                                    <li>
                                        <a href="<?php echo base_url();?>student/viewFile/<?php echo $fm['file'];?>" target="_blank"><?php echo $fm['file'];?></a> 
                                        - 
                                        <a href="<?php echo base_url();?>student/delivery/delete/<?php echo $fm['fhomework_file_id'];?>/<?php echo $homework_code;?>" onclick="return confirm('<?php echo getEduAppGTLang('confirm_delete');?>');"><i class="picons-thin-icon-thin-0056_bin_trash_recycle_delete_garbage_empty" title="delete"></i></a>
                                        <?php if($fm['edited'] == 1):?>
                                            - (<a target="_blank" href="<?php echo base_url();?>public/uploads/homework_delivery/edited/<?php echo $fm['edited_file_name'];?>"><?php echo getEduAppGTLang('view_edited');?></a>)
                                        <?php endif;?>
                                    </li>                   
                                <?php endforeach;?>
                                </ul><hr>
                                <?php endif;?>
                                <a class="btn btn-rounded btn-edu text-white" href="<?php echo base_url();?>student/homework_edit/<?php echo base64_encode($query->row()->id);?>/"><i class="picons-thin-icon-thin-0001_compose_write_pencil_new"></i> <?php echo getEduAppGTLang('edit_delivery');?></a>
                                <br><br>
                                <div class="alert alert-success" role="alert"><strong><?php echo getEduAppGTLang('success');?>. </strong><?php echo getEduAppGTLang('success_delivery');?>.</div>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="pipeline white lined-secondary">
                                <div class="pipeline-header">
                                    <h5 class="pipeline-name"><?php echo getEduAppGTLang('information');?></h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-lightbor table-lightfont">
                                        <tr>
                                            <th><b><?php echo getEduAppGTLang('subject');?></b>:</th>
                                            <td><?php echo $this->crud->get_type_name_by_id('subject',$row['subject_id']);?></td>
                                        </tr>
                                        <tr>
                                            <th><b><?php echo getEduAppGTLang('class');?></b>:</th>
                                            <td><?php echo $this->crud->get_type_name_by_id('class',$row['class_id']);?></td>
                                        </tr>
                                        <tr>
                                            <th><b><?php echo getEduAppGTLang('section');?></b>:</th>
                                            <td><?php echo $this->crud->get_type_name_by_id('section',$row['section_id']);?></td>
                                        </tr>
                                        <tr>
                                            <th><b><?php echo getEduAppGTLang('limit_date');?></b>:</th>
                                            <td><?php echo getEduAppGTLang('allowed_deliveries');?> <?php echo $row['date_end'];?> <?php echo $row['time_end'];?>.</td>
                                        </tr>
                                        <tr>
                                            <th><b><?php echo getEduAppGTLang('status');?></b>:</th>
                                            <td>
                                            <?php if($query->num_rows() <= 0):?>
                                                <a class="btn nc btn-rounded btn-sm btn-danger" style="color:white"><?php echo getEduAppGTLang('no_delivered');?></a>
                                            <?php endif;?>
                                            <?php if($query->num_rows() > 0):?>
                                                <a class="btn nc btn-rounded btn-sm btn-success" style="color:white"><?php echo getEduAppGTLang('submitted_for_review');?></a>
                                            <?php endif;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><b><?php echo getEduAppGTLang('mark');?></b>:</th>
                                            <td>
                                            <?php if($query->num_rows() <= 0):?>
                                                <a class="btn btn-rounded btn-sm btn-danger" style="color:white"><?php echo getEduAppGTLang('unrated');?></a>
                                            <?php endif;?>
                                            <?php if($query->num_rows() > 0):?>
                                                <a class="btn btn-rounded btn-sm btn-primary" style="color:white"><?php $mark =$this->db->get_where('deliveries', array('homework_code' => $homework_code, 'student_id' => $this->session->userdata('login_user_id')))->row()->mark; if($mark > 0) echo $mark; else echo getEduAppGTLang('waiting_mark');?></a>
                                            <?php endif;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><b><?php echo getEduAppGTLang('teacher_comment');?></b>:</th>
                                            <td>
                                            <?php if($query->num_rows() > 0):?>
                                                <?php echo $this->db->get_where('deliveries', array('homework_code' => $homework_code, 'student_id' => $this->session->userdata('login_user_id')))->row()->teacher_comment;?>
                                            <?php endif;?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
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
                            url: "<?php echo base_url();?>student/upload_audio/"+audioName,
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
    
    <script src="<?php echo base_url();?>public/uploads/jquery.fileuploader.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('input[name="files"]').fileuploader({
                limit: 20,
                maxSize: 50,
                addMore: true,
                thumbnails: {
                    onItemShow: function(item) {
                        item.html.find('.fileuploader-action-remove').before('<button type="button" class="fileuploader-action fileuploader-action-sort" title="Sort"><i class="fileuploader-icon-sort"></i></button>');
                    }
                },
                sorter: {
                    selectorExclude: null,
                    placeholder: null,
                    scrollContainer: window,
                    onSort: function(list, listEl, parentEl, newInputEl, inputEl) {
                    }
                }
            });
        });
    </script>   
<?php endforeach;?>