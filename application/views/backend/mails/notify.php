<?php 
    $system_name = $this->crud->getInfo('system_name');
    $system_email = $this->crud->getInfo('system_email');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta charset="UTF-8">
            <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
            <meta name="viewport" content="width=device-width" />
            <link href="<?php echo base_url();?>public/style/cms/css/email_css.css" rel="stylesheet">
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        </head>
        <body class="hdr">
            <div width="100%" class="hemail">
                <div class="sbemail">
                <div class="trr" align="center"><a href="#"><img src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logow');?>" alt="<?php echo $system_name;?>" class="mxsimg"></a></div>
                    <div class="tblh">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tbody>
                                <tr>
                                    <td>
                                        <p><?php echo $email_msg;?></p>
                                        <span class="fts"><?php echo $system_name;?></span> 
                                    </td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="ftr">
                        <p> <img alt="" src="<?php echo base_url();?>public/uploads/<?php echo $this->crud->getInfo('logo');?>" class="imgftr"><?php echo $system_name;?><br>
                    </div>
                </div>
            </div>
        </body>
    </html>