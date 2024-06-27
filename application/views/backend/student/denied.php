<?php 
    $system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$system_title       =	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Failed | <?php echo $system_title;?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta content="ie=edge" http-equiv="x-ua-compatible">
        <meta content="School System, EduAppGT PRO, GuateApps, WSG" name="keywords">
        <meta content="GuateApps" name="author">
        <meta content="<?php echo $system_name ." ".$system_title;?>" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link href="<?php echo base_url();?>public/uploads/<?php echo $this->db->get_where('settings', array('type' => 'favicon'))->row()->description;?>" rel="icon">
        <link href="<?php echo base_url();?>public/style/cms/css/main.css?ver=1" media="all" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/olapp/Bootstrap/dist/css/bootstrap-reboot.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/olapp/Bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/olapp/Bootstrap/dist/css/bootstrap-grid.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/olapp/css/main.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/style/olapp/css/fonts.min.css">
        <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link href="<?php echo base_url();?>public/style/cms/bower_components/perfect-scrollbar/css/perfect-scrollbar.min.css" rel="stylesheet">
    </head>
    <body style="background:#fff!important">
        <div class="container" style="margin-top:20%">
            <h3 class="text-center">No tienes autorización para ingresar a esta página.</h3>
            <center><img src="<?php echo base_url();?>public/uploads/denied.png" style="width:150px"></center>
            <br><br>
            <center><a class="btn btn-info" href="<?php echo base_url();?>">Ir al inicio</a></center>
        </div>
        <script>
            function close()
            {
                window.close();
            }
        </script>
    </body>
</html>