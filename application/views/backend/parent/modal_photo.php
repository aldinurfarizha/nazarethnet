
    <div class="modal-content">
        <div class="modal-body p-0">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="1" class="active"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <?php if($param2 == 'complete' && $param3 != ''):?>
                        <img class="d-block w-100" src="<?php echo base64_decode($param3);?>" alt="Second slide">
                        <?php elseif($param2 != 'complete' && $param3 != ''):?>
                        <img class="d-block w-100" src="<?php echo base_url();?>public/uploads/<?php echo $param2;?>/<?php echo $param3;?>" alt="Second slide">
                        <?php elseif($param2 != '' && $param3 == ''):?>
                        <img class="d-block w-100" src="<?php echo base_url();?>public/uploads/<?php echo $param2;?>" alt="Second slide">
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
  