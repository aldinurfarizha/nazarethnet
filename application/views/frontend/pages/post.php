    <?php 
        $data = $this->db->get_where('news', array('news_code' => $news_code))->result_array();
        foreach($data as $row):
    ?>
    <section class="subpage-hero">
		<div class="subpage-hero__content container-fluid">
			<div class="row">
				<div class="col-md-12 col-sm-12 mx-auto">
					<h1 class="subpage-hero__header" ><?php echo getEduAppGTLang('our_school_news');?></h1>
				</div>
			</div>
		</div>
	</section>
    <section class="subpage-presentations min-top">
        <div class="presentation presentation--image-left">
            <div class="row container-fluid">
                <div class="presentation__content col-12 col-md-12">
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="">
                                <a class="btn btn-primary btn-sm" href="<?php echo base_url();?>news/"><?php echo getEduAppGTLang('back_to_news');?></a>
                                <br><br>
                                <?php if (file_exists('public/uploads/news_images/'.$row['news_code'].'.jpg')):?>
                                <img src="<?php echo base_url();?>public/uploads/news_images/<?php echo $row['news_code'];?>.jpg" class="post-featured"/>
                                <?php endif;?>
                                <hr>
                                <div class="post-desc">
                                    <p class="post-author"><?php echo getEduAppGTLang('by');?>: <?php echo $this->crud->get_name('admin', $row['admin_id']);?></p>
                                    <p class="post-date"><b><?php echo getEduAppGTLang('date');?>:</b>  <?php echo $row['date'].' '.$row['date2'];?></p>
                                    <p><?php echo $row['description'];?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endforeach;?>