<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        <meta name="description" content="Description">  
        <link href="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('favicon');?>" rel="icon">
        <title><?php echo $page_title;?> | <?php echo $this->crud->getInfo('system_title');?></title>
        <?php include 'topcss.php';?>
    </head>
    <body>   
        <div class="no-overflow-x">
            <?php include 'header.php';?>
            <?php include 'pages/'.$page_name.'.php';?>
            <?php include 'footer.php';?>
        </div>       
    </body>
</html>
