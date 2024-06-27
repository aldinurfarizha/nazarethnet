	<style>
		.homepage-hero::after{
			background-image: url(<?php echo base_url();?>public/uploads/frontend/<?php echo $this->crud->getFront('home_image');?>)!important;
		}
	</style>
	<section id="hero" class="homepage-hero container-fluid">
	    <div class="row m-0 homepage-hero__left">
		    <div class="col-lg-7 col-md-7 p-0">
			    <h1 class="homepage-hero__title"><?php echo $this->crud->getFront('home_title');?></h1>
			    <p class="mr-lg-5 pr-lg-4 homepage-hero__text"><?php echo $this->crud->getFront('home_subtitle');?></p>
			    <form action="#" class="signup-form">
				    <div class="row align-items-center m-0">
					    <div class="col-12 p-0">
							<?php if($this->db->get_where('frontend' , array('type' => 'home_text_button_1'))->row()->description != ''):?>
						    <a href="<?php echo $this->crud->getFront('home_redirect_button_1');?>" class="max-w btn btn-home signup-form__submit"><?php echo $this->crud->getFront('home_text_button_1');?></a>
							<?php endif;?>
							<?php if($this->db->get_where('frontend' , array('type' => 'home_text_button_2'))->row()->description != ''):?>
	                        <a href="<?php echo $this->crud->getFront('home_redirect_button_2');?>" class="max-w btn btn-outline-primary signup-form__submit"><?php echo $this->crud->getFront('home_text_button_2');?></a>
							<?php endif;?>
					    </div>
				    </div>
			    </form>
		    </div>
	    </div>
	    <div class="col-sm-12 homepage-hero__image row m-0">
		    <img src="<?php echo base_url();?>public/uploads/frontend/<?php echo $this->crud->getFront('home_image');?>">
		</div>
	</section>
	<section id="info-cards" class="info-cards">
	    <div class="row container-fluid justify-content-center">
	        <div class="col-sm-12 text-center pd-bottom">
	            <h1 class="text-title"><?php echo $this->crud->getFront('why_us_title');?></h1>
	            <h3 class="weight-100"><?php echo $this->crud->getFront('why_us_subtitle');?></h3>
	        </div>
		    <div class="info-card col-10 col-sm-10 col-md-3">
			    <div class="info-card__icon icon-1">
				    <i class="picons-thin-icon-thin-0729_student_degree_science_university_school_graduate"></i>
		    	</div>
			    <div class="info-card__title"><?php echo $this->crud->getFront('why_us_card_1_title');?></div>
			    <div class="info-card__text"><?php echo $this->crud->getFront('why_us_card_1_description');?></div>
		    </div>
		    <div class="info-card col-10 col-sm-10 col-md-3">
			    <div class="info-card__icon icon-2">
				    <i class="picons-thin-icon-thin-0658_cup_place_winner_award_prize_achievement"></i>
			    </div>
			    <div class="info-card__title"><?php echo $this->crud->getFront('why_us_card_2_title');?></div>
			    <div class="info-card__text"><?php echo $this->crud->getFront('why_us_card_2_description');?></div>
		    </div>
		    <div class="info-card col-10 col-sm-10 col-md-3">
			    <div class="info-card__icon icon-3">
				    <i class="picons-thin-icon-thin-0680_pencil_ruller_drawing"></i>
		    	</div>
			    <div class="info-card__title"><?php echo $this->crud->getFront('why_us_card_3_title');?></div>
			    <div class="info-card__text"><?php echo $this->crud->getFront('why_us_card_3_description');?></div>
		    </div>
	    </div>
	</section>
	<section class="homepage-presentations">
	    <div class="row presentations-header justify-content-center blue-color">
		    <div class="col-9 p-0 text-white">
			    <h3><?php echo $this->crud->getFront('why_us_bottom_title');?></h3>
			    <p><?php echo $this->crud->getFront('why_us_bottom_subtitle');?></p><br><br>
		    </div>
	    </div>
	    <div class="presentation">
		    <div class="row container-fluid">
			    <div class="presentation__content col-12 col-md-6">
			    <div class="title-2"><?php echo $this->crud->getFront('principal_intro');?></div>
				    <header class="presentation__content-header">
						<?php echo $this->crud->getFront('principal_title');?>
				    </header>
				    <p class="presentation__content-text">
						<?php echo $this->crud->getFront('principal_description');?>
	                    <br>
						<br><br>
						<?php if($this->db->get_where('frontend' , array('type' => 'principal_text_button'))->row()->description != ''):?>
	                    <a href="<?php echo $this->crud->getFront('principal_redirect_button');?>" class="btn btn-home signup-form__submit max-w"><?php echo $this->crud->getFront('principal_text_button');?></a>
						<?php endif;?>
				    </p>
			    </div>
			    <div class="presentation__image col-12 col-md-6 p-0">
				    <img src="<?php echo base_url();?>public/uploads/frontend/<?php echo $this->crud->getFront('principal_image');?>" class="radius-15">
			    </div>
		    </div>
	    </div>
		<div class="presen tation presentation--bg-grey">
	        <div class="post-co">
			    <div class="row container-fluid">
	                <div class="col-sm-12">
	                    <h1 class="news-title"><?php echo getEduAppGTLang('our_recent_news');?></h1>
	                </div>
					<?php 
						$this->db->where('is_public','1');
						$this->db->order_by('news_id', 'desc');
						$this->db->limit(3);
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
	                <div class="col-sm-12">
	                    <br>
	                    <a href="<?php echo base_url();?>news/" class="all-posts"><?php echo getEduAppGTLang('view_all_news');?> ></a>
	                </div>
	            </div>
	        </div>
		</div>
		<div class="presentation presentation--image-left presentation--bg-white">
			<div class="row container-fluid">
				<div class="presentation__content col-12 col-md-6">
					<div class="sub-t"><?php echo $this->crud->getFront('second_intro');?></div>
					<header class="presentation__content-header">
						<?php echo $this->crud->getFront('second_title');?>
					</header>
					<p class="presentation__content-text">
						<?php echo $this->crud->getFront('second_description');?>
					</p>
	                <br>
					<?php if($this->db->get_where('frontend' , array('type' => 'second_text_button'))->row()->description != ''):?>
	                <a href="<?php echo $this->crud->getFront('second_redirect_button');?>" class="max-w btn btn-outline-primary signup-form__submit"><?php echo $this->crud->getFront('second_text_button');?></a>
					<?php endif;?>
				</div>
				<div class="presentation__image col-12 col-md-6 p-0">
					<img class="radius-15" src="<?php echo base_url();?>public/uploads/frontend/<?php echo $this->crud->getFront('second_image');?>">
				</div>
			</div>
		</div>
	</section><br><br><br>