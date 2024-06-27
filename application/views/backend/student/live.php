<?php $running_year = $this->db->get_where('settings' , array('type' => 'running_year'))->row()->description; ?>
<?php 
  $posts = $this->db->get_where('zoom' , array('zoom_id' => base64_decode($zoom_id)))->result_array();
  foreach ($posts as $row):
?>
<!DOCTYPE html>
    <head>
        <title><?php echo $this->db->get_where('settings' , array('type' => 'system_name'))->row()->description;?> - <?php echo $this->db->get_where('settings' , array('type' => 'system_title'))->row()->description;?></title>
        <meta charset="utf-8"/>
        <link rel="stylesheet" href="<?php echo base_url();?>public/assets/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="<?php echo base_url();?>public/assets/font-awesome/css/all.min.css">
        <link type="text/css" rel="stylesheet" href="https://source.zoom.us/3.5.1/css/react-select.css"/>
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    </head>
    <body>
        <a href="<?php echo base_url();?>student/meet/<?php echo base64_encode($row['class_id']."-".$row['section_id']."-".$row['subject_id']);?>/"><i class="picons-thin-icon-thin-0131_arrow_back_undo"></i></a>
        <style type="text/css">
            body {
                padding-top: 50px;
            }
            .navbar-inverse {
                background-color: #313131;
                border-color: #404142;
            }
            .navbar-header h4 {
                margin: 0;
                padding: 15px 15px;
                color: #c4c2c2;
            }
            .navbar-right h5 {
                margin: 0;
                padding: 9px 5px;
                color: #c4c2c2;
            }
            .navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form{
                border-color: transparent;
            }
        </style>
        <nav id="nav-tool" class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <h4><i class="fab fa-chromecast"></i> Live Class Title : <?php echo $row['title']?></h4>
                </div>
                <div class="navbar-form navbar-right">
                    <h5><i class="far fa-user-circle" style=""></i> You : <?php echo $this->crud->get_name('student', $this->session->userdata('login_user_id'));?></h5>
                </div>
            </div>
        </nav>
        <script src="https://source.zoom.us/3.5.1/lib/vendor/react.min.js"></script>
        <script src="https://source.zoom.us/3.5.1/lib/vendor/react-dom.min.js"></script>
        <script src="https://source.zoom.us/3.5.1/lib/vendor/redux.min.js"></script>
        <script src="https://source.zoom.us/3.5.1/lib/vendor/redux-thunk.min.js"></script>
        <script src="https://source.zoom.us/3.5.1/lib/vendor/jquery.min.js"></script>
        <script src="https://source.zoom.us/3.5.1/lib/vendor/lodash.min.js"></script>
        <script src="https://source.zoom.us/zoom-meeting-3.5.1.min.js"></script>
        <script type="text/javascript">
            ZoomMtg.preLoadWasm();
            ZoomMtg.prepareWebSDK();
            var meetConfig = {
                sdkKey: "<?php echo $this->db->get_where('settings', array('type' => 'zoom_key'))->row()->description;?>",
                meetingNumber: "<?php echo $row['meeting_id']?>",
                userName: "<?php echo $this->crud->get_name('student', $this->session->userdata('login_user_id'));?>",
                passWord: "<?php echo $row['meeting_password']?>",
                leaveUrl: "<?php echo base_url();?>student/meet/<?php echo base64_encode($row['class_id']."-". $row['section_id']."-". $row['subject_id']);?>",
                userEmail: "<?php echo $this->db->get_where('student', array('student_id' => $this->session->userdata('login_user_id')))->row()->email;?>",
                sdkSecret: "<?php echo $this->db->get_where('settings', array('type' => 'zoom_secret'))->row()->description;?>",
                role: parseInt(1, 10)
            };
            var signature = ZoomMtg.generateSDKSignature({
                meetingNumber: meetConfig.meetingNumber,
                sdkKey: meetConfig.sdkKey,
                sdkSecret: meetConfig.sdkSecret,
                role: meetConfig.role,
                success: function(res){
                    //Error
                }
            });
            ZoomMtg.init({
                leaveUrl: meetConfig.leaveUrl,
                isSupportAV: true,
                success: function () {
                    ZoomMtg.join(
                        {
                            meetingNumber: meetConfig.meetingNumber,
                            userName: meetConfig.userName,
                            signature: signature,
                            sdkKey: meetConfig.sdkKey,
                            passWord: meetConfig.passWord,
                            userEmail: meetConfig.userEmail,
                            success: function(res){
                                $('#nav-tool').hide();
                            },
                            error: function(res) {
                                //Error
                            }
                        }
                    );
                },
                error: function(res) {
                    //Error
                }
            });
        </script>
<?php endforeach;?>