    <section class="subpage-hero">
		<div class="subpage-hero__content container-fluid">
			<div class="row">
				<div class="col-md-12 col-sm-12 mx-auto">
					<h1 class="subpage-hero__header" ><?php echo getEduAppGTLang('our_school_gallery');?></h1>
				</div>
			</div>
		</div>
	</section>
    <section class="subpage-presentations min-top">
        <div class="presentation presentation--image-left">
            <div class="row container-fluid">
                <div class="presentation__content col-12 col-md-12">
                    <div class="row">
                        <div class="col-sm-12" id="documentation">
                            <section>                                
                                <div class="row">
                                    <?php 
                                        $gallery = $this->db->get('gallery')->result_array();
                                        foreach($gallery as $row):    
                                    ?>
                                    <div class="col-sm-2 text-center">
                                        <a class="example-image-link" href="<?php echo base_url();?>public/uploads/gallery/<?php echo $row['name'];?>" data-lightbox="example-set" data-title="<?php echo $row['name'];?>"><img class="example-image img-class full-img" src="<?php echo base_url();?>public/uploads/gallery/<?php echo $row['name'];?>" alt=""/></a>
                                    </div>
                                    <?php endforeach;?>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="<?php echo base_url();?>public/assets/frontend/dist/js/lightbox-plus-jquery.min.js"></script>