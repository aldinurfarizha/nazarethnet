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
    	<div class="pres entation presentation--image-left">
			<div class="row container-fluid">
    			<div class="presentation__content col-12 col-md-12">
                    <br>
                    <div class="row">
                        <?php 
                            $this->db->where('is_public','1');
                            $this->db->order_by('news_id', 'desc');
                            $news = $this->db->get('news')->result_array();
                            foreach($news as $row):
                        ?>
                        <div class="col-sm-4">
                            <div class="news-container">
                                <?php if (file_exists('public/uploads/news_images/'.$row['news_code'].'.jpg')):?>
                                <img src="<?php echo base_url();?>public/uploads/news_images/<?php echo $row['news_code'];?>.jpg" class="post-img"/>
                                <?php endif;?>
                                <div class="post-content">
                                    <p class="post-title"><?php echo getEduAppGTLang('by');?>: <?php echo $this->crud->get_name('admin', $row['admin_id']);?></p>
                                    <p class="post-description"><a href="<?php echo base_url();?>post/postID/<?php echo $row['news_code'];?>"><?php if(strlen($row['description']) > 70) echo substr($row['description'], 0,70).'...'; else echo $row['description']?></a></p>
                                    <p class="post-date"><b><?php echo getEduAppGTLang('date');?>:</b> <?php echo $row['date'].' '.$row['date2'];?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </section>