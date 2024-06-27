<link  rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css"/>
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />
<style>
.container {
    margin: 0px;
    max-width: 1000px;
}
</style>

<?php 
$this->db->order_by('lesson_online_id', 'asc');
$course = $this->db->get_where('lesson_online', array('lesson_online_id' => $lesson_id))->result_array();
foreach($course as $row):?> 

<div class="content-w">
    <?php include 'fancy.php';?>
    <div class="header-spacer">
    </div>
    <div class="conty">
        <div class="content-i">
          <div class="content-box">
                 <div class="row">
                    <div class="col-lg-9 col-md-12" id="video_player_area">
                        <div id="container">
                            <div class="post-thumb">
                            <?php if($type == 'video' && $row['type'] == 'videos' && $row['type_video'] == 'local'):  $tt = explode(".", $row['name_video']);?>
                                <video style="width:100%;" controls crossorigin playsinline poster="<?php echo base_url();?>/uploads/online_course_image/<?php echo $row['image_video'];?>">
                                    <source src="<?php echo base_url();?>/uploads/online_course_video/<?php echo $row['name_video'];?>" type="video/<?php echo $tt[1];?>" size="720">
                                    <!-- Caption files -->
                                    <track kind="captions" label="English" srclang="en" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt"
                                        default>
                                    <!-- Fallback for browsers that don't support the <video> element -->
                                </video>
                            <?php endif;?>
                            <?php if($row['type'] == 'videos' && $row['type_video'] == 'youtube'):?>
                                <div style="width:100%;" class="plyr__video-embed" id="player">
                                    <iframe height="100%" width="100%" frameborder="0" allowfullscreen
                                        src="https:/<?php echo $row['name_video'];?>?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1">
                                    </iframe>
                                </div>
                            <?php endif;?>
                            <?php if($type == 'video' && $row['type'] == 'videos' && $row['type_video'] == 'vimeo'):?>
                                    <div style="width:100%;" class="plyr__video-embed" id="player">
                                      <iframe height="100%" width="100%" frameborder="0" allowfullscreen
                                        src="https://player.vimeo.com/video/<?php echo $row['name_video'];?>?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media">
                                      </iframe>
                                    </div>
                            <?php endif;?>
                    
                    
                            <?php if($type == 'archive' && $row['type'] != 'videos' && $row['type_video'] == ''):?>
                                    <div class="" style="text-align: center;">
                                        <div class="mt-5">
                                            <a href="<?php echo base_url();?>teacher/view_lesson/download/<?php echo $row['type'];?>/<?php echo $lesson_id;?>" class="btn btn-info" style="color: #fff;">
                                            <i class="fa fa-download" style="font-size: 20px;"></i> <?php echo getEduAppGTLang('Download');?> <?php echo $row['type'];?></a>
                                        </div>
                                    </div>
                            <?php endif;?>
                              </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo getEduAppGTLang('Note');?>:</h5>
                                        <p class="card-text"><?php echo $row['summary'];?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    <div class="col-lg-3  col-md-12">
                        <div class="text-center" style="margin: 12px 10px;">
                            <h4 style="color:#1b55e2;" ><?php echo $this->db->get_where('online_course', array('online_course_id' => $online_course_id))->row()->title;?> </h4><br>
                            <h6><b>Content</b></h6>
                        </div>
                        <div class="row" style="margin: 12px -1px">
                            <div class="col-12">
                               <?php 
                                $this->db->order_by('section_online_id', 'asc');
                                $sections = $this->db->get_where('section_online', array('online_course_id'=>$online_course_id))->result_array();
                                $n=1; 
                                if(count($sections) > 0):
                                foreach($sections as $rr): ?>
                                <div class="card" style="margin:0px 0px;">
                                    <div class="card-header course_card">
                                        <h5 class="mb-0">
                                            <h6 style="color: #959aa2; font-size: 13px;"><?php echo getEduAppGTLang('Section');?> <?php echo $n++;?></h6>
                                                <?php echo $rr['name'];?>
                                        </h5>
                                    </div>
                                    <?php 
                                      $this->db->order_by('lesson_online_id', 'asc');
                                      $less = $this->db->get_where('lesson_online', array('section_online_id'=> $rr['section_online_id']))->result_array();
                                      $n2=1;
                                      $this->db->order_by('quiz_id', 'asc');
                                      $quizz = $this->db->get_where('quiz', array('section_online_id'=> $rr['section_online_id']))->result_array();?>
                                        <div class="card-body" style="padding:0px;">
                                            <table style="width: 100%;">
                                                <tbody>
                                                    <?php foreach($less as $ss):?>
                                                        <?php if($ss['type'] == 'videos'):?>
                                                        <tr style="width: 100%; padding: 5px 0px;background-color: #E6F2F5;">
                                                            <td style="text-align: left; padding:7px 10px;">
                                                                <div class="form-group">
                                                                    <a href="<?php echo base_url();?>teacher/view_lesson/video/<?php echo $online_course_id;?>/<?php echo $ss['lesson_online_id'];?>" id="1" <?php if($ss['lesson_online_id'] == $lesson_id):?>style="color:red; font-size: 20px;font-weight: 500;" <?php else: ?> style="font-size: 14px;font-weight: 400;" <?php endif;?>>
                                                                    <?php echo $n2++; ?>: <b><?php echo $ss['name'];?></b></a>
                                                                </div>
                                                                <div class="lesson_duration">
                                                                    <i class="fa fa-play-circle"></i>    <b>  <?php echo $ss['duration'];?></b>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php else: ?>
                                                        <tr style="width: 100%; padding: 5px 0px;background-color: #E6F2F5;">
                                                            <td style="text-align: left; padding:7px 10px;">
                                                                <div class="form-group">
                                                                    <a href="<?php echo base_url();?>teacher/view_lesson/archive/<?php echo $online_course_id;?>/<?php echo $ss['lesson_online_id'];?>" id="1" <?php if($ss['lesson_online_id'] == $lesson_id):?>style="color:red; font-size: 20px;font-weight: 500;" <?php else: ?> style="font-size: 14px;font-weight: 400;" <?php endif;?>>
                                                                    <?php echo $n2++; ?>: <b><?php echo $ss['name'];?></b></a>
                                                                </div>
                                                                <div>
                                                                    <i class="picons-thin-icon-thin-0042_attachment"></i>    <b>  <?php echo $ss['type'];?></b>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php endif; ?>
                                                    <?php endforeach; ?>
                                                    <?php foreach($quizz as $qq):?>
                                                    <tr style="width: 100%; padding: 5px 0px;background-color: #E6F2F5;">
                                                        <td style="text-align: left; padding:7px 10px;">
                                                            <div class="form-group">
                                                                <a href="<?php echo base_url();?>teacher/quiz_contest/<?php echo $online_course_id;?>/<?php echo $qq['quiz_id'];?>/<?php echo $lesson_id;?>" id="1" style="font-size: 14px;font-weight: 400;">
                                                                <?php echo $n2++; ?>: <b><?php echo $qq['title'];?></b></a>
                                                            </div>
                                                            <div>
                                                                <i class="picons-thin-icon-thin-0061_error_warning_alert_attention"></i>    <b>  <?php echo $qq['instruction'];?></b>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><br><br>
                                    <?php endforeach; ?>
                                    <?php else:?>
                                    <div class="card" style="margin:0px 0px;">
                                        <div class="card-header course_card">
                                            <a href="<?php echo base_url();?>teacher/lessons/<?php echo $online_course_id;?>" ><h5 class="text-center">
                                            <?php echo getEduAppGTLang('create_sections_here');?>
                                            </h5></a>
                                        </div>
                                    </div>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             <br><br>
            </div>
        </div>
    </div>
<?php endforeach;?>

<script>
function toggle_lesson_view() {
    $('#lesson-container').toggleClass('justify-content-center');
    $("#video_player_area").toggleClass("order-md-1");
    $("#lesson_list_area").toggleClass("col-lg-5 order-md-1");
}
</script>

<script>
    // Change the second argument to your options:
    // https://github.com/sampotts/plyr/#options
    const player = new Plyr('video', {captions: {active: true}});
    
    // Expose player so it can be used from the console
    window.player = player;
</script>