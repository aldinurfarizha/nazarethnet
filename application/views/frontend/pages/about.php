	<style>
		.homepage-hero::after{
			background-image: url(<?php echo base_url();?>public/uploads/frontend/<?php echo $this->crud->getFront('about_image');?>)!important;
		}
	</style>
	<section id="hero" class="homepage-hero container-fluid">
		<div class="row m-0 homepage-hero__left">
			<div class="col-lg-7 col-md-7 p-0">
				<h1 class="homepage-hero__title"><?php echo $this->crud->getFront('about_title');?></h1>
				<p class="mr-lg-5 pr-lg-4 homepage-hero__text"><?php echo $this->crud->getFront('about_subtitle');?></p>
				<div class="row align-items-center m-0">
					<?php if($this->db->get_where('frontend' , array('type' => 'about_text_button'))->row()->description != ''):?>
					<div class="col-12 p-0">
						<a href="<?php echo $this->crud->getFront('about_redirect_button');?>" class="max-w btn btn-outline-primary signup-form__submit"><?php echo $this->crud->getFront('about_text_button');?></a>
					</div>
					<?php endif;?>
				</div>
			</div>
		</div>
		<div class="col-sm-12 homepage-hero__image row m-0">
			<img src="<?php echo base_url();?>public/uploads/frontend/<?php echo $this->crud->getFront('about_image');?>">
		</div>
	</section>
	<section id="info-cards" class="info-cards">
		<div class="row container-fluid justify-content-center">
            <div class="col-sm-12 text-center pd-bottom">
                <h1 class="text-title"><?php echo $this->crud->getFront('widget_title');?></h1>
                <h3 class="weight-100"><?php echo $this->crud->getFront('widget_subtitle');?></h3>
            </div>
			<div class="info-card col-10 col-sm-10 col-md-3">
				<div class="info-card__icon icon-3">
					<i class="picons-thin-icon-thin-0032_flag"></i>
				</div>
				<div class="info-card__title"><?php echo $this->crud->getFront('about_mission');?></div>
				<div class="info-card__text"><?php echo $this->crud->getFront('about_mission_description');?></div>
			</div>
			<div class="info-card col-10 col-sm-10 col-md-3">
				<div class="info-card__icon icon-2">
					<i class="picons-thin-icon-thin-0032_flag"></i>
				</div>
				<div class="info-card__title"><?php echo $this->crud->getFront('about_vission');?></div>
				<div class="info-card__text"><?php echo $this->crud->getFront('about_vission_description');?></div>
			</div>
		</div>
	</section>
	<section class="homepage-presentations">
		<div class="row presentations-header justify-content-center blue-color">
			<div class="col-9 p-0 text-white">
				<h3><?php echo $this->crud->getFront('about_bottom_title');?></h3>
				<p><?php echo $this->crud->getFront('about_bottom_subtitle');?></p><br><br>
			</div>
		</div>
		<div class="presentation">
			<div class="row container-fluid">
				<div class="presentation__content col-12 col-md-6">
				<div class="title-2"><?php echo $this->crud->getFront('about_intro_text');?></div>
					<header class="presentation__content-header">
						<?php echo $this->crud->getFront('about_title_1');?>
					</header>
					<p class="presentation__content-text">
					<?php echo $this->crud->getFront('about_description_1');?>
                        <br><br>
						<?php if($this->db->get_where('frontend' , array('type' => 'about_text_button'))->row()->description != ''):?>
                        <a href="<?php echo $this->crud->getFront('about_redirect_button');?>" class="max-w btn btn-home signup-form__submit"><?php echo $this->crud->getFront('about_text_button');?></a>
						<?php endif;?>
					</p>
				</div>
				<div class="presentation__image col-12 col-md-6 p-0">
					<img src="<?php echo base_url();?>public/uploads/frontend/<?php echo $this->crud->getFront('about_image_widget');?>" class="radius-15">
				</div>
			</div>
		</div>
	</section><br><br><br>