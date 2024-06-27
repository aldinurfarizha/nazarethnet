<link  rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css"/>
<link rel="stylesheet" href="https://cdn.plyr.io/3.6.2/plyr.css" />


<style>
.container {
  position: relative;
  width: 100%;
  overflow: hidden;
  padding-top: 66.66%; /* 3:2 Aspect Ratio */
}
.responsive-iframe {
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  width: 100%;
  height: 100%;
  border: none;
}


.iframe {
    max-width: 100%;
    height: auto;
}
</style>

<?php 
$this->db->order_by('online_course_id', 'asc');
$course = $this->db->get_where('online_course', array('online_course_id' => $online_course_id))->result_array();
foreach($course as $row):?> 

<div class="content-w">
    <?php include 'fancy.php';?>
    <div class="header-spacer">
    </div>
    <div class="conty">
        <div class="content-i">
          <div class="content-box">
               <div class="back">
                     <!--<a style="float:right;" href="javascript:void(0);" class="btn btn-success" onclick="toggle_lesson_view()"><i class="picons-thin-icon-thin-0158_arrow_next_right"></i></a>-->
                </div>
                <div class="row">
                    <div class="col-lg-9 col-md-12" id="video_player_area">
                        <div id="container">
                             <div class="post-thumb">
                            <?php if($row['provider'] == 'local'):?>
                                    <?php $tt = explode(".", $row['url_video']);?>
                                	<video style="width:100%;" controls crossorigin playsinline poster="<?php echo base_url();?>/uploads/online_course_image/<?php echo $row['thumbnail']; ?>">
                                			<source src="<?php echo base_url();?>/uploads/online_course_video/<?php echo $row['url_video'];?>" type="video/<?php echo $tt[1];?>" size="720">
                                			<!-- Caption files -->
                                			<track kind="captions" label="English" srclang="en" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt"
                                					default>
                                			<!-- Fallback for browsers that don't support the <video> element -->
                                	</video>
                            <?php endif;?>
                            <?php if($row['provider'] == 'youtube'):?>
                            	<div style="width:100%;" class="plyr__video-embed" id="player">
                                    <iframe height="100%" width="100%" frameborder="0" allowfullscreen
                                        src="https:/<?php echo $row['embed'];?>?origin=https://plyr.io&amp;iv_load_policy=3&amp;modestbranding=1&amp;playsinline=1&amp;showinfo=0&amp;rel=0&amp;enablejsapi=1">
                                    </iframe>
                                </div>
                            <?php endif;?>
                            <?php if($row['provider'] == 'vimeo'):?>
                                <div style="width:100%;" class="plyr__video-embed" id="player">
                                    <iframe height="100%" width="100%" frameborder="0" allowfullscreen
                                            src="https://player.vimeo.com/video/<?php echo $row['embed'];?>?loop=false&amp;byline=false&amp;portrait=false&amp;title=false&amp;speed=true&amp;transparent=0&amp;gesture=media">
                                    </iframe>
                                    
                                </div>
                            <?php endif;?>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Note:</h5>
                                    <p class="card-text"><?php echo $row['description'];?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-12 course_col">
                        <div class="text-center" style="margin: 12px 10px;">
                            <h4 style="color:#1b55e2;" ><?php echo $row['title']?> </h4><br>
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
                                            <h6 style="color: #959aa2; font-size: 13px;">Section <?php echo $n++;?></h6>
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
                                                    <?php foreach($less as $ss):$lesson_online_id = $ss['lesson_online_id'];?>
                                                        <?php if($ss['type'] == 'videos'):?>
                                                        <tr style="width: 100%; padding: 5px 0px;background-color: #E6F2F5;">
                                                            <td style="text-align: left; padding:7px 10px;">
                                                                <div class="form-group">
                                                                    <a href="<?php echo base_url();?>admin/view_lesson/video/<?php echo $online_course_id;?>/<?php echo $ss['lesson_online_id'];?>" id="1" style="font-size: 14px;font-weight: 400;">
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
                                                                    <a href="<?php echo base_url();?>admin/view_lesson/archive/<?php echo $online_course_id;?>/<?php echo $ss['lesson_online_id'];?>" id="1" style="font-size: 14px;font-weight: 400;">
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
                                                                <a href="<?php echo base_url();?>admin/quiz_contest/<?php echo $online_course_id;?>/<?php echo $qq['quiz_id'];?>/<?php echo $lesson_online_id;?>" id="1" style="font-size: 14px;font-weight: 400;">
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
                                            <a href="<?php echo base_url();?>admin/lessons/<?php echo $online_course_id;?>" ><h5 class="text-center">
                                            Create sections here
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