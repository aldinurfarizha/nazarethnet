<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo getEduAppGTLang('verification');?> | <?php echo getEduAppGTLang('students_verification');?></title>
    <link rel='stylesheet' type='text/css' href='<?php echo base_url();?>public/style/calendar/fullcalendar.bundle.css'/>
    <link rel='stylesheet' type='text/css' href='<?php echo base_url();?>public/style/calendar/style.bundle.css'/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="<?php echo base_url();?>public/style/picker.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>public/style/cms/icon_fonts_assets/themefy/themify-icons.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/style/cms/bower_components/bootstrap-clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet">
    <script src="<?php echo base_url();?>public/uploads/sweetalert2.all.min.js"></script> 
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/olapp/Bootstrap/dist/css/bootstrap-reboot.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/olapp/Bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/olapp/Bootstrap/dist/css/bootstrap-grid.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/olapp/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/olapp/css/fonts.min.css">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url();?>public/style/cms/bower_components/dropzone/dist/dropzone.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="<?php echo base_url();?>public/style/cms/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/style/cms/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/style/cms/icon_fonts_assets/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/style/cms/icon_fonts_assets/picons-thin/style.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/style/cms/icon_fonts_assets/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/style/cms/icon_fonts_assets/picons-social/style.css" rel="stylesheet">
	<link href="<?php echo base_url();?>public/style/cms/icon_fonts_assets/feather/style.css" rel="stylesheet">
	<link href="<?php echo base_url();?>public/style/cms/bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/style/cms/bower_components/dragula.js/dist/dragula.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>public/uploads/<?php echo $this->db->get_where('settings', array('type' => 'favicon'))->row()->description;?>" rel="icon">
    <link href="<?php echo base_url();?>public/style/cms/css/main.css?ver=1" media="all" rel="stylesheet">
    <style>
        .invoice-w:before{
            top: -27%!important;
        }
        .invoice-w .infos .info-2{
            margin-top:-80px!important;
        }
        body{
            background:#090931!important;
        }
        
    </style>
</head>
<body>
<?php 
	$data = $this->db->get_where('enroll', array('student_id' => $student_id))->result_array();
	foreach($data as $row):
?>
<center>
    <div class="content-w" style="background:#090931;"> 
      <div class="conty">
        <div class="content-i">
	        <div class="content-box">
	            <div class="element-wrapper">
		            <div class="invoice-w" id="invoiceid">
		                <div class="infos">
			                <div class="info-1" style="text-align: left;">
			                    <div class="invoice-logo-w">
				                    <img alt="" src="<?php echo base_url();?>public/uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description;?>" style="height:70px">
			                    </div>
			                    <div class="company-name" style="color:#000;">
				                    <?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;?>
			                    </div>
			                    <div class="company-address">
				                    <?php echo $this->db->get_where('settings', array('type' => 'address'))->row()->description;?>
			                    </div>
			                    <div class="company-extra" style="color:#000;">
				                    <?php echo getEduAppGTLang('phone');?>: <?php echo $this->db->get_where('settings', array('type' => 'phone'))->row()->description;?>
			                    </div>
			                </div>
			                <div class="info-2" style="float:right;margin-top: -86px!important;">
			                    <div class="rcard-profile">
            						<img alt="" src="<?php echo $this->crud->get_image_url('student', $student_id);?>" style="width:50px">
                                </div>
			                    <div class="company-name">
				                    <?php echo $this->crud->get_name('student',$row['student_id']);?>
			                    </div>
			                    <div class="company-address text-dark">
				                    <?php echo getEduAppGTLang('roll');?>: <strong><?php echo $row['roll'];?></strong><br/>
				                    <?php echo $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;?><br/>
				                    <?php echo $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name;?><br/>
			                    </div>
			                </div>
		                </div>
    		                <div class="invoice-heading">
    			                <h3><?php echo getEduAppGTLang('student_details');?></h3>
    			                <div class="invoice-date">
    			                    <?php echo $row['creation_timestamp'];?>
    			                </div>
    		                </div>
		                    <div class="invoice-body">
			                    <div class="invoice-table" style="width:100%;">
			                        <table class="table">
    				                    <tbody>
    				                        <tr>
    				  	                        <td><b><?php echo getEduAppGTLang('name');?>:</b></td>
    				  	                        <td class="text-right"><img alt="" src="<?php echo $this->crud->get_image_url('student', $student_id);?>" style="width:25px"> <?php echo $this->crud->get_name('student',$row['student_id']);?></td>
    				                        </tr>
    				                        <tr>
    				  	                        <td><b><?php echo getEduAppGTLang('class');?>:</b></td>
    				  	                        <td class="text-right"><span class="badge badge-primary"><?php echo $this->db->get_where('class', array('class_id' => $row['class_id']))->row()->name;?></span></td>
    				                        </tr>
    				                        <tr>
    				  	                        <td><b><?php echo getEduAppGTLang('section');?>:</b></td>
    				  	                        <td class="text-right"><span class="badge badge-info"><?php echo $this->db->get_where('section', array('section_id' => $row['section_id']))->row()->name;?></span></td>
    				                        </tr>
    				                        <tr>
    				                            <?php $parent_id = $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->parent_id;?>
    				  	                        <td><b><?php echo getEduAppGTLang('parent');?>:</b></td>
    				  	                        <td class="text-right"><?php echo $this->crud->get_name('parent',$parent_id);?></td>
    				                        </tr>
    				                        <tr>
    				  	                        <td><b><?php echo getEduAppGTLang('parent_phone');?>:</b></td>
    				  	                        <td class="text-right"><span class="badge badge-warning"><?php echo $this->db->get_where('parent', array('parent_id' => $parent_id))->row()->phone;?></span></td>
    				                        </tr>
    				                        <tr>
    				  	                        <td><b><?php echo getEduAppGTLang('address');?>:</b></td>
    				  	                        <td class="text-right"><?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->address;?></td>
    				                        </tr>
    				                        <tr>
    				  	                        <td><b><?php echo getEduAppGTLang('phone');?>:</b></td>
    				  	                        <td class="text-right"><?php echo $this->db->get_where('student', array('student_id' => $row['student_id']))->row()->phone;?></td>
    				                        </tr>
    				                    </tbody>
			                        </table>
    			                </div>
		                    </div>
		                    <div class="invoice-footer">
			                    <div class="invoice-logo">
    			                    <img alt="" src="<?php echo base_url();?>public/uploads/<?php echo $this->db->get_where('settings', array('type' => 'logo'))->row()->description;?>"><span><?php echo $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;?></span>
			                    </div>
			                    <div class="invoice-info">
    			                    <span><?php echo $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;?></span><span><?php echo $this->db->get_where('settings', array('type' => 'phone'))->row()->description;?></span>
			                    </div>
		                    </div>
    		            </div>
	                </div>
    	        </div>
            </div>
        </div>
    </div>
</center>
<?php endforeach;?>

<script src="<?php echo base_url();?>public/style/login/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>public/style/login/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>public/style/login/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>public/style/login/js/main.js"></script>
</body>
</html>