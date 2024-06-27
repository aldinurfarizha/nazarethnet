<footer class="footer">
	<div class="container-fluid">
		<div class="footer-links row justify-content-xl-end">
			<div class="col-xl-12 col-12 inner mb-5">
                <div class="row">
                    <div class="col-sm-5 center-col">
                        <div class="footer__description text-center">
                            <a href="<?php echo base_url();?>" class="footer-logo"><img src="<?php echo base_url();?>public/uploads/frontend/<?php echo $this->crud->getFront('footer_logo');?>" class="logo-foot"></a>
                            <p class="cl"><?php echo $this->crud->getFront('footer_text');?></p>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="footer-items">
                            <a class="footer-item" href="<?php echo base_url();?>news/"><?php echo getEduAppGTLang('news');?></a>
                            <a class="footer-item-2" href="<?php echo base_url();?>register/"><?php echo getEduAppGTLang('register');?></a>
                            <a class="footer-item-2" href="<?php echo base_url();?>about/"><?php echo getEduAppGTLang('about_us');?></a>
                            <a class="footer-item-2" href="<?php echo base_url();?>contact/"><?php echo getEduAppGTLang('contact');?></a>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="footer-items">
                            <?php if($this->crud->getInfo('facebook') != ''):?>
                            <a class="footer-item" href="<?php echo $this->crud->getInfo('facebook');?>"><img width="30px" src="<?php echo base_url();?>public/assets/frontend/img/social/fb.png"></a>
                            <?php endif;?>
                            <?php if($this->crud->getInfo('twitter') != ''):?>
                            <a class="footer-item" href="<?php echo $this->crud->getInfo('twitter');?>"><img width="30px" src="<?php echo base_url();?>public/assets/frontend/img/social/tw.png"></a>
                            <?php endif;?>
                            <?php if($this->crud->getInfo('youtube') != ''):?>
                            <a class="footer-item" href="<?php echo $this->crud->getInfo('youtube');?>"><img width="30px" src="<?php echo base_url();?>public/assets/frontend/img/social/yt.png"></a>
                            <?php endif;?>
                            <?php if($this->crud->getInfo('instagram') != ''):?>
                            <a class="footer-item" href="<?php echo $this->crud->getInfo('instagram');?>"><img width="30px" src="<?php echo base_url();?>public/assets/frontend/img/social/insta.png"></a>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
			</div>
		</div>
		<div class="row footer-bottom">
			<div class="col-12 col-md-6 offset-xl-1 justify-content-md-start d-flex justify-content-center">
				<ul>
					<li><a href="<?php echo base_url();?>terms_and_conditions/"><i class="picons-thin-icon-thin-0389_gavel_hammer_law_judge_court"></i> <?php echo getEduAppGTLang('terms_and_conditions');?></a></li>
				</ul>
			</div>
			<div class="col-12 col-md-6 col-xl-5 footer-bottom__copyright">
				<p>© <?php echo date('Y');?> <?php echo getEduAppGTLang('copyright');?> | <b><?php echo $this->crud->getInfo('system_name');?></b> <?php echo getEduAppGTLang('all_rights_reserved');?>.</p>
			</div>
		</div>
	</div>
</footer>